<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_ebook extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}
	
	public function index()
	{


	


		
		 $this->load->view('common/header');
		$this->load->view('invitation_for_ebook_view');
		$this->load->view('common/footer');
	}

	function invite_for_ebook_submit()
	{

		// echo 'hi';
    	$nam=$this->input->post('nam');
        $designation=$this->input->post('designation');
        $phone=$this->input->post('phone');
        $email=$this->input->post('email');
        $wp=$this->input->post('wp');
        $address=$this->input->post('address');
    	$subject=$this->input->post('subject');
    	$book_title=$this->input->post('book_title');  
    	$short_description=$this->input->post('short_description');

    


    	$data= array(
    		     'nam'=>$nam,
    		     'email'=>$email,
    		     'phone'=>$phone,
    		     'wp'=>$wp,
    		     'subject'=>$subject,
                 'designation'=>$designation,
                 'address'=>$address,
                 'book_title'=>$book_title,
    		     'short_description'=>$short_description,
    		     'created_on'=>date('Y-m-d')
    	             );


    	$this->db->insert('tbl_invite_for_ebook',$data);
    	$this->session->set_flashdata('succ_msg','Submitted successfully');
    	redirect('Manage_ebook','refresh');


    	
		
	}

	public function purchase_your_ebook()
	{


		$data['ebook_list']=$this->admin_model->selectAll('tbl_ebook');
	    


		
		 $this->load->view('common/header');
		$this->load->view('purchase_your_ebook_view',$data);
		$this->load->view('common/footer');
	}

	public function book_list()
	{


		$data['ebook_list']=$this->admin_model->selectAll('tbl_ebook');
	    


		
		 $this->load->view('common/header');
		$this->load->view('our_ebook_view',$data);
		$this->load->view('common/footer');
	}

	function buy_now()
	{
		// echo 'hi';



		 $user_id=@$this->session->userdata('user_session_id');
		 if($user_id=='')
		 {
		 	$this->session->set_flashdata('wrong',"You have to login first.");
		 	redirect($this->url->link(2), 'refresh');
		 }


		$ebook_id= $this->uri->segment(3);

		// print_r($ebook_id); exit;

		$data=array(
			     'ebook_id'=>$ebook_id,
			     'user_id'=>$user_id,
			     'purchase_date'=>date('Y-m-d'),
		            );

              $this->db->insert('tbl_ebook_purchase',$data);
              $this->session->set_flashdata('succ_msg','You have successfully purchased E-book');
              redirect('manage_ebook/purchase_your_ebook_success');



	}

	function purchase_your_ebook_success()
	{
		$this->load->view('common/header');
		$this->load->view('purchase_your_ebook_success');
		$this->load->view('common/footer');
	}

	

	



	
	
	


	
}
?>