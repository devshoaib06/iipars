<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_thesis extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}
	
	public function index()
	{


	    
        $data['manage_home']=$this->admin_model->selectAll('tbl_disertation_guideline');
          

		$data['subjects']=$this->teachinns_home_model->subjects();
		$this->load->view('common/header',$data);
		$this->load->view('thesis_consultancy_general_guide_view',$data);
		$this->load->view('common/footer');
	}

	public function apply_form()
	{


	


		
		 $this->load->view('common/header');
		$this->load->view('thesis_consultancy_online_submission_form');
		$this->load->view('common/footer');
	}



	function thesis_consul_submit()
	{
		$nam=$this->input->post('nam');
		$designation=$this->input->post('designation');
		$phone=$this->input->post('phone');
		$email=$this->input->post('email');
		$wp=$this->input->post('wp');
		$address=$this->input->post('address');
		$subject=$this->input->post('subject');
		$thesis_title=$this->input->post('thesis_title');
		$chapter1=$this->input->post('chapter1');
		$chapter2=$this->input->post('chapter2');
		$chapter3=$this->input->post('chapter3');
		$chapter4=$this->input->post('chapter4');
		$chapter5=$this->input->post('chapter5');
		$chapter6=$this->input->post('chapter6');
		$chapter7=$this->input->post('chapter7');
		

		$data= array(
			   'nam'=>$nam,
			   'designation'=>$designation,
			   'phone'=>$phone,
			   'email'=>$email,
			   'wp'=>$wp,
			   'address'=>$address,
			   'subject'=>$subject,
			   'thesis_title'=>$thesis_title,
			   'chapter1'=>$chapter1,
			   'chapter2'=>$chapter2,
			   'chapter3'=>$chapter3,
			   'chapter4'=>$chapter4,
			   'chapter5'=>$chapter5,
			   'chapter6'=>$chapter6,
			   'chapter7'=>$chapter7,
			   'created_on'=>date('Y-m-d')
		             );

		$this->db->insert('tbl_thesis_cons_form',$data);
		$this->session->set_flashdata('succ_msg','Submitted Successfully');
		redirect('manage_thesis/apply_form','refresh');


		
		
		

	}

	

	



	
	
	


	
}
?>