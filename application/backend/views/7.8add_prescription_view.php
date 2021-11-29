<style type="text/css">
    .thumb-image{float:left;width:100px;position:relative;padding:5px;}
</style>


<div class="content-wrapper">
<div class="total-div-area-cntent-p-cus-form">
    <form class="" method="post" action="<?php echo base_url(); ?>index.php/admin_prescription/prescription_add" id="doc_add_form">
  
    <section class="content">
        <div class="row">
            <div class="col-xs-12 table-responsive">
              
      <div id="patient_detail_table">

                                       
      </div>
                <div class="box section_p">
             
                    <div class="clearfix"></div>
                    
                    <div class="box-body new_box">
                        <div class="tab-content">


                                <div id="vital_info" >








    <div class="p-cus-class-all-section" id="p-add-cus-new-class">
<div class="first-all-section-p-cus">
<div class="form-group frm-diff top new_desin Choose_Patient">
      <div class="col-sm-12" >
            <label for="product_name" class="control-label">Choose Patient</label>
            <div id="div_patient" class="first-add-pres">
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
<div class="form-group frm-diff new_desin C_C">
        <div class="col-sm-12" >
  <label for="product_name" class=" control-label">C/C</label>
      <div id="null" class="first-add-pres">
        <select  class="form-control select2" name="cc[]" id="cc_0"  required="">
        <option value="">Select C/C</option>
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
<div class="form-group frm-diff new_desin_day Days_c_c">
<div class="col-sm-12">
<label for="product_name" class=" control-label">Days</label>      <div class="first-add-pres">   
   <select  class="form-control" name="dose_cc[]" id="dose_cc_0"  required="">
  <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
     ?>
<option value="">--Select Days--</option>
  <?php 
foreach($days as $row)
{
 ?>
 <option value="<?php echo $row->id; ?>"><?php echo $row->day; ?></option>
  <?php } ?>

  </select>
 </div>
   </div>
 </div>
<a href="javacript:void(0)"  id="edu_no2_1" onclick="edu_produce_file_box_cc('1')" class="btn btn-primary"><b>+</b></a>
</div>
<div class="cc-p-cus-design">
<div class="first-section-loop-p-cus">
     <div id="edu_cc_1" style="display: none;">
<div class="form-group frm-diff add_blank first-section-equal-width">
<select  class="form-control" style="display: none;">
  </select>
</div>
<div class="form-group frm-diff new_desin C_C first-section-equal-width">
 <div class="col-sm-12" >
<label for="product_name" class=" control-label">C/C</label>
    <div id="null" class="first-add-pres">
      <select  class="form-control select2" name="cc[]" id="cc_0"  required="">
   <option value="">Select C/C</option>
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
<div class="form-group frm-diff new_desin_day Days_c_c first-section-equal-width">
<div class="col-sm-12">
<label for="product_name" class=" control-label">Days</label>         
  <select  class="form-control cutom-calc-width" name="dose_cc[]" id="dose_cc_0"  required="">
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
    </select>
  </div>
     </div>
<div class="add_remove">
 <div class="all-p-add-pplus-mina">
  <div class="right-p-sec-pp">
    <td>
     <a href="javacript:void(0)"  id="edu_no2_2" onclick="edu_produce_file_box_cc(2)" class="btn btn-primary first-loop-plus"><b>+</b></a>
        </td>
 <td>
<a href="javacript:void(0)" class="btn btn-primary first-loop-minis" id="minus" onclick="edu_hiding_out_cc(2);"><b>-</b></a></td>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="first-section-loop-p-cus">
    <div id="edu_cc_2" style="display: none;">
<div class="form-group frm-diff add_blank first-section-equal-width">
          <select  class="form-control" style="display: none;">
   </select>
    </div>
<div class="form-group frm-diff new_desin C_C first-section-equal-width">
                                          
<div class="col-sm-12" >
  <label for="product_name" class=" control-label">C/C</label>
 <div id="null" class="first-add-pres">
       <select  class="form-control select2" name="cc[]" id="cc_0"  required="">
                                                    
  <option value="">Select C/C</option>
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

<div class="form-group frm-diff new_desin_day Days_c_c first-section-equal-width">
<div class="col-sm-12">
<label for="product_name" class=" control-label">Days</label>      
<select  class="form-control cutom-calc-width" name="dose_cc[]" id="dose_cc_0"  required="">
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
  </select>
   </div>
     </div>

 <div class="add_remove">
  <div class="all-p-add-pplus-mina">
     <div class="right-p-sec-pp">
       <td>
     <a href="javacript:void(0)"  id="edu_no2_3" onclick="edu_produce_file_box_cc(3)" class="btn btn-primary first-loop-plus"><b>+</b></a>
      </td>
  <td>
   <a href="javacript:void(0)" class="btn btn-primary first-loop-minis" id="minus" onclick="edu_hiding_out_cc(3);"><b>-</b></a></td>
      </div>
  </div>
     </div>
  </div>
</div>
<div class="first-section-loop-p-cus">
     <div id="edu_cc_3" style="display: none;">

  <div class="form-group frm-diff add_blank first-section-equal-width">
          <select  class="form-control" style="display: none;">
         </select>
  </div>
<div class="form-group frm-diff new_desin C_C first-section-equal-width">
<div class="col-sm-12" >
  <label for="product_name" class=" control-label">C/C</label>
   <div id="null" class="first-add-pres">
     <select  class="form-control select2" name="cc[]" id="cc_0"  required="">
    <option value="">Select C/C</option>
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

<div class="form-group frm-diff new_desin_day Days_c_c first-section-equal-width">
<div class="col-sm-12">
  <label for="product_name" class=" control-label">Days</label>        
  <select  class="form-control cutom-calc-width" name="dose_cc[]" id="dose_cc_0"  required="">
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
        </select>
            </div>
       </div>
<div class="add_remove">
       <div class="all-p-add-pplus-mina">
        <div class="right-p-sec-pp">
       <td>
        <a href="javacript:void(0)"  id="edu_no2_4" onclick="edu_produce_file_box_cc(4)" class="btn btn-primary first-loop-plus"><b>+</b></a>
         </td>
          <td>
     <a href="javacript:void(0)" class="btn btn-primary first-loop-minis" id="minus" onclick="edu_hiding_out_cc(4);"><b>-</b></a></td>
        </div>
    </div>
      </div>
  </div>

</div>
<div class="first-section-loop-p-cus">
  <div id="edu_cc_4" style="display: none;">
<div class="form-group frm-diff add_blank first-section-equal-width">
<select  class="form-control" style="display: none;">
       </select>
   </div>
<div class="form-group frm-diff new_desin C_C first-section-equal-width">
<div class="col-sm-12" >
  <label for="product_name" class=" control-label">C/C</label>
        <div id="null" class="first-add-pres">
          <select  class="form-control select2" name="cc[]" id="cc_0"  required="">
           <option value="">Select C/C</option>
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
<div class="form-group frm-diff new_desin_day Days_c_c first-section-equal-width">
<div class="col-sm-12">
 <label for="product_name" class=" control-label">Days</label>         
       <select  class="form-control cutom-calc-width" name="dose_cc[]" id="dose_cc_0"  required="">
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
    </select>
     </div>
     </div>
<div class="add_remove">
    <div class="all-p-add-pplus-mina">
    <div class="right-p-sec-pp">
  <td>
    <a href="javacript:void(0)"  id="edu_no2_5" onclick="edu_produce_file_box_cc(5)" class="btn btn-primary first-loop-plus"><b>+</b></a>
  </td>
       <td>
   <a href="javacript:void(0)" class="btn btn-primary first-loop-minis" id="minus" onclick="edu_hiding_out_cc(5);"><b>-</b></a></td>
    </div>
      </div>
      </div>
  </div>
</div>
 </div>
 <script type="text/javascript">
  function edu_produce_file_box_cc(id)
    {
      // alert(id);
 var val=id;
if(val==1)
{
  $("#edu_no2_1").hide();
  $("#edu_cc_1").show();
$("#minus").show();
  }
// var base_url='<?php echo base_url(); ?>';
if(val==2)
  { 
$("#edu_cc_2").css('display','block');    
$("#edu_no2_1").hide();
 $("#edu_no2_2").hide();
 $("#minus").show();
}
 if(val==3)
 { 

  $("#edu_cc_3").css('display','block');    
  $("#edu_no2_1").hide();
  $("#edu_no2_2").hide();
   $("#edu_no2_3").hide();
  $("#minus").show();
                                                                
  }

if(val==4)
{ 

$("#edu_cc_4").css('display','block');    
$("#edu_no2_1").hide();
$("#edu_no2_2").hide();
 $("#edu_no2_3").hide();
  $("#edu_no2_4").hide();
  $("#minus").show();
   }
}
function edu_hiding_out_cc(val)
  {
if(val==1)
{
}
// var base_url='<?php echo base_url(); ?>';
if(val==2)
   { 
$("#edu_cc_1").css('display','none');    
$("#edu_no2_1").show();
$("#minus").show();
 }
if(val==3)
  { 
 $("#edu_cc_2").css('display','none');    
 $("#edu_no2_2").show();
$("#minus").show();
 }
  if(val==4)
 { 
$("#edu_cc_3").css('display','none');    
 $("#edu_no2_3").show();
   $("#minus").show();
}
if(val==5)
 { 
$("#edu_cc_4").css('display','none');    
 $("#edu_no2_4").show();
 }
                                                             
  }
 
</script>

<!-- opd first-section end-->

































 <div class="p-cus-know-more-ho-days">
                                       <!--  <div class="form-group frm-diff new_desin Choose_Patient Known_Patient">
                                            <label for="product_name" class="control-label">Known Patient Of
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
                                       -->

 <div class="form-group frm-diff new_desin_diagnosis Diagnosis">
<div class="col-sm-12">
   <label for="product_name" class=" control-label">Diagnosis</label>
<div id="div_diagnosis" class="p-cus-class-all-section">
  <select  class="form-control select2" multiple="" name="diagnosis[]" id="diagnosis"  required="">
 <?php
  foreach($diagnosis as $row){
 ?>
<option value="<?php echo $row->diagnosis_id; ?>" >
  <?php echo $row->diagnosis_name; ?></option>
 <?php
 }
 ?>
  </select>
  </div>
</div> 
</div>
<div class="form-group frm-diff new_desin C_C">
<div class="col-sm-12">
    <label for="product_name" class=" control-label">H/O</label>
    <div id="null" class="p-cus-class-all-section">
    <select  class="form-control select2" name="ho[]" id="ho"   required="">
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
<div class="form-group frm-diff new_desin_day Days_c_c">
 <div class="col-sm-12">
     <label for="product_name" class=" control-label">Days</label>
   <div class="p-cus-class-all-section">
     <input type="text" class="form-control" name="dose_ho[]" id="dose_ho_0">
       </div>  
                                             
   </div>
   </div>
   <a href="javacript:void(0)"  id="edu_no3_1" onclick="edu_produce_file_box_ho('1')" class="btn btn-primary"><b>+</b></a>
     </div>
    </div>

                                         

 <div class="first-section-second-area-loop-p-cus">                                      
 <div id="edu_ho_1" style="display: none;">
  <div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin_diagnosis Diagnosis">
<div class="col-sm-12">
 <div id="null">
  <select  class="form-control" style="display: none;">
  </select>
    </div>
</div>
  </div>
</div>
<div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin C_C">

    <div class="col-sm-12">
        <label for="product_name" class=" control-label">H/O</label>
   <div id="null" class="diagonasis-area-sec">
      <select  class="form-control select2" name="ho[]" id="ho"   required="">
  <option>Select H/O</option>
       <?php
     foreach($ho as $row){
?>
 <option value="<?php echo $row->ho_id; ?>" >
  <?php echo $row->ho_name; ?></option>
   <?php
    }
      ?>
       </select>
   </div>
   </div>
  </div>
</div>
<div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin_day Days_c_c daia-cus-with">
    
    <div class="col-sm-12">
      <label for="product_name" class=" control-label">Days</label>
 <input type="text" class="form-control cus-inpu-p-width" name="dose_ho[]" id="dose_ho_0">
  </div>
</div>
<div class="all-p-cus-section-left">
    <div class="inder-left-sec">
     <td>
<a href="javacript:void(0)"  id="edu_no3_2" onclick="edu_produce_file_box_ho(2)" class="btn btn-primary first-loop-plus"><b>+</b></a>
    </td>
      <td>
         <a href="javacript:void(0)" class="btn btn-primary first-loop-minis" id="minus" onclick="edu_hiding_out_ho(2);"><b>-</b></a></td>
  </div>
 </div>
   </div>

   </div>
</div>




<div class="first-section-second-area-loop-p-cus">                                      
 <div id="edu_ho_2" style="display: none;">
  <div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin_diagnosis Diagnosis">
<div class="col-sm-12">
 <div id="null">
  <select  class="form-control" style="display: none;">
  </select>
    </div>
</div>
  </div>
</div>
<div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin C_C">

    <div class="col-sm-12">
        <label for="product_name" class=" control-label">H/O</label>
   <div id="null" class="diagonasis-area-sec">
      <select  class="form-control select2" name="ho[]" id="ho"   required="">
  <option>Select H/O</option>
       <?php
     foreach($ho as $row){
?>
 <option value="<?php echo $row->ho_id; ?>" >
  <?php echo $row->ho_name; ?></option>
   <?php
    }
      ?>
       </select>
   </div>
   </div>
  </div>
</div>
<div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin_day Days_c_c daia-cus-with">
    
    <div class="col-sm-12">
      <label for="product_name" class=" control-label">Days</label>
 <input type="text" class="form-control cus-inpu-p-width" name="dose_ho[]" id="dose_ho_0">
  </div>
