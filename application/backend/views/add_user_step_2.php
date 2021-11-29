<?php 

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
     
              <small id="msg" style="color:red"></small>
              <p>
              <?php

                 if ($this->session->flashdata('flash_msg') != "") {
                    echo $this->session->flashdata('flash_msg');
                 }

              ?>
              </p>
           
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
            
            <!-- /.box-header -->
            
          <div class="box">
           <!--  <div class="box-header" style="text-align: center;">
              <h3 >Step 2 of doctor enrollment</h3>
              <h3 class="box-title" style="display: block;">Name: <?php echo $doctor_details[0]->full_name; ?></h3>
            
            </div> -->
            <!-- /.box-header -->

            <div class="box-body" style="text-align: center;">

               <div class="pdf_container" style="text-align: center;">
                  <object width="1050px" height="900px" data="<?php echo base_url('../assets/upload/invoice/admin/'.$inv_no .'.pdf') ?>"></object>
               </div>

               <a href="<?php echo base_url('../assets/upload/invoice/admin/'.$inv_no .'.pdf') ?>" class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i> Download PDF</a>
              <!--  <a href="<?php echo base_url('index.php/user_management/step_3/'.$doctor_details[0]->doctor_id) ?>" class="btn btn-primary">Continue <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a> -->
                      
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    </div>
    </div>
    

