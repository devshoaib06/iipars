<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Appointment Timing</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>index.php/admin_dashboard"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboad</a></li>
            <li class="active">Appointment Timing</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Timing List</h3>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php/admin_appointment/add_time" class="btn btn-sm btn-success" style="margin-left: 12px;"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                    <!--  <button class="btn btn-success btn-sm" type="submit" style="" onclick="change_active(this.value)" value="active" name="change_active" id="change_active"><i class="fa fa-check" aria-hidden="true"></i> active</button>
                    <button class="btn btn-warning btn-sm" type="submit" style="" onclick="change_inactive(this.value)" value="inactive" name="change_inactive" id="change_inactive"><i class="fa fa-times" aria-hidden="true"></i> inactive</button>
                    <button  class="btn btn-sm btn-danger" onclick="delete_multiple()" >Delete multiple</button> -->
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover table-condensed table-responsive">
                            <thead>
                            <tr class="bg-blue">
                                <th>Time</th>
                                <th>Days</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <div class="clearfix"></div>
                            <?php
                                foreach ($appoint as $row)
                                {
                            ?>
                            <tr>
                                <td><?php echo $row->start_time." "."to"." ".$row->end_time; ?></td>
                                <td><?php echo $row->day; ?></td>
                                <td>
                                    <!--<a href="<?php echo base_url(); ?>index.php/admin_appointment/appointment_edit/<?php echo $row->time_id; ?>" class="btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>-->
                                    <a href="<?php echo base_url(); ?>index.php/admin_appointment/delete_time/<?php echo $row->time_id; ?>" class="btn-sm btn-danger" onclick="return confirm('are you sure ?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
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
</script>

