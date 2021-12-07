<?php
class blog_model extends CI_Model
{


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function record_count($table)
    {
        return $this->db->count_all($table);
    }

    function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function update_data($data, $table, $columname, $columnvalue)
    {
        $this->db->where($columname, $columnvalue);
        $this->db->update($table, $data);
    }

    function delete_data($table, $columname, $columnvalue)
    {
        $this->db->where($columname, $columnvalue);
        $this->db->delete($table);
    }

    function selectOne($table_name, $column_name, $column_value)
    {
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where($column_name, $column_value);
        $query = $this->db->get();
        return $query->result();
    }

    function fetch_all($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result();
    }

    function fetch_as_array($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result_array();
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

    function fetch_first($table,$columname)
    {
         $this->db->select_min($columname);
         $this->db->from($table);
         $query = $this->db->get();
         return $query->result();
    }


    function fetch_all_blog($table,$limit,$start)
    {
        $this->db->limit($limit,$start);
        $this->db->select('*');
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result();
    }

    function fetch_all_blog_count($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result();
    }

    function fetch_all_blog_select($table,$limit,$start,$url)
    {
        $this->db->limit($limit,$start);
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('cat_id',$url);
        $query = $this->db->get();
        return $query->result();
    }

    function fetch_all_blog_count_select($table,$url)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('cat_id',$url);
        $query = $this->db->get();
        return $query->result();
    }

    function fetch_all_testimonial($table)
    {
        $this->db->limit(3,0);
        $this->db->select('*');
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result();
    }

    function selectOne_price($level,$id)
    {
        $this->db->select('*');
        $this->db->from('tbl_price');
        $this->db->where('deadline_id', $id);
        $this->db->where('level_id', $level);
        $query = $this->db->get();
        return $query->result();
    }

    function selectOne_file($table_name, $column_name, $column_value,$type)
    {
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where($column_name, $column_value);
        $this->db->where('doc_type', $type);
        $query = $this->db->get();
        return $query->result();
    }

    function select_order_max($reg_id)
    {
         $this->db->select_max('order_id');
         $this->db->from('tbl_order');
         $this->db->where('register_id', $reg_id);
         $query = $this->db->get();
         return $query->result();
    }

    function select_order($order_id)
    {
         $this->db->select('*');
         $this->db->from('tbl_order');
         $this->db->where('order_id', $order_id);
         $query = $this->db->get();
         return $query->result();
    }

    function insertTransaction($data = array())
    {
        $insert = $this->db->insert('payments',$data);
        return $insert?true:false;
    }

    function update_order($data,$order_id,$reg_id)
    {
        $this->db->where('order_id', $order_id);
        $this->db->where('register_id', $reg_id);
        $this->db->update('tbl_order', $data);
    }

    function selectOne_payment($order_id,$reg_id)
    {
         $this->db->select('*');
         $this->db->from('payments');
         $this->db->where('product_id', $order_id);
         $this->db->where('user_id', $reg_id);
         $query = $this->db->get();
         return $query->result();
    }

    function selectOne_order($order_id,$reg_id)
    {
         $this->db->select('*');
         $this->db->from('tbl_order');
         $this->db->where('order_id', $order_id);
         $this->db->where('register_id', $reg_id);
         $query = $this->db->get();
         return $query->result();
    }

    function selectOne_invoice($order_id,$reg_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_invoice');
        $this->db->where('order_id', $order_id);
        $this->db->where('register_id', $reg_id);
        $query = $this->db->get();
        return $query->result();
    }

    function selectOne_coupon($coupon_id,$reg_id)
    {
         $this->db->select('*');
         $this->db->from('tbl_coupon_user');
         $this->db->where('user_id', $reg_id);
         $this->db->where('coupon_id', $coupon_id);
         $query = $this->db->get();
         return $query->result();
    }

    
     function fetch_like_blog_count_select($table,$url)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->like('title',$url);
        $query = $this->db->get();
        return $query->result();
    }

    function fetch_all_blog_like_select($table,$limit,$start,$url)
    {
        $this->db->limit($limit,$start);
        $this->db->select('*');
        $this->db->from($table);
        $this->db->like('title',$url);
        $query = $this->db->get();
        return $query->result();
    }

}
?>