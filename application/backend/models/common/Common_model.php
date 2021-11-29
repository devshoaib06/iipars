<?php
class common_model extends CI_Model {

    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    public function logincheck($email,$password)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('login_email',$email);
		$this->db->where('login_pass',$password);
		$query = $this->db->get();
		return $query->result();
	}

	public function common($table_name='',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array())
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
			
			
			if($end)
			{

				$this->db->limit($end,$start);
			}
			
			if(count($where_in_array)>0)
			{
				
				$this->db->where_in('user_id', $where_in_array);
			}
			 
			$query = $this->db->get();
			$resultResponse=$query->result();
			return $resultResponse;
					
			}
			else
			{
					 echo 'Table name should not be empty';exit;
			}
	
	   }

		public function sum($table_name='',$field_name='',$where=array(),$where_or=array(),$start='',$end='')
		{
			if(trim($field_name) && trim($table_name) )
			{
				$this->db->select_sum($field_name);
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
			    return $resultResponse;
			}
			else 
			{
				echo 'Opps!something went wrong';
			}
		}
	
	
function subject()  
{  
    //$this->db->select('DISTINCT(subject_name)'); 
   	$this->db->select('*');
	//$this->db->group_by('subject_name'); 
	$this->db->from('tbl_subject');  
  
   $query=$this->db->get();  
   return $query->result();


}

function preffered_location($adds_type)  
{  
    $this->db->select('*');
	$this->db->group_by('area'); 
	$this->db->from('tbl_address');
	$this->db->where('address_type',$adds_type);


   $query=$this->db->get();  
   return $query->result();  
}

function teacher_search($value)  
{  
    
   	$this->db->select('*');
	$this->db->group_by('subject_name'); 
	$this->db->from('tbl_subject'); 
	$this->db->where('status','active'); 
	
	$this->db->like('subject_name',$value); 
  
   	$query=$this->db->get();  
   	return $query->result();


}


function search_by_loc_sub($location,$subject)  
{  
    
   
   
   	$this->db->select('*');
	$this->db->group_by('tu.id'); 
	$this->db->from('tbl_user tu'); 
	$this->db->join('tbl_address ta','ta.user_id=tu.id','left');
    $this->db->join('tbl_tutor_subject tts','tts.user_id=tu.id','left');
    $this->db->join('tbl_subject ts','ts.id=tts.subject_id','left');
    if($location!="" && $subject=="") 
    { 
    	$this->db->where('ta.area',$location);
    }
    if($subject!="" && $location=="") 
    {
    	$this->db->where('ts.subject_name',$subject);
    }
    if($location!="" && $subject!="") 
    { 
         $this->db->where('ta.area',$location);
         $this->db->where('ts.subject_name',$subject);
    }
    $query=$this->db->get();  
   	return $query->result();
   	}
	

function search_by_loc_sub_pagination($location,$subject,$page,$per_page)  
{  
    
   	$this->db->select('*');
	$this->db->group_by('tu.id'); 
	$this->db->from('tbl_user tu'); 
	$this->db->join('tbl_address ta','ta.user_id=tu.id','left');
    $this->db->join('tbl_tutor_subject tts','tts.user_id=tu.id','left');
    $this->db->join('tbl_subject ts','ts.id=tts.subject_id','left');
	
	$this->db->where('ta.area',$location);
	$this->db->or_where('ts.subject_name',$subject); 
	//$this->db->like('ta.area',$location);
	//$this->db->or_like('ts.subject_name',$subject); 
	$this->db->limit($per_page,$page);
  
  
   	$query=$this->db->get();  
   	return $query->result();


}

function fetch_first($table,$columname)
    {
         $this->db->select_min($columname);
         $this->db->from($table);
         $query = $this->db->get();
         return $query->result();
    }

