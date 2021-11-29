 


        <section class="my-account-wrapper">
            <div class="container">

             <div class="ch-cont">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <div class="myaccount-sidebar">
                            <div class="profile-content">
                                <div class="profile-image">
                                    <?php 
                                    if(@$password[0]->image!='')
                                    { ?>
                                        <img src="<?php echo base_url();?>assets/upload/user_image/<?php echo @$password[0]->image;?>" class="img-responsive" alt="" />
                                   <?php  } else { ?>
                                        <img src="<?php echo base_url();?>assets/upload/no-image1.jpg" class="img-responsive" alt="" />
                                   <?php } ?>
                                </div>
                                <h4 class="my-name"><?php echo @$password[0]->first_name.' '.@$password[0]->last_name; ?></h4>
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
                            if($this->session->flashdata('error_msg')!='')
                             {
                                ?>
                                <span style="color:red;"><b><?php echo $this->session->flashdata('error_msg'); ?></b></span>
                            <?php
                            }?> 
                            <?php
                            if($this->session->flashdata('succ_msg')!='')
                             {
                                ?>
                                <span style="color:green;"><b><?php echo $this->session->flashdata('succ_msg'); ?></b></span>
                            <?php
                            }?> 
                            <h3 class="title">Change Password</h3>
                          
                            <div class="form-container">
                                <form action="<?php echo base_url(); ?>my_account/change_password_action" name="form" method="post" onsubmit="return testVal()">
                                    <div class="form-group clearfix">

                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 nopadd-left">
                                            <input type="Password" id="Txt1" onkeyup="field1(this.value)" required="" name="old_pass" class="form-control" placeholder="Old Password" /><span id="old_pass_match" style="color:red"></span>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 nopadd-left">
                                            <input type="Password" id="Txt2" onkeyup="field2()" required="" name="new_pass"  class="form-control" placeholder="New Password" /><span id="new_pass_match" style="color:red"></span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 nopadd-right">
                                            <input type="Password" required="" name="confirm_pass"  id="Txt3" class="form-control" onkeyup="field3()" placeholder="Confirm Password" /><span id="conf_pass_match" style="color:red"></span>
                                        </div>
                                        </div>
                                    <button class="btb pull-right">update</button>
                                     <input type="hidden" value="<?php echo @$password[0]->login_pass;?>" name="hidden_pass">
                                     <input type="hidden" value="<?php echo @$password[0]->user_id;?>" name="user_id">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                </div>
            </div>
        </section><!--//my-account-wrapper-->

     