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
  .red_border{
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
       Manage General Guideline
         
        
        
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
              <h3 class="box-title">
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
            <form class="form-horizontal" action="<?php echo base_url();?>index.php/manage_disertation_guideline/insert" method="post" id="welcome_content_form" enctype="multipart/form-data">
              <div class="box-body">
                            
                

                    <div class="form-group">
                  <label for="mobile" class="col-sm-2 control-label"><center>Title<span style="color:#F00">*</span> </center></label>

                  <div class="col-sm-10" >
                   
                  
                  <!-- <input type="text" name="title" class="form-control" id="title" value="<?php echo @$manage_home[0]->title; ?>"> -->
                  <textarea class="tinyarea" name="title" id="title"><?php echo @$manage_home[0]->title; ?></textarea>

                    <span id="error_add" style="color:red"></span>

                  </div>
                  
                </div> 

                     <div class="form-group">
                  <label for="mobile" class="col-sm-2 control-label"><center>Youtube Video Link<span style="color:#F00">*</span> </center></label>

                  <div class="col-sm-10" >
                   
                   <iframe width="260" height="190" src="<?php echo @$manage_home[0]->video_link; ?>" frameborder="0" allowfullscreen></iframe>
                  <input type="text" name="video_link" class="form-control" id="video_link" value="<?php echo @$manage_home[0]->video_link; ?>">

                    <span id="error_add" style="color:red"></span>

                  </div>
                  
                </div> 

           
                <div class="form-group">
                  <label for="mobile" class="col-sm-2 control-label"><center>Description<span style="color:#F00">*</span> </center></label>

                  <div class="col-sm-10" >
                   
                  <textarea name="des" class="tinyarea"   rows="5" cols="96" id="content"><?php echo @$manage_home[0]->description; ?></textarea>

                    <span id="error_add" style="color:red"></span>

                  </div>
                  
                </div> 

				<span style="color:#F00">*Fields Are Required</span>

				


              
              <!-- <input type="hidden" name="hidden_image" value="<?php echo @$home_content[0]->image; ?>"> -->
              <div id="error"></div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit"  class="btn btn-info pull-right" onclick="return form_validation()">Update</button>
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
<script src="<?php echo base_url();?>custom_script/mission_validation.js"></script>

<script type="text/javascript">
  function validation()
  {     


      if ($('#title').val()== "") 
      {
        $('#title').addClass('red_border');
      }
      else 
      {
        $('#title').removeClass('red_border');
      }


        if ($('#video_link').val()== "") 
      {
        $('#video_link').addClass('red_border');
      }
      else 
      {
        $('#video_link').removeClass('red_border');
      }




      

      

              
  }

    function form_validation()
    {
         $('#welcome_content_form').attr('onchange', 'validation()');
         $('#welcome_content_form').attr('onkeyup', 'validation()');
         $('#welcome_content_form').attr('onfocus', 'validation()');
         

              validation();

              if ($('#welcome_content_form .red_border').size() > 0)
              {
                $('#welcome_content_form .red_border:first').focus();
                return false;
              }
              else 
              {
                
              var content = tinymce.get('content').getContent();
              if (!isNull(content)) 
                        {
          
              alert('Please Enter Description');
              return false;
              } 
              else 
              {
              $('#welcome_content_form').submit();
              }
              }
  }
 </script>     
 <script>
  function readURL(input)
    {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#prof_pic')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>       

            