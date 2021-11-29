<footer class="main-footer">
    <!-- To the right -->
    <!-- <div class="pull-right hidden-xs">
         Anything you want
     </div>-->
    <!-- Default to the left -->

    <strong>Copyright &copy; <?php echo date('Y'); ?> .<a href="<?php echo base_url();?>index.php/admin_dashboard">iipars</a></strong> All rights reserved.
</footer>
<div class="control-sidebar-bg"></div>
</div>

<script src="<?php echo base_url()?>assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>

<script src="<?php echo base_url();?>assets/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
$(function () {
//Initialize Select2 Elements
$(".select2").select2();
});
</script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>assets/dist/js/app.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
    $(function () {
        $("#example1").DataTable({

              

        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
    	});
    });

</script>

 <script type="text/javascript">

   $(document).ready(function(){

    
      $(".datepicker").datepicker({

      minDate:0,

      autoclose: true, 

      dateFormat: "dd-mm-yy",

      pickerPosition: "bottom-left",

      changeMonth: true,

      changeYear: true,

    }); 

   });

    
</script>
 

</body>
</html>
