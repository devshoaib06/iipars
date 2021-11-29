<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
 

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
            
            <form name="form" id="book_appo_form" class="form-horizontal form" action="<?php echo base_url();?>index.php/appointmentslist/booking_details" method="post" enctype="multipart/form-data">
              <div class="box-body">


    

<div class="panel panel-default">
<div style="">
 <!--  <div class="form-heading">
   <h4>Appointment Date</h4>
 </div> -->                            
            
           <div class="form-group">
                 

                  <div class="col-sm-6">
                  <input type="hidden" class="form-control" id="app_date" name="app_date" placeholder="mm/dd/yyyy " value="">
                 
                  </div>
                  
                </div>


           
                <div class="" id="timeScheduleWrapper" >
                    <h3>Pick a date for appointment below</h3>
                    <div class="form-group">
                     
                        <div id="datepicker-app"></div>
                    </div>
                   

                </div>

                <script>
              
                  $( function() {
                    $( "#datepicker-app" ).datepicker({ minDate: -0, maxDate: "+4M",
                                                         onSelect: function(dateStr)
                                                        {
                                                            $( "#app_date" ).val(dateStr);
                                                            $("#book_appo_form").submit();


                                                        }
                                                    });
                  } );

                  
                  </script>


          </div>


              <span style="float:right; color: rgb(255, 0, 0); padding-right: 2px;"></span>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url();?>index.php/admin_appointment/my_appointments" class="btn btn-danger">Cancel</a>
                <!-- <button type="submit" class="btn btn-info pull-right" id="cont_sub" onclick="submit_appo_form()">Continue</button> -->
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

<script type="text/javascript">
function show_calendar()
{
  $("#timeScheduleWrapper").show();
}

$(document).ready(function(){
            $("#cont_sub").click(function(){
              var appdate= $("#datepicker-app").val();  
              $("#app_date").val(appdate);
            });
        });


function submit_appo_form()
{
  var appo_date=$("#datepicker-app").val();
  $("#app_date").val(appo_date);

  $("#book_appo_form").submit();
}
</script>

