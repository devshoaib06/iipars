<?php 
 $CI= & get_instance();
 $admin_details=$CI->session_check_and_session_data->admin_session_data();
 
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
     
              <small id="msg" style="color:red"></small>
              <p style='color:green'>
              <?php

                 if ($this->session->flashdata('flash_msg') != "") {
                    echo $this->session->flashdata('flash_msg');
                 }

              ?>
              </p>
              
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url()?>index.php/add_controller">Add controller</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
            
            <!-- /.box-header -->

            
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add Controller (<?php echo count($management_list ); ?>)</h3>
              
            </div>
            <!-- /.box-header -->
            






 <div class="box-content">
     <?php if($this->session->flashdata('message')) { ?> 
        <table class="table table-striped table-bordered bootstrap-datatable ">
          <tr>
            <td width="100%" colspan="2" style=" text-align:center"><span style="color:#F00"><?php echo $this->session->flashdata('message'); ?></span></td>
          </tr>
        </table>
         <?php } ?>
      <div class="box-content">
        <form action="<?php echo base_url();?>index.php/add_controller/controller_update" method="post" id="add_page">
         <table class="table table-striped table-bordered bootstrap-datatable">         
               
               
                    
             
                      
               
               </table>   
                 <table class="table table-striped table-bordered bootstrap-datatable">  
                 <tr>
                <td colspan="2" style="padding-left:410px;"><strong> CONTROLLER  </strong></td> 
               </tr>  
                     
                <tr id="page_type_box">
                <td style="width:20%;"><strong>Management</strong></td> 
                <td><select id="management" name="management"  style="width:56%">
                
                <?php 
        foreach($management_list as $row) 
        {
          
          ?>
                <option value="<?php echo $row->management_id ?>" <?php if($row->management_id==$controller_list[0]->management_id){echo "selected";}?> ><?php echo $row->management_name ?></option>
                <?php } ?>
                </select>
               
                </td>
              </tr> 
                
             </tr>  
                     
                <tr id="page_type_box">
                <td style="width:20%;"><strong>Title</strong></td> 
                <td><input type="text" id="title" name="title" value="<?php echo $controller_list[0]->title; ?>" style="width:56%"/>
               
                </td>
              </tr> 
                
              
                </tr>  
                     
                <tr id="page_type_box">
                <td style="width:20%;"><strong>Name</strong></td> 
                <td><input type="text" id="controller" name="controller" value="<?php echo $controller_list[0]->controller; ?>" style="width:56%"/>
                <input type="hidden" name="id" value="<?php echo $controller_list[0]->parent_page_id; ?>" >
                </td>
              </tr>    
                 
                       
        </table>
      
        
        <section class="controls"> <input type="submit" class="btn btn-primary" id="addProductSubmit" value="SUBMIT" >   <a href="<?php echo base_url(); ?>index.php/add_controller" class="btn btn-danger" id="addProductSubmit" onClick="return UnitAddEdit()" ><i class="icon-backward icon-white"></i>  BACK </a> </section>
        </form>
        <section class="controls pull-right"> <a class="btn btn-primary" id="addProductSubmit" onClick="return addPageValidation()" > SUBMIT </a>  <a href="<?php echo base_url(); ?>index.php/add_controller" class="btn btn-danger" id="addProductSubmit" onClick="UnitAddEdit()" ><i class="icon-backward icon-white"></i>  BACK </a> </section>
      </div>
    </div>








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
    

<script type="text/javascript" src="<?php echo base_url(); ?>custom_script/add_page_validation_validation.js" ></script> 
<script type="text/javascript">
function addPageValidation()
{
  //alert('ok');
  //$('#add_page').attr('onchange','add_page_validation()');
//  $('#add_page').attr('onkeyup','add_page_validation()');
//  //var action='focus'; 
//  add_page_validation()
//  
//  $('#management').trigger("focusout");     
//
//  
//  if ($('#add_page .red_border').size()>0) 
//  {
//    $('#add_page .red_border:first').focus();
//     return false;
//  }
//  else
//  {
     $("#add_page").submit();
  //} 
}
</script> 


