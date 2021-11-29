<?php
class permission extends CI_Model {

    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
			
    
	
	 //START USER DETAIL
	function page($id)
	{
		 $admin_details=$this->session_check_and_session_data->admin_session_data();
		 $user_id=$admin_details[0]->id;
		 $role_id=$admin_details[0]->user_type_id;
		// echo   $role_id;exit;
		 
		 if($role_id==2 || $role_id==3 || $role_id==4 || $role_id==5 || $role_id==6)
		 { 
		 	
			$parent_page_id=$id;
		 
		
		 
			$this->db->select('*');
			$this->db->from('tbl_admin_user_page_permission');
			$this->db->where('admin_user_id',$user_id);
			$this->db->where('page_id',$parent_page_id);
			$query =$this->db->get();
			$result=$query->result();
			@$is_view=$result[0]->is_view;
			
			
			return $is_view;
			
		 }
		 else  if($role_id==1)
		 {
		 	return $is_view='Y';
		 }
		 
			
	}
	
	
	
	
	
	
	
	
	
	 //START USER DETAIL
	function is_allow($id)
	{
		 $admin_details=$this->session_check_and_session_data->admin_session_data();
		 $user_id=@$admin_details[0]->id;
		 $role_id=@$admin_details[0]->user_type_id;
		// echo   $role_id;exit;
		 
		 if($role_id==2 || $role_id==3 || $role_id==4 || $role_id==5 || $role_id==6)
		 { 
			
		 
			$this->db->select('*');
			$this->db->from('tbl_admin_user_page_permission');
			$this->db->where('admin_user_id',$user_id);
			$this->db->where('page_id',$id);
			$query =$this->db->get();
			$result=$query->result();
			@$is_view=$result[0]->is_view;
			//echo $is_view;
			if($is_view=='N' || $is_view!='Y')
			{
				redirect('index.php/no_permission');
			}
			
		 }
		 
			
	}
	 
}
?>