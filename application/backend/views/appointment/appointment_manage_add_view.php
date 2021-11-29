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
          Appointment Timing Add
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>index.php/admin_dashboard"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboard</a></li>
            <li class="active"></i>Appointment Timing Add</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <!--<div class="box-header">
                        <h3 class="box-title" style="margin-left:15px"> </h3>
                    </div>-->
                    <!-- /.box-header -->
                    <div class="box-body pad">
                        <form action="<?php echo base_url()?>index.php/Admin_appointment/add_time_submit" class="form-horizontal" id="main" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                            <div class="clearfix"></div> 




                    <div id="time">
                        <div class="form-group"  id="form-group_0" style="margin-top: 10px;">
                            <div class="select-time-form clearfix">
                                <div class="col-sm-2">
                                    <label for="time" class="text-left control-label text-center">Timings</label>
                                </div> 
                                <div class="col-sm-7 clearfix">  
                                <div class="col-sm-4">
                                    <select class="form-control" name="start_time[]" id="start_time">
                                        <option value="0"> --select start time--</option>
                                        <option value="08:00 AM" >08:00 AM</option>
                                        <option value="08:15 AM" >08:15 AM</option>
                                        <option value="08:30 AM" >08:30 AM</option>
                                        <option value="08:45 AM" >08:45 AM</option>
                                        <option value="09:00 AM" >09:00 AM</option>
                                        <option value="09:15 AM" >09:15 AM</option>
                                        <option value="09:30 AM" >09:30 AM</option>
                                        <option value="09:45 AM" >09:45 AM</option>
                                        <option value="10:00 AM">10:00 AM</option>
                                        <option value="10:15 AM">10:15 AM</option>
                                        <option value="10:30 AM" >10:30 AM</option>
                                        <option value="10:45 AM" >10:45 AM</option>
                                        <option value="11:00 AM" >11:00 AM</option>
                                        <option value="11:15 AM" >11:15 AM</option>
                                        <option value="11:30 AM" >11:30 AM</option>
                                        <option value="11:45 AM" >11:45 AM</option>
                                        <option value="12:00 PM" >12:00 PM</option>
                                        <option value="12:15 PM" >12:15 PM</option>
                                        <option value="12:30 PM" >12:30 PM</option>
                                        <option value="12:45 PM" >12:45 PM</option>
                                        <option value="01:00 PM" >01:00 PM</option>
                                        <option value="01:15 PM" >01:15 PM</option>
                                        <option value="01:30 PM" >01:30 PM</option>
                                        <option value="01:45 PM" >01:45 PM</option>
                                        <option value="02:00 PM" >02:00 PM</option>
                                        <option value="02:15 PM" >02:15 PM</option>
                                        <option value="02:30 PM" >02:30 PM</option>
                                        <option value="02:45 PM" >02:45 PM</option>
                                        <option value="03:00 PM" >03:00 PM</option>
                                        <option value="03:15 PM" >03:15 PM</option>
                                        <option value="03:30 PM" >03:30 PM</option>
                                        <option value="03:45 PM" >03:45 PM</option>
                                        <option value="04:00 PM" >04:00 PM</option>
                                        <option value="04:15 PM" >04:15 PM</option>
                                        <option value="04:30 PM" >04:30 PM</option>
                                        <option value="04:45 PM" >04:45 PM</option>
                                        <option value="05:00 PM" >05:00 PM</option>
                                        <option value="05:15 PM" >05:15 PM</option>
                                        <option value="05:30 PM" >05:30 PM</option>
                                        <option value="05:45 PM" >05:45 PM</option>
                                        <option value="06:00 PM" >06:00 PM</option>
                                        <option value="06:15 PM" >06:15 PM</option>
                                        <option value="06:30 PM" >06:30 PM</option>
                                        <option value="06:45 PM" >06:45 PM</option>
                                        <option value="07:00 PM" >07:00 PM</option>
                                        <option value="07:15 PM" >07:15 PM</option>
                                        <option value="07:30 PM" >07:30 PM</option>
                                        <option value="07:45 PM" >07:45 PM</option>
                                        <option value="08:00 PM" >08:00 PM</option>
                                        <option value="08:15 PM" >08:15 PM</option>
                                        <option value="08:30 PM" >08:30 PM</option>
                                        <option value="08:45 PM" >08:45 PM</option>
                                        <option value="09:00 PM" >09:00 PM</option>
                                        <option value="09:15 PM" >09:15 PM</option>
                                        <option value="09:30 PM" >09:30 PM</option>
                                        <option value="09:45 PM" >09:45 PM</option>
                                        <option value="10:00 PM" >10:00 PM</option>
                                    </select>
                                </div>
                                <div class="col-sm-1 text-center">To</div>
                                <div class="col-sm-4">
                                    <select class="form-control" name="end_time[]" id="end_time">
                                        <option value="0"> --select end time--</option>
                                        <option value="08:00 AM" >08:00 AM</option>
                                        <option value="08:15 AM" >08:15 AM</option>
                                        <option value="08:30 AM" >08:30 AM</option>
                                        <option value="08:45 AM" >08:45 AM</option>
                                        <option value="09:00 AM" >09:00 AM</option>
                                        <option value="09:15 AM" >09:15 AM</option>
                                        <option value="09:30 AM" >09:30 AM</option>
                                        <option value="09:45 AM" >09:45 AM</option>
                                        <option value="10:00 AM">10:00 AM</option>
                                        <option value="10:15 AM">10:15 AM</option>
                                        <option value="10:30 AM" >10:30 AM</option>
                                        <option value="10:45 AM" >10:45 AM</option>
                                        <option value="11:00 AM" >11:00 AM</option>
                                        <option value="11:15 AM" >11:15 AM</option>
                                        <option value="11:30 AM" >11:30 AM</option>
                                        <option value="11:45 AM" >11:45 AM</option>
                                        <option value="12:00 PM" >12:00 PM</option>
                                        <option value="12:15 PM" >12:15 PM</option>
                                        <option value="12:30 PM" >12:30 PM</option>
                                        <option value="12:45 PM" >12:45 PM</option>
                                        <option value="01:00 PM" >01:00 PM</option>
                                        <option value="01:15 PM" >01:15 PM</option>
                                        <option value="01:30 PM" >01:30 PM</option>
                                        <option value="01:45 PM" >01:45 PM</option>
                                        <option value="02:00 PM" >02:00 PM</option>
                                        <option value="02:15 PM" >02:15 PM</option>
                                        <option value="02:30 PM" >02:30 PM</option>
                                        <option value="02:45 PM" >02:45 PM</option>
                                        <option value="03:00 PM" >03:00 PM</option>
                                        <option value="03:15 PM" >03:15 PM</option>
                                        <option value="03:30 PM" >03:30 PM</option>
                                        <option value="03:45 PM" >03:45 PM</option>
                                        <option value="04:00 PM" >04:00 PM</option>
                                        <option value="04:15 PM" >04:15 PM</option>
                                        <option value="04:30 PM" >04:30 PM</option>
                                        <option value="04:45 PM" >04:45 PM</option>
                                        <option value="05:00 PM" >05:00 PM</option>
                                        <option value="05:15 PM" >05:15 PM</option>
                                        <option value="05:30 PM" >05:30 PM</option>
                                        <option value="05:45 PM" >05:45 PM</option>
                                        <option value="06:00 PM" >06:00 PM</option>
                                        <option value="06:15 PM" >06:15 PM</option>
                                        <option value="06:30 PM" >06:30 PM</option>
                                        <option value="06:45 PM" >06:45 PM</option>
                                        <option value="07:00 PM" >07:00 PM</option>
                                        <option value="07:15 PM" >07:15 PM</option>
                                        <option value="07:30 PM" >07:30 PM</option>
                                        <option value="07:45 PM" >07:45 PM</option>
                                        <option value="08:00 PM" >08:00 PM</option>
                                        <option value="08:15 PM" >08:15 PM</option>
                                        <option value="08:30 PM" >08:30 PM</option>
                                        <option value="08:45 PM" >08:45 PM</option>
                                        <option value="09:00 PM" >09:00 PM</option>
                                        <option value="09:15 PM" >09:15 PM</option>
                                        <option value="09:30 PM" >09:30 PM</option>
                                        <option value="09:45 PM" >09:45 PM</option>
                                        <option value="10:00 PM" >10:00 PM</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div class="check-sec clearfix">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-7 backend-check-day" id="backend-check-day_0">
                            <div class="col-sm-2 text-center">
                                <input type="checkbox" id="check_day_0" name="check_0[]" value="Monday">Monday
                            </div>
                            <div class="col-sm-2 text-center">
                                <input type="checkbox" id="check_day_0" name="check_0[]" value="Tuesday">Tuesday
                            </div>
                            <div class="col-sm-2 text-center">
                                <input type="checkbox" id="check_day_0" name="check_0[]" value="Wednesday"> Wednesday
                            </div>
                            <div class="col-sm-2 text-center">
                                <input type="checkbox" id="check_day_0" name="check_0[]" value="Thursday">Thursday
                            </div>
                            <div class="col-sm-2 text-center">
                                <input type="checkbox" id="check_day_0" name="check_0[]" value="Friday"> Friday
                            </div>
                            <div class="col-sm-2 text-center">
                                <input type="checkbox" id="check_day_0" name="check_0[]" value="Saturday">Saturday
                            </div>
                            <div class="col-sm-2 text-center">
                                <input type="checkbox" id="check_day" name="check_0[]" value="Sunday"> Sunday
                            </div>
                        </div>
                    </div>
                </div><!--//form-group-->
            </div>

                <div class="clearfix"></div> 


                <div class="text-center"><a  onclick="add_more()" style="cursor: pointer"><i class="fa fa-plus" aria-hidden="true"></i> Add more time</a></div>





                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary pull-left" value="Save changes" style="margin-top: 8px;margin-right:10px">
                                <a href="<?php echo base_url()?>index.php/admin_appointment" class="btn btn-danger" style="margin-top: 8px;margin-left:10px">Cancel</a>

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
    
