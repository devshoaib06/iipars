<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class page extends CI_Controller 
{ 
	 public function __construct()
     {
            parent::__construct();
			$this->load->database();

			$this->load->model('admin_model');
		 	$this->load->model('url_slug_model');
			$this->load->model('page_model');
			$this->load->library('image_lib');

			
			//START LOGIN CHECK++++++++++++++++++++++++++++++++++++++
			$this->session_check_and_session_data->session_check();
			//END LOGIN CHECK++++++++++++++++++++++++++++++++++++++	
			
	 }
	 function add_page()
	 {
		$data['main_menu_section_list']=$this->page_model->all_main_menu_section_list();
		$data_user['user_fullname']='Chemeequal';
$data['active']='page_list_manage';
		$this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
		$this->load->view('page_add',$data);
		$this->load->view('common/footer');
	 }
	 
	 function add_page_action()
	 {
		
		$menu_title=trim($this->input->post('menu_title')); 
		$menu_section_id=trim($this->input->post('menu_section_id')); 
		$menu_sub_section_id=trim($this->input->post('menu_sub_section_id')); 
		
		
		$page_type_array = $this->input->post('page_type'); 
		$page_type = $page_type_array[0];
		
		$page_rout=trim($this->input->post('page_rout')); 
		$page_title=trim($this->input->post('page_title')); 
		$page_headline=trim($this->input->post('page_headline')); 
		$url=trim($this->input->post('url')); 
	
		
		$meta_title=trim($this->input->post('meta_title')); 
		$meta_description=trim($this->input->post('meta_description')); 
		$meta_keyword=trim($this->input->post('meta_keyword')); 	
		$page_content=trim($this->input->post('page_content')); 
		
		$page_slug=$this->url_slug_model->url_slug($page_title);
		
		
		$data['page_details']=$this->page_model->page_title_available_check($page_title);
		$page_details=$data['page_details'];


		
				
		for($i=0;$i<count($page_type);$i++)
		{
			if($page_type[$i]!='')
			{
				$page_type=$page_type[$i];
				//echo $page_type;exit;
				break;
			}
		}
		
		$this->session->set_flashdata('menu_title',$menu_title);
		@$menu_section_id=trim($this->input->post('menu_section_id'));
			if(empty($menu_section_id))
			{
				$menu_section_id=0;
			}
			
			@$menu_sub_section_id=trim($this->input->post('menu_sub_section_id')); 
			if(empty($menu_sub_section_id))
			{
				$menu_sub_section_id=0;
			}
		$this->session->set_flashdata('page_type',$page_type);
		
		
		$this->session->set_flashdata('page_rout',$page_rout);
		$this->session->set_flashdata('page_title',$page_title);
		$this->session->set_flashdata('page_headline',$page_headline);
		
		
		$this->session->set_flashdata('meta_title',$meta_title);
		$this->session->set_flashdata('meta_description',$meta_description);
		$this->session->set_flashdata('page_content',$page_content);
		
		
		 if(count($page_details)<=0)
		 {
			
			$rout_data=array
					(
						'slug'=>$page_slug,
						//'url'=>$url,
						'controller'=>$page_rout,
						'is_active'=>'Y',
						//'page_type'=>'static',
						'page_type'=>$page_type,
						'added_time_stamp'=>time()
					);
			$this->db->insert('app_routes',$rout_data);
			$routes_id=$this->db->insert_id();
			
			$menu_data=array
					(
						'menu_title'=>$menu_title,
						'menu_section_id'=>$menu_section_id,
						'menu_sub_section_id'=>$menu_sub_section_id,
						'added_time_stamp'=>time()
					);
			$this->db->insert('tbl_menu_manage',$menu_data);
			$menu_id=$this->db->insert_id();
			
			$page_data=array
					(
						'routes_id'=>$routes_id,
						'menu_id'=>$menu_id,
						'meta_title'=>$meta_title,
						'meta_description'=>$meta_description,
						'meta_keyword'=>$meta_keyword,
						'page_title'=>$page_title,
						'page_headline'=>$page_headline,
						'page_content'=>$page_content,
					);
			$this->db->insert('tbl_page_manage',$page_data);
			
		     $this->session->set_flashdata('message','Page  ['.$page_title.'] has been Added successfully.');
			 redirect('page_list_manage','refresh');
		 }
		 else
		 {
			 $this->session->set_flashdata('message','Page  ['.$page_title.'] Already exist.');
			 redirect('page/add_page','refresh');
		 }
	 }

	 function page_edit()
	 {
		    $data_user['user_fullname']='';
		    $id=$this->uri->segment(3);
			$data['main_menu_section_list']=$this->page_model->all_main_menu_section_list();
			if($id)
			{
				
				$data['page_details']=$this->page_model->page_details_by_id($id);
				//print_r($data['page_details']);
				if(count($data['page_details'])>0)
				{
					$data['active']="page_list_manage";
					$this->load->view('common/header',$data_user);
        			$this->load->view('common/leftmenu',$data);
					$this->load->view('page_edit', $data);
					$this->load->view('common/footer');
				}
				else
				{    $data['active']="page_list_manage";
					$data_user['page_tag']='UNIT EDIT';
					 $this->load->view('common/header',$data_user);
        			$this->load->view('common/leftmenu',$data);
					$this->load->view('no_record_found');
					$this->load->view('common/footer');
				}
			}
			else
			{     $data['active']="page_list_manage";
				   $data_user['page_tag']='UNIT EDIT';
					 $this->load->view('common/header',$data_user);
					$this->load->view('common/leftmenu',$data);
					$this->load->view('invalid_url');
					$this->load->view('common/footer');
			}
	 } 
	 function page_edit_action()
	 {
		  $id=$this->input->post('rout_id_store');
		  
		   
		    $menu_id=$this->input->post('menu_id'); 
			
			$menu_title=trim($this->input->post('menu_title')); 
			@$menu_section_id=trim($this->input->post('menu_section_id'));
			if(empty($menu_section_id))
			{
				$menu_section_id=0;
			}
			
			
			
			@$menu_sub_section_id=trim($this->input->post('menu_sub_section_id')); 
			if(empty($menu_sub_section_id))
			{
				$menu_sub_section_id=0;
			}
			$page_type_array = $this->input->post('page_type'); 
			$page_type = $page_type_array[0]; 
			//echo $page_type; exit;
			
			$page_rout=trim($this->input->post('page_rout')); 
			$page_title=trim($this->input->post('page_title')); 
			$page_headline=trim($this->input->post('page_headline')); 
			//$url=trim($this->input->post('url')); 
			
			$meta_title=trim($this->input->post('meta_title')); 
			$meta_description=trim($this->input->post('meta_description')); 	
			$meta_keyword=trim($this->input->post('meta_keyword')); 
			$page_content=trim($this->input->post('page_content')); 
			$hidden_img=$this->input->post('hidden_img');

					$image=NULL;
						
		   if(($_FILES['image']['name'])!='')
		  {
		  $new_name =time();      
		  $config['upload_path'] ='../uploads/aboutus/';
		  $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';    
		  $config['file_name']=$new_name; 
		  
		  //$this->upload->initialize($config);  
		  $this->load->library('upload', $config);  
		  //==========end:resize body_part image======================   
		  $field_name = "image"; 
		      
		  $image=NULL;   
		  if($this->upload->do_upload($field_name))
		  { 
		   //echo $new_name;exit; 
		   $file_info = $this->upload->data();
		   $original_image_file_name = $file_info['raw_name'].$file_info['file_ext'];
		   $file_size=$file_info['file_size'];
		   $this->image_lib->clear();     
		   $image =$file_info['raw_name'].$file_info['file_ext']; 
		    
		   //$new_image_name2='150_'.$file_info['raw_name'].$file_info['file_ext'];  
		          
		   //-----------------------Test new resize-------------------
		    
		   
		   
		   $image_config["image_library"] = "gd2";
		   $image_config["source_image"] ='../uploads/aboutus/'.$image;   //$upload_data["full_path"];
		   $image_config['create_thumb'] = FALSE;
		   $image_config['maintain_ratio'] =FALSE;
		   $image_config['new_image'] = '../uploads/aboutus/'.$image; //$upload_data["file_path"] . 'product.png';
		   $image_config['quality'] = "100%";
		   $image_config['width'] = 578;
		   $image_config['height']= 400;
		  //@$dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);
				//$image_config['master_dim'] = ($dim > 0)? "height" : "width";
		   $image_config['master_dim'] =  "height" ;
		   $this->image_lib->initialize($image_config);
		   $this->image_lib->resize(); 
		   $this->image_lib->clear();
		  } //end if
		        
		  }
		if($image==NULL)
		{ 
			$image=$hidden_img;

		}
		else
		{
			@unlink('../uploads/aboutus/'.$hidden_img);
		}

			$page_slug=$this->url_slug_model->url_slug($page_title);
			
			
			$data['page_title']=$this->page_model->page_title_available_check($page_title);
			$data['page_details']=$this->page_model->page_details_by_id($id);
			
			$page_details=$data['page_details'];
		
		 if(count($page_details)>0)
		 {
			 
			  if($id==$page_details[0]->id)
			  {
					$rout_data=array
								(
									'slug'=>$page_slug,
									//'url'=>$url,
									'controller'=>$page_rout,
									'is_active'=>'Y',
									//'page_type'=>'static',
									'page_type'=>$page_type,
									'edited_time_stamp'=>time()
								);
					$this->db->where('id',$id);
					$this->db->update('app_routes',$rout_data);
					
					
					$page_data=array
						(
							'menu_id'=>$menu_id,
							'meta_title'=>$meta_title,
							'meta_description'=>$meta_description,
							'meta_keyword'=>$meta_keyword,
							'page_title'=>$page_title,
							'page_headline'=>$page_headline,
							'page_content'=>$page_content,
							'image'=>$image,
						);
					$this->db->where('routes_id',$id);
					$this->db->update('tbl_page_manage',$page_data);
					
					
					
					$menu_data=array
							(
								'menu_title'=>$menu_title,
								'menu_section_id'=>$menu_section_id,
								'menu_sub_section_id'=>$menu_sub_section_id,
								'added_time_stamp'=>time()
							);
					$this->db->where('menu_id',$menu_id);
					$this->db->update('tbl_menu_manage',$menu_data);
					$menu_id=$this->db->insert_id();
					
				
					
					 $this->session->set_flashdata('message','Page  ['.$page_title.'] has been Updated successfully.');
					redirect('page_list_manage','refresh');					
			  }
			  else
			  {
				 
				 
				   redirect('sub_admin/sub_admin_edit/'.$id,'refresh');
			  }
		 }
		 else
		 { 
				$sub_admin_data=array
				(
					'user_full_name'=>$sub_admin_full_name,
					'username'=>$user_name,
					'email'=>$sub_admin_email,
					'password'=>$sub_admin_password,
					'edited_time_stamp'=>time()
				);
				$this->db->where('id',$id);
				$this->db->update('tbluser',$sub_admin_data);
				$this->session->set_flashdata('message','Sub admin has been updated successfully.');
				exit;
				//redirect('index.php/sub_admin_list_manage','refresh');
		 }
		  
	 }
	 
	 
	 
	 
	function menu_sub_section()
	{
	   $mainSectionId=$this->input->post('mainSectionId');
	   //echo  $mainSectionId;
	   $response=$this->page_model->all_sub_menu_section_list($mainSectionId);
	  echo json_encode($response);
	}
}
?>