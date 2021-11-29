<style type="text/css">
    .thumb-image{float:left;width:100px;position:relative;padding:5px;}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <form class="" method="post" >

    <input type="hidden" value="<?php echo @$user_doc[0]->user_id; ?>" name="doc_user_id"></input>

    <input type="hidden" value="<?php echo @$doc_id; ?>" name="doc_id"></input>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>DETAILS OF DR. <?php echo @$user_doc[0]->first_name." ".@$user_doc[0]->last_name; ?></h1>
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
                                            <label for="product_name" class="col-sm-2 control-label">First Name</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="first_name" readonly="" value="<?php echo @$user_doc[0]->first_name; ?>" id="first_name" placeholder="First Name" style="margin-bottom:12px" >
                                            </div>
                                        </div>
                                              <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Last Name</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="last_name" readonly="" value="<?php echo @$user_doc[0]->last_name; ?>" id="last_name" placeholder="Last Name" style="margin-bottom:12px" >
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-8">
                                            
                                                <input class="form-control" type="email" name="email" onkeyup="email_check(value)" readonly="" id="email" value="<?php echo @$user_doc[0]->login_email; ?>" placeholder="Email" style="margin-bottom:12px" >

                                                 
                                            </div>

                                            <div class="col-sm-2">
                                            
                                                

                                                  <span id="error" style="color:red;margin-left: 4px;">  </span>
                                            </div>
                                        </div>

                                         <div class="clearfix"></div>

                                       <!--    <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Password</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="password" name="pass" readonly="" value="<?php echo @$user_doc[0]->login_pass; ?>" id="pass" placeholder="Password" style="margin-bottom:12px" >
                                            </div>
                                        </div> -->

                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Mobile</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="mobile" readonly="" value="<?php echo @$user_doc[0]->mobile; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="mobile" maxlength="11" style="margin-bottom:12px" placeholder="Mobile No">
                                            </div>
                                        </div>

                                         <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Age</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="age" readonly="" id="age" value="<?php echo @$user_doc[0]->age; ?>" style="margin-bottom:12px" placeholder="Age">
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Gender</label>
                                            <div class="col-sm-8">
                                                <input  type="radio" name="gen" id="gen" value="male" style="margin-bottom:12px" <?php if(@$user_doc[0]->gender=='Male') { echo 'checked'; } ?>>Male
                                                  <input type="radio" name="gen" id="gen" value="female" <?php if(@$user_doc[0]->gender=='Female') { echo 'checked'; } ?> style="margin-bottom:12px" >Female
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                         <!--  <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Weight (Kg.)<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="weight" value="<?php echo @$user_doc[0]->weight; ?>" id="weight" style="margin-bottom:12px" placeholder="Weight">
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Height (Feet)<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="height" value="<?php echo @$user_doc[0]->height; ?>" id="height" style="margin-bottom:12px" placeholder="Height">
                                            </div>
                                        </div> -->


                                       

                                      
                                       

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

                                        <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Experience</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" type="text" readonly="" name="exp" id="exp" style="margin-bottom:12px" placeholder="Experience">
                                                    <?php echo @$doc[0]->exp_desc; ?>
                                                </textarea>
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Registration No</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" readonly="" name="reg_no" id="reg_no" value="<?php echo @$doc[0]->reg_no; ?>" style="margin-bottom:12px" placeholder="Registration No">
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Practice Start Date</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="date" readonly="" name="start" id="start" value="<?php echo @$doc[0]->start_year; ?>" style="margin-bottom:12px" >
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
                                    <?php
                                                
                                                     for($i=0;$i<count($doc_chamber);$i++)
                                                {

                                     ?>
                                        
                                       <div id="price_<?php echo $i+1; ?>">
                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Chamber Name</label>
                                            <div class="col-sm-8">
                                               <select  class="form-control select" readonly="" name="chamber[]" id="chamber"  required="">
                                                  
                      
                                                     <?php
                                                       foreach($chamber_list as $row){

                                                        ?>

                                                   <option value="<?php echo $row->chamber_id; ?>" <?php if($doc_chamber[$i]->chamber_id==$row->chamber_id){ echo 'selected'; } ?> readonly><?php echo $row->chamber_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                            </div>
                                        </div><br><br>
                                        <div class="clearfix"></div><div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Fees(Rs.)</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="fees[]" readonly="" id="fees" value="<?php echo $doc_chamber[$i]->fees; ?>" style="margin-bottom:12px" placeholder="Fees">
                                            </div>
                                        </div>
                                        </div>
                                                

                                        <?php } ?>
                                       

                                     
                                       
                                       

                                       

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
                                    
                                   
                                </div> 
                            
                                 <div class="box-footer" style="margin-top: 10px;">
                                    
                                    <a href="<?php echo base_url();?>index.php/admin_user"  class="btn btn-danger" style="margin-left:12px">Back</a>
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

         var email = $('#email').val();
        if (!isNull(email)) 
        {
          $('#email').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#email').removeClass('red_border').addClass('black_border');
        }

         var pass = $('#pass').val();
        if (!isNull(pass)) 
        {
          $('#pass').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#pass').removeClass('red_border').addClass('black_border');
        }

         var mobile = $('#mobile').val();
        if (!isNull(mobile)) 
        {
          $('#mobile').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#mobile').removeClass('red_border').addClass('black_border');
        }

        var age = $('#age').val();
        if (!isNull(age)) 
        {
          $('#age').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#age').removeClass('red_border').addClass('black_border');
        }

          var weight = $('#weight').val();
        if (!isNull(weight)) 
        {
          $('#weight').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#weight').removeClass('red_border').addClass('black_border');
        }

         var height = $('#height').val();
        if (!isNull(height)) 
        {
          $('#height').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#height').removeClass('red_border').addClass('black_border');
        }


         var exp = $('#exp').val();
        if (!isNull(exp)) 
        {
          $('#exp').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#exp').removeClass('red_border').addClass('black_border');
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


 

