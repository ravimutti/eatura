<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Store (StoreController)
 * User Class to control all user related operations.
 * @author : Ravinder singh / ravimutti.mutti@gmail.com
 * @version : 1.0
 * @since : 18.08.2020
 */
class Store extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Store_model');
		$this->load->model('Product_model');
        $this->isLoggedIn();
    }
	public function categories(){
				if($this->input->post('submit')){
					$this->load->library('form_validation');
					$this->form_validation->set_rules('name','Category Name','trim|required|max_length[128]');
					if($this->form_validation->run() == TRUE)
					{
						$checkpoint=$this->Store_model->check_category($this->session->userdata('userId'),$this->input->post('name'));
						 $slugname = $this->slugify(ucwords(strtolower($this->security->xss_clean($this->input->post('name')))));
							$image='';
							if($checkpoint==0){
								$config = array(
									'upload_path' => FCPATH."assets/uploads/category/",
									'allowed_types' => 'jpg|png|jpeg|gif',
									'max_size' => "20048"
								);
							 $this->load->library('upload', $config);
							 if($this->upload->do_upload('bannerimage')){
								  $uploadedimage = $this->upload->data();
								  $image=$uploadedimage['file_name'];
							 }else{
								$this->session->set_flashdata('error', $this->upload->display_errors());
								redirect('categories');								 
							 }
								$insert=array(
									'storeid'=>$this->session->userdata('userId'),
									'catslug'=>$slugname,
									'category'=>$this->input->post('name'),
									'note'=>$this->input->post('note'),
									'description'=>$this->input->post('description')
								);
								if(!empty($image)){
									$insert['cimage']=$image;
								}
								$result=$this->Store_model->insert($insert,'categories');
								if($result>0){
										$this->session->set_flashdata('success', 'Category added successfully');
										redirect('categories');
								}else{
									$this->session->set_flashdata('error', 'Something went wrong please try again later.');
										redirect('categories');
								}
							}else{
								 $this->session->set_flashdata('error', 'Category already exists');
								redirect('categories');
							}
					}
				}
				$this->global['pageTitle'] = 'Eatura : Categories List';
				$data['storelist']=$this->Store_model->getCategory($this->session->userdata('userId'));
				$this->loadViews("store/categories", $this->global, $data, NULL);
	}
	
	/* public function storelist()
	{
		$this->global['pageTitle'] = 'Eatura : Restaurant List';
		$data['storelist']=$this->Store_model->getRestaurant();
		$this->loadViews("store/restaurant", $this->global, $data, NULL);
	} */
	
	public function restaurant()
	{
		$this->global['pageTitle'] = 'Eatura : Restaurant List';
		$data['storelist']=$this->Store_model->getRestaurant();
		$this->loadViews("store/restaurant", $this->global, $data, NULL);
	}
	
	public function updatecategory($id = null) {
			
		if($this->input->post()){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name','Category Name','trim|required|max_length[128]');
            
            if($this->form_validation->run() == FALSE) {
				//echo json_encode(array('status' => 'error', 'error' => 'The Category Name field is required.')); exit;
				redirect('store/updatecategory/'.$id);
			}
			
			$checkpoint=$this->Store_model->check_categoryid($id,$this->session->userdata('userId'),$this->input->post('name'));
			 $slugname = $this->slugify(ucwords(strtolower($this->security->xss_clean($this->input->post('name')))));
				$image='';
				if($checkpoint==0){
					
					/* $config = array(
						'upload_path' => FCPATH."assets/uploads/category/",
						'allowed_types' => 'jpg|png|jpeg|gif',
						'max_size' => "20048"
					);
				 $this->load->library('upload', $config);
				 if($this->upload->do_upload('bannerimage')){
					  $uploadedimage = $this->upload->data();
					  $image=$uploadedimage['file_name'];
				 }else{
					 echo json_encode(array('status' => 'error', 'error' => $this->upload->display_errors())); exit;								 
				 } */
					$insert=array(
						'storeid'=>$this->session->userdata('userId'),
						'catslug'=>$slugname,
						'category'=>$this->input->post('name'),
						'note'=>$this->input->post('note'),
						'description'=>$this->input->post('description')
					);
					if(!empty($image)){
						$insert['cimage']=$image;
					}
					$result=$this->Store_model->update($this->input->post('id'), $insert,'categories');
					if($result>0){
						$this->session->set_flashdata('success', 'successfully Update');
						redirect('categories');
					}else{
						 $this->session->set_flashdata('error', 'Something went wrong please try again later.');
						redirect('store/updatecategory/'.$id);
					}
				}else{
					$this->session->set_flashdata('error', 'Category already exists');
					redirect('store/updatecategory/'.$id);
				}
			
		} else {
			$data['category'] = $this->Store_model->getCategoryById($id, $this->session->userdata('userId'));
			$this->global['pageTitle'] = 'Update Category';
			//cho '<pre>'; print_r($data['category']->id); die;
			$this->loadViews("store/categoryform", $data, NULL, true);
		}
	}
	
	public function variations_toppings(){
		if($this->input->post('topping')){
				$this->load->library('form_validation');
				$this->form_validation->set_rules('tname','Topping Name','trim|required|max_length[128]');
				if($this->form_validation->run() == TRUE)
				{
					$name = ucwords(strtolower($this->security->xss_clean($this->input->post('tname'))));
					$slugname = $this->slugify(ucwords(strtolower($this->security->xss_clean($this->input->post('tname')))));
					if($this->Store_model->checkTopping($this->session->userdata('userId'),$name)==0)
					{
							$insert=array(
								'toppingname'=>$name,
								'storeid'=>$this->session->userdata('userId'),
								'toppingslug'=>$slugname,
							);
							$result=$this->Store_model->insert($insert,'toppings');
							if($result>0)
							{
								$this->session->set_flashdata('success', 'Topping added successfully');
								redirect('variations-toppings');
							}else{
								$this->session->set_flashdata('error', 'Something went wrong please try again later.');
								redirect('variations-toppings');
							}
					}else{
						$this->session->set_flashdata('error', 'Topping name already exist.Please choose new name.');
						redirect('variations-toppings');
					}
				}
		}
		if($this->input->post('variation')){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('vname','Variation Name','trim|required|max_length[128]');
					if($this->form_validation->run() == TRUE)
					{
						$name = ucwords(strtolower($this->security->xss_clean($this->input->post('vname'))));
						$slugname = $this->slugify(ucwords(strtolower($this->security->xss_clean($this->input->post('vname')))));
						if($this->Store_model->checkVariation($this->session->userdata('userId'),$name)==0){
								$insert=array(
									'variationname'=>$name,
									'storeid'=>$this->session->userdata('userId'),
									'variationslug'=>$slugname,
								);
								$result=$this->Store_model->insert($insert,'variations');
								if($result>0){
									$this->session->set_flashdata('success', 'Variation added successfully');
									redirect('variations-toppings');
								}else{
									$this->session->set_flashdata('error', 'Something went wrong please try again later.');
									redirect('variations-toppings');
								}
						}else{
							$this->session->set_flashdata('error', 'Variation name already exist.Please choose new name.');
							redirect('variations-toppings');
						}
					}	
		}
		$this->global['pageTitle'] = 'Eatura : Variations & Toppings List';
		$data['toppings']=$this->Store_model->getToppings($this->session->userdata('userId'));
		$data['variations']=$this->Store_model->getVariations($this->session->userdata('userId'));
		$this->loadViews("store/variations-toppings", $this->global, $data, NULL);
	}
	public function createProduct(){
		$this->global['pageTitle'] = 'Eatura : Add New product';
		$data['toppings']=$this->Store_model->getToppings($this->session->userdata('userId'));
		$data['variations']=$this->Store_model->getVariations($this->session->userdata('userId'));
		// pre($data['variations']);die;
		$data['categories']=$this->Store_model->getCategory($this->session->userdata('userId'));
		$this->loadViews("store/products", $this->global, $data, NULL);
	}
	
	public function price_validate($val)
    {
		if($val == '')
		{
			$this->form_validation->set_message('price_validate', 'The {field} field is required.');
            return FALSE;
		}
		else if ($val > 0) {
			return TRUE;
        } else {
            $this->form_validation->set_message('price_validate', 'The {field} field must be number or decimal.');
            return FALSE;
        }
    }
	
	public function handleVariation($productId, $label, $variations, $price) {
		if(isset($label)) {
			$userId = $this->session->userdata('userId');
			$result = $this->Product_model->handleProductVariant($userId, $productId, $label, $variations, $price);
		}
	}
	
	public function product_name($val)
    {
		if(empty($val))
		{
			$this->form_validation->set_message('product_name', 'The {field} field is required.');
            return FALSE;
		}
		
		$checkProduct = $this->Store_model->check_product($this->session->userdata('userId'), $this->slugify(ucwords(strtolower($val))));
		if($checkProduct)
		{
			$this->form_validation->set_message('product_name', 'The {field} already exixt.');
            return FALSE;
		}
    }
	
	function checkProductExists()
    {
		$name = ucwords(strtolower($this->security->xss_clean($this->input->post('name'))));
		$result = $this->Store_model->check_product($this->session->userdata('userId'), $name);

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
	
	public function handleProduct() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','trim|required|max_length[128]');
		$this->form_validation->set_rules('category_id','Category','trim|required|numeric');
		$this->form_validation->set_rules('type_id','Type','required|numeric');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('productprice', 'Price', 'required|trim|callback_price_validate');

		if($this->form_validation->run() == FALSE) {
			$this->createProduct();
		} else {
			if(isset($_FILES['image']) && $_FILES['image'] == 0)
			{
				$config = array(
					'upload_path' => FCPATH."assets/uploads/product",
					'allowed_types' => 'jpg|png|jpeg|gif',
					'max_size' => "20048"
				);
				$image = '';
				$this->load->library('upload', $config);
				 if($this->upload->do_upload('image'))
				 {
					  $uploadedimage = $this->upload->data();
					  $image=$uploadedimage['file_name'];
				 }
				 else 
				 {
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect('createProduct');							 
				 }
			}
			 
			 $name = ucwords(strtolower($this->security->xss_clean($this->input->post('name'))));
			 $checkProduct = $this->Store_model->check_product($this->session->userdata('userId'), $name);
			if($checkProduct)
			{
				$this->session->set_flashdata('error', 'The '.$name.' already use.');
				redirect('createProduct');	
			}
		
             $slugname = $this->slugify(ucwords(strtolower($this->security->xss_clean($this->input->post('name')))));
			 $category_id = $this->slugify(ucwords(strtolower($this->security->xss_clean($this->input->post('category_id')))));
			 $type_id = $this->slugify(ucwords(strtolower($this->security->xss_clean($this->input->post('type_id')))));
			 $description = $this->slugify(ucwords(strtolower($this->security->xss_clean($this->input->post('description')))));
			 $price = $this->security->xss_clean($this->input->post('productprice'));
			 
			 $data = array(
				'name'=> $name,
				'slugname'=> $slugname,
				'category_id'=> $category_id,
				'storeid'=> $this->session->userdata('userId'),
				'type_id'=>$type_id,
				'description'=>$description,
				'price'=>$price,
				'image'=>$image
			);
								
			$result = $this->Product_model->createProduct($data);
			
			if($result > 0)
			{
				$this->handleVariation($result, $this->input->post('label'), $this->input->post('variation'), $this->input->post('price')); 
				$this->session->set_flashdata('success', 'New Product created successfully');
			}
			else
			{
				$this->session->set_flashdata('error', 'Product creation failed');
            }
                
			redirect('createProduct');
		}
	}
	
	public function products() {
		$this->global['pageTitle'] = 'Eatura : Product List';
		$data['products']=$this->Product_model->products($this->session->userdata('userId'));
		
		$this->loadViews("store/productlisting", $this->global, $data, NULL);
	}
	
	public function productclone($id) {
		$this->global['pageTitle'] = 'Eatura : Clone product';
		$product = $this->Product_model->getProductById($id,$this->session->userdata('userId'));
		if($product == null)
		{
			redirect('store/products');
		}
		$data['product']=$product;
		$data['ttoppingus']=$this->Store_model->getToppings($this->session->userdata('userId'));
		$data['variationdata']=$this->Store_model->getVariations($this->session->userdata('userId'));
		
		$data['categories']=$this->Store_model->getCategory($this->session->userdata('userId'));
		
		$data['productVariants']=$this->Product_model->getProductVariantByProductId($product->id);
		
			//echo '<pre>'; print_r($data['toppings']);die;	
		$this->loadViews("store/productclone", $this->global, $data, NULL);
	}
	
	public function cloneproduct($id)
	{
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','trim|required|max_length[128]');
		$this->form_validation->set_rules('category_id','Category','trim|required|numeric');
		$this->form_validation->set_rules('type_id','Type','required|numeric');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('productprice', 'Price', 'required|trim|callback_price_validate');

		if($this->form_validation->run() == FALSE) {
			$this->productclone($id);
		} else {
			if(isset($_FILES['image']) && $_FILES['image'] == 0)
			{
				$config = array(
					'upload_path' => FCPATH."assets/uploads/product",
					'allowed_types' => 'jpg|png|jpeg|gif',
					'max_size' => "20048"
				);
				$image = '';
				$this->load->library('upload', $config);
				 if($this->upload->do_upload('image'))
				 {
					  $uploadedimage = $this->upload->data();
					  $image=$uploadedimage['file_name'];
				 }
				 else 
				 {
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect('createProduct');							 
				 }
			}
			 
			 $name = ucwords(strtolower($this->security->xss_clean($this->input->post('name'))));
			 $checkProduct = $this->Store_model->check_product($this->session->userdata('userId'), $name);
			if($checkProduct)
			{
				$this->session->set_flashdata('error', 'The '.$name.' already use.');
				redirect('createProduct');	
			}
		
             $slugname = $this->slugify(ucwords(strtolower($this->security->xss_clean($this->input->post('name')))));
			 $category_id = $this->slugify(ucwords(strtolower($this->security->xss_clean($this->input->post('category_id')))));
			 $type_id = $this->slugify(ucwords(strtolower($this->security->xss_clean($this->input->post('type_id')))));
			 $description = $this->slugify(ucwords(strtolower($this->security->xss_clean($this->input->post('description')))));
			 $price = $this->security->xss_clean($this->input->post('productprice'));
			 
			 $data = array(
				'name'=> $name,
				'slugname'=> $slugname,
				'category_id'=> $category_id,
				'storeid'=> $this->session->userdata('userId'),
				'type_id'=>$type_id,
				'description'=>$description,
				'price'=>$price,
				'image'=>$image
			);
								
			$result = $this->Product_model->createProduct($data);
			
			if($result > 0)
			{
				$this->handleVariation($result, $this->input->post('label'), $this->input->post('variation'), $this->input->post('price')); 
				$this->session->set_flashdata('success', 'New Product created successfully');
			}
			else
			{
				$this->session->set_flashdata('error', 'Product creation failed');
            }
                
			redirect('createProduct');
		}
	}
	
	public function updateProductform($id){
		$this->global['pageTitle'] = 'Eatura : Update product';
		$product = $this->Product_model->getProductById($id,$this->session->userdata('userId'));
		if($product == null)
		{
			redirect('store/products');
		}
		$data['product']=$product;
		$data['ttoppingus']=$this->Store_model->getToppings($this->session->userdata('userId'));
		$data['variationdata']=$this->Store_model->getVariations($this->session->userdata('userId'));
		
		$data['categories']=$this->Store_model->getCategory($this->session->userdata('userId'));
		
		$data['productVariants']=$this->Product_model->getProductVariantByProductId($product->id);
		
			//echo '<pre>'; print_r($data['toppings']);die;	
		$this->loadViews("store/updateproduct", $this->global, $data, NULL);
	}
	
	public function detetevariation()
	{
		$variationId = $this->input->post('id');
		$this->input->post('type');
		echo json_encode(array('status' => 'success'));
	}
	
	public function updateproduct($id)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','trim|required|max_length[128]');
		$this->form_validation->set_rules('category_id','Category','trim|required|numeric');
		$this->form_validation->set_rules('type_id','Type','required|numeric');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('productprice', 'Price', 'required|trim|callback_price_validate');
		
		if($this->form_validation->run() == FALSE) {
			$this->updateProductform($id);
		} else {
			 $image = null;
			 if(isset($_FILES['image']) && $_FILES['image'] == 0)
			{
				$config = array(
					'upload_path' => FCPATH."assets/uploads/product",
					'allowed_types' => 'jpg|png|jpeg|gif',
					'max_size' => "20048"
				);
				
				$this->load->library('upload', $config);
				 if($this->upload->do_upload('image'))
				 {
					  $uploadedimage = $this->upload->data();
					  $image=$uploadedimage['file_name'];
				 }
				 else 
				 {
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect('createProduct');							 
				 }
			}
			 
			 $name = ucwords(strtolower($this->security->xss_clean($this->input->post('name'))));
             $slugname = $this->slugify(ucwords(strtolower($this->security->xss_clean($this->input->post('name')))));
			 $category_id = $this->slugify(ucwords(strtolower($this->security->xss_clean($this->input->post('category_id')))));
			 $type_id = $this->slugify(ucwords(strtolower($this->security->xss_clean($this->input->post('type_id')))));
			 $description = $this->slugify(ucwords(strtolower($this->security->xss_clean($this->input->post('description')))));
			 $price = $this->slugify(ucwords(strtolower($this->security->xss_clean($this->input->post('productprice')))));
			 
			 $data = array(
				'name'=> $name,
				'slugname'=> $slugname,
				'category_id'=> $category_id,
				'type_id'=>$type_id,
				'description'=>$description,
				'price'=>$price,
				'updatedDtm'=>date('Y-m-d H:i:s')
			);
			
			if($image != null) {
				$data['image'] = $image;
			}
			
			$result = $this->Store_model->update($id,$data,'products');
			
			if($result > 0)
			{
				$this->handleVariation($id, $this->input->post('label'), $this->input->post('variation'), $this->input->post('price')); 
				$this->session->set_flashdata('success', 'Product update successfully');
				redirect('store/products/');
			}
			else
			{
				$this->session->set_flashdata('error', 'Product creation failed');
            }
			redirect('store/updateproduct/'.$id);
		}
	}
	
	public  function slugify($text)
	{
		// replace non letter or digits by -
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);

		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		// trim
		$text = trim($text, '-');

		// remove duplicate -
		$text = preg_replace('~-+~', '-', $text);

		// lowercase
		$text = strtolower($text);

		if (empty($text)) {
		return 'n-a';
		}
		return $text;
	}
}