<?php
class customer_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function record_count($table)
    {
        return $this->db->count_all($table);
    }

    function get_all_seller($per_page,$start,$url)
    {
        $name=@$url['name'];
        $email=@$url['email'];
        $mobile=@$url['mobile'];
        $date=@$url['date'];
        $status=@$url['status'];

        $this->db->select('*');
        $this->db->from('tb_seller s');
        $this->db->join('tb_seller_contact_person scp','s.seller_id=scp.seller_id');
        if($name!="")
        {
            $this->db->where('s.seller_id',$name);

        }
        if($email!="")
        {
            $this->db->where('s.seller_id',$email);
        }
        if($mobile!="")
        {
            $this->db->where('s.seller_id',$mobile);
        }
        if($date!="")
        {
            $this->db->where('s.seller_added',date('Y-m-d',strtotime($date)));
        }
        if($status!="")
        {
            $this->db->where('s.seller_account_status',$status);
        }
        $this->db->where('s.seller_role_id','1');
        $this->db->limit($per_page,$start);
        $query=$this->db->get();
        return $query->result();
    }
    
    function get_all_seller_total($url)
    {
        $name=@$url['name'];
        $email=@$url['email'];
        $mobile=@$url['mobile'];
        $date=@$url['date'];
        $status=@$url['status'];

        $this->db->select('*');
        $this->db->from('tb_seller s');
        $this->db->join('tb_seller_contact_person scp','s.seller_id=scp.seller_id');
        if($name!="")
        {
            $this->db->where('s.seller_id',$name);

        }
        if($email!="")
        {
            $this->db->where('s.seller_id',$email);
        }
        if($mobile!="")
        {
            $this->db->where('s.seller_id',$mobile);
        }
        if($date!="")
        {
            $this->db->where('s.seller_added',date('Y-m-d',strtotime($date)));
        }
        if($status!="")
        {
            $this->db->where('s.seller_account_status',$status);
        }
        $this->db->where('s.seller_role_id','1');
        $query=$this->db->get();
        return $query->result();
    }
    function get_seller_detail($seller_id)
    {
        $this->db->select('*');
        $this->db->from('tb_seller s');
        $this->db->join('tb_seller_contact_person scp','s.seller_id=scp.seller_id');
        $this->db->join('tb_seller_contact sc','s.seller_id=sc.seller_id');
        $this->db->where('s.seller_id',$seller_id);
        $query=$this->db->get();
        return $query->result();
    }
    function get_seller_subscription($seller_id)
    {
        $this->db->select('*');
        $this->db->from('tb_seller s');
        $this->db->join('tb_seller_subscription ss','s.seller_id=ss.seller_id');
        $this->db->join('tb_subscription_plan sp','ss.subscription_plan_id=sp.subscription_plan_id');
        $this->db->where('s.seller_id',$seller_id);
        $query=$this->db->get();
        return $query->result();
    }
    function get_all_buyer($per_page,$start,$url)
    {
        $name=@$url['name'];
        $email=@$url['email'];
        $mobile=@$url['mobile'];
        $date=@$url['date'];
        $status=@$url['status'];

        $this->db->select('*');
        $this->db->from('tb_seller s');
        $this->db->join('tb_seller_contact_person scp','s.seller_id=scp.seller_id');
        if($name!="")
        {
            $this->db->where('s.seller_id',$name);
        }
        if($email!="")
        {
            $this->db->where('s.seller_id',$email);
        }
        if($mobile!="")
        {
            $this->db->where('s.seller_id',$mobile);
        }
        if($date!="")
        {
            $this->db->where('s.seller_added',date('Y-m-d',strtotime($date)));
        }
        if($status!="")
        {
            $this->db->where('s.seller_account_status',$status);
        }
        $this->db->where('s.seller_role_id','0');
        $this->db->limit($per_page,$start);
        $query=$this->db->get();
        return $query->result();
    }
    function get_all_buyer_total($url)
    {

        $name=@$url['name'];
        $email=@$url['email'];
        $mobile=@$url['mobile'];
        $date=@$url['date'];
        $status=@$url['status'];

        $this->db->select('*');
        $this->db->from('tb_seller s');
        $this->db->join('tb_seller_contact_person scp','s.seller_id=scp.seller_id');
        if($name!="")
        {
            $this->db->where('s.seller_id',$name);
        }
        if($email!="")
        {
            $this->db->where('s.seller_id',$email);
        }
        if($mobile!="")
        {
            $this->db->where('s.seller_id',$mobile);
        }
        if($date!="")
        {
            $this->db->where('s.seller_added',date('Y-m-d',strtotime($date)));
        }
        if($status!="")
        {
            $this->db->where('s.seller_account_status',$status);
        }
        $this->db->where('s.seller_role_id','0');
        $query=$this->db->get();
        return $query->result();
    }
}
?>
