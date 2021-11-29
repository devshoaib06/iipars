

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        ADD Video Gallery
        
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
       <?php if($this->session->flashdata('message')) { ?> 
        <table class="table table-striped table-bordered bootstrap-datatable ">
          <tr>
            <td width="100%" colspan="2" style=" text-align:center"><span style="color:#F00"><?php echo $this->session->flashdata('message'); ?></span></td>
          </tr>
        </table>
         <?php } ?>
      <div class="row">
        <!-- left column -->
        
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Video Gallery Add</h3>
            <div id="validation" style="color:red;"></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/manage_video_category/add_video_gallery_action" method="post" id="examination_add"  onsubmit="return log_val()" >
              <div class="box-body">
              
             

              
               
               <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Video Gallery Category</label>

                  <div class="col-sm-10">
                    <select class="form-control" id="video_category" name="video_category" required="">
                      <option value="">--Select Category--</option>
                      <?php
                      foreach ($video_category as $row) { ?>
                         <option value="<?php echo $row->video_category_id; ?>"><?php echo $row->video_category; ?></option>
                      <?php } ?>

                    </select>
                  </div>
                 
              </div>

               <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Video Gallery Image (647 X 558)</label>

                  <div class="col-sm-10">
                    <!-- <input type="text" name="examination" required="" id="examination" class="form-control" placeholder="Service Name" > -->
                    <input type="file" id="gallery_image" name="gallery_image" class="form-control">
                     <span id="error_catname" style="color:red"></span>
                  </div>
                 
              </div>


              <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Video Gallery Link</label>

                  <div class="col-sm-10">
                    <input type="text" name="video_galary_link" required="" id="video_galary_link" class="form-control" placeholder="Video Gallery Link" >
                    
                     <span id="error_catname" style="color:red"></span>
                  </div>
                 
              </div>
               
      

              
                
                
              </div>
             
             
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url();?>index.php/manage_video_category/video_gallery_view" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-info pull-right" onclick="return subAdminAdd()">Submit</button>
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
 <script type="text/javascript" src="<?php echo base_url(); ?>custom_script/sub_admin_form_validation.js" ></script> 
<script src="<?php echo base_url();?>custom_script/validation_rulse.js"></script>
<script src="<?php echo base_url();?>custom_script/setting_validation.js"></script>
<style type="text/css">
.red_border
{
  border:1px solid red !important; 
}

.error
{
  color:red;
}


 </style>

 <script type="text/javascript">
   function add_role_validate()
{
  

        var video_category = $('#video_category').val();
        if (!isNull(video_category)) 
        {
          $('#video_category').removeClass('black_border').addClass('red_border');

           $("#video_category").attr("data-toggle", "tooltip");
                $("#video_category").attr("data-placement", "bottom");
                document.getElementById('video_category').title = 'Gallery Category Is Required';
                $('#video_category').tooltip('show');
        } 
        else 
        {
          $('#video_category').removeClass('red_border').addClass('black_border');

           document.getElementById('video_category').title = '';
                $('#video_category').tooltip('destroy');
        }

        var gallery_image = $('#gallery_image').val();
        if (!isNull(gallery_image)) 
        {
          $('#gallery_image').removeClass('black_border').addClass('red_border');

            $("#gallery_image").attr("data-toggle", "tooltip");
                $("#gallery_image").attr("data-placement", "bottom");
                document.getElementById('gallery_image').title = 'Gallery Image Is Required';
                $('#gallery_image').tooltip('show');
        } 
        else 
        {
          $('#gallery_image').removeClass('red_border').addClass('black_border');

          document.getElementById('gallery_image').title = '';
                $('#gallery_image').tooltip('destroy');
        }

        var video_galary_link = $('#video_galary_link').val();
        if (!isNull(video_galary_link)) 
        {
          $('#video_galary_link').removeClass('black_border').addClass('red_border');

            $("#video_galary_link").attr("data-toggle", "tooltip");
                $("#video_galary_link").attr("data-placement", "bottom");
                document.getElementById('video_galary_link').title = 'Gallery Link Is Required';
                $('#video_galary_link').tooltip('show');
        } 
        else 
        {
          $('#video_galary_link').removeClass('red_border').addClass('black_border');

          document.getElementById('video_galary_link').title = '';
                $('#video_galary_link').tooltip('destroy');
        }

}
 function subAdminAdd()
 {
    $('#examination_add').attr('onchange', 'add_role_validate()');
    $('#examination_add').attr('onkeyup', 'add_role_validate()');

     add_role_validate();
    //alert($('#contact_form .red_border').size());

    if ($('#examination_add .red_border').size() > 0)
    {
      $('#examination_add .red_border:first').focus();
      $('#examination_add .alert-error').show();
      return false;
    } else {

      $('#examination_add').submit();
    }

 }


 </script>








 
