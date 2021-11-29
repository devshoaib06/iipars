
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url()?>index.php/sub_admin_list_manage/role_management">Doctor management</a></li>
        
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
              <h3 class="box-title">Doctor List(<?php echo count($doc_list); ?>)</h3><br><br>
               <span> <a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>index.php/admin_user/add_doctor">Add Doctor</a> </span>
              
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
                 <th>Doctor Name</th>
                 <th>Contact Number</th>
                 <th>Email</th>
                 <th>Created on</th>
                 <th>Action</th>
                </tr>
                </thead>
               <tbody>

               <?php 

                      foreach($doc_list as $row)
                      {
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
                	<td> <a href="<?php echo base_url();?>index.php/admin_user/show_doc_detail/<?php echo $row->user_id; ?>" target="_blank"><?php echo $row->first_name.' '.$row->last_name; ?></a></td>

                  <td><?php echo $row->mobile; ?></td>
                   <td><?php echo $row->login_email; ?></td>

                 
                	<td><?php echo date("d/m/Y", strtotime( $row->created_on )); ?></td>
                	<td>

                    
                       <a  class="btn btn-success btn-sm" title="Edit" href="<?php echo base_url(); ?>index.php/admin_user/edit_doctor/<?php echo  $row->user_id; ?>">
                          <i id="" class="fa fa-pencil-square-o"></i>
                       </a>
                      
                          <a href="<?php echo base_url(); ?>index.php/admin_user/delete_doctor/<?php echo  $row->user_id; ?>" class="btn-danger btn-sm" name="" id="" onclick="return confirm('Are you sure ?')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                           

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
              
              url:base_url+'index.php/admin_user/change_to_active_doc',
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


  