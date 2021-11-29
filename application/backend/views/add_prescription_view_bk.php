<style type="text/css">
    .thumb-image{float:left;width:100px;position:relative;padding:5px;}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <form class="" method="post" action="<?php echo base_url(); ?>index.php/admin_prescription/prescription_add" id="doc_add_form">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> ADD NEW PRESCRIPTION</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>index.php/admin_dashboard"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboad</a></li>
            <li class="active">Prescription</li>
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
                    <div class="box-body new_box">
                        <div class="tab-content">


                                <div id="vital_info" >
                                    
                                      <div class="col-md-12">
                                        <div id="patient_detail_table">

                                       
                                        </div>
                                      </div>
                                  <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Choose Patient<span style="color:red">*</span></label>
                                            <div class="col-sm-8" >

                                            <div id="div_patient">
                                               <select  class="form-control select2" name="patient" id="patient" onchange="get_data(this.value)"    required="">
                                                    
                                                    <option value="">Search By Patient Name</option>
                                                     <?php
                                                       foreach($patient as $row){

                                                        ?>

                                                   <option value="<?php echo $row->user_id; ?>" ><b><?php echo $row->first_name.' '.$row->last_name.' '.'('.$row->user_unique_id.')'; ?></b></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                    
                                   
                                        
                                       
                                        <!-- <div class="clearfix"></div> <div class="clearfix"></div> -->

                                        

                                      <!--   <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">First Name</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="first_name" readonly="" id="first_name" placeholder="First Name" style="margin-bottom:12px" >
                                            </div>
                                        </div>
                                              <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Last Name</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="last_name" readonly="" id="last_name" placeholder="Last Name" style="margin-bottom:12px" >
                                            </div>
                                        </div>
                                      

                                       
                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Mobile</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="mobile" readonly="" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="mobile" maxlength="11" style="margin-bottom:12px" placeholder="Mobile No">
                                            </div>
                                        </div>

                                         <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Age (year)</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="age" id="age" readonly="" style="margin-bottom:12px" placeholder="Age">
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Gender</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="gender" id="gender" readonly="" style="margin-bottom:12px" placeholder="Gender">
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Weight (Kg.)</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="weight" readonly="" id="weight" style="margin-bottom:12px" placeholder="Weight">
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Height (m)</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="height" readonly="" id="height" style="margin-bottom:12px" placeholder="Height">
                                            </div>
                                        </div>

                                         <div class="clearfix"></div>

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">BMI (Kg/m^2)</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="bmi" readonly=""  id="bmi" style="margin-bottom:12px" placeholder="BMI">
                                            </div>
                                        </div>

                                          <div class="clearfix"></div> -->
                                           <!-- <div class="clearfix"></div><br> -->
                                           
                                         <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">C/C</label>
                                            <div class="col-sm-8" >

                                            <div id="null">
                                               <select  class="form-control select2" name="cc[]" id="cc_0" multiple=""  required="">
                                                    
                      
                                                     <?php
                                                       foreach($cc as $row){

                                                        ?>

                                                   <option value="<?php echo $row->cc_id; ?>" ><?php echo $row->cc_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                      


                                         <!-- <div class="clearfix"></div> -->
                                        
                                         <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Known Patient Of
                                            </label>
                                            <div class="col-sm-8">
                                             <div id="null">
                                               <select  class="form-control select2" name="kpo[]" id="kpo" multiple=""  required="">
                                                    
                      
                                                     <?php
                                                       foreach($kpo as $row){

                                                        ?>

                                                   <option value="<?php echo $row->kpo_id; ?>" ><?php echo $row->kpo_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                      
                                           <div class="clearfix"></div>
                                           
                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">H/O</label>
                                            <div class="col-sm-8">
                                                 <div id="null">
                                               <select  class="form-control select2" name="kpo[]" id="kpo" multiple=""  required="">
                                                    
                      
                                                     <?php
                                                       foreach($ho as $row){

                                                        ?>

                                                   <option value="<?php echo $row->ho_id; ?>" ><?php echo $row->ho_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                      
                                       

                                        <!-- <div class="clearfix"></div> -->
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
                        <h3 class="box-title"><b><u>Examination</u> : </b></h3>
                       <!--  <ul class="nav nav-tabs">
                           <li class="active"><a data-toggle="tab" href="#vital_info">Vital Info</a></li>
                          
                       </ul> -->

                    </div>
                    <div class="clearfix"></div>
                    <!-- /.box-header -->
                    <div class="box-body new_box">
                        <div class="tab-content">


                                <div id="vital_info" >
                                  
                                        
                                       
                                      


                                       

                                       

                                        <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">General<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                             <div id="div_gen">
                                               <select  class="form-control select2" multiple="" name="gen[]" id="gen"  required="">
                                                
                                                    <?php 

                                                     $exam_type_gen =  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_type_id'=>2,'status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

                                                        foreach($exam_type_gen as $row)
                                                        {
                                                     ?>

                                                   <option value="<?php echo $row->examination_id; ?>" ><?php echo $row->examination_name; ?></option>
                                                   <?php } ?>
                                                  
                                                </select>
                                                </div>
                                            </div>
                                        </div>

                                         <div class="clearfix"></div>

                                    

                                           <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Pulse (RPM)<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="pulse" id="pulse" placeholder="Pulse">
                                            </div>
                                        </div>

                                          <div class="clearfix"></div>

                                           <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">BP<span style="color:red">*</span></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="text" name="upper" id="upper"placeholder="Upper">
                                            </div>

                                             <div class="col-sm-6">
                                                <input class="form-control" type="text" name="lower" id="lower"placeholder="Lower">
                                            </div>
                                        </div>

                                          <div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Chest<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                             <div id="div_chest">
                                               <select  class="form-control select2" multiple="" name="chest[]" id="chest"  required="">
                                                
                                                    <?php 

                                                      $exam_type_chest =  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_type_id'=>3,'status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


                                                        foreach($exam_type_chest as $row)
                                                        {
                                                     ?>

                                                   <option value="<?php echo $row->examination_id; ?>" ><?php echo $row->examination_name; ?></option>
                                                   <?php } ?>
                                                  
                                                </select>
                                                </div>
                                            </div>
                                        </div>


                                         <div class="clearfix"></div>

                                           <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">ABD<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                             <div id="div_abd">
                                               <select  class="form-control select2" multiple="" name="abd[]" id="abd"  required="">
                                                
                                                    <?php 

                                                      $exam_type_abd =  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_type_id'=>4,'status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

                                                        foreach($exam_type_abd as $row)
                                                        {
                                                     ?>

                                                   <option value="<?php echo $row->examination_id; ?>" ><?php echo $row->examination_name; ?></option>
                                                   <?php } ?>
                                                  
                                                </select>
                                                </div>
                                            </div>
                                        </div>

                                         <div class="clearfix"></div>

                                           <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">CNS<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                             <div id="div_cns">
                                               <select  class="form-control select2" multiple="" name="cns[]" id="cns"  required="">
                                                
                                                    <?php 

                                                     $exam_type_cns =  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_type_id'=>5,'status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

                                                        foreach($exam_type_cns as $row)
                                                        {
                                                     ?>

                                                   <option value="<?php echo $row->examination_id; ?>" ><?php echo $row->examination_name; ?></option>
                                                   <?php } ?>
                                                  
                                                </select>
                                                </div>
                                            </div>
                                        </div>

                                         <div class="clearfix"></div>






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
                        <h3 class="box-title"><b><u>Advice</u> : </b></h3>
                      <!--   <ul class="nav nav-tabs">
                           <li class="active"><a data-toggle="tab" href="#vital_info">Vital Info</a></li>
                          
                       </ul> -->

                    </div>
                    <div class="clearfix"></div>
                    <!-- /.box-header -->
                    <div class="box-body new_box">
                        <div class="tab-content">

          <div id="vital_info" >
                                  
                                        
                                       
                                      


                                       

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Medicine Name<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                               <select  class="form-control select" name="medicine[]" id="medicine"  required="">
                                                    <option value="">--Select Medicine--</option>
                      
                                                     <?php
                                                       foreach($med_list as $row){

                                                        ?>

                                                   <option value="<?php echo $row->medicine_id; ?>" ><?php echo $row->medicine_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div><div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Dose<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                              
                                                <textarea class="form-control" type="text" name="dose" id="dose"  placeholder="Dose"></textarea>
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

                                       






                                        <div class="clearfix"></div>
                                        <div class="box-footer">
                                        </div>

                                </div>


                            




                           
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

     <section class="content">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><b><u>Investigation/Diet/Counelling</u> : </b></h3>
                       <!--  <ul class="nav nav-tabs">
                           <li class="active"><a data-toggle="tab" href="#vital_info">Vital Info</a></li>
                          
                       </ul> -->

                    </div>
                    <div class="clearfix"></div>
                    <!-- /.box-header -->
                    <div class="box-body new_box">
                        <div class="tab-content">


                                <div id="vital_info" >
                                  
                                        
                                       
                                      


                                       

                                        <div class="clearfix"></div>

                                         <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Investigation Name<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                            <div id="div_inves">
                                               <select  class="form-control select2" multiple="" name="investigation[]" id="investigation"  required="">
                                                  
                      
                                                     <?php
                                                       foreach($investigation as $row){

                                                        ?>

                                                   <option value="<?php echo $row->investigation_id; ?>" ><?php echo $row->investigation_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                          <div class="clearfix"></div>

                                           <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Diet Name<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                            <div id="div_diet">
                                               <select  class="form-control select2" multiple="" name="diet[]" id="diet"  required="">
                                                  
                      
                                                     <?php
                                                       foreach($diet as $row){

                                                        ?>

                                                   <option value="<?php echo $row->diet_id; ?>" ><?php echo $row->diet_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                                </div>
                                            </div>
                                        </div>

                                            <div class="clearfix"></div>

                                           <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Councelling Name<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                            <div id="div_councel">
                                               <select  class="form-control select2" multiple="" name="councilling[]" id="councilling"  required="">
                                                   
                      
                                                     <?php
                                                       foreach($councelling as $row){

                                                        ?>

                                                   <option value="<?php echo $row->councelling_id; ?>" ><?php echo $row->councelling_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                                </div>
                                            </div>
                                        </div>

                                         <div class="clearfix"></div>

                                          
                                                 <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Diagnosis<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                            <div id="div_diagnosis">
                                               <select  class="form-control select2" multiple="" name="diagnosis[]" id="diagnosis"  required="">
                                                   
                      
                                                     <?php
                                                       foreach($diagnosis as $row){

                                                        ?>

                                                   <option value="<?php echo $row->diagnosis_id; ?>" ><?php echo $row->diagnosis_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                                </div>
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
                        <h3 class="box-title"><b><u>Review</u> : </b></h3>
                       <!--  <ul class="nav nav-tabs">
                           <li class="active"><a data-toggle="tab" href="#vital_info">Vital Info</a></li>
                          
                       </ul> -->

                    </div>
                    <div class="clearfix"></div>
                    <!-- /.box-header -->
                    <div class="box-body new_box">
                        <div class="tab-content">


                                <div id="vital_info" >
                                  
                                        
                                       
                                      


                                       

                                          <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Review<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                              
                                                <input class="form-control" type="date" name="review" id="review" >
                                            </div>
                                        </div>
                                         
                                        <div class="box-footer">
                                        </div>

                                </div>


                            




                           
                        </div>

                    <div class="box-footer" style="margin-top: 10px;float: right;margin-right: 17%;" >
                                    
                                    <button type="button"  class="btn btn-info" style="margin-left:12px" id="butt1" onclick="return valid_doc_form();">Submit</button>

                                     <button type="button" id="butt2" style="display: none;" class="btn btn-info" disabled="">Submit</button>
                                </div> 
                            
                                 <div class="box-footer" style="margin-top: 10px;">
                                    
                                    <a href="<?php echo base_url();?>index.php/admin_prescription"  class="btn btn-danger" style="margin-left:12px">Back</a>
                                </div> 
                            
                    </div>
                    <!-- /.box-body -->

                    
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>


    </form>








</div>



<script src="<?php echo base_url();?>custom_script/validation_rulse.js"></script>
<script src="<?php echo base_url();?>custom_script/setting_validation.js"></script>
 <script src="<?php echo base_url();?>plugins/select2/select2.full.min.js"></script>
<!--  <script src="<?php echo base_url();?>assets/js/jquery.multiselect.js"></script>  -->


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
      var options = $('#patient > option:selected');
         if(options.length == "")
              {
               $('#div_patient').removeClass('black_border').addClass('red_border');
              }
              else{
               $('#div_patient').removeClass('red_border').addClass('black_border');

              }

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


        var options = $('#cc_0 > option:selected');
         if(options.length == 0)
              {
               $('#div_cc').removeClass('black_border').addClass('red_border');
              }
              else{
               $('#div_cc').removeClass('red_border').addClass('black_border');

              }


               var options = $('#kpo > option:selected');
         if(options.length == 0)
              {
               $('#div_kpo').removeClass('black_border').addClass('red_border');
              }
              else{
               $('#div_kpo').removeClass('red_border').addClass('black_border');

              }

               var options = $('#gen > option:selected');
         if(options.length == 0)
              {
               $('#div_gen').removeClass('black_border').addClass('red_border');
              }
              else{
               $('#div_gen').removeClass('red_border').addClass('black_border');

              }

               var options = $('#chest > option:selected');
         if(options.length == 0)
              {
               $('#div_chest').removeClass('black_border').addClass('red_border');
              }
              else{
               $('#div_chest').removeClass('red_border').addClass('black_border');

              }

               var options = $('#abd > option:selected');
         if(options.length == 0)
              {
               $('#div_abd').removeClass('black_border').addClass('red_border');
              }
              else{
               $('#div_abd').removeClass('red_border').addClass('black_border');

              }

               var options = $('#cns > option:selected');
         if(options.length == 0)
              {
               $('#div_cns').removeClass('black_border').addClass('red_border');
              }
              else{
               $('#div_cns').removeClass('red_border').addClass('black_border');

              }

              var options = $('#investigation > option:selected');
         if(options.length == 0)
              {
               $('#div_inves').removeClass('black_border').addClass('red_border');
              }
              else{
               $('#div_inves').removeClass('red_border').addClass('black_border');

              }

               var options = $('#diet > option:selected');
         if(options.length == 0)
              {
               $('#div_diet').removeClass('black_border').addClass('red_border');
              }
              else{
               $('#div_diet').removeClass('red_border').addClass('black_border');

              }

               var options = $('#councilling > option:selected');
         if(options.length == 0)
              {
               $('#div_councel').removeClass('black_border').addClass('red_border');
              }
              else{
               $('#div_councel').removeClass('red_border').addClass('black_border');

              }

               var options = $('#diagnosis > option:selected');
         if(options.length == 0)
              {
               $('#div_diagnosis').removeClass('black_border').addClass('red_border');
              }
              else{
               $('#div_diagnosis').removeClass('red_border').addClass('black_border');

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


         var pulse = $('#pulse').val();
        if (!isNull(pulse)) 
        {
          $('#pulse').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#pulse').removeClass('red_border').addClass('black_border');
        }

         var upper = $('#upper').val();
        if (!isNull(upper)) 
        {
          $('#upper').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#upper').removeClass('red_border').addClass('black_border');
        }

         var lower = $('#lower').val();
        if (!isNull(lower)) 
        {
          $('#lower').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#lower').removeClass('red_border').addClass('black_border');
        }

 var dose = $('#dose').val();
        if (!isNull(dose)) 
        {
          $('#dose').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#dose').removeClass('red_border').addClass('black_border');
        }

         var medicine = $('#medicine').val();
        if (!isNull(medicine)) 
        {
          $('#medicine').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#medicine').removeClass('red_border').addClass('black_border');
        }

         var review = $('#review').val();
        if (!isNull(review)) 
        {
          $('#review').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#review').removeClass('red_border').addClass('black_border');
        }
        
 var ho = $('#ho').val();
        if (!isNull(ho)) 
        {
          $('#ho').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#ho').removeClass('red_border').addClass('black_border');
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
       alert(id);
         
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
              
             url:base_url+'index.php/admin_prescription/edu_file_box_show',
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

  <script type="text/javascript">
    function get_data(value)
    {


     
        var base_url='<?php echo base_url(); ?>';

        $.ajax(

            {

            type: "POST",

            dataType: 'html',

            url: base_url + "index.php/admin_prescription/get_user_data",

            data: {user_id:value},

            async: true,

            success: function (data) {


                $("#patient_detail_table").html(data);
              
               /* console.log(data.wishlist);

                var perform=data.changedone;

                $("#first_name").val(perform['user_detail'][0]['first_name']);

                $("#last_name").val(perform['user_detail'][0]['last_name']);

                $("#mobile").val(perform['user_detail'][0]['mobile']);


                $("#age").val(perform['user_detail'][0]['age']);

                $("#gender").val(perform['user_detail'][0]['gender']);

                $("#weight").val(perform['user_detail'][0]['weight']);

                $("#height").val(perform['user_detail'][0]['height']);

                $("#bmi").val(perform['user_detail'][0]['bmi']);
*/
            
                
               
               
                 
                 
               
        }

            

        }); 
  

 

    }
  </script>