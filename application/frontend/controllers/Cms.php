<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class cms extends CI_Controller 
{	 
	 public function __construct()
     {
            parent::__construct();
			$this->load->database();
			$this->load->model('page_model');
	 }

	
	
	function page()
	{
	    $data = array();
		$slug=$this->uri->segment(3);
		//echo $slug; exit; 
		if(!empty($slug)){
			$data['page_detl']=$this->page_model->page_detl($slug);
            // echo '<pre>';
            // print_r($data['page_detl']);
            // exit;
		}
		$data['book_publication_page_detl']=$this->page_model->book_publication_detl_all();
		$data['writing_consultancy_page_detl']=$this->page_model->writing_consultancy_detl_all();
		$data['subjects']=$this->teachinns_home_model->subjects();	

		$this->load->view('common/header',$data);
		$this->load->view('page_cms',$data);
		//$this->load->view('our_services',$data);
		$this->load->view('common/footer_page');
		
	}
	function book_publication()
	{	
		$data = array();
		$slug=$this->uri->segment(3);
		if(!empty($slug)){
			$data['page_detl']=$this->page_model->book_publication_detl($slug);
		}
		$data['subjects']=$this->teachinns_home_model->subjects();	
        $data['book_publication_page_detl']=$this->page_model->book_publication_detl_all();
		$data['writing_consultancy_page_detl']=$this->page_model->writing_consultancy_detl_all();
        
		$this->load->view('common/header',$data);
		$this->load->view('page',$data);
		//$this->load->view('our_services',$data);
		$this->load->view('common/footer_page');

		
	}
	
	function book_publication_all()
	{	
		$data = array();
		$data['book_publication_page_detl']=$this->page_model->book_publication_detl_all();
		$data['writing_consultancy_page_detl']=$this->page_model->writing_consultancy_detl_all();
		$data['subjects']=$this->teachinns_home_model->subjects();
		$data['head'] = "All book publication";
		$this->load->view('common/header',$data);
		$this->load->view('page_all',$data);
		//$this->load->view('our_services',$data);
		$this->load->view('common/footer_page');

		
	}

	function writing_consultancy()
	{
		$data = array();
		$slug=$this->uri->segment(3);
		if(!empty($slug)){
			$data['page_detl']=$this->page_model->writing_consultancy_detl($slug);
		}
        $data['subjects']=$this->teachinns_home_model->subjects();	
        $data['book_publication_page_detl']=$this->page_model->book_publication_detl_all();
		$data['writing_consultancy_page_detl']=$this->page_model->writing_consultancy_detl_all();
		
		$this->load->view('common/header',$data);
		$this->load->view('page',$data);
		//$this->load->view('our_services',$data);
		$this->load->view('common/footer_page');
	}
	
	function writing_consultancy_all()
	{
		$data = array();
		$data['page_detl']=$this->page_model->writing_consultancy_detl_all();
		$data['subjects']=$this->teachinns_home_model->subjects();
		$data['book_publication_page_detl']=$this->page_model->book_publication_detl_all();
		$data['writing_consultancy_page_detl']=$this->page_model->writing_consultancy_detl_all();
		
		$data['head'] = "All writing consultancy";
		$this->load->view('common/header',$data);
		$this->load->view('page_all',$data);
		//$this->load->view('our_services',$data);
		$this->load->view('common/footer_page');
	}

}