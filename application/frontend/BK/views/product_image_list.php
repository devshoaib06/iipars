


        <section class="my-account-wrapper">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <div class="myaccount-sidebar">
                            <div class="profile-content">
                                <div class="profile-image">
                                <?php 
                                    if(@$user[0]->image!='')
                                    { ?>
                                        <img src="<?php echo base_url();?>assets/upload/seller_image/<?php echo @$user[0]->image;?>" class="img-responsive" alt="" />
                                   <?php  } else { ?>
                                        <img src="<?php echo base_url();?>assets/upload/no-image1.jpg" class="img-responsive" alt="" />
                                   <?php } ?>
                                    
                                </div>
                                <h4 class="my-name"><?php echo @$user[0]->first_name.' '.@$user[0]->last_name; ?></h4>
                            </div>


                                <h4 class="sell-p">My Account</h4>
                            <ul>
                                <li class="active"><a href="<?php echo $this->url->link(21); ?>">Business Profile</a></li>
                                <li><a href="<?php echo $this->url->link(22); ?>">Password Manager</a></li>
                                
                                <li><a href="<?php echo $this->url->link(27); ?>">Close my account</a></li>
                                <li><a href="<?php echo $this->url->link(20); ?>">Go to Dashboard</a></li>
                            </ul>


                              <h4 class="sell-p">Product Manager</h4>
                            <ul>
                                <li class="active"><a href="<?php echo $this->url->link(23); ?>">Product List</a></li>
                                <li><a href="<?php echo $this->url->link(26); ?>">Add a Single Product</a></li>
                                
                            </ul>


                                <h4 class="sell-p">My Orders</h4>
                            <ul>
                                <li class="active"><a href="<?php echo $this->url->link(28);?>">Order List</a></li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                        <div class="myaccount-widget">
                            <h3 class="title">Product Image List</h3>
                           </div>
                            <?php
                            if($this->session->flashdata('succ_delete')!='')
                             {
                                ?>
                                <span style="color:green;"><b><?php echo $this->session->flashdata('succ_delete'); ?></b></span>
                            <?php
                            }?> 

                             <?php
                            if($this->session->flashdata('succ_image')!='')
                             {
                                ?>
                                <span style="color:green;"><b><?php echo $this->session->flashdata('succ_image'); ?></b></span>
                            <?php
                            }?> 

                            <?php
                            if($this->session->flashdata('succ_updt_image')!='')
                             {
                                ?>
                                <span style="color:green;"><b><?php echo $this->session->flashdata('succ_updt_image'); ?></b></span>
                            <?php
                            }?> 

                                     
                          <div class="save-btn">

                                    
                                   <a href="#" data-target="#pwdModal" data-toggle="modal" class="btn btn-default">Add</a>

                                   <a href="<?php echo $this->url->link(23); ?>"  class="btn btn-default">Cancel</a>
                                    
                                    

                          </div>
                                  <!-- <div id="show" class="save-btn" style="display: none;">
                                  <div class="myaccount-widget">
                                    <h3 class="title">Product Image Add</h3>
                                  </div>   
                                        <input type="file"  name="brand_logo" id="brand_logo" onchange="readURL(this);">
                                        <img id="prof_pic" src="<?php echo base_url()?>assets/upload/no-image.jpg"  alt="User Image" style="margin-top: 10px;width:90px;height:90px;" /> 
                                    </div> -->

                    
                     <div class="clearfix"></div>

                    <div class="table-responsive">
                            <table id="sp-list">
                                <thead>
                                    <tr>
                                       
                                         
                                        <!--  <th>Featured Product</th> -->
                                         <th>Product Image</th>
                                          <th>Action</th>
                                         
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 

                                        foreach($product_image as $image)
                                        {


                                ?>
                                    <tr>
                                        
                                     

                                        <td>
                                  
                                   
                                  <img src="<?php echo base_url();?>assets/upload/product/<?php echo $image->image;?>" height="100px" width="100px" title="See Images">
                             

                                  </td>
                                  <td>
                                        <a href="" onclick="show_modal('<?php echo $image->pro_image_id; ?>','<?php echo $image->image; ?>')" data-target="#edtModal" data-toggle="modal" class="btn btn-success">Edit</a>
                                        <button type="button" class="btn btn-danger" onclick="return delete_data(<?php echo $image->pro_image_id;?>)" title="Delete"><i class="fa fa-trash-o"></i></button>
                                        

                                  </td>

                                 
                                        
                                    </tr>
                                    

                                   
                                     

                                    

                                   
                                   <?php } ?>
                                </tbody>
                            </table>
                        </div>

                   
                    </div>
                </div>
            </div>
        </section><!--//my-account-wrapper-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <script type="text/javascript">
          function delete_data(id)
          {
            if(confirm('Are you sure to delete this product?'))
            {
                window.location.href="<?php echo base_url();?>seller_bussiness_profile/delete_seller_product_image/"+id;
            }
          }
        </script>
     <script type="text/javascript">

          function change_home(id)


          {
          if(confirm("Are you sure ?"))
          {
          var base_url='<?php echo  base_url();?>';

          $.ajax({
                        
              url:base_url+'seller_bussiness_profile/change_home_status',
              data:{pid:id},
              dataType: "json",
              type: "POST",
              success: function(data){


                var perform= data.changedone;

                      if(perform['status']==1)
                      {
                        
                       var node='<a href="#" class="label label-success"  title="Change" onclick="change_home('+id+')">Yes</a>';

                        $("#home_"+id).html(node);
                      }
                      else
                      {
                        
                        var node='<a href="#" class="label label-danger" title="Change" onclick="change_home('+id+')">No</a>';

                        $("#home_"+id).html(node);
                      }
                
                  }
              });
//window.location=baseurl+'index.php/manage_category/popularity_change/'+id;


}
}</script>
 <div id="pwdModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="email_title"></h4>
      </div>
      <form method="post" action="<?php echo base_url();?>seller_bussiness_profile/seller_image_upload" enctype="multipart/form-data">
      <div class="modal-body">
         (<b>Resolution</b>: 317 X 317)

          <input type="file"  name="img_upload" id="img_upload" onchange="readURL(this);">
            <img id="prof_pic" src="<?php echo base_url()?>assets/upload/no-image.jpg"  alt="User Image" style="margin-top: 10px;width:90px;height:90px;" />
          <input type="hidden" name="pro_id" value="<?php echo $this->uri->segment(3); ?>" > 
                                        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary" >Upload</button> 
      </div>
      </form>
    </div>

  </div>
