<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Manage Employee 
       
        
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
        <li><a href="<?php echo base_url()?>index.php/index.php/sub_admin_list_manage">Employee List</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
            
            <!-- /.box-header -->
            
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Total Employee(<?php echo count($sub_admin_list ); ?>)</h3>
            </div>
            <!-- /.box-header -->
            
            <table width="100%">
            <tr>
              <td width="50%"><a href="<?php echo base_url();?>index.php/sub_admin/add_sub_admin" class="btn btn-primary btn-action" title="Add"><i class="fa fa-pencil-square-o"></i> Add Employee</a></td>

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
                  <th><input type="checkbox" name="all_chk" id="all_chk" onclick="check_all()"></th>
                  <th>Status</th>
                   <th>Name</th>
           <!--   <th>Role</th> -->
                  
                  <th>Email</th>
                <!--   <th>User Access</th> -->
             
                  <th>Added Date</th>
             
             
              <th>Action</th>
                </tr>
                </thead>
                <tbody>

               <?php $i=0; 
            if(count($sub_admin_list )>0)
            {
        
                foreach($sub_admin_list  as $row)
                {
                  $i++;

                  $role=$this->admin_model->selectOne('tbl_role','role_id',$row->role_id);
                  
                  $emptyString='N/A';
                  
                  ?>
              
                <tr>
                  <td><input type="checkbox" name="record" value="<?php echo $row->user_id;?>"></td>
                  <td>
                    <?php if($row->status=='active'){ ?>
                      <img src="<?php echo base_url();?>../assets/upload/active.png">
                    <?php } else { ?>
                      <img src="<?php echo base_url();?>../assets/upload/inactive.png">
                    <?php } ?>
                  </td>
                  <td><?php if(!empty($row->first_name)){ echo $row->first_name.' '.$row->last_name;}else{ echo $emptyString;}?></td>
                 <!-- <td><?php echo @$role[0]->role_title; ?></td> -->
             
                  <td><?php if(!empty($row->login_email)){ echo $row->login_email;}else{ echo $emptyString;}?></td>
                <!--   <td>
                     <a href="<?php echo base_url();?>index.php/page_permission/<?php echo $row->user_id;?>">Manage</a>
        
                  </td>   --> 
                   <td><?php if(!empty($row->created_on)){ echo $row->created_on;}else{ echo $emptyString;}?></td>                                               
                  <td>
                     <a href="<?php echo base_url();?>index.php/sub_admin/sub_admin_edit/<?php echo $row->user_id;?>" class="btn btn-success" title="View"><i class="fa fa-pencil"></i></a>
                   
                    <button type="button" class="btn btn-danger" onclick="delete_data('<?php echo $row->user_id;?>')" title="Delete"><i class="fa fa-trash-o"></i></button>
                  
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
      window.location = base_url+'index.php/sub_admin_list_manage/sub_admin_delete/'+id;
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

   
  function active_sub_admin()
  {
    var checkboxValue =[];
    var checkboxId=[];
    $.each($("input[name='record']:checked"), function()
    {            
      checkboxValue.push($(this).val());
      checkboxId.push(this.id);
    });
    var checkboxId=checkboxId.join(",");
    var checkboxValue=checkboxValue.join(",");
    if(checkboxValue!='')
    {
       $.post(base_url+'index.php/sub_admin_list_manage/sub_admin_active_more_than_one_id',
        {
        
        sub_admin_id:checkboxValue
        },
        function(data,status)
        {
       /* $(".selectCheck").html('<img src="'+base_url+'img/active.png" width="26" >');
          $("#parent_check_id").parent().removeClass('checked');
          $('#parent_check_id').attr('checked', false);
        $(".chtest_test").parent().removeClass('checked');
        $('.chtest_test').attr('checked', false);
        $(".select").removeClass('selectCheck');*/
        alert('Record has been Activated successfully.');
        location.reload();
        });
    }
    else
    {
      alert('Please Select at least one check box.');
    }
    
  }
  
  

  function in_active_sub_admin()
  {
    var checkboxValue =[];
    var checkboxId=[];
    $.each($("input[name='record']:checked"), function()
    {            
      checkboxValue.push($(this).val());
      checkboxId.push(this.id);
    });
    var checkboxId=checkboxId.join(",");
    var checkboxValue=checkboxValue.join(",");
    //alert(checkboxValue);
    if(checkboxValue!='')
    {
       $.post(base_url+'index.php/sub_admin_list_manage/sub_admin_inactive_more_than_one_id',
        {
        sub_admin_id:checkboxValue
        },
        function(data,status)
        {
        
        alert('Record has been inactivated successfully.');
        location.reload();
        });
    }
    else
    {
      alert('Please Select at least one check box.');
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
              
              url:base_url+'index.php/sub_admin_list_manage/change_to_active',
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