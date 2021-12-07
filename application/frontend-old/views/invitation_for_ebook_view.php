
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
              <h2 class="title">Invitation For Ebook</h2>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="#">Home</a></li>
                <li class="active text-theme-colored">Invitation For Ebook</li>
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
              <form id="contact_form" name="contact_form" action="<?php echo base_url(); ?>/Manage_ebook/invite_for_ebook_submit" class="contact-form-transparent" action="" method="post">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Name <small>*</small></label>
                      <input name="nam" id="user_nam" class="form-control" type="text" placeholder="Enter Name">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Designation(if any) <small>*</small></label>
                      <input name="designation" id="designation" class="form-control" type="text" placeholder="Enter Designation(if any)">
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
                      <label>Email</label>
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
              <h2 class="text-uppercase font-28 mt-0 p_cus_text_center  p_cus_img_mar"><span class="text-theme-colored">eBook Details</span></h2>
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
                      <label>Book Title</label>
                      <input name="book_title" id="book_title" class="form-control" type="text" placeholder="Enter Book Title">
                    </div>
                  </div>
                   


                   <div class="col-sm-12">
                    <div class="form-group sohrt_description_p_cus">
                      <label>Short Description:<small>*</small></label>
                      <!-- <textarea class="form-control" name="short_description" id="short_description">
                          </textarea> -->
                          <textarea class="form-control" name="short_description" id="short_description" required=""></textarea>
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
      var user_nam= $('#user_nam').val();

      var designation= $('#designation').val();

      var address= $('#address').val();


     
      var subject= $('#subject').val();
      
      
      
      
      var short_description= $('#short_description').val();
     
      
           if(user_nam==''){
            $('#user_nam').addClass('border-red');
            return false;
          }
        else {
                $('#user_nam').removeClass('border-red');
             }
        

            if(designation==''){
            $('#designation').addClass('border-red');
            return false;
          }
       else  {

                $('#designation').removeClass('border-red');
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


     

      
         if(isNull(short_description))
         {
          alert('Please Write Short Description');
          return false;
         }

       


        


         

       //       if(short_description==''){
       //      $('#short_description').addClass('border-red');
       //      return false;
       //    }
       // else  {

       //          $('#short_description').removeClass('border-red');
       // } 


       
        
        
  }
</script>
<style>
.error {color: #FF0000;}
</style>