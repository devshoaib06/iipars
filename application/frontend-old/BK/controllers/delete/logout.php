<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class logout extends CI_Controller 
{	
	 
	 public function __construct()
     {
            parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->library('session');
		
			
	 }
	
	public function index()
	{

		//$this->session->sess_destroy();

		//echo '<pre>'; print_r($this->session->all_userdata()) ; exit;
		
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('user_email');
		$this->session->unset_userdata('user_session_id');
		$this->session->unset_userdata('user_fname');
		$this->session->unset_userdata('cart_session_id');
		//$this->session->unset_userdata('payment_type');
		//$this->session->unset_userdata('total_cart_amount');
		
		
		
		$this->session->set_flashdata('suc_msg','You are successfully logged out.');
		redirect($this->url->link(3),'redirect');
		
	}
	
	
	
	
	
	
}
?>