</div>
<div class="all-p-cus-section-left">
    <div class="inder-left-sec">
     <td>
<a href="javacript:void(0)"  id="edu_no3_2" onclick="edu_produce_file_box_ho(3)" class="btn btn-primary first-loop-plus"><b>+</b></a>
    </td>
      <td>
         <a href="javacript:void(0)" class="btn btn-primary first-loop-minis" id="minus" onclick="edu_hiding_out_ho(3);"><b>-</b></a></td>
  </div>
 </div>
   </div>

   </div>
</div>


<div class="first-section-second-area-loop-p-cus">                                      
 <div id="edu_ho_3" style="display: none;">
  <div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin_diagnosis Diagnosis">
<div class="col-sm-12">
 <div id="null">
  <select  class="form-control" style="display: none;">
  </select>
    </div>
</div>
  </div>
</div>
<div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin C_C">

    <div class="col-sm-12">
        <label for="product_name" class=" control-label">H/O</label>
   <div id="null" class="diagonasis-area-sec">
      <select  class="form-control select2" name="ho[]" id="ho"   required="">
  <option>Select H/O</option>
       <?php
     foreach($ho as $row){
?>
 <option value="<?php echo $row->ho_id; ?>" >
  <?php echo $row->ho_name; ?></option>
   <?php
    }
      ?>
       </select>
   </div>
   </div>
  </div>
</div>
<div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin_day Days_c_c daia-cus-with">
    
    <div class="col-sm-12">
      <label for="product_name" class=" control-label">Days</label>
 <input type="text" class="form-control cus-inpu-p-width" name="dose_ho[]" id="dose_ho_0">
  </div>
</div>
<div class="all-p-cus-section-left">
    <div class="inder-left-sec">
     <td>
<a href="javacript:void(0)"  id="edu_no3_2" onclick="edu_produce_file_box_ho(4)" class="btn btn-primary first-loop-plus"><b>+</b></a>
    </td>
      <td>
         <a href="javacript:void(0)" class="btn btn-primary first-loop-minis" id="minus" onclick="edu_hiding_out_ho(4);"><b>-</b></a></td>
  </div>
 </div>
   </div>

   </div>
</div>



<div class="first-section-second-area-loop-p-cus">                                      
 <div id="edu_ho_4" style="display: none;">
  <div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin_diagnosis Diagnosis">
<div class="col-sm-12">
 <div id="null">
  <select  class="form-control" style="display: none;">
  </select>
    </div>
</div>
  </div>
</div>
<div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin C_C">

    <div class="col-sm-12">
        <label for="product_name" class=" control-label">H/O</label>
   <div id="null" class="diagonasis-area-sec">
      <select  class="form-control select2" name="ho[]" id="ho"   required="">
  <option>Select H/O</option>
       <?php
     foreach($ho as $row){
?>
 <option value="<?php echo $row->ho_id; ?>" >
  <?php echo $row->ho_name; ?></option>
   <?php
    }
      ?>
       </select>
   </div>
   </div>
  </div>
</div>
<div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin_day Days_c_c daia-cus-with">
    
    <div class="col-sm-12">
      <label for="product_name" class=" control-label">Days</label>
 <input type="text" class="form-control cus-inpu-p-width" name="dose_ho[]" id="dose_ho_0">
  </div>
</div>
<div class="all-p-cus-section-left">
    <div class="inder-left-sec">
     <td>
<a href="javacript:void(0)"  id="edu_no3_2" onclick="edu_produce_file_box_ho(5)" class="btn btn-primary first-loop-plus"><b>+</b></a>
    </td>
      <td>
         <a href="javacript:void(0)" class="btn btn-primary first-loop-minis" id="minus" onclick="edu_hiding_out_ho(5);"><b>-</b></a></td>
  </div>
 </div>
   </div>

   </div>
</div>



<div class="first-section-second-area-loop-p-cus">                                      
 <div id="edu_ho_5" style="display: none;">
  <div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin_diagnosis Diagnosis">
<div class="col-sm-12">
 <div id="null">
  <select  class="form-control" style="display: none;">
  </select>
    </div>
</div>
  </div>
</div>
<div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin C_C">

    <div class="col-sm-12">
        <label for="product_name" class=" control-label">H/O</label>
   <div id="null" class="diagonasis-area-sec">
      <select  class="form-control select2" name="ho[]" id="ho"   required="">
  <option>Select H/O</option>
       <?php
     foreach($ho as $row){
?>
 <option value="<?php echo $row->ho_id; ?>" >
  <?php echo $row->ho_name; ?></option>
   <?php
    }
      ?>
       </select>
   </div>
   </div>
  </div>
</div>
<div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin_day Days_c_c daia-cus-with">
    
    <div class="col-sm-12">
      <label for="product_name" class=" control-label">Days</label>
 <input type="text" class="form-control cus-inpu-p-width" name="dose_ho[]" id="dose_ho_0">
  </div>
</div>
<div class="all-p-cus-section-left">
    <div class="inder-left-sec">
     <td>
<a href="javacript:void(0)"  id="edu_no3_2" onclick="edu_produce_file_box_ho(6)" class="btn btn-primary first-loop-plus"><b>+</b></a>
    </td>
      <td>
         <a href="javacript:void(0)" class="btn btn-primary first-loop-minis" id="minus" onclick="edu_hiding_out_ho(6);"><b>-</b></a></td>
  </div>
 </div>
   </div>

   </div>
</div>



<div class="first-section-second-area-loop-p-cus">                                      
 <div id="edu_ho_6" style="display: none;">
  <div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin_diagnosis Diagnosis">
<div class="col-sm-12">
 <div id="null">
  <select  class="form-control" style="display: none;">
  </select>
    </div>
</div>
  </div>
</div>
<div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin C_C">

    <div class="col-sm-12">
        <label for="product_name" class=" control-label">H/O</label>
   <div id="null" class="diagonasis-area-sec">
      <select  class="form-control select2" name="ho[]" id="ho"   required="">
  <option>Select H/O</option>
       <?php
     foreach($ho as $row){
?>
 <option value="<?php echo $row->ho_id; ?>" >
  <?php echo $row->ho_name; ?></option>
   <?php
    }
      ?>
       </select>
   </div>
   </div>
  </div>
</div>
<div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin_day Days_c_c daia-cus-with">
    
    <div class="col-sm-12">
      <label for="product_name" class=" control-label">Days</label>
 <input type="text" class="form-control cus-inpu-p-width" name="dose_ho[]" id="dose_ho_0">
  </div>
</div>
<div class="all-p-cus-section-left">
    <div class="inder-left-sec">
     <td>
<a href="javacript:void(0)"  id="edu_no3_2" onclick="edu_produce_file_box_ho(7)" class="btn btn-primary first-loop-plus"><b>+</b></a>
    </td>
      <td>
         <a href="javacript:void(0)" class="btn btn-primary first-loop-minis" id="minus" onclick="edu_hiding_out_ho(7);"><b>-</b></a></td>
  </div>
 </div>
   </div>

   </div>
</div>


<div class="first-section-second-area-loop-p-cus">                                      
 <div id="edu_ho_7" style="display: none;">
  <div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin_diagnosis Diagnosis">
<div class="col-sm-12">
 <div id="null">
  <select  class="form-control" style="display: none;">
  </select>
    </div>
</div>
  </div>
</div>
<div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin C_C">

    <div class="col-sm-12">
        <label for="product_name" class=" control-label">H/O</label>
   <div id="null" class="diagonasis-area-sec">
      <select  class="form-control select2" name="ho[]" id="ho"   required="">
  <option>Select H/O</option>
       <?php
     foreach($ho as $row){
?>
 <option value="<?php echo $row->ho_id; ?>" >
  <?php echo $row->ho_name; ?></option>
   <?php
    }
      ?>
       </select>
   </div>
   </div>
  </div>
</div>
<div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin_day Days_c_c daia-cus-with">
    
    <div class="col-sm-12">
      <label for="product_name" class=" control-label">Days</label>
 <input type="text" class="form-control cus-inpu-p-width" name="dose_ho[]" id="dose_ho_0">
  </div>
</div>
<div class="all-p-cus-section-left">
    <div class="inder-left-sec">
     <td>
<a href="javacript:void(0)"  id="edu_no3_2" onclick="edu_produce_file_box_ho(8)" class="btn btn-primary first-loop-plus"><b>+</b></a>
    </td>
      <td>
         <a href="javacript:void(0)" class="btn btn-primary first-loop-minis" id="minus" onclick="edu_hiding_out_ho(8);"><b>-</b></a></td>
  </div>
 </div>
   </div>

   </div>
</div>


<div class="first-section-second-area-loop-p-cus">                                      
 <div id="edu_ho_8" style="display: none;">
  <div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin_diagnosis Diagnosis">
<div class="col-sm-12">
 <div id="null">
  <select  class="form-control" style="display: none;">
  </select>
    </div>
</div>
  </div>
</div>
<div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin C_C">

    <div class="col-sm-12">
        <label for="product_name" class=" control-label">H/O</label>
   <div id="null" class="diagonasis-area-sec">
      <select  class="form-control select2" name="ho[]" id="ho"   required="">
  <option>Select H/O</option>
       <?php
     foreach($ho as $row){
?>
 <option value="<?php echo $row->ho_id; ?>" >
  <?php echo $row->ho_name; ?></option>
   <?php
    }
      ?>
       </select>
   </div>
   </div>
  </div>
</div>
<div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin_day Days_c_c daia-cus-with">
    
    <div class="col-sm-12">
      <label for="product_name" class=" control-label">Days</label>
 <input type="text" class="form-control cus-inpu-p-width" name="dose_ho[]" id="dose_ho_0">
  </div>
</div>
<div class="all-p-cus-section-left">
    <div class="inder-left-sec">
     <td>
<a href="javacript:void(0)"  id="edu_no3_2" onclick="edu_produce_file_box_ho(9)" class="btn btn-primary first-loop-plus"><b>+</b></a>
    </td>
      <td>
         <a href="javacript:void(0)" class="btn btn-primary first-loop-minis" id="minus" onclick="edu_hiding_out_ho(9);"><b>-</b></a></td>
  </div>
 </div>
   </div>

   </div>
</div>


<div class="first-section-second-area-loop-p-cus">                                      
 <div id="edu_ho_9" style="display: none;">
  <div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin_diagnosis Diagnosis">
<div class="col-sm-12">
 <div id="null">
  <select  class="form-control" style="display: none;">
  </select>
    </div>
</div>
  </div>
</div>
<div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin C_C">

    <div class="col-sm-12">
        <label for="product_name" class=" control-label">H/O</label>
   <div id="null" class="diagonasis-area-sec">
      <select  class="form-control select2" name="ho[]" id="ho"   required="">
  <option>Select H/O</option>
       <?php
     foreach($ho as $row){
?>
 <option value="<?php echo $row->ho_id; ?>" >
  <?php echo $row->ho_name; ?></option>
   <?php
    }
      ?>
       </select>
   </div>
   </div>
  </div>
</div>
<div class=" daia-cus-with">
 <div class="form-group frm-diff new_desin_day Days_c_c daia-cus-with">
    
    <div class="col-sm-12">
      <label for="product_name" class=" control-label">Days</label>
 <input type="text" class="form-control cus-inpu-p-width" name="dose_ho[]" id="dose_ho_0">
  </div>
</div>
<div class="all-p-cus-section-left">
    <div class="inder-left-sec">
     <td>
<a href="javacript:void(0)"  id="edu_no3_2" onclick="edu_produce_file_box_ho(10)" class="btn btn-primary first-loop-plus"><b>+</b></a>
    </td>
      <td>
         <a href="javacript:void(0)" class="btn btn-primary first-loop-minis" id="minus" onclick="edu_hiding_out_ho(10);"><b>-</b></a></td>
  </div>
 </div>
   </div>

   </div>
