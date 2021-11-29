<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class sub_admin_list_manage extends CI_Controller 
{
	 
	 
	 public function __construct()
     {
            parent::__construct();
			$this->load->database();
			$this->load->library('session');
			//$this->load->library('encrypt');
			$this->load->helper('url');
			
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->library('email');			
			$this->load->library('image_lib');
			$this->load->model('sub_admin_mange_list_model');	
			
			
	
	}
	
	
	function _remap($method, $params=array())
    {
        $methodToCall = method_exists($this, $method) ? $method : 'index';
        return call_user_func_array(array($this, $methodToCall), $params);
    }
	
	function index()
	{	
		$this->permission->is_allow(1);
		
		$default=$this->uri->segment(1);
		$active_inactive_value=$this->uri->segment(2);
		$data['active_inactive_value']=$active_inactive_value;
		
		$data['active']="sub_admin";
		if($active_inactive_value=='active')
		{
			$data['sub_admin_list']=$this->sub_admin_mange_list_model->sub_admin_listing_by_filter($active_inactive_value);
		}
		else if($active_inactive_value=='in-active')
		{
			$data['sub_admin_list']=$this->sub_admin_mange_list_model->sub_admin_listing_by_filter($active_inactive_value);
		}
		else
		{
			$data['sub_admin_list']=$this->sub_admin_mange_list_model->sub_admin_listing();
		}
		
		
		
	
		//print_r($data['unit_list']);exit();
		//echo 'test';exit();   
		
		$this->load->view('common/header');
		$this->load->view('common/leftmenu',$data);
		$this->load->view('manage_subadmin/sub_admin_listing_view',$data);
		$this->load->view('common/footer');	
	}
	
	function sub_admin_delete()
	{
		$this->permission->is_allow(6);

		$id=$this->uri->segment(3);
		$this->db->where('user_id', $id);
        $this->db->delete('tbl_user'); 
		
		$this->session->set_flashdata('message','Delete action is successfull...');
		redirect('sub_admin_list_manage','refresh');
		
	}
	
	function sub_admin_active_inactive()
	{
		

		$value=$this->input->post('value');
		$id=$this->input->post('id');
		$data_sub_admin_active_inactive=array(
		'status'=>$value
		);
		//echo $value;
		$this->db->where('user_id', $id); 
		$this->db->update('tbl_user',$data_sub_admin_active_inactive); 
	}	
	
	
	
	function sub_admin_active_more_than_one_id()
	{
		
		

		$sub_admin_id_all=$this->input->post('sub_admin_id');
		$sub_admin_id_array=explode(",",$sub_admin_id_all);
		for($i=0;$i<count($sub_admin_id_array);$i++)
		{
			//echo $product_id_all;
			$sub_admin_id=trim($sub_admin_id_array[$i]);
			$data_sub_admin_active_inactive=array(
			'status'=>'active'
			);
			//echo $value;
			$this->db->where('user_id', $sub_admin_id); 
			$this->db->update('tbl_user',$data_sub_admin_active_inactive); 
		}
		
		//$id=$this->input->post('id');
		
		
	}

	function change_to_active()
{
	
		$pro_ids=$this->input->post('pid');
		$status=$this->input->post('status');
		$data=array('status'=>$status);


		for($i=0;$i<count($pro_ids);$i++)
		{
			$id=$pro_ids[$i];
			$this->db->where('user_id',$id);

			if($this->db->update('tbl_user',$data))
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
	
	function sub_admin_inacactive_more_than_one_id()
	{
		

		$sub_admin_id_all=$this->input->post('sub_admin_id');
		$sub_admin_id_array=explode(",",$sub_admin_id_all);
		for($i=0;$i<count($sub_admin_id_array);$i++)
		{
			//echo $product_id_all;
			$sub_admin_id=$sub_admin_id_array[$i];
			$data_sub_admin_active_inactive=array(
			'status'=>'inactive'
			);
			//echo $value;
			$this->db->where('user_id', $sub_admin_id); 
			$this->db->update('tbl_user',$data_sub_admin_active_inactive); 
		}
	}

	public function role_management()
	{
		$data['active'] = 'role_management';
		$data['role_data'] = $this->common->select($table_name='tbl_role',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array('role_id'=>'DESC'),$start='',$end='');

		    $this->load->view('common/header');
			$this->load->view('common/leftmenu',$data);
			$this->load->view('role_management',$data);
			$this->load->view('common/footer');
	}

	public function add_role_action()
	{
		$admin_details=$this->session_check_and_session_data->admin_session_data();
		$role_title = $this->input->post('role_title');

		$data= array(
			  'role_title'=>$role_title,
			  'created_by'=>$admin_details[0]->id,
			  'created_date'=> date('Y-m-d')
			);
           $this->db->insert('tbl_role',$data);

			$this->session->set_flashdata('flash_msg','<p style="color: green; font-weight: 700;">Role has been added successfully.</p>.');
			 redirect('sub_admin_list_manage/role_management','refresh');
	}

	public function edit_role_json()
	{
		$role_id = $this->input->post('role_id');
		$role_data =  $this->common->select($table_name='tbl_role',$field=array(), $where=array('role_id'=>$role_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
		print_r( json_encode($role_data) );
	}

	public function edit_role_action()
	{
		$admin_details=$this->session_check_and_session_data->admin_session_data();
		$role_id = $this->input->post('role_id_ed');
		$role_title = $this->input->post('role_title_ed');
		$data = array(
			  'role_title'=>$role_title,
			  'edited_by'=>$admin_details[0]->id,
			  'edited_date'=> date('Y-m-d')
			);
		$this->admin_model->update_data($data,'tbl_role','role_id',$role_id);

		$this->session->set_flashdata('flash_msg','<p style="color: green; font-weight: 700;">Role has been edited successfully.</p>.');
		redirect('sub_admin_list_manage/role_management','refresh');

	}
	function delete_role()
	{

		$role_id=$this->uri->segment(3);
		$this->db->where('role_id',$role_id);
		$this->db->delete('tbl_role');
		$this->session->set_flashdata('flash_msg','<p style="color: green; font-weight: 700;">Role has been deleted successfully.</p>.');
		redirect('sub_admin_list_manage/role_management','refresh');
	}
	
		
}?>