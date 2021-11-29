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
         Book  Appointment
        <small >
         <b> <?php echo date('jS M Y', strtotime($appointment_date)).', '.$appointment_time; ?></b>
        </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
     
        <li class="active">Book Appointment</li>
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
            
            <form name="form" id="client_form" class="form-horizontal form" action="<?php echo base_url();?>index.php/appointmentslist/book_new_action" method="post" enctype="multipart/form-data">
              <div class="box-body">

            <div class="form-heading">
              <h4>PATIENT DETAILS</h4>
            </div>

               <div class="form-group">
                  <label class="col-sm-3 control-label">First Name<span style="color: rgb(255, 0, 0); padding-left: 2px;"></span></label>

                  <div class="col-sm-6">
                  <input type="name" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
                  
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Last Name<span style="color: rgb(255, 0, 0); padding-left: 2px;"></span></label>

                  <div class="col-sm-6">
                  <input type="name" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
                  
                  </div>
                </div>

                 <div class="form-group">
                  <label class="col-sm-3 control-label">Mobile No.<span style="color: rgb(255, 0, 0); padding-left: 2px;"></span></label>

                  <div class="col-sm-6">
                  <input type="name" class="form-control" id="contact_no" name="contact_no" placeholder="Mobile No." required>
                  
                  </div>
                </div> 

                 <div class="form-group">
                  <label class="col-sm-3 control-label">E-Mail</label>

                  <div class="col-sm-6">
                  <input type="name" class="form-control" id="email" name="email" placeholder="E-Mail">
                   <input type="hidden" class="form-control" id="appointment_date" name="appointment_date" value="<?php echo $appointment_date; ?>">
                    <input type="hidden" class="form-control" id="appointment_time" name="appointment_time" value="<?php echo $appointment_time; ?>">
                  </div>
                </div>


              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url();?>index.php/appointmentslist/today" class="btn btn-danger"><i class="fa fa-backward"></i> Back</a>
                <button type="submit" class="btn btn-info pull-right" >Submit</button>
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



