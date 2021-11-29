<?php
class page_model extends CI_Model 
{

    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	   
    }
    
	function all_main_menu_section_list()
	{
	    $this->db->select('*');
		$this->db->from('tbl_menu_section');	
		$query=$this->db->get();
		$result=$query->result();
		//print_r($result);exit;
		return $result;
		
	}
	
	function all_sub_menu_section_list($menu_section_id)
	{
	    $this->db->select('*');
		$this->db->from('tbl_menu_sub_section');	
		$this->db->where('menu_section_id',$menu_section_id);
		$query=$this->db->get();
		$result=$query->result();
		//print_r($result);exit;
		return $result;
		
	}
	
	
	function page_title_available_check($page_title)
	{
	    $this->db->select('*');
		$this->db->from('tbl_page_manage');	
		$this->db->where('page_title',$page_title);
		$query=$this->db->get();
		$result=$query->result();
		//print_r($result);exit;
		return $result;
		
	}
	
	
	
	function page_details_by_id($routes_id)
	{
		$this->db->select('AR.*,PM.*,MM.*,MS.menu_section_title');
		$this->db->from('app_routes AR');
		$this->db->join('tbl_page_manage PM','PM.routes_id=AR.id','left');
		$this->db->join('tbl_menu_manage MM','MM.menu_id=PM.menu_id','left');
		$this->db->join('tbl_menu_sub_section MBS','MBS.menu_sub_section_id=MM.menu_sub_section_id','left');
		$this->db->join('tbl_menu_section MS','MS.menu_section_id=MM.menu_section_id','left');
	    $this->db->where('AR.id',$routes_id);
		$query=$this->db->get();
		$result=$query->result();
		//print_r($result);exit;
		return $result;
	}
	
}
?>