<?php

/**
* 
*/
class searchmodel extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function searchq($k)
	{
		$this->db->select('*');
		$this->db->like('product_name',$k)->limit('10');
		$query=$this->db->get("tbl_product");
		$result=$query->result();
				if(count($result))
		{
		return $result;
		}
		else
		{
		return FALSE;
		}

	}




	function product_search($category,$product_name,$page,$per_page)
	{
		

		$this->db->select('*');
		$this->db->from('tbl_product');				
		$this->db->like('product_name',$product_name);
		//$this->db->where('cat_id',$category);
		$this->db->where('status ','Active');
		
		$this->db->limit($per_page,$page);
		
		$query=$this->db->get();
		return $query->result();
	}



}

?>