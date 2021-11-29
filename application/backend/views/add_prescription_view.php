
<link href="https://harvesthq.github.io/chosen/chosen.css" rel="stylesheet" type="text/css">

<div class="content-wrapper" style="min-height: 231px;">
<div class="all-add-prescription-section">

      <form action="<?php echo base_url(); ?>index.php/admin_prescription/prescription_add" id="doc_add_form7" method="post">
      <div class="first-section">
        <div class="first-part-all-div">
        <div class="first-part">
          <div class="col-md-12">
            <div class="form-group">
             
              <div class="col-md-4">
                 <div class="patient-height-p-cus">
                <label>Paitent</label>
         



  <select class="form-control select2" name="patient" id="patient" onchange="get_data(this.value),get_pulse(this.value),get_exist_patient(this.value)" >
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
              <div class="col-md-5">
                <label>C/C</label>
               <select class="form-control select2" name="cc[]" id="cc_0">
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
              <div class="all-days-section">
              <div class="col-md-2">
                <label>Days</label>
                <select name="dose_cc[]" id="dose_cc_0">
                 <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
     ?>
<option value="">Days</option>
  <?php 
foreach($days as $row)
{
 ?>
 <option value="<?php echo $row->id; ?>"><?php echo $row->day; ?></option>
  <?php } ?>

                </select>
              </div>
              </div>
              <div class="col-md-1">
                <div class="plus-min-btn">
                  <!-- <span class="min-btn">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                  </span> -->
                  <span class="plus-btn" id="edu_no2_1" onclick="edu_produce_file_box_cc('1')">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </span>
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
       
        <div class="first-part-loop" id="edu_cc_1" style="display: none;">
          <div class="first-part">
          <div class="col-md-12">
            <div class="form-group">
              <div class="col-md-4">
             <!--    <label>Paitent</label>
               <input list=text_editors>

<datalist id="text_editors">
    <select multiple size=8>
      <option value="Pitam Mukherjee">
      <option value="Aruniva Sen">   
      <option value="Arman Ali">
      <option value="Debayan Sen">
      <option value="Sujan Talukder">
      <option value="Shamin Sharmat">
      <option value="Sampa Koyla">
      
    </select>
  </datalist> -->
              </div>
              <div class="col-md-5">
                <label>C/C</label>
             <select class="form-control select2" name="cc[]" id="cc_0">
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
              <div class="all-days-section">
              <div class="col-md-2">
                <label>Days</label>
                <select name="dose_cc[]" id="dose_cc_0" >
                 <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
     ?>
<option value="">Days</option>
 <?php 
 foreach($days as $row)
  {
  ?>
 <option value="<?php echo $row->id; ?>"><?php echo $row->day; ?></option>
  <?php } ?>

                </select>
              </div>
              </div>
              <div class="col-md-1">
                <div class="plus-min-btn">
                  <span class="min-btn">
                    <i class="fa fa-minus" aria-hidden="true" id="minus" onclick="edu_hiding_out_cc(2);"></i>
                  </span>
                  <span class="plus-btn" id="edu_no2_2" onclick="edu_produce_file_box_cc('2')">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>

          <div class="first-part-loop" id="edu_cc_2" style="display: none;">
          <div class="first-part">
          <div class="col-md-12">
            <div class="form-group">
              <div class="col-md-4">
             <!--    <label>Paitent</label>
               <input list=text_editors>

<datalist id="text_editors">
    <select multiple size=8>
      <option value="Pitam Mukherjee">
      <option value="Aruniva Sen">   
      <option value="Arman Ali">
      <option value="Debayan Sen">
      <option value="Sujan Talukder">
      <option value="Shamin Sharmat">
      <option value="Sampa Koyla">
      
    </select>
  </datalist> -->
              </div>
              <div class="col-md-5">
                <label>C/C</label>
            <select class="form-control select2" name="cc[]" id="cc_0">
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
              <div class="all-days-section">
              <div class="col-md-2">
                <label>Days</label>
                <select name="dose_cc[]" id="dose_cc_0">
                  <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
                                                ?>

<option value="">Days</option>
  <?php 
 foreach($days as $row)
   {
   ?>
  <option value="<?php echo $row->id; ?>"><?php echo $row->day; ?></option>
   <?php } ?>


                </select>
              </div>
              </div>
              <div class="col-md-1">
                <div class="plus-min-btn">
                  <span class="min-btn">
                    <i class="fa fa-minus" id="minus" onclick="edu_hiding_out_cc(3);" aria-hidden="true"></i>
                  </span>
                  <span class="plus-btn" id="edu_no2_3" onclick="edu_produce_file_box_cc('3')">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>


          <div class="first-part-loop" id="edu_cc_3" style="display: none;">
          <div class="first-part">
          <div class="col-md-12">
            <div class="form-group">
              <div class="col-md-4">
             <!--    <label>Paitent</label>
               <input list=text_editors>

<datalist id="text_editors">
    <select multiple size=8>
      <option value="Pitam Mukherjee">
      <option value="Aruniva Sen">   
      <option value="Arman Ali">
      <option value="Debayan Sen">
      <option value="Sujan Talukder">
      <option value="Shamin Sharmat">
      <option value="Sampa Koyla">
      
    </select>
  </datalist> -->
              </div>
              <div class="col-md-5">
                <label>C/C</label>
            <select class="form-control select2" name="cc[]" id="cc_0">
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

               <div class="all-days-section">
              <div class="col-md-2">
                <label>Days</label>
                <select  name="dose_cc[]" id="dose_cc_0" >
                 <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
                                                ?>
<option value="">Days</option>
     <?php 
foreach($days as $row)
{
   ?>
    <option value="<?php echo $row->id; ?>"><?php echo $row->day; ?></option>
     <?php } ?>
                </select>
              </div>
              </div>
              <div class="col-md-1">
                 <div class="plus-min-btn">
                  <span class="min-btn">
                    <i class="fa fa-minus" id="minus" onclick="edu_hiding_out_cc(4);" aria-hidden="true"></i>
                  </span>
                  <span class="plus-btn" id="edu_no2_4" onclick="edu_produce_file_box_cc('4')">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>


          <div class="first-part-loop" id="edu_cc_4" style="display: none;">
          <div class="first-part">
          <div class="col-md-12">
            <div class="form-group">
              <div class="col-md-4">
             <!--    <label>Paitent</label>
               <input list=text_editors>

