   


        <section class="my-account-wrapper">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <div class="myaccount-sidebar">
                            <div class="profile-content">
                                <div class="profile-image">
                                    <?php 
                                    if(@$seller_detail[0]->image!='')
                                    { ?>
                                        <img src="<?php echo base_url();?>assets/upload/seller_image/<?php echo @$seller_detail[0]->image;?>" class="img-responsive" alt="" />
                                   <?php  } else { ?>
                                        <img src="<?php echo base_url();?>assets/upload/no-image1.jpg" class="img-responsive" alt="" />
                                   <?php } ?>
                                    
                                </div>
                                <h4 class="my-name"><?php echo @$seller_detail[0]->first_name.' '.@$seller_detail[0]->last_name; ?></h4>
                            </div>


                                <h4 class="sell-p">My Account</h4>
                            <ul>
                                <li class="active"><a href="<?php echo $this->url->link(21); ?>">Business Profile</a></li>
                                <li><a href="<?php echo $this->url->link(22); ?>">Password Manager</a></li>
                                
                                <li><a href="<?php echo $this->url->link(27); ?>">Close my account</a></li>
                                <li><a href="<?php echo $this->url->link(20); ?>">Go to Dashboard</a></li>
                            </ul>


                              <h4 class="sell-p">Product Manager</h4>
                            <ul>
                                <li class="active"><a href="<?php echo $this->url->link(23); ?>">Product List</a></li>
                                <li><a href="<?php echo $this->url->link(26); ?>">Add a Single Product</a></li>
                                <!-- <li><a href="seller-featured-product.php">My featured Products</a></li> -->
                                <!-- <li><a href="#">Close my account</a></li> -->
                            </ul>


                              <h4 class="sell-p">My Orders</h4>
                            <ul>
                                <li class="active"><a href="<?php echo $this->url->link(28);?>">Order List</a></li>
                               
                            </ul>

                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                       <!--  <div class="myaccount-widget">
                            <h3 class="title">Single Product List</h3>
                           </div> -->


                           <div class="form-container" id="bp-cont">
                           <!-- <form method="post" action=""> -->
                           <h4 class="bp-head">Edit Product</h4>
                           <?php
                            if($this->session->flashdata('succ_add')!='')
                             {
                                ?>
                                <span style="color:green;"><b><?php echo $this->session->flashdata('succ_add'); ?></b></span>
                            <?php
                            }?> 
                           

                           <div class="sap-bx">



  

 <!--  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Product</a></li>
     <li><a data-toggle="tab" href="#menu1">Images</a></li>
    <li><a data-toggle="tab" href="#menu2">More Details</a></li> 

  </ul> -->

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
       <div class="col-md-12">
                        


                           <div class="form-container">
                           <form method="post" action="<?php echo base_url(); ?>seller_bussiness_profile/edit_seller_product_action" enctype="multipart/form-data">
                           
                           <div class="form-group" id="bp-ac">

                           <div class="row" id="bp-mar">
                            
                                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-">
                                        <label>Product Category<sup><i class="fa fa-star" id="font-sz"></i></sup></label> 
                                    </div>
                                             <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                                <select class="form-control" name="category" id="category" style="margin-bottom:12px" >
                                                <option value="">Select Product Category</option>
                                                <!-- <?php foreach($category as $cat)
                                                 
                                                 {
                                                     $parent_cat = $cat->parent_category;
                                                 
                                                     $parent = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('category_id'=>$parent_cat), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                                                 
                                                 
                                                 
                                                     //$parent = $this->admin_model->selectone('tbl_category','category_id',$parent_cat);
                                                     $sub_cat = $cat->sub_category;
                                                 
                                                      $sub = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('category_id'=>$sub_cat), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                                                 
                                                 
                                                     //$sub = $this->admin_model->selectone('tbl_category','category_id',$sub_cat);
                                                 
                                                 ?>
                                                     
                                                     <option value="<?php echo $cat->category_id;?>" <?php if(@$product_details[0]->cat_id==$cat->category_id){ echo 'selected';}?>><?php if($parent_cat>0){ echo @$parent[0]->category_name." >> "; } ?><?php if($sub_cat>0){ echo @$sub[0]->category_name." >> "; } ?><?php echo $cat->category_name; ?></option>
                                                 <?php 
                                                 
                                                 } ?> --> 


                                                 <?php $all_parent_category=$this->common_model->all_parent_category(); ?>
                                                <?php foreach($all_parent_category as $parent_category){ ?>
                                                <?php $all_sub_category=$this->common_model->all_sub_category($parent_category->category_id); ?>
                                                <?php foreach($all_sub_category as $sub_category){ ?>
                                                <?php $all_category=$this->common_model->all_category($sub_category->category_id); ?>
                                                <?php foreach($all_category as $category){ ?>
                                                  <option value="<?php echo $category->category_id; ?>"  <?php if(@$product_details[0]->cat_id==$category->category_id){ echo 'selected';}?>>
                                                    <?php echo $parent_category->category_name; ?> >
                                                    <?php echo $sub_category->category_name; ?> >
                                                    <?php echo $category->category_name; ?>
                                                  </option>
                                                <?php } ?>
                                                <?php } ?>
                                                <?php } ?> 
                                                    
                                                </select>
                                                </div>
                                            </div>
                                       


                           <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                        <label>Product Title<sup><i class="fa fa-star" id="font-sz"></i></sup></label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                        <input type="text" placeholder="Product Title" name="product_name" id="product_name" onkeyup="catname(this.value)"  class="bp-bx" value="<?php echo @$product_details[0]->product_name;?>" required="">
                                    </div>
                                    </div>

                                   <!--  <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                        <label>Product Slug<sup><i class="fa fa-star" id="font-sz"></i></sup></label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                        <input type="text" placeholder="Lorem Ipsum" name="product_slug" id="product_slug" class="bp-bx" required="">
                                    </div>
                                    </div> -->


                                   <!--  <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                        <label>Manufacturer<sup><i class="fa fa-star" id="font-sz"></i></sup></label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                        <input type="text" placeholder="Lorem Ipsum" name="" class="bp-bx" required="">
                                    </div>
                                    </div> -->


                                     <div class="row" id="bp-mar">
                            
                                           <div class="col-lg-3 col-md-3 col-sm-4 col-xs-">
                                        <label>Brand<sup><i class="fa fa-star" id="font-sz"></i></sup></label> 
                                          </div>
                                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                                 <select class="form-control" name="brand" id="brand" style="margin-bottom:12px" >
                                                     <option value="">Select A Brand</option>
                                                <?php foreach($brand as $bra){?>     
                                                    <option value="<?php echo $bra->brand_id; ?>" <?php if(@$product_details[0]->brand_id==$bra->brand_id){ echo 'selected'; }?>><?php echo $bra->brand_name; ?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row" id="bp-mar">
                                      <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                        <label>Weight<sup><i class="fa fa-star" id="font-sz"></i></sup></label>  ( in gm)
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                        <input type="text" placeholder="Product Weight" name="weight" id="weight" value="<?php echo @$product_details[0]->weight; ?>"  class="bp-bx" required="">
                                    </div>
                                    </div>

                                        <!-- <div class="row" id="bp-mar">
                            
                                           <div class="col-lg-3 col-md-3 col-sm-4 col-xs-">
                                        <label>Feature<sup><i class="fa fa-star" id="font-sz"></i></sup></label> 
                                          </div>
                                           <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                                 <select class="form-control" name="featured" id="featured" style="margin-bottom:12px" >
                                                    <option value="">Select</option>
                                                    <option value="Yes" <?php if(@$product_details[0]->featured=='Yes'){ echo 'selected'; }?>>Yes</option>
                                                    <option value="No" <?php if(@$product_details[0]->featured=='No'){ echo 'selected'; }?>>No</option>
                                                </select>
                                            </div>
                                        </div> -->

                                      <div class="row" id="bp-mar">
                                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                        <label>Availibility<sup><i class="fa fa-star" id="font-sz"></i></sup></label> 
                                          </div>
                                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                                <select class="form-control" name="availability" id="availability" style="margin-bottom:12px" >
                                                    <option value="Yes" <?php if(@$product_details[0]->availability=='Yes'){ echo 'selected'; }?>>In Stock</option>
                                                    <option value="No" <?php if(@$product_details[0]->availability=='No'){ echo 'selected'; }?>>Out Of Stock</option>
                                                </select>
                                            </div>
                                        </div>

                                           <!--   <div class="row" id="bp-mar">
                                           <div class="col-lg-3 col-md-3 col-sm-4 col-xs-">
                                        <label>Product image<sup><i class="fa fa-star" id="font-sz"></i></sup></label> 
                                          </div>
                                            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                                                <input class="form-control" type="file" name="image[]" id="image" style="margin-bottom:12px" >

                                                    
                                            </div>
                                            <table>
                                                    <tr>
                                                        <td>
                                                            <a href="javacript:void(0)" class="btn btn-primary" id="no2" onclick="produce_file_box('2')"><b>+</b></a></td>
                                                        <td>
                                                                 </td>
                                                    </tr>
                                            </table>
                                           
                                        </div>
                                        
                                            <div id="more_image_2"></div>
                                            <div id="more_image_3"></div>
                                            <div id="more_image_4"></div> -->

                                    <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                        <label>Product SKU<sup><!-- <i class="fa fa-star" id="font-sz"></i> --></sup></label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                        <input type="text" placeholder="Product SKU" name="sku" class="bp-bx" value="<?php echo @$product_details[0]->sku_id;?>" required="">
                                    </div>
                                    </div>

                                     <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                        <label>Product Price<sup><i class="fa fa-star" id="font-sz"></i></sup></label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                        <input type="text" placeholder="Product price" name="price" class="bp-bx" value="<?php echo @$product_details[0]->price;?>" required="">
                                    </div>
                                    </div>

                                    <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                        <label>Product Discount<sup><i class="fa fa-star" id="font-sz"></i></sup></label> 
                                    </div>

                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" placeholder="Product  discount" name="discount" class="bp-bx" value="<?php echo @$product_details[0]->discount;?>" required="">
                                    </div><div> % </div>
                                    </div>


                                    <!-- <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                        <label>Seller SKU<sup><i class="fa fa-star" id="font-sz"></i></sup></label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                        <input type="text" placeholder="Lorem Ipsum" name="" class="bp-bx" required="">
                                    </div>
                                    </div> -->


                                         <div class="row" id="bp-mar">
                                   <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                        <label>Manufacture Date<sup><i class="fa fa-star" id="font-sz"></i></sup></label> 
                                    </div>
                                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                                <input type="text" class="form-control pull-right"  name="manufactured_date" id="manufactured_date" value="<?php echo @$product_details[0]->manufactured_date;?>">
                                                <!-- <i class="fa fa-calendar form-control-feedback" style="margin-right:20px"></i> -->
                                            </div>
                                        </div>
                                        <div class="row" id="bp-mar">
                                   <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                        <label>Expiry Date<sup><i class="fa fa-star" id="font-sz"></i></sup></label> 
                                    </div>
                                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                                <input type="text" class="form-control pull-right" name="expiry_date" id="expiry_date" value="<?php echo @$product_details[0]->expiry_date;?>">
                                                <!-- <i class="fa fa-calendar form-control-feedback" style="margin-right:20px"></i> -->
                                            </div>
                                        </div>


                                    <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                        <label>Product Description <sup><i class="fa fa-star" id="font-sz"></i></sup></label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                        
                                        <textarea  type="text" placeholder="" name="product_description" class="bp-bx" cols="60" rows="5" required=""><?php echo @$product_details[0]->description;?></textarea>
                                    </div>
                                    </div>

                                    <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                        <label>Meta Title<sup></sup></label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                        <input type="text" placeholder="Meta Title" name="meta_title" class="bp-bx" value="<?php echo @$product_details[0]->meta_title;?>" >
                                    </div>
                                    </div>

                                     <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                        <label>Meta Keyword<sup></sup></label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                        <input type="text" placeholder="Meta Keyword" name="meta_key" class="bp-bx" value="<?php echo @$product_details[0]->meta_keyword;?>">
                                    </div>
                                    </div>

                                     <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                        <label>Meta Description <sup></sup></label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                        
                                        <textarea  type="text" placeholder="Meta Description" name="meta_description" class="bp-bx" cols="60" rows="5" ><?php echo @$product_details[0]->meta_description;?></textarea>
                                    </div>
                                    </div>

                                      <div class="row" id="bp-mar">
                                     <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                        <label>Product Status <sup><i class="fa fa-star" id="font-sz"></i></sup></label> 
                                    </div>

                               <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                     <select class="form-control" name="status" id="status" style="margin-bottom:12px" >
                                                    <option value="">Select</option>
                                                    <option value="Active" <?php if(@$product_details[0]->status=='Active'){ echo 'selected'; }?>>Active</option>
                                                    <option value="Inactive" <?php if(@$product_details[0]->status=='Inactive'){ echo 'selected'; }?>>Inactive</option>
                                                </select>
                                </div>
                            </div>


                           </div>


                                   
                                    <div class="save-btn">

                                    <button type="submit" class="btn btn-default">Update</button>

                                    </div>
                                    <a href="<?php echo $this->url->link(23); ?>"  class="btn btn-success">Cancel</a>
                                   
                                      <input type="hidden" value="<?php echo @$product_details[0]->id?>" name="edit_id" >

                                   


  </form>


                           </div>


                           </div>
    </div>
<!--     <div id="menu1" class="tab-pane fade">
      <div class="main-image">
                                                <h4 class="text-center">Main Image</h4>
                                                <div class="col-md-3 mt-20">
                                                    <div class="imageUploadWidget">
                                                        <div class="imageArea">
                                                            <img id="main" src="assets/images/camera_icon.png" alt="your image">
                                                        </div>

                                                        <input type="file" onchange="readURL(this);">
                                                    </div>
                                                </div>
                                                <div class="col-md-9 mt-20">
                                                    <p>
                                                        <a class="tiny" href="#">
                                                                Product images style guideline</a>
                                                    </p>
                                                   <p class="tiny"> Listings that are missing a main image will not appear in search or browse until you fix the listing.
                                                    <br>Choose images that are clear, information-rich, and attractive.
                                                    <br>Images must meet the following requirements:</p>
                                                    <ol>
                                                        <li>Products must fill at least 85% of the image. Images must show only the product that is for sale, with few or no props and with no logos, watermarks, or inset images. Images may only contain text that is a part of the product.</li>
                                                        <li>Main images must have a pure white background, must be a photo (not a drawing), and must not contain excluded accessories.</li>
                                                        <li>Images must be at least 1000 pixels on the longest side and at least 500 pixels on the shortest side to be zoom-able.</li>
                                                        <li>Images must not exceed 10000 pixels on the longest side.</li>
                                                        <li>JPEG is the preferred image format, but you also may use TIFF and GIF files.</li>
                                                    </ol>
                                                </div>
                                            </div>

                                            <div class="save-btn">

                                    <button type="submit" class="btn btn-default">save</button>

                                    </div>
    </div> -->
    <!-- <div id="menu2" class="tab-pane fade">
      <div class="col-md-12">
                        


                           <div class="form-container">
                           <form method="post" action="">
                           
                           <div class="form-group" id="bp-ac">


                            <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Warrenty</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        
                                        <textarea  type="text" placeholder="" name="" class="bp-bx" cols="60" rows="2" required=""></textarea>
                                    </div>
                                    </div>


                                    <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Seller Warranty Description</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" placeholder="" name="" class="bp-bx" required="">
                                    </div>
                                    </div>


                                    <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Legal Disclaimer</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                         <textarea  type="text" placeholder="" name="" class="bp-bx" cols="60" rows="5" required=""></textarea>
                                    </div>
                                    </div>


                                    <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Product Features</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" placeholder="Product Features" name="" class="bp-bx1" required="">

                                        <button class="btn btn-danger btn-sm pull-right" id="sap-but"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                </button>
                                    </div>
                                    </div>


                                    <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Weight</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" placeholder="Weight" name="" class="bp-bx2" required="">

                                        <select name="weight_class_id" id="input-weight-class" class="form-control bp-bx3">
                                                    <option value="1" selected="selected">Kilogram</option>
                                                    <option value="2">Gram</option>
                                                    <option value="5">Pound</option>
                                                    <option value="6">Ounce</option>
                                                </select>
                                    </div>
                                    </div>


                                    <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>SubtractStock</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        
                                       <select name="subtract" id="input-subtract" class="form-control bp-bx4">
                                                    <option value="1" selected="selected">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                    </div>
                                    </div>

                                    



                           </div>


                                   
                                    <div class="save-btn">

                                    <button type="submit" class="btn btn-default">save</button>

                                    </div>
                                   

  </form>


                           </div>


                           </div>
    </div> -->
   
  </div>


                           </div>


                                   <!--  </form> -->
                           </div>


                           </div>
                           
                        
                    </div>
                </div>
            </div>
        </section><!--//my-account-wrapper-->



<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
        <!-- <script>
     function catname(value)
      {
        //alert(value);
          
          $.ajax({

              type: "POST",
              dataType:'json',
              url:"<?php echo base_url();?>seller_bussiness_profile/category_slug_show",
              data: {slug: value},
              async: false,

               success: function(data)
                {

                    var cat_slug_name= data.slug_name;

                      if(cat_slug_name!='')
                        {
                           $('#product_slug').val(cat_slug_name);

                        }
                }
          });
          
     
      }
   </script>
 -->

 <script type="text/javascript">
function produce_file_box(id)
    {
        //alert(id);
         
        var val=id;
            
            if(val==2)
                {
                     $("#no_2").hide();
                      $("#minus").hide();
                }
            var base_url='<?php echo base_url(); ?>';
            if(val==3)
                {
                    $("#no_"+val).hide();
                   
                }
            if(val==4)
                {
                    $("#no_"+val).hide();
                }
           

            $.ajax({
              
             url:base_url+'seller_bussiness_profile/file_box_show',
             data:{num:val},
             dataType: "html",
             type: "POST",
             success: function(data){


              $("#more_image_"+id).html(data);
              $("#more_image_"+id).show();

                 
                
              }
             });

    }
          
    
    function hiding_out(val)
    {
    
          var current_div=val-1;          
          $("#more_image_"+current_div).html('');
          $("#more_image_"+current_div).hide();
      
    }

    </script>