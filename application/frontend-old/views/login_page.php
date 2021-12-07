<!-- Start main-content -->
  <div class="main-content">

    
    
    <section class="log-sec">
		<div class="container">
			<div class="log-wrap">
				<h2>Sign in to your account</h2>
				<p style="color:green"><b><?php echo $this->session->flashdata('succs');?></b></p>
				<p style="color:red"><b><?php echo $this->session->flashdata('wrong');?></b></p>

				<div class="form-wrap">
					<form id="login_form_id" method="POST" action="<?php echo base_url();?>login/login_action" enctype="multipart/form-data">
						<div class="col-lg-12">
							<div class="form-group">
								<input type="email" name="email" id="email" class="input-box" placeholder="Email">
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<input type="password" name="password" id="password" class="input-box" placeholder="Password">
							</div>
						</div>
						<div class="col-lg-6">
							<!-- <div class="lt-rem">
								<label>
									<input type="checkbox" class="rem-mark">
									Rememder me
								</label>
							</div> -->
						</div>
						<div class="col-lg-6">
							<div class="rt-forg">
								<a href="forgot-password.html">Forgot Password</a>
							</div>
						</div>
						<div class="srv-btn">
							<a href="javascript:void(0)" onclick="client_registration_validation()" class="btn btn-dark btn-sm mt-15">Login</a>
						</div>
					</form>
				</div>
			</div>
			<div class="form-footer">
				<div class="form-text">
					Don't have an account? <a href="<?php  echo $this->url->link(3);?>">Register here</a>
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
        var email=$("#email").val();       
        if (email=="") 
        {
            $('#email').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#email').removeClass('red_border').addClass('black_border');               
        }

        
        var password=$("#password").val();       
        if (password=="") 
        {
            $('#password').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#password').removeClass('red_border').addClass('black_border');               
        }


        

  }
  function client_registration_validation()
  {
  	
   
        $('#login_form_id').attr('onchange', 'client_form_validation()');
        $('#login_form_id').attr('onkeypress', 'client_form_validation()');

        // data_Submit_fm();

        client_form_validation();

        // alert($('#client_registration_form .red_border').size());

        if ($('#login_form_id .red_border').size() > 0)
        {

            $('#login_form_id .red_border:first').focus();
            $('#login_form_id .alert-error').show();
            return false;
        } 
//        
        

        else {

    		$("#login_form_id").submit();
  		}
        

  }
 
 </script>
