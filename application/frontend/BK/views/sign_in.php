

      




<div class="body-content">
  <div class="container">
              
    <div class="sign-in-page">
      <div class="row">
        <!-- Sign-in -->  
          
<div class="col-md-6 col-sm-6 sign-in">
  <div class="myaccount-widget">
              <?php
                if($this->session->flashdata('err_msg')!='')
                   {
                      ?>
                  <span style="color:red;"><b><?php echo $this->session->flashdata('err_msg'); ?></b></span>
                <?php
              }?> 
              <?php
                if($this->session->flashdata('suc_msg')!='')
                   {
                      ?>
                  <span style="color:green;"><b><?php echo $this->session->flashdata('suc_msg'); ?></b></span>
                <?php
              }?> 

              <?php
                if($this->session->flashdata('pass_error_msg')!='')
                   {
                      ?>
                  <span style="color:red;"><b><?php echo $this->session->flashdata('pass_error_msg'); ?></b></span>
                <?php
              }?> 
              <?php
                if($this->session->flashdata('pass_succ_msg')!='')
                   {
                      ?>
                  <span style="color:green;"><b><?php echo $this->session->flashdata('pass_succ_msg'); ?></b></span>
                <?php
              }?> 

               <?php
                            if($this->session->flashdata('close_acc')!='')
                             {
                                ?>
                                <span style="color:red;"><b><?php echo $this->session->flashdata('close_acc'); ?></b></span>
                            <?php
                            }?> 

                             <?php
                            if($this->session->flashdata('login_plan')!='')
                             {
                                ?>
                                <span style="color:red;"><b><?php echo $this->session->flashdata('login_plan'); ?></b></span>
                            <?php
                            }?> 
                            <?php
                            if($this->session->flashdata('book_plan')!='')
                             {
                                ?>
                                <span style="color:red;"><b><?php echo $this->session->flashdata('book_plan'); ?></b></span>
                            <?php
                            }?> 
                           
     <h3 class="title">Sign In</h3>

    </div>
  
  
  <form class="register-form outer-top-xs" role="form" method="post" id="login" action="<?php echo base_url();?>sign_in/login_action" >
    <div class="form-group">
        <label class="info-title" for="exampleInputEmail1">Email / Phone No. <span>*</span></label>
        <input type="text" class="form-control unicase-form-control text-input" id="user_email" name="username" required="" >
    </div>
      <div class="form-group">
        <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
        <input type="password" class="form-control unicase-form-control text-input" id="user_password" name="user_password" required="">
    </div>
    <div class="radio outer-xs">
        <!-- <label>
                  <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Remember me!
        </label> -->
        <a href="#" data-target="#pwdModal" data-toggle="modal" onclick="email_modal()" class="forgot-password pull-right">Forgot your Password?</a>
    </div>
      <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
  </form>   
        
</div>
<!-- Sign-in -->

<!-- create a new account -->
<div class="col-md-6 col-sm-6 create-new-account">
  <div class="myaccount-widget">
   <span>
              <?php 

               $succ=$this->session->flashdata('msg');

                             if($succ)
                             {

                             ?>
                            <br><span style="color:green"><b>

                               <?php echo $succ; ?>
                   </b> </span>
                              <?php
                       }
                   ?>

                    <span>
              <?php 

               $succ=$this->session->flashdata('wrongpass');

                             if($succ)
                             {

                             ?>
                            <br><span style="color:red"><b>

                               <?php echo $succ; ?>
                    </b></span>
                              <?php
                       }
                   ?>

                    <span>
              <?php 

               $succ=$this->session->flashdata('reg_msg');

                             if($succ)
                             {

                             ?>
                            <br><span style="color:green">

                               <?php echo $succ; ?>
                    </span>
                              <?php
                       }
                   ?>

                   <span>
              <?php 

               $succ=$this->session->flashdata('reg_fail_msg');

                             if($succ)
                             {

                             ?>
                            <br><span style="color:red">

                               <?php echo $succ; ?>
                    </span>
                              <?php
                       }
                   ?>

                    <span>
              <?php 

               $succ=$this->session->flashdata('emailexist');

                             if($succ)
                             {

                             ?>
                            <br><span style="color:red"><b>

                               <?php echo $succ; ?>
                   </b> </span>
                              <?php
                       }
                   ?>
     <h3 class="title">Create your new account</h3>
    </div>

    

  <form name="login_form" id="login_form"  class="register-form outer-top-xs" method="post"  action="<?php echo base_url(); ?>sign_in/registration_submit" onsubmit="return log_val()" >

    
      <div class="col-md-6">
        <div class="form-group">
        <label class="info-title" for="exampleInputfirstname">First Name <span>*</span></label>
        <input type="text" class="form-control unicase-form-control text-input" required="" name="f_name" id="f_name">
        <span id="f_errors"></span>
    </div>
    </div>
      <div class="col-md-6">
        <div class="form-group">
        <label class="info-title" for="exampleInputlastname">Last Name <span>*</span></label>
        <input type="text" class="form-control unicase-form-control text-input" name="l_name" required="" id="l_name">
         <span id="l_errors"></span>
    </div>
    </div>
    <div class="col-md-6">
    <div class="form-group">
        <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
        <input type="email" class="form-control unicase-form-control text-input" name="email" required=""  id="email">
         <span id="e_errors"></span>
      </div>
      </div>
    <div class="col-md-6">
        <div class="form-group">
        <label class="info-title" for="exampleInputnumber">Phone Number <span>*</span></label>
        <input type="text" class="form-control unicase-form-control text-input" name="mobile" required="" id="mobile" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10">
         <span id="m_errors"></span>
        
        
    </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <label class="info-title" for="exampleInputpass">Password <span>*</span></label>
        <input type="password" class="form-control unicase-form-control text-input" name="password" id="Txt2" required="" onkeyup="field2()">
         <span id="new_pass_match" style="color:red"></span>

    </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <label class="info-title" for="exampleInputcpass">Confirm Password <span>*</span></label>
       
        <input type="password"  class="form-control unicase-form-control text-input" name="c_password" required="" onkeyup="field3()" id="Txt3">
       <span id="conf_pass_match" style="color:red"></span>
        
    </div>
    </div>
         
      <button  onclick="return login_validation_action()"  class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
  </form>
  
  
