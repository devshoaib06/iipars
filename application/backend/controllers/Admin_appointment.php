 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_appointment extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('pagination');
        $this->load->library('session');
        $this->load->model('admin_model');
         $this->load->model('common');
    }



    function index()
    {
        if ($this->session->userdata('hs_admin_id') == "")
        {
            redirect(base_url() . 'index.php/admin_login');
        }

        $data['active']="appointment";
        $data['appoint']=$this->admin_model->fetch_all('tbl_manage_timing');
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('appointment/appointment_manage_view',$data);
        $this->load->view('common/footer'); 
    }

    function add_time()
    {
        $this->load->view('common/header');
        $this->load->view('common/leftmenu');
        $this->load->view('appointment/appointment_manage_add_view');
        $this->load->view('common/footer'); 
    }

    function edit_close_time()
    {
        $id= $this->uri->segment(3);

        $data['edit_data']= $this->common->select($table_name='tbl_availability',$field=array(),$where=array('id'=>$id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

        $this->load->view('common/header');
        $this->load->view('common/leftmenu');
        $this->load->view('appointment/appointment_close_edit_view', $data);
        $this->load->view('common/footer'); 
    }
    function close_edit_action()
    {
        $hidden_id= $this->input->post('hiddenid');

        $close_start_date=$this->input->post('close_start_date');
        $start_time=$this->input->post('start_time');
        $end_time=$this->input->post('end_time');

        $update_data= array(
                            'close_start_date'=>$close_start_date,
                            'close_end_date'=>$close_start_date,
                            'close_start_time'=>$start_time,
                            'close_end_time'=>$end_time
                        );

        $this->db->where('id', $hidden_id);
        $this->db->update('tbl_availability',$update_data);
        $this->session->set_flashdata('msg','Timing Successfully Updated');
        redirect('admin_appointment/availability','refresh');


    }

    function add_time_submit()
    {
        $test=$this->input->post('test');
        $start_time=$this->input->post('start_time');
        $end_time=$this->input->post('end_time');
        
        foreach($test as $key => $row)
        { 
            $check=$this->input->post('check_'.$row);
            $check=@implode($check,',');

            $data=array(
                'start_time'=> $start_time[$key],
                'end_time'=> $end_time[$key],
                'day'=> $check
                );

            $this->admin_model->insert_data($data,'tbl_manage_timing');

            //print_r($check);      
        }

       redirect('admin_appointment');
    }

    public function availability()
    {
        if ($this->session->userdata('hs_admin_id') == "")
        {
            redirect(base_url() . 'index.php/admin_login');
        }

        $data['active']="appointment";
        $data['availability']= $this->common->select($table_name='tbl_availability',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
        //echo '<pre>'; print_r($data['appoint']); exit;
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('appointment/appo_availity_view',$data);
        $this->load->view('common/footer'); 
    }
    function set_close_dates()
    {
       $this->load->view('common/header');
        $this->load->view('common/leftmenu');
        $this->load->view('appointment/appointment_close_view');
        $this->load->view('common/footer');  
    }
    function close_dates_action()
    {
        $close_start_date=$this->input->post('close_start_date');
        $start_time=$this->input->post('start_time');
        $end_time=$this->input->post('end_time');

        if(count($start_time)>0)
        {
            for($i=0; $i<count($start_time); $i++)
            {
                $start_time_val= $start_time[$i];
                $end_time_val= $end_time[$i];
                $close_start_date_val= $close_start_date[$i];

                if($start_time_val!='' && $end_time_val!='' && $close_start_date_val!='')
                {
                    
                    $check_date= $this->common->select($table_name='tbl_availability',$field=array(),$where=array('close_start_date'=>$close_start_date_val),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
                    if(count($check_date)>0)
                    {
                        $id= $check_date[0]->id;
                        $insert_data= array(
                                        'service'=>'Appointment',
                                        'availability'=>'NO',
                                        'close_start_date'=>$close_start_date_val,
                                        'close_end_date'=>$close_start_date_val,
                                        'close_start_time'=>$start_time_val,
                                        'close_end_time'=>$end_time_val
                                    );
                        $this->db->where('id', $id);
                        $this->db->update('tbl_availability',$insert_data);


                    }
                    else{
                          $insert_data= array(
                                        'service'=>'Appointment',
                                        'availability'=>'NO',
                                        'close_start_date'=>$close_start_date_val,
                                        'close_end_date'=>$close_start_date_val,
                                        'close_start_time'=>$start_time_val,
                                        'close_end_time'=>$end_time_val
                                    );

                    $this->db->insert('tbl_availability', $insert_data);
                    }
                  
                }

            }

            $this->session->set_flashdata('msg','Timing Successfully set');
            redirect('admin_appointment/availability','refresh');
        }


    }
    function close_time_delete()
    {
        $id= $this->uri->segment(3);
        $this->db->where('id', $id);
        $this->session->set_flashdata('msg','Timing deleted');
        redirect('admin_appointment/availability','refresh');
    }
    function change_availability()
    {
        if ($this->session->userdata('hs_admin_id') == "")
        {
            redirect(base_url() . 'index.php/admin_login');
        }

        $chnge_status= $this->input->post('value');
    $info= $this->common->select($table_name='tbl_availability',$field=array(),$where=array('service'=>'Appointment'),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
       $id= $info[0]->id;

        if($chnge_status=='' || $id=='')
        {
            redirect('admin_appointment/availability','refresh');
        }
        else
        {
            if($chnge_status=='YES')
            {
                $update_status= array('availability'=>'YES',
                                        'close_start_date'=>'',
                                        'close_end_date'=>''
                                    );
            }
            else{
                $close_start_date= $this->input->post('close_start_date');
                $close_end_date= $this->input->post('close_end_date');
                $update_status= array('availability'=>'NO',
                    'close_start_date'=>$close_start_date,
                    'close_end_date'=>$close_end_date
                );
            }

            $this->db->where('id',$id);
            $this->db->update('tbl_availability',$update_status);

            $this->session->set_flashdata('msg','Service availability has been changed successfully');
          redirect('admin_appointment/availability','refresh');
        }
    }

    public function my_appointments()
    {
        if ($this->session->userdata('hs_admin_id') == "")
        {
            redirect(base_url() . 'index.php/admin_login');
        }

        $data['active']="appointment";
        $data['appoint']= $this->common->select($table_name='tbl_appointments',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or=array(),$order=array('appointment_id'=>'DESC'),$start='',$end='');
        //echo '<pre>'; print_r($data['appoint']); exit;
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('appointment/my_appointment_view',$data);
        $this->load->view('common/footer'); 
    }

    public function my_appointments_list()
    {
        
        $data=$this->admin_model->selectOne('tbl_user','user_id',1);
        $newData=array(
                'hs_admin_id'=>$data[0]->admin_id,
                'session_name'=>$data[0]->user_name,
            );
            $this->session->set_userdata($newData);
        
        $data['active']="appointment";
        $data['appoint']= $this->common->select($table_name='tbl_appointments',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or=array(),$order=array('appointment_id'=>'DESC'),$start='',$end='');
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('appointment/my_appointment_view',$data);
        $this->load->view('common/footer'); 
    }

    public function my_app_delete()
    {
        if ($this->session->userdata('hs_admin_id') == "")
        {
            redirect(base_url() . 'index.php/admin_login');
        }
            $id= $this->uri->segment(3);

            $this->db->where('appointment_id',$id);
            $this->db->delete('tbl_appointments');

            redirect('admin_appointment/my_appointments','refresh');

    }

    public function change_status()
    {
        $id= $this->uri->segment(4);
        $status= $this->uri->segment(3);

        $status_data= array(
                                'appointment_status'=>$status
                                );
        $this->db->where('appointment_id',$id);
        $this->db->update('tbl_appointments',$status_data);

        $appo_details= $this->admin_model->selectOne('tbl_appointments','appointment_id',$id);

        $patient_mob= $appo_details[0]->patient_mobile;
        $first_name= $appo_details[0]->patient_fname;
        $last_name= $appo_details[0]->patient_lname;
        $appointment_uid= $appo_details[0]->appointment_uniq_id;
        $date= $appo_details[0]->appointment_date;
        $time= $appo_details[0]->appointment_time;
        if($status=='Confirmed' || $status=='Canceled')
        {
        $this->status_sms_patient($patient_mob, $first_name,$appointment_uid,$status,$date,$time);
        }
         redirect('admin_appointment/my_appointments','refresh');
    }

    public function delete_time()
    {
        $id= $this->uri->segment(3);

        $this->db->where('time_id', $id);
        $this->db->delete('tbl_manage_timing');

         redirect('admin_appointment');
    }

    public function reschedule()
    {
        if ($this->session->userdata('hs_admin_id') == "")
        {
            redirect(base_url() . 'index.php/admin_login');
        }
        $data=$this->admin_model->selectOne('tbl_admin','admin_id',1);
        $newData=array(
                'hs_admin_id'=>$data[0]->admin_id,
                'session_name'=>$data[0]->user_name,
            );
            $this->session->set_userdata($newData);
        
        $data['active']="appointment";
        
        $appointment_id= $this->uri->segment(3);

        $data['appointment_details']= $this->admin_model->selectOne('tbl_appointments','appointment_id',$appointment_id);
        
        $appointment_date= $data['appointment_details'][0]->appointment_date;
        $app_day= date('l', strtotime($appointment_date));

        $data['appnt_time']= $this->common->select($table_name='tbl_manage_timing',$field=array(),$where=array(),$where_or=array(),$like=array('day'=>$app_day),$like_or=array(),$order=array(),$start='',$end='');

        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('appointment/appointment_edit_view',$data);
        $this->load->view('common/footer'); 
    }

     public function appointment_details()
     {
        $appointment_id= $this->input->post('appoinment_id');
        $appointment_uid= $this->input->post('appoinment_uid');
        $appointment_date= $this->input->post('app_date');
       // echo  $appointment_date;
        $data['appointment_details']= $this->admin_model->selectOne('tbl_appointments','appointment_id',$appointment_id);
       // $appointment_date= $data['appointment_details'][0]->appointment_date;
        $app_day= date('l', strtotime($appointment_date));

        $data['appnt_time']= $this->common->select($table_name='tbl_manage_timing',$field=array(),$where=array(),$where_or=array(),$like=array('day'=>$app_day),$like_or=array(),$order=array(),$start='',$end='');
        $data['appointment_date']= $appointment_date;

        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('appointment/appointment_details_view',$data);
        $this->load->view('common/footer'); 
     }

    public function update_appointment()
    {
        $patient_mob= $this->input->post('contact_no');
        $first_name= $this->input->post('first_name');
        $last_name= $this->input->post('last_name');
        $appointment_date= $this->input->post('app_date');
        $appointment_time= $this->input->post('app_time');
        $appointment_uid= $this->input->post('appoinment_uid');
        $appointment_id=  $this->input->post('appoinment_id');


        $update_data= array(
                                'appointment_date'=>$appointment_date,
                                'appointment_time'=>$appointment_time,
                                'appointment_status'=>'Confirmed'

                            );



        $this->db->where('appointment_id',$appointment_id);
        $this->db->update('tbl_appointments', $update_data);

        $this->sms_patient($patient_mob, $first_name, $appointment_date, $appointment_time, $appointment_uid);
        $this->sms_doctor(8981518696, $first_name, $last_name, $appointment_date, $appointment_time,$appointment_uid);

       redirect('admin_appointment/my_appointments_list','refresh');
    }


    function sms_patient($num,$full_name, $date, $time, $appointment_uniq_id)
    {
           $full_name=ucwords($full_name);
           $date=date('jS M Y', strtotime($date));
            $sms_text='Dear '.$full_name.', Your appointment of id '.$appointment_uniq_id. ' with Dr Roys Clinic has been rescheduled on '.$date.' at '.$time.'.';
            $msg = urlencode($sms_text);
            
           
           
$route = 4;
$senderId = 'DRNROY';
$authKey = "248027AWP2qcYdC75bf26666";

$postData = array(
'authkey' => $authKey,
'mobiles' => $num,
'message' => $msg,
'sender' => $senderId,
'route' => $route
);


$url="http://api.msg91.com/api/sendhttp.php";


$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    //,CURLOPT_FOLLOWLOCATION => true
));

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$output = curl_exec($ch);
    if(curl_errno($ch))
    {
        echo 'error:' . curl_error($ch);
    }
    curl_close($ch);
       //echo $result;
    }

    function sms_doctor($num,$full_name,$last_name, $date, $time, $appointment_uniq_id)
    {
            $full_name=ucwords($full_name);
            $last_name=ucwords($last_name);
            $date=date('jS M Y', strtotime($date));
            $patient_name=$full_name.' '.$last_name;
            $sms_text='Hello Dr Roy, Your Appointment has been rescheduled on '.$date.' at '.$time.' with '.$patient_name.'. Appointment id is: '.$appointment_uniq_id.'.';
            $msg = urlencode($sms_text);
            //$apikey= "08cRikZTIkacd44udAMHMw";
            //$apisender = "TESTIN";
           
$route = 4;
$senderId = 'DRNROY';
$authKey = "248027AWP2qcYdC75bf26666";

$postData = array(
'authkey' => $authKey,
'mobiles' => $num,
'message' => $msg,
'sender' => $senderId,
'route' => $route
);


$url="http://api.msg91.com/api/sendhttp.php";


$ch = curl_init();
curl_setopt_array($ch, array(
CURLOPT_URL => $url,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_POST => true,
CURLOPT_POSTFIELDS => $postData
    //,CURLOPT_FOLLOWLOCATION => true
));

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$output = curl_exec($ch);
    if(curl_errno($ch))
    {
        echo 'error:' . curl_error($ch);
    }
    curl_close($ch);
    }

    function status_sms_patient($num,$full_name,$appointment_uniq_id,$status,$date,$time)
    {
           $full_name=ucwords($full_name);
           $date=date('jS M Y', strtotime($date));
           if($status=='Confirmed')
           {
            $sms_text='Dear '.$full_name.', Your appointment of id '.$appointment_uniq_id. ' with Dr Roys Clinic on '.$date.' at '.$time.' has been confirmed.';
           }
           if($status=='Canceled'){
            $sms_text='Dear '.$full_name.', Your appointment of id '.$appointment_uniq_id. ' with Dr Roys Clinic on '.$date.' at '.$time.' has been canceled.';
           }
           $msg = urlencode($sms_text);
            //$apikey= "08cRikZTIkacd44udAMHMw";
            //$apisender = "TESTIN";
           
           
$route = 4;
$senderId = 'DRNROY';
$authKey = "248027AWP2qcYdC75bf26666";

$postData = array(
'authkey' => $authKey,
'mobiles' => $num,
'message' => $msg,
'sender' => $senderId,
'route' => $route
);


$url="http://api.msg91.com/api/sendhttp.php";


$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    //,CURLOPT_FOLLOWLOCATION => true
));

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$output = curl_exec($ch);
    if(curl_errno($ch))
    {
        echo 'error:' . curl_error($ch);
    }
    curl_close($ch);
    }

    function status_sms_doctor($num,$full_name,$last_name, $date, $time, $appointment_uniq_id)
    {
            $full_name=ucwords($full_name);
            $last_name=ucwords($last_name);
            $date=date('jS M Y', strtotime($date));
            $patient_name=$full_name.' '.$last_name;
            $sms_text='Hello Dr Roy, Your Appointment has been rescheduled on '.$date.' at '.$time.' with '.$patient_name.'. Appointment id is: '.$appointment_uniq_id.' To confirm the appointment please click the link: '.base_url().'admin/index.php/appointmentslist';
            $msg = urlencode($sms_text);
           // $apikey= "08cRikZTIkacd44udAMHMw";
            //$apisender = "TESTIN";
           
$route = 4;
$senderId = 'DRNROY';
$authKey = "248027AWP2qcYdC75bf26666";

$postData = array(
'authkey' => $authKey,
'mobiles' => $num,
'message' => $msg,
'sender' => $senderId,
'route' => $route
);


$url="http://api.msg91.com/api/sendhttp.php";


$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    //,CURLOPT_FOLLOWLOCATION => true
));

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$output = curl_exec($ch);
    if(curl_errno($ch))
    {
        echo 'error:' . curl_error($ch);
    }
    curl_close($ch);
    }


    function appointment_background_add()
    {
        if ($this->session->userdata('hs_admin_id') == "")
        {
            redirect(base_url() . 'index.php/admin_login');
        }
        $data['active']="appointment";
        $data['app']=$this->admin_model->fetch_all('tbl_appointment_background');
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('appointment/app_bg_view',$data);
        $this->load->view('common/footer'); 
    }


    function appointment_background_submit()
    {
        $this->load->library('image_lib');

        $data=array(
                'app_header'=>$this->input->post('app_header_text'),
            );

            $this->admin_model->update_data($data,'tbl_appointment_background','app_bg_id','1');

         if($_FILES['bg_img_upload']['name']!="")
            {
                $new_name1 = str_replace(".", "", microtime());
                $new_name = str_replace(" ", "_", $new_name1);
                $file_tmp = $_FILES['bg_img_upload']['tmp_name'];
                $file = $_FILES['bg_img_upload']['name'];
                $ext = substr(strrchr($file, '.'), 1);
                if ($ext == "png" ||  $ext == "jpg" || $ext == "jpeg")
                {
                    $old_img=$this->input->post('app_bg');
                    @unlink("../uploads/app/".$old_img);

                    move_uploaded_file($file_tmp, "../uploads/app/" . $new_name . "." . $ext);
                    $image = $new_name . "." . $ext;

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = '../uploads/app/' . $image;
                    //$config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = FALSE;
                    $config['quality'] = "100%";
                    $config['width'] = 1600;
                    $config['height'] = 192;
                    $config['master_dim'] = 'height';
                    
                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();

                    $data=array(
                        'app_bg'=>$image
                        );
                     $this->admin_model->update_data($data,'tbl_appointment_background','app_bg_id','1');
                     redirect('admin_appointment/appointment_background_add');
                }
                else
                {
                    $this->session->set_flashdata('image_error','please upload an image..!');
                    redirect('admin_appointment/appointment_background_add');
                }
            }   

             redirect('admin_appointment/appointment_background_add');  
    }

}
?>