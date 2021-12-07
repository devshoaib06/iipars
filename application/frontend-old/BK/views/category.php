

<div class="body-content outer-top-xs">
  <div class='container'>
    <div class='row'>
      <div class='col-md-3 col-sm-4 sidebar'> 
        <!-- ================================== TOP NAVIGATION ================================== -->
      
        <!-- /.side-menu --> 
        <!-- ================================== TOP NAVIGATION : END ================================== -->
        <div class="sidebar-module-container on-top">
          <div class="sidebar-filter"> 
            <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
            <div class="sidebar-widget wow fadeInUp">
              <h3 class="section-title">shop by</h3>
               <?php 
            if(count($parent_category)>0){

                foreach ($parent_category as $p_cat) {
                  
                  $p_cat_id = $p_cat->category_id;
                  $sub_category = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('parent_category'=>$p_cat_id,'sub_category'=>'o'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
               
          ?>
              <div class="widget-header">
                <h4 class="widget-title"<a href="<?php echo $this->url->link(2);?>/<?php echo $p_cat->category_slug;?>" class="dropdown-toggle" data-toggle="dropdown"><i id="pad-rig" aria-hidden="true"></i><?php echo $p_cat->category_name;?></a></h4>
              </div>
              <div class="sidebar-widget-body">
                <div class="accordion">
                   <?php 
                    if(count($sub_category)>0)
                      { ?>
                  <div class="accordion-group">
                      <?php 
                        
                          foreach($sub_category as $s_cat)
                          {

                            $sub_cat_id = $s_cat->category_id;
                            $sub_sub_category = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('parent_category'=>$p_cat_id,'sub_category'=>$sub_cat_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                    ?>
                    <div class="accordion-heading"> <a href="#collapse<?php echo $sub_cat_id ?> " data-toggle="collapse" class="accordion-toggle collapsed"><?php echo $s_cat->category_name;?></a> </div>
                    <?php }?>
                    <!-- /.accordion-heading -->
                    <div class="accordion-body collapse" id="collapse<?php echo $sub_cat_id ?>" style="height: 0px;">
                      <?php 
                            if(count($sub_sub_category)>0)
                            {
                              foreach($sub_sub_category as $ss_cat)
                              {
                          ?>
                      <div class="accordion-inner">
                        <ul>
                          <li><a href="<?php echo $this->url->link(2);?>/<?php echo $p_cat->category_slug;?>/<?php echo $s_cat->category_slug;?>/<?php echo $ss_cat->category_slug;?>"><?php echo $ss_cat->category_name;?></a></li>
                          <!-- <li><a href="#">categories2</a></li>
                          <li><a href="#">categories3</a></li>
                          <li><a href="#">categories4</a></li> -->
                        </ul>
                      </div>
                      <?php }}?>
                      <!-- /.accordion-inner --> 
                    </div>
                    <!-- /.accordion-body --> 
                  </div>
                  <!-- /.accordion-group -->
                  <?php }?>
                 
                  
                
                 
                  
                 
                 
                  
                </div>
                <!-- /.accordion --> 
              </div>
              <?php }}?>
              <!-- /.sidebar-widget-body --> 
            </div>
            <!-- /.sidebar-widget --> 
            <!-- ============================================== SIDEBAR CATEGORY : END ============================================== --> 
            
            <!-- ============================================== PRICE SILDER============================================== -->
            <div class="sidebar-widget wow fadeInUp">
              <div class="widget-header">
                <h4 class="widget-title">Price Slider</h4>
              </div>
              <div class="sidebar-widget-body m-t-10">
                <div class="price-range-holder"> <span class="min-max"> <span class="pull-left">$200.00</span> <span class="pull-right">$800.00</span> </span>
                  <input type="text" id="amount" style="border:0; color:#666666; font-weight:bold;text-align:center;">
                  <input type="text" class="price-slider" value="" >
                </div>
                <!-- /.price-range-holder --> 
                <a href="#" class="lnk btn btn-primary">Show Now</a> </div>
              <!-- /.sidebar-widget-body --> 
            </div>
            <!-- /.sidebar-widget --> 
            <!-- ============================================== PRICE SILDER : END ============================================== --> 
            <!-- ============================================== MANUFACTURES============================================== -->
            <?php if(count($brand)>0){?>
            <div class="sidebar-widget wow fadeInUp">
              <div class="widget-header">
                <h4 class="widget-title">Brand</h4>
              </div>
              <div class="sidebar-widget-body">
                 
                <ul class="list">
                  <?php foreach($brand as $bra){?>
                  <li><input  id="styled-checkbox-1" name="brand_name[]" type="checkbox" value="<?php echo $bra->brand_name; ?>"><label for="styled-checkbox-1"></label><a href="#"><?php echo $bra->brand_name; ?></a></li>

                 <input type="hidden" value="<?php echo $this->uri->segment(2);?>" name="hidden_parent_cat" id="hidden_parent_cat" >
                  <input type="hidden" value="<?php echo $this->uri->segment(3);?>" name="hiden_sub_cat" id="hiden_sub_cat" >
                  <input type="hidden" value="<?php echo $this->uri->segment(4);?>" name="hidden_cat" id="hidden_cat" >  
                 <?php }?>
                </ul>
                
                <!--<a href="#" class="lnk btn btn-primary">Show Now</a>--> 
              </div>
              <!-- /.sidebar-widget-body --> 
            </div>
            <!-- /.sidebar-widget --> 
            <?php }?>
           
            
           
             <div class="home-banner"> <img src="<?php echo base_url();?>assets/upload/banner/<?php echo @$banner[0]->banner; ?>" alt="Image" class="img"> </div>
          </div>
          <!-- /.sidebar-filter --> 
        </div>
        <!-- /.sidebar-module-container --> 
      </div>
      <!-- /.sidebar -->
      <div class='col-md-9 col-sm-8'> 
        <!-- ========================================== SECTION – HERO ========================================= -->
        
        
     
        <div class="clearfix filters-container m-t-10">
          <div class="row">
            <div class="col col-sm-6 col-md-6">
              
              <!-- /.filter-tabs --> 
            </div>
            <!-- /.col -->
           
            <!-- /.col -->
            <div class="col col-sm-6 col-md-6 text-right">
             <div class="col col-sm-6 col-md-7 col-xs-12 no-padding">
                <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                  <div class="fld inline">
                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                      <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> Position <span class="caret"></span> </button>
                      <ul role="menu" class="dropdown-menu">
                        <li role="presentation"><a href="#">position</a></li>
                        <li role="presentation"><a href="#">Price:Lowest first</a></li>
                        <li role="presentation"><a href="#">Price:HIghest first</a></li>
                        <li role="presentation"><a href="#">Product Name:A to Z</a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- /.fld --> 
                </div>
                <!-- /.lbl-cnt --> 
              </div>


               <div class="col col-sm-6 col-md-5 col-xs-12 no-padding">
                <div class="lbl-cnt"> <span class="lbl">Show</span>
                  <div class="fld inline">
                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                      <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1 <span class="caret"></span> </button>
                      <ul role="menu" class="dropdown-menu">
                        <li role="presentation"><a href="#">1</a></li>
                        <li role="presentation"><a href="#">2</a></li>
                        <li role="presentation"><a href="#">3</a></li>
                        <li role="presentation"><a href="#">4</a></li>
                        <li role="presentation"><a href="#">5</a></li>
                        <li role="presentation"><a href="#">6</a></li>
                        <li role="presentation"><a href="#">7</a></li>
                        <li role="presentation"><a href="#">8</a></li>
                        <li role="presentation"><a href="#">9</a></li>
                        <li role="presentation"><a href="#">10</a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- /.fld --> 
                </div>
                <!-- /.lbl-cnt --> 
              </div>


              <!-- /.pagination-container --> </div>
            <!-- /.col --> 
          </div>
          <!-- /.row --> 
        </div>
                <div class="search-result-container ">
          <div id="myTabContent" class="tab-content category-list">
            <div class="tab-pane active " id="grid-container">
              <div class="category-product">
                <div class="row" id="product_div">

                <?php 
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
                          <!-- <div class="rating rateit-small"></div> -->
                          <div class="singel_review">
                                        <?php 
                                        for($i=0; $i<@$row->avg_rating; $i++){
                                        ?>
                                                                                            
                                            <span class="fa fa-star"></span>

                                        <?php } ?>                                     
                                                            
                                        <?php 
                                        for($i=0; $i<5-(@$row->avg_rating); $i++){
                                        ?>
                                                                                            
                                        <span class="fa fa-star-o"></span>

                                        <?php } ?>
                        </div>
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
                  <?php } } else  { echo 'No Products Available.'; } ?>
                
                  
                  
                </div>
                <!-- /.row --> 
              </div>
              <!-- /.category-product --> 
              
            </div>
            <!-- /.tab-pane -->
            
           
            <!-- /.tab-pane #list-container --> 
          </div>
          <!-- /.tab-content -->
          <div class="clearfix filters-container">
            <div class="text-right">
              <div class="pagination-container">

                <?php echo $links; ?> 

                <!-- /.list-inline --> 
              </div>
              <!-- /.pagination-container --> </div>
            <!-- /.text-right --> 
            
          </div>
          <!-- /.filters-container --> 
          
        </div>
        
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.row --> 
    <!-- ============================================== BRANDS CAROUSEL ============================================== -->
   
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== --> </div>
  <!-- /.container --> 
  