</div>  
<!-- create a new account -->     </div><!-- /.row -->
    </div><!-- /.sigin-in-->
    <!-- ============================================== BRANDS CAROUSEL ============================================== -->

<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->  </div><!-- /.container -->
</div><!-- /.body-content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_script/validation_rulse.js" ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_script/login_validation.js" ></script> 


<!-- <script>

$('#password, #c_password').on('keyup', function () {
  if ($('#password').val() == $('#c_password').val()) {
    $('#message').html('Matching..').css('color', 'green');
  
  } else 
    $('#message').html('Not Matching..').css('color', 'red');
   
    

});

</script> -->

<!-- <script>

function form_validation()
{

  
  if(document.form.f_name.value=='')
  {

     document.getElementById('f_errors').innerHTML="*Please enter a First Name*";

     return false;
  }
  if(document.form.l_name.value=='')
  {

     document.getElementById('l_errors').innerHTML="*Please enter a Last Name*";
    
     return false;
  }
  if(document.form.email.value=='')
  {

     document.getElementById('e_errors').innerHTML="*Please enter the Email Id*";
    
     return false;
  }
  if(document.form.mobile.value=='' || isNan(document.form.mobile.value))
  {

     document.getElementById('m_errors').innerHTML="*Please enter the Mobile Number Properly*";
    
     return false;
  }
  if(document.form.password.value=='')
  {

     document.getElementById('p_errors').innerHTML="*Please enter a Password*";
    
     return false;
  }


}
</script>
 -->


<!--modal-->
<div id="pwdModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">What's My Password?</h1>
      </div>
      <div class="modal-body">
          <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                          
                          <p>Forgot Your Password??<br>Put Your Registered Email Id here..We Will Send You Back Your Existing Password To Your Email Address..</p>
                            <div class="panel-body">
                                <fieldset>
                                <form name="reset_pass" id="reset_pass" method="post" action="<?php echo base_url(); ?>sign_in/reset_pass_email_sent">
                                    <div class="form-group">
                                        <input class="form-control input-lg" placeholder="E-mail Address" name="email" type="email" id="email" required="">
                                    </div>
                                    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Send My Password">
                                    </form>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
      </div>  
      </div>
  </div>
  </div>
</div>

 <!-- <script>
  

        function reset_pass() 
        {
           var email=$("#pwdModal #email").val().trim();
           //alert(email);
            $.ajax({
                  type:"POST",
                
                  url:"<?php echo base_url()?>sign_in/reset_pass_email_sent",
                  data:{ Email:email },
                  cache: false,
                  processData: false,

                  success:function(data)
                  {
                       $("#pwdModal .close").click();
                  }
              });

          
        }
 
</script> -->

<style>
    .glowing-border-red_show{
        outline: none;
        border-color: #ff3333 !important;
        box-shadow: 0 0 10px #ff3333 !important;
    }
</style>

<script>
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
function log_val()
    {
       
        new_pass=$('#Txt2').val();
        conf_pass=$('#Txt3').val();
        var status="";

       
        var counter=0;
        var retval = [];
        var elem = getVal('Txt2', 'Txt3');

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

       

        if(new_pass!=conf_pass)
        {
            return false;
        }
    }

    function field1(value)
    {
        var status="";
        //alert(value);

        
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
            $('#conf_pass_match').html("password does not match ..!");
        }
        else
        {
            $('#conf_pass_match').html("");
        }
        $("#Txt3").removeClass("glowing-border-red_show");
    }
</script>



