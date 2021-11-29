<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_my_plan extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}
	
	public function index()
	{


			$user_id=@$this->session->userdata('user_session_id');


            $login_avail['user_details']=  $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

            $login_avail['active']="my_plan";


		
		 $this->load->view('common/header');
		$this->load->view('my_plan_page',$login_avail);
		$this->load->view('common/footer');
	}

	function checkout()
	{


             $plan_id=$_GET['id'];



		 $user_id=@$this->session->userdata('user_session_id');
		 if($user_id=='')
		 {
		 	$this->session->set_flashdata('wrong',"You have to login first.");
		 	redirect($this->url->link(2), 'refresh');
		 }


		 $data['user_details']=  $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		 $data['state']=  $this->common_model->common($table_name = 'state3', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		 $data['package']=  $this->common_model->common($table_name = 'tbl_package', $field = array(), $where = array('id'=>$plan_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

   //       echo '<pre>';
		 // print_r($data['user_details']); exit;


		$this->load->view('common/header');
		$this->load->view('checkout_page',$data);
		$this->load->view('common/footer');

	}



	function make_payment_package()
	{
		$user_id= $this->input->post('user_id');
		$plan_id= $this->input->post('plan_id');

		// echo $user_id;
		// echo $plan_id;


		 // $user_details=  $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		 $package=  $this->common_model->common($table_name = 'tbl_package', $field = array(), $where = array('id'=>$plan_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		 $package_type= @$package[0]->package_type;

		 // print_r($expiry_date);
		 // echo $expiry_date;

		 if($package_type=='Month')
		 {
		 	$expiry_date= date('Y-m-d', strtotime("+30 days"));
		 }
		 elseif ($package_type=='Half Year') {
		 	$expiry_date= date('Y-m-d', strtotime("+180 days"));
		 }
		 else
		 {
		 	$expiry_date= date('Y-m-d', strtotime("+365 days"));
		 }



		 $data= array(
		 	     'user_id'=>$user_id,
		 	     'package_id'=>$plan_id,
		 	     'expiry_date'=>$expiry_date,
		             );

		 if($this->db->insert('tbl_user_package_plan',$data))
		 {
		 	$result=1;
		 }
		 else
		 {
		 	$result=0;
		 }

		 echo json_encode(array('changedone'=>$result));


		





	}

	



	
	
	


	
}
?>