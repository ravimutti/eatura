<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/controllers/MyController.php';
/**
 * Class Store
 */
class Store extends MyController
{
	const PaymentMethodPayPal = "Paypal";
	const PaymentMethodCash = "Cash";
	/**
	 * @var string
	 */
	public $productToppingMaps = "product_topping_maps";
	/**
	 * @var string
	 */
	public $productVariantMap = "variantMap";

	public $currentSlug = "";
	/**
	 * Store constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		$this->load->database();
		$this->load->model('Api_model');
		// $this->load->helper('cookie');
		$this->load->library('user_agent');
		$this->load->library('paypal_lib');
		date_default_timezone_set('Europe/Berlin');
		$this->checkIsAuth();

		$this->currentSlug = $this->input->cookie('uriRestaurant', true);
	}

	/**
	 *
	 */
	public function index()
	{
		if(trim($this->currentSlug) == "") {
			$this->currentSlug = $this->uri_slug;
		}

		delete_cookie('pincode');
		delete_cookie('delivery_type');
		if (isset($_POST['pincode']) || isset($_POST['delivery'])) {
			$pinCode = $_POST['pincode'];
			if($_POST['delivery'] == "delivery" && trim($pinCode) !="") {
				$cookie = array('name' => 'pincode','value' => $pinCode,'expire' => time()+86400,"path"=>'/');
				$this->input->set_cookie($cookie);
			}

			$cookie = array('name' => 'delivery_type','value' => $_POST['delivery'],'expire' => time()+86400,"path"=>'/');
			$this->input->set_cookie($cookie);

			if(isset($_SERVER['HTTP_REFERER'])) {
				$link_array = explode('/',$_SERVER['HTTP_REFERER']);
    		$page = end($link_array);
				if($page == "place-order") {
					return redirect($_SERVER['HTTP_REFERER']);
				}
			}

			return redirect('/' . $this->currentSlug);
		}

		$url = SITEURL . "getAllRestruent";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "purchaseKey=value");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = json_decode(curl_exec($ch));
		curl_close($ch);
		$this->load->view('all-restruents', $response);
	}

	public function updateresetpassword()
	{
		$url = SITEURL . "updateresetpassword";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = json_decode(curl_exec($ch));
		curl_close($ch);

		if (!empty($response)) {
			if ($response->error == '202')
			{
				return redirect('/');
			}
			else
			{
				return redirect('resetpassword/'.$_POST['token']);
			}
		}
		return redirect('/');
 	}

	public function resetpassword($token)
	{
		$url = SITEURL . "gettoken";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array("token" => $token));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = json_decode(curl_exec($ch));
		curl_close($ch);
		if (!empty($response)) {
			if ($response->error == '202') {
				$this->load->view('resetpassword', $response);
			} else {
				return redirect($_SERVER['HTTP_REFERER']);
			}
		} else {
			return redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function restaurantBarCodeAction() {
		delete_cookie('pincode');
		delete_cookie('delivery_type');
		$queryParams = $_GET;
		// http://localhost/eatura/000024?d=d&pincode=123456
		// print_r($queryParams);die;
		if (isset($queryParams['pincode']) || isset($queryParams['delivery'])) {
			$pinCode = isset($queryParams['pincode']) ? $queryParams['pincode'] : '';
			if($queryParams['delivery'] == "delivery" && trim($pinCode) !="") {
				$cookie = array('name' => 'pincode','value' => $pinCode,'expire' => time()+86400,"path"=>'/');
				$this->input->set_cookie($cookie);
			}
			$cookie = array('name' => 'delivery_type','value' => $queryParams['delivery'],'expire' => time()+86400,"path"=>'/');
			$this->input->set_cookie($cookie);
			return redirect('/' . $this->currentSlug);
		}
	}

	/**
	 * @param $slug
	 */
	public function shop($slug)
	{
		// here we need to check get variables
		$queryParams = $_GET;
		if(isset($queryParams['d'])) {
			$delivery_type = "self";
			$pincode = "";
			if($queryParams['d'] == 'd')
				$delivery_type = "delivery";

			if( isset($queryParams['pincode']) && trim($queryParams['pincode']) !="")
				$pincode = $queryParams['pincode'];

			return redirect(site_url("/restaurant-barcode?delivery=$delivery_type&pincode=$pincode"));
		}
		// print_r($queryParams);die;
		$pinCode = $this->input->cookie('pincode', true);
		$cookie = array('name' => 'uriRestaurant','value' =>$slug,'expire' => time()+86400);
		$this->input->set_cookie($cookie);

		$isByPassPinCodeCheck = ($this->input->cookie('delivery_type', true) == "self" || trim($this->input->cookie('delivery_type', true)) === "") ? true : false;
		$queryString = "purchaseKey=value1&slugname=$slug&pincode=$pinCode";

		// echo $queryString;die;
		$url = SITEURL . "getDetails";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $queryString);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = json_decode(curl_exec($ch));
		curl_close($ch);
		// echo "<pre>";print_r($response);die;
		if (!empty($response)) {
			$response->errorMessageInCaseOfPinCode = null;
			if ($response->error == '202') {
				// here we need to match pin code first
				if (!in_array($pinCode, array_column($response->deliverydetails, 'pincode')) && !$isByPassPinCodeCheck) {
					// pin code not matched return to home page
					$this->session->set_flashdata('pin_code_not_found', "We are not available on entered pin code.");
					$response->restaurant_status = 0;
					$response->errorMessageInCaseOfPinCode =  $response->profile->name." is not delivering orders on the entered pin code.";
					$this->cart->destroy();
				}
				if ($this->input->cookie('currentRestaurant', TRUE) !== $slug) {
					$this->cart->destroy();
					delete_cookie('pincode');
					delete_cookie('delivery_type');
				}

				$cookie = array('name' => 'currentRestaurant','value' => $response->profile->slugname,'expire' => time()+86400);
				$this->input->set_cookie($cookie);

				$response->pinCode = $this->input->cookie('pincode', true);
				$url = SITEURL . "pincodes";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, "purchaseKey=value1&slugname=" . $slug);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$pincodes = json_decode(curl_exec($ch));
				curl_close($ch);
				$response->pincodes = $pincodes->pincodes;
				$this->load->view('shoppingpage', $response);
			} elseif ($response->error == '404') {
				// $this->session->set_flashdata('pin_code_not_found', "Restaurant not found, please enter your area pin code and try again.");
				// return redirect($_SERVER['HTTP_REFERER']);
				$this->load->view('errors/html/error_404');
			}
		} else {
			$this->load->view('errors/html/error_404');
		}
	}

	/**
	 * @purpose save cart items
	 * @method storeCartItemAction
	 */
	public function storeCartItemAction()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		// here we need to add item to cart
		$postData = json_decode($this->input->post('postData'));
		$deliveryCharge = json_decode($this->input->post('deliveryCharge'));

		$cartItems = array();
		foreach ($postData as $k => $post) {
			// we need to match cart values with db for price
			$product = $this->Api_model->getProductBySlug($post->options->product->productSKU);
			if (isset($product->id)) {
				// check addOn prices
				$addOnPrice = $postData[$k]->price;
				$options = $post->options->variants;
				$post->options->deliveryCharge = $deliveryCharge;
				if (is_array($options)) {
					foreach ($options as $key => $option) {
						if (is_array($option->variantArr)) {
							foreach ($option->variantArr as $v => $variant) {
								// here we need to modify price according price
								foreach ($variant->addOns as $a => $addOn) {
									if ($option->type == $this->productToppingMaps)
										$optionRowById = $this->Api_model->getProductToppingMapsById($option->id);
									else
										$optionRowById = $this->Api_model->getProductVariantMapsById($option->id);

									if (isset($optionRowById->price)) {
										$postData[$k]->options->variantArr[$v]->addOns[$a] = $option;
										$postData[$k]->options->variantArr[$v]->addOns[$a]->price = $optionRowById->price;
										$addOnPrice += $postData[$k]->options->variantArr[$v]->addOns[$a]->price;
									}
								}
							}
						}
					}
				} else {
					$addOnPrice = $postData[$k]->price;
				}

				$post = $postData[$k];
				// echo "<pre>";print_r($post);
				$itemPrice = $addOnPrice;
				$cartItems[$k] = array(
					'id' => $post->id,
					'qty' => $post->qty,
					'price' => $itemPrice,
					'name' => $post->name,
					'options' => (array) $post->options
				);
			}
		}
		$this->cart->destroy();
		$this->cart->product_name_rules = '[:print:]';
		$this->cart->insert($cartItems);
		echo json_encode(array('success' => true, "message" => 'cart has been updated.'));die;
	}


	/**
	 * @purpose load checkout page and submit details to order place api
	 * @method placeOrderAction
	 */
	public function placeOrderAction()
	{
		if (trim($this->uri->segment(1)) != "") {
			// we need to pass user details as well
			$slug = $this->uri->segment(1);
			$url = SITEURL . "getRestaurant";
			$pin_code = $this->input->cookie('pincode', true);
			$delivery_type = $this->input->cookie('delivery_type', true);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "slugname=$slug&pincode=$pin_code&delivery_type=$delivery_type" );
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = json_decode(curl_exec($ch));
			curl_close($ch);

			if (!empty($response) ) {
				if ($response->error == '202') {
					// here we need to pass delivery charge
					$cartItem = $this->cart->contents();
					$cartItem = array_values($cartItem);
					$response->matchedPinCodeRow = $response->pincode;
					$url = SITEURL . "pincodes";
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, "purchaseKey=value1&slugname=" . $slug);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$pincodes = json_decode(curl_exec($ch));
					curl_close($ch);
					$response->pincodes = $pincodes->pincodes;
					$response->no_cart_item = sizeof($this->cart->contents()) > 0 ? false : true;
					$this->load->view('checkout', $response);
				} elseif ($response->error == '404') {
					$this->session->set_flashdata('pin_code_not_found', "Restaurant not found, please enter your area pin code and try again.");
					return redirect('/', 'refresh');
				}
			} else {
				$this->session->set_flashdata('pin_code_not_found', "Restaurant not found, please enter your area pin code and try again.");
				return redirect('/', 'refresh');
			}
		}
	}

	/**
	 * @purpose place order api to save order details to db
	 * @method checkoutAction
	 */
	public function checkoutAction()
	{
		$order = $_POST;
		$order['order_user_details']['keyid'] = null;
		if(isset($this->session->userdata('userdata')['user']->userId)) {
			$order['order_user_details']['keyid'] = $this->session->userdata('userdata')['user']->userId;
		}
		$order["cart"] = $this->cart->contents();
		$data_string = json_encode($order);
		$url = SITEURL . "checkoutAction";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array("postData" => $data_string));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = json_decode(curl_exec($ch));
		curl_close($ch);
		// print_r($response);die;
		if (!empty($response)) {
			if ($response->error == '202') {
				$response->delayTime = 2000;
				$this->cart->destroy();
				if($order['order']['payment_mode'] === self::PaymentMethodPayPal) {
					return $this->buyWithPaypalProduct($response);
				}
				$response->url = site_url('order/tracking/' . $response->order);
				echo json_encode($response);
				die;
			} elseif ($response->error == '404') {
				echo json_encode($response);
				die;
			}
		} else {
			echo json_encode(array("success" => false, "error_message" => "Something went wrong please try again"));
			die;
		}
	}

	/**
	 *
	 */
	public function thankYouAction()
	{
		$id = $this->uri->segment(3);
		$url = SITEURL . "getorder";

		$pin_code = $this->input->cookie('pincode', true);
		$delivery_type = $this->input->cookie('delivery_type', true);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array(
			"order_id" => $id,
			"pin_code" => $id,
			"delivery_type" => $delivery_type,
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = json_decode(curl_exec($ch));
		curl_close($ch);
		// echo "<pre>";
		// // print_r($response->order->orders); echo "</pre>";
		//
		// foreach ($response->order->orders as $key => $value) {
		// 	$product_array = json_decode($value->product_add_ons);
		// 	print_r( $product_array->product->addOnsString );
		// }

		// die;
		if (!empty($response)) {
			if ($response->error == '202') {
				$this->load->view('order-detail', $response);
			} elseif ($response->error == '404') {
				echo json_encode($response);
				die;
			}
		} else {
			echo json_encode(array("success" => false, "error_message" => "Something went wrong please try again"));
			die;
		}
	}

	public function buyWithPaypalProduct($post){
        //Set variables for paypal form
        $returnURL 	= base_url().'paypal/success'; //payment success url
        $failURL 	= base_url().'paypal/fail'; //payment fail url
        $notifyURL 	= base_url().'paypal/ipn'; //ipn url
		$userID 	= 0; //current user id
		if(isset($this->session->userdata('userdata')['user']->userId)) {
			$userID  = $this->session->userdata('userdata')['user']->userId;
		}
        $logo 		= base_url().'Your_logo_url';
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('fail_return', $failURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $post->order);
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('amount',  $post->amount);
        $this->paypal_lib->image($logo);
        $this->paypal_lib->paypal_auto_form();
	}

	public function paypalPaymentSuccessAction(){
		log_message('error', 'Some variable did not contain a value.');
		$rawData = $_POST;
		return redirect(site_url('/order/tracking/'.$rawData['item_name']));
    }

    public function paypalPaymentpaymentFailAction(){
        //if transaction cancelled
        echo "Your order has been cancelled.";
    }


	public function paypalIpnAction(){
        //paypal return transaction details array
		$paypalInfo    			        = $this->input->post();
        $data['user_id'] 		        = $paypalInfo['custom'];
        $data['order_id'] 		        = $paypalInfo["item_name"];
        $data['transaction_id']         = $paypalInfo["txn_id"];
        $data['paid_amount'] 	        = $paypalInfo["mc_gross"];
        $data['transaction_raw_data'] 	= json_encode($paypalInfo);
        $data['payment_mode'] 	        = self::PaymentMethodPayPal;
        $data['payment_status']         = $paypalInfo["payment_status"];
        $data['created_at']             = date("Y-m-d h:i:s");
        $data['updated_at']             = date("Y-m-d h:i:s");

        $paypalURL = $this->paypal_lib->paypal_url;
        $result    = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
        //check whether the payment is verified
        if(preg_match("/VERIFIED/i",$result)){
            //insert the transaction data into the database
			$url = SITEURL . "saveTransaction";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = json_decode(curl_exec($ch));
			curl_close($ch);
        }
    }

	/**/
	public function review($orderId)
	{
		if(!isset($this->session->userdata('userdata')['user']->userId)) {
			return redirect('/' . $this->currentSlug);
		}
		$url = SITEURL . "getReviewByOrderId";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array('order_id' => $orderId));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = json_decode(curl_exec($ch));
		curl_close($ch);

		//echo '<pre>'; print_r($response);

		if (!empty($response)) {
			if ($response->error == '202') {
				$this->load->view('review', $response);
			} elseif ($response->error == '404') {
				return redirect('/' . $this->currentSlug);
			} elseif ($response->error == '505') {
				return redirect('/' . $this->currentSlug);
			}
		} else {
			return redirect('/' . $this->currentSlug);
		}
	}

	public function orderreview() {
		$post = $this->input->post();

		if (!in_array($post['rating'], array(1,2,3,4,5)))
		{
		  return redirect('/' . $this->currentSlug);
		}
		/* $order_id = $post['order_id'];
		$rating = $post['rating'];
		$review = $post['review']; */

		if(isset($this->session->userdata('userdata')['user']->userId)) {
			$_POST['user_id'] = $this->session->userdata('userdata')['user']->userId;
		}
		else
		{
			return redirect('/' . $this->currentSlug);
		}


		$url = SITEURL . "updatereview";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = json_decode(curl_exec($ch));
		curl_close($ch);
		/* echo $_POST['order_id'];
		echo '<pre>'; print_r($response); die; */

		if (!empty($response)) {
			if ($response->error == '202') {
				$this->session->set_flashdata('success', "Successfully review submit.");
				return redirect('/review/' . $_POST['order_id']);
			} elseif ($response->error == '404') {
				$this->session->set_flashdata('error', $response->data);
				return redirect('/review/' . $_POST['order_id']);
			} elseif ($response->error == '505') {
				$this->session->set_flashdata('error', $response->data);
				return redirect('/review/' . $_POST['order_id']);
			}
		} else {
			return redirect('/' . $this->currentSlug);
		}

	}


}
