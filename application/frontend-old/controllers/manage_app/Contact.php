<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class contact extends CI_Controller
{
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	public function details()
	{
		$contact_details=[];
		

		$contact=$this->admin_model->selectAll('tbl_contact');

		foreach($contact as $row_contact)
		{
			
			$conArr['contact_no']= $row_contact->contact_no;
			$address=strip_tags($row_contact->full_address);
			$conArr['full_address']= $address;
			$conArr['primary_email']= $row_contact->primary_email;

			array_push($contact_details,$conArr);

		}

		// print_r($all_news_feed);
	

 	echo json_encode(array('contact_details'=>$contact_details));
         



	}

	public function contact_form()
	{
		$json =  file_get_contents('php://input');
		$obj  =  json_decode($json);


		$nam = $obj->name;
		$email = $obj->email;
		$subject = $obj->subject;
		$phone = $obj->phone_no;
		$form_message = $obj->massage;


			$data= array(
			  'name'=>$nam,
			  'email'=>$email,
			  'subject'=>$subject,
			  'phone'=>$phone,
			  'message'=>$form_message,
			  'created_on'=>date('Y-m-d')
		            );

			if($this->db->insert('tbl_contact_form',$data))
			{
				$result=1;
			}
			else
			{
				$result=0;
			}
			
            echo json_encode(array('result'=>$result));
       

	}
}



 ?>