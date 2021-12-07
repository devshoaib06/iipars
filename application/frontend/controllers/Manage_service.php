<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class manage_service extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}
	
	public function index()
	{

	 // $data['slider'] = $this->common_model->common($table_name = 'tbl_home_slider', $field = array(), $where = array('status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		 $service_slug=$this->uri->segment(1);
		// echo $service_id;exit;

		 $service=  $this->common_model->common($table_name = 'tbl_examination', $field = array(), $where = array('slug'=>$service_slug), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		 // print_r($service[0]->examination_id ); exit;

		 $service_id= $service[0]->examination_id;

		 // print_r($service_id); exit;

		 $data= array(
		 	     'service_id'=>$service_id
		              );
		 $this->session->set_userdata($data);

		 // echo $this->session->userdata('service_id'); exit;

		  $user_id=@$this->session->userdata('user_session_id');
		 if($user_id!='')
		 {
		 	$user_sub=  $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		 	$sub_id= @$user_sub[0]->subject_id;

		 	$data['subject_details']=  $this->common_model->common($table_name = 'tbl_kpo', $field = array(), $where = array('kpo_id'=>$sub_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		 }
		 else
		 {
		 	$data['subject_details']=  $this->common_model->common($table_name = 'tbl_kpo', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		 }

		

		 $data['active']="service";


        $data['subjects']=$this->teachinns_home_model->subjects();
		$this->load->view('common/header',$data);
		$this->load->view('subject_list',$data);
		$this->load->view('common/footer');
	}


	function fetch_all_university_data()
	{


		 // $user_id=@$this->session->userdata('user_session_id');
		 // if($user_id=='')
		 // {
		 // 	$this->session->set_flashdata('wrong',"You have to login first.");
		 // 	redirect($this->url->link(2), 'refresh');
		 // }



		$univ_id= $this->input->post('query');
		$sub_id= $this->input->post('sub_id');
		$ser_id= $this->input->post('ser_id');
		// echo $ser_id;


		// $university_details= $this->common_model->common($table_name ='tbl_university', $field = array(), $where = array('university_type'=>$univ_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		// $university_id= $university_details[0]->university_id;

		// echo $university_id;


		// $form_list= $this->common_model->common($table_name ='tbl_form', $field = array(), $where = array('service_id'=>$ser_id,'subject_id'=>$sub_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


      $this->db->select("*");
      $this->db->from('tbl_form');
      $this->db->join('tbl_university','tbl_university.university_id=tbl_form.university_id	');
      
      $this->db->where('tbl_form.service_id',$ser_id);
      $this->db->where('tbl_form.subject_id',$sub_id);
      $this->db->where('tbl_university.university_type',$univ_id);
      $query = $this->db->get();
      $service_provider= $query->result();

      // print_r($service_provider);







		// print_r($university_details);
		// echo $university_details;

		?>
                                              
                                                                      <?php
                         $i=0;
                        foreach($service_provider as $un) {
                        	$i++;
                         ?>
						<a href="<?php echo base_url(); ?>manage_service/service_details?id=<?php echo $un->form_id; ?>" ><?php echo $i ?>.&nbsp;<?php echo $un->title;  ?></a>

					<?php } ?>
				
			
				





       
<?php


	}


	function institute()
	{
		// $data['active']="service";

		$subject_slug= $this->uri->segment(1);

		$subject_details=  $this->common_model->common($table_name = 'tbl_kpo', $field = array(), $where = array('slug'=>$subject_slug), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$subject_id= $subject_details[0]->kpo_id;

		// print_r($subject_id); exit;

		$data['sub_id']= $subject_id;

		// print_r($subject_id); exit;

		 // $user_id=@$this->session->userdata('user_session_id');
		 // if($user_id=='')
		 // {
		 // 	$this->session->set_flashdata('wrong',"You have to login first.");
		 // 	redirect($this->url->link(2), 'refresh');
		 // }

		$data['university']=  $this->common_model->common($table_name = 'tbl_cc', $field = array(), $where = array('status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
        $data['subjects']=$this->teachinns_home_model->subjects();
		$this->load->view('common/header',$data);
		$this->load->view('institute',$data);
		$this->load->view('common/footer');
	}



	function service_details()
	{

		// echo $this->session->userdata('form_id');

             $form_id=$_GET['id'];
            // print_r($form_id); exit;
         $data['university_type'] = $this->common->select($table_name='tbl_cc',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            // $data['subject'] = $this->common->select($table_name='tbl_kpo',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            $data['service_type'] = $this->common->select($table_name='tbl_examination_type',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            $added_by=$this->session->userdata('hs_admin_id');
            $data['form'] = $this->common->select($table_name='tbl_form',$field=array(), $where=array('form_id'=>$form_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            $uni_type=$this->common->select($table_name='tbl_university',$field=array(), $where=array('university_id'=>@$data['form'][0]->university_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


            $data['uni_type_id']=@$uni_type[0]->university_type;
             $data['uni_name']=@$uni_type[0]->university;
             $data['uni_link']=@$uni_type[0]->website_address;
             $subject= $data['form'][0]->subject_id;

             $data['subject'] = $this->common->select($table_name='tbl_kpo',$field=array(), $where=array('kpo_id '=>$subject), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


            $service_type=$this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$data['form'][0]->service_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            $data['service_type_id']=@$service_type[0]->examination_type_id;
             $data['service_name']=@$service_type[0]->examination_name;


	    $data['subjects']=$this->teachinns_home_model->subjects();
		$this->load->view('common/header',$data);
		$this->load->view('service_details',$data);
		$this->load->view('common/footer');
	}

	function form_id()
	{
		$form_id=$this->input->post('form_id');
		echo $form_id;

		$data= array(
			      'form_id'=>$form_id
		             );
		// $this->session->set_userdata($data);


		  // if($this->session->set_userdata($data))
    //         {
    //             $result=1;
    //         }
    //         else
    //         {
    //             $result=0;
    //         }


            
            
        // echo json_encode(array('changedone'=>$result));
        
	}





	
	
	


	
}
?>