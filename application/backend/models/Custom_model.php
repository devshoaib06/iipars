<?php
class custom_model extends CI_Model {

    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        
    }
    
			
	
	public function unique_id_genarator_encode($unique_key)
	{
		$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
		$product_unique_id=uniqid();
		$unique_id=trim($product_unique_id.'_'.$unique_key);
		$unique_id	= base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $unique_id, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
		return $unique_id;
	}
	
	public function unique_id_genarator_decode($unique_key_encode)
	{
		$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $decode_unique_id = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $unique_key_encode), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
		return $decode_unique_id;
	}
	
	//sTART GET USER ID BY PRODUCT ID
	public function user_id_get_from_product_tbl($product_id)
	{
		//echo $product_id;exit;
		$this->db->select('*');  
		$this->db->from('tbl_product');  
		$this->db->where('product_id',$product_id); 
		$query = $this->db->get();
		$result=$query->result();
		$user_id=$result[0]->user_id;
		return $user_id;
	}
	//END GET USER ID BY PRODUCT ID
	
	public function unique_user_details($user_id)
	{
		  $query = $this->db->get_where('tbluser_business', array('user_id' => $user_id,'user_status' => 'Y'));
		  $unique_user_details_array=$query->result();
		  return $unique_user_details_array;
	}
	
	public function all_autocomplete($keyword,$slug)
	{
		if($keyword && $slug='brand_name')
		{
			$this->db->select('*');
			$this->db->from('tblbrand');
			$this->db->like('brand_name',$keyword);
			$query = $this->db->get();
			if(count($query->result())>0)
			{
				foreach ($query->result() as $rs) 
				{
					
					$country_name = str_replace($rs->brand_name, '<b>'.$rs->brand_name.'</b>', $rs->brand_name);
					
					echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs->brand_name).'\','.$rs->brand_id.')">'.$rs->brand_name.'</li>';
				}
			}
			else
			{
			   //echo '<li>No result found</li>';  	
			}
		}
		
	}
public function base_url2()
 {
   @$val=explode('admin', base_url());
    return @$val[0];
 }

 public function commission_request_desc($m)
 {
 	$this->db->select('*');
 	$this->db->from('tbl_commission_request');
 	$this->db->where('user_id',$m);
 	//$this->db->order_by("request_id","DESC");
 	$query=$this->db->get();
 	$result=$query->result();
 	return $result;
 }

 public function get_all_banner_with_section()
 {
 	 	$this->db->select('*');
     	$this->db->from('tbl_banner tb');
     	$this->db->join('tbl_banner_section tbs','tbs.section_id=tb.section_id','left');
     	$query=$this->db->get();
     	return $query->result();
 }

 public function get_banner_with_section($id)
 {
 	 	$this->db->select('*');
     	$this->db->from('tbl_banner tb');
     	$this->db->join('tbl_banner_section tbs','tbs.section_id=tb.section_id','left');
     	$this->db->where('tb.banner_id',$id);
     	$query=$this->db->get();
     	return $query->result();
 }
 public function get_all_add_with_section()
 {
 	 	$this->db->select('*');
     	$this->db->from('tbl_google_add_sense tg');
     	$this->db->join('tbl_add_section tgs','tgs.section_id=tg.section_id','left');
     	$query=$this->db->get();
     	return $query->result();
 }

 public function get_add_with_section($id)
 {
 	 	$this->db->select('*');
     	$this->db->from('tbl_google_add_sense tb');
     	$this->db->join('tbl_add_section tbs','tbs.section_id=tb.section_id','left');
     	$this->db->where('tb.google_add_id',$id);
     	$query=$this->db->get();
     	return $query->result();
 }

 public function get_center_details($id)
 {
	$this->db->select('*');
	$this->db->from('tbl_center c');
	$this->db->join('tbl_user a','c.center_admin_id=a.user_id','left');
	$this->db->where('c.center_id',$id);
	$query= $this->db->get();
	$result= $query->result();
	return $result;
 }
	
}
?>