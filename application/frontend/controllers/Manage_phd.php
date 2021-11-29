<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_phd extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}
	
	public function index()
	{


        $data['manage_home']=$this->admin_model->selectAll('tbl_phd_thesis_guideline');
	   


		
		 $this->load->view('common/header');
		$this->load->view('phd_thesis_writing_consult',$data);
		$this->load->view('common/footer');
	}

	public function apply_form()
	{


	


		
		 $this->load->view('common/header');
		$this->load->view('phd_online_submission_form_view');
		$this->load->view('common/footer');
	}




		function phd_thesis_submit()
	{

		// echo 'hi';
    	$nam=$this->input->post('nam');
        $designation=$this->input->post('designation');
        $phone=$this->input->post('phone');
        $email=$this->input->post('email');
        $wp=$this->input->post('wp');
        $address=$this->input->post('address');
    	$subject=$this->input->post('subject');
    	$thesis_title=$this->input->post('thesis_title');  
    	$short_description=$this->input->post('short_description');

    


    	$data= array(
    		     'nam'=>$nam,
    		     'email'=>$email,
    		     'phone'=>$phone,
    		     'wp'=>$wp,
    		     'subject'=>$subject,
                 'designation'=>$designation,
                 'address'=>$address,
                 'thesis_title'=>$thesis_title,
    		     'short_description'=>$short_description,
    		     'created_on'=>date('Y-m-d')
    	             );


    	$this->db->insert('tbl_phd_thesis_form',$data);
    	$this->session->set_flashdata('succ_msg','Submitted successfully');
    	redirect('manage_phd/apply_form','refresh');


    	
		
	}

	

	



	
	
	


	
}
?>