<datalist id="text_editors">
    <select multiple size=8>
      <option value="Pitam Mukherjee">
      <option value="Aruniva Sen">   
      <option value="Arman Ali">
      <option value="Debayan Sen">
      <option value="Sujan Talukder">
      <option value="Shamin Sharmat">
      <option value="Sampa Koyla">
      
    </select>
  </datalist> -->
              </div>
              <div class="col-md-5">
                <label>C/C</label>
            <select class="form-control select2" name="cc[]" id="cc_0">
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
               <div class="all-days-section">
              <div class="col-md-2">
                <label>Days</label>
                <select name="dose_cc[]" id="dose_cc_0">
                  <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
                                                ?>
<option value="">Days</option>
       <?php 
foreach($days as $row)
       {
       ?>
<option value="<?php echo $row->id; ?>"><?php echo $row->day; ?></option>
     <?php } ?>

                </select>
              </div>

              </div>
              <div class="col-md-1">
                 <div class="plus-min-btn">
                  <span class="min-btn">
                    <i class="fa fa-minus" id="minus" onclick="edu_hiding_out_cc(5);" aria-hidden="true"></i>
                  </span>
                  <span class="plus-btn" id="edu_no2_5" onclick="edu_produce_file_box_cc('5')">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>



        </div>
        <div class="second-part-all-div">
        <div class="second-part">
          <div class="form-group">
              <div class="col-md-4">
                <label>Diagnosis</label>
               <div id="output"></div>

  <select data-placeholder="Choose Diagnosis" name="diagnosis[]" id="diagnosis" multiple class="chosen-select">
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

             
              <div class="col-md-5">
                     <label>H/O</label>
  <select class="form-control select2" name="ho[]" id="ho">
     <option value="">Select H/O</option>
        <?php
    foreach($ho as $row){
 ?>
 <option value="<?php echo $row->ho_id; ?>" ><?php echo $row->ho_name; ?></option>
   <?php
   }
 ?>
      
    </select>
              </div>
               <div class="all-days-section">
              <div class="col-md-2">
                <div class="ho-dignosis">
                <label>Days</label>
               <input type="text" class="form-control" name="dose_ho[]" id="dose_ho_0">
              </div>
              </div>
              </div>
              <div class="col-md-1">
                 <div class="plus-min-btn">
                 <!--  <span class="min-btn">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                  </span> -->
                  <span class="plus-btn" id="edu_no3_1" onclick="edu_produce_file_box_ho('1')">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </span>
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
                  $("#edu_ho_"+val).show();
                     $("#edu_no3_1").hide();
                      $("#minus").hide();
                }
          
            
            if(val==2)
                {
                  $("#edu_ho_"+val).show();
                    $("#edu_no3_"+val).hide();
                   $("#minus").hide();
                }
            if(val==3)
                {
                  $("#edu_ho_"+val).show();
                    $("#edu_no3_"+val).hide();
                    $("#minus").hide();
                }
             if(val==4)
                {
                  $("#edu_ho_"+val).show();
                    $("#edu_no3_"+val).hide();
                    $("#minus").hide();
                }
             if(val==5)
                {
                  $("#edu_ho_"+val).show();
                    $("#edu_no3_"+val).hide();
                    $("#minus").hide();
                }   

                 if(val==6)
                {
                  $("#edu_ho_"+val).show();
                    $("#edu_no3_"+val).hide();
                    $("#minus").hide();
                }    
                 if(val==7)
                {
                  $("#edu_ho_"+val).show();
                    $("#edu_no3_"+val).hide();
                    $("#minus").hide();
                }      
                 if(val==8)
                {
                  $("#edu_ho_"+val).show();
                    $("#edu_no3_"+val).hide();
                    $("#minus").hide();
                }    
                 if(val==9)
                {
                  $("#edu_ho_"+val).show();
                    $("#edu_no3_"+val).hide();
                    $("#minus").hide();
                }    
                

            
   
    }


  function edu_hiding_out_ho(val)
  {


        var current_div=val-1; 

        
          $("#edu_ho_"+current_div).hide();
          $("#edu_no3_"+current_div).show();
          $("#minus").show();
       

  }



                                                              

</script>

