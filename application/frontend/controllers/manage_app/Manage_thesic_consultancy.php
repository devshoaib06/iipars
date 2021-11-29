<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class manage_thesic_consultancy extends CI_Controller
{
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	public function thesis_consul_form()
	{
		
		$json    			=  file_get_contents('php://input');
		$obj     			=  json_decode($json);



		$nam = $obj->name;
		$designation = $obj->designation;
		$phone = $obj->phone_no;
		$email = $obj->email;
		$wp = $obj->whatsapp_no;
		$address = $obj->address;
		$subject = $obj->subject;
		$thesis_title = $obj->thesis_title;
		$chapter1 = $obj->chapter1;
		$chapter2 = $obj->chapter2;
		$chapter3 = $obj->chapter3;
		$chapter4 = $obj->chapter4;
		$chapter5 = $obj->chapter5;
		$chapter6 = $obj->chapter6;
		$chapter7 = $obj->chapter7;
	    $created_on=date('Y-m-d');


	$data= array(
			   'nam'=>$nam,
			   'designation'=>$designation,
			   'phone'=>$phone,
			   'email'=>$email,
			   'wp'=>$wp,
			   'address'=>$address,
			   'subject'=>$subject,
			   'thesis_title'=>$thesis_title,
			   'chapter1'=>$chapter1,
			   'chapter2'=>$chapter2,
			   'chapter3'=>$chapter3,
			   'chapter4'=>$chapter4,
			   'chapter5'=>$chapter5,
			   'chapter6'=>$chapter6,
			   'chapter7'=>$chapter7,
			   'created_on'=>$created_on
		             );


		if($this->db->insert('tbl_thesis_cons_form',$data))
		{
			$result=1;
		}
		else
		{
			$result=0;
		}
	    	

	    	

			echo json_encode(array('result'=>$result));
		
   
         



	}


	public function dissertation_guideline()
	{

		$guideline=[];

		$dissertation_guide=$this->admin_model->selectAll('tbl_disertation_guideline');

		foreach($dissertation_guide as $guide)
		{
			$guideArr['video_link']= $guide->video_link;
			$guideArr['title']= $guide->title;
			$description=strip_tags($guide->description);
			$guideArr['description']= $description;
			

			array_push($guideline,$guideArr);

		}

    echo json_encode(array('guideline'=>$guideline));


	}




	
}



 ?>