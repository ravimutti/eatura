<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model
{
    
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function createProduct($data)
    {
        $this->db->trans_start();
        $this->db->insert('products', $data);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
	
	function handleProductVariant($userId, $productId, $label, $variations, $price)
	{
		foreach($label as $key => $variation) 
		{
			if($key == 1)
			{
				foreach($variation as $lavelMap => $data) 
				{
					if(!empty($data))
					{
						$insertId = $this->createProductVariant(array('user_id' => $userId, 'product_id' => $productId, 'type' => $key, 'label' => $data));
						if(isset($variations[$key][$lavelMap]))
						{
							foreach($variations[$key][$lavelMap] as $priceMap => $varientPrice)
							{ 
								if($varientPrice > 0)
								{
									$vinsertId = $this->createProductVariantMap(array('product_variant_id' => $insertId, 'variation_id' => $priceMap, 'price' => $varientPrice));
									if(isset($price[$key][$lavelMap][$priceMap]))
									{
										foreach($price[$key][$lavelMap][$priceMap] as $topping_id => $toppingPrice) { 
											if($toppingPrice > 0)
											{
												$this->createProductTopping(array('product_variant_map_id' => $vinsertId, 'topping_id' => $topping_id, 'price' => $toppingPrice, 'type' => $key));
											}
										}
									}
								}
							}
						}
					}
				}
			} 
			else if($key == 2)
			{
				foreach($variation as $lavelMap => $data) 
				{
					if(!empty($data))
					{
						$insertId = $this->createProductVariant(array('user_id' => $userId, 'product_id' => $productId, 'type' => $key, 'label' => $data));
						if(isset($variations[$key][$lavelMap]))
						{
							foreach($variations[$key][$lavelMap] as $topping_id => $toppingPrice) { 
								if($toppingPrice > 0)
								{
									$this->createProductTopping(array('product_variant_map_id' => $insertId, 'topping_id' => $topping_id, 'price' => $toppingPrice, 'type' => $key));
								}
							}
						}
					}
				}
			}
			
		}
	}
	
	function createProductTopping($data)
	{
		$this->db->insert('product_topping_maps', $data);
        
        return $this->db->insert_id();
	}
	
	function getProductVariantByProductId($productid, $userId = null)
	{
		$this->db->select('*');
		$this->db->from('product_variants');
		$this->db->where('product_id', $productid);
		/* if($userId != null) {
			$this->db->where('user_id', $userId);
		} */
		return $this->db->get()->result();
	}
	
	function createProductVariant($data)
	{
		$this->db->insert('product_variants', $data);
        
        return $this->db->insert_id();
	}
	
	function createProductVariantMap($data)
	{
		$this->db->insert('product_variant_maps', $data);
        
        return $this->db->insert_id();
	}
	
	function products($userid = null){
		$this->db->select('*');
		$this->db->from('products');
		if($userid != null) {
			$this->db->where('storeid', $userid);
		}
		return $this->db->get()->result();
	}
	
    function getProductById($id, $userid = null){
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('id', $id);
		if($userid != null) {
			$this->db->where('storeid', $userid);
		}
		$query = $this->db->get();
		return $query->row();
	}
	
	public function getProductVariantMapByParentMapId($productvarid) {
		$this->db->select('*');
		$this->db->from('product_variant_maps');
		$this->db->where("product_variant_id",$productvarid);
		$query = $this->db->get();
		$result = $query->result();        
		return $result;
	}
	
	public function getProductTopping($product_variant_map_id, $type) {
		$this->db->select('*');
		$this->db->from('product_topping_maps');
		$this->db->where("product_variant_map_id",$product_variant_map_id);
		$this->db->where("type",$type);
		$query = $this->db->get();
		$result = $query->result();        
		return $result;
	}
	
	function getToppingById($toppingId){
		$this->db->select('*');
		$this->db->from('toppings');
		$this->db->where('id', $toppingId);
		return $this->db->get()->row();
	}
}

  