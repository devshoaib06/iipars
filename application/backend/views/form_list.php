<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Manage Service Data
       
        
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
        <li><a href="<?php echo base_url()?>index.php/index.php/sub_admin_list_manage">Service Data List</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
            
            <!-- /.box-header -->
            
          <div class="box">
            <!-- <div class="box-header">
              <h3 class="box-title">Total  Form(<?php echo count($form_list ); ?>)</h3>
            </div> -->
            <!-- /.box-header -->
            
            <table width="100%">
            <tr>

               <?php 

                $admin_details=$this->session_check_and_session_data->admin_session_data();

                if(@$admin_details[0]->user_type_id!='1')
                {
            ?>
              <td width="50%"><a href="<?php echo base_url();?>index.php/Admin_datalist/add_examination" class="btn btn-primary btn-action" title="Add"><i class="fa fa-pencil-square-o"></i> Add Service Data</a></td>

            <?php } ?>

              <td width="50%" style="padding-left:20.5%">
              <!--<span style="padding-left: 80.5%">-->
            <!--  <a href="javascript:void(0)" class="btn btn-success btn-action" title="Active"  onclick="active_sub_admin()"><i class="fa fa-pencil-square-o" ></i> Active</a>

                <a href="javascript:void(0)" class="btn btn-danger btn-action" title="Inactive" onclick="in_active_sub_admin()"><i class="fa fa-pencil-square-o" ></i> Inactive</a>
 -->

  <?php 

                $admin_details=$this->session_check_and_session_data->admin_session_data();

                if(@$admin_details[0]->user_type_id=='1')
                {
            ?>
                <a href="javascript:void(0)" class="btn btn-success btn-action" title="Active"  onclick="change_sts_active('active')"><i class="fa fa-pencil-square-o" ></i> Approve</a>

                <a href="javascript:void(0)" class="btn btn-danger btn-action" title="Inactive" onclick="change_sts_active('inactive')"><i class="fa fa-pencil-square-o" ></i> Reject</a>
 <?php } ?>
            </td>
            </tr>
            </table>
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="bg-blue">

                   <?php 

                $admin_details=$this->session_check_and_session_data->admin_session_data();

                if(@$admin_details[0]->user_type_id=='1')
                {
            ?>
                  <th><input type="checkbox" name="all_chk" id="all_chk" onclick="check_all()"></th>
                  <?php } ?>
                  <th>Approve</th>
 

  
                   <th>Institute</th>
                    <th>Subject</th>
                     <th>Service</th>
                      <th>Title</th>

                      <?php 

                $admin_details=$this->session_check_and_session_data->admin_session_data();

                if(@$admin_details[0]->user_type_id=='1')
                {
            ?>
                    <th>Added by</th>

                     <?php } ?>
                       <th>Added On</th>


                        <!-- <th>Edited On</th> -->
          
                  
                
                 
             
             
              <th>Action</th>
                </tr>
                </thead>
                <tbody>

               <?php $i=0; 
            if(count($form_list )>0)
            {
        
                foreach($form_list  as $row)
                {
                  $i++;

                  $added_by=$this->admin_model->selectOne('tbl_user','user_id',$row->added_by);
                  $university=$this->admin_model->selectOne('tbl_university','university_id',$row->university_id);
                  $subject=$this->admin_model->selectOne('tbl_kpo','kpo_id',$row->subject_id);
                  $service=$this->admin_model->selectOne('tbl_examination','examination_id',$row->service_id);
                  
                  $emptyString='N/A';
                  
                  ?>
              
                <tr>

                   <?php 

                $admin_details=$this->session_check_and_session_data->admin_session_data();

                if(@$admin_details[0]->user_type_id=='1')
                {
            ?>
                  <td><input type="checkbox" name="record" value="<?php echo $row->form_id;?>"></td>
                  <?php } ?>
                  <td>
                    <?php if($row->status=='active'){ ?>
                      <img src="<?php echo base_url();?>../assets/upload/active.png">
                    <?php } else { ?>
                      <img src="<?php echo base_url();?>../assets/upload/inactive.png">
                    <?php } ?>
                  </td>
                 

                   
                  <td><?php echo @$university[0]->university;?></td>
                  <td><?php echo @$subject[0]->kpo_name;?></td>


                  <td><?php echo @$service[0]->examination_name;?></td>
                  <td><?php echo @$row->title;?></td>

                  <?php 

                $admin_details=$this->session_check_and_session_data->admin_session_data();

                if(@$admin_details[0]->user_type_id=='1')
                {
            ?>
                  <td><?php echo @$added_by[0]->first_name.' '.@$added_by[0]->last_name; ?></td>
                <?php } ?>
                  <td><?php echo date("d/m/Y", strtotime( $row->added_date )); ?></td>


                <!--  <td><?php  if($row->edited_date =""){ echo date("d/m/Y", strtotime( $row->edited_date ));} else {echo 'N/A';}  ?></td> -->
             
                 
                                                         
                  <td>

                    <?php if($row->status=='inactive' && @$admin_details[0]->user_type_id!='1'){ ?>
                     <a href="<?php echo base_url();?>index.php/Admin_datalist/form_edit/<?php echo $row->form_id;?>" class="btn btn-success" title="View"><i class="fa fa-pencil"></i></a>

                     <?php } ?>
                    <a target="_blank" href="<?php echo base_url();?>index.php/Admin_datalist/form_view/<?php echo $row->form_id;?>" class="btn btn-info" title="View"><i class="fa fa-eye"></i></a>
                   <!--  <button type="button" class="btn btn-danger" onclick="delete_data('<?php echo $row->form_id;?>')" title="Delete"><i class="fa fa-trash-o"></i></button> -->
                  
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
      window.location = base_url+'index.php/admin_service/examination_delete/'+id;
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
              
              url:base_url+'index.php/Admin_datalist/change_to_active_examination',
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