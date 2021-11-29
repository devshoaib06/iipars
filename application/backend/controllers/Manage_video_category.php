<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_video_category extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('customer_model');
        $this->load->model('product_model');
        $this->load->library('image_lib');

        if ($this->session->userdata('hs_admin_id')=="")
        {
            redirect(base_url().'index.php/admin_login');
        }
    }
    function index()
    {
  $admin_details=$this->session_check_and_session_data->admin_session_data();

                if(@$admin_details[0]->user_type_id!='1')
                {
                    redirect(base_url().'index.php/admin_dashboard');
                }
    	$data['active']="video_category_list";

    	$data['video_category_list']=$this->admin_model->selectAll('tbl_video_category');
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('video_category_list',$data);
        $this->load->view('common/footer');
    }


    function add_examination_type_action()
    {

        $video_category=$this->input->post('video_category');

        $created_by=$this->session->userdata('hs_admin_id');
        $created_date=date('Y-m-d');

        $data=array(

                            'video_category'=>$video_category,
                            'created_date'=>$created_date,
                            'created_by'=>$created_by
                   );

        $this->db->insert('tbl_video_category',$data);
        $this->session->set_flashdata('flash_msg','Data Successfully Submitted.');
        redirect('manage_video_category','refresh');

    }


    public function edit_examination_type_json()
    {
        $examination_type_id = $this->input->post('examination_type_id');

        $examination_type_data=  $this->common->select($table_name='tbl_video_category',$field=array(), $where=array('video_category_id'=>$examination_type_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

        $name=@$examination_type_data[0]->video_category;

        echo json_encode($name);
    }


    function edit_examination_type_action()
    {
        $examination_type_id=$this->input->post('examination_type_id');
        $examination_type=$this->input->post('examination_type');

        $edited_by=$this->session->userdata('hs_admin_id');
        $edited_date=date('Y-m-d');

        $data=array(

                            'video_category'=>$examination_type,
                            'edited_by'=>$edited_by,
                            'edited_date'=>$edited_date,
                   );
        $this->db->where('video_category_id',$examination_type_id);
        $this->db->update('tbl_video_category',$data);
        $this->session->set_flashdata('flash_msg','Data Successfully Updated.');
        redirect('manage_video_category','refresh');

    }

    function change_to_active_examination_type()
    {
    
        $pro_ids=$this->input->post('pid');
        $status=$this->input->post('status');
        $data=array('status'=>$status);


        for($i=0;$i<count($pro_ids);$i++)
        {
            $id=$pro_ids[$i];
            $this->db->where('video_category_id',$id);

            if($this->db->update('tbl_video_category',$data))
            {
                $result=1;
            }
            else
            {
                $result=0;
            }


            }
            
        echo json_encode(array('changedone'=>$result));
        


        }


        function video_category_delete()
    {

        $cc_id=$this->uri->segment(3);
        $this->db->where('video_category_id',$cc_id);
        $this->db->delete('tbl_video_category');
        $this->session->set_flashdata('flash_msg','Data Successfully Deleted.');
        redirect('Manage_video_category','refresh');
    }


    function video_gallery_view()
    {
        
         $admin_details=$this->session_check_and_session_data->admin_session_data();

                if(@$admin_details[0]->user_type_id!='1')
                {
                    redirect(base_url().'index.php/admin_dashboard');
                }

        $data['active']="video";

        $data['vedio_gallery_list']=$this->admin_model->selectAll('tbl_video_gallery');

        //echo "<pre>";print_r($data['examination_list']);exit;
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('video_gallery_view',$data);
        $this->load->view('common/footer');
    }


    function add_video_gallery()
    {

        $data['active']="video";

        //$data['examination_type']=$this->admin_model->selectAll('tbl_examination_type');

        $data['video_category'] = $this->common->select($table_name='tbl_video_category',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('add_vedio_gallery',$data);
        $this->load->view('common/footer');
    }


    function add_video_gallery_action()
    {
        $video_category_id=$this->input->post('video_category');
        $video_galary_link=$this->input->post('video_galary_link');
        $edited_by=$this->session->userdata('hs_admin_id');
        $created_date=date('Y-m-d');


        if($_FILES['gallery_image']['name']==NULL)

        {
            $image=NULL;
        }
        else
        {
                $new_name1 = str_replace(".", "", microtime());
            $new_name = str_replace(" ", "_", $new_name1);
            $file_tmp = $_FILES['gallery_image']['tmp_name'];
            $file = $_FILES['gallery_image']['name'];
            $ext = substr(strrchr($file, '.'), 1);
           /* if ($ext == "png" || $ext == "gif" || $ext == "jpg" || $ext == "jpeg")
            {*/
                
                move_uploaded_file($file_tmp, "../assets/upload/gallery_image/" . $new_name . "." . $ext);
                $image = $new_name . "." . $ext;

                $config['image_library'] = 'gd2';
                $config['source_image'] = '../assets/upload/gallery_image/' . $image;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = "100%";
               
    
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['new_image'] = '../assets/upload/gallery_image/'.$image;
                $config['quality'] = "100%";
                $config['width'] = 647;
                $config['height']= 558;
                $config['master_dim'] ="height" ;

               $this->image_lib->initialize($config);
               $this->image_lib->resize(); 
               $this->image_lib->clear();
                      
            
           /* }
            else
            {
                $this->session->set_flashdata('image_error','please upload an image..!');
                redirect(base_url().'index.php/admin_brand');
            }*/
        }

        $data=array(

                    'video_category_id'=>$video_category_id,
                    'video_gallery_image'=>$image,
                    'video_gallery_link'=>$video_galary_link,
                    'created_on'=>$edited_by,
                    'created_date'=>$created_date
                );

        $this->db->insert('tbl_video_gallery',$data);
        $this->session->set_flashdata('message','Data Successfully Submitted.');
        redirect('manage_video_category/video_gallery_view','refresh');



    }


    function video_gallery_edit()
    {
        $video_gallery_id=$this->uri->segment(3);
        // echo $video_gallery_id;exit;

        $data['video_category'] = $this->common->select($table_name='tbl_video_category',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

        $data['edit_details'] = $this->common->select($table_name='tbl_video_gallery',$field=array(), $where=array('video_gallery_id'=>$video_gallery_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

        // echo "<pre>"; print_r($data['edit_details']); exit;


        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('edit_video_gallery',$data);
        $this->load->view('common/footer');


    }

    function edit_video_gallery_action()
    {
        $video_category_id=$this->input->post('video_category');
        $video_galary_link=$this->input->post('video_galary_link');
        $edited_by=$this->session->userdata('hs_admin_id');
        $created_date=date('Y-m-d');
        $hidden_image=$this->input->post('hidden_image');
        $video_gallery_id =$this->input->post('video_gallery_id');


        if($_FILES['gallery_image']['name']==NULL)

        {
            $image=$hidden_image;
        }
        else
        {
                $new_name1 = str_replace(".", "", microtime());
            $new_name = str_replace(" ", "_", $new_name1);
            $file_tmp = $_FILES['gallery_image']['tmp_name'];
            $file = $_FILES['gallery_image']['name'];
            $ext = substr(strrchr($file, '.'), 1);

             $hidden_image=$this->input->post('hidden_image');
               
                @unlink('../assets/upload/gallery_image/'.$hidden_image);
             
           /* if ($ext == "png" || $ext == "gif" || $ext == "jpg" || $ext == "jpeg")
            {*/
                
                move_uploaded_file($file_tmp, "../assets/upload/gallery_image/" . $new_name . "." . $ext);
                $image = $new_name . "." . $ext;

                $config['image_library'] = 'gd2';
                $config['source_image'] = '../assets/upload/gallery_image/' . $image;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = "100%";
               
    
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['new_image'] = '../assets/upload/gallery_image/'.$image;
                $config['quality'] = "100%";
                $config['width'] = 647;
                $config['height']= 558;
                $config['master_dim'] ="height" ;

               $this->image_lib->initialize($config);
               $this->image_lib->resize(); 
               $this->image_lib->clear();
                      
            
           /* }
            else
            {
                $this->session->set_flashdata('image_error','please upload an image..!');
                redirect(base_url().'index.php/admin_brand');
            }*/
        }


        $data=array(

                    'video_category_id'=>$video_category_id,
                    'video_gallery_image'=>$image,
                    'video_gallery_link'=>$video_galary_link,
                    'edited_on'=>$edited_by,
                    'edited_date'=>$created_date
                );

        $this->db->where('video_gallery_id',$video_gallery_id);
        $this->db->update('tbl_video_gallery',$data);

        $this->session->set_flashdata('message','Data Successfully Updated.');
        redirect('manage_video_category/video_gallery_view','refresh');



    }


    function delete_data()
    {
        $video_gallery_id=$this->uri->segment(3);

        $data = $this->common->select($table_name='tbl_video_gallery',$field=array(), $where=array('video_gallery_id'=>$video_gallery_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
        if(count($data)!=0)
        {
            $image=@$data[0]->video_gallery_image;

             @unlink('../assets/upload/gallery_image/'.$image);

            $this->db->where('video_gallery_id',$video_gallery_id);
            $this->db->delete('tbl_video_gallery');

            $this->session->set_flashdata('message','Data Successfully Deleted.');
            redirect('manage_video_category/video_gallery_view','refresh');
        }


       


    }


    function change_to_active_video_gallery()
    {


        $pro_ids=$this->input->post('pid');
        $status=$this->input->post('status');
        $data=array('status'=>$status);


        for($i=0;$i<count($pro_ids);$i++)
        {
            $id=$pro_ids[$i];
            $this->db->where('video_gallery_id',$id);

            if($this->db->update('tbl_video_gallery',$data))
            {
                $result=1;
            }
            else
            {
                $result=0;
            }


            }
            
        echo json_encode(array('changedone'=>$result));
    }




}

?>

