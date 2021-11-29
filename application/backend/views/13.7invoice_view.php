<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body lang=EN-US link="#0563C1" vlink=green style="font-family:'PTS75F', 'ptn57f', 'pt sans regular', 'pt sans narrow bold', 'streamline small cs', 'pt sans italic', 'pt sans bold italic', 'pt sans bold', 'flexslider icon', sans-serif; font-size:11pt">








      <table style="width: 1500px;margin: 0 0 0 0%;background-color: #fff;padding: 0px;">
        <tr style="text-align: center;">
            <th >
              <p style="font-size: 20px;text-align: center;font-weight: 600;margin: 10px 0;color: #333;">ID: 
                <?php  $data['user_detail']=  $this->common->select($table_name='tbl_user',$field=array(), $where=array('user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

                echo @$data['user_detail'][0]->user_unique_id;

                ?></p> 
              </th>
              <th><p style="font-size: 20px;text-align: center;font-weight: 600;margin: 10px 0 ;color: #333;"> <?php echo @$data['user_detail'][0]->first_name." ".@$data['user_detail'][0]->last_name; ?>, <?php echo @$data['user_detail'][0]->age; ?> Yrs/<?php echo @$data['user_detail'][0]->gender; ?></p>
               </th> 

                
              <th>

              <p style="font-size: 20px;text-align: center;font-weight: 600;margin: 10px 0 ;color: #333;">
<?php if(@$data['user_detail'][0]->weight !=0 && @$data['user_detail'][0]->bmi != 0){ ?>
              wt: <?php echo @$data['user_detail'][0]->weight; ?>kg., BMI: <?php echo @$data['user_detail'][0]->bmi; ?>, 


 <?php } ?>
              <?php  echo @$data['user_detail'][0]->city; ?>



              </p>
            </th>
           

        <th >
              <p style="font-size: 20px;text-align: center;font-weight: 600;margin: 10px 0;color: #333;"><?php
                  $originalDate = @$prescription[0]->created_date;
                   $newDate = date("d-m-y", strtotime($originalDate));

              echo $newDate;

               ?></p>
         </th>
          </tr>
        
      </table>

      <table style="width: 1400px; margin: 0 0 0 0%;background-color: #fff;padding: 40px 10px; ">
        
        <tr>
          <td colspan="2">

         <?php    $data['diagnosis']=  $this->common->select($table_name='tbl_patient_diagnosis',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
   


         if(count($data['diagnosis']) > 0)
         { ?>
          <p style="font-size: 22px;text-align: center;font-weight: bold;margin: 10px 0;color: #000;"><u>Diagnosis</u> :</p>
            <br>
              <ul>

               <?php  

   

           foreach($data['diagnosis'] as $row)
           {

              $data['user_diagnosis']=  $this->common->select($table_name='tbl_diagnosis',$field=array(), $where=array('diagnosis_id'=>@$row->diagnosis_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
    ?>
                <li style="padding: 8px;font-size: 20px; color: #222;padding: 10px; "><b><?php echo @$data['user_diagnosis'][0]->diagnosis_name; ?></b></li><br>

                <?php } }?>
               <!--  <li style="padding: 8px;font-size: 20px; color: #222;padding: 10px; ">Hypertension</li><br>
                <li style="padding: 8px;font-size: 20px; color: #222;padding: 10px; ">Chronic Kidney Disease stage V</li> -->

                <br>
                
              </ul>
          </td>
        </tr>
        <tr>


          <td style="vertical-align: top; ">


          	<table style="width:100%">
			 
			  <tr>
			    <td style="width: 240px;padding-bottom: 10px;">
			    	<p style="font-size: 22px;text-align: center;font-weight: bold;margin: 20px 0 10px;color: #000;">C/C :</p>
			    </td>
			    <td style="padding-bottom: 10px;">
			    	<?php  

         $data['cc']=  $this->common->select($table_name='tbl_patient_cc',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


         if(count($data['cc'])>0)
         {

          
        ?>
            

            <?php 
               foreach($data['cc'] as $row)
           {

              $data['user_cc']=  $this->common->select($table_name='tbl_cc',$field=array(), $where=array('cc_id'=>@ $row->cc_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

              $data['day']=  $this->common->select($table_name='tbl_time',$field=array(), $where=array('id'=>@ $row->day_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
            ?>

           
            <p style="padding: 8px;font-size: 20px; color: #222;padding: 10px;"><?php echo @$data['user_cc'][0]->cc_name; ?> since <?php echo @$data['day'][0]->day; ?></p><br>

             <?php } } ?>
			    </td> 
			  </tr>

			  <tr>
			  	<?php  

         $data['kpo']=  $this->common->select($table_name='tbl_patient_kpo',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


             if(count($data['kpo'])>0)
             {

           
          ?>
			    <td style="width: 240px;padding-bottom: 10px;"><p style="font-size: 22px;text-align: center;font-weight: bold;margin: 20px 0 10px;color: #000;">
            Known patient of :</p><br></td>

			    <td style="padding-bottom: 10px;">
			<?php 

                foreach($data['kpo'] as $row)
           {

              $data['user_kpo']=  $this->common->select($table_name='tbl_kpo',$field=array(), $where=array('kpo_id'=>@$row->kpo), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
          ?>

             <p style="padding: 8px;font-size: 20px; color: #222;padding: 10px;"><?php echo @$data['user_kpo'][0]->kpo_name; ?></p><br>
            <?php } } ?></td>
			  </tr>



			  <tr>
			  	<?php    $data['ho']=  $this->common->select($table_name='tbl_patient_ho',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
   


         if(count($data['ho'])>0)
         { ?>
			    <td style="width: 240px; padding-bottom: 10px"><p style="font-size: 22px;text-align: center;font-weight: bold;margin: 0px 0 10px;color: #000;">
             Medical History :</p><br>
			    </td>
			    <td style="padding-bottom: 10px;"><?php 

                foreach($data['ho'] as $row)
           {

              $data['user_ho']=  $this->common->select($table_name='tbl_ho',$field=array(), $where=array('ho_id'=>@$row->ho_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

               $data['day']=  $this->common->select($table_name='tbl_time',$field=array(), $where=array('id'=>@ $row->day_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
          ?>

            <p style="padding: 8px;font-size: 20px; color: #222;padding: 10px;"><?php echo @$data['user_ho'][0]->ho_name; ?> - <?php echo @$row->day_id; ?></p><br>
 <?php } } ?></td> 
			  </tr>
			  <tr>
			  	<td style="width: 240px;padding-bottom: 10px;">
			    	<p style="font-size: 22px;text-align: center;font-weight: bold;margin: 20px 0 10px;color: #000;">
            Examination :</p>
			    </td>
			    <td></td>
			  </tr>

			  <tr>
			  	 <?php
 $data['gen_exam']=  $this->common->select($table_name='tbl_patient_gen_exam',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     if(count($data['gen_exam'])>0)
     {
      ?>
			    <td style="width: 120px;padding-bottom: 10px;">
			    	<!-- <p style="font-size: 22px;text-align: center;font-weight: bold;margin: 20px 0 10px;color: #000;">
            Examination :</p> -->
			    </td>
			    <td style="padding-bottom: 10px;"><p style="padding: 8px;font-size: 20px; color: #222;padding: 10px 10px 10px 100px;"><?php

foreach($data['gen_exam'] as $row)
     {
       $data['exam']=  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$row->gen_exam), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

 ?>
<?php $result .=@$data['exam'][0]->examination_name.','; $result = rtrim($result,','); echo $result; ?>
 <?php } } ?><br></td>
			  </tr>
			  <tr>
			  	<?php if(@$prescription[0]->bp_upper !="" && @$prescription[0]->bp_lower) { ?>
			    <td style="width: 120px;padding-bottom: 10px;">
			    	<p style="font-size: 20px; color: #222;"><b style="width:100px;">BP</b></p>
			    </td>
			    <td style="padding-bottom: 10px;font-size: 20px; color: #222;"><p>: <?php echo @$prescription[0]->bp_upper; ?>/<?php echo @$prescription[0]->bp_lower; ?> mm of Hg<?php } ?></p></td> 
			  </tr>
			  <tr><?php if(@$prescription[0]->pulse != "" || @$prescription[0]->pulse != 0){ ?>
			    <td style="width: 120px;padding-bottom: 10px;">
			    	<p style="padding: 0px 8px 8px;font-size: 20px; color: #222;padding: 0px 10px 10px;"><b>Pulse</b></p>
			    </td>
			    <td style="padding-bottom: 10px;"><p style="font-size: 20px; color: #222;">: <?php echo @$prescription[0]->pulse; ?>/min <?php echo @$prescription[0]->pulse_type; ?></p><?php } ?><br></td>
			  </tr>
			  <tr>
			  	<?php  

     $data['chest_exam']=  $this->common->select($table_name='tbl_patient_chest',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     if(count($data['chest_exam'])>0)
     {

     
     ?>
			    <td style="width: 120px; padding-bottom: 10px;">
			    	<p style="padding: 8px;font-size: 20px; color: #222;padding: 10px;"><b style="width: 100px;">Chest :</b></p>
			    </td>
			    <td style="padding-bottom: 10px;font-size: 20px; color: #222;"> <?php 

            foreach($data['chest_exam'] as $row)
              {
       $data['exam_chest']=  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$row->chest_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

$result1 .=@$data['exam_chest'][0]->examination_name.','; $result1 = rtrim($result1,','); echo $result1;

             ?> <?php } ?><?php }   else { ?>

            <p style="padding: 8px;font-size: 20px; color: #222;padding: 10px;"><b style="width: 100px;">Chest :</b> NAD</p>


            <?php } ?>


            </td> 
			  </tr>
			  <tr>
			  	<?php  

     $data['heart_exam']=  $this->common->select($table_name='tbl_patient_heart',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     if(count($data['heart_exam'])>0)
     {

     
     ?>
			    <td style="width: 120px;padding-bottom: 10px;">
			    	<p style="padding: 8px;font-size: 20px; color: #222;padding: 10px;">
              <b style="padding-right: 100px;">Heart :</b></p>  

			    </td>
			    <td style="padding-bottom: 10px;font-size: 20px; color: #222;"><p style="font-size: 20px; color: #222;><?php 

            foreach($data['heart_exam'] as $row)
              {
       $data['exam_heart']=  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$row->heart_exam_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

$result2 .=@$data['exam_heart'][0]->examination_name.','; $result2 = rtrim($result2,','); echo $result2;

            ?><?php }  ?></p><?php } else { ?></td>
			  </tr>
			  <tr>
			    <td style="width: 240px;padding-bottom: 10px">
			    	<p style="padding: 8px;font-size: 20px; color: #222; padding: 10px; ">
              <b style="">Heart :</b></p>

			    </td>
			    <td style="padding-bottom: 10px; font-size: 20px; color: #222;"><p> NAD</p>
            <?php } ?></td> 
			  </tr>


			  <tr>
			  	<?php  

     $data['abd_exam']=  $this->common->select($table_name='tbl_patient_abd',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     if(count($data['abd_exam'])>0)
     {

     
     ?>
			    <td style="width: 120px;padding-bottom: 10px;">
			    	<p style="padding: 8px;font-size: 20px; color: #222;padding: 10px;"><b >Abd :</b>
			    </td>
			    <td style="padding-bottom: 10px;font-size: 20px; color: #222;width: 400px;"> <?php

                  foreach($data['abd_exam'] as $row)
                     {
                       $data['abd']=  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$row->abd_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
             ?>


           <?php 

           $result3 .=@$data['abd'][0]->examination_name.','; $result3 = rtrim($result3,','); echo $result3;

          

           ?>

 <?php }  ?>
            

            <?php }  else { ?>
               <p style="padding: 8px;font-size: 20px; color: #222;padding: 10px;"><b style="width: 100px;">Abd :</b> NAD</p>
            <?php } ?>


            
        </td>
			  </tr>


			  <tr>
			  	 <?php  

     $data['cns_exam']=  $this->common->select($table_name='tbl_patient_cns',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     if(count($data['cns_exam'])>0)
     {

     
     ?>
			    <td style="width: 120px;padding-bottom: 10px;">
			    	<p style="padding: 8px;font-size: 20px; color: #222;padding: 10px;"><b style="width: 100px;">CNS :</b></p>
			    </td>
			    <td style="padding-bottom: 10px;"><?php
      foreach($data['cns_exam'] as $row)
     {
       $data['cns']=  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$row->cns_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
 ?>
            <?php

            $result4 .=@$data['cns'][0]->examination_name.','; $result4 = rtrim($result4,','); echo $result4;

           

             ?>

            <?php } ?>
            
          

          <?php } else { ?></td>
			  </tr>


			  <tr>
			    <td style="width: 120px;padding-bottom: 10px;">
			    	 <p style="padding: 8px;font-size: 20px; color: #222;padding: 10px;"><b style="width: 100px;">CNS :</b></p>
			    </td>
			    <td style="padding-bottom: 10px;"><p>NAD</p><br></td>
			     <?php } ?>
			  </tr>

			  <tr>
			  	 <?php  

     $data['report']=  $this->common->select($table_name='tbl_patient_report',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     if(count($data['report'])>0)
     {

      
?>
			    <td style="width: 240px;padding-bottom: 10px;">
			    	<p style="font-size: 22px;text-align: center;font-weight: bold;margin: 20px 0 10px;color: #000;">
            Reports:</p>
			    </td>
			    <td style="padding-bottom: 10px;"><?php 
              foreach($data['report'] as $row)
                  {
             ?>
            <p style="padding: 8px;font-size: 20px; color: #222;padding: 10px;line-height: 22px;"><?php echo $row->content; ?>- <b><?php echo $row->description; ?></b>

           <?php if(@$row->date != "0000-00-00") { ?> ( 

            <?php 

             $originalDate1 = @$row->date;
                   $newDate1 = date("d-m-y", strtotime($originalDate1));

            echo $newDate1; 


            ?> 

            )<?php } ?>

            </p>

            <?php } } ?>
</td>
			  </tr>
			</table>


             
 

             



            

            


             
  
             

           

            

             



         


          


            

            


            



         <!--    <p style="padding: 8px;font-size: 20px; color: #222;padding: 10px;">Urea – 120, creatinine- 10 (15.3.19)</p><br> -->


         
          </td>



























          <td style="border-left:1px solid #333; padding:0 20px 20px; vertical-align: top;">

           <?php 
$i=0;
            $data['med']=  $this->common->select($table_name='tbl_patient_medicine',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
if(count($data['med'])>0)
{

 

              ?>
          <p style="font-size: 22px;text-align: center;font-weight: bold;margin: -20px 0 100px;color: #000;"><u>ADVICE :</u></p><br>
         
          
     <?php  

     $data['inves']=  $this->common->select($table_name='tbl_patient_investigation',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


         if(count($data['inves'])>0)
         {

          
    ?>

            <p style="font-size: 22px;text-align: center;font-weight: bold;margin: 20px 0 10px;color: #000;">
            Investigtions :</p><br>

<?php 
       foreach($data['inves'] as $row)
           {

              $data['user_inves']=  $this->common->select($table_name='tbl_investigations',$field=array(), $where=array('investigation_id'=>@$row->investigation_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
 ?>
            <p style="padding: 8px;font-size: 20px; color: #222;padding: 10px;line-height: 20px;"><?php echo @$data['user_inves'][0]->investigation_name; ?></p>

            <?php }  } ?>

          <ol><br>
<p style="font-size: 22px;text-align: center;font-weight: bold;margin: 20px 0 10px;color: #000;">
            Medicine :</p><br>
          <?php
                  foreach($data['med'] as $row)
           {
              $i++;
              $data['med_name']=  $this->common->select($table_name='tbl_medicine',$field=array(), $where=array('medicine_id'=>@$row->medicine_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
           ?>
            <li style="padding: 0px 8px;  margin: 5px 0px 0px 0px; font-size: 20px; color: #222;"><?php echo @$data['med_name'][0]->medicine_name; ?> <?php if($row->group_id == 0) { echo ' for '; } else {  } ?> <?php echo @$row->dose; ?></li><br><?php } } ?>
           
          </ol>
          <br>


          <?php  

     $data['diet']=  $this->common->select($table_name='tbl_patient_diet',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     if(count($data['diet'])>0)
     {

     
     ?>
          <p style="font-size: 22px;text-align: center;font-weight: bold;margin: 20px 0 10px;color: #000;">Diet:</p>
          

<?php

    foreach($data['diet'] as $row)
     {
       $data['user_diet']=  $this->common->select($table_name='tbl_diet',$field=array(), $where=array('diet_id'=>@$row->diet_id ), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
 ?>
          <p style="padding: 8px;font-size: 20px; color: #222;padding: 10px;"> - <?php echo @$data['user_diet'][0]->diet_name; ?></p>

          <?php } }?>




          


          <br>

          <?php  

     $data['coun']=  $this->common->select($table_name='tbl_patient_councelling',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

if(count($data['coun'])>0)
{

     
     ?>
          <p style="font-size: 22px;text-align: center;font-weight: bold;margin: 20px 0 10px;color: #000;">Counselling : </p>
          
<?php

      foreach($data['coun'] as $row)
     {


       $data['councelling']=  $this->common->select($table_name='tbl_councelling',$field=array(), $where=array('councelling_id'=>@$row->councelling_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
 ?>

          <p style="padding: 8px;font-size: 20px; color: #222;padding: 10px;"> - <?php echo @$data['councelling'][0]->councelling_name; ?> </p>

<?php } } ?>
          <br>

          
        
          <p style="font-size: 22px;text-align: center;font-weight: bold;margin: 20px 0 10px;color: #000;">Review 
            <span style="font-weight: normal; color: #222;"><?php if(@$prescription[0]->check_next_date !="0000-00-00"){ ?>on <?php echo @$prescription[0]->check_next_date; ?><?php } else { echo 'after '.$prescription[0]->feedback; ?><?php } ?> </span>

            </p>
          

          <br>
          </td>
        </tr>
      </table>
        
<table style="width: 1400px; margin: 0 0 0 0%;background-color: #fff;padding: 40px 10px; margin-top: 20%;">
  <tr style="text-align: center;">
          <td style="width:50%; text-align: right; ">
            
            
           
            
           
          </td>
          <td style="width:50%; text-align:right; ">
          
           
           <p style="font-size: 16px;font-weight: bold;margin: 20px 0 10px;color: #000;">Dr Sajjad Hossain</p>
          </td>
        </tr>
      </table>


<table style="width: 1400px; margin: 0 0 0 0%;background-color: #fff;padding: 40px 10px; margin-top: 20%;">
  <tr style="text-align: center;">
          <td style="width:50%; text-align: right; ">
            
            
           
            <?php if(@$prescription[0]->feedback != ""){ ?>
             <p style="font-size: 16px;font-weight: bold;margin: 20px 0 10px;color: #000;">* This Prescription is valid for <?php echo @$prescription[0]->feedback; ?> *</p><?php } ?>
           
          </td>
          <td style="width:50%; text-align:right; ">
          
           
          </td>
        </tr>
      </table>






















</body>
</html>