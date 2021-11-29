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
		
}
?>