<style type="text/css">
    .thumb-image{float:left;width:100px;position:relative;padding:5px;}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <form class="" method="post" action="<?php echo base_url(); ?>index.php/admin_prescription/prescription_add" id="doc_add_form">
    <!-- Content Header (Page header) -->
  <!--   <section class="content-header">
        <h1> ADD NEW PRESCRIPTION</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>index.php/admin_dashboard"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboad</a></li>
            <li class="active">Prescription</li>
        </ol>
    </section> -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <div class="box">
                  <!--   <div class="box-header">
                        <h3 class="box-title"><b><u>General Information</u> : </b></h3>
                      

                    </div> -->
                    <div class="clearfix"></div>
                    <!-- /.box-header -->
                    <div class="box-body new_box">
                        <div class="tab-content">


                                <div id="vital_info" >
                                    
                                      <div class="col-md-12">
                                        <div id="patient_detail_table">

                                       
                                        </div>
                                      </div>
                                      <div class="p-cus-class-all-section" id="p-add-cus-new-class">

                                  <div class="form-group frm-diff top">
                                            <label for="product_name" class="col-sm-2 control-label">Choose Patient</label>
                                            <div class="col-sm-8" >

                                            <div id="div_patient">
                                               <select  class="form-control select2" name="patient" id="patient" onchange="get_data(this.value),get_pulse(this.value),get_exist_patient(this.value)"    required="">
                                                    
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
                                      
                                           
                                         <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">C/C</label>
                                            <div class="col-sm-8" >

                                            <div id="null">
                                               <select  class="form-control" name="cc[]" id="cc_0"  required="">
                                                    
                                            <option>Select C/C</option>
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


                                             <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">Days</label>
                                            <div class="col-sm-8">
                                              
                                               <select  class="form-control" name="dose_cc[]" id="dose_cc_0"  required="">
                                                <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
                                                ?>

                                                    <option value="">--Select Days--</option>
                                                    <?php 

                                                        foreach($days as $row)
                                                        {
                                                     ?>
                                                    <option value="<?php echo $row->id; ?>"><?php echo 'since '.$row->day; ?></option>
                                                    <?php } ?>
                      
                                                 <option></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="cc-p-cus-design">
                                        <div id="edu_cc_1"></div>
                                           <div id="edu_cc_2"></div>
                                           <div id="edu_cc_3"></div>
                                           <div id="edu_cc_4"></div>
                                            <div id="edu_cc_5"></div> 

                                             <div id="edu_cc_6"></div>
                                           <div id="edu_cc_7"></div>
                                           <div id="edu_cc_8"></div>
                                           <div id="edu_cc_9"></div>
                                            <div id="edu_cc_10"></div> 
                                          </div>
                                          <div class="p-cus-know-more-ho-days">
                                        <div class="form-group frm-diff">
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
                                      
                                           
                                          <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">H/O</label>
                                            <div class="col-sm-8">
                                                 <div id="null">
                                               <select  class="form-control" name="ho[]" id="ho"   required="">
                                                    
                          <option>Select H/O</option>
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

                                          <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">Days</label>
                                            <div class="col-sm-8">

                                            <input type="text" class="form-control" name="dose_ho[]" id="dose_ho_0">
                                              
                                              <!--  <select  class="form-control" name="dose_ho[]" id="dose_ho_0"  required="">
                                                <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
                                                ?>

                                                    <option value="">--Select Days--</option>
                                                    <?php 

                                                        foreach($days as $row)
                                                        {
                                                     ?>
                                                    <option value="<?php echo $row->id; ?>"><?php echo $row->day; ?></option>
                                                    <?php } ?>
                      
                                                 <option></option>
                                                </select> -->
                                            </div>
                                        </div>
                                        <a href="javacript:void(0)"  id="edu_no3_1" onclick="edu_produce_file_box_ho('1')" class="btn btn-primary"><b>+</b></a>
                                      </div>
                                      </div>

                                         

                                       
                                            <div id="edu_ho_1"></div>
                                           <div id="edu_ho_2"></div>
                                           <div id="edu_ho_3"></div>
                                           <div id="edu_ho_4"></div>
                                            <div id="edu_ho_5"></div> 

                                             <div id="edu_ho_6"></div>
                                           <div id="edu_ho_7"></div>
                                           <div id="edu_ho_8"></div>
                                           <div id="edu_ho_9"></div>
                                            <div id="edu_ho_10"></div> 


                                       <!--  <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">To add new H/O</label>
                                            <div class="col-sm-8">                                               
                                                <div id="null">
                                               <input type="text" class="form-control" name="ho_new" id="ho_new" multiple="" required="" placeholder="To add new H/O(example:HO1,HO2,..)">
                                                </div>
                                            </div>
                                        </div> -->

                                        <!-- <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">To add new C/C</label>
                                            <div class="col-sm-8">
                                                  <div id="null">
                                                    <input type="text" class="form-control" name="cc_new" id="cc_new" multiple="" required="" placeholder="To add new C/C(example: CC1,CC2,..)">
                                                </div>
                                             </div>
                                           </div> -->

                                        
                                        <a href="javacript:void(0)"  id="edu_no2_1" onclick="edu_produce_file_box_cc('1')" class="btn btn-primary"><b>+</b></a>

                                       
                                            

                                            



                                      


                                       
                                        

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

                                        <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">General</label>
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
                                           


                                           <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">Pulse (RPM)</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="pulse" id="pulse" placeholder="Pulse">
                                            </div>
                                        </div>

                                         <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">Choose</label>
                                            <div class="col-sm-8">
                                               <!--  <input class="form-control" type="text" name="pulse" id="pulse" placeholder="Pulse"> -->
                                               <Select class="form-control" name="pulse_type"><option value="">Please Select</option>

                                               <option value="Regular">Regular</option>
                                                <option value="Regularly Irregular">Regularly Irregular</option>
                                                  <option value="Irregularly Irregular">Irregularly Irregular</option>
                                                    <option value="Pulse Deficit+">Pulse Deficit+</option>

                                               ></Select>
                                            </div>
                                        </div>


                                           <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">BP</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="text" name="upper" id="upper"placeholder="Upper">
                                            </div>

                                             <div class="col-sm-6">
                                                <input class="form-control" type="text" name="lower" id="lower"placeholder="Lower">
                                            </div>
                                        </div>


                                        <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">Chest</label>
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

                                        
                                       

                                                    <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">Heart</label>
                                            <div class="col-sm-8">
                                             <div id="div_chest">
                                               <select  class="form-control select2" multiple="" name="heart[]" id="heart"  required="">
                                                
                                                    <?php 

                                                      $exam_type_heart =  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_type_id'=>6,'status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


                                                        foreach($exam_type_heart as $row)
                                                        {
                                                     ?>

                                                   <option value="<?php echo $row->examination_id; ?>" ><?php echo $row->examination_name; ?></option>
                                                   <?php } ?>
                                                  
                                                </select>
                                                </div>
                                                 
                                            </div>
                                        </div>

                                            



                                           <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">ABD</label>
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
                                        

                                           <div class="form-group frm-diff top">
                                            <label for="product_name" class="col-sm-2 control-label">CNS</label>
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
                        <h3 class="box-title"><b><u>Report</u> : </b></h3>
                      <!--   <ul class="nav nav-tabs">
                           <li class="active"><a data-toggle="tab" href="#vital_info">Vital Info</a></li>
                          
                       </ul> -->

                    </div>
                    <div class="clearfix"></div>
                    <!-- /.box-header -->
                    <div class="box-body new_box">
                        <div class="tab-content">
                             <div id="vital_info" >
                             
                                              <div class="form-group frm-diff">
                                           
                                            <div class="col-sm-8">
                                            <div id="div_inves">
                                               <select  class="form-control"  name="write[]" id="write"  required="">  

                                                <option value="" >Select</option>            
                      
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

                                          <div class="form-group frm-diff">
                                           <!--  <label for="product_name" class="col-sm-2 control-label">Date</label> -->
                                            <div class="col-sm-8">
                                              
                                             

                                                <input type="text" name="write_some[]" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group frm-diff">
                                           <!--  <label for="product_name" class="col-sm-2 control-label">Date</label> -->
                                            <div class="col-sm-8">
                                              
                                             

                                                <input type="date" name="date[]" class="form-control">
                                            </div>
                                        </div>

                                        <!-- <a href="javacript:void(0)"  id="edu_no1_1" onclick="edu_produce_file_box1('1')" class="btn btn-primary"><b>Add More</b></a> -->
