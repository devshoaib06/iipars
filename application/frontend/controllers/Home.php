<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();
           $this->load->model('page_model');


	}
	
	public function index()
	{


		$counter = $this->common_model->common($table_name = 'tbl_no_of_visitor', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		$total_count= 1+$counter[0]->count;
	

	$data= array(
		     'count'=>$total_count
	            );
	$this->db->where('id','1');
	$this->db->update('tbl_no_of_visitor',$data);




	 	$data['slider'] = $this->common_model->common($table_name = 'tbl_slider', $field = array(), $where = array('slider_status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	 	$data['why_choose_us'] = $this->common_model->common($table_name = 'tbl_why_choose_us', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	 	$data['manage_home'] = $this->common_model->common($table_name = 'tbl_manage_home', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	 	$data['link'] = $this->common_model->common($table_name = 'tbl_importain_link', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	 	$data['news_feed'] = $this->common_model->common($table_name = 'tbl_news_feed', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



	 	$data['ceo'] = $this->common_model->common($table_name = 'tbl_ceo', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


	 	$data['download'] = $this->common_model->common($table_name = 'tbl_download', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		 
		 $data['active']="home";
		 $data['testimonials'] = $this->teachinns_home_model->common($table_name = 'testimonials', $field = array(), $where = array('status'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');		
		 $data['subjects']=$this->teachinns_home_model->subjects();	
		 
		 $data['book_publication_page_detl']=$this->page_model->book_publication_detl_all();
         $data['writing_consultancy_page_detl']=$this->page_model->writing_consultancy_detl_all();
		 $data['units']=$this->teachinns_home_model->units();		
	 	// echo "<pre>"; print_r($data['units']);exit;
		
		
		 $this->load->view('common/header',$data);
		$this->load->view('home',$data);
		$this->load->view('common/footer');
	}


	public function all_category()
	{
						
		$data['all_category'] = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		//echo '<pre>'; print_r($data['home_slider']); exit;
		
		$this->load->view('common/header');
		$this->load->view('all_categories',$data);
		$this->load->view('common/footer');
	}

	public function all_brand()
	{
				

		
		$data['all_brand'] = $this->common_model->common($table_name = 'tbl_brand', $field = array(), $where = array('status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		//echo '<pre>'; print_r($data['home_slider']); exit;
		
		$this->load->view('common/header');
		$this->load->view('all_brand',$data);
		$this->load->view('common/footer');
	}

	public function todays_deal()
	{
				

		
		$data['todays_deal'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('status'=>'Active','todays_deal'=>'Y'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		//echo '<pre>'; print_r($data['home_slider']); exit;
		
		$this->load->view('common/header');
		$this->load->view('today_deal',$data);
		$this->load->view('common/footer');
	}



	public function contact_submit()
	{
		

		// $data['site_address_list'] = $this->common_model->common($table_name = 'tbl_site_address', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

$user_name=$this->input->post('username');
$email=$this->input->post('email');
$phone=$this->input->post('phone');
$subject=$this->input->post('subject');
$contact_msg=$this->input->post('message');

if($user_name=='' || $email=='' || $phone=='' || $subject=='' || $contact_msg=='')
{
	$this->session->set_flashdata('msg','Please fill up all field properly');
    redirect(base_url(),"refresh");
}


$email_list=$this->common_model->common($table_name = 'tbl_email', $field = array(), $where = array('email_id'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


  $admin_from=$email_list[0]->from_email;
  $admin_recive=$email_list[0]->recieve_email;

//echo $admin_from; 
//echo $admin_recive; exit;
// bathdecore@gmail.com




		$email_data['mail_data']=array
              (
                  'uname'=>$user_name,
                  'uemail'=> $email,
                  'uphone'=> $phone,
                  'subject'=> $subject,
                  'umsg'=>$contact_msg
              );


        //print_r($email_data); exit;



         $this->email->set_mailtype("html");

              $html_email_user = $this->load->view('mail_template/admin_offer_mail',$email_data, true);
              $send_user_mail_html=$this->load->view('mail_template/offer_mail_view',$email_data, true);

            // print_r($html_email_user);exit;
            // print_r( $send_user_mail_html);exit;
               
              $this->email->from($admin_from,'Naturecampretreat');
              $this->email->to($admin_recive);
              $this->email->subject('Get The Best Offers - Naturecampretreat');
              $this->email->message($html_email_user);
              @$response=$this->email->send();

              $this->email->from($admin_from,'Naturecampretreat');
              $this->email->to($email);
              $this->email->subject('Your enquiry mail submited - Naturecampretreat');
              $this->email->message($send_user_mail_html);
              @$reponse_reply=$this->email->send();

              

               $this->session->set_flashdata('msg','Mail successfully sent.. ');
            

              

            redirect(base_url(),"refresh");
	       }
	
	
	
	
	public function landingpage()
	{
	   
		$counter = $this->common_model->common($table_name = 'tbl_no_of_visitor', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		$total_count= 1+$counter[0]->count;
	

	$data= array(
		     'count'=>$total_count
	            );
	$this->db->where('id','1');
	$this->db->update('tbl_no_of_visitor',$data);




	 	$data['slider'] = $this->common_model->common($table_name = 'tbl_slider', $field = array(), $where = array('slider_status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	 	$data['why_choose_us'] = $this->common_model->common($table_name = 'tbl_why_choose_us', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	 	$data['manage_home'] = $this->common_model->common($table_name = 'tbl_manage_home', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	 	$data['link'] = $this->common_model->common($table_name = 'tbl_importain_link', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	 	$data['news_feed'] = $this->common_model->common($table_name = 'tbl_news_feed', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



	 	$data['ceo'] = $this->common_model->common($table_name = 'tbl_ceo', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


	 	$data['download'] = $this->common_model->common($table_name = 'tbl_download', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	 	// echo "<pre>"; print_r($data['manage_home']);exit;

		 $data['active']="landing-page";



		
		 $this->load->view('common/header',$data);
		$this->load->view('landing-page',$data);
		$this->load->view('common/footer');
     /* $this->load->view('landing-page');*/
      
	}
	


	
}
