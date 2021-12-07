


<div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container">
    <div class="row"> 


    <div class="col-md-12">



        <div id="hero">
          <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
             <?php 

              foreach($slider as $row)
              {
          ?>
            <div class="item" style="background-image: url(<?php echo base_url();?>assets/upload/home_slider/<?php echo $row->home_slider_image; ?>);">
              <div class="container-fluid">
                <div class="caption bg-color vertical-center text-left">
                  <div class="slider-header fadeInDown-1"><?php echo $row->home_slider_title1; ?></div>
                  <div class="big-text fadeInDown-1"><?php echo $row->home_slider_title2; ?></div>
                 
                  <div class="button-holder fadeInDown-3"> <a href="detail.php" class="btn-lg btn btn-uppercase btn-primary shop-now-button btn-bann">Shop Now</a> </div>
                </div>
                <!-- /.caption --> 
              </div>
              <!-- /.container-fluid --> 
            </div>
            <!-- /.item -->
            
            


           <?php }?>
            
          </div>
          <!-- /.owl-carousel --> 
        </div>
        


    </div>









      <!-- ============================================== SIDEBAR ============================================== -->
      <div class="col-xs-12 col-sm-4 col-md-3 sidebar"> 
      
        
        <div class="sidebar-widget outer-bottom-small wow fadeInUp mar-top">
          <h3 class="section-title">Popular Product</h3>
          <div class="sidebar-widget-body outer-top-xs">
                 <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
              <div class="item">
                <div class="products special-product">

                <?php 
                    if(count($special_offer_product_1)>0){

                        foreach($special_offer_product_1 as $spl_offr_1)
                        {

                          $product_id = $spl_offr_1->id;
                          $product_image = $this->common_model->common($table_name = 'tbl_product_image', $field = array(), $where = array('product_id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                ?>
                  <div class="product">
                    <div class="product-micro">
                      <div class="row product-micro-row">
                        <div class="col col-xs-5">
                          <div class="product-image">
                            <div class="image"> <a href="<?php echo $this->url->link(4); ?>/<?php echo $spl_offr_1->id; ?>/<?php echo $spl_offr_1->slug; ?>"> <img src="<?php echo base_url();?>assets/upload/product/<?php echo $product_image[0]->image;?>" alt=""> </a>  </div>
                            <!-- /.image --> 
                            
                          </div>
                          <!-- /.product-image --> 
                        </div>
                        <!-- /.col -->
                        <div class="col col-xs-7">
                          <div class="product-info">
                            <h3 class="name"><a href="<?php echo $this->url->link(4); ?>/<?php echo $spl_offr_1->id; ?>/<?php echo $spl_offr_1->slug; ?>"><?php echo $spl_offr_1->product_name;?></a></h3>
                            <div class="rating rateit-small"><?php 
                                        for($i=0; $i<@$spl_offr_1->avg_rating; $i++){
                                        ?>
                                                                                            
                                            <span class="fa fa-star"></span>

                                        <?php } ?>                                     
                                                            
                                        <?php 
                                        for($i=0; $i<5-(@$spl_offr_1->avg_rating); $i++){
                                        ?>
                                                                                            
                                        

                                        <?php } ?></div>
                            <div class="product-price"> <span class="price"> $<?php echo $spl_offr_1->net_price;?>  </span> </div>
                            <!-- /.product-price --> 
                            
                          </div>
                        </div>
                        <!-- /.col --> 
                      </div>
                      <!-- /.product-micro-row --> 
                    </div>
                    <!-- /.product-micro --> 
                    
                  </div>
                  
                <?php }}?>
                </div>
              </div>
                 <div class="item">
                <div class="products special-product">

                <?php 
                    if(count($special_offer_product_2)>0){

                        foreach($special_offer_product_2 as $spl_offr_2)
                        {

                          $product_id = $spl_offr_2->id;
                          $product_image = $this->common_model->common($table_name = 'tbl_product_image', $field = array(), $where = array('product_id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                ?>
                  <div class="product">
                    <div class="product-micro">
                      <div class="row product-micro-row">
                        <div class="col col-xs-5">
                          <div class="product-image">
                            <div class="image"> <a href="<?php echo $this->url->link(4); ?>/<?php echo $spl_offr_2->id; ?>/<?php echo $spl_offr_2->slug; ?>"> <img src="<?php echo base_url();?>assets/upload/product/<?php echo $product_image[0]->image;?>" alt=""> </a>  </div>
                            <!-- /.image --> 
                            
                          </div>
                          <!-- /.product-image --> 
                        </div>
                        <!-- /.col -->
                        <div class="col col-xs-7">
                          <div class="product-info">
                            <h3 class="name"><a href="<?php echo $this->url->link(4); ?>/<?php echo $spl_offr_2->id; ?>/<?php echo $spl_offr_2->slug; ?>"><?php echo $spl_offr_2->product_name;?></a></h3>
                            <div class="rating rateit-small"><?php 
                                        for($i=0; $i<@$spl_offr_2->avg_rating; $i++){
                                        ?>
                                                                                            
                                            <span class="fa fa-star"></span>

                                        <?php } ?>                                     
                                                            
                                        <?php 
                                        for($i=0; $i<5-(@$spl_offr_2->avg_rating); $i++){
                                        ?>
                                                                                            
                                        

                                        <?php } ?></div>
                            <div class="product-price"> <span class="price"> $<?php echo $spl_offr_2->net_price;?>  </span> </div>
                            <!-- /.product-price --> 
                            
                          </div>
                        </div>
                        <!-- /.col --> 
                      </div>
                      <!-- /.product-micro-row --> 
                    </div>
                    <!-- /.product-micro --> 
                    
                  </div>
                  
                <?php }}?>
                </div>
              </div>
              <div class="item">
                <div class="products special-product">

                <?php 
                    if(count($special_offer_product_3)>0){

                        foreach($special_offer_product_3 as $spl_offr_3)
                        {

                          $product_id = $spl_offr_3->id;
                          $product_image = $this->common_model->common($table_name = 'tbl_product_image', $field = array(), $where = array('product_id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                ?>
                  <div class="product">
                    <div class="product-micro">
                      <div class="row product-micro-row">
                        <div class="col col-xs-5">
                          <div class="product-image">
                            <div class="image"> <a href="<?php echo $this->url->link(4); ?>/<?php echo $spl_offr_3->id; ?>/<?php echo $spl_offr_3->slug; ?>"> <img src="<?php echo base_url();?>assets/upload/product/<?php echo $product_image[0]->image;?>" alt=""> </a>  </div>
                            <!-- /.image --> 
                            
                          </div>
                          <!-- /.product-image --> 
                        </div>
                        <!-- /.col -->
                        <div class="col col-xs-7">
                          <div class="product-info">
                            <h3 class="name"><a href="<?php echo $this->url->link(4); ?>/<?php echo $spl_offr_3->id; ?>/<?php echo $spl_offr_3->slug; ?>"><?php echo $spl_offr_3->product_name;?></a></h3>
                            <div class="rating rateit-small"><?php 
                                        for($i=0; $i<@$spl_offr_3->avg_rating; $i++){
                                        ?>
                                                                                            
                                            <span class="fa fa-star"></span>

                                        <?php } ?>                                     
                                                            
                                        <?php 
                                        for($i=0; $i<5-(@$spl_offr_3->avg_rating); $i++){
                                        ?>
                                                                                            
                                        

                                        <?php } ?></div>
                            <div class="product-price"> <span class="price"> $<?php echo $spl_offr_3->net_price;?>  </span> </div>
                            <!-- /.product-price --> 
                            
                          </div>
                        </div>
                        <!-- /.col --> 
                      </div>
                      <!-- /.product-micro-row --> 
                    </div>
                    <!-- /.product-micro --> 
                    
                  </div>
                  
                <?php }}?>
                </div>
              </div>
              
            
            </div>          </div>
          <!-- /.sidebar-widget-body --> 
        </div>
        <!-- /.sidebar-widget --> 
        <!-- ============================================== SPECIAL OFFER : END ============================================== --> 
      
     
        
        
        
        <div class="home-banner"> <img src="<?php echo base_url();?>assets/upload/banner/<?php echo @$banner[0]->banner; ?>" alt="Image" class="img"> </div>
      </div>
      <!-- /.sidemenu-holder --> 
      <!-- ============================================== SIDEBAR : END ============================================== --> 
      
      <!-- ============================================== CONTENT ============================================== -->
      <div class="col-xs-12 col-sm-8 col-md-9 homebanner-holder"> 
        <!-- ========================================== SECTION – HERO ========================================= -->
        
        <!-- ========================================= SECTION – HERO : END ========================================= --> 
        
        <!-- ============================================== INFO BOXES ============================================== -->


       
        <!-- ============================================== INFO BOXES : END ============================================== --> 
        <!-- ============================================== SCROLL TABS ============================================== -->
        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
          <div class="more-info-tab clearfix ">
            <h3 class="new-product-title pull-left">New Arrival</h3>
            <!-- /.nav-tabs --> 
          </div>
          <div class="tab-content outer-top-xs">
            <div class="tab-pane in active" id="all">
              <div class="product-slider">

                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                    <?php if(count($trending_product)>0)
                     {
                         foreach($trending_product as $tren_product){


                          $product_id = $tren_product->id;
                          $product_image = $this->common_model->common($table_name = 'tbl_product_image', $field = array(), $where = array('product_id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                     ?>
                  <div class="item item-carousel">
                    <div class="products">
                      <div class="product">
                        <div class="product-image">
                             <div class="image"> <a href="<?php echo $this->url->link(4); ?>/<?php echo $tren_product->id; ?>/<?php echo $tren_product->slug; ?>"><img  src="<?php echo base_url();?>assets/upload/product/<?php echo $product_image[0]->image;?>" alt=""></a>  </div>
                          <!-- /.image -->
                          
                          <!-- <div class="tag new"><span>new</span></div> -->
                        </div>
                        <!-- /.product-image -->
                        
                        <div class="product-info text-left">
                           <h3 class="name"><a href="<?php echo $this->url->link(4); ?>/<?php echo $tren_product->id; ?>/<?php echo $tren_product->slug; ?>"><?php echo $tren_product->product_name;?></a></h3>
                          <div class="rating rateit-small"><?php 
                                        for($i=0; $i<@$tren_product->avg_rating; $i++){
                                        ?>
                                                                                            
                                            <span class="fa fa-star"></span>

                                        <?php } ?>                                     
                                                            
                                        <?php 
                                        for($i=0; $i<5-(@$tren_product->avg_rating); $i++){
                                        ?>
                                                                                            
                                       
                                        <?php } ?></div>
                          <div class="description"></div>
                         <div class="product-price"> <span class="price"> $<?php echo $tren_product->net_price;?> </span> <span class="price-before-discount">$ <?php echo $tren_product->price;?></span> </div>
                          <!-- /.product-price --> 
                          
                        </div>
                        <!-- /.product-info -->
                        <div class="cart clearfix animate-effect">
                          <div class="action">
                           <ul class="list-unstyled">
                              <li class="add-cart-button btn-group">
                          <button class="btn btn-primary icon" data-toggle="dropdown" type="button" onclick="add_to_cart_single(<?php echo $tren_product->id?>)" <?php if(@$tren_product->availability=='No'){ echo 'disabled'; } ?>> <i class="fa fa-shopping-cart"></i> </button>
                          <button class="btn btn-primary cart-btn" type="submit" >Add to cart</button>
                        </li>
                        <li class="lnk wishlist"> <a class="add-to-cart" title="Wishlist" onclick="add_to_wishlist(<?php echo $tren_product->id;?>)"> <i class="icon fa fa-heart-o"></i> </a> </li>
                              
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
                  <?php }}?>
                 
              
              
               




              

                


                       


                 




                       




                     

                      






                </div>
                <!-- /.home-owl-carousel --> 
              </div>
              <!-- /.product-slider --> 
            </div>
            <!-- /.tab-pane -->
            
            
            
            
            <!-- /.tab-pane --> 
            
          </div>
          <!-- /.tab-content --> 
        </div>
        <!-- /.scroll-tabs --> 
        <!-- ============================================== SCROLL TABS : END ============================================== --> 
        <!-- ============================================== WIDE PRODUCTS ============================================== -->
        <div class="wide-banners wow fadeInUp outer-bottom-xs">
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="wide-banner cnt-strip">
                <div class="image"> 
                <div class="banner-box2"><a href="#"><img src="<?php echo base_url();?>assets/upload/banner/<?php echo @$banner[1]->banner; ?>" class="img" alt=""></a>

                

                </div>
                </div>
              </div> 
              <!-- /.wide-banner --> 
            </div>

            <div class="col-md-6 col-sm-6">
              <div class="wide-banner cnt-strip">
                <div class="image"> 
                <div class="banner-box2"><a href="#"><img src="<?php echo base_url();?>assets/upload/banner/<?php echo @$banner[2]->banner; ?>" class="img" alt=""></a>

               
                </div>
                </div>
              </div> 
              <!-- /.wide-banner --> 
            </div>
            <!-- /.col -->
          
          </div>
          <!-- /.row --> 
        </div>
        <!-- /.wide-banners --> 
        
        <!-- ============================================== WIDE PRODUCTS : END ============================================== --> 

        <!-- ============================================== Refrigerator PRODUCTS ============================================== -->
        <?php foreach ($home_show_category as  $p_cat) { 

          $cat_id=$p_cat->category_id;
          
          $data['product1'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('cat_id'=>$cat_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
          
         ?>

         
            
          
         
       
        <section class="section featured-product wow fadeInUp">
          <h3 class="section-title"><?php echo $p_cat->category_name ?></h3>
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

            <?php  foreach ($data['product1'] as $product_show) { 

              $product_id = $product_show->id;
              $product_image = $this->common_model->common($table_name = 'tbl_product_image', $field = array(), $where = array('product_id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

              ?>

            <div class="item item-carousel">
              <div class="products">
                <div class="product">

              

                  <div class="product-image">
                    <div class="image"> <a href="<?php echo $this->url->link(4); ?>/<?php echo $product_show->id; ?>/<?php echo $product_show->slug; ?>"><img  src="<?php echo base_url();?>assets/upload/product/<?php echo $product_image[0]->image;?>" alt=""></a> </div>
                    <!-- /.image -->          
                  </div>
                  <!-- /.product-image -->
                  
                  <div class="product-info text-left">
                    <h3 class="name"><a href="<?php echo $this->url->link(4); ?>/<?php echo $product_show->id; ?>/<?php echo $product_show->slug; ?>"><?php echo $product_show->product_name  ;?> </a></h3>
                    <div class="rating rateit-small">
                      <?php 
                                        for($i=0; $i<@$product_show->avg_rating; $i++){
                                        ?>
                                                                                            
                                            <span class="fa fa-star"></span>

                                        <?php } ?>                                     
                                                            
                                        <?php 
                                        for($i=0; $i<5-(@$product_show->avg_rating); $i++){
                                        ?>
                                                                                            
                                       
                                        <?php } ?>
                    </div>
                    <div class="description"></div>
                    <div class="product-price"> <span class="price"> Rs. <?php echo $product_show->net_price  ;?>  </span> <span class="price-before-discount">Rs. <?php echo $product_show->price;?></span> </div>
                    <!-- /.product-price -->  
                  </div>
                  <!-- /.product-info -->
                    <div class="cart clearfix animate-effect">
                    <div class="action">
                      <ul class="list-unstyled">
                              <li class="add-cart-button btn-group">
                                 <button data-toggle="tooltip" class="btn btn-primary icon" type="button" onclick="add_to_cart_single(<?php echo $product_show->id?>)"  <?php if(@$product_show->availability=='No'){ echo 'disabled'; } ?>> <i class="fa fa-shopping-cart"></i> </button>
                                <button class="btn btn-primary cart-btn" type="submit" >Add to cart</button>
                              </li>
                              <li class="lnk wishlist"> <a data-toggle="tooltip" class="add-to-cart" href="#" onclick="add_to_wishlist(<?php echo $product_show->id;?>)"> <i class="icon fa fa-heart"></i> </a> </li>
                             
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
            <?php } ?>

          </div>
          <!-- /.home-owl-carousel --> 
        </section>
        <!-- /.section --> 
<?php } ?>



    

            

         
       

       </div>
        
      </div>
      <!-- /.homebanner-holder --> 
      <!-- ============================================== CONTENT : END ============================================== --> 
    </div>
    <!-- /.row --> 
    
  </div>
  <!-- /.container --> 
</div>


<section class="container-fluid">
  
<div class="container pad-bot">
  <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="sec-bx">
          <div class="sec-icon">
            <img src="assets/images/shield.png" alt="">
          </div>
          <h2>100% Secure Payments</h2>
          <p>Moving your card details to a much more </p>
          <p>secured place</p>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="sec-bx">
          <div class="sec-icon">
            <img src="assets/images/payment-method.png" alt="">
          </div>
          <h2>TrustPay</h2>
          <p>100% Payment Protection. Easy</p>
          <p>Return Policy </p>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="sec-bx">
          <div class="sec-icon">
            <img src="assets/images/headphone.png" alt="">
          </div>
          <h2>Help Center</h2>
          <p>Got a question? Look no further.</p>
          <p>submit your query here.</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="sec-bx">
          <div class="sec-icon">
            <img src="assets/images/smartphone.png" alt="">
          </div>
          <h2>Shop on the Go</h2>
          <p>Download the app and get exciting</p>
          <p>app only offers at your fingertips</p>
        </div>
      </div>


    </div>

</div>

</section>


<section class="container">

     <section class="section featured-product wow fadeInUp">
          <h3 class="section-title">Our Brands</h3>
          <div class="brands">
          <div class="owl-carousel home-owl-carousel1 custom-carousel owl-theme outer-top-xs">
            <div class="item item-carousel">
                  <div class="image"> <a href="#"><img  src="<?php echo base_url();?>assets/images/ourbrands/1.png" alt=""></a> </div>
              <!-- /.products --> 
            </div>
            <!-- /.item -->
            
            <div class="item item-carousel">
                  <div class="image"> <a href="#"><img  src="assets/images/ourbrands/2.png" alt=""></a> </div>
              <!-- /.products --> 
            </div>
            <!-- /.item -->
            
          <div class="item item-carousel">
                  <div class="image"> <a href="#"><img  src="assets/images/ourbrands/3.png" alt=""></a> </div>
              <!-- /.products --> 
            </div>
            <!-- /.item -->
            
               <div class="item item-carousel">
                  <div class="image"> <a href="#"><img  src="assets/images/ourbrands/4.png" alt=""></a> </div>
              <!-- /.products --> 
            </div>
            <!-- /.item -->
            
            <div class="item item-carousel">
                  <div class="image"> <a href="#"><img  src="assets/images/ourbrands/5.png" alt=""></a> </div>
              <!-- /.products --> 
            </div>
            <!-- /.item -->
            
          <div class="item item-carousel">
                  <div class="image"> <a href="#"><img  src="assets/images/ourbrands/6.png" alt=""></a> </div>
              <!-- /.products --> 
            </div>
            <!-- /.item -->



               <div class="item item-carousel">
                  <div class="image"> <a href="#"><img  src="assets/images/ourbrands/7.png" alt=""></a> </div>
              <!-- /.products --> 
            </div>
            <!-- /.item -->
            
            <div class="item item-carousel">
                  <div class="image"> <a href="#"><img  src="assets/images/ourbrands/8.png" alt=""></a> </div>
              <!-- /.products --> 
            </div>
            <!-- /.item -->
            
          <div class="item item-carousel">
                  <div class="image"> <a href="#"><img  src="assets/images/ourbrands/9.png" alt=""></a> </div>
              <!-- /.products --> 
            </div>
            <!-- /.item -->


            <div class="item item-carousel">
                        <div class="image"> <a href="#"><img  src="assets/images/ourbrands/10.png" alt=""></a> </div>
            </div>
            <!-- /.item -->

            <div class="item item-carousel">
                        <div class="image"> <a href="#"><img  src="assets/images/ourbrands/11.png" alt=""></a> </div>
            </div>
            <!-- /.item -->

            <div class="item item-carousel">
                        <div class="image"> <a href="#"><img  src="assets/images/ourbrands/12.png" alt=""></a> </div>
            </div>
            <!-- /.item -->

            <div class="item item-carousel">
                        <div class="image"> <a href="#"><img  src="assets/images/ourbrands/13.png" alt=""></a> </div>
            </div>
            <!-- /.item -->

            <div class="item item-carousel">
                        <div class="image"> <a href="#"><img  src="assets/images/ourbrands/14.png" alt=""></a> </div>
            </div>
            <!-- /.item -->

            <div class="item item-carousel">
                        <div class="image"> <a href="#"><img  src="assets/images/ourbrands/15.png" alt=""></a> </div>
            </div>
            <!-- /.item -->

            <div class="item item-carousel">
                        <div class="image"> <a href="#"><img  src="assets/images/ourbrands/16.png" alt=""></a> </div>
            </div>
            <!-- /.item -->


          </div>
        </div>
          <!-- /.home-owl-carousel --> 
        </section>
        <!-- /.section --> 
  





</section>
<!-- /detail.phptop-banner-and-menu --> 
