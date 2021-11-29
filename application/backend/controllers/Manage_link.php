<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class manage_link extends CI_Controller 
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
        $data['active']="importain_link";

        $data['link']=$this->admin_model->selectAll('tbl_importain_link');

		$this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('importain_link_list',$data);
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

        $data['active']="importain_link";

        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('link_add');
        $this->load->view('common/footer');
          
    }


    function insert()
    {
        
        $first_title=$this->input->post('first_title');
        $link=$this->input->post('link');
        
        $current_date=date('Y-m-d');
        $id=$this->session->userdata('hs_admin_id');


        
        $data = array(
                        
                        
                        'title'=>$first_title,
                        'link'=>$link,
                        'created_date'=>$current_date,
                        'created_on'=>$id                       
                    );
        
        $this->db->insert('tbl_importain_link',$data);
        $this->session->set_flashdata('succ_msg','added successfully');
        redirect('manage_link','refresh');


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

        $data['link_details']=$this->admin_model->selectOne('tbl_importain_link','id',$edit_id);

         $data['active']="importain_link";

        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('link_edit',$data);
        $this->load->view('common/footer');
        

    }

    function edit_action()
    {
        $first_title=$this->input->post('first_title');
        $link=$this->input->post('link');
        
        $edited_date=date('Y-m-d');
        $edit_by=$this->session->userdata('hs_admin_id');
        $id=$this->input->post("id");
        
       $data = array(
                        
                        
                        'title'=>$first_title,
                        'link'=>$link,
                        'edited_date'=>$edited_date,
                        'edited_on'=>$edit_by                       
                    );
       // print_r($data);exit;
       $this->db->where('id',$id);
       $this->db->update('tbl_importain_link',$data);
       $this->session->set_flashdata('succ_msg','updated successfully');
        redirect('manage_link','refresh');

    }

    function delete()
    {
        $del_id=$this->uri->segment(3);
      
       $this->db->where('id',$del_id);
       $this->db->delete('tbl_importain_link');          
       $this->session->set_flashdata('succ_msg','deleted successfully');
            
            
    redirect('manage_link','refresh');
    }
	



}
?>