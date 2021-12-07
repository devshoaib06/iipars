<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row single-product'>
			
			<div class='col-md-9 col-sm-8'>
            <div class="detail-block">
				<div class="row  wow fadeInUp">
    			 <div class="col-xs-12 col-sm-12 col-md-5 gallery-holder">
    			 	
  				 <div class="product-item-holder size-big single-product-gallery small-gallery">
  				 	
      			 <div class="ubislider-image-container" data-ubislider="#slider" id="imageSlider"></div>
      			 
                 <div class="ubislider" id="slider">
  					<?php 
                      $i=0;
                        foreach($product_details_image as $row)
                          {
                            $i++;

                          ?>
                   <ul class="ubislider-inner" onclick="add_to_wishlist(<?php echo $row->product_id;?>)">
                      <li>
        				<img src="<?php echo base_url(); ?>assets/upload/product/large/<?php echo $row->image;?>" class="img">

        			  </li>
        			
    				</ul>
    				<?php }?>
				</div>
				
    		</div>

		</div>




					<div class='col-sm-12 col-md-7 product-info-block'>
						<div class="product-info">
							<h1 class="name"><?php echo @$product_details[0]->product_name; ?></h1>
							
							<div class="rating-reviews m-t-20">
								
							</div><!-- /.rating-reviews -->

							<div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-6 col-md-4">
										<div class="stock-box">
											<span class="label">Availability :</span>
										</div>	
									</div>
									<div class="col-sm-6 col-md-8">
										<div class="stock-box">
											 <span class="value"><?php  if(@$product_details[0]->availability=='Yes') { echo 'In Stock'; } else { echo 'Out Of Stock'; }?></span>
										</div>	
									</div>
								</div><!-- /.row -->	

								
							</div><!-- /.stock-container -->

							<div class="price-container info-container m-t-20">
								<div class="row">
									

									<div class="col-sm-6">
										<div class="price-box">
											<span class="price">$<?php echo @$product_details[0]->net_price; ?></span>
											<span class="price-strike">$<?php echo @$product_details[0]->price; ?></span>
										</div>
									</div>

									<div class="col-sm-6">
                                           
                                            


                                            
                                        
									</div>

								</div><!-- /.row -->
							</div><!-- /.price-container -->

						<!-- 	<div class="row cl-si">
								<div class="col-md-6 col-xs-8 col-sm-6">
								 <div id="color_wanted" class="product_attribute" name="color_wanted">
                                                        <label class="attribute_label">Color</label>
                                
                                	
                                
                                                        <select class="form-control styled form-select hasCustomSelect cform-input fm-bx" id="edit-field-country-und">
                                                    <?php foreach ($color as $row) { ?>

                                                        	<option value="<?php echo $row; ?>"><?php echo $row; ?></option>
                                                        	
                                                    <?php } ?>
                                                        </select>
                                            
                                                    </div>

								</div>



								<div class="col-md-6 col-xs-4 col-sm-6">
								<h4>Size</h4>

								<select class="form-control styled form-select hasCustomSelect cform-input fm-bx" id="edit-field-country-und">
									<?php foreach ($pro_size as $row) { ?>
									<option value="<?php echo $row->product_size; ?>"><?php echo $row->product_size; ?></option>
									
									<?php } ?>
								</select>

								</div>

							</div> -->

							<div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-4 col-xs-4">
										<div class="stock-box">
											<span class="label">SKU :</span>
										</div>	
									</div>
									<div class="col-sm-8 col-xs-8">
										<div class="stock-box">
											<span class="value"><?php echo @$product_details[0]->sku_id;?></span>
										</div>	
									</div>

									 <div class="col-sm-4 col-xs-4">
										<div class="stock-box">
											<span class="label">Weight :</span>
										</div>	
									</div>
									<div class="col-sm-8 col-xs-8">
										<div class="stock-box">
											<span class="value"><?php echo @$product_details[0]->product_shipping_weight;?> <?php echo @$pro_color[0]->weight_class; ?></span>
										</div>	
									</div> 
									<div class="col-sm-4 col-xs-4">
										<div class="stock-box">
											<span class="label">Type :</span>
										</div>	
									</div>
									<div class="col-sm-8 col-xs-8">
										<div class="stock-box">
											<span class="value"><?php echo @$product_details[0]->product_type;?></span>
										</div>	
									</div> 


									<!-- <div class="col-sm-4 col-xs-4">
										<div class="stock-box">
											<span class="label">Handling fee :</span>
										</div>	
									</div>
									<div class="col-sm-8 col-xs-8">
										<div class="stock-box">
											<span class="value">$50</span>
										</div>	
									</div> -->

									
									




								</div><!-- /.row -->	
							</div><!-- /.stock-container -->

							

							

							<div class="quantity-container info-container">
								<div class="row">
									
									<div class="col-sm-3 col-xs-6">
										<span class="label">Qty :</span>
									</div>
									
									<div class="col-sm-9 col-xs-6">
										<div class="cart-quantity">
											<div class="quant-input">
								               
								                 <input type="number" value="1" min="1" id="quantity" >

							              </div>
							            </div>
									</div>

									<div class="col-sm-12 res-btn">
										
											<p>Minimum quantity order amount <strong>10pcs</strong></p>
										
										
									</div>

									<div class="col-sm-12 col-md-7 res-btn">
									<a href="#" class="btn btn-primary" id="butt-add1" onclick="buy_single(<?php echo @$product_details[0]->id;?>)" <?php if(@$product_details[0]->availability=='No'){ echo 'disabled'; } ?>>BUY NOW</a>

                                            <a href="#" class="btn btn-primary" id="butt-add" onclick="add_to_cart(<?php echo @$product_details[0]->id;?>)" <?php if(@$product_details[0]->availability=='No'){ echo 'disabled'; } ?>><i class="fa fa-shopping-cart inner-right-vs" ></i> ADD TO CART</a>

									</div>

									
									
									
									




								
									
								</div><!-- /.row -->
							</div><!-- /.quantity-container -->

							

							

							
						</div><!-- /.product-info -->
					</div><!-- /.col-sm-7 -->
				</div><!-- /.row -->
                </div>
				
				

				<div class="product-tabs inner-bottom-xs  wow fadeInUp">
                    <div class="row">
                        <div class="col-sm-3">
                            <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                
                                <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a>
                                </li>
                                <li><a data-toggle="tab" href="#tags">specification</a>
                                </li>
                                <li><a data-toggle="tab" href="#view">REVIEW</a>
                                </li>

                            </ul>
                            <!-- /.nav-tabs #product-tabs -->
                        </div>
                        <div class="col-sm-9">

                            <div class="tab-content">

                              <div id="description" class="tab-pane in active">
                                    <div class="product-tab">
                                     <?php echo @$product_details[0]->description; ?>
                                       
                                    </div>
                                </div>

                                   <div id="tags" class="tab-pane">
                                    <div class="product-tag">

                                        <h4 class="title">Specification</h4>

                                        <div class="sp-bx">
                                           <!--  <h4>Box Contents</h4> -->
                                            <p>Manufactured Date:</p>
                                             <h5>
                                             <?php echo date('d',strtotime(@$product_details[0]->manufactured_date)); ?>
                                                 <?php echo date('M',strtotime(@$product_details[0]->manufactured_date)); ?>  
                                                 <?php echo date('Y',strtotime(@$product_details[0]->manufactured_date)); ?></h5><br>
                                              <p>Expiry Date:</p>
                                             <h5>
                                             <?php echo date('d',strtotime(@$product_details[0]->expiry_date)); ?>
                                                 <?php echo date('M',strtotime(@$product_details[0]->expiry_date)); ?>  
                                                 <?php echo date('Y',strtotime(@$product_details[0]->expiry_date)); ?></h5>
                                        </div>

                                        <!-- <div class="sp-bx">
                                            <h4>Warranty</h4>
                                            <p>Warranty Period</p>
                                            <h5>12 Months Brand Warranty</h5>
                                            <p>Not Covered in Warranty</p>
                                            <h5>Physical Damage</h5>
                                        </div> -->

                                        <div class="sp-bx">
                                            <h4>General</h4>
                                            <p>Brand</p>
                                            <?php 
                                                    $data= $this->common_model->common($table_name = 'tbl_brand', $field = array(), $where = array('brand_id'=>@$product_details[0]->brand_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

                                             ?>
                                            <h5><?php echo $data[0]->brand_name; ?></h5>
                                             <p>Category</p>
                                             <?php 
                                                    $data= $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('category_id'=>@$product_details[0]->cat_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

                                             ?>
                                            <h5><?php echo $data[0]->category_name; ?></h5>
                                            <p>SKU</p>
                                            <h5><?php echo @$product_details[0]->sku_id;  ?></h5>
                                        
                                            <p>Weight</p>
                                            <h5><?php echo @$product_details[0]->product_shipping_weight;  ?> <?php echo @$pro_color[0]->weight_class; ?> </h5>
                                           
                                        </div>


                                    </div>
                                    <!-- /.product-tab -->
                                </div>
                                <!-- /.tab-pane -->




                                               <div id="view" class="tab-pane">
                                    <div class="product-tab">

                                        <div class="product-reviews">
                                            <h4 class="title">Customer Reviews</h4>
                                    <?php 
                                    $review = $this->common_model->common($table_name = 'tbl_review', $field = array(), $where = array('product_id'=>$this->uri->segment(2)), $where_or = array(), $like = array(), $like_or = array(), $order = array('id'=>'DESC'), $start = '', $end = '');
                                    if(count(@$review[1])!=''){
                                    ?>
                                    
                                            <div class="reviews">
                                                <div class="review">
                                                    <div class="review-title"><span class="summary"><?php echo @$review[1]->user_name;?></span><span class="date"><i class="fa fa-calendar"></i><span><?php echo date('j F, Y', strtotime(@$review[0]->created_date));?></span></span>
                                                    </div>
                                                    <?php if(@$review[1]->user_message!=''){?>
                                                    <div class="text">"<?php echo @$review[1]->user_message;?>"</div>
                                                    <?php } else { ?>
                                                    <div class="text">"No Message"</div>
                                                    <?php } ?>
                                                    <div>
                                                        <ul class="singel_review">
                                                        
                                                        <li>
                                                          
                                                        <?php 
                                                            for($i=0; $i<@$review[1]->rating; $i++){
                                                        ?>
                                                                                            
                                                            <span class="fa fa-star"></span>

                                                         <?php } ?>                                     
                                                            
                                                        <?php 
                                                            for($i=0; $i<=4-(@$review[1]->rating); $i++){
                                                        ?>
                                                                                            
                                                            <span class="fa fa-star-o"></span>

                                                         <?php } ?>
                                                                                              
                                                            

                                                    </ul>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- 2nd Msg -->

                                        <?php } ?>
                                        <?php if(count(@$review[0])!=''){ ?>
                                            <div class="reviews">
                                                <div class="review">
                                                    <div class="review-title"><span class="summary"><?php echo @$review[0]->user_name;?></span><span class="date"><i class="fa fa-calendar"></i><span><?php echo date('j F, Y', strtotime(@$review[0]->created_date));?></span></span>
                                                    </div>
                                                    <?php if(@$review[0]->user_message!=''){?>
                                                    <div class="text">"<?php echo substr(@$review[0]->user_message, 0,100);?>..."</div>
                                                    <?php } else { ?>
                                                    <div class="text">"No Message"</div>
                                                    <?php } ?>
                                                    <div>
                                                        <ul class="singel_review">
                                                        
                                                        <li>
                                                          
                                                        <?php 
                                                            for($i=0; $i<@$review[0]->rating; $i++){
                                                        ?>
                                                                                            
                                                            <span class="fa fa-star"></span>

                                                         <?php } ?>                                     
                                                            
                                                        <?php 
                                                            for($i=0; $i<=4-(@$review[0]->rating); $i++){
                                                        ?>
                                                                                            
                                                            <span class="fa fa-star-o"></span>

                                                         <?php } ?>
                                                                                              
                                                            

                                                    </ul>
                                                    </div>
                                                </div>

                                            </div>
                                    <?php } ?>
                                            
                                        </div>



                                        <div class="product-add-review">
                                            <h4 class="title">Write your own review</h4>


                                            <div class="review-form">
                                                <div class="form-container">
                                                    <form role="form" class="cnt-form" method="post" action="<?php echo base_url();?>review/submit">

                                                            <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                   <!--  <label for="exampleInputName">Your Name <span class="astk">*</span>
                                                                    </label>
                                                                    
                                                                    <input type="text" class="form-control txt" id="name" placeholder="" name="name" required=""> -->
                                                                   
                                                                </div>
                                                                <div class="form-group">
                                                                    <!-- <label for="exampleInputSummary">Email <span class="astk">*</span>
                                                                    </label>
                                                                    
                                                                    <input type="email" class="form-control txt" id="email" name="email" placeholder="" required=""> -->
                                                                    
                                                                    <input type="hidden" name="rating_star" id="rating_star">
                                                                    <input type="hidden" name="product_id" id="product_id" value="<?php echo $this->uri->segment(2);?>" >
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="exampleInputReview">Review <span class="astk">*</span>
                                                                    </label>
                                                                    <textarea class="form-control txt txt-review" id="review_msg" name="review_msg" rows="5" placeholder=""></textarea>
                                                                   <!--  <input type="hidden" name="rating_star" id="rating_star"> -->
                                                                </div>
                                                                <!-- /.form-group -->
                                                            </div>
                                                        </div>
                                                        <!-- /.row -->
                                                         <?php if($this->session->userdata('user_session_id')==''){?>   
                                                        <div class="action text-right">
                                                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal" >Submit Review</a>
                                                        </div>
                                                        <?php } else { ?>

                                                        <div class="action text-right">
                                                            <button class="btn btn-primary btn-upper" type="submit">SUBMIT REVIEW</button>
                                                        </div>
                                                        <?php } ?>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.product-tabs -->

				<!-- ============================================== UPSELL PRODUCTS ============================================== -->
<section class="section featured-product wow fadeInUp">
	<h3 class="section-title">Related products</h3>
	 <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
	    <?php 
            if(count($related_product)>0){

               foreach($related_product as $rel_pro)
                 {

                    $product_id=$rel_pro->id;

                    $rel_pro_image= $this->common_model->common($table_name = 'tbl_product_image', $field = array(), $where = array('product_id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = ''); 

                                        

            ?>
	
	
		<div class="item item-carousel">
			<div class="products">
			<div class="product">		
			<div class="product-image">
			<div class="image">
				<a href="<?php echo $this->url->link(4); ?>/<?php echo $rel_pro->id; ?>/<?php echo $rel_pro->slug; ?>"> <img src="<?php echo base_url(); ?>assets/upload/product/<?php echo @$rel_pro_image[0]->image; ?>" alt=""></a>
			</div><!-- /.image -->			
			<div class="tag sale"><span><?php echo round($rel_pro->discount); ?>%<br>off</span></div>            		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="<?php echo $this->url->link(4); ?>/<?php echo $rel_pro->id; ?>/<?php echo $rel_pro->slug; ?>"><?php echo $rel_pro->product_name; ?></a></h3>
			<div class="rating rateit-small">                                            
				<?php 
 					for($i=0; $i<@$rel_pro->avg_rating; $i++)
 					 {
                       ?>
                                                                                                
                      <span class="fa fa-star"></span>

                       <?php } ?>                                     
                                                                
                         <?php 
                              for($i=0; $i<5-(@$rel_pro->avg_rating); $i++){
                                ?>
                                                                                                
                               <!--  <span class="fa fa-star-o"></span>
 -->
                         <?php } ?>
</div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price"><i class="fa fa-inr"></i>  <?php echo $rel_pro->net_price; ?>
                </span>
				<span class="price-before-discount"><i class="fa fa-inr"></i>  <?php echo $rel_pro->price; ?></span>  

		  </div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
			<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						<li class="add-cart-button btn-group">
							<button class="btn btn-primary icon" data-toggle="dropdown" type="button" onclick="add_to_cart_single(<?php echo $rel_pro->id?>)" <?php if(@$rel_pro->availability=='No'){ echo 'disabled'; } ?>>
                                                <i class="fa fa-shopping-cart" ></i>	
                                            </button>
                                            <button class="btn btn-primary cart-btn" type="button" >Add to cart</button>

													
						</li>
	                   
		                <li class="lnk wishlist">
							<a class="add-to-cart" title="Wishlist" onclick="add_to_wishlist(<?php echo $rel_pro->id;?>)"><i class="icon fa fa-heart" ></i>
                           </a>
						</li>

					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div><!-- /.item -->
		  <?php } } else { ?>

                                <div class="item">

                                <?php echo 'No Related Products Available'; ?>

                                </div> 
                                <?php } ?>
                        

			</div><!-- /.home-owl-carousel -->
</section><!-- /.section -->
<!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
			
			</div><!-- /.col -->
			<div class='col-md-3 col-sm-4 sidebar'>
				<div class="sidebar-module-container">
				<div class="home-banner outer-top-n">
 				 <div class="home-banner"> <img src="<?php echo base_url();?>assets/upload/banner/<?php echo @$banner[0]->banner; ?>" alt="Image" class="img"> </div>
</div>		
  
    
    
    	<!-- ============================================== HOT DEALS ============================================== -->
<div class="sidebar-widget hot-deals wow fadeInUp outer-top-vs">
	<h3 class="section-title">Recent Added</h3>
	<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">
		
				<?php if(count($trending_product)>0)
                     {
                         foreach($trending_product as $tren_product){


                          $product_id = $tren_product->id;
                          $product_image = $this->common_model->common($table_name = 'tbl_product_image', $field = array(), $where = array('product_id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                     ?>	        
					<div class="item">
					<div class="products">
						<div class="hot-deal-wrapper">
							<div class="image">
								<a href="<?php echo $this->url->link(4); ?>/<?php echo $tren_product->id; ?>/<?php echo $tren_product->slug; ?>"><img  src="<?php echo base_url();?>assets/upload/product/<?php echo $product_image[0]->image;?>" alt=""></a>
							</div>
							<div class="sale-offer-tag"><span><?php echo round($tren_product->discount); ?>%<br>off</span></div>
							
						</div><!-- /.hot-deal-wrapper -->

						<div class="product-info text-left m-t-20">
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

							<div class="product-price">	
								<span class="price"> $<?php echo $tren_product->net_price;?> </span> <span class="price-before-discount">$ <?php echo $tren_product->price;?></span>				
							
							</div><!-- /.product-price -->
							
						</div><!-- /.product-info -->

						<div class="cart clearfix animate-effect">
							<div class="action">
								
								<div class="add-cart-button btn-group">
									<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                                    <i class="fa fa-shopping-cart"  onclick="add_to_cart_single(<?php echo $tren_product->id?>)"  <?php if(@$tren_product->availability=='No'){ echo 'disabled'; } ?>></i> 
                                                </button>
                                                <button class="btn btn-primary cart-btn" type="button" onclick="add_to_cart_single(<?php echo $tren_product->id?>)"  <?php if(@$rel_pro->availability=='No'){ echo 'disabled'; } ?>>Add to cart</button>
															
								</div>
								
							</div><!-- /.action -->
						</div><!-- /.cart -->
					</div>	
					</div>		        
					<?php }}?>								
				</div>		
	    
    </div><!-- /.sidebar-widget -->
</div>
<!-- ============================================== HOT DEALS: END ============================================== -->					





 

				</div>
			</div><!-- /.sidebar -->
		</div><!-- /.row -->
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->




</div>

</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
   
   function login_submit()

   {
            var username=$('#login_username').val();
            var password=$('#login_password').val();

            //alert(username);
           
          $.ajax({
            type:'POST',
            dataType:'json',
            url:"<?php echo base_url(); ?>review/login_action_for_review",
            data:{login_id:username,login_pass:password},
            success:function(data)
             {
                    console.log(data.review);
                    var perform= data.review;       
                    
                    if(perform==1)
                    {
                        location.reload(data);
                    }
                    if(perform==2)
                    {
                        //location.reload(data);
                        //$('#myModal').modal('show');
                        alert('Incorrect Username Or Password !!');
                    }

             }
        }); 

   } 

</script>


<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript">
        function email_get(value)
        {
            //alert(value);
            $("#login_username").val(value);
        }

        function password_get(value)
        {
            //alert(value);
            $("#login_password").val(value);
        }

    </script>
    <!-- <script>
      $(function () {
    
        $('#form_submit').on('submit', function (e) {
            //alert();
          e.preventDefault();
          var email = $('#email').val();
          var password = $('#pwd').val();
          var tutor_id = $('#tutor_id').val();
          //alert(email);
          $.ajax(
            {
            type: "POST",
            dataType:'html',
            url:"<?php echo base_url(); ?>contact_tutor",
            data: {email: email,password: password,tutor_id:tutor_id},
            async: false,
            success: function(data)
            {
                
                //alert(data);
                $('#myModal').modal('hide');
                //$('#myModal').modal('show');
                $('#ajax_modal').html(data);
                $('#myModal').modal('show');
                   
            }
        });
    
        });
    
      });
    </script> -->






















