<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_contact extends CI_Controller {
public function __construct()
{
	parent::__construct();
	$this->load->database();
	$this->load->library('session');
	 
	$this->load->helper('url');
	$this->load->helper('form');
	$this->load->library('form_validation');
	$this->load->library('email');			
	$this->load->library('image_lib');
	// $this->load->model('common/common_model');		
		
}
public function index()
{
	
		if($this->session->userdata('hs_admin_id')=="")
      {
      	redirect('index.php/admin_login');
      }
		$data['active']="contact";
		$user['contact']=$this->admin_model->selectAll('tbl_contact');

		
       	


       	$this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('contact/contact_view',$user);
        $this->load->view('common/footer');
	
}
public function contact_update()
{

		if($this->session->userdata('hs_admin_id')=="")
      {
      	redirect('index.php/admin_login');
      }

	// $organization=$this->input->post('organization');

	// $parent_organization=$this->input->post('parent_organization');
	$full_address=$this->input->post('full_address');
	$contact_no=$this->input->post('contact_no');
	 // $help_line_no=$this->input->post('help_line_no');

// $google_map_link=$this->input->post('map_link');
	$primary_email=$this->input->post('primary_email');
	// $secondary_email=$this->input->post('secondary_email');	
	$contact_id=$this->input->post('contact_id');
		$edited_date=date('Y-m-d H-i-s');
    
	$data_update=array(
		                 // 'organization'=>$organization,
		                 // 'parent_organaization'=>$parent_organization,
		               'full_address'=>$full_address,
		                'contact_no'=>$contact_no,
		                // 'help_line_no'=>$help_line_no,
		                // 'map_link'=>$google_map_link,
		                'primary_email'=>$primary_email,
		                
		                'edited_date'=>$edited_date);
	$this->db->where('contact_id',$contact_id);
	$this->db->update('tbl_contact',$data_update);
	$this->session->set_flashdata('succ_msg','Contact Details updated successfully');
	 redirect('admin_contact/','refresh');
}



function contact_query()
{
		$data['active']="contact";
      
		$user['contact_query']=$this->admin_model->selectAll('tbl_contact_form');
         


	    $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('contact/contact_query',$user);
        $this->load->view('common/footer');
}



function export_csv_ebook_list()
  {
    // $enquiry_id=$this->uri->segment('3');
      header("Content-type: text/csv");

          header("Content-Disposition: attachment; filename=Query for Contact.csv");

          $marks_details= $this->common->select($table_name='tbl_contact_form',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
// echo "<pre>";print_r($marks_details);die;
          $output = fopen('php://output', 'w');

          fputcsv($output, array('Sl No.','Name','Phone','Email Id','Subject','Message'));

          $count=1;

          foreach($marks_details as $row)

          {
            
                fputcsv($output, array(

                    "Sl No" => $count,
                    'Name'=>@$row->name,
                    
                    'Phone'=>@$row->phone,
                    'Email Id'=>@$row->email,
                   
                    
                    'Subject'=>@$row->subject,
                    
                    'Message'=>@$row->message
                   
                ));

            
                $count++;


          }
         //  $this->session->set_flashdata('msg','Data  Has Been Exported !');
         // redirect(base_url().'index.php/manage_student_entry');
  }



    function delete()
    {
        $del_id=$this->uri->segment(3);
        
       $this->db->where('id',$del_id);
       $this->db->delete('tbl_contact_form');            
       $this->session->set_flashdata('succ_msg','deleted successfully');
            
            
    redirect('admin_contact/contact_query','refresh');
    }


    function single_line_header()
    {

      $data['header_title']= $this->common->select($table_name='tbl_single_line_header',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());


        $this->load->view('common/header');
        $this->load->view('common/leftmenu');
        $this->load->view('single_line_header',$data);
        $this->load->view('common/footer');
    }

    function single_line_update()
    {
      $title= $this->input->post('title');

      $data=array(
           'title'=>$title
                 );
      $this->db->where('id',1);
      $this->db->update('tbl_single_line_header',$data);


       $this->session->set_flashdata('succ_msg','Updated successfully');

      redirect('admin_contact/single_line_header','refresh');
    }




}



