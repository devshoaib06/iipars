<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class manage_ebook extends CI_Controller 
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
        $data['active']="manage_ebook";

        $data['ebook']=$this->admin_model->selectAll('tbl_invite_for_ebook');

		$this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('manage_ebook_list',$data);
        $this->load->view('common/footer');
		
	
	}



      function export_csv_ebook_list()
  {
    // $enquiry_id=$this->uri->segment('3');
      header("Content-type: text/csv");

          header("Content-Disposition: attachment; filename=Invitation for Ebook.csv");

          $marks_details= $this->common->select($table_name='tbl_invite_for_ebook',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
// echo "<pre>";print_r($marks_details);die;
          $output = fopen('php://output', 'w');

          fputcsv($output, array('Sl No.','Name','Designation','Phone','Email Id','Whatsapp No.','Address','Subject','Book Title','Short Description'));

          $count=1;

          foreach($marks_details as $row)

          {
            
                fputcsv($output, array(

                    "Sl No" => $count,
                    'Name'=>@$row->nam,
                    'Designation'=>@$row->designation,
                    'Phone'=>@$row->phone,
                    'Email Id'=>@$row->email,
                    'Whatsapp No.'=>@$row->wp,
                    'Address'=>@$row->address,
                    'Subject'=>@$row->subject,
                    'Book Title'=>@$row->book_title,
                    'Short Description'=>@$row->short_description
                   
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
       $this->db->delete('tbl_invite_for_ebook');            
       $this->session->set_flashdata('succ_msg','deleted successfully');
            
            
    redirect('manage_ebook','refresh');
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
    	if($this->session->userdata('hs_admin_id')!='')
		{
			$user_id= $this->session->userdata('hs_admin_id');
		}
		else{
			redirect('index.php/admin_login','refresh');
		}
		$edit_id=$this->uri->segment(3);
		$data['manage_home']=$this->admin_model->selectOne('tbl_manage_home','id',$edit_id);
		 $data['active']="manage_home";

        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
		$this->load->view('manage_home_edit',$data);
        $this->load->view('common/footer');
		

    }	
    function edit_action()
    {
        $first_title=$this->input->post('first_title');
        $content_details=$this->input->post('content_details');
        
       	$edited_date=date('Y-m-d');
       	$edit_by=$this->session->userdata('hs_admin_id');
        $id=$this->input->post("id");
        $old_img=$this->input->post('old_image');
        
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
		  if($image=='')
		  {
		  	$image=$old_img;
		  }
		  else
		  {
            @unlink('../assets/upload/manage_home/'.$old_img);
		  	// @unlink('../assets/upload/slider/small/'.$old_img);
		  }
       $data = array(
    					
    					
    					'title'=>$first_title,
                        'description'=>$content_details,
                        'image'=>$image,
                        'edited_date'=>$edited_date,
                        'edited_by'=>$edit_by   					
    				);
       // print_r($data);exit;
       $this->db->where('id',$id);
       $this->db->update('tbl_manage_home',$data);
       $this->session->set_flashdata('succ_msg','updated successfully');
    	redirect('manage_home','refresh');

    }
  
    function change_slider_status()
{
	
		$test_ids=$this->input->post('id');
		$status=$this->input->post('status');
		$data=array('slider_status'=>$status);


		for($i=0;$i<count($test_ids);$i++)
		{
			$id=$test_ids[$i];
			$this->db->where('slider_id',$id);

			if($this->db->update('tbl_slider',$data))
			{
				$result=1;
			}
			
		}
			
		echo json_encode(array('changedone'=>$result));
		


}



//ebook list

function ebook_list()
{

      $data['active']='ebook_list';
  

        $data['ebook_list']=$this->admin_model->selectAll('tbl_ebook');

        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('ebook_list',$data);
        $this->load->view('common/footer');
  
}

function add_ebook()
{

      $data['active']='ebook_list';


        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('add_ebook_list');
        $this->load->view('common/footer');
}


function insert_new_ebook()
{
  $title= $this->input->post('title');
  $price= $this->input->post('price');
  // $image= $this->input->post('image');
  $created_by=$this->session->userdata('hs_admin_id');
  $created_on= date('Y-m-d');

  $slug=$this->create_slug($title);




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
            if ($ext == "png" || $ext == "gif" || $ext == "jpg" || $ext == "jpeg" || $ext=="pdf")
            {
               
              
              

                move_uploaded_file($file_tmp, "../assets/upload/ebook/" . $new_name . "." . $ext);
                $image = $new_name . "." . $ext;

                $config['image_library'] = 'gd2';
                $config['source_image'] = '../assets/upload/ebook/' . $image;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = "100%";
               
    
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['new_image'] = '../assets/upload/ebook/resize/' .$image;
                $config['quality'] = "100%";
                $config['width'] = 1200;
                $config['height']= 1367;
                $config['master_dim'] ="height" ;

               $this->image_lib->initialize($config);
               $this->image_lib->resize(); 
               $this->image_lib->clear();
                      
            
            }
            else
            {
                $this->session->set_flashdata('image_error','please upload an image..!');
                redirect('manage_ebook/add_ebook');
            }
        }


        $data=array(
             'title'=>$title,
             'price'=>$price,
             'image'=>$image,
             'created_on'=>$created_on,
             'created_by'=>$created_by,
             'slug'=>$slug
                   );


        $this->db->insert('tbl_ebook',$data);
        $this->session->set_flashdata('succ_msg','Submitted successfully');
        redirect('manage_ebook/ebook_list');


}



     function create_slug($string)
  {     
        $replace = '-';         
        $string = strtolower($string);     
 
        //replace / and . with white space     
        $string = preg_replace("/[\/\.]/", " ", $string);     
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);     
 
        //remove multiple dashes or whitespaces     
        $string = preg_replace("/[\s-]+/", " ", $string);     
 
        //convert whitespaces and underscore to $replace     
        $string = preg_replace("/[\s_]/", $replace, $string);     
 
        //limit the slug size     
        $string = substr($string, 0, 100);     
 
        //slug is generated     
        return $string; 
    }


    function edit_ebook()
    {
        $data['active']='ebook_list';

        $edit_id= $this->uri->segment(3);

        // print_r($edit_id); exit;

        

        $data['ebook_list']=  $this->common->select($table_name='tbl_ebook',$field=array(), $where=array('id'=>$edit_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');



        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('edit_ebook_list',$data);
        $this->load->view('common/footer');
    }


    function update_new_ebook()
    {
      $title= $this->input->post('title');
      $price= $this->input->post('price');
      $old_image= $this->input->post('old_image');
      $hidden_id= $this->input->post('hidden_id');
  
      $edited_by=$this->session->userdata('hs_admin_id');
      $edited_on= date('Y-m-d');

      $slug=$this->create_slug($title);



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
            if ($ext == "png" || $ext == "gif" || $ext == "jpg" || $ext == "jpeg" || $ext=="pdf")
            {
               
              
              

                move_uploaded_file($file_tmp, "../assets/upload/ebook/" . $new_name . "." . $ext);
                $image = $new_name . "." . $ext;

                $config['image_library'] = 'gd2';
                $config['source_image'] = '../assets/upload/ebook/' . $image;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = "100%";
               
    
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['new_image'] = '../assets/upload/ebook/resize/' .$image;
                $config['quality'] = "100%";
                $config['width'] = 1200;
                $config['height']= 1367;
                $config['master_dim'] ="height" ;

               $this->image_lib->initialize($config);
               $this->image_lib->resize(); 
               $this->image_lib->clear();
                      
            
            }
            else
            {
                $this->session->set_flashdata('image_error','please upload an image..!');
                redirect('manage_ebook/add_ebook');
            }
        }


          if($image=='')
      {
        $image=$old_image;
      }
      else
      {
            @unlink('../assets/upload/ebook/resize/'.$old_image);
            @unlink('../assets/upload/ebook/'.$old_image);
        // @unlink('../assets/upload/slider/small/'.$old_img);
      }

       

         $data=array(
             'title'=>$title,
             'price'=>$price,
             'image'=>$image,
             'edited_on'=>$edited_on,
             'edited_by'=>$edited_by,
             'slug'=>$slug
                   );


         $this->db->where('id',$hidden_id);
         $this->db->update('tbl_ebook',$data);
         $this->session->set_flashdata('succ_msg','Updated successfully');
          redirect('manage_ebook/ebook_list');




    }


    function delete_ebook_data()
    {
      $id=$this->uri->segment(3);

      $ebook_list=  $this->common->select($table_name='tbl_ebook',$field=array(), $where=array('id'=>$id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

           $image=$ebook_list[0]->image;

           if($image!='')
           {
            @unlink('../assets/upload/ebook/resize/'.$image);
            @unlink('../assets/upload/ebook/'.$image);
           }

         $this->db->where('id',$id);
         $this->db->delete('tbl_ebook');
         $this->session->set_flashdata('succ_msg','Deleted successfully');
          redirect('manage_ebook/ebook_list');


    }


    function change_ebookkk_status()
    {
      $test_ids=$this->input->post('id');
      $status=$this->input->post('status');
      $data=array('status'=>$status);


    for($i=0;$i<count($test_ids);$i++)
    {
      $id=$test_ids[$i];
      $this->db->where('id',$id);

      if($this->db->update('tbl_ebook',$data))
      {
        $result=1;
      }
      
    }
      
    echo json_encode(array('changedone'=>$result));
    }



    function purchase_ebook()
    {
      $data['active']='purchase_ebook';

        $data['ebook_purchase']=$this->admin_model->selectAll('tbl_ebook_purchase');


        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('purchase_ebook_list',$data);
        $this->load->view('common/footer');


    }

//     function csv_ebook_purchased()
//     {
//         header("Content-type: text/csv");

//           header("Content-Disposition: attachment; filename=Purchased Ebook.csv");

//           $ebook= $this->common->select($table_name='tbl_ebook_purchase',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
// // echo "<pre>";print_r($marks_details);die;
//           $output = fopen('php://output', 'w');

//           fputcsv($output, array('Sl No.','E-Book Title','E-Book Image','Buyer Name','Purchased Date'));

//           $count=1;

//           foreach($ebook as $row)

//           {

//                    $buyer_name=  $this->common->select($table_name='tbl_user',$field=array(), $where=array('user_id'=>$row->user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

//                   $ebook=  $this->common->select($table_name='tbl_ebook',$field=array(), $where=array('id'=>$row->ebook_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');




            
//                 fputcsv($output, array(

//                     "Sl No" => $count,
//                     'E-Book Title'=>@$ebook[0]->title,
//                     'E-Book Image'=>'<img src='.base_url().'../assets/upload/ebook/resize/'.@$ebook[0]->image,
//                     'Buyer Name'=>@$buyer_name[0]->first_name,
//                     'Purchased Date'=>@$row->purchase_date,
                    
                   
//                 ));

            
//                 $count++;


//           }
//     }


    function delete_purchased_ebook()
    {
      $id=$this->uri->segment(3);

    

         $this->db->where('id',$id);
         $this->db->delete('tbl_ebook_purchase');
         $this->session->set_flashdata('succ_msg','Deleted successfully');
          redirect('manage_ebook/purchase_ebook');
    }


}
?>