<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model
{
	function getProfile($slug)
	{
		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->where("slugname", $slug);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

	function getCategory($id)
	{
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where("storeid", $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getProductByStoreId($id)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where("storeid", $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getProductByCategoryId($id)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where("category_id", $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getProductBySlug($slug)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where("slugname", $slug);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

	public function getProductVariantByProductId($productid)
	{
		$this->db->select('*');
		$this->db->from('product_variants');
		$this->db->where("product_id", $productid);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getProductVariantMapByParentMapId($productvarid)
	{
		$this->db->select('*');
		$this->db->from('product_variant_maps');
		$this->db->where("product_variant_id", $productvarid);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getProductTopping($product_variant_map_id, $type)
	{
		$this->db->select('*');
		$this->db->from('product_topping_maps');
		$this->db->where("product_variant_map_id", $product_variant_map_id);
		$this->db->where("type", $type);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getToppingById($id)
	{
		$this->db->select('*');
		$this->db->from('toppings');
		$this->db->where("id", $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function getVariationById($id)
	{
		$this->db->select('*');
		$this->db->from('variations');
		$this->db->where("id", $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function getProductVariantNametMapId($productvarid)
	{
		$this->db->select('product_variant_maps.*, variations.variationname as name');
		$this->db->from('product_variant_maps');
		$this->db->where("product_variant_id", $productvarid);
		$this->db->join('variations', 'variations.id = product_variant_maps.variation_id');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getProductToppingName($product_variant_map_id, $type)
	{
		$this->db->select('product_topping_maps.*, toppings.toppingname as name');
		$this->db->from('product_topping_maps');
		$this->db->where("product_variant_map_id", $product_variant_map_id);
		$this->db->join('toppings', 'toppings.id = product_topping_maps.topping_id');
		$this->db->where("type", $type);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getProductVariantMapsById($id)
	{
		$this->db->select('*');
		$this->db->from('product_variant_maps');
		$this->db->where("id", $id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

	public function getProductToppingMapsById($id)
	{
		$this->db->select('*');
		$this->db->from('product_topping_maps');
		$this->db->where("id", $id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
}