<?php for($i=1;$i<10;$i++){ ?>
        <div class="second-part-loop" id="edu_ho_<?php echo $i; ?>" style="display: none;">
          <div class="second-part">
          <div class="form-group">
              <div class="col-md-4">

 

              </div>
              <div class="col-md-5">
                     <label>H/O</label>
               <select class="form-control select2" name="ho[]" id="ho">
      <option value="">Select H/O</option>
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
               <div class="all-days-section">
              <div class="col-md-2">
                <div class="ho-dignosis">
                <label>Days</label>
               <input type="text" class="form-control" name="dose_ho[]" id="dose_ho_0">
              </div>
              </div>
              </div>
              <div class="col-md-1">
                 <div class="plus-min-btn">
                  <span class="min-btn" id="minus" onclick="edu_hiding_out_ho(<?php echo $i+1; ?>);">
                    <i class="fa fa-minus"  aria-hidden="true"></i>
                  </span>
                  <span class="plus-btn" id="edu_no3_<?php echo $i+1; ?>" onclick="edu_produce_file_box_ho(<?php echo $i+1; ?>)">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </span>
                </div>
              </div>
            </div>
        </div>
        </div>

        <?php } ?>


      </div>
      </div>




      <div class="second-section">
        <div class="second-first-part">
          <div class="col-md-12">
           <div class="form-group">
              <div class="col-md-4">
                <label>General</label>
               <div id="output"></div>

  <select data-placeholder="Choose General Exam" name="gen[]" id="gen" multiple class="chosen-select">
                                                    <?php 

                                                     $exam_type_gen =  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_type_id'=>2,'status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

                                                        foreach($exam_type_gen as $row)
                                                        {
                                                     ?>

                                                   <option value="<?php echo $row->examination_id; ?>" ><?php echo $row->examination_name; ?></option>
                                                   <?php } ?>
  </select>
 

              </div>
              <div class="pulse-rhytm-bp">
              <div class="col-md-8">
                <div class="col-md-4">
                  <div class="pulse-section">
                  <label>Pulse</label>
               <input type="text" name="pulse" id="pulse" placeholder="Pulse" class="form-control">
             </div>
                </div>
                <div class="col-md-4">
                  <div class="rhythm-section">
                    <label>Rhythm</label>
                     <select class="form-control">
                                                  <option value="Regular">Regular</option>
                                                  <option value="Regularly Irregular">Regularly Irregular</option>
                                                  <option value="Irregularly Irregular">Irregularly Irregular</option>
                                                  <option value="Pulse Deficit+">Pulse Deficit+</option>
                     </select>
                   </div>

                </div>
                <div class="col-md-4">
                  <div class="bp-section">
                    <label>BP</label>
                       <input type="text" name="upper" id="upper" placeholder="Upper" class="form-control">
                       <input type="text" name="lower" id="lower" placeholder="Lower" class="form-control" >
                     </div>
                </div>
              </div>
            </div>
              
            
              
            </div>
          </div>
        </div>
        <div class="secnd-second-part">
          <div class="col-md-12">
            <div class="form-group">
              <div class="col-md-4">
                  <div class="chest-section">
                <label>Chest</label>
              
                   <div id="output"></div>

  <select data-placeholder="Choose Chest Exam" name="chest[]" id="chest" multiple class="chosen-select">
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
            <div class="heart-abd-cns">
              <div class="col-md-8">
                <div class="col-md-4">
                  <div class="heart-section">
                  <label>Heart</label>
              
                   <div id="output"></div>

  <select data-placeholder="Choose Heart Exam" name="heart[]" id="heart" multiple class="chosen-select">
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
                <div class="abd-sec-col">
                <div class="col-md-4">
                   <div class="abd-section">
                  <label>Abd</label>
              
                   <div id="output"></div>

  <select data-placeholder="Choose ABD Exam" name="abd[]" id="abd" multiple class="chosen-select">
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
              <div class="cns-section-col">
                <div class="col-md-4">
                  <div class="cns-section">
                    <label>CNS</label>
              
                   <div id="output"></div>

  <select data-placeholder="Choose CNS Exam" name="cns[]" id="cns" multiple class="chosen-select">
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
            </div>

          </div>


        </div>
      </div>


          <script type="text/javascript">
  
        




        function edu_report_produce_file_box(id)
    {
      // alert(id);
         
             var val=id;

             if(val==1)
                {
                  $("#add_more_edu_report_no_"+val).show();
                     $("#edu_report_no_"+val).hide();
                      $("#minus").hide();
                }
          
            
            if(val==2)
                {
                  $("#add_more_edu_report_no_"+val).show();
                     $("#edu_report_no_"+val).hide();
                   $("#minus").hide();
                }
            if(val==3)
                {
                  $("#add_more_edu_report_no_"+val).show();
                   $("#edu_report_no_"+val).hide();
                    $("#minus").hide();
                }
             if(val==4)
                {
                  $("#add_more_edu_report_no_"+val).show();
                    $("#edu_report_no_"+val).hide();
                    $("#minus").hide();
                }
             if(val==5)
                {
                  $("#add_more_edu_report_no_"+val).show();
                    $("#edu_report_no_"+val).hide();
                    $("#minus").hide();
                }   

                 if(val==6)
                {
                  $("#add_more_edu_report_no_"+val).show();
                    $("#edu_report_no_"+val).hide();
                    $("#minus").hide();
                }    
                 if(val==7)
                {
                  $("#add_more_edu_report_no_"+val).show();
                    $("#edu_report_no_"+val).hide();
                    $("#minus").hide();
                }      
                 if(val==8)
                {
                  $("#add_more_edu_report_no_"+val).show();
                    $("#edu_report_no_"+val).hide();
                    $("#minus").hide();
                }    
                 if(val==9)
                {
                  $("#add_more_edu_report_no_"+val).show();
                    $("#edu_report_no_"+val).hide();
                    $("#minus").hide();
                }    
                

            
   
    }


  function edu_report_hiding_out(val)
  {


        var current_div=val-1; 

        
          $("#add_more_edu_report_no_"+current_div).hide();
          $("#edu_report_no_"+current_div).show();
          $("#minus").show();
       

  }



                                                              

</script>


      <div class="third-section">
        <div class="third-section-first-part">
          <div class="col-md-12">
            <div class="form-group">
              <div class="investion-section-col">
              <div class="col-md-4">
                <div class="invest-section">
                <label>Invest</label>

                   <div id="output"></div>

  <select data-placeholder="Choose Investigation" name="investigation[]" id="investigation" multiple class="chosen-select">
                                                
                      
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
              <div class="col-md-8">


              <div class="all-report-section-p-cus">
                <div class="col-md-4">
                  <div class="report-section">
                  <label>Report</label>
                  <select class="form-control select2" name="write[]" id="write">
                  <option value="">Select Report</option>
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
                <div class="col-md-4">
                  <div class="report-blank-section">
                         <label></label>
                     <input type="text" name="write_some[]" class="form-control">


</div>
                </div>
                <div class="col-md-3">
                  <div class="report-days-section">
                <!--   <label>Date</label> -->
                  <input type="text" name="date[]" class="form-control datepicker">
                </div>
                </div>
                <div class="plus-minus-btn-sec">
                <div class="col-md-1">
                  <div class="plus-min-btn">
                  <!-- <span class="min-btn">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                  </span> -->
                  <span class="plus-btn" id="edu_report_no_1" onclick="edu_report_produce_file_box('1')">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </span>
                </div>
                </div>
                </div>
              </div>

             

