<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_service extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('customer_model');
        $this->load->model('product_model');
        $this->load->library('image_lib');

        if ($this->session->userdata('hs_admin_id')=="")
        {
            redirect(base_url().'index.php/admin_login');
        }
    }
    function index()
    {
  $admin_details=$this->session_check_and_session_data->admin_session_data();

                if(@$admin_details[0]->user_type_id!='1')
                {
                    redirect(base_url().'index.php/admin_dashboard');
                }
    	$data['active']="cc_view";

    	$data['cc_list']=$this->admin_model->selectAll('tbl_cc');
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('cc_list_view',$data);
        $this->load->view('common/footer');
    }



     function create_slug($string)

  {     

        $replace = '-';         

        $string = strtolower($string);     

 

        //replace / and . with white space     

        $string = preg_replace("/[\/\.]/", " ", $string);     

        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);     

 

        //remove multiple dashes or whitespaces     

        $string = preg_replace("/[\s-]+/", " ", $string);     

 

        //convert whitespaces and underscore to $replace     

        $string = preg_replace("/[\s_]/", $replace, $string);     

 

        //limit the slug size     

        $string = substr($string, 0, 100);     

 

        //slug is generated     

        return $string; 

    }

    function timing_view()
    {
        $data['active']="timing";

        $data['timing']=$this->admin_model->selectAll('tbl_time');
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('timing_list',$data);
        $this->load->view('common/footer');

    }

     function add_day_action()
    {

        $day=$this->input->post('day');

         $day= explode(',',$day);

        // print_r($day);exit;

       for($i=0;$i<count($day);$i++)
       {
             $data=array(

                            'day'=>$day[$i],
                           
                   );

        $this->db->insert('tbl_time',$data);

       }

       
        $this->session->set_flashdata('flash_msg','Data Successfully Submitted.');
        redirect('Admin_service/timing_view','refresh');

    }

    function add_cc_action()
    {

    	$cc_name=$this->input->post('cc_name');

    	$created_by=$this->session->userdata('hs_admin_id');
    	$created_date=date('Y-m-d');

    	$data=array(

    						'cc_name'=>$cc_name,
    						'created_date'=>$created_date,
    						'created_by'=>$created_by
    		       );

    	$this->db->insert('tbl_cc',$data);
    	$this->session->set_flashdata('flash_msg','Data Successfully Submitted.');
    	redirect('Admin_service','refresh');

    }
     public function edit_time_json()
    {
        $id = $this->input->post('id');
        $cc_data =  $this->common->select($table_name='tbl_time',$field=array(), $where=array('id'=>$id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

        $name=@$cc_data[0]->day;

        echo json_encode($name);
    }

    public function edit_cc_json()
	{
		$cc_id = $this->input->post('cc_id');
		$cc_data =  $this->common->select($table_name='tbl_cc',$field=array(), $where=array('cc_id'=>$cc_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

		$name=@$cc_data[0]->cc_name;

		echo json_encode($name);
	}

    function edit_time_action()
    {
        $id=$this->input->post('id');
        $day=$this->input->post('day');

       

        $data=array(

                            'day'=>$day,
                           
                   );
        $this->db->where('id',$id);
        $this->db->update('tbl_time',$data);
        $this->session->set_flashdata('flash_msg','Data Successfully Updated.');
        redirect('Admin_service/timing_view','refresh');

    }

	function edit_cc_action()
	{
		$cc_id=$this->input->post('cc_id');
		$cc_name=$this->input->post('cc_name');

		$edited_by=$this->session->userdata('hs_admin_id');
    	$edited_date=date('Y-m-d');

    	$data=array(

    						'cc_name'=>$cc_name,
    						'edited_by'=>$edited_by,
    						'edited_date'=>$edited_date,
    		       );
    	$this->db->where('cc_id',$cc_id);
    	$this->db->update('tbl_cc',$data);
    	$this->session->set_flashdata('flash_msg','Data Successfully Updated.');
    	redirect('Admin_service','refresh');

	}

    //manage h/o
        function ho_view()
    {

        $data['active']="ho_view";

        $data['ho_list']=$this->admin_model->selectAll('tbl_ho');
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('ho_list_view',$data);
        $this->load->view('common/footer');
    }

    //Add ho
        function add_ho_action()
    {

        $ho_name=$this->input->post('ho_name');

        $created_by=$this->session->userdata('hs_admin_id');
        $created_date=date('Y-m-d');

        $data=array(

                            'ho_name'=>$ho_name,
                            'created_date'=>$created_date,
                            'created_by'=>$created_by
                   );

        $this->db->insert('tbl_ho',$data);
        $this->session->set_flashdata('flash_msg','Data Successfully Submitted.');
        redirect('Admin_service/ho_view','refresh');

    }

    //Active/inactive ho
        function change_to_active_ho()
{
    
        $pro_ids=$this->input->post('pid');
        $status=$this->input->post('status');
        $data=array('status'=>$status);


        for($i=0;$i<count($pro_ids);$i++)
        {
            $id=$pro_ids[$i];
            $this->db->where('ho_id',$id);

            if($this->db->update('tbl_ho',$data))
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
    //end of active/inactive ho

        //edit ho
        function edit_ho_action()
    {
        $ho_id=$this->input->post('ho_id');
        $ho_name=$this->input->post('ho_name');

        $edited_by=$this->session->userdata('hs_admin_id');
        $edited_date=date('Y-m-d');

        $data=array(

                            'ho_name'=>$ho_name,
                            'edited_by'=>$edited_by,
                            'edited_date'=>$edited_date,
                   );
        $this->db->where('ho_id',$ho_id);
        $this->db->update('tbl_ho',$data);
        $this->session->set_flashdata('flash_msg','Data Successfully Updated.');
        redirect('Admin_service/ho_view','refresh');

    }
        //end of edit ho
        ///// ho delete
        function ho_delete()
    {

        $ho_id=$this->uri->segment(3);
        $this->db->where('ho_id',$ho_id);
        $this->db->delete('tbl_ho');
        $this->session->set_flashdata('flash_msg','Data Successfully Deleted.');
        redirect('Admin_service/ho_view','refresh');
    }
    ///

	function change_to_active()
{
	
		$pro_ids=$this->input->post('pid');
		$status=$this->input->post('status');
		$data=array('status'=>$status);


		for($i=0;$i<count($pro_ids);$i++)
		{
			$id=$pro_ids[$i];
			$this->db->where('cc_id',$id);

			if($this->db->update('tbl_cc',$data))
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

		function cc_delete()
	{

		$cc_id=$this->uri->segment(3);
		$this->db->where('cc_id',$cc_id);
		$this->db->delete('tbl_cc');
		$this->session->set_flashdata('flash_msg','Data Successfully Deleted.');
		redirect('Admin_service','refresh');
	}

    function time_delete()
    {

        $cc_id=$this->uri->segment(3);
        $this->db->where('id',$cc_id);
        $this->db->delete('tbl_time');
        $this->session->set_flashdata('flash_msg','Data Successfully Deleted.');
        redirect('Admin_service/timing_view','refresh');
    }
//////////////////////////////////////////////////MEdicine//////////////////////////////////////////////////////////

	function medicine_view()
	{

		$data['active']="medicine_view";

    	$data['medicine_list']=$this->admin_model->selectAll('tbl_medicine');

    	$data['group'] = $this->common->select($table_name='tbl_group',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('medicine_list_view',$data);
        $this->load->view('common/footer');
	}

	function assign_group_action()
	{

		$group=$this->input->post('group_name');
		$med_id=$this->input->post('grp_id');

		$med_id1=explode(',', $med_id);
//print_r($med_id1);exit;
		 for($i=0;$i<count($med_id1);$i++)
        {
            $med_id2=$med_id1[$i];
//print_r($med_id2);exit;
            $data=array(
            				'group_id'=>$group,
            				'medicine_id'=>$med_id2
            			);

            $chk_grp = $this->common->select($table_name='tbl_group_medicine',$field=array(), $where=array('group_id'=>$group,'medicine_id'=>$med_id2), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
            if(count($chk_grp)==0)
            {
            		$this->db->insert('tbl_group_medicine', $data);

            }
            else
            {
            		$this->db->where('medicine_id',$med_id2);
            		$this->db->where('group_id',$group);
            		$this->db->update('tbl_group_medicine',$data);
            }

            
           



        }

         $this->session->set_flashdata('flash_msg','Group Successfully Assigned.');
    	    redirect('Admin_service/medicine_view','refresh');
		//print_r($grp_id1);
	}

	function add_medicine_action()
    {

    	$medicine_name=$this->input->post('medicine_name');

    	$created_by=$this->session->userdata('hs_admin_id');
    	$created_date=date('Y-m-d');

    	$data=array(

    						'medicine_name'=>$medicine_name,
    						'created_date'=>$created_date,
    						'created_by'=>$created_by
    		       );

    	$this->db->insert('tbl_medicine',$data);
    	$this->session->set_flashdata('flash_msg','Data Successfully Submitted.');
    	redirect('Admin_service/medicine_view','refresh');

    }

    public function edit_medicine_json()
	{
		$medicine_id = $this->input->post('medicine_id');
		$medicine_data =  $this->common->select($table_name='tbl_medicine',$field=array(), $where=array('medicine_id'=>$medicine_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

		$name=@$medicine_data[0]->medicine_name;

		echo json_encode($name);
	}

	function edit_medicine_action()
	{
		$medicine_id=$this->input->post('medicine_id');
		$medicine_name=$this->input->post('medicine_name');

		$edited_by=$this->session->userdata('hs_admin_id');
    	$edited_date=date('Y-m-d');

    	$data=array(

    						'medicine_name'=>$medicine_name,
    						'edited_by'=>$edited_by,
    						'edited_date'=>$edited_date,
    		       );
    	$this->db->where('medicine_id',$medicine_id);
    	$this->db->update('tbl_medicine',$data);
    	$this->session->set_flashdata('flash_msg','Data Successfully Updated.');
    	redirect('Admin_service/medicine_view','refresh');
    }

    function change_to_active_medicine()
{
	
		$pro_ids=$this->input->post('pid');
		$status=$this->input->post('status');
		$data=array('status'=>$status);


		for($i=0;$i<count($pro_ids);$i++)
		{
			$id=$pro_ids[$i];
			$this->db->where('medicine_id',$id);

			if($this->db->update('tbl_medicine',$data))
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

    function medicine_delete()
	{

		$cc_id=$this->uri->segment(3);
		$this->db->where('medicine_id',$cc_id);
		$this->db->delete('tbl_medicine');
		$this->session->set_flashdata('flash_msg','Data Successfully Deleted.');
		redirect('Admin_service/medicine_view','refresh');
	}


	////////////////////////////////////////////////////////////Medicine Investigation////////////////////////////////////////

	function investigation_view()
	{


		$data['active']="medicine_investigation";

    	$data['investigation_list']=$this->admin_model->selectAll('tbl_investigations');
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('investigation_list_view',$data);
        $this->load->view('common/footer');
	}

	function add_investigation_action()
    {

    	$investigation_name=$this->input->post('investigation_name');

    	$created_by=$this->session->userdata('hs_admin_id');
    	$created_date=date('Y-m-d');

    	$data=array(

    						'investigation_name'=>$investigation_name,
    						'created_date'=>$created_date,
    						'created_by'=>$created_by
    		       );

    	$this->db->insert('tbl_investigations',$data);
    	$this->session->set_flashdata('flash_msg','Data Successfully Submitted.');
    	redirect('Admin_service/investigation_view','refresh');

    }

    public function edit_investigation_json()
	{
		$investigation_id = $this->input->post('investigation_id');
		$investigation_data =  $this->common->select($table_name='tbl_investigations',$field=array(), $where=array('investigation_id'=>$investigation_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

		$name=@$investigation_data[0]->investigation_name;

		echo json_encode($name);
	}

	function edit_investigation_action()
	{
		$investigation_id=$this->input->post('investigation_id');
		$investigation_name=$this->input->post('investigation_name');

		$edited_by=$this->session->userdata('hs_admin_id');
    	$edited_date=date('Y-m-d');

    	$data=array(

    						'investigation_name'=>$investigation_name,
    						'edited_by'=>$edited_by,
    						'edited_date'=>$edited_date,
    		       );
    	$this->db->where('investigation_id',$investigation_id);
    	$this->db->update('tbl_investigations',$data);
    	$this->session->set_flashdata('flash_msg','Data Successfully Updated.');
    	redirect('Admin_service/investigation_view','refresh');
    }

    function change_to_active_investigation()
{
	
		$pro_ids=$this->input->post('pid');
		$status=$this->input->post('status');
		$data=array('status'=>$status);


		for($i=0;$i<count($pro_ids);$i++)
		{
			$id=$pro_ids[$i];
			$this->db->where('investigation_id',$id);

			if($this->db->update('tbl_investigations',$data))
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

    function investigation_delete()
	{

		$investigation_id=$this->uri->segment(3);
		$this->db->where('investigation_id',$investigation_id);
		$this->db->delete('tbl_investigations');
		$this->session->set_flashdata('flash_msg','Data Successfully Deleted.');
		redirect('Admin_service/investigation_view','refresh');
	}

	///////////////////////////////////////////////////////////////Group /////////////////////////////////////////////////////

function group_view()
	{


		$data['active']="group_view";

    	$data['group_list']=$this->admin_model->selectAll('tbl_group');
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('group_list_view',$data);
        $this->load->view('common/footer');
	}

    function med_group()
    {

        $grp_id=$this->uri->segment(3);

         $data['medicines']=$this->admin_model->selectOne('tbl_group_medicine','group_id',$grp_id);

         $data['active']="group_view";
         $data['grp_id']=$grp_id;
       
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('group_assign_med_view',$data);
        $this->load->view('common/footer');
    }

	function add_group()
	{

		 $data['active']="group_view";

		$data['medicine'] =  $this->common->select($table_name='tbl_medicine',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('add_group_view',$data);
        $this->load->view('common/footer');
	}

	function add_group_action()
    {

    	$group_name = $this->input->post('group');
    	$created_by=$this->session->userdata('hs_admin_id');
    	$created_date=date('Y-m-d');

    	$med_id=$this->input->post('medicine');


    	$data=array(

    						'group_name'=>$group_name,
    						'created_date'=>$created_date,
    						'created_by'=>$created_by
    		       );



    	$this->db->insert('tbl_group',$data);

    	$group_id=$this->db->insert_id();

    	if(count($med_id)>0)
        {
            for($x=0;$x<count($med_id);$x++)
                    {
                        
                        $med_array = array(
                                                    'group_id'=>$group_id,
                                                    'medicine_id'=>$med_id[$x],
                                                                                                        
                                                );

                     
				            		$this->db->insert('tbl_group_medicine', $med_array);

                       
                    }
        }
    	

    	
    	$this->session->set_flashdata('flash_msg','Data Successfully Submitted.');
    	redirect('Admin_service/group_view','refresh');

    }

    function edit_group()
    {

    	$group_id=$this->uri->segment(3);

    	$data['medicine'] =  $this->common->select($table_name='tbl_medicine',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

    	$data['group'] =  $this->common->select($table_name='tbl_group',$field=array(), $where=array('group_id'=>$group_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

    	$data['group_med'] =  $this->common->select($table_name='tbl_group_medicine',$field=array(), $where=array('group_id'=>$group_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


    	 $data['active']="group_view";
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('edit_group_view',$data);
        $this->load->view('common/footer');


    }

  /*  public function edit_group_json()
	{
		$group_id = $this->input->post('group_id');
		$group_data =  $this->common->select($table_name='tbl_group',$field=array(), $where=array('group_id'=>$group_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

		$name=@$group_data[0]->group_name;

		echo json_encode($name);
	}*/

	function edit_group_action()
    {
    	$grp_id = $this->input->post('grp_id');
    	//echo $grp_id;exit; 
    	$group_name = $this->input->post('group');
    	$edited_by=$this->session->userdata('hs_admin_id');
    	$edited_date=date('Y-m-d');

    	$med_id=$this->input->post('medicine');


    	$data=array(

    						'group_name'=>$group_name,
    						'edited_by'=>$edited_by,
    						'edited_date'=>$edited_date
    		       );


    	$this->db->where('group_id',$grp_id);
    	$this->db->update('tbl_group',$data);

    	

    	if(count($med_id)>0)
        {

        	 $this->db->where('group_id',$grp_id);

            $this->db->delete('tbl_group_medicine');
            for($x=0;$x<count($med_id);$x++)
                    {
                        
                        $med_array = array(
                                                    'group_id'=>$grp_id,
                                                    'medicine_id'=>$med_id[$x],
                                                                                                        
                                                );

                     
				            		$this->db->insert('tbl_group_medicine', $med_array);

                       
                    }
        }
    	

    	
    	$this->session->set_flashdata('flash_msg','Data Successfully Updated.');
    	redirect('Admin_service/group_view','refresh');

    }

    function change_to_active_group()
{
	
		$pro_ids=$this->input->post('pid');
		$status=$this->input->post('status');
		$data=array('status'=>$status);


		for($i=0;$i<count($pro_ids);$i++)
		{
			$id=$pro_ids[$i];
			$this->db->where('group_id',$id);

			if($this->db->update('tbl_group',$data))
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

    function group_delete()
	{

		$group_id=$this->uri->segment(3);
		$this->db->where('group_id',$group_id);
		$this->db->delete('tbl_group');
		$this->db->where('group_id',$group_id);
		$this->db->delete('tbl_group_medicine');
		$this->session->set_flashdata('flash_msg','Data Successfully Deleted.');
		redirect('Admin_service/group_view','refresh');
	}

	///////////////////////////////////////////////////////////////////group Med////////////////////////////////////////////////

	/*function group_med_view()
	{

		$data['active']="group_med_view";

    	$data['group_med_list']=$this->admin_model->selectAll('group_medicine');
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('group_med_view',$data);
        $this->load->view('common/footer');
	}*/


	///////////////////////////////////////////////////////////// KPO /////////////////////////////////////////////////////////////////

	function kpo_view()
	{
	    $admin_details=$this->session_check_and_session_data->admin_session_data();

                if(@$admin_details[0]->user_type_id!='1')
                {
                    redirect(base_url().'index.php/admin_dashboard');
                }
		$data['active']="kpo_view";

    	$data['kpo_list']=$this->admin_model->selectAll('tbl_kpo');
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('kpo_list_view',$data);
        $this->load->view('common/footer');

	}

	function add_kpo_action()
    {

    	$kpo_name=$this->input->post('kpo_name');

    	$created_by=$this->session->userdata('hs_admin_id');
    	$created_date=date('Y-m-d');
        // echo $_FILES['image']['name']; exit;

        if($_FILES['image']['name']==NULL)

         {
             $image=NULL;
         }
        else
        {
            $new_name1 = str_replace(".", "", microtime());
            $new_name = str_replace(" ", "_", $new_name1);
            $file_tmp = $_FILES['image']['tmp_name'];
            $file = $_FILES['image']['name'];
            $ext = substr(strrchr($file, '.'), 1);
            if ($ext == "png" || $ext == "gif" || $ext == "jpg" || $ext == "jpeg")
            {
               
              
              

                move_uploaded_file($file_tmp, "../assets/upload/subject_image/" . $new_name . "." . $ext);
                $image = $new_name . "." . $ext;

                $config['image_library'] = 'gd2';
                $config['source_image'] = '../assets/upload/subject_image/' . $image;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = "100%";
               
    
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['new_image'] = '../assets/upload/subject_image/' .$image;
                $config['quality'] = "100%";
                $config['width'] = 800;
                $config['height']= 800;
                $config['master_dim'] ="height" ;

               $this->image_lib->initialize($config);
               $this->image_lib->resize(); 
               $this->image_lib->clear();
                      
            
            }
            else
            {
                $this->session->set_flashdata('flash_msg','please upload an image..!');
                redirect(base_url().'index.php/admin_service/kpo_view');
            }
        }

    	$data=array(

    						'kpo_name'=>$kpo_name,
                            'subject_image'=>$image,
    						'created_date'=>$created_date,
    						'created_by'=>$created_by
    		       );

    	$this->db->insert('tbl_kpo',$data);
    	$this->session->set_flashdata('flash_msg','Data Successfully Submitted.');
    	redirect('Admin_service/kpo_view','refresh');

    }

    public function edit_kpo_json()
	{
		$kpo_id = $this->input->post('cc_id');
		$kpo_data=  $this->common->select($table_name='tbl_cc',$field=array(), $where=array('cc_id'=>$kpo_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

		$name=@$kpo_data[0]->cc_name;

		echo json_encode($name);
	}
     public function edit_kpo_json1()
    {
        $kpo_id = $this->input->post('kpo_id');

        $kpo_data=  $this->common->select($table_name='tbl_kpo',$field=array(), $where=array('kpo_id'=>$kpo_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

        $name=@$kpo_data[0]->kpo_name;
        $subject_image=@$kpo_data[0]->subject_image;

        echo json_encode(array('subject_name'=>$name,'subject_image'=>$subject_image));
    }

    //edit ho
        public function edit_ho_json()
    {
        $ho_id = $this->input->post('ho_id');
        $ho_data=  $this->common->select($table_name='tbl_ho',$field=array(), $where=array('ho_id'=>$ho_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

        $name=@$ho_data[0]->ho_name;

        echo json_encode($name);
    }


	function edit_kpo_action()
	{
		$kpo_id=$this->input->post('kpo_id');
		$kpo_name=$this->input->post('kpo_name');
        $old_image=$this->input->post('old_image');

		$edited_by=$this->session->userdata('hs_admin_id');
    	$edited_date=date('Y-m-d');

        $slug=$this->create_slug($kpo_name);



        if($_FILES['image']['name']==NULL)

         {
             $image=NULL;
         }
        else
        {
            $new_name1 = str_replace(".", "", microtime());
            $new_name = str_replace(" ", "_", $new_name1);
            $file_tmp = $_FILES['image']['tmp_name'];
            $file = $_FILES['image']['name'];
            $ext = substr(strrchr($file, '.'), 1);
            if ($ext == "png" || $ext == "gif" || $ext == "jpg" || $ext == "jpeg")
            {
               
              
              

                move_uploaded_file($file_tmp, "../assets/upload/subject_image/" . $new_name . "." . $ext);
                $image = $new_name . "." . $ext;

                $config['image_library'] = 'gd2';
                $config['source_image'] = '../assets/upload/subject_image/' . $image;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = "100%";
               
    
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['new_image'] = '../assets/upload/subject_image/' .$image;
                $config['quality'] = "100%";
                $config['width'] = 800;
                $config['height']= 800;
                $config['master_dim'] ="height" ;

               $this->image_lib->initialize($config);
               $this->image_lib->resize(); 
               $this->image_lib->clear();
                      
            
            }
            else
            {
                $this->session->set_flashdata('flash_msg','please upload an image..!');
                redirect(base_url().'index.php/Admin_service/kpo_view');
            }
        }
          if($image=='')
          {
            $image=$old_image;
          }
          else
          {
            @unlink('../assets/upload/subject_image/'.$old_image);
            // @unlink('../assets/upload/slider/small/'.$old_img);
          }

    	$data=array(

    						'kpo_name'=>$kpo_name,
                            'subject_image'=>$image,
    						'edited_by'=>$edited_by,
    						'edited_date'=>$edited_date,
                            'slug'=>$slug
    		       );
    	$this->db->where('kpo_id',$kpo_id);
    	$this->db->update('tbl_kpo',$data);
    	$this->session->set_flashdata('flash_msg','Data Successfully Updated.');
    	redirect('Admin_service/kpo_view','refresh');

	}

	function change_to_active_kpo()
{
	
		$pro_ids=$this->input->post('pid');
		$status=$this->input->post('status');
		$data=array('status'=>$status);


		for($i=0;$i<count($pro_ids);$i++)
		{
			$id=$pro_ids[$i];
			$this->db->where('kpo_id',$id);

			if($this->db->update('tbl_kpo',$data))
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

		function kpo_delete()
	{

		$cc_id=$this->uri->segment(3);

        $kpo_data=  $this->common->select($table_name='tbl_kpo',$field=array(), $where=array('kpo_id'=>$cc_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
        
        $old_image= $kpo_data[0]->subject_image;

         if($old_image!='')
        {
        @unlink('../assets/upload/subject_image/'.$old_image);
        // @unlink('../assets/upload/slider/small/'.$old_image);
        }

		$this->db->where('kpo_id',$cc_id);
		$this->db->delete('tbl_kpo');
		$this->session->set_flashdata('flash_msg','Data Successfully Deleted.');
		redirect('Admin_service/kpo_view','refresh');
	}

	////////////////////////////////////////////////////////Diagnosis/////////////////////////////////////////////////////////////
	
	function university_view()
	{
		$data['active']="diagnosis_view";

    	$data['diagnosis_list']=$this->admin_model->selectAll('tbl_university');
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('university_view',$data);
        $this->load->view('common/footer');

	}

    function university_wise_subject()
    {
        $university_id= $this->uri->segment(3);

        $data['active']="diagnosis_view";
        

        $data['subject']=  $this->common->select($table_name='tbl_subject_for_inst',$field=array(), $where=array('inst_id'=>$university_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

        // echo 'prev';
        // print_r($subject); exit;

        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('university_wise_subject_view',$data);
        $this->load->view('common/footer');


    }



	function add_diagnosis_action()
    {

    	$diagnosis_name=$this->input->post('diagnosis_name');

    	$created_by=$this->session->userdata('hs_admin_id');
    	$created_date=date('Y-m-d');

    	$data=array(

    						'diagnosis_name'=>$diagnosis_name,
    						'created_date'=>$created_date,
    						'created_by'=>$created_by
    		       );

    	$this->db->insert('tbl_diagnosis',$data);

        $data_group_name=array(
                             'group_name'=>$diagnosis_name,

                             'created_date'=>$created_date,
                            'created_by'=>$created_by,
                            'status'=>'active'

                            );


        $this->db->insert('tbl_group',$data_group_name);


    	$this->session->set_flashdata('flash_msg','Data Successfully Submitted.');
    	redirect('Admin_service/diagnosis_view','refresh');

    }

    public function edit_diagnosis_json()
	{
		$diagnosis_id = $this->input->post('diagnosis_id');
		$diagnosis_data=  $this->common->select($table_name='tbl_diagnosis',$field=array(), $where=array('diagnosis_id'=>$diagnosis_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

		$name=@$diagnosis_data[0]->diagnosis_name;

		echo json_encode($name);
	}

	function edit_diagnosis_action()
	{
		$diagnosis_id=$this->input->post('diagnosis_id');
		$diagnosis_name=$this->input->post('diagnosis_name');

		$edited_by=$this->session->userdata('hs_admin_id');
    	$edited_date=date('Y-m-d');

    	$data=array(

    						'diagnosis_name'=>$diagnosis_name,
    						'edited_by'=>$edited_by,
    						'edited_date'=>$edited_date,
    		       );
    	$this->db->where('diagnosis_id',$diagnosis_id);
    	$this->db->update('tbl_diagnosis',$data);
    	$this->session->set_flashdata('flash_msg','Data Successfully Updated.');
    	redirect('Admin_service/diagnosis_view','refresh');

	}

	function change_to_active_diagnosis()
{
	
		$pro_ids=$this->input->post('pid');
		$status=$this->input->post('status');
		$data=array('status'=>$status);


		for($i=0;$i<count($pro_ids);$i++)
		{
			$id=$pro_ids[$i];
			$this->db->where('diagnosis_id',$id);

			if($this->db->update('tbl_diagnosis',$data))
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

		function diagnosis_delete()
	{

		$cc_id=$this->uri->segment(3);
		$this->db->where('diagnosis_id',$cc_id);
		$this->db->delete('tbl_diagnosis');
		$this->session->set_flashdata('flash_msg','Data Successfully Deleted.');
		redirect('Admin_service/diagnosis_view','refresh');
	}

	//////////////////////////////////////////////////Examination Type//////////////////////////////////////////

	function examination_type_view()
	{
	     $admin_details=$this->session_check_and_session_data->admin_session_data();

                if(@$admin_details[0]->user_type_id!='1')
                {
                    redirect(base_url().'index.php/admin_dashboard');
                }
			$data['active']="examination_type";

    	$data['examination_type_list']=$this->admin_model->selectAll('tbl_examination_type');
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('examination_type_view',$data);
        $this->load->view('common/footer');

	}

	 public function edit_examination_type_json()
	{
		$examination_type_id = $this->input->post('examination_type_id');
		$examination_type_data=  $this->common->select($table_name='tbl_examination_type',$field=array(), $where=array('examination_type_id'=>$examination_type_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

		$name=@$examination_type_data[0]->examination_type;

		echo json_encode($name);
	}

	function edit_examination_type_action()
	{
		$examination_type_id=$this->input->post('examination_type_id');
		$examination_type=$this->input->post('examination_type');

		$edited_by=$this->session->userdata('hs_admin_id');
    	$edited_date=date('Y-m-d');

    	$data=array(

    						'examination_type'=>$examination_type,
    						'edited_by'=>$edited_by,
    						'edited_date'=>$edited_date,
    		       );
    	$this->db->where('examination_type_id',$examination_type_id);
    	$this->db->update('tbl_examination_type',$data);
    	$this->session->set_flashdata('flash_msg','Data Successfully Updated.');
    	redirect('Admin_service/examination_type_view','refresh');

	}

	function add_examination_type_action()
    {

    	$examination_type=$this->input->post('examination_type');

    	$created_by=$this->session->userdata('hs_admin_id');
    	$created_date=date('Y-m-d');

    	$data=array(

    						'examination_type'=>$examination_type,
    						'created_date'=>$created_date,
    						'created_by'=>$created_by
    		       );

    	$this->db->insert('tbl_examination_type',$data);
    	$this->session->set_flashdata('flash_msg','Data Successfully Submitted.');
    	redirect('Admin_service/examination_type_view','refresh');

    }

    	function change_to_active_examination_type()
{
	
		$pro_ids=$this->input->post('pid');
		$status=$this->input->post('status');
		$data=array('status'=>$status);


		for($i=0;$i<count($pro_ids);$i++)
		{
			$id=$pro_ids[$i];
			$this->db->where('examination_type_id',$id);

			if($this->db->update('tbl_examination_type',$data))
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

		function examination_type_delete()
	{

		$cc_id=$this->uri->segment(3);
		$this->db->where('examination_type_id',$cc_id);
		$this->db->delete('tbl_examination_type');
		$this->session->set_flashdata('flash_msg','Data Successfully Deleted.');
		redirect('Admin_service/examination_type_view','refresh');
	}

	///////////////////////////////////////////////////////EXAMINATION////////////////////////////////////////////////////////////////

	function examination_view()
	{
	    
	     $admin_details=$this->session_check_and_session_data->admin_session_data();

                if(@$admin_details[0]->user_type_id!='1')
                {
                    redirect(base_url().'index.php/admin_dashboard');
                }

		$data['active']="examination_view";

    	$data['examination_list']=$this->admin_model->selectAll('tbl_examination');

        //echo "<pre>";print_r($data['examination_list']);exit;
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('examination_view',$data);
        $this->load->view('common/footer');
	}

	function add_examination()
	{

		$data['active']="examination_view";

    	//$data['examination_type']=$this->admin_model->selectAll('tbl_examination_type');

    	$data['examination_type'] = $this->common->select($table_name='tbl_examination_type',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('examination_add_view',$data);
        $this->load->view('common/footer');
	}
    
function add_university()
    {

        $data['active']="examination_view";

        //$data['examination_type']=$this->admin_model->selectAll('tbl_examination_type');

        $data['examination_type'] = $this->common->select($table_name='tbl_cc',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


        $data['subject_list'] = $this->common->select($table_name='tbl_kpo',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('university_add_view',$data);
        $this->load->view('common/footer');
    }
	function add_examination_action()
	{
		$examination_type=$this->input->post('examination_type');
		$examination_name=$this->input->post('examination');

    	$created_by=$this->session->userdata('hs_admin_id');
    	$created_date=date('Y-m-d');

    	$data=array(
    						'examination_name'=>$examination_name,	
    						'examination_type_id'=>$examination_type,
    						'created_date'=>$created_date,
    						'created_by'=>$created_by
    		       );

    	$this->db->insert('tbl_examination',$data);
    	$this->session->set_flashdata('flash_msg','Data Successfully Submitted.');
    	redirect('Admin_service/examination_view','refresh');


	}

    function add_examination_action1()
    {
        $examination_type=$this->input->post('examination_type');
        $examination_name=$this->input->post('examination');
        $website_address=$this->input->post('website_address');
        $subject_id=$this->input->post('subject_id');

        // print_r($subject_id); exit;


        $created_by=$this->session->userdata('hs_admin_id');
        $created_date=date('Y-m-d');

        $data=array(
                            'university'=>$examination_name,  
                            'university_type'=>$examination_type,
                             'website_address'=>$website_address,
                            
                   );

        $this->db->insert('tbl_university',$data);

        $inst_id= $this->db->insert_id();

        for ($i=0; $i <count($subject_id) ; $i++) { 
           $data_sub= array(
                        'inst_id'=>$inst_id,
                        'subject_id'=>$subject_id[$i]
                            );

          $this->db->insert('tbl_subject_for_inst',$data_sub);
        }


        $this->session->set_flashdata('flash_msg','Data Successfully Submitted.');
        redirect('Admin_service/university_view','refresh');


    }


	function examination_edit()
	{
       $data['active']="examination_view";
		$exam_id=$this->uri->segment(3);
		$data['exam_data']=$this->admin_model->selectOne('tbl_examination','examination_id',$exam_id);

		$data['examination_type'] = $this->common->select($table_name='tbl_examination_type',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
		//$data['examination_type']=$this->admin_model->selectAll('tbl_examination_type');
		 $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('examination_edit_view',$data);
        $this->load->view('common/footer');
	}

    function university_edit()
    {
       $data['active']="examination_view";
        $exam_id=$this->uri->segment(3);
        $data['examination_type']=$this->admin_model->selectOne('tbl_university','university_id',$exam_id);

      $data['examination_type1'] = $this->common->select($table_name='tbl_cc',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

      $data['subject_list'] = $this->common->select($table_name='tbl_kpo',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

      // $data['subject'] = $this->common->select($table_name='tbl_subject_for_inst',$field=array(), $where=array('inst_id'=>$exam_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
       
      // echo '<pre>';
      // print_r($data['subject']); exit;
        // $data['examination_type']=$this->admin_model->selectAll('tbl_examination_type');
         $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('university_edit_view',$data);
        $this->load->view('common/footer');
    }

    function edit_university_action()
    {
        $examination_type=$this->input->post('examination_type');
        $examination_name=$this->input->post('examination');
        $website_address=$this->input->post('website_address');
        $subjects=$this->input->post('subjects');

        $examination_id=$this->input->post('exam_id');

        $data=array(
                            'university'=>$examination_name,  
                            'university_type'=>$examination_type,
                             'website_address'=>$website_address,
                            
                   );

        $this->db->where('university_id',$examination_id);
        $this->db->update('tbl_university',$data);


        $this->db->where('inst_id',$examination_id);
        $this->db->delete('tbl_subject_for_inst');

        for ($i=0; $i <count($subjects) ; $i++) { 

          

             $data_sub= array(
                        'inst_id'=>$examination_id,
                        'subject_id'=>$subjects[$i]
                            );

             $this->db->insert('tbl_subject_for_inst',$data_sub);


        }






        $this->session->set_flashdata('flash_msg','Data Successfully Updated.');
        redirect('Admin_service/university_view','refresh');
    }

	function edit_examination_action()
	{
		$examination_type=$this->input->post('examination_type');
		$examination_name=$this->input->post('examination');
		$examination_id=$this->input->post('exam_id');
    	$edited_by=$this->session->userdata('hs_admin_id');
    	$edited_date=date('Y-m-d');

    	$data=array(
    						'examination_name'=>$examination_name,	
    						'examination_type_id'=>$examination_type,
    						'edited_date'=>$edited_date,
    						'edited_by'=>$edited_by
    		       );
    	$this->db->where('examination_id',$examination_id);
    	$this->db->update('tbl_examination',$data);
    	$this->session->set_flashdata('flash_msg','Data Successfully Updated.');
    	redirect('Admin_service/examination_view','refresh');


	}
	function examination_delete()
	{
		$exam_id=$this->uri->segment(3);
		$this->db->where('examination_id',$exam_id);
		$this->db->delete('tbl_examination');
		$this->session->set_flashdata('flash_msg','Data Successfully Deleted.');
		redirect('Admin_service/examination_view','refresh');
	}

    function university_delete()
    {
        $exam_id=$this->uri->segment(3);
        $this->db->where('university_id',$exam_id);
        $this->db->delete('tbl_university');
        $this->session->set_flashdata('flash_msg','Data Successfully Deleted.');
        redirect('Admin_service/university_view','refresh');
    }

    function change_to_active_university()
    {

        $pro_ids=$this->input->post('pid');
        $status=$this->input->post('status');
        $data=array('status'=>$status);


        for($i=0;$i<count($pro_ids);$i++)
        {
            $id=$pro_ids[$i];
            $this->db->where('university_id',$id);

            if($this->db->update('tbl_university',$data))
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

	function change_to_active_examination()
{
	
		$pro_ids=$this->input->post('pid');
		$status=$this->input->post('status');
		$data=array('status'=>$status);


		for($i=0;$i<count($pro_ids);$i++)
		{
			$id=$pro_ids[$i];
			$this->db->where('examination_id',$id);

			if($this->db->update('tbl_examination',$data))
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

		//////////////////////////////////////////////////////////////////Diet/////////////////////////////////////////////

		function diet_view()
		{



			$data['active']="medicine_diet";

    	$data['diet_list']=$this->admin_model->selectAll('tbl_diet');

    	
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('diet_view',$data);
        $this->load->view('common/footer');

	}

	
function add_diet()
{

  $data['diagnosis_list'] = $this->common->select($table_name='tbl_diagnosis',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
$data['active']="medicine_diet";
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('add_diet_view',$data);
        $this->load->view('common/footer');
}

function edit_diet()
{
	$diet_id=$this->uri->segment(3);

 $data['diet'] = $this->common->select($table_name='tbl_diet',$field=array(), $where=array('diet_id'=>$diet_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

  $data['diagnosis_list'] = $this->common->select($table_name='tbl_diagnosis',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
$data['active']="medicine_diet";

       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('edit_diet_view',$data);
        $this->load->view('common/footer');
}
		

	function edit_diet_action()
	{
		$diet_id=$this->input->post('diet_id');
		$diet_name=$this->input->post('diet');
		$diagnosis_name=$this->input->post('diagnosis_name1');

		$edited_by=$this->session->userdata('hs_admin_id');
    	$edited_date=date('Y-m-d');

    	$data=array(

    						'diet_name'=>$diet_name,
    						'edited_by'=>$edited_by,
    						'diagnosis_id'=>$diagnosis_name,
    						'edited_date'=>$edited_date,
    		       );
    	$this->db->where('diet_id',$diet_id);
    	$this->db->update('tbl_diet',$data);
    	$this->session->set_flashdata('flash_msg','Data Successfully Updated.');
    	redirect('Admin_service/diet_view','refresh');

	}

	function add_diet_action()
    {

    	$diet=$this->input->post('diet');

    	$diagnosis_name=$this->input->post('diagnosis_name');

    	$created_by=$this->session->userdata('hs_admin_id');
    	$created_date=date('Y-m-d');

    	$data=array(

    						'diet_name'=>$diet,
    						'created_date'=>$created_date,
    						'diagnosis_id'=>$diagnosis_name,
    						'created_by'=>$created_by
    		       );

    	$this->db->insert('tbl_diet',$data);
    	$this->session->set_flashdata('flash_msg','Data Successfully Submitted.');
    	redirect('Admin_service/diet_view','refresh');

    }

    	function change_to_active_diet()
{
	
		$pro_ids=$this->input->post('pid');
		$status=$this->input->post('status');
		$data=array('status'=>$status);


		for($i=0;$i<count($pro_ids);$i++)
		{
			$id=$pro_ids[$i];
			$this->db->where('diet_id',$id);

			if($this->db->update('tbl_diet',$data))
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

		function diet_delete()
	{

		$diet_id=$this->uri->segment(3);
		$this->db->where('diet_id',$diet_id);
		$this->db->delete('tbl_diet');
		$this->session->set_flashdata('flash_msg','Data Successfully Deleted.');
		redirect('Admin_service/diet_view','refresh');
	}

	////////////////////////////////////////////////////////////Councelling///////////////////////////////////////////////////////////////

	
function councelling_view()
		{



			$data['active']="medicine_councelling";

    	$data['councelling_list']=$this->admin_model->selectAll('tbl_councelling');

    	
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('councelling_view',$data);
        $this->load->view('common/footer');

	}

	
function add_councelling()
{

  $data['diagnosis_list'] = $this->common->select($table_name='tbl_diagnosis',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
$data['active']="medicine_councelling";
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('add_councelling_view',$data);
        $this->load->view('common/footer');
}

function edit_councelling()
{
	$councelling_id=$this->uri->segment(3);

 $data['councelling'] = $this->common->select($table_name='tbl_councelling',$field=array(), $where=array('councelling_id'=>$councelling_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

  $data['diagnosis_list'] = $this->common->select($table_name='tbl_diagnosis',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
$data['active']="medicine_councelling";

       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('edit_councelling_view',$data);
        $this->load->view('common/footer');
}
		

	function edit_councelling_action()
	{
		$councelling_id=$this->input->post('councelling_id');
		$councelling_name=$this->input->post('councelling');
		$diagnosis_name=$this->input->post('diagnosis_name1');

		$edited_by=$this->session->userdata('hs_admin_id');
    	$edited_date=date('Y-m-d');

    	$data=array(

    						'councelling_name'=>$councelling_name,
    						'edited_by'=>$edited_by,
    						'diagnosis_id'=>$diagnosis_name,
    						'edited_date'=>$edited_date,
    		       );
    	$this->db->where('councelling_id',$councelling_id);
    	$this->db->update('tbl_councelling',$data);
    	$this->session->set_flashdata('flash_msg','Data Successfully Updated.');
    	redirect('Admin_service/councelling_view','refresh');

	}

	function add_councelling_action()
    {

    	$councelling=$this->input->post('councelling');

    	$diagnosis_name=$this->input->post('diagnosis_name');

    	$created_by=$this->session->userdata('hs_admin_id');
    	$created_date=date('Y-m-d');

    	$data=array(

    						'councelling_name'=>$councelling,
    						'created_date'=>$created_date,
    						'diagnosis_id'=>$diagnosis_name,
    						'created_by'=>$created_by
    		       );

    	$this->db->insert('tbl_councelling',$data);
    	$this->session->set_flashdata('flash_msg','Data Successfully Submitted.');
    	redirect('Admin_service/councelling_view','refresh');

    }

    	function change_to_active_councelling()
{
	
		$pro_ids=$this->input->post('pid');
		$status=$this->input->post('status');
		$data=array('status'=>$status);


		for($i=0;$i<count($pro_ids);$i++)
		{
			$id=$pro_ids[$i];
			$this->db->where('councelling_id',$id);

			if($this->db->update('tbl_councelling',$data))
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

		function councelling_delete()
	{

		$diet_id=$this->uri->segment(3);
		$this->db->where('councelling_id',$diet_id);
		$this->db->delete('tbl_councelling');
		$this->session->set_flashdata('flash_msg','Data Successfully Deleted.');
		redirect('Admin_service/councelling_view','refresh');
	}

}
?>
