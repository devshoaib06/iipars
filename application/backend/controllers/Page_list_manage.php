<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class page_list_manage extends CI_Controller 
{	 
	 public function __construct()
     {
            parent::__construct();
			$this->load->database();

			$this->load->model('admin_model');

			$this->load->library('datalist');
			$this->load->model('custom_model');	

			$this->load->model('page_list_manage_model');	

			//START LOGIN CHECK++++++++++++++++++++++++++++++++++++++
			$this->session_check_and_session_data->session_check();
			//END LOGIN CHECK++++++++++++++++++++++++++++++++++++++	
			$controller_name=$this->router->fetch_class();
            $fetch_method_name=$this->router->fetch_method();
	 }

	function _remap($method, $params=array())
    {
        $methodToCall = method_exists($this, $method) ? $method : 'index';
        return call_user_func_array(array($this, $methodToCall), $params);
    }
	
	function index()
	{	
	    $default=$this->uri->segment(1);
		$active_inactive_value=$this->uri->segment(2);
		$data['active_inactive_value']=$active_inactive_value;
		//echo $active_inactive_value;exit;
		
		if($active_inactive_value=='active')
		{
			$data['page_list']=$this->page_list_manage_model->all_page_listing_by_filter($active_inactive_value);
		}
		else if($active_inactive_value=='in-active')
		{
			$data['page_list']=$this->page_list_manage_model->all_page_listing_by_filter($active_inactive_value);
		}
		else
		{
			$data['page_list']=$this->page_list_manage_model->all_page_listing();
		}

		$data['active']='page_list_manage';
		//echo '<pre>'; print_r($data['page_list']);exit;
		$this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
		$this->load->view('page_list_view',$data);
		$this->load->view('common/footer');
	}
	
	function page_delete()
	{
		$id=$this->uri->segment(3);
		$menu_id=$this->uri->segment(4);
		
		
		$this->db->where('id', $id);
        $this->db->delete('app_routes'); 
		
		$this->db->where('routes_id', $id);
        $this->db->delete('tbl_page_manage'); 
		
		$this->db->where('menu_id', $menu_id);
        $this->db->delete('tbl_menu_manage'); 
		
		$this->session->set_flashdata('message','Delete action is successfull...');
		redirect('index.php/page_list_manage','refresh');
	}
	
	function unit_active_inactive()
	{
		$value=$this->input->post('value');
		$id=$this->input->post('id');
		$data_unit_active_inactive=array(
		'is_active'=>$value
		);
		//echo $value;
		$this->db->where('unit_id', $id); 
		$this->db->update('tbl_unit_manage', $data_unit_active_inactive); 
	}	
	
	
	
	
	function page_active_more_than_one_id()
	{
		$page_id_all=$this->input->post('id');
		$page_id_all=explode(",",$page_id_all);
		for($i=0;$i<count($page_id_all);$i++)
		{
			$id=trim($page_id_all[$i]);
			$rout_data=array
					(
						
						'is_active'=>'Y',
						'edited_time_stamp'=>time()
					);
			$this->db->where('id',$id);
			$this->db->update('app_routes',$rout_data);
		}
		
		
	}
	
	
	
	function page_in_active_more_than_one_id()
	{
		$page_id_all=$this->input->post('id');
		$page_id_all=explode(",",$page_id_all);
		for($i=0;$i<count($page_id_all);$i++)
		{
			$id=trim($page_id_all[$i]);
			$rout_data=array
					(
						'is_active'=>'N'
					);
			$this->db->where('id',$id);
			$this->db->update('app_routes',$rout_data);
		}
	}
		
}?>