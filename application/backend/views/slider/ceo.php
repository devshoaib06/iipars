<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
  <script type="text/javascript">
        tinymce.init({
            selector: "tinyarea",
            theme: "modern",
            menubar: "edit insert tools",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern imagetools"
            ],
            toolbar1: "undo redo | styleselect | bold italic| forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | link preview",
            image_advtab: true,
            extended_valid_elements : "span[*],i[*]",
            relative_urls : false,
            remove_script_host : false,
            convert_urls : true
        });
    </script>
<style type="text/css">
  .border-red{
    outline: none;
    border-color: #ff3333;
    box-shadow: 0 0 10px #ff3333; 
  }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>
        <!-- CEO -->
        
      </h3>

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
              <!-- <h3 class="box-title">TESTIMONIAL  ADD</h3> -->
            <div id="validation" style="color:red;"></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url();?>index.php/manage_slider/update_ceo" method="post"  enctype="multipart/form-data" >
              <div class="box-body">


                <div class="form-group" >
                    <label for="product_title" class="col-sm-2 control-label">Title<span style="color: rgb(255, 0, 0); padding-left: 2px;">*</span></label>

                      <div class="col-sm-9">
                        <input type="text" required="" name="first_title" class="form-control"  placeholder="Enter Title"  id="first_title" value="<?php echo @$ceo[0]->title; ?>" >
                        <span id="f_ttle" style="color: red;"></span>
                       
                      </div>
                 
                  </div>


               <div class="form-group" >
                    <label for="product_title" class="col-sm-2 control-label">Description<span style="color: rgb(255, 0, 0); padding-left: 2px;">*</span></label>

                      <div class="col-sm-9">
                       
                        <textarea name="description" required="required" id="description" style="height: 80px; width: 788px;"><?php echo @$ceo[0]->description; ?></textarea>
                        <span id="s_ttle" style="color: red;"></span>
                       
                      </div>
                       
                  </div>



                  

                  <div class="form-group">
                    <label for="image" class="col-sm-2 control-label">Image <span style="color: rgb(255, 0, 0); padding-left: 2px;">*</span></label>

                    <div class="col-sm-9">
                      <input type="file" name="image" class="form-control"  id="image" value="" onchange="readURL(this);">
                      <input type="hidden" name="old_image" id="old_image" value="<?php echo @$ceo[0]->image; ?>" ><br>
                        

                      <img id="prof_pic" src="<?php echo base_url();?>../assets/upload/ceo/<?php echo @$ceo[0]->image; ?>" alt="no image" height="100px" width="100px" style="border-radius: 0%">
                    </div>
                 
                  </div>

             

                <!-- <input type="hidden" name="slider_id" value=""> -->
        
               

                
                  <span style="color: rgb(255, 0, 0); padding-left: 2px;">* Fields are Required</span>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <!-- <a href="<?php echo base_url();?>index.php/manage_slider" class="btn btn-danger">Cancel</a> -->
                <button type="submit" class="btn btn-info pull-right" >Update</button>
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
  </div>
 
<script src="<?php echo base_url();?>custom_script/validation_rulse.js"></script>
<script src="<?php echo base_url();?>custom_script/setting_validation.js"></script>

  <script>


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






  $(function() {
    $( "#datepicker" ).datepicker(
    {
    autoclose: true
    });
  } );
  </script>
<script type="text/javascript">
  function validate()
  {
      var first_title= $('#first_title').val();
      var second_title= $('#second_title').val();
      var img_alt= $('#img_alt').val();
      
         
         if(first_title==''){
            $('#first_title').addClass('border-red');
            return false;
          }
        else {
                $('#first_title').removeClass('border-red');
             } 
         if(second_title==''){
            $('#second_title').addClass('border-red');
            return false;
          }
       else {

                $('#second_title').removeClass('border-red');
       }

if(third_title==''){
            $('#third_title').addClass('border-red');
            return false;
          }
       else {

                $('#third_title').removeClass('border-red');
       }
       

          if(slider_link==''){
            $('#slider_link').addClass('border-red');
            return false;
          }
       else {

                $('#slider_link').removeClass('border-red');
       } 

        if(img_alt==''){
             $('#img_alt').addClass('border-red');
            return false;
          }
          else {
                $('#img_alt').removeClass('border-red');
            
          }
        
  }
</script>


    
<style>
.error {color: #FF0000;}
</style>

            