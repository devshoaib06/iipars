<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function index()
    {
        if ($this->session->userdata('hs_admin_id')!="")
        {
            redirect(base_url().'index.php/admin_dashboard');
        }
        $this->load->view('common/login');
    }
    function login_submit()
    {
        $username=trim($this->input->post('username'));
        $password=trim($this->input->post('password'));
        //$pass=md5($password);
        
        $login_detail=$this->admin_model->check_login($username,$password);

         //$login_detail_subadmin=$this->admin_model->check_login_subadmin($username,$password);
        if(count($login_detail))
        {

            /*if(@$login_detail[0]->user_type_id==3)
            {
                $this->session->set_flashdata('message', 'invalid user-name/password..!');
                redirect(base_url().'index.php/admin_login');
            }*/

            if(@$login_detail[0]->user_type_id==6)
            {
                 $newData=array(
                'hs_admin_id'=>$login_detail[0]->user_id,
                'hs_admin_name'=>$login_detail[0]->first_name,
                     );

                 $this->session->set_userdata($newData);
            redirect(base_url().'index.php/admin_dashboard');
            }

            else
            {

                $newData=array(
                'hs_admin_id'=>$login_detail[0]->user_id,
                'hs_admin_name'=>$login_detail[0]->first_name,
            );
            $this->session->set_userdata($newData);
            redirect(base_url().'index.php/admin_dashboard');

            }
            
        }
     
        else
        {
            $this->session->set_flashdata('message', 'invalid user-name/password..!');
            redirect(base_url().'index.php/admin_login');
        }
        
    }
    function logout()
    {
        //session_destroy();
        $this->session->unset_userdata('hs_admin_id');
        $this->session->unset_userdata('hs_admin_name');

        $this->session->set_flashdata('message','Successfully Logout !');
        redirect(base_url().'index.php/admin_login');
    }

function email_sent()
    {
        $data=array(
            'recieve_email'=>$this->input->post('receive_email'),
            'from_email'=>$this->input->post('from_email')
            );

        $this->admin_model->update_data($data,'tbl_email','email_id','1');
    }
}
?>