</div>



                                            <script type="text/javascript">
  
        




        function edu_produce_file_box_ho(id)
    {
      // alert(id);
         
             var val=id;

                                                                if(val==1)
                                                                      {


                                                                           $("#edu_no3_1").hide();
                                                                           $("#edu_ho_1").show();
                                                                            $("#minus").show();
                                                                      }
           // var base_url='<?php echo base_url(); ?>';

                                                                 if(val==2)
                                                                { 

                                                                $("#edu_ho_2").css('display','block');    
                                                                $("#edu_no3_1").hide();
                                                                $("#edu_no3_2").hide();
                                                                $("#minus").show();
                                                                
                                                                }
                                                                if(val==3)
                                                                { 

                                                                $("#edu_ho_3").css('display','block');    
                                                                $("#edu_no3_1").hide();
                                                                $("#edu_no3_2").hide();
                                                                 $("#edu_no3_3").hide();
                                                                $("#minus").show();
                                                                
                                                                }
                                                                if(val==4)
                                                                { 

                                                                $("#edu_ho_4").css('display','block');    
                                                                $("#edu_no3_1").hide();
                                                                $("#edu_no3_2").hide();
                                                                 $("#edu_no3_3").hide();
                                                                 $("#edu_no3_4").hide();
                                                                $("#minus").show();
                                                                
                                                                }
                                                                if(val==5)
                                                                { 

                                                                $("#edu_ho_5").css('display','block');    
                                                                $("#edu_no3_1").hide();
                                                                $("#edu_no3_2").hide();
                                                                 $("#edu_no3_3").hide();
                                                                 $("#edu_no3_4").hide();
                                                                  $("#edu_no3_5").hide();
                                                                $("#minus").show();
                                                                
                                                                }

                                                                if(val==6)
                                                                { 

                                                                $("#edu_ho_6").css('display','block');    
                                                                $("#edu_no3_1").hide();
                                                                $("#edu_no3_2").hide();
                                                                 $("#edu_no3_3").hide();
                                                                 $("#edu_no3_4").hide();
                                                                  $("#edu_no3_5").hide();
                                                                   $("#edu_no3_6").hide();
                                                                $("#minus").show();
                                                                
                                                                }

                                                                 if(val==7)
                                                                { 

                                                                $("#edu_ho_7").css('display','block');    
                                                                $("#edu_no3_1").hide();
                                                                $("#edu_no3_2").hide();
                                                                 $("#edu_no3_3").hide();
                                                                 $("#edu_no3_4").hide();
                                                                  $("#edu_no3_5").hide();
                                                                   $("#edu_no3_6").hide();
                                                                     $("#edu_no3_7").hide();
                                                                $("#minus").show();
                                                                
                                                                }

                                                                if(val==8)
                                                                { 

                                                                $("#edu_ho_8").css('display','block');    
                                                                $("#edu_no3_1").hide();
                                                                $("#edu_no3_2").hide();
                                                                 $("#edu_no3_3").hide();
                                                                 $("#edu_no3_4").hide();
                                                                  $("#edu_no3_5").hide();
                                                                   $("#edu_no3_6").hide();
                                                                     $("#edu_no3_7").hide();
                                                                      $("#edu_no3_8").hide();
                                                                $("#minus").show();
                                                                
                                                                }

                                                                if(val==9)
                                                                { 

                                                                $("#edu_ho_9").css('display','block');    
                                                                $("#edu_no3_1").hide();
                                                                $("#edu_no3_2").hide();
                                                                 $("#edu_no3_3").hide();
                                                                 $("#edu_no3_4").hide();
                                                                  $("#edu_no3_5").hide();
                                                                   $("#edu_no3_6").hide();
                                                                     $("#edu_no3_7").hide();
                                                                      $("#edu_no3_8").hide();
                                                                      $("#edu_no3_9").hide();
                                                                $("#minus").show();
                                                                
                                                                }


            
       /*     if(val==1)
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
             
              

                 
                
              }
             });*/
    }


  function edu_hiding_out_ho(val)
  {

      /*   var current_div=val-1; 
                
          $("#edu_ho_"+val).html('');
          $("#edu_ho_"+current_div).hide();
          $("#edu_no3_"+current_div).show();
          $("#minus").show();*/



                                                                 if(val==1)
                                                                      {
                                                                      }
           // var base_url='<?php echo base_url(); ?>';

                                                                if(val==2)
                                                                { 

                                                                  $("#edu_ho_1").css('display','none');    
                                                               
                                                                  $("#edu_no3_1").show();
                                                                  $("#minus").show();
                                                                
                                                                }
                                                                if(val==3)
                                                                { 

                                                                   $("#edu_ho_2").css('display','none');    
                                                               
                                                                  $("#edu_no3_2").show();
                                                                  $("#minus").show();
                                                                
                                                                }
                                                                if(val==4)
                                                                { 

                                                                   $("#edu_ho_3").css('display','none');    
                                                               
                                                                  $("#edu_no3_3").show();
                                                                  $("#minus").show();
                                                                
                                                                }
                                                                if(val==5)
                                                                { 

                                                                  $("#edu_ho_4").css('display','none');    
                                                               
                                                                  $("#edu_no3_4").show();
                                                                  $("#minus").show();
                                                                  
                                                                
                                                                }
                                                                 if(val==6)
                                                                { 

                                                                  $("#edu_ho_5").css('display','none');    
                                                               
                                                                  $("#edu_no3_5").show();
                                                                  $("#minus").show();
                                                                  
                                                                
                                                                }
                                                                 if(val==7)
                                                                { 

                                                                  $("#edu_ho_6").css('display','none');    
                                                               
                                                                  $("#edu_no3_6").show();
                                                                  $("#minus").show();
                                                                  
                                                                
                                                                }

                                                                if(val==8)
                                                                { 

                                                                  $("#edu_ho_7").css('display','none');    
                                                               
                                                                  $("#edu_no3_7").show();
                                                                  $("#minus").show();
                                                                  
                                                                
                                                                }

                                                                  if(val==9)
                                                                { 

                                                                  $("#edu_ho_8").css('display','none');    
                                                               
                                                                  $("#edu_no3_8").show();
                                                                  $("#minus").show();
                                                                  
                                                                
                                                                }

                                                                 if(val==10)
                                                                { 

                                                                  $("#edu_ho_9").css('display','none');    
                                                               
                                                                  $("#edu_no3_9").show();
                                                                  $("#minus").show();
                                                                  
                                                                
                                                                }
  }



</script>


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
                    <!-- <div class="box-header">
                        <h3 class="box-title"><b><u>Examination</u> : </b></h3>
                      

                    </div> -->
                    <div class="clearfix"></div>
                    <!-- /.box-header -->
                    <div class="box-body new_box">
                        <div class="tab-content"> 

                                <div id="vital_info" >  

                                    <div class="general-puls-all-section">
                                        <div class="form-group frm-diff new_desin_long General">
                                            
                                            <div class="col-sm-12">
                                              <label for="product_name" class=" control-label">General</label>
                                             <div id="div_gen" class="general-puls-all-width">
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
                                            
                                           


                                           <div class="form-group frm-diff new_desin_day Pulse_RPM">
                                           
                                            <div class="col-sm-12">
                                               <label for="product_name" class=" control-label">Pulse (RPM)</label>
                                              <div id="div_gen" class="general-puls-all-width">
                                                <input class="form-control" type="text" name="pulse" id="pulse" placeholder="Pulse">
                                              </div>
                                            </div>
                                        </div>
                                   






                                         <div class="form-group frm-diff new_desin_day Choose">
                                            <label for="product_name" class=" control-label">Choose</label>
                                            <div class="col-sm-8">
                                               <!--  <input class="form-control" type="text" name="pulse" id="pulse" placeholder="Pulse"> -->
                                               <Select class="form-control" name="pulse_type">

                                               <option value="Regular">Regular</option>
                                                <option value="Regularly Irregular">Regularly Irregular</option>
                                                  <option value="Irregularly Irregular">Irregularly Irregular</option>
                                                    <option value="Pulse Deficit+">Pulse Deficit+</option>

                                               ></Select>
                                            </div>
                                        </div>

                                          <div class="all-bp-chest-all-sec">
                                           <div class="form-group frm-diff new_desin_day bp">
                                            <label for="product_name" class=" control-label">BP</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="text" name="upper" id="upper"placeholder="Upper">
                                            </div>

                                             <div class="col-sm-6">
                                                <input class="form-control" type="text" name="lower" id="lower"placeholder="Lower">
                                            </div>
                                        </div>
                                      </div>
   </div>
                            <div class="chest-heart-abd-all-p-cus-section">
                                        <div class="form-group frm-diff new_desin Chest">
                                            
                                            <div class="col-sm-12">
                                              <label for="product_name" class=" control-label">Chest</label>
                                             <div id="div_chest" class="chest-heart-abd-input-all">
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

                                        
                                       

                                                    <div class="form-group frm-diff new_desin Chest">
                                            
                                            <div class="col-sm-12">
                                              <label for="product_name" class=" control-label">Heart</label>
                                             <div id="div_chest" class="chest-heart-abd-input-all">
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

                                            



                    <div class="form-group frm-diff new_desin Chest">
                                           
                    <div class="col-sm-12">
                      <label for="product_name" class=" control-label">ABD</label>
                  <div id="div_abd" class="chest-heart-abd-input-all">
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
                                        

                                           <div class="form-group frm-diff new_desin Chest">
                                          
                                            <div class="col-sm-12">
                                                <label for="product_name" class=" control-label">CNS</label>
                                             <div id="div_cns" class="chest-heart-abd-input-all">
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
                        <h3 class="box-title"><b>Report: </b></h3>
                </div>
                  <div class="clearfix"></div>
                   <div class="box-body new_box">
                    <div class="tab-content">
                    <div id="vital_info" >



  <div class="report-all-section-class">                    
      <div class="form-group frm-diff new_desin Report ">
   <div class="col-sm-12">
   <div id="div_inves">
   <select  class="form-control select2"  name="write[]" id="write"  required="">  
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
<div class="form-group frm-diff new_desin Report">
  <div class="col-sm-8">
 <input type="text" name="write_some[]" class="form-control">
       </div>
       </div>
 <div class="form-group frm-diff new_desin_day">
 <div class="col-sm-12">
<input type="date" name="date[]" class="form-control">
    </div>
  </div>
<div class="report-section-text-p-cus">
     <a href="javacript:void(0)" class="btn btn-primary" id="edu_report_no_1" onclick="edu_report_produce_file_box('1')"><b>+</b></a>
  </div>
</div>







<div class="report-loop-section-all">
 <div id="add_more_edu_report_no_1" style="display: none;">
  <div class="form-group frm-diff new_desin Report ">
<div class="col-sm-12">
  <div id="div_inves">
    <select  class="form-control select2"  name="write[]" id="write"  required="">  
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
 <div class="form-group frm-diff new_desin Report">

 <div class="col-sm-8">
<input type="text" name="write_some[]" class="form-control">
 </div>
    </div>
 <div class="form-group frm-diff new_desin_day">
    
    <div class="col-sm-12">
 <input type="date" name="date[]" class="form-control">
       </div>
     </div>
<div class="report-p-cus-plus-mi-btn">
   <div class="report-p-cus-text-right">
     <td>
    <a href="javacript:void(0)"  id="edu_report_no_2" onclick="edu_report_produce_file_box(2)" class="btn btn-primary"><b>+</b></a>
   </td>
      <td>
  <a href="javacript:void(0)" class="btn btn-primary" id="report_minus" onclick="edu_report_hiding_out(2);"><b>-</b></a></td>
                                            
   </div>
</div>
 </div>
</div>








<div class="report-loop-section-all">
 <div id="add_more_edu_report_no_2" style="display: none;">
  <div class="form-group frm-diff new_desin Report ">
<div class="col-sm-12">
  <div id="div_inves">
    <select  class="form-control select2"  name="write[]" id="write"  required="">  
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
 <div class="form-group frm-diff new_desin Report">

 <div class="col-sm-8">
<input type="text" name="write_some[]" class="form-control">
 </div>
    </div>
 <div class="form-group frm-diff new_desin_day">
    
    <div class="col-sm-12">
 <input type="date" name="date[]" class="form-control">
       </div>
     </div>
<div class="report-p-cus-plus-mi-btn">
   <div class="report-p-cus-text-right">
     <td>
    <a href="javacript:void(0)"  id="edu_report_no_3" onclick="edu_report_produce_file_box(3)" class="btn btn-primary"><b>+</b></a>
   </td>
      <td>
  <a href="javacript:void(0)" class="btn btn-primary" id="report_minus" onclick="edu_report_hiding_out(3);"><b>-</b></a></td>
                                            
   </div>
</div>
 </div>
</div>






<div class="report-loop-section-all">
 <div id="add_more_edu_report_no_3" style="display: none;">
  <div class="form-group frm-diff new_desin Report ">
<div class="col-sm-12">
  <div id="div_inves">
    <select  class="form-control select2"  name="write[]" id="write"  required="">  
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
 <div class="form-group frm-diff new_desin Report">

 <div class="col-sm-8">
<input type="text" name="write_some[]" class="form-control">
 </div>
    </div>
 <div class="form-group frm-diff new_desin_day">
    
    <div class="col-sm-12">
 <input type="date" name="date[]" class="form-control">
       </div>
     </div>
<div class="report-p-cus-plus-mi-btn">
   <div class="report-p-cus-text-right">
     <td>
    <a href="javacript:void(0)"  id="edu_report_no_4" onclick="edu_report_produce_file_box(4)" class="btn btn-primary"><b>+</b></a>
   </td>
      <td>
  <a href="javacript:void(0)" class="btn btn-primary" id="report_minus" onclick="edu_report_hiding_out(4);"><b>-</b></a></td>
                                            
   </div>
</div>
 </div>
</div>




<div class="report-loop-section-all">
 <div id="add_more_edu_report_no_4" style="display: none;">
  <div class="form-group frm-diff new_desin Report ">
<div class="col-sm-12">
  <div id="div_inves">
    <select  class="form-control select2"  name="write[]" id="write"  required="">  
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
 <div class="form-group frm-diff new_desin Report">

 <div class="col-sm-8">
<input type="text" name="write_some[]" class="form-control">
 </div>
    </div>
 <div class="form-group frm-diff new_desin_day">
    
    <div class="col-sm-12">
 <input type="date" name="date[]" class="form-control">
       </div>
     </div>
<div class="report-p-cus-plus-mi-btn">
   <div class="report-p-cus-text-right">
     <td>
    <a href="javacript:void(0)"  id="edu_report_no_5" onclick="edu_report_produce_file_box(5)" class="btn btn-primary"><b>+</b></a>
   </td>
      <td>
  <a href="javacript:void(0)" class="btn btn-primary" id="report_minus" onclick="edu_report_hiding_out(5);"><b>-</b></a></td>
                                            
   </div>
</div>
 </div>
</div>







<div class="report-loop-section-all">
 <div id="add_more_edu_report_no_5" style="display: none;">
  <div class="form-group frm-diff new_desin Report ">
<div class="col-sm-12">
  <div id="div_inves">
    <select  class="form-control select2"  name="write[]" id="write"  required="">  
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
 <div class="form-group frm-diff new_desin Report">

 <div class="col-sm-8">
<input type="text" name="write_some[]" class="form-control">
 </div>
    </div>
 <div class="form-group frm-diff new_desin_day">
    
    <div class="col-sm-12">
 <input type="date" name="date[]" class="form-control">
       </div>
     </div>
