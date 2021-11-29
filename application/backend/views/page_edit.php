
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
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
            
            image_advtab: true,
            extended_valid_elements : "span[*],i[*]",
            relative_urls : false,
            remove_script_host : false,
            convert_urls : true
        });
    </script>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>
       EDIT PAGE
        
        
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
              <h3 class="box-title">PAGE EDIT</h3>
              <div id="validation" style="color:red;"></div>
            </div>
            
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url();?>index.php/page/page_edit_action" method="post" id="add_page" enctype='multipart/form-data'>
             <input type="hidden" id="menu_id" name="menu_id" value="<?php echo $page_details[0]->menu_id; ?>" />
            <input type="hidden" id="rout_id_store" name="rout_id_store" value="<?php echo $page_details[0]->id; ?>" />
            
              <div class="box-body">
              <!--First Row Start-->

    <!--<h4 style="text-align:center;">MENU MANAGE</h4> <p></p>
                  <div class="form-group">
                  <label for="menu_title" class="col-sm-2 control-label">Menu Title</label>

                  <div class="col-sm-10">
                    <input type="text" id="menu_title" name="menu_title" class="form-control" value="<?php echo $page_details[0]->menu_title; ?>">
                     <span id="error_title" style="color:red"></span>
                  </div>
                 
                </div>
                
                 <div class="form-group">
                  <label for="main_section" class="col-sm-2 control-label">Main Section</label>

                  <div class="col-sm-10">
                  <input type="hidden" id="main_section_id_store" value="<?php echo  $page_details[0]->menu_section_id;?>" />

                    <select onchange="data_fetch_sub_menu_section(this.value)" name="menu_section_id" id="menu_section_id" class="form-control">
                <option value="">Select Main Section</option>
                <?php 
        if(count($main_menu_section_list)>0)
        {
        foreach($main_menu_section_list as $row){ ?>
                <option  value="<?php echo $row->menu_section_id; ?>" <?php if($page_details[0]->menu_section_id==$row->menu_section_id) { ?>selected="selected"<?php } ?>><?php echo $row->menu_section_title; ?></option>
                <?php } } ?>
                </select>
                  </div>
                 
                </div>


                 <div class="form-group">
                  <label for="menu_title" class="col-sm-2 control-label">Sub Section</label>

                  <div class="col-sm-10">
                  <input type="hidden" id="menu_sub_section_id_store" value="<?php echo  $page_details[0]->menu_sub_section_id;?>" />
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
                    <input type="radio" id="page_type" name="page_type[]"  class="span7" value="static"  onclick="static_page_function(this.value)" <?php if($page_details[0]->page_type=='static') { ?>checked="checked"<?php } ?><?php if($page_details[0]->page_type=='') { ?>checked="checked"<?php } ?> />Index
                 <input type="radio" id="page_type" name="page_type[]"  class="span7" value="dyanamic"  onclick="static_page_function(this.value)" <?php if($page_details[0]->page_type=='dyanamic') { ?>checked="checked"<?php } ?>/>Non-Index
                  </div>
                 
                </div>
                
                 <div class="form-group">
                  <label for="rout" class="col-sm-2 control-label">Rout</label>

                  <div class="col-sm-10">
                    <input type="text" id="page_rout" class="form-control" name="page_rout" value="<?php echo $page_details[0]->controller; ?>" />
                  </div>
                 
                </div>

                <div class="form-group">
                  <label for="title" class="col-sm-2 control-label">Page Title</label>

                  <div class="col-sm-10">
                    <input type="text" id="page_title" name="page_title" class="form-control" value="<?php echo $page_details[0]->page_title; ?>"  />
                  </div>
                 
                </div>


                 <div class="form-group">
                  <label for="headline" class="col-sm-2 control-label">Page Headline </label>

                  <div class="col-sm-10">
                <input type="text" id="page_headline" name="page_headline" class="form-control" value="<?php echo $page_details[0]->page_headline; ?>"  />
                  </div>
                 
                </div>

                 <div class="form-group">
                  <label for="meta_title" class="col-sm-2 control-label">Meta Title</label>

                  <div class="col-sm-10">
                    <input type="text" id="meta_title" name="meta_title" class="form-control" value="<?php echo $page_details[0]->meta_title; ?>" />
                  </div>
                 
                </div>



                <div class="form-group">
                  <label for="meta_descpn" class="col-sm-2 control-label">Meta Description</label>

                  <div class="col-sm-10">
                     <textarea id="meta_description"  name="meta_description"  class="form-control" style="height:100px"><?php echo $page_details[0]->meta_description; ?></textarea>
                  </div>
                 
                </div>

                  <div class="form-group">
                  <label for="meta_descpn" class="col-sm-2 control-label">Meta Keyword</label>

                  <div class="col-sm-10">
                     <textarea id="meta_keyword"  name="meta_keyword"  class="form-control" style="height:100px"><?php echo $page_details[0]->meta_keyword; ?></textarea>
                  </div>
                 
                </div>



                <div class="form-group">
                  <label for="page_contop" class="col-sm-2 control-label">Page Content(Optional)</label>

                  <div class="col-sm-10">
                    <textarea id="page_content"  name="page_content"  class="form-control" style="height:300px"><?php echo $page_details[0]->page_content; ?></textarea>
                  </div>
                 
                </div>
                 <div class="form-group"  id="image">
                  <label for="_image" class="col-sm-2 control-label"> Image(optional)</label>

                  <div class="col-sm-10">
                    <input type="file" name="image"  class="form-control" id="image">
                   <input type="hidden" name="hidden_img" value="<?php echo $page_details[0]->image; ?>">
                     <span id="error_catname" style="color:red"></span>
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

