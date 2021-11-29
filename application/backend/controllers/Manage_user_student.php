<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_user_student extends CI_Controller 
{
	 
	  public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('upload');
        $this->load->library('session');
        $this->load->model('admin_model');
        $this->load->model('common');
        $this->load->model('url_slug_model');
	    $this->load->model('page_model');
		$this->load->library('image_lib');
        $this->load->helper('text');
		$this->session_check_and_session_data->session_check();
		
    }
	
	public function index()
	{

		if($this->session->userdata('hs_admin_id')=="")
      {
      	redirect('index.php/admin_login');
      }
        $data['active']="Manage_user_student";

        $data['user_details']= $this->common->select($table_name='tbl_user',$field=array(),$where=array('user_type_id'=>'2'),$where_or=array(),$like=array(),$like_or=array(),$order=array('user_id'=>'DESC'),$start='',$end='',$where_in_array=array());

		$this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('manage_user_student',$data);
        $this->load->view('common/footer');
		
	
	}



      function export_csv_ebook_list()
  {
    // $enquiry_id=$this->uri->segment('3');
      header("Content-type: text/csv");

          header("Content-Disposition: attachment; filename=User List.csv");

          $user_details= $this->common->select($table_name='tbl_user',$field=array(),$where=array('user_type_id'=>'2'),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
// echo "<pre>";print_r($marks_details);die;
          $output = fopen('php://output', 'w');

          fputcsv($output, array('Sl No.','Name','Unique Id','Email','Mobile','Subject','Added On'));

          $count=1;

          foreach($user_details as $row)

          {

            $subject= $this->common->select($table_name='tbl_kpo',$field=array(),$where=array('kpo_id'=>$row->subject_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
            
                fputcsv($output, array(

                    "Sl No" => $count,
                    'Name'=>@$row->first_name.' '.$row->last_name,
                    'Unique Id'=>@$row->user_unique_id,
                    'Email'=>@$row->login_email,
                    'Mobile'=>@$row->mobile,
                    'Subject'=>@$subject[0]->kpo_name,
                    'Added On'=>@$row->created_on,
                    
                   
                ));

            
                $count++;


          }
         //  $this->session->set_flashdata('msg','Data  Has Been Exported !');
         // redirect(base_url().'index.php/manage_student_entry');
  }



    function delete()
    {
        $del_id=$this->uri->segment(3);
        
       $this->db->where('user_id',$del_id);
       $this->db->delete('tbl_user');            
       $this->session->set_flashdata('succ_msg','deleted successfully');
            
            
    redirect('Manage_user_student','refresh');
    }



	function add_data()
	{
		if($this->session->userdata('hs_admin_id')!='')
		{
			$user_id= $this->session->userdata('hs_admin_id');
		}
		else{
			redirect('index.php/admin_login','refresh');
		}
        $data['active']="manage_home";

		$this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
		$this->load->view('manage_home_add');
        $this->load->view('common/footer');
          
	}
	
	 function insert()
    {
    	
    	$first_title=$this->input->post('first_title');
        $content_details=$this->input->post('content_details');
        
       	$current_date=date('Y-m-d');
       	$id=$this->session->userdata('hs_admin_id');


    	if($_FILES['image']['name']==NULL)

         {
             $image=NULL;
         }
        else
        {
            $new_name1 = str_replace(".", "", microtime());
            $new_name = str_replace(" ", "_", $new_name1);
            $file_tmp = $_FILES['image']['tmp_name'];
            $file = $_FILES['image']['name'];
            $ext = substr(strrchr($file, '.'), 1);
            if ($ext == "png" || $ext == "gif" || $ext == "jpg" || $ext == "jpeg")
            {
               
              
              

                move_uploaded_file($file_tmp, "../assets/upload/manage_home/" . $new_name . "." . $ext);
                $image = $new_name . "." . $ext;

                $config['image_library'] = 'gd2';
                $config['source_image'] = '../assets/upload/manage_home/' . $image;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = "100%";
               
    
                // $config['create_thumb'] = FALSE;
                // $config['maintain_ratio'] = FALSE;
                // $config['new_image'] = '../assets/upload/slider/small/' .$image;
                // $config['quality'] = "100%";
                // $config['width'] = 1920;
                // $config['height']= 550;
                // $config['master_dim'] ="height" ;

               $this->image_lib->initialize($config);
               $this->image_lib->resize(); 
               $this->image_lib->clear();
                      
            
            }
            else
            {
                $this->session->set_flashdata('image_error','please upload an image..!');
                redirect(base_url().'index.php/manage_home');
            }
        }
    	$data = array(
    					
    					
                        'title'=>$first_title,
    					'description'=>$content_details,
                        'image'=>$image,
    					'created_date'=>$current_date,
                        'created_by'=>$id   					
    				);
    	
    	$this->db->insert('tbl_manage_home',$data);
    	$this->session->set_flashdata('succ_msg','added successfully');
    	redirect('manage_home','refresh');


    }
    function edit()
    {
    	
		$edit_id=$this->uri->segment(3);
		
		 $data['active']="Manage_user_student";

     $data['user_details']= $this->common->select($table_name='tbl_user',$field=array(),$where=array('user_id'=>$edit_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());

        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
		$this->load->view('manage_user_student_edit',$data);
        $this->load->view('common/footer');
		

    }	
    function edit_action_user_student()
    {
        $fname=$this->input->post('fname');
        $email=$this->input->post('email');
        $mobile=$this->input->post('mobile');
        $subject=$this->input->post('subject');
        
       	
        $id=$this->input->post("hidden_id");
        
        
		
       $data = array(
    					
    					
    					          'first_name'=>$fname,
                        'login_email'=>$email,
                        'mobile'=>$mobile,
                        'subject_id'=>$subject,
                         					
    				);
       // print_r($data);exit;
       $this->db->where('user_id',$id);
       $this->db->update('tbl_user',$data);
       $this->session->set_flashdata('succ_msg','updated successfully');
    	redirect('Manage_user_student','refresh');

    }
  
    function change_slider_status()
{
	
		$test_ids=$this->input->post('id');
		$status=$this->input->post('status');
		$data=array('status'=>$status);


		for($i=0;$i<count($test_ids);$i++)
		{
			$id=$test_ids[$i];
			$this->db->where('user_id',$id);

			if($this->db->update('tbl_user',$data))
			{
				$result=1;
			}
			
		}
			
		echo json_encode(array('changedone'=>$result));
		


}



}
?>