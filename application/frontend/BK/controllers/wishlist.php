<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class wishlist extends CI_Controller 
{	
	 
	 public function __construct()
     {
          parent::__construct();

	 }
	
	public function index()
	{
		  $user_id = $this->session->userdata('user_session_id');
     

     	$data['wish_list'] = $this->common_model->common($table_name = 'tbl_wishlist', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

     	//echo '<pre>'; print_r($data['wish_list']); exit;
     
  		$this->load->view('common/header',$data);
  		$this->load->view('my_wishlist',$data);
  		$this->load->view('common/footer');
	}
	
	public function remove_wishlist()
	{
		$wish_id = $this->input->post('wish_id');
		$user_id = $this->session->userdata('user_session_id');

		$this->db->where('wish_id',$wish_id);
		$this->db->where('user_id',$user_id);
		$this->db->delete('tbl_wishlist');
		$result=1;
		echo json_encode(array('del_result'=>$result));
	}

public function add_wishlist()
{
    
    $product_id= $this->input->post('pro_id');
    
    @$product_details = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
    $product_name = @$product_details[0]->product_name;  
    $product_price = @$product_details[0]->price;
    $product_discount = @$product_details[0]->discount;
    $product_net_price = @$product_details[0]->net_price;

    
    if($this->session->userdata('user_session_id')=='')
    {
        $wish_sess_id= 'wish'.time().rand(000,999);
        $wish_sess_array= array(
                                    'wish_sess_id'=>$wish_sess_id,       // Wish Session Set //
                                    'wish_pro_id'=>$product_id
                              );
        $this->session->set_userdata($wish_sess_array);
        $result=3;
    }
    else
    {

            $this->session->unset_userdata('wish_sess_id');
            $this->session->unset_userdata('wish_pro_id');             // wish Session destroy  //



            $chk_wish_lst = $this->common_model->common($table_name = 'tbl_wishlist', $field = array(), $where = array('product_id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
            if(count($chk_wish_lst)>0)
            {
              $this->db->where('product_id',$product_id);
              $this->db->delete('tbl_wishlist');
              $result=1;
              $user_id= $this->session->userdata('user_session_id');
            }
            else
            {
              
              $user_id = $this->session->userdata('user_session_id');
              $wishlist_data = array(

                                        'product_id'=>$product_id,
                                        'product_name'=>$product_name,
                                        'product_price'=>$product_price,
                                        'product_discount'=>$product_discount,
                                        'product_net_price'=>$product_net_price,
                                        'user_id'=>$user_id

                                    );

            $this->db->insert('tbl_wishlist',$wishlist_data);
            $result=2;
            
            }
    }

    echo json_encode(array('wishlist'=>$result));
   
}


	
}
?>