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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        EDIT Employee
        
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
              <h3 class="box-title">Employee DETAILS</h3>
            <div id="validation" style="color:red;"></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url();?>index.php/sub_admin/sub_admin_edit_action" method="post" id="sub_admin_admin" >
              <div class="box-body">
              
              <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">First Name</label>

                  <div class="col-sm-10">
                    <input type="text" name="sub_admin_first_name" id="sub_admin_first_name" class="form-control" placeholder="Name" value="<?php echo $sub_admin_edit_details[0]->first_name; ?>">
                     <span id="error_catname" style="color:red"></span>
                  </div>
                 
              </div>
              <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">last Name</label>

                  <div class="col-sm-10">
                    <input type="text" name="sub_admin_last_name" id="sub_admin_last_name" class="form-control" placeholder="Name" value="<?php echo $sub_admin_edit_details[0]->last_name; ?>">
                     <span id="error_catname" style="color:red"></span>
                  </div>
                 
              </div>
             
               <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    <input type="text" name="sub_admin_email" id="sub_admin_email" class="form-control" placeholder="Email" value="<?php echo $sub_admin_edit_details[0]->login_email; ?>">
                     <span id="error_catname" style="color:red"></span>
                  </div>
                 
              </div>
               <!--<div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Role</label>

                  <div class="col-sm-10">
                   <select class="form-control" id="role_id" name="role_id">
                      <option value="0">--Select role--</option>
                      <?php
                      foreach ($roles as $row) { ?>
                         <option value="<?php echo $row->role_id; ?>" <?php if( $sub_admin_edit_details[0]->role_id == $row->role_id ) { echo "selected"; } ?>><?php echo $row->role_title; ?></option>
                      <?php } ?>

                    </select>
                  </div>
                 
              </div>-->
               <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="text" name="sub_admin_password" id="sub_admin_password" class="form-control" placeholder="Password " value="<?php echo $sub_admin_edit_details[0]->login_pass; ?>">
                     <span id="error_catname" style="color:red"></span>
                  </div>
                 
              </div>
<!-- 
 <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Confirm Password</label>

                  <div class="col-sm-10">
                    <input type="text" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" value="">
                     <span id="error_catname" style="color:red"></span>
                  </div>
                 
              </div> -->

              
                 <input type="hidden" id="id" name="id" value="<?php echo $sub_admin_edit_details[0]->user_id; ?>" />
                
              </div>
             
             
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url();?>index.php/sub_admin_list_manage" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-info pull-right" onclick="return subAdminAddEdit()">Submit</button>
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
<script type="text/javascript">
function subAdminAddEdit()
{
    //alert('ok');
    $('#sub_admin_admin').attr('onchange','sub_admin_validation()');
    $('#sub_admin_admin').attr('onkeyup','sub_admin_validation()');
    //var action='focus'; 
      sub_admin_validation()
    
    $('#sub_admin_full_name').trigger("focusout");      
    $('#user_name').trigger("focusout");
    $('#sub_admin_email').trigger("focusout");      
    $('#sub_admin_password').trigger("focusout");
    
    if ($('#sub_admin_admin .red_border').size()>0) 
    {
      $('#sub_admin_admin .red_border:first').focus();
       return false;
    }
    else
    {
       $("#sub_admin_admin").submit();
    } 
}
</script> 



  </script>

            