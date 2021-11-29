<?php
class admin_details_model extends CI_Model {

    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
			
    //START USER DETAIL
	function admin_details($id)
	{
		$this->db->select('*');
		$this->db->from('tbluser AU');
		$this->db->join('tblemail AE','AE.email_id=AU.id','left');
		$this->db->where('AU.id',$id);
		$query=$this->db->get();
		$result=$query->result();
		return $result;
	}
	
	
	
}
?>