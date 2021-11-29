<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class terms_of_use extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	public function index()
	{
		$data['terms_of_use']=$this->common_model->common($table_name = 'tbl_page_manage', $field = array(), $where = array('routes_id'=>23), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
	    $this->load->view('common/header');
		$this->load->view('terms_of_use',$data);
		$this->load->view('common/footer');

	}

}
?>