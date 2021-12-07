<?php
class common extends CI_Model
{

    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	public function select($table_name='',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_sort=array())
	{
		if(trim($table_name))
		{
			if(count($field)>0)
			{
				 $field=implode(',',$field);
			}
			else
			{
				$field='*';
			}
			
			$this->db->select($field);  
			$this->db->from($table_name); 
			
			if(count($where)>0)
			{
			
				foreach($where as $key=>$val)
				{
					if(trim($val))
					{
						$this->db->where($key,$val);
					} 
				}
			
			
			
			}
			
			
			
		if(count($where_sort)>0)
		{
			foreach($where_sort as $key=>$val)
			{
				
				//echo $val;
				if(trim($val))
				{
					$this->db->where($key,$val);
				} 
			}
		
		} 
			
			
			if(count($where_or)>0)
			{
				foreach($where_or as $key=>$val)
				{
					if(trim($val))
					{
							
						$this->db->or_where($key,$val);
					} 
				}
			}
			
			if(count($order)>0)
			{
			
				foreach($order as $key=>$val)
				{
					if(trim($val))
					{
						$this->db->order_by($key,$val);
					} 
				}
			
			}
			
			if(count($like)>0)
			{
			
				foreach($like as $key=>$val)
				{
					if(trim($val))
					{
					   $this->db->like($key,$val);
					 
					} 
				}
			
			}

			if(count($like_or)>0)
			{
			
				foreach($like_or as $key=>$val)
				{
					if(trim($val))
					{
					   $this->db->or_like($key,$val);
					 
					} 
				}
			
			}
			
			
			if($end)
			{

				$this->db->limit($end,$start);
			}
			 
			$query = $this->db->get();
			$resultResponse=$query->result();
			return $resultResponse;
					
			}
			else
			{
					 echo 'Table name should no empty';exit;
			}
	
	}
	
	
	
	public function select_max($table_name='',$field=array(),$where=array())
	{
		
		if(trim($table_name))
		{
			if(count($field)>0)
			{
					
				$field=implode(',',$field);
				$this->db->select_max($field); 
				$this->db->from($table_name); 
				
				if(count($where)>0)
				{
				
					foreach($where as $key=>$val)
					{
						if(trim($val))
						{
							$this->db->where($key,$val);
						} 
					}
				
				}
				
				$query = $this->db->get();
				$resultResponse=$query->result();
				return @$resultResponse;
			}
			else
			{
				 echo 'Please provied a field name';exit;
			}
					
			}
			else
			{
					 echo 'Table name should no empty';exit;
			}
	
	}	
	
	
	public function char_truncate($string='',$char_length='')
	{
	  if($string && $char_length>0 )
	  {
	 
		$string1= character_limiter($string, 1);
	  }
	  return @$string1;
	}
	
	public function get_protocol($string='',$char_length='')
	{
		
	  $val=explode('://', base_url());
	  return $val[0];
	}
	
	public function base_url2()
	{
		 @$val=explode('admin', base_url());
		  return @$val[0];
	}

	public function get_pro_details($status)
	{
		$this->db->select('p.*, b.brand_name, s.full_name');
		$this->db->from('tbl_product p');
		
		$this->db->join('tbl_brand b', 'p.brand_id= b.brand_id','left');
		$this->db->join('tbl_seller s','p.product_added_by= s.seller_id','left');
		if($status !='')
		{
			$this->db->where('p.product_approval',$status);
		}
		$query = $this->db->get();
		$resultResponse=$query->result();
		return @$resultResponse;
	}

	public function get_view_details($p_id)
	{
		$this->db->select('p.*, c.category_name, b.brand_name, s.full_name');
		$this->db->from('tbl_product p');
		$this->db->join('tbl_category c','p.category_id= c.category_id','left');
		$this->db->join('tbl_brand b', 'p.brand_id= b.brand_id','left');
		$this->db->join('tbl_seller s','p.product_added_by= s.seller_id','left');
		$this->db->where('p.product_id',$p_id);
	
		$query = $this->db->get();
		$resultResponse=$query->result();
		return @$resultResponse;
	}

