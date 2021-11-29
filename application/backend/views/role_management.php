<?php
  
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url()?>index.php/sub_admin_list_manage/role_management">Role management</a></li>
        
      </ol>

         <?php
            if ($this->session->flashdata('flash_msg') != "") {
               echo $this->session->flashdata('flash_msg');
            }
         ?>

    </section>

    <!-- Main content -->
    <section class="content" style="margin-top: 12px;">
      <div class="row">
        <div class="col-xs-12">
          
            
      <div class="box" style="padding: 12px;">


            <div class="box-header">
              <h3 class="box-title">Role management</h3>
               <span> <span class="btn btn-primary btn-sm" onclick="add_role_modal();">Add new role</span> </span>
              
            </div>
            
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <!--  <th>SL No</th> -->
                 <th>SL No.</th>
                 
                 <th>Role title</th>
                 <!-- <th>Number of users</th> -->
                 <th>Created on</th>
                 <th>Action</th>
                </tr>
                </thead>
               <tbody>

               <?php
               $sl = 0;
               foreach ($role_data as $row) {
               	 
               
               ?>
                <tr>
                   <!--  <td><?php echo $sl++; ?></td> -->
                	
                	<td><?php echo $sl; ?></td>
                	<td><?php echo $row->role_title ?></td>
                	<!-- <td><?php  ?></td> -->
                	<td><?php echo date("d/m/Y", strtotime( $row->created_date )); ?></td>
                	<td>
                		
                       <a id="edit_role_btn_<?php echo $row->role_id; ?>" class="btn btn-success btn-sm" title="Edit" href="javascript:void(0);" onclick="edit_role(<?php echo $row->role_id; ?>);">
                          <i id="edit_role_icon_<?php echo $row->role_id; ?>" class="fa fa-pencil-square-o"></i>
                       </a>
                       <?php $del_role=$this->admin_model->selectOne('tbl_user','role_id',$row->role_id);
                              if(count($del_role)=="")
                              {
                        ?>
                         <a href="<?php echo base_url(); ?>index.php/sub_admin_list_manage/delete_role/<?php echo $row->role_id; ?>" class="btn-danger btn-sm" name="" id="" onclick="return confirm('Are you sure ?')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                         <?php } ?>

                	</td>
                </tr>

                <?php  } ?>

               </tbody>
              </table>

      </div>

      </div>
    </div>
   </section>


  </div>









  


<!--- Add new role Modal -->
<!-- Modal -->
  <div class="modal fade" id="add_role_modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">

  <?php echo form_open_multipart('sub_admin_list_manage/add_role_action', array('class' => 'form-horizontal', 'id' => 'add_role_form')); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Submit new case</h3>
      </div>
          <div class="modal-body">
              <div>
              <fieldset>   
                   
                  <div class="control-group" id="edit_discount_control">
                     <label class="control-label" for="inputSuccess2">Role name</label>
                     <div class="controls">
                       <input type="text" name="role_title" id="role_title" class="form-control" placeholder=""  value="" autocomplete="off">
                     <br> 
                     </div>
                  </div>
                   
                </fieldset>
               </div>
          </div>
          <div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
            <button type="submit" class="btn btn-primary" onclick="return add_role_validation()" >Add</button>
          </div>
      </form>

        </div>
      </div>
      
    </div>
  </div>






<!--- Add new role Modal -->
<!-- Modal -->
  <div class="modal fade" id="edit_role_modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">

  <?php echo form_open_multipart('sub_admin_list_manage/edit_role_action', array('class' => 'form-horizontal', 'id' => 'edit_role_form')); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Edit role</h3>
      </div>
          <div class="modal-body">
              <div>
              <fieldset>   
                   
                  <div class="control-group" id="edit_discount_control">
                     <input type="hidden" name="role_id_ed" id="role_id_ed">
                     <label class="control-label" for="inputSuccess2">Role name</label>
                     <div class="controls">
                       <input type="text" name="role_title_ed" id="role_title_ed" class="form-control" placeholder=""  value="" autocomplete="off">
                     <br> 
                     </div>
                  </div>
                   
                </fieldset>
               </div>
          </div>
          <div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
            <button type="submit" class="btn btn-primary" onclick="return edit_role_validation()" >Update</button>
          </div>
      </form>

        </div>
      </div>
      
    </div>
  </div>








  <script type="text/javascript">
  	function add_role_modal()
  	{
  		$('#add_role_modal').modal('show');
  	}



function add_role_validate()
{
	var role_title = $('#role_title').val();

      if (role_title == "") {
        $('#role_title').removeClass('black_border').addClass('red_border');
      } else {
        $('#role_title').removeClass('red_border').addClass('black_border');
      }

}
 function add_role_validation()
 {
    $('#add_role_form').attr('onchange', 'add_role_validate()');
    $('#add_role_form').attr('onkeyup', 'add_role_validate()');

     add_role_validate();
    //alert($('#contact_form .red_border').size());

    if ($('#add_role_form .red_border').size() > 0)
    {
      $('#add_role_form .red_border:first').focus();
      $('#add_role_form .alert-error').show();
      return false;
    } else {

      $('#add_role_form').submit();
    }

 }








function edit_role_validate()
{
	var role_title = $('#role_title_ed').val();

      if (role_title == "") {
        $('#role_title_ed').removeClass('black_border').addClass('red_border');
      } else {
        $('#role_title_ed').removeClass('red_border').addClass('black_border');
      }

}
 function edit_role_validation()
 {
    $('#edit_role_form').attr('onchange', 'edit_role_validate()');
    $('#edit_role_form').attr('onkeyup', 'edit_role_validate()');

     edit_role_validate();
    //alert($('#contact_form .red_border').size());

    if ($('#edit_role_form .red_border').size() > 0)
    {
      $('#edit_role_form .red_border:first').focus();
      $('#edit_role_form .alert-error').show();
      return false;
    } else {

      $('#edit_role_form').submit();
    }

 }








function edit_role(role_id)
{
	
$.ajax(
    {   
        type: "POST",
        dataType:'json',  
        url:"<?php echo base_url();?>index.php/sub_admin_list_manage/edit_role_json",  
        data: {role_id:role_id},
        //async: false,
        success: function(data)
        {                     
         //console.log(data[0]);
         console.log(data);
         $('#edit_role_modal').modal('show');
         $('#role_title_ed').val(data[0].role_title);
         $('#role_id_ed').val(data[0].role_id);

      }
  });

      

}

  </script>