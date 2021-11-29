<style type="text/css">
    .thumb-image{float:left;width:100px;position:relative;padding:5px;}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <form class="" method="post" action="<?php echo base_url(); ?>index.php/admin_user/prescription_edit" id="doc_add_form">

    <input name="hidden_chk_history_id" value="<?php echo $chk_history_id;?>" type="hidden">

     <input name="hidden_user_id" value="<?php echo $user_id;?>" type="hidden">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>PRESCRIPTION OF <?php echo @$name[0]->first_name.' '.@$name[0]->last_name; ?> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>index.php/admin_dashboard"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboad</a></li>
            <li class="active">Edit Prescription</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <div class="box section_p">
                    
                    <div class="box-body new_box">
                        <div class="tab-content">


                                <div id="vital_info" >
                                    
                                      <div class="col-md-12">
                                        <div id="patient_detail_table">

                                       
                                        </div>
                                      </div>
                                       
                                  <div class="form-group frm-diff top new_desin Choose_Patient">
                                            <label for="product_name" class="control-label">Patient Name</label>
                                            <div class="col-sm-8" >

                                            <div id="div_patient">
                                              <!--  <select  class="form-control select2" name="patient" id="patient" onchange="get_data(this.value)"    required="">
                                                    
                                                    <option value="">Search By Patient Name</option>
                                                     <?php
                                                       foreach($patient as $row){

                                                        ?>

                                                   <option value="<?php echo $row->user_id; ?>" ><b><?php echo $row->first_name.' '.$row->last_name.' '.'('.$row->user_unique_id.')'; ?></b></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select> -->

                                                <input class="form-control" type="text" disabled="" value="<?php echo @$name[0]->first_name.' '.@$name[0]->last_name; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="clearfix"></div> <div class="clearfix"></div> -->

                                           <!-- <div class="clearfix"></div><br> -->

                                            <?php /*foreach($product_price as $price){*/
                                           for($i=0;$i<count($patient_cc);$i++)
                                            {
                                              ?>

                                      <div id="patient_cc_<?php echo $i+1; ?>">
                                           <div class="form-group frm-diff add_blank"></div>
                                         <div class="form-group frm-diff new_desin C_C">
                                            <label for="product_name" class="control-label">C/C</label>
                                            <div class="col-sm-8" >

                                            <div id="null">
                                               <select  class="form-control" name="cc[]" id="cc_0"   required="">
                                                    
                      
                                                     <?php

                                                     foreach($cc as $row)
                                                     {
                                                       

                                                        ?>

                                                   <option value="<?php echo $row->cc_id; ?>" <?php  if($row->cc_id==@$patient_cc[$i]->cc_id) { echo "selected"; }  ?> ><?php echo $row->cc_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                                </div>
                                             
                                            </div>
                                        </div>

                                          <div class="form-group frm-diff new_desin_day Days_c_c">
                                            <label for="product_name" class="control-label">Days</label>
                                            <div class="col-sm-8">
                                              
                                               <select  class="form-control" name="dose_cc[]" id="dose_cc_0"  required="">
                                                <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
                                                ?>

                                                    <option value="">--Select Days--</option>
                                                    <?php 

                                                        foreach($days as $row)
                                                        {
                                                     ?>
                                                    <option value="<?php echo $row->id; ?>"<?php if($row->id==@$patient_cc[$i]->day_id){ echo 'selected'; } ?>><?php echo 'since '.$row->day; ?></option>
                                                    <?php } ?>
                      
                                                 <option></option>
                                                </select>
                                            </div>
                                        </div>
                                         
                                    
                                       

                                       
                                        <td>
                                       <a href="javacript:void(0)" class="btn btn-primary negative_btn" id="minus" onclick="price_hiding_out_cc('<?php echo $i+1; ?>');"><b>-</b></a>


                                       </td>
                                          </div>
                                       <?php } ?>


                                       

                                        
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

                                            
                                      


                                         <!-- <div class="clearfix"></div> -->
                                        
                                      <!--    <div class="form-group frm-diff new_desin Choose_Patient Known_Patient">
                                             <label for="product_name" class="control-label">Known Patient Of
                                            </label>
                                            <div class="col-sm-8">
                                             <div id="null">
                                               <select  class="form-control select2" name="kpo[]" id="kpo" multiple=""  required="">
                                                    
                      
                                                     <?php
                                                       foreach($kpo as $row){

                                                        ?>

                                                   <option value="<?php echo $row->kpo_id; ?>" <?php foreach($patient_kpo as $row1) {  if($row->kpo_id==$row1->kpo) { echo "selected"; } } ?> ><?php echo $row->kpo_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                                </div>
                                            </div> 
                                        </div> -->

                                                         <div class="form-group frm-diff new_desin_diagnosis Diagnosis">
                                            <label for="product_name" class="control-label">Diagnosis</label>
                                            <div class="col-sm-8">
                                            <div id="div_diagnosis">
                                               <select  class="form-control select2" multiple="" name="diagnosis[]" id="diagnosis"  required="">
                                                   
                      
                                                     <?php
                                                       foreach($diagnosis as $row){

                                                        ?>

                                                   <option value="<?php echo $row->diagnosis_id; ?>" <?php foreach($patient_diag as $row1) {  if($row->diagnosis_id==$row1->diagnosis_id) { echo "selected"; } } ?> ><?php echo $row->diagnosis_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                                </div>
                                                

                                                 
                                            </div>
                                        </div>

                                         <?php /*foreach($product_price as $price){*/
                                           for($i=0;$i<count($patient_ho);$i++)
                                            {
                                              ?>
                                        
                                           <div id="patient_ho_<?php echo $i+1; ?>">
                                            <div class="form-group frm-diff add_blank"></div>

                                          <div class="form-group frm-diff new_desin C_C">
                                            <label for="product_name" class="control-label">H/O</label>
                                            <div class="col-sm-8">
                                                 <div id="null">
                                               <select  class="form-control" name="ho[]" id="ho"  required="">
                                                    
                      
                                                     <?php
                                                       foreach($ho as $row){

                                                        ?>

                                                   <option value="<?php echo $row->ho_id; ?>" <?php  if($row->ho_id==@$patient_ho[$i]->ho_id) { echo "selected";  } ?>  ><?php echo $row->ho_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                                </div>
                                                
                                            </div>
                                        </div>
                                                <div class="form-group frm-diff new_desin_day Days_c_c">
                                            <label for="product_name" class="control-label">Days</label>
                                            <div class="col-sm-8">

                                            <input class="form-control" name="dose_ho[]" id="dose_ho_0" value="<?php echo @$patient_ho[$i]->day_id; ?>">
                                              
                                         
                                            </div>
                                        </div>
                                       

                                        <td>
                                       <a href="javacript:void(0)" class="btn btn-primary negative_btn dwn" id="minus" onclick="price_hiding_out_ho('<?php echo $i+1; ?>');"><b>-</b></a>


                                       </td>
                                        </div>
                                        <?php } ?>
                                        
                                    


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
                <div class="box section_p">
                    
                    
                    <div class="box-body new_box">
                        <div class="tab-content"> 

                                <div id="vital_info" >                                     

                                        <div class="form-group frm-diff new_desin_long General">
                                            <label for="product_name" class="control-label">General</label>
                                            <div class="col-sm-8">
                                             <div id="div_gen">
                                               <select  class="form-control select2" multiple="" name="gen[]" id="gen"  required="">
                                                
                                                    <?php 

                                                     $exam_type_gen =  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_type_id'=>2,'status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

                                                        foreach($exam_type_gen as $row)
                                                        {
                                                     ?>

                                                   <option value="<?php echo $row->examination_id; ?>" <?php foreach($patient_gen_exam as $row1) {  if($row->examination_id==$row1->gen_exam) { echo "selected"; } } ?> ><?php echo $row->examination_name; ?></option>
                                                   <?php } ?>
                                                  
                                                </select>
                                                </div>
                                                 
                                                
                                            </div>
                                        </div>    
                                                                    

                                           <div class="form-group frm-diff new_desin_day Pulse_RPM">
                                            <label for="product_name" class="control-label">Pulse (RPM)</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" value="<?php echo @$patient_chk[0]->pulse; ?>" type="text" name="pulse" id="pulse" placeholder="Pulse">
                                            </div>
                                        </div>

                                          <div class="form-group frm-diff new_desin_day Choose">
                                            <label for="product_name" class="control-label">Choose</label>
                                            <div class="col-sm-8">
                                               <!--  <input class="form-control" type="text" name="pulse" id="pulse" placeholder="Pulse"> -->
                                               <Select class="form-control" name="pulse_type">
                                               <option value="Regular" <?php if(@$patient_chk[0]->pulse_type=="Regular") { echo "selected"; } ?>>Regular</option>
                                                <option value="Regularly Irregular" <?php if(@$patient_chk[0]->pulse_type=="Regularly Irregular") { echo "selected"; } ?>>Regularly Irregular</option>
                                                  <option value="Irregularly Irregular" <?php if(@$patient_chk[0]->pulse_type=="Irregularly Irregular") { echo "selected"; } ?>>Irregularly Irregular</option>
                                                    <option value="Pulse Deficit+" <?php if(@$patient_chk[0]->pulse_type=="Pulse Deficit+") { echo "selected"; } ?>>Pulse Deficit+</option>

                                               ></Select>
                                            </div>
                                        </div>


                                           <div class="form-group frm-diff new_desin_day bp">
                                            <label for="product_name" class="control-label">BP</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="text" value="<?php echo @$patient_chk[0]->bp_upper; ?>" name="upper" id="upper"placeholder="Upper">
                                            </div>

                                             <div class="col-sm-6">
                                                <input class="form-control" value="<?php echo @$patient_chk[0]->bp_lower; ?>" type="text" name="lower" id="lower"placeholder="Lower">
                                            </div>
                                        </div>


                                        <div class="form-group frm-diff new_desin Chest">
                                            <label for="product_name" class="control-label">Chest</label>
                                            <div class="col-sm-8">
                                             <div id="div_chest">
                                               <select  class="form-control select2" multiple="" name="chest[]" id="chest"  required="">
                                                
                                                    <?php 

                                                      $exam_type_chest =  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_type_id'=>3,'status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


                                                        foreach($exam_type_chest as $row)
                                                        {
                                                     ?>

                                                   <option value="<?php echo $row->examination_id; ?>" <?php foreach($patient_chest as $row1) {  if($row->examination_id==$row1->chest_id) { echo "selected"; } } ?>><?php echo $row->examination_name; ?></option>
                                                   <?php } ?>
                                                  
                                                </select>
                                                </div>
                                                 
                                            </div>
                                        </div>

                                        


                                            <div class="form-group frm-diff new_desin Chest">
                                            <label for="product_name" class="control-label">Heart</label>
                                            <div class="col-sm-8">
                                             <div id="div_chest">
                                               <select  class="form-control select2" multiple="" name="heart[]" id="heart"  required="">
                                                
                                                    <?php 

                                                      $exam_type_heart =  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_type_id'=>6,'status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


                                                        foreach($exam_type_heart as $row)
                                                        {
                                                     ?>

                                                   <option value="<?php echo $row->examination_id; ?>" <?php foreach($patient_heart as $row1) {  if($row->examination_id==$row1->heart_exam_id) { echo "selected"; } } ?>><?php echo $row->examination_name; ?></option>
                                                   <?php } ?>
                                                  
                                                </select>
                                                </div>
                                                 
                                            </div>
                                        </div>

                                        


                                           <div class="form-group frm-diff new_desin Chest">
                                            <label for="product_name" class="control-label">ABD</label>
                                            <div class="col-sm-8">
                                             <div id="div_abd">
                                               <select  class="form-control select2" multiple="" name="abd[]" id="abd"  required="">
                                                
                                                    <?php 

                                                      $exam_type_abd =  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_type_id'=>4,'status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

                                                        foreach($exam_type_abd as $row)
                                                        {
                                                     ?>

                                                   <option value="<?php echo $row->examination_id; ?>" <?php foreach($patient_abd as $row1) {  if($row->examination_id==$row1->abd_id) { echo "selected"; } } ?>><?php echo $row->examination_name; ?></option>
                                                   <?php } ?>
                                                  
                                                </select>
                                                </div>
                                                 
                                            </div>
                                        </div>
                                        

                                           <div class="form-group frm-diff new_desin Chest">
                                            <label for="product_name" class="control-label">CNS</label>
                                            <div class="col-sm-8">
                                             <div id="div_cns">
                                               <select  class="form-control select2" multiple="" name="cns[]" id="cns"  required="">
                                                
                                                    <?php 

                                                     $exam_type_cns =  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_type_id'=>5,'status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

                                                        foreach($exam_type_cns as $row)
                                                        {
                                                     ?>

                                                   <option value="<?php echo $row->examination_id; ?>" <?php foreach($patient_cns as $row1) {  if($row->examination_id==$row1->cns_id) { echo "selected"; } } ?>><?php echo $row->examination_name; ?></option>
                                                   <?php } ?>
                                                  
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

         <section class="content">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <div class="box">
                     <div class="box-header">
                        <h3 class="box-title"><b><u>Report</u> : </b></h3>
                      

                    </div>
                    <div class="clearfix"></div>
                    <!-- /.box-header -->
                    <div class="box-body new_box">
                        <div class="tab-content">
                             <div id="vital_info" >
                              
                             <div id="price">


                                 <?php /*foreach($product_price as $price){*/
                                           for($in=0;$in<count($patient_report);$in++)
                                            {
                                              ?>

                                      <div id="patient_report_<?php echo $i+1; ?>">

                                <div class="form-group frm-diff new_desin Report">
                                          <div class="col-sm-8">

                                               <select  class="form-control"  name="write[]" id="write" required=""> 


                                                 <option value="" >Select</option>              
                      
                                                     <?php
                                                       foreach($investigation as $row){

                                                        ?>

                                                   <option value="<?php echo $row->investigation_id; ?>" <?php   if($row->investigation_name==$patient_report[$in]->content) { echo "selected"; }  ?>><?php echo $row->investigation_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>




                                                 <!--  <?php
                                                       foreach($investigation as $row){

                                                        ?>

                                                  <?php echo $row->investigation_id; ?> <?php    if($row->investigation_name==@$patient_report[$in]->content) { echo "selected"; }  ?><?php echo $row->investigation_name; ?>
                                                  <?php
                                                    }
                                                  ?>
                                                  <option value="<?php echo $row->investigation_id; ?>" <?php foreach($patient_report as $row1) {  if($row->investigation_name==$row1->content) { echo "selected"; } } ?>><?php echo $row->investigation_name; ?></option> -->




                                              
                                            </div>
                                        </div>
                                       

                                          <div class="form-group frm-diff new_desin Report">
                                           <!--  <label for="product_name" class="col-sm-2 control-label">Date</label> -->
                                            <div class="col-sm-8">
                                              
                                             

                                                <input type="text" value="<?php echo @$patient_report[$in]->description; ?>" name="write_some[]" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group frm-diff new_desin_day">
                                           <!--  <label for="product_name" class="col-sm-2 control-label">Date</label> -->
                                            <div class="col-sm-8">
                                              
                                             

                                                <input type="date" value="<?php echo @$patient_report[$in]->date; ?>" name="date[]" class="form-control">
                                            </div>
                                        </div>

                                          <!-- <td>
                                                    <a href="javacript:void(0)" class="btn btn-primary" id="minus" onclick="price_hiding_out('<?php echo $i+1; ?>');"><b>-</b></a></td> -->

                                        <!-- </div>

                                       <br><br> -->




                                        <td>
                                       <a href="javacript:void(0)" class="btn btn-primary negative_btn" id="minus" onclick="patient_report_hiding_out('<?php echo $i+1; ?>');"><b>-</b></a>


                                       </td>
                                          </div>
                                       <?php } ?>

                                       

                                       <!--  <a href="javacript:void(0)"  id="edu_no1_1" onclick="edu_produce_file_box1('1')" class="btn btn-primary"><b>Add More</b></a>
 -->
                                       

                                       

                                        <div class="clearfix"></div>
                                        <div class="box-footer">
                                        </div>
                                            <div id="edu_add1_1"></div>
                                           <div id="edu_add1_2"></div>
                                           <div id="edu_add1_3"></div>
                                           <div id="edu_add1_4"></div>
                                            <div id="edu_add1_5"></div> 

                                             <div id="edu_add1_6"></div>
                                           <div id="edu_add1_7"></div>
                                           <div id="edu_add1_8"></div>
                                           <div id="edu_add1_9"></div>
                                            <div id="edu_add1_10"></div> 

                                        
                                </div>    
                                        <div class="form-group frm-diff new_desin_mediam Investigation_name">
                                            <label for="product_name" class="control-label">Investigation Name</label>
                                            <div class="col-sm-8">
                                            <div id="div_inves">
                                               <select  class="form-control select2" multiple="" name="investigation[]" id="investigation"  required="">              
                      
                                                     <?php
                                                       foreach($investigation as $row){

                                                        ?>

                                                   <option value="<?php echo $row->investigation_id; ?>" <?php foreach($patient_inves as $row1) {  if($row->investigation_id==$row1->investigation_id) { echo "selected"; } } ?>><?php echo $row->investigation_name; ?></option>
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
        <!-- /.row -->
    </section>

    <?php 

          $gyno_data =  $this->common->select($table_name='tbl_gyno_patient',$field=array(), $where=array('user_id'=>$user_id,'chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

          if(count($gyno_data)>0)
          {



    ?>

      <section class="content">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <div class="box">
                     <div class="box-header">
                        <h3 class="box-title"><b><u>Gynae & Obs</u> : </b></h3>
                      <!--   <ul class="nav nav-tabs">
                           <li class="active"><a data-toggle="tab" href="#vital_info">Vital Info</a></li>
                          
                       </ul> -->

                    </div>
                    <div class="clearfix"></div>
                    <!-- /.box-header -->
                    <div class="box-body new_box">
                        <div class="tab-content">
                             <div id="vital_info" >
                               

                                        <div class="form-group frm-diff new_desin">
                                           <label for="product_name" class="control-label">LMP</label> 
                                            <div class="col-sm-8">
                                              
                                             

                                                <input type="date" name="date7" value="<?php echo @$gyno[0]->lnpv_date; ?>" class="form-control">
                                            </div>
                                        </div>

                                         <div class="form-group frm-diff new_desin">
                                            <label for="product_name"   class="control-label">EDD</label> 
                                            <div class="col-sm-8">
                                              
                                             

                                                <input type="date" value="<?php echo @$gyno[0]->eddv_date; ?>" name="date8" class="form-control">
                                            </div>
                                        </div>

                                         <div class="form-group frm-diff new_desin_day Weight">
                                            <label for="product_name" class="control-label">Weight(Kg.)</label> 
                                            <div class="col-sm-8">
                                              
                                             

                                                <input type="text"  name="gyno_weight" value="<?php echo @$user_weight[0]->weight; ?>" id="gyno_weight" class="form-control">
                                            </div>
                                        </div>

                                     <div class="box-footer" style="display: inline-block; width: 100%;">
                                   <?php foreach($gyno_weight as $row){ ?>
                                     <li style="display: block; width: 100%;">
                                     <b>wt</b>-<?php echo  $row->date; ?> to <?php echo date('Y-m-d'); ?> is <b><?php echo $row->weight; ?>kg</b>
                                     </li>
                                     <?php } ?>
                                   
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

    <?php  } ?>


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
<!--          <section class="content">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <div class="box section_p">
                    
                    <div class="box-body new_box">
                        <div class="tab-content">
                            <div id="vital_info" >
                                      <div class="form-group frm-diff new_desin_mediam Investigation_name">
                                            <label for="product_name" class="control-label">Investigation Name</label>
                                            <div class="col-sm-8">
                                            <div id="div_inves">
                                               <select  class="form-control select2" multiple="" name="investigation[]" id="investigation"  required="">              
                      
                                                     <?php
                                                       foreach($investigation as $row){

                                                        ?>

                                                   <option value="<?php echo $row->investigation_id; ?>" <?php foreach($patient_inves as $row1) {  if($row->investigation_id==$row1->investigation_id) { echo "selected"; } } ?>><?php echo $row->investigation_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                                </div>

                                                 
                                            </div>
                                        </div>
                                        

                                  

                                          
                                                 <div class="form-group frm-diff new_desin_diagnosis Diagnosis">
                                            <label for="product_name" class="control-label">Diagnosis</label>
                                            <div class="col-sm-8">
                                            <div id="div_diagnosis">
                                               <select  class="form-control select2" multiple="" name="diagnosis[]" id="diagnosis"  required="">
                                                   
                      
                                                     <?php
                                                       foreach($diagnosis as $row){

                                                        ?>

                                                   <option value="<?php echo $row->diagnosis_id; ?>" <?php foreach($patient_diag as $row1) {  if($row->diagnosis_id==$row1->diagnosis_id) { echo "selected"; } } ?> ><?php echo $row->diagnosis_name; ?></option>
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
                          
                </div>
            </div>
         
        </div>
       
    </section>
 -->
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
                                <?php /*foreach($product_price as $price){*/
                                           for($i=0;$i<count($patient_med);$i++)
                                            {



                                               $this->db->select('*');
                                               $this->db->from('tbl_patient_medicine');
                                               $this->db->where('user_id',$user_id);
                                               $this->db->where('chk_history_id',$chk_history_id);
                                               $this->db->where('group_id',$patient_med[$i]->group_id);
                                              
                                               $qry=$this->db->get();
                                               $data['patient_med']=$qry->result();

                                              //echo "<pre>"; print_r($data['patient_med']);exit;
                                     ?>
                             <div id="price1_<?php echo $i+1; ?>">
                              <div class="form-group frm-diff new_desin eit_Disease">
                                         <label for="product_name" class="control-label">Disease</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select" name="group[]" onchange="get_med(this.value,1)" id="group_1"  required="">
                                                    <option value="">--Select Group--</option>
                      
                                                     <?php
                                                       foreach($group as $row){

                                                        ?>

                                                   <option value="<?php echo $row->group_id; ?>" <?php if($row->group_id==$patient_med[$i]->group_id) { echo "selected"; } ?>><?php echo $row->group_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                            </div>
                                        </div>
                                   <div class="form-group frm-diff medi-p-cus-se new_desin_mediam Medicine_Name">
                                         <label for="product_name" class="control-label">Medicine Name</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select2" multiple="" name="medicine<?php echo $i+1; ?>[]" id="medicine_1"  required="">
                                                    <option value="">--Select Medicine--</option>
                      
                                                      <?php
                                                       foreach($med_list as $row){

                                                        ?>

                                                   <option value="<?php echo $row->medicine_id; ?>" <?php foreach($data['patient_med'] as $row1) { if($row->medicine_id==$row1->medicine_id) { echo "selected"; } } ?>><?php echo $row->medicine_name; ?></option>
                                                  <?php
                                                    }
                                                  ?> 
                                                </select>
                                            </div>
                                        </div>

                                      

                                       

                                          <td>
                                                    <a href="javacript:void(0)" class="btn btn-primary edit_nagative" id="minus" onclick="price_hiding_out1('<?php echo $i+1; ?>');"><b>-</b></a></td>

                                                     </div>

                                        <?php } ?>                                        

                                        <a href="javacript:void(0)"  id="edu_no_1" onclick="edu_produce_file_box('1')" class="btn btn-primary prosetive_btn"><b>+</b></a>

                                       

                                       

                                        
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

                                         <?php /*foreach($product_price as $price){*/
                                           for($i=0;$i<count($my_med_without_group);$i++)
                                            {

                                              ?>

                                           <div id="price_my_med_<?php echo $i+1;  ?>">
                                            <div class="form-group frm-diff medi-p-cus-se new_desin_mediam Medicine_Name">
                                            <label for="product_name" class="control-label">Medicine Name</label>
                                            <div class="col-sm-8">
                                            <div id="div_diagnosis">
                                               <select  class="form-control"  name="my_medicine[]" id="my_medicine_1"  required="">
                                                   
                      
                                                     <?php
                                                       foreach($med_list as $row){

                                                        ?>

                                                   <option value="<?php echo $row->medicine_id; ?>" <?php  if(@$my_med_without_group[$i]->medicine_id==$row->medicine_id) { echo "selected";  } ?> ><?php echo $row->medicine_name; ?>
                                                   </option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                                </div>

                                               
                                            </div>
                                        </div>

                                          <div class="form-group frm-diff p-cus-medi-cus-all-days new_desin_day Medicine_Days">
                                            <label for="product_name" class="control-label">Dose</label>
                                            <div class="col-sm-8">

                                               <select  class="form-control" name="dose[]" id="dose"  required="">
                                                <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
                                                ?>

                                                    <option value="">--Select Days--</option>
                                                    <?php 

                                                        foreach($days as $row)
                                                        {
                                                     ?>
                                                    <option value="<?php echo $row->id; ?>" <?php if($row->day==@$my_med_without_group[$i]->dose) {  echo 'selected'; }?>><?php echo 'for '.$row->day; ?></option>
                                                    <?php } ?>
                      
                                                 <option></option>
                                                </select>

                                              
                                              <!--   <textarea class="form-control" type="text" name="dose[]" id="dose_1"  placeholder="Dose"><?php echo @$patient_med[$i]->dose; ?></textarea> -->
                                            </div>
                                        </div>

                                         <div class="all-p-add-pplus-mina m_add-pplus-mina">
                                                    <a href="javacript:void(0)" class="btn btn-primary  dwn" id="minus" onclick="price_hiding_out_my_med('<?php echo $i+1; ?>');"><b>-</b></a>

                                                  </div>

                                                    </div>

                                                    <?php } ?>

                                                    <script type="text/javascript">
                                                      function price_hiding_out_my_med(val)
                                                      {

                                                        $("#price_my_med_"+val).remove();
                                                      }
                                                    </script>


                                              <div class="form-group frm-diff new_desin">
                                            <label for="product_name" class="control-label">Diet Name</label>
                                            <div class="col-sm-8">
                                            <div id="div_diet">
                                               <select  class="form-control select2" multiple="" name="diet[]" id="diet"  required="">
                      
                                                     <?php
                                                       foreach($diet as $row){

                                                        ?>

                                                   <option value="<?php echo $row->diet_id; ?>" <?php foreach($patient_diet as $row1) {  if($row->diet_id==$row1->diet_id) { echo "selected"; } } ?> ><?php echo $row->diet_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                                </div>

                                                  
                                            </div>
                                        </div>
                                        

                                           <div class="form-group frm-diff new_desin Councelling_Name">
                                            <label for="product_name" class="control-label">Councelling Name</label>
                                            <div class="col-sm-8">
                                            <div id="div_councel">
                                               <select  class="form-control select2" multiple="" name="councilling[]" id="councilling"  required="">
                                                   
                      
                                                     <?php
                                                       foreach($councelling as $row){

                                                        ?>

                                                   <option value="<?php echo $row->councelling_id; ?>" <?php foreach($patient_counc as $row1) {  if($row->councelling_id==$row1->councelling_id) { echo "selected"; } } ?> ><?php echo $row->councelling_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                                </div>

                                                
                                            </div>
                                        </div>
                                        <div class="form-group new_desin_day Review">
                                            <label for="product_name" class="control-label">Review</label>
                                            <div class="col-sm-8">
                                              
                                             

                                               <select  class="form-control" name="feedback" id="feedback"  required="">
                                                <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
                                                ?>

                                                    <option value="">--Select Days--</option>
                                                    <?php 

                                                        foreach($days as $row)
                                                        {
                                                     ?>
                                                    <option value="<?php echo $row->id; ?>"<?php if(@$patient_chk[0]->feedback==$row->day) { echo "selected"; }?>><?php echo 'after '.$row->day; ?></option>
                                                    <?php } ?>
                      
                                                 <option></option>
                                                </select>
                                            </div>
                                        </div> 


                                        


                                </div>                           
                             </div>
                        </div>
                         <div class="box-footer" style="margin-top: 10px;float: right;margin-right: 1%;" >
                                    
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
               /*  var node='<option value="1">select medicine</option>';*/
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
                    <!-- /.box-header -->
                    <div class="box-body new_box">
                        <div class="tab-content">
                              <div id="vital_info" >
                                    <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">Review date</label>
                                            <div class="col-sm-8">
                                              
                                                <input class="form-control" value="<?php echo @$patient_chk[0]->check_next_date; ?>" type="date" name="review" id="review" >
                                            </div>
                                        </div>                                         
                                       
                                        <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">To add new H/O</label>
                                            <div class="col-sm-8">
                                              <div id="null">
                                               <input type="text" class="form-control" name="ho_new" id="ho_new" multiple="" required="" placeholder="To add new H/O(example:HO1,HO2,..)">
                                                </div>
                                              </div>
                                            </div>
                                        <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">To add new C/C
                                            </label>
                                            <div class="col-sm-8"> 

                                               <div id="null">
                                               <input type="text" class="form-control" name="cc_new" id="cc_new" multiple="" required="" placeholder="To add new C/C(example: CC1,CC2,..)">
                                               </div>
                                             </div>
                                           </div> 

                                        <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">To add new General</label>
                                            <div class="col-sm-8">
                                              <div id="null">
                                               <input type="text" class="form-control" name="gen_new" id="gen_new" multiple="" required="" placeholder="To add new General(example:gen-exam1,gen-exam2...)">
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
                                               </div></div>
                                             </div>
                                             <div class="form-group frm-diff">
                                            <label for="product_name" class="col-sm-2 control-label">To add new</label>
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






                                  </div>                           
                               </div>
                               <div class="box-body new_box">
                        <div class="tab-content">
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
/* function valid_doc_form()
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

 }*/
 function valid_doc_form()
 {
  

      $('#doc_add_form').submit();
 

 }
 </script>

<script >
    
    /*function edu_produce_file_box(id)
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

    }
*/

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
     function price_hiding_out(val)
    {
      $("#price_"+val).remove();
    }
    function price_hiding_out1(val)
    {
      $("#price1_"+val).remove();
    }
    function price_hiding_out_cc(val)
    {
         $("#patient_cc_"+val).remove();

    }
    

    function patient_report_hiding_out(val)
    {

    //  alert(val);
         $("#patient_report_"+val).remove();

    }



     function price_hiding_out_ho(val)
    {
         $("#patient_ho_"+val).remove();

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
               
        }

        }); 
  

    }
  </script>