<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Manage Group Medicine
       
        
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
        <li><a href="<?php echo base_url()?>index.php/index.php/sub_admin_list_manage">Group Medicine List</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
            
            <!-- /.box-header -->
            
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Total Examination(<?php echo count($group_med_list ); ?>)</h3>
            </div>
            <!-- /.box-header -->
            
            <table width="100%">
            <tr>
              <td width="50%"><a href="<?php echo base_url();?>index.php/admin_cc/add_examination" class="btn btn-primary btn-action" title="Add"><i class="fa fa-pencil-square-o"></i> Add Examination</a></td>

              <td width="50%" style="padding-left:20.5%">
              <!--<span style="padding-left: 80.5%">-->
            <!--  <a href="javascript:void(0)" class="btn btn-success btn-action" title="Active"  onclick="active_sub_admin()"><i class="fa fa-pencil-square-o" ></i> Active</a>

                <a href="javascript:void(0)" class="btn btn-danger btn-action" title="Inactive" onclick="in_active_sub_admin()"><i class="fa fa-pencil-square-o" ></i> Inactive</a>
 -->
                <a href="javascript:void(0)" class="btn btn-success btn-action" title="Active"  onclick="change_sts_active('active')"><i class="fa fa-pencil-square-o" ></i> Active</a>

                <a href="javascript:void(0)" class="btn btn-danger btn-action" title="Inactive" onclick="change_sts_active('inactive')"><i class="fa fa-pencil-square-o" ></i> Inactive</a>

            </td>
            </tr>
            </table>
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 
                   <th>Group Name</th>
                 <th>Medicine Name</th>
                  
                
                  
             
              <th>Action</th>
                </tr>
                </thead>
                <tbody>

               <?php $i=0; 
            if(count($group_med_list )>0)
            {
        
                foreach($group_med_list  as $row)
                {
                  $i++;

                  $type=$this->admin_model->selectOne('tbl_group','group_id',$row->group_id);

                  $med=$this->admin_model->selectOne('tbl_medicine','medicine_id',$row->medicine_id);
                  
                  $emptyString='N/A';
                  
                  ?>
              
                <tr>
                 
                 
                  <td><?php echo $row->examination_name;?></td>
                 <td><?php echo @$type[0]->group_name; ?></td>
             
                 
                                                       
                  <td>
                     <a href="<?php echo base_url();?>index.php/admin_cc/examination_edit/<?php echo $row->group_med_id;?>" class="btn btn-success" title="View"><i class="fa fa-pencil"></i></a>
                   
                    <button type="button" class="btn btn-danger" onclick="delete_data('<?php echo $row->group_med_id;?>')" title="Delete"><i class="fa fa-trash-o"></i></button>
                  
                  </td>
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
      window.location = base_url+'index.php/admin_cc/examination_delete/'+id;
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
              
              url:base_url+'index.php/admin_cc/change_to_active_examination',
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