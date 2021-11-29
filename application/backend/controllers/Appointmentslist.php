<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class appointmentslist extends CI_Controller
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
        
        $data=$this->admin_model->selectOne('tbl_user','user_id',1);
        $newData=array(
                'hs_admin_id'=>$data[0]->admin_id,
                'session_name'=>$data[0]->user_name,
            );
            $this->session->set_userdata($newData);
        
        $data['active']="appointment";
        $data['appoint']=$this->admin_model->fetch_all('tbl_appointments');
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('appointment/my_appointment_view',$data);
        $this->load->view('common/footer'); 
    }

   
   public function today()
    {
        if ($this->session->userdata('hs_admin_id') == "")
        {
            redirect(base_url() . 'index.php/admin_login');
        }
        $today_date= date('m/d/Y');
        //echo $today_date;
        $day= date('l', strtotime($today_date));
        $data['appnt_time']= $this->common->select($table_name='tbl_manage_timing',$field=array(),$where=array(),$where_or=array(),$like=array('day'=>$day),$like_or=array(),$order=array(),$start='',$end='');
        $data['appointment_date']= $today_date;
         $data['active']="appointmentslist";
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('appointment/today_appointment_view',$data);
        $this->load->view('common/footer');
    }
    
    public function book_new()
    {
        if ($this->session->userdata('hs_admin_id') == "")
        {
            redirect(base_url() . 'index.php/admin_login');
        }
        $appointment_date= $this->input->post('appointment_date');
        $appointment_time= $this->input->post('appointment_time');

        //echo $appointment_date.' '.$appointment_time;

        $data['appointment_date']= $appointment_date;
        $data['appointment_time']= $appointment_time;
        $data['active']="appointmentslist";
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('appointment/book_appointment_details',$data);
        $this->load->view('common/footer');

    }

    public function book_new_action()
    {
                $first_name= $this->input->post('first_name');
                $last_name= $this->input->post('last_name');
                $patient_mob= $this->input->post('contact_no');
                $patient_email= $this->input->post('email');
                $appo_date= $this->input->post('appointment_date');
                $appo_time= $this->input->post('appointment_time');

                $patient_details= $this->common->select($table_name='tbl_user',$field=array(),$where=array('user_type_id'=>'2','mobile'=>$patient_mob),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

                 if(count($patient_details)>0)
            {
                $patient_id= $patient_details[0]->patient_id;
                
            }
            else
            {
                $patient_data= array(
                    'first_name'=>$first_name.' '.$last_name,
                    //'last_name'=>$last_name,
                    //'email'=>$patient_email,
                    'user_type_id'=>'2',
                    'mobile'=>$patient_mob,
                    'created_on'=>date('Y-m-d H:i:s')
                    );
                $this->db->insert('tbl_user', $patient_data);
                $patient_id= $this->db->insert_id();
                $password=$first_name.rand(000,999).$patient_id;

                $pass_update= array(
                                    'login_pass'=>$password
                                    );
                $this->db->where('user_id',$patient_id);
                $this->db->update('tbl_user',$pass_update);
                }   

                 $insert_data= array(
                                    'patient_fname'=>$first_name,
                                    'patient_lname'=>$last_name,
                                    'patient_mobile'=>$patient_mob,
                                    'patient_email'=>$patient_email,
                                    'appointment_date'=>$appo_date,
                                    'appointment_time'=>$appo_time,
                                     'appointment_status'=>'Confirmed',
                                    'appointment_type'=>'first_time',
                                    'patient_id'=>$patient_id,
                                   
                                    'added_date'=>date('Y-m-d H:i:s')
                                 );

           $this->db->insert('tbl_appointments', $insert_data);

           $appointment_id= $this->db->insert_id();
           $appointment_uniq_id='DRR'.rand(000,999).$appointment_id;

           $update_data= array(
                                'appointment_uniq_id'=>$appointment_uniq_id
                                );
           $this->db->where('appointment_id', $appointment_id);
           $this->db->update('tbl_appointments',$update_data);

            $this->sms_patient($patient_mob, $first_name, $appo_date, $appo_time, $appointment_uniq_id);
            $this->sms_doctor(8981518696, $first_name, $last_name, $patient_mob, $appo_date, $appo_time,$appointment_uniq_id);

         $this->session->set_flashdata('message', 'Appointment has been successfully booked');
         redirect('appointmentslist/today','refresh');

    }

    function sms_patient($num,$full_name, $date, $time, $appointment_uniq_id)
    {
           //echo 'helo';exit;
           $full_name=ucwords($full_name);
           $date=date('jS M Y', strtotime($date));
            $sms_text='Dear '.$full_name.', Your appointment with Dr Roys Clinic on '.$date.' at '.$time.' Has been confirmed. Your Appointment id is '.$appointment_uniq_id.'. To cancel the appointment please click the link: http://drroysclinic.com/appointments/index/'.$appointment_uniq_id.'';
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

    function sms_doctor($num,$full_name,$last_name, $patient_mob, $date, $time, $appointment_uniq_id)
    {
           // echo 'doc heloo'; exit;
            $full_name=ucwords($full_name);
            $last_name=ucwords($last_name);
            $date=date('jS M Y', strtotime($date));
            $patient_name=$full_name.' '.$last_name;
            $sms_text='Hello Dr Roy, A new Appointment has been booked on '.$date.' at '.$time.' with '.$patient_name.' ('.$patient_mob.'). Appointment id is: '.$appointment_uniq_id.'';
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
    }
    public function book_appointment()
    {
        if ($this->session->userdata('hs_admin_id') == "")
        {
            redirect(base_url() . 'index.php/admin_login');
        }
        $data['active']="appointmentslist";
         $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('appointment/appointment_date_view',$data);
        $this->load->view('common/footer');
    }

    public function booking_details()
    {

        if ($this->session->userdata('hs_admin_id') == "")
        {
            redirect(base_url() . 'index.php/admin_login');
        }
        $appointment_date= $this->input->post('app_date');
      
       //echo $appointment_date;
       
        $app_day= date('l', strtotime($appointment_date));
        //echo $app_day; exit;

        $data['appnt_time']= $this->common->select($table_name='tbl_manage_timing',$field=array(),$where=array(),$where_or=array(),$like=array('day'=>$app_day),$like_or=array(),$order=array(),$start='',$end='');
        $data['appointment_date']= $appointment_date;
        $data['active']="appointmentslist";
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('appointment/booking_details_view ',$data);
        $this->load->view('common/footer');
    }

    public function process()
    {
        if ($this->session->userdata('hs_admin_id') == "")
        {
            redirect(base_url() . 'index.php/admin_login');
        }

                $first_name= $this->input->post('first_name');
                $last_name= $this->input->post('last_name');
                $patient_mob= $this->input->post('contact_no');
                $patient_email= $this->input->post('email');
                $appo_date= $this->input->post('app_date');
                $appo_time= $this->input->post('app_time');
                $appo_type= $this->input->post('nature_visit');

                $patient_details= $this->common->select($table_name='tbl_user',$field=array(),$where=array('user_type_id'=>'2','mobile'=>$patient_mob),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

                 if(count($patient_details)>0)
            {
                $patient_id= $patient_details[0]->patient_id;
                
            }
            else
            {
                $patient_data= array(
                    'first_name'=>$first_name.' '.$last_name,
                    //'last_name'=>$last_name,
                    //'email'=>$patient_email,
                    'mobile'=>$patient_mob,
                    'created_on'=>date('Y-m-d H:i:s')
                    );
                $this->db->insert('tbl_user', $patient_data);
                $patient_id= $this->db->insert_id();
                $password=$first_name.rand(000,999).$patient_id;

                $pass_update= array(
                                    'login_pass'=>$password
                                    );
                $this->db->where('user_id',$patient_id);
                $this->db->update('tbl_user',$pass_update);
                }   

                 $insert_data= array(
                                    'patient_fname'=>$first_name,
                                    'patient_lname'=>$last_name,
                                    'patient_mobile'=>$patient_mob,
                                    'patient_email'=>$patient_email,
                                    'appointment_date'=>$appo_date,
                                    'appointment_time'=>$appo_time,
                                    'appointment_status'=>'Confirmed',
                                    'appointment_type'=>$appo_type,
                                    'patient_id'=>$patient_id,
                                   
                                    'added_date'=>date('Y-m-d H:i:s')
                                 );

           $this->db->insert('tbl_appointments', $insert_data);

           $appointment_id= $this->db->insert_id();
           $appointment_uniq_id='DRR'.rand(000,999).$appointment_id;

           $update_data= array(
                                'appointment_uniq_id'=>$appointment_uniq_id
                                );
           $this->db->where('appointment_id', $appointment_id);
           $this->db->update('tbl_appointments',$update_data);

            $this->sms_patient($patient_mob, $first_name, $appo_date, $appo_time, $appointment_uniq_id);
            $this->sms_doctor(8981518696, $first_name, $last_name, $patient_mob, $appo_date, $appo_time,$appointment_uniq_id);

         $this->session->set_flashdata('message', 'Appointment has been successfully booked');
         redirect('admin_appointment/my_appointments','refresh');


    }

}
?>