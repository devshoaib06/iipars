<style type="text/css">
    .thumb-image{float:left;width:100px;position:relative;padding:5px;}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <form class="" method="post" action="<?php echo base_url(); ?>index.php/admin_user/patient_add_action" id="doc_add_form">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>PATIENT INFORMATION ADD</h1>
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
                                                    <option value="">Choose Prefix</option>
                                                    <option value="Mr.">Mr.</option>
                                                    <option value="Ms.">Ms.</option>
                                                     <option value="Mrs.">Mrs.</option>
                                                      <option value="Baby">Baby</option>
                                                       <option value="Master">Master</option>
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

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Full Name<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="first_name" id="first_name" placeholder="Full Name" style="margin-bottom:12px" >
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">City/Village<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                              <input class="form-control" type="text" name="city"  id="city" placeholder="City/Village" style="margin-bottom:12px" >

                                            
                                                <!-- <input class="form-control" type="text" name="city" onkeyup="email_check(value)"  id="city" placeholder="City/Village" style="margin-bottom:12px" >
 -->
                                                 
                                            </div>

                                            <div class="col-sm-2">
                                            
                                                

                                                  <span id="error" style="color:red;margin-left: 4px;">  </span>
                                            </div>
                                        </div>

                                         <div class="clearfix"></div>


                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Mobile<!-- <span style="color:red">*</span> --></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="mobile" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="mobile" maxlength="11" style="margin-bottom:12px" placeholder="Mobile No">
                                            </div>
                                        </div>

                                         <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Age<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="age" id="age" style="margin-bottom:12px" placeholder="Age">
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                         <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Pulse(RPM)</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="pulse" id="pulse" style="margin-bottom:12px" placeholder="Pulse">
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">BP</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text"  name="upper" id="upper" style="margin-bottom:12px" placeholder="Upper">

                                                 <input class="form-control" type="text"  name="lower" id="lower" style="margin-bottom:12px" placeholder="Lower">
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>


                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Gender<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input  type="radio" name="gen" id="gen_m" value="male" style="margin-bottom:12px" checked="">Male
                                                  <input type="radio" name="gen" id="gen_f" value="female" style="margin-bottom:12px" >Female
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Weight (in Kg.)<!-- <span style="color:red">*</span> --></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="weight" id="weight1"  style="margin-bottom:12px" placeholder="Weight">
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Height (in m)<!-- <span style="color:red">*</span> --></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="height" id="height1" style="margin-bottom:12px" placeholder="Height">
                                            </div>
                                        </div>

                                         <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">BMI (kg/m^2)<!-- <span style="color:red">*</span> --></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="bmi" id="bmi2" style="margin-bottom:12px" readonly="" placeholder="BMI">
                                            </div>
                                        </div>


                                          <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Payment<!-- <span style="color:red">*</span> --></label>
                                            <div class="col-sm-8">
                                              <select name="payment" id="payment" class="form-control">
                                                
                                                <option value="">Select Payment</option>
                                                <option value="free">Free</option>
                                                <option value="paid">Paid</option>
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
                                    
                                    <button type="button"  class="btn btn-info" style="margin-left:12px" id="butt1" onclick="return valid_doc_form();">Submit</button>

                                     <button type="button" id="butt2" style="display: none;" class="btn btn-info" disabled="">Submit</button>
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
  

  var prefix = $('#prefix').val();
        if (!isNull(prefix)) 
        {
          $('#prefix').removeClass('black_border').addClass('red_border');

           $("#prefix").attr("data-toggle", "tooltip");
                $("#prefix").attr("data-placement", "bottom");
                document.getElementById('prefix').title = 'Prefix Required';
                $('#prefix').tooltip('show');
        } 
        else 
        {
          $('#prefix').removeClass('red_border').addClass('black_border');
           document.getElementById('prefix').title = '';
                $('#prefix').tooltip('destroy');
        }



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

        

        var city = $('#city').val();
        if (!isNull(city)) 
        {
          $('#city').removeClass('black_border').addClass('red_border');

           $("#city").attr("data-toggle", "tooltip");
                $("#city").attr("data-placement", "bottom");
                document.getElementById('city').title = 'City/Village Name Required';
                $('#city').tooltip('show');
        } 
        else 
        {
          $('#city').removeClass('red_border').addClass('black_border');

           document.getElementById('city').title = '';
                $('#city').tooltip('destroy');
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

          var payment = $('#payment').val();
        if (!isNull(payment)) 
        {
          $('#payment').removeClass('black_border').addClass('red_border');

            $("#payment").attr("data-toggle", "tooltip");
                $("#payment").attr("data-placement", "bottom");
                document.getElementById('payment').title = 'Payment Required';
                $('#payment').tooltip('show');
        } 
        else 
        {
          $('#payment').removeClass('red_border').addClass('black_border');

           document.getElementById('payment').title = '';
                $('#payment').tooltip('destroy');
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



<!-- <script>
  
  function email_check(value)
  {
      //alert(value);
       var base_url='<?php echo  base_url();?>';
        if(value!='')
        {
          $.ajax({
                        
              url:base_url+'index.php/admin_user/check_mail_patient',
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
 -->
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
 

