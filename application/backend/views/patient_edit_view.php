<style type="text/css">
    .thumb-image{float:left;width:100px;position:relative;padding:5px;}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <form class="" method="post" action="<?php echo base_url(); ?>index.php/admin_user/patient_edit_action" id="doc_add_form">

    <input type="hidden" value="<?php echo @$user_patient[0]->user_id; ?>" name="patient_user_id"></input>

    
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>PATIENT INFORMATION EDIT</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>index.php/admin_dashboard"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboad</a></li>
            <li class="active">Patient Details</li>
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
                                            <label for="product_name" class="col-sm-2 control-label">Prefix<span style="color:red">*</span></label>
                                            <div class="col-sm-4">
                                            

                                               <select class="form-control" name="prefix" id="prefix" onchange="get_prefix(this.value)">
                                                 
                                                    <option value="Mr." <?php if(@$user_patient[0]->prefix=="Mr.") { echo "selected"; } ?>>Mr.</option>
                                                    <option value="Ms." <?php if(@$user_patient[0]->prefix=="Ms.") { echo "selected"; } ?>>Ms.</option>
                                                     <option value="Mrs." <?php if(@$user_patient[0]->prefix=="Mrs.") { echo "selected"; } ?>>Mrs.</option>
                                                      <option value="Baby" <?php if(@$user_patient[0]->prefix=="Baby") { echo "selected"; } ?>>Baby</option>
                                                       <option value="Master" <?php if(@$user_patient[0]->prefix=="Master") { echo "selected"; } ?>>Master</option>
                                               </select>
                                            </div>
                                        </div>
                                              <div class="clearfix"></div>

                                              <script type="text/javascript">
                                                function get_prefix(val)
                                                {

                                                    if(val=="Ms." || val=="Mrs." || val=="Baby")
                                                    {
                                                          $("#gen_f").prop('checked', true);
                                                    }
                                                    else
                                                    {
                                                        $("#gen_f").prop('checked', false);
                                                        $("#gen_m").prop('checked', true);

                                                    }
                                                }
                                              </script>
                                              <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Full Name<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="first_name" value="<?php echo @$user_patient[0]->first_name; ?>" id="first_name" placeholder="Full Name" style="margin-bottom:12px" >
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">City/Village<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                            
                                                <input class="form-control" type="city" name="city" id="city" value="<?php echo @$user_patient[0]->city; ?>" placeholder="city" style="margin-bottom:12px" >

                                                 
                                            </div>

                                            <div class="col-sm-2">
                                            
                                                

                                                  <span id="error" style="color:red;margin-left: 4px;">  </span>
                                            </div>
                                        </div>

                                        

                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Mobile<!-- <span style="color:red">*</span> --></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="mobile" value="<?php echo @$user_patient[0]->mobile; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="mobile" maxlength="11" style="margin-bottom:12px" placeholder="Mobile No">
                                            </div>
                                        </div>

                                         <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Age<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="age" id="age" value="<?php echo @$user_patient[0]->age; ?>" style="margin-bottom:12px" placeholder="Age">
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Pulse(RPM)</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" value="<?php echo @$user_patient[0]->pulse; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="pulse" id="pulse" style="margin-bottom:12px" placeholder="Pulse">
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">BP</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" value="<?php echo @$user_patient[0]->bp_upper; ?>"  name="upper" id="upper" style="margin-bottom:12px" placeholder="Upper">

                                                 <input class="form-control" type="text" value="<?php echo @$user_patient[0]->bp_lower; ?>"  name="lower" id="lower" style="margin-bottom:12px" placeholder="Lower">
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Gender<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input  type="radio" name="gen" id="gen_m" value="male" <?php if(@$user_patient[0]->gender=='Male'){ echo 'checked'; } ?> style="margin-bottom:12px">Male
                                                  <input type="radio" name="gen" id="gen_f" value="female" <?php if(@$user_patient[0]->gender=='Female'){ echo 'checked'; } ?> style="margin-bottom:12px" >Female
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                           <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Weight (in Kg.)<!-- <span style="color:red">*</span> --></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="weight" value="<?php echo @$user_patient[0]->weight; ?>" id="weight1" style="margin-bottom:12px" placeholder="Weight">
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Height (in m)<!-- <span style="color:red">*</span> --></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="height" value="<?php echo @$user_patient[0]->height; ?>" id="height1" style="margin-bottom:12px" placeholder="Height">
                                            </div>
                                        </div> 

                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">BMI (Kg/m^2)<!-- <span style="color:red">*</span> --></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="bmi" readonly="" value="<?php echo @$user_patient[0]->bmi; ?>" id="bmi2" style="margin-bottom:12px" placeholder="BMI">
                                            </div>
                                        </div> 

                                         <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Payment<!-- <span style="color:red">*</span> --></label>
                                            <div class="col-sm-8">
                                              <select name="payment" id="payment" class="form-control">
                                                
                                                
                                                <option value="free" <?php if(@$user_patient[0]->payment=="free") { echo "selected"; } ?>>Free</option>
                                                <option value="paid" <?php if(@$user_patient[0]->payment=="paid") { echo "selected"; } ?>>Paid</option>
                                              </select>
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
                   
                    <div class="clearfix"></div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="tab-content">

                                   
                              

                                <div class="box-footer" style="margin-top: 10px;float: right;" >
                                    
                                    <button type="button"  class="btn btn-info" style="margin-left:12px" id="butt1" onclick="return valid_doc_form();">Update</button>

                                     <button type="button" id="butt2" style="display: none;" class="btn btn-info" disabled="">Update</button>
                                </div> 
                            
                                 <div class="box-footer" style="margin-top: 10px;">
                                    
                                    <a href="<?php echo base_url();?>index.php/admin_user/patient_view"  class="btn btn-danger" style="margin-left:12px">Back</a>
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
        } 
        else 
        {
          $('#first_name').removeClass('red_border').addClass('black_border');
        }

         var last_name = $('#last_name').val();
        if (!isNull(last_name)) 
        {
          $('#last_name').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#last_name').removeClass('red_border').addClass('black_border');
        }

         var city = $('#city').val();
        if (!isNull(city)) 
        {
          $('#city').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#city').removeClass('red_border').addClass('black_border');
        }

    /*     var pass = $('#pass').val();
        if (!isNull(pass)) 
        {
          $('#pass').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#pass').removeClass('red_border').addClass('black_border');
        }*/

