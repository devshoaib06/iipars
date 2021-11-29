<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<style>
    .glowing-border-red{
        outline: none;
        border-color: #ff3333;
        /*box-shadow: 0 0 10px #ff3333;*/
    }
    .glowing-border-red-image{
        outline: none;
        border-color: #ff3333;
        box-shadow: 0 0 10px #ff3333;
    }
    .backend-check-day .col-sm-2{padding: 0;margin-bottom: 20px;}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
          Edit Unavailable Timing
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>index.php/admin_dashboard"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboard</a></li>
            <li class="active"></i>Edit Unavailable Timing</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                <div class="box-header">
                    <?php
                    if( $this->session->flashdata('msg'))
                        {
                            ?>
        <span class="box-title" style="color:green"><?php echo $this->session->flashdata('msg'); ?></span>
                        <?php
                    }
                    ?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body pad">
                        <form action="<?php echo base_url()?>index.php/admin_appointment/close_edit_action" class="form-horizontal" id="main" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                            <div class="clearfix"></div> 




                    <div id="time">
                        <div class="form-group"  id="form-group_0" style="margin-top: 10px;">
                            <div class="select-time-form padding-top-10 clearfix" >
                                <div class="col-sm-2">
                                    <label for="time" class="text-left control-label text-center">Unavailability Date</label>
                                </div> 
                                <div class="col-sm-10 clearfix">  
                                <div class="col-sm-7">
                                  <input type="text" class="form-control fromdate" name="close_start_date" id="fromdate" style="margin-bottom: 20px" placeholder="Closing Date:yyyy-mm-dd" required="" value="<?php echo $edit_data[0]->close_start_date; ?>">
                                </div>
                                
                            </div>
                    </div>
                            <div class="select-time-form clearfix">
                                <div class="col-sm-2">
                                    <label for="time" class="text-left control-label text-center">Unavailability Time</label>
                                </div> 
                                <div class="col-sm-7 clearfix">  
                                <div class="col-sm-4">
                                <input type="hidden" name="hiddenid" value="<?php echo $edit_data[0]->id; ?>">
                                    <select class="form-control" name="start_time" id="start_time" required>
                                        <option value="">Start Time</option>
                                        <option value="08:00 AM" <?php if($edit_data[0]->close_start_time=='08:00 AM'){ echo 'selected'; } ?>>08:00 AM</option>
                                        <option value="08:15 AM" <?php if($edit_data[0]->close_start_time=='08:15 AM'){ echo 'selected'; } ?>>08:15 AM</option>
                                        <option value="08:30 AM" <?php if($edit_data[0]->close_start_time=='08:30 AM'){ echo 'selected'; } ?>>08:30 AM</option>
                                        <option value="08:45 AM" <?php if($edit_data[0]->close_start_time=='08:45 AM'){ echo 'selected'; } ?>>08:45 AM</option>
                                        <option value="09:00 AM" <?php if($edit_data[0]->close_start_time=='09:00 AM'){ echo 'selected'; } ?>>09:00 AM</option>
                                        <option value="09:15 AM" <?php if($edit_data[0]->close_start_time=='09:15 AM'){ echo 'selected'; } ?>>09:15 AM</option>
                                        <option value="09:30 AM" <?php if($edit_data[0]->close_start_time=='09:30 AM'){ echo 'selected'; } ?>>09:30 AM</option>
                                        <option value="09:45 AM" <?php if($edit_data[0]->close_start_time=='09:45 AM'){ echo 'selected'; } ?>>09:45 AM</option>
                                        <option value="10:00 AM" <?php if($edit_data[0]->close_start_time=='10:00 AM'){ echo 'selected'; } ?>>10:00 AM</option>
                                        <option value="10:15 AM" <?php if($edit_data[0]->close_start_time=='10:15 AM'){ echo 'selected'; } ?>>10:15 AM</option>
                                        <option value="10:30 AM" <?php if($edit_data[0]->close_start_time=='10:30 AM'){ echo 'selected'; } ?>>10:30 AM</option>
                                        <option value="10:45 AM" <?php if($edit_data[0]->close_start_time=='10:45 AM'){ echo 'selected'; } ?>>10:45 AM</option>
                                        <option value="11:00 AM" <?php if($edit_data[0]->close_start_time=='11:00 AM'){ echo 'selected'; } ?>>11:00 AM</option>
                                        <option value="11:15 AM" <?php if($edit_data[0]->close_start_time=='11:15 AM'){ echo 'selected'; } ?>>11:15 AM</option>
                                        <option value="11:30 AM" <?php if($edit_data[0]->close_start_time=='11:30 AM'){ echo 'selected'; } ?>>11:30 AM</option>
                                        <option value="11:45 AM" <?php if($edit_data[0]->close_start_time=='11:45 AM'){ echo 'selected'; } ?>>11:45 AM</option>
                                        <option value="12:00 PM" <?php if($edit_data[0]->close_start_time=='12:00 PM'){ echo 'selected'; } ?>>12:00 PM</option>
                                        <option value="12:15 PM" <?php if($edit_data[0]->close_start_time=='12:15 PM'){ echo 'selected'; } ?>>12:15 PM</option>
                                        <option value="12:30 PM" <?php if($edit_data[0]->close_start_time=='12:30 PM'){ echo 'selected'; } ?>>12:30 PM</option>
                                        <option value="12:45 PM" <?php if($edit_data[0]->close_start_time=='12:45 PM'){ echo 'selected'; } ?>>12:45 PM</option>
                                        <option value="01:00 PM" <?php if($edit_data[0]->close_start_time=='01:00 PM'){ echo 'selected'; } ?>>01:00 PM</option>
                                        <option value="01:15 PM" <?php if($edit_data[0]->close_start_time=='01:15 PM'){ echo 'selected'; } ?>>01:15 PM</option>
                                        <option value="01:30 PM" <?php if($edit_data[0]->close_start_time=='01:30 PM'){ echo 'selected'; } ?>>01:30 PM</option>
                                        <option value="01:45 PM" <?php if($edit_data[0]->close_start_time=='01:45 PM'){ echo 'selected'; } ?>>01:45 PM</option>
                                        <option value="02:00 PM" <?php if($edit_data[0]->close_start_time=='02:00 PM'){ echo 'selected'; } ?>>02:00 PM</option>
                                        <option value="02:15 PM" <?php if($edit_data[0]->close_start_time=='02:15 PM'){ echo 'selected'; } ?>>02:15 PM</option>
                                        <option value="02:30 PM" <?php if($edit_data[0]->close_start_time=='02:30 PM'){ echo 'selected'; } ?>>02:30 PM</option>
                                        <option value="02:45 PM" <?php if($edit_data[0]->close_start_time=='02:45 PM'){ echo 'selected'; } ?>>02:45 PM</option>
                                        <option value="03:00 PM" <?php if($edit_data[0]->close_start_time=='03:00 PM'){ echo 'selected'; } ?>>03:00 PM</option>
                                        <option value="03:15 PM" <?php if($edit_data[0]->close_start_time=='03:15 PM'){ echo 'selected'; } ?>>03:15 PM</option>
                                        <option value="03:30 PM" <?php if($edit_data[0]->close_start_time=='03:30 PM'){ echo 'selected'; } ?>>03:30 PM</option>
                                        <option value="03:45 PM" <?php if($edit_data[0]->close_start_time=='03:45 PM'){ echo 'selected'; } ?>>03:45 PM</option>
                                        <option value="04:00 PM" <?php if($edit_data[0]->close_start_time=='04:00 PM'){ echo 'selected'; } ?>>04:00 PM</option>
                                        <option value="04:15 PM" <?php if($edit_data[0]->close_start_time=='04:15 PM'){ echo 'selected'; } ?>>04:15 PM</option>
                                        <option value="04:30 PM" <?php if($edit_data[0]->close_start_time=='04:30 PM'){ echo 'selected'; } ?>>04:30 PM</option>
                                        <option value="04:45 PM" <?php if($edit_data[0]->close_start_time=='04:45 PM'){ echo 'selected'; } ?>>04:45 PM</option>
                                        <option value="05:00 PM" <?php if($edit_data[0]->close_start_time=='05:00 PM'){ echo 'selected'; } ?>>05:00 PM</option>
                                        <option value="05:15 PM" <?php if($edit_data[0]->close_start_time=='05:15 PM'){ echo 'selected'; } ?>>05:15 PM</option>
                                        <option value="05:30 PM" <?php if($edit_data[0]->close_start_time=='05:30 PM'){ echo 'selected'; } ?>>05:30 PM</option>
                                        <option value="05:45 PM" <?php if($edit_data[0]->close_start_time=='05:45 PM'){ echo 'selected'; } ?>>05:45 PM</option>
                                        <option value="06:00 PM" <?php if($edit_data[0]->close_start_time=='06:00 PM'){ echo 'selected'; } ?>>06:00 PM</option>
                                        <option value="06:15 PM" <?php if($edit_data[0]->close_start_time=='06:15 PM'){ echo 'selected'; } ?>>06:15 PM</option>
                                        <option value="06:30 PM" <?php if($edit_data[0]->close_start_time=='06:30 PM'){ echo 'selected'; } ?>>06:30 PM</option>
                                        <option value="06:45 PM" <?php if($edit_data[0]->close_start_time=='06:45 PM'){ echo 'selected'; } ?>>06:45 PM</option>
                                        <option value="07:00 PM" <?php if($edit_data[0]->close_start_time=='07:00 PM'){ echo 'selected'; } ?>>07:00 PM</option>
                                        <option value="07:15 PM" <?php if($edit_data[0]->close_start_time=='07:15 PM'){ echo 'selected'; } ?>>07:15 PM</option>
                                        <option value="07:30 PM" <?php if($edit_data[0]->close_start_time=='07:30 PM'){ echo 'selected'; } ?>>07:30 PM</option>
                                        <option value="07:45 PM" <?php if($edit_data[0]->close_start_time=='07:45 PM'){ echo 'selected'; } ?>>07:45 PM</option>
                                        <option value="08:00 PM" <?php if($edit_data[0]->close_start_time=='08:00 PM'){ echo 'selected'; } ?>>08:00 PM</option>
                                        <option value="08:15 PM" <?php if($edit_data[0]->close_start_time=='08:15 PM'){ echo 'selected'; } ?>>08:15 PM</option>
                                        <option value="08:30 PM" <?php if($edit_data[0]->close_start_time=='08:30 PM'){ echo 'selected'; } ?>>08:30 PM</option>
                                        <option value="08:45 PM" <?php if($edit_data[0]->close_start_time=='08:45 PM'){ echo 'selected'; } ?>>08:45 PM</option>
                                        <option value="09:00 PM" <?php if($edit_data[0]->close_start_time=='09:00 PM'){ echo 'selected'; } ?>>09:00 PM</option>
                                        <option value="09:15 PM" <?php if($edit_data[0]->close_start_time=='09:15 PM'){ echo 'selected'; } ?>>09:15 PM</option>
                                        <option value="09:30 PM"<?php if($edit_data[0]->close_start_time=='09:30 PM'){ echo 'selected'; } ?> >09:30 PM</option>
                                        <option value="09:45 PM" <?php if($edit_data[0]->close_start_time=='09:45 PM'){ echo 'selected'; } ?>>09:45 PM</option>
                                        <option value="10:00 PM" <?php if($edit_data[0]->close_start_time=='10:00 PM'){ echo 'selected'; } ?>>10:00 PM</option>
                                    </select>
                                </div>
                                <div class="col-sm-1 text-center">To</div>
                                <div class="col-sm-4">
                                    <select class="form-control" name="end_time" id="end_time" required>
                                        <option value="">End Time</option>
                                        <option value="08:00 AM" <?php if($edit_data[0]->close_end_time=='08:00 AM'){ echo 'selected'; } ?>>08:00 AM</option>
                                        <option value="08:15 AM" <?php if($edit_data[0]->close_end_time=='08:15 AM'){ echo 'selected'; } ?>>08:15 AM</option>
                                        <option value="08:30 AM" <?php if($edit_data[0]->close_end_time=='08:30 AM'){ echo 'selected'; } ?>>08:30 AM</option>
                                        <option value="08:45 AM" <?php if($edit_data[0]->close_end_time=='08:45 AM'){ echo 'selected'; } ?>>08:45 AM</option>
                                        <option value="09:00 AM" <?php if($edit_data[0]->close_end_time=='09:00 AM'){ echo 'selected'; } ?>>09:00 AM</option>
                                        <option value="09:15 AM" <?php if($edit_data[0]->close_end_time=='09:15 AM'){ echo 'selected'; } ?>>09:15 AM</option>
                                        <option value="09:30 AM" <?php if($edit_data[0]->close_end_time=='09:30 AM'){ echo 'selected'; } ?>>09:30 AM</option>
                                        <option value="09:45 AM" <?php if($edit_data[0]->close_end_time=='09:45 AM'){ echo 'selected'; } ?>>09:45 AM</option>
                                        <option value="10:00 AM" <?php if($edit_data[0]->close_end_time=='10:00 AM'){ echo 'selected'; } ?>>10:00 AM</option>
                                        <option value="10:15 AM" <?php if($edit_data[0]->close_end_time=='10:15 AM'){ echo 'selected'; } ?>>10:15 AM</option>
                                        <option value="10:30 AM" <?php if($edit_data[0]->close_end_time=='10:30 AM'){ echo 'selected'; } ?>>10:30 AM</option>
                                        <option value="10:45 AM" <?php if($edit_data[0]->close_end_time=='10:45 AM'){ echo 'selected'; } ?>>10:45 AM</option>
                                        <option value="11:00 AM" <?php if($edit_data[0]->close_end_time=='11:00 AM'){ echo 'selected'; } ?>>11:00 AM</option>
                                        <option value="11:15 AM" <?php if($edit_data[0]->close_end_time=='11:15 AM'){ echo 'selected'; } ?>>11:15 AM</option>
                                        <option value="11:30 AM" <?php if($edit_data[0]->close_end_time=='11:30 AM'){ echo 'selected'; } ?>>11:30 AM</option>
                                        <option value="11:45 AM" <?php if($edit_data[0]->close_end_time=='11:45 AM'){ echo 'selected'; } ?>>11:45 AM</option>
                                        <option value="12:00 PM" <?php if($edit_data[0]->close_end_time=='12:00 PM'){ echo 'selected'; } ?>>12:00 PM</option>
                                        <option value="12:15 PM" <?php if($edit_data[0]->close_end_time=='12:15 PM'){ echo 'selected'; } ?>>12:15 PM</option>
                                        <option value="12:30 PM" <?php if($edit_data[0]->close_end_time=='12:30 PM'){ echo 'selected'; } ?>>12:30 PM</option>
                                        <option value="12:45 PM" <?php if($edit_data[0]->close_end_time=='12:45 PM'){ echo 'selected'; } ?>>12:45 PM</option>
                                        <option value="01:00 PM" <?php if($edit_data[0]->close_end_time=='01:00 PM'){ echo 'selected'; } ?>>01:00 PM</option>
                                        <option value="01:15 PM" <?php if($edit_data[0]->close_end_time=='01:15 PM'){ echo 'selected'; } ?>>01:15 PM</option>
                                        <option value="01:30 PM" <?php if($edit_data[0]->close_end_time=='01:30 PM'){ echo 'selected'; } ?>>01:30 PM</option>
                                        <option value="01:45 PM" <?php if($edit_data[0]->close_end_time=='01:45 PM'){ echo 'selected'; } ?>>01:45 PM</option>
                                        <option value="02:00 PM" <?php if($edit_data[0]->close_end_time=='02:00 PM'){ echo 'selected'; } ?>>02:00 PM</option>
                                        <option value="02:15 PM" <?php if($edit_data[0]->close_end_time=='02:15 PM'){ echo 'selected'; } ?>>02:15 PM</option>
                                        <option value="02:30 PM" <?php if($edit_data[0]->close_end_time=='02:30 PM'){ echo 'selected'; } ?>>02:30 PM</option>
                                        <option value="02:45 PM" <?php if($edit_data[0]->close_end_time=='02:45 PM'){ echo 'selected'; } ?>>02:45 PM</option>
                                        <option value="03:00 PM" <?php if($edit_data[0]->close_end_time=='03:00 PM'){ echo 'selected'; } ?>>03:00 PM</option>
                                        <option value="03:15 PM" <?php if($edit_data[0]->close_end_time=='03:15 PM'){ echo 'selected'; } ?>>03:15 PM</option>
                                        <option value="03:30 PM" <?php if($edit_data[0]->close_end_time=='03:30 PM'){ echo 'selected'; } ?>>03:30 PM</option>
                                        <option value="03:45 PM" <?php if($edit_data[0]->close_end_time=='03:45 PM'){ echo 'selected'; } ?>>03:45 PM</option>
                                        <option value="04:00 PM" <?php if($edit_data[0]->close_end_time=='04:00 PM'){ echo 'selected'; } ?>>04:00 PM</option>
                                        <option value="04:15 PM" <?php if($edit_data[0]->close_end_time=='04:15 PM'){ echo 'selected'; } ?>>04:15 PM</option>
                                        <option value="04:30 PM" <?php if($edit_data[0]->close_end_time=='04:30 PM'){ echo 'selected'; } ?>>04:30 PM</option>
                                        <option value="04:45 PM" <?php if($edit_data[0]->close_end_time=='04:45 PM'){ echo 'selected'; } ?>>04:45 PM</option>
                                        <option value="05:00 PM" <?php if($edit_data[0]->close_end_time=='05:00 PM'){ echo 'selected'; } ?>>05:00 PM</option>
                                        <option value="05:15 PM" <?php if($edit_data[0]->close_end_time=='05:15 PM'){ echo 'selected'; } ?>>05:15 PM</option>
                                        <option value="05:30 PM" <?php if($edit_data[0]->close_end_time=='05:30 PM'){ echo 'selected'; } ?>>05:30 PM</option>
                                        <option value="05:45 PM" <?php if($edit_data[0]->close_end_time=='05:45 PM'){ echo 'selected'; } ?>>05:45 PM</option>
                                        <option value="06:00 PM" <?php if($edit_data[0]->close_end_time=='06:00 PM'){ echo 'selected'; } ?>>06:00 PM</option>
                                        <option value="06:15 PM" <?php if($edit_data[0]->close_end_time=='06:15 PM'){ echo 'selected'; } ?>>06:15 PM</option>
                                        <option value="06:30 PM" <?php if($edit_data[0]->close_end_time=='06:30 PM'){ echo 'selected'; } ?>>06:30 PM</option>
                                        <option value="06:45 PM" <?php if($edit_data[0]->close_end_time=='06:45 PM'){ echo 'selected'; } ?>>06:45 PM</option>
                                        <option value="07:00 PM" <?php if($edit_data[0]->close_end_time=='07:00 PM'){ echo 'selected'; } ?>>07:00 PM</option>
                                        <option value="07:15 PM" <?php if($edit_data[0]->close_end_time=='07:15 PM'){ echo 'selected'; } ?>>07:15 PM</option>
                                        <option value="07:30 PM" <?php if($edit_data[0]->close_end_time=='07:30 PM'){ echo 'selected'; } ?>>07:30 PM</option>
                                        <option value="07:45 PM" <?php if($edit_data[0]->close_end_time=='07:45 PM'){ echo 'selected'; } ?>>07:45 PM</option>
                                        <option value="08:00 PM" <?php if($edit_data[0]->close_end_time=='08:00 PM'){ echo 'selected'; } ?>>08:00 PM</option>
                                        <option value="08:15 PM" <?php if($edit_data[0]->close_end_time=='08:15 PM'){ echo 'selected'; } ?>>08:15 PM</option>
                                        <option value="08:30 PM" <?php if($edit_data[0]->close_end_time=='08:30 PM'){ echo 'selected'; } ?>>08:30 PM</option>
                                        <option value="08:45 PM" <?php if($edit_data[0]->close_end_time=='08:45 PM'){ echo 'selected'; } ?>>08:45 PM</option>
                                        <option value="09:00 PM" <?php if($edit_data[0]->close_end_time=='09:00 PM'){ echo 'selected'; } ?>>09:00 PM</option>
                                        <option value="09:15 PM" <?php if($edit_data[0]->close_end_time=='09:15 PM'){ echo 'selected'; } ?>>09:15 PM</option>
                                        <option value="09:30 PM"<?php if($edit_data[0]->close_end_time=='09:30 PM'){ echo 'selected'; } ?> >09:30 PM</option>
                                        <option value="09:45 PM" <?php if($edit_data[0]->close_end_time=='09:45 PM'){ echo 'selected'; } ?>>09:45 PM</option>
                                        <option value="10:00 PM" <?php if($edit_data[0]->close_end_time=='10:00 PM'){ echo 'selected'; } ?>>10:00 PM</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                   
            </div>