<div class="report-p-cus-plus-mi-btn">
   <div class="report-p-cus-text-right">
     <td>
    <a href="javacript:void(0)"  id="edu_report_no_6" onclick="edu_report_produce_file_box(6)" class="btn btn-primary"><b>+</b></a>
   </td>
      <td>
  <a href="javacript:void(0)" class="btn btn-primary" id="report_minus" onclick="edu_report_hiding_out(6);"><b>-</b></a></td>
                                            
   </div>
</div>
 </div>
</div>






<div class="report-loop-section-all">
 <div id="add_more_edu_report_no_6" style="display: none;">
  <div class="form-group frm-diff new_desin Report ">
<div class="col-sm-12">
  <div id="div_inves">
    <select  class="form-control select2"  name="write[]" id="write"  required="">  
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
 <div class="form-group frm-diff new_desin Report">

 <div class="col-sm-8">
<input type="text" name="write_some[]" class="form-control">
 </div>
    </div>
 <div class="form-group frm-diff new_desin_day">
    
    <div class="col-sm-12">
 <input type="date" name="date[]" class="form-control">
       </div>
     </div>
<div class="report-p-cus-plus-mi-btn">
   <div class="report-p-cus-text-right">
     <td>
    <a href="javacript:void(0)"  id="edu_report_no_7" onclick="edu_report_produce_file_box(7)" class="btn btn-primary"><b>+</b></a>
   </td>
      <td>
  <a href="javacript:void(0)" class="btn btn-primary" id="report_minus" onclick="edu_report_hiding_out(7);"><b>-</b></a></td>
                                            
   </div>
</div>
 </div>
</div>









<div class="report-loop-section-all">
 <div id="add_more_edu_report_no_7" style="display: none;">
  <div class="form-group frm-diff new_desin Report ">
<div class="col-sm-12">
  <div id="div_inves">
    <select  class="form-control select2"  name="write[]" id="write"  required="">  
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
 <div class="form-group frm-diff new_desin Report">

 <div class="col-sm-8">
<input type="text" name="write_some[]" class="form-control">
 </div>
    </div>
 <div class="form-group frm-diff new_desin_day">
    
    <div class="col-sm-12">
 <input type="date" name="date[]" class="form-control">
       </div>
     </div>
<div class="report-p-cus-plus-mi-btn">
   <div class="report-p-cus-text-right">
     <td>
    <a href="javacript:void(0)"  id="edu_report_no_8" onclick="edu_report_produce_file_box(8)" class="btn btn-primary"><b>+</b></a>
   </td>
      <td>
  <a href="javacript:void(0)" class="btn btn-primary" id="report_minus" onclick="edu_report_hiding_out(8);"><b>-</b></a></td>
                                            
   </div>
</div>
 </div>
</div>









<div class="report-loop-section-all">
 <div id="add_more_edu_report_no_8" style="display: none;">
  <div class="form-group frm-diff new_desin Report ">
<div class="col-sm-12">
  <div id="div_inves">
    <select  class="form-control select2"  name="write[]" id="write"  required="">  
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
 <div class="form-group frm-diff new_desin Report">

 <div class="col-sm-8">
<input type="text" name="write_some[]" class="form-control">
 </div>
    </div>
 <div class="form-group frm-diff new_desin_day">
    
    <div class="col-sm-12">
 <input type="date" name="date[]" class="form-control">
       </div>
     </div>
<div class="report-p-cus-plus-mi-btn">
   <div class="report-p-cus-text-right">
     <td>
    <a href="javacript:void(0)"  id="edu_report_no_9" onclick="edu_report_produce_file_box(9)" class="btn btn-primary"><b>+</b></a>
   </td>
      <td>
  <a href="javacript:void(0)" class="btn btn-primary" id="report_minus" onclick="edu_report_hiding_out(9);"><b>-</b></a></td>
                                            
   </div>
</div>
 </div>
</div>





<div class="report-loop-section-all">
 <div id="add_more_edu_report_no_9" style="display: none;">
  <div class="form-group frm-diff new_desin Report ">
<div class="col-sm-12">
  <div id="div_inves">
    <select  class="form-control select2"  name="write[]" id="write"  required="">  
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
 <div class="form-group frm-diff new_desin Report">

 <div class="col-sm-8">
<input type="text" name="write_some[]" class="form-control">
 </div>
    </div>
 <div class="form-group frm-diff new_desin_day">
    
    <div class="col-sm-12">
 <input type="date" name="date[]" class="form-control">
       </div>
     </div>
<div class="report-p-cus-plus-mi-btn">
   <div class="report-p-cus-text-right">
     <td>
    <a href="javacript:void(0)"  id="edu_report_no_10" onclick="edu_report_produce_file_box(10)" class="btn btn-primary"><b>+</b></a>
   </td>
      <td>
  <a href="javacript:void(0)" class="btn btn-primary" id="report_minus" onclick="edu_report_hiding_out(10);"><b>-</b></a></td>
                                            
   </div>
</div>
 </div>
</div>



<div class="report-loop-section-all">
 <div id="add_more_edu_report_no_10" style="display: none;">
  <div class="form-group frm-diff new_desin Report ">
<div class="col-sm-12">
  <div id="div_inves">
    <select  class="form-control select2"  name="write[]" id="write"  required="">  
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
 <div class="form-group frm-diff new_desin Report">

 <div class="col-sm-8">
<input type="text" name="write_some[]" class="form-control">
 </div>
    </div>
 <div class="form-group frm-diff new_desin_day">
    
    <div class="col-sm-12">
 <input type="date" name="date[]" class="form-control">
       </div>
     </div>
<div class="report-p-cus-plus-mi-btn">
   <div class="report-p-cus-text-right">
     <td>
    <a href="javacript:void(0)"  id="edu_report_no_11" onclick="edu_report_produce_file_box(11)" class="btn btn-primary"><b>+</b></a>
   </td>
      <td>
  <a href="javacript:void(0)" class="btn btn-primary" id="report_minus" onclick="edu_report_hiding_out(11);"><b>-</b></a></td>
                                            
   </div>
</div>
 </div>
</div>

<div class="form-group frm-diff new_desin_mediam Investigation_name">
                                            <label for="product_name" class=" control-label">Investigation Name</label>
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

                                       

                                        
                                </div>                           
                             </div>
                        </div>
                    </div>
                                
                </div>
            </div>
    
    </section>



    <script >
    
    function edu_report_produce_file_box(id)
    {
      
         
        var val=id;

      

                 if(val==1)
        {
          $("#add_more_edu_report_no_1").show();
         $("#edu_report_no_1").hide();
         $("#report_minus").show();
       }

       if(val==2)
        {
          $("#add_more_edu_report_no_2").show();
         $("#edu_report_no_1").hide();
         $("#edu_report_no_2").hide();
         $("#report_minus").show();
       }

       if(val==3)
        {
          $("#add_more_edu_report_no_3").show();
         $("#edu_report_no_1").hide();
         $("#edu_report_no_2").hide();
          $("#edu_report_no_3").hide();
         $("#report_minus").show();
       }
       if(val==4)
        {
          $("#add_more_edu_report_no_4").show();
         $("#edu_report_no_1").hide();
         $("#edu_report_no_2").hide();
          $("#edu_report_no_3").hide();
           $("#edu_report_no_4").hide();
         $("#report_minus").show();
       }

        if(val==5)
        {
          $("#add_more_edu_report_no_5").show();
         $("#edu_report_no_1").hide();
         $("#edu_report_no_2").hide();
          $("#edu_report_no_3").hide();
           $("#edu_report_no_4").hide();
            $("#edu_report_no_5").hide();
         $("#report_minus").show();
       }

         if(val==6)
        {
          $("#add_more_edu_report_no_6").show();
         $("#edu_report_no_1").hide();
         $("#edu_report_no_2").hide();
          $("#edu_report_no_3").hide();
           $("#edu_report_no_4").hide();
            $("#edu_report_no_5").hide();
             $("#edu_report_no_6").hide();
         $("#report_minus").show();
       }

       if(val==7)
        {
          $("#add_more_edu_report_no_7").show();
         $("#edu_report_no_1").hide();
         $("#edu_report_no_2").hide();
          $("#edu_report_no_3").hide();
           $("#edu_report_no_4").hide();
            $("#edu_report_no_5").hide();
             $("#edu_report_no_6").hide();
              $("#edu_report_no_7").hide();
         $("#report_minus").show();
       }

       if(val==8)
        {
          $("#add_more_edu_report_no_8").show();
         $("#edu_report_no_1").hide();
         $("#edu_report_no_2").hide();
          $("#edu_report_no_3").hide();
           $("#edu_report_no_4").hide();
            $("#edu_report_no_5").hide();
             $("#edu_report_no_6").hide();
              $("#edu_report_no_7").hide();

              $("#edu_report_no_8").hide();
         $("#report_minus").show();
       }

       if(val==9)
        {
          $("#add_more_edu_report_no_9").show();
         $("#edu_report_no_1").hide();
         $("#edu_report_no_2").hide();
          $("#edu_report_no_3").hide();
           $("#edu_report_no_4").hide();
            $("#edu_report_no_5").hide();
             $("#edu_report_no_6").hide();
              $("#edu_report_no_7").hide();

              $("#edu_report_no_8").hide();

               $("#edu_report_no_9").hide();
         $("#report_minus").show();
       }
       //var base_url='<?php echo base_url(); ?>';
     



      /* if(val==2)
                {
                    $("#edu_report_no_"+val).hide();
                
                }
            if(val==3)
                {
                    $("#edu_report_no_"+val).hide();
                  
                }
             if(val==4)
                {
                    $("#edu_report_no_"+val).hide();
                   
                }
             if(val==5)
                {
                    $("#edu_report_no_"+val).hide();
                  
                }
                if(val==6)
                {
                    $("#edu_report_no_"+val).hide();
                 
                }   
                if(val==7)
                {
                    $("#edu_report_no_"+val).hide();
                 
                }       
                if(val==8)
                {
                    $("#edu_report_no_"+val).hide();
                  
                }   
                if(val==9)
                {
                    $("#edu_report_no_"+val).hide();
                 
                }   
                if(val==10)
                {
                    $("#edu_report_no_"+val).hide();
                 
                }  










           

            $.ajax({
              
             url:base_url+'index.php/admin_prescription/edu_report_file_box_show',
             data:{num:val},
             dataType: "html",
             type: "POST",
             success: function(data){

              
              $("#add_more_edu_report_no_"+id).html(data);
              $("#add_more_edu_report_no_"+id).show();
             
              

                 
                
              }
             });*/

    }


 function edu_report_hiding_out(val)
    {
        
          //var current_div=val-1; 

        //  alert(val);
        //  alert(current_div);


         /* alert(val);
          alert(current_div);*/         
         /* $("#add_more_edu_report_no_"+val).html('');
          $("#add_more_edu_report_no_"+current_div).hide();
        
           $("#edu_report_no_"+current_div).show();
          $("#report_minus").show();*/

                                                               if(val==1)
                                                                      {
                                                                      }
           // var base_url='<?php echo base_url(); ?>';

                                                                if(val==2)
                                                                { 

                                                                  $("#add_more_edu_report_no_1").css('display','none');    
                                                               
                                                                  $("#edu_report_no_1").show();
                                                                  $("#minus").show();
                                                                
                                                                }
                                                                if(val==3)
                                                                { 

                                                                    $("#add_more_edu_report_no_2").css('display','none');    
                                                               
                                                                  $("#edu_report_no_2").show();
                                                                  $("#minus").show();
                                                                
                                                                }
                                                                if(val==4)
                                                                { 

                                                                    $("#add_more_edu_report_no_3").css('display','none');    
                                                               
                                                                  $("#edu_report_no_3").show();
                                                                  $("#minus").show();
                                                                
                                                                }
                                                                if(val==5)
                                                                { 
                                                                $("#add_more_edu_report_no_4").css('display','none');    
                                                               
                                                                  $("#edu_report_no_4").show();
                                                                  $("#minus").show();
                                                                
                                                                  
                                                                
                                                                }
                                                                 if(val==6)
                                                                { 

                                                                  $("#add_more_edu_report_no_5").css('display','none');    
                                                               
                                                                  $("#edu_report_no_5").show();
                                                                  $("#minus").show();
                                                                  
                                                                
                                                                }
                                                                 if(val==7)
                                                                { 

                                                                  $("#add_more_edu_report_no_6").css('display','none');    
                                                               
                                                                  $("#edu_report_no_6").show();
                                                                  $("#minus").show();
                                                                  
                                                                
                                                                }

                                                                if(val==8)
                                                                { 

                                                                 $("#add_more_edu_report_no_7").css('display','none');    
                                                               
                                                                  $("#edu_report_no_7").show();
                                                                  $("#minus").show();
                                                                  
                                                                
                                                                }

                                                                  if(val==9)
                                                                { 

                                                                   $("#add_more_edu_report_no_8").css('display','none');    
                                                               
                                                                  $("#edu_report_no_8").show();
                                                                  $("#minus").show();
                                                                  
                                                                
                                                                }

                                                                 if(val==10)
                                                                { 

                                                                 $("#add_more_edu_report_no_9").css('display','none');    
                                                               
                                                                  $("#edu_report_no_9").show();
                                                                  $("#minus").show();
                                                                  
                                                                
                                                                }

      
    }
  </script>









        

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
        <!--  <section class="content">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <div class="box section_p">
                  
                    <div class="clearfix"></div>
                  
                    <div class="box-body new_box">
                        <div class="tab-content">
                            <div id="vital_info" >
                                      <div class="form-group frm-diff new_desin_mediam Investigation_name">
                                            <label for="product_name" class=" control-label">Investigation Name</label>
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
                                        
                                     

                                  

                                          
                                                 <div class="form-group frm-diff new_desin_diagnosis Diagnosis">
                                             <label for="product_name" class=" control-label">Diagnosis</label>
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
                                
                </div>
            </div>
       
        </div>
      
    </section>
 -->










































































     <section class="content advice-main-p-cus-section">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <div class="box ">
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


  <div class="disease-firts-section-p-cus">
                              <div class="form-group frm-diff new_desin">
                                         <label for="product_name" class=" control-label">Disease</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select2" name="group[]" onchange="get_med(this.value,1)" id="group_1"  required="">
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
<div class="form-group frm-diff disease-medi-p-cus new_desin_mediam Disease_Medicine">
  <label for="product_name" class=" control-label">Disease Medicine</label>
  <div class="col-sm-8" >
  <div class="processing_cont" id="get_des_med_1" style="min-height: 1px;overflow-y:scroll;max-height: 200px;" >
  </div>
    </div>
                                       

                                           <a href="javacript:void(0)"  id="edu_no_1" onclick="edu_produce_file_box('1')" class="btn btn-primary first-deiseas-section"><b>+</b></a>

                                        </div>
                                      </div>















                                       
