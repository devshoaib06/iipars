<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class manage_seller_order extends CI_Controller 
{	
	 
	 public function __construct()
     {
          parent::__construct();
          $this->load->model('common/admin_model');

	 }
	
	public function index()
	{
		$this->session->unset_userdata('search_sess_name');
		$this->session->unset_userdata('search_category');
		
	 	$user_id = $this->session->userdata('user_session_id');
	 	$data['order_details'] = $this->common_model->common($table_name = 'tbl_order_details', $field = array(), $where = array('product_seller_id'=>$user_id,'seller_view'=>'Y'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');	
     	$data['order_list'] = $this->common_model->common($table_name = 'tbl_order', $field = array(), $where = array('order_customer_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
     	$data['user_details'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
     	
     	//echo '<pre>'; print_r($data['user_details']); exit;
		$this->load->view('common/header');
		$this->load->view('seller_purchase',$data);
		$this->load->view('common/footer');

	}

	public function order_details()
	{
	
	 	$order_details_id = $this->uri->segment(2);	
	 	
     	$order_details = $this->common_model->common($table_name = 'tbl_order_details', $field = array(), $where = array('order_details_id'=>$order_details_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
     	$order_id = @$order_details[0]->order_id;
     	$order_list = $this->common_model->common($table_name = 'tbl_order', $field = array(), $where = array('order_id'=>$order_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
     	$data['order'] = $order_list ;
     	$data['or_details'] = $order_details;
     	$customer_id = @$order_list[0]->order_customer_id;
     	$data['customer_details'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$customer_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
     	$user_id = $this->session->userdata('user_session_id');	
     	$data['user_details'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		
		$product_id = @$order_details[0]->order_product_id;
		$data['product_details'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		$data['product_image'] = $this->common_model->common($table_name = 'tbl_product_image', $field = array(), $where = array('product_id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		//$data['delivery_address'] = $this->common_model->common($table_name = 'tbl_delivery_address', $field = array(), $where = array('deli_user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		
		$this->load->view('common/header');
		$this->load->view('seller_order_details',$data);
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

	public function order_status_change()
	{
		$order_details_id = $this->input->post('order_details_id');
		$order_status = $this->input->post('order_status');

		$order_details= $this->common_model->common($table_name = 'tbl_order_details', $field = array(), $where = array('order_details_id'=>$order_details_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$order_id = @$order_details[0]->order_id;

	   

		$status_data = array(

								'order_product_status'=>$order_status
							);

		$this->db->where('order_details_id',$order_details_id);
		$this->db->update('tbl_order_details',$status_data);

		//****************************MAIL**************************************//

		  $order_list = $this->common_model->common($table_name='tbl_order_details',$field=array(),$where=array('order_details_id'=>$order_details_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
		
	      $order= $this->common_model->common($table_name='tbl_order',$field=array(),$where=array('order_id'=>$order_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());

	    $order_unique_id = @$order[0]->order_unique_id;
	    $order_status = @$order_list[0]->order_product_status;
	    $order_date = @$order[0]->created_date;
	    $order_product_id = @$order_list[0]->order_product_id;
	    $customer_id = @$order[0]->order_customer_id;
	    $cancel_reason = @$order_list[0]->cancel_reason_seller;
	   	//echo $order_status ;
		//print_r($order_list); 
		$product_details = $this->common_model->common($table_name='tbl_product',$field=array(),$where=array('id'=>$order_product_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
	
	
	
		//echo $customer_id; exit;
		$customer= $this->common_model->common($table_name='tbl_user',$field=array(),$where=array('user_id'=>$customer_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());

		$cust_fst_name = @$customer[0]->first_name;
		$cust_lst_name = @$customer[0]->last_name;
		$cust_email = @$customer[0]->login_email;
		$cust_ph = @$customer[0]->mobile;

		$email_data = array
				(
					'cust_fst_name'=>$cust_fst_name,
					'cust_lst_name'=>$cust_lst_name,
					'cust_email'=>$cust_email,
					'ph'=>$cust_ph,
					'order_unique_id'=>$order_unique_id,
					'order_status'=>$order_status,
					'order_date'=>$order_date,
					'product_details'=>$product_details
					
					
				);


	       
	        
	             $data['email']=$this->common_model->common($table_name = 'tblemail', $field = array(), $where = array('email_id'=>1), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	           // $admin_recive=$data['email'][0]->recieve_email;
	            $admin_from=$data['email'][0]->from_email;
	            //$admin_from='rahul.exprolab@gmail.com';
	        
	            $email_data['mail_data']=array
	            (
	                'fname'=>$cust_fst_name,
	                'lname'=>$cust_lst_name,
	                'uemail'=> $cust_email,
	                'uphone'=> $cust_ph,
	                'uorder_id'=>$order_unique_id,
	                'ustatus'=>$order_status,
	                'uorder_date'=>$order_date,
	                'cancel_reason'=>$cancel_reason,
	                'product_name'=>@$product_details[0]->product_name,
	               
	            );



            $this->email->set_mailtype("html");

            //$html_email_user = $this->load->view('mail_template/admin_enquiry_contact_mail',$email_data, true);
            $send_user_mail_html=$this->load->view('mail_template/customer_status_reply_mail_view',$email_data, true);

            //print_r($send_user_mail_html );exit;
            
            $this->email->from($admin_from,'Dr.Roy Ecommerce');
            $this->email->to($cust_email);
            $this->email->subject('Reply from Dr.roy Ecommerce');
            $this->email->message($send_user_mail_html);
            @$reponse_reply=$this->email->send();

            

        


	

		$result=1;
		echo json_encode(array('changedone'=>$result));



	}

	public function order_delete()
	{
		$order_details_id = $this->input->post('order_details_id');

		$data = array('seller_view'=>'N');

		$this->db->where('order_details_id',$order_details_id);
		$this->db->update('tbl_order_details',$data);

		$result=1;
		echo json_encode(array('changedone'=>$result));

	}


	function cancel_reason()
	{

		
		$reason=$this->input->post('cancel_reason');
		$order_details_id = $this->input->post('order_details_id');
		

		$data=array(

				'cancel_reason_seller'=>$reason,	
			);

		$this->db->where('order_details_id',$order_details_id);
		$this->db->update('tbl_order_details',$data);

		$status_data = array(

								'order_product_status'=>'Canceled',
							);
		
		$this->db->where('order_details_id',$order_details_id);
		$this->db->update('tbl_order_details',$status_data);


		$order_list = $this->common_model->common($table_name='tbl_order_details',$field=array(),$where=array('order_details_id'=>$order_details_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
		
	    $order= $this->common_model->common($table_name='tbl_order',$field=array(),$where=array('order_id'=>@$order_list[0]->order_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());

	    $order_unique_id = @$order[0]->order_unique_id;
	    $order_status = @$order_list[0]->order_product_status;
	    $order_date = @$order[0]->created_date;
	    $order_product_id = @$order_list[0]->order_product_id;
	    $customer_id = @$order[0]->order_customer_id;
	    $cancel_reason = @$order_list[0]->cancel_reason_seller;
	   	//echo $order_status ; exit;
		//print_r($order_list); 
		$product_details = $this->common_model->common($table_name='tbl_product',$field=array(),$where=array('id'=>$order_product_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
	
	
	
			//echo $customer_id; exit;
			$customer= $this->common_model->common($table_name='tbl_user',$field=array(),$where=array('user_id'=>$customer_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());

			$cust_fst_name = @$customer[0]->first_name;
			$cust_lst_name = @$customer[0]->last_name;
			$cust_email = @$customer[0]->login_email;
			$cust_ph = @$customer[0]->mobile;

			$email_data = array
					(
						'cust_fst_name'=>$cust_fst_name,
						'cust_lst_name'=>$cust_lst_name,
						'cust_email'=>$cust_email,
						'ph'=>$cust_ph,
						'order_unique_id'=>$order_unique_id,
						'order_status'=>$order_status,
						'order_date'=>$order_date,
						'product_details'=>$product_details
						
						
					);


       
        
             $data['email']=$this->common_model->common($table_name = 'tblemail', $field = array(), $where = array('email_id'=>1), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

           	// $admin_recive=$data['email'][0]->recieve_email;
            $admin_from=$data['email'][0]->from_email;
            //$admin_from='rahul.exprolab@gmail.com';
        
            $email_data['mail_data']=array
            (
                'fname'=>$cust_fst_name,
                'lname'=>$cust_lst_name,
                'uemail'=> $cust_email,
                'uphone'=> $cust_ph,
                'uorder_id'=>$order_unique_id,
                'ustatus'=>$order_status,
                'uorder_date'=>$order_date,
                'cancel_reason'=>$cancel_reason,
                'product_name'=>@$product_details[0]->product_name,
               
            );



            $this->email->set_mailtype("html");

            //$html_email_user = $this->load->view('mail_template/admin_enquiry_contact_mail',$email_data, true);
            $send_user_mail_html=$this->load->view('mail_template/customer_status_reply_mail_view',$email_data, true);

            //print_r($send_user_mail_html );exit;
            
            $this->email->from($admin_from,'Dr.Roy Ecommerce');
            $this->email->to($cust_email);
            $this->email->subject('Reply from Dr.roy Ecommerce');
            $this->email->message($send_user_mail_html);
            @$reponse_reply=$this->email->send();

		redirect($this->url->link(28),'refresh');
		
	}
	
	


	
}
?>