<!--</div>-->

<script src="<?php echo base_url();?>custom_script/validation_rulse.js"></script>
<script src="<?php echo base_url();?>custom_script/setting_validation.js"></script>


<script language="javascript" type="text/javascript">

$(document).ready(function()
{
  var checkboxValue =[];
  
  $.each($("input[id='page_type']:checked"), function()
  {            
    checkboxValue.push($(this).val());
   
  });
  var checkboxValue=checkboxValue.join(", ");
  if(checkboxValue=='static')
  {
    $('#page_type_box').hide()
  }
})
function static_page_function(page_type)
{
  if(page_type=='static')
  {
    $('#page_type_box').hide()
  }
  else if(page_type=='dyanamic')
  {
    $('#page_type_box').show()  
  }
}


function data_fetch_sub_menu_section(value)
{
  //alert(base_url)
    $.post(base_url+"index.php/page/menu_sub_section",
    {
        mainSectionId: value
    },
    function(data, status)
  {
    
    var sub_menu_section_details= '{"subMenuSection":'+data+'}';        
    obj = JSON.parse(sub_menu_section_details);
    var length=obj.subMenuSection.length
    //alert(length)
    var count=0;
    var str='<option value="">Select sub section</option>';
    for(count=0;count<length;count++)
    {
      var main_section_id_store=document.getElementById('menu_sub_section_id_store').value
      if(obj.subMenuSection[count].menu_sub_section_id==main_section_id_store)
      {
      str+='<option value="'+obj.subMenuSection[count].menu_sub_section_id+'" selected>'+obj.subMenuSection[count].menu_sub_section_title+'</option>';
      }
      else
      {
        str+='<option value="'+obj.subMenuSection[count].menu_sub_section_id+'">'+obj.subMenuSection[count].menu_sub_section_title+'</option>';
      }
    }
    
    $('#menu_sub_section_id').html(str)
        //alert("Data: " + str + "\nStatus: " + status);
    });
}

var main_section_id_store=document.getElementById('main_section_id_store').value
data_fetch_sub_menu_section(main_section_id_store)

//var base_url='<?php echo base_url()?>';
/*jQuery(document).ready(function()
 {
  addTinyMCE("page_content");
});
jQuery(document).ready(function() 
{
   addTinyMCE("edit_route");

});

 function addTinyMCE(id) {
  tinyMCE
  .init({
    mode : "exact",
    
    elements : id,
    theme : "advanced",
    plugins : "table,paste,insertdatetime,aspnetbrowser",
    
    verify_html : true,
    theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,link,|,table,aspnetbrowser,code",
    theme_advanced_buttons2 : "",
    theme_advanced_buttons3 : "",
    theme_advanced_buttons4 : "",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    apply_source_formatting : true,
    theme_advanced_statusbar_location : "bottom",
    plugin_insertdate_dateFormat : '%m/%d/%Y',
    theme_advanced_resizing : true,
    convert_urls : false,
    

  });
  }*/ 
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>custom_script/add_page_validation_validation.js" ></script> 
<script type="text/javascript">
function addPageValidation()
{
  //alert('ok');
  $('#add_page').attr('onchange','add_page_validation()');
  $('#add_page').attr('onkeyup','add_page_validation()');
  //var action='focus'; 
  add_page_validation()
  
  $('#page_title').trigger("focusout");     
  $('#page_headline').trigger("focusout");
  $('#meta_title').trigger("focusout");     
  $('#meta_description').trigger("focusout");
  
  if ($('#add_page .red_border').size()>0) 
  {
    $('#add_page .red_border:first').focus();
     return false;
  }
  else
  {
     $("#add_page").submit();
  } 
}
</script> 