function add_more()
{
         var count= $('#time').children('.form-group').length;
         //$("#test").val(count);

         //alert(count);

    $("#time").append('<div class=\"form-group\" id=\"form-group_'+count+'\" style=\"margin-top: 10px;\"> <div class=\"select-time-form clearfix\"> <div class=\"col-sm-2\"> <label for=\"time\" class=\"text-left control-label text-center\">Timings</label> </div> <div class=\"col-sm-7 clearfix\"> <div class=\"col-sm-4\"> <select class=\"form-control\" name=\"start_time[]\" id=\"start_time\"> <option value=\"0\"> select start time</option> <option value=\"08:00 AM\" >08:00 AM</option> <option value=\"08:15 AM\" >08:15 AM</option> <option value=\"08:30 AM\" >08:30 AM</option> <option value=\"08:45 AM\" >08:45 AM</option> <option value=\"09:00 AM\" >09:00 AM</option> <option value=\"09:15 AM\" >09:15 AM</option> <option value=\"09:30 AM\" >09:30 AM</option> <option value=\"09:45 AM\" >09:45 AM</option> <option value=\"10:00 AM\">10:00 AM</option> <option value=\"10:15 AM\">10:15 AM</option> <option value=\"10:30 AM\" >10:30 AM</option> <option value=\"10:45 AM\" >10:45 AM</option> <option value=\"11:00 AM\" >11:00 AM</option> <option value=\"11:15 AM\" >11:15 AM</option> <option value=\"11:30 AM\" >11:30 AM</option> <option value=\"11:45 AM\" >11:45 AM</option> <option value=\"12:00 PM\" >12:00 PM</option> <option value=\"12:15 PM\" >12:15 PM</option> <option value=\"12:30 PM\" >12:30 PM</option> <option value=\"12:45 PM\" >12:45 PM</option> <option value=\"01:00 PM\" >01:00 PM</option> <option value=\"01:15 PM\" >01:15 PM</option> <option value=\"01:30 PM\" >01:30 PM</option> <option value=\"01:45 PM\" >01:45 PM</option> <option value=\"02:00 PM\" >02:00 PM</option> <option value=\"02:15 PM\" >02:15 PM</option> <option value=\"02:30 PM\" >02:30 PM</option> <option value=\"02:45 PM\" >02:45 PM</option> <option value=\"03:00 PM\" >03:00 PM</option> <option value=\"03:15 PM\" >03:15 PM</option> <option value=\"03:30 PM\" >03:30 PM</option> <option value=\"03:45 PM\" >03:45 PM</option> <option value=\"04:00 PM\" >04:00 PM</option> <option value=\"04:15 PM\" >04:15 PM</option> <option value=\"04:30 PM\" >04:30 PM</option> <option value=\"04:45 PM\" >04:45 PM</option> <option value=\"05:00 PM\" >05:00 PM</option> <option value=\"05:15 PM\" >05:15 PM</option> <option value=\"05:30 PM\" >05:30 PM</option> <option value=\"05:45 PM\" >05:45 PM</option> <option value=\"06:00 PM\" >06:00 PM</option> <option value=\"06:15 PM\" >06:15 PM</option> <option value=\"06:30 PM\" >06:30 PM</option> <option value=\"06:45 PM\" >06:45 PM</option> <option value=\"07:00 PM\" >07:00 PM</option> <option value=\"07:15 PM\" >07:15 PM</option> <option value=\"07:30 PM\" >07:30 PM</option> <option value=\"07:45 PM\" >07:45 PM</option> <option value=\"08:00 PM\" >08:00 PM</option> <option value=\"08:15 PM\" >08:15 PM</option> <option value=\"08:30 PM\" >08:30 PM</option> <option value=\"08:45 PM\" >08:45 PM</option> <option value=\"09:00 PM\" >09:00 PM</option> <option value=\"09:15 PM\" >09:15 PM</option> <option value=\"09:30 PM\" >09:30 PM</option> <option value=\"09:45 PM\" >09:45 PM</option> <option value=\"10:00 PM\" >10:00 PM</option> </select> </div> <div class=\"col-sm-1 text-center\">To</div> <div class=\"col-sm-4\"> <select class=\"form-control\" name=\"end_time[]\" id=\"end_time\"> <option value=\"0\"> select end time</option> <option value=\"08:00 AM\" >08:00 AM</option> <option value=\"08:15 AM\" >08:15 AM</option> <option value=\"08:30 AM\" >08:30 AM</option> <option value=\"08:45 AM\" >08:45 AM</option> <option value=\"09:00 AM\" >09:00 AM</option> <option value=\"09:15 AM\" >09:15 AM</option> <option value=\"09:30 AM\" >09:30 AM</option> <option value=\"09:45 AM\" >09:45 AM</option> <option value=\"10:00 AM\">10:00 AM</option> <option value=\"10:15 AM\">10:15 AM</option> <option value=\"10:30 AM\" >10:30 AM</option> <option value=\"10:45 AM\" >10:45 AM</option> <option value=\"11:00 AM\" >11:00 AM</option> <option value=\"11:15 AM\" >11:15 AM</option> <option value=\"11:30 AM\" >11:30 AM</option> <option value=\"11:45 AM\" >11:45 AM</option> <option value=\"12:00 PM\" >12:00 PM</option> <option value=\"12:15 PM\" >12:15 PM</option> <option value=\"12:30 PM\" >12:30 PM</option> <option value=\"12:45 PM\" >12:45 PM</option> <option value=\"01:00 PM\" >01:00 PM</option> <option value=\"01:15 PM\" >01:15 PM</option> <option value=\"01:30 PM\" >01:30 PM</option> <option value=\"01:45 PM\" >01:45 PM</option> <option value=\"02:00 PM\" >02:00 PM</option> <option value=\"02:15 PM\" >02:15 PM</option> <option value=\"02:30 PM\" >02:30 PM</option> <option value=\"02:45 PM\" >02:45 PM</option> <option value=\"03:00 PM\" >03:00 PM</option> <option value=\"03:15 PM\" >03:15 PM</option> <option value=\"03:30 PM\" >03:30 PM</option> <option value=\"03:45 PM\" >03:45 PM</option> <option value=\"04:00 PM\" >04:00 PM</option> <option value=\"04:15 PM\" >04:15 PM</option> <option value=\"04:30 PM\" >04:30 PM</option> <option value=\"04:45 PM\" >04:45 PM</option> <option value=\"05:00 PM\" >05:00 PM</option> <option value=\"05:15 PM\" >05:15 PM</option> <option value=\"05:30 PM\" >05:30 PM</option> <option value=\"05:45 PM\" >05:45 PM</option> <option value=\"06:00 PM\" >06:00 PM</option> <option value=\"06:15 PM\" >06:15 PM</option> <option value=\"06:30 PM\" >06:30 PM</option> <option value=\"06:45 PM\" >06:45 PM</option> <option value=\"07:00 PM\" >07:00 PM</option> <option value=\"07:15 PM\" >07:15 PM</option> <option value=\"07:30 PM\" >07:30 PM</option> <option value=\"07:45 PM\" >07:45 PM</option> <option value=\"08:00 PM\" >08:00 PM</option> <option value=\"08:15 PM\" >08:15 PM</option> <option value=\"08:30 PM\" >08:30 PM</option> <option value=\"08:45 PM\" >08:45 PM</option> <option value=\"09:00 PM\" >09:00 PM</option> <option value=\"09:15 PM\" >09:15 PM</option> <option value="09:30 PM" >09:30 PM</option> <option value=\"09:45 PM\" >09:45 PM</option> <option value="10:00 PM" >10:00 PM</option> </select> </div> </div> </div> <div class="check-sec clearfix"> <div class="col-sm-2"></div> <div class="col-sm-7 backend-check-day" id="backend-check-day_'+count+'"> <div class=\"col-sm-2 text-center"> <input type="checkbox" id="check_day_'+count+'" name="check_'+count+'[]\" value="Monday">Monday </div> <div class="col-sm-2 text-center"> <input type="checkbox" id="check_day_'+count+'" name="check_'+count+'[]" value="Tuesday">Tuesday </div> <div class="col-sm-2 text-center"> <input type="checkbox" id="check_day_'+count+'" name="check_'+count+'[]" value="Wednesday"> Wednesday </div> <div class="col-sm-2 text-center"> <input type="checkbox" id="check_day_'+count+'" name="check_'+count+'[]" value="Thursday">Thursday </div> <div class="col-sm-2 text-center"> <input type="checkbox" id="check_day_'+count+'" name="check_'+count+'[]" value="Friday"> Friday </div> <div class="col-sm-2 text-center"> <input type="checkbox" id="check_day_'+count+'" name="check_'+count+'[]" value="Saturday">Saturday </div> <div class="col-sm-2 text-center"> <input type="checkbox" id="check_day_'+count+'" name="check_'+count+'[]" value="Sunday"> Sunday  </div> <a style="margin-left:20px" class="btn btn-xs btn-danger" onclick=remove_div('+count+')><i class="fa fa-minus" aria-hidden="true"></i></a></div> </div> <input type="hidden" name="test[]"  value="'+count+'"></div>');
}
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





