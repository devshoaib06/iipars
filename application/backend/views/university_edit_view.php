

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Institute
        
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
              <h3 class="box-title">Institute Edit</h3>
            <div id="validation" style="color:red;"></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url();?>index.php/admin_service/edit_university_action" method="post" id="examination_add"  onsubmit="return log_val()" >
              <div class="box-body">
              
             

              
               
               <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Service Provider</label>

                  <div class="col-sm-10">
                    <select class="form-control" id="examination_type" name="examination_type" required="">
                      <option value="">--Select Service Provider--</option>
                      <?php
                      foreach ($examination_type1 as $row) { ?>
                         <option value="<?php echo $row->cc_id; ?>" <?php if(@$examination_type[0]->university_type==$row->cc_id) {  echo 'selected';} ?>><?php echo $row->cc_name; ?></option>
                      <?php } ?>

                    </select>
                  </div>
                 
              </div>



                  <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Subjects</label>

                  <div class="col-sm-10">
                    <select class="form-control select2" id="subjects" name="subjects[]" required="" multiple="multiple" data-placeholder="Select Subjects">
                      <option value="">--Select  Subjects--</option>
                      
                        <?php foreach($subject_list as $row) {

                          $subject = $this->common->select($table_name='tbl_subject_for_inst',$field=array(), $where=array('subject_id'=>$row->kpo_id,'inst_id'=>@$examination_type[0]->university_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

                         ?>
                         <option value="<?php echo $row->kpo_id; ?>"<?php if(@$subject[0]->subject_id==$row->kpo_id) { echo 'selected';}?>><?php echo $row->kpo_name; ?></option>
                      <?php }  ?>

                    </select>
                  </div>
                 
              </div>

               <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Institute</label>

                  <div class="col-sm-10">
                    <input type="text" name="examination" value="<?php echo @$examination_type[0]->university; ?>"  id="examination" class="form-control" placeholder="Institute Name" >
                     <span id="error_catname" style="color:red"></span>
                  </div>
                 
              </div>
               
      

               <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Website Link</label>

                  <div class="col-sm-10">
                    <input type="text" name="website_address" value="<?php echo @$examination_type[0]->website_address; ?>" id="website" class="form-control" placeholder="Website Link" >
                    
                  </div>
                 
              </div>
                
                
              </div>
             
             
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url();?>index.php/admin_service/university_view" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-info pull-right" onclick="return subAdminAdd()">Submit</button>
              </div>
              <!-- /.box-footer -->

              <input type="hidden" name="exam_id" value="<?php echo @$examination_type[0]->university_id; ?>">
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
  

        var examination = $('#examination').val();
        if (!isNull(examination)) 
        {
          $('#examination').removeClass('black_border').addClass('red_border');

           $("#examination").attr("data-toggle", "tooltip");
                $("#examination").attr("data-placement", "bottom");
                document.getElementById('examination').title = 'University Name Is Required';
                $('#examination').tooltip('show');
        } 
        else 
        {
          $('#examination').removeClass('red_border').addClass('black_border');

           document.getElementById('examination').title = '';
                $('#examination').tooltip('destroy');
        }

        var examination_type = $('#examination_type').val();
        if (!isNull(examination_type)) 
        {
          $('#examination_type').removeClass('black_border').addClass('red_border');

            $("#examination_type").attr("data-toggle", "tooltip");
                $("#examination_type").attr("data-placement", "bottom");
                document.getElementById('examination_type').title = 'University Type Is Required';
                $('#examination_type').tooltip('show');
        } 
        else 
        {
          $('#examination_type').removeClass('red_border').addClass('black_border');

          document.getElementById('examination_type').title = '';
                $('#examination_type').tooltip('destroy');
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








 
