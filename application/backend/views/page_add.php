
<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
  <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
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
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>
        ADD NEW PAGE
        
        
      </h3>
      
    </section>

   

 
<section class="content">
      <div class="row">
        <!-- left column -->
        
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
          <div class="box-header with-border">
              <h3 class="box-title">PAGE ADD</h3>
<div id="validation" style="color:red;"></div>
            </div>
            
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url();?>index.php/page/add_page_action" method="post" id="add_page" enctype='multipart/form-data'>
            
              <div class="box-body">
              <!--First Row Start-->

    <!--<h4 style="text-align:center;">MENU MANAGE</h4> <p></p>
                  <div class="form-group">
                  <label for="menu_title" class="col-sm-2 control-label">Menu Title</label>

                  <div class="col-sm-10">
                    <input type="text" id="menu_title" name="menu_title" class="form-control" value="<?php echo $this->session->flashdata('menu_title'); ?>">
                     <span id="error_title" style="color:red"></span>
                  </div>
                 
                </div>
                
                 <div class="form-group">
                  <label for="main_section" class="col-sm-2 control-label">Main Section</label>

                  <div class="col-sm-10">
                    <select onchange="data_fetch_sub_menu_section(this.value)" name="menu_section_id" id="menu_section_id" class="form-control">
                <option value="">Select Main Section</option>
                <?php 
        if(count($main_menu_section_list)>0)
        {
        foreach($main_menu_section_list as $row){ ?>
                <option  value="<?php echo $row->menu_section_id; ?>" <?php if($this->session->flashdata('menu_section_id')==$row->menu_section_id) { ?>selected="selected"<?php } ?>><?php echo $row->menu_section_title; ?></option>
                <?php } } ?>
                </select>
                  </div>
                 
                </div>


                 <div class="form-group">
                  <label for="menu_title" class="col-sm-2 control-label">Sub Section</label>

                  <div class="col-sm-10">
                    <select id="menu_sub_section_id" name="menu_sub_section_id">
              
                </select>
               
                  </div>
                 
                </div>-->


                 
                 <!--First Row End-->
                 

                  <!--Secoend Row Start-->

 <h4 style="text-align:center;">PAGE MANAGE</h4> <p></p>
                <div class="form-group">
                  <label for="page_tupe" class="col-sm-2 control-label">Page Type</label>

                  <div class="col-sm-10">
                    <input type="radio" id="page_type" name="page_type[]"  class="span7" value="static"  onclick="static_page_function(this.value)" <?php if($this->session->flashdata('page_type')=='static') { ?>checked="checked"<?php } ?><?php if($this->session->flashdata('page_type')=='') { ?>checked="checked"<?php } ?> />Index
                 <input type="radio" id="page_type" name="page_type[]"  class="span7" value="dyanamic"  onclick="static_page_function(this.value)" <?php if($this->session->flashdata('page_type')=='dyanamic') { ?>checked="checked"<?php } ?>/>Non-Index

                  </div>
                 
                </div>
                
                 <div class="form-group">
                  <label for="rout" class="col-sm-2 control-label">Rout</label>

                  <div class="col-sm-10">
                    <input type="text" id="page_rout" class="form-control" name="page_rout" value="<?php echo $this->session->flashdata('page_rout'); ?>" />
                  </div>
                 
                </div>

                <div class="form-group">
                  <label for="title" class="col-sm-2 control-label">Page Title</label>

                  <div class="col-sm-10">
                    <input type="text" id="page_title" name="page_title" class="form-control" value="<?php echo $this->session->flashdata('page_title'); ?>"  />
                  </div>
                 
                </div>


                 <div class="form-group">
                  <label for="headline" class="col-sm-2 control-label">Page Headline </label>

                  <div class="col-sm-10">
                <input type="text" id="page_headline" name="page_headline" class="form-control" value="<?php echo $this->session->flashdata('page_headline'); ?>"  />
                  </div>
                 
                </div>

                 <div class="form-group">
                  <label for="meta_title" class="col-sm-2 control-label">Meta Title</label>

                  <div class="col-sm-10">
                    <input type="text" id="meta_title" name="meta_title" class="form-control" value="<?php echo $this->session->flashdata('meta_title'); ?>" />
                  </div>
                 
                </div>



                <div class="form-group">
                  <label for="meta_descpn" class="col-sm-2 control-label">Meta Description</label>

                  <div class="col-sm-10">
                     <textarea id="meta_description"  name="meta_description"  class="form-control" style="height:100px"><?php echo $this->session->flashdata('meta_description'); ?></textarea>
                  </div>
                 
                </div>

                <div class="form-group">
                  <label for="meta_descpn" class="col-sm-2 control-label">Meta Keyword</label>

                  <div class="col-sm-10">
                     <textarea id="meta_keyword"  name="meta_keyword"  class="form-control" style="height:100px"><?php echo $this->session->flashdata('meta_keyword'); ?></textarea>
                  </div>
                 
                </div>



                <div class="form-group">
                  <label for="page_contop" class="col-sm-2 control-label">Page Content(Optional)</label>

                  <div class="col-sm-10">
                    <textarea id="page_content"  name="page_content"  class="form-control" style="height:100px"><?php echo $this->session->flashdata('page_content'); ?></textarea>
                  </div>
                 
                </div>


                



                
                 
               
               
                <!--Secoend Row End-->
                
              </div>

              

             
              
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url(); ?>index.php/page_list_manage/" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-info pull-right" onclick="return execute_page_add_validation()" >Submit</button>
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
<script src="<?php echo base_url();?>custom_script/setting_validation.js"></script>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">


 

        function show_caption_form(val)
        {
          
            var id=val;
            var base_url='<?php echo base_url(); ?>';
          
            $.ajax({
              
             url:base_url+'index.php/content/form_by_caption',
             data:{con_id:id},
             dataType: "html",
             type: "POST",
             success: function(data){


              $("#single").html(data);

                 
                
              }
             });
          
        }





        </script>-->
 

