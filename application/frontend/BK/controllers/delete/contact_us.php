<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class contact_us extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	public function index()
	{
		 $data['contact']=$this->common_model->common($table_name = 'tbl_contact', $field = array(), $where = array('contact_id'=>1), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
	    $this->load->view('common/header');
		$this->load->view('contactus',$data);
		$this->load->view('common/footer');

	}

	 function contactus_mail_submit()
	 {
           
	 	 $at=0;
        $dt=0;
       $name=$this->input->post('name');
       $email=$this->input->post('email');

       $phone=$this->input->post('phone');
       //$phn_no=$this->input->post('phn_no');
       $msg=$this->input->post('message');
//echo $name.$email.$phone.$msg;exit;
        $len=strlen($email);
        for($i=0;$i<$len;$i++)
        {
            if($email[$i]=="@")
            {
                $at=$i;
            }
            if($email[$i]==".")
            {
                $dt=$i;
            }
        }

        if($name=="" || $email=="" || $phone=="" || $msg==""  || $at < 1 || $dt < $at + 2 || $dt + 2 >= $len)
        {
            $this->session->set_flashdata('msg','please insert all fields properly..!');
            redirect(base_url().$this->url->slug(13));
        }
        else 
        {
             $data['email']=$this->common_model->common($table_name = 'tblemail', $field = array(), $where = array('email_id'=>1), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
            $admin_recive=$data['email'][0]->recieve_email;
            $admin_from=$data['email'][0]->from_email;
            //$admin_from='rahul.exprolab@gmail.com';
        
            $email_data['mail_data']=array
            (
                'uname'=>$name,
                'uemail'=> $email,
                'uphone'=> $phone,
                'umsg'=>$msg
            );

            $this->email->set_mailtype("html");

            $html_email_user = $this->load->view('mail_template/admin_enquiry_contact_mail',$email_data, true);
            $send_user_mail_html=$this->load->view('mail_template/contact_reply_mail_view',$email_data, true);

            //print_r($html_email_user );exit;

            $this->email->from($admin_from);
            $this->email->to($admin_recive);
            $this->email->subject('Contact us enquirymail from AKD Ecommerce');
            $this->email->message($html_email_user);
            @$reponse=$this->email->send();

            $this->email->from($admin_from);
            $this->email->to($email);
            $this->email->subject('Reply from AKD Ecommerce');
            $this->email->message($send_user_mail_html);
            @$reponse_reply=$this->email->send();

            if(@$reponse && @$reponse_reply)
            {
                $this->session->set_flashdata('msg','You enquiry has been submitted successfully');
            }
            else
            {
                $this->session->set_flashdata('msg','You enquiry has not been submitted successfully..!');
            }
             redirect(base_url().$this->url->slug(13));

        }
    }

}
?>