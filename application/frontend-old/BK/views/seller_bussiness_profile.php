 


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
                               <!--  <li><a href="seller-review.php">Reviews</a></li> -->
                                <li><a href="<?php echo $this->url->link(30); ?>">Close my account</a></li>
                                <li><a href="<?php echo $this->url->link(20); ?>">Go to Dashboard</a></li>
                            </ul>


                              <h4 class="sell-p">Product Manager</h4>
                            <ul>
                                <li class="active"><a href="<?php echo $this->url->link(23); ?>">Product List</a></li>
                                <li><a href="<?php echo $this->url->link(29); ?>">Add a Single Product</a></li>
                                <!-- <li><a href="seller-featured-product.php">My featured Products</a></li> -->
                                <!-- <li><a href="#">Close my account</a></li> -->
                            </ul>


                              <h4 class="sell-p">My Orders</h4>
                            <ul>
                                <li class="active"><a href="<?php echo $this->url->link(31);?>">Order List</a></li>
                               
                            </ul>

                        
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8s col-xs-12">
                        <div class="myaccount-widget">
                            <h3 class="title">Business Profile</h3>
                           </div>


                           <div class="form-container" id="bp-cont">
                        <form method="post" action="<?php echo base_url(); ?>seller_bussiness_profile/seller_bussiness_profile_action" enctype="multipart/form-data">
                           
                           <?php
                            if($this->session->flashdata('msg')!='')
                             {
                                ?>
                                <span style="color:green;"><b><?php echo $this->session->flashdata('msg'); ?></b></span>
                            <?php
                            }?> 
                             <?php
                            if($this->session->flashdata('updtmsg')!='')
                             {
                                ?>
                                <span style="color:green;"><b><?php echo $this->session->flashdata('updtmsg'); ?></b></span>
                            <?php
                            }?> 
                           <h4 class="bp-head">Company Information (Billing)</h4>
                           <div class="form-group" id="bp-ac">

                          
                           <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Business Name</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" placeholder="" value="<?php echo @$seller_company_detail[0]->company_name; ?>" name="company_name" class="bp-bx" required="">
                                    </div>
                                    </div>  

                                    
                                    <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Phone</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" placeholder="" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo @$seller_company_detail[0]->company_phone; ?>" name="company_phone" class="bp-bx" required="" maxlength="10">
                                    </div>
                                    </div>
                                    

                                    <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Email</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="email" placeholder="" value="<?php echo @$seller_company_detail[0]->company_email; ?>" name="company_email" class="bp-bx" required="">
                                    </div>
                                    </div>
                                    



                                   
                                    <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>GSTIN</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" placeholder="" value="<?php echo @$seller_company_detail[0]->company_gstin; ?>" name="company_gst" class="bp-bx">
                                    </div>
                                    </div>
                                    


                                    <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Address</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" placeholder="" value="<?php echo @$seller_company_detail[0]->company_address; ?>" name="company_address" class="bp-bx" required="">
                                    </div>
                                    </div>
                                     


                                   


                                   

                                    <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>City</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" placeholder="" value="<?php echo @$seller_company_detail[0]->company_city; ?>" name="company_city" class="bp-bx" required="">
                                    </div>
                                    </div>
                                     



                                             
                                    <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Pin Code</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" placeholder="" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo @$seller_company_detail[0]->company_pincode; ?>" name="company_pincode" class="bp-bx" required="">
                                    </div>
                                    </div>

                                    


                                            
                                     <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>State</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" placeholder="" value="<?php echo @$seller_company_detail[0]->company_state; ?>" name="company_state" class="bp-bx" required="">
                                    </div>
                                    </div>

                                   





                           </div>


                            <h4 class="bp-head">Contact Information</h4>
                           <div class="form-group" id="bp-ac">


                           <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>First Name</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" placeholder="" name="fname" value="<?php echo @$seller_detail[0]->first_name; ?>"  class="bp-bx" required="">
                                    </div>
                                    </div>


                                    <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Last Name</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" placeholder="" name="lname" value="<?php echo @$seller_detail[0]->last_name; ?>"  class="bp-bx" required="">
                                    </div>
                                    </div>

                                     


                                    <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Email</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="email" placeholder="" name="email" value="<?php echo @$seller_detail[0]->login_email; ?>" class="bp-bx" required="">
                                    </div>
                                    </div>


                                   


                                    <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Mobile no</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" placeholder="" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="mobile" value="<?php echo @$seller_detail[0]->mobile; ?>" class="bp-bx" required="" maxlength="10">
                                    </div>
                                    </div>
                                    <div class="row" id="bp-mar">
                                     <div class="profile-image">
                                          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            
                                           
                                           <img id="prof_pic" src="<?php echo base_url(); ?>assets/images/profile-oimage.jpg" class="img-responsive" alt="" />
                                           <div class="form-group clearfix"></div>
                                            <input type="file"  name="img_upload" id="img_upload" onchange="readURL(this);">
                                            </div>
                                           </div>
                                           </div>
                                          
                                       </div>

                                    <!-- <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Fax</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" placeholder="" name="" class="bp-bx" required="">
                                    </div>
                                    </div> -->


                                   
                                    <div class="save-btn">

                                    <button type="submit" class="btn btn-default">save</button>

                                    </div>
                                     <!--  <a href="<?php echo $this->url->link(20); ?>">Go to Dashboard</a> -->
                                   
                                     <input type="hidden" name="company_id" value="<?php echo @$seller_company_detail[0]->company_id; ?>" >
                                     <input type="hidden" value="<?php echo @$seller_detail[0]->image;?>" name="hidden_image">


  </form>


                           </div>


                           </div>
         
                    </div>
                </div>
            </div>
        </section><!--//my-account-wrapper-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpkYuEhCS81-3NuqXq7DW6Y2WM2XanIB4&libraries=places&callback=initAutocomplete"></script>

     <script>


    function readURL(input)
    {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#prof_pic')
                    .attr('src', e.target.result)
                    .width(90)
                    .height(90);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

     </script>  