</div>
<!-- /.body-content --> 
<script type="text/javascript">
  function product_by_brand(brand_id)
    {

        var base_url='<?php echo base_url(); ?>';
        //alert(brand_id);         
        var parent_cat_id= $("#hidden_parent_cat").val();
        var sub_cat_id= $("#hidden_sub_cat").val();
        var cat_id= $("#hidden_cat").val();


        //alert(searched_category);
       if(parent_cat_id=='search_product')
       {

            $.ajax(
            {

            type: "POST",
            dataType: 'html',
            url: base_url + "cat_product/get_filtered_data",
            data: {brand_id:brand_id,parent_cat:parent_cat_id},
            async: true,
            success: function (data) {
               //alert(data);

              // alert('Item successfully added to your cart');
               
               $("#product_div").html(data);
               $('body').animate({ scrollTop: 100 }, 'slow')
               //window.scrollTo(500, 0);


                }
            
            });

       }else
       {

            

            $.ajax(
            {

            type: "POST",
            dataType: 'html',
            url: base_url + "cat_product/get_filtered_data",
            data: {brand_id:brand_id,parent_cat:parent_cat_id,sub_cat:sub_cat_id,cat:cat_id},
            async: true,
            success: function (data) {
               //alert(data);

              // alert('Item successfully added to your cart');
                
               $("#product_div").html(data);
               $('body').animate({ scrollTop: 100 }, 'slow')
               //window.scrollTo(500, 0);


                }
            
            });
       }
        
    }
</script>



















