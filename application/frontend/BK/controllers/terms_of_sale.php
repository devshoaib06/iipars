<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class terms_of_sale extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	public function index()
	{
		$data['terms_of_sale']=$this->common_model->common($table_name = 'tbl_page_manage', $field = array(), $where = array('routes_id'=>30), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
	    $this->load->view('common/header');
		$this->load->view('terms_of_sale',$data);
		$this->load->view('common/footer');

	}

}
?>