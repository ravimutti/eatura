<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Ravinder singh / ravimutti.mutti@gmail.com
 * @version : 1.0
 * @since : 10.08.2020
 */
class Test extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Api_model');
        
    }
    
    /**
     * This function used to load the first screen of the user
     */
	 
	 
	public function getDetails($slug){
		$response=array();
		if(!empty($slug)){
			$profile=$this->Api_model->getProfile($slug);
			if(!empty($profile)){
			$response['profile']=$profile;
			$response['categories']=$this->Api_model->getCategory($profile->userId);
			$response['products']=$this->Api_model->getProduct($profile->userId);
			$response['error']='202';
			$response['message']='profile fetch successfully';
			}else{
			$response['error']='404';
			$response['message']='Not found.';
			}
		}else{
			$response['error']='505';
			$response['message']='data error.';
		}
		
		echo json_encode($response);die;
	}
	
    public function index()
    {
      
           $data = $this->Api_model->getProductByStoreId(20);
		   $response = array();
		   foreach($data as $product) {
			   $product_variants = $this->Api_model->getProductVariantByProductId($product->id);
			   $product_variant_data = array();
			   foreach($product_variants as $product_variantobj) {
				   if($product_variantobj->type == 1) {
					   $product_variantobj->product_variant_maps = array();
					   $variants = $this->Api_model->getProductVariantMapByParentMapId($product_variantobj->id, $product_variantobj->type);
					   
					   
					   foreach($variants as $variant) {
						   $variant->variantMap = array();
						   $variant->variantMap[] = $this->Api_model->getProductTopping($variant->id, $product_variantobj->type);
					   }
					   
					   $product_variantobj->product_variant_maps[] = $variants;
					   
					   
					   
					   $product_variant_data[] = $product_variantobj;
				   } else if($product_variantobj->type == 2) {
						$product_variantobj->product_topping_maps[] = $this->Api_model->getProductTopping($product_variantobj->id, $product_variantobj->type);
						$product_variant_data[] = $product_variantobj;
				   }
				   
			   }
			   $product->product_variants = $product_variant_data;
			   $response[] = $product;
		   }
		   echo '<pre>'; print_r($response);
           
    }
	
	
	
}

?>