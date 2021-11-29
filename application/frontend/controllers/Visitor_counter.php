<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Visitor_counter extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}




	Function Show_article($slug){
// here you put your query to select the article 
//by slug or whatever by id
//then call the counter function  and pass the slug or the 
//id for the counter function
$this->add_count($slug);
}
 

// This is the counter function.. 
function add_count($slug)
{
// load cookie helper
    $this->load->helper('cookie');
// this line will return the cookie which has slug name
  $check_visitor = $this->input->cookie(urldecode($slug), FALSE);
// this line will return the visitor ip address
    $ip = $this->input->ip_address();
// if the visitor visit this article for first time then //
 //set new cookie and update article_views column  ..
//you might be notice we used slug for cookie name and ip 
//address for value to distinguish between articles  views
    if ($check_visitor == false) {
        $cookie = array(
            "name"   => urldecode($slug),
            "value"  => "$ip",
            "expire" =>  time() + 7200,
            "secure" => false
        );
        $this->input->set_cookie($cookie);
        $this->common->update_counter(urldecode($slug));
    }
}



	
	public function index()
	{


	


		
		 $this->load->view('common/header');
		$this->load->view('invitation_for_ebook_view');
		$this->load->view('common/footer');
	}

	function invite_for_ebook_submit()
	{

		// echo 'hi';
    	$nam=$this->input->post('nam');
        $designation=$this->input->post('designation');
        $phone=$this->input->post('phone');
        $email=$this->input->post('email');
        $wp=$this->input->post('wp');
        $address=$this->input->post('address');
    	$subject=$this->input->post('subject');
    	$book_title=$this->input->post('book_title');  
    	$short_description=$this->input->post('short_description');

    


    	$data= array(
    		     'nam'=>$nam,
    		     'email'=>$email,
    		     'phone'=>$phone,
    		     'wp'=>$wp,
    		     'subject'=>$subject,
                 'designation'=>$designation,
                 'address'=>$address,
                 'book_title'=>$book_title,
    		     'short_description'=>$short_description,
    		     'created_on'=>date('Y-m-d')
    	             );


    	$this->db->insert('tbl_invite_for_ebook',$data);
    	$this->session->set_flashdata('succ_msg','Submitted successfully');
    	redirect('Manage_ebook','refresh');


    	
		
	}

	public function purchase_your_ebook()
	{


	


		
		 $this->load->view('common/header');
		$this->load->view('purchase_your_ebook_view');
		$this->load->view('common/footer');
	}

	

	



	
	
	


	
}
?>