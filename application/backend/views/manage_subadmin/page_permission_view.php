<?php 
 $CI= & get_instance();
 $admin_details=$CI->session_check_and_session_data->admin_session_data();
 
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
     
              <small id="msg" style="color:red"></small>
              <p>
              <?php

                 if ($this->session->flashdata('deleted_msg') != "") {
                    echo $this->session->flashdata('deleted_msg');
                 }
              ?>
              </p>
              
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url()?>index.php/page_permission/<?php echo $this->uri->segment(2); ?>">Page Permission</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
            
            <!-- /.box-header -->
            
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">User Privileges (<?php echo count($admin_page_list);?>)</h3>
              <?php 

              if ($this->session->flashdata('message') != "") {
                echo $this->session->flashdata('message');
              } 


              ?>
            </div>
            <!-- /.box-header -->



            
            <table width="100%">
            <tr>
              <!--<td width="50%"><a href="<?php echo base_url();?>index.php/manage_category/add_category" class="btn btn-primary btn-action" title="Add"><i class="fa fa-pencil-square-o"></i> Add Category</a></td>-->
         <td align="right" style="padding-left:315px;" ><a class="btn btn-primary" id="active_unit" href="javascript:void(0)" onclick="active_page(<?php echo $sub_admin_user_id; ?>)" ><i class="icon-edit icon-white"></i> Allow </a> <a class="btn btn-primary" id="in_active_unit" href="javascript:void(0)" onclick="in_active_unit(<?php echo $sub_admin_user_id; ?>)" ><i class="icon-edit icon-white"></i> Dis-Allow </a></td>

            </tr>
            </table>
            
            <div class="box-body">
              <table id="example44" class="table table-bordered table-striped">
              <span style="">
               <input style="" type="checkbox" name="" id="parent_check_id" onclick="parent_check_checked(this.checked,this.id)" /> Select all from this page
              </span>
                <thead>
                <tr class="bg-blue">


              <th></th>

                  <th>SL No.</th>
                  <th>Status</th>
                  <th>Page Title</th>
                </tr>
                </thead>


             

             <?php
             foreach ($sub_admin_management_list as $row) {
              $admin_page_list_by_management=$this->page_permission_model->all_permission_page_listing_by_management($sub_admin_user_id,$row->management_id);
               ?>

                <tbody>
                  <td style="background-color: #ccc;border: none;border-bottom: 2px;border-bottom: solid 2px #fff;"></td>
                  <td style="background-color: #ccc;border: none;border-bottom: 2px;border-bottom: solid 2px #fff;"></td>
                  <td style="background-color: #ccc;border: none;border-bottom: 2px;border-bottom: solid 2px #fff;"></td>
                  <td style="background-color: #ccc;border: none;border-bottom: 2px;border-bottom: solid 2px #fff;"><b><?php echo $row->management_name; ?></b></td>
                </tbody>


                <tbody>

              <?php
              // echo "<pre>"; print_r($doctor_list); echo "</pre>";
              $sl_no = 1;

              foreach($admin_page_list_by_management as $row)
              {
                $emptyString='NA';
              ?>
              
                <tr>

              <td style="width:1px"><input type="checkbox" name="check_id" id="<?php echo $row->parent_page_id;?>"  class="chtest_test" onClick="single_check_box_checked(this.checked,this.id)" value="<?php echo $row->parent_page_id;?>"/></td>
              
                  <td style="font-size: 0.85em"><b><?php echo $sl_no++; ?></b></td>

                   <td  style="width:1px;"><span class="select" id="select_<?php echo $row->parent_page_id;?>">
                <?php if($row->is_view=='Y'){?>
                <span style="display:none">active</span><img src="<?php echo base_url();?>img/active.png" width="26" alt="active" >
                <?php } else if($row->is_view=='N') {?>
                <span style="display:none">In-active</span><img src="<?php echo base_url();?>img/inactive.png" width="26" alt="In-active"  >
                <?php } else {?>
                 <span style="display:none">In-active</span><img src="<?php echo base_url();?>img/inactive.png" width="26" alt="In-active"  >
                 <?php } ?>
                </span></td>
              <td><?php if(!empty($row->title)){ echo $row->title;}else{ echo $emptyString;}?></td>


                    
                </tr>
       <?php } ?>
       </tbody>

       <?php } ?>


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
    


