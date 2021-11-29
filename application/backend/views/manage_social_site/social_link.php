<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
  <!--<script>tinymce.init({ selector:'textarea' });</script>-->
  <script type="text/javascript">
    tinymce.init({
      selector: ".tinyarea",
      theme: "modern",
      menubar: "edit insert tools",
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern imagetools"
      ],
      toolbar1: "undo redo | styleselect | bold italic| forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | link preview",
      image_advtab: true
    });
  </script>
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>
        SOCIAL LINK DETAILS
         
        
        
      </h3>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">SOCIAL LINK DETAILS
                <span style="padding-right:30px;"></span>
                <small style="color:#008000;"><?php 
        
                  $msg=$this->session->flashdata('succ_msg');
                  if($msg)
                   {
                   echo $msg;
                   }

                ?></small>


              </h3>
                <div id="validation" style="color:red;"></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url();?>index.php/Manage_social_site/site_update" method="post" id="social_link_form_validation" >
              <div class="box-body">
             <!-- <div class="form-group">
                  <label for="company_name" class="col-sm-2 control-label">Comapany Name</label>

                  <div class="col-sm-10">
                    <input type="text" name="Comp_name" id="Comp_name"class="form-control" id="inputName" placeholder="Company Name" value="<?php echo $contact[0]->company_name; ?>">
                     <span id="error_compname" style="color:red"></span>
                  </div>
                 
                </div>-->                 
                <div class="form-group">
                  <label for="facebook" class="col-sm-2 control-label"><center>Facebook Link:<span style="color:#F00"></span> </center></label>

                  <div class="col-sm-10">
                    <!--<textarea name="address" class="tinyarea" id="address" placeholder="Address"><?php echo $contact[0]->address; ?></textarea> -->
                    <input type="text" name="fb" id="fb" class="form-control" value="<?php echo @$site[0]->facebook_link; ?>" placeholder=https:// > 
                    <span id="error_fb" style="color:red"></span>
                  </div>
                  
                </div>

				<div class="form-group">
                  <label for="twitter" class="col-sm-2 control-label"><center>Twitter Link:<span style="color:#F00"></span> </center></label>

                  <div class="col-sm-10">
                    <input type="text" name="twitter_link" class="form-control" id="twt"   value="<?php echo @$site[0]->twitter_link; ?>" placeholder=https:// >
                    <span id="error_twt" style="color:red"></span>
                  </div>
                  
                </div>
                <div class="clearfix"></div>
         <div class="form-group">
                  <label for="twitter" class="col-sm-2 control-label"><center>Skype Link:<span style="color:#F00"></span> </center></label>

                  <div class="col-sm-10">
                    <input type="text" name="insta_link" class="form-control" id="twt"   value="<?php echo @$site[0]->instagram_link; ?>" placeholder=https:// >
                    <span id="error_twt" style="color:red"></span>
                  </div>
                  
                </div>

                       <div class="clearfix"></div>
              <div class="form-group">
              <label for="YouTube" class="col-sm-2 control-label"><center>Google Plus Link:<span style="color:#F00"></span> </center></label>

                  <div class="col-sm-10">
                    <input type="text" name="gplus_link" class="form-control" id="gplus_link"  value="<?php echo @$site[0]->googleplus_link; ?>" placeholder=https:// >
                    <span id="error_ytb" style="color:red"></span>
                  </div>
                  
                </div> 


                   <div class="clearfix"></div>
              <div class="form-group">
              <label for="YouTube" class="col-sm-2 control-label"><center>YouTube Link:<span style="color:#F00"></span> </center></label>

                  <div class="col-sm-10">
                    <input type="text" name="youtube_link" class="form-control" id="ytb"  value="<?php echo @$site[0]->youtube_link; ?>" placeholder=https:// >
                    <span id="error_ytb" style="color:red"></span>
                  </div>
                  
                </div> 

                <div class="clearfix"></div>
           
          

                <div class="clearfix"></div>
            <!--     <div class="form-group">
            <label for="linkedin_link" class="col-sm-2 control-label"><center>Linkedin Link:<span style="color:#F00"></span> </center></label>

                  <div class="col-sm-10">
                    <input type="text" name="linked_link" class="form-control" id="lkd"  value="<?php echo @$site[0]->linkedin_link; ?>" placeholder=https:// >
                    <span id="error_lkd" style="color:red"></span>
                  </div>
                  
                </div>   -->  

                 <div class="clearfix"></div>
                                                  
              
             


                 <div class="clearfix"></div>
            <!--   <div class="form-group">
              <label for="YouTube" class="col-sm-2 control-label"><center>Pinterest Link:<span style="color:#F00"></span> </center></label>

                  <div class="col-sm-10">
                    <input type="text" name="pinter_link" class="form-control" id="pinter_link"  value="<?php echo @$site[0]->pinterest_link; ?>" placeholder=https:// >
                    <span id="error_ytb" style="color:red"></span>
                  </div>
                  
                </div>  -->


            


                <div class="clearfix"></div>
                                                     
            
              <input type="hidden" name="site_id" value="<?php echo @$site[0]->id; ?>">
              <div id="error"></div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right">Update</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->
          
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  </div>
 
<script src="<?php echo base_url();?>custom_script/validation_rulse.js"></script>
<script src="<?php echo base_url();?>custom_script/social_link_validation.js"></script>

            

            