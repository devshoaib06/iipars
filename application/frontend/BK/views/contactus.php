	


        <section class="my-account-wrapper">
        	<div class="container">
             <div class="ch-cont">
        		<div class="row clearfix">

                


        			<div class="col-lg-5 col-md-5 col-sm-4 col-xs-12">
                    <div class="myaccount-widget ">
                            <h3 class="title">Customer Service</h3>

        				<div class="cont-bx">

                            <p><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;<?php echo @$contact[0]->site_email; ?></p>
                            <p><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;<?php echo @$contact[0]->site_phone; ?></p>

                        </div>

                        <div class="map">
                            <?php echo @$contact[0]->map_link; ?>
                <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3682.820211710009!2d88.44512600000002!3d22.623188000000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f89fcd7bee085d%3A0x92985ad044b2aaf!2sExpro+Lab+Technologies+Pvt.+Ltd.!5e0!3m2!1sen!2sin!4v1414658500432" height="200" width="100%" allowfullscreen=""></iframe> -->

                </div>


                        </div>
        			</div>

        			<div class="col-lg-7 col-md-7 col-sm-8 col-xs-12 cont-bx1">
        				
                        <div class="myaccount-widget ">
                            <span>
                            <?php 

                             $succ=$this->session->flashdata('msg');

                             if($succ)
                             {

                             ?>
                            <br><span style="color:red">

                               <?php echo $succ; ?>
                    </span>
                              <?php
                                   }
                               ?>
                            <h3 class="title">Contact Us</h3>
                            <div class="form-container">
                                <form action="<?php echo base_url(); ?>index.php/contact_us/contactus_mail_submit" method="post">
                                    <div class="form-group clearfix">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 nopadd-left">
                                            <input type="text" name="name" class="form-control" placeholder="Name" required="" />
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 nopadd-right">
                                            <input type="email" name="email" class="form-control" placeholder="Email" required="" />
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 nopadd-left">
                                            <input type="text" name="phone" class="form-control" placeholder="Phone Number" required="" />
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadd">
                                            <textarea class="form-control" rows="4" placeholder="Your Message" name="message"></textarea>
                                        </div>
                                    </div>
                                    <button class="btb pull-right btn-main">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>


                    </div>
        		</div>
        	</div>
        </section><!--//my-account-wrapper-->

     