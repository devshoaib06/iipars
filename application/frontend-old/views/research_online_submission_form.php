
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
              <h2 class="title">Research Paper Consultancy Online Submission Form</h2>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="#">Home</a></li>
                <li class="active text-theme-colored">Research Paper Consultancy Online Submission Form</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>



     <section data-bg-img="<?php echo base_url();?>assets/images/pattern/p4.png" class="cont-form-sec"> 
      <div class="container">
        <div class="section-title text-center">
          <div class="row">
            <div class="col-md-12">
              <h2 class="text-uppercase font-28 mt-0 p_cus_text_center"><span class="text-theme-colored">Personal Details</span></h2>
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
              <form id="contact_form" name="contact_form" class="contact-form-transparent" action="<?php echo base_url(); ?>manage_research/research_paper_submit" method="post">
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
                   <div class="col-sm-6">
                    <div class="form-group">
                      <label>Phone</label>
                      <input name="phone" id="phone" class="form-control" type="text" placeholder="Enter Phone">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>WhatsApp No</label>
                      <input name="wp" id="wp" class="form-control" type="text" placeholder="Enter WhatsApp No">
                    </div>
                  </div>

                   <div class="col-sm-6">
                    <div class="form-group">
                      <label>Subject <small>*</small></label>
                      <input name="subject" id="subject" class="form-control" type="text" placeholder="Enter Subject">
                    </div>
                  </div>

                   <div class="col-sm-6">
                    <div class="form-group">
                      <label>Designation(if any) <small>*</small></label>
                      <input name="designation" id="designation" class="form-control" type="text" placeholder="Enter Designation">
                    </div>
                  </div>


                </div>

                  <div class="row">
            <div class="col-md-12">
              <h2 class="text-uppercase font-28 mt-0 p_cus_text_center  p_cus_img_mar"><span class="text-theme-colored">Research Paper Consultancy Details</span></h2>
            </div>
          </div>



           <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Subject <small>*</small></label>
                      <input name="subject2" id="subject2" class="form-control" type="text" placeholder="Enter Subject" required="">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Specialisation(if any) <small>*</small></label>
                      <input name="specialisation" id="specialisation" class="form-control" type="text" placeholder="Enter Specialisation">
                    </div>
                  </div>
                   <div class="col-sm-6">
                    <div class="form-group">
                      <label>M.Phil/ Ph.d Title(if any)<small>*</small></label>
                      <input name="mphil" id="mphil" class="form-control" type="text" placeholder="M.Phil/ Ph.d Title">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>No of Paper Order<small>*</small></label>
                      <input name="nopaper" id="nopaper" class="form-control" type="text" placeholder="Enter No of Paper Order">
                    </div>
                  </div>

                   <div class="col-sm-6">
                    <div class="form-group">
                      <label>In Words <small>*</small></label>
                      <input name="in_words" id="in_words" class="form-control required" type="text" placeholder="Enter In Words">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Total Amount(INR) <small>*</small></label>
                      <input name="total_amount" id="total_amount" class="form-control required" type="text" placeholder="Enter Total Amount(INR)">
                    </div>
                  </div>

                   <div class="col-sm-6">
                    <div class="form-group">
                      <label>Total Amount(In Words)<small>*</small></label>
                      <input name="t_amount_words" id="t_amount_words" class="form-control required" type="text" placeholder="Enter Total Amount(In Words)">
                    </div>
                  </div>


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
      var designation= $('#designation').val();
      var subject2= $('#subject2').val();
      var specialisation= $('#specialisation').val();
      var mphil= $('#mphil').val();
      
      var nopaper= $('#nopaper').val();
      var in_words= $('#in_words').val();
      
      var total_amount= $('#total_amount').val();
      var t_amount_words= $('#t_amount_words').val();
     
      
         
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


          if(designation==''){
            $('#designation').addClass('border-red');
            return false;
          }
       else  {

                $('#designation').removeClass('border-red');
       }


           if(subject2==''){
            $('#subject2').addClass('border-red');
            return false;
          }
       else  {

                $('#subject2').removeClass('border-red');
       }


             if(specialisation==''){
            $('#specialisation').addClass('border-red');
            return false;
          }
       else  {

                $('#specialisation').removeClass('border-red');
       }


        
             if(mphil==''){
            $('#mphil').addClass('border-red');
            return false;
          }
       else  {

                $('#mphil').removeClass('border-red');
       }
      


          if(nopaper==''){
            $('#nopaper').addClass('border-red');
            return false;
          }
       else  {

                $('#nopaper').removeClass('border-red');
       }


          if(in_words==''){
            $('#in_words').addClass('border-red');
            return false;
          }
       else  {

                $('#in_words').removeClass('border-red');
       }  


         

             if(total_amount==''){
            $('#total_amount').addClass('border-red');
            return false;
          }
       else  {

                $('#total_amount').removeClass('border-red');
       } 


           if(t_amount_words==''){
            $('#t_amount_words').addClass('border-red');
            return false;
          }
       else  {

                $('#t_amount_words').removeClass('border-red');
       }
        
        
  }
</script>
<style>
.error {color: #FF0000;}
</style>