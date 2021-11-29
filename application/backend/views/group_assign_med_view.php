
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url()?>index.php/sub_admin_list_manage/role_management">Group management</a></li>
        
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
              <h3 class="box-title">Assigned Medicines for <?php $grp_name=$this->admin_model->selectOne('tbl_group','group_id',$grp_id); echo @$grp_name[0]->group_name; ?></h3><br><br>
              <!--  <span> <span class="btn btn-primary btn-sm" onclick="add_role_modal();">Add Group</span> </span> -->

              
            </div>

             <table width="100%">
         
            </table>
            
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL No</th> 
                
               <th> Medicine Name</th> 
                
               
                </tr>
                </thead>
               <tbody>

               <?php
               $sl = 1;
               foreach ($medicines as $med) {

                 $med_name=$this->admin_model->selectOne('tbl_medicine','medicine_id',$med->medicine_id);
               	 
               
               ?>
                <tr>
                    <td><?php echo $sl++; ?></td> 
                	
                	
                  
                	<td><?php echo @$med_name[0]->medicine_name; ?></td>
            
                	
                </tr>

                <?php  } ?>

               </tbody>
              </table>

      </div>

      </div>
    </div>
   </section>


  </div>









  


