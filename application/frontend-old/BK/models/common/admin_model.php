<?php
class admin_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function record_count($table)
    {
        return $this->db->count_all($table);
    }
    function check_login($username,$password)
    {

        
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('login_email',$username);
        $this->db->where('login_pass',$password);
        $query=$this->db->get();
        return $query->result();
    }
    function insert_data($data,$table)
    {
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }
    function update_data($data,$table,$columname,$columnvalue)
    {
        $this->db->where($columname,$columnvalue);
        $this->db->update($table,$data);
    }
    function delete_data($table,$columname,$columnvalue)
    {
        $this->db->where($columname,$columnvalue);
        $this->db->delete($table);
    }
    function selectAll($table_name)
    {
        $this->db->select('*');
        $this->db->from($table_name);
        $query=$this->db->get();
        return $query->result();
    }

    function fetch_all($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result();
    }
    
    function selectOne($table_name,$column_name,$column_value)
    {
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where($column_name,$column_value);
        $query=$this->db->get();
        return $query->result();
    }
    function select_size()
    {
         $this->db->select('*');
         $this->db->from('tbl_size');
        $this->db->order_by('size_id','desc');
        $query=$this->db->get();
        return $query->result();
    }
    function selectAll_order($table_name,$column_name,$order)
    {
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->order_by($column_name,$order);
        $query=$this->db->get();
        return $query->result();
    }
    function url_slug($string)
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
    function getTotalOrdersByYear()
    {
		$order_data = array();
		for ($i = 1; $i <= 12; $i++)
        {
  			$order_data[$i] = array(
  				'month' => date('M', mktime(0, 0, 0, $i)),
  				'total' => 0
  			);
    	}
    	$query = $this->db->query("SELECT COUNT(*) AS total, date_added
          FROM `tb_order`
          WHERE order_status_id = 1
          AND YEAR(date_added) = YEAR(NOW())
          GROUP BY MONTH(date_added)");

        //echo "<pre>";print_r($query->result_array());exit;
    	foreach ($query->result_array() as $result)
        {
		     $order_data[date('n', strtotime($result['date_added']))] = array(
				'month' => date('M', strtotime($result['date_added'])),
				'total' => $result['total']
			    );
    	}
    	return $order_data;
  	}
    function getTotalOrdersByMonth()
    {
		$order_data = array();
		for ($i = 1; $i <= date('t'); $i++)
        {
  			$date = date('Y') . '-' . date('m') . '-' . $i;
  			$order_data[date('j', strtotime($date))] = array(
  				'day'   => date('d', strtotime($date)),
  				'total' => 0
  			);
		}
		$query = $this->db->query("SELECT COUNT(*) AS total, date_added
        FROM `tb_order`
        WHERE order_status_id = 1
        AND DATE(date_added) >= '" . date('Y') . '-' . date('m') .'-01'. "'
        AND DATE(date_added) < '" . date('Y-m-d',strtotime("+1 months",strtotime(date('Y') . '-' . date('m') .'-01'))). "'
        GROUP BY DATE(date_added)");

		foreach ($query->result_array() as $result)
        {
  			$order_data[date('j', strtotime($result['date_added']))] = array(
  				'day'   => date('d', strtotime($result['date_added'])),
  				'total' => $result['total']
  			);
		}
    	return $order_data;
  	}
    function getTotalOrdersByWeek()
    {
		$order_data = array();
		$date_start = strtotime('-' . date('w') . ' days');
		for ($i = 0; $i < 7; $i++)
        {
  			$date = date('Y-m-d', $date_start + ($i * 86400));
  			$order_data[date('w', strtotime($date))] = array(
  				'day'   => date('D', strtotime($date)),
  				'total' => 0
  			);
		}
		$query = $this->db->query("SELECT COUNT(*) AS total, date_added
        FROM `tb_order`
        WHERE order_status_id = 1
        AND DATE(date_added) >= DATE('" . date('Y-m-d', $date_start) . "')
        GROUP BY DAYNAME(date_added)");

		foreach ($query->result_array() as $result)
        {
			  $order_data[date('w', strtotime($result['date_added']))] = array(
				'day'   => date('D', strtotime($result['date_added'])),
				'total' => $result['total']
			);
		}
		return $order_data;
  	}

    function select_category($table_name)
    {
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->order_by('category_sort_order','asc');
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

    function fetch_all_tab()
    {
        $this->db->select('*');
        $this->db->from('tbl_faq_question ques');
        $this->db->join('tbl_faq_tab tab','ques.ftab_id=tab.ftab_id');
        $query = $this->db->get();
        return $query->result();
    }



    function get_all_customer()
    {
        $this->db->select('*');
        $this->db->from('tbl_seller s');
        $this->db->where('s.seller_role_id','0');
        $query=$this->db->get();
        return $query->result();
    }

    function get_all_seller()
    {
        $this->db->select('*');
        $this->db->from('tbl_seller s');
        $this->db->where('s.seller_role_id','1');
        $query=$this->db->get();
        return $query->result();
    }

    function get_all_pin()
    {
        $this->db->distinct('shipping_postcode');
        $this->db->select('shipping_postcode');
        $this->db->from('tbl_order');
        $query=$this->db->get();
        return $query->result();
    }

}
?>