<?php for($i=1;$i<10;$i++){ ?>
<div class="all-report-section-p-cus" id="add_more_edu_report_no_<?php echo $i; ?>" style="display: none;">
                <div class="col-md-4">
                  <div class="report-section">
                  <label>Report</label>
                     <select class="form-control select2" name="write[]" id="write">
                      <option value="">Select Report</option>
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
                <div class="col-md-4">
                  <div class="report-blank-section">
                         <label></label>
                     <input type="text" name="write_some[]" class="form-control">


</div>
                </div>
                <div class="col-md-3">
                  <div class="report-days-section">
                  <!-- <label>Date</label> -->
                  <input type="text" name="date[]" class="form-control datepicker">
                </div>
                </div>
                <div class="plus-minus-btn-sec">
                <div class="col-md-1">
                  <div class="plus-min-btn">
                   <span class="min-btn" id="minus" onclick="edu_report_hiding_out(<?php echo $i+1; ?>);">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                  </span> 
                  <span class="plus-btn" id="edu_report_no_<?php echo $i+1; ?>" onclick="edu_report_produce_file_box(<?php echo $i+1; ?>)">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </span>
                </div>
                </div>
                </div>
              </div>

              <?php } ?>





              </div>

            </div>


          </div>

        </div>
      </div>


          <script type="text/javascript">
  
        




        function edu_produce_file_box(id)
    {
      // alert(id);
         
             var val=id;

             if(val==1)
                {
                  $("#edu_add_"+val).show();
                     $("#edu_no_"+val).hide();
                      $("#minus").hide();
                }
          
            
            if(val==2)
                {
                  $("#edu_add_"+val).show();
                     $("#edu_no_"+val).hide();
                   $("#minus").hide();
                }
            if(val==3)
                {
                  $("#edu_add_"+val).show();
                   $("#edu_no_"+val).hide();
                    $("#minus").hide();
                }
             if(val==4)
                {
                  $("#edu_add_"+val).show();
                    $("#edu_no_"+val).hide();
                    $("#minus").hide();
                }
             if(val==5)
                {
                  $("#edu_add_"+val).show();
                    $("#edu_no_"+val).hide();
                    $("#minus").hide();
                }   

                 if(val==6)
                {
                  $("#edu_add_"+val).show();
                    $("#edu_no_"+val).hide();
                    $("#minus").hide();
                }    
                 if(val==7)
                {
                  $("#edu_add_"+val).show();
                    $("#edu_no_"+val).hide();
                    $("#minus").hide();
                }      
                 if(val==8)
                {
                  $("#edu_add_"+val).show();
                    $("#edu_no_"+val).hide();
                    $("#minus").hide();
                }    
                 if(val==9)
                {
                  $("#edu_add_"+val).show();
                    $("#edu_no_"+val).hide();
                    $("#minus").hide();
                }    

                if(val==10)
                {
                  $("#edu_add_"+val).show();
                    $("#edu_no_"+val).hide();
                    $("#minus").hide();
                }    

                if(val==11)
                {
                  $("#edu_add_"+val).show();
                    $("#edu_no_"+val).hide();
                    $("#minus").hide();
                }    

                if(val==12)
                {
                  $("#edu_add_"+val).show();
                    $("#edu_no_"+val).hide();
                    $("#minus").hide();
                }    

                if(val==13)
                {
                  $("#edu_add_"+val).show();
                    $("#edu_no_"+val).hide();
                    $("#minus").hide();
                }    

                 if(val==14)
                {
                  $("#edu_add_"+val).show();
                    $("#edu_no_"+val).hide();
                    $("#minus").hide();
                }    
                

            
   
    }


  function edu_hiding_out(val)
  {


        var current_div=val-1; 

        
          $("#edu_add_"+current_div).hide();
          $("#edu_no_"+current_div).show();
          $("#minus").show();
       

  }



                                                              

</script>


      <div class="fourth-section">
        <div class="fourth-section-first-part">
          <div class="col-md-12">
            <div class="form-group">
              <div class="col-md-4">
                <div class="disease-section">
                <label>Disease</label>
                  <select class="form-control select2" name="group[]" onchange="get_med(this.value,1)" id="group_1">
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
              <div class="col-md-7">
                <div class="disease-medicine-section-all">
                  <label>Medicines</label>
                  <div class="all-disease-check-box-sec" id="get_des_med_1" style="min-height: 1px;overflow-y:scroll;max-height: 200px;">
                   
                  </div>
                </div>
              </div>
              <div class="col-md-1">
                <div class="plus-min-btn">
                <!--   <span class="min-btn">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                  </span> -->
                  <span class="plus-btn" id="edu_no_1" onclick="edu_produce_file_box('1')">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="fourth-section-firts-part-loop-section">

        <?php for($i=1;$i<10;$i++){ ?>
           <div class="fourth-section-first-part" id="edu_add_<?php echo $i; ?>" style="display: none;">
          <div class="col-md-12">
            <div class="form-group">
              <div class="col-md-4">
                <div class="disease-section">
                <label>Disease</label>
                     <select class="form-control select2" name="group[]" onchange="get_med(this.value,<?php echo $i+1; ?>)" id="group_<?php echo $i; ?>">
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
              <div class="col-md-7">
                <div class="disease-medicine-section-all">
                  <label>Disease Medicine</label>
                  <div class="all-disease-check-box-sec" id="get_des_med_<?php echo $i+1; ?>" style="min-height: 1px;overflow-y:scroll;max-height: 200px;">
                  </div>
                </div>
              </div>
              <div class="col-md-1">
                <div class="plus-min-btn">
                  <span class="min-btn" id="minus" onclick="edu_hiding_out(<?php echo $i+1; ?>);">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                  </span>
                  <span class="plus-btn" id="edu_no_<?php echo $i+1; ?>" onclick="edu_produce_file_box(<?php echo $i+1; ?>)">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>

        </div>
<?php } ?>


          <script type="text/javascript">
  
        




        function edu_produce_file_box_my_med(id)
    {
      // alert(id);
         
             var val=id;

             if(val==1)
                {
                      $("#edu_my_med_"+val).show();
                      $("#edu_nomed_"+val).hide();
                      $("#minus").hide();
                }
          
            
            if(val==2)
                {
                   $("#edu_my_med_"+val).show();
                      $("#edu_nomed_"+val).hide();
                   $("#minus").hide();
                }
            if(val==3)
                {
                   $("#edu_my_med_"+val).show();
                      $("#edu_nomed_"+val).hide();
                    $("#minus").hide();
                }
             if(val==4)
                {
                   $("#edu_my_med_"+val).show();
                      $("#edu_nomed_"+val).hide();
                    $("#minus").hide();
                }
             if(val==5)
                {
                   $("#edu_my_med_"+val).show();
                      $("#edu_nomed_"+val).hide();
                    $("#minus").hide();
                }   

                 if(val==6)
                {
                   $("#edu_my_med_"+val).show();
                      $("#edu_nomed_"+val).hide();
                    $("#minus").hide();
                }    
                 if(val==7)
                {
                   $("#edu_my_med_"+val).show();
                      $("#edu_nomed_"+val).hide();
                    $("#minus").hide();
                }      
                 if(val==8)
                {
                  $("#edu_my_med_"+val).show();
                      $("#edu_nomed_"+val).hide();
                    $("#minus").hide();
                }    
                 if(val==9)
                {
                   $("#edu_my_med_"+val).show();
                      $("#edu_nomed_"+val).hide();
                    $("#minus").hide();
                }    

                if(val==10)
                {
                   $("#edu_my_med_"+val).show();
                      $("#edu_nomed_"+val).hide();
                    $("#minus").hide();
                }    

                if(val==11)
                {
                   $("#edu_my_med_"+val).show();
                      $("#edu_nomed_"+val).hide();
                    $("#minus").hide();
                }    

                if(val==12)
                {
                   $("#edu_my_med_"+val).show();
                      $("#edu_nomed_"+val).hide();
                    $("#minus").hide();
                }    

                if(val==13)
                {
                   $("#edu_my_med_"+val).show();
                      $("#edu_nomed_"+val).hide();
                    $("#minus").hide();
                }   

                 if(val==14)
                {
                   $("#edu_my_med_"+val).show();
                      $("#edu_nomed_"+val).hide();
                    $("#minus").hide();
                }    
                

            
   
    }


  function edu_hiding_out_my_med(val)
  {


        var current_div=val-1; 

        
          $("#edu_my_med_"+current_div).hide();
          $("#edu_nomed_"+current_div).show();
          $("#minus").show();
       

  }



                                                              

