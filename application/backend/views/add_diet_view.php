

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        ADD Diet
        
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
              <h3 class="box-title">Diet Add</h3>
            <div id="validation" style="color:red;"></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url();?>index.php/admin_cc/add_diet_action" method="post" id="examination_add">
              <div class="box-body">
              
            
              
               
            <!--    <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Diagnosis Type</label>

                  <div class="col-sm-10">
                    <select class="form-control" id="diagnosis_name" name="diagnosis_name" required="">
                      <option value="">--Select Diagnosis Type--</option>
                      <?php
                      foreach ($diagnosis_list as $row) { ?>
                         <option value="<?php echo $row->diagnosis_id; ?>"><?php echo $row->diagnosis_name; ?></option>
                      <?php } ?>

                    </select>
                  </div>
                 
              </div> -->
                 <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Diet Name</label>

                  <div class="col-sm-10">
                    <input type="text" name="diet" required="" id="diet" class="form-control" placeholder="Diet Name" >
                     <span id="error_catname" style="color:red"></span>
                  </div>
                 
              </div>

      

              
                
                
              </div>
             
             
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url();?>index.php/admin_cc/diet_view" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-info pull-right" onclick=" return subAdminAdd()" >Submit</button>
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
  

        var diagnosis_name = $('#diagnosis_name').val();
        if (!isNull(diagnosis_name)) 
        {
          $('#diagnosis_name').removeClass('black_border').addClass('red_border');

           $("#diagnosis_name").attr("data-toggle", "tooltip");
                $("#diagnosis_name").attr("data-placement", "bottom");
                document.getElementById('diagnosis_name').title = 'Diagonisis Name Is Required';
                $('#diagnosis_name').tooltip('show');
        } 
        else 
        {
          $('#diagnosis_name').removeClass('red_border').addClass('black_border');

           document.getElementById('diagnosis_name').title = '';
                $('#diagnosis_name').tooltip('destroy');
        }

        var diet = $('#diet').val();
        if (!isNull(diet)) 
        {
          $('#diet').removeClass('black_border').addClass('red_border');

           $("#diet").attr("data-toggle", "tooltip");
                $("#diet").attr("data-placement", "bottom");
                document.getElementById('diet').title = 'Choose Diet';
                $('#diet').tooltip('show');
        } 
        else 
        {
          $('#diet').removeClass('red_border').addClass('black_border');

          document.getElementById('diet').title = '';
                $('#diet').tooltip('destroy');
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


 
