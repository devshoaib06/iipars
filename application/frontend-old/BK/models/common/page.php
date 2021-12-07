<?php
class page extends CI_Model {

    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	
	function login_check()
	{
		
		@$session_user_data=$this->session->userdata('session_user_data');
		
		//print_r(@$session_user_data);
		@$session_user_id=$session_user_data[0]->user_id;
		
		if(trim($session_user_id))
		{
			//start data exist check
			@$user_details=@$this->common_model->common($table_name='tbl_user',$field=array(),$where=array('user_id'=>$session_user_id,'is_active'=>'Y'),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
			if(count($user_details)<=0)
			{
				//start destroy all the session
				$this->session->sess_destroy();
				//start destroy all the session
				return false;
			}
			else
			{
				return true;	
			}
			//end data exist check	
			
		}
		else
		{
			return false;
		}
		
	}
    	
	function permission_by_loged_in()
	{
		@$session_user_data=$this->session->userdata('session_user_data');
		
		//print_r(@$session_user_data);
		@$session_user_id=$session_user_data[0]->user_id;
		
		
		
		if(trim($session_user_id))
		{
			//start data exist check
			@$user_details=@$this->common_model->common($table_name='tbl_user',$field=array(),$where=array('user_id'=>$session_user_id,'is_active'=>'Y'),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
			if(count($user_details)<=0)
			{
				//start destroy all the session
				$this->session->sess_destroy();
				//start destroy all the session
				
				//start redirect to login page
				redirect($this->url->slug(58),'refresh');
				//end redirect to login page
			}
			//end data exist check
		}
		else
		{
			//start destroy all the session
			$this->session->sess_destroy();
			//start destroy all the session
			
			//start redirect to login page
			redirect($this->url->slug(58),'refresh');
			//end redirect to login page
		}
	}
	
	
	
	function link_permissionby_loged_in()
	{
		@$session_user_data=$this->session->userdata('session_user_data');
		if($session_user_data['is_login'] && trim($session_user_data['ses_user_id']) )
		{
			//start data exist check
			@$user_details=@$this->user->details_by_id($session_user_data['ses_user_id'],$is_active_action='Y');
			if(count($user_details)<=0)
			{
				//start destroy all the session
				$this->session->sess_destroy();
				//start destroy all the session
				$response='N';
			}
			else
			{
				$response='Y';
			}
			//end data exist check
		}
		else
		{
			//start destroy all the session
			$this->session->sess_destroy();
			//start destroy all the session
			$response='N';
			
		}
		return @$response;
	}
	
	
	
	function permission_by_loged_out()
	{
		@$session_user_data=$this->session->userdata('session_user_data');
		if($session_user_data['is_login'] && trim($session_user_data['ses_user_id']) )
		{
			//start data exist check
			@$user_details=@$this->user->details_by_id($session_user_data['ses_user_id'],$is_active_action='Y');
			if(count($user_details)>0)
			{
				//start redirect to login page
				redirect($this->url->slug(48),'refresh');
				//end redirect to login page
			}
			//end data exist check
		}
		
	}
	
	
}
?>