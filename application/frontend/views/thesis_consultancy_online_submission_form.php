
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
              <h2 class="title">Thesis Consultancy Online Submission Form</h2>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="#">Home</a></li>
                <li class="active text-theme-colored">Thesis Consultancy Online Submission Form</li>
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
              <form id="contact_form" name="contact_form" class="contact-form-transparent" action="<?php echo base_url(); ?>manage_thesis/thesis_consul_submit" method="post">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Name <small>*</small></label>
                      <input name="nam" id="nam" class="form-control" type="text" placeholder="Enter Name">
                    </div>
                  </div>
                  
                   <div class="col-sm-6">
                    <div class="form-group">
                      <label>Designation(if any) <small>*</small></label>
                      <input name="designation" id="designation" class="form-control" type="text" placeholder="Enter Designation(if any) ">
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
                      <label>Email <small>*</small></label>
                      <input name="email" id="email" class="form-control" type="email" placeholder="Enter Email">
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
                      <label>Address <small>*</small></label>
                      <input name="address" id="address" class="form-control" type="text" placeholder="Enter Address">
                    </div>
                  </div>

                  


                </div>

                  <div class="row">
            <div class="col-md-12">
              <h2 class="text-uppercase font-28 mt-0 p_cus_text_center  p_cus_img_mar"><span class="text-theme-colored">Thesis Details</span></h2>
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
                      <label>Thesis Title <small>*</small></label>
                      <input name="thesis_title" id="thesis_title" class="form-control" type="text" placeholder="Enter Thesis Title ">
                    </div>
                  </div>
                  <div class="col-md-12">
                      <h3>Chaptalization</h3>
                  </div>
                   <div class="col-sm-6">
                    <div class="form-group">
                      <label>Chapter 1<small>*</small></label>
                      <input name="chapter1" id="chapter1" class="form-control" type="text" placeholder="Enter Chapter 1">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Chapter 2<small>*</small></label>
                      <input name="chapter2" id="chapter2" class="form-control" type="text" placeholder="Enter Chapter 2">
                    </div>
                  </div>

                   <div class="col-sm-6">
                    <div class="form-group">
                      <label>Chapter 3<small>*</small></label>
                      <input name="chapter3" id="chapter3" class="form-control" type="text" placeholder="Enter Chapter 3">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Chapter 4<small>*</small></label>
                      <input name="chapter4" id="chapter4" class="form-control" type="text" placeholder="Enter Chapter 4">
                    </div>
                  </div>

                   <div class="col-sm-6">
                    <div class="form-group">
                      <label>Chapter 5<small>*</small></label>
                      <input name="chapter5" id="chapter5" class="form-control" type="text" placeholder="Enter Chapter 5">
                    </div>
                  </div>
                  
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Chapter 6<small>*</small></label>
                      <input name="chapter6" id="chapter6" class="form-control" type="text" placeholder="Enter Chapter 6">
                    </div>
                  </div>
                  
                  
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Chapter 7<small>*</small></label>
                      <input name="chapter7" id="chapter7" class="form-control" type="text" placeholder="Enter Chapter 7">
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
      var designation= $('#designation').val();
      var email= $('#email').val();
      var address= $('#address').val();
      var subject= $('#subject').val();
      
      var thesis_title= $('#thesis_title').val();
      var chapter1= $('#chapter1').val();
      
      var chapter2= $('#chapter2').val();
      var chapter3= $('#chapter3').val();
      var chapter4= $('#chapter4').val();
      var chapter5= $('#chapter5').val();
      var chapter6= $('#chapter6').val();
      var chapter7= $('#chapter7').val();
     
      
         
         if(nam==''){
            $('#nam').addClass('border-red');
            return false;
          }
        else {
                $('#nam').removeClass('border-red');
             } 


               if(designation==''){
            $('#designation').addClass('border-red');
            return false;
          }
        else {
                $('#designation').removeClass('border-red');
             } 

         if(email==''){
            $('#email').addClass('border-red');
            return false;
          }
       else {

                $('#email').removeClass('border-red');
       } 



  
         if(address==''){
            $('#address').addClass('border-red');
            return false;
          }
       else  {

                $('#address').removeClass('border-red');
       }


           if(subject==''){
            $('#subject').addClass('border-red');
            return false;
          }
       else  {

                $('#subject').removeClass('border-red');
       }

      


          if(thesis_title==''){
            $('#thesis_title').addClass('border-red');
            return false;
          }
       else  {

                $('#thesis_title').removeClass('border-red');
       }


          if(chapter1==''){
            $('#chapter1').addClass('border-red');
            return false;
          }
       else  {

                $('#chapter1').removeClass('border-red');
       }  


         

             if(chapter2==''){
            $('#chapter2').addClass('border-red');
            return false;
          }
       else  {

                $('#chapter2').removeClass('border-red');
       } 


           if(chapter3==''){
            $('#chapter3').addClass('border-red');
            return false;
          }
       else  {

                $('#chapter3').removeClass('border-red');
       }



         if(chapter4==''){
            $('#chapter4').addClass('border-red');
            return false;
          }
       else  {

                $('#chapter4').removeClass('border-red');
       }


         if(chapter5==''){
            $('#chapter5').addClass('border-red');
            return false;
          }
       else  {

                $('#chapter5').removeClass('border-red');
       }


         if(chapter6==''){
            $('#chapter6').addClass('border-red');
            return false;
          }
       else  {

                $('#chapter6').removeClass('border-red');
       }

         if(chapter7==''){
            $('#chapter7').addClass('border-red');
            return false;
          }
       else  {

                $('#chapter7').removeClass('border-red');
       }
        
        
  }
</script>
<style>
.error {color: #FF0000;}
</style>