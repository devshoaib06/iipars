        

        <section class="sel-rig">

                <div class="container">
                <div class="col-md-6">
                    <img src="<?php echo base_url(); ?>assets/images/ecommerce.png" alt="" class="img-responsive img">


                </div>
                <div class="col-md-6" id="res">
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

                               <span>


                    <h4 class="res-head">Seller Registration</h4>
                 <form method="post" action="<?php echo base_url(); ?>seller_sign_in/seller_registration_submit" id="login_form"  onsubmit="return log_val()">
                    
                    <input type="text" class="regis-inbx" name="f_name" id="f_name" required="" placeholder="First Name"></input> 
                     <input type="text" class="regis-inbx" name="l_name" id="l_name" required="" placeholder="Last Name"></input>
                     <input type="email" class="regis-inbx" name="email" id="email" required="" placeholder="Enter Email"></input>
                    <input type="text" class="regis-inbx" name="mobile"  id="mobile" required="" placeholder="Mobile No" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10"></input><span id="number"></span>
                    <input type="password" class="regis-inbx" name="password" id="Txt2" onkeyup="field2()" required="" placeholder="Password"></input> 
                    <input type="password" class="regis-inbx" name="c_password" onkeyup="field3()" id="Txt3" required="" placeholder="Re-enter Password"><span id="conf_pass_match" style="color:red"></span>
                     <!-- <input type="text" class="regis-inbx" placeholder="GST"></input> -->

                     <button type="submit" class="res-btn1">Sell Now</button>
                </form>

                </div>

                </div>
            

        </section>

    <!--  <script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_script/validation_rulse.js" ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_script/login_validation.js" ></script>  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <!-- <script>

$('#password, #c_password').on('keyup', function () {
  if ($('#password').val() == $('#c_password').val()) {
    $('#message').html('Matching..').css('color', 'green');
    
  } else 
    $('#message').html('Not Matching..').css('color', 'red');
    
   
    

});

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

     

      