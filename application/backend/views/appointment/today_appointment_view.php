<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Today's Appointments</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>index.php/admin_dashboard"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboad</a></li>
            <li class="active">Appointment</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Appointment List</h3>
                    </div>
                    
                    <!--  <button class="btn btn-success btn-sm" type="submit" style="" onclick="change_active(this.value)" value="active" name="change_active" id="change_active"><i class="fa fa-check" aria-hidden="true"></i> active</button>
                    <button class="btn btn-warning btn-sm" type="submit" style="" onclick="change_inactive(this.value)" value="inactive" name="change_inactive" id="change_inactive"><i class="fa fa-times" aria-hidden="true"></i> inactive</button>
                    <button  class="btn btn-sm btn-danger" onclick="delete_multiple()" >Delete multiple</button> -->
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="" class="table table-bordered table-hover table-condensed">
                            <thead>
                            <tr class="bg-blue">
                                 <th>Time</th>
                                <th>Appointment Id</th>
                                <th>Status</th>
                                <th>Patient Name</th>
                                <th>Contact No</th>
                                <!-- <th>Date</th> -->
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <div class="clearfix"></div>
                            <?php
                            //echo $appointment_date;
                                foreach ($appnt_time as $row)
                                {
                                    $start_time= $row->start_time;
                                    $end_time= $row->end_time;
                                    $start= strtotime($start_time);
                                    $end= strtotime($end_time);
                                    for ($i=$start;$i<=$end;$i = $i + 15*60)
                                        {
                                            $app_time= date('g:i A',$i);
                                            //$this->load->model('common');
                                            $appnt_list= $this->common->check_book_availivity($app_time, $appointment_date);
                            ?>
                            <tr>
                                <td><?php echo $app_time; ?></td>
                                <?php
                                if(count(@$appnt_list)>0)
                                    {
                                        ?>
                                <td><?php echo $appnt_list[0]->appointment_uniq_id; ?></td>
                                <td>
                                <select onchange="change_status(this.value,<?php echo $appnt_list[0]->appointment_id; ?>)">
                                    <option value="Pending" <?php if($appnt_list[0]->appointment_status=='Pending'){ echo 'selected'; } ?>>Pending</option>
                                    <option value="Confirmed" <?php if($appnt_list[0]->appointment_status=='Confirmed'){ echo 'selected'; } ?>>Confirmed</option>
                                    <option value="Canceled" <?php if($appnt_list[0]->appointment_status=='Canceled'){ echo 'selected'; } ?>>Canceled</option>
                                    <option value="Completed" <?php if($appnt_list[0]->appointment_status=='Completed'){ echo 'selected'; } ?>>Completed</option>
                                    <option value="Reschedule" >Reschedule</option>
                                </select>
                                </td>
                                <td><?php echo $appnt_list[0]->patient_fname.' '.$appnt_list[0]->patient_lname; ?></td>
                                  <td><?php echo $appnt_list[0]->patient_mobile; ?></td>
                               <!--  <td><?php echo date('jS M y, l',strtotime($row->appointment_date)); ?></td> -->
                                
                                <td><?php if($appnt_list[0]->appointment_type =='first_time'){ echo 'First Time'; } else{
                                    echo 'Follow up';
                                } ?></td>
                                <td>
                                    
                                    <a href="<?php echo base_url(); ?>index.php/admin_appointment/my_app_delete/<?php echo $appnt_list[0]->appointment_id; ?>" class="btn-sm btn-danger" onclick="return confirm('are you sure ?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
                                </td>
                                <?php
                            }
                            else {
                                ?>
                                <td colspan="6">
                                    <form action="<?php echo base_url();?>index.php/appointmentslist/book_new" id="book_form" method="post">
                                        <input type="hidden" name="appointment_date" value="<?php echo $appointment_date; ?>">
                                        <input type="hidden" name='appointment_time' id="appointment_time">
                                    </form>
                                    <a href="javascript:void(0)" onclick="get_time('<?php  echo $app_time?>')" >Free Slot</a>
                                </td>
                                    <?php
                                    }
                                    ?>
                            </tr>
                            <?php 
                            
                        }
                        }?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>


<script src="<?php echo base_url()?>assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
function get_time(value)
{
    $("#appointment_time").val(value);
    $("#book_form").submit();
}

    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });


    function change_status(status, id)
    {
        if(status=='Reschedule')
        {
            if(confirm('are you sure to change the schedule ?'))
            {
                window.location='<?php echo base_url();?>index.php/admin_appointment/reschedule/'+id;
            }
        }
        else{
            if(confirm('are you sure?'))
            {
             window.location='<?php echo base_url();?>index.php/admin_appointment/change_status/'+status+'/'+id;
            }
        }
        
    }
</script>

