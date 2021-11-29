<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>
     MANAGE PACKAGE
       
        
      </h3>
      <small><?php
            $succ_msg=$this->session->flashdata('succ_msg');
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
        <li><a href="<?php echo base_url(); ?>index.php/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Manage Package</li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
            
            <!-- /.box-header -->
            
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Package(<?php echo count($manage_package); ?>)</h3>
            </div>
            <!-- /.box-header -->
            
            
            <table width="100%">
            <tr>
               <?php if(count($manage_package) !=3) { ?>
              
              <td width="50%"><a href="<?php echo base_url();?>index.php/manage_package/add_data" class="btn btn-primary btn-action" title="Add"><i class="fa fa-plus"></i> Add</a></td>

            <?php } ?>
        
           

              <td width="50%">
              <span style="padding-left: 30%">
              

                <!-- <a href="javascript:void(0)" class="btn btn-danger btn-action" title="Selected Delete" onclick="delete_selected()"><i class="fa fa-trash-o"></i> Delete</a> -->

                <a href="javascript:void(0)" class="btn btn-success btn-action" title="Active"  onclick="change_sts_active('active')"><i class="fa fa-pencil-square-o" ></i> Active</a>

                <a href="javascript:void(0)" class="btn btn-danger btn-action" title="Inactive" onclick="change_sts_active('inactive')"><i class="fa fa-pencil-square-o" ></i> Inactive</a>

            </td>
            </tr>
            </table>
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="bg-blue">
                 
                  <th>
                    <input type="checkbox" name="all" id="all_chk"onclick="check_all()"></th>
                  <!-- <th>Sl NO</th> -->
                  <th>Status</th>
                  <th>Package Name</th>
                  <th>Package Type</th>
                  <th>Price</th>
                  <th>Description</th>
                  <!-- <th width="12%">Third Title</th> -->
                  <th>Action</th>
                   </tr>
                </thead>
                <tbody>

               <?php
                $i=0;
                foreach($manage_package as $row)
                {
                  $i++;
          
                ?>
               
                <tr>
        
                <td><input type="checkbox" name="slider" value="<?php echo $row->id;?>"></td>
                <td>
                    <?php if($row->status=='active'){ ?>
                      <img src="<?php echo base_url();?>../assets/upload/active.png">
                    <?php } else { ?>
                      <img src="<?php echo base_url();?>../assets/upload/inactive.png">
                    <?php } ?>
                  </td>
                <td>
                  <?php echo  $row->package_name; ?>
                </td>
                <td>
                  <?php echo  $row->package_type; ?>
                </td>
                
                <td><?php echo $row->price ; ?></td>

                <td><?php echo character_limiter($row->description, 200);?></td> 
               <!--  <td><?php echo $row->third_title;?></td> -->
                
               
         
         <td> 
          <a href="<?php echo base_url();?>index.php/manage_package/edit/<?php echo $row->id;  ?>" class="btn btn-info btn-action" title="View & Edit"><i class="fa fa-pencil-square-o"></i></a>

         

          <button type="button" class="btn btn-danger" onclick="delete_data(<?php echo $row->id;  ?>)" title="Delete"><i class="fa fa-trash-o"></i></button>


         </td>
            </tr>
                <?php
              
                }
                ?>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->1
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
function delete_data(id)
{
  if(confirm("Are you sure ?"))
  {
  var baseurl='<?php echo  base_url();?>';
  window.location=baseurl+'index.php/manage_package/delete/'+id;
  }
}
/*function change_status(id)
{
if(confirm("Are you sure"))
{
var baseurl='<?php echo  base_url();?>';
window.location=baseurl+'index.php/manage_product/change_to_active/'+id;
}
}*/
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
function check_all()
{
  
   if ($("#all_chk").is(':checked')) {
            $("input[name=slider]").each(function () {
                $(this).prop("checked", true);
            });

        } 
        else {
            $("input[name=slider]").each(function () {
                $(this).prop("checked", false);
            });
          }
        }
  </script>
  <script type="text/javascript">
     function change_sts_active(val)
        {
          var test_ids =[];
          $.each($("input[name='slider']:checked"), function()
            {            
                test_ids.push($(this).val());
            });

            //alert(cat_ids[0]);
            var base_url='<?php echo base_url(); ?>';
            if(test_ids.length>0)
            {

            $.ajax({
              
             url:base_url+'index.php/manage_package/change_slider_status',
             data:{id:test_ids,status:val},
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
/*function delete_selected()
{
   var gal_ids =[];

            $.each($("input[name='record']:checked"), function()
            {            
                gal_ids.push($(this).val());
            });

           //alert(gal_ids[0]);
            var base_url='<?php echo base_url(); ?>';
            if(gal_ids.length>0)
            {

            $.ajax({
              
             url:base_url+'index.php/manage_product/delete_selected',
             data:{galid:gal_ids},
             dataType: "json",
             type: "POST",
             success: function(data){


              var perform= data.deletedone;

                 if(perform==1)
                 {
                   alert('Selected Items deleted successsfully');
                   location.reload();
                 }
                
                if(perform==2)
                 {
                   alert('Selected Items deleted successsfully');
                   location.reload();
                 }
              }
             });
          }
          else
          {
            alert('Sorry!! please select any records');
          }
}*/
        
        </script>