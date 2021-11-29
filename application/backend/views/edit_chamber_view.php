

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        EDIT Chamber
        
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
              <h3 class="box-title">Chamber Edit</h3>
            <div id="validation" style="color:red;"></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url();?>index.php/admin_chamber/edit_chamber_action" method="post" id="chamber_form">
              <div class="box-body">
              
            <input type="hidden" name="chamber_id" value="<?php echo @$chamber[0]->chamber_id; ?>"></input>
              
               
               
                 <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Chamber Name<span style="color:red">*</span></label>

                  <div class="col-sm-10">
                    <input type="text" name="chamber" required="" id="chamber" class="form-control" placeholder="Chamber Name" value="<?php echo @$chamber[0]->chamber_name; ?>">
                     <span id="error_catname" style="color:red"></span>
                  </div>
                 
              </div>

              <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Chamber Address<span style="color:red">*</span></label>

                  <div class="col-sm-10">
                    <textarea type="text" name="chamber_address" required="" id="chamber_address" class="form-control" placeholder="chamber Address" >
                      
                        <?php echo @$chamber[0]->chamber_address; ?>
                    </textarea>
                     <span id="error_catname" style="color:red"></span>
                  </div>
                 
              </div>

              <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Contact Number<span style="color:red">*</span></label>

                  <div class="col-sm-10">
                    <input type="text" name="contact" required="" id="contact" class="form-control" maxlength="11" placeholder="Contact Number" value="<?php echo @$chamber[0]->chamber_phone; ?>"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                     <span id="error_catname" style="color:red"></span>
                  </div>
                 
              </div>

      

              
                
                
              </div>
              </form>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url();?>index.php/admin_chamber" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-info pull-right" onclick="return validate_form()">Submit</button>
              </div>
              <!-- /.box-footer -->
           
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
 function chamber_validate()
{
  

        var chamber = $('#chamber').val();
        if (!isNull(chamber)) 
        {
          $('#chamber').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#chamber').removeClass('red_border').addClass('black_border');
        }

         var chamber_address = $('#chamber_address').val();
        if (!isNull(chamber_address)) 
        {
          $('#chamber_address').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#chamber_address').removeClass('red_border').addClass('black_border');
        }

         var contact = $('#contact').val();
        if (!isNull(contact)) 
        {
          $('#contact').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#contact').removeClass('red_border').addClass('black_border');
        }

}
 function validate_form()
 {
    $('#chamber_form').attr('onchange', 'chamber_validate()');
    $('#chamber_form').attr('onkeyup', 'chamber_validate()');

     chamber_validate();
    //alert($('#contact_form .red_border').size());

    if ($('#chamber_form .red_border').size() > 0)
    {
      $('#chamber_form .red_border:first').focus();
      $('#chamber_form .alert-error').show();
      return false;
    } else {

      $('#chamber_form').submit();
    }

 }

 </script>






 
