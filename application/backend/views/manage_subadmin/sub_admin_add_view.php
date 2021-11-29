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
      <h1>
        ADD Employee
        
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
       <?php if($this->session->flashdata('message')) { ?> 
        <table class="table table-striped table-bordered bootstrap-datatable ">
          <tr>
            <td width="100%" colspan="2" style=" text-align:center"><span style="color:#F00"><?php echo $this->session->flashdata('message'); ?></span></td>
          </tr>
        </table>
         <?php } ?>
      <div class="row">
        <!-- left column -->
        
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Employee DETAILS</h3>
            <div id="validation" style="color:red;"></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url();?>index.php/sub_admin/add_sub_admin_action" method="post" id="add_sub_admin"  onsubmit="return log_val()" >
              <div class="box-body">
              
              <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">First Name</label>

                  <div class="col-sm-10">
                    <input type="text" name="sub_admin_first_name" required="" id="sub_admin_first_name" class="form-control" placeholder="First Name" >
                     <span id="error_catname" style="color:red"></span>
                  </div>
                 
              </div>

               <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Last Name</label>

                  <div class="col-sm-10">
                    <input type="text" name="sub_admin_last_name" required="" id="sub_admin_last_name" class="form-control" placeholder="Last Name" >
                     <span id="error_catname" style="color:red"></span>
                  </div>
                 
              </div>
               
               <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    <input type="email" name="sub_admin_email" required="" autocomplete="off" id="sub_admin_email" class="form-control" placeholder="Email" value="">
                     <span id="email_error" style="color:red"></span>
                  </div>
                 
              </div>
             <!--   <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Role</label>

                  <div class="col-sm-10">
                    <select class="form-control" id="role_id" name="role_id" required="">
                      <option value="">--Select role--</option>
                      <?php
                      foreach ($roles as $row) { ?>
                         <option value="<?php echo $row->role_id; ?>"><?php echo $row->role_title; ?></option>
                      <?php } ?>

                    </select>
                  </div>
                 
              </div> -->
               <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="password" autocomplete="off" name="sub_admin_password" id="Txt2" required="" onkeyup="field2()" class="form-control" placeholder="Password " value="">
                     <span id="new_pass_match" style="color:red"></span>
                  </div>
                 
              </div>

           <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Confirm Password</label>

                  <div class="col-sm-10">
                    <input type="password" autocomplete="off" name="confirm_password" required="" onkeyup="field3()" id="Txt3" class="form-control" placeholder="Confirm Password" value="">
                    <span id="conf_pass_match" style="color:red"></span>
                  </div>
                 
              </div>

              
                
                
              </div>
             
             
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url();?>index.php/sub_admin_list_manage" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-info pull-right" onclick="return subAdminAdd()">Submit</button>
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
 <script type="text/javascript" src="<?php echo base_url(); ?>custom_script/sub_admin_form_validation.js" ></script> 
<script src="<?php echo base_url();?>custom_script/validation_rulse.js"></script>
<script src="<?php echo base_url();?>custom_script/setting_validation.js"></script>
<script>
  function subAdminAdd()
{
  $fname=$("#sub_admin_first_name").val();
   $lname=$("#sub_admin_last_name").val();
    $email=$("#sub_admin_email").val();
     $role=$("#role_id").val();
  if($fname=="" || $lname=="" || $email=="" || $role=="")
  {
    alert("Please fill the fields");
  }
  else
  {
     $("#add_sub_admin").submit();
  } 
}
</script> 


  </script>

  <script>
    
      $( "#sub_admin_email" ).on("input change paste keyup", function() {

       var email = $( "#sub_admin_email" ).val();

           $.ajax({
              url: "<?php echo base_url();?>index.php/sub_admin/check_email",
              type: "POST",
              //dataType:'text',
              data: {log_email:email},

            success: function (data) {
      
                //alert(data);
                $('#email_error').html(data);


                  /*if (data != "") {
                       $('#doctor_email').removeClass('black_border').addClass('red_border');
                  } else {
                       $('#doctor_email').removeClass('red_border').addClass('black_border');
                  }*/

              }
            });

  });
  </script>
  <style>
    .glowing-border-red_show{
        outline: none;
        border-color: #ff3333 !important;
        box-shadow: 0 0 10px #ff3333 !important;
    }
</style>

            <script>
function getVal()
    {
      //alert('ok');
        var elements = new Array();

        for (var i = 0; i < arguments.length; i++)
        {
            var element = arguments[i];
            if (typeof element == 'string')
                element = document.getElementById(element);
            if (arguments.length == 1)
                return element;
            elements.push(element);
        }
        return elements;
    }
function log_val()
    {
       
        new_pass=$('#Txt2').val();
        conf_pass=$('#Txt3').val();
        var status="";

       
        var counter=0;
        var retval = [];
        var elem = getVal('Txt2', 'Txt3');

        for(var i =0; i < elem.length; i++)
        {
            if(elem[i].value == "")
            {
                $('input').each(function(){
                    retval.push($(this).attr('id'));
                });
                var id= retval[i];
                //alert(id);    
                $("#"+id).addClass("glowing-border-red_show");
                counter++;
            }
        }
        if(counter!=0)
        {
            return false;
        }

       

        if(new_pass!=conf_pass)
        {
            return false;
        }
    }

    function field1(value)
    {
        var status="";
        //alert(value);

        
        if(status=='N')
        {
            $('#old_pass_match').html("password does not match..!");
        }
        else
        {
            $('#old_pass_match').html("");
        }
        $("#Txt1").removeClass("glowing-border-red");
    }

    function field2()
    {
      
        new_pass=$('#Txt2').val();
        conf_pass=$('#Txt3').val();
        if(new_pass==old_pass)
        {
            $('#new_pass_match').html(" provide a new password..!");
            $("#Txt2").addClass("glowing-border-red");
        }
        else
        {
            $('#new_pass_match').html("");
            $("#Txt2").removeClass("glowing-border-red_show");
        }
        if((new_pass!=conf_pass) && (conf_pass!=""))
        {
            $('#conf_pass_match').html(" new password does not match with confirm password..!");
        }
        else
        {
            $('#conf_pass_match').html("");
            $("#Txt2").removeClass("glowing-border-red_show");
        }
    }

    function field3()
    {
        new_pass=$('#Txt2').val();
        conf_pass=$('#Txt3').val();
        if(new_pass!=conf_pass)
        {
            $('#conf_pass_match').html("password does not match ..!");
        }
        else
        {
            $('#conf_pass_match').html("");
        }
        $("#Txt3").removeClass("glowing-border-red_show");
    }
</script>
