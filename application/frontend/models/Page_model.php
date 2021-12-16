<?php
class page_model extends CI_Model 
{

    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	   
    }
    
    function page_detl($slug){
        $this->db->select('tpm.*');
		$this->db->from('app_routes as ar');
		$this->db->join('tbl_page_manage tpm', 'ar.id= tpm.routes_id','left');
		$this->db->where('ar.controller',$slug);
		$this->db->where('ar.is_active','Y');
		
		$query=$this->db->get();
		//echo $this->db->last_query(); exit;
		$result=$query->row();
		return $result;
    }
    
	
	function book_publication_detl($slug)
	{
		$this->db->select('*');
		$this->db->from('tbl_book_publication');
		$this->db->where('slug',$slug);
		$this->db->where('status','1');
		
		$query=$this->db->get();
		$result=$query->row();
		return $result;
	}
	
	function book_publication_detl_all()
	{
		$this->db->select('*');
		$this->db->from('tbl_book_publication');
		$this->db->where('status','1');

		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}

	function writing_consultancy_detl($slug)
	{
		$this->db->select('*');
		$this->db->from('tbl_writing_consultancy');
		$this->db->where('slug',$slug);
		$this->db->where('status','1');
		
		$query=$this->db->get();
		$result=$query->row();
		return $result;
	}
	
	
	function writing_consultancy_detl_all()
	{
		$this->db->select('*');
		$this->db->from('tbl_writing_consultancy');
		//$this->db->where('slug',$slug);
		$this->db->where('status','1');
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}
	
	
	function acadamic($tbl,$seg3){
	   

        $this->db->select();
        $this->db->from($tbl);
        $this->db->where('find_in_set("'.$seg3.'", subject_list_ids)');
        $query = $this->db->get();
        
        return $query->result();
	}
	
	function ugc($seg3){
	    $this->db->select();
        $this->db->from('tbl_ugc_video');
        $this->db->where('find_in_set("'.$seg3.'", subject_list_ids)');
        $query = $this->db->get();
        
        return $query->result();
	    
	}
	
	function ugc_other($seg3){
	    $this->db->select();
        $this->db->from('tbl_ugc_net_other');
        $this->db->where('find_in_set("'.$seg3.'", subject_list_ids)');
        $query = $this->db->get();
        
        return $query->result();
	    
	}
	
	function ugc_other_detl($seg3){
	    $this->db->select();
        $this->db->from('tbl_ugc_net_other');
        $this->db->where('slug',$seg3);
        $query = $this->db->get();
        
        return $query->result();
	    
	}
}
?>