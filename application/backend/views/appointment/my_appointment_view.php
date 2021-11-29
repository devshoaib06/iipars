<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Manage Appointments</h1>
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
                        <table id="example1" class="table table-bordered table-hover table-condensed table-responsive">
                            <thead>
                            <tr class="bg-blue">
                                <th>Sl. no</th>
                                <th>Appointment Id</th>
                                <th>Status</th>
                                <th>Patient Name</th>
                                <th>Contact No</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <div class="clearfix"></div>
                            <?php
                            $i=0;
                                foreach ($appoint as $row)
                                {
                                    $i++;
                            ?>      
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $row->appointment_uniq_id; ?></td>
                                <td>
                                <select onchange="change_status(this.value,<?php echo $row->appointment_id; ?>)">
                                    <option value="Pending" <?php if($row->appointment_status=='Pending'){ echo 'selected'; } ?>>Pending</option>
                                    <option value="Confirmed" <?php if($row->appointment_status=='Confirmed'){ echo 'selected'; } ?>>Confirmed</option>
                                    <option value="Canceled" <?php if($row->appointment_status=='Canceled'){ echo 'selected'; } ?>>Canceled</option>
                                    <option value="Completed" <?php if($row->appointment_status=='Completed'){ echo 'selected'; } ?>>Completed</option>
                                    <option value="Reschedule" >Reschedule</option>
                                </select>
                                </td>
                                <td><?php echo $row->patient_fname.' '.$row->patient_lname; ?></td>
                                  <td><?php echo $row->patient_mobile; ?></td>
                                <td><?php echo date('jS M y, l',strtotime($row->appointment_date)); ?></td>
                                <td><?php echo $row->appointment_time; ?></td>
                                <td><?php if($row->appointment_type =='first_time'){ echo 'First Time'; } else{
                                    echo 'Follow up';
                                } ?></td>
                                <td>
                                    
                                    <a href="<?php echo base_url(); ?>index.php/admin_appointment/my_app_delete/<?php echo $row->appointment_id; ?>" class="btn-sm btn-danger" onclick="return confirm('are you sure ?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
                                </td>
                            </tr>
                            <?php }?>
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

