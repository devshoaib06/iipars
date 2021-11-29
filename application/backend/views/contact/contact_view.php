<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
  <!--<script>tinymce.init({ selector:'textarea' });</script>-->
  <script type="text/javascript">
    tinymce.init({
      selector: ".tinyarea",
      theme: "modern",
      menubar: "edit insert tools",
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern imagetools"
      ],
      toolbar1: "undo redo | styleselect | bold italic| forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | link preview",
      image_advtab: true
    });
  </script>

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
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>
       CONTACT DETAILS
         
        
        
      </h3>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
       <li class="active">Contact Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">CONTACT DETAILS -->
                <span style="padding-right:30px;"></span>
                <small style="color:#008000;"><?php 
        
                  $msg=$this->session->flashdata('succ_msg');
                  if($msg)
                   {
                   echo $msg;
                   }

                ?></small>


              </h3>
                <div id="validation" style="color:red;"></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url();?>index.php/admin_contact/contact_update" method="post" id="contact_add_form_validation" >
              <div class="box-body">

              <!--   <div class="form-group">
                  <label for="organization" class="col-sm-2 control-label"><center>Organization Name : <span style="color:#F00">*</span> </center></label>

                  <div class="col-sm-8">
                   
                  <input type="text"  name="organization" id="organization" class="form-control" placeholder="Enter Organization Name" value="<?php echo @$contact[0]->organization; ?>">

                  </div>
                  
                </div> -->

          

				<div class="form-group">
                  <label for="contact_no" class="col-sm-2 control-label"><center>Contact No : <span style="color:#F00"></span> </center></label>

                  <div class="col-sm-8">
                    <input type="text" name="contact_no" class="form-control" id="contact_no" placeholder="Enter Contact No "  value="<?php echo @$contact[0]->contact_no; ?>">
                    <span id="error_mobile" style="color:red"></span>
                  </div>
                  
                </div>

               <!--  <div class="form-group">
                  <label for="contact_no" class="col-sm-2 control-label"><center>Admission Help Line No : <span style="color:#F00"></span> </center></label>

                  <div class="col-sm-8">
                    <input type="text" name="help_line_no" class="form-control" id="help_line_no" placeholder="Enter No "  value="<?php echo @$contact[0]->help_line_no; ?>">
                    <span id="error_mobile" style="color:red"></span>
                  </div>
                  
                </div> -->


  <div class="form-group">
                  <label for="primary_email" class="col-sm-2 control-label"><center>Email : <span style="color:#F00"></span> </center></label>

                  <div class="col-sm-8">
          
                    <input type="text" name="primary_email" id="primary_email" class="form-control" placeholder="Enter Email Id " value="<?php echo @$contact[0]->primary_email; ?>"> 
                    <span id="error_add" style="color:red"></span>
                  </div>
                  
                </div>

                 
              <!--      <div class="form-group">
                  <label for="full_address" class="col-sm-2 control-label"><center>Parent Organization : <span style="color:#F00">*</span> </center></label>

                  <div class="col-sm-8">
                   
                  <div id="full_address">  <textarea placeholder="Enter Address " name="parent_organization" id="parent_organization" class="tinyarea" > <?php echo @$contact[0]->parent_organaization; ?></textarea> </div>

                    <input type="hidden" name="contact_id"  value="<?php echo @$contact[0]->contact_id; ?>">
                     <span id="error_add" style="color:red"></span>
                  </div>
                  
                </div>  -->



                 <div class="form-group">
                  <label for="full_address" class="col-sm-2 control-label"><center>Address : <span style="color:#F00"></span> </center></label>

                  <div class="col-sm-8">
                   
                  <div id="full_address">  <textarea placeholder="Enter Address " name="full_address" id="full_address" class="tinyarea" > <?php echo @$contact[0]->full_address; ?></textarea> </div>

                    <input type="hidden" name="contact_id"  value="<?php echo @$contact[0]->contact_id; ?>">
                   <!--  <span id="error_add" style="color:red"></span> -->
                  </div>
                  
                </div>

      <!--     <div class="form-group">
                  <label for="alt_contact" class="col-sm-2 control-label"><center>Alternative Contact No:</center></label>

                  <div class="col-sm-9">
                    <input type="text" name="alt_contact" class="form-control" id="alt_contact"   value="<?php echo @$contact[0]->alt_contact; ?>">
                    <span id="error_mobile" style="color:red"></span>
                  </div>
                  
                </div> -->
         
            
<div class="clearfix"></div>
                              <!--   <div class="form-group" style="margin-top: 10px">
                                    <label for="map_src" class="col-sm-2 control-label text-center">Google map link : <span style="color: rgb(255, 0, 0); padding-left: 2px;">*</span></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="map_link" placeholder="Enter Map Link with iframe " id="map_src" rows="8" ><?php echo $contact[0]->map_link;?></textarea>
                                    </div>
                                </div> -->
				 <!--  <div class="clearfix"></div> 
            <div class="form-group">
                   <label for="secondary_email" class="col-sm-2 control-label"><center>Secondary email: </center></label>

                  <div class="col-sm-9">
          
                    <input type="text" name="secondary_email" id="secondary_email" class="form-control" value="<?php  echo @$contact[0]->secondary_email;  ?>"> 
                    <span id="error_add" style="color:red"></span>
                  </div>
                  
                </div>
                           
                                                           
              </div> -->
              <!-- <span style="color:#F00">*Fields Are Required</span> -->

              
              <div id="error"></div>
              <!-- /.box-body -->
              <div class="box-footer">
                <!-- <a href="<?php echo base_url(); ?>" class="btn btn-danger">Cancel</a> -->
                <button type="submit" class="btn btn-info pull-right">Update</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->
          
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- </div> -->

