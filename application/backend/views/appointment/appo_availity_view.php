<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Manage Unavailable Timing</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>index.php/admin_dashboard"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboad</a></li>
            <li class="active">Manage Unavailable Timing</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <?php
                if($this->session->flashdata('msg')!='')
                    {
                        ?>
                        <span style="color:green"><strong><?php echo $this->session->flashdata('msg'); ?></strong></span>
                        <?php
                    }
                    ?>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <a href="<?php echo base_url(); ?>index.php/admin_appointment/set_close_dates" class="btn btn-primary"><i class="fa fa-calendar" aria-hidden="true"></i> Set New Timing</a>
                    </div>
                    
                   
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover table-condensed table-responsive">
                            <thead>
                            <tr class="bg-blue">
                                <th>Sl. no</th>
                                <th>Service</th>
                                <th>Date (Not Available)</th>
                              <th>Time (Not Available)</th>
                                <th>Action</th>
                           
                            </tr>
                            </thead>
                            <tbody>
                            <div class="clearfix"></div>
                            <?php
                            $i=0;
                                foreach ($availability as $row)
                                {
                                    $i++;
                            ?>      
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><strong><?php echo $row->service; ?></strong></td>
                                <td>
                                    
                            <!-- <select name="available_status" id="available_status" onchange="chage_availability(this.value)">
                                <option value="YES" <?php if($row->availability=='YES'){ echo 'selected'; } ?>>Yes</option>
                                <option value="NO" <?php if($row->availability=='NO'){ echo 'selected'; } ?>>No</option>
                            </select> -->
                            <?php echo date('jS M y', strtotime($row->close_start_date)); ?>
                                </td>
                                
                                  <td>
                                      <?php
                                      
                                        echo $row->close_start_time.' to '.$row->close_end_time;
                                        
                                        ?>
                                  </td>  
                                  <td>
                                     <a href="<?php echo base_url(); ?>index.php/admin_appointment/close_time_delete/<?php echo $row->id; ?>" class="btn-sm btn-danger" onclick="return confirm('are you sure ?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a> 
                                     <a href="<?php echo base_url(); ?>index.php/admin_appointment/edit_close_time/<?php echo $row->id; ?>" class="btn-sm btn-primary" ><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a> 
                                  </td>  
                                
                            </tr>
                            <?php 
                        }
                            ?>
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
    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Set Unavailable Date</h4>
      </div>
          <form method="post" action="<?php echo base_url(); ?>index.php/admin_appointment/change_availability">
      <div class="modal-body">
   <input type="hidden" class="form-control" name="value" id="value" style="margin-bottom: 20px" placeholder="From Date" value="NO">
         <input type="text" class="form-control" name="close_start_date" id="fromdate" style="margin-bottom: 20px" placeholder="From Date" required="">
         <input type="text" class="form-control" name="close_end_date" id="todate" style="margin-bottom: 20px" placeholder="To Date" required="">  

    
      </div>
      <div class="modal-footer">
       
        <button type="submit" class="btn btn-primary">Done</button>
         <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
</form>
  </div>
</div>

</div>


<script src="<?php echo base_url()?>assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
    $( "#fromdate" ).datepicker({dateFormat: 'yy-mm-dd'});
  } );

    $( function() {
    $( "#todate" ).datepicker(
        {dateFormat: 'yy-mm-dd'});
  } );
  </script>
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

function chage_availability(value)
{
    if(value=='YES')
    {
      $.ajax(

      {

        type: "POST",
        url: "<?php echo base_url(); ?>index.php/admin_appointment/change_availability",
        data: {value:value},
        success: function (data) 
        {
        
            alert('Status has been changed successfully');
            location.reload();
           }



       });  
    }
    else{
        $("#myModal").modal('show');
    }
    
}
   
</script>

<script type="text/javascript">

   
     $( function() {
    $("#ui-datepicker-div").addClass("date-table");
  } );
</script>

