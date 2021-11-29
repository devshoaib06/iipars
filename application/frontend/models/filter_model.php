<?php
class filter_model extends CI_Model {

    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    


/*  +++++++++++++++++++++++++++++++++++  for student contact ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  */

function get_product_by_filter_data($data_model,$brand_chk)
    {

        $parent_category_id=@$data_model['parent_category_id'];
        $sub_category_id=@$data_model['sub_category_id'];
        $category_id=@$data_model['category_id'];
        //echo '1'; exit;

            $this->db->select('*');
            $this->db->from('tbl_product tp'); 
            //$this->db->join('tbl_category c','c.category_id=tp.cat_id');
            $this->db->join('tbl_brand b','b.brand_id=tp.brand_id');

            /*if($parent_category_id!="" && ($sub_category_id=="" && $category_id==""))
            {
                $this->db->where('c.parent_category',$parent_category_id);
                $this->db->or_where('c.category_id',$parent_category_id);

            }
            if($sub_category_id!="" && $category_id=="")
            {
                $this->db->where('c.sub_category',$sub_category_id);
                $this->db->or_where('c.category_id',$sub_category_id);
            }
            if($category_id!="")
            {
                $this->db->where('c.category_id',$category_id);
                $this->db->or_where('c.category_id',$category_id);

            }*/
            
            if($brand_chk > 0)
            {
                $this->db->where_in('b.brand_id',$brand_chk);
            }
                      
                    
            $this->db->where('tp.status ','Active');
            //$this->db->order_by('c.category_id','desc');
            $query = $this->db->get();
            return $query->result();
          
    }


    /*function get_product_by_shorting_data($data_model,$shorting)
    {

        $parent_category_id=@$data['parent_category_id'];
        $sub_category_id=@$data['sub_category_id'];
        $category_id=@$data['category_id'];


            $this->db->select('*');
            $this->db->from('tbl_product tp'); 
            $this->db->join('tbl_category c','c.category_id=tp.cat_id');
           // $this->db->join('tbl_category c','c.category_id=tp.cat_id');
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
             
            if($shorting=='High')
            {
                $this->db->order_by('tp.net_price','asc');
            }

            if($shorting=='low')
            {
                $this->db->order_by('tp.net_price','desc');
            }
                    
            $this->db->where('tp.status ','Active');
            
            $query = $this->db->get();
            return $query->result();
          
          
        
    }*/

    function get_product_by_shorting_data($data_model,$shorting)
    {

        $parent_category_id=@$data['parent_category_id'];
        $sub_category_id=@$data['sub_category_id'];
        $category_id=@$data['category_id'];


            $this->db->select('*');
            $this->db->group_by('tp.id');
            $this->db->from('tbl_product tp'); 
            $this->db->join('tbl_category c','c.category_id=tp.cat_id');
            $this->db->join('tbl_product_price pp','pp.product_id=tp.id');
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
             
            if($shorting=='High')
            {
                $this->db->order_by('pp.net_price','asc');
            }

            if($shorting=='low')
            {
                $this->db->order_by('pp.net_price','desc');
            }
                    
            $this->db->where('tp.status ','Active');
            
            $query = $this->db->get();
            return $query->result();
          
          
        
    }


   

    
}
?>