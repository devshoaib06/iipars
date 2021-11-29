<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class manage_slider extends CI_Controller 
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
		$this->session_check_and_session_data->session_check();
		
    }
	
	public function index()
	{

		if($this->session->userdata('hs_admin_id')=="")
      {
      	redirect('index.php/admin_login');
      }
        $data['active']="slider";
        $data['slider']=$this->admin_model->selectAll('tbl_slider');
		$this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('slider/slider_table',$data);
        $this->load->view('common/footer');
		
	
	}
	function add_slider()
	{
		if($this->session->userdata('hs_admin_id')!='')
		{
			$user_id= $this->session->userdata('hs_admin_id');
		}
		else{
			redirect('index.php/admin_login','refresh');
		}
        $data['active']="slider";
		$this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
		$this->load->view('slider/slider_add');
        $this->load->view('common/footer');
          
	}
	
	 function insert()
    {
    	
    	$first_title=$this->input->post('first_title');
        $second_title=$this->input->post('second_title');
        $third_title=$this->input->post('third_title');
        $button_name=$this->input->post('button_name');
    	$slider_link=$this->input->post('slider_link');
        
    	$image_alt=$this->input->post('img_alt');
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
               
              
              

                move_uploaded_file($file_tmp, "../assets/upload/slider/" . $new_name . "." . $ext);
                $image = $new_name . "." . $ext;

                $config['image_library'] = 'gd2';
                $config['source_image'] = '../assets/upload/slider/' . $image;
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
                redirect(base_url().'index.php/manage_slider');
            }
        }
    	$data = array(
    					
    					
                        'first_title'=>$first_title,
    					'third_title'=>$third_title,
                        'second_title'=>$second_title,
                        'button_name'=>$button_name,
    					'slider_link'=>$slider_link,
    					'slider_image'=>$image,
    					'image_alt'=>$image_alt,
    					'slider_status'=>'active',
                        'created_date'=>$current_date,
                        'created_by'=>$id   					
    				);
    	
    	$this->db->insert('tbl_slider',$data);
    	$this->session->set_flashdata('succ_msg','added successfully');
    	redirect('manage_slider','refresh');


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
		$data['slider']=$this->admin_model->selectOne('tbl_slider','slider_id',$edit_id);
		 $data['active']="slider";
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
		$this->load->view('slider/slider_edit',$data);
        $this->load->view('common/footer');
		

    }	
    function edit_action()
    {
        $first_title=$this->input->post('first_title');
        $second_title=$this->input->post('second_title');
        $third_title=$this->input->post('third_title');
        $button_name=$this->input->post('button_name');
        $slider_link=$this->input->post('slider_link');
        $image_alt=$this->input->post('img_alt');
       	$edited_date=date('Y-m-d');
       	$edit_by=$this->session->userdata('hs_admin_id');
        $slider_id=$this->input->post("slider_id");
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
               
              
              

                move_uploaded_file($file_tmp, "../assets/upload/slider/" . $new_name . "." . $ext);
                $image = $new_name . "." . $ext;

                $config['image_library'] = 'gd2';
                $config['source_image'] = '../assets/upload/slider/' . $image;
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
                redirect(base_url().'index.php/manage_slider');
            }
        }
		  if($image=='')
		  {
		  	$image=$old_img;
		  }
		  else
		  {
            @unlink('../assets/upload/slider/'.$old_img);
		  	// @unlink('../assets/upload/slider/small/'.$old_img);
		  }
       $data = array(
    					
    					
    					'first_title'=>$first_title,
                        'second_title'=>$second_title,
                        'third_title'=>$third_title,
                        'button_name'=>$button_name,
                        'slider_link'=>$slider_link,
                        'slider_image'=>$image,
                        'image_alt'=>$image_alt,
                        'slider_status'=>'active',
                        'edited_date'=>$edited_date,
                        'edited_by'=>$edit_by   					
    				);
       // print_r($data);exit;
       $this->db->where('slider_id',$slider_id);
       $this->db->update('tbl_slider',$data);
       $this->session->set_flashdata('succ_msg','updated successfully');
    	redirect('manage_slider','refresh');

    }
    function delete()
    {
    	$del_id=$this->uri->segment(3);
    	$image_find = $this->admin_model->selectOne('tbl_slider','slider_id',$del_id);
	    $old_image = $image_find[0]->slider_image;
	    //echo $old_image; exit;
	    if($old_image!='')
	    {
        @unlink('../assets/upload/slider/'.$old_image);
		// @unlink('../assets/upload/slider/small/'.$old_image);
	    }
	   $this->db->where('slider_id',$del_id);
	   $this->db->delete('tbl_slider');			
	   $this->session->set_flashdata('succ_msg','deleted successfully');
			
			
	redirect('manage_slider','refresh');
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


function ceo()
{
    // echo 'ok';


    if($this->session->userdata('hs_admin_id')=="")
      {
        redirect('index.php/admin_login');
      }
        $data['active']="ceo";
        $data['ceo']=$this->admin_model->selectAll('tbl_ceo');
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('slider/ceo',$data);
        $this->load->view('common/footer');



}


function update_ceo()
{
    $first_title=$this->input->post('first_title');
    $description=$this->input->post('description');
    $old_image=$this->input->post('old_image');


    if($_FILES['image']['name']==NULL)

         {
             $image=$old_image;
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
               
              
              

                move_uploaded_file($file_tmp, "../assets/upload/ceo/" . $new_name . "." . $ext);
                @unlink('../assets/upload/ceo/'.$old_image);
                $image = $new_name . "." . $ext;

                $config['image_library'] = 'gd2';
                $config['source_image'] = '../assets/upload/ceo/' . $image;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = "100%";


                // $config['create_thumb'] = FALSE;
                // $config['maintain_ratio'] = FALSE;
                // $config['new_image'] = '../assets/upload/ceo/' .$image;
                // $config['quality'] = "100%";
                // $config['width'] = 470;
                // $config['height']= 650;
                // $config['master_dim'] ="height" ;
               
    
                

               $this->image_lib->initialize($config);
               $this->image_lib->resize(); 
               $this->image_lib->clear();
                      
            
            }
            else
            {
                $this->session->set_flashdata('succ_msg','please upload an image..!');
                redirect(base_url().'index.php/manage_slider/ceo');
            }
        }


        $data=array(
                   'title'=>$first_title,
                   'description'=>$description,
                   'image'=>$image,
                   'created_on'=>date('Y-m-d'),
                    );


        $this->db->where('id',1);
        $this->db->update('tbl_ceo',$data);

         $this->session->set_flashdata('succ_msg','Updated successfully');
        redirect('manage_slider/ceo','refresh');

          


}



}
?>