<div class="report-section-text-p-cus">
                                        <a href="javacript:void(0)" class="btn btn-primary" id="edu_report_no_1" onclick="edu_report_produce_file_box('1')"><b>+</b></a>
                                      </div>
                                     

                                     
                                            <div id="add_more_edu_report_no_1"></div>
                                           <div id="add_more_edu_report_no_2"></div>
                                           <div id="add_more_edu_report_no_3"></div>
                                           <div id="add_more_edu_report_no_4"></div>
                                            <div id="add_more_edu_report_no_5"></div> 

                                             <div id="add_more_edu_report_no_6"></div>
                                           <div id="add_more_edu_report_no_7"></div>
                                           <div id="add_more_edu_report_no_8"></div>
                                           <div id="add_more_edu_report_no_9"></div>
                                            <div id="add_more_edu_report_no_10"></div> 


                                       

                                       

                                        
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



    <script >
    
    function edu_report_produce_file_box(id)
    {
      
         
        var val=id;

      //  alert(val);
            
           /* if(val==1)
                {
                     $("#edu_report_no_1").hide();
                      $("#report_minus").hide();
                }
            var base_url='<?php echo base_url(); ?>';
            
            if(val==2)
                {
                    $("#edu_report_no_"+val).hide();
                   $("#report_minus").hide();
                }
            if(val==3)
                {
                    $("#edu_report_no_"+val).hide();
                    $("#report_minus").hide();
                }
             if(val==4)
                {
                    $("#edu_report_no_"+val).hide();
                    $("#report_minus").hide();
                }
             if(val==5)
                {
                    $("#edu_report_no_"+val).hide();
                    $("#report_minus").hide();
                }
                if(val==6)
                {
                    $("#edu_report_no_"+val).hide();
                    $("#report_minus").hide();
                }   
                if(val==7)
                {
                    $("#edu_report_no_"+val).hide();
                    $("#report_minus").hide();
                }       
                if(val==8)
                {
                    $("#edu_report_no_"+val).hide();
                    $("#report_minus").hide();
                }   
                if(val==9)
                {
                    $("#edu_report_no_"+val).hide();
                    $("#report_minus").hide();
                }   
                if(val==10)
                {
                    $("#edu_report_no_"+val).hide();
                    $("#report_minus").hide();
                }  

                */ 




                 if(val==1)
        {
         $("#edu_report_no_1").hide();
         $("#report_minus").hide();
       }
       var base_url='<?php echo base_url(); ?>';
     



       if(val==2)
                {
                    $("#edu_report_no_"+val).hide();
                 //  $("#report_minus").hide();
                }
            if(val==3)
                {
                    $("#edu_report_no_"+val).hide();
                  //  $("#report_minus").hide();
                }
             if(val==4)
                {
                    $("#edu_report_no_"+val).hide();
                   // $("#report_minus").hide();
                }
             if(val==5)
                {
                    $("#edu_report_no_"+val).hide();
                  //  $("#report_minus").hide();
                }
                if(val==6)
                {
                    $("#edu_report_no_"+val).hide();
                  //  $("#report_minus").hide();
                }   
                if(val==7)
                {
                    $("#edu_report_no_"+val).hide();
                   // $("#report_minus").hide();
                }       
                if(val==8)
                {
                    $("#edu_report_no_"+val).hide();
                  //  $("#report_minus").hide();
                }   
                if(val==9)
                {
                    $("#edu_report_no_"+val).hide();
                  //  $("#report_minus").hide();
                }   
                if(val==10)
                {
                    $("#edu_report_no_"+val).hide();
                  //  $("#report_minus").hide();
                }  










           

            $.ajax({
              
             url:base_url+'index.php/admin_prescription/edu_report_file_box_show',
             data:{num:val},
             dataType: "html",
             type: "POST",
             success: function(data){

               // alert(data);
              $("#add_more_edu_report_no_"+id).html(data);
              $("#add_more_edu_report_no_"+id).show();
              //$("#edu_delete").hide();
              

                 
                
              }
             });

    }


 function edu_report_hiding_out(val)
    {
        
          var current_div=val-1; 

        //  alert(val);
        //  alert(current_div);


         /* alert(val);
          alert(current_div);*/         
          $("#add_more_edu_report_no_"+val).html('');
          $("#add_more_edu_report_no_"+current_div).hide();
         // $("#edu_report_no_"+current_div).show();
           $("#edu_report_no_"+current_div).show();
          $("#report_minus").show();

      
    }
  </script>









             <section class="content">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <div class="box">
                     <div class="box-header">
                        <h3 class="box-title"><b><u>Gynecology</u> : </b></h3>
                      <!--   <ul class="nav nav-tabs">
                           <li class="active"><a data-toggle="tab" href="#vital_info">Vital Info</a></li>
                          
                       </ul> -->

                    </div>
                    <div class="clearfix"></div>
                    <!-- /.box-header -->
                    <div class="box-body new_box">
                        <div class="tab-content">
                             <div id="vital_info" >
                               

                                        <div class="form-group frm-diff">
                                           <label for="product_name" class="col-sm-2 control-label">LMP</label> 
                                            <div class="col-sm-8">
                                              
                                             

                                                <input type="date" name="date7" class="form-control">
                                            </div>
                                        </div>

                                         <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">EDD</label> 
                                            <div class="col-sm-8">
                                              
                                             

                                                <input type="date" name="date8" class="form-control">
                                            </div>
                                        </div>

                                         <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">Weight(Kg.)</label> 
                                            <div class="col-sm-8">
                                              
                                             

                                                <input type="text" readonly="" name="gyno_weight" id="gyno_weight" class="form-control">
                                            </div>
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

