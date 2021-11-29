<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class My_account extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}
	
	public function index()
	{

            $user_id=@$this->session->userdata('user_session_id');


            $login_avail['user_details']=  $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	 // $data['slider'] = $this->common_model->common($table_name = 'tbl_home_slider', $field = array(), $where = array('status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$login_avail['active']="my_account";



		
		 $this->load->view('common/header');
		$this->load->view('my_account_page',$login_avail);
		$this->load->view('common/footer');
	}

	function view_profile()
	{

		$user_id=@$this->session->userdata('user_session_id');


            $login_avail['user_details']=  $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

            $login_avail['active']="profile";

		$this->load->view('common/header');
		$this->load->view('profile_page',$login_avail);
		$this->load->view('common/footer');
	}

	function update_profile()
	{
		// echo "okk";
		$user_id=@$this->session->userdata('user_session_id');


		$f_name= $this->input->post('f_name');
		$l_name= $this->input->post('l_name');
		$email= $this->input->post('email');
		$ph_no= $this->input->post('ph_no');
		$address= $this->input->post('address');

		$update_data=array(
							'first_name'=>$f_name,
							'last_name'=>$l_name,
							'login_email'=>$email,
							'mobile'=>$ph_no,
							'address'=>$address
						);

		$this->db->where('user_id',$user_id);
		$this->db->update('tbl_user',$update_data);

		$this->session->set_flashdata('suss_msg',"You have successfully updated all your information.");

			// redirect('my_account/view_profile', 'refresh');
		redirect($this->url->link(5), 'refresh');



	}


	function reset_password()
	{
		$user_id=@$this->session->userdata('user_session_id');


            $login_avail['user_details']=  $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

            $login_avail['active']="reset_psw";


            $this->load->view('common/header');
			$this->load->view('reset_password',$login_avail);
			$this->load->view('common/footer');
	}

	function update_password()
	{
		$reset_password= $this->input->post('reset_password');

		$reset_data=array('login_pass'=>$reset_password);
		$user_id=@$this->session->userdata('user_session_id');

		$this->db->where('user_id',$user_id);
		$this->db->update('tbl_user',$reset_data);

		$this->session->set_flashdata('suss_msg',"You have successfully updated password.");

		redirect($this->url->link(7), 'refresh');
			

	}


	
	
	


	
}
?>