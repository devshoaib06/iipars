<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Manage Image Gallery
       
        
      </h1>
      <small><?php
            $message=$this->session->flashdata('message');
            if($message){
              ?>
              <br><span style="color:green">
                <?php echo $message; ?>
              </span>
              <?php
              }
              ?>
             
             
            
              </small>
              <small id="msg" style="color:red"></small>
              
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Image Gallery List</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
            
            <!-- /.box-header -->
            
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Total Image Gallery(<?php echo count($vedio_gallery_list ); ?>)</h3>
            </div>
            <!-- /.box-header -->
            
            <table width="100%">
            <tr>
              <td width="50%"><a href="<?php echo base_url();?>index.php/manage_image_category/add_video_gallery" class="btn btn-primary btn-action" title="Add"><i class="fa fa-plus"></i> Add Image Gallery</a></td>

              <td width="50%" style="padding-left:20.5%">
              <!--<span style="padding-left: 80.5%">-->
            <!--  <a href="javascript:void(0)" class="btn btn-success btn-action" title="Active"  onclick="active_sub_admin()"><i class="fa fa-pencil-square-o" ></i> Active</a>

                <a href="javascript:void(0)" class="btn btn-danger btn-action" title="Inactive" onclick="in_active_sub_admin()"><i class="fa fa-pencil-square-o" ></i> Inactive</a>
 -->
                <a href="javascript:void(0)" class="btn btn-success btn-action" title="Active"  onclick="change_sts_active('active')"><i class="fa fa-pencil-square-o" ></i> Active</a>

                <a href="javascript:void(0)" class="btn btn-danger btn-action" title="Inactive" onclick="change_sts_active('inactive')"><i class="fa fa-pencil-square-o" ></i> Inactive</a>

            </td>
            </tr>
            </table>
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="bg-blue">
                  <th><input type="checkbox" name="all_chk" id="all_chk" onclick="check_all()"></th>
                  <th>Status</th>

                     
                   <th>Image</th>

                   <th>Image Gallery Category</th>
          
                  <!-- <th>Video Gallery Link</th> -->
                
                  <th>Added Date</th>
             
             
              <th>Action</th>
                </tr>
                </thead>
                <tbody>

               <?php $i=0; 
            if(count($vedio_gallery_list )>0)
            {
        
                foreach($vedio_gallery_list  as $row)
                {
                  $i++;

                   $type=$this->admin_model->selectOne('tbl_video_category','video_category_id',$row->video_category_id);
                  
                  $emptyString='N/A';
                  
                  ?>
              
                <tr>
                  <td><input type="checkbox" name="record" value="<?php echo $row->video_gallery_id;?>"></td>
                  <td>
                    <?php if($row->status=='active'){ ?>
                      <img src="<?php echo base_url();?>../assets/upload/active.png">
                    <?php } else { ?>
                      <img src="<?php echo base_url();?>../assets/upload/inactive.png">
                    <?php } ?>
                  </td>

                   <td><img height="100" width="100" src="<?php echo base_url();?>../assets/upload/gallery_image/<?php echo $row->video_gallery_image ; ?>"></td>
                   <td><?php echo @$type[0]->video_category; ?></td>
                   <!-- <td><?php echo $row->video_gallery_link; ?></td> -->
             
                 
                  <td><?php echo date("d/m/Y", strtotime( $row->created_date )); ?></td>
                                                          
                  <td>
                     <a href="<?php echo base_url();?>index.php/manage_image_category/video_gallery_edit/<?php echo $row->video_gallery_id;?>" class="btn btn-success" title="View"><i class="fa fa-pencil"></i></a>

                     
                   
                    <button type="button" class="btn btn-danger" onclick="delete_data('<?php echo $row->video_gallery_id;?>')" title="Delete"><i class="fa fa-trash-o"></i></button>
                  
                  </td>
                </tr>
<?php } 
}?>

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
    <script>
    var base_url= '<?php echo base_url();?>'
function delete_data(id)
  { 
    if(confirm('Are you sure do you want to delete it?'))
    {
      window.location = base_url+'index.php/manage_image_category/delete_data/'+id;
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
              
              url:base_url+'index.php/manage_image_category/change_to_active_video_gallery',
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