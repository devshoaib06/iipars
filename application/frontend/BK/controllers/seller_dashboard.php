<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class seller_dashboard extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	public function index()
	{
		 
		$this->session->unset_userdata('search_sess_name');
		$this->session->unset_userdata('search_category');
		
		$seller_id=$this->session->userdata('user_session_id');
		//echo $seller_id;exit;

		$data['seller_dashboard'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$seller_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$data['total_order'] = $this->common_model->common($table_name = 'tbl_order_details', $field = array(), $where = array('product_seller_id'=>$seller_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$data['total_product'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('seller_id'=>$seller_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$data['total_feature_product'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('seller_id'=>$seller_id,'featured'=>'Yes'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');




	    $this->load->view('common/header');
		$this->load->view('seller_dashboard',$data);
		$this->load->view('common/footer');

	}

}
?>
