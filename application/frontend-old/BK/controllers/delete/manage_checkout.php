<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class manage_checkout extends CI_Controller 
{	
	 
	 public function __construct()
     {
          parent::__construct();
          //$this->load->library('paypal_lib');
	 }
	
	public function index()
	{
		if($this->session->userdata('user_session_id')!='')
		{
			$user_id= $this->session->userdata('user_session_id');
		}
		else
		{
			$this->session->set_flashdata('err_msg','Plaese Log in !');
			redirect($this->url->link(3),'refresh');
		}

		//echo '<pre>'; print_r($this->session->all_userdata()) ; exit;
		if($this->session->userdata('cart_session_id')=='')
		{
			redirect($this->url->link(1),'refresh');
		}
		
     	$data['seller_cart_details'] = $this->common_model->common($table_name='tbl_seller_cart',$field=array(),$where=array('user_id'=>$user_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
     
		$this->load->view('common/header');
		$this->load->view('checkout',$data);
		$this->load->view('common/footer');
	}
	public function shipping_address()
	{
		if($this->session->userdata('user_session_id')!='')
		{
			$user_id= $this->session->userdata('user_session_id');
		}
		else
		{
			$this->session->set_flashdata('err_msg','Plaese Log in !');
			redirect($this->url->link(3),'refresh');
		}

		//echo '<pre>'; print_r($this->session->all_userdata()) ; exit;
		if($this->session->userdata('cart_session_id')=='')
		{
			redirect($this->url->link(1),'refresh');
		}
		
     	$data['shipping_address'] = $this->common_model->common($table_name='tbl_delivery_address',$field=array(),$where=array('deli_user_id'=>$user_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
     
		$this->load->view('common/header');
		$this->load->view('shopping_address',$data);
		$this->load->view('common/footer');
	}
	public function payment_checkout()
	{
		if($this->session->userdata('cart_session_id')=='')
		{
			redirect($this->url->link(1),'refresh');
		}
     
		$this->load->view('common/header');
		$this->load->view('payment');
		$this->load->view('common/footer');
	}
	public function billing_address()
	{
		
		$user_id = $this->session->userdata('user_session_id');
		
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$alter_phone = $this->input->post('alter_phone');
		$location = $this->input->post('address');
		$city = $this->input->post('city');
		$state = $this->input->post('state');
		$pincode = $this->input->post('pincode');
		//$optradio = $this->input->post('optradio');
		$current_date=date('Y-m-d H:i:s');
		
		$data = array(
						
						'deli_name'=>$name,
						'deli_mail'=>$email,
						'deli_phone'=>$phone,
						'deli_alt_phone'=>$alter_phone,
						'deli_adds_type'=>$optradio,
						'deli_location'=>$location,
						'deli_city'=>$city,
						'deli_state'=>$state,
						'deli_pin'=>$pincode,
						'deli_user_id'=>$user_id,
						'created_date'=>$current_date
					);	//echo '<pre>';	print_r($data); exit;

		$chk = $this->common_model->common($table_name='tbl_delivery_address',$field=array(),$where=array('deli_user_id'=>$user_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
		if(count($chk)>0)
		{
			$this->db->where('deli_user_id',$user_id);
			$this->db->update('tbl_delivery_address',$data);
			redirect($this->url->link(17), 'refresh'); 
		}
		else
		{
			$this->db->insert('tbl_delivery_address',$data);
			redirect($this->url->link(17), 'refresh'); 
		}
		
		
	}
	public function confirm_order()
	{
		if($this->session->userdata('cart_session_id')=='')
		{
			redirect($this->url->link(1),'refresh');
		}
     
		$this->load->view('common/header');
		$this->load->view('confirm_order');
		$this->load->view('common/footer');
	}

	public function order_submit()
	{

		//echo $this->input->post('radio'); exit;
		$payment_type = $this->input->post('optradio');
		$sess_array= array(
                               'payment_type'=>$payment_type
                           );
		$this->session->set_userdata($sess_array);
		//echo '<pre>'; print_r($this->session->all_userdata()) ; exit;
		redirect($this->url->link(19), 'refresh'); 
	}


	public function order_submit_action()
	{
		$user_id = $this->session->userdata('user_session_id');
		//echo '<pre>'; print_r($this->session->all_userdata()) ; exit;
		$cart_sub_total= $this->session->userdata('checkout_total_amount');
		$pay_method= $this->session->userdata('payment_type');
		//echo $cart_sub_total; exit;
		if($pay_method=="COD")
		{
			$payment_status='cod';
		}
		else{
			$payment_status='online';
		}
		//echo $payment_status; exit;		
		$buy_option= $this->input->post('buy_option');

		if($pay_method=="COD")
		{
			$order_data= array(
							
							'order_customer_id'=>$user_id,
							'order_total_price'=>$cart_sub_total,
							'order_status'=>'Pending',
							'payment_status'=>$payment_status,							
							'created_date'=>date('Y-m-d H:i:s')
							
							);
		}
		else
		{
			$order_data= array(
							
							'order_customer_id'=>$user_id,
							'order_total_price'=>$cart_sub_total,
							'order_status'=>'Pending',
							'payment_status'=>'unpaid',							
							'created_date'=>date('Y-m-d H:i:s')
							
							);

		}

		//echo '<pre>'; print_r($order_data); exit;

		$this->db->insert('tbl_order', $order_data); 
		$order_id = $this->db->insert_id();

		$uni_code= 'Dr.Roy-'.rand(000,999).$order_id;
		$string = str_shuffle('QWERTYUIOPASDFGHJKLZXCVBNMqwertyuioplkjhgfdsazxcvbnm1234567890');
		$uni_track_code = substr($string,-10);
		
		//$uni_track_code= rand(0000000000000000,9999999999999999);
		/*$track_sess_array= array(
                                    'order_track_id'=>$uni_track_code
                                );
        $this->session->set_userdata($track_sess_array);*/

		$update_data= array(
							'order_unique_id'=>$uni_code,
							'order_track_id'=>$uni_track_code,
							);

		$this->db->where('order_id', $order_id);
		$this->db->update('tbl_order',$update_data );

		//----------------------------------------------------------------------------------//
		/*$coupon_data = array(
							'order_unique_id'=>$uni_code,
							
							);
		$coupon_sess_id = $this->session->userdata('coupon_session_id');
		$this->db->where('user_id', $user_id);
		$this->db->where('coupon_session_id', $coupon_sess_id);
		$this->db->update('tbl_coupon_user',$coupon_data );*/
		//---------------------------------------------------------------------------------------------//

		$cart_sess_id= $this->session->userdata('cart_session_id');
		$user_id = $this->session->userdata('user_session_id');
		$cart_list = $this->common_model->common($table_name = 'tbl_seller_cart', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		foreach($cart_list as $cart)
          {

          	$product_id = $cart->cart_item_id; 
          		$product_details =  $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');        	
          	$product_seller_id = @$product_details[0]->seller_id;
          	$product_quantity = $cart->cart_item_qty;
          	$net_price = $cart->cart_item_net_price;          	
          	$discount = $cart->cart_item_price_disc;
          	$order_details_data= array(
          								'order_id'=>$order_id,
          								
          								'order_product_id'=>$product_id,
          								'order_product_qty'=>$product_quantity,
          								'order_product_price'=>$net_price,          								
          								'order_created_date'=>date('Y-m-d H:i:s')
          							);
          	//echo '<pre>'; print_r($order_details_data); exit;
          	$this->db->insert('tbl_order_details', $order_details_data);

          	/*if($pay_method=='Cash On Delivery')
         	{*/
          	$this->db->where('cart_session_id',$cart_sess_id);
          	$this->db->where('user_id',$user_id);
          	$this->db->delete('tbl_seller_cart');




          	
          	/*}*/
          } 
          //-------------------------mail---------------------------------//
		$delivary_adds = $this->common_model->common($table_name = 'tbl_delivery_address', $field = array(), $where = array('deli_user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		$deli_name = $delivary_adds[0]->deli_name;		
		$deli_mail = $delivary_adds[0]->deli_mail;
		$deli_phone = $delivary_adds[0]->deli_phone;
		$deli_alt_phone = $delivary_adds[0]->deli_alt_phone;
		$deli_adds_type = $delivary_adds[0]->deli_adds_type;
		$deli_location = $delivary_adds[0]->deli_location;
		$deli_city = $delivary_adds[0]->deli_city;
		$deli_state = $delivary_adds[0]->deli_state;
		$deli_pin = $delivary_adds[0]->deli_pin;

        $admin_details_array= $this->common_model->common($table_name = 'tblemail', $field = array(), $where = array('email_id'=>1), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		
		$billing_address =  $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		//echo '<pre>'; print_r($user_details_array); exit;

		$first_name= $billing_address[0]->first_name;
		$last_name= $billing_address[0]->last_name;
		$email= $billing_address[0]->login_email;
		$mobile= $billing_address[0]->mobile;

		$admin_recive=$admin_details_array[0]->recieve_email;
		$admin_from=$admin_details_array[0]->from_email;
		
		
		
		$email_data['mail_data']=
		array(
				'first_name'=>$first_name,
				'last_name'=>$last_name,
				'email'=>$email,
				'mobile'=>$mobile,
				'order_uniq_id'=>$uni_code,
				'order_total_price'=>$cart_sub_total,
				'order_shipping_charge'=>'FREE',							
				'deli_name'=>$deli_name,				
				'deli_mail'=>$deli_mail,
				'deli_phone'=>$deli_phone,
				'deli_alt_phone'=>$deli_alt_phone,
				'deli_adds_type'=>$deli_adds_type,
				'deli_location'=>$deli_location,
				'deli_state'=>$deli_state,
				'deli_city'=>$deli_city,
				'deli_pin'=>$deli_pin,
				'order_date'=>date('Y-m-d H:i:s')
				
				
			);

			
			
			/* -- Send to Admin -- */
			$this->email->set_mailtype("html");
			$html_email_user = $this->load->view('mail_template/order_user_mail',$email_data, true);

			$html_email_admin=$this->load->view('mail_template/order_admin_mail',$email_data, true);
			
			print_r($html_email_user); echo '<br>'; 
			
			print_r($html_email_admin); exit;
			
			$this->email->from($admin_from);
			$this->email->to($admin_recive);
			$this->email->subject('Scarver and Febrics | New Order Placed');
			$this->email->message($html_email_admin);
			$this->email->send();

			/* -- Send to Vendor -- */
			$this->email->from($admin_from);
			$this->email->to($email);
			$this->email->subject('Scarver and Febrics | New Order Placed');
			$this->email->message($html_email_user);
			$this->email->send();

			$this->session->unset_userdata('cart_session_id');
          	$this->session->unset_userdata('discount_for_coupon');
          	$this->session->unset_userdata('discount_type');
          	$this->session->unset_userdata('cart_total_amount');
          	$this->session->unset_userdata('total_placed_amount');
          	$this->session->set_userdata('coupon_session_id',0);
		//---------------------------------------------------------------------------------//
			if($payment_status=='online')
			{
				if($pay_method=='CC Avenue')
				{
					$data= array(
		 						'first_name'=>$first_name,
								'last_name'=>$last_name,
								'email'=>$email,
								'mobile'=>$mobile,
								'order_uniq_id'=>$uni_code,
								'order_total_price'=>$cart_sub_total,
								'order_shipping_charge'=>'FREE',
								
								'order_sub_total'=>$cart_sub_total,
								'billing_name_1'=>$deli_fst_name,
								'billing_name_2'=>$deli_lst_name,
								'billing_mail'=>$bil_mail,
								'billing_phone'=>$deli_phone,
								'billing_country'=>$country_name,
								'billing_state_id'=>$state_name,
								'billing_city_id'=>$city_name,
								'billing_pin'=>$deli_pin,
								'billing_add'=>$deli_addrs1,
								'deli_name_1'=>$deli_fst_name,
								'deli_name_2'=>$deli_lst_name,
								'deli_mail'=>$bil_mail,
								'deli_phone'=>$deli_phone,
								'deli_country'=>$country_name,
								'deli_state_id'=>$state_name,
								'deli_city_id'=>$city_name,
								'deli_pin'=>$deli_pin,
								'deli_add'=>$deli_addrs1,
								'redirect_url'=>base_url()."ccavResponseHandler"
							
		 						);

		 				$this->load->view('dataFrom', $data);
				}
				else if($pay_method=='PayPal')
				{
					//echo $cart_sub_total; exit;
					
					$order = $this->common_model->common($table_name = 'tbl_order', $field = array(), $where = array('order_id'=>$order_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
					$price = $order[0]->order_sub_total;

					$returnURL = base_url().$this->url->slug(56); //payment success url
	                $cancelURL = base_url().$this->url->slug(57); //payment cancel url
	                $notifyURL = base_url().$this->url->slug(58); //ipn url
	                $logo = base_url().'assets/images/logo.png';

	                //$reg_id=$this->session->userdata('reg_id');
	                
	                $this->paypal_lib->add_field('return', $returnURL);
	                $this->paypal_lib->add_field('cancel_return', $cancelURL);
	                $this->paypal_lib->add_field('notify_url', $notifyURL);
	                $this->paypal_lib->add_field('item_name', $uni_code);
	                //$this->paypal_lib->add_field('custom', $reg_id);
	                $this->paypal_lib->add_field('item_number',  $order_id);
	                $this->paypal_lib->add_field('amount', $price); 
	                $this->paypal_lib->add_field('currency_code', $currency);       
	                $this->paypal_lib->image($logo);
	                
	                $this->paypal_lib->paypal_auto_form();

				}
			}
			else
			{
				//echo 'ok'; exit;
				$this->session->set_flashdata('ords_msg','Your order has been successfully placed.');
				redirect($this->url->slug(35), 'refresh'); 
			}
		
	}

}
?>