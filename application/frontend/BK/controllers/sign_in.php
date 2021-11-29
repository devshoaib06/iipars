<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class sign_in extends CI_Controller 
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
		
	    $this->load->view('common/header');
		$this->load->view('sign_in');
		$this->load->view('common/footer');

	}

	function registration_submit()
	{

		$f_name=trim($this->input->post('f_name'));
		$l_name=trim($this->input->post('l_name'));
		$email=trim($this->input->post('email'));
		$mobile=trim($this->input->post('mobile'));
		$password=trim($this->input->post('password'));
		$c_password=trim($this->input->post('c_password'));
		$created_on=date('Y-m-d H:i:s');

		$email_check=$this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('mobile'=>$mobile,'login_email'=>$email,'user_type_id'=>'3',), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		if(count($email_check)>0)
		{
		 	$this->session->set_flashdata('emailexist',"Your Email Is Already Used.");
		 	redirect($this->url->link(3),'refresh');
		}
		else
		{
		 
				if($password==$c_password && $f_name!="" && $l_name!="" && $email!="" && $mobile!="" && $password!="" && $c_password!="")
				{

				$data=array(

							'first_name'=>$f_name,
							'last_name'=>$l_name,
							'mobile'=>$mobile,
							'login_email'=>$email,
							'login_pass'=>$password,
							'created_on'=>$created_on,
							'user_type_id'=>3
							);

				$this->db->insert('tbl_user',$data);
				$id = $this->db->insert_id();


				//******************************** Mail Sent To customer******************************************//


		           $data['email']=$this->common_model->common($table_name = 'tbl_email', $field = array(), $where = array('email_id'=>1), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		            $admin_recive=$data['email'][0]->recieve_email;
		            $admin_from=$data['email'][0]->from_email;
		            //$admin_from='rahul.exprolab@gmail.com';
		        
		            $email_data['mail_data']=array
		            (
		                'ufname'=>$f_name,
		                'ulname'=>$l_name,
		                'uemail'=> $email,
		                'umobile'=> $mobile,
		                'upass'=>$password
		                
		            );

		            $this->email->set_mailtype("html");

		            $html_email_user = $this->load->view('mail_template/admin_enquiry_registration_mail',$email_data, true);
		            $send_user_mail_html=$this->load->view('mail_template/registration_reply_mail_view',$email_data, true);

		           //print_r($send_user_mail_html );exit;

		            $this->email->from($admin_from);
		            $this->email->to($admin_recive);
		            $this->email->subject('Registration With us mail from DSY apnabazzar');
		            $this->email->message($html_email_user);
		            @$reponse=$this->email->send();

		            $this->email->from($admin_from,'AKD Ecommerce');
		            $this->email->to($email);
		            $this->email->subject('Registration With us Reply from  DSY apnabazzar');
		            $this->email->message($send_user_mail_html);
		            @$reponse_reply=$this->email->send();

		            if($this->session->userdata('cart_session_id')!='')
		            {
		            	$akd_log_session = array(					  
					   
												   'user_email'=>$email,
												   'user_session_id'=>$id,
												   'user_fname'=>$f_name,
												   'user_contact'=>$mobile,
												   'logged_in' => TRUE
				   								);
			 			$this->session->set_userdata($akd_log_session);

			 			$cart_sess_id = $this->session->userdata('cart_session_id');
						$user_id = $this->session->userdata('user_session_id');
						@$cart_item = $this->common_model->common($table_name = 'tbl_cart_item', $field = array(), $where = array('cart_session_id'=>$cart_sess_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

						foreach(@$cart_item as $cart)
						{
							$seller_cart_data = array(

													'cart_session_id'=>$cart_sess_id,
													'user_id'=>$user_id,										
													'cart_item_id'=>$cart->cart_item_id,
													'cart_item_qty'=>$cart->cart_item_qty,
													'cart_item_net_price'=>$cart->cart_item_net_price,
													'cart_item_price'=>$cart->cart_item_price,
													'cart_item_price_disc'=>$cart->cart_item_price_disc,
												
												);
							
							$this->db->insert('tbl_seller_cart',$seller_cart_data);
						}

						$this->db->where('cart_session_id',$cart_sess_id);
		          		$this->db->delete('tbl_cart_item');
			 			redirect($this->url->link(8), 'refresh');
		            }
		            else
		            {
		            	
		            	$this->session->set_flashdata('msg','You Are Successfully Registered with us.<br> Your Login credentials has been sent to your Email..Please Check Your Email Id');
				    	redirect($this->url->link(3),'refresh');
		            }
				    

				  

			
				}
				else
				{
			
					$this->session->set_flashdata('wrongpass',"Registration Failed!!!!<br>Password doesn't match.");
		    
					redirect($this->url->link(33),'refresh');
				}

		}

		


	

	                                                                                                                                                                                                                                                                                                                                                                                                                      


	}


	public function login_action()
	{

		$username= $this->input->post('username');
		$password= $this->input->post('user_password');

		$login_avail=  $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('login_email'=>$username,'login_pass'=>$password,'status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		$login_avail2= $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('mobile'=>$username,'login_pass'=>$password, 'status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		if(count($login_avail) >0)
		{
		    //echo '<pre>';	print_r($login_avail); exit;
		    
				$this->session_set($login_avail);
				

				$user_id = $this->session->userdata('user_session_id');
				//echo $user_id; exit;	
			if(@$login_avail[0]->user_type_id=='3' || @$login_avail2[0]->user_type_id=='3')
		    {
		    	//exit;

				if($this->session->userdata('wish_sess_id')!='')
				{
					//echo 'hi' ; exit;
					redirect(base_url().$this->add_wishlist());                    // add the product in wishlist  //
				}
		/*---------------------------------------------------------------------------------------------*/
				if($this->session->userdata('cart_session_id')!='')
				{
					
					$cart_sess_id = $this->session->userdata('cart_session_id');
					$user_id = $this->session->userdata('user_session_id');
					@$cart_item = $this->common_model->common($table_name = 'tbl_cart_item', $field = array(), $where = array('cart_session_id'=>$cart_sess_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

					foreach(@$cart_item as $cart)
					{
						$seller_cart_data = array(

												'cart_session_id'=>$cart_sess_id,
												'user_id'=>$user_id,										
												'cart_item_id'=>$cart->cart_item_id,
												'cart_item_qty'=>$cart->cart_item_qty,
												'cart_item_net_price'=>$cart->cart_item_net_price,
												'cart_item_price'=>$cart->cart_item_price,
												'cart_item_price_disc'=>$cart->cart_item_price_disc,
											
											);
						
						$this->db->insert('tbl_seller_cart',$seller_cart_data);
					}

					$this->db->where('cart_session_id',$cart_sess_id);
	          		$this->db->delete('tbl_cart_item');
					redirect($this->url->link(25), 'refresh');    // go to shipping address page ///

				}
				
				/*else
				{
					
					if(@$login_avail[0]->user_type_id=='2' || @$login_avail2[0]->user_type_id=='2')
					{
						redirect($this->url->link(20));
					}
					else
					{
						redirect($this->url->link(5));
					}
					
				}*/
				else
					{
						
						redirect($this->url->link(5));
					}
				
			}
			else
			{
				//echo '<pre>'; print_r($this->session->all_userdata()) ; exit;
				redirect($this->url->link(20));
			}
		}

		if(count($login_avail2) >0)
		{
		    //echo '<pre>';	print_r($login_avail); exit;
		    
				$this->session_set($login_avail2);
				

				$user_id = $this->session->userdata('user_session_id');
				echo $user_id; exit;	
			if(@$login_avail[0]->user_type_id=='3' || @$login_avail2[0]->user_type_id=='3')
		    {
		    	//exit;

				if($this->session->userdata('wish_sess_id')!='')
				{
					//echo 'hi' ; exit;
					redirect(base_url().$this->add_wishlist());                    // add the product in wishlist  //
				}
		/*---------------------------------------------------------------------------------------------*/
				if($this->session->userdata('cart_session_id')!='')
				{
					
					$cart_sess_id = $this->session->userdata('cart_session_id');
					$user_id = $this->session->userdata('user_session_id');
					@$cart_item = $this->common_model->common($table_name = 'tbl_cart_item', $field = array(), $where = array('cart_session_id'=>$cart_sess_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

					foreach(@$cart_item as $cart)
					{
						$seller_cart_data = array(

												'cart_session_id'=>$cart_sess_id,
												'user_id'=>$user_id,										
												'cart_item_id'=>$cart->cart_item_id,
												'cart_item_qty'=>$cart->cart_item_qty,
												'cart_item_net_price'=>$cart->cart_item_net_price,
												'cart_item_price'=>$cart->cart_item_price,
												'cart_item_price_disc'=>$cart->cart_item_price_disc,
											
											);
						
						$this->db->insert('tbl_seller_cart',$seller_cart_data);
					}

					$this->db->where('cart_session_id',$cart_sess_id);
	          		$this->db->delete('tbl_cart_item');
					redirect($this->url->link(8), 'refresh');    // go to shipping address page ///

				}
				
				/*else
				{
					
					if(@$login_avail[0]->user_type_id=='2' || @$login_avail2[0]->user_type_id=='2')
					{
						redirect($this->url->link(20));
					}
					else
					{
						redirect($this->url->link(5));
					}
					
				}*/
				else
					{
						
						redirect($this->url->link(34));
					}
				
			}
			else
			{
				//echo '<pre>'; print_r($this->session->all_userdata()) ; exit;
				redirect($this->url->link(20));
			}
		}
		
		else{
			$this->session->set_flashdata('err_msg','Log in failed !!');
			redirect($this->url->link(3),'refresh');
		}

	
	}


	public function session_set($login_avail)
		{
			 $user_id= @$login_avail[0]->user_id; 
			 $user_email= @$login_avail[0]->login_email; 
			 $user_ph= @$login_avail[0]->mobile;
			 $fname= @$login_avail[0]->first_name; 
			 
			 
			 $akd_log_session = array(					  
					   
					   'user_email'=>$user_email,
					   'user_session_id'=>$user_id,
					   'user_fname'=>$fname,
					   'user_contact'=>$user_ph,
					   'logged_in' => TRUE
				   						);
			 $this->session->set_userdata($akd_log_session);
			//echo '<pre>'; print_r($this->session->all_userdata()) ; exit;
		}

		
  

  /// *******************************  This function for : after login add the click product in wishlist   ************************************************************//////


	public function add_wishlist()
	{
    
		    $product_id= $this->session->userdata('wish_pro_id');
		    
		    @$product_details = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		    $product_name = @$product_details[0]->product_name;  
		    $product_price = @$product_details[0]->price;
		    $product_discount = @$product_details[0]->discount;
		    $product_net_price = @$product_details[0]->net_price;

		    
		    $this->session->unset_userdata('wish_sess_id');
		   	$this->session->unset_userdata('wish_pro_id');
    		
    		$user_id= $this->session->userdata('user_session_id');
            $chk_wish_lst = $this->common_model->common($table_name = 'tbl_wishlist', $field = array(), $where = array('product_id'=>$product_id,'user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
            if(count($chk_wish_lst)>0)
            {
              $user_id= $this->session->userdata('user_session_id');
              $this->db->where('product_id',$product_id);
              $this->db->where('user_id',$user_id);
              $this->db->delete('tbl_wishlist');
              $user_id= $this->session->userdata('user_session_id');
              $this->session->set_flashdata('err_msg','Product Deleted Form Your Wishlist.');
              redirect($this->url->link(7),'refresh');
            }
            else
            {
              
              $user_id = $this->session->userdata('user_session_id');
              $wishlist_data = array(

                                        'product_id'=>$product_id,
                                        'product_name'=>$product_name,
                                        'product_price'=>$product_price,
                                        'product_discount'=>$product_discount,
                                        'product_net_price'=>$product_net_price,
                                        'user_id'=>$user_id

                                    );

            $this->db->insert('tbl_wishlist',$wishlist_data);
            $this->session->set_flashdata('succ_msg','Product Added To Your Wishlist.');
            redirect($this->url->link(7),'refresh');
            
            }
    

    		//echo json_encode(array('wishlist'=>$result));
   
	}

	function reset_pass_email_sent()
	{

		$email=$this->input->post('email');

		if($email!=null)

		{

	            $data=$this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('login_email'=>$email), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	            


	            if(count($data)>0)
	            {
	            	 $user_login_pass=$data[0]->login_pass;

	            	  $user_fname=$data[0]->first_name;
	            	  $user_lname=$data[0]->last_name;

	            	 $user_email=$data[0]->login_email;

	            	$data['email']=$this->common_model->common($table_name = 'tbl_email', $field = array(), $where = array('email_id'=>1), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
	            	//$data['email']=$this->common->selectOne('tblemail','email_id','1');
                    //$admin_recive=$data['email'][0]->recieve_email;
                    $admin_from=$data['email'][0]->from_email;

                     $email_data['mail_data']=array
                                               (
                									'upass'=>$user_login_pass,
                									'ufname'=>$user_fname,
                									'ulname'=>$user_lname
               
          										);

                       $this->email->set_mailtype("html");  

                        $html_email_user = $this->load->view('mail_template/reset_pass_mail_view',$email_data, true);   

                        print_r($html_email_user);exit();
                       
                        $this->email->from($admin_from,'AKD Ecommerce');
			            $this->email->to($user_email);
			            $this->email->subject('Reset Password Mail From AKD Ecommerce');
			            $this->email->message($html_email_user);
         			    @$reponse=$this->email->send();

         			    $this->session->set_flashdata('pass_succ_msg','Please Check Your mail!!! Your password has been sent successfully to your registered Email id....');
         			    redirect($this->url->link(3),'refresh');                


	            }

	            else
	            {

	            	$this->session->set_flashdata('pass_error_msg','Email Id Not Registered....');

	            	redirect($this->url->link(3),'refresh');
	            }


       }

	}

	
}