
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url()?>index.php/sub_admin_list_manage/role_management">Subject management</a></li>
        
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
              <h3 class="box-title">Subject (<?php  echo count($kpo_list);?>)</h3><br><br>
               <span> <span class="btn btn-primary btn-sm" onclick="add_role_modal();">Add New Subject</span> </span>
              
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
                  <th>Subject Image</th>
                 <th>Subject Name</th>
                 <!-- <th>Number of users</th> -->
                 <th>Created on</th>
                 <th>Action</th>
                </tr>
                </thead>
               <tbody>

               <?php
               $sl = 0;
               foreach ($kpo_list as $row) {
               	 
               
               ?>
                <tr>
                   <!--  <td><?php echo $sl++; ?></td> -->
                	
                	 <td><input type="checkbox" name="record" value="<?php echo $row->kpo_id;?>"></td>
                   <td>
                    <?php if($row->status=='active'){ ?>
                      <img src="<?php echo base_url();?>../assets/upload/active.png">
                    <?php } else { ?>
                      <img src="<?php echo base_url();?>../assets/upload/inactive.png">
                    <?php } ?>
                  </td>
                  <td><img src="<?php echo base_url();?>../assets/upload/subject_image/<?php echo $row->subject_image;  ?>"  alt="no image" height="60px" width="150px" style="border-radius: 0%"></td>
                	<td><a href="<?php echo base_url();?>index.php/admin_chamber/form_list/<?php echo $row->kpo_id;?>/kpo" target="_blank"><?php echo $row->kpo_name; ?></a></td>
                	<!-- <td><?php  ?></td> -->
                	<td><?php echo date("d/m/Y", strtotime( $row->created_date )); ?></td>
                	<td>
                		
                       <a id="edit_role_btn_<?php echo $row->kpo_id; ?>" class="btn btn-success btn-sm" title="Edit" href="javascript:void(0);" onclick="edit_kpo(<?php echo $row->kpo_id; ?>);">
                          <i id="edit_role_icon_<?php echo $row->kpo_id; ?>" class="fa fa-pencil-square-o"></i>
                       </a>
                      
                          <a href="<?php echo base_url()?>index.php/admin_service/kpo_delete/<?php echo $row->kpo_id; ?>" class="btn-danger btn-sm" name="" id="" onclick="return confirm('Are you sure ?')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                        

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


      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Add Subject</h3>
      </div>
          <div class="modal-body">
              <div>
              <fieldset>   
                   <form action="<?php echo base_url(); ?>index.php/admin_service/add_kpo_action" id="add_role_form" enctype="multipart/form-data" method="post">

                  <div class="control-group" id="edit_discount_control">
                     <label class="control-label" for="inputSuccess2">Subject name<span style="color: rgb(255, 0, 0); padding-left: 2px;">*</span></label>
                     <div class="controls">
                       <input type="text" name="kpo_name" id="kpo_name" class="form-control" placeholder="" required=""  autocomplete="off">
                     <br> 
                     </div>
                  </div>


                  <div class="control-group">
                    <label for="image" class="col-sm-2 control-label">Image<span style="color: rgb(255, 0, 0); padding-left: 2px;">*</span></label>

                    <div class="controls">
                      <input type="file" name="image" class="form-control"  id="image" onchange="readURL(this);">

                       <img id="prof_pic" src="<?php echo base_url()?>../assets/upload/no-image.jpg"  alt="User Image" style="margin-top: 10px;width:60px;height:60px;" />
                      
                        <span id="img_eror" style="color: red;"></span>
                    </div>
                 
                  </div>


                  </form>
                   
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

  
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Edit Subject</h3>
      </div>
          <div class="modal-body">
              <div>
              <fieldset>   
                   <form action="<?php echo base_url(); ?>index.php/admin_service/edit_kpo_action" id="edit_role_form" enctype="multipart/form-data"  method="post">

                  <div class="control-group" id="edit_discount_control">
                     <input type="hidden" name="kpo_id" id="role_id_ed" value="">
                     <input type="hidden" name="old_image" id="old_image">
                     <label class="control-label" for="inputSuccess2">Subject name<span style="color: rgb(255, 0, 0); padding-left: 2px;">*</span></label>
                     <div class="controls">
                       <input type="text" name="kpo_name" id="role_title_ed" class="form-control" placeholder="" required=""  value="" autocomplete="off">
                     <br> 
                     </div>
                  </div>

                  <div class="control-group">
                    <label for="image" class="col-sm-2 control-label">Image<span style="color: rgb(255, 0, 0); padding-left: 2px;">*</span></label>

                    <div class="controls">
                      <input type="file" name="image" class="form-control"  id="image" onchange="edit_readURL(this);">

                       <img id="edit_prof_pic" src="<?php echo base_url()?>../assets/upload/no-image.jpg"  alt="User Image" style="margin-top: 10px;width:60px;height:60px;" />
                      
                        <span id="img_eror" style="color: red;"></span>
                    </div>
                 
                  </div>

                  </form>
                   
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






<script src="<?php echo base_url();?>custom_script/validation_rulse.js"></script>
<script src="<?php echo base_url();?>custom_script/setting_validation.js"></script>


<script type="text/javascript">
  function readURL(input)
    {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#prof_pic')
                    .attr('src', e.target.result)
                    .width(90)
                    .height(90);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script type="text/javascript">
  function edit_readURL(input)
    {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#edit_prof_pic')
                    .attr('src', e.target.result)
                    .width(90)
                    .height(90);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<style type="text/css">
.red_border
{
  border:1px solid red !important; 
}

.error
{
  color:red;
}
 </style>
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
              
              url:base_url+'index.php/admin_service/change_to_active_kpo',
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


  <script type="text/javascript">
  	function add_role_modal()
  	{
  		$('#add_role_modal').modal('show');
  	}



function add_role_validate()
{
	

        var kpo_name = $('#kpo_name').val();
        if (!isNull(kpo_name)) 
        {
          $('#kpo_name').removeClass('black_border').addClass('red_border');

            $("#kpo_name").attr("data-toggle", "tooltip");
                $("#kpo_name").attr("data-placement", "bottom");
                document.getElementById('kpo_name').title = 'Name Is Required';
                $('#kpo_name').tooltip('show');
        } 
        else 
        {
          $('#kpo_name').removeClass('red_border').addClass('black_border');

           document.getElementById('kpo_name').title = '';
                $('#kpo_name').tooltip('destroy');
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








function edit_kpo(kpo_id)
{
	
$.ajax(
    {   
        type: "POST",
        dataType:'json',  
        url:"<?php echo base_url();?>index.php/admin_service/edit_kpo_json1",  
        data: {kpo_id:kpo_id},
        //async: false,
        success: function(data)
        {     


         console.log(data);
         // alert(data);
          var image  = "<?php echo base_url();?>../assets/upload/subject_image/"+data.subject_image
          // alert(image);
         $("#edit_prof_pic").attr("src",image);
          $('#role_title_ed').val(data.subject_name);
          $('#old_image').val(data.subject_image);
          $('#role_id_ed').val(kpo_id);
          $('#edit_role_modal').modal('show');
        

      }
  });

      

}

  </script>