

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        EDIT Diet
        
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
              <h3 class="box-title">Diet Edit</h3>
            <div id="validation" style="color:red;"></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url();?>index.php/admin_cc/edit_diet_action" method="post"  >
            <input type="hidden" value="<?php echo @$diet[0]->diet_id; ?>" name="diet_id">
              <div class="box-body">
              


              
               
            <!--    <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Diagnosis Type</label>

                  <div class="col-sm-10">
                    <select class="form-control" id="diagnosis_name1" name="diagnosis_name1" required="">
                      <option value="">--Select Diagnosis Type--</option>
                      <?php
                      foreach ($diagnosis_list as $row) { ?>
                         <option <?php if($row->diagnosis_id==@$diet[0]->diagnosis_id) { echo 'selected'; } ?> value="<?php echo $row->diagnosis_id; ?>"><?php echo $row->diagnosis_name; ?></option>
                      <?php } ?>

                    </select>
                  </div>
                 
              </div> -->


                            <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Diet Name</label>

                  <div class="col-sm-10">
                    <input type="text" name="diet" required="" id="diet" class="form-control" placeholder="Diet Name" value="<?php echo @$diet[0]->diet_name; ?>">
                     <span id="error_catname" style="color:red"></span>
                  </div>
                 
              </div>
               
      

              
                
                
              </div>
             
             
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url();?>index.php/admin_cc/diet_view" class="btn btn-danger">Cancel</a>
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
  </div>
 <script type="text/javascript" src="<?php echo base_url(); ?>custom_script/sub_admin_form_validation.js" ></script> 
<script src="<?php echo base_url();?>custom_script/validation_rulse.js"></script>
<script src="<?php echo base_url();?>custom_script/setting_validation.js"></script>



  </script>


 
