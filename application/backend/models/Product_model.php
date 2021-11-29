<?php
class product_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function product_list($limit,$start,$url)
    {
        $filter_name=@$url['filter_name'];
        $filter_sku=@$url['filter_sku'];
        $filter_model=@$url['filter_model'];
        $filter_status=@$url['filter_status'];
        $filter_seller=@$url['filter_seller'];

        $this->db->select('*');
        $this->db->from('tb_product p');
        if($filter_name!="")
        {
            $this->db->where('p.product_id',$filter_name);
        }
        if($filter_sku!="")
        {
            $this->db->where('p.product_id',$filter_sku);
        }
        if($filter_model!="")
        {
            $this->db->where('p.product_id',$filter_model);
        }
        if($filter_status!="")
        {
            $this->db->where('p.product_status',$filter_status);
        }
        if($filter_seller!="")
        {
            $this->db->where('p.seller_id',$filter_seller);
        }
        $this->db->join('tb_seller s','p.seller_id=s.seller_id');
        $this->db->limit($limit,$start);
        $query=$this->db->get();
        return $query->result();
    }
    function product_list_total($url)
    {
        $filter_name=@$url['filter_name'];
        $filter_sku=@$url['filter_sku'];
        $filter_model=@$url['filter_model'];
        $filter_status=@$url['filter_status'];
        $filter_seller=@$url['filter_seller'];

        $this->db->select('*');
        $this->db->from('tb_product p');
        if($filter_name!="")
        {
            $this->db->where('p.product_id',$filter_name);
        }
        if($filter_sku!="")
        {
            $this->db->where('p.product_id',$filter_sku);
        }
        if($filter_model!="")
        {
            $this->db->where('p.product_id',$filter_model);
        }
        if($filter_status!="")
        {
            $this->db->where('p.product_status',$filter_status);
        }
        if($filter_seller!="")
        {
            $this->db->where('p.seller_id',$filter_seller);
        }
        $this->db->join('tb_seller s','p.seller_id=s.seller_id');
        $query=$this->db->get();
        return $query->result();
    }
    function product_details($product_id)
    {
        $this->db->select('*');
        $this->db->from('tb_product p');
        $this->db->join('tb_product_description pd','p.product_id=pd.product_id','left');
        $this->db->join('tb_product_shipping ps','p.product_id=ps.product_id','left');
        $this->db->join('tb_manufacturer m','p.manufacturer_id=m.manufacturer_id','left');
        $this->db->join('tb_brand b','p.product_brand=b.brand_id','left');
        $this->db->where('p.product_id',$product_id);
        $query=$this->db->get();
        return $query->result();
    }


}
?>
