<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_chamber extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('customer_model');
        $this->load->model('product_model');
        if ($this->session->userdata('hs_admin_id')=="")
        {
            redirect(base_url().'index.php/admin_login');
        }
    }
    function index()
    {

    	$data['active']="manage_chamber";

    	$data['chamber_list']=$this->admin_model->selectAll('tbl_chamber');
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('chamber_list_view',$data);
        $this->load->view('common/footer');
    }

    function add_chamber()
    {

        $data['active']="manage_chamber";
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('add_chamber_view');
        $this->load->view('common/footer');
    }

    function add_chamber_action()
    {

        $chamber_name=$this->input->post('chamber');

        $chamber_address=$this->input->post('chamber_address');

         $contact=$this->input->post('contact');

        $created_by=$this->session->userdata('hs_admin_id');
        $created_date=date('Y-m-d');

        $data=array(

                            'chamber_name'=>$chamber_name,
                            'chamber_phone'=>$contact,
                            'created_date'=>$created_date,
                            'chamber_address'=>$chamber_address,
                            'created_by'=>$created_by
                   );

        $this->db->insert('tbl_chamber',$data);
        $this->session->set_flashdata('flash_msg','Data Successfully Submitted.');
        redirect('admin_chamber','refresh');
    }

    function edit_chamber()
    {

         $data['active']="manage_chamber";
       $segment=$this->uri->segment(3);
       $data['chamber']=$this->admin_model->selectOne('tbl_chamber','chamber_id',$segment);
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('edit_chamber_view',$data);
        $this->load->view('common/footer');
    }

    function edit_chamber_action()
    {

        
         $chamber_id=$this->input->post('chamber_id');
         $chamber_name=$this->input->post('chamber');

        $chamber_address=$this->input->post('chamber_address');

        $contact=$this->input->post('contact');

        $created_by=$this->session->userdata('hs_admin_id');
        $created_date=date('Y-m-d');

        $data=array(

                            'chamber_name'=>$chamber_name,
                            'chamber_phone'=>$contact,
                            'edited_date'=>$created_date,
                            'chamber_address'=>$chamber_address,
                            'edited_by'=>$created_by
                   );
        $this->db->where('chamber_id',$chamber_id);
        $this->db->update('tbl_chamber',$data);
        $this->session->set_flashdata('flash_msg','Data Successfully Updated.');
        redirect('admin_chamber','refresh');
    }

    function chamber_delete()
    {
         $segment=$this->uri->segment(3);

         $this->db->where('chamber_id',$segment);
        $this->db->delete('tbl_chamber');
        $this->session->set_flashdata('flash_msg','Data Successfully Deleted.');
      
        redirect('admin_chamber','refresh');


    }

    function change_to_active_chamber()
{
    
        $pro_ids=$this->input->post('pid');
        $status=$this->input->post('status');
        $data=array('status'=>$status);


        for($i=0;$i<count($pro_ids);$i++)
        {
            $id=$pro_ids[$i];
            $this->db->where('chamber_id',$id);

            if($this->db->update('tbl_chamber',$data))
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

function getuniversity()
{
    $id=$this->input->post('id');

    $university = $this->common->select($table_name='tbl_university',$field=array(), $where=array('university_type'=>$id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

    echo json_encode($university);
}
function getservice()
{
    $id=$this->input->post('id');

    $service = $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_type_id'=>$id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

    echo json_encode($service);
}



        function form_list()
        {
          $added_by=$this->session->userdata('hs_admin_id');

          $uni=$this->uri->segment(3);

          $unitype=$this->uri->segment(4);

          if($added_by == 1)
          {

            if($unitype == "uni")
            {
                $data['form_list'] = $this->common->select($table_name='tbl_form',$field=array(), $where=array('university_id'=>$uni), $where_or=array(),$like=array(),$like_or=array(),$order=array('form_id'=>'DESC'),$start='',$end='');
            }
            elseif($unitype == "service")
            {
                $data['form_list'] = $this->common->select($table_name='tbl_form',$field=array(), $where=array('service_id'=>$uni), $where_or=array(),$like=array(),$like_or=array(),$order=array('form_id'=>'DESC'),$start='',$end='');
            }
            elseif($unitype == "kpo")
            {
                $data['form_list'] = $this->common->select($table_name='tbl_form',$field=array(), $where=array('subject_id'=>$uni), $where_or=array(),$like=array(),$like_or=array(),$order=array('form_id'=>'DESC'),$start='',$end='');
            }
            else
            {
                 $data['form_list'] = $this->common->select($table_name='tbl_form',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array('form_id'=>'DESC'),$start='',$end='');
            }
           
          }
          else
          {
            $data['form_list'] = $this->common->select($table_name='tbl_form',$field=array(), $where=array('added_by'=>$added_by), $where_or=array(),$like=array(),$like_or=array(),$order=array('form_id'=>'DESC'),$start='',$end='');
          }
          
            $this->load->view('common/header');
            $this->load->view('common/leftmenu',$data);
            $this->load->view('form_list',$data);
            $this->load->view('common/footer');
        }

        function form_view()
        {
            $form_id=$this->uri->segment(3);
         $data['university_type'] = $this->common->select($table_name='tbl_cc',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            $data['subject'] = $this->common->select($table_name='tbl_kpo',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            $data['service_type'] = $this->common->select($table_name='tbl_examination_type',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            $added_by=$this->session->userdata('hs_admin_id');
            $data['form'] = $this->common->select($table_name='tbl_form',$field=array(), $where=array('form_id'=>$form_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            $uni_type=$this->common->select($table_name='tbl_university',$field=array(), $where=array('university_id'=>@$data['form'][0]->university_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


            $data['uni_type_id']=@$uni_type[0]->university_type;
             $data['uni_name']=@$uni_type[0]->university;


            $service_type=$this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$data['form'][0]->service_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            $data['service_type_id']=@$service_type[0]->examination_type_id;
             $data['service_name']=@$service_type[0]->examination_name;


            $this->load->view('common/header');
            $this->load->view('common/leftmenu',$data);
            $this->load->view('form_view',$data);
            $this->load->view('common/footer');
        }

    function form_edit()
    {
        $form_id=$this->uri->segment(3);
         $data['university_type'] = $this->common->select($table_name='tbl_cc',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            $data['subject'] = $this->common->select($table_name='tbl_kpo',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            $data['service_type'] = $this->common->select($table_name='tbl_examination_type',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            $added_by=$this->session->userdata('hs_admin_id');
            $data['form'] = $this->common->select($table_name='tbl_form',$field=array(), $where=array('form_id'=>$form_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            $uni_type=$this->common->select($table_name='tbl_university',$field=array(), $where=array('university_id'=>@$data['form'][0]->university_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


            $data['uni_type_id']=@$uni_type[0]->university_type;
             $data['uni_name']=@$uni_type[0]->university;


            $service_type=$this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$data['form'][0]->service_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            $data['service_type_id']=@$service_type[0]->examination_type_id;
             $data['service_name']=@$service_type[0]->examination_name;


            $this->load->view('common/header');
            $this->load->view('common/leftmenu',$data);
            $this->load->view('form_edit',$data);
            $this->load->view('common/footer');
    }

        function add_examination()
        {
            $data['university_type'] = $this->common->select($table_name='tbl_cc',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            $data['subject'] = $this->common->select($table_name='tbl_kpo',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            $data['service_type'] = $this->common->select($table_name='tbl_examination_type',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


            $this->load->view('common/header');
            $this->load->view('common/leftmenu',$data);
            $this->load->view('form_add',$data);
            $this->load->view('common/footer');
        }

        function edit_form_action()
        {
            $added_by=$this->session->userdata('hs_admin_id');
            $added_at=date('Y-m-d');
            $university=$this->input->post('university');
            $subject=$this->input->post('subject');
            $services=$this->input->post('services');
            $state=$this->input->post('state');
            $announce_date=$this->input->post('announce_date');
            $last_date=$this->input->post('last_date');
            $title=$this->input->post('title');
            $exam_date=$this->input->post('exam_date');
            $duration=$this->input->post('duration');
            $sponsor_by=$this->input->post('sponsor_by');
            $from_date=$this->input->post('from_date');
            $to_date=$this->input->post('to_date');
            $post=$this->input->post('post');
            $amount=$this->input->post('amount');
            $web_link=$this->input->post('web_link');
           
$hidden_id=$this->input->post('hidden_id');
           $data=array(

            'service_id'=>$services,
            'university_id'=>$university,
            'subject_id'=>$subject,
            'added_by'=>$added_by,
            'added_date'=>$added_at,
            'state'=>$state,
            'sponsor_by'=> $sponsor_by,
            'announce_date'=>$last_date,
            'last_announce_date'=>$last_date,
            'title'=>$title,
            'exam_date'=>$exam_date,
            'duration'=>$duration,
            'for_post'=>$post,
            'amount'=>$amount,
            'from_date'=>$from_date,
            'to_date'=>$to_date,
            'web_link'=>$web_link


                      );
           $this->db->where('form_id',$hidden_id);
           $this->db->update('tbl_form',$data);
           $this->session->set_flashdata('flash_msg','Data Successfully Updated.');
           redirect('admin_chamber/form_list','refresh');
        }

        function add_form_action()
        {
            $added_by=$this->session->userdata('hs_admin_id');
            $added_at=date('Y-m-d');
            $university=$this->input->post('university');
            $subject=$this->input->post('subject');
            $services=$this->input->post('services');
            $state=$this->input->post('state');
            $announce_date=$this->input->post('announce_date');
            $last_date=$this->input->post('last_date');
            $title=$this->input->post('title');
            $exam_date=$this->input->post('exam_date');
            $duration=$this->input->post('duration');
            $sponsor_by=$this->input->post('sponsor_by');
            $from_date=$this->input->post('from_date');
            $to_date=$this->input->post('to_date');
            $post=$this->input->post('post');
            $amount=$this->input->post('amount');
            $web_link=$this->input->post('web_link');
           

           $data=array(

            'service_id'=>$services,
            'university_id'=>$university,
            'subject_id'=>$subject,
            'added_by'=>$added_by,
            'added_date'=>$added_at,
            'state'=>$state,
            'announce_date'=>$announce_date,
            'last_announce_date'=>$last_date,
            'title'=>$title,
            'exam_date'=>$exam_date,
            'duration'=>$duration,
            'for_post'=>$post,
            'amount'=>$amount,
            'from_date'=>$from_date,
            'sponsor_by'=> $sponsor_by,
            'to_date'=>$to_date,
            'web_link'=>$web_link


                      );

           $this->db->insert('tbl_form',$data);
           $this->session->set_flashdata('flash_msg','Data Successfully Submitted.');
           redirect('admin_chamber/form_list','refresh');
        }

        function change_to_active_examination()
{
    
        $pro_ids=$this->input->post('pid');
        $status=$this->input->post('status');
        $data=array('status'=>$status);


        for($i=0;$i<count($pro_ids);$i++)
        {
            $id=$pro_ids[$i];
            $this->db->where('form_id',$id);

            if($this->db->update('tbl_form',$data))
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