	public function get_tyre_list()
	{
		$this->db->select('t.*, m.tyre_make_name, mm.tyre_make_model_name, b.tyre_brand_name');
		$this->db->from('tbl_tyre_list t');
		$this->db->join('tbl_tyre_make m','t.tyre_make_id= m.tyre_make_id','left');
		$this->db->join('tbl_tyre_make_model mm','t.tyre_make_model_id= mm.tyre_make_model_id','left');
		$this->db->join('tbl_tyre_brand b','t.tyre_brand_id= b.tyre_brand_id','left');

		$query = $this->db->get();
		$resultResponse=$query->result();
		return @$resultResponse;
	}

	public function get_tyre_list_by_brand($tyre_brand_id)
	{
		$this->db->select('t.*, m.tyre_make_name, mm.tyre_make_model_name, b.tyre_brand_name');
		$this->db->from('tbl_tyre_list t');
		$this->db->join('tbl_tyre_make m','t.tyre_make_id= m.tyre_make_id','left');
		$this->db->join('tbl_tyre_make_model mm','t.tyre_make_model_id= mm.tyre_make_model_id','left');
		$this->db->join('tbl_tyre_brand b','t.tyre_brand_id= b.tyre_brand_id','left');
		$this->db->where('t.tyre_brand_id',$tyre_brand_id);
		$query = $this->db->get();
		$resultResponse=$query->result();
		return @$resultResponse;
	}

	public function get_tyre_details($tyre_id)
	{
		$this->db->select('t.*, m.tyre_make_name, mm.tyre_make_model_name, b.tyre_brand_name,p.pattern_name');
		$this->db->from('tbl_tyre_list t');
		$this->db->join('tbl_tyre_make m','t.tyre_make_id= m.tyre_make_id','left');
		$this->db->join('tbl_tyre_make_model mm','t.tyre_make_model_id= mm.tyre_make_model_id','left');
		$this->db->join('tbl_tyre_brand b','t.tyre_brand_id= b.tyre_brand_id','left');
		$this->db->join('tbl_tyre_pattern p','t.tyre_patterns_id= p.pattern_id','left');
		$this->db->where('t.tyre_id',$tyre_id);
		$query = $this->db->get();
		$resultResponse=$query->result();
		return @$resultResponse;
	}

	public function get_battery_details($battery_id)
	{
		$this->db->select('b.*, m.battery_make_name, mm.make_model_name, br.battery_brand_name,p.pro_type_name');

		$this->db->from('tbl_battery_list b');
		$this->db->join('tbl_product_type p','b.battery_pro_type_id= p.pro_type_id','left');
		$this->db->join('tbl_battery_make m','b.battery_make_id= m.battery_make_id','left');
		$this->db->join('tbl_battery_make_model mm','b.battery_make_model_id= mm.make_model_id','left');
		$this->db->join('tbl_battery_brand br','b.battery_brand_id= br.battery_brand_id','left');
		
		$this->db->where('b.battery_id',$battery_id);
		$query = $this->db->get();
		$resultResponse=$query->result();
		return @$resultResponse;
	}


	function get_prescription_details($chk_history_id,$user_id)
	{
		$this->db->select('*');

		$this->db->from('tbl_patient_check_up_history chk');
		


		
		$this->db->where('chk.chk_history_id',$chk_history_id);
		$this->db->where('chk.user_id',$user_id);
		$query = $this->db->get();
		$resultResponse=$query->result();
		return @$resultResponse;
	}

	public function check_book_availivity($time, $date)
	{
		$this->db->select('*');
		$this->db->from('tbl_appointments');
		$this->db->where('appointment_date',$date);
		$this->db->where('appointment_time',$time);
		$query = $this->db->get();
		$resultResponse=$query->result();
		return @$resultResponse;
		
	}

		
}
?>