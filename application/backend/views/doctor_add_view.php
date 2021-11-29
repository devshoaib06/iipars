<style type="text/css">
    .thumb-image{float:left;width:100px;position:relative;padding:5px;}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <form class="" method="post" action="<?php echo base_url(); ?>index.php/admin_user/doctor_add_action" id="doc_add_form">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>DOCTOR INFORMATION ADD</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>index.php/admin_dashboard"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboad</a></li>
            <li class="active">Doctor Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><b><u>General Information</u> : </b></h3>
                       <!--  <ul class="nav nav-tabs">
                           <li class="active"><a data-toggle="tab" href="#vital_info">Vital Info</a></li>
                          
                       </ul> -->

                    </div>
                    <div class="clearfix"></div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="tab-content">


                                <div id="vital_info" >
                                   
                                        
                                       
                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">First Name<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="first_name" id="first_name" placeholder="First Name" >
                                            </div>
                                        </div>
                                              <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Last Name<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                            
                                                <input class="form-control" type="email" name="email" onkeyup="email_check(value)" id="email" placeholder="Email" >

                                                 
                                            </div>

                                            <div class="col-sm-2">
                                            
                                                

                                                  <span id="error" style="color:red;margin-left: 4px;">  </span>
                                            </div>
                                        </div>

                                         <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Password<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="password" name="pass" id="pass" placeholder="Password" >
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Mobile<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="mobile" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="mobile" maxlength="11"  placeholder="Mobile No">
                                            </div>
                                        </div>

                                         <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Age<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="age" id="age" placeholder="Age">
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Gender<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input  type="radio" name="gen" id="gen" value="male" style="margin-bottom:12px" checked="">Male
                                                  <input type="radio" name="gen" id="gen" value="female">Female
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                        <!--   <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Weight (Kg.)<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="weight" id="weight" style="margin-bottom:12px" placeholder="Weight">
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Height (Feet)<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="height" id="height" style="margin-bottom:12px" placeholder="Height">
                                            </div>
                                        </div>
 -->

                                       

                                      
                                       

                                        <div class="clearfix"></div>
                                        <div class="box-footer">
                                        </div>

                                </div>


                        </div>
                    </div>
                    <!-- /.box-body -->

                    
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
 

    <section class="content">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><b><u>Experience</u> : </b></h3>
                       <!--  <ul class="nav nav-tabs">
                           <li class="active"><a data-toggle="tab" href="#vital_info">Vital Info</a></li>
                          
                       </ul> -->

                    </div>
                    <div class="clearfix"></div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="tab-content">


                                <div id="vital_info" >
                                  
                                        
                                       
                                      


                                         <div class="clearfix"></div>

                                        

                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Registration No<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="reg_no" id="reg_no" placeholder="Registration No">
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Practice Start Date<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="date" name="start" id="start"  >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Experience<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                

                                                <textarea class="form-control" type="text" name="exp" id="exp" placeholder="Experience"></textarea>
                                            </div>
                                        </div>


                                        <div class="clearfix"></div>
                                        <div class="box-footer">
                                        </div>

                                </div>


                            




                           
                        </div>
                    </div>
                    <!-- /.box-body -->

                    
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

     <section class="content">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><b><u>Chamber Detail's</u> : </b></h3>
                       <!--  <ul class="nav nav-tabs">
                           <li class="active"><a data-toggle="tab" href="#vital_info">Vital Info</a></li>
                          
                       </ul> -->

                    </div>
                    <div class="clearfix"></div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="tab-content">


                                <div id="vital_info" >
                                   
                                        
                                       
                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Chamber Name<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                               <select  class="form-control select" name="chamber[]" id="chamber"  required="">
                                                    <option value="">--Select Chamber--</option>
                      
                                                     <?php
                                                       foreach($chamber_list as $row){

                                                        ?>

                                                   <option value="<?php echo $row->chamber_id; ?>" ><?php echo $row->chamber_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div><div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Fees(Rs.)<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="fees[]" id="fees"  placeholder="Fees">
                                            </div>
                                        </div>

                                        <a href="javacript:void(0)"  id="edu_no_1" onclick="edu_produce_file_box('1')" class="btn btn-primary"><b>Add More</b></a>

                                       

                                       

                                        <div class="clearfix"></div>
                                        <div class="box-footer">
                                        </div>
                                            <div id="edu_add_1"></div>
                                            <div id="edu_add_2"></div>
                                            <div id="edu_add_3"></div>
                                            <div id="edu_add_4"></div>
                                            <div id="edu_add_5"></div>
                                </div>

                                <div class="box-footer" style="margin-top: 10px;float: right;" >
                                    
                                    <button type="button"  class="btn btn-info" style="margin-left:12px" id="butt1" onclick="return valid_doc_form();">Submit</button>

                                     <button type="button" id="butt2" style="display: none;" class="btn btn-info" disabled="">Submit</button>
                                </div> 
                            
                                 <div class="box-footer" style="margin-top: 10px;">
                                    
                                    <a href="<?php echo base_url();?>index.php/admin_user"  class="btn btn-danger" >Back</a>
                                </div> 
                            




                          

                        </div>
                    </div>
                    <!-- /.box-body -->

                    
                </div>

            </div>
            <!-- /.col -->
      
        <!-- /.row -->
    </section>
    <!-- /.content -->


    </form>








</div>



<script src="<?php echo base_url();?>custom_script/validation_rulse.js"></script>
<script src="<?php echo base_url();?>custom_script/setting_validation.js"></script>
<!--  <script src="<?php echo base_url();?>plugins/select2/select2.full.min.js"></script>
 <script src="<?php echo base_url();?>assets/js/jquery.multiselect.js"></script> -->


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
 function valid_form()
{
  

        var first_name = $('#first_name').val();
        if (!isNull(first_name)) 
        {
          $('#first_name').removeClass('black_border').addClass('red_border');

                $("#first_name").attr("data-toggle", "tooltip");
                $("#first_name").attr("data-placement", "bottom");
                document.getElementById('first_name').title = 'First Name Required';
                $('#first_name').tooltip('show');
        } 
        else 
        {
          $('#first_name').removeClass('red_border').addClass('black_border');

                document.getElementById('first_name').title = '';
                $('#first_name').tooltip('destroy');
        }

         var last_name = $('#last_name').val();
        if (!isNull(last_name)) 
        {
          $('#last_name').removeClass('black_border').addClass('red_border');

                $("#last_name").attr("data-toggle", "tooltip");
                $("#last_name").attr("data-placement", "bottom");
                document.getElementById('last_name').title = 'Last Name Required';
                $('#last_name').tooltip('show');
        } 
        else 
        {
          $('#last_name').removeClass('red_border').addClass('black_border');

                document.getElementById('last_name').title = '';
                $('#last_name').tooltip('destroy');
        }

         var email = $('#email').val();
        if (!isNull(email)) 
        {
          $('#email').removeClass('black_border').addClass('red_border');

                $("#email").attr("data-toggle", "tooltip");
                $("#email").attr("data-placement", "bottom");
                document.getElementById('email').title = 'Email Required';
                $('#email').tooltip('show');
        } 
        else 
        {
          $('#email').removeClass('red_border').addClass('black_border');

                document.getElementById('email').title = '';
                $('#email').tooltip('destroy');
        }

         var pass = $('#pass').val();
        if (!isNull(pass)) 
        {
          $('#pass').removeClass('black_border').addClass('red_border');

                 $("#pass").attr("data-toggle", "tooltip");
                 $("#pass").attr("data-placement", "bottom");
                 document.getElementById('pass').title = ' Password Required';
                 $('#pass').tooltip('show');
        } 
        else 
        {
          $('#pass').removeClass('red_border').addClass('black_border');

                 document.getElementById('pass').title = '';
                $('#pass').tooltip('destroy');
        }

         var mobile = $('#mobile').val();
        if (!isNull(mobile)) 
        {
          $('#mobile').removeClass('black_border').addClass('red_border');

                $("#mobile").attr("data-toggle", "tooltip");
                 $("#mobile").attr("data-placement", "bottom");
                 document.getElementById('mobile').title = 'Mobile Required';
                 $('#mobile').tooltip('show');
        } 
        else 
        {
          $('#mobile').removeClass('red_border').addClass('black_border');

                 document.getElementById('mobile').title = '';
                $('#mobile').tooltip('destroy');
        }

        var age = $('#age').val();
        if (!isNull(age)) 
        {
          $('#age').removeClass('black_border').addClass('red_border');

                  $("#age").attr("data-toggle", "tooltip");
                 $("#age").attr("data-placement", "bottom");
                 document.getElementById('age').title = 'Age Required';
                 $('#age').tooltip('show');
        } 
        else 
        {
          $('#age').removeClass('red_border').addClass('black_border');

                document.getElementById('age').title = '';
                $('#age').tooltip('destroy');
        }

         


         var exp = $('#exp').val();
        if (!isNull(exp)) 
        {
          $('#exp').removeClass('black_border').addClass('red_border');

                 $("#exp").attr("data-toggle", "tooltip");
                 $("#exp").attr("data-placement", "bottom");
                 document.getElementById('exp').title = 'Experience Required';
                 $('#exp').tooltip('show');
        } 
        else 
        {
          $('#exp').removeClass('red_border').addClass('black_border');

           document.getElementById('exp').title = '';
                $('#exp').tooltip('destroy');
        }

         var reg_no = $('#reg_no').val();
        if (!isNull(reg_no)) 
        {
          $('#reg_no').removeClass('black_border').addClass('red_border');

                 $("#reg_no").attr("data-toggle", "tooltip");
                 $("#reg_no").attr("data-placement", "bottom");
                 document.getElementById('reg_no').title = 'Registration No Required';
                 $('#reg_no').tooltip('show');
        } 
        else 
        {
          $('#reg_no').removeClass('red_border').addClass('black_border');

           document.getElementById('reg_no').title = '';
                $('#reg_no').tooltip('destroy');
        }


         var start = $('#start').val();
        if (!isNull(start)) 
        {
          $('#start').removeClass('black_border').addClass('red_border');

            $("#start").attr("data-toggle", "tooltip");
                 $("#start").attr("data-placement", "bottom");
                 document.getElementById('start').title = 'Start Date Required';
                 $('#start').tooltip('show');
        } 
        else 
        {
          $('#start').removeClass('red_border').addClass('black_border');

           document.getElementById('start').title = '';
                $('#start').tooltip('destroy');
        }

         var fees = $('#fees').val();
        if (!isNull(fees)) 
        {
          $('#fees').removeClass('black_border').addClass('red_border');

            $("#fees").attr("data-toggle", "tooltip");
                 $("#fees").attr("data-placement", "bottom");
                 document.getElementById('fees').title = 'Fees Required';
                 $('#fees').tooltip('show');
        } 
        else 
        {
          $('#fees').removeClass('red_border').addClass('black_border');

           document.getElementById('fees').title = '';
                $('#fees').tooltip('destroy');
        }

         var chamber = $('#chamber').val();
        if (!isNull(chamber)) 
        {
          $('#chamber').removeClass('black_border').addClass('red_border');

            $("#chamber").attr("data-toggle", "tooltip");
                 $("#chamber").attr("data-placement", "bottom");
                 document.getElementById('chamber').title = 'Choose The Field';
                 $('#chamber').tooltip('show');
        } 
        else 
        {
          $('#chamber').removeClass('red_border').addClass('black_border');

           document.getElementById('chamber').title = '';
                $('#chamber').tooltip('destroy');
        }

        



}
 function valid_doc_form()
 {
    $('#doc_add_form').attr('onchange', 'valid_form()');
    $('#doc_add_form').attr('onkeyup', 'valid_form()');

     valid_form();
    //alert($('#contact_form .red_border').size());

    if ($('#doc_add_form .red_border').size() > 0)
    {
      $('#doc_add_form .red_border:first').focus();
      $('#doc_add_form .alert-error').show();
      return false;
    } else {

      $('#doc_add_form').submit();
    }

 }

 </script>

<script >
    
    function edu_produce_file_box(id)
    {
      // alert(id);
         
        var val=id;
            
            if(val==1)
                {
                     $("#edu_no_1").hide();
                      $("#minus").hide();
                }
            var base_url='<?php echo base_url(); ?>';
            
            if(val==2)
                {
                    $("#edu_no_"+val).hide();
                   $("#minus").hide();
                }
            if(val==3)
                {
                    $("#edu_no_"+val).hide();
                    $("#minus").hide();
                }
             if(val==4)
                {
                    $("#edu_no_"+val).hide();
                    $("#minus").hide();
                }
             if(val==5)
                {
                    $("#edu_no_"+val).hide();
                    $("#minus").hide();
                }    
           

            $.ajax({
              
             url:base_url+'index.php/admin_user/edu_file_box_show',
             data:{num:val},
             dataType: "html",
             type: "POST",
             success: function(data){

               // alert(data);
              $("#edu_add_"+id).html(data);
              $("#edu_add_"+id).show();
              //$("#edu_delete").hide();
              

                 
                
              }
             });

    }


 function edu_hiding_out(val)
    {
        
          var current_div=val-1; 
         /* alert(val);
          alert(current_div);*/         
          $("#edu_add_"+val).html('');
          $("#edu_add_"+current_div).hide();
          $("#edu_no_"+current_div).show();
          $("#minus").show();

      
    }
  </script>

<script>
  
  function email_check(value)
  {
      //alert(value);
       var base_url='<?php echo  base_url();?>';
        if(value!='')
        {
          $.ajax({
                        
              url:base_url+'index.php/admin_user/check_mail',
              data:{email:value},
              dataType: "json",
              type: "POST",
              async: true,
              success: function(data)
              {

                    
                    var perform= data.changedone;
                    //alert(perform['status']);
                    if(perform['status']==2)
                      {

                        $("#error").html('Email is not valid.');
                       
                        $("#butt2").show(); 
                        $("#butt1").hide();

                       
                      }
                      else if(perform['status']==3)
                      {
                         $("#error").html('Email already exist.');
                       
                        $("#butt2").show(); 
                        $("#butt1").hide();

                      }
                      else
                      {
                        
                         $("#error").html("");
                         $("#butt1").show();
                         $("#butt2").hide(); 
                      }
                     
                      
               }

            
                            
                      
              });
        }
        else
        {
          $("#error").html("");
           $("#butt1").show();
           $("#butt2").hide(); 
        }
      
  }

</script>


 

