  


        <section class="my-account-wrapper">
            <div class="container">
                <div class="row clearfix">
                 <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <div class="myaccount-sidebar">
                            <div class="profile-content">
                                <div class="profile-image">
                                <?php 
                                    if(@$password[0]->image!='')
                                    { ?>
                                        <img src="<?php echo base_url();?>assets/upload/seller_image/<?php echo @$password[0]->image;?>" class="img-responsive" alt="" />
                                   <?php  } else { ?>
                                        <img src="<?php echo base_url();?>assets/upload/no-image1.jpg" class="img-responsive" alt="" />
                                   <?php } ?>
                                    
                                </div>
                                <h4 class="my-name"><?php echo @$password[0]->first_name.' '.@$password[0]->last_name; ?></h4>
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
                                <li><a href="<?php echo $this->url->link(29); ?>">Add Single Product</a></li>
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
                            <h3 class="title">Password Manager</h3>
                           </div>


                           <div class="form-container" id="bp-cont">
                           <form method="post" action="<?php echo base_url(); ?>seller_bussiness_profile/change_password_action" onsubmit="return testVal()">
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
                           <h4 class="bp-head">Change Password</h4>
                           <div class="form-group" id="bp-ac">


                           <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Current Password</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                     <input type="password" placeholder="Old Password" id="Txt1" required="" name="old_pass" onkeyup="field1(this.value)" class="bp-bx"><span id="old_pass_match" style="color:red"></span>

                                    </div>
                                    </div>


                                    <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>New PassWord</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                    <input type="password" placeholder="New Password" id="Txt2" required="" name="new_pass" onkeyup="field2()" class="bp-bx"><span id="new_pass_match" style="color:red"></span>
                                    </div>
                                    </div>


                                    <div class="row" id="bp-mar">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Confirm Password</label> 
                                    </div>

                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                     <input type="password" placeholder="Confirm Password" id="Txt3" required="" name="confirm_pass" onkeyup="field3()" class="bp-bx"><span id="conf_pass_match" style="color:red"></span>
                                    </div>
                                    </div>

                           </div>
                    <div class="save-btn">

                                    <button type="submit" class="btn btn-default">save</button>

                                    </div>
                                      <!-- <a href="<?php echo $this->url->link(20); ?>">Go to Dashboard</a> -->
                         <input type="hidden" value="<?php echo @$password[0]->login_pass;?>" name="hidden_pass">
                                     <input type="hidden" value="<?php echo @$password[0]->user_id;?>" name="user_id">
                                    </form>
                           </div>


                           </div>
         
                    </div>
                </div>
            </div>
        </section><!--//my-account-wrapper-->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<style>
    .glowing-border-red_show{
        outline: none;
        border-color: #ff3333 !important;
        box-shadow: 0 0 10px #ff3333 !important;
    }
</style>

       <script>
    function clear_form()
    {
        document.getElementById("main").reset();
    }

    function getVal()
    {
      //alert('ok');
        var elements = new Array();

        for (var i = 0; i < arguments.length; i++)
        {
            var element = arguments[i];
            if (typeof element == 'string')
                element = document.getElementById(element);
            if (arguments.length == 1)
                return element;
            elements.push(element);
        }
        return elements;
    }

    function testVal()
    {
        old_pass=$('#Txt1').val();
        new_pass=$('#Txt2').val();
        conf_pass=$('#Txt3').val();
        var status="";

        $.ajax(
            {
                type: "POST",
                dataType:'json',
                url:"<?php echo base_url();?>seller_bussiness_profile/get_old_password",
                data: {id: old_pass},
                async: false,
                success: function(data)
                {
                    //alert(data);
                    status=data.msg;
                }
            });

        var counter=0;
        var retval = [];
        var elem = getVal('Txt1', 'Txt2', 'Txt3');

        for(var i =0; i < elem.length; i++)
        {
            if(elem[i].value == "")
            {
                $('input').each(function(){
                    retval.push($(this).attr('id'));
                });
                var id= retval[i];
                //alert(id);    
                $("#"+id).addClass("glowing-border-red_show");
                counter++;
            }
        }
        if(counter!=0)
        {
            return false;
        }

        if(status=='N')
        {
            return false;
        }
        if(new_pass==old_pass)
        {
            $('#new_pass_match').html(" provide a new password..!");
            return false;
        }

        if(new_pass!=conf_pass)
        {
            return false;
        }
    }

    function field1(value)
    {
        var status="";
        //alert(value);

        $.ajax(
            {
                type: "POST",
                dataType:'json',
                url:"<?php echo base_url();?>seller_bussiness_profile/get_old_password",
                data: {id: value},
                async: false,
                success: function(data)
                {
                    status=data.msg;
                }
            });
        if(status=='N')
        {
            $('#old_pass_match').html("password does not match..!");
        }
        else
        {
            $('#old_pass_match').html("");
        }
        $("#Txt1").removeClass("glowing-border-red");
    }

    function field2()
    {
        old_pass=$('#Txt1').val();
        new_pass=$('#Txt2').val();
        conf_pass=$('#Txt3').val();
        if(new_pass==old_pass)
        {
            $('#new_pass_match').html(" provide a new password..!");
            $("#Txt2").addClass("glowing-border-red");
        }
        else
        {
            $('#new_pass_match').html("");
            $("#Txt2").removeClass("glowing-border-red_show");
        }
        if((new_pass!=conf_pass) && (conf_pass!=""))
        {
            $('#conf_pass_match').html(" new password does not match with confirm password..!");
        }
        else
        {
            $('#conf_pass_match').html("");
            $("#Txt2").removeClass("glowing-border-red_show");
        }
    }

    function field3()
    {
        new_pass=$('#Txt2').val();
        conf_pass=$('#Txt3').val();
        if(new_pass!=conf_pass)
        {
            $('#conf_pass_match').html(" new password does not match with confirm password..!");
        }
        else
        {
            $('#conf_pass_match').html("");
        }
        $("#Txt3").removeClass("glowing-border-red_show");
    }
</script>