<!---Edit Subscription Modal -->
<!-- Modal -->
  <div class="modal fade" id="myEditModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-body">
          




  <?php echo form_open_multipart('index.php/normal_plan/edit_subscription_plan', array('class' => 'form-horizontal', 'id' => 'adduserrole_frm')); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Edit Subscription </h3>
      </div>
          <div class="modal-body">
              <div>
              <fieldset>   
                <input type="hidden" name="edit_subscription_id" id="edit_subscription_id" />       
                  <div class="control-group" id="edit_subscription_control"><span class="control-label">Coverage</span>
                    <div class="controls">
                    
                      <input type="text" id="edit_subscription_plan_name" class="form-control" name="edit_coverage" onblur="edit_subscription_plan_name_onblur()"/> Lakh
                     <br> <span class="help-inline" id="edit_subscription_plan_message" style="display:none; color:red"></span> </div>
                  </div> 
                   
                   
                   <div class="control-group" id="edit_discount_control">
                     <label class="control-label" for="inputSuccess2">Yearly Amount</label>
                     <div class="controls">
                      <input type="text" id="edit_discount_percentage" class="form-control" name="edit_yearly_amount" onblur="edit_discount_percentage_onblur()"/>
                     <br> <span class="help-inline" id="edit_discount_percentage_message" style="display:none; color:red"></span> </div>
                  </div>

                  
                                     
                </fieldset>
               </div>
          </div>
          <div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
            <button type="submit" class="btn btn-primary" onclick="return editplan()" >Update</button>
          </div>
      </form>





        </div>
      </div>
      
    </div>
  </div>






<!---Add specialization Modal -->
<!-- Modal -->
  <div class="modal fade" id="myAddModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-body">





  <?php echo form_open_multipart('index.php/normal_plan/add_subscription_plan', array('class' => 'form-horizontal', 'id' => 'adduserrole_frm')); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Add Subscription </h3>
      </div>
          <div class="modal-body">
              <div>
              <fieldset>          
                  <div class="control-group" id="subscription_plan_control">
                   
                  </div>
                  
                  <div class="control-group" id="price_control">
                    <label class="control-label" for="inputSuccess">Coverage</label>
                    <div class="controls">
                      <input type="text" id="price" class="form-control" name="coverage" onblur="price_onblur()"/>&nbsp&nbsp;Lakh
                     <br> <span class="help-inline" id="price_message" style="display:none; color:red"></span> </div>
                  </div>                   
                 
                  <div class="control-group" id="resume_download_control">
                    <label class="control-label" for="inputSuccess">Yearly Amount</label>
                    <div class="controls">
                      <input type="text" id="plan_period" class="form-control" name="yearly_amount" onblur=""/>
                   <br> <span class="help-inline" id="sub_message" style="display:none; color:red"></span></div>
                  </div>
                </fieldset>
               </div>
          </div>
          <div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
            <button type="submit" class="btn btn-primary" onclick=" return addplan()">Add</button>
          </div>
      </form>







        </div>
      </div>
      
    </div>
  </div>





 