<div class="diseas-loop-section-p-cus">
     <div id="edu_add_1" style="display: none;">
                                                   <div class="form-group frm-diff new_desin">
                                         <label for="product_name" class="control-label">Disease</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select2" name="group[]" onchange="get_med(this.value,2)" id="group_2"  required="">
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
                                 
                                        <div class="form-group frm-diff disease-medi-p-cus new_desin_mediam Disease_Medicine">
                                         <label for="product_name" class="control-label">Disease Medicine</label>
                                          <div class="col-sm-8">

                                           <div class="processing_cont" id="get_des_med_2" style="min-height: 1px;overflow-y:scroll;max-height: 200px;">
 </div>
 </div>
 </div>
<div class="advice-section-btn-plus-p-cus">
         <div class="medi-p-cus-btn-right">
        <td>
    <a href="javacript:void(0)"  id="edu_no_2" onclick="edu_produce_file_box(2)" class="btn btn-primary"><b>+</b></a>
        </td>
        <td>
    <a href="javacript:void(0)" class="btn btn-primary p-cus-min" id="minus" onclick="edu_hiding_out(2);"><b>-</b></a></td>
       </div>
      </div>
 </div>
                   </div>














<div class="diseas-loop-section-p-cus">
<div id="edu_add_2" style="display: none;">
                                                   <div class="form-group frm-diff new_desin">
                                         <label for="product_name" class="control-label">Disease</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select2" name="group[]" onchange="get_med(this.value,3)" id="group_3"  required="">
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
                                 
                                        <div class="form-group frm-diff disease-medi-p-cus new_desin_mediam Disease_Medicine">
                                         <label for="product_name" class="control-label">Disease Medicine</label>
                                          <div class="col-sm-8">

                                           <div class="processing_cont" id="get_des_med_3" style="min-height: 1px;overflow-y:scroll;max-height: 200px;">

                                        
                    
            


                    </div>

                    </div>



                    </div>

                      <div class="advice-section-btn-plus-p-cus">
                                            <div class="medi-p-cus-btn-right">
                                                <td>
                                                    <a href="javacript:void(0)"  id="edu_no_3" onclick="edu_produce_file_box(3)" class="btn btn-primary"><b>+</b></a>
                                                </td>
                                                <td>
                                                    <a href="javacript:void(0)" class="btn btn-primary p-cus-min" id="minus" onclick="edu_hiding_out(3);"><b>-</b></a></td>
                                             
                                           
                                        </div>
                                </div>

                     </div>
  </div>




<div class="diseas-loop-section-p-cus">
<div id="edu_add_3" style="display: none;">
                                                   <div class="form-group frm-diff new_desin">
                                         <label for="product_name" class="control-label">Disease</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select2" name="group[]" onchange="get_med(this.value,4)" id="group_4"  required="">
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
                                 
                                        <div class="form-group frm-diff disease-medi-p-cus new_desin_mediam Disease_Medicine">
                                         <label for="product_name" class="control-label">Disease Medicine</label>
                                          <div class="col-sm-8">

                                           <div class="processing_cont" id="get_des_med_4" style="min-height: 1px;overflow-y:scroll;max-height: 200px;">
 </div>
</div>
</div>
<div class="advice-section-btn-plus-p-cus">
  <div class="medi-p-cus-btn-right">
    <td>
  <a href="javacript:void(0)"  id="edu_no_4" onclick="edu_produce_file_box(4)" class="btn btn-primary"><b>+</b></a>
    </td>
     <td>
  <a href="javacript:void(0)" class="btn btn-primary p-cus-min" id="minus" onclick="edu_hiding_out(4);"><b>-</b></a></td>
                                             
                                           
  </div>
  </div>
</div>
  </div>







<div class="diseas-loop-section-p-cus">
<div id="edu_add_4" style="display: none;">
     <div class="form-group frm-diff new_desin">
      <label for="product_name" class="control-label">Disease</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select2" name="group[]" onchange="get_med(this.value,5)" id="group_5"  required="">
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
                                 
                                        <div class="form-group frm-diff disease-medi-p-cus new_desin_mediam Disease_Medicine">
                                         <label for="product_name" class="control-label">Disease Medicine</label>
                                          <div class="col-sm-8">

                                           <div class="processing_cont" id="get_des_med_5" style="min-height: 1px;overflow-y:scroll;max-height: 200px;">

                                        
                    
            


                    </div>

                    </div>



                    </div>

                      <div class="advice-section-btn-plus-p-cus">
                                            <div class="medi-p-cus-btn-right">
                                                <td>
                                                    <a href="javacript:void(0)"  id="edu_no_5" onclick="edu_produce_file_box(5)" class="btn btn-primary"><b>+</b></a>
                                                </td>
                                                <td>
                                                    <a href="javacript:void(0)" class="btn btn-primary p-cus-min" id="minus" onclick="edu_hiding_out(5);"><b>-</b></a></td>
                                             
                                           
                                        </div>
                                </div>

                     </div>
</div>










<div class="diseas-loop-section-p-cus">
<div id="edu_add_5" style="display: none;">
                                                   <div class="form-group frm-diff new_desin">
                                         <label for="product_name" class="control-label">Disease</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select2" name="group[]" onchange="get_med(this.value,6)" id="group_6"  required="">
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
                                 
                                        <div class="form-group frm-diff disease-medi-p-cus new_desin_mediam Disease_Medicine">
                                         <label for="product_name" class="control-label">Disease Medicine</label>
                                          <div class="col-sm-8">

                                           <div class="processing_cont" id="get_des_med_6" style="min-height: 1px;overflow-y:scroll;max-height: 200px;">

                                        
                    
            


                    </div>

                    </div>



                    </div>

                      <div class="advice-section-btn-plus-p-cus">
                                            <div class="medi-p-cus-btn-right">
                                                <td>
                                                    <a href="javacript:void(0)"  id="edu_no_6" onclick="edu_produce_file_box(6)" class="btn btn-primary"><b>+</b></a>
                                                </td>
                                                <td>
                                                    <a href="javacript:void(0)" class="btn btn-primary p-cus-min" id="minus" onclick="edu_hiding_out(6);"><b>-</b></a></td>
                                             
                                           
                                        </div>
                                </div>

                     </div>
                   </div>










<div class="diseas-loop-section-p-cus">                                            
<div id="edu_add_6" style="display: none;">
                                                   <div class="form-group frm-diff new_desin">
                                         <label for="product_name" class="control-label">Disease</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select2" name="group[]" onchange="get_med(this.value,7)" id="group_7"  required="">
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
                                 
                                        <div class="form-group frm-diff disease-medi-p-cus new_desin_mediam Disease_Medicine">
                                         <label for="product_name" class="control-label">Disease Medicine</label>
                                          <div class="col-sm-8">

                                           <div class="processing_cont" id="get_des_med_7" style="min-height: 1px;overflow-y:scroll;max-height: 200px;">

                                        
                    
            


                    </div>

                    </div>



                    </div>

                      <div class="advice-section-btn-plus-p-cus">
                                            <div class="medi-p-cus-btn-right">
                                                <td>
                                                    <a href="javacript:void(0)"  id="edu_no_7" onclick="edu_produce_file_box(7)" class="btn btn-primary"><b>+</b></a>
                                                </td>
                                                <td>
                                                    <a href="javacript:void(0)" class="btn btn-primary p-cus-min" id="minus" onclick="edu_hiding_out(7);"><b>-</b></a></td>
                                             
                                           
                                        </div>
                                </div>

                     </div>
                   </div>







<div class="diseas-loop-section-p-cus">
<div id="edu_add_7" style="display: none;">
                                                   <div class="form-group frm-diff new_desin">
                                         <label for="product_name" class="control-label">Disease</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select2" name="group[]" onchange="get_med(this.value,8)" id="group_8"  required="">
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
                                 
                                        <div class="form-group frm-diff disease-medi-p-cus new_desin_mediam Disease_Medicine">
                                         <label for="product_name" class="control-label">Disease Medicine</label>
                                          <div class="col-sm-8">

                                           <div class="processing_cont" id="get_des_med_8" style="min-height: 1px;overflow-y:scroll;max-height: 200px;">

                                        
                    
            


                    </div>

                    </div>



                    </div>

                      <div class="advice-section-btn-plus-p-cus">
                                            <div class="medi-p-cus-btn-right">
                                                <td>
                                                    <a href="javacript:void(0)"  id="edu_no_8" onclick="edu_produce_file_box(8)" class="btn btn-primary"><b>+</b></a>
                                                </td>
                                                <td>
                                                    <a href="javacript:void(0)" class="btn btn-primary p-cus-min" id="minus" onclick="edu_hiding_out(8);"><b>-</b></a></td>
                                             
                                           
                                        </div>
                                </div>

                     </div>
                   </div>













<div class="diseas-loop-section-p-cus">
<div id="edu_add_8" style="display: none;">
                                                   <div class="form-group frm-diff new_desin">
                                         <label for="product_name" class="control-label">Disease</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select2" name="group[]" onchange="get_med(this.value,9)" id="group_9"  required="">
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
                                 
                                        <div class="form-group frm-diff disease-medi-p-cus new_desin_mediam Disease_Medicine">
                                         <label for="product_name" class="control-label">Disease Medicine</label>
                                          <div class="col-sm-8">

                                           <div class="processing_cont" id="get_des_med_9" style="min-height: 1px;overflow-y:scroll;max-height: 200px;">

                                        
                    
            


                    </div>

                    </div>



                    </div>

                      <div class="advice-section-btn-plus-p-cus">
                                            <div class="medi-p-cus-btn-right">
                                                <td>
                                                    <a href="javacript:void(0)"  id="edu_no_9" onclick="edu_produce_file_box(9)" class="btn btn-primary"><b>+</b></a>
                                                </td>
                                                <td>
                                                    <a href="javacript:void(0)" class="btn btn-primary p-cus-min" id="minus" onclick="edu_hiding_out(9);"><b>-</b></a></td>
                                             
                                           
                                        </div>
                                </div>

                     </div>
                   </div>











<div class="diseas-loop-section-p-cus">
<div id="edu_add_9" style="display: none;">
                                                   <div class="form-group frm-diff new_desin">
                                         <label for="product_name" class="control-label">Disease</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select2" name="group[]" onchange="get_med(this.value,10)" id="group_10"  required="">
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
                                 
                                        <div class="form-group frm-diff disease-medi-p-cus new_desin_mediam Disease_Medicine">
                                         <label for="product_name" class="control-label">Disease Medicine</label>
                                          <div class="col-sm-8">

                                           <div class="processing_cont" id="get_des_med_10" style="min-height: 1px;overflow-y:scroll;max-height: 200px;">

                                        
                    
            


                    </div>

                    </div>



                    </div>

                      <div class="advice-section-btn-plus-p-cus">
                                            <div class="medi-p-cus-btn-right">
                                                <td>
                                                    <a href="javacript:void(0)"  id="edu_no_10" onclick="edu_produce_file_box(10)" class="btn btn-primary"><b>+</b></a>
                                                </td>
                                                <td>
                                                    <a href="javacript:void(0)" class="btn btn-primary p-cus-min" id="minus" onclick="edu_hiding_out(10);"><b>-</b></a></td>
                                             
                                           
                                        </div>
                                </div>

                     </div>
                   </div>















                                            <div id="edu_add_10"></div> 
                                          </div>



