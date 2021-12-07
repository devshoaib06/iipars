    


        <section class="my-account-wrapper">
            <div class="container">
             <div class="ch-cont">
                <div class="row clearfix">


                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <div class="myaccount-sidebar">
                            <div class="profile-content">
                                <div class="profile-image">
                                    <?php 
                      if(@$address[0]->image!='')
                      { ?>
                         <img src="<?php echo base_url();?>assets/upload/user_image/<?php echo @$address[0]->image;?>" class="img-responsive" alt="" />
                      <?php  } else { ?>
                          <img src="<?php echo base_url();?>assets/upload/no-image1.jpg" class="img-responsive" alt="" />
                      <?php } ?>
                                </div>
                                <h4 class="my-name"><?php echo @$address[0]->first_name.' '.@$address[0]->last_name; ?></h4>
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
                            <h3 class="title">Manage Addresses</h3>
                            <div class="form-container">
                                <?php
                            if($this->session->flashdata('succ_msg')!='')
                             {
                                ?>
                                <span style="color:green;"><b><?php echo $this->session->flashdata('succ_msg'); ?></b></span>
                            <?php
                            }  ?>
                                <form action="<?php echo base_url(); ?>my_account/get_manage_address" name="form" method="post">
                                    <div class="form-group clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-left">
                                            <input type="text" name="full_name" class="form-control" placeholder="Name" />
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-left">
                                            <input type="text" name="phone" class="form-control" placeholder="Phone Number" />
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-left">
                                            <input type="text" name="pin_code" class="form-control" placeholder="Pincode" />
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-right">
                                            <input type="text" name="location" class="form-control" placeholder="location" />
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadd">
                                            <textarea class="form-control" rows="4" placeholder="Address" name="address"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-left">
                                            <input type="text" name="city" class="form-control" placeholder="City/District/Town" />
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-right">
                                            <input type="text" name="state" class="form-control" placeholder="State" />
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-left">
                                            <input type="text" name="landmark" class="form-control" placeholder="Landmark (Optional)" />
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nopadd-right">
                                            <input type="text" name="alt_phone" class="form-control" placeholder="Alternate Phone (Optional)" />
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                    <div class="adm">
                                    <p>Address Type</p>

                                    <input type="radio" name="radio" value="home"><h4 class="cal">Home</h4>
                                    <input type="radio" name="radio" value="work"><h4 class="cal">Work</h4>
                                    </div>
                                    </div>
                                    
                                    <button class="btb pull-right btn-main">Save</button>
                                </form>
                            </div>

                            <?php foreach ($default_address as  $row) { ?>

                            <div class="col-md-12" id="dis">
                            <div class="add-ad">
                                <div class="row">
                                <div class="col-md-9">

                                 <?php if($row->is_default=='y'){   ?>   

                                <ul>                                                            
                                     <li><a class="btn-main">DEFAULT</a></li>

                                </ul>
                                <?php } ?>
                                <h4><?php echo @$row->full_name; ?></h4>
                                <h5>Mob: <?php echo @$row->phone; ?></h5>
                                <p><?php echo @$row->location.'<br> '.@$row->address.' '.@$row->city.'<br> State- '.@$row->state.'<br> Pin-'.@$row->pin_code.'<br> Landmark-'.@$row->landmark ; ?></p>
                                </div>

                                <div class="col-md-3">
                                <div class="edit-btn">

                                
        
                                    <ul>
                                        <li title="Edit"><a href="<?php base_url(); ?>my_account/edit_manage_address/<?php echo $row->id ?>" class="edt-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                        <li title="Delete"><a href="<?php base_url(); ?>my_account/delete_manage_address/<?php echo $row->id ?>" class="del-btn"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
        
                                    </ul>
        
                                </div>

                                </div>

                                </div>
        <?php if($row->is_default=='n'){   ?> 
        <a href="<?php base_url(); ?>my_account/make_default_manage_address/<?php echo $row->id ?>"><button type="button" class="btn btn-info btn-sm">
        <span class="glyphicon glyphicon-check"></span> Make default</button></a>
        <?php } ?>
                            </div>
                            </div>

                            <?php } ?>




                        </div>
                    </div>




                    </div>
                </div>
            </div>
        </section><!--//my-account-wrapper-->

    