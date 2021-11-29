<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class profile extends CI_Controller {
	
public function __construct()
{
	parent::__construct();
	$this->load->database();
	$this->load->library('session');
	
	$this->load->helper('url');
	$this->load->helper('form');
	$this->load->library('form_validation');
	$this->load->library('email');			
	$this->load->library('image_lib');
	// $this->load->model('login_model');	
	$this->load->model('common/common_model');	
		
}

public function profile_view()
{
	
	
	$user_id=$this->uri->segment(3);
	$user['profile']=$this->admin_model->selectOne('tbl_user','user_id',$user_id);
	$user['active']="profile";
	$this->load->view('common/header');
	$this->load->view('common/leftmenu',$user);
	$this->load->view('profile_edit',$user);
	$this->load->view('common/footer');
	
}
public function profile_update()
{
	$userid = $this->input->post('user_id');
	$fst_name = $this->input->post('f_name');
	$email=$this->input->post('email');
	$lst_name = $this->input->post('lst_name');
	$phone = $this->input->post('phone');

	$chk_phone = $this->admin_model->selectOne('tbl_user','mobile',$phone);
	if(count($chk_phone)>0)
	{
		$data_update = array(

							'first_name'=>$fst_name,
							'last_name'=>$lst_name,
							'login_email'=>$email

						);
// print_r($data_update);
		$this->db->where('user_id',$userid);
		$this->db->update('tbl_user',$data_update);
		$this->session->set_flashdata('succ_update','Phone number exist. Rest fields are updated successfully.');
	}
	else
	{
		$data_update = array(

							'first_name'=>$fst_name,
							'last_name'=>$lst_name,
							'login_email'=>$email,
							'mobile'=>$phone,

						);
// print_r($data_update);

		$this->db->where('user_id',$userid);
		$this->db->update('tbl_user',$data_update);
		$this->session->set_flashdata('succ_update','Profile Updated Successfully');
	}

	
	 redirect('profile/profile_view/'.$userid,'refresh');

}


}



