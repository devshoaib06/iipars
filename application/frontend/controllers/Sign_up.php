<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sign_up extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();
           $this->load->model('page_model');
           $this->load->model('teachinns_home_model');
           

	}
	
	public function index()
	{

	 // $data['slider'] = $this->common_model->common($table_name = 'tbl_home_slider', $field = array(), $where = array('status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		// $data['active']="home";

       
        $data['subject'] = $this->common_model->common($table_name = 'tbl_kpo', $field = array(), $where = array('status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
        $data['subjects']=$this->teachinns_home_model->subjects();
		$data['book_publication_page_detl']=$this->page_model->book_publication_detl_all();
		$data['writing_consultancy_page_detl']=$this->page_model->writing_consultancy_detl_all();
		 $this->load->view('common/header',$data);
		$this->load->view('sign_up_page',$data);
		$this->load->view('common/footer');
	}

	// function create_account()
	// {

	// 	// echo "okk";
	// 	$full_name=$this->input->post('full_name');
	// 	$email=$this->input->post('email');
	// 	$mobile=$this->input->post('mobile');
	// 	$password=$this->input->post('password');
	// 	$confirm_pass=$this->input->post('confirm_pass');
	// 	$subject=$this->input->post('subject');
	// 	// $contact_msg=$this->input->post('message');
	// 	$created_on=date('Y-m-d H:i:s');


	// 	$code= mt_rand(100000, 999999);
	// 	$user_type_id="ST".$code;

	// 	$email_check=$this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('login_email'=>$email), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	// 	if(count($email_check)>0)
	// 	{
	// 	 	$this->session->set_flashdata('exist',"Your Email Is Already Used.");
	// 		 //redirect('sign_up', 'refresh');
	// 		 redirect($this->url->link(3), 'refresh');
		 	
	// 	}

	         

	// 	$data=array(
	// 					'user_type_id'=>'2',
	// 					'user_unique_id'=>$user_type_id,
	// 					'first_name'=>$full_name,
	// 					'login_email'=>$email,
	// 					'login_pass'=>$confirm_pass,
	// 					'created_on'=>$created_on,
	// 					'subject_id'=>$subject,
	// 					'mobile'=>$mobile
	// 				);

	// 			 $this->db->insert('tbl_user',$data);

	// 			$this->session->set_flashdata('succs',"You have successfully create your account please Login.");
	// 	 	redirect($this->url->link(4), 'refresh');

	// }



	function create_account()
	{

		// echo "okk";
		$full_name=$this->input->post('full_name');
		$email=$this->input->post('email');
		$mobile=$this->input->post('mobile');
		$password=$this->input->post('password');
		$confirm_pass=$this->input->post('confirm_pass');
		$subject=$this->input->post('subject');
		// $contact_msg=$this->input->post('message');
		$created_on=date('Y-m-d H:i:s');


		$code= mt_rand(100000, 999999);
		$user_type_id="ST".$code;

		$email_check=$this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('login_email'=>$email), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$mobile_check=$this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('mobile'=>$mobile), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		if(count($email_check)>0)
		{
		 	$this->session->set_flashdata('exist',"Your Email Is Already Used.");
			 //redirect('sign_up', 'refresh');
			 redirect($this->url->link(3), 'refresh');
		 	
		}

		if(count($mobile_check)>0)
		{
		 	$this->session->set_flashdata('exist',"Your Mobile No. Is Already Used.");
			 //redirect('sign_up', 'refresh');
			 redirect($this->url->link(3), 'refresh');
		 	
		}

	         

		$data=array(
						'user_type_id'=>'2',
						'user_unique_id'=>$user_type_id,
						'first_name'=>$full_name,
						'login_email'=>$email,
						'login_pass'=>$confirm_pass,
						'created_on'=>$created_on,
						'subject_id'=>$subject,
						'mobile'=>$mobile
					);

				 $this->session->set_userdata($data);

				
		 	

	        redirect('sign_up/sendotp_for_verify','refresh');


	}



		public function sendotp_for_verify(){

		// echo 'test'; exit;

		$curl = curl_init();
		$mobile=$this->session->userdata('mobile');

		$auth_key = '258941A8mZuDen35c518aac';
		$alphanumeric = 'AGNISK';
		$otp = rand(100000,999999);
		$message = str_replace(" ","%20","Greetings from IIPARS! Your mobile verification OTP is ".$otp);

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.msg91.com/api/sendhttp.php?mobiles='.$mobile.'&authkey='.$auth_key.'&route=4&sender='.$alphanumeric.'&message='.$message.'&country=91',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "",
		  CURLOPT_SSL_VERIFYHOST => 0,
		  CURLOPT_SSL_VERIFYPEER => 0,
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  //echo $response;

			$this->session->set_userdata('otp',$otp);
			
	        redirect('sign_up/otp_page','refresh');

		}
	}


		function otp_page()
	{
		

	    

		$this->load->view('common/header');
		$this->load->view('otp');
		$this->load->view('common/footer');
	}


	function final_create_account()
	{
		$otp1=$this->input->post('otp');

    $sendotp = $this->session->userdata('otp');
		$otp =$otp1;

		 if((int)$otp != $sendotp){

		 	$this->session->set_flashdata('err_msg','Sorry! Wrong OTP');
		 	redirect('sign_up/otp_page','refresh');
		 }
		 else
		 {
		 	$data=array(
		 		  
		 		        'user_type_id'=>$this->session->userdata('user_type_id'),
						'user_unique_id'=>$this->session->userdata('user_unique_id'),
						'first_name'=>$this->session->userdata('first_name'),
						'login_email'=>$this->session->userdata('login_email'),
						'login_pass'=>$this->session->userdata('login_pass'),
						'created_on'=>$this->session->userdata('created_on'),
						'subject_id'=>$this->session->userdata('subject_id'),
						'mobile'=>$this->session->userdata('mobile'),

		 	           );

		 	     $this->db->insert('tbl_user',$data);

		 	     $last_id=$this->db->insert_id();

		 	     $data_sess= array(
		 	     	            'user_session_id'=>$last_id,
		 	                      );
		 	     $this->session->set_userdata($data_sess);

				$this->session->set_flashdata('succs',"You have successfully create your account please Login.");
		 	    redirect($this->url->link(4), 'refresh');
	      }

    }

	function check_email()
	{

		$email = $this->input->post('email');

		$email_check=$this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('login_email'=>$email,'user_id !='=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		if(count($email_check) > 0)
		{
			$result['status']=1;
			echo json_encode(array('changedone'=>$result));
		}
		else
		{
			$result['status']=0;
			echo json_encode(array('changedone'=>$result));
		}

	}



	
	
	


	
}
?>