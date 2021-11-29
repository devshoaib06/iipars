<?php
class user_page_permission_model extends CI_Model {

    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
			
    
	
	 //START USER DETAIL
	function user_page_permission_by_id($controller_name)
	{
		 $admin_details=$this->session_check_and_session_data->admin_session_data();
		 $user_id=$admin_details[0]->id;
		 $role_id=$admin_details[0]->role_id;
		// echo   $role_id;exit;
		 
		 if($role_id==2)
		 { 
		 	$this->db->select('*');
			$this->db->from('tbl_admin_parent_page');
			$this->db->where('controller',$controller_name);
			$query =$this->db->get();
			$result=$query->result();
			$parent_page_id=$result[0]->parent_page_id;
		 
			$this->db->select('*');
			$this->db->from('tbl_admin_user_page_permission');
			$this->db->where('admin_user_id',$user_id);
			$this->db->where('page_id',$parent_page_id);
			$query =$this->db->get();
			$result=$query->result();
			@$is_view=$result[0]->is_view;
			//echo $is_view;
			if($is_view=='N')
			{
				redirect('index.php/no_permission');
			}
			
		 }
		 
			
	}
	 
}
?>