<script src="<?php echo base_url();?>custom_script/validation_rulse.js"></script>
<script src="<?php echo base_url();?>custom_script/contact_validation.js"></script>
<script src="<?php echo base_url();?>custom_script/setting_validation.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.multiselect.js"></script>

   <script>

     function contact_Submit_fm()
    {

        var organization = $('#organization').val();
        if (!isNull(organization)) 
        {
          $('#organization').removeClass('black_border').addClass('red_border');
         
          $("#organization").attr("data-toggle", "tooltip");
                $("#organization").attr("data-placement", "bottom");
                document.getElementById('organization').title = 'Organization name Is Required';
                $('#organization').tooltip('show'); 
        } 
        else 
        {
          $('#organization').removeClass('red_border').addClass('black_border');
           document.getElementById('organization').title = '';
                $('#organization').tooltip('destroy');
        }

         var primary_email = $('#primary_email').val();
        if (!isNull(primary_email)) 
        {
          $('#primary_email').removeClass('black_border').addClass('red_border');
           $("#primary_email").attr("data-toggle", "tooltip");
                $("#primary_email").attr("data-placement", "bottom");
                document.getElementById('primary_email').title = 'Primary Email Is Required';
                $('#primary_email').tooltip('show');
        } 
        else 
        {
          $('#primary_email').removeClass('red_border').addClass('black_border');
           document.getElementById('primary_email').title = '';
                $('#primary_email').tooltip('destroy');
        }

        var full_address = tinymce.get('full_address').getContent();
        if (!isNull(full_address)) 
        {
          
          $('#full_address').removeClass('black_border').addClass('red_border');
           $("#full_address").attr("data-toggle", "tooltip");
                $("#full_address").attr("data-placement", "bottom");
                document.getElementById('full_address').title = 'Full Address  Is Required';
                $('#full_address').tooltip('show');
          
        } 
         else 
         {
           $('#full_address').removeClass('red_border').addClass('black_border');
            document.getElementById('full_address').title = '';
                $('#full_address').tooltip('destroy');
         }

       

        

         
           var map_src = $('#map_src').val();
        if (!isNull(map_src)) 
        {
          $('#map_src').removeClass('black_border').addClass('red_border');
        
        $("#map_src").attr("data-toggle", "tooltip");
                $("#map_src").attr("data-placement", "bottom");
                document.getElementById('map_src').title = 'Map Link Is Required';
                $('#map_src').tooltip('show'); 

        } 
        else 
        {
          $('#map_src').removeClass('red_border').addClass('black_border');
           document.getElementById('map_src').title = '';
                $('#map_src').tooltip('destroy');
        }

       /* var contact_no = $('#contact_no').val();
        if (!isNull(contact_no)) 
        {
          $('#contact_no').removeClass('black_border').addClass('red_border');
          return false;
        } 
        else 
        {
          $('#contact_no').removeClass('red_border').addClass('black_border');
        }*/
/*
        var alt_contact = $('#alt_contact').val();
        if (!isNull(alt_contact)) 
        {
          $('#alt_contact').removeClass('black_border').addClass('red_border');
          return false;
        } 
        else 
        {
          $('#alt_contact').removeClass('red_border').addClass('black_border');
        }*/
       

    }

    function form_validation()
    {
      // alert("ok");

        $('#contact_add_form_validation').attr('onchange', 'contact_Submit_fm()');
        $('#contact_add_form_validation').attr('onkeyup', 'contact_Submit_fm()');

        contact_Submit_fm();
        //alert($('#contact_form .red_border').size());

        if ($('#contact_add_form_validation .red_border').size() > 0)
        {
            $('#contact_add_form_validation .red_border:first').focus();
            $('#contact_add_form_validation .alert-error').show();
           
            return false;
        } 
        else 
        {

            $('#contact_add_form_validation').submit();
        }
    }
</script> 

    <script src="<?php echo base_url();?>custom_script/validation_rulse.js"></script>

<script type="text/javascript">
  
    function validate()
  {
      var contact_no= $('#contact_no').val();
      var primary_email= $('#primary_email').val();
      var full_address= $('#full_address').val();
     
     
      
         
         if(contact_no==''){
            $('#contact_no').addClass('border-red');
            return false;
          }
        else {
                $('#contact_no').removeClass('border-red');
             } 

         if(primary_email==''){
            $('#primary_email').addClass('border-red');
            return false;
          }
       else {

                $('#primary_email').removeClass('border-red');
       } 



  
         if(full_address==''){
            $('#full_address').addClass('border-red');
            return false;
          }
       else  {

                $('#full_address').removeClass('border-red');
       }


           
        
        
  }
</script>
<style>
.error {color: #FF0000;}
</style>

</script>        

            