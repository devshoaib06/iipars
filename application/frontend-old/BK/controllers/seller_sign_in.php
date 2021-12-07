<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class seller_sign_in extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	public function index()
	{
		 /*$data['aboutus']=$this->common_model->common($table_name = 'tbl_page_manage', $field = array(), $where = array('routes_id'=>15), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');*/
	    $this->load->view('common/header');
		$this->load->view('seller_registration');
		$this->load->view('common/footer');

	}

	public function seller_registration_submit()
	{

		$f_name=$this->input->post('f_name');
		$l_name=$this->input->post('l_name');
		$mobile=$this->input->post('mobile');
		$password=$this->input->post('password');
		$c_password=$this->input->post('c_password');
		$email=$this->input->post('email');
		//$pincode=$this->input->post('pincode');
		//$gstin=$this->input->post('gstin');

		$email_check=$this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('login_email'=>$email,'user_type_id'=>'2'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		if(count($email_check)>0)
		 {
		 	$this->session->set_flashdata('emailexist',"Your Email Is Already Used.");
		 	redirect($this->url->link(18),'refresh');
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
							'user_type_id'=>2
							);

				$this->db->insert('tbl_user',$data);


				//******************************** Mail Sent To Seller******************************************//


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
		                /*'upincode'=> $pincode,
		                'ugstin'=>$gstin*/
		                
		            );

		            $this->email->set_mailtype("html");

	               $html_email_user = $this->load->view('mail_template/admin_enquiry_seller_registration_mail',$email_data, true);
		            $send_user_mail_html=$this->load->view('mail_template/seller_registration_reply_mail_view',$email_data, true);

		          // print_r($html_email_user );exit;
		            $this->email->from($admin_from);
		            $this->email->to($admin_recive);
		            $this->email->subject('Registration With us mail from Dr.roy Ecommerce');
		            $this->email->message($html_email_user);
		            @$reponse=$this->email->send();

		            $this->email->from($admin_from);
		            $this->email->to($email);
		            $this->email->subject('Registration With us Reply from  Dr.roy Ecommerce');
		            $this->email->message($send_user_mail_html);
		            @$reponse_reply=$this->email->send();


				    $this->session->set_flashdata('msg','You Are Successfully Registered with us....<br>Login credentials has been sent to your mail id, Please check your mail id...');
				    redirect($this->url->link(18),'refresh');

				  

			
				}
				else
				{
			
					$this->session->set_flashdata('wrongpass',"Registration Failed!!!!<br>Password doesn't match...");
		    
					redirect($this->url->link(18),'refresh');
				}

		}

	}
}
?>
