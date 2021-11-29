<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class plan extends CI_Controller
{
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	public function plan_data()
	{
		$plan_data=[];

		$package_details=  $this->common_model->common($table_name = 'tbl_package', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		foreach($package_details as $type)
		{
			

			$packageArr['package_name']= $type->package_name;
			$packageArr['price']= $type->price;
			$packageArr['package_type']= $type->package_type;
			$packageArr['description']= $type->description;
			
			array_push($plan_data,$packageArr);


		}

 	echo json_encode(array('plan_data'=>$plan_data));

		



	}


	public function checkout()
	{
		$user_details=[];
		$state_details=[];
		$package_detail=[];

		 $user_details=  $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		 $userArr['first_name']= $user_details[0]->first_name;
		 $userArr['last_name']= $user_details[0]->last_name;
		 $userArr['login_email']= $user_details[0]->login_email;
		 $userArr['address']= $user_details[0]->address;
		 $userArr['city']= $user_details[0]->city;
		 $userArr['zip_postal_code']= $user_details[0]->zip_postal_code;
		 $userArr['state_id']= $user_details[0]->state_id;

		 array_push($user_details,$userArr);


		 $state=  $this->common_model->common($table_name = 'state3', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		 $stateArr['id']= $state[0]->id;
		 $stateArr['name']= $state[0]->name;

		 array_push($state_details, $stateArr);


		 $package=  $this->common_model->common($table_name = 'tbl_package', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		 $pArray['package_name']= $package[0]->package_name;
		 $pArray['price']= $package[0]->price;

		 array_push($package_detail, $pArray);



 	echo json_encode(array('user_details'=>$user_details,'state_details'=>$state_details,'package_detail'=>$package_detail));

	}

	public function make_payment_package()
	{
		$json =  file_get_contents('php://input');
		$obj  =  json_decode($json);


		$user_id = $obj->user_id;
		$plan_id = $obj->plan_id;



			 $package=  $this->common_model->common($table_name = 'tbl_package', $field = array(), $where = array('id'=>$plan_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		 $package_type= @$package[0]->package_type;

		 // print_r($expiry_date);
		 // echo $expiry_date;

		 if($package_type=='Month')
		 {
		 	$expiry_date= date('Y-m-d', strtotime("+30 days"));
		 }
		 elseif ($package_type=='Half Year') {
		 	$expiry_date= date('Y-m-d', strtotime("+180 days"));
		 }
		 else
		 {
		 	$expiry_date= date('Y-m-d', strtotime("+365 days"));
		 }



		 $data= array(
		 	     'user_id'=>$user_id,
		 	     'package_id'=>$plan_id,
		 	     'expiry_date'=>$expiry_date,
		             );

		 $this->db->insert('tbl_user_package_plan',$data)
		
		 	$result=1;
		 

		 echo json_encode(array('result'=>$result));
		
	}
}



 ?>