<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style>
  @font-face {
    font-family: 'Times New Roman';
    src: url('../assets/fonts/TimesNewRomanPSMT.woff2') format('woff2'),
        url('../assets/fonts/TimesNewRomanPSMT.woff') format('woff');
    font-weight: normal;
    font-style: normal;
}
</style>
</head>
<body lang=EN-US link="#0563C1" vlink=green style=" font-family: 'Times New Roman';font-size: 14px;">





<!-- 
   <table style="width: 1500px;margin: 0 0 0 0%;background-color: #fff;padding: 0px;">
        <tr style="text-align: center;">
            <th >
              <p style="font-size: 40px;text-align: center;font-weight: 600;margin: 10px 0;color: #333;">ID: 
                <?php  $data['user_detail']=  $this->common->select($table_name='tbl_user',$field=array(), $where=array('user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

                echo @$data['user_detail'][0]->user_unique_id;

                ?></p> 
              </th>
              <th><p style="font-size: 40px;text-align: center;font-weight: 600;margin: 10px 0 ;color: #333;"> <?php echo @$data['user_detail'][0]->first_name." ".@$data['user_detail'][0]->last_name; ?>, <?php echo @$data['user_detail'][0]->age; ?> Yrs/<?php echo @$data['user_detail'][0]->gender; ?></p>
               </th> 

                
              <th>

              <p style="font-size: 40px;text-align: center;font-weight: 600;margin: 10px 0 ;color: #333;">
		<?php if(@$data['user_detail'][0]->weight !=0 && @$data['user_detail'][0]->bmi != 0){ ?>
              wt: <?php echo @$data['user_detail'][0]->weight; ?>kg., BMI: <?php echo @$data['user_detail'][0]->bmi; ?>, 


 		<?php } ?>
              <?php  echo @$data['user_detail'][0]->city; ?>



              </p>
            </th>
           

        <th >
              <p style="font-size: 40px;text-align: center;font-weight: 600;margin: 10px 0;color: #333;"><?php
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
          <p style="font-size: 40px;text-align: center;font-weight: bold;margin: 10px 0;color: #000;"><u>Diagnosis</u> :</p>
            <br>
            <table>
				  <tr>
				    <th style="width: 50px;"></th>
				    <th style="text-align: left;">
              <ul>

               <?php  

   

           foreach($data['diagnosis'] as $row)
           {

              $data['user_diagnosis']=  $this->common->select($table_name='tbl_diagnosis',$field=array(), $where=array('diagnosis_id'=>@$row->diagnosis_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
    		?>
                <li style="padding: 8px;font-size: 40px; color: #222;padding-bottom: 10px; "><b><?php echo @$data['user_diagnosis'][0]->diagnosis_name; ?></b></li>

                <?php } }?>
               

                <br>
                
              </ul>
              </th>
				    
				  </tr>
				  
				  
				</table>
          </td>
        </tr>
        <tr>


          <td style="vertical-align: top; ">


          	<table style="width:100%">
			 
			  <tr>
			    <td style="width: 240px;padding-bottom: 10px;"><p style="font-size: 40px;text-align: center;font-weight: bold;margin: 40px 0 10px;color: #000;">C/C :</p>
			    	<table>
			          <tr>
			            <th style="width: 50px;"></th>
			            <th style="text-align: left;">
			            	<ul>
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
            <li style="padding: 8px;font-size: 40px; color: #222;padding: 10px; ">
            	<?php echo @$data['user_cc'][0]->cc_name; ?> since <?php echo @$data['day'][0]->day; ?>

             <?php } } ?>
            </li></ul>
           
            
			            </th>
			        </tr>
			      </table>
			    	
			    	





			    </td>
			    <td style="padding-bottom: 10px;">
			    	
			    </td> 
			  </tr>

			  <tr>

			  	

			  	
			    <td style="width: 240px;padding-bottom: 10px;">
			    	<p style="font-size: 40px;text-align: center;font-weight: bold;margin: 40px 0 10px;color: #000;">
            Known patient of :</p>
			    	<table>
				          <tr>
				            <th style="width: 50px;"></th>
				            	<?php  

         $data['kpo']=  $this->common->select($table_name='tbl_patient_kpo',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


             if(count($data['kpo'])>0)
             {

           
          ?>
				            <th style="text-align: left;">
				            	<ul>
				              <?php 

                foreach($data['kpo'] as $row)
           {

              $data['user_kpo']=  $this->common->select($table_name='tbl_kpo',$field=array(), $where=array('kpo_id'=>@$row->kpo), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
          ?>

             <li style="padding: 8px;font-size: 40px; color: #222;padding-bottom: 10px; "><?php echo @$data['user_kpo'][0]->kpo_name; ?></li>
            <?php } } ?>	</ul>
				            </th>
				        </tr>
				      </table>

			    	</td>

			    <td style="padding-bottom: 10px;">
			


        </td>
			  </tr>



			  <tr>
			  	<?php    $data['ho']=  $this->common->select($table_name='tbl_patient_ho',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
   


         if(count($data['ho'])>0)
         { ?>
			    <td style="width: 240px; padding-bottom: 10px"><p style="font-size: 40px;text-align: center;font-weight: bold;margin: 0px 0 10px;color: #000;">
             Medical History :</p>
             	<table>
		          <tr>
		            <th style="width: 50px;"></th>
		            <th style="text-align: left;">
		            	<ul>
		              <?php 

                foreach($data['ho'] as $row)
           {

              $data['user_ho']=  $this->common->select($table_name='tbl_ho',$field=array(), $where=array('ho_id'=>@$row->ho_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

               $data['day']=  $this->common->select($table_name='tbl_time',$field=array(), $where=array('id'=>@ $row->day_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
          ?>

            <li style="padding: 8px;font-size: 40px; color: #222;padding: 10px; "><?php echo @$data['user_ho'][0]->ho_name; ?> - <?php echo @$row->day_id; ?></li><br>
 		<?php } } ?> </ul>
		            </th>
		        </tr>
		      </table>
			    </td>
			    <td style="padding-bottom: 10px;">
			    	</td> 
			  </tr>
			  <tr>
			  	<td style="width: 240px;padding-bottom: 10px;">
			    	<p style="font-size: 40px;text-align: center;font-weight: bold;margin: 40px 0 10px;color: #000;">
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
			    <td colspan="2" style="width:80px;padding-bottom: 10px;">
			    	
			    	<table>
				          <tr>
				            <th style="width: 90px;text-align: left;"><p style="font-size: 40px; color: #222;"><b style="">General </b></p></th>
				            <th style="text-align: left; font-size: 40px; color: #555;font-weight: 100;"> :
				            	<?php

		foreach($data['gen_exam'] as $row)
     {
       $data['exam']=  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$row->gen_exam), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

 		?>
			<?php $result .=@$data['exam'][0]->examination_name.','; } $result = rtrim($result,','); echo $result; ?>
 			<?php  } ?><br>
				            </th>
				            <th style="width: 90px;text-align: left;"></th>
				            <th style="text-align: left; font-size: 40px; color: #555;font-weight: 100;"></th>
				        </tr>
				      </table>



            
			    </td>















			  </tr>
			  <tr>
			  	
			    <td colspan="2" style="width: 10px;padding-bottom: 10px;">

			    	<table>
				          <tr>
				          	<?php if(@$prescription[0]->bp_upper !="" && @$prescription[0]->bp_lower !=0) { ?>
				            <th style="width: 90px;text-align: left;"><p style="font-size: 40px; color: #222;"><b>BP</b></p></th>
				            <th style="text-align: left; font-size: 40px; color: #555;font-weight: 100;">
				              <p > : <?php echo @$prescription[0]->bp_upper; ?>/<?php echo @$prescription[0]->bp_lower; ?> mm of Hg ,</p>
				            </th><?php } else{ ?>
				            	<th style="width: 0px;text-align: left;"></th>
            					<th style="text-align: left; font-size: 40px; color: #555;font-weight: 100;"></th>


				            <?php } ?>

				            <?php if(@$prescription[0]->pulse_type != "" || @$prescription[0]->pulse != 0){ ?>
				             <th style="width: 80px; text-align: left;"><p style="padding: 0px 8px 8px;font-size: 40px; color: #222;padding: 0px 10px 10px;"><b>Pulse</b></p></th>
				             <th style="text-align: left; font-size: 40px; color: #555;font-weight: 100;">
				             	
				             		<p>: <?php echo @$prescription[0]->pulse; ?>/min <?php echo @$prescription[0]->pulse_type; ?></p><br>
				             </th>

				             <?php } else { ?>
				             		<th style="width: 0px;text-align: left;"></th>
            					<th style="text-align: left; font-size: 40px; color: #555;font-weight: 100;"></th>

				             <?php }?>
				        </tr>
				      </table>
			    	


			    </td> 
			  </tr>
			  
			  <tr>
			  	<?php  

     $data['chest_exam']=  $this->common->select($table_name='tbl_patient_chest',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     if(count($data['chest_exam'])>0)
     {

     
     ?>
			    <td colspan="2" style="width: 10px; padding-bottom: 10px;">
			    	<table>
			          <tr>
			            <th style="width: 90px;text-align: left;"><p style="padding: 8px;font-size: 40px; color: #222;padding: 10px;"><b style="width: 100px;">Chest </b></p></th>
			            <th style="text-align: left; font-size: 40px; color: #555;font-weight: 100;">
			            	: <?php 

            foreach($data['chest_exam'] as $row)
              {
       $data['exam_chest']=  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$row->chest_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

		$result1 .=@$data['exam_chest'][0]->examination_name.','; } $result1 = rtrim($result1,','); echo $result1;

             ?> <?php }   else { ?>

            <p style="padding: 8px;font-size: 40px; color: #222;padding: 10px;"><b style="width: 100px;">Chest :</b> NAD</p>


            <?php } ?>
			            </th>
			            <th style="width: 90px;text-align: left;"></th>
			            <th style="text-align: left; font-size: 40px; color: #555;font-weight: 100;"></th>
			        </tr>
			      </table>
			    	
			    </td>
			    
			  </tr>


        








			  <?php  

		     $data['heart_exam']=  $this->common->select($table_name='tbl_patient_heart',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

		     if(count($data['heart_exam'])>0)
		     {

		     
		     ?>
			  <tr>
			  	
			    <td colspan="2" style="width: 140px;padding-bottom: 10px;">
			    	
			    		<table>
				          <tr>
				            <th style="width: 90px;text-align: left;"><p style="padding: 8px;font-size: 40px; color: #222;padding: 10px;">
              		<b style="padding-right: 100px;">Heart </b></p> </th>

				            <th style="text-align: left; font-size: 40px; color: #555;font-weight: 100;">
				            	<p style="font-size: 40px; color: #222;"> : <?php 

            foreach($data['heart_exam'] as $row)
              {
       $data['exam_heart']=  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$row->heart_exam_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

			$result2 .=@$data['exam_heart'][0]->examination_name.','; } $result2 = rtrim($result2,','); echo $result2;

            ?></p>
 			
            
              
            
				            </th>
				            <th style="width: 90px;text-align: left;"></th>
				            <th style="text-align: left; font-size: 40px; color: #555;font-weight: 100;"></th>
				        </tr>
				      </table>
			    </td>
			    
			  </tr>

			  <?php } else { ?>
			  	<tr>
			  		<td colspan="2" style="width: 140px;padding-bottom: 10px;">
			  			<table>
			          <tr>
			            <th style="width: 90px;text-align: left;"> <p style="padding: 8px;font-size: 40px; color: #222; padding: 10px; ">
              <b style="">Heart</b></p></th>
			            <th style="text-align: left; font-size: 40px; color: #555;font-weight: 100;">
			            	 <p style="padding: 8px;font-size: 40px; color: #222;padding: 10px;"><b style="width: 100px;"></b> :  NAD</p>
			            </th>
			            <th style="width: 90px;text-align: left;"></th>
			            <th style="text-align: left; font-size: 40px; color: #555;font-weight: 100;"></th>
			        </tr>
			      </table>
			  		</td>
			  	</tr>
			  	<?php } ?>











			  <?php  

				     $data['abd_exam']=  $this->common->select($table_name='tbl_patient_abd',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

				     if(count($data['abd_exam'])>0)
				     {

				   
				     ?>
			  <tr>
			  	
			    <td colspan="2" style="width: 140px;padding-bottom: 10px;">
			    	
			    		<table>
				          <tr>
				            <th style="width: 90px;text-align: left;"><p style="padding: 8px;font-size: 40px; color: #222;padding: 10px;"><b >Abd </b></th>

				            <th style="text-align: left; font-size: 40px; color: #555;font-weight: 100;">
				            	: <?php

                  foreach($data['abd_exam'] as $row)
                     {
                       $data['abd']=  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$row->abd_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
             ?>
           <?php 
           $result3 .=@$data['abd'][0]->examination_name.','; } $result3 = rtrim($result3,','); echo $result3;
           ?>
 			
            
              
            
				            </th>
				            <th style="width: 90px;text-align: left;"></th>
				            <th style="text-align: left; font-size: 40px; color: #555;font-weight: 100;"></th>
				        </tr>
				      </table>
			    </td>
			    
			  </tr>

			  <?php }  else { ?>
			  	<tr>
			  		<td colspan="2" style="width: 140px;padding-bottom: 10px;">
			  			<table>
			          <tr>
			            <th style="width: 90px;text-align: left;"> <p style="padding: 8px;font-size: 40px; color: #222;padding: 10px;"><b style="width: 100px;">Abd </b></p></th>
			            <th style="text-align: left; font-size: 40px; color: #555;font-weight: 100;">
			            	 <p style="padding: 8px;font-size: 40px; color: #222;padding: 10px;"><b style="width: 100px;"></b> :  NAD</p>
			            </th>
			            <th style="width: 90px;text-align: left;"></th>
			            <th style="text-align: left; font-size: 40px; color: #555;font-weight: 100;"></th>
			        </tr>
			      </table>
			  		</td>
			  	</tr>
			  	<?php } ?>





















			  	<?php  

     $data['cns_exam']=  $this->common->select($table_name='tbl_patient_cns',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     if(count($data['cns_exam'])>0)
     {

     
     ?>
			  <tr>
			  	
			    <td colspan="2" style="width: 140px;padding-bottom: 10px;">
			    	
			    		<table>
				          <tr>
				            <th style="width: 90px;text-align: left;"><p style="padding: 8px;font-size: 40px; color: #222;padding: 10px;"><b style="width: 100px;">CNS </b></p></th>

				            <th style="text-align: left; font-size: 40px; color: #555;font-weight: 100;">
				            	 : <?php
      foreach($data['cns_exam'] as $row)
     {
       $data['cns']=  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$row->cns_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
 			?>
            <?php

            $result4 .=@$data['cns'][0]->examination_name.','; } $result4 = rtrim($result4,','); echo $result4;

           

             ?>
 			
            
              
            
				            </th>
				            <th style="width: 90px;text-align: left;"></th>
				            <th style="text-align: left; font-size: 40px; color: #555;font-weight: 100;"></th>
				        </tr>
				      </table>
			    </td>
			    
			  </tr>

			  <?php } else { ?>
			  	<tr>
			  		<td colspan="2" style="width: 140px;padding-bottom: 10px;">
			  			<table>
			          <tr>
			            <th style="width: 90px;text-align: left;">  <p style="padding: 8px;font-size: 40px; color: #222;padding: 10px;"><b style="width: 100px;">CNS </b></p></th>
			            <th style="text-align: left; font-size: 40px; color: #555;font-weight: 100;">
			            	 <p style="padding: 8px;font-size: 40px; color: #222;padding: 10px;"><b style="width: 100px;"></b> :  NAD</p>
			            </th>
			            <th style="width: 90px;text-align: left;"></th>
			            <th style="text-align: left; font-size: 40px; color: #555;font-weight: 100;"></th>
			        </tr>
			      </table>
			  		</td>
			  	</tr>
			  	<?php } ?>
			 


			  

			  <tr>
			  	 
			    <td colspan="2" style="width: 240px;padding-bottom: 10px;">
			    	<p style="font-size: 40px;text-align: center;font-weight: bold;margin: 40px 0 10px;color: #000;">
            Reports</p>


            		<table>
			          <tr>
			          	<?php  

				     $data['report']=  $this->common->select($table_name='tbl_patient_report',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

				     if(count($data['report'])>0)
				     {

				      
				?>
			            <th style="width: 80px;"></th>
			            <th style="text-align: left; font-size: 40px; color: #555;font-weight: 100;">
			            	<ul>
			            	<?php 
              foreach($data['report'] as $row)
                  {
             ?>
            <li style="padding: 8px;font-size: 40px; color: #222;padding: 10px;line-height: 40px;"> <?php echo $row->content; ?>- <b><?php echo $row->description; ?></b>

           <?php if(@$row->date != "0000-00-00") { ?> ( 

            <?php 

             $originalDate1 = @$row->date;
                   $newDate1 = date("d-m-y", strtotime($originalDate1));

            echo $newDate1; 


            ?> 

            )<?php } ?>

            </li>

            <?php } } ?>
        </ul>
			            </th>
			        </tr>
			      </table>










			    </td>
			  
			  </tr>
			</table>

         
         



























          <td style="border-left:1px solid #333; padding:0 40px 40px; vertical-align: top;width: 50%;">

           <?php 
$i=0;
            $data['med']=  $this->common->select($table_name='tbl_patient_medicine',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
if(count($data['med'])>0)
{

 

              ?>
          <p style="font-size: 40px;text-align: center;font-weight: bold;margin: -40px 0 100px;color: #000;"><u>ADVICE :</u></p><br>
         
          
     <?php  

     $data['inves']=  $this->common->select($table_name='tbl_patient_investigation',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


         if(count($data['inves'])>0)
         {

          
    ?>

            <p style="font-size: 40px;text-align: center;font-weight: bold;margin: 40px 0 10px;color: #000;">
            Investigtions :</p><br>
			<ul>
<?php 
       foreach($data['inves'] as $row)
           {

              $data['user_inves']=  $this->common->select($table_name='tbl_investigations',$field=array(), $where=array('investigation_id'=>@$row->investigation_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
 ?>
            <li style="padding: 8px;font-size: 40px; color: #222;padding: 10px;line-height: 40px;"><?php echo @$data['user_inves'][0]->investigation_name; ?></li>

            <?php }  } ?>
        </ul>

          <ol><br>
<p style="font-size: 40px;text-align: center;font-weight: bold;margin: 40px 0 10px;color: #000;">
            Medicine :</p><br>
          <?php
                  foreach($data['med'] as $row)
           {
              $i++;
              $data['med_name']=  $this->common->select($table_name='tbl_medicine',$field=array(), $where=array('medicine_id'=>@$row->medicine_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
           ?>
            <li style="padding: 10px 8px;  margin: 5px 0px 0px 0px; font-size: 40px; color: #222;"><?php echo @$data['med_name'][0]->medicine_name; ?> <?php if($row->group_id == 0) { echo ' for '; } else {  } ?> <?php echo @$row->dose; ?></li><br><?php } } ?>
           
          </ol>
          <br>


          <?php  

     $data['diet']=  $this->common->select($table_name='tbl_patient_diet',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     if(count($data['diet'])>0)
     {

     
     ?>
          <p style="font-size: 40px;text-align: center;font-weight: bold; padding: 40px 0 10px;color: #000;">Diet:</p>
          <p></p>
          <ul>

<?php

    foreach($data['diet'] as $row)
     {
       $data['user_diet']=  $this->common->select($table_name='tbl_diet',$field=array(), $where=array('diet_id'=>@$row->diet_id ), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
 ?>
          <li style="padding: 8px;font-size: 40px; color: #222;padding: 10px;">  <?php echo @$data['user_diet'][0]->diet_name; ?></li>

          <?php } }?>
      </ul>



          


          <br>

          <?php  

     $data['coun']=  $this->common->select($table_name='tbl_patient_councelling',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

if(count($data['coun'])>0)
{

     
     ?>
          <p style="font-size: 40px;text-align: center;font-weight: bold;padding: 40px 0 10px;color: #000;">Counselling : </p>
          <p></p>
          <ul>
<?php

      foreach($data['coun'] as $row)
     {


       $data['councelling']=  $this->common->select($table_name='tbl_councelling',$field=array(), $where=array('councelling_id'=>@$row->councelling_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
 ?>

          <li style="padding: 8px;font-size: 40px; color: #222;padding: 10px;">  <?php echo @$data['councelling'][0]->councelling_name; ?> </li>

<?php } } ?>
		</ul>
          <br>

          
        
          <p style="font-size: 40px;text-align: center;font-weight: bold;margin: 40px 0 10px;color: #000;">Review 
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
          
           
           <p style="font-size: 16px;font-weight: bold;margin: 40px 0 10px;color: #000;">Dr Sajjad Hossain</p>
          </td>
        </tr>
      </table>


<table style="width: 1400px; margin: 0 0 0 0%;background-color: #fff;padding: 40px 10px; margin-top: 10%;">
  <tr style="text-align: center;">
          <td style="width:50%; text-align: right; ">
            
            
           
            <?php if(@$prescription[0]->feedback != ""){ ?>
             <p style="font-size: 16px;font-weight: bold;margin: 40px 0 10px;color: #000;">* This Prescription is valid for <?php echo @$prescription[0]->feedback; ?> *</p><?php } ?>
           
          </td>
          <td style="width:50%; text-align:right; ">
          
           
          </td>
        </tr>
      </table> -->








<table style="width: 100%;background-color: #fff; float: left; padding-left: 20px; padding-top: 80px;">

        <tr style="text-align: center;">
            <th >
              <p style="font-size: 14px;text-align: center;font-weight: 600;margin: 10px 0;color: #333;">ID: 
                <?php  $data['user_detail']=  $this->common->select($table_name='tbl_user',$field=array(), $where=array('user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

                echo @$data['user_detail'][0]->user_unique_id;

                ?></p> 
              </th>
              <th><p style="font-size: 14px;text-align: center;font-weight: 600;margin: 10px 0 ;color: #333;"> <?php echo @$data['user_detail'][0]->first_name." ".@$data['user_detail'][0]->last_name; ?>, <?php echo @$data['user_detail'][0]->age; ?> Yrs/<?php echo @$data['user_detail'][0]->gender; ?></p>
               </th> 

                
              <th>

              <p style="font-size: 14px;text-align: center;font-weight: 600;margin: 10px 0 ;color: #333;">
		<?php if(@$data['user_detail'][0]->weight !=0 && @$data['user_detail'][0]->bmi != 0){ ?>
              wt: <?php echo @$data['user_detail'][0]->weight; ?>kg., BMI: <?php echo @$data['user_detail'][0]->bmi; ?>, 


 		<?php } ?>
              <?php  echo @$data['user_detail'][0]->city; ?>



              </p>
            </th>
           

        <th >
              <p style="font-size: 14px;text-align: center;font-weight: 600;margin: 10px 0;color: #333;"><?php
                  $originalDate = @$prescription[0]->created_date;
                   $newDate = date("d-m-y", strtotime($originalDate));

              echo $newDate;

               ?></p>
         </th>
          </tr>
        
 </table>






<table style="margin-top: 15%; padding-left: 50px;">
  <tr>

    <th style="width: 35%;vertical-align: top; text-align: left;padding-left: 0px;" >
    	
    	<table style="">

    	 <?php    $data['diagnosis']=  $this->common->select($table_name='tbl_patient_diagnosis',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
   


         if(count($data['diagnosis']) > 0)
         { ?>
			  <tr>
			    <td>
			    	 <table style="">
					  <tr>
					    <td colspan="2" style="color: #000;padding: 5px 5px 15px 5px; "><p style="font-weight: bold;margin: 10px 0;color: #000; font-size: 50px;"><u>Diagnosis</u>:</p></td>
					    
					  </tr>
					  <tr>
					    <td style="width: 40px;"></td>
					    <td style="color: #333;">

					    	<table style="width: 100%;">

					    	<?php  

   

           foreach($data['diagnosis'] as $row)
           {

              $data['user_diagnosis']=  $this->common->select($table_name='tbl_diagnosis',$field=array(), $where=array('diagnosis_id'=>@$row->diagnosis_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
    ?>
					    	<tr>
					    	<td style=" vertical-align: top; text-align: left;width: 45px;">
					    		<img src="../assets/img/3.png" style="width: 30px;margin-top: 10px;">
					    	</td>
					    	<td style="text-align: left;font-weight: bold;color: #333;">
					    		<span style="font-size: 42px;"><?php echo @$data['user_diagnosis'][0]->diagnosis_name; ?> </span></td>
					    	</tr>

					    		<?php } ?>

					    
					    </table>
					    	
					    	
					
					</td> 
					  </tr>
					  
					</table>
			    </td>
			    
			  </tr>

			  <?php } ?>

			  <?php  

         $data['cc']=  $this->common->select($table_name='tbl_patient_cc',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


         if(count($data['cc'])>0)
         {

          
        ?>
			  <tr>
			    <td>
			    	 <table style="">
					  <tr>
					    <td colspan="2" style="color: #000;padding: 5px;font-size: 14px;"><p style="font-weight: bold;margin: 10px 0;color: #000; font-size: 47px;">C/C:</p></td>
					    
					  </tr>
					  <tr>
					    <td style="width: 40px;"></td>
					    <td style="color: #333;">

					    	<table style="">
					    	 <?php 
               foreach($data['cc'] as $row)
           {

              $data['user_cc']=  $this->common->select($table_name='tbl_cc',$field=array(), $where=array('cc_id'=>@$row->cc_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

              echo $row->day_id;

if($row->day_id != 0)
{
	 $data['day']=  $this->common->select($table_name='tbl_time',$field=array(), $where=array('id'=>@$row->day_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

	 $day_cc=$data['day'][0]->day;

	 
}

else
{

	 $day_cc="";
}

             

              //count($data['day']);exit;
            ?>
					    	<tr>
					    	<td style="width:35px; vertical-align: top; text-align: left;">
					    		<img src="../assets/img/1.png" style="width: 15px; margin-top: 13px;">
					    	</td>
					    	<td style="text-align: left;color: #333;">
					    		<span style="font-size: 44px;"><?php echo @$data['user_cc'][0]->cc_name; ?>

					    				<?php if($day_cc != ""){ echo '- '. $day_cc; } else { echo $day_cc; } ?>
					    		 



					    		 </span></td>
					    	</tr>
					    	<?php } ?>

					    
					    </table>
					    	
					    	
					
					</td> 
					  </tr>
					  
					</table>
			    </td>
			  </tr>
			  <?php } ?>

			  <?php  

         $data['kpo']=  $this->common->select($table_name='tbl_patient_kpo',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


             if(count($data['kpo'])>0)
             {

           
          ?>

			  <tr>
			    <td>
			    	 <table style="">
					  <tr>
					    <td colspan="2" style="color: #000;padding: 5px;font-size: 14px;"><p style="font-weight: bold;margin: 10px 0;color: #000;font-size: 47px;">Known patient of:</p></td>
					    
					  </tr>
					  <tr>
					    <td style="width: 40px;"></td>
					    <td style="color: #333;">

					    	<table style="width: 100%;">

					    		<?php 

                foreach($data['kpo'] as $row)
           {

              $data['user_kpo']=  $this->common->select($table_name='tbl_kpo',$field=array(), $where=array('kpo_id'=>@$row->kpo), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
          ?>
					    	<tr>
					    	<td style="width:35px; vertical-align: top; text-align: left;">
					    		<img src="../assets/img/1.png" style="width: 15px; margin-top: 13px;">
					    	</td>
					    	<td style="text-align: left;color: #333;font-size: 44px;"><?php echo @$data['user_kpo'][0]->kpo_name; ?></td>
					    	</tr>

					    	<?php } ?>

					    	
					    </table>
					    	
					    	
					
					</td> 
					  </tr>
					  
					</table>
			    </td>
			  </tr>
			  <?php } ?>

			   <?php    $data['ho']=  $this->common->select($table_name='tbl_patient_ho',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
   


         if(count($data['ho'])>0)
         { ?>
			  <tr>
			    <td>
			    	 <table style="">
					  <tr>
					    <td colspan="2" style="color: #000;padding: 5px;font-size: 14px;"><p style="font-weight: bold;margin: 10px 0;color: #000;font-size: 47px;">Medical History:</p></td>
					    
					  </tr>
					  <tr>
					    <td style="width: 40px;"></td>
					    <td style="font-size: 14px;color: #333;">

					    	<table style="width: 100%;">
					    		<?php 

                foreach($data['ho'] as $row)
           {

              $data['user_ho']=  $this->common->select($table_name='tbl_ho',$field=array(), $where=array('ho_id'=>@$row->ho_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

               $data['day']=  $this->common->select($table_name='tbl_time',$field=array(), $where=array('id'=>@ $row->day_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
          ?>
					    	<tr>
					    	<td style="width:35px; vertical-align: top; text-align: left;">
					    		<img src="../assets/img/1.png" style="width: 15px; margin-top: 13px;">
					    	</td>
					    	<td style="text-align: left;color: #333;">
					    		<span style="font-size: 44px;"><?php echo @$data['user_ho'][0]->ho_name; ?>
					    		<?php 
					    			if( @$row->day_id !=""){
					    		 ?>
					    		 - <?php echo @$row->day_id; ?>

					    		 <?php 
					    		 	}
					    		 ?>
					    		 </span></td>
					    	</tr>

					    	<?php } ?>

					    	
					    </table>
					    	
					    	
					
					</td> 
					  </tr>
					  
					</table>
			    </td>
			  </tr>

			  <?php } ?>

			  <tr>
			    <td>
			    	 <table style="">
					  <tr>
					    <td colspan="2" style="color: #000;padding: 5px;font-size: 14px;"><p style="font-weight: bold;margin: 10px 0;color: #000;font-size: 47px;">Examination:</p></td>
					    
					  </tr>

					    <?php
 $data['gen_exam']=  $this->common->select($table_name='tbl_patient_gen_exam',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     if(count($data['gen_exam'])>0)
     {
      ?>
					  <tr>
					    <td style="width: 60px;vertical-align: top;font-weight: bold;color: #333;font-size: 40px; float: left;">General</td>
					    <td style="font-size: 14px;color: #333;width: 600px;">

					    	<table style="">
					    	<tr>
					    	<td  style="vertical-align: top;font-weight: bold;color: #333;font-size: 40px;">:</td>
					    	<td style="text-align: left;color: #333;vertical-align: top;">
					    		<span style="font-size: 44px;">

					    			<?php
					    	$result = '';
					    	foreach($data['gen_exam'] as $row)
     {
       $data['exam']=  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$row->gen_exam), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

 ?>
<?php $result .=@$data['exam'][0]->examination_name.','; } $result = rtrim($result,','); echo $result; ?>


					    		</span></td>
					    	</tr>

					         </table>
					     </td>

					  </tr>

					  <?php } ?>

					   <?php if(@$prescription[0]->bp_upper !="" && @$prescription[0]->bp_lower) { ?>
					  <tr>
					    <td style="width: 60px;vertical-align: top;font-weight: bold;color: #333;font-size: 44px;">BP</td>
					    <td style="color: #333;width: 600px;">

					    	<table style="">
					    	<tr>					    	
					    	<td style="text-align: left;color: #333;vertical-align: top;">
					    		<span style="font-size: 44px;"><b>:</b> <?php echo @$prescription[0]->bp_upper; ?>/<?php echo @$prescription[0]->bp_lower; ?> mm of Hg,</span>
					    	</td>
					    	</tr>

					         </table>
					     </td>
					      
					  </tr>
					  <?php } ?>

					   <?php if(@$prescription[0]->pulse != "" && @$prescription[0]->pulse != '0' && @$prescription[0]->pulse_type !=""){ ?>
					  <tr>
					    <td style="width: 60px;vertical-align: top;font-weight: bold;color: #333;font-size: 44px;">Pulse</td>
					    <td style="color: #333;width: 600px;">

					    	<table style="width: 100%;">
					    	<tr>					    	
					    	<td style="width: 100%;text-align: left;color: #333;vertical-align: top;">
					    		<span style="font-size: 44px;"><b>:</b> <?php echo @$prescription[0]->pulse; ?>/min, <?php echo @$prescription[0]->pulse_type; ?></span>
					    	</td>
					    	</tr>

					         </table>
					     </td>
					      
					  </tr>
					  <?php } ?>

					  	<?php  

     $data['chest_exam']=  $this->common->select($table_name='tbl_patient_chest',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     if(count($data['chest_exam'])>0)
     {

     
     ?>
					 <tr>
					    <td style="width: 60px;vertical-align: top;font-weight: bold;color: #333;font-size: 40px; float: left;">Chest</td>
					    <td style="font-size: 14px;color: #333;width: 600px;">

					    	<table style="">
					    	<tr>
					    	<td  style="vertical-align: top;font-weight: bold;color: #333;font-size: 40px;">:</td>
					    	<td style="text-align: left;color: #333;vertical-align: top;">
					    		<span style="font-size: 44px;">

					    				<?php 

					    		$result1="";

            foreach($data['chest_exam'] as $row)
              {
       $data['exam_chest']=  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$row->chest_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

$result1 .=@$data['exam_chest'][0]->examination_name.','; } $result1 = rtrim($result1,','); echo $result1;

             ?>


					    		</span></td>
					    	</tr>

					         </table>
					     </td>

					  </tr>

					  <?php } else { ?>

					   <tr>
					    <td style="width: 60px;vertical-align: top;font-weight: bold;color: #333;font-size: 40px; float: left;">Chest</td>
					    <td style="font-size: 14px;color: #333;width: 600px;">

					    	<table style="">
					    	<tr>
					    	<td  style="vertical-align: top;font-weight: bold;color: #333;font-size: 40px;">:</td>
					    	<td style="text-align: left;color: #333;vertical-align: top;">
					    		<span style="font-size: 44px;">

					    	B/L Vesicular Breath sound


					    		</span></td>
					    	</tr>

					         </table>
					     </td>

					  </tr>


					  <?php } ?>

					  	<?php  

     $data['heart_exam']=  $this->common->select($table_name='tbl_patient_heart',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     if(count($data['heart_exam'])>0)
     {

     
     ?>
					  
					  <tr>
					    <td style="width: 60px;vertical-align: top;font-weight: bold;color: #333;font-size: 40px; float: left;">Heart</td>
					    <td style="font-size: 14px;color: #333;width: 600px;">

					    	<table style="">
					    	<tr>
					    	<td  style="vertical-align: top;font-weight: bold;color: #333;font-size: 40px;">:</td>
					    	<td style="text-align: left;color: #333;vertical-align: top;">
					    		<span style="font-size: 44px;">

					    			<?php 
$result2="";
            foreach($data['heart_exam'] as $row)
              {
       $data['exam_heart']=  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$row->heart_exam_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

$result2 .=@$data['exam_heart'][0]->examination_name.','; } $result2 = rtrim($result2,','); echo $result2;

            ?>


					    		</span></td>
					    	</tr>

					         </table>
					     </td>

					  </tr>
					  <?php } else { ?>

					  	 <tr>
					    <td style="width: 60px;vertical-align: top;font-weight: bold;color: #333;font-size: 40px; float: left;">General</td>
					    <td style="font-size: 14px;color: #333;width: 600px;">

					    	<table style="">
					    	<tr>
					    	<td  style="vertical-align: top;font-weight: bold;color: #333;font-size: 40px;">:</td>
					    	<td style="text-align: left;color: #333;vertical-align: top;">
					    		<span style="font-size: 44px;">
S1, S2 audible, no murmur


					    		</span></td>
					    	</tr>

					         </table>
					     </td>

					  </tr>


					  <?php } ?>

					  <?php  

     $data['abd_exam']=  $this->common->select($table_name='tbl_patient_abd',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     if(count($data['abd_exam'])>0)
     {

     
     ?>
					    <tr>
					    <td style="width: 60px;vertical-align: top;font-weight: bold;color: #333;font-size: 40px; float: left;">Abd</td>
					    <td style="font-size: 14px;color: #333;width: 600px;">

					    	<table style="">
					    	<tr>
					    	<td  style="vertical-align: top;font-weight: bold;color: #333;font-size: 40px;">:</td>
					    	<td style="text-align: left;color: #333;vertical-align: top;">
					    		<span style="font-size: 44px;">
		<?php
					    			$result3="";
                  foreach($data['abd_exam'] as $row)
                     {
                       $data['abd']=  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$row->abd_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
         


          

           $result3 .=@$data['abd'][0]->examination_name.','; }  $result3 = rtrim($result3,','); echo $result3;
?>


					    		</span></td>
					    	</tr>

					         </table>
					     </td>

					  </tr>

					  <?php } else { ?>

					   <tr>
					    <td style="width: 60px;vertical-align: top;font-weight: bold;color: #333;font-size: 40px; float: left;">Abd</td>
					    <td style="font-size: 14px;color: #333;width: 600px;">

					    	<table style="">
					    	<tr>
					    	<td  style="vertical-align: top;font-weight: bold;color: #333;font-size: 40px;">:</td>
					    	<td style="text-align: left;color: #333;vertical-align: top;">
					    		<span style="font-size: 44px;">
	 Soft,IPS+,no tendernes,no organomegaly


					    		</span></td>
					    	</tr>

					         </table>
					     </td>

					  </tr>


					  <?php } ?>

					  <?php  

     $data['cns_exam']=  $this->common->select($table_name='tbl_patient_cns',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     if(count($data['cns_exam'])>0)
     {

     
     ?>
					    <tr>
					    <td style="width: 60px;vertical-align: top;font-weight: bold;color: #333;font-size: 40px; float: left;">CNS</td>
					    <td style="font-size: 14px;color: #333;width: 600px;">

					    	<table style="">
					    	<tr>
					    	<td  style="vertical-align: top;font-weight: bold;color: #333;font-size: 40px;">:</td>
					    	<td style="text-align: left;color: #333;vertical-align: top;">
					    		<span style="font-size: 44px;">

					    		  		<?php

					    		 $result4="";
      foreach($data['cns_exam'] as $row)
     {
       $data['cns']=  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$row->cns_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

           

            $result4 .=@$data['cns'][0]->examination_name.',';  } $result4 = rtrim($result4,','); echo $result4;

           

            ?>


					    		</span></td>
					    	</tr>

					         </table>
					     </td>

					  </tr>

					  <?php } else { ?>

					   <tr>
					    <td style="width: 60px;vertical-align: top;font-weight: bold;color: #333;font-size: 40px; float: left;">CNS</td>
					    <td style="font-size: 14px;color: #333;width: 600px;">

					    	<table style="">
					    	<tr>
					    	<td  style="vertical-align: top;font-weight: bold;color: #333;font-size: 40px;">:</td>
					    	<td style="text-align: left;color: #333;vertical-align: top;">
					    		<span style="font-size: 44px;">

					    		   No Neuro deficit


					    		</span></td>
					    	</tr>

					         </table>
					     </td>

					  </tr>


					  <?php } ?>
					  

					  
					</table>
			    </td>
			  </tr>

			   <?php  

     $data['report']=  $this->common->select($table_name='tbl_patient_report',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     if(count($data['report'])>0)
     {

      
?>
			  <tr>
			    <td>
			    	 <table style="">
					  <tr>
					    <td colspan="2" style="color: #000;padding: 5px;">
							<p style="font-weight: bold;margin: 10px 0;color: #000;font-size: 47px;">Reports:</p></td>
					    
					  </tr>
					  <tr>
					    <td style="width: 40px;"></td>
					    <td style="color: #333;">

					    	<table style="">

					    	<?php 
              foreach($data['report'] as $row)
                  {
             ?>
					    	<tr>
		<td style="width:35px; vertical-align: top; text-align: left;">
	<img src="../assets/img/1.png" style="width: 15px;margin-top: 13px; ">
	</td>
<td style="text-align: left;color: #333;">
    <table>
	  <tr>
	    <td style="padding-right: 15px;"><span style="font-size: 44px;"><?php echo $row->content; ?> – <b><?php echo $row->description; ?></b> <?php if(@$row->date != "0000-00-00") { 
$originalDate1 = @$row->date;
$newDate1 = date("d-m-y", strtotime($originalDate1));
echo '('.$newDate1.')'; 
} ?></span></td>
	<!-- <td style="width: 5px;"></td>
<td style="padding:0px;text-align: right;padding-left: 0px;font-size: 44px;"><span >

</span></td> -->
</tr>
</table>
					    	</td>
					    	</tr>

					    	<?php } ?>

					 
					    </table>
					    	
					    	
					
					</td> 
					  </tr>
					  
					</table>
			    </td>
			  </tr>

			  <?php } ?>




			  
			</table>

    </th>








   <th style="width: 65%;vertical-align: top; text-align: left; padding-left: 10px; ">
    	<br><br><br><br><br><br><br><br><br><br>
    	<table style="width:100%; border-left: 2px solid #000;padding-left: 15px;">

    	 <?php 


             

     $data['inves']=  $this->common->select($table_name='tbl_patient_investigation',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


         
            $i=0;
            $data['med']=  $this->common->select($table_name='tbl_patient_medicine',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

          
   
if(count($data['inves'])>0 || count($data['med'])>0)
{

 

              ?>
			  <tr>
			    <td>
			    	
			    	<table>
			    		<tr>
			    			<td colspan="2" style="color: #000;padding: 0 5px 5px;font-size: 16px;"><p style="font-weight: bold; margin:-10px 0px 0px;color: #000;font-size: 44px; padding-bottom: 100px;"><u>ADVICE</u>:</p></td>
			    		</tr>
			    	</table>

			    	 <?php  

    



         if(count($data['inves'])>0)
         {
 

          
    ?>

			    	 <table style="width:100%">
					  <tr>
					    <td colspan="2" style="color: #000;padding: 5px;"><p style="font-weight: bold;margin: 10px 0;color: #000; font-size: 47px;">Investigtions:</p></td>
					    
					  </tr>
					  <tr>
					    <td style="width: 40px;"></td>
					    <td style="font-size: 40px;color: #333;">

					    	<table style="width: 100%;">

					    	<?php
					    				foreach($data['inves'] as $row)
                                                     {

                                                     	  $data['user_inves']=  $this->common->select($table_name='tbl_investigations',$field=array(), $where=array('investigation_id'=>@$row->investigation_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

					    	 ?>
					    	<tr>
					    	<td style="width:35px; vertical-align: top; text-align: left;">
					    		<img src="../assets/img/1.png" style="width: 20px; margin-top: 13px;">
					    	</td>
					    	<td style="width: 100%;text-align: left;color: #333;">
					    		<span style="font-size: 40px;"><?php echo @$data['user_inves'][0]->investigation_name; ?></span></td>
					    	</tr>

					    	<?php } ?>

					    

					    
					    </table>
					    	
					    	
					
					</td> 
					  </tr>
					  
					</table>

						<?php } ?>
			    </td>
			    
			  </tr>

			  <?php } ?>

			     <?php 

if(count($data['med'])>0)
{

	?>

			  <tr>
			    <td>
			    	 <table style="width:100%">
					  <tr>
					    <td colspan="2" style="color: #000;padding: 5px;"><p style="font-weight: bold;margin: 10px 0;color: #000;font-size: 47px;">Medicine:</p></td>
					    
					  </tr>
					  <tr>
					    <td style="width: 20px;"></td>
					    <td style="">

					    	<table style="width: 100%;">

					    	 <?php
                  foreach($data['med'] as $row)
           {
              $i++;
              $data['med_name']=  $this->common->select($table_name='tbl_medicine',$field=array(), $where=array('medicine_id'=>@$row->medicine_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
           ?>
					    	<tr>
					    	<td style="width:25px; vertical-align: top; text-align: left; margin-left: -40px; font-size: 40px;line-height: 55px;">
					    		<?php echo $i; ?>.
					    	</td>
					    	<td style="width: 100%;text-align: left;color: #333; line-height: 55px;">
					    		<span style="font-size: 44px;color: #333;"><?php echo @$data['med_name'][0]->medicine_name; ?> <?php if($row->group_id == 0 && @$row->dose!="") { echo ' for '; } else {  } ?> <?php echo @$row->dose; ?></span></td>
					    	</tr>

					    	<?php } ?>


	
					    	
					    </table>
					    	
					    	
					
					</td> 
					  </tr>
					  
					</table>
			    </td>
			  </tr>

			  <?php } ?>

			   <?php  

     $data['diet']=  $this->common->select($table_name='tbl_patient_diet',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     if(count($data['diet'])>0)
     {

     
     ?>
			  <tr>
			    <td>
			    	 <table style="width:100%">
					  <tr>
					    <td colspan="2" style="color: #000;padding: 5px;"><p style="font-weight: bold;margin: 10px 0;color: #000;font-size: 47px;">Diet:</p></td>
					    
					  </tr>
					  <tr>
					    <td style="width: 40px;"></td>
					    <td style="font-size: 14px;color: #333;">

					    	<table style="width: 100%;">


<?php

    foreach($data['diet'] as $row)
     {
       $data['user_diet']=  $this->common->select($table_name='tbl_diet',$field=array(), $where=array('diet_id'=>@$row->diet_id ), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
 ?>
					    	<tr>
					    	<td style="width:35px; vertical-align: top; text-align: left;">
					    		<img src="../assets/img/1.png" style="width: 20px;margin-top: 20px; ">
					    	</td>
					    	<td style="width: 100%;text-align: left;color: #333;font-size: 44px;"><?php echo @$data['user_diet'][0]->diet_name; ?></td>
					    	</tr>

					    	<?php } ?>

					    
					    </table>
					    	
					    	
					
					</td> 
					  </tr>
					  
					</table>
			    </td>
			  </tr>
			  <?php } ?>

			   <?php  

     $data['coun']=  $this->common->select($table_name='tbl_patient_councelling',$field=array(), $where=array('chk_history_id'=>$chk_history_id,'user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

if(count($data['coun'])>0)
{

     
     ?>
			  <tr>
			    <td>
			    	 <table style="width:100%">
					  <tr>
					    <td colspan="2" style="color: #000;padding: 5px;"><p style="font-weight: bold;margin: 10px 0;color: #000;font-size: 47px;">Counselling:</p></td>
					    
					  </tr>
					  <tr>
					    <td style="width: 40px;"></td>
					    <td style="font-size: 14px;color: #333;">

					    	<table style="width: 100%;">

					    	<?php

      foreach($data['coun'] as $row)
     {


       $data['councelling']=  $this->common->select($table_name='tbl_councelling',$field=array(), $where=array('councelling_id'=>@$row->councelling_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
 ?>
					    	<tr>
					    	<td style="width:35px; vertical-align: top; text-align: left;">
					    		<img src="../assets/img/1.png" style="width: 20px;margin-top: 13px; ">
					    	</td>
					    	<td style="width: 100%;text-align: left;color: #333;font-size: 40px;">
					    		<span style="font-size: 44px;"><?php echo @$data['councelling'][0]->councelling_name; ?></span></td>
					    	</tr>

					    	<?php } ?>

					    	
					    </table>
					    	
					    	
					
					</td> 
					  </tr>
					  
					</table>
			    </td>
			  </tr><?php } ?>

			

			  <tr>
			    <td>
			    	 <table style="width:100%">
					  <tr>
					    <td colspan="2" style="color: #000;padding: 5px;"><span style="font-weight: bold;margin: 10px 0;color: #000;font-size: 47px;">Review: </span> <span style="font-size: 44px;"><?php if (@$prescription[0]->feedback=="sos") {

					    	echo 'SOS';
					    	
					    } else { echo 'after '.$prescription[0]->feedback; ?><?php } ?></span></td>
					    
					  </tr>
					  
					  
					  
					 
					 
					  

					  
					</table>
			    </td>
			  </tr>

			 
			  

			</table>

<!--  <table style="width:100%; padding-top: 200px;">
					  <tr>
					  	
					    <td style="color: #000;padding: 5px; text-align: right;">
					    	<span style="font-size: 40px;">
					    	Dr S Hossain
					    </span></td>
					    
					  </tr>

					  
					  
					  
					 
					 
					  

					  
					</table>
 -->
 



    </th> 
  </tr>
</table>
<!-- <p style="position: absolute; bottom: 27%; right: 12%; font-size: 12px !important;"><span style="padding: 0px 40px; ">Dr S Hossain</span></p> -->

<?php 
			if(@$prescription[0]->feedback !='sos')
			{
?>

<p style="position: absolute; bottom: 10%; left:0; width: 100%; text-align: center; font-size: 12px !important;">* This Prescription is valid for <?php echo @$prescription[0]->feedback; ?>*



</p>

<?php } ?>

<!-- 
<table style="width: 1400px; margin: 0 0 0 0%;background-color: #fff;padding: 40px 10px; margin-top: 20%;">
  <tr style="text-align: center;">
          <td style="width:50%; text-align: right; ">
            
            
           
            
           
          </td>
          <td style="width:50%; text-align:right; ">
          
           
           <p style="font-size: 20px;font-weight: bold;margin: 40px 0 10px;color: #333;"><span style="padding: 0px 40px; "><i>Dr S Hossain</i></span></p>
          </td>
        </tr>
      </table>


<table style="width: 1400px; margin: 0 0 0 0%;background-color: #fff;padding: 40px 10px; margin-top: 10%;">
  <tr style="text-align: center;">
          <td style="width:60%; text-align: right; ">
            
            
           
            <?php if(@$prescription[0]->feedback != ""){ ?>
             <p style="font-size: 20px;font-weight: bold;margin: 40px 0 10px;color: #333;">* This Prescription is valid for <?php echo @$prescription[0]->feedback; ?> *</p><?php } ?>
           
          </td>
          <td style="width:40%; text-align:right; ">
          
           
          </td>
        </tr>
      </table> -->






























</body>
</html>