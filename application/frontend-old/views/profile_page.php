<!-- Start main-content -->
  <div class="main-content">

    
    
    <section class="acc-sec">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-12">
					<div class="acc-lt-panel">
						<div class="user-name">
							<h3><?php echo @$user_details[0]->first_name." ".@$user_details[0]->last_name;?></h3>
							<p><?php echo @$user_details[0]->login_email;?></p>
						</div>
						<div class="prof-tab">
							<ul>
	                           <li <?php if($active=='profile') { ?> class="prof-active" <?php } ?>><a href="<?php  echo $this->url->link(5);?>">Profile Update</a></li>
                                <li <?php if($active=='my_plan') { ?> class="prof-active" <?php } ?>><a href="<?php  echo $this->url->link(8);?>">My Plan</a></li>
                                
                                <li <?php if($active=='reset_psw') { ?> class="prof-active" <?php } ?>"><a href="<?php  echo $this->url->link(7);?>">Reset Password</a></li>
                                <li><a href="<?php  echo $this->url->link(6);?>">Logout</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-md-12">
					<div class="acc-rt-panel">
						<h2>Profile Update</h2>
					<p style="color:green"><b><?php echo $this->session->flashdata('suss_msg');?></b></p>

						<div class="prof-name-wrap">
							<form id="profile_form_id" method="POST" action="<?php echo base_url();?>my_account/update_profile" enctype="multipart/form-data">
								<div class="col-lg-12">
									<div class="form-group">
										<label>First Name</label>
										<input type="text" class="input-box" name="f_name" id="f_name" value="<?php echo @$user_details[0]->first_name;?>" placeholder="First Name">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" class="input-box" name="l_name" id="l_name" value="<?php echo @$user_details[0]->last_name;?>" placeholder="Last Name">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label>Email</label>
										<input type="email" name="email" id="email" value="<?php echo @$user_details[0]->login_email;?>" class="input-box" placeholder="Email">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label>Phone Number</label>
										<input type="text" name="ph_no" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="12" id="ph_no" value="<?php echo @$user_details[0]->mobile;?>" class="input-box" placeholder="Phone Number">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label>Address</label>
										<textarea class="input-box" name="address" id="address" placeholder="Address"><?php echo @$user_details[0]->address;?></textarea>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="srv-btn">
										<a href="javascript:void(0)" onclick="client_registration_validation()" class="btn btn-dark btn-sm mt-15">Save</a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

  </div>
  <!-- end main-content -->

<script src="<?php echo base_url();?>assets/custom_script/validation_rulse.js"></script>



<script type="text/javascript">

  function client_form_validation()
  {

  	// alert('ok');
        var f_name=$("#f_name").val();       
        if (f_name=="") 
        {
            $('#f_name').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#f_name').removeClass('red_border').addClass('black_border');               
        }

        var l_name=$("#l_name").val();       
        if (l_name=="") 
        {
            $('#l_name').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#l_name').removeClass('red_border').addClass('black_border');               
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


		var ph_no=$("#ph_no").val();       
        if (ph_no=="") 
        {
            $('#ph_no').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#ph_no').removeClass('red_border').addClass('black_border');               
        }

        var address=$("#address").val();       
        if (address=="") 
        {
            $('#address').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#address').removeClass('red_border').addClass('black_border');               
        }
        

  }
  function client_registration_validation()
  {
  	
   
        $('#profile_form_id').attr('onchange', 'client_form_validation()');
        $('#profile_form_id').attr('onkeypress', 'client_form_validation()');

        // data_Submit_fm();

        client_form_validation();

        // alert($('#client_registration_form .red_border').size());

        if ($('#profile_form_id .red_border').size() > 0)
        {

            $('#profile_form_id .red_border:first').focus();
            $('#profile_form_id .alert-error').show();
            return false;
        } 
//        
        

        else {

    		$("#profile_form_id").submit();
  		}
        

  }
 
 </script>