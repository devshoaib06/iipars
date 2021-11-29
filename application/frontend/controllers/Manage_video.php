<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_video extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}
	
	public function index()
	{


        $data['category_list']=$this->admin_model->selectAll('tbl_video_category');
	


		
		 $this->load->view('common/header');
		$this->load->view('video_gallery',$data);
		$this->load->view('common/footer');
	}

	

	



	
	
	


	
}
?>