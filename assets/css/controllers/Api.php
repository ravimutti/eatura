<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
/**
 * Class : Api (Api Controller)
 * Api Class to control all apis related  frontend operations.
 * @author : Ravinder singh / ravimutti.mutti@gmail.com
 * @version : 1.0
 * @since : 02.09.2020
 */
class Api extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Api_model');
    }
	public function getDetails(){
		$response=array();
		if(!empty($this->input->post('slugname'))){
			$slug=$this->input->post('slugname');
			$profile=$this->Api_model->getProfile($slug);
			if(!empty($profile)){
			$response['profile']=$profile;
			$response['categories']=$this->getCategories($profile->userId);
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
		echo '<pre>'; print_r($response); die;
		echo json_encode($response);die;
	}
	
	function getCategories($userId) {
		$response = array();
		$categories = $this->Api_model->getCategory($userId);
		foreach($categories as $category) {
			$category->products = array();
			$products = $this->Api_model->getProductByCategoryId($category->id);
			foreach($products as $product) {
				$category->products[] = $product;
				$product_variants = $this->Api_model->getProductVariantByProductId($product->id);
				$product->product_variants = array();
				$product_variant_data = array();
				foreach($product_variants as $product_variantobj) {
					if($product_variantobj->type == 1) 
					{
					   $product_variantobj->product_variant_maps = array();
					   $variants = $this->Api_model->getProductVariantMapByParentMapId($product_variantobj->id, $product_variantobj->type);
					   
					   
					   foreach($variants as $variant) {
						   $variant->variantMap = array();
						   $variant->variantMap[] = $this->Api_model->getProductTopping($variant->id, $product_variantobj->type);
					   }
					   
					   $product_variantobj->product_variant_maps[] = $variants;
					   
					   
					   
					   $product_variant_data[] = $product_variantobj;
				   } 
				   else if($product_variantobj->type == 2) 
				   {
						$product_variantobj->product_topping_maps[] = $this->Api_model->getProductTopping($product_variantobj->id, $product_variantobj->type);
						$product_variant_data[] = $product_variantobj;
				   }
				}
				$product->product_variants[] = $product_variant_data;
			}
			
			$response[] = $category; 
		}
		
		return $response;
		/* 
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
		   $product->product_variants = $product_variant_data;
			   $response[] = $product;
	   }
	   return $response; */
	}

}