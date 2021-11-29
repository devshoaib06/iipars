<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}
	
	public function index()
	{

	 // $data['slider'] = $this->common_model->common($table_name = 'tbl_home_slider', $field = array(), $where = array('status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		// $data['active']="home";



		
		 $this->load->view('common/header');
		$this->load->view('login_page');
		$this->load->view('common/footer');
	}


	function login_action()
	{
// 		echo "okk"; exit;

		$login_email_ph= $this->input->post('email');
		$login_password= $this->input->post('password');


		$login_avail=  $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('login_email'=>$login_email_ph,'login_pass'=>$login_password,'status'=>'active','user_type_id'=>'2'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		if(count($login_avail) > 0)
		{
					 $this->session_set($login_avail);
						// echo $user_fname=@$this->session->userdata('user_fname');

					// echo "okk";
		 	// redirect($this->url->link(5), 'refresh');

			 //redirect('my_account', 'refresh');
			 redirect($this->url->link(4), 'refresh');


		}


		$this->session->set_flashdata('wrong',"Wrong Password Or Email.");
		
		 	redirect($this->url->link(2), 'refresh');
			 
		 	
	}


	public function session_set($login_avail)
	{
		 $user_id= @$login_avail[0]->user_id; 
		 $user_email= @$login_avail[0]->login_email; 
		 $user_ph= @$login_avail[0]->mobile;
		 $fname= @$login_avail[0]->first_name; 
		 $user_type= @$login_avail[0]->user_type_id;
		 
		 
		 
		 $log_session = array(					  
				   
				   'user_email'=>$user_email,
				   'user_session_id'=>$user_id,
				   'user_fname'=>$fname,
				   'user_contact'=>$user_ph,
				   // 'authorised'=>$authorised,
				   'user_type'=>$user_type,
				   // 'logged_in' => TRUE
			   						);
		 $this->session->set_userdata($log_session);
		//echo '<pre>'; print_r($this->session->all_userdata()) ; exit;
	}

	// function sign_up()
	// {
	// 	$this->load->view('common/header');
	// 	$this->load->view('sign_up_page');
	// 	$this->load->view('common/footer');
	// }

	function logout()
	{
		$this->session->unset_userdata('user_email');
		$this->session->unset_userdata('user_session_id');

		$this->session->unset_userdata('user_fname');
		$this->session->unset_userdata('user_contact');
		 	redirect($this->url->link(2), 'refresh');
        
        
	}

	
	
	


	
}
?>