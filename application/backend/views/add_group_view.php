

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        ADD Group
        
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
              <h3 class="box-title">Group Add</h3>
            <div id="validation" style="color:red;"></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url();?>index.php/admin_cc/add_group_action" method="post" id="group_form">
              <div class="box-body">
              
            
              
               
               
                 <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Group Name<span style="color:red">*</span></label>

                  <div class="col-sm-9">
                    <input type="text" name="group" required="" id="group" class="form-control" placeholder="Group Name" >
                     <span id="error_catname" style="color:red"></span>
                  </div>
                 
              </div>

              <div class="clearfix"></div><br><br>

               <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label"> Medicine<span style="color:red">*</span></label></label> 
                  <div class="col-sm-9">
                     <div id="div_med">
                    <select  class="form-control select2" name="medicine[]" id="medicine" multiple required="">
                     
                      
                         <?php
                           foreach($medicine as $row){

                            ?>

                       <option value="<?php echo $row->medicine_id; ?>" ><?php echo $row->medicine_name; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                    </div>
                  </div>
                 
                </div>

      

              
                
                
              </div>
             
             
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url();?>index.php/admin_cc/group_view" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-info pull-right" onclick="return validate_form()">Submit</button>
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
 <script src="<?php echo base_url();?>plugins/select2/select2.full.min.js"></script>
 <script src="<?php echo base_url();?>assets/js/jquery.multiselect.js"></script>


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
 function group_validate()
{
  

        var group = $('#group').val();
        if (!isNull(group)) 
        {
          $('#group').removeClass('black_border').addClass('red_border');

           $("#group").attr("data-toggle", "tooltip");
                $("#group").attr("data-placement", "bottom");
                document.getElementById('group').title = 'Group Name Is Required';
                $('#group').tooltip('show');
        } 
        else 
        {
          $('#group').removeClass('red_border').addClass('black_border');

           document.getElementById('group').title = '';
                $('#group').tooltip('destroy');
        }

         var options = $('#medicine > option:selected');
         if(options.length == 0)
              {
               $('#div_med').removeClass('black_border').addClass('red_border');

                 $("#div_med").attr("data-toggle", "tooltip");
                $("#div_med").attr("data-placement", "bottom");
                document.getElementById('div_med').title = 'Choose Medicine';
                $('#div_med').tooltip('show');
              }
              else{
               $('#div_med').removeClass('red_border').addClass('black_border');

                document.getElementById('div_med').title = '';
                $('#div_med').tooltip('destroy');

              }

      

}
 function validate_form()
 {
    $('#group_form').attr('onchange', 'group_validate()');
    $('#group_form').attr('onkeyup', 'group_validate()');

     group_validate();
    //alert($('#contact_form .red_border').size());

    if ($('#group_form .red_border').size() > 0)
    {
      $('#group_form .red_border:first').focus();
      $('#group_form .alert-error').show();
      return false;
    } else {

      $('#group_form').submit();
    }

 }

 </script>






 
