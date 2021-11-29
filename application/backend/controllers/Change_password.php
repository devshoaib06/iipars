<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class change_password extends CI_Controller {
	
public function __construct()
{
	parent::__construct();
	$this->load->database();
	$this->load->library('session');
	$this->load->library('encrypt');
	$this->load->helper('url');
	$this->load->helper('form');
	$this->load->library('form_validation');
	$this->load->library('email');			
	$this->load->library('image_lib');
	$this->load->model('login_model');	
		
}

public function password_edit()
{
	
	

	
	$this->load->view('template/admin_header');
	$this->load->view('template/admin_leftmenu');
	$this->load->view('password_change');
	$this->load->view('template/admin_footer');
	//redirect('profile/profile_show');

	//$this->load->view('profile_edit',$user);
	
}
/*public function profile_update()
{
	$userid=$this->input->post('userid');
	$username=$this->input->post('username');
	$email=$this->input->post('email');
	$fullname=$this->input->post('fullname');
	$data_update=array('user_full_name'=>$fullname,'username'=>$username,'email'=>$email);
	$this->db->where('id',$userid);
	$this->db->update('tbluser',$data_update);
	redirect('index.php/profile/profile_view/'.$userid,'refresh');

}*/
public function password_updated()
{
	if($this->session->userdata('session_user_id'))
       {
            $user_id= $this->session->userdata('session_user_id');
        }
        $oldp=$this->input->post('oldpasswd');
        $newp=$this->input->post('newpasswd');
        $confp=$this->input->post('conpasswd');
        $data=$this->admin_model->selectOne('tbl_admin','id',$user_id);
        $getpwd=$data[0]->password;
       
        if($oldp==$getpwd && $newp==$confp)
        {
        	$data=array('password'=>$newp);
        	$this->db->where('id',$user_id);
        	$this->db->update('tbl_admin',$data);
        	$this->session->set_flashdata('succ_msg','Password has been changed successfully');
        	redirect('index.php/change_password/password_edit/','refresh');
        }
        else
        {
        	$this->session->set_flashdata('err_msg','Sorry!! Please provide correct data');
        	
        	redirect('index.php/change_password/password_edit/','refresh');
        }
}


}



