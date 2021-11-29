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

                 if ($this->session->flashdata('message') != "") {
                    echo $this->session->flashdata('message');
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
              <h3 class="box-title">Controller List (<?php echo count($controller_list); ?>)</h3> 
              <a class="btn btn-primary" href="<?php echo base_url();?>index.php/add_controller/add_new_controller" ><i class="fa fa-plus" area-hidden="true"></i> Add Controller </a>
              
            </div>
            <!-- /.box-header -->
            
            <table width="100%">
            <tr>
              <!--<td width="50%"><a href="<?php echo base_url();?>index.php/manage_category/add_category" class="btn btn-primary btn-action" title="Add"><i class="fa fa-pencil-square-o"></i> Add Category</a></td>-->

              <td width="50%">
              <span style="padding-left: 10px">

              <!--<a href="#" onclick="openAddModel()" class="btn btn-primary btn-action" title="Active"  ><i class="fa fa-pencil-square-o" ></i>Add Plan</a>-->


                <!--<a href="javascript:void(0)" class="btn btn-danger btn-action" title="Selected Delete" onclick="delete_selected()"><i class="fa fa-trash-o"></i> Delete</a>-->
            </td>
            </tr>
            </table>
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="bg-blue">
                  
                   <th style="font-size: 0.85em;">SL No</th>
                  
                  <!--<th style="font-size: 0.8em;">SL No</th>-->
                  <th style="font-size: 0.85em;">Title</th>
                  
                  <th style="font-size: 0.85em">Controller Name</th>
                  <th style="font-size: 0.85em;">Management Name</th>

                  <th style="font-size: 0.85em;">Action</th>                                     
                 <!--  <th>State</th>
                  <th>City</th>
                  <th>Address</th> -->
                </tr>
                </thead>
                <tbody>

              <?php
              // echo "<pre>"; print_r($doctor_list); echo "</pre>";
              $sl_no = 1;

              foreach($controller_list as $row1)
              {
                $emptyString='NA';

              ?>
              
                <tr>
                   <td style="font-size: 0.85em"><b><?php echo $sl_no++; ?></b></td>
                  
                  <td style="font-size: 0.85em"><b>  
                      <?php 
                         if(!empty($row1->title))
                         { echo $row1->title; } else
                         {  echo $emptyString; }
                        ?>
                  </b></td>
                 
                  <td style="font-size: 0.85em"><b>
                    <?php 
                    if(!empty($row1->controller))
                    { echo $row1->controller; }
                    else  { echo $emptyString; }
                    ?>
                  </b>
                  </td>
                  <td style="font-size: 0.85em"><b>
                   <?php foreach($management_list  as $row)
                     { 
                       if($row->management_id==$row1->management_id)
                             {
                         echo strtoupper($row->management_name);
                       }
                     }
                     ?>
                  </b></td>
                  <td style="font-size: 0.85em"><b>

                   <?php if(/*@$this->user_page_permission_checki_availablity_view_model->user_page_permission_checki_availablity_left_sidebar_menu('add_controller/controller_edit')=='Y' ||*/ $admin_details[0]->id==1) { ?><a class="btn btn-small btn-warning" href="<?php echo base_url();?>index.php/add_controller/controller_edit/<?php echo $row1->parent_page_id;?>/" > <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a><?php } ?> 
                  <?php if(/*@$this->user_page_permission_checki_availablity_view_model->user_page_permission_checki_availablity_left_sidebar_menu('add_controller/controller_delete')=='Y' ||*/ $admin_details[0]->id==1) { ?>
                   <a class="btn btn-danger" onClick="return delete_data();" href="<?php echo base_url(); ?>index.php/add_controller/controller_delete/<?php echo $row1->parent_page_id;?>"> <i class="fa fa-trash" aria-hidden="true"></i> </a><?php } ?>
             
              </b></td>

                
                </tr>
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

function openedit_model(id)
{

  var base_url='<?php echo base_url();?>';
    var dataString = 'id='+ id ;
    
  
    $.ajax(
    {   
        type: "POST",
        dataType:'json',  
        url:base_url+"index.php?/normal_plan/getSubscriptionPlan",  
        data: dataString,
        async: false,  
        success: function(data)
        {                     
         console.log(data.subscription);
         var value = data.subscription[0].sub_status;
        
          $("#edit_subscription_id").val(id);
          $("#edit_subscription_plan_name").val(data.subscription[0].coverage);
         // $("#edit_credit_value").val(data.subscription[0].credit_value);
          $("#edit_price").val(data.subscription[0].monthly_plan);
          $("#edit_discount_percentage").val(data.subscription[0].yearly_plan);
                  $("#edit_two_year").val(data.subscription[0].two_year);
                  $("#edit_three_year").val(data.subscription[0].three_year);
                  $("#edit_four_year").val(data.subscription[0].four_year);
                  $("#edit_five_year").val(data.subscription[0].five_year);
          //$("#edit_job_post_number").val(data.subscription[0].jobpost_number);
          //$("#edit_resume_download_number").val(data.subscription[0].resume_download_number);
          //$("#edit_sub_expiry").val(data.subscription[0].subscription_period);
          //$("#edit_sub_status_active").prop('checked',true);  
          $('#myEditModal').modal('show');
         }
  });
    return false;

}
function openAddModel()
{
  $('#myAddModal').modal('show');
}
function delete_data(id)
{ 
  if(confirm('Are you sure do you want to delete it?')){
    window.location =   '<?php echo base_url(); ?>index.php/doctor_list/delete_doctor/'+id;
  } 
} 
</script>


    <script>

function change_type(id)
{
  if(confirm("Are you sure ??"))
  {
    var baseurl='<?php echo  base_url();?>';
    window.location=baseurl+'index.php/manage_user/user_type_change/'+id;
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





<script>
    function addplan()
    {
        var coverage=$("#price").val();
        //alert(coverage);
        var yearly_amount= $("#plan_period").val();
       // alert(yearly_amount);
        if(coverage==''||coverage=='0')
        {
            $("#price_message").text('Please Enter Coverage Amount');
            $("#price_message").show();
            $("#price").focus();
            return false;
        }
        else{
            $("#price_message").text('');
            $("#price_message").hide();
        }

        if(yearly_amount==''||yearly_amount=='0')
        {
            $("#sub_message").text('Please Enter Yearly Amount');
            $("#sub_message").show();
            $("#plan_period").focus();
            return false;
        }
        else{
            $("#sub_message").text('');
            $("#sub_message").hide();
        }

    }



    function editplan()
    {
        var coverage=$("#edit_subscription_plan_name").val();
        //alert(coverage);
        var yearly_amount= $("#edit_discount_percentage").val();
        // alert(yearly_amount);
        if(coverage==''|| coverage=='0')
        {
            $("#edit_subscription_plan_message").text('Please enter your value');
            $("#edit_subscription_plan_message").show();
            $("#edit_subscription_plan_name").focus();
            return false;
        }
        else{
            $("#edit_subscription_plan_message").text('');
            $("#edit_subscription_plan_message").hide();
        }

        if(yearly_amount==''||yearly_amount=='0')
        {
            $("#edit_discount_percentage_message").text('Please enter your value');
            $("#edit_discount_percentage_message").show();
            $("#edit_discount_percentage").focus();
            return false;
        }
        else{
            $("#edit_discount_percentage_message").text('');
            $("#edit_discount_percentage_message").hide();
        }

    }
</script>





  <script type="text/javascript">

   function change_sts_active(val)
        {
            //alert(val);
            var user_ids =[];


            $.each($("input[name='record']:checked"), function()
            {            
                user_ids.push($(this).val());
            });

            //alert(cat_ids[0]);
            var base_url='<?php echo base_url(); ?>';
            if(confirm("Are you sure?"))
              {
            if(user_ids.length>0)
            {

            $.ajax({
              
             url:base_url+'index.php/manage_user/change_to_active',
             data:{uid:user_ids,status:val},
             dataType: "json",
             type: "POST",
             success: function(data){


              var perform= data.changedone;

                 if(perform==1)
                 {
                   alert('Status changed successsfully');
                   location.reload();
                 }
                if(perform==2)
                 {
                   alert('due to having product,');
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
}
  
        </script>



<script type="text/javascript">
  
  function in_active_doctor()
  { //alert("hi");
    var checkboxValue =[];
    var checkboxId=[];

    $.each($("input[name='record']:checked"), function()
    {
      checkboxValue.push($(this).val());
      checkboxId.push(this.id);
      //alert($(this).val());
    });
    var checkboxId=checkboxId.join(", ");
    var checkboxValue=checkboxValue.join(", ");
    if(checkboxValue!='')
    {



      if (confirm("Delete checked listing?")){
      //alert(checkboxValue);
      $.post('<?php echo base_url(); ?>index.php/user_management/delete_user_more_than_one/',
        {
          sub_admin_id:checkboxValue
        },
        function(data,status)
        {
          
          var split=checkboxId.split(',');
          var length=split.length;
          var i=0;
          for(i=0;i<length;i++)
          {
            //var status_id=split[i];

            //$('#status_'+split[i]).html('tgreye');
            //alert(status_id);
          }
          //$.post(base_url+'index.php/user_management/doctor_list','refresh');
          //alert('Unit has been Successfully Inactivated.');
          location.reload();
        });

    }


    }
    else
    {
      alert('Please Select at least one check box.');
    }

  }

</script>


