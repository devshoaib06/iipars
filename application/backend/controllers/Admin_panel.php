<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_panel extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('upload');
        $this->load->library('session');
        $this->load->model('admin_model');
        $this->load->model('common');
    }

    function index()
    {
        if ($this->session->userdata('hs_admin_id') == "")
        {
            redirect(base_url() . 'index.php/admin_login');
        }
    }
    
    

    function password()
    {
        if ($this->session->userdata('hs_admin_id') == "")
        {
            redirect(base_url() . 'index.php/admin_login');
        }
        $id=$this->session->userdata('hs_admin_id');
        $data['prof_name']=$this->admin_model->selectOne('tbl_user','user_id',$id);

        $data['active']='password';
        $this->load->view('common/header',$data);
        $this->load->view('common/leftmenu',$data);
        // $this->load->view('password/view_password');
        $this->load->view('password/password_change');
        $this->load->view('common/footer');
    }

    function get_old_password()
    {
        if ($this->session->userdata('hs_admin_id') == "")
        {
            redirect(base_url() . 'index.php/admin_login');
        }
        $admin_id = $this->session->userdata('hs_admin_id');
        $old_pass=$this->input->post('id');
        $old_pass_md=$old_pass;
        //$data=$this->admin_model->selectOne('tbl_user','login_pass',$old_pass_md);
        
        $data = $this->common->select($table_name='tbl_user',$field=array(),$where=array('login_pass'=>$old_pass_md, 'user_id'=>$admin_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_sort=array());


        if(count($data)==0)
        {
            $status='N';
        }
        echo json_encode(array('msg'=>$status));

    }

    function password_submit()
    {
        if ($this->session->userdata('hs_admin_id') == "")
        {
            redirect(base_url() . 'index.php/admin_login');
        }
        $id=$this->session->userdata('hs_admin_id');
        $new_pass=$this->input->post('new_password');
        $new_pass_md=$new_pass;

        $data=array(
            'login_pass'=>$new_pass_md
        );
        $this->admin_model->update_data($data,'tbl_user','user_id',$id);
        redirect('admin_panel/password');
    }
    
}
?>