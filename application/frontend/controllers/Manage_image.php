<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_image extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}
	
	public function index()
	{


	

        // $data['image_gallery_list']=$this->admin_model->selectAll('tbl_image_gallery');
        $data['category_list']=$this->admin_model->selectAll('tbl_video_category');



		
		 $this->load->view('common/header');
		$this->load->view('image_gallery',$data);
		$this->load->view('common/footer');
	}

	

	



	
	
	


	
}
?>