</div>
                <div class="clearfix"></div> 


               <!--  <div class="text-center"><a  onclick="add_more()" style="cursor: pointer"><i class="fa fa-plus" aria-hidden="true"></i> Add more time</a></div> -->





                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary pull-left" value="Set Timing" style="margin-top: 8px;margin-right:10px">
                                <a href="<?php echo base_url()?>index.php/admin_appointment/availability" class="btn btn-danger" style="margin-top: 8px;margin-left:10px">Cancel</a>

                                <input type="hidden" name="test[]" id="test" value="0">
                            </div>
                            <div class="clearfix"></div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</div>

<script>
    $( function() {
    $( "#fromdate" ).datepicker({dateFormat: 'yy-mm-dd'});
  } );
    
   
  </script>
  <script>
    $( function() {
    $( "#closedate" ).datepicker({dateFormat: 'yy-mm-dd'});
  } );
    
   
  </script>
<script>
    
function add_more()
{
         var count= $('#time').children('.form-group').length;
         //$("#test").val(count);

         //alert(count);

    $("#time").append('<div class=\"form-group\" id=\"form-group_'+count+'\" style=\"margin-top: 10px;\"> <div class=\"select-time-form clearfix\"> <div class=\"col-sm-2\"> <label for=\"time\" class=\"text-left control-label text-center\">Closing Timings</label> </div> <div class=\"col-sm-7 clearfix\"> <div class=\"col-sm-4\"> <select class=\"form-control\" name=\"start_time[]\" id=\"start_time\"> <option value="" required> Start Time</option> <option value=\"08:00 AM\" >08:00 AM</option> <option value=\"08:15 AM\" >08:15 AM</option> <option value=\"08:30 AM\" >08:30 AM</option> <option value=\"08:45 AM\" >08:45 AM</option> <option value=\"09:00 AM\" >09:00 AM</option> <option value=\"09:15 AM\" >09:15 AM</option> <option value=\"09:30 AM\" >09:30 AM</option> <option value=\"09:45 AM\" >09:45 AM</option> <option value=\"10:00 AM\">10:00 AM</option> <option value=\"10:15 AM\">10:15 AM</option> <option value=\"10:30 AM\" >10:30 AM</option> <option value=\"10:45 AM\" >10:45 AM</option> <option value=\"11:00 AM\" >11:00 AM</option> <option value=\"11:15 AM\" >11:15 AM</option> <option value=\"11:30 AM\" >11:30 AM</option> <option value=\"11:45 AM\" >11:45 AM</option> <option value=\"12:00 PM\" >12:00 PM</option> <option value=\"12:15 PM\" >12:15 PM</option> <option value=\"12:30 PM\" >12:30 PM</option> <option value=\"12:45 PM\" >12:45 PM</option> <option value=\"01:00 PM\" >01:00 PM</option> <option value=\"01:15 PM\" >01:15 PM</option> <option value=\"01:30 PM\" >01:30 PM</option> <option value=\"01:45 PM\" >01:45 PM</option> <option value=\"02:00 PM\" >02:00 PM</option> <option value=\"02:15 PM\" >02:15 PM</option> <option value=\"02:30 PM\" >02:30 PM</option> <option value=\"02:45 PM\" >02:45 PM</option> <option value=\"03:00 PM\" >03:00 PM</option> <option value=\"03:15 PM\" >03:15 PM</option> <option value=\"03:30 PM\" >03:30 PM</option> <option value=\"03:45 PM\" >03:45 PM</option> <option value=\"04:00 PM\" >04:00 PM</option> <option value=\"04:15 PM\" >04:15 PM</option> <option value=\"04:30 PM\" >04:30 PM</option> <option value=\"04:45 PM\" >04:45 PM</option> <option value=\"05:00 PM\" >05:00 PM</option> <option value=\"05:15 PM\" >05:15 PM</option> <option value=\"05:30 PM\" >05:30 PM</option> <option value=\"05:45 PM\" >05:45 PM</option> <option value=\"06:00 PM\" >06:00 PM</option> <option value=\"06:15 PM\" >06:15 PM</option> <option value=\"06:30 PM\" >06:30 PM</option> <option value=\"06:45 PM\" >06:45 PM</option> <option value=\"07:00 PM\" >07:00 PM</option> <option value=\"07:15 PM\" >07:15 PM</option> <option value=\"07:30 PM\" >07:30 PM</option> <option value=\"07:45 PM\" >07:45 PM</option> <option value=\"08:00 PM\" >08:00 PM</option> <option value=\"08:15 PM\" >08:15 PM</option> <option value=\"08:30 PM\" >08:30 PM</option> <option value=\"08:45 PM\" >08:45 PM</option> <option value=\"09:00 PM\" >09:00 PM</option> <option value=\"09:15 PM\" >09:15 PM</option> <option value=\"09:30 PM\" >09:30 PM</option> <option value=\"09:45 PM\" >09:45 PM</option> <option value=\"10:00 PM\" >10:00 PM</option> </select> </div> <div class=\"col-sm-1 text-center\">To</div> <div class=\"col-sm-4\"> <select class=\"form-control\" name=\"end_time[]\" id=\"end_time\" required> <option value=""> End Time</option> <option value=\"08:00 AM\" >08:00 AM</option> <option value=\"08:15 AM\" >08:15 AM</option> <option value=\"08:30 AM\" >08:30 AM</option> <option value=\"08:45 AM\" >08:45 AM</option> <option value=\"09:00 AM\" >09:00 AM</option> <option value=\"09:15 AM\" >09:15 AM</option> <option value=\"09:30 AM\" >09:30 AM</option> <option value=\"09:45 AM\" >09:45 AM</option> <option value=\"10:00 AM\">10:00 AM</option> <option value=\"10:15 AM\">10:15 AM</option> <option value=\"10:30 AM\" >10:30 AM</option> <option value=\"10:45 AM\" >10:45 AM</option> <option value=\"11:00 AM\" >11:00 AM</option> <option value=\"11:15 AM\" >11:15 AM</option> <option value=\"11:30 AM\" >11:30 AM</option> <option value=\"11:45 AM\" >11:45 AM</option> <option value=\"12:00 PM\" >12:00 PM</option> <option value=\"12:15 PM\" >12:15 PM</option> <option value=\"12:30 PM\" >12:30 PM</option> <option value=\"12:45 PM\" >12:45 PM</option> <option value=\"01:00 PM\" >01:00 PM</option> <option value=\"01:15 PM\" >01:15 PM</option> <option value=\"01:30 PM\" >01:30 PM</option> <option value=\"01:45 PM\" >01:45 PM</option> <option value=\"02:00 PM\" >02:00 PM</option> <option value=\"02:15 PM\" >02:15 PM</option> <option value=\"02:30 PM\" >02:30 PM</option> <option value=\"02:45 PM\" >02:45 PM</option> <option value=\"03:00 PM\" >03:00 PM</option> <option value=\"03:15 PM\" >03:15 PM</option> <option value=\"03:30 PM\" >03:30 PM</option> <option value=\"03:45 PM\" >03:45 PM</option> <option value=\"04:00 PM\" >04:00 PM</option> <option value=\"04:15 PM\" >04:15 PM</option> <option value=\"04:30 PM\" >04:30 PM</option> <option value=\"04:45 PM\" >04:45 PM</option> <option value=\"05:00 PM\" >05:00 PM</option> <option value=\"05:15 PM\" >05:15 PM</option> <option value=\"05:30 PM\" >05:30 PM</option> <option value=\"05:45 PM\" >05:45 PM</option> <option value=\"06:00 PM\" >06:00 PM</option> <option value=\"06:15 PM\" >06:15 PM</option> <option value=\"06:30 PM\" >06:30 PM</option> <option value=\"06:45 PM\" >06:45 PM</option> <option value=\"07:00 PM\" >07:00 PM</option> <option value=\"07:15 PM\" >07:15 PM</option> <option value=\"07:30 PM\" >07:30 PM</option> <option value=\"07:45 PM\" >07:45 PM</option> <option value=\"08:00 PM\" >08:00 PM</option> <option value=\"08:15 PM\" >08:15 PM</option> <option value=\"08:30 PM\" >08:30 PM</option> <option value=\"08:45 PM\" >08:45 PM</option> <option value=\"09:00 PM\" >09:00 PM</option> <option value=\"09:15 PM\" >09:15 PM</option> <option value=\"09:30 PM\" >09:30 PM</option> <option value=\"09:45 PM\" >09:45 PM</option> <option value=\"10:00 PM\" >10:00 PM</option> </select> </div> </div> </div> <div class=\"select-time-form padding-top-10 clearfix\" ><div class=\"col-sm-2\"><label for="time" class="text-left control-label text-center">Closing Date</label></div> <div class="col-sm-10 clearfix"><div class="col-sm-7"><input type=\"text\" class=\"form-control fromdate\" name=\"close_start_date[]\" id="fromdate'+count+'" style="margin-bottom: 20px" placeholder="Closing Date: yyyy-mm-dd" required=""></div></div><a style="margin-left:20px" class="btn btn-xs btn-danger" onclick=remove_div('+count+')><i class="fa fa-minus" aria-hidden="true"></i></a></div></div>');
}
</script>

