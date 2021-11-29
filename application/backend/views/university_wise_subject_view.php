<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Subjects
       
        
      </h1>
      <small><?php
            $message=$this->session->flashdata('message');
            if($message){
              ?>
              <br><span style="color:green">
                <?php echo $message; ?>
              </span>
              <?php
              }
              ?>
             
             
            
              </small>
              <small id="msg" style="color:red"></small>
              
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url()?>index.php/index.php/sub_admin_list_manage">Subjects List</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
            
            <!-- /.box-header -->
            
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Total Subjects(<?php echo count($subject); ?>)</h3>
            </div>
            <!-- /.box-header -->
            
            <table width="100%">
            <tr>
                
          <!--         <?php 

                $admin_details=$this->session_check_and_session_data->admin_session_data();

                if(@$admin_details[0]->user_type_id=='1')
                {
            ?>
              <td width="50%"><a href="<?php echo base_url();?>index.php/admin_service/add_university" class="btn btn-primary btn-action" title="Add"><i class="fa fa-pencil-square-o"></i> Add Institutes</a></td>
              
              <?php } ?>
              
                <?php 

                $admin_details=$this->session_check_and_session_data->admin_session_data();

                if(@$admin_details[0]->user_type_id=='1')
                {
            ?> -->

          <!--     <td width="50%" style="padding-left:20.5%">
              
 
 
                <a href="javascript:void(0)" class="btn btn-success btn-action" title="Active"  onclick="change_sts_active('active')"><i class="fa fa-pencil-square-o" ></i> Active</a>

                <a href="javascript:void(0)" class="btn btn-danger btn-action" title="Inactive" onclick="change_sts_active('inactive')"><i class="fa fa-pencil-square-o" ></i> Inactive</a>

            </td>
 -->            
              <!-- <?php } ?> -->
            </tr>
            </table>
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="bg-blue">
                    
                  <th>Sl</th>
                  <th>Subjects</th>
                </tr>
                </thead>
                <tbody>

               <?php $i=0; 
            if(count($subject )>0)
            {
        
                foreach($subject  as $row)
                {
                  $i++;

                
                  
                  ?>
              
                <tr>
                 
                   <td><?php echo $i; ?></td>

                   <?php 

                   $main_sub=$this->common->select($table_name='tbl_kpo',$field=array(), $where=array('kpo_id'=>$row->subject_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


                    ?>


                  <td><?php echo @$main_sub[0]->kpo_name;?></a></td>
                
             
            
                </tr>
<?php } 
}?>

                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    </div>
    </div>
    <script>
    var base_url= '<?php echo base_url();?>'
function delete_data(id)
  { 
    if(confirm('Are you sure do you want to delete it?'))
    {
      window.location = base_url+'index.php/admin_service/university_delete/'+id;
    } 
  } 

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
function check_all()
{
  
   if ($("#all_chk").is(':checked')) {
            $("input[name=record]").each(function () {
                $(this).prop("checked", true);
            });

        } 
        else {
            $("input[name=record]").each(function () {
                $(this).prop("checked", false);
            });
          }
}
  </script>




  <script type="text/javascript">

       function change_sts_active(val)
        {
          //alert(val);
          
            var pro_ids =[];

            $.each($("input[name='record']:checked"), function()
            {            
                pro_ids.push($(this).val());
            });

            //alert(pro_ids[0]);
            var base_url='<?php echo base_url(); ?>';
            if(pro_ids.length>0)
            {

              $.ajax({
              
              url:base_url+'index.php/admin_service/change_to_active_university',
              data:{pid:pro_ids,status:val},
              dataType: "json",
              type: "POST",
              success: function(data){


                var perform= data.changedone;

                  if(perform==1)
                  {
                      alert('Status changed successsfully');
                      location.reload();
                  }
                
                  }
              });
            }
            else
            {
              alert('Sorry!! please select any records');
            }
    }

    </script>