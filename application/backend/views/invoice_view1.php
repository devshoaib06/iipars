

   <table style="width: 1120px;margin: 0 0 0 0%;background-color: #fff;padding: 40px 30px;">
  <tr style="text-align: center;">
    <th ><p style="font-size: 20px;text-align: center;font-weight: 600;margin: 10px 0;color: #333;">ID: 

  <?php  $data['user_detail']=  $this->common->select($table_name='tbl_user',$field=array(), $where=array('user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

  echo @$data['user_detail'][0]->user_unique_id;

  ?>


    </p> </th>
    <th><p style="font-size: 20px;text-align: center;font-weight: 600;margin: 10px 0 ;color: #333;"> <?php echo @$data['user_detail'][0]->first_name." ".@$data['user_detail'][0]->last_name; ?> <?php echo @$data['user_detail'][0]->age; ?>/<?php echo @$data['user_detail'][0]->gender; ?>
            </p></th> 
    <th><p style="font-size: 20px;text-align: center;font-weight: 600;margin: 10px 0 ;color: #333;">wt: <?php echo @$data['user_detail'][0]->weight; ?>kg. HT:<?php echo @$data['user_detail'][0]->height; ?>  BMI: <?php echo @$data['user_detail'][0]->bmi; ?></p></th>
    <th ><p style="font-size: 20px;text-align: center;font-weight: 600;margin: 10px 0;color: #333;"><?php echo @$prescription[0]->created_date; ?>
</p> </th>
  </tr>




  <tr>
    <td style="    vertical-align: top;text-align: center;"><p style="font-size: 18px;font-weight: 600;color: #333;">Chiel Complaints : </p></td>

   
    <td>
 <?php  

     $data['cc']=  $this->common->select($table_name='tbl_patient_cc',$field=array(), $where=array('chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


         

           foreach($data['cc'] as $row)
           {

              $data['user_cc']=  $this->common->select($table_name='tbl_cc',$field=array(), $where=array('cc_id'=>@ $row->cc_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
    ?>
    <p style="font-size: 18px;font-weight: 600;color: #333; margin: 0 0 5px;"><?php echo @$data['user_cc'][0]->cc_name; ?></p><?php } ?>
    <!--  <p style="font-size: 15px;font-weight: 600;color: #333;margin: 0 0 5px;">Swelling of both legs since 5 days</p>
      <p style="font-size: 15px;font-weight: 600;color: #333;margin: 0 0 25px;">Swelling of both legs since 2 days</p --></td>
    <td></td>
  </tr>


  <tr>
    <td style=" vertical-align: top;text-align: center;"><p style="font-size: 18px;font-weight: 600;color: #333;">Known patient of : </p></td>
    <td>
<?php  

     $data['kpo']=  $this->common->select($table_name='tbl_patient_kpo',$field=array(), $where=array('chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


         

           foreach($data['kpo'] as $row)
           {

              $data['user_kpo']=  $this->common->select($table_name='tbl_kpo',$field=array(), $where=array('kpo_id'=>@$row->kpo), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
    ?>
    <p style="font-size: 18px;font-weight: 600;color: #333; margin: 0 0 5px;"><?php echo @$data['user_kpo'][0]->kpo_name; ?></p><?php } ?>
     <!-- <p style="font-size: 18px;font-weight: 600;color: #333;margin: 0 0 5px;">Swelling of both legs since 5 days</p>
      <p style="font-size: 18px;font-weight: 600;color: #333;margin: 0 0 25px;">Swelling of both legs since 2 days</p --></td>
    <td></td>
  </tr>


  <tr>
    <td style=" vertical-align: top;text-align: center;">
      <h5 style="font-size: 18px;color: #333;font-weight: 600;margin: 0 0 8px;">Examination : </h5>
      </td>
    <td><p style="font-size: 18px;font-weight: 600;color: #333;margin: 0 0 5px;display: inline-block;vertical-align:top;">

    <?php  

     $data['gen_exam']=  $this->common->select($table_name='tbl_patient_gen_exam',$field=array(), $where=array('chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     foreach($data['gen_exam'] as $row)
     {
       $data['exam']=  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$row->gen_exam), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
     ?>

   <?php echo @$data['exam'][0]->examination_name.','; ?>

    <?php } ?>

    </p>
          <p style="font-size: 18px;font-weight: 600;color: #333;margin: 0 0 5px;vertical-align:top;">BP- <?php echo @$prescription[0]->bp_upper; ?>/<?php echo @$prescription[0]->bp_lower; ?></p>
           <p style="font-size: 18px;font-weight: 600;color: #333;margin: 0 0 5px;vertical-align:top;">Pulse : <?php echo @$prescription[0]->pulse; ?></p>
          <!--  <p style="font-size: 18px;font-weight: 600;color: #333;margin: 0 0 25px;vertical-align:top;">Irregularly irregular</p> -->
           <p style="font-size: 18px;font-weight: 600;color: #333;margin: 0 0 5px;vertical-align:top;">Chest :

<?php  

     $data['chest_exam']=  $this->common->select($table_name='tbl_patient_chest',$field=array(), $where=array('chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     foreach($data['chest_exam'] as $row)
     {
       $data['exam_chest']=  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$row->chest_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
     ?>

   <?php echo @$data['exam_chest'][0]->examination_name.','; ?>

    <?php } ?>


           </p>


                     <p style="font-size: 18px;font-weight: 600;color: #333;margin: 0 0 5px;vertical-align:top;">Abd :

<?php  

     $data['abd_exam']=  $this->common->select($table_name='tbl_patient_abd',$field=array(), $where=array('chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     foreach($data['abd_exam'] as $row)
     {
       $data['abd']=  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$row->chest_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
     ?>

   <?php echo @$data['abd'][0]->examination_name.','; ?>

    <?php } ?>


           </p>

            <p style="font-size: 18px;font-weight: 600;color: #333;margin: 0 0 5px;vertical-align:top;">CNS :

<?php  

     $data['cns_exam']=  $this->common->select($table_name='tbl_patient_cns',$field=array(), $where=array('chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     foreach($data['cns_exam'] as $row)
     {
       $data['cns']=  $this->common->select($table_name='tbl_examination',$field=array(), $where=array('examination_id'=>@$row->chest_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
     ?>

   <?php echo @$data['cns'][0]->examination_name.','; ?>

    <?php } ?>


           </p>
     </td> 



     <td style=" vertical-align: top;text-align: center;">
      <h5 style="font-size: 18px;color: #333;font-weight: 600;margin: 0 0 8px;">Diagnosis : </h5>
      </td>
    <td>
         <?php  

     $data['diagnosis']=  $this->common->select($table_name='tbl_patient_diagnosis',$field=array(), $where=array('chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


         

           foreach($data['diagnosis'] as $row)
           {

              $data['user_diagnosis']=  $this->common->select($table_name='tbl_diagnosis',$field=array(), $where=array('diagnosis_id'=>@$row->diagnosis_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
    ?>
    <p style="font-size: 18px;font-weight: 600;color: #333; margin: 0 0 5px;"><?php echo @$data['user_diagnosis'][0]->diagnosis_name; ?></p><?php } ?>
          <!--  <p style="font-size: 18px;font-weight: 600;color: #333;margin: 0 0 5px;vertical-align:top;">Pulse : 76</p>
           <p style="font-size: 18px;font-weight: 600;color: #333;margin: 0 0 5px;vertical-align:top;">Irregularly irregular</p> -->
     </td> 
  </tr>
    <tr>
    <td style=" vertical-align: top;">
      <p style="font-size: 18px;font-weight: 600;color: #333;margin: 0 0 5px;vertical-align:top;">Reports (<?php echo @$prescription[0]->created_date; ?>)</p>
       <p style="font-size: 18px;font-weight: 600;color: #333;margin: 0 0 5px;vertical-align:top;">Hb- <?php echo @$prescription[0]->hb; ?>gm</p>
      <!--  <p style="font-size: 18px;font-weight: 600;color: #333;margin: 0 0 5px;vertical-align:top;">urea: 65</p> 
       <p style="font-size: 18px;font-weight: 600;color: #333;margin: 0 0 5px;vertical-align:top;">Create: 3.7</p> -->                                
    </td>
    <td></td>
    <td style=" vertical-align: top;text-align: center;">
      <h5 style="font-size: 18px;color: #333;font-weight: 600;margin: 10px 0 10px;text-align: center;"><u>ADVICE</u></h5>
          <ol style="margin: 0;padding: 0;">
          <?php 
$i=0;
            $data['med']=  $this->common->select($table_name='tbl_patient_medicine',$field=array(), $where=array('chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
 foreach($data['med'] as $row)
           {
              $i++;
              $data['med_name']=  $this->common->select($table_name='tbl_medicine',$field=array(), $where=array('medicine_id'=>@$row->medicine_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

              ?>

                <li style="width: 100%; display: inline-block;">
                    <p style="font-size: 18px;font-weight: 600;color: #333;margin: 0 0 5px;"> Tab. <?php echo @$data['med_name']->medicine_name; ?> <?php echo @$row->dose; ?></p>  
                </li>

                <?php } ?>
               <!--  <li style="width: 100%; display: inline-block;">
                    <p style="font-size: 18px;font-weight: 600;color: #333;margin: 0 0 5px;"> Tab. Calpol 650 one tab twice daily for 10 days</p>  
                </li>
                <li style="width: 100%; display: inline-block;">
                    <p style="font-size: 18px;font-weight: 600;color: #333;margin: 0 0 5px;"> Tab. Calpol 650 one tab twice daily for 10 days</p>  
                </li>
                <li style="width: 100%; display: inline-block;">
                    <p style="font-size: 18px;font-weight: 600;color: #333;margin: 0 0 25px;"> Tab. Calpol 650 one tab twice daily for 10 days</p>  
                </li> -->
          </ol>
      
                                    
                              
    </td>
</tr>
<tr>
    <td style=" vertical-align: top;">
      <h5 style="font-size: 18px;color: #333;font-weight: 600;margin: 10px 0 8px;text-align: center;"><u>Investigtions</u></h5></td>
      <td>
     <?php  

     $data['inves']=  $this->common->select($table_name='tbl_patient_investigation',$field=array(), $where=array('chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


         

           foreach($data['inves'] as $row)
           {

              $data['user_inves']=  $this->common->select($table_name='tbl_investigations',$field=array(), $where=array('investigation_id'=>@$row->investigation_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
    ?>
    <p style="font-size: 18px;font-weight: 600;color: #333; margin: 0 0 5px;"><?php echo @$data['user_inves'][0]->investigation_name; ?></p><?php } ?>
    </td>
    
    <td style=" vertical-align: top;">
          <p style="font-size: 18px;font-weight: 600;color: #333;margin: 0 0 10px;">Diet: <?php  

     $data['diet']=  $this->common->select($table_name='tbl_patient_diet',$field=array(), $where=array('chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     foreach($data['diet'] as $row)
     {
       $data['user_diet']=  $this->common->select($table_name='tbl_diet',$field=array(), $where=array('diet_id'=>@$row->diet_id ), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
     ?>

   <?php echo @$data['user_diet'][0]->diet_name.','; ?>

    <?php } ?></p>
          <h5 style="font-size: 18px;color: #333;font-weight: 600;margin: 0 0 10px;">Counselling: <?php  

     $data['coun']=  $this->common->select($table_name='tbl_patient_councelling',$field=array(), $where=array('chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

     foreach($data['coun'] as $row)
     {


       $data['councelling']=  $this->common->select($table_name='tbl_councelling',$field=array(), $where=array('councelling_id'=>@$row->councelling_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
     ?>

   <?php echo @$data['councelling'][0]->councelling_name.','; ?>

    <?php } ?></h5>
                            
                                    
                         
                             
         <h5 style="font-size: 18px;color: #333;font-weight: 600;margin: 20px 0 8px;">Review on <?php echo @$prescription[0]->check_next_date; ?></h5>
                             
    </td>
</tr>




</table>

</body>
</html>
