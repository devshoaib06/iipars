<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_upcomming_course extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}
	
	public function index()
	{


			// $user_id=@$this->session->userdata('user_session_id');


   //          $login_avail['user_details']=  $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

   $data['active']="upcoming";


		
		 $this->load->view('common/header',$data);
		$this->load->view('upcomming_event');
		$this->load->view('common/footer');
	}

	

	



	
	
	


	
}
?>