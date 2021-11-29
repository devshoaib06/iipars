


        <section class="my-account-wrapper">
        	<div class="container">
             <div class="ch-cont">
        		<div class="row clearfix">


        			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
        				<div class="myaccount-sidebar">
        					<div class="profile-content">
        						<div class="profile-image">
                                    <?php 
                      if(@$profile_detail_show[0]->image!='')
                      { ?>
                         <img src="<?php echo base_url();?>assets/upload/user_image/<?php echo @$profile_detail_show[0]->image;?>" class="img-responsive" alt="" />
                      <?php  } else { ?>
                          <img src="<?php echo base_url();?>assets/upload/no-image1.jpg" class="img-responsive" alt="" />
                      <?php } ?>
        							
        						</div>
        						<h4 class="my-name"><?php echo @$profile_detail_show[0]->first_name.' '.@$profile_detail_show[0]->last_name; ?></h4>
        					</div>

                            <h4 class="as"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;ACCOUNT SETTINGS</h4>
        					<ul>

    							<li><a href="<?php echo $this->url->link(5);?>" class="active">Edit Profile</a></li>
    							<li><a href="<?php echo $this->url->link(6);?>">Change Passwrd</a></li>
    							<li><a href="<?php echo $this->url->link(24);?>">My Order</a></li>
    							<li><a href="<?php echo $this->url->link(7);?>">My Wishlist</a></li>
                                <li><a href="<?php echo $this->url->link(25);?>">Manage Addresses</a></li>
                                <li><a href="<?php echo $this->url->link(26);?>">Log Out</a></li>
    						</ul>
        				</div>
        			</div>
        			<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
        				<div class="myaccount-widget">
                            <?php
                            if($this->session->flashdata('msg')!='')
                             {
                                ?>
                                <span style="color:green;"><b><?php echo $this->session->flashdata('msg'); ?></b></span>
                            <?php
                            }?> 
        					<h3 class="title">My Profile</h3>
                            <div class="form-container">
                                <form action="<?php echo base_url(); ?>my_account/profile_edit_action" name="form" method="post" enctype="multipart/form-data">
                                    <div class="form-group clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 nopadd-left">
                                            <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" required="" value="<?php echo @$profile_detail_show[0]->first_name; ?>" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 nopadd-left">
                                            <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required="" value="<?php echo@$profile_detail_show[0]->last_name; ?>" />
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-right">
                                            <input type="email" required=""  name="email" id="email" class="form-control" placeholder="Email" value="<?php echo @$profile_detail_show[0]->login_email; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-left">
                                            <input type="text" required="" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="mobile" id="mobile" class="form-control" placeholder="Phone Number" value="<?php echo @$profile_detail_show[0]->mobile; ?>" maxlength="10" />
                                        </div>
                                        <?php 

                                                if( @$profile_detail_show[0]->city==null)

                                                {
                                       ?>

                                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-right">
                                            <input type="text" name="city" id="city" class="form-control" placeholder="City" value="" />
                                        </div>

                                         <?php }
                                                else
                                                { 

                                              ?>
                                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-right">
                                            <input type="text" name="city" id="city" class="form-control" placeholder="City" value="<?php echo @$profile_detail_show[0]->city; ?>" />
                                        </div>



                                                    <?php } ?>

                                    </div>
                                    <div class="form-group clearfix">
                                       <?php 

                                                if( @$profile_detail_show[0]->state==null)

                                                {
                                       ?>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-left">
                                            <input type="text" name="state" id="state" class="form-control" placeholder="State" value="" />
                                        </div>

                                        <?php }
                                                else
                                                { 

                                              ?>

                                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-left">
                                            <input type="text" name="state" id="state" class="form-control" placeholder="State" value="<?php echo @$profile_detail_show[0]->state; ?>" />
                                        </div>
                                        <?php } ?>
                                         <?php 

                                                if( @$profile_detail_show[0]->pincode==0)

                                                {
                                       ?>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-right">
                                            <input type="text" name="pincode" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="pincode" class="form-control" placeholder="Pincode"  value=""/>
                                        </div>

                                        <?php }
                                                else
                                                { 

                                                    ?>

                                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-right">
                                            <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Pincode" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  value="<?php echo @$profile_detail_show[0]->pincode; ?>"/>
                                        </div>

                                        <?php } ?>
                                    </div>

                                     <div class="form-group clearfix">
                                        <?php 

                                                if( @$profile_detail_show[0]->address==null)

                                                {
                                       ?>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadd">
                                            <textarea class="form-control" rows="4" placeholder="Address" name="address"></textarea>
                                        </div>
                                        <?php }
                                                else
                                                { 

                                              ?>
                                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadd">
                                            <textarea class="form-control" rows="4" placeholder="Address" name="address"><?php echo @$profile_detail_show[0]->address; ?></textarea>
                                            <?php } ?>
                                        </div>
                                    </div> 
                                    <div class="form-group clearfix">
                                        <div class="profile-image">
                                         
                                            
                                           
                                            <img id="prof_pic" src="<?php echo base_url(); ?>assets/images/profile-oimage.jpg" class="img-responsive" alt="" height="50px"/> 
                                           <img id="prof_pic" class="img-responsive" alt="" height="50px"/>
                                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadd">
                                            <input type="file"  name="img_upload" id="img_upload" onchange="readURL(this);">
                                           </div>
                                           </div>
                                          
                                       </div>
                                <button class="btb pull-right btn-main btn-lg">Update</button>
                                <input type="hidden" value="<?php echo @$profile_detail_show[0]->user_id;?>" name="user_id">
                                    <input type="hidden" value="<?php echo @$profile_detail_show[0]->image;?>" name="hidden_image">
                                </form>
                            </div>
        				</div>
        			</div>




                    </div>
        		</div>
        	</div>
        </section><!--//my-account-wrapper-->

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