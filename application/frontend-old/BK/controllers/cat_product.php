<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class cat_product extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
          $this->load->model('common/admin_model');

	}
	
	public function index()
	{
    //*************************************************** url category by product **********************************//

    //echo 'hi'; exit;
    $parent_category = $this->uri->segment(2);
    $sub_category = $this->uri->segment(3);
    $category = $this->uri->segment(4);

    $parent_category_data=$this->admin_model->selectOne('tbl_category','category_slug',$parent_category);
    $sub_category_data=$this->admin_model->selectOne('tbl_category','category_slug',$sub_category);
    $category_data=$this->admin_model->selectOne('tbl_category','category_slug',$category);

    $data_model=array(

                      'parent_category_id'=>@$parent_category_data['0']->category_id,
                      'sub_category_id'=>@$sub_category_data['0']->category_id,
                      'category_id'=>@$category_data['0']->category_id,
                    );

		$this->session->unset_userdata('search_sess_name');
    $this->session->unset_userdata('search_category');

		$data['parent_category'] = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('parent_category'=>'o','sub_category'=>'o'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


    $data['brand'] = $this->common_model->common($table_name = 'tbl_brand', $field = array(), $where = array('status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    $data['banner'] = $this->common_model->common($table_name = 'tbl_banner', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
     
    $total_row = $this->common_model->product_list_total_count($data_model);
     if($parent_category!="" && ($sub_category=="" && $category==""))
      {
        $url=$this->uri->segment(2);
        $config['base_url'] = base_url().$this->url->slug(2)."/".$url."?";
      }
      if($sub_category!="" && $category=="")
      {
        $url=$this->uri->segment(2).'/'.$this->uri->segment(3);
        $config['base_url'] = base_url().$this->url->slug(2)."/".$url."?";
      }
      if($category!="")
      {
        $url=$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4);
        $config['base_url'] = base_url().$this->url->slug(2)."/".$url."?";
      }
		

            $config['total_rows'] = count($total_row); 
            $config['per_page'] = 9;
            $config['first_link'] = 'FIRST';
            $config['last_link'] = 'LAST';
            $config['first_tag_open'] = '<li  class="paging-nav">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li  class="paging-nav">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = '<i class="fa fa-angle-right"></i>';
            $config['next_tag_open'] = '<li  class="next">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
            $config['prev_tag_open'] = '<li  class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['full_tag_open'] = '<ul class="list-inline list-unstyled" id="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['cur_tag_open'] = '<li class="number active"><span class="font600"><b>';
            $config['cur_tag_close'] = '</b></span></li>';
            $config['num_tag_open'] = '<li class="number"><span class="font600">';
            $config['num_tag_close'] = '</span></li>';

            $config["num_links"] =5;
            $config['page_query_string'] = TRUE;

             $this->pagination->initialize($config);
            if(isset($_GET['per_page'])){
                $page = $_GET['per_page'] ;


            }
            else{
                $page = 0;
            }

             $str_links = $this->pagination->create_links();

          
            //echo "<pre>";print_r($str_links);
            //exit;
           $data['links'] = $str_links;


	    $data['product'] = $this->common_model->product_list_total($data_model,$page,$config['per_page']);
		  
  		$this->load->view('common/header');
  		$this->load->view('category',$data);
  		$this->load->view('common/footer');
	}
	
	
    public function get_product(){
       
          $value = $this->input->post('request');
          $category = $this->input->post('cat_id');
          //echo $value;
          $pro_arr=array();
          if($category>0)
          {
            $arr = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('status'=>'Active','cat_id'=>$category), $where_or = array(), $like = array('product_name'=>$value), $like_or = array(), $order = array(), $start = '', $end = '');
            if(count($arr)>0)
            {

              foreach($arr as $row)
              {
                $pro_arr[]=$row->product_name;
              }
            }
            /*else
            {
              $arr = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('status'=>'Active'), $where_or = array(), $like = array('product_name'=>$value), $like_or = array(), $order = array(), $start = '', $end = '');
              foreach($arr as $row)
              {
                $pro_arr[]=$row->product_name;
              }
            }*/
          }
          else
          {
            $arr = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('status'=>'Active'), $where_or = array(), $like = array('product_name'=>$value), $like_or = array(), $order = array(), $start = '', $end = '');
            if(count($arr)>0)
            {

              foreach($arr as $row)
              {
                $pro_arr[]=$row->product_name;
              }
            }
          }
          

        

          /*$arr1=$this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array(), $where_or = array(), $like = array('category_name'=>$value), $like_or = array(), $order = array(), $start = '', $end = '');
            if(count($arr1)>0)
            {

              foreach($arr1 as $row)
              {
                $pro_arr[]=$row->category_name;
              }
            }*/

          //print_r($arr);exit;
          echo json_encode($pro_arr);
    
    }


  public function search_product()
  {


    $search_category = $this->input->post('category_id');
    $search_product = $this->input->post('search_name');

    $session_array = array('search_sess_name'=>$search_product);
    $this->session->set_userdata($session_array);
    //echo $search_product; exit;
    //echo 'working'; exit;
    $data['parent_category'] = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('parent_category'=>'o','sub_category'=>'o'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
    $data['brand'] = $this->common_model->common($table_name = 'tbl_brand', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
    $total_row=$this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('product_name'=>$search_product,'cat_id'=>$search_category), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
    $url=$this->uri->segment(2);
    $config['base_url'] = base_url().$this->url->slug(30)."/".$url."?";

            $config['total_rows'] = count($total_row); 
            $config['per_page'] = 9;
            $config['first_link'] = 'FIRST';
            $config['last_link'] = 'LAST';
            $config['first_tag_open'] = '<li  class="paging-nav">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li  class="paging-nav">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = '<i class="fa fa-angle-right"></i>';
            $config['next_tag_open'] = '<li  class="next">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
            $config['prev_tag_open'] = '<li  class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['full_tag_open'] = '<ul class="list-inline list-unstyled" id="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['cur_tag_open'] = '<li class="number active"><span class="font600"><b>';
            $config['cur_tag_close'] = '</b></span></li>';
            $config['num_tag_open'] = '<li class="number"><span class="font600">';
            $config['num_tag_close'] = '</span></li>';

            $config["num_links"] =5;
            $config['page_query_string'] = TRUE;

             $this->pagination->initialize($config);
            if(isset($_GET['per_page'])){
                $page = $_GET['per_page'] ;


            }
            else{
                $page = 0;
            }

             $str_links = $this->pagination->create_links();

          
           
            $data['links'] = $str_links;
    
            $data['product']= $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('product_name'=>$search_product,'cat_id'=>$search_category), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = $page, $end = $config['per_page']);

  
    
            $this->load->view('common/header');
            $this->load->view('category',$data);
            $this->load->view('common/footer');
  }

  public function get_cat_name()
  {
    $cat_id = $this->input->post('cat_id');
    if($cat_id==0)
    {
      //$category = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('category_id'=>$cat_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
      $this->session->unset_userdata('search_category');
      $search_category_session = array('search_category'=>'Category...');

      $this->session->set_userdata($search_category_session);
      $cat_name = 'Category...';
      echo json_encode($cat_name);
    }
    else
    {
      $category = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('category_id'=>$cat_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
      //$cat_name = @$category[0]->category_name;
      $this->session->unset_userdata('search_category');
      $search_category_session = array('search_category'=>substr(@$category[0]->category_name, 0, 7).'...');
      $this->session->set_userdata($search_category_session);
      $cat_name = substr(@$category[0]->category_name, 0, 7).'...';
      echo json_encode($cat_name);
    }
    

  }




  public function get_filtered_data()
  {
        $this->session->unset_userdata('search_sess_name');
        $this->session->unset_userdata('search_category');

              //$product_cat_slug = $this->input->post('cat_slug');
              $brand_id= $this->input->post('brand_id');
              
              $parent_category = $this->input->post('parent_cat');
              $sub_category = $this->input->post('sub_cat');
              $category = $this->input->post('cat');

              if($parent_category=='search_product')
              {
                $product =  $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('status'=>'Active','brand_id'=>$brand_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
              }
              else
              {
                $parent_category_data=$this->admin_model->selectOne('tbl_category','category_slug',$parent_category);
                $sub_category_data=$this->admin_model->selectOne('tbl_category','category_slug',$sub_category);
                $category_data=$this->admin_model->selectOne('tbl_category','category_slug',$category);

                $data_model=array(

                        'parent_category_id'=>@$parent_category_data[0]->category_id,
                        'sub_category_id'=>@$sub_category_data[0]->category_id,
                        'category_id'=>@$category_data[0]->category_id,
                      );
                
                $product = $this->common_model->product_list_total_by_brand($data_model,$brand_id);
              }          
                    if(count($product)>0){
                        foreach($product as $row)
                        {

                          $id=$row->id;

                ?>
                  <div class="col-sm-6 col-md-4 wow fadeInUp">
                    <div class="products" id="products">
                      <div class="product">
                        <div class="product-image">

                        <?php 

                              $image= $this->common_model->common($table_name = 'tbl_product_image', $field = array(), $where = array('product_id'=>$id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

                        ?>
                          <div class="image"> <a href="<?php echo $this->url->link(4); ?>/<?php echo $row->id; ?>/<?php echo $row->slug; ?>"><img  src="<?php echo base_url(); ?>assets/upload/product/<?php echo @$image[0]->image; ?>" alt=""></a> </div>
                          <!-- /.image -->
                          
                          <!-- <div class="tag new"><span>new</span></div> -->
                        </div>
                        <!-- /.product-image -->
                        
                        <div class="product-info text-left">
                          <h3 class="name"><a href="<?php echo $this->url->link(4); ?>/<?php echo $row->id; ?>/<?php echo $row->slug; ?>"><?php echo $row->product_name; ?></a></h3>
                          <div class="rating rateit-small"></div>
                          <div class="description"></div>
                          <div class="product-price"> <span class="price"> <i class="fa fa-inr"></i> <?php echo $row->net_price; ?> </span> <span class="price-before-discount"><i class="fa fa-inr"></i> <?php echo $row->price; ?></span> </div>
                          <!-- /.product-price --> 
                          
                        </div>
                        <!-- /.product-info -->
                        <div class="cart clearfix animate-effect">
                          <div class="action">
                            <ul class="list-unstyled">
                              <li class="add-cart-button btn-group">
                                <button class="btn btn-primary icon" data-toggle="dropdown" type="button" onclick="add_to_cart_single(<?php echo $row->id?>)" <?php if(@$row->availability=='No'){ echo 'disabled'; } ?>> <i class="fa fa-shopping-cart"></i> </button>
                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                              </li>
                              <li class="lnk wishlist"> <a class="add-to-cart" onclick="add_to_wishlist(<?php echo $row->id;?>)" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                        
                            </ul>
                          </div>
                          <!-- /.action --> 
                        </div>
                        <!-- /.cart --> 
                      </div>
                      <!-- /.product --> 
                      
                    </div>
                    <!-- /.products --> 
                  </div>
                  <!-- /.item -->
                  <?php }  }

                    else {
                            echo 'No Products Available.';
                          }
        

    }
	
}
?>