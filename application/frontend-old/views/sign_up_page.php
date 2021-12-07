<!-- Start main-content -->
  <div class="main-content">

    
    
    <section class="log-sec">
		<div class="container">
			<div class="log-wrap">
				<h2>Create an account</h2>
				<p style="color:green"><b><?php echo $this->session->flashdata('exist');?></b></p>


				<div class="form-wrap">
					<form method="POST" action="<?php echo base_url();?>sign_up/create_account"  id="client_registration_form" enctype="multipart/form-data">


              <div class="col-lg-12">
              <div class="form-group">
                <select class="input-box" name="subject">
                   <option>Choose Subject</option>
                  <?php foreach($subject as $sub) { ?>
                 <option value="<?php echo $sub->kpo_id; ?>"><?php echo $sub->kpo_name; ?></option>
                <?php } ?>
                </select>
               
                
              </div>
            </div>


						<div class="col-lg-12">
							<div class="form-group">
								<input type="text" name="full_name" onkeypress="return check_valid_input(event)" id="full_name" class="input-box" placeholder="Full Name">
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<input type="email" class="input-box" onkeyup="chk_email(value)" name="email" id="email" placeholder="Email">
								<span style="color:red;display: none;" id="email_error" ><b>This Email is already used.</b></span>	
							</div>
						</div>

            <div class="col-lg-12">
              <div class="form-group">
                <input type="number" class="input-box" name="mobile" id="mobile" placeholder="Mobile">
                 
              </div>
            </div>
						<div class="col-lg-12">
							<div class="form-group">
								<input type="password" name="password" id="password" class="input-box" placeholder="Password">
								<small id="pass_error" style="color:red"></small>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<input type="password" name="confirm_pass" id="confirm_pass" class="input-box" placeholder="Confirm Password">
								
							</div>
						</div>

          
						
						<div class="srv-btn">
							<a href="javascript:void(0)" onclick="client_registration_validation()" class="btn btn-dark btn-sm mt-15">Sign Up</a>
						</div>
					</form>
				</div>
			</div>
			<div class="form-footer">
				<div class="form-text">
					Already a member? <a href="<?php  echo $this->url->link(2);?>">Login here</a>
				</div>
			</div>
		</div>
	</section>

  </div>
  <!-- end main-content -->

<script src="<?php echo base_url();?>assets/custom_script/validation_rulse.js"></script>

<script>
function check_valid_input(value)
{
     var x = value.which || value.keyCode;
     //alert(x);
     if ((x > 32 && x < 45) || (x > 47 && x < 65) || (x > 90 && x < 97)){ value.preventDefault();}
     
  

}
</script>


  <script type="text/javascript">

  function client_form_validation()
  {

  	// alert('ok');
        var full_name=$("#full_name").val();       
        if (full_name=="") 
        {
            $('#full_name').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#full_name').removeClass('red_border').addClass('black_border');               
        }

        var email=$("#email").val();
        if (!isEmail(email)) 
        {
            $('#email').removeClass('black_border').addClass('red_border');            
        } 
        else 
        {
            $('#email').removeClass('red_border').addClass('black_border');
        }


        var password=$("#password").val();
        if (password=="" ) 
        {
            $('#password').removeClass('black_border').addClass('red_border');            
        } 
        
        else if (password.length < 6) 
        {
        	$('#pass_error').html('<i class="fa fa-exclamation-triangle"></i> Password length should be minimum 6 character').css('color', 'red');

            $('#password').removeClass('black_border').addClass('red_border');            
        } 
        else 
        {
        	$('#pass_error').html('');

            $('#password').removeClass('red_border').addClass('black_border');
        }
            



         

        var confirm_pass=$("#confirm_pass").val();
        if (confirm_pass=="" || confirm_pass!=password) 
        {
            $('#confirm_pass').removeClass('black_border').addClass('red_border');            
        } 
        else 
        {
            $('#confirm_pass').removeClass('red_border').addClass('black_border');
        }

        
        
        
        
      
        

  }
  function client_registration_validation()
  {
  	
   
        $('#client_registration_form').attr('onchange', 'client_form_validation()');
        $('#client_registration_form').attr('onkeypress', 'client_form_validation()');

        // data_Submit_fm();

        client_form_validation();

        // alert($('#client_registration_form .red_border').size());

        if ($('#client_registration_form .red_border').size() > 0)
        {

            $('#client_registration_form .red_border:first').focus();
            $('#client_registration_form .alert-error').show();
            return false;
        } 
//        
        

        else {

    		$("#client_registration_form").submit();
  		}
        

  }
 
 </script>

 <script>
  
  function chk_email(value)
  {

  	// alert(value);


       var base_url='<?php echo  base_url();?>';
        if(value!='')
        {
          $.ajax({
                        
              url:'<?php echo  base_url();?>sign_up/check_email',
              data:{email:value},
              dataType: "json",
              type: "POST",
              async: true,
              success: function(data)
              {
                    // alert(data);
                    var perform= data.changedone;
                    if(perform['status']==1)
                      {
                        
                        $("#email_error").show();
                        
                        $('#email').removeClass('black_border').addClass('red_border');
                       
                       
                      }
                      if(perform['status']==0){

                         
                         $('#email_error').hide();

                      	$('#email').removeClass('red_border').addClass('black_border');
                      }                    
               }
                                                            
              });
        }
        else
        {
          $("#email_error").html("");
          
        }
      
  }

</script>