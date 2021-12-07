<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class about_us extends CI_Controller
{
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	


	public function about_us_details()
	{
		$about_us_details=[];

		$about_us=  $this->common_model->common($table_name = 'tbl_manage_home', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$aboutArr['description1']= @$about_us[0]->description;

		$aboutArr['description2']= @$about_us[1]->description;
		$aboutArr['image2']= base_url().'assets/upload/manage_home/'. @$about_us[1]->image;

		$aboutArr['image3']= base_url().'assets/upload/manage_home/'. @$about_us[2]->image;
		$aboutArr['description3']= @$about_us[2]->description;

		array_push($about_us_details,$aboutArr);

// print_r($about_us_details);

		

 	echo json_encode(array('about_us_details'=>$about_us_details));

	}
}



 ?>