<script >
    
    function edu_produce_file_box(id)
    {
      // alert(id);
         
        var val=id;
            
            if(val==1)
                {
                    $("#edu_add_1").show();
                     $("#edu_no_1").hide();
                      $("#minus").show();
                }

                 if(val==2)
                {
                    $("#edu_add_2").show();
                     $("#edu_no_1").hide();
                      $("#edu_no_2").hide();
                      $("#minus").show();
                }

                if(val==3)
                {
                    $("#edu_add_3").show();
                     $("#edu_no_1").hide();
                      $("#edu_no_2").hide();
                       $("#edu_no_3").hide();
                      $("#minus").show();
                }

                 if(val==4)
                {
                    $("#edu_add_4").show();
                     $("#edu_no_1").hide();
                      $("#edu_no_2").hide();
                       $("#edu_no_3").hide();
                       $("#edu_no_4").hide();
                      $("#minus").show();
                }

                if(val==5)
                {
                    $("#edu_add_5").show();
                     $("#edu_no_1").hide();
                      $("#edu_no_2").hide();
                       $("#edu_no_3").hide();
                       $("#edu_no_4").hide();
                       $("#edu_no_5").hide();
                      $("#minus").show();
                }

                 if(val==6)
                {
                    $("#edu_add_6").show();
                     $("#edu_no_1").hide();
                      $("#edu_no_2").hide();
                       $("#edu_no_3").hide();
                       $("#edu_no_4").hide();
                       $("#edu_no_5").hide();
                       $("#edu_no_6").hide();
                      $("#minus").show();
                }

                if(val==7)
                {
                    $("#edu_add_7").show();
                     $("#edu_no_1").hide();
                      $("#edu_no_2").hide();
                       $("#edu_no_3").hide();
                       $("#edu_no_4").hide();
                       $("#edu_no_5").hide();
                       $("#edu_no_6").hide();
                       $("#edu_no_7").hide();
                      $("#minus").show();
                }

                if(val==8)
                {
                    $("#edu_add_8").show();
                     $("#edu_no_1").hide();
                      $("#edu_no_2").hide();
                       $("#edu_no_3").hide();
                       $("#edu_no_4").hide();
                       $("#edu_no_5").hide();
                       $("#edu_no_6").hide();
                       $("#edu_no_7").hide();
                       $("#edu_no_8").hide();
                      $("#minus").show();
                }

                if(val==9)
                {
                    $("#edu_add_9").show();
                     $("#edu_no_1").hide();
                      $("#edu_no_2").hide();
                       $("#edu_no_3").hide();
                       $("#edu_no_4").hide();
                       $("#edu_no_5").hide();
                       $("#edu_no_6").hide();
                       $("#edu_no_7").hide();
                       $("#edu_no_8").hide();
                        $("#edu_no_9").hide();
                      $("#minus").show();
                }
            //var base_url='<?php echo base_url(); ?>';
            
      /*      if(val==2)
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
             });*/

    }


 function edu_hiding_out(val)
    {
        
         // var current_div=val-1; 
         /* alert(val);
          alert(current_div);*/         
         /* $("#edu_add_"+val).html('');
          $("#edu_add_"+current_div).hide();
          $("#edu_no_"+current_div).show();
          $("#minus").show();*/

                                                          if(val==1)
                                                                      {
                                                                      }
           // var base_url='<?php echo base_url(); ?>';

                                                                if(val==2)
                                                                { 

                                                                  $("#edu_add_1").css('display','none');    
                                                               
                                                                  $("#edu_no_1").show();
                                                                  $("#minus").show();
                                                                
                                                                }
                                                                if(val==3)
                                                                { 

                                                                   $("#edu_add_2").css('display','none');    
                                                               
                                                                  $("#edu_no_2").show();
                                                                  $("#minus").show();
                                                                
                                                                }
                                                                if(val==4)
                                                                { 
                                                                  $("#edu_add_3").css('display','none');    
                                                               
                                                                  $("#edu_no_3").show();
                                                                  $("#minus").show();
                                                                
                                                                }
                                                                if(val==5)
                                                                { 
                                                               $("#edu_add_4").css('display','none');    
                                                               
                                                                  $("#edu_no_4").show();
                                                                  $("#minus").show();
                                                                
                                                                  
                                                                
                                                                }
                                                                 if(val==6)
                                                                { 

                                                                 $("#edu_add_5").css('display','none');    
                                                               
                                                                  $("#edu_no_5").show();
                                                                  $("#minus").show();
                                                                  
                                                                
                                                                }
                                                                 if(val==7)
                                                                { 

                                                                 $("#edu_add_6").css('display','none');    
                                                               
                                                                  $("#edu_no_6").show();
                                                                  $("#minus").show();
                                                                  
                                                                
                                                                }

                                                                if(val==8)
                                                                { 

                                                                $("#edu_add_7").css('display','none');    
                                                               
                                                                  $("#edu_no_7").show();
                                                                  $("#minus").show();
                                                                  
                                                                
                                                                }

                                                                  if(val==9)
                                                                { 

                                                                  $("#edu_add_8").css('display','none');    
                                                               
                                                                  $("#edu_no_8").show();
                                                                  $("#minus").show();
                                                                
                                                                }

                                                                 if(val==10)
                                                                { 

                                                                $("#edu_add_9").css('display','none');    
                                                               
                                                                  $("#edu_no_9").show();
                                                                  $("#minus").show();
                                                                  
                                                                
                                                                }

      
    }
  </script>





<div class="only-first-medicine-name-class">
<div class="all-medi-first-section-all">
  <div class="p-cus-medicine-name-all-width new_a">
  <div class="form-group frm-diff medi-p-cus-se new_desin_mediam Medicine_Name">
     <label for="product_name" class=" control-label">Medicine Name</label>
  <div class="col-sm-8">
   
<select  class="form-control select2"   name="my_medicine[]" id="my_medicine_0"  required="">
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

<div class="form-group frm-diff p-cus-medi-cus-all-days new_desin_day Medicine_Days">
    <label for="product_name" class=" control-label">Days</label>
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
</select>
  </div>
</div>

<a href="javacript:void(0)"  id="edu_nomed_1" onclick="edu_produce_file_box_my_med('1')" class="btn btn-primary plus-section-medicine"><b>+</b></a>

  </div>
</div>
</div>



















<div class="clearfix"></div>
<div class="box-footer">
</div>
<div class="p-cus-medicine-name-all-width new_a"  id="edu_my_med_1" style="display: none;">
<div class="form-group frm-diff medi-p-cus-se new_desin_mediam Medicine_Name">
 <label for="product_name" class=" control-label">Medicine Name</label>
   <div class="col-sm-8">
