<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class terms extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	public function index()
	{
		$data['terms']=$this->common_model->common($table_name = 'tbl_page_manage', $field = array(), $where = array('routes_id'=>10), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
	    $this->load->view('common/header');
		$this->load->view('terms&condition',$data);
		$this->load->view('common/footer');

	}

}
?>