</div>

<div id="edtModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="email_title"></h4>
      </div>
      <form method="post" action="<?php echo base_url();?>seller_bussiness_profile/seller_image_edit_upload" enctype="multipart/form-data">
      <div class="modal-body">
         (<b>Resolution</b>: 317 X 317)
     

          <input type="file"  name="img_upload" id="img_upload" onchange="readURL(this);" style="margin-bottom:8px">
                  <!--  <?php
                                        if($product_image[0]->image!="")
                                        {
                                            ?>
                                            <img id="prof_pic"
                                                 src="<?php echo base_url() ?>assets/upload/product/<?php echo $product_image[0]->image; ?>"
                                                 alt="User Image" style="width:90px;height:90px;"/>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <img id="prof_pic" src="<?php echo base_url()?>assets/images/profile-oimage.jpg"  alt="User Image" style="margin-top: 10px;width:60px;height:60px;" />
                                            <?php
                                        }
                                        ?> -->
          <input type="hidden" name="hidden_id" id="hidden_id" value="" > 
          <input type="hidden" name="hidden_img" id="hidden_img" value="" > 
          <input type="hidden" name="hidden_pro_id" id="hidden_pro_id" value="<?php echo $this->uri->segment(3); ?>" > 

                                        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary" >Upload</button> 
      </div>
      </form>
    </div>

  </div>
</div>
<script type="text/javascript">
  
function show_modal(id,img)
{
  //alert(id);
  //$('#edtmodal').modal('show');
  $('#hidden_id').val(id);
  $('#hidden_img').val(img);
}

</script>

<script>
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

<!-- <script>
function show_div()
{
  $('#show').show();

}
</script>
 -->