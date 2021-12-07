<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class privacy extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	public function index()
	{
		 $data['privacy']=$this->common_model->common($table_name = 'tbl_page_manage', $field = array(), $where = array('routes_id'=>31), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
	    $this->load->view('common/header');
		$this->load->view('privacy',$data);
		$this->load->view('common/footer');

	}

}
?>