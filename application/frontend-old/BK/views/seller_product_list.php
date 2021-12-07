


        <section class="my-account-wrapper">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <div class="myaccount-sidebar">
                            <div class="profile-content">
                                <div class="profile-image">
                                  <?php 
                                    if(@$user[0]->image!='')
                                    { ?>
                                        <img src="<?php echo base_url();?>assets/upload/seller_image/<?php echo @$user[0]->image;?>" class="img-responsive" alt="" />
                                   <?php  } else { ?>
                                        <img src="<?php echo base_url();?>assets/upload/no-image1.jpg" class="img-responsive" alt="" />
                                   <?php } ?>
                                    
                                </div>
                                <h4 class="my-name"><?php echo @$user[0]->first_name.' '.@$user[0]->last_name; ?></h4>
                            </div>


                                <h4 class="sell-p">My Account</h4>
                            <ul>
                                <li class="active"><a href="<?php echo $this->url->link(21); ?>">Business Profile</a></li>
                                <li><a href="<?php echo $this->url->link(22); ?>">Password Manager</a></li>
                                <!-- <li><a href="seller-review.php">Reviews</a></li> -->
                                <li><a href="<?php echo $this->url->link(30); ?>">Close my account</a></li>
                                <li><a href="<?php echo $this->url->link(20); ?>">Go to Dashboard</a></li>
                            </ul>


                              <h4 class="sell-p">Product Manager</h4>
                            <ul>
                                <li class="active"><a href="<?php echo $this->url->link(23); ?>">Product List</a></li>
                                <li><a href="<?php echo $this->url->link(29); ?>">Add a Single Product</a></li>
                               <!--  <li><a href="seller-featured-product.php">My featured Products</a></li> -->
                                <!-- <li><a href="#">Close my account</a></li> -->
                            </ul>


                              <h4 class="sell-p">My Orders</h4>
                            <ul>
                                <li class="active"><a href="<?php echo $this->url->link(31);?>">Order List</a></li>
                               
                            </ul>

                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                        <div class="myaccount-widget">
                            <h3 class="title">Products List</h3>
                           </div>

                          <!--  <div class="spl-bx">
                           <div class="form-container" id="bp-cont">
                            <form method="post" action="">
                           
                           <div class="form-group" id="bp-ac">


                           <div class="row" id="bp-mar">

                           <div class="col-md-3">
                            <div class="col-md-12">
                                        <label>Product Name</label> 
                                    </div>

                                    <div class="col-md-12">
                                        <input type="text" placeholder="" name="" class="bp-bx" required="">
                                    </div>

                                    </div>
                                    
                            <div class="col-md-3">
                            <div class="col-md-12">
                                        <label>SKU</label> 
                                        </div>
                                  

                                    <div class="col-md-12">
                                        <input type="text" placeholder="" name="" class="bp-bx" required="">
                                    </div>
                                    </div>
                                                 
                            <div class="col-md-3">
                            <div class="col-md-12">
                                        <label>Status</label> 
                                        </div>
                                    

                                    <div class="col-md-12">
                                        <select class="bp-bx">
                                            <option value="showboat">Showboat</option>
                                            <option value="redwing">Redwing</option>
                                            <option value="narcho">Narcho</option>
                                            <option value="hardball">Hardball</option>
                                        </select>
                                    </div>
                                    </div>
                                    


                                    <div class="col-md-3">

                                    <div class="save-btn">

                                    <button type="submit" class="btn btn-default" id="spl-mar">Filter</button>

                                    </div>
                                    </div>

                           </div>
   
                            </form> 


                           </div>




                           </div> -->
                           <?php
                            if($this->session->flashdata('succ_add')!='')
                             {
                                ?>
                                <span style="color:green;"><b><?php echo $this->session->flashdata('succ_add'); ?></b></span>
                            <?php
                            }?> 
                         <?php
                            if($this->session->flashdata('succ_delete')!='')
                             {
                                ?>
                                <span style="color:green;"><b><?php echo $this->session->flashdata('succ_delete'); ?></b></span>
                            <?php
                            }?> 

                             <?php
                            if($this->session->flashdata('succ_updt')!='')
                             {
                                ?>
                                <span style="color:green;"><b><?php echo $this->session->flashdata('succ_updt'); ?></b></span>
                            <?php
                            }?> 

                     <div class="save-btn">

                                    <a href="<?php echo $this->url->link(29); ?>" class="btn btn-default">Add</a>

                                    </div>  <!-- <a href="<?php echo $this->url->link(20); ?>">Go to Dashboard</a> -->
                     <div class="clearfix"></div>

