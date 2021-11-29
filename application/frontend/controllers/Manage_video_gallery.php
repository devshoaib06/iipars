<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_video_gallery extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}
	
	public function index()
	{


			// $user_id=@$this->session->userdata('user_session_id');


   $data['video_gallery_category']=  $this->common_model->common($table_name = 'tbl_video_category', $field = array(), $where = array('status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


   $data['video_gallery']=  $this->common_model->common($table_name = 'tbl_video_gallery', $field = array(), $where = array('status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


   $data['active']="video";


		
		 $this->load->view('common/header',$data);
		$this->load->view('video_gallery_page',$data);
		$this->load->view('common/footer');
	}

	

	



	
	
	


	
}
?>