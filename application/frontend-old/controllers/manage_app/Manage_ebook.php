<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class manage_ebook extends CI_Controller
{
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	public function invitation_for_ebook_form()
	{
		
		$json    			=  file_get_contents('php://input');
		$obj     			=  json_decode($json);



		$name = $obj->name;
		$designation = $obj->designation;
		$phone_no = $obj->phone_no;
		$email = $obj->email;
		$whatsapp_no = $obj->whatsapp_no;
		$address = $obj->address;
		$subject = $obj->subject;
		$book_title = $obj->book_title;
		$description = $obj->description;
	    $created_on=date('Y-m-d');


	    	$data= array(
    		     'nam'=>$name,
    		     'email'=>$email,
    		     'phone'=>$phone_no,
    		     'wp'=>$whatsapp_no,
    		     'subject'=>$subject,
                 'designation'=>$designation,
                 'address'=>$address,
                 'book_title'=>$book_title,
    		     'short_description'=>$description,
    		     'created_on'=>$created_on
    	             );


	    	if($this->db->insert('tbl_invite_for_ebook',$data))
	    	{
	    		$result=1;
	    	}
	    	else
	    	{
	    		$result=0;
	    	}

	    	

			echo json_encode(array('result'=>$result));
		
   
         



	}


	public function purchase_your_book()
	{

		$purchase_ebook=[];

		$ebook_list=$this->admin_model->selectAll('tbl_ebook');

		foreach($ebook_list as $book)
		{
			$ebookArr['id']= $book->id;
			$ebookArr['title']= $book->title;
			$ebookArr['image']=base_url().'assets/upload/ebook/resize/'.$book->image;

			// http://192.168.1.248/iipars/site/assets/upload/ebook/resize/015271400_1607602431.jpg

			array_push($purchase_ebook,$ebookArr);

		}

    echo json_encode(array('purchase_ebook'=>$purchase_ebook));


	}


	public function buy_now()
	{
		$json    			=  file_get_contents('php://input');
		$obj     			=  json_decode($json);
        $ebook_id			=$obj->ebook_id;
        $user_id			=$obj->user_id;

		    $data=array(
			     'ebook_id'=>$ebook_id,
			     'user_id'=>$user_id,
			     'purchase_date'=>date('Y-m-d'),
		            );

              if($this->db->insert('tbl_ebook_purchase',$data))
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