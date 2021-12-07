<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class seller_bussiness_profile extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	public function index()
	{
		$seller_id=$this->session->userdata('user_session_id');
		//echo $seller_id;exit;

		$data['seller_detail'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$seller_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$data['seller_company_detail'] = $this->common_model->common($table_name = 'tbl_seller_company', $field = array(), $where = array('seller_id'=>$seller_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



	    $this->load->view('common/header');
		$this->load->view('seller_bussiness_profile',$data);
		$this->load->view('common/footer');

	}

	public function seller_bussiness_profile_action()
	{
		$seller_id=$this->session->userdata('user_session_id');
		//echo $seller_id;exit;
		$chk_seller_company = $this->common_model->common($table_name = 'tbl_seller_company', $field = array(), $where = array('seller_id'=>$seller_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		

		$company_name=$this->input->post('company_name');
		$company_phone=$this->input->post('company_phone');
		$company_email=$this->input->post('company_email');
		$company_gst=$this->input->post('company_gst');
		$company_address=$this->input->post('company_address');
		$company_city=$this->input->post('company_city');
		$company_pincode=$this->input->post('company_pincode');
		$company_state=$this->input->post('company_state');


		$fname=$this->input->post('fname');
		$lname=$this->input->post('lname');
		$email=$this->input->post('email');
		$mobile=$this->input->post('mobile');

		//echo $fname;exit;
		if(count($chk_seller_company)>0)
		{
			$data=array(

				'company_name'=>$company_name,
				'company_phone'=>$company_phone,
				'company_email'=>$company_email,
				'company_gstin'=>$company_gst,
				'company_address'=>$company_address,
				'company_city'=>$company_city,
				'company_pincode'=>$company_pincode,
				'company_state'=>$company_state,
				'seller_id'=>$seller_id


			);
			$this->db->where('seller_id',$seller_id);
			$this->db->update('tbl_seller_company',$data);
			$this->session->set_flashdata('updtmsg','Data has been updated properly...');

		}
		else
		{
			$data=array(

				'company_name'=>$company_name,
				'company_phone'=>$company_phone,
				'company_email'=>$company_email,
				'company_gstin'=>$company_gst,
				'company_address'=>$company_address,
				'company_city'=>$company_city,
				'company_pincode'=>$company_pincode,
				'company_state'=>$company_state,
				'seller_id'=>$seller_id


			);

		
			$this->db->insert('tbl_seller_company',$data);
			$this->session->set_flashdata('msg','Data has been added properly...');
		}
		
		//redirect($this->url->link(21),'refresh');
	

	

	    //$hidden_seller_id=$this->input->post('hidden_seller_id');
	    	/*$this->db->where('seller_id',$seller_id);
		    $this->db->update('tbl_seller_company',$data);
			
			$this->session->set_flashdata('updtmsg','Data has been updated properly...');
			redirect($this->url->link(21),'refresh');*/
	    
		$seller_detail=array(


					'first_name'=>$fname,
					'last_name'=>$lname,
					'login_email'=>$email,
					'mobile'=>$mobile
			);
		$this->db->where('user_id',$seller_id);
		$this->db->update('tbl_user',$seller_detail);
		$this->session->set_flashdata('update','Data has been updated successfully...');
		redirect($this->url->link(21),'refresh');
	


	}
}
?>