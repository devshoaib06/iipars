<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker({
      dateFormat: 'dd/mm/yy',
       changeMonth: true,
    changeYear: true
      });
    
      } );

  </script>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         New Appointment
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
     
        <li class="active">New Appointment</li>
      </ol>
    </section>

  <!-- Main content -->
    <section class="content">
      <!-- ////////////////////////////////////////////////////////////////////////////////// -->
      <div class="row">

  

        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div style="padding-left: 12px;"><?php echo $this->session->flashdata('msg'); ?> </div>
            
            <form name="form" id="client_form" class="form-horizontal form" action="<?php echo base_url();?>index.php/appointmentslist/process" method="post" enctype="multipart/form-data">
              <div class="box-body">


<div class="panel panel-default">
<div style="margin:10px; padding:10px;">
  <div class="form-heading">
   <h4>BOKING DETAILS </h4>
 </div>                            
            
           <div class="form-group">
                  <label class="col-sm-3 control-label">Appointment Date<span style="color: rgb(255, 0, 0); padding-left: 2px;"></span></label>

                  <div class="col-sm-6">
                  <input type="text" class="form-control" id="app_date" name="app_date" placeholder="mm/dd/yyyy " value="<?php echo $appointment_date; ?>" readonly>
                  
                  </div>
                </div>


           <div class="form-group">
                  <label class="col-sm-3 control-label">Appointment Time<span style="color: rgb(255, 0, 0); padding-left: 2px;"></span></label>

                  <div class="col-sm-6">
                   <select name="app_time" id="app_time" class="form-control" required>
                    <option value=''>Choose time</option>
                    <?php
                        foreach($appnt_time as $t_slot)
                          {
                              $start_time= $t_slot->start_time;
                              $end_time= $t_slot->end_time;
                              $start= strtotime($start_time);
                              $end= strtotime($end_time);
                              $appontment_date= $appointment_details[0]->appointment_date;
                              for ($i=$start;$i<=$end;$i = $i + 15*60)
                                {

                                     $app_time= date('g:i A',$i);
                                     $check_booking= $this->common->check_book_availivity($app_time, $appontment_date); 
                                                   //echo count($check_booking);
                                           ?>
                      <option value="<?php  echo date('g:i A',$i); ?>" <?php if(count($check_booking) > 0) { ?> disabled <?php } ?>><?php  echo date('g:i A',$i); ?></option>
                      <?php 
                    }
                  }?>
                    </select>
                  </div>
                </div> 


           <div class="form-group">
                  <label class="col-sm-3 control-label">Nature of Visit<span style="color: rgb(255, 0, 0); padding-left: 2px;"></span></label>

                  <div class="col-sm-6">
                   <select name="nature_visit" name="nature_visit" class="form-control" >
                      <option value="first_time" >First time visit</option>
                      <option value="follow_up" >Follow up visit</option>
                    </select>
                  </div>
                </div> 
          </div>


              <span style="float:right; color: rgb(255, 0, 0); padding-right: 2px;"></span>
              </div>


    <div class="form-heading">
      <h4>PATIENT DETAILS</h4>
    </div>

               <div class="form-group">
                  <label class="col-sm-3 control-label">First Name<span style="color: rgb(255, 0, 0); padding-left: 2px;"></span></label>

                  <div class="col-sm-6">
                  <input type="name" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="" required>
                  
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Last Name<span style="color: rgb(255, 0, 0); padding-left: 2px;"></span></label>

                  <div class="col-sm-6">
                  <input type="name" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="" required>
                  
                  </div>
                </div>

                 <div class="form-group">
                  <label class="col-sm-3 control-label">Mobile No.<span style="color: rgb(255, 0, 0); padding-left: 2px;"></span></label>

                  <div class="col-sm-6">
                  <input type="name" class="form-control" id="contact_no" name="contact_no" placeholder="Mobile No." value="" required>
                  
                  </div>
                </div> 

                 <div class="form-group">
                  <label class="col-sm-3 control-label">E-Mail</label>

                  <div class="col-sm-6">
                  <input type="name" class="form-control" id="email" name="email" placeholder="E-Mail" value="" required>
                  </div>
                </div>


              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url();?>index.php/appointmentslist/book_appointment" class="btn btn-danger">Back</a>
                <button type="submit" class="btn btn-info pull-right" >Book Now</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
         
        </div>
        <!--/.col (right) -->
      </div>
      <!-- ////////////////////////////////////////////////////////////////////////////////// -->
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>



