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
	
	
	public function unique_user_details($user_id)
	{
		  $query = $this->db->get_where('tbluser_business', array('user_id' => $user_id,'user_status' => 'Y'));
		  $unique_user_details_array=$query->result();
		  return $unique_user_details_array;
	}


	public function price_range_filter($value1,$value2,$cat_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('category_id',$cat_id);
		$this->db->where('price  >=', $value1);
		$this->db->where('price <=' , $value2);
		$query=$this->db->get();  
   		return $query->result(); 
	}
	
		
}
?>