<select  class="form-control select2"   name="my_medicine[]" id="my_medicine_0"  required="">
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
<div class="form-group frm-diff p-cus-medi-cus-all-days new_desin_day Medicine_Days">
  <label for="product_name" class=" control-label">Days</label>
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
                      
                                             
                                                </select>
                                            </div>
                                        </div>

                                        
                                                 <a href="javacript:void(0)"  id="edu_nomed_2" onclick="edu_produce_file_box_my_med(2)" class="btn btn-primary positive"><b>+</b></a><br>
                                               
                                                <a href="javacript:void(0)" class="btn btn-primary min-p-ico" id="minus" onclick="edu_hiding_out_my_med(2);"><b>-</b></a>

                                          <style type="text/css">
                                          .btn.btn-primary.positive {
    top: -8px !important;
    padding: 0 10px !important;
}
.p-cus-medicine-name-all-width a.btn.btn-primary {
    top: 17px;}</style>

                                                </div>

                                                   <div class="p-cus-medicine-name-all-width new_a"  id="edu_my_med_2" style="display: none;">
                                        <div class="form-group frm-diff medi-p-cus-se new_desin_mediam Medicine_Name">
                                         <label for="product_name" class=" control-label">Medicine Name</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select2"   name="my_medicine[]" id="my_medicine_0"  required="">
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

                                          <div class="form-group frm-diff p-cus-medi-cus-all-days new_desin_day Medicine_Days">
                                            <label for="product_name" class=" control-label">Days</label>
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
                      
                                             
                                                </select>
                                            </div>
                                        </div>

                                        
                                                 <a href="javacript:void(0)"  id="edu_nomed_3" onclick="edu_produce_file_box_my_med(3)" class="btn btn-primary positive"><b>+</b></a><br>
                                               
                                                <a href="javacript:void(0)" class="btn btn-primary min-p-ico" id="minus" onclick="edu_hiding_out_my_med(3);"><b>-</b></a>

                                        

                                                </div>



                                                   <div class="p-cus-medicine-name-all-width new_a"  id="edu_my_med_3" style="display: none;">
                                        <div class="form-group frm-diff medi-p-cus-se new_desin_mediam Medicine_Name">
                                         <label for="product_name" class=" control-label">Medicine Name</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select2"   name="my_medicine[]" id="my_medicine_0"  required="">
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

                                          <div class="form-group frm-diff p-cus-medi-cus-all-days new_desin_day Medicine_Days">
                                            <label for="product_name" class=" control-label">Days</label>
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
                      
                                             
                                                </select>
                                            </div>
                                        </div>

                                        
                                                 <a href="javacript:void(0)"  id="edu_nomed_4" onclick="edu_produce_file_box_my_med(4)" class="btn btn-primary positive"><b>+</b></a><br>
                                               
                                                <a href="javacript:void(0)" class="btn btn-primary min-p-ico" id="minus" onclick="edu_hiding_out_my_med(4);"><b>-</b></a>

                                        

                                                </div>




                                                  <div class="p-cus-medicine-name-all-width new_a"  id="edu_my_med_4" style="display: none;">
                                        <div class="form-group frm-diff medi-p-cus-se new_desin_mediam Medicine_Name">
                                         <label for="product_name" class=" control-label">Medicine Name</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select2"   name="my_medicine[]" id="my_medicine_0"  required="">
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

                                          <div class="form-group frm-diff p-cus-medi-cus-all-days new_desin_day Medicine_Days">
                                            <label for="product_name" class=" control-label">Days</label>
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
                      
                                             
                                                </select>
                                            </div>
                                        </div>

                                        
                                                 <a href="javacript:void(0)"  id="edu_nomed_5" onclick="edu_produce_file_box_my_med(5)" class="btn btn-primary positive"><b>+</b></a><br>
                                               
                                                <a href="javacript:void(0)" class="btn btn-primary min-p-ico" id="minus" onclick="edu_hiding_out_my_med(5);"><b>-</b></a>

                                        

                                                </div>



                                                  <div class="p-cus-medicine-name-all-width new_a"  id="edu_my_med_5" style="display: none;">
                                        <div class="form-group frm-diff medi-p-cus-se new_desin_mediam Medicine_Name">
                                         <label for="product_name" class=" control-label">Medicine Name</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select2"   name="my_medicine[]" id="my_medicine_0"  required="">
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

                                          <div class="form-group frm-diff p-cus-medi-cus-all-days new_desin_day Medicine_Days">
                                            <label for="product_name" class=" control-label">Days</label>
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
                      
                                             
                                                </select>
                                            </div>
                                        </div>

                                        
                                                 <a href="javacript:void(0)"  id="edu_nomed_6" onclick="edu_produce_file_box_my_med(6)" class="btn btn-primary positive"><b>+</b></a><br>
                                               
                                                <a href="javacript:void(0)" class="btn btn-primary min-p-ico" id="minus" onclick="edu_hiding_out_my_med(6);"><b>-</b></a>

                                        

                                                </div>


                                                   <div class="p-cus-medicine-name-all-width new_a"  id="edu_my_med_6" style="display: none;">
                                        <div class="form-group frm-diff medi-p-cus-se new_desin_mediam Medicine_Name">
                                         <label for="product_name" class=" control-label">Medicine Name</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select2"   name="my_medicine[]" id="my_medicine_0"  required="">
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

                                          <div class="form-group frm-diff p-cus-medi-cus-all-days new_desin_day Medicine_Days">
                                            <label for="product_name" class=" control-label">Days</label>
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
                      
                                             
                                                </select>
                                            </div>
                                        </div>

                                        
                                                 <a href="javacript:void(0)"  id="edu_nomed_7" onclick="edu_produce_file_box_my_med(7)" class="btn btn-primary positive"><b>+</b></a><br>
                                               
                                                <a href="javacript:void(0)" class="btn btn-primary min-p-ico" id="minus" onclick="edu_hiding_out_my_med(7);"><b>-</b></a>

                                        

                                                </div>



                                                           <div class="p-cus-medicine-name-all-width new_a"  id="edu_my_med_7" style="display: none;">
                                        <div class="form-group frm-diff medi-p-cus-se new_desin_mediam Medicine_Name">
                                         <label for="product_name" class=" control-label">Medicine Name</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select2"   name="my_medicine[]" id="my_medicine_0"  required="">
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

                                          <div class="form-group frm-diff p-cus-medi-cus-all-days new_desin_day Medicine_Days">
                                            <label for="product_name" class=" control-label">Days</label>
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
                      
                                             
                                                </select>
                                            </div>
                                        </div>

                                        
                                                 <a href="javacript:void(0)"  id="edu_nomed_8" onclick="edu_produce_file_box_my_med(8)" class="btn btn-primary positive"><b>+</b></a><br>
                                               
                                                <a href="javacript:void(0)" class="btn btn-primary min-p-ico" id="minus" onclick="edu_hiding_out_my_med(8);"><b>-</b></a>

                                        

                                                </div>


                                                 <div class="p-cus-medicine-name-all-width new_a"  id="edu_my_med_8" style="display: none;">
                                        <div class="form-group frm-diff medi-p-cus-se new_desin_mediam Medicine_Name">
                                         <label for="product_name" class=" control-label">Medicine Name</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select2"   name="my_medicine[]" id="my_medicine_0"  required="">
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

                                          <div class="form-group frm-diff p-cus-medi-cus-all-days new_desin_day Medicine_Days">
                                            <label for="product_name" class=" control-label">Days</label>
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
                      
                                             
                                                </select>
                                            </div>
                                        </div>

                                        
                                                 <a href="javacript:void(0)"  id="edu_nomed_9" onclick="edu_produce_file_box_my_med(9)" class="btn btn-primary positive"><b>+</b></a><br>
                                               
                                                <a href="javacript:void(0)" class="btn btn-primary min-p-ico" id="minus" onclick="edu_hiding_out_my_med(9);"><b>-</b></a>

                                        

                                                </div>


                                                 <div class="p-cus-medicine-name-all-width new_a"  id="edu_my_med_9" style="display: none;">
                                        <div class="form-group frm-diff medi-p-cus-se new_desin_mediam Medicine_Name">
                                         <label for="product_name" class=" control-label">Medicine Name</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select2"   name="my_medicine[]" id="my_medicine_0"  required="">
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

                                          <div class="form-group frm-diff p-cus-medi-cus-all-days new_desin_day Medicine_Days">
                                            <label for="product_name" class=" control-label">Days</label>
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
                      
                                             
                                                </select>
                                            </div>
                                        </div>

                                        
                                                 <a href="javacript:void(0)"  id="edu_nomed_10" onclick="edu_produce_file_box_my_med(10)" class="btn btn-primary positive"><b>+</b></a><br>
                                               
                                                <a href="javacript:void(0)" class="btn btn-primary min-p-ico" id="minus" onclick="edu_hiding_out_my_med(10);"><b>-</b></a>

                                        

                                                </div>
                                         
                                         
                                         
                                         
                                         
                                         
                                          

                                            
                                         <!--   <div id="edu_my_med_2"></div>
                                           <div id="edu_my_med_3"></div>
                                           <div id="edu_my_med_4"></div>
                                            <div id="edu_my_med_5"></div> 

                                             <div id="edu_my_med_6"></div>
                                           <div id="edu_my_med_7"></div>
                                           <div id="edu_my_med_8"></div>
                                           <div id="edu_my_med_9"></div>
                                            <div id="edu_my_med_10"></div> 
 -->

                                            <script type="text/javascript">
                                              function edu_produce_file_box_my_med(id)
                                              {

                                                 var val=id;
                                                            
                                                            if(val==1)
                                                                { 

                                                                $("#edu_my_med_1").css('display','block');    
                                                                $("#edu_nomed_1").hide();
                                                                $("#minus").show();
                                                                
                                                                }

                                                                if(val==2)
                                                                { 

                                                                $("#edu_my_med_2").css('display','block');    
                                                                $("#edu_nomed_1").hide();
                                                                $("#edu_nomed_2").hide();
                                                                $("#minus").show();
                                                                
                                                                }

                                                                if(val==3)
                                                                { 

                                                                $("#edu_my_med_3").css('display','block');    
                                                                $("#edu_nomed_1").hide();
                                                                $("#edu_nomed_2").hide();
                                                                $("#edu_nomed_3").hide();
                                                                $("#minus").show();
                                                                
                                                                }

                                                                 if(val==4)
                                                                { 

                                                                $("#edu_my_med_4").css('display','block');    
                                                                $("#edu_nomed_1").hide();
                                                                $("#edu_nomed_2").hide();
                                                                $("#edu_nomed_3").hide();
                                                                $("#edu_nomed_4").hide();
                                                                $("#minus").show();
                                                                
                                                                }

                                                                 if(val==5)
                                                                { 

                                                                $("#edu_my_med_5").css('display','block');    
                                                                $("#edu_nomed_1").hide();
                                                                $("#edu_nomed_2").hide();
                                                                $("#edu_nomed_3").hide();
                                                                $("#edu_nomed_4").hide();
                                                                 $("#edu_nomed_5").hide();
                                                                $("#minus").show();
                                                                
                                                                }

                                                                if(val==6)
                                                                { 

                                                                $("#edu_my_med_6").css('display','block');    
                                                                $("#edu_nomed_1").hide();
                                                                $("#edu_nomed_2").hide();
                                                                $("#edu_nomed_3").hide();
                                                                $("#edu_nomed_4").hide();
                                                                $("#edu_nomed_5").hide();

                                                                $("#edu_nomed_6").hide();
                                                                $("#minus").show();
                                                                
                                                                }

                                                                if(val==7)
                                                                { 

                                                                $("#edu_my_med_7").css('display','block');    
                                                                $("#edu_nomed_1").hide();
                                                                $("#edu_nomed_2").hide();
                                                                $("#edu_nomed_3").hide();
                                                                $("#edu_nomed_4").hide();
                                                                $("#edu_nomed_5").hide();

                                                                $("#edu_nomed_6").hide();
                                                                $("#edu_nomed_7").hide();
                                                                $("#minus").show();
                                                                
                                                                }

                                                                 if(val==8)
                                                                { 

                                                                $("#edu_my_med_8").css('display','block');    
                                                                $("#edu_nomed_1").hide();
                                                                $("#edu_nomed_2").hide();
                                                                $("#edu_nomed_3").hide();
                                                                $("#edu_nomed_4").hide();
                                                                $("#edu_nomed_5").hide();

                                                                $("#edu_nomed_6").hide();
                                                                $("#edu_nomed_7").hide();
                                                                $("#edu_nomed_8").hide();
                                                                $("#minus").show();
                                                                
                                                                }

                                                                if(val==9)
                                                                { 

                                                                $("#edu_my_med_9").css('display','block');    
                                                                $("#edu_nomed_1").hide();
                                                                $("#edu_nomed_2").hide();
                                                                $("#edu_nomed_3").hide();
                                                                $("#edu_nomed_4").hide();
                                                                $("#edu_nomed_5").hide();

                                                                $("#edu_nomed_6").hide();
                                                                $("#edu_nomed_7").hide();
                                                                $("#edu_nomed_8").hide();
                                                                $("#edu_nomed_9").hide();
                                                                $("#minus").show();
                                                                
                                                                }
                                                          /*  var base_url='<?php echo base_url(); ?>';
                                                            
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
                                                             });*/

                                                    }


                                                 function edu_hiding_out_my_med(val)
                                                    {
                                                        
                                                          //var current_div=val-1; 
                                                         /* alert(val);
                                                          alert(current_div);*/         
                                                         /* $("#edu_my_med_"+val).html('');
                                                          $("#edu_my_med_"+current_div).hide();
                                                          $("#edu_nomed_"+current_div).show();
                                                          $("#minus").show();


*/
                                                        if(val==1)
                                                                      {
                                                                      }
           // var base_url='<?php echo base_url(); ?>';

                                                                if(val==2)
                                                                { 

                                                                  $("#edu_my_med_1").css('display','none');    
                                                               
                                                                  $("#edu_nomed_1").show();
                                                                  $("#minus").show();
                                                                
                                                                }
                                                                if(val==3)
                                                                { 

                                                                $("#edu_my_med_2").css('display','none');    
                                                               
                                                                  $("#edu_nomed_2").show();
                                                                  $("#minus").show();
                                                                
                                                                }
                                                                if(val==4)
                                                                { 

                                                                  $("#edu_my_med_3").css('display','none');    
                                                               
                                                                  $("#edu_nomed_3").show();
                                                                  $("#minus").show();
                                                                
                                                                }
                                                                if(val==5)
                                                                { 

                                                                 $("#edu_my_med_4").css('display','none');    
                                                               
                                                                  $("#edu_nomed_4").show();
                                                                  $("#minus").show();
                                                                  
                                                                
                                                                }
                                                                 if(val==6)
                                                                { 

                                                                $("#edu_my_med_5").css('display','none');    
                                                               
                                                                  $("#edu_nomed_5").show();
                                                                  $("#minus").show();
                                                                  
                                                                
                                                                }
                                                                 if(val==7)
                                                                { 

                                                                  $("#edu_my_med_6").css('display','none');    
                                                               
                                                                  $("#edu_nomed_6").show();
                                                                  $("#minus").show();
                                                                  
                                                                
                                                                }

                                                                if(val==8)
                                                                { 

                                                                  $("#edu_my_med_7").css('display','none');    
                                                               
                                                                  $("#edu_nomed_7").show();
                                                                  $("#minus").show();
                                                                
                                                                }

                                                                  if(val==9)
                                                                { 

                                                                  $("#edu_my_med_8").css('display','none');    
                                                               
                                                                  $("#edu_nomed_8").show();
                                                                  $("#minus").show();
                                                                  
                                                                
                                                                }

                                                                 if(val==10)
                                                                { 

                                                                  $("#edu_my_med_9").css('display','none');    
                                                               
                                                                  $("#edu_nomed_9").show();
                                                                  $("#minus").show();
                                                                  
                                                                
                                                                }
                                                       }

                                              
                                            </script>


                                              <div class="form-group frm-diff new_desin">
                                            <label for="product_name" class=" control-label">Diet Name</label>
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
                                       

                                           <div class="form-group frm-diff new_desin Councelling_Name">
                                            
                                            <div class="col-sm-12">
                                              <label for="product_name" class=" control-label councilling-label">Councelling Name</label>
                                            <div id="div_councel" class="councilling-name-text">
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

                                                 <div class="form-group new_desin_day Review">
                                            <label for="product_name" class=" control-label">Review</label>
                                            <div class="col-sm-8">

                                            <select  class="form-control" name="feedback" id="feedback"  required="">
                                                <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
                                                ?>

                                                    <option value="">--Select Days--</option>

                                                     <option value="sos">SOS</option>
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




                                  <div class="box-footer" style="margin-top: 10px;float: right;margin-right: 0%;" >
                                    
                                    <button type="button"  class="btn btn-info" onclick="valid_doc_form()" style="margin-left:12px" id="butt1"> Submit </button>

                                     <button type="button" id="butt2" style="display: none;" class="btn btn-info" disabled="">Submit</button>
                                </div> 
                            
                                 <div class="box-footer" style="margin-top: 10px;">
                                    
                                    <a href="<?php echo base_url();?>index.php/admin_prescription"  class="btn btn-danger" style="margin-left:12px"> Back </a>
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
   <input type="hidden" name="my_purpose_processing" id="my_purpose_processing">
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

                   //node +='<option value="'+data[i].medicine_id+'">'+data[i].medicine_name+' </option>';

                   node +='<div   class="col-md-12 processing_cont_form"><div class="col-md-12 loop"><div class="col-xs-1"><input type="checkbox"  name="medicine'+index+'[]" id="medicine_'+i+'" value="'+data[i].medicine_id+'" ></div> <div class="col-xs-10"><label>'+data[i].medicine_name+'</label></div></div></div>';


                }
                 //alert(node);
                $("#get_des_med_"+index).html(node);


             }
               });
        }


  function excel_insert_input()
  {


           var checkboxId=[];
    $.each($("input[name='medicine1']:checked"), function()
    {            
      checkboxId.push($(this).val());
      
    });
    var checkboxId=checkboxId.join(",");



      $('#my_purpose_processing').val(checkboxId);

  }

    </script>
    <script>
      $(document).ready(function(){
        $(".add_dwn_section").hide();
        $(".remove_dwn_section").hide();
        $(".btn_dwn_section").click(function(){
          $(".add_dwn_section").show();
          $(".btn_dwn_section").hide();
          $(".remove_dwn_section").show();
        });
        $(".remove_dwn_section").click(function(){
          $(".add_dwn_section").hide();
          $(".btn_dwn_section").show();
          $(".remove_dwn_section").hide();
        });
      });
    </script>
    <div class="click_add_dwn text-center">
      <a href="javacript:void(0)" class="btn btn-primary btn_dwn_section">For new addition</a>
      <a href="javacript:void(0)" class="btn btn-primary remove_dwn_section">-</a>
    </div>
<div class="add_dwn_section">












    


























































































     <section class="content">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <div class="box1">
                <div class="box-body new_box">
                     <div class="box section_p">
                    <div class="box-body new_box">
                        <div class="tab-content">
<div id="vital_info" >
    
  <!-- <div class="col-md-12">
    <div id="patient_detail_table">
    </div>
  </div> -->
  

<div class="all-class-cc-days-all-sec">
<div id="cc_new_xx">
  <div id="row_cc_new_1" class="row row1">
     <div class="col-md-12">
                <div class="form-group frm-diff">
  
    <div class="col-sm-8">
      <label for="product_name" class=" control-label">C/C</label>
  <div id="null">
    <input type="text" class="form-control" name="cc_new[]" id="cc_new_1" multiple="" required="" placeholder="To add new C/C(example: CC1)">
  </div>
        </div>
  </div>

<div class="form-group frm-diff">

  <div class="col-sm-8">
        <label for="product_name" class="control-label">Days</label>
  <div id="null">
<select  class="form-control" name="days_x[]" id="days_x_1"  required="">
  <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
    ?>
<option value="">--Select Days--</option>
    <?php 
foreach($days as $row)
    {
?>
<option value="<?php echo $row->id; ?>"><?php echo $row->day; ?></option>
                                                    <?php } ?>
</select>
  </div>
  </div>
  <button type="button" class="btn btn-primary plus-icon-all-class-sec" id="add_new_cc_btn_1" onclick="addNewCCs(1)">+</button>
  </div>

          </div> 
                                      </div> 
                                    </div>


</div>






<div class="all-class-cc-days-all-sec">
<div class="to-add-new-medicine-all-cls">

   <div class="form-group frm-diff">
   
  <div class="col-sm-8">
      <label for="product_name" class=" control-label">Medicine</label>
    <div id="null">
     <input type="text" class="form-control" name="my_new_med[]" id="my_new_med_1"  required="" placeholder="add new medicine">
        </div>
       </div>
   </div>

      <div class="form-group frm-diff">
   
    <div class="col-sm-8">
       <label for="product_name" class=" control-label">Days</label>
   <select  class="form-control" name="my_new_med_day[]" id="my_new_med_day_1"  required="">
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


<a href="javacript:void(0)"  id="edu_mynew_med_1" onclick="edu_produce_file_box_my_new_med('1')" class="btn btn-primary plus-icon-all-class-sec med p-btn-flo-right"><b>+</b></a>
</div>
<div class="loop-p-cus-all">
  <div id="edu_my_new_med_1" class="all-width-full"></div>
  <div id="edu_my_new_med_2" class="all-width-full"></div>
  <div id="edu_my_new_med_3" class="all-width-full"></div>
  <div id="edu_my_new_med_4" class="all-width-full"></div>
  <div id="edu_my_new_med_5" class="all-width-full"></div> 
  <div id="edu_my_new_med_6" class="all-width-full"></div>
  <div id="edu_my_new_med_7" class="all-width-full"></div>
  <div id="edu_my_new_med_8" class="all-width-full"></div>
  <div id="edu_my_new_med_9" class="all-width-full"></div>
  <div id="edu_my_new_med_10" class="all-width-full"></div>
