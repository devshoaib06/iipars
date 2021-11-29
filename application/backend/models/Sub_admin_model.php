<?php
class sub_admin_model extends CI_Model {

    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
    }
	
	function sub_admin_edit_details($admin_id)
	{
			//echo 'test';exit();
			$this->db->select('*');
			$this->db->from('tbl_user');
			$this->db->where('user_id', $admin_id);
			$this->db->where('user_type_id', 6);
			$query =$this->db->get();
			$resultquery=$query->result();
			//print_r($resultquery);exit();
			return $resultquery;
	}
	
	function sub_admin_edit_details_by_user_name($username)
	{
		    $this ->db-> select('*');
			$this->db->from('tbl_user');
			$this->db->where('username', $username);
			$query =$this->db->get();
			$resultquery=$query->result();
			//print_r($resultquery);
			
				return $resultquery;
			
	}
	
	function sub_admin_edit_details_by_email($admin_email)
	{
		$this->db-> select('*');
		$this->db->from('tbl_user');
		$this->db->where('login_email', $admin_email);
		$this->db->where('user_type_id', 6);
		$query =$this->db->get();
		$resultquery=$query->result();
		//print_r($resultquery);
		
			return $resultquery;
		
			
	}
	
}
?>
