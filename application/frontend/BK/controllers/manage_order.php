<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class manage_order extends CI_Controller 
{	
	 
	 public function __construct()
     {
          parent::__construct();

	 }
	
	public function index()
	{
		$this->session->unset_userdata('search_sess_name');
		$this->session->unset_userdata('search_category');
		
	 	$user_id = $this->session->userdata('user_session_id');	
     	$data['order_list'] = $this->common_model->common($table_name = 'tbl_order', $field = array(), $where = array('order_customer_id'=>$user_id,'buyer_view'=>'Y'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
     	$data['user_details'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
     	//echo $user_id; exit;
     	//echo '<pre>'; print_r($data['order_list']); exit;
		$this->load->view('common/header');
		$this->load->view('my_order_list',$data);
		$this->load->view('common/footer');

	}

	public function order_details()
	{
	
	 	$order_id = $this->uri->segment(2);	
	 	$data['order_list'] = $this->common_model->common($table_name = 'tbl_order', $field = array(), $where = array('order_id'=>$order_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
     	$data['order_details'] = $this->common_model->common($table_name = 'tbl_order_details', $field = array(), $where = array('order_id'=>$order_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
     	$user_id = $this->session->userdata('user_session_id');	
     	$data['user_details'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		$data['delivery_address'] = $this->common_model->common($table_name = 'tbl_delivery_address', $field = array(), $where = array('deli_user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		
		$this->load->view('common/header');
		$this->load->view('my_order_details',$data);
		$this->load->view('common/footer');
	}

	public function order_cancel()
	{
		$order_id = $this->input->post('order_id');

		$data = array('order_status'=>'Canceled');

		$this->db->where('order_id',$order_id);
		$this->db->update('tbl_order',$data);

		$result=1;
		echo json_encode(array('changedone'=>$result));

	}


	public function cancel_buyer_order()
	{
		$order_details_id = $this->input->post('order_id');
		
			$data = array('order_product_status'=>'Canceled');
			$this->db->where('order_details_id',$order_details_id);
			$this->db->update('tbl_order_details',$data);
		


		$result=1;
		echo json_encode(array('changedone'=>$result));

	}


	public function order_delete()
	{
		$order_id = $this->input->post('order_id');

		$data = array('buyer_view'=>'N');

		$this->db->where('order_id',$order_id);
		$this->db->update('tbl_order',$data);

		$result=1;
		echo json_encode(array('changedone'=>$result));

	}
	
	
	


	
}
?>