<script>
     
     $( function() {
    $( "#fromdate1" ).datepicker({dateFormat: 'yy-mm-dd'});
  } );
     $( function() {
    $( "#fromdate2" ).datepicker({dateFormat: 'yy-mm-dd'});
  } );
     $( function() {
    $( "#fromdate3" ).datepicker({dateFormat: 'yy-mm-dd'});
  } );
     $( function() {
    $( "#fromdate4" ).datepicker({dateFormat: 'yy-mm-dd'});
  } );
     $( function() {
    $( "#fromdate5" ).datepicker({dateFormat: 'yy-mm-dd'});
  } );
     $( function() {
    $( "#fromdate6" ).datepicker({dateFormat: 'yy-mm-dd'});
  } );


</script>
<script>

        function remove_div(count)
        {
            //alert(count);
            $("#form-group_"+count).remove();
            //$("#check_day_"+count).remove();
            //$("#backend-check-day_"+count).remove();
        }
</script>

<script>
    function validateForm()
    {
        var count=0;
        var service_name=$('#service_name').val();
      
        if(service_name=="")
        {
            $("#service_name").addClass("glowing-border-red");
            count++;
        }
        else
        {
            $("#service_name").removeClass("glowing-border-red");
        }

        if(count>0)
        {
            return false;
        }
    }

    function remove_border()
    {
        var service_name=$('#service_name').val();

        if(service_name!="")
        {
            $("#service_name").removeClass("glowing-border-red");
        }

    }
</script>





<script type="text/javascript">

   
     $( function() {
    $("#ui-datepicker-div").addClass("date-table");
  } );
</script>