/*         var mobile = $('#mobile').val();
        if (!isNull(mobile)) 
        {
          $('#mobile').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#mobile').removeClass('red_border').addClass('black_border');
        }*/

        var age = $('#age').val();
        if (!isNull(age)) 
        {
          $('#age').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#age').removeClass('red_border').addClass('black_border');
        }

  /*        var weight1 = $('#weight1').val();
        if (!isNull(weight1)) 
        {
          $('#weight1').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#weight1').removeClass('red_border').addClass('black_border');
        }

         var height1 = $('#height1').val();
        if (!isNull(height1)) 
        {
          $('#height1').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#height1').removeClass('red_border').addClass('black_border');
        }


         var bmi = $('#bmi').val();
        if (!isNull(bmi)) 
        {
          $('#bmi').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#bmi').removeClass('red_border').addClass('black_border');
        }

         var reg_no = $('#reg_no').val();
        if (!isNull(reg_no)) 
        {
          $('#reg_no').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#reg_no').removeClass('red_border').addClass('black_border');
        }


         var start = $('#start').val();
        if (!isNull(start)) 
        {
          $('#start').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#start').removeClass('red_border').addClass('black_border');
        }

         var fees = $('#fees').val();
        if (!isNull(fees)) 
        {
          $('#fees').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#fees').removeClass('red_border').addClass('black_border');
        }

         var chamber = $('#chamber').val();
        if (!isNull(chamber)) 
        {
          $('#chamber').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#chamber').removeClass('red_border').addClass('black_border');
        }

        */



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
     function price_hiding_out(val)
    {
        //alert('ok');
      $("#price_"+val).remove();
    }
  </script>

<!-- <script>
  
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

</script> -->


 <script type="text/javascript">
 
  
   

     $('#weight1,#height1').on('keyup keypress change', function(e) {
      
          

        var weight=$("#weight1").val();

        var height=$("#height1").val();
       
        var bmi=weight/height;
        var bmi1=bmi/height;


       if(weight != "" && height != "") {

      

      $("#bmi2").val(bmi1);


       }
       else
       {

       }

    });


</script>
 