<script >
    
    function edu_produce_file_box1(id)
    {
      
         
        var val=id;
            
            if(val==1)
                {
                     $("#edu_no1_1").hide();
                      $("#minus1").hide();
                }
            var base_url='<?php echo base_url(); ?>';
            
            if(val==2)
                {
                    $("#edu_no1_"+val).hide();
                   $("#minus1").hide();
                }
            if(val==3)
                {
                    $("#edu_no1_"+val).hide();
                    $("#minus1").hide();
                }
             if(val==4)
                {
                    $("#edu_no1_"+val).hide();
                    $("#minus1").hide();
                }
             if(val==5)
                {
                    $("#edu_no1_"+val).hide();
                    $("#minus1").hide();
                }
                if(val==6)
                {
                    $("#edu_no1_"+val).hide();
                    $("#minus1").hide();
                }   
                if(val==7)
                {
                    $("#edu_no1_"+val).hide();
                    $("#minus1").hide();
                }       
                if(val==8)
                {
                    $("#edu_no1_"+val).hide();
                    $("#minus1").hide();
                }   
                if(val==9)
                {
                    $("#edu_no1_"+val).hide();
                    $("#minus1").hide();
                }   
                if(val==10)
                {
                    $("#edu_no1_"+val).hide();
                    $("#minus1").hide();
                }   

           

            $.ajax({
              
             url:base_url+'index.php/admin_user/edu_file_box_show1',
             data:{num:val},
             dataType: "html",
             type: "POST",
             success: function(data){

               // alert(data);
              $("#edu_add1_"+id).html(data);
              $("#edu_add1_"+id).show();
              //$("#edu_delete").hide();
              

                 
                
              }
             });

    }


 function edu_hiding_out1(val)
    {
        
          var current_div=val-1; 
         /* alert(val);
          alert(current_div);*/         
          $("#edu_add1_"+val).html('');
          $("#edu_add1_"+current_div).hide();
          $("#edu_no1_"+current_div).show();
          $("#minus1").show();

      
    }
  </script>
         <section class="content">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><b><u>Investigation</u> : </b></h3>
                       <!--  <ul class="nav nav-tabs">
                           <li class="active"><a data-toggle="tab" href="#vital_info">Vital Info</a></li>
                          
                       </ul> -->

                    </div>
                    <div class="clearfix"></div>
                    <!-- /.box-header -->
                    <div class="box-body new_box">
                        <div class="tab-content">
                            <div id="vital_info" >
                                      <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">Investigation Name</label>
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
                                        
                                     

                                  

                                          
                                                 <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">Diagnosis</label>
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

     <section class="content advice-main-p-cus-section">
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
<div class="advice-all-section-two-sec-p-cus">
                              <div class="form-group frm-diff">
                                         <label for="product_name" class="col-sm-2 control-label">Disease</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select" name="group[]" onchange="get_med(this.value,1)" id="group_1"  required="">
                                                    <option value="">--Select Group--</option>
                      
                                                     <?php
                                                       foreach($group as $row){

                                                        ?>

                                                   <option value="<?php echo $row->group_id; ?>" ><?php echo $row->group_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                            </div>
                                        </div>
                                   <div class="form-group frm-diff disease-medi-p-cus">
                                         <label for="product_name" class="col-sm-2 control-label">Disease Medicine</label>
                                          <div class="col-sm-12">
                                               <select  class="form-control select2" multiple="" name="medicine1[]" id="medicine_1"  required="">
                                                    <option value="">--Select Medicine--</option>
                      
                                                    <!--  <?php
                                                       foreach($med_list as $row){

                                                        ?>

                                                   <option value="<?php echo $row->medicine_id; ?>" ><?php echo $row->medicine_name; ?></option>
                                                  <?php
                                                    }
                                                  ?> -->
                                                </select>
                                            </div>
                                       

                                           <a href="javacript:void(0)"  id="edu_no_1" onclick="edu_produce_file_box('1')" class="btn btn-primary"><b>+</b></a>

                                        </div>

                                       

                                        <div class="clearfix"></div>
                                        <div class="box-footer">
                                        </div>
                                            <div id="edu_add_1"></div>
                                           <div id="edu_add_2"></div>
                                           <div id="edu_add_3"></div>
                                           <div id="edu_add_4"></div>
                                            <div id="edu_add_5"></div> 

                                             <div id="edu_add_6"></div>
                                           <div id="edu_add_7"></div>
                                           <div id="edu_add_8"></div>
                                           <div id="edu_add_9"></div>
                                            <div id="edu_add_10"></div> 
                                          </div>

                                      <div class="p-cus-medicine-name-all-width">
                                        <div class="form-group frm-diff medi-p-cus-se">
                                         <label for="product_name" class="col-sm-2 control-label">Medicine Name</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control"  name="my_medicine[]" id="my_medicine_0"  required="">
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

                                          <div class="form-group frm-diff p-cus-medi-cus-all-days">
                                            <label for="product_name" class="col-sm-2 control-label">Days</label>
                                            <div class="col-sm-8">
                                              
                                               <select  class="form-control" name="dose[]" id="dose_1"  required="">
                                                <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
                                                ?>

                                                    <option value="">--Select Days--</option>
                                                    <?php 

                                                        foreach($days as $row)
                                                        {
                                                     ?>
                                                    <option value="<?php echo $row->id; ?>"><?php echo 'for '.$row->day; ?></option>
                                                    <?php } ?>
                      
                                                 <option></option>
                                                </select>
                                            </div>
                                        </div>

                                         <a href="javacript:void(0)"  id="edu_nomed_1" onclick="edu_produce_file_box_my_med('1')" class="btn btn-primary"><b>+</b></a>
                                       </div>
                                     

                                       

                                       

                                        <div class="clearfix"></div>
                                        <div class="box-footer">
                                        </div>
                                            <div id="edu_my_med_1"></div>
                                           <div id="edu_my_med_2"></div>
                                           <div id="edu_my_med_3"></div>
                                           <div id="edu_my_med_4"></div>
                                            <div id="edu_my_med_5"></div> 

                                             <div id="edu_my_med_6"></div>
                                           <div id="edu_my_med_7"></div>
                                           <div id="edu_my_med_8"></div>
                                           <div id="edu_my_med_9"></div>
                                            <div id="edu_my_med_10"></div> 


                                            <script type="text/javascript">
                                              function edu_produce_file_box_my_med(id)
                                              {

                                                 var val=id;
                                                            
                                                            if(val==1)
                                                                {
                                                                     $("#edu_nomed_1").hide();
                                                                      $("#minus").hide();
                                                                }
                                                            var base_url='<?php echo base_url(); ?>';
                                                            
                                                            if(val==2)
                                                                {
                                                                    $("#edu_nomed_"+val).hide();
                                                                   $("#minus").hide();
                                                                }
                                                            if(val==3)
                                                                {
                                                                    $("#edu_nomed_"+val).hide();
                                                                    $("#minus").hide();
                                                                }
                                                             if(val==4)
                                                                {
                                                                    $("#edu_nomed_"+val).hide();
                                                                    $("#minus").hide();
                                                                }
                                                             if(val==5)
                                                                {
                                                                    $("#edu_nomed_"+val).hide();
                                                                    $("#minus").hide();
                                                                }   

                                                                 if(val==6)
                                                                {
                                                                    $("#edu_nomed_"+val).hide();
                                                                    $("#minus").hide();
                                                                }    
                                                                 if(val==7)
                                                                {
                                                                    $("#edu_nomed_"+val).hide();
                                                                    $("#minus").hide();
                                                                }      
                                                                 if(val==8)
                                                                {
                                                                    $("#edu_nomed_"+val).hide();
                                                                    $("#minus").hide();
                                                                }    
                                                                 if(val==9)
                                                                {
                                                                    $("#edu_nomed_"+val).hide();
                                                                    $("#minus").hide();
                                                                }    
                                                                 if(val==10)
                                                                {
                                                                    $("#edu_nomed_"+val).hide();
                                                                    $("#minus").hide();
                                                                }   
                                                           

                                                            $.ajax({
                                                              
                                                             url:base_url+'index.php/admin_prescription/edu_file_box_show_my_med',
                                                             data:{num:val},
                                                             dataType: "html",
                                                             type: "POST",
                                                             success: function(data){

                                                               // alert(data);
                                                              $("#edu_my_med_"+id).html(data);
                                                              $("#edu_my_med_"+id).show();
                                                              //$("#edu_delete").hide();
                                                              

                                                                 
                                                                
                                                              }
                                                             });

                                                    }


                                                 function edu_hiding_out_my_med(val)
                                                    {
                                                        
                                                          var current_div=val-1; 
                                                         /* alert(val);
                                                          alert(current_div);*/         
                                                          $("#edu_my_med_"+val).html('');
                                                          $("#edu_my_med_"+current_div).hide();
                                                          $("#edu_nomed_"+current_div).show();
                                                          $("#minus").show();

                                                      
                                                       }

                                              
                                            </script>


                                              <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">Diet Name</label>
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
                                       

                                           <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">Councelling Name</label>
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

                                                <!--  <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Data</label>
                                            <div class="col-sm-8">

                                           <input type="" name="">
                                             

                                               <textarea name="feedback" rows="5" cols="5" class="form-control"></textarea>
                                            </div>
                                        </div>
 -->

                                                 <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Review</label>
                                            <div class="col-sm-8">

                                            <select  class="form-control" name="feedback" id="feedback"  required="">
                                                <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
                                                ?>

                                                    <option value="">--Select Days--</option>
                                                    <?php 

                                                        foreach($days as $row)
                                                        {
                                                     ?>
                                                    <option value="<?php echo $row->id; ?>"><?php echo 'after '.$row->day; ?></option>
                                                    <?php } ?>
                      
                                                 <option></option>
                                                </select>
                                              
                                             

                                              <!--  <textarea name="feedback" rows="5" cols="5" class="form-control"></textarea> -->
                                            </div>
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

 <script type="text/javascript">
         function get_med(group_id,index){
          //alert(state_id);
              var base_url='<?php echo  base_url();?>';
             $.ajax({
              url:base_url+'index.php/admin_prescription/get_medicine',
             data:{group_id: group_id},
             dataType: "json",
             type: "POST",
             success: function(data)
             {
                 //alert(data);
                 var i=0;
                 var node='';
                for(i=0;i<data.length;i++)
                 {

                   node +='<option value="'+data[i].medicine_id+'">'+data[i].medicine_name+' </option>';
                }
                 //alert(node);
                $("#medicine_"+index).html(node);


             }
               });
        }
    </script>

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
                                            <label for="product_name" class="col-sm-2 control-label">Review Date</label>
                                            <div class="col-sm-8">
                                              
                                                <input class="form-control" type="date" name="review" id="review" >
                                            </div>
                                        </div>                                         
                              


                                  </div>                           
                               </div>












































                               <div class="box">
                    <!-- <div class="box-header">
                        <h3 class="box-title"><b><u>General Information</u> : </b></h3>
                     

                    </div> -->
                    <div class="clearfix"></div>
                    <!-- /.box-header -->
                    <div class="box-body new_box">
                        <div class="tab-content">


                                <div id="vital_info" >
                                    
                                      <div class="col-md-12">
                                        <div id="patient_detail_table">

                                       
                                        </div>
                                      </div>
                                
                                           
                                         

                                             
                                      
                                      
                                           
                                        
                                        

                                        <!--  <a href="javacript:void(0)"  id="edu_no3_1" onclick="edu_produce_file_box_ho('1')" class="btn btn-primary"><b>+</b></a>

                                       
                                            <div id="edu_ho_1"></div>
                                           <div id="edu_ho_2"></div>
                                           <div id="edu_ho_3"></div>
                                           <div id="edu_ho_4"></div>
                                            <div id="edu_ho_5"></div> 

                                             <div id="edu_ho_6"></div>
                                           <div id="edu_ho_7"></div>
                                           <div id="edu_ho_8"></div>
                                           <div id="edu_ho_9"></div>
                                            <div id="edu_ho_10"></div>  -->


                                        <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">To add new H/O</label>
                                            <div class="col-sm-8">                                               
                                                <div id="null">
                                               <input type="text" class="form-control" name="ho_new" id="ho_new" multiple="" required="" placeholder="To add new H/O(example:HO1,HO2,..)">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">To add new C/C</label>
                                            <div class="col-sm-8">
                                                  <div id="null">
                                                    <input type="text" class="form-control" name="cc_new" id="cc_new" multiple="" required="" placeholder="To add new C/C(example: CC1,CC2,..)">
                                                </div>
                                             </div>
                                           </div>

                                            <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">To add new chest exam.</label>
                                            <div class="col-sm-8">
                                              <div id="null">
                                               <input type="text" class="form-control" name="chest_new" id="chest_new" multiple="" required="" placeholder="To add new chest exam.(example: chect-exam1,chest-exam2....)">
                                               </div>
                                             </div>
                                           </div>


                                           <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">To add new General(example</label>
                                            <div class="col-sm-8">
                                              <div id="null">
                                               <input type="text" class="form-control" name="gen_new" id="gen_new" multiple="" required="" placeholder="To add new General(example:gen-exam1,gen-exam2...)">
                                               </div>
                                             </div>
                                           </div>
                                           <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">To add new heart exam.</label>
                                            <div class="col-sm-8">
                                              <div id="null">
                                               <input type="text" class="form-control" name="heart_new" id="heart_new" multiple="" required="" placeholder="To add new heart exam.(example: heart-exam1,heart-exam2....)">
                                               </div>
                                             </div>
                                           </div>
                                           <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">To add new ABD</label>
                                            <div class="col-sm-8">
                                              <div id="null">
                                               <input type="text" class="form-control" name="abd_new" id="abd_new" multiple="" required="" placeholder="To add new ABD(example:ABD-exam1, ABD-exxam2...)">
                                               </div>
                                             </div>
                                           </div>
                                            <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">To add new CNS</label>
                                            <div class="col-sm-8">
                                              <div id="null">
                                               <input type="text" class="form-control" name="cns_new" id="cns_new" multiple="" required="" placeholder="To add new CNS(example: CNS-Exam1 , CNS-Exam2...)">
                                               </div>
                                             </div>
                                           </div>
                                           <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">To add new Investigation</label>
                                            <div class="col-sm-8">
                                              <div id="null">
                                               <input type="text" class="form-control" name="investigation_name" id="investigation_name" multiple="" required="" placeholder="To add new Investigation(example: Investigation , Investigation...)">
                                               </div>
                                             </div>
                                           </div>
                                           <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">To add new Diagnosis</label>
                                            <div class="col-sm-8">
                                              <div id="null">
                                               <input type="text" class="form-control" name="diagnosis_name" id="diagnosis_name" multiple="" required="" placeholder="To add new Diagnosis(example: Diagnosis1 , Diagnosis2...)">
                                               </div>
                                             </div>
                                           </div>
                                            <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">To add new Diet</label>
                                            <div class="col-sm-8">
                                              <div id="null">
                                               <input type="text" class="form-control" name="diet_name" id="diet_name" multiple="" required="" placeholder="To add new Diet(example: Diet1 , Diet2...)">
                                               </div>
                                             </div>
                                           </div>
                                           <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">To add new councilling</label>
                                            <div class="col-sm-8">
                                              <div id="null">
                                               <input type="text" class="form-control" name="councilling_name" id="councilling_name" multiple="" required="" placeholder="To add new councilling(example: councilling1 , councilling2...)">
                                               </div>
                                             </div>
                                           </div>

                                        
                                       <!--  <a href="javacript:void(0)"  id="edu_no2_1" onclick="edu_produce_file_box_cc('1')" class="btn btn-primary"><b>+</b></a>

                                       
                                            <div id="edu_cc_1"></div>
                                           <div id="edu_cc_2"></div>
                                           <div id="edu_cc_3"></div>
                                           <div id="edu_cc_4"></div>
                                            <div id="edu_cc_5"></div> 

                                             <div id="edu_cc_6"></div>
                                           <div id="edu_cc_7"></div>
                                           <div id="edu_cc_8"></div>
                                           <div id="edu_cc_9"></div>
                                            <div id="edu_cc_10"></div> 
 -->
                                            



                                      


                                       
                                        

                                </div>


                        </div>
                    </div>
                    <!-- /.box-body -->

                    
                </div>

































                                

                    <div class="box-footer" style="margin-top: 10px;float: right;margin-right: 17%;" >
                                    
                                    <button type="button"  class="btn btn-info" onclick="valid_doc_form()" style="margin-left:12px" id="butt1">Submit</button>

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

 //        var first_name = $('#first_name').val();
 //        if (!isNull(first_name)) 
 //        {
 //          $('#first_name').removeClass('black_border').addClass('red_border');
 //        } 
 //        else 
 //        {
 //          $('#first_name').removeClass('red_border').addClass('black_border');
 //        }

 //         var last_name = $('#last_name').val();
 //        if (!isNull(last_name)) 
 //        {
 //          $('#last_name').removeClass('black_border').addClass('red_border');
 //        } 
 //        else 
 //        {
 //          $('#last_name').removeClass('red_border').addClass('black_border');
 //        }

 //         var email = $('#email').val();
 //        if (!isNull(email)) 
 //        {
 //          $('#email').removeClass('black_border').addClass('red_border');
 //        } 
 //        else 
 //        {
 //          $('#email').removeClass('red_border').addClass('black_border');
 //        }

 //         var pass = $('#pass').val();
 //        if (!isNull(pass)) 
 //        {
 //          $('#pass').removeClass('black_border').addClass('red_border');
 //        } 
 //        else 
 //        {
 //          $('#pass').removeClass('red_border').addClass('black_border');
 //        }

 //         var mobile = $('#mobile').val();
 //        if (!isNull(mobile)) 
 //        {
 //          $('#mobile').removeClass('black_border').addClass('red_border');
 //        } 
 //        else 
 //        {
 //          $('#mobile').removeClass('red_border').addClass('black_border');
 //        }

 //        var age = $('#age').val();
 //        if (!isNull(age)) 
 //        {
 //          $('#age').removeClass('black_border').addClass('red_border');
 //        } 
 //        else 
 //        {
 //          $('#age').removeClass('red_border').addClass('black_border');
 //        }

 //          var weight = $('#weight').val();
 //        if (!isNull(weight)) 
 //        {
 //          $('#weight').removeClass('black_border').addClass('red_border');
 //        } 
 //        else 
 //        {
 //          $('#weight').removeClass('red_border').addClass('black_border');
 //        }

 //         var height = $('#height').val();
 //        if (!isNull(height)) 
 //        {
 //          $('#height').removeClass('black_border').addClass('red_border');
 //        } 
 //        else 
 //        {
 //          $('#height').removeClass('red_border').addClass('black_border');
 //        }


 //        var options = $('#cc_0 > option:selected');
 //         if(options.length == 0)
 //              {
 //               $('#div_cc').removeClass('black_border').addClass('red_border');
 //              }
 //              else{
 //               $('#div_cc').removeClass('red_border').addClass('black_border');

 //              }


 //               var options = $('#kpo > option:selected');
 //         if(options.length == 0)
 //              {
 //               $('#div_kpo').removeClass('black_border').addClass('red_border');
 //              }
 //              else{
 //               $('#div_kpo').removeClass('red_border').addClass('black_border');

 //              }

 //               var options = $('#gen > option:selected');
 //         if(options.length == 0)
 //              {
 //               $('#div_gen').removeClass('black_border').addClass('red_border');
 //              }
 //              else{
 //               $('#div_gen').removeClass('red_border').addClass('black_border');

 //              }

 //               var options = $('#chest > option:selected');
 //         if(options.length == 0)
 //              {
 //               $('#div_chest').removeClass('black_border').addClass('red_border');
 //              }
 //              else{
 //               $('#div_chest').removeClass('red_border').addClass('black_border');

 //              }

 //               var options = $('#abd > option:selected');
 //         if(options.length == 0)
 //              {
 //               $('#div_abd').removeClass('black_border').addClass('red_border');
 //              }
 //              else{
 //               $('#div_abd').removeClass('red_border').addClass('black_border');

 //              }

 //               var options = $('#cns > option:selected');
 //         if(options.length == 0)
 //              {
 //               $('#div_cns').removeClass('black_border').addClass('red_border');
 //              }
 //              else{
 //               $('#div_cns').removeClass('red_border').addClass('black_border');

 //              }

 //              var options = $('#investigation > option:selected');
 //         if(options.length == 0)
 //              {
 //               $('#div_inves').removeClass('black_border').addClass('red_border');
 //              }
 //              else{
 //               $('#div_inves').removeClass('red_border').addClass('black_border');

 //              }

 //               var options = $('#diet > option:selected');
 //         if(options.length == 0)
 //              {
 //               $('#div_diet').removeClass('black_border').addClass('red_border');
 //              }
 //              else{
 //               $('#div_diet').removeClass('red_border').addClass('black_border');

 //              }

 //               var options = $('#councilling > option:selected');
 //         if(options.length == 0)
 //              {
 //               $('#div_councel').removeClass('black_border').addClass('red_border');
 //              }
 //              else{
 //               $('#div_councel').removeClass('red_border').addClass('black_border');

 //              }

 //               var options = $('#diagnosis > option:selected');
 //         if(options.length == 0)
 //              {
 //               $('#div_diagnosis').removeClass('black_border').addClass('red_border');
 //              }
 //              else{
 //               $('#div_diagnosis').removeClass('red_border').addClass('black_border');

 //              }

 //         var bmi = $('#bmi').val();
 //        if (!isNull(bmi)) 
 //        {
 //          $('#bmi').removeClass('black_border').addClass('red_border');
 //        } 
 //        else 
 //        {
 //          $('#bmi').removeClass('red_border').addClass('black_border');
 //        }


 //         var pulse = $('#pulse').val();
 //        if (!isNull(pulse)) 
 //        {
 //          $('#pulse').removeClass('black_border').addClass('red_border');
 //        } 
 //        else 
 //        {
 //          $('#pulse').removeClass('red_border').addClass('black_border');
 //        }

 //         var upper = $('#upper').val();
 //        if (!isNull(upper)) 
 //        {
 //          $('#upper').removeClass('black_border').addClass('red_border');
 //        } 
 //        else 
 //        {
 //          $('#upper').removeClass('red_border').addClass('black_border');
 //        }

 //         var lower = $('#lower').val();
 //        if (!isNull(lower)) 
 //        {
 //          $('#lower').removeClass('black_border').addClass('red_border');
 //        } 
 //        else 
 //        {
 //          $('#lower').removeClass('red_border').addClass('black_border');
 //        }

 // var dose = $('#dose').val();
 //        if (!isNull(dose)) 
 //        {
 //          $('#dose').removeClass('black_border').addClass('red_border');
 //        } 
 //        else 
 //        {
 //          $('#dose').removeClass('red_border').addClass('black_border');
 //        }

 //         var medicine = $('#medicine').val();
 //        if (!isNull(medicine)) 
 //        {
 //          $('#medicine').removeClass('black_border').addClass('red_border');
 //        } 
 //        else 
 //        {
 //          $('#medicine').removeClass('red_border').addClass('black_border');
 //        }

      /*   var review = $('#review').val();
        if (!isNull(review)) 
        {
          $('#review').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#review').removeClass('red_border').addClass('black_border');
        }
        */
 /*var ho = $('#ho').val();
        if (!isNull(ho)) 
        {
          $('#ho').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#ho').removeClass('red_border').addClass('black_border');
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
 /*function valid_doc_form()
 {
  

      $('#doc_add_form').submit();
 

 }*/
 </script>

<script >
    
/*    function edu_produce_file_box(id)
    {
      
         
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

    }*/


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

<script type="text/javascript">
  
        function edu_produce_file_box_cc(id)
    {
      // alert(id);
         
             var val=id;


            
            if(val==1)
                {
                     $("#edu_no2_1").hide();
                      $("#minus").hide();
                }
            var base_url='<?php echo base_url(); ?>';
            
            if(val==2)
                {
                    $("#edu_no2_"+val).hide();
                   $("#minus").hide();
                }
            if(val==3)
                {
                    $("#edu_no2_"+val).hide();
                    $("#minus").hide();
                }
             if(val==4)
                {
                    $("#edu_no2_"+val).hide();
                    $("#minus").hide();
                }
             if(val==5)
                {
                    $("#edu_no2_"+val).hide();
                    $("#minus").hide();
                }   

                 if(val==6)
                {
                    $("#edu_no2_"+val).hide();
                    $("#minus").hide();
                }    
                 if(val==7)
                {
                    $("#edu_no2_"+val).hide();
                    $("#minus").hide();
                }      
                 if(val==8)
                {
                    $("#edu_no2_"+val).hide();
                    $("#minus").hide();
                }    
                 if(val==9)
                {
                    $("#edu_no2_"+val).hide();
                    $("#minus").hide();
                }    
                 if(val==10)
                {
                    $("#edu_no2_"+val).hide();
                    $("#minus").hide();
                }  

             $.ajax({
              
             url:base_url+'index.php/admin_user/edu_file_box_show_cc1',
             data:{num:val},
             dataType: "html",
             type: "POST",
             success: function(data){

               
              $("#edu_cc_"+id).html(data);
              $("#edu_cc_"+id).show();
              //$("#edu_delete").hide();
              

                 
                
              }
             });
    }


  function edu_hiding_out_cc(val)
  {

         var current_div=val-1; 
         /* alert(val);
          alert(current_div);*/         
          $("#edu_cc_"+val).html('');
          $("#edu_cc_"+current_div).hide();
          $("#edu_no2_"+current_div).show();
          $("#minus").show();
  }




        function edu_produce_file_box_ho(id)
    {
      // alert(id);
         
             var val=id;


            
            if(val==1)
                {
                     $("#edu_no3_1").hide();
                      $("#minus").hide();
                }
            var base_url='<?php echo base_url(); ?>';
            
            if(val==2)
                {
                    $("#edu_no3_"+val).hide();
                   $("#minus").hide();
                }
            if(val==3)
                {
                    $("#edu_no3_"+val).hide();
                    $("#minus").hide();
                }
             if(val==4)
                {
                    $("#edu_no3_"+val).hide();
                    $("#minus").hide();
                }
             if(val==5)
                {
                    $("#edu_no3_"+val).hide();
                    $("#minus").hide();
                }   

                 if(val==6)
                {
                    $("#edu_no3_"+val).hide();
                    $("#minus").hide();
                }    
                 if(val==7)
                {
                    $("#edu_no3_"+val).hide();
                    $("#minus").hide();
                }      
                 if(val==8)
                {
                    $("#edu_no3_"+val).hide();
                    $("#minus").hide();
                }    
                 if(val==9)
                {
                    $("#edu_no3_"+val).hide();
                    $("#minus").hide();
                }    
                 if(val==10)
                {
                    $("#edu_no3_"+val).hide();
                    $("#minus").hide();
                }  

             $.ajax({
              
             url:base_url+'index.php/admin_user/edu_file_box_show_ho',
             data:{num:val},
             dataType: "html",
             type: "POST",
             success: function(data){

               
              $("#edu_ho_"+id).html(data);
              $("#edu_ho_"+id).show();
              //$("#edu_delete").hide();
              

                 
                
              }
             });
    }


  function edu_hiding_out_ho(val)
  {

         var current_div=val-1; 
         /* alert(val);
          alert(current_div);*/         
          $("#edu_ho_"+val).html('');
          $("#edu_ho_"+current_div).hide();
          $("#edu_no3_"+current_div).show();
          $("#minus").show();
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

                 if(val==6)
                {
                    $("#edu_no_"+val).hide();
                    $("#minus").hide();
                }    
                 if(val==7)
                {
                    $("#edu_no_"+val).hide();
                    $("#minus").hide();
                }      
                 if(val==8)
                {
                    $("#edu_no_"+val).hide();
                    $("#minus").hide();
                }    
                 if(val==9)
                {
                    $("#edu_no_"+val).hide();
                    $("#minus").hide();
                }    
                 if(val==10)
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
  function get_pulse(value)
  {

       var base_url='<?php echo base_url(); ?>';

        $.ajax(

            {

            type: "POST",

            dataType: 'JSON',

            url: base_url + "index.php/admin_prescription/get_user_data1",

            data: {user_id:value},

            async: true,

            success: function (data) {

                
                var pulse=data.pulse;
                var upper=data.upper;
                var lower=data.lower;
                var weight=data.weight;

             
                
                $("#pulse").val(pulse);
                $("#upper").val(upper);
                $("#lower").val(lower);
                $("#gyno_weight").val(weight);
              
               
        }

        }); 
  }


    function get_exist_patient(value)
    {

       var base_url='<?php echo base_url(); ?>';


        $.ajax(

            {

            type: "POST",

            dataType: 'json',

            url: base_url + "index.php/admin_prescription/get_user_data2",

            data: {user_id:value},

            async: true,

            success: function (data) {
              var user_id=data.user_id;
              var res=data.res;
              var chk_history_id=data.chk_history_id;

              if(res==1)
              {
                alert("This is a existing patient.");
                  window.location.href="<?php echo base_url(); ?>index.php/admin_user/edit_patient_prescription/"+user_id+"/"+chk_history_id;

              }



               
              
        }

        }); 
    }


    function get_data(value)
    {

  $("#edu_no2_1").addClass('p-add-cusss-new-class');

     $("#edu_no3_1").addClass('p-add-cuss-new-class');
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
               
        }

        }); 
  

    }
  </script>