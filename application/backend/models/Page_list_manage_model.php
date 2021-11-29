<?php
class page_list_manage_model extends CI_Model 
{

    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	   
    }
    
	function all_page_listing()
	{
	    $this->db->select('AR.*,PM.*,MS.menu_section_title');
		$this->db->from('app_routes AR');
		$this->db->join('tbl_page_manage PM','PM.routes_id=AR.id','left');
		$this->db->join('tbl_menu_manage MM','MM.menu_id=PM.menu_id','left');
		$this->db->join('tbl_menu_sub_section MBS','MBS.menu_sub_section_id=MM.menu_sub_section_id','left');
		$this->db->join('tbl_menu_section MS','MS.menu_section_id=MM.menu_section_id','left');
		$query=$this->db->get();
		$result=$query->result();
		//print_r($result);exit;
		return $result;
		
	}
	function all_page_listing_by_filter($active_inactive_value)
	{
		$this->db->select('AR.*,PM.*,MS.menu_section_title');
		$this->db->from('app_routes AR');
		$this->db->join('tbl_page_manage PM','PM.routes_id=AR.id','left');
		$this->db->join('tbl_menu_manage MM','MM.menu_id=PM.menu_id','left');
		$this->db->join('tbl_menu_sub_section MBS','MBS.menu_sub_section_id=MM.menu_sub_section_id','left');
		$this->db->join('tbl_menu_section MS','MS.menu_section_id=MM.menu_section_id','left');
		
		if($active_inactive_value=='active')
		{
			
			$this->db->where('AR.is_active','Y');
		}
		else
		{
			$this->db->where('AR.is_active','N');	
		}
		$query=$this->db->get();
		$result=$query->result();
		//print_r($result);exit;
		return $result;
	}
}
?>