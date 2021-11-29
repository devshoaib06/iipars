<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('customer_model');
        $this->load->model('product_model');
        if ($this->session->userdata('hs_admin_id')=="")
        {
            redirect(base_url().'index.php/admin_login');
        }
    }
    function index()
    {
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu');
        $this->load->view('common/dashboard');
        $this->load->view('common/footer');
    }
}
?>
