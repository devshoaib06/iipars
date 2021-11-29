<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class page_permission extends CI_Controller 
{
	 
	 public function __construct()
     {
            parent::__construct();
			$this->load->database();
			$this->load->library('session');
			$this->load->library('encrypt');
			$this->load->helper('url');
			
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->library('email');			
			$this->load->library('image_lib');
			
			//$this->load->model('unit_list_manage_model');
			$this->load->model('page_permission_model');	
			
			//START LOGIN CHECK++++++++++++++++++++++++++++++++++++++
			$this->session_check_and_session_data->session_check();
			//END LOGIN CHECK++++++++++++++++++++++++++++++++++++++	
			$admin_details=$this->session_check_and_session_data->admin_session_data();
		    //START PERMISSION
		
			$this->permission->is_allow(67);
			//END  PERMISSION
	}
	
	function _remap($method, $params=array())
    {
        $methodToCall = method_exists($this, $method) ? $method : 'index';
        return call_user_func_array(array($this, $methodToCall), $params);
    }
	
	function index()
	{	
	    $data['sub_admin_user_id']=$this->uri->segment(2);
		//echo $data['sub_admin_user_id'];
		$allow_dis_allow_value=$this->uri->segment(2);
		//echo $data['sub_admin_user_id'];
		$data['allow_dis_allow_value']=$allow_dis_allow_value;
		//echo $allow_dis_allow_value;exit;
		
		//@$data['admin_page_list']=$this->page_permission_model->all_permission_page_listing($data['sub_admin_user_id']);
		if($allow_dis_allow_value=='allow')
		{
			$data['admin_page_list']=$this->page_permission_model->all_page_permission_listing_by_filter($allow_dis_allow_value);
		}
		else if($allow_dis_allow_value=='dis-allow')
		{
			$data['admin_page_list']=$this->page_permission_model->all_page_permission_listing_by_filter($allow_dis_allow_value);
		}
		else
		{
			$data['admin_page_list']=$this->page_permission_model->all_permission_page_listing($data['sub_admin_user_id']);
		}

		$data['sub_admin_management_list']=$this->common->select($table_name='tbl_admin_management',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
		
		$data['active']="sub_admin";
		
		$this->load->view('common/header');
		$this->load->view('common/leftmenu',$data);
		$this->load->view('manage_subadmin/page_permission_view',$data);
		$this->load->view('common/footer');	
	}
	
	function unit_delete()
	{
		$id=$this->uri->segment(3);
		$this->db->where('unit_id', $id);
        $this->db->delete('tbl_unit_manage'); 
		$this->session->set_flashdata('message','Delete action is successfull...');
		redirect('index.php/unit_list_manage','refresh');
	}
	
	function unit_allow_inallow()
	{
		$value=$this->input->post('value');
		$id=$this->input->post('id');
		$data_unit_allow_inallow=array(
		'is_allow'=>$value
		);
		//echo $value;
		$this->db->where('unit_id', $id); 
		$this->db->update('tbl_unit_manage', $data_unit_allow_inallow); 
	}	
	
	
	
	
	function permission_allow_more_than_one_id()
	{
		$admin_details=$this->session_check_and_session_data->admin_session_data();
		$page_id_all=$this->input->post('page_id');
		$user_id=$this->input->post('user_id');
		$page_id_array=explode(",",$page_id_all);
		for($i=0;$i<count($page_id_array);$i++)
		{
			$page_id=trim($page_id_array[$i]);
			$response=$this->page_permission_model->user_permission_availability_check($user_id,$page_id);
			//echo $product_id_all;
			if(count($response)<=0)
			{
			
				$page_permission_allow_data=array(
				'admin_user_id'=>$user_id,
				'page_id'=>$page_id,
				'is_view'=>'Y'
				);
				//echo $value;
				$this->db->insert('tbl_admin_user_page_permission', $page_permission_allow_data);

			}
			else
			{
				$page_permission_allow_data=array(
				'is_view'=>'Y'
				);
				//echo $value;
				$this->db->where('page_id', $page_id); 
				$this->db->where('admin_user_id',$user_id); 
				$this->db->update('tbl_admin_user_page_permission', $page_permission_allow_data); 
			}
		}
		//$id=$this->input->post('id');
	}
	
	
	
	function permisson_dis_allow_more_than_one_id()
	{
		$admin_details=$this->session_check_and_session_data->admin_session_data();
		$page_id_all=$this->input->post('page_id');
		$user_id=$this->input->post('user_id');
		$page_id_array=explode(",",$page_id_all);
		for($i=0;$i<count($page_id_array);$i++)
		{
			$page_id=trim($page_id_array[$i]);
			$response=$this->page_permission_model->user_permission_availability_check($user_id,$page_id);
			//echo $product_id_all;
			if(count($response)<=0)
			{
			
				$page_permission_allow_data=array(
				'admin_user_id'=>$user_id,
				'page_id'=>$page_id,
				'is_view'=>'N'
				);
				//echo $value;
				$this->db->insert('tbl_admin_user_page_permission', $page_permission_allow_data);

			}
			else
			{
				$page_permission_allow_data=array(
				'is_view'=>'N'
				);
				//echo $value;
				$this->db->where('page_id', $page_id); 
				$this->db->update('tbl_admin_user_page_permission', $page_permission_allow_data); 
			}
		}
		//$id=$this->input->post('id');
	}
	
	
	
	
	
	
	
		
}?>