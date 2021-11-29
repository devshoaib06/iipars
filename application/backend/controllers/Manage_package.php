<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class manage_package extends CI_Controller 
{
	 
	  public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('upload');
        $this->load->library('session');
        $this->load->model('admin_model');
        $this->load->model('common');
        $this->load->model('url_slug_model');
	    $this->load->model('page_model');
		$this->load->library('image_lib');
        $this->load->helper('text');
		$this->session_check_and_session_data->session_check();
		
    }
	
	public function index()
	{

		if($this->session->userdata('hs_admin_id')=="")
      {
      	redirect('index.php/admin_login');
      }
        $data['active']="manage_package";

        $data['manage_package']=$this->admin_model->selectAll('tbl_package');

		$this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('package_list',$data);
        $this->load->view('common/footer');
		
	
	}

	function add_data()
	{

		if($this->session->userdata('hs_admin_id')!='')
		{
			$user_id= $this->session->userdata('hs_admin_id');
		}
		else{
			redirect('index.php/admin_login','refresh');
		}

        $data['active']="manage_package";

		$this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
		$this->load->view('package_add');
        $this->load->view('common/footer');
          
	}
	
	 function insert()
    {
    	
    	$first_title=$this->input->post('first_title');
        $price=$this->input->post('price');
         $content_details=$this->input->post('content_details');
        
       	$current_date=date('Y-m-d');
       	$id=$this->session->userdata('hs_admin_id');


    	
    	$data = array(
    					
    					
                        'package_name'=>$first_title,
    					'description'=>$content_details,
                        'price'=>$price,
    					'created_date'=>$current_date,
                        'created_by'=>$id   					
    				);
    	
    	$this->db->insert('tbl_package',$data);
    	$this->session->set_flashdata('succ_msg','added successfully');
    	redirect('manage_package','refresh');


    }
    function edit()
    {
    	if($this->session->userdata('hs_admin_id')!='')
		{
			$user_id= $this->session->userdata('hs_admin_id');
		}
		else{
			redirect('index.php/admin_login','refresh');
		}
		$edit_id=$this->uri->segment(3);

		$data['manage_package']=$this->admin_model->selectOne('tbl_package','id',$edit_id);
		 $data['active']="manage_package";

        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
		$this->load->view('package_edit',$data);
        $this->load->view('common/footer');
		

    }

    function edit_action()
    {
        $first_title=$this->input->post('first_title');
        $content_details=$this->input->post('content_details');
        $package_type=$this->input->post('package_type');
        $price=$this->input->post('price');
        
       	$edited_date=date('Y-m-d');
       	$edit_by=$this->session->userdata('hs_admin_id');
        $id=$this->input->post("id");
        
       $data = array(
    					
    					
    					'package_name'=>$first_title,
                        'package_type'=>$package_type,
                        'description'=>$content_details,
                        'price'=>$price,
                        'edited_date'=>$edited_date,
                        'edited_by'=>$edit_by   					
    				);
       // print_r($data);exit;
       $this->db->where('id',$id);
       $this->db->update('tbl_package',$data);
       $this->session->set_flashdata('succ_msg','updated successfully');
    	redirect('manage_package','refresh');

    }
    
    function delete()
    {
    	$del_id=$this->uri->segment(3);

    	
	   $this->db->where('id',$del_id);
	   $this->db->delete('tbl_package');			
	   $this->session->set_flashdata('succ_msg','deleted successfully');
			
			
	redirect('manage_package','refresh');
    }
    function change_slider_status()
{
	
		$test_ids=$this->input->post('id');
		$status=$this->input->post('status');
		$data=array('status'=>$status);


		for($i=0;$i<count($test_ids);$i++)
		{
			$id=$test_ids[$i];
			$this->db->where('id',$id);

			if($this->db->update('tbl_package',$data))
			{
				$result=1;
			}
			
		}
			
		echo json_encode(array('changedone'=>$result));
		


}



}
?>