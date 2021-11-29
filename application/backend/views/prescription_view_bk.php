
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url()?>index.php/sub_admin_list_manage/role_management">Prescription</a></li>
        
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
              <h3 class="box-title">Total Prescription(<?php echo count($prescription_list); ?>)</h3><br><br>
               <span> <a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>index.php/admin_prescription/add_prescription">Add Prescription</a> </span>
              
            </div>

            <!--  <table width="100%">
            <tr>
            

              <td width="50%" style="padding-left:20.5%">
           
                <a href="javascript:void(0)" class="btn btn-success btn-action" title="Active"  onclick="change_sts_active('active')"><i class="fa fa-pencil-square-o" ></i> Active</a>

                <a href="javascript:void(0)" class="btn btn-danger btn-action" title="Inactive" onclick="change_sts_active('inactive')"><i class="fa fa-pencil-square-o" ></i> Inactive</a>

            </td>
            </tr>
            </table> -->
            
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="bg-blue">
                 <th>SL No</th>
                 <!--  <th><input type="checkbox" name="all_chk" id="all_chk" onclick="check_all()"></th>
                  <th>Status</th> -->
                 <th>Patient Name</th>
                
                 <th>Created on</th>
                  <th>Review on</th>
                 <th>Action</th>
                </tr>
                </thead>
               <tbody>

             <?php
             $i=0;
                      foreach($prescription_list as $row)
                      {


         $user_detail=  $this->common->select($table_name='tbl_user',$field=array(), $where=array('user_id'=>$row->user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

                        $i++;
              ?>
                <tr>
                   
                	<td>
                <?php echo $i; ?>
                  </td>
                

                 
                	<td> <a href="<?php echo base_url(); ?>index.php/admin_user/show_patient_detail/<?php echo @ $user_detail[0]->user_id ?>"><?php echo @$user_detail[0]->first_name.' '.@$user_detail[0]->last_name.'('.@$user_detail[0]->user_unique_id.')'; ?></a></td>
                  <td>  <?php echo $row->created_date; ?></td>  
                  <td>  <?php echo $row->check_next_date; ?></td> 
                	<td>

                    
                       
                          <a href="<?php echo base_url(); ?>index.php/admin_prescription/delete_prescription/<?php echo $row->chk_history_id; ?>" class="btn-danger btn-sm" name="" id="" onclick="return confirm('Are you sure ?')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>


                           <a class="btn btn-primary" id="print_unit" title="Invoice" href="<?php echo base_url();?>index.php/admin_prescription/individual_invoice/<?php echo $row->chk_history_id; ?>/<?php echo $row->user_id; ?>" ><i class="fa fa-print"></i></a>
                           

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


  