 <style type="text/css">
  .border-red{
    outline: none;
    border-color: #ff3333;
    box-shadow: 0 0 10px #ff3333; 
  }
</style>
    <style type="text/css">
    .thumb-image{float:left;width:100px;position:relative;padding:5px;}
</style>

<!-- Start main-content -->
  <div class="main-content">

    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-white-8" data-bg-img="<?php echo base_url();?>assets/images/bg6.jpg">
      <div class="container pt-30 pb-30">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="title">Contact</h2>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="#">Home</a></li>
                <li class="active text-theme-colored">Contact Us</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section: Have Any Question -->
    <section class="contact-sec">
      <div class="container">
        <div class="section-title mb-60">
          <div class="row">
            <div class="col-md-12">
              <div class="esc-heading small-border text-center">
                <h3>Have any Questions?</h3>
              </div>
            </div>
          </div>
        </div>
        <div class="section-content">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="contact-info text-center">
                <i class="fa fa-phone font-36 mb-10 text-theme-colored"></i>
                <h4>Call Us</h4>
                <h6 class="text-gray"><?php echo @$contact[0]->contact_no; ?></h6>
              </div>
            </div>
            <!-- <div class="col-sm-12 col-md-4">
              <div class="contact-info text-center">
                <i class="fa fa-map-marker font-36 mb-10 text-theme-colored"></i>
                <h4>Address</h4>
                <h6 class="text-gray"> <?php echo @$contact[0]->full_address; ?></h6>
              </div>
            </div> -->
            <div class="col-sm-12 col-md-6">
              <div class="contact-info text-center">
                <i class="fa fa-envelope font-36 mb-10 text-theme-colored"></i>
                <h4>Email</h4>
                <h6 class="text-gray"><?php echo @$contact[0]->primary_email; ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section: Contact -->
    <section data-bg-img="<?php echo base_url();?>assets/images/pattern/p4.png" class="cont-form-sec"> 
      <div class="container">
        <div class="section-title text-center">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h2 class="text-uppercase font-28 mt-0"><span class="text-theme-colored">Contact</span> Us</h2>
            </div>
          </div>
        </div>
        <div class="section-content">          
          <div class="row">
            <div class="col-md-12">



                  <small><?php
            $succ_msg=$this->session->flashdata('succ_msg');
            if($succ_msg){
              ?>
              <br><span style="color:green">
                <?php echo $succ_msg; ?>
              </span>
              <?php
              }
              ?>
            
      </small>
            
              <!-- Contact Form -->
              <form id="contact_form" name="contact_form" class="contact-form-transparent" method="post" action="<?php echo base_url(); ?>manage_contact/contact_form_submit">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Name <small>*</small></label>
                      <input name="nam" id="nam" class="form-control" type="text" placeholder="Enter Name">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Email <small>*</small></label>
                      <input name="email" id="email" class="form-control" type="email" placeholder="Enter Email">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Subject <small>*</small></label>
                      <input name="subject" id="subject" class="form-control" type="text" placeholder="Enter Subject">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Phone</label>
                      <input name="phone" id="phone" class="form-control" type="text" placeholder="Enter Phone">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Message</label>
                  <textarea name="form_message" class="form-control" rows="5" placeholder="Enter Message"></textarea>
                </div>
				<div class="srv-btn">
					<button type="submit" class="btn btn-dark btn-sm mt-15" data-loading-text="Please wait..." onclick="return validate()">Send your message</button>
				</div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Divider: Google Map 
    <section>
      <div class="container-fluid pt-0 pb-0">
        <div class="row">

          
              <iframe src="https://maps.google.com/maps?q=3rd+Floor%2C+Mondal+House%2C+Noapara%2C+Chinar+Park%2C+Dash+Drone%2C+Rajarhat%2C+Kolkata%2C+West+Bengal+700157&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" class="map" allowfullscreen="" width="100%" height="450" frameborder="0"></iframe>

        </div>
      </div>
    </section> -->
  </div>
  <!-- end main-content -->






      <script src="<?php echo base_url();?>custom_script/validation_rulse.js"></script>
<script type="text/javascript">




function readURL(input)
    {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#prof_pic')
                    .attr('src', e.target.result)
                    .width(90)
                    .height(90);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }




  
  function validate()
  {
      var nam= $('#nam').val();
      var email= $('#email').val();
      var subject= $('#subject').val();

     
      
         
         if(nam==''){
            $('#nam').addClass('border-red');
            return false;
          }
        else {
                $('#nam').removeClass('border-red');
             } 

         if(email==''){
            $('#email').addClass('border-red');
            return false;
          }
       else {

                $('#email').removeClass('border-red');
       } 



  
         if(subject==''){
            $('#subject').addClass('border-red');
            return false;
          }
       else  {

                $('#subject').removeClass('border-red');
       }


        
        
  }
</script>
<style>
.error {color: #FF0000;}
</style>