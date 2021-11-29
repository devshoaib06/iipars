<?php
class url extends CI_Model {

    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
		
    }
	
	function slug($id)
	{
		//echo $id;exit;
		$this->db->select('slug');
		$this->db->from('app_routes');
		$this->db->where('id',$id);	
		$query=$this->db->get();
		$result=$query->result();
		$slug=$result[0]->slug;
		return $slug;
	}
	
	function link($id)
	{
		
		//echo $id;exit;
		$this->db->select('slug');
		$this->db->from('app_routes');
		$this->db->where('id',$id);	
		$query=$this->db->get();
		$result=$query->result();
		$link=base_url().$result[0]->slug;
		return $link;
	}
	
	function make_slug($string)
	{
		//Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
		$string = strtolower($string);
		//Strip any unwanted characters
		$string = preg_replace("/[^a-z0-9_\s-]/", " ", $string);
		//Clean multiple dashes or whitespaces
		$string = preg_replace("/[\s-]+/", "-", $string);
		//Convert whitespaces and underscore to dash
		$string = preg_replace("/[\s_]/", "-", $string);
		//$string =substr_replace($string ,"",-1);//Last dashes remove
		return $string;	
	}
	
	
	
	
	function slug_exist_check($slug='')
	{
		
		 if(trim(@$slug))
		 {
		 	
		 
			//START SLUG EXIST CHECK FROM USER TBL
			@$slug_exist_check_form_user_tbl=$this->common_model->common($table_name='tbl_user',$field=array('user_id'),$where=array('user_slug'=>@$slug),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
			//END SLUG EXIST CHECK FROM USER TBL
			
			
			//START SLUG EXIST CHECK FROM APPS ROOT TABLE
			@$slug_exist_check_form_apps_rout_tbl=$this->common_model->common($table_name='app_routes',$field=array('id'),$where=array('slug'=>@$slug),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
			//END SLUG EXIST CHECK FROM APPS ROOT TABLE
			
			//START SLUG EXIST CHECK FROM DIAGNOSIS  TBL
			@$slug_exist_check_form_diagnosis_tbl=$this->common_model->common($table_name='tbl_diagnostis',$field=array('diagnostis_id'),$where=array('diagonosis_slug'=>@$slug),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
			//END SLUG EXIST CHECK FROM DIAGNOSIS  TBL
			
			
			//START SLUG EXIST CHECK FROM CITY  TBL
			@$slug_exist_check_form_diagnosis_tbl=$this->common_model->common($table_name='tbl_city',$field=array('city_id'),$where=array('city_slug'=>@$slug),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
			//END SLUG EXIST CHECK FROM CITY  TBL
			
			
		    //START SLUG EXIST CHECK FROM AREA  TBL
			@$slug_exist_check_form_diagnosis_tbl=$this->common_model->common($table_name='tbl_area',$field=array('area_id'),$where=array('area_slug'=>@$slug),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
			//END SLUG EXIST CHECK FROM AREA TBL
			
			//START SLUG EXIST CHECK FROM SERVICES  TBL
			@$slug_exist_check_form_services_tbl=$this->common_model->common($table_name='tbl_services',$field=array('service_id'),$where=array('service_slug'=>@$slug),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
			//END SLUG EXIST CHECK FROM SERVICES  TBL
			
			//START SLUG EXIST CHECK FROM SPECIALISATIONS  TBL
			@$slug_exist_check_form_specialisation_tbl=$this->common_model->common($table_name='tbl_specialization',$field=array('specialization_id'),$where=array('specialisation_slug'=>@$slug),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
			//END SLUG EXIST CHECK FROM SPECIALISATIONS  TBL
			
			//START SLUG EXIST CHECK FROM CATEGORY TBL
			@$slug_exist_check_form_user_category_tbl=$this->common_model->common($table_name='tbl_user_category',$field=array('user_category_id'),$where=array('category_slug'=>@$slug),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
			//END SLUG EXIST CHECK FROM CATEGORY TBL
			if(count(@$slug_exist_check_form_user_category_tbl)>0 || count(@$slug_exist_check_form_specialisation_tbl)>0 || count(@$slug_exist_check_form_services_tbl)>0 || count(@$slug_exist_check_form_diagnosis_tbl)>0 || count(@$slug_exist_check_form_apps_rout_tbl)>0 || count(@$slug_exist_check_form_user_tbl)>0 )
			{
				return false;
			}
			else 
			{
				return true;
			}
			
		}
		else 
		{
			echo 'THE slug should not be empty.';
		}
		
		
	}
	
	
	public function get_protocol($string='',$char_length='')
	{
		
	  $val=explode('://', base_url());
	  return $val[0];
	}

	
	
	
}
?>