</div>
</div>



























<div class="all-class-cc-days-all-sec">
  <div id="ho_new_xx">
    <div id="row_ho_new_1" class="row rowHo">
        <div class="col-md-12">
<div class="form-group frm-diff">

        <div class="col-sm-8">   
            <label for="product_name" class=" control-label">H/O</label>
          <div id="null">
  <input type="text" class="form-control" name="ho_new[]" id="ho_new
                                               _1" required="" placeholder="To add new H/O(example:HO1.)">
           </div>
      </div>
    </div>

    <div class="form-group frm-diff">
   
        <div class="col-sm-8">   
           <label for="product_name" class=" control-label">Days</label>
          <div id="null">
    <input type="text" class="form-control" name="ho_new_days[]" id="ho_new_days_1" required="" placeholder="">
          </div>
      </div>
    </div>
<button type="button" class="btn btn-primary plus-icon-all-class-sec" id="add_new_ho_btn_1" onclick="addNewHOs(1)">+</button>
</div>
 </div>
  </div>
</div>






  <div class="general-cheast-heart-abd-total-section">


    <div class="form-group frm-diff p-last-frm">
 <div class="col-md-12 col-sm-3">
<label for="product_name" class=" control-label">General</label>
<div id="null">
<input type="text" class="form-control" name="gen_new" id="gen_new" multiple="" required="" placeholder="To add new General(example:gen-exam1,gen-exam2...)">
</div>
</div>
</div>


                                            
<div class="form-group frm-diff p-last-frm">
<div class="col-md-12 col-sm-3">
<label for="product_name" class=" control-label">Chest Exam.</label>
<div id="null">
<input type="text" class="form-control" name="chest_new" id="chest_new" multiple="" required="" placeholder="To add new chest exam.(example: chect-exam1,chest-exam2....)">
</div>
</div>
</div>

<div class="form-group frm-diff p-last-frm">
  <div class="col-md-12 col-sm-3">
<label for="product_name" class=" control-label">Heart Exam.</label>
<div id="null">
<input type="text" class="form-control" name="heart_new" id="heart_new" multiple="" required="" placeholder="To add new heart exam.(example: heart-exam1,heart-exam2....)">
</div>
</div>
</div>
<div class="form-group frm-diff p-last-frm">
 <div class="col-md-12 col-sm-3">
<label for="product_name" class=" control-label">ABD</label>
  <div id="null">
  <input type="text" class="form-control" name="abd_new" id="abd_new" multiple="" required="" placeholder="To add new ABD(example:ABD-exam1, ABD-exxam2...)">
  </div>
  </div>
</div>
</div>


  
 <div class="cns-inves-diagonestic-all-section-p-cus">
  <div class="form-group frm-diff cn-in-frm">
 
<div class="col-sm-8">
  <label for="product_name" class=" control-label">CNS</label>
<div id="null">
  <input type="text" class="form-control" name="cns_new" id="cns_new" multiple="" required="" placeholder="To add new CNS(example: CNS-Exam1 , CNS-Exam2...)">
  </div>
</div>
  </div>

   <div class="form-group frm-diff cn-in-frm">
<div class="col-sm-8">
<label for="product_name" class=" control-label">Investigation</label>
<div id="null">
<input type="text" class="form-control" name="investigation_name" id="investigation_name" multiple="" required="" placeholder="To add new Investigation(example: Investigation , Investigation...)">
</div>
</div>
</div>

<div class="form-group frm-diff cn-in-frm">
<div class="col-sm-8">
<label for="product_name" class=" control-label">Diagnosis</label>
  <div id="null">
  <input type="text" class="form-control" name="diagnosis_name" id="diagnosis_name" multiple="" required="" placeholder="To add new Diagnosis(example: Diagnosis1 , Diagnosis2...)">
    </div>
      </div>
      </div>
</div>




<div class="diet-council-all-sec">
    <div class="form-group frm-diff diet-conu-p-cus">
   
     <div class="col-sm-8">
      <label for="product_name" class=" control-label">Diet</label>
      <div id="null">
     <input type="text" class="form-control" name="diet_name" id="diet_name" multiple="" required="" placeholder="To add new Diet(example: Diet1 , Diet2...)">
       </div>
       </div>
      </div>
      <div class="form-group frm-diff diet-conu-p-cus">
    
     <div class="col-sm-8">
<label for="product_name" class=" control-label">Councilling</label>
      <div id="null">
      <input type="text" class="form-control" name="councilling_name" id="councilling_name" multiple="" required="" placeholder="To add new councilling(example: councilling1 , councilling2...)">
     </div>
    </div>
   </div>
 </div>


<div class="gym-p-all-sec">

 <div class="col-xs-12 table-responsive">
  <div class="box">
  <div class="box-header">
  <h3 class="box-title"><b><u>Gynae & Obs</u> : </b></h3>
  </div>

  <div class="box-body new_box">
  <div class="tab-content">
    <div id="vital_info" >

  <div class="lmp-edd-weig-all-p-cus">    
      <div class="form-group frm-diff new_desin lmp-edd-wei-p-cus">
      <label for="product_name" class=" control-label">LMP</label> 
      <div class="col-sm-8">
      <input type="date" name="date7" class="form-control">
      </div>
      </div>

      <div class="form-group frm-diff new_desin lmp-edd-wei-p-cus">
      <label for="product_name" class=" control-label">EDD</label> 
      <div class="col-sm-8">
      <input type="date" name="date8" class="form-control">
      </div>
      </div>

      <div class="form-group frm-diff new_desin_day Weight lmp-edd-wei-p-cus">
      <label for="product_name" class=" control-label weight-lab">Weight(Kg.)</label> 
      <div class="col-sm-8">
      <input type="text" readonly="" name="gyno_weight" id="gyno_weight" class="form-control">
      </div>
      </div>
  </div>




    </div>                           
 </div>
</div>
</div>                 
    </div>
</div>







         <div class="review-cus">
      <div class="form-group frm-diff new_desin">
    <label for="product_name" class=" control-label">Review Date</label>
        <div class="col-sm-8">
        <input class="form-control" type="date" name="review" id="review" >
          </div>
      </div>
    </div>











            <div class="clearfix"></div>
  <div class="box-footer">
</div>
 
<script type="text/javascript">
function edu_produce_file_box_my_new_med(id)
  {
var val=id;
    if(val==1)
  {
  $("#edu_mynew_med_1").hide();
  $("#minus").hide();
  }
var base_url='<?php echo base_url(); ?>';
if(val==2)
{
   $("#edu_mynew_med_"+val).hide();
  $("#minus").hide();
}
if(val==3)
{
$("#edu_mynew_med_"+val).hide();
$("#minus").hide();
}
if(val==4)
{
  $("#edu_mynew_med_"+val).hide();
  $("#minus").hide();
}
if(val==5)
{
$("#edu_mynew_med_"+val).hide();
$("#minus").hide();
}   
if(val==6)
{
$("#edu_my_new_med_"+val).hide();
$("#minus").hide();
}    
if(val==7)
{
$("#edu_mynew_med_"+val).hide();
 $("#minus").hide();
}      
if(val==8)
   {
  $("#edu_my_new_med_"+val).hide();
      $("#minus").hide();
}    
if(val==9)
{
 $("#edu_mynew_med_"+val).hide();
$("#minus").hide();
   }    
   if(val==10)
   {
   $("#edu_mynew_med_"+val).hide();
   $("#minus").hide();
    }   
  $.ajax({
url:base_url+'index.php/admin_prescription/edu_file_box_show_my_new_med',
    data:{num:val},
    dataType: "html",
    type: "POST",
    success: function(data){

      // alert(data);
   $("#edu_my_new_med_"+id).html(data);
  $("#edu_my_new_med_"+id).show();
  //$("#edu_delete").hide();
}
 });
}
function edu_hiding_out_my_new_med(val)
{
var current_div=val-1; 
/* alert(val);
alert(current_div);*/         
 $("#edu_my_new_med_"+val).html('');
$("#edu_my_new_med_"+current_div).hide();
   $("#edu_mynew_med_"+current_div).show();
  $("#minus").show();
}
</script>
</div>
</div>
 </div>
</div>             
</div>
</div>
</div>
</div>
</section>













    <section class="content">
        <div class="row">
           
            </div>
    

    </section>


   







</div>

    </form>
  </div>
</div>
<style type="text/css">
  .click_add_dwn{
    width: 100%;
    padding-right: 15px;
  }
</style>
<script src="<?php echo base_url();?>custom_script/validation_rulse.js"></script>
<script src="<?php echo base_url();?>custom_script/setting_validation.js"></script>
<!--  <script src="<?php echo base_url();?>plugins/select2/select2.full.min.js"></script> -->
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

         var feedback = $('#feedback').val();
        if (!isNull(feedback)) 
        {
          $('#feedback').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
          $('#feedback').removeClass('red_border').addClass('black_border');
        }
        
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


/* function edu_hiding_out(val)
    {
        
          var current_div=val-1; 
                
          $("#edu_add_"+val).html('');
          $("#edu_add_"+current_div).hide();
          $("#edu_no_"+current_div).show();
          $("#minus").show();

      
    }*/
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

  <script type="text/javascript">
    function addNewCCs(index){
        //alert(index);

        $("#add_new_cc_btn_"+index).remove();
        var btnAdd = '<button type="button" class="btn btn-primary push_right left" onclick="removeNewCCs('+index+')">-</button>';
        $("#row_cc_new_"+index).append(btnAdd);

        var next_index = parseInt(index) + 1;



        var html_data = '';
            html_data +='<div id="row_cc_new_'+next_index+'" class="row row1">';
            html_data +='<div class="col-md-12">';
            html_data +='<div class="form-group frm-diff">';
            html_data +='<label for="product_name" class=" control-label">To add new C/C</label>';
            html_data +='<div class="col-sm-8">';
            html_data +='<div id="null">';
            html_data +='<input type="text" class="form-control" name="cc_new[]" id="cc_new_'+next_index+'" multiple="" required="" placeholder="To add new C/C(example: CC1)">';
            html_data +='</div>';
            html_data +='</div>';
            html_data +='</div>';

            html_data +='<div class="form-group frm-diff">';
            html_data +='<label for="product_name" class="control-label">Days</label>';
            html_data +='<div class="col-sm-8">';
            html_data +='<div id="null">';
            html_data +='<select  class="form-control" name="days_x[]" id="days_x_'+next_index+'"  required="">';

              <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
              ?>

            html_data +='<option value="">--Select Days--</option>';
              <?php 

                  foreach($days as $row)
                  {
               ?>
             html_data +='<option value="<?php echo $row->id; ?>"><?php echo $row->day; ?></option>';
              <?php } ?>
            html_data +='<option></option>';
            html_data +='</select>';
            html_data +='</div>';
            html_data +='</div>';
            html_data +='</div>';
             html_data +='<button type="button" class="btn btn-primary push_right" id="add_new_cc_btn_'+next_index+'" onclick="addNewCCs('+next_index+')">+</button>';
            html_data +='<button type="button" class="btn btn-primary push_right left" onclick="removeNewCCs('+next_index+')">-</button>';
            html_data +='</div>';
            html_data +='</div>';

        $("#cc_new_xx").append(html_data);
    }

    function removeNewCCs(index){
        var rowLength = $(".row1").length;
        //alert(rowLength);
        if(rowLength > 1){
          $("#row_cc_new_"+index).remove();
        }else{
          alert("Sorry you can't remove");
        }
    }
  </script>

  <script>
    function addNewHOs(index){

       $("#add_new_ho_btn_"+index).remove();
        var btnAdd = '<button type="button" class="btn btn-primary push_right left" onclick="removeNewHOs('+index+')">-</button>';
        $("#row_ho_new_"+index).append(btnAdd);

        var next_index = parseInt(index) + 1;

      var html_data='';
      html_data +='<div id="row_ho_new_'+next_index+'" class="row rowHo">';
      html_data +='<div class="col-md-12">';

      html_data +='<div class="form-group frm-diff">';
          html_data +='<label for="product_name" class=" control-label">To add new H/O</label>';
          html_data +='<div class="col-sm-8">';                                               
              html_data +='<div id="null">';
             html_data +='<input type="text" class="form-control" name="ho_new[]" id="ho_new_'+next_index+'" required="" placeholder="To add new H/O(example:HO1.)">';
              html_data +='</div>';
          html_data +='</div>';
      html_data +='</div>';

      html_data +='<div class="form-group frm-diff">';
          html_data +='<label for="product_name" class=" control-label">Days</label>';
          html_data +='<div class="col-sm-8">';                                               
              html_data +='<div id="null">';
             html_data +='<input type="text" class="form-control" name="ho_new_days[]" id="ho_new_days_'+next_index+'" required="" placeholder="">';
              html_data +='</div>';
          html_data +='</div>';
      html_data +='</div>';

       html_data +='<button type="button" class="btn btn-primary push_right" id="add_new_ho_btn_1" onclick="addNewHOs('+next_index+')">+</button>';
       html_data +='<button type="button" class="btn btn-primary push_right left" onclick="removeNewHOs('+next_index+')">-</button>';
  html_data +='</div>';
  html_data +='</div>';

      $("#ho_new_xx").append(html_data);


    }


     function removeNewHOs(index){
        var rowLength = $(".rowHo").length;
        //alert(rowLength);
        if(rowLength > 1){
          $("#row_ho_new_"+index).remove();
        }else{
          alert("Sorry you can't remove");
        }
    }
  </script>