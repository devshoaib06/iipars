<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sign_up extends CI_Controller
{
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	public function get_subject_name()
	{
		$subject_name_details=[];
		

		$subject = $this->common_model->common($table_name = 'tbl_kpo', $field = array(), $where = array('status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		foreach($subject as $row_subject)
		{
			
			$subArr['kpo_id']= $row_subject->kpo_id;
			$subArr['kpo_name']= $row_subject->kpo_name;
			

			array_push($subject_name_details,$subArr);

		}

		// print_r($all_news_feed);
	

 	echo json_encode(array('subject_name_details'=>$subject_name_details));
         



	}

	function otp_verify()
	{
		$json         =  file_get_contents('php://input');
	    $obj          =  json_decode($json);
	    $otp            =  $obj->otp;
	    $mobile_number  =  $obj->mobile_number;
	    $email  =  $obj->email;


	 //    $email_check=$this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('login_email'=>$email,'user_id !='=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		// $phone_check=$this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('mobile'=>$mobile_number,'user_id !='=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$email_check=$this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('login_email'=>$email), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$mobile_check=$this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('mobile'=>$mobile_number), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		if(count($email_check) > 0)
		{
			$result=3;

			echo json_encode($result);
			
		}
		else if(count($mobile_check) > 0)
		{
			$result=2;
			echo json_encode($result);
		}
		else
		{
			$curl = curl_init();
		// $mobile=$mobile;

		$auth_key = '258941A8mZuDen35c518aac';
		$alphanumeric = 'AGNISK';
		// $otp = rand(100000,999999);
		$message = str_replace(" ","%20","Greetings from IIPARS! Your mobile verification OTP is ".$otp);

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.msg91.com/api/sendhttp.php?mobiles='.$mobile_number.'&authkey='.$auth_key.'&route=4&sender='.$alphanumeric.'&message='.$message.'&country=91',
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
		}


		$result=1;

		echo json_encode($result);

		}

	}

	public function create_account()
	{
		$json =  file_get_contents('php://input');
		$obj  =  json_decode($json);


		$full_name = $obj->full_name;
		$email = $obj->email;
		$mobile = $obj->ph_no;
		$password = $obj->confirm_password;
		$confirm_pass = $obj->confirm_password;
		$subject = $obj->subject_name;
		$created_on=date('Y-m-d H:i:s');

		$code= mt_rand(100000, 999999);
		$user_type_id="ST".$code;

		
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

			 if($this->db->insert('tbl_user',$data))
			 {
			 	$result=1;
			 }
			 else
			 {
			 	$result=0;
			 }
			
            echo json_encode($result);
		
		


		     
       

	}


	public function login_action()
	{
		$json =  file_get_contents('php://input');
		$obj  =  json_decode($json);


		$email = $obj->phone_number;
		$password = $obj->password;

		$login_check_email=  $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('login_email'=>$email,'login_pass'=>$password,'status'=>'active','user_type_id'=>'2'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		$login_check_mobile=  $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('mobile'=>$email,'login_pass'=>$password,'status'=>'active','user_type_id'=>'2'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		if(count($login_check_email)>0)
		{
					 $result=1;
					 $user_id= $login_check_email[0]->user_id;
					  $user_fname= $login_check_email[0]->first_name;
					   $mobile= $login_check_email[0]->mobile;
					    $login_email= $login_check_email[0]->login_email;

                     echo json_encode(array('result'=>$result,'user_id'=>$user_id,'user_fname'=>$user_fname,'mobile'=>$mobile,'login_email'=>$login_email));


		}
		else if(count($login_check_mobile)>0){

					$result=1;
					 $user_id= $login_check_mobile[0]->user_id;
					  $user_fname= $login_check_mobile[0]->first_name;
					   $mobile= $login_check_mobile[0]->mobile;
					    $login_email= $login_check_mobile[0]->login_email;

                     echo json_encode(array('result'=>$result,'user_id'=>$user_id,'user_fname'=>$user_fname,'mobile'=>$mobile,'login_email'=>$login_email));
		}
		else{

					$result=0;
					 $user_id='';
					  $user_fname= '';
					   $mobile= '';
					    $login_email= '';

                     echo json_encode(array('result'=>$result,'user_id'=>$user_id,'user_fname'=>$user_fname,'mobile'=>$mobile,'login_email'=>$login_email));
		}
	}

	public function get_my_profile_details()
	{
		$json =  file_get_contents('php://input');
		$obj  =  json_decode($json);


		$user_id = $obj->user_id;

		$get_profile_details= $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$profile_details_array=array();
		foreach($get_profile_details as $row){

			$rowArray['first_name']= $row->first_name;
			$rowArray['user_unique_id']= $row->user_unique_id;
			$rowArray['mobile']= $row->mobile;
			$rowArray['login_email']= $row->login_email;
			$rowArray['created_on']= $row->created_on;
			$rowArray['subject_id']= $row->subject_id;
			$rowArray['address']= $row->address;

			array_push($profile_details_array, $rowArray);




		}
		echo json_encode(array('profile_details_array'=>$profile_details_array));
	}


	function update_profile_details(){

		$json =  file_get_contents('php://input');
		$obj  =  json_decode($json);


		$user_id = $obj->user_id;
		$user_name = $obj->user_name;
		$user_id = $obj->user_id;
		$email = $obj->email;
		$phone_number = $obj->phone_number;
		$address = $obj->address;

		$update_data= array(
							'first_name'=>$user_name,
							'mobile'=>$phone_number,
							'login_email'=>$email,
							'address'=>$address
						);

		$this->db->where('user_id',$user_id);
		$this->db->update(' tbl_user', $update_data);

		echo json_encode(array('result'=>1));

	}
	function update_password_action()
	{

		$json =  file_get_contents('php://input');
		$obj  =  json_decode($json);


		$user_id = $obj->user_id;
		$old_password = $obj->old_password;
		$new_passwprd = $obj->new_passwprd;
		$confirm_password = $obj->confirm_password;

		$check_old_password= $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('login_pass'=>$old_password,'user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		if(count($check_old_password)>0){
					if($old_password==$new_passwprd){
						$result=2;
						}
					else{
						$update_array=array(
											'login_pass'=>$new_passwprd
										);
						$this->db->where('user_id', $user_id);
						$this->db->update('tbl_user', $update_array);
						$result=1;
					}
		}
		else{
			$result=0;

		}

		echo  json_encode(array('result'=>$result));
	}
}



 ?>