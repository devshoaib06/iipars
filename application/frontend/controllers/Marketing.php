<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Marketing extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}
	
	public function index()
	{


			

		$data['manage_home'] = $this->common_model->common($table_name = 'tbl_manage_home', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		
		 $this->load->view('common/header');
		$this->load->view('marketing_page',$data);
		$this->load->view('common/footer');
	}



	function privacy_policy()
	{

		$data['privacy_policy'] = $this->common_model->common($table_name = 'tbl_page_manage', $field = array(), $where = array('routes_id'=>16), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		$this->load->view('common/header');
		$this->load->view('privacy_policy',$data);
		$this->load->view('common/footer');
	}

	function terms_cond()
	{

		$data['terms_cond'] = $this->common_model->common($table_name = 'tbl_page_manage', $field = array(), $where = array('routes_id'=>17), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		$this->load->view('common/header');
		$this->load->view('terms_cond',$data);
		$this->load->view('common/footer');
	}

	

	



	
	
	


	
}
?>