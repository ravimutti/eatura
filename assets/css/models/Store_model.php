<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Store_model extends CI_Model
{
	function check_category($userid,$name){
			$this->db->select('*');
			$this->db->from('categories');
			$this->db->where('storeid', $userid);
			$this->db->where('category', $name);
			$query = $this->db->get();
			return $query->num_rows();
		}
		function insert($data,$table){
			$this->db->trans_start();
			$this->db->insert($table, $data);
			$insert_id = $this->db->insert_id();
			$this->db->trans_complete();
			return $insert_id;
		}
		function update($id,$data,$table){
			$this->db->set($data);
			$this->db->where('id', $id);
			$this->db->update($table);
			return true;
		}
		function getCategory($userid){
			$this->db->select('*');
			$this->db->from('categories');
			$this->db->where('storeid', $userid);
			$query = $this->db->get();
			return $query->result();
		}
		function checkVariation($userid,$name){
			$this->db->select('*');
			$this->db->from('variations');
			$this->db->where('storeid', $userid);
			$this->db->where('variationname', $name);
			$query = $this->db->get();
			return $query->num_rows();
		}
		function checkTopping($userid,$name){
			$this->db->select('*');
			$this->db->from('toppings');
			$this->db->where('storeid', $userid);
			$this->db->where('toppingname', $name);
			$query = $this->db->get();
			return $query->num_rows();
		}
		function getVariations($userid){
			$this->db->select('*');
			$this->db->from('variations');
			$this->db->where('storeid', $userid);
			$query = $this->db->get();
			return $query->result();
		}
		function getToppings($userid){
			$this->db->select('*');
			$this->db->from('toppings');
			$this->db->where('storeid', $userid);
			$query = $this->db->get();
			return $query->result();
		}
		function getCategoryById($id, $userid){
			$this->db->select('*');
			$this->db->from('categories');
			$this->db->where('id', $id);
			$this->db->where('storeid', $userid);
			$query = $this->db->get();
			return $query->row();
		}
		function getRestaurant(){
			$this->db->select('*');
			$this->db->from('tbl_users');
			$this->db->where('roleId', 2);
			$query = $this->db->get();
			return $query->result();
		}
		
		function check_categoryid($id,$userid,$name){
			$this->db->select('*');
			$this->db->from('categories');
			$this->db->where('storeid', $userid);
			$this->db->where('id !=', $id);
			$this->db->where('category', $name);
			$query = $this->db->get();
			return $query->num_rows();
		}
		
		function check_product($userid,$name){
			$this->db->select('*');
			$this->db->from('products');
			$this->db->where('storeid', $userid);
			$this->db->where('name', $name);
			$query = $this->db->get();
			return $query->num_rows();
		}
}