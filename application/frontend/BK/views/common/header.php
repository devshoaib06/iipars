<!DOCTYPE html> 
<html lang="en">

<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>DSY ApnaBazar </title>
<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/fav.png">

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">



<!-- Customizable CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/blue.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.carousel.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.transitions.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/rateit.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-select.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/responsive.css">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ubislider.css">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.css">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1"> 
  
  <!-- ============================================== TOP MENU ============================================== -->
  <div class="top-bar animate-dropdown">
    <div class="container">
      <div class="header-top-inner">
        <div class="cnt-account">
          <ul class="list-unstyled">
            <li><a href="business-concept.php"><i class="icon fa fa-user-plus"></i>Business Concept</a></li>
            <li><a href="http://dsyapnabazar.com/onlineform"><i class="icon fa fa-user-plus"></i>Become a Member</a></li>
            <li><a href="<?php echo $this->url->link(18); ?>"><i class="icon fa fa-heart"></i>Become a Seller</a></li>
           <?php if($this->session->userdata('user_session_id')!=''){
              $user_id = $this->session->userdata('user_session_id');
              $user = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
              $user_type_id =@$user[0]->user_type_id; 

            ?>
            <?php if($user_type_id=='3'){?>
            <li><a href="<?php echo $this->url->link(7);?>">Wishlist</a></li>
            
          <?php }} ?>
           <?php if($this->session->userdata('user_session_id')!=''){
              $user_id = $this->session->userdata('user_session_id');
              $user = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
              $user_type_id =@$user[0]->user_type_id; 
            ?>
            <li class="dropdown" id="mac"><a href="#" class="dropdown-toggle"  data-toggle="dropdown" href="#"><?php echo @$user[0]->first_name;?><b class="caret"></b></a>            
                <ul class="dropdown-menu" role="menu" id="ac-bx" >
                      <?php if($user_type_id=='2'){ ?>
                      <li role="presentation"><a href="<?php echo $this->url->link(20);?>" role="menuitem" tabindex="-1">My Profile</a></li>                  
                      <?php } else { ?>
                      <li role="presentation"><a href="<?php echo $this->url->link(5);?>" role="menuitem" tabindex="-1">My Profile</a></li>
                      <?php } ?>
                      <li role="presentation"><a  role="menuitem" tabindex="-1" href="<?php echo base_url();?>my_account/log_out">Log out</a></li>                  
                </ul>
            </li>
            <?php } ?>
            <!-- <li><a href="#">My Cart</a></li>
            <li><a href="#">Checkout</a></li> -->
            <?php if($this->session->userdata('user_session_id')==''){?>
                <li><a href="<?php echo $this->url->link(3); ?>"><i class="icon fa fa-user"></i>Sign up</a></li>
            <li><a href="<?php echo $this->url->link(3); ?>"><i class="icon fa fa-lock"></i>Log in</a></li> 
            <?php } else { 
                $user_id = $this->session->userdata('user_session_id');
                $user_details =  $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
              ?>
              <!-- <?php if(@$user_details[0]->user_type_id=='2'){?>
                <li><a href="<?php echo $this->url->link(20);?>"><?php echo @$user_details[0]->first_name;?></a></li>
                <?php } else { ?>
                <li><a href="<?php echo $this->url->link(5);?>"><?php echo @$user_details[0]->first_name;?></a></li>
                <?php } ?> -->
                          <?php } ?> 
          </ul>
        </div>
        <!-- /.cnt-account -->


        
        <div class="cnt-block1">
          <ul class="list-unstyled list-inline">
            <li class="dropdown dropdown-small"> <a class="ph-n" >Toll free: +91 1234567891</a>
              
            </li>
            
          </ul>
          <!-- /.list-unstyled --> 
        </div>
        <!-- /.cnt-cart -->
        <div class="clearfix"></div>
      </div>
      <!-- /.header-top-inner --> 
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.header-top --> 
  <!-- ============================================== TOP MENU : END ============================================== -->
  <div class="fhead">
  <div class="main-header">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 logo-holder"> 
          <!-- ============================================================= LOGO ============================================================= -->
          <div class="logo"> <a href="<?php echo base_url(); ?>"> <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="logo" class="logo-img"> </a> </div>
          <!-- /.logo --> 
          <!-- ============================================================= LOGO : END ============================================================= --> </div>
        <!-- /.logo-holder -->
        
        <div class="col-xs-10 col-sm-10 col-md-7 top-search-holder"> 
          <!-- /.contact-row --> 
          <!-- ============================================================= SEARCH AREA ============================================================= -->
          <div class="search-area">
            <form action="<?php echo base_url();?>cat_product/search_product" method="post" id="search_box">
              <div class="control-group">
                <ul class="categories-filter animate-dropdown">
                  <li class="dropdown"> <a class="dropdown-toggle"  data-toggle="dropdown" ><span id="search_category"><?php if($this->session->userdata('search_category')!=''){ echo $this->session->userdata('search_category'); } else { echo 'Categories'; }?></span> <b class="caret"></b></a>
                    
                    <ul class="dropdown-menu abcd" role="menu" >
                     <!-- <section class="dropdown-menu" role="menu" onclick="click_to_category(this.value)">  --> 
                    <li style="cursor: pointer;" onclick="click_to_category('0')" >Category</li>
                                                <?php 
                                                $category = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('parent_category !='=>'o','sub_category !='=>'o'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                                                foreach($category as $cat)

                                                {
                                                    /*$parent_cat = $cat->parent_category;
                                                    $parent = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('category_id'=>$parent_cat), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

                                                    $sub_cat = $cat->sub_category;
                                                    $sub = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('category_id'=>$sub_cat), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');*/


                                                ?>
                                                    
                                                    <!-- <option value="<?php echo $cat->category_id;?>"><?php if($parent_cat!=''){ echo @$parent[0]->category_name." >> "; } ?><?php if($sub_cat!=''){ echo @$sub[0]->category_name." >> "; } ?><?php echo $cat->category_name; ?></option> -->
                                                     
                                                     <li style="cursor: pointer;" onclick="click_to_category('<?php echo $cat->category_id;?>')"><?php echo $cat->category_name;?></li> 
                                                <?php 

                                                } ?> 
                        <!-- </section>   -->                 
                     </ul> 
                  </li>
                </ul>
                <input class="search-field" placeholder="Search here..." type="text" onkeypress="get_prod('search_name')" name="search_name" id="search_name" value="<?php if($this->session->userdata('search_sess_name')!=''){ echo $this->session->userdata('search_sess_name'); }?>" />
                <input type="hidden" name="category_id" id="category_id" value="">
                <button type="submit" class="search-button" ></button> </div>
            </form>
          </div>
          <!-- /.search-area --> 
          <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
        <!-- /.top-search-holder -->
        
        <div class="col-xs-2 col-sm-2 col-md-2 animate-dropdown top-cart-row"> 
          <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
        

    

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
                      <div class="price"  id="kom">( <i class="fa fa-inr"></i>  <?php echo @$cart_product_details[0]->net_price;?> ) X <?php echo $cart->cart_item_qty;?> <br>= <i class="fa fa-inr"></i> <?php echo (@$cart_product_details[0]->net_price*$cart->cart_item_qty)?></div>
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
                  <div class="pull-left"> <span class="text">Sub Total :</span><span class='price'><i class="fa fa-inr"></i>  <?php echo $sub_total;?></span> </div>
                  <div class="clearfix"></div>
                  <a href="<?php echo $this->url->link(8);?>" class="btn btn-upper btn-primary btn-block m-t-20" >Checkout</a> 
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
           
  </div>
          
          <!-- /.dropdown-cart --> 
            <!-- <div class="wishlist-link"><a href="#"><i class="icon-heart icons"></i></a></div> -->
          
          <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= --> </div>
        <!-- /.top-cart-row --> 
      </div>
      <!-- /.row --> 
      
    </div>
    <!-- /.container --> 
    
  </div>
  <!-- /.main-header --> 
  
  <!-- ============================================== NAVBAR ============================================== -->
  <div class="header-nav animate-dropdown">
    <div class="container">
      <div class="yamm navbar navbar-default" role="navigation">
        <div class="navbar-header">
       <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
       <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="nav-bg-class">
          <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
            <div class="nav-outer">
              <ul class="nav navbar-nav">
                <li class="active yamm-fw"> <a href="<?php echo $this->url->link(1); ?>">Home</a> </li>
                <?php 
  $category = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('parent_category'=>'o','sub_category'=>'o','show_menu'=>'Yes'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '0', $end = '6');

  if(count($category)>0){
    $i=0;
    foreach($category as $header_cat){
      $i++;
      $p_cat_id = $header_cat->category_id;
      //echo $p_cat_id;

      $category_image = $this->common_model->common($table_name = 'tbl_category_description', $field = array(), $where = array('category_id'=>$p_cat_id,'show_menu'=>'Yes'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

      $sub_category = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('parent_category'=>$p_cat_id,'sub_category'=>'o','show_menu'=>'Yes'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


?>
                 <li class="<?php if($this->uri->segment(3)==$header_cat->category_slug){ echo 'dropdown yamm mega-menu'; } ?>"> <a onclick="window.location.href='<?php echo $this->url->link(2);?>/<?php echo $header_cat->category_slug;?>'" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown" style="cursor: pointer"><?php echo $header_cat->category_name;?> 
                  <!-- <span class="caret" id="rgt-cnt1"></span> -->
                <span id="plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                <span id="plus1"><i class="fa fa-minus" aria-hidden="true"></i></span>
                </a>

                <?php 
                    if(count($sub_category)>0){ ?>

                  <ul class="dropdown-menu container">
                    <li>
                      <div class="yamm-content ">
                        <div class="row">
                 <?php

          foreach($sub_category as $s_cat){

            $sub_cat_id = $s_cat->category_id;
            $sub_sub_category = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('parent_category'=>$p_cat_id,'sub_category'=>$sub_cat_id,'show_menu'=>'Yes'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
      ?>        
                          
                          
                          
                       
                          
                      <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                            <h2 class="title"><a onclick="window.location.href='<?php echo $this->url->link(2);?>/<?php echo $header_cat->category_slug;?>/<?php echo $s_cat->category_slug;?>'" style="cursor: pointer;"><?php echo $s_cat->category_name;?></a></h2>
                            <ul class="links">
                              <?php 
                            if(count($sub_sub_category)>0){
                              foreach($sub_sub_category as $ss_category){
                        ?>
                               <li><a onclick="window.location.href='<?php echo $this->url->link(2);?>/<?php echo $header_cat->category_slug;?>/<?php echo $s_cat->category_slug;?>/<?php echo $ss_category->category_slug;?>'" style="cursor: pointer;"><?php echo $ss_category->category_name;?></a></li>
                                <?php } 
                            } ?>
                            </ul>
                          </div>
                          <!-- /.col -->
                          
                          
                          <?php }  
              ?>
                          <!-- /.yamm-content --> 
                          <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image"> <img class="img-responsive" src="<?php echo base_url(); ?>assets/upload/category/<?php echo @$category_image[0]->category_image ;?>" alt=""> </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                  <?php } ?>
                </li>
                <?php } }?>

              <!--   <li> <a href="category.php">Categories 2</a> </li>
                <li> <a href="category.php">Categories 3</a> </li>
                <li> <a href="category.php">Categories 4</a> </li>
                <li> <a href="category.php">Categories 5</a> </li>
                <li> <a href="category.php">Categories 6</a> </li>
                <li> <a href="category.php">Categories 7</a>
                
                </li> -->
                
              </ul>
              <!-- /.navbar-nav -->
              <div class="clearfix"></div>
            </div>
            <!-- /.nav-outer --> 
          </div>
          <!-- /.navbar-collapse --> 
          
        </div>
        <!-- /.nav-bg-class --> 
      </div>
      <!-- /.navbar-default --> 
    </div>
    <!-- /.container-class --> 
    
  </div>
  <!-- /.header-nav --> 

  </div>
  <!-- ============================================== NAVBAR : END ============================================== --> 
  
</header>
<script src="<?php echo base_url();?>assets/js/modernizr.custom.js"></script>
<link href="<?php echo base_url(); ?>assets/css/ul-css.css" rel="stylesheet">

 <script>
    

    function get_prod(text_id)
    {
        //alert(search_value);
        //alert($("#"+text_id).val());
       var cat_id = $('#category_id').val();
       var base_url='<?php echo base_url();?>';
        $( "#"+text_id ).autocomplete({
            source: function(request, response) {
             $.ajax({
             
             url:base_url+'cat_product/get_product',
             data:{'request':$("#"+text_id).val(),'cat_id':cat_id},
             dataType: "json",
             type: "POST",
             success: function(data){
                //alert(data);
             console.log(data);
             response(data);
             }
             });
             },

            //source: availableTags

        });

    }



    function search_validation()
    {
        var search_name= $("#search_name").val();

        if(search_name=='')
        {
            $("#search_name").focus();
            return false;
        }
        else{
            $("#search_form").submit();
        }
    }

    function click_to_category(id)
    {
      $('#category_id').val(id);
      //alert(id);
      
          $.ajax(
          {

            type: "POST",
            dataType: 'json',
            url: base_url + "cat_product/get_cat_name",
            data: {cat_id:id},
            async: false,
            success: function (data) {
                   //alert(data);
                   
                   $('#search_category').html(data);
                  

               }

           });
       /* }
        else
        {

          $("#search_category").html('Category');
       
        }*/
    }

    </script>
