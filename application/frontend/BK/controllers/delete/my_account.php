<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class my_account extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();
           $this->load->library('image_lib');

	}
	
	public function index()
	{
		
		$this->session->unset_userdata('search_sess_name');
		$this->session->unset_userdata('search_category');
		
		$user_id = $this->session->userdata('user_session_id');

		$data['profile_detail_show'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



		
		$this->load->view('common/header');
		$this->load->view('my_account',$data);
		$this->load->view('common/footer');
	}

	

	function profile_edit_action()
	{


		$user_id=$this->input->post('user_id');

		$fname=$this->input->post('fname');
		$lname=$this->input->post('lname');
		$email=$this->input->post('email');
		$mobile=$this->input->post('mobile');
		//$location=$this->input->post('area');
		$city=$this->input->post('city');
		$state=$this->input->post('state');
		$pincode=$this->input->post('pincode');
		$address=$this->input->post('address');



		 	  if($_FILES['img_upload']['name']=="")
        {
             $image=$this->input->post('hidden_image');
            
        }
        else
        {
            $new_name1 = str_replace(".", "", microtime());
            $new_name = str_replace(" ", "_", $new_name1);
            $file_tmp = $_FILES['img_upload']['tmp_name'];
            $file = $_FILES['img_upload']['name'];
            $ext = substr(strrchr($file, '.'), 1);
            if ($ext == "png" || $ext == "jpg" || $ext == "jpeg")
            {
            	$image=$this->input->post('hidden_image');

                @unlink('./assets/upload/user_image/'.$image);

                move_uploaded_file($file_tmp, "./assets/upload/user_image/" . $new_name . "." . $ext);

                $image = $new_name . "." . $ext;
               
           
           
                $img_config_4['image_library'] = 'gd2';
                $img_config_4['source_image'] = './assets/upload/user_image/'.$image;
                $img_config_4['create_thumb'] = FALSE;
                $img_config_4['maintain_ratio'] = FALSE;
                $img_config_4['width']  = 116;
                $img_config_4['height'] = 116;
                $img_config_4['new_image'] ='./assets/upload/user_image/'.$image;
                //echo '<pre>';print_r($img_config_4);
                $this->image_lib->initialize($img_config_4);
                $this->image_lib->resize();
                $this->image_lib->clear();

                   
             
                      

            }
            else
            {
                $this->session->set_flashdata('image_error','please upload an image..!');
                 redirect($this->url->link(5),'refresh');
            }
        }
		$data=array(

				'first_name'=>$fname,
				'last_name'=>$lname,
				'login_email'=>$email,
				'mobile'=>$mobile,
				//'area'=>$location,
				'city'=>$city,
				'state'=>$state,
				'pincode'=>$pincode,
				'address'=>$address,
				'image'=>$image


			);
		//print_r($data);exit();
		$this->db->where('user_id',$user_id);
		$this->db->update('tbl_user',$data);
		$this->session->set_flashdata('msg','Data has been Updated Successfully...');
		  redirect($this->url->link(5),'refresh');






	}


	public function change_my_password()
	{
		
		//$data['parent_category'] = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('parent_category'=>'o','sub_category'=>'o'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		
		//echo '<pre>'; print_r($data['special_offer_product_1']); exit;
		$user_id = $this->session->userdata('user_session_id');

	    $data['password'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$this->load->view('common/header');
		$this->load->view('change_password',$data);
		$this->load->view('common/footer');
	}

	function get_old_password()
    {
        
        $old_pass=$this->input->post('id');
        $old_pass_md=$old_pass;
        $user_id = $this->session->userdata('user_session_id');

        $data=$this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('login_pass'=>$old_pass_md,'user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

        //$data=$this->admin_model->selectOne('tbl_user','login_pass',$old_pass_md);
        if(count($data)==0)
        {
            $status='N';
        }
        echo json_encode(array('msg'=>$status));

    }

	function change_password_action()
	{
			$old_pass=$this->input->post('hidden_pass');
			$user_id=$this->input->post('user_id');
			//echo $old_pass;
			$old_pass_user_typing=$this->input->post('old_pass');
			$new_pass=$this->input->post('new_pass');
			$confirm_pass=$this->input->post('confirm_pass');

			
					if($old_pass==$old_pass_user_typing && $new_pass==$confirm_pass)

					{
							$data=array(

									'login_pass'=>$new_pass
								);

							$this->db->where('user_id',$user_id);
		                    $this->db->update('tbl_user',$data);
		                    $this->session->set_flashdata('succ_msg','<strong>Password Has been Changed Successfully...</strong>');
		                   redirect($this->url->link(6),'refresh');

					}

					else
					{
								$this->session->set_flashdata('error_msg','<strong>Password Not matched properly...</strong>');
		                       redirect($this->url->link(6),'refresh');

					}

		}

	public function manage_address()
	{
		
		$user_id = $this->session->userdata('user_session_id');

	    $data['address'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	    $data['default_address'] = $this->common_model->common($table_name = 'tbl_buyer_address', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		$this->load->view('common/header');
		$this->load->view('manage_address',$data);
		$this->load->view('common/footer');
	}

	public function get_manage_address()
	{
		
		$user_id = $this->session->userdata('user_session_id');
		$full_name=$this->input->post('full_name');
		$phone=$this->input->post('phone');
		$pin_code=$this->input->post('pin_code');
		$location=$this->input->post('location');
		$address=$this->input->post('address');
		$city=$this->input->post('city');
		$state=$this->input->post('state');
		$landmark=$this->input->post('landmark');
		$alt_phone=$this->input->post('alt_phone');
		$address_type=$this->input->post('radio');
		$created_date=date("Y-m-d H:i:s");
	    
	    $data=array(	
					 'user_id'=>$user_id,
					 'full_name'=>$full_name,
					 'phone'=>$phone,
					 'pin_code'=>$pin_code,
					 'location'=>$location,
					 'address'=>$address,
					 'city'=>$city,
					 'state'=>$state,
					 'landmark'=>$landmark,
					 'alt_phone'=>$alt_phone,
					 'address_type'=>$address_type,
					 'created_date'=>$created_date
					);

	    	//$this->db->where('user_id',$user_id);
		    $this->db->insert('tbl_buyer_address',$data);
		    $this->session->set_flashdata('succ_msg','<strong>Address Has been Saved Successfully...</strong>');
		    redirect($this->url->link(25),'refresh');

	}

	public function edit_manage_address()
	{
		
		$user_id = $this->session->userdata('user_session_id');
		$id = $this->uri->segment(3);
	    $data['address'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	    $data['edit_address'] = $this->common_model->common($table_name = 'tbl_buyer_address', $field = array(), $where = array('id'=>$id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		$this->load->view('common/header');
		$this->load->view('manage_address_edit',$data);
		$this->load->view('common/footer');
	}

	public function get_edited_manage_address()
	{
		
		$user_id = $this->session->userdata('user_session_id');
		$id=$this->input->post('id');
		$full_name=$this->input->post('full_name');
		$phone=$this->input->post('phone');
		$pin_code=$this->input->post('pin_code');
		$location=$this->input->post('location');
		$address=$this->input->post('address');
		$city=$this->input->post('city');
		$state=$this->input->post('state');
		$landmark=$this->input->post('landmark');
		$alt_phone=$this->input->post('alt_phone');
		$address_type=$this->input->post('radio');
		$created_date=date("Y-m-d H:i:s");
	    
	    $data=array(	
					 'user_id'=>$user_id,
					 'full_name'=>$full_name,
					 'phone'=>$phone,
					 'pin_code'=>$pin_code,
					 'location'=>$location,
					 'address'=>$address,
					 'city'=>$city,
					 'state'=>$state,
					 'landmark'=>$landmark,
					 'alt_phone'=>$alt_phone,
					 'address_type'=>$address_type,
					 'created_date'=>$created_date
					);

	    	$this->db->where('id',$id);
		    $this->db->update('tbl_buyer_address',$data);
		    $this->session->set_flashdata('succ_msg','<strong>Address Has been Modified Successfully...</strong>');
		    redirect($this->url->link(25),'refresh');

	}

	public function delete_manage_address()
	{
		
		//$user_id = $this->session->userdata('user_session_id');
		$id = $this->uri->segment(3);
	    //$data['address'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	    //$data['edit_address'] = $this->common_model->common($table_name = 'tbl_buyer_address', $field = array(), $where = array('id'=>$id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		$this->db->where('id',$id);
		$this->db->delete('tbl_buyer_address');
		$this->session->set_flashdata('succ_msg','<strong>Address Has been Deleted Successfully...</strong>');
		redirect($this->url->link(25),'refresh');

	}

	public function make_default_manage_address()
	{
		
		$user_id = $this->session->userdata('user_session_id');

		$id = $this->uri->segment(3);
	    //$data['address'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	    $data['pre_default_address'] = $this->common_model->common($table_name = 'tbl_buyer_address', $field = array(), $where = array('is_default'=>'y','user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	    //echo @$default_id=$data['pre_default_address'][0]->id; exit();

	    if (@$data['pre_default_address'][0]->is_default=='y') {

	    	@$default_id=$data['pre_default_address'][0]->id;

	    	$data=array(	
					 'is_default'=>'n'
					 
					);
	    $this->db->where('id',$default_id);
		$this->db->update('tbl_buyer_address',$data);
	    }

		$data=array(	
					 'is_default'=>'y',
					 
					);

		$this->db->where('id',$id);
		$this->db->update('tbl_buyer_address',$data);
		$this->session->set_flashdata('succ_msg','<strong></strong>');
		redirect($this->url->link(25),'refresh');

	}

	public function log_out()
	{
		$this->session->unset_userdata('user_session_id');
		$this->session->set_flashdata('log_out_acc','Successfully Log out....');
		redirect($this->url->link(3),'refresh');
		
	}

	function close_my_account()
	{
			$user_id = $this->session->userdata('user_session_id');

			$data['user_detail'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		     $this->load->view('common/header');
		     $this->load->view('user_close_account',$data);
		     $this->load->view('common/footer');
	}

	function close_account()
	{

		$user_id = $this->session->userdata('user_session_id');

		$data['acc_close'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id,'user_type_id'=>3), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		//$data['product'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('seller_id'=>$user_id,'user_type_id'=>2), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		






		
		if(@count($data['acc_close'][0])>0)
		{

			$data=array(

					'status'=>'inactive'

				      );

			$this->db->where('user_id',$user_id);
			$this->db->update('tbl_user',$data);

		
				
		}	
			$this->session->unset_userdata('user_session_id');
			$this->session->set_flashdata('close_acc','Your Account Successfully Deactivated....');
			redirect($this->url->link(3),'refresh');
		}


	
	


	
}
?>