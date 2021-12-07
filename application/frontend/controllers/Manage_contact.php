<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_contact extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();
           $this->load->model('page_model');

	}
	
	public function index()
	{


			// $user_id=@$this->session->userdata('user_session_id');

		$user['contact']=$this->admin_model->selectAll('tbl_contact');
        


   //          $login_avail['user_details']=  $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    $data['active']="contact";
    $data['book_publication_page_detl']=$this->page_model->book_publication_detl_all();
		$data['writing_consultancy_page_detl']=$this->page_model->writing_consultancy_detl_all();


		$data['subjects']=$this->teachinns_home_model->subjects();
		 $this->load->view('common/header',$data);
		$this->load->view('contact_us',$user);
		$this->load->view('common/footer');
	}


	function contact_form_submit()
	{
		// echo 'hi';
		$nam= $this->input->post('nam');
		$email= $this->input->post('email');
		$subject= $this->input->post('subject');
		$phone= $this->input->post('phone');
		$form_message= $this->input->post('form_message');


		$data= array(
			  'name'=>$nam,
			  'email'=>$email,
			  'subject'=>$subject,
			  'phone'=>$phone,
			  'message'=>$form_message,
			  'created_on'=>date('Y-m-d')
		            );

		$this->db->insert('tbl_contact_form',$data);
		$this->session->set_flashdata('succ_msg','Submitted Successfully');
		redirect($this->url->link(10));
	}

	

	



	
	
	


	
}
?>