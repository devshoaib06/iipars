<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class manage_phd_thesis_cons extends CI_Controller
{
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	public function phd_consul_form()
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
		$short_description = $obj->description;
	    $created_on=date('Y-m-d');


	$data= array(
    		     'nam'=>$nam,
    		     'email'=>$email,
    		     'phone'=>$phone,
    		     'wp'=>$wp,
    		     'subject'=>$subject,
                 'designation'=>$designation,
                 'address'=>$address,
                 'thesis_title'=>$thesis_title,
    		     'short_description'=>$short_description,
    		     'created_on'=>$created_on
    	             );


    	if($this->db->insert('tbl_phd_thesis_form',$data))
    	{
    		$result=1;
    	}
    	else
    	{
    		$result=0;
    	}
	    	

	    	

		echo json_encode(array('result'=>$result));
		
   
         



	}


	public function phd_guideline()
	{

		$guideline=[];

		$phd_guidelines=$this->admin_model->selectAll('tbl_phd_thesis_guideline');

		foreach($phd_guidelines as $guide)
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