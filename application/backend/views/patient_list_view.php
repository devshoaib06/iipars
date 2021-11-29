
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url()?>index.php/sub_admin_list_manage/role_management">Patient management</a></li>
        
      </ol>

         <small><?php
             
            $succ_msg=$this->session->flashdata('flash_msg');
            if($succ_msg){
              ?>
              <br><span style="color:green">
                <?php echo $succ_msg; ?>
              </span>
              <?php
              }
              ?>
              
           
              </small>

    </section>

    <!-- Main content -->
    <section class="content" style="margin-top: 12px;">
      <div class="row">
        <div class="col-xs-12">
          
            
      <div class="box" style="padding: 12px;">


            <div class="box-header">
              <h3 class="box-title">Patient List(<?php echo count($patient_list); ?>)</h3><br><br>
               <span> <a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>index.php/admin_user/add_patient">Add Patient</a> </span>
              
            </div>

             <table width="100%">
            <tr>
            

              <td width="50%" style="padding-left:20.5%">
           
                <a href="javascript:void(0)" class="btn btn-success btn-action" title="Active"  onclick="change_sts_active('active')"><i class="fa fa-pencil-square-o" ></i> Active</a>

                <a href="javascript:void(0)" class="btn btn-danger btn-action" title="Inactive" onclick="change_sts_active('inactive')"><i class="fa fa-pencil-square-o" ></i> Inactive</a>

            </td>
            </tr>
            </table>
            
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="bg-blue">
                <!--  <th>SL No</th> -->
                  <th><input type="checkbox" name="all_chk" id="all_chk" onclick="check_all()"></th>
                  <th>Status</th>
                   <th>Patient Id</th>
                  
                 <th>Patient Name</th>
                  <th>No of Visit</th>

                 <th>Contact Number</th>
                <th>City/Village</th>
                <th>Payment</th>
                 <th>Created on</th>
                 <th>Action</th>
                </tr>
                </thead>
               <tbody>

               <?php 

                      foreach($patient_list as $row)
                      {

                         $prescription=  $this->common->select($table_name='tbl_patient_check_up_history',$field=array(), $where=array('user_id'=>$row->user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
       
               ?>
                <tr>
                   
                	
                	 <td><input type="checkbox" name="record" value="<?php echo $row->user_id; ?>"></td>
                   <td>
                    <?php if($row->status=='active'){ ?>
                      <img src="<?php echo base_url();?>../assets/upload/active.png">
                    <?php } else { ?>
                      <img src="<?php echo base_url();?>../assets/upload/inactive.png">
                    <?php } ?>
                  </td>
                   <td><b><a href="<?php echo base_url();?>index.php/admin_user/show_patient_detail/<?php echo $row->user_id; ?>" target="_blank"><?php echo $row->user_unique_id; ?></a></b></td>

                 <!--   <td>
                        <?php

                              if(count($prescription)>0)
                              {

                              

                        ?>

                        <a class="label label-success" title="My Prescription" href="<?php echo base_url(); ?>index.php/admin_user/edit_patient_prescription/<?php echo  $row->user_id; ?>/<?php echo @$prescription[0]->chk_history_id; ?>"  target="_blank" ><span>My Prescription</span></a>

                        <?php } else {  ?>
                           <a class="label label-warning" title="N/A" href="javascript:void(0);"><span>N/A</span></a>
                        <?php } ?>
                   </td> -->
                	<td> <?php echo $row->first_name.' '.$row->last_name; ?></td>
                    <td> <?php echo $row->visit; ?></td>

                  <td><?php echo $row->mobile; ?></td>
                  
                  <td><?php echo $row->city; ?></td>
                   <td><b><?php echo $row->payment; ?></b></td>
                 
                	<td><?php echo date("d/m/Y", strtotime( $row->created_on )); ?></td>
                	<td>

                    
                       <a  class="btn btn-success btn-sm" title="Edit" href="<?php echo base_url(); ?>index.php/admin_user/edit_patient/<?php echo  $row->user_id; ?>">
                          <i id="" class="fa fa-pencil-square-o"></i>
                       </a>
                      
                          <a href="<?php echo base_url(); ?>index.php/admin_user/delete_patient/<?php echo  $row->user_id; ?>" class="btn-danger btn-sm" name="" id="" onclick="return confirm('Are you sure ?')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                           

                	</td>
                </tr>

                <?php } ?>

                
               </tbody>
              </table>

      </div>

      </div>
    </div>
   </section>


  </div>









  







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
              
              url:base_url+'index.php/admin_user/change_to_active_patient',
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


  