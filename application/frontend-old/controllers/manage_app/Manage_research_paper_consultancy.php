<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class manage_research_paper_consultancy extends CI_Controller
{
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	public function research_paper_consul_form()
	{
		
		$json    			=  file_get_contents('php://input');
		$obj     			=  json_decode($json);



		$name = $obj->name;
		$designation = $obj->designation;
		$phone_no = $obj->phone_no;
		$email = $obj->email;
		$whatsapp_no = $obj->whatsapp_no;
		$persunal_subject = $obj->persunal_subject;
		$research_subject = $obj->research_subject;
		$specialisation = $obj->specialisation;
		$m_phil = $obj->m_phil;
		$no_of_paper = $obj->no_of_paper;
		$in_word = $obj->in_word;
		$total_amount = $obj->total_amount;
		$total_amount_word = $obj->total_amount_word;
	    $created_on=date('Y-m-d');


	    $data= array(
			 'nam'=>$name,
			 'email'=>$email,
			 'phone'=>$phone_no,
			 'wp'=>$whatsapp_no,
			 'subject'=>$persunal_subject,
			 'designation'=>$designation,
			 'subject2'=>$research_subject,
			 'specialisation'=>$specialisation,
			 'mphil'=>$m_phil,
			 'nopaper'=>$no_of_paper,
			 'in_words'=>$in_word,
			 'total_amount'=>$total_amount,
			 't_amount_words'=>$total_amount_word,
			 'created_on'=>$created_on

		            );


	    	if($this->db->insert('tbl_research_paper_consul_form',$data))
	    	{
	    		$result=1;
	    	}
	    	else
	    	{
	    		$result=0;
	    	}

	    	

			echo json_encode(array('result'=>$result));
		
   
         



	}


	public function research_guideline()
	{

		$guideline=[];

		$research_guide=$this->admin_model->selectAll('tbl_research_guideline');

		foreach($research_guide as $guide)
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