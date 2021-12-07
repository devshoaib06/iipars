<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class service_package extends CI_Controller
{
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	public function service_package_data()
	{
		$services_package=[];

		$service_type=  $this->common_model->common($table_name = 'tbl_examination_type', $field = array(), $where = array('status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		foreach($service_type as $type)
		{
			$service=  $this->common_model->common($table_name = 'tbl_examination', $field = array(), $where = array('examination_type_id'=>$type->examination_type_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
			$service_array=[];

			foreach($service as $ser)
			{

				$serviceArr['service_name']= $ser->examination_name;

				array_push($service_array,$serviceArr);
			}

			$ser_typArr['type_name']= $type->examination_type;
			$ser_typArr['service_array']= $service_array;
			array_push($services_package,$ser_typArr);


		}

 	echo json_encode(array('services_package'=>$services_package));

		



	}

	public function get_sub_service()
	{
		$json         =  file_get_contents('php://input');
	    $obj          =  json_decode($json);

	    $service_id    =  $obj->service_id;

	    $service_details=[];

	     $got_service=  $this->common_model->common($table_name = 'tbl_examination', $field = array(), $where = array('examination_type_id'=>$service_id,'status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	     foreach($got_service as $service)
	     {
	     	$servicearr['id']= $service->examination_id ;
	     	$servicearr['slug']=$service->slug;
	     	$servicearr['title']=$service->examination_name;

	     	array_push($service_details,$servicearr);
	     }

	     echo json_encode(array('service_details'=>$service_details));
	   

	}


	public function subject_list()
	{

		$json         =  file_get_contents('php://input');
	    $obj          =  json_decode($json);

	    $user_id    =  $obj->user_id;

	    $subject_details=[];

		 if($user_id!='')
		 {
		 	$user_sub=  $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		 	$sub_id= @$user_sub[0]->subject_id;

		 	$get_subject_details=  $this->common_model->common($table_name = 'tbl_kpo', $field = array(), $where = array('kpo_id'=>$sub_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		 }
		 else
		 {
		 	$get_subject_details=  $this->common_model->common($table_name = 'tbl_kpo', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		 }

		 
		foreach($get_subject_details as $sub)
		{
			$subArr['id']= $sub->kpo_id;
			$subArr['sub_name']= $sub->kpo_name;
			$subArr['image']= base_url().'assets/upload/subject_image/'.$sub->subject_image;

			array_push($subject_details, $subArr);
		}

 	echo json_encode(array('subject_details'=>$subject_details));

	}


	function get_institute_details()
	{


		$university_details=  $this->common_model->common($table_name = 'tbl_cc', $field = array(), $where = array('status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		echo json_encode(array('institute_details'=>$university_details));

	}

	function get_university_name()
	{
		$json         =  file_get_contents('php://input');
	    $obj          =  json_decode($json);

	    $cc_id    =  $obj->university_id;
	    $subject_id    =  $obj->subject_id;
	    $service_sub_id    =  $obj->service_sub_id;

	    $serviceprovider_name=[];

	    $university_details=  $this->common_model->common($table_name = 'tbl_cc', $field = array(), $where = array('cc_id'=>$cc_id,'status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



	  $this->db->select("*");
      $this->db->from('tbl_form');
      $this->db->join('tbl_university','tbl_university.university_id=tbl_form.university_id	');
      
      $this->db->where('tbl_form.service_id',$service_sub_id);
      $this->db->where('tbl_form.subject_id',$subject_id);
      $this->db->where('tbl_university.university_type',$cc_id);
      $query = $this->db->get();
      $service_provider= $query->result();

      foreach($service_provider as $service)
      {
      	$serviceproarr['id']=$service->form_id;
      	$serviceproarr['title']=$service->title;

      	array_push($serviceprovider_name, $serviceproarr);

      }



	    echo json_encode(array('unversity_name'=>$university_details,'serviceprovider_name'=>$serviceprovider_name));
	}

	function get_all_details()
	{
		$json         =  file_get_contents('php://input');
	    $obj          =  json_decode($json);

	    $form_id    =  $obj->form_id;

	    $form_details = $this->common->select($table_name='tbl_form',$field=array(), $where=array('form_id'=>$form_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

	    $service_type=$this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$form_details[0]->service_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

	    $subject= $form_details[0]->subject_id;

             $subject_details = $this->common->select($table_name='tbl_kpo',$field=array(), $where=array('kpo_id '=>$subject), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

             $uni_type=$this->common->select($table_name='tbl_university',$field=array(), $where=array('university_id'=>$form_details[0]->university_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

	   echo json_encode(array('form_details'=>$form_details,'service_type'=>$service_type,'subject_details'=>$subject_details,'uni_type'=>$uni_type)); 
	}
}






 ?>