<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Api_model extends CI_Model
{
	function getProfile($slug)
    { 
		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->where("slugname",$slug);
		$query = $this->db->get();
		$result = $query->row();        
		return $result;
	}
	function getCategory($id)
    { 
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where("storeid",$id);
		$query = $this->db->get();
		$result = $query->result();        
		return $result;
	}
	public function getProductByStoreId($id) {
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where("storeid",$id);
		$query = $this->db->get();
		$result = $query->result();        
		return $result;
	}
	public function getProductBySlug($slug) {
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where("slugname",$slug);
		$query = $this->db->get();
		$result = $query->row();        
		return $result;
	}
	public function getProductVariantByProductId($productid) {
		$this->db->select('*');
		$this->db->from('product_variants');
		$this->db->where("product_id",$productid);
		$query = $this->db->get();
		$result = $query->result();        
		return $result;
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
}