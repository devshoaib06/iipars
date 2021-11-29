<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class sub_admin extends CI_Controller 
{ 
	 public function __construct()
     {
            parent::__construct();
			$this->load->database();
			$this->load->library('session');
			//$this->load->library('encrypt');
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->library('datalist');	
			$this->load->library('form_validation');
			$this->load->library('email');			
			$this->load->library('image_lib');
			$this->load->model('admin_model');
			//$this->load->model('search_model');
			//$this->load->model('unit_model');
			$this->load->model('sub_admin_model');
			
			//START LOGIN CHECK++++++++++++++++++++++++++++++++++++++
			$this->session_check_and_session_data->session_check();
			//END LOGIN CHECK++++++++++++++++++++++++++++++++++++++	
	 }
	 function add_sub_admin()
	 {
 
    //START PAGE PERMISSION ++++++++++++++++++++++++++++++++++++++
	$this->permission->is_allow(2);
	$data['roles']=$this->admin_model->selectAll('tbl_role');
	//END PAGE PERMISSION ++++++++++++++++++++++++++++++++++++++
		$data['active']="sub_admin";
		$this->load->view('common/header');
		$this->load->view('common/leftmenu',$data);
		$this->load->view('manage_subadmin/sub_admin_add_view',$data);
		$this->load->view('common/footer');	
	 }
	 
	 function add_sub_admin_action()
	 {
	 
	   //START PAGE PERMISSION ++++++++++++++++++++++++++++++++++++++
		//$this->permission->is_allow(2);
		//END PAGE PERMISSION ++++++++++++++++++++++++++++++++++++++
		
		$sub_admin_first_name=trim($this->input->post('sub_admin_first_name')); 
		$sub_admin_last_name=trim($this->input->post('sub_admin_last_name')); 
		 $role_id=$this->input->post('role_id');
		$unique_id='lb'.rand(0000,9999);
		$sub_admin_email=trim($this->input->post('sub_admin_email')); 
		$sub_admin_password=trim($this->input->post('sub_admin_password')); 
		
		$this->session->set_flashdata('sub_admin_first_name',$sub_admin_first_name);
		$this->session->set_flashdata('sub_admin_last_name',$sub_admin_last_name);
		
		$this->session->set_flashdata('sub_admin_email',$sub_admin_email);
		$this->session->set_flashdata('sub_admin_password',$sub_admin_password);
		//echo $sub_admin_password;exit;

		 
		  $data['sub_admin_edit_details_by_email']=$this->sub_admin_model->sub_admin_edit_details_by_email($this->input->post('sub_admin_email'));
		  
		  
		  $sub_admin_edit_details_by_email=$data['sub_admin_edit_details_by_email'];
		//print_r( $data['unit_edit_details']);exit;
		 if(count($sub_admin_edit_details_by_email)<=0)
		 {
			 //echo 'test';exit();
			$sub_admin_data=array
					(
						'first_name'=>$sub_admin_first_name,
						'last_name'=>$sub_admin_last_name,
						
						'login_email'=>$sub_admin_email,
						'login_pass'=>$sub_admin_password,
						'status'=>'active',
						'role_id'=>$role_id,
						'user_type_id'=>6,
						//'unique_id'=>$unique_id,
						'created_on'=>date('Y-m-d H:i:s')
					);
			$this->db->insert('tbl_user',$sub_admin_data);
		    $this->session->set_flashdata('message','Employee has been Added successfully.');
			redirect('sub_admin_list_manage','refresh');
		
		 }
		 else
		 {
			 if(count($sub_admin_edit_details_by_email)>0)
			 {
				 $this->session->set_flashdata('message','Employee [EMAIL:'.$sub_admin_email.'] Is Already Exist.');
			 }
			 
			 else if(count($sub_admin_edit_details_by_email)>0)
			 {
				 $this->session->set_flashdata('message','Employee [EMAIL:'.$sub_admin_email.'] Is Already Exist.'); 
			 }
			
			redirect('sub_admin/add_sub_admin','refresh');
			
		 }
	 }

	 function sub_admin_edit()
	 {
			//START PAGE PERMISSION ++++++++++++++++++++++++++++++++++++++
			$this->permission->is_allow(3);
			//END PAGE PERMISSION ++++++++++++++++++++++++++++++++++++++
		    
		    $id=$this->uri->segment(3);
			if($id)
			{
				
				$data['sub_admin_edit_details']=$this->sub_admin_model->sub_admin_edit_details($id);
				$data['active']="sub_admin";

				if(count($data['sub_admin_edit_details'])>0)
				{
					$data['roles']=$this->admin_model->selectAll('tbl_role');
					$this->load->view('common/header');
					$this->load->view('common/leftmenu',$data);
					$this->load->view('manage_subadmin/sub_admin_edit_view', $data);
					$this->load->view('common/footer');	
				}
				
			}
			
	 } 
	 function sub_admin_edit_action()
	 {
		//START PAGE PERMISSION ++++++++++++++++++++++++++++++++++++++
		$this->permission->is_allow(3);
		//END PAGE PERMISSION ++++++++++++++++++++++++++++++++++++++
		 
		  $id=$this->input->post('id'); 
		  
		  $sub_admin_password=trim($this->input->post('sub_admin_password'));
		  $sub_admin_first_name=trim($this->input->post('sub_admin_first_name')); 
		  $sub_admin_last_name=trim($this->input->post('sub_admin_last_name')); 
		 $role_id=$this->input->post('role_id');
		  $sub_admin_email=trim($this->input->post('sub_admin_email')); 
		  $sub_admin_password=trim($this->input->post('sub_admin_password')); 
		
		  $data['sub_admin_edit_details_by_email']=$this->sub_admin_model->sub_admin_edit_details_by_email($this->input->post('sub_admin_email'));
		  
		 
		 
		  
		
		  $sub_admin_edit_details_by_email=$data['sub_admin_edit_details_by_email'];
		  
		
		 if(count($sub_admin_edit_details_by_email)>0)
		 {
			if(count($sub_admin_edit_details_by_email)>0)
			{
			  	$sub_admin_edit_details_by_email_id=$sub_admin_edit_details_by_email[0]->user_id;
			}
			else
			{
				$sub_admin_edit_details_by_email_id='';
			}
			
			
			
			  if($id==$sub_admin_edit_details_by_email_id)
			  {
					$sub_admin_data=array
					(
						'first_name'=>$sub_admin_first_name,
						'last_name'=>$sub_admin_last_name,
						
						'login_email'=>$sub_admin_email,
						'login_pass'=>$sub_admin_password,
						'role_id'=>$role_id,
						'user_type_id'=>6,
						'modified_on'=>date('Y-m-d H:i:s')
					);
					$this->db->where('user_id',$id);
					$this->db->update('tbl_user',$sub_admin_data);
					$this->session->set_flashdata('message','Employee has been updated successfully.');
					
					redirect('sub_admin_list_manage','refresh');
					
			  }
			  else if($id==$sub_admin_edit_details_by_email_id)
			  {
				   $sub_admin_data=array
					(
						'first_name'=>$sub_admin_first_name,
						'last_name'=>$sub_admin_last_name,
						
						'login_email'=>$sub_admin_email,
						'login_pass'=>$sub_admin_password,
						'role_id'=>$role_id,
						'user_type_id'=>6,
						'modified_on'=>date('Y-m-d')
					);
					$this->db->where('user_id',$id);
					$this->db->update('tbl_user',$sub_admin_data);
					$this->session->set_flashdata('message','Employee has been updated successfully.');
					redirect('sub_admin_list_manage','refresh');
			  }
			  else if(count($sub_admin_edit_details_by_email)<=0)
			  {
				    $sub_admin_data=array
					(
						'first_name'=>$sub_admin_first_name,
						'last_name'=>$sub_admin_last_name,
						'role_id'=>$role_id,
						'login_email'=>$sub_admin_email,
						'login_pass'=>$sub_admin_password,
						
						'user_type_id'=>6,
						'modified_on'=>date('Y-m-d')
					);
					$this->db->where('user_id',$id);
					$this->db->update('tbl_user',$sub_admin_data);
					$this->session->set_flashdata('message','Employee has been updated successfully.');
					redirect('index.php/sub_admin_list_manage','refresh');
				  
			  }
			  else
			  {
				  if(count($sub_admin_edit_details_by_email)>0 &&$id!=$sub_admin_edit_details_by_email_id)
				  {
						$this->session->set_flashdata('message','Employee [EMAIL:'.$sub_admin_email.']  Is Already Exist.');
				  }
				 
				  else if(count($sub_admin_edit_details_by_email)>0 && $id!=$sub_admin_edit_details_by_email_id)
				  {
					   $this->session->set_flashdata('message','Employee [EMAIL:'.$sub_admin_email.'] Is Already Exist.');
				  }
				   redirect('sub_admin/sub_admin_edit/'.$id,'refresh');
			  }
		 }
		 else
		 { 
				$sub_admin_data=array
				(
					     'first_name'=>$sub_admin_first_name,
						'last_name'=>$sub_admin_last_name,
						
						'login_email'=>$sub_admin_email,
						'login_pass'=>$sub_admin_password,
						'role_id'=>$role_id,
						'user_type_id'=>6,
						'modified_on'=>date('Y-m-d')
				);
				$this->db->where('user_id',$id);
				$this->db->update('tbl_user',$sub_admin_data);
				$this->session->set_flashdata('message','Employee has been updated successfully.');
				redirect('sub_admin_list_manage','refresh');
		 }
		  
	 }

	 function history()
	 {
	 	$sub_admin_id= $this->uri->segment(3);
	 	$data['history_details']= $this->common->select($table_name='tbl_admin_history',$field=array(),$where=array('admin_id'=>$sub_admin_id),$where_or=array(),$like=array(),
	 		$like_or_array=array(),$order=array('addede_time'=>'DESC'),
			$start='',$end='');

	 	$data['sub_admin_details']= $this->common->select($table_name='tbl_admin',$field=array(),$where=array('id'=>$sub_admin_id),$like=array(),$order=array(),$where_or=array(),
			$like_or_array=array(),$start='',$end='');
	 	//echo '<pre>'; print_r($data['history_details']); exit;

	 	$this->load->view('template/admin_header');
		$this->load->view('template/admin_leftmenu');
		$this->load->view('sub_admin_history_view',$data);
		$this->load->view('template/admin_footer');	

	 }

	 function delete_history($id)
	 {
	 	//echo $id;
	 	$this->db->where('id', $id);
	 	$this->db->delete('tbl_admin_history');

	 	$this->session->set_flashdata('message','history deleted');
	 	redirect('index.php/sub_admin_list_manage','refresh');
	 }

	  public function check_email()
     {
		  $email = $this->input->post('log_email');
		  $data = $this->admin_model->check_email_model($email);

	      if (count($data) != 0) {
	         echo("email is already exist");
	      } else {
            

	  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	             //echo("<span style='color:green;'>$doctor_email is a valid email address</span>");
	         } else {
	             echo("email is not a valid email address");
	         }


	      }

   }
}

?>