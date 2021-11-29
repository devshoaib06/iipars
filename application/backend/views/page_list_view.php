<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>
      MANAGE PAGES 
       
        
      </h3>
      <small><?php
             
            $succ_msg=$this->session->flashdata('message');
            if($succ_msg){
              ?>
              <br><span style="color:green">
                <?php echo $succ_msg; ?>
              </span>
              <?php
              }
              ?>
              
           
              </small>
             
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url()?>index.php/page_list_manage/">Page List</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
            
            <!-- /.box-header -->
            
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Page(<?php echo count($page_list ); ?>)</h3>
            </div>
            <!-- /.box-header -->
            
            <table width="100%">
            <tr>
              <td width="30%"><a href="<?php echo base_url();?>index.php/page/add_page" class="btn btn-primary btn-action" title="Add"><i class="fa fa-pencil-square-o"></i> Add Page</a></td>

             <td width="30%"> Show as:&nbsp;
            <select style="width:85px" id="activeInactive" onchange="filterInactiveActive(this.value)" >
              <option value="">All</option>
              <option value="active" <?php if($active_inactive_value=='active'){ ?> selected="selected"<?php }?>>Active</option>
              <option value="in-active" <?php if($active_inactive_value=='in-active'){ ?> selected="selected"<?php }?>>In-Active</option>
            </select>

              <td width="40%">
              
              <a href="javascript:void(0)" class="btn btn-success btn-action" title="Active"  onclick="active_page()"><i class="fa fa-pencil-square-o" ></i> Active</a>

                <a href="javascript:void(0)" class="btn btn-danger btn-action" title="Inactive" onclick="in_active_page()"><i class="fa fa-pencil-square-o" ></i> Inactive</a>

               <!-- <a href="javascript:void(0)" class="btn btn-danger btn-action" title="Selected Delete" onclick="selected_delete()"><i class="fa fa-trash-o"></i> Delete</a>-->

            </td>
            </tr>
            </table>
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><input type="checkbox" name="" id="parent_check_id" onclick="parent_check_checked(this.checked,this.id)" /></th>
                  <th>Status</th>
                  <th>Page Name</th>
                 
                  <th>Section</th>
                  
                  <th>Created Date</th>
                  <th>Edited Date</th>
                  <th>Action</th>
                   </tr>
                </thead>
                <tbody>

               <?php $i=0; 
                if(count($page_list )>0)
                {
        //echo 'test'; exit();
              foreach($page_list  as $row)
                {
                $i++;
          
                $emptyString='NA';
          
                ?>
               
                
                <tr>
                  <td>
                  <input type="checkbox" name="check_id" id="<?php echo $row->id; ?>"
                   onClick="single_check_box_checked(this.checked,this.id)" value="<?php echo $row->id;?>" class="chtest_test"></td>
                  <td><img src="<?php 

                  $sts=$row->is_active;
                  if($sts=="Y")
                                    {
                  echo base_url()."../assets/upload/active.png";
                  }
                  else
                  {
                    echo base_url()."../assets/upload/inactive.png";
                  }?>">

                 </td>

                  
                  
                  <td> <?php if(!empty($row->page_title)){ echo $row->page_title;}else{ echo $emptyString;}?></td>

                  <td>
                  <?php if(!empty($row->menu_section_title)){ echo $row->menu_section_title;}else{ echo $emptyString;}?></td>

                  

                  <td><?php if(!empty($row->added_time_stamp)){ echo $createDate=date('M d,Y',$row->added_time_stamp);}else{ echo $emptyString;}?></td>
                  <td>
                  <?php if(!empty($row->edited_time_stamp)){ echo $editDate=date('M d,Y',$row->edited_time_stamp);}else{ echo $emptyString;}?>
                    
                  </td>
                  <td> <a href="<?php echo base_url();?>index.php/page/page_edit/<?php echo $row->id;?>/" class="btn btn-info btn-action"  title=" Edit"><i class="fa fa-pencil-square-o"></i></a>
                   </td>
                </tr>
                <?php }}?>
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
    <script language="javascript" type="text/javascript">

    var base_url='<?php echo base_url(); ?>';

  function delete_data(id,menu_id)
  { 
    if(confirm('Are you sure do you want to delete it?'))
    {
      window.location = base_url+'index.php/page_list_manage/page_delete/'+id+'/'+menu_id;
    } 
  } 
  
  
  function filterInactiveActive(id)
  { 
    
      window.location = base_url+'index.php/page_list_manage/'+id;
      
  } 
  
  
  
  function unitActivateInactive(id,value)
  {
      $.post(base_url+'index.php/page_list_manage/unit_active_inactive/',
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
    $("#"+id).attr('checked',true);
    $(".select").addClass('selectCheck');
    $(".chtest_test").parent().addClass('checked');
    $('.chtest_test').attr('checked','checked');
    
  }
  else if(isChecked==false)
  {
      $("#"+id).attr('checked',false);
    $(".select").removeClass('selectCheck');
    $(".chtest_test").parent().removeClass('checked');
    $('.chtest_test').attr('checked', false);
  }
}
  


  
  function active_page()
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
       $.post(base_url+'index.php/page_list_manage/page_active_more_than_one_id/',
        {
        id:checkboxValue
        },
        function(data,status)
        {
        $(".selectCheck").html('<img src="'+base_url+'img/active.png" width="26" >');
          $("#parent_check_id").parent().removeClass('checked');
          $('#parent_check_id').attr('checked', false);
        $(".chtest_test").parent().removeClass('checked');
        $('.chtest_test').attr('checked', false);
        $(".select").removeClass('selectCheck');
        alert('Page has been Activared successfully.');
        location.reload();
        });
    }
    else
    {
      alert('Please Select at least one check box.');
    }
    
  }
  
  

  function in_active_page()
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
       $.post(base_url+'index.php/page_list_manage/page_in_active_more_than_one_id/',
        {
        id:checkboxValue
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
        alert('Page has been inActivated successfully.');
        location.reload();
        });
    }
    else
    {
      alert('Please Select at least one check box.');
    }
    
  }

</script> 