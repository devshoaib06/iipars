<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_entry_level_score extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}
	
	public function index()
	{

		 $user_id=@$this->session->userdata('user_session_id');
		 if($user_id=='')
		 {
		 	$this->session->set_flashdata('wrong',"You have to login first.");
		 	redirect($this->url->link(2), 'refresh');
		 }
		 else
		 {
		 	      $data['user_details']=  $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		 }


			// $user_id=@$this->session->userdata('user_session_id');


      //       $data['package_details']=  $this->common_model->common($table_name = 'tbl_package', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

   			// $data['active']="upcoming";


		
		 // $this->load->view('common/header');
		$this->load->view('entry',$data);
		// $this->load->view('common/footer');
	}

	

	



	
	
	


	
}
?>