</script>

        </div>
        <div class="fourt-section-second-part">
<div class="fourt-section-first-part">
          <div class="col-md-9">
            <div class="fourth-medicine">
            <label>Medicine</label>
            <select class="form-control select2" name="my_medicine[]" id="my_medicine_0">
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
          <div class="col-md-2">
            <div class="fourth-review-days" >
              <label>Days</label>
              <select name="dose[]" id="dose_1">
                 <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
  ?>
<option value="">Days</option>
  <?php 
foreach($days as $row)
{
?>
<option value="<?php echo $row->id; ?>"><?php echo 'for '.$row->day; ?></option>
<?php } ?>
              </select>
            </div>
          </div>
          <div class="fourth-section-plus-min">
          <div class="col-md-1">
            <div class="plus-min-btn">
                 <!--  <span class="min-btn">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                  </span> -->
                  <span class="plus-btn" id="edu_nomed_1" onclick="edu_produce_file_box_my_med('1')">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </span>
                </div>
          </div>
        </div>
      </div>
      

      <div class="fourth-section-second-part-loop">

<?php for($i=1;$i<15;$i++){ ?>
        <div class="fourt-section-first-part" id="edu_my_med_<?php echo $i; ?>" style="display: none;">
          <div class="col-md-9">
            <div class="fourth-medicine">
            <label>Medicine</label>
             <select class="form-control select2" name="my_medicine[]" id="my_medicine_0">
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
          <div class="col-md-2">
            <div class="fourth-review-days">
              <label>Days</label>
             <select name="dose[]" id="dose_1">
                 <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
  ?>
<option value="">Days</option>
  <?php 
foreach($days as $row)
{
?>
<option value="<?php echo $row->id; ?>"><?php echo 'for '.$row->day; ?></option>
<?php } ?>
              </select>
            </div>
          </div>
          <div class="fourth-section-plus-min">
          <div class="col-md-1">
            <div class="plus-min-btn">
                  <span class="min-btn" id="minus" onclick="edu_hiding_out_my_med(<?php echo $i+1; ?>);">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                  </span>
                  <span class="plus-btn" id="edu_nomed_<?php echo $i+1; ?>" onclick="edu_produce_file_box_my_med(<?php echo $i+1; ?>)">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </span>
                </div>
          </div>
        </div>
      </div>

      <?php } ?>


      </div>
        </div>
      </div>



      <div class="fifth-section">
        <div class="fifth-section-first-part">
          <div class="col-md-4">
            <label>Diet</label>
             <div id="output"></div>

  <select data-placeholder="Choose Diet" name="diet[]" id="diet" multiple class="chosen-select">

  <option value="">Choose Diet</option>
   <?php
                                                       foreach($diet as $row){

                                                        ?>

                                                   <option value="<?php echo $row->diet_id; ?>" ><?php echo $row->diet_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
  </select>
          </div>

            <div class="col-md-4">
            <label>Counsel</label>
             <div id="output"></div>

  <select data-placeholder="Choose Councel" name="councilling[]" id="councilling" multiple class="chosen-select">

  <option value="">Choose Councel</option>
   <?php
                                                       foreach($councelling as $row){

                                                        ?>

                                                   <option value="<?php echo $row->councelling_id; ?>" ><?php echo $row->councelling_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
  </select>
          </div>

<div class="fifth-review-days-all-section">
          <div class="col-md-3">
            <label>Reviews</label>
             <select class="form-control" name="feedback" id="feedback">
              <option value="">Days</option>
              <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
                                                ?>

                                                    
                                                    
                                                    <?php 

                                                        foreach($days as $row)
                                                        {
                                                     ?>
                                                    <option value="<?php echo $row->id; ?>"><?php echo 'after '.$row->day; ?></option>
                                                    <?php } ?>
                      
                                                <option value="sos">SOS</option>
             </select>
          </div>
        </div>

        </div>
        <div class="all-form-btn-section-start">
          <div class="col-md-6">
            <div class="back-btn">
              <input type="button" onclick="back_form()"   class="inp-sub-btn" value="Back">
            </div>
          </div>
          <div class="col-md-6">
            <div class="sybmit-btn">
              <input type="button" onclick="valid_doc_form()" value="Submit"  class="ipt-submit-btn-sec">
            </div>
          </div>
        </div>


<script type="text/javascript">
  function back_form()
  {
    window.location.href="<?php echo base_url(); ?>index.php/admin_prescription";
  }
</script>

        

      </div>


                <script type="text/javascript">
  
        




        function addNewCCs(id)
    {
      // alert(id);
         
             var val=id;

             if(val==1)
                {
                      $("#add_nw_cc_"+val).show();
                      $("#add_new_cc_btn_"+val).hide();
                      $("#minus").hide();
                }
          
            
            if(val==2)
                {
                   $("#add_nw_cc_"+val).show();
                      $("#add_new_cc_btn_"+val).hide();
                      $("#minus").hide();
                }
            if(val==3)
                {
                   $("#add_nw_cc_"+val).show();
                      $("#add_new_cc_btn_"+val).hide();
                      $("#minus").hide();
                }
             if(val==4)
                {
                  $("#add_nw_cc_"+val).show();
                      $("#add_new_cc_btn_"+val).hide();
                      $("#minus").hide();
                }
             if(val==5)
                {
                   $("#add_nw_cc_"+val).show();
                      $("#add_new_cc_btn_"+val).hide();
                      $("#minus").hide();
                }   

                 if(val==6)
                {
                   $("#add_nw_cc_"+val).show();
                      $("#add_new_cc_btn_"+val).hide();
                      $("#minus").hide();
                }    
                 if(val==7)
                {
                  $("#add_nw_cc_"+val).show();
                      $("#add_new_cc_btn_"+val).hide();
                      $("#minus").hide();
                }      
                 if(val==8)
                {
                 $("#add_nw_cc_"+val).show();
                      $("#add_new_cc_btn_"+val).hide();
                      $("#minus").hide();
                }    
                 if(val==9)
                {
                   $("#add_nw_cc_"+val).show();
                      $("#add_new_cc_btn_"+val).hide();
                      $("#minus").hide();
                }    
                

            
   
    }


  function removeNewCCs(val)
  {


        var current_div=val-1; 

        
          $("#add_nw_cc_"+current_div).hide();
          $("#add_new_cc_btn_"+current_div).show();
          $("#minus").show();
       

  }



                                                              

</script>
      <div class="all-new-adition-section">
      <div class="add-new-first-static-section">
         
          <div class="add-new-firdt-sec-static">
            <div class="col-md-6">
            <div class="add-new-first-section-first-part">
              <div class="form-group">
              <div class="col-md-6">
                <label>C/C</label>
                <input type="text" name="cc_new[]" id="cc_new_1" multiple="" required="" placeholder="new C/C" class="form-control">
              </div>
              <div class="add-new-days">
              <div class="col-md-4">
                <label>Days</label>
                <select class="form-control"  name="days_x[]" id="days_x_1">
                  <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
    ?>
<option value="">Days</option>
    <?php 
foreach($days as $row)
    {
?>
<option value="<?php echo $row->id; ?>"><?php echo $row->day; ?></option>
                                                    <?php } ?>
                </select>

              </div> 
              </div>
              <div class="plus-add-btn-all">
              <div class="col-md-2">
                <div class="plus-min-btn">
                  <!-- <span class="min-btn">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                  </span> -->
                  <span class="plus-btn" id="add_new_cc_btn_1" onclick="addNewCCs(1)">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </span>
                </div>
              </div>
              </div>
            </div>
            </div>
<?php for($i=1;$i<10;$i++){ ?>
            <div class="add-new-first-section-loop-add-new" id="add_nw_cc_<?php echo $i; ?>" style="display: none;">
            <div class="add-new-first-section-first-part">
              <div class="form-group">
              <div class="col-md-6">
                <label>C/C</label>
                 <input type="text" name="cc_new[]" id="cc_new_<?php echo $i; ?>" multiple="" required="" placeholder="new C/C" class="form-control">
              </div>
              <div class="add-new-days">
              <div class="col-md-4">
                <label>Days</label>
                <select class="form-control"  name="days_x[]" id="days_x_<?php echo $i; ?>">
                  <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
    ?>
<option value="">Days</option>
    <?php 
foreach($days as $row)
    {
?>
<option value="<?php echo $row->id; ?>"><?php echo $row->day; ?></option>
                                                    <?php } ?>
                </select>

              </div> 
              </div>
              <div class="plus-add-btn-all">
              <div class="col-md-2">
                <div class="plus-min-btn">
                  <span class="min-btn" id="minus" onclick="removeNewCCs(<?php echo $i+1; ?>)">
                    <i class="fa fa-minus"  aria-hidden="true"></i>
                  </span>
                  <span class="plus-btn" id="add_new_cc_btn_<?php echo $i+1; ?>" onclick="addNewCCs(<?php echo $i+1; ?>)">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </span>
                </div>
              </div>
              </div>
            </div>
            </div>

            </div>

            <?php } ?>


      




</div>




                <script type="text/javascript">
  
        




        function edu_produce_file_box_my_new_med(id)
    {
      // alert(id);
         
             var val=id;

             if(val==1)
                {
                      $("#add_my_nw_med_"+val).show();
                      $("#edu_mynew_med_"+val).hide();
                      $("#minus").hide();
                }
          
            
            if(val==2)
                {
                   $("#add_my_nw_med_"+val).show();
                      $("#edu_mynew_med_"+val).hide();
                      $("#minus").hide();
                }
            if(val==3)
                {
                    $("#add_my_nw_med_"+val).show();
                      $("#edu_mynew_med_"+val).hide();
                      $("#minus").hide();
                }
             if(val==4)
                {
                   $("#add_my_nw_med_"+val).show();
                      $("#edu_mynew_med_"+val).hide();
                      $("#minus").hide();
                }
             if(val==5)
                {
                    $("#add_my_nw_med_"+val).show();
                      $("#edu_mynew_med_"+val).hide();
                      $("#minus").hide();
                }   

                 if(val==6)
                {
                    $("#add_my_nw_med_"+val).show();
                      $("#edu_mynew_med_"+val).hide();
                      $("#minus").hide();
                }    
                 if(val==7)
                {
                   $("#add_my_nw_med_"+val).show();
                      $("#edu_mynew_med_"+val).hide();
                      $("#minus").hide();
                }      
                 if(val==8)
                {
                  $("#add_my_nw_med_"+val).show();
                      $("#edu_mynew_med_"+val).hide();
                      $("#minus").hide();
                }    
                 if(val==9)
                {
                    $("#add_my_nw_med_"+val).show();
                      $("#edu_mynew_med_"+val).hide();
                      $("#minus").hide();
                }    
                

            
   
    }


  function edu_hiding_out_my_new_med(val)
  {


        var current_div=val-1; 

        
          $("#add_my_nw_med_"+current_div).hide();
          $("#edu_mynew_med_"+current_div).show();
          $("#minus").show();
       

  }



                                                              

</script>



          </div>



          <!-- mdicine-edit -->
          
 <div class="col-md-6">
          <div class="add-new-second-section-ho-days-static">
          <div class="col-md-6">
            <div class="page-last-ho-sec">
          <label>H/O</label>
         <input type="text" class="form-control" name="ho_new[]" id="ho_new_1" required="" placeholder="new H/O">
          </div>
        </div>
          <div class="col-md-4">
          <label>Days</label>
          <input type="text" class="form-control" name="ho_new_days[]" id="ho_new_days_1" required="" placeholder="">
          </div>
          <div class="plus-add-btn-all">
              <div class="col-md-2">
                <div class="plus-min-btn">
                 <!--  <span class="min-btn">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                  </span> -->
                  <span class="plus-btn" id="add_new_ho_btn_1" onclick="addNewHOs(1)">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </span>
                </div>
              </div>
              </div>
          </div>
          <div class="add-new-second-section-ho-days-loop">
          <?php for($i=0;$i<10;$i++){ ?>
          <div class="add-new-second-section-ho-days-static" style="display: none;" id="add_nw_ho_<?php echo $i; ?>">
          <div class="col-md-6">
            <div class="page-last-ho-sec">
          <label>H/O</label>
          <input type="text" class="form-control" name="ho_new[]" id="ho_new_<?php echo $i; ?>" required="" placeholder="new H/O">
        </div>

          </div>
          <div class="col-md-4">
          <label>Days</label>
          <input type="text" class="form-control" name="ho_new_days[]" id="ho_new_days_<?php echo $i; ?>" required="" placeholder="">
          </div>
          <div class="plus-add-btn-all">
              <div class="col-md-2">
                <div class="plus-min-btn">
                  <span class="min-btn"  id="minus" onclick="remove_hos(<?php echo $i+1; ?>)">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                  </span>
                  <span class="plus-btn" id="add_new_ho_btn_<?php echo $i+1; ?>" onclick="addNewHOs(<?php echo $i+1; ?>)">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </span>
                </div>
              </div>
              </div>
          </div>

          <?php } ?>
  
          </div>

          </div>






          

          </div>


           <script type="text/javascript">
  
        




        function addNewHOs(id)
    {
      // alert(id);
         
             var val=id;

             if(val==1)
                {
                      $("#add_nw_ho_"+val).show();
                      $("#add_new_ho_btn_"+val).hide();
                      $("#minus").hide();
                }
          
            
            if(val==2)
                {
                    $("#add_nw_ho_"+val).show();
                      $("#add_new_ho_btn_"+val).hide();
                      $("#minus").hide();
                }
            if(val==3)
                {
                    $("#add_nw_ho_"+val).show();
                      $("#add_new_ho_btn_"+val).hide();
                      $("#minus").hide();
                }
             if(val==4)
                {
                   $("#add_nw_ho_"+val).show();
                      $("#add_new_ho_btn_"+val).hide();
                      $("#minus").hide();
                }
             if(val==5)
                {
                     $("#add_nw_ho_"+val).show();
                      $("#add_new_ho_btn_"+val).hide();
                      $("#minus").hide();
                }   

                 if(val==6)
                {
                    $("#add_nw_ho_"+val).show();
                      $("#add_new_ho_btn_"+val).hide();
                      $("#minus").hide();
                }    
                 if(val==7)
                {
                   $("#add_nw_ho_"+val).show();
                      $("#add_new_ho_btn_"+val).hide();
                      $("#minus").hide();
                }      
                 if(val==8)
                {
                   $("#add_nw_ho_"+val).show();
                      $("#add_new_ho_btn_"+val).hide();
                      $("#minus").hide();
                }    
                 if(val==9)
                {
                    $("#add_nw_ho_"+val).show();
                      $("#add_new_ho_btn_"+val).hide();
                      $("#minus").hide();
                }    
                

            
   
    }


  function remove_hos(val)
  {


        var current_div=val-1; 

        
          $("#add_nw_ho_"+current_div).hide();
          $("#add_new_ho_btn_"+current_div).show();
          $("#minus").show();
       

  }



                                                              

</script>



<div class="add-new-report-section-all">
  <div class="col-md-12">
    <div class="div-class-report-sec">
      <div class="form-group">
        <div class="col-md-3">
          <label>Report</label>
          <input type="text" name="new_report[]" class="form-control">
        </div>
<div class="div-clas-report-text-sec">
        <div class="col-md-5">
          <label></label>
          <input type="text" name="new_report_write[]" class="form-control">
        </div>
      </div>
        <div class="date-add-report-sec">
        <div class="col-md-3">
          <label></label>
          <input type="text" name="new_report_date[]" class="form-control datepicker">
        </div>
      </div>

         <div class="plus-add-btn-all">
              <div class="col-md-1">
                <div class="plus-min-btn">
                 <!--  <span class="min-btn" onclick="edu_hiding_out_my_new_med" id="minus">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                  </span> -->
                  <span class="plus-btn" id="add_new_report_1" onclick="new_report_plus(1)">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </span>
                </div>
              </div>
              </div>
      </div>

    </div>
  </div>
  </div>




 <script type="text/javascript">
  
        




        function new_report_plus(id)
    {
      // alert(id);
         
             var val=id;

             if(val==1)
                {
                       $("#add_nw_report_"+val).show();
                      $("#add_new_report_"+val).hide();
                      $("#minus").hide();
                }
          
            
            if(val==2)
                {
                     $("#add_nw_report_"+val).show();
                      $("#add_new_report_"+val).hide();
                      $("#minus").hide();
                }
            if(val==3)
                {
                     $("#add_nw_report_"+val).show();
                      $("#add_new_report_"+val).hide();
                      $("#minus").hide();
                }
             if(val==4)
                {
                   $("#add_nw_report_"+val).show();
                      $("#add_new_report_"+val).hide();
                      $("#minus").hide();
                }
             if(val==5)
                { $("#add_nw_report_"+val).show();
                      $("#add_new_report_"+val).hide();
                      $("#minus").hide();
                }   

                 if(val==6)
                {
                     $("#add_nw_report_"+val).show();
                      $("#add_new_report_"+val).hide();
                      $("#minus").hide();
                }    
                 if(val==7)
                {
                    $("#add_nw_report_"+val).show();
                      $("#add_new_report_"+val).hide();
                      $("#minus").hide();
                }      
                 if(val==8)
                {
                    $("#add_nw_report_"+val).show();
                      $("#add_new_report_"+val).hide();
                      $("#minus").hide();
                }    
                 if(val==9)
                {
                    $("#add_nw_report_"+val).show();
                      $("#add_new_report_"+val).hide();
                      $("#minus").hide();
                }    
                

            
   
    }


  function remove_new_report(val)
  {


        var current_div=val-1; 

        
          $("#add_nw_report_"+current_div).hide();
          $("#add_new_report_"+current_div).show();
          $("#minus").show();
       

  }



                                                              

</script>

 <?php for($i=0;$i<10;$i++){ ?>

  <div class="add-new-report-section-all-loop"  style="display: none;" id="add_nw_report_<?php echo $i; ?>">
    <div class="add-new-report-section-all">
  <div class="col-md-12">
    <div class="div-class-report-sec">
      <div class="form-group">
        <div class="col-md-3">
          <label>Report</label>
          <input type="text" name="new_report[]" class="form-control">
        </div>
<div class="div-clas-report-text-sec">
        <div class="col-md-5">
          <label></label>
          <input type="text" name="new_report_write[]" class="form-control">
        </div>
      </div>
        <div class="date-add-report-sec">
        <div class="col-md-3">
          <label></label>
          <input type="text" name="new_report_date[]" class="form-control datepicker">
        </div>
      </div>

         <div class="plus-add-btn-all">
              <div class="col-md-1">
                <div class="plus-min-btn">
                   <span class="min-btn" onclick="remove_new_report(<?php echo $i+1; ?>)" id="minus">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                  </span> 
                  <span class="plus-btn" id="add_new_report_<?php echo $i+1; ?>" onclick="new_report_plus(<?php echo $i+1; ?>)">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </span>
                </div>
              </div>
              </div>
      </div>

    </div>
  </div>
  </div>

  
  


  </div><?php } ?>



          <div class="add-new-second-section">
         <div class="col-md-12">
          <div class="add-new-medicine-second-section-static-part">
            <div class="add-new-first-section-second-part">
            <div class="form-group">
            <div class="col-md-9">
            <label>Medicine</label>
            <input type="text" class="form-control" name="my_new_med[]" id="my_new_med_1"  required="" placeholder="new medicine">
            </div>
            <div class="col-md-2">
              <div class="medicine-days-p-cus-last">
            <label>Days</label>
            <select class="form-control" name="my_new_med_day[]" id="my_new_med_day_1">
             <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
                                                ?>
<option value="">Days</option>
  <?php 
foreach($days as $row)
  {
 ?>
<option value="<?php echo $row->id; ?>"><?php echo 'for '.$row->day; ?></option>
<?php } ?>
            </select>
          </div>
            </div>
           <div class="plus-add-btn-all">
              <div class="col-md-1">
                <div class="plus-min-btn">
                 <!--  <span class="min-btn" onclick="edu_hiding_out_my_new_med" id="minus">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                  </span> -->
                  <span class="plus-btn" id="edu_mynew_med_1" onclick="edu_produce_file_box_my_new_med('1')">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </span>
                </div>
              </div>
              </div>
            </div>

            </div>
            </div>
            <div class="add-new-secopnd-medicine-sectio-second-part-loop">
<?php for($i=1;$i<10;$i++){ ?>

             <div class="add-new-first-section-second-part" style="display: none;" id="add_my_nw_med_<?php echo $i; ?>">
            <div class="form-group">
            <div class="col-md-9">
            <label>Medicine</label>
            <input type="text" class="form-control" name="my_new_med[]" id="my_new_med_<?php echo $i; ?>"  required="" placeholder="new medicine">
            </div>
            <div class="col-md-2">
              <div class="medicine-days-p-cus-last">
            <label>Days</label>
            <select class="form-control" name="my_new_med_day[]" id="my_new_med_day_<?php echo $i; ?>">
             <?php $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
                                                ?>
<option value="">Days</option>
  <?php 
foreach($days as $row)
  {
 ?>
<option value="<?php echo $row->id; ?>"><?php echo 'for '.$row->day; ?></option>
<?php } ?>
            </select>
          </div>
            </div>
           <div class="plus-add-btn-all">
              <div class="col-md-1">
                <div class="plus-min-btn">
                  <span class="min-btn" onclick="edu_hiding_out_my_new_med(<?php echo $i+1; ?>)" id="minus">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                  </span>
                  <span class="plus-btn" id="edu_mynew_med_<?php echo $i+1; ?>" onclick="edu_produce_file_box_my_new_med(<?php echo $i+1; ?>)">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </span>
                </div>
              </div>
              </div>
            </div>

            </div>

            <?php } ?>

            </div>
          </div>
         


          </div>



<div class="all-gen-abd-chest-p-cus">
           <div class="add-new-second-section">
         <div class="col-md-6">
          <div class="add-new-second-section-general-days-static">
          <div class="col-md-6">
          <label>General</label>
         <input type="text" class="form-control" name="gen_new" id="gen_new" multiple="" required="" placeholder="new General">
          </div>
          <div class="abd-add-new-sec">
          <div class="col-md-6">
          <label>Abd</label>
          <input type="text" class="form-control" name="abd_new" id="abd_new" multiple="" required="" placeholder="new ABD">
          </div>
        </div>
           
          </div>
         
          </div>
          <div class="col-md-6">
          <div class="add-new-second-section-general-days-static">
          <div class="col-md-6">
          <label>Chest</label>
         <input type="text" class="form-control" name="chest_new" id="gen_new" multiple="" required="" placeholder="new General">
          </div>
          <div class="col-md-6">
          <label>Heart</label>
          <input type="text" class="form-control" name="heart_new" id="abd_new" multiple="" required="" placeholder="new ABD">
          </div>
           
          </div>
         
          </div>

<div class="cns-coun-dia-p-last">
           <div class="col-md-6">
          <div class="add-new-second-section-general-days-static">
          <div class="col-md-6">
          <label>CNS</label>
        <input type="text" name="cns_new" id="cns_new" multiple="" class="form-control">
          </div>
          <div class="abd-add-new-sec">
          <div class="col-md-6">
           <label>Diagnosis</label>
          <input type="text" name="diagnosis_name" id="diagnosis_name" multiple="" class="form-control">
          </div>
        </div>
           
          </div>
         
          </div>



           <div class="col-md-6">
          <div class="add-new-second-section-general-days-static">
          <div class="col-md-6">
            <label>Counsel</label>
           <input type="text" name="councilling_name" id="councilling_name" multiple="" class="form-control">
          </div>
          <div class="abd-add-new-sec">
          <div class="col-md-6">
            <label>Invest</label>
           <input type="text" name="investigation_name" id="investigation_name" multiple="" class="form-control">
          </div>
        </div>
           
          </div>
         
          </div>
        </div>



          


          </div>
        </div>



        
        </div>
    </form>

  

</div>

</div>




<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.js"></script>
<script  type="text/javascript">
  document.getElementById('output').innerHTML = location.search;
$(".chosen-select").chosen();

</script>
<script type="text/javascript">


$(".dropdown dt a").on('click', function () {
          $(".dropdown dd ul").slideToggle('fast');
      });

      $(".dropdown dd ul li a").on('click', function () {
          $(".dropdown dd ul").hide();
      });

      function getSelectedValue(id) {
           return $("#" + id).find("dt a span.value").html();
      }

      $(document).bind('click', function (e) {
          var $clicked = $(e.target);
          if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
      });


      $('.mutliSelect input[type="checkbox"]').on('click', function () {
        
          var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
              title = $(this).val() + ",";
        
          if ($(this).is(':checked')) {
              var html = '<span title="' + title + '">' + title + '</span>';
              $('.multiSel').append(html);
              $(".hida").hide();
          } 
          else {
              $('span[title="' + title + '"]').remove();
              var ret = $(".hida");
              $('.dropdown dt a').append(ret);
              
          }
      });
</script>

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
    $('#doc_add_form7').attr('onchange', 'valid_form()');
    $('#doc_add_form7').attr('onkeyup', 'valid_form()');

     valid_form();
    //alert($('#contact_form .red_border').size());

    if ($('#doc_add_form7 .red_border').size() > 0)
    {
      $('#doc_add_form7 .red_border:first').focus();
      $('#doc_add_form7 .alert-error').show();
      return false;
    } else {

      $('#doc_add_form7').submit();
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

                   


                   node+=' <input type="checkbox"  name="medicine'+index+'[]" id="medicine_'+i+'" value="'+data[i].medicine_id+'" ><span class="dd-nc"> '+data[i].medicine_name+'</span>'


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