<script language="javascript" type="text/javascript">
  var base_url = '<?php echo base_url(); ?>';


  function delete_data(id)
  { 
    if(confirm('Are you sure do you want to delete it?'))
    {
      window.location = base_url+'index.php/admin_page_list_manage/unit_delete/'+id;
    } 
  } 
  
  
  function filter_allow_disallow(id)
  { 
      window.location = base_url+'index.php/page_permission/'+id;
      
  } 
  
  
  
  function unitActivateInactive(id,value)
  {
      $.post(base_url+'index.php/admin_page_list_manage/unit_active_inactive/',
      {
      id:id,
      value:value
      },
      function(data,status)
      {
        //alert(value)
        if(value.trim()=='Y')
        {
        alert("Unit has been Activate successfully ");
        }
        else
        {
         alert("Unit has been In-activate successfully "); 
        }
      });
  } 
</script> 
<script>

function single_check_box_checked(isChecked,id)
{
  
      if(isChecked==true)
    {
      $("#select_"+id).addClass('selectCheck');
      $("#"+id).parent().addClass('checked');
      $("#"+id).attr('checked',true);
      
    }
    else if(isChecked==false)
    {
      $("#select_"+id).removeClass('selectCheck');
      $("#"+id).parent().removeClass('checked');
      $("#"+id).attr('checked', false);
    }
  
}


function parent_check_checked(isChecked,id)
{
  //alert(isChecked)
  if(isChecked==true)
  {
    $("#"+id).prop('checked', true);
    $(".select").addClass('selectCheck');
    $(".chtest_test").prop('checked', true);
    $('.chtest_test').prop('checked', true);
    
  }
  else if(isChecked==false)
  {
      $("#"+id).prop('checked', false);
    $(".select").removeClass('selectCheck');
    $(".chtest_test").prop('checked', false);
    $('.chtest_test').prop('checked', false);
  }
}
  


  
  function active_page(user_id)
  {
    var checkboxValue =[];
    var checkboxId=[];
    $.each($("input[name='check_id']:checked"), function()
    {            
      checkboxValue.push($(this).val());
      checkboxId.push(this.id);
    });
    var checkboxId=checkboxId.join(", ");
    var checkboxValue=checkboxValue.join(", ");
    if(checkboxValue!='')
    {
       $.post(base_url+'index.php/page_permission/permission_allow_more_than_one_id/',
        {
        page_id:checkboxValue,
        user_id:user_id
        },
        function(data,status)
        {
        $(".selectCheck").html('<img src="'+base_url+'img/active.png" width="26" >');
          $("#parent_check_id").parent().removeClass('checked');
          $('#parent_check_id').attr('checked', false);
        $(".chtest_test").parent().removeClass('checked');
        $('.chtest_test').attr('checked', false);
        $(".select").removeClass('selectCheck');
        alert('Page has been allowed to view.');
        });
    }
    else
    {
      alert('Please Select at least one check box.');
    }
    
  }
  
  

  function in_active_unit(user_id)
  {
    var checkboxValue =[];
    var checkboxId=[];
    $.each($("input[name='check_id']:checked"), function()
    {            
      checkboxValue.push($(this).val());
      checkboxId.push(this.id);
    });
    var checkboxId=checkboxId.join(", ");
    var checkboxValue=checkboxValue.join(", ");
    if(checkboxValue!='')
    {
       $.post(base_url+'index.php/page_permission/permisson_dis_allow_more_than_one_id/',
        {
        page_id:checkboxValue,
        user_id:user_id
        },
        function(data,status)
        {
        $(".selectCheck").html('<img src="'+base_url+'img/inactive.png" width="26" >');
        $("#parent_check_id").parent().removeClass('checked');
        $('#parent_check_id').attr('checked', false);
        $(".chtest_test").parent().removeClass('checked');
        $('.chtest_test').attr('checked', false);
        $(".select").removeClass('selectCheck');
        
        var split=checkboxId.split(',');
        var length=split.length;
        var i=0;
        for(i=0;i<length;i++)
        {
          //var status_id=split[i];
          
          //$('#status_'+split[i]).html('tgreye');
          //alert(status_id);
        }
        alert('Page has been dis-allowed to view.');
        });
    }
    else
    {
      alert('Please Select at least one check box.');
    }
    
  }

</script> 