function convert_number($number) {
		if (($number < 0) || ($number > 999999999)) {
			throw new Exception("Number is out of range");
		}

		$Gn = floor($number / 1000000);
		/* Millions (giga) */
		$number -= $Gn * 1000000;
		$kn = floor($number / 1000);
		/* Thousands (kilo) */
		$number -= $kn * 1000;
		$Hn = floor($number / 100);
		/* Hundreds (hecto) */
		$number -= $Hn * 100;
		$Dn = floor($number / 10);
		/* Tens (deca) */
		$n = $number % 10;
		/* Ones */

		$res = "";

		if ($Gn) {
			$res .= $this->convert_number($Gn) .  "Million";
		}

		if ($kn) {
			$res .= (empty($res) ? "" : " ") .$this->convert_number($kn) . " Thousand";
		}

		if ($Hn) {
			$res .= (empty($res) ? "" : " ") .$this->convert_number($Hn) . " Hundred";
		}

		$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
		$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");

		if ($Dn || $n) {
			if (!empty($res)) {
				$res .= " and ";
			}

			if ($Dn < 2) {
				$res .= $ones[$Dn * 10 + $n];
			} else {
				$res .= $tens[$Dn];

				if ($n) {
					$res .= "-" . $ones[$n];
				}
			}
		}

		if (empty($res)) {
			$res = "zero";
		}

		return $res;
	}








//*************************************** for dr.roy product list *************************************************
	function product_list_total_count($data)
	{
		$parent_category_id=@$data['parent_category_id'];
		$sub_category_id=@$data['sub_category_id'];
		$category_id=@$data['category_id'];
		

		$this->db->select('*');
		$this->db->from('tbl_product p');
		$this->db->join('tbl_category c','c.category_id=p.cat_id');
		if($parent_category_id!="" && ($sub_category_id=="" && $category_id==""))
		{
			$this->db->where('c.parent_category',$parent_category_id);
		}
		if($sub_category_id!="" && $category_id=="")
		{
			$this->db->where('c.sub_category',$sub_category_id);
		}
		if($category_id!="")
		{
			$this->db->where('c.category_id',$category_id);
		}
		
		$this->db->where('p.status ','Active');
		$this->db->order_by('c.category_id','desc');
		
		$query=$this->db->get();
		return $query->result();
	}
	function product_list_total($data,$page,$per_page)
	{
		$parent_category_id=@$data['parent_category_id'];
		$sub_category_id=@$data['sub_category_id'];
		$category_id=@$data['category_id'];
		

		$this->db->select('*');
		$this->db->from('tbl_product p');
		$this->db->join('tbl_category c','c.category_id=p.cat_id');
		if($parent_category_id!="" && ($sub_category_id=="" && $category_id==""))
		{
			$this->db->where('c.parent_category',$parent_category_id);
		}
		if($sub_category_id!="" && $category_id=="")
		{
			$this->db->where('c.sub_category',$sub_category_id);
		}
		if($category_id!="")
		{
			$this->db->where('c.category_id',$category_id);
		}
		
		$this->db->where('p.status ','Active');
		$this->db->order_by('c.category_id','desc');
		$this->db->limit($per_page,$page);
		$query=$this->db->get();
		return $query->result();
	}

	function brand_list_by_product($data)
	{
		$parent_category_id=@$data['parent_category_id'];
		$sub_category_id=@$data['sub_category_id'];
		$category_id=@$data['category_id'];
		
		$this->db->distinct();
		$this->db->select('b.brand_id');
		$this->db->from('tbl_product p');
		$this->db->join('tbl_category c','c.category_id=p.cat_id');
		$this->db->join('tbl_brand b','p.brand_id=b.brand_id','left');
		if($parent_category_id!="" && ($sub_category_id=="" && $category_id==""))
		{
			$this->db->where('c.parent_category',$parent_category_id);
		}
		if($sub_category_id!="" && $category_id=="")
		{
			$this->db->where('c.sub_category',$sub_category_id);
		}
		if($category_id!="")
		{
			$this->db->where('c.category_id',$category_id);
		}
		
		$this->db->where('p.status ','Active');

		 $query=$this->db->get();
		 $sq2= $query->result();
			             
		 $sq_arr2=array();
		 for($i=0;$i<count($sq2);$i++)
			 {
			    $sq_arr2[$i]=$sq2[$i]->brand_id;
			 }
		if(count($sq_arr2)>0)
		{
		$this->db->select('*');
		$this->db->from('tbl_brand');
			
		$this->db->where('status ','Active');
		$this->db->where_in('brand_id', $sq_arr2);
				
		$query=$this->db->get();
		return $query->result();
		}
		
	}