<div class="table-responsive">
                            <table id="sp-list">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Product Name</th>
                                        <!-- <th>Featured Product</th>  -->
                                        <th>Product Image</th>
                                        <th>Category Name</th>
                                       <!--  <th>SKU id</th> -->
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Availibility</th>
                                        
                                        <!-- <th>Manufacture Date</th>
                                        <th>Expiry Date</th> -->
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 

                                        foreach($product_list as $products)
                                        {


                                ?>
                                    <tr>
                                        <td><h5><?php echo $products->status; ?></h5></td>
                                        <td>
                                            <h5><?php echo $products->product_name; ?></h5>
                                            
                                            
                                        </td>

                                        <!-- <td id="home_<?php echo $products->id; ?>">
                                            <h5>
                                        <?php
                                            if($products->featured=="Yes")
                                            {
                                        ?>
                                                <a href="#" class="label label-success" title="Change" onclick="change_home(<?php echo $products->id; ?>)" style="align:centre"> <?php echo $products->featured;?></a>
                                        <?php
                                            }
                                            else
                                            {
                                        ?>
                                                <a href="#" class="label label-danger" title="Change" onclick="change_home(<?php echo $products->id; ?>)" style="align:centre"> <?php echo $products->featured;?></a>
                                        <?php
                                        }
                                        ?>
                                        </h5>
                                  </td>  -->

                                        <?php 

                                        $pro_id = $products->id;
                                        //$product_image = $this->admin_model->selectOne('tbl_product_image','product_id',$pro_id);

                                         $product_image = $this->common_model->common($table_name = 'tbl_product_image', $field = array(), $where = array('product_id'=>$pro_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                                        //print_r($product_image);

                                         ?> 


                                        <td>
                                  <?php if($products->user_type_id=='2'){?>
                                    <img src="<?php echo base_url();?>assets/upload/product/<?php echo @$product_image[0]->image;?>" height="100px" width="100px" style="cursor: pointer;" title="See Images" onclick="window.location.href='<?php echo base_url(); ?>seller_bussiness_profile/product_image_view/<?php echo $products->id;?>'">
                                  <?php } else { ?>
                                    <img src="<?php echo base_url()?>assets/upload/no-image.jpg" height="100px" width="100px" title="" >
                                  <?php } ?>

                                  </td>

                                  <?php 
                                    $cat_id = $products->cat_id;

                                    $category = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('category_id'=>$cat_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                                   // $category = $this->admin_model->selectOne('tbl_category','category_id',$cat_id);
                                  ?>


                                  <td><h5><?php echo @$category[0]->category_name;?></h5></td>
                                        <!-- <td>
                                           <span><h5><?php echo $products->sku_id; ?></h5></span>
                                        </td> -->
                                        <td><h5><?php echo $products->price; ?></h5></td>
                                        <td><h5><?php echo $products->discount; ?></h5></td>
                                        <td><h5><?php if($products->availability=='Yes'){ echo 'In Stock'; } else{ echo 'Out of stock'; } ?></h5></td>
                                       
                                        

                                        <!-- <td>
                                                <h5> <?php echo date('d',strtotime($products->manufactured_date)); ?>
                                                 <?php echo date('M',strtotime($products->manufactured_date)); ?>  
                                                 <?php echo date('y',strtotime($products->manufactured_date)); ?>  
                                                 </h5>
                                        </td>

                                        <td>
                                                 <h5>
                                                 <?php echo date('d',strtotime($products->expiry_date)); ?>
                                                 <?php echo date('M',strtotime($products->expiry_date)); ?>  
                                                 <?php echo date('y',strtotime($products->expiry_date)); ?>
                                                  </h5>
                                        </td> -->
                                        
                                        
                                        
                                        <td><a href="<?php echo base_url();?>seller_bussiness_profile/edit_seller_product/<?php echo $products->id;?>" class="seller-view" title="Edit"><i class="fa fa-pencil"></i></a><br><br>
                                        <button type="button" class="btn btn-danger" onclick="return delete_data(<?php echo $products->id;?>)" title="Delete"><i class="fa fa-trash-o"></i></button>
                                        </td>
                                        
                                    </tr>
                                    

                                   
                                     

                                    

                                   
                                   <?php } ?>
                                </tbody>
                            </table>
                        </div>















                        
                    </div>
                </div>
            </div>
        </section><!--//my-account-wrapper-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type="text/javascript">
          function delete_data(id)
          {
            if(confirm('Are you sure to delete this product?'))
            {
                window.location.href="<?php echo base_url();?>seller_bussiness_profile/delete_seller_product/"+id;
            }
          }
        </script>
     <script type="text/javascript">

          function change_home(id)


          {
          if(confirm("Are you sure ?"))
          {
          var base_url='<?php echo  base_url();?>';

          $.ajax({
                        
              url:base_url+'seller_bussiness_profile/change_home_status',
              data:{pid:id},
              dataType: "json",
              type: "POST",
              success: function(data){


                var perform= data.changedone;

                      if(perform['status']==1)
                      {
                        
                       var node='<a href="#" class="label label-success"  title="Change" onclick="change_home('+id+')">Yes</a>';

                        $("#home_"+id).html(node);
                      }
                      else
                      {
                        
                        var node='<a href="#" class="label label-danger" title="Change" onclick="change_home('+id+')">No</a>';

                        $("#home_"+id).html(node);
                      }
                
                  }
              });
//window.location=baseurl+'index.php/manage_category/popularity_change/'+id;


}
}</script>
