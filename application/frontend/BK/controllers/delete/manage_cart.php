<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class manage_cart extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}
	
	public function add_to_cart()
	{
		
		$product_id = $this->input->post('product_id');
		$product_quantity = $this->input->post('product_quantity');
		//$this->session->unset_userdata('cart_session_id');
		$cart_sess_id= $this->session->userdata('cart_session_id');
        
        if($cart_sess_id=='')
        {
            $cart_id= 'AKD- '.time().rand(0000,9999);
            $cart_sess_array= array(
                                        'cart_session_id'=>$cart_id
                                   );
            $this->session->set_userdata($cart_sess_array);
            $cart_sess_id= $this->session->userdata('cart_session_id');
        }
        else
        {
            $cart_sess_id= $this->session->userdata('cart_session_id');
        }


        @$product_details= $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		
		$product_price = @$product_details[0]->price;
		$product_discount = @$product_details[0]->discount;
		$product_net_price = @$product_details[0]->net_price;

		$user_id = $this->session->userdata('user_session_id');   // chk if the user login is there //

		if($user_id=='')   // cart item //
		{
			$check_cart_item= $this->common_model->common($table_name = 'tbl_cart_item', $field = array(), $where = array('cart_session_id'=>$cart_sess_id,'cart_item_id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
			if(count($check_cart_item)==0)
			{

				$cart_data= array(
	                                'cart_session_id'=>$cart_sess_id,                              
	                                'cart_item_id'=>$product_id,
	                                'cart_item_qty'=>$product_quantity,                               
	                                'cart_item_price'=>$product_price,
	                                'cart_item_price_disc'=>$product_discount,
	                                'cart_item_net_price'=>$product_net_price,
	                            );

				$this->db->insert('tbl_cart_item',$cart_data );
			}
			else
			{
				$cart_data= array(
	                                'cart_session_id'=>$cart_sess_id,                              
	                                'cart_item_id'=>$product_id,
	                                'cart_item_qty'=>$product_quantity,                                
	                                'cart_item_price'=>$product_price,
	                                'cart_item_price_disc'=>$product_discount,
	                                'cart_item_net_price'=>$product_net_price,
	                            );

				$this->db->where('cart_item_id',$product_id);
				$this->db->update('tbl_cart_item',$cart_data );
			}
		}
		else    // seller cart //
		{
			$check_seller_cart_item= $this->common_model->common($table_name = 'tbl_seller_cart', $field = array(), $where = array('cart_session_id'=>$cart_sess_id,'cart_item_id'=>$product_id,'user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
			if(count($check_seller_cart_item)==0)
			{
				$seller_cart_data= array(
	                                'cart_session_id'=>$cart_sess_id,                              
	                                'cart_item_id'=>$product_id,
	                                'cart_item_qty'=>$product_quantity,                                
	                                'cart_item_price'=>$product_price,
	                                'cart_item_price_disc'=>$product_discount,
	                                'cart_item_net_price'=>$product_net_price,
	                                'user_id'=>$user_id,
	                            );

				$this->db->insert('tbl_seller_cart',$seller_cart_data );
			}
			else
			{
				$seller_cart_data= array(
	                                'cart_session_id'=>$cart_sess_id,                              
	                                'cart_item_id'=>$product_id,
	                                'cart_item_qty'=>$product_quantity,                                
	                                'cart_item_price'=>$product_price,
	                                'cart_item_price_disc'=>$product_discount,
	                                'cart_item_net_price'=>$product_net_price,
	                                'user_id'=>$user_id,
	                            );

				$this->db->where('cart_item_id',$product_id);
				$this->db->update('tbl_seller_cart',$seller_cart_data );
			}
		} ?>


		 <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
          <?php
          $cart_sess_id= $this->session->userdata('cart_session_id');

          if($cart_sess_id!='')
          {
                if($this->session->userdata('user_session_id')!='')
                {
                    $user_id = $this->session->userdata('user_session_id');

                    @$cart_list = $this->common_model->common($table_name = 'tbl_seller_cart', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                }
                else
                {
                    @$cart_list = $this->common_model->common($table_name = 'tbl_cart_item', $field = array(), $where = array('cart_session_id'=>$cart_sess_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                }

                $crt_item_count= count(@$cart_list);

          ?>

            <div class="items-cart-inner">
              <div class="basket">
                <img src="<?php echo base_url();?>assets/images/shopping-cart.png" alt="" class="cart-icon">

              </div>
              <div class="basket-item-count"><span class="count"><?php echo $crt_item_count; ?></span></div>
              
            </div>
            </a>


            <ul class="dropdown-menu">
            <?php 
              
              if($crt_item_count>0)
              {
                

            ?>
              <li>
                <div class="cart-item product-summary">
                  <?php 
                    $sub_total=0;
                    foreach($cart_list as $cart)
                    {

                      $product_id = $cart->cart_item_id;
                      @$cart_product_details = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                      @$cart_product_image = $this->common_model->common($table_name = 'tbl_product_image', $field = array(), $where = array('product_id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

                  ?>
                  <div class="row">
                    <div class="col-xs-4">
                      <div class="image"> <a href="<?php echo $this->url->link(4); ?>/<?php echo $product_id; ?>/<?php echo @$cart_product_details[0]->slug; ?>"><img src="<?php echo base_url();?>assets/upload/product/<?php echo @$cart_product_image[0]->image;?>" alt=""></a> </div>
                    </div>
                    <div class="col-xs-7">
                      <h3 class="name"><a href="<?php echo $this->url->link(4); ?>/<?php echo $product_id; ?>/<?php echo @$cart_product_details[0]->slug; ?>"><?php echo @$cart_product_details[0]->product_name;?></a></h3>
                       <div class="price" id="kom">( <i class="fa fa-inr"></i>  <?php echo @$cart_product_details[0]->net_price;?> ) X <?php echo $cart->cart_item_qty;?> <br>= <i class="fa fa-inr"></i> <?php echo (@$cart_product_details[0]->net_price*$cart->cart_item_qty)?></div>
                    </div>
                    <div class="col-xs-1 action"  onclick="delete_cart(<?php echo $cart->id;?>)"> <a href="#"><i class="fa fa-trash"></i></a> </div>
                  </div>
                  <p></p>
                  <?php 
                    $sub_total= $sub_total+((@$cart_product_details[0]->net_price)*($cart->cart_item_qty));
                  } ?>
                </div>
                <!-- /.cart-item -->
                <div class="clearfix"></div>
                <hr>
                <div class="clearfix cart-total">
                  <div class="pull-left"> <span class="text">Sub Total :</span><span class='price'><i class="fa fa-inr"></i>  <?php echo $sub_total;?></span> </div>
                  <div class="clearfix"></div>
                  <a href="<?php echo $this->url->link(8);?>" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> 
                  <div class="clearfix"></div>
                  <a href="<?php echo $this->url->link(14);?>" class="btn btn-upper btn-primary btn-block m-t-20" >View Cart</a></div>
               <!--  /.cart-total  -->
                
              </li>
              <?php 

              } 

              ?>
            </ul>


            <!-- /.dropdown-menu--> 
          </div>
          <?php } else { ?> 

          <div class="items-cart-inner">
              <div class="basket">
                <img src="<?php echo base_url();?>assets/images/shopping-cart.png" alt="" class="cart-icon">

              </div>
              <div class="basket-item-count"><span class="count">0</span></div>
              
          </div>
          <?php } ?>

          <?php

	}


	public function remove_cart()
	{
		$cart_id = $this->input->post('cart_id');
		$user_id = $this->session->userdata('user_session_id');

		if($user_id!='')
		{
			$this->db->where('id', $cart_id);
        	$this->db->delete('tbl_seller_cart');

        	$cart_sess_id= $this->session->userdata('cart_session_id');
        	$cart_list = $this->common_model->common($table_name = 'tbl_seller_cart', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		}
		else
		{
			$this->db->where('id', $cart_id);
          	$this->db->delete('tbl_cart_item');

          	$cart_sess_id= $this->session->userdata('cart_session_id');
          	$cart_list = $this->common_model->common($table_name = 'tbl_cart_item', $field = array(), $where = array('cart_session_id'=>$cart_sess_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		}

		if(count($cart_list)==0)
    	{
      		$this->session->unset_userdata('cart_session_id');
    	} ?>

    	<div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
          <?php
          $cart_sess_id= $this->session->userdata('cart_session_id');

          if($cart_sess_id!='')
          {
                if($this->session->userdata('user_session_id')!='')
                {
                    $user_id = $this->session->userdata('user_session_id');

                    @$cart_list = $this->common_model->common($table_name = 'tbl_seller_cart', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                }
                else
                {
                    @$cart_list = $this->common_model->common($table_name = 'tbl_cart_item', $field = array(), $where = array('cart_session_id'=>$cart_sess_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                }

                $crt_item_count= count(@$cart_list);

          ?>

            <div class="items-cart-inner">
              <div class="basket">
                <img src="<?php echo base_url();?>assets/images/shopping-cart.png" alt="" class="cart-icon">

              </div>
              <div class="basket-item-count"><span class="count"><?php echo $crt_item_count; ?></span></div>
              
            </div>
            </a>


            <ul class="dropdown-menu">
            <?php 
              
              if($crt_item_count>0)
              {
                

            ?>
              <li>
                <div class="cart-item product-summary">
                  <?php 
                    $sub_total=0;
                    foreach($cart_list as $cart)
                    {

                      $product_id = $cart->cart_item_id;
                      @$cart_product_details = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                      @$cart_product_image = $this->common_model->common($table_name = 'tbl_product_image', $field = array(), $where = array('product_id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

                  ?>
                  <div class="row">
                    <div class="col-xs-4">
                      <div class="image"> <a href="<?php echo $this->url->link(4); ?>/<?php echo $product_id; ?>/<?php echo @$cart_product_details[0]->slug; ?>"><img src="<?php echo base_url();?>assets/upload/product/<?php echo @$cart_product_image[0]->image;?>" alt=""></a> </div>
                    </div>
                    <div class="col-xs-7">
                      <h3 class="name"><a href="<?php echo $this->url->link(4); ?>/<?php echo $product_id; ?>/<?php echo @$cart_product_details[0]->slug; ?>"><?php echo @$cart_product_details[0]->product_name;?></a></h3>
                      <div class="price" id="kom">( <i class="fa fa-inr"></i>  <?php echo @$cart_product_details[0]->net_price;?> ) X <?php echo $cart->cart_item_qty;?> <br>= <i class="fa fa-inr"></i> <?php echo (@$cart_product_details[0]->net_price*$cart->cart_item_qty)?></div>
                    </div>
                    <div class="col-xs-1 action" onclick="delete_cart(<?php echo $cart->id;?>)"> <a href="#"><i class="fa fa-trash"></i></a> </div>
                  </div>
                  <p></p>
                  <?php 
                    $sub_total= $sub_total+((@$cart_product_details[0]->net_price)*($cart->cart_item_qty));
                  } ?>
                </div>
                <!-- /.cart-item -->
                <div class="clearfix"></div>
                <hr>
                <div class="clearfix cart-total">
                  <div class="pull-left"> <span class="text">Sub Total :</span><span class='price'><i class="fa fa-inr"></i> <?php echo $sub_total;?></span> </div>
                  <div class="clearfix"></div>
                  <a href="<?php echo $this->url->link(8);?>" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> 
                  <div class="clearfix"></div>
                  <a href="<?php echo $this->url->link(14);?>" class="btn btn-upper btn-primary btn-block m-t-20" >View Cart</a></div>
               <!--  /.cart-total  -->
                
              </li>
              <?php 

              } 

              ?>
            </ul>


            <!-- /.dropdown-menu--> 
          </div>
          <?php } else { ?> 

          <div class="items-cart-inner">
              <div class="basket">
                <img src="<?php echo base_url();?>assets/images/shopping-cart.png" alt="" class="cart-icon">

              </div>
              <div class="basket-item-count"><span class="count">0</span></div>
              
          </div>
          <?php } ?>
	<?php }
	
	   public function cart_list_view()
    {
        
        if($this->session->userdata('cart_session_id')=='')
        {
          redirect($this->url->slug(1),'refresh');
        }

        //$data['cart_list'] = $this->common_model->common($table_name='tbl_seller_cart',$field=array(),$where=array('user_id'=>$user_id),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());
         
        $this->load->view('common/header');
        $this->load->view('shopping_cart');
        $this->load->view('common/footer');
  }

   public function update_cart_qnty()
    {
        
        $cart_id= $this->input->post('cart_id');
        $update_quantity= $this->input->post('update_quantity');
        $update_data= array('cart_item_qty'=>$update_quantity);
        $user_id = $this->session->userdata('user_session_id');
        if($user_id!='')
        {
          $this->db->where('id',$cart_id);
          $this->db->update('tbl_seller_cart',$update_data);
        }
        else
        {
          $this->db->where('id',$cart_id);
          $this->db->update('tbl_cart_item',$update_data);
        }

  }
  public function delete_cart()
  {

    $cart_id= $this->uri->segment(3);
    $user_id = $this->session->userdata('user_session_id');
    
    if($user_id!=''){


          $this->db->where('id', $cart_id);
          $this->db->delete('tbl_seller_cart');

          $cart_sess_id= $this->session->userdata('cart_session_id');
          $cart_list = $this->common_model->common($table_name = 'tbl_seller_cart', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

          

      }
      else
      {

          $this->db->where('id', $cart_id);
          $this->db->delete('tbl_cart_item');

          $cart_sess_id= $this->session->userdata('cart_session_id');
          $cart_list = $this->common_model->common($table_name = 'tbl_cart_item', $field = array(), $where = array('cart_session_id'=>$cart_sess_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
      }
    

    if(count($cart_list)==0)
    {
      $this->session->unset_userdata('cart_session_id');
      redirect($this->url->link(1),'refresh');
    }
    else
    {
      
      redirect($this->url->link(14),'refresh');
    }
  }

  
  


	
}
?>