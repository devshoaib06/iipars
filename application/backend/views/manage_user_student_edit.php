

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage User Edit
        
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
              <h3 class="box-title">Manage User Edit</h3>
            <div id="validation" style="color:red;"></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url();?>index.php/Manage_user_student/edit_action_user_student" method="post"  >
            <input type="hidden" value="<?php echo @$user_details[0]->user_id; ?>" name="hidden_id">
              <div class="box-body">
              


              
               
             <!--   <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Diagnosis Type</label>

                  <div class="col-sm-10">
                    <select class="form-control" id="diagnosis_name1" name="diagnosis_name1" required="">
                      <option value="">--Select Diagnosis Type--</option>
                      <?php
                      foreach ($diagnosis_list as $row) { ?>
                         <option <?php if($row->diagnosis_id==@$councelling[0]->diagnosis_id) { echo 'selected'; } ?> value="<?php echo $row->diagnosis_id; ?>"><?php echo $row->diagnosis_name; ?></option>
                      <?php } ?>

                    </select>
                  </div>
                 
              </div> -->


                            <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-10">
                    <input type="text" name="fname" required="" id="fname" class="form-control" placeholder="Name" value="<?php echo @$user_details[0]->first_name; ?>">
                     
                  </div>
                 
              </div>



                         <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    <input type="text" name="email" required="" id="email" class="form-control" placeholder="Email" value="<?php echo @$user_details[0]->login_email; ?>">
                     
                  </div>
                 
              </div>


                        <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Mobile</label>

                  <div class="col-sm-10">
                    <input type="text" name="mobile" required="" id="mobile" class="form-control" placeholder="Mobile" value="<?php echo @$user_details[0]->mobile; ?>">
                     
                  </div>
                 
              </div>

              <?php 

              $subject= $this->common->select($table_name='tbl_kpo',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array());


               ?>


                  <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Subject</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="subject">
                      <option>Choose Subject</option>
                      <?php foreach($subject as $sub) { ?>
                        <option value="<?php echo $sub->kpo_id; ?>"<?php if($sub->kpo_id==@$user_details[0]->subject_id){echo 'selected';} ?>><?php echo $sub->kpo_name; ?></option>
                      <?php } ?>
                    </select>
                     
                  </div>
                 
              </div>
               
      

              
                
                
              </div>
             
             
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url();?>index.php/Manage_user_student/" class="btn btn-danger">Cancel</a>
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


 
