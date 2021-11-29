<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class faq extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	public function index()
	{
	     $data['faq']=$this->common_model->common($table_name = 'tbl_faq', $field = array(), $where = array('faq_status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
	    $this->load->view('common/header');
		$this->load->view('faq',$data);
		$this->load->view('common/footer');

	}

}
?>