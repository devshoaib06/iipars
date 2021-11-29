<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class add_controller extends CI_Controller 
{ 
	 public function __construct()
     {
            parent::__construct();
			$this->load->database();
			$this->load->library('session');
			$this->load->library('encrypt');
			$this->load->helper('url');
			$this->load->helper('form');
			
			$this->load->model('common/common_model');  /*****************/
			//$this->load->model('doctor_list_model'); /**********************/

			$this->load->library('form_validation');
			$this->load->library('email');			
			$this->load->library('image_lib');
			$this->load->model('admin_model');
			$this->load->model('search_model');
			$this->load->model('page_model');
			$this->load->model('url_slug_model');

			$this->load->model('user_page_permission_checki_availablity_view_model');
			
			//START LOGIN CHECK++++++++++++++++++++++++++++++++++++++
			$this->session_check_and_session_data->session_check();
			//END LOGIN CHECK++++++++++++++++++++++++++++++++++++++	
			
	 }
	 function index()
	{	
		$admin_details=$this->session_check_and_session_data->admin_session_data();
        $data['admin_details'] = $this->session_check_and_session_data->admin_session_data();
        
 		if(@$this->user_page_permission_checki_availablity_view_model->check_permission_for_controller('add_controller',$this->session->userdata('session_user_id'))=='Y' || $admin_details[0]->user_type_id==1)
		{
			
		$data['management_list']=$this->admin_model->selectAll('tbl_admin_management');
		$data['controller_list']=$this->admin_model->selectAll('tbl_admin_parent_page');

		
		
		$data['active']="sub_admin";
		$this->load->view('common/header');
		$this->load->view('common/leftmenu',$data);
		$this->load->view('controller_listing_view',$data);
		$this->load->view('common/footer');	
		}
		else
		{
			$this->session->set_flashdata('message','<p style="color: #ff5722; font-weight: 700;">Access Denied.</p>.');
			 redirect('dashboard','refresh');
		}
	}
	 function add_new_controller()
	 { 
		$admin_details=$this->session_check_and_session_data->admin_session_data();
        $data['admin_details'] = $this->session_check_and_session_data->admin_session_data();
        
 		if(@$this->user_page_permission_checki_availablity_view_model->check_permission_for_controller('add_controller/add_new_controller',$this->session->userdata('session_user_id'))=='Y' || $admin_details[0]->user_type_id==1)
		{ 
			//START PAGE PERMISSION ++++++++++++++++++++++++++++++++++++++
			//$this->permission->is_allow(58);
			//END PAGE PERMISSION ++++++++++++++++++++++++++++++++++++++
			
			$data['management_list']=$this->admin_model->selectAll('tbl_admin_management');
			
			$data['main_menu_section_list']=$this->page_model->all_main_menu_section_list();

		
		
		
		$data['active']="sub_admin";
			$data_user['user_fullname']='Chemeequal';
			$this->load->view('common/header');
			$this->load->view('common/leftmenu',$data);
			$this->load->view('add_controller_view',$data);
			$this->load->view('common/footer');	
		}
	    else
		{
			$this->session->set_flashdata('message','<p style="color: #ff5722; font-weight: 700;">Access Denied.</p>');
			 redirect('dashboard','refresh');
		}
		 	
	 }
	 
	 function add_controller_action()
	 {
	 
		//START PAGE PERMISSION ++++++++++++++++++++++++++++++++++++++
		//$this->permission->is_allow(58);
		//END PAGE PERMISSION ++++++++++++++++++++++++++++++++++++++
		
		$management=trim($this->input->post('management')); 
		$title=trim($this->input->post('title')); 
		$controller=trim($this->input->post('controller')); 
	
		$this->session->set_flashdata('title',$title);
		$this->session->set_flashdata('controller',$controller);		
		$this->session->set_flashdata('management',$management);
		if($management!="" && $title!="" && $controller!="")
		{
			$data=array
					(
						'management_id'=>$management,
						'title'=>$title,
						'controller'=>$controller,
						'added_time_stamp'=>"",
						'edited_time_stamp'=>""						
					);
			$this->db->insert('tbl_admin_parent_page',$data);
			
		     $this->session->set_flashdata('message','Controller  ['.$title.'] has been Added successfully.');
			 redirect('add_controller','refresh');
		}
		else
		{
			$this->session->set_flashdata('message','<p style="color:red;">Controller  ['.$title.'] has not been Added successfully.</p>');
			 redirect('add_controller','refresh');
		}
		
	 }

	 function controller_edit($id)
	 {
		$admin_details=$this->session_check_and_session_data->admin_session_data();
        $data['admin_details'] = $this->session_check_and_session_data->admin_session_data();
        
 		if(@$this->user_page_permission_checki_availablity_view_model->check_permission_for_controller('add_controller/controller_edit',$this->session->userdata('session_user_id'))=='Y' || $admin_details[0]->user_type_id==1)
		{
		$data['management_list']=$this->admin_model->selectAll('tbl_admin_management');
		$data['controller_list']=$this->admin_model->selectOne('tbl_admin_parent_page','parent_page_id',$id); 
		$data['main_menu_section_list']=$this->page_model->all_main_menu_section_list();
		$data_user['user_fullname']='Chemeequal';

		
		$data['active']="sub_admin";
		$this->load->view('common/header');
		$this->load->view('common/leftmenu',$data);
		$this->load->view('edit_controller_view',$data);
		$this->load->view('common/footer');	
		}
	    else
		{
			$this->session->set_flashdata('message','<p style="color: #ff5722; font-weight: 700;">Access Denied.</p>');
			 redirect('dashboard','refresh');
		} 
	 }
	 function controller_delete($id)
	 {
		$admin_details=$this->session_check_and_session_data->admin_session_data();
        $data['admin_details'] = $this->session_check_and_session_data->admin_session_data();
        
 		if(@$this->user_page_permission_checki_availablity_view_model->check_permission_for_controller('add_controller/controller_delete',$this->session->userdata('session_user_id'))=='Y' || $admin_details[0]->user_type_id==1)
		{ 
		$this->admin_model->delete_data('tbl_admin_parent_page','parent_page_id',$id);
		$this->session->set_flashdata('message','Controller has  been  successfully deleted.'); 
		redirect('add_controller','refresh');
		}
	    else
		{
			$this->session->set_flashdata('message','<p style="color: #ff5722; font-weight: 700;">Access Denied.</p>');
			 redirect('dashboard','refresh');
		}
	 }
	 function controller_update()
	 {
		$management=trim($this->input->post('management'));
		$controller=trim($this->input->post('controller')); 
		$title=trim($this->input->post('title'));
		$id=trim($this->input->post('id')); 
		$data=array(
			'management_id'=>$management,
			'controller'=>$controller,
			'title'=>$title,
				  );
		$this->admin_model->update_data($data,'tbl_admin_parent_page','parent_page_id',$id);
		 
		$this->session->set_flashdata('message','Controller  ['.$controller.'] has been  successfully updated.');
		redirect('add_controller','refresh');
	 }
}
?>