<?php
class book_publication_model extends CI_Model 
{

    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	   
    }
    
	function all_book_publication_listing()
	{
	    $this->db->select('*');
		$this->db->from('tbl_book_publication');
		$this->db->where_not_in('status','3');
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		$result=$query->result();
		//print_r($result);exit;
		return $result;
		
	}
	function all_book_publication_listing_by_filter($active_inactive_value)
	{
		$this->db->select('*');
		$this->db->from('tbl_book_publication');
		$this->db->where_not_in('status','3');
		
		if($active_inactive_value=='active')
		{
			
			$this->db->where('status','1');
		}
		else
		{
			$this->db->where('status','0');	
		}
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}
}
?>