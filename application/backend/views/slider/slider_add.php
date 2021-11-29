<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
  <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
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
    <style type="text/css">
    .thumb-image{float:left;width:100px;position:relative;padding:5px;}
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>
        ADD SLIDER
        
      </h3>
      
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
            <form class="form-horizontal" action="<?php echo base_url();?>index.php/manage_slider/insert" method="post" id="productadd_form_validation" enctype="multipart/form-data" >
              <div class="box-body">


                

                  <div class="form-group" >
                    <label for="product_title" class="col-sm-2 control-label">Slider Title 1<span style="color: rgb(255, 0, 0); padding-left: 2px;">*</span></label>

                      <div class="col-sm-9">
                        <input type="text" name="first_title" class="form-control"  placeholder="slider title 1"  id="first_title" >
                        <span id="f_ttle" style="color: red;"></span>
                       
                      </div>
                 
                  </div>


               <div class="form-group" >
                    <label for="product_title" class="col-sm-2 control-label">Slider Title 2<span style="color: rgb(255, 0, 0); padding-left: 2px;">*</span></label>

                      <div class="col-sm-9">
                        <input type="text" name="second_title" class="form-control"  placeholder="slider title 2"  id="second_title" >
                        <span id="s_ttle" style="color: red;"></span>
                       
                      </div>
                       
                  </div>


                  <!--  <div class="form-group" >
                    <label for="product_title" class="col-sm-2 control-label">Slider Title 3<span style="color: rgb(255, 0, 0); padding-left: 2px;">*</span></label>

                      <div class="col-sm-9">
                        <input type="text" name="third_title" class="form-control"  placeholder="slider title 2"  id="third_title" >
                        <span id="s_ttle" style="color: red;"></span>
                       
                      </div>
                       
                  </div>  -->

                  <div class="form-group">
                    <label for="image" class="col-sm-2 control-label">Slider Image<span style="color: rgb(255, 0, 0); padding-left: 2px;">*</span></label>

                    <div class="col-sm-9">
                      <input type="file" name="image" class="form-control"  id="image" onchange="readURL(this);">

                       <img id="prof_pic" src="<?php echo base_url()?>../assets/upload/no-image.jpg"  alt="User Image" style="margin-top: 10px;width:60px;height:60px;" />
                      
                        <span id="img_eror" style="color: red;"></span>
                    </div>
                 
                  </div>

                  <!-- <div class="form-group" >
                    <label for="product_title" class="col-sm-2 control-label">Button Name<span style="color: rgb(255, 0, 0); padding-left: 2px;">*</span></label>

                      <div class="col-sm-9">
                        <input type="text" name="button_name" class="form-control"  placeholder="slider title 2"  id="button_name">
                        <span id="s_ttle" style="color: red;"></span>
                       
                      </div>
                       
                  </div> -->
 


                 <!-- <div class="form-group" >
                    <label for="product_title" class="col-sm-2 control-label">Button Link<span style="color: rgb(255, 0, 0); padding-left: 2px;">*</span></label>

                      <div class="col-sm-9">
                        <input type="text" name="slider_link" class="form-control"  placeholder="Slider Link"  id="slider_link" >
                       
                        <span id="error" style="color: red;"></span>
                      </div>
                 
                  </div> -->

                <!--

                 <div class="form-group" >
                    <label for="product_title" class="col-sm-2 control-label">Image Alt<span style="color: rgb(255, 0, 0); padding-left: 2px;">*</span></label>

                      <div class="col-sm-9">
                        <input type="text" name="img_alt" class="form-control"  placeholder="image alt"  id="img_alt" >
                       
                        <span id="error" style="color: red;"></span>
                      </div>
                 
                  </div>
                  -->

                  <!--  <div class="form-group">
                  <label for="meta_title" class="col-sm-2 control-label">Content Title</label>

                   <div class="col-sm-9">
                      <input type="text" class="form-control" name="content_title" id="content_title" placeholder="Content Title">
                    </div>
                </div>
                <div class="form-group">
                  <label for="product_details" class="col-sm-2 control-label">Content Details<span style="color: rgb(255, 0, 0); padding-left: 2px;">*</span></label>

                  <div class="col-sm-9">
                 <div id="pro_details">  <textarea type="text" name="content_details" class="form-control"  placeholder="Content details"  id="content_details">
                     </textarea></div>
                  </div>
                 
                  </div>  -->
               
                 <!-- <div class="form-group">
                  <label for="meta_description" class="col-sm-2 control-label">Slider Status</label>

                    <div class="col-sm-9">
                      <input type="radio" name="slider_status" id="active" value='active'>Active
                      <input type="radio" name="slider_status" id="inactive" value='inactive'>Inactive
                    </div>
                 
                </div> -->
               

                
                  <span style="color: rgb(255, 0, 0); padding-left: 2px;">* Fields are Required</span>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url();?>index.php/manage_slider" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-info pull-right" id="submit" onclick="return validate()">Submit</button>
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
      var first_title= $('#first_title').val();
      var second_title= $('#second_title').val();
      var third_title= $('#third_title').val();
      var image= $('#image').val();
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
         if(image==''){
            $('#image').addClass('border-red');
            return false;
          }
       else  {

                $('#image').removeClass('border-red');
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

            