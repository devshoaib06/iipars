<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class manage_research_guideline extends CI_Controller 
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
        $data['active']="manage_research_guideline";

        $data['manage_home']=$this->admin_model->selectAll('tbl_research_guideline');

		    $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('research_guideline/general_guideline',$data);
        $this->load->view('common/footer');
		
	
	}
	// function add_data()
	// {
	// 	if($this->session->userdata('hs_admin_id')!='')
	// 	{
	// 		$user_id= $this->session->userdata('hs_admin_id');
	// 	}
	// 	else{
	// 		redirect('index.php/admin_login','refresh');
	// 	}
 //        $data['active']="manage_home";

	// 	$this->load->view('common/header');
 //        $this->load->view('common/leftmenu',$data);
	// 	$this->load->view('manage_home_add');
 //        $this->load->view('common/footer');
          
	// }
	
	 function insert()
    {
    	
    	$title=$this->input->post('title');
        $video_link=$this->input->post('video_link');
        $des=$this->input->post('des');
        
       	$current_date=date('Y-m-d');
       	$user_id=$this->session->userdata('hs_admin_id');


    	
    	$data = array(
    					
    					
                        'title'=>$title,
                        'description'=>$des,
    					'video_link'=>$video_link,
                        
    					'created_date'=>$current_date,
                        'created_by'=>$user_id   					
    				);
    	
        // $this->db->insert('tbl_research_guideline',$data);
        $this->db->where('id',1);
    	$this->db->update('tbl_research_guideline',$data);
    	$this->session->set_flashdata('succ_msg','Updated successfully');
    	redirect('manage_research_guideline','refresh');


    }


    function research_paper_consul_form()
    {
       

        $data['active']="manage_research_guideline";


        $data['research_consul']=$this->admin_model->selectAll('tbl_research_paper_consul_form');




        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('research_guideline/research_paper_form',$data);
        $this->load->view('common/footer');
    }



          function export_csv_research_paper_list()
  {
    $enquiry_id=$this->uri->segment('3');
      header("Content-type: text/csv");

          header("Content-Disposition: attachment; filename=Research Paper Consultancy.csv");

          $marks_details= $this->common->select($table_name='tbl_research_paper_consul_form',$field=array(),$where=array('id'=>$enquiry_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
// echo "<pre>";print_r($marks_details);die;
          $output = fopen('php://output', 'w');

          fputcsv($output, array('Sl No.','Name','Email','Phone','Whatsapp No.','Subject','Designation','Subject for Research Paper','Specialisation','M.Phil/ Ph.d Title(if any)','No of Paper Order','In Words','Total Amount(INR)','Total Amount(In Words)'));

          $count=1;

          foreach($marks_details as $row)

          {
            
                fputcsv($output, array(

                    "Sl No" => $count,
                    'Name'=>@$row->nam,
                    'Email'=>@$row->email,
                    'Phone'=>@$row->phone,
                    'Whatsapp No.'=>@$row->wp,
                    'Subject'=>@$row->subject,
                    'Designation'=>@$row->designation,
                    'Subject for Research Paper'=>@$row->subject2,
                    'Specialisation'=>@$row->specialisation,
                    'M.Phil/ Ph.d Title(if any)'=>@$row->mphil,
                    'No of Paper Order'=>@$row->nopaper,
                    'In Words'=>@$row->in_words,
                    'Total Amount(INR)'=>@$row->total_amount,
                    'Total Amount(In Words)'=>@$row->t_amount_words,
                   
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
       $this->db->delete('tbl_research_paper_consul_form');            
       $this->session->set_flashdata('succ_msg','deleted successfully');
            
            
    redirect('manage_research_guideline/research_paper_consul_form','refresh');
    }




  //   function edit()
  //   {
  //   	if($this->session->userdata('hs_admin_id')!='')
		// {
		// 	$user_id= $this->session->userdata('hs_admin_id');
		// }
		// else{
		// 	redirect('index.php/admin_login','refresh');
		// }
		// $edit_id=$this->uri->segment(3);
		// $data['manage_home']=$this->admin_model->selectOne('tbl_manage_home','id',$edit_id);
		//  $data['active']="manage_home";

  //       $this->load->view('common/header');
  //       $this->load->view('common/leftmenu',$data);
		// $this->load->view('manage_home_edit',$data);
  //       $this->load->view('common/footer');
		

  //   }	
  //   function edit_action()
  //   {
  //       $first_title=$this->input->post('first_title');
  //       $content_details=$this->input->post('content_details');
        
  //      	$edited_date=date('Y-m-d');
  //      	$edit_by=$this->session->userdata('hs_admin_id');
  //       $id=$this->input->post("id");
  //       $old_img=$this->input->post('old_image');
        
		// if($_FILES['image']['name']==NULL)

  //        {
  //            $image=NULL;
  //        }
  //       else
  //       {
  //           $new_name1 = str_replace(".", "", microtime());
  //           $new_name = str_replace(" ", "_", $new_name1);
  //           $file_tmp = $_FILES['image']['tmp_name'];
  //           $file = $_FILES['image']['name'];
  //           $ext = substr(strrchr($file, '.'), 1);
  //           if ($ext == "png" || $ext == "gif" || $ext == "jpg" || $ext == "jpeg")
  //           {
               
              
              

  //               move_uploaded_file($file_tmp, "../assets/upload/manage_home/" . $new_name . "." . $ext);
  //               $image = $new_name . "." . $ext;

  //               $config['image_library'] = 'gd2';
  //               $config['source_image'] = '../assets/upload/manage_home/' . $image;
  //               $config['maintain_ratio'] = FALSE;
  //               $config['quality'] = "100%";
               
    
  //               // $config['create_thumb'] = FALSE;
  //               // $config['maintain_ratio'] = FALSE;
  //               // $config['new_image'] = '../assets/upload/slider/small/' .$image;
  //               // $config['quality'] = "100%";
  //               // $config['width'] = 1920;
  //               // $config['height']= 550;
  //               // $config['master_dim'] ="height" ;

  //              $this->image_lib->initialize($config);
  //              $this->image_lib->resize(); 
  //              $this->image_lib->clear();
                      
            
  //           }
  //           else
  //           {
  //               $this->session->set_flashdata('image_error','please upload an image..!');
  //               redirect(base_url().'index.php/manage_home');
  //           }
  //       }
		//   if($image=='')
		//   {
		//   	$image=$old_img;
		//   }
		//   else
		//   {
  //           @unlink('../assets/upload/manage_home/'.$old_img);
		//   	// @unlink('../assets/upload/slider/small/'.$old_img);
		//   }
  //      $data = array(
    					
    					
  //   					'title'=>$first_title,
  //                       'description'=>$content_details,
  //                       'image'=>$image,
  //                       'edited_date'=>$edited_date,
  //                       'edited_by'=>$edit_by   					
  //   				);
  //      // print_r($data);exit;
  //      $this->db->where('id',$id);
  //      $this->db->update('tbl_manage_home',$data);
  //      $this->session->set_flashdata('succ_msg','updated successfully');
  //   	redirect('manage_home','refresh');

  //   }
 //    function delete()
 //    {
 //    	$del_id=$this->uri->segment(3);
 //    	$image_find = $this->admin_model->selectOne('tbl_manage_home','id',$del_id);
	//     $old_image = $image_find[0]->image;
	//     //echo $old_image; exit;
	//     if($old_image!='')
	//     {
 //        @unlink('../assets/upload/manage_home/'.$old_image);
	// 	// @unlink('../assets/upload/slider/small/'.$old_image);
	//     }
	//    $this->db->where('id',$del_id);
	//    $this->db->delete('tbl_manage_home');			
	//    $this->session->set_flashdata('succ_msg','deleted successfully');
			
			
	// redirect('manage_home','refresh');
 //    }
//     function change_slider_status()
// {
	
// 		$test_ids=$this->input->post('id');
// 		$status=$this->input->post('status');
// 		$data=array('slider_status'=>$status);


// 		for($i=0;$i<count($test_ids);$i++)
// 		{
// 			$id=$test_ids[$i];
// 			$this->db->where('slider_id',$id);

// 			if($this->db->update('tbl_slider',$data))
// 			{
// 				$result=1;
// 			}
			
// 		}
			
// 		echo json_encode(array('changedone'=>$result));
		


// }






}
?>