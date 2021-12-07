<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_video extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();
           $this->load->model('page_model');

	}
	
	public function index()
	{

        //echo "Hi...."; exit;
        $data['category_list']=$this->admin_model->selectAll('tbl_video_category');
	

        $data['subjects']=$this->teachinns_home_model->subjects();
        $data['book_publication_page_detl']=$this->page_model->book_publication_detl_all();
		$data['writing_consultancy_page_detl']=$this->page_model->writing_consultancy_detl_all();
        
        // echo '<pre>';
        // print_r($data['subjects']);
        // exit;
		
		 $this->load->view('common/header',$data);
		$this->load->view('video_gallery',$data);
		$this->load->view('common/footer');
	}

	

	



	
	
	


	
}
?>