function brand_list_by_search($brand_id)
	{
		
		$this->db->distinct();
		$this->db->select('b.brand_id');
		$this->db->from('tbl_brand b');
		$this->db->where_in('b.brand_id',$brand_id);

		 $query=$this->db->get();
		  $sq2= $query->result();
			             
		  $sq_arr2=array();
		  for($i=0;$i<count($sq2);$i++)
		 	 {
		 	    $sq_arr2[$i]=$sq2[$i]->brand_id;
		 	 }
		 if(count($sq_arr2)>0)
		 {
		 $this->db->select('*');
		 $this->db->from('tbl_brand');
			
		 $this->db->where('status ','Active');
		 $this->db->where_in('brand_id', $sq_arr2);
				
		 $query=$this->db->get();
		return $query->result();
		}
		
	}


	function product_list_total_by_brand($data,$brand_id,$data_by_price,$page,$per_page)
	{
		$parent_category_id=@$data['parent_category_id'];
		$sub_category_id=@$data['sub_category_id'];
		$category_id=@$data['category_id'];

		$minprice=@$data_by_price['minprice'];
		$maxprice=@$data_by_price['maxprice'];

		//echo $minprice."<br>";
		//echo $maxprice."<br>";
		//print_r($brand_id);
		//exit;

		$this->db->select('*');
		$this->db->from('tbl_product p');
		$this->db->join('tbl_category c','c.category_id=p.cat_id');
		//$this->db->join('tbl_brand b','p.brand_id=b.brand_id','left');
		if($parent_category_id!="" && ($sub_category_id=="" && $category_id==""))
		{
			$this->db->where('c.parent_category',$parent_category_id);
		}
		if($sub_category_id!="" && $category_id=="")
		{
			$this->db->where('c.sub_category',$sub_category_id);
		}
		if($category_id!="")
		{
			$this->db->where('c.category_id',$category_id);
		}
		if($minprice!='' && $maxprice!='')
 		{
             
            $this->db->where("price >=",$minprice);
            $this->db->where("price <=",$maxprice);
      
             	$query=$this->db->get();
                $sq3= $query->result();
             
                $sq_arr3=array();
                for($i=0;$i<count($sq3);$i++)
                {
                    $sq_arr3[$i]=$sq3[$i]->id;
                }
 		}

 			//print_r($sq_arr3);exit;

		if(@$brand_id[0]==0)
   		{
   			
			   		$this->db->select('*');
			       	$this->db->from('tbl_product tp');
			       	$this->db->join('tbl_category c','c.category_id=tp.cat_id');
			        $this->db->where('tp.status','Active');
			        if($parent_category_id!="" && ($sub_category_id=="" && $category_id==""))
					{
						$this->db->where('c.parent_category',$parent_category_id);
					}
					if($sub_category_id!="" && $category_id=="")
					{
						$this->db->where('c.sub_category',$sub_category_id);
					}
					if($category_id!="")
					{
						$this->db->where('c.category_id',$category_id);
					}
			        if(count($sq_arr3)>0)
					{
						 $this->db->where_in('tp.id', $sq_arr3);
						 $this->db->limit($page,$per_page);	
					 $query=$this->db->get();
		    		 return $query->result();
		    		}
		    		else
		    		{
		    			$result=array();
           				return $result;
		    		}
   		}
   		else{
			   		$this->db->select('*');
					$this->db->from('tbl_product p');
					$this->db->join('tbl_category c','c.category_id=p.cat_id');
					$this->db->join('tbl_brand b','p.brand_id=b.brand_id','left');
					if($parent_category_id!="" && ($sub_category_id=="" && $category_id==""))
					{
						$this->db->where('c.parent_category',$parent_category_id);
					}
					if($sub_category_id!="" && $category_id=="")
					{
						$this->db->where('c.sub_category',$sub_category_id);
					}
					if($category_id!="")
					{
						$this->db->where('c.category_id',$category_id);
					}

					if(@$brand_id[0]!=0)
			   		{
			            $this->db->where_in('p.brand_id',$brand_id);

			              
			                $query=$this->db->get();
			                $sq2= $query->result();
			             
			                $sq_arr2=array();
			                for($i=0;$i<count($sq2);$i++)
			                {
			                    $sq_arr2[$i]=$sq2[$i]->id;
			                }

			               // print_r($sq_arr2);

			    	}



    	$this->db->select('*');
       	$this->db->from('tbl_product tp');
       	$this->db->join('tbl_category c','c.category_id=tp.cat_id');
        $this->db->where('tp.status','active');
        if($parent_category_id!="" && ($sub_category_id=="" && $category_id==""))
		{
			$this->db->where('c.parent_category',$parent_category_id);
		}
		if($sub_category_id!="" && $category_id=="")
		{
			$this->db->where('c.sub_category',$sub_category_id);
		}
		if($category_id!="")
		{
			$this->db->where('c.category_id',$category_id);
		}
		if(@$brand_id[0]!=0)
        {
             
              $this->db->where_in('tp.id', $sq_arr2);
        }	
        if(count($sq_arr3)>0)
					{
						 $this->db->where_in('tp.id', $sq_arr3);
						 $this->db->limit($page,$per_page);	
					 $query=$this->db->get();
		    		 return $query->result();
		    		}
		    		else
		    		{
		    			$result=array();
           				return $result;
		    		}


   		}
	
	}

function product_list_total_by_brand_count($data,$brand_id,$data_by_price)
	{
		$parent_category_id=@$data['parent_category_id'];
		$sub_category_id=@$data['sub_category_id'];
		$category_id=@$data['category_id'];

		$minprice=@$data_by_price['minprice'];
		$maxprice=@$data_by_price['maxprice'];

		//echo $minprice."<br>";
		//echo $maxprice."<br>";
		//print_r($brand_id);
		//exit;

		$this->db->select('*');
		$this->db->from('tbl_product p');
		$this->db->join('tbl_category c','c.category_id=p.cat_id');
		//$this->db->join('tbl_brand b','p.brand_id=b.brand_id','left');
		if($parent_category_id!="" && ($sub_category_id=="" && $category_id==""))
		{
			$this->db->where('c.parent_category',$parent_category_id);
		}
		if($sub_category_id!="" && $category_id=="")
		{
			$this->db->where('c.sub_category',$sub_category_id);
		}
		if($category_id!="")
		{
			$this->db->where('c.category_id',$category_id);
		}
		if($minprice!='' && $maxprice!='')
 		{
             
            $this->db->where("price >=",$minprice);
            $this->db->where("price <=",$maxprice);
      
             	$query=$this->db->get();
                $sq3= $query->result();
             
                $sq_arr3=array();
                for($i=0;$i<count($sq3);$i++)
                {
                    $sq_arr3[$i]=$sq3[$i]->id;
                }
 		}

 			//print_r($sq_arr3);exit;

		if(@$brand_id[0]==0)
   		{
   			
			   		$this->db->select('*');
			       	$this->db->from('tbl_product tp');
			       	$this->db->join('tbl_category c','c.category_id=tp.cat_id');
			        $this->db->where('tp.status','Active');
			        if($parent_category_id!="" && ($sub_category_id=="" && $category_id==""))
					{
						$this->db->where('c.parent_category',$parent_category_id);
					}
					if($sub_category_id!="" && $category_id=="")
					{
						$this->db->where('c.sub_category',$sub_category_id);
					}
					if($category_id!="")
					{
						$this->db->where('c.category_id',$category_id);
					}
			        if(count($sq_arr3)>0)
					{
						 $this->db->where_in('tp.id', $sq_arr3);
							
					 $query=$this->db->get();
		    		 return $query->result();
		    		}
		    		else
		    		{
		    			$result=array();
           				return $result;
		    		}
   		}
   		else{
			   		$this->db->select('*');
					$this->db->from('tbl_product p');
					$this->db->join('tbl_category c','c.category_id=p.cat_id');
					$this->db->join('tbl_brand b','p.brand_id=b.brand_id','left');
					if($parent_category_id!="" && ($sub_category_id=="" && $category_id==""))
					{
						$this->db->where('c.parent_category',$parent_category_id);
					}
					if($sub_category_id!="" && $category_id=="")
					{
						$this->db->where('c.sub_category',$sub_category_id);
					}
					if($category_id!="")
					{
						$this->db->where('c.category_id',$category_id);
					}

					if(@$brand_id[0]!=0)
			   		{
			            $this->db->where_in('p.brand_id',$brand_id);

			              
			                $query=$this->db->get();
			                $sq2= $query->result();
			             
			                $sq_arr2=array();
			                for($i=0;$i<count($sq2);$i++)
			                {
			                    $sq_arr2[$i]=$sq2[$i]->id;
			                }

			               // print_r($sq_arr2);

			    	}



    	$this->db->select('*');
       	$this->db->from('tbl_product tp');
       	$this->db->join('tbl_category c','c.category_id=tp.cat_id');
        $this->db->where('tp.status','active');
        if($parent_category_id!="" && ($sub_category_id=="" && $category_id==""))
		{
			$this->db->where('c.parent_category',$parent_category_id);
		}
		if($sub_category_id!="" && $category_id=="")
		{
			$this->db->where('c.sub_category',$sub_category_id);
		}
		if($category_id!="")
		{
			$this->db->where('c.category_id',$category_id);
		}
		if(@$brand_id[0]!=0)
        {
             
              $this->db->where_in('tp.id', $sq_arr2);
        }	
        if(count($sq_arr3)>0)
					{
						 $this->db->where_in('tp.id', $sq_arr3);
						 	
					 $query=$this->db->get();
		    		 return $query->result();
		    		}
		    		else
		    		{
		    			$result=array();
           				return $result;
		    		}


   		}
	
	}




	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	function all_parent_category()
	{
        $this->db->select('*');
        $this->db->from('tbl_category c');
        $this->db->where('c.parent_category','0');
        $this->db->where('c.sub_category','0');
		$this->db->where('c.status','active');
        $this->db->order_by('c.category_sort_order','asc');
        $query=$this->db->get();
        return $query->result();
    }
    function all_sub_category($category_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_category c');
		if($category_id!="")
		{
			$this->db->where('c.parent_category',$category_id);
		}
		else
		{
			$this->db->where('c.parent_category !=','0');
		}
        $this->db->where('c.sub_category','0');
		$this->db->where('c.status','active');
        $this->db->order_by('c.category_sort_order','asc');
        $query=$this->db->get();
        return $query->result();
    }
	function all_category($category_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_category c');
		$this->db->where('c.parent_category !=','0');
		if($category_id!="")
		{
			$this->db->where('c.sub_category',$category_id);
		}
		else
		{
			$this->db->where('c.sub_category !=','0');
		}
		$this->db->where('c.status','active');
		$this->db->order_by('c.category_sort_order','asc');
        $query=$this->db->get();
        return $query->result();
    }

    public function check_book_availivity($time, $date)
	{
		$this->db->select('*');
		$this->db->from('tbl_service_book');
		$this->db->where('booking_date',$date);
		$this->db->where('booking_time',$time);
		$query = $this->db->get();
		$resultResponse=$query->result();
		return @$resultResponse;
		
	}

	function get_plan($user_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_user_package tup');
        $this->db->join('tbl_plan tp','tp.id=tup.plan_id');
        $this->db->join('tbl_online_service tos','tos.id=tup.service_id');
        $this->db->order_by('tup.id','desc');
        $this->db->where('tup.user_id',$user_id);
        $query=$this->db->get();
        return $query->result();

    }

     function check_pickup_pin($pincode)
    {
    	$this->db->select('*');
    	$this->db->from('table_ship_pin');
    	$this->db->where('pincodes',$pincode);
    	$this->db->where('pickup','Y');
    	$query= $this->db->get();
    	return $query->result();
    }

    function sales_history($saller_id)
{
	$this->db->select('*');
	$this->db->from('tbl_order_details');
	$this->db->where('product_seller_id', $saller_id);
	$this->db->where('order_product_status', 'Delivered');
	$this->db->order_by('order_details_id','DESC');
	$query= $this->db->get();
	return $query->result();
}

function get_price($cat_id)
   {


    $category_id=$cat_id;

   $category_details=$this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('category_id'=>$category_id,'status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
   //print_r($category_details);exit;

   $pcat=$category_details[0]->parent_category;
   $scat=$category_details[0]->sub_category;


    

           $this->db->distinct();
            $this->db->select('tp.id');
            $this->db->from('tbl_product tp');
            $this->db->join('tbl_category tpi','tp.cat_id=tpi.category_id','left');
            //$this->db->where('category_id',$cat_id);


             if($pcat==0 && $scat==0)
            {
                 

            $this->db->where('tpi.parent_category',$cat_id); 
           
            }
            elseif($pcat=!0 && $scat==0)
            {
                 $this->db->where('tpi.sub_category',$cat_id); 
            }
            elseif($pcat=!0 && $scat=!0)
            {
                $this->db->where('tp.cat_id',$cat_id);
            }
                //$subQuery = $this->db->get_compiled_select(); 
   
                $query=$this->db->get();
                $sq= $query->result();
                //print_r($sq);
                $sq_arr=array();
                for($i=0;$i<count($sq);$i++)
                {
                    $sq_arr[$i]=$sq[$i]->id;
                }
                //print_r($sq_arr);

                /*$this->db->select('MAX(price) as max, MIN(price) as min');
                $this->db->from('tbl_product');
                $this->db->where("product_id IN ($subQuery)", NULL, FALSE);
                $query=$this->db->get();
                return $query->result();*/
              
                 $this->db->select('MAX(price) as max, MIN(price) as min');
                $this->db->from('tbl_product');
                if(count($sq_arr)>0)
                {
                    $this->db->where_in('id', $sq_arr);
                }
                
                 $query=$this->db->get();
                 return $query->result();
               

   }

   function get_price_search($id)
   {


   //  $category_id=$cat_id;

   // $category_details=$this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('category_id'=>$category_id,'status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
   // //print_r($category_details);exit;

   // $pcat=$category_details[0]->parent_category;
   // $scat=$category_details[0]->sub_category;


    

           	$this->db->distinct();
            // $this->db->select('tp.id');
            // $this->db->from('tbl_product tp');
            //$this->db->join('tbl_category tpi','tp.cat_id=tpi.category_id','left');
            //$this->db->where('category_id',$cat_id);


            //  if($pcat==0 && $scat==0)
            // {
                 

            // $this->db->where('tpi.parent_category',$cat_id); 
           
            // }
            // elseif($pcat=!0 && $scat==0)
            // {
            //      $this->db->where('tpi.sub_category',$cat_id); 
            // }
            // elseif($pcat=!0 && $scat=!0)
            // {
            //     $this->db->where('tp.cat_id',$cat_id);
            // }
                //$subQuery = $this->db->get_compiled_select(); 
   
                // $query=$this->db->get();
                // $sq= $query->result();
                // //print_r($sq);
                // $sq_arr=array();
                // for($i=0;$i<count($sq);$i++)
                // {
                //     $sq_arr[$i]=$sq[$i]->id;
                // }
                //print_r($sq_arr);

                /*$this->db->select('MAX(price) as max, MIN(price) as min');
                $this->db->from('tbl_product');
                $this->db->where("product_id IN ($subQuery)", NULL, FALSE);
                $query=$this->db->get();
                return $query->result();*/
              
                $this->db->select('MAX(price) as max, MIN(price) as min');
                $this->db->from('tbl_product');
                // if(count($sq_arr)>0)
                // {
                    $this->db->where_in('id', $id);
                //}
                
                 $query=$this->db->get();
                 return $query->result();
               

   }
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

}
?>