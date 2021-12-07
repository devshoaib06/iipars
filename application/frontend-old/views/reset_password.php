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
						<h2>Reset Password</h2>
				<p style="color:green"><b><?php echo $this->session->flashdata('suss_msg');?></b></p>

						<div class="prof-name-wrap">
							
							<div class="form-wrap">
								<form id="reset_form_id" method="POST" action="<?php echo base_url();?>my_account/update_password">
									
									<div class="col-lg-12">
										<div class="form-group">
											<input type="password" id="reset_password" name="reset_password" class="input-box" placeholder="New Password">
										</div>
									</div>
									<div class="col-lg-12">
										<div class="srv-btn">
											<a href="javascript:void(0)" onclick="client_registration_validation()" class="btn btn-dark btn-sm mt-15">Reset Password</a>
										</div>
									</div>
								</form>
							</div>
							
							
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
        var reset_password=$("#reset_password").val();       
        if (reset_password=="") 
        {
            $('#reset_password').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#reset_password').removeClass('red_border').addClass('black_border');               
        }

        
        


        

  }
  function client_registration_validation()
  {
  	
   
        $('#reset_form_id').attr('onchange', 'client_form_validation()');
        $('#reset_form_id').attr('onkeypress', 'client_form_validation()');

        // data_Submit_fm();

        client_form_validation();

        // alert($('#client_registration_form .red_border').size());

        if ($('#reset_form_id .red_border').size() > 0)
        {

            $('#reset_form_id .red_border:first').focus();
            $('#reset_form_id .alert-error').show();
            return false;
        } 
//        
        

        else {

    		$("#reset_form_id").submit();
  		}
        

  }
 
 </script>
