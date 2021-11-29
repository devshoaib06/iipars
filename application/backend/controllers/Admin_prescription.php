<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_prescription extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('customer_model');
        $this->load->model('product_model');
       /* if ($this->session->userdata('hs_admin_id')=="")
        {
            redirect(base_url().'index.php/admin_login');
        }*/
    }
    function index()
    {

      
       

    	$data['active']="manage_prescription";

    	
         $data['prescription_list']=  $this->common->select($table_name='tbl_patient_check_up_history',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('prescription_view',$data);
        $this->load->view('common/footer');
    }
    function add_invoice()
    {

     // $data['active']="manage_prescription";

       $chk_history_id= 2;

   
    $user_id=16;

    $invoice_no="OPD".rand('000','999').$chk_history_id.$user_id;
  
   
         $data['prescription']=  $this->common->get_prescription_details($chk_history_id,$user_id);

         $data['chk_history_id']=$chk_history_id;
         $data['user_id']=$user_id;

        //echo "<pre>"; print_r($prescription);exit;
   
 
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu');
        $this->load->view('invoice_view1',$data);
        $this->load->view('common/footer');
    }

    function prescription_add()
    {

        $patient=$this->input->post('patient');
        $cc=$this->input->post('cc');

        $kpo=$this->input->post('kpo');
        $ho=$this->input->post('ho');
        $gen=$this->input->post('gen');
        $pulse=$this->input->post('pulse');
        $pulse_type=$this->input->post('pulse_type');


        $upper_bp=$this->input->post('upper');
        $lower_bp=$this->input->post('lower');
        $chest=$this->input->post('chest');
        $abd=$this->input->post('abd');
        $cns=$this->input->post('cns');

        
        $group=$this->input->post('group');
       
        $investigation=$this->input->post('investigation');
        $diet=$this->input->post('diet');
        $councilling=$this->input->post('councilling');
        $diagnosis=$this->input->post('diagnosis');
        $review=$this->input->post('review');
        $cc_new=$this->input->post('cc_new'); //array
        $days_x=$this->input->post('days_x'); //array
        

        $write=$this->input->post('write');
        $date=$this->input->post('date');
         //$date=date("Y-m-d",strtotime($this->input->post('date')));

       
        $write_some=$this->input->post('write_some');



       
        $ho_new=$this->input->post('ho_new'); //array
        $ho_new_days=$this->input->post('ho_new_days'); //array
        // $ho_new= explode(',',$ho_new);
        $gen_new=$this->input->post('gen_new');
        $gen_new= explode(',',$gen_new);
        $chest_new=$this->input->post('chest_new');
        $chest_new= explode(',',$chest_new);
        $abd_new=$this->input->post('abd_new');
        $abd_new= explode(',',$abd_new);
        $cns_new=$this->input->post('cns_new');
        $cns_new= explode(',',$cns_new);
        $user_id=$this->session->userdata('hs_admin_id');

         $diet_name=$this->input->post('diet_name');
         $diet_name= explode(',',$diet_name);
       
         $councilling_name=$this->input->post('councilling_name');
         $councilling_name= explode(',',$councilling_name);

         $investigation_name=$this->input->post('investigation_name');
         $investigation_name= explode(',',$investigation_name);

         $diagnosis_name=$this->input->post('diagnosis_name');
         $diagnosis_name= explode(',',$diagnosis_name);


          $my_medicine=$this->input->post('my_medicine');

           $feedback=$this->input->post('feedback');

           $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array('id'=>$feedback), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

           if($feedback !="sos")
          {

             $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array('id'=>$feedback), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

             $feedback_days=@$days[0]->day;
          }

          else
          {

              $feedback_days=$feedback;
          }
    

        $data_gen_info=array(

                                'user_id'=>$patient,
                                'pulse'=>$pulse,
                                'bp_upper'=>$upper_bp,
                                'bp_lower'=>$lower_bp,
                                'check_next_date'=>$review,
                                'created_date'=>date('Y-m-d'),
                                'feedback'=>@$feedback_days,
                                'pulse_type'=>$pulse_type,
                                'created_by'=>$user_id
                             );

        $this->db->insert('tbl_patient_check_up_history',$data_gen_info);

        $chk_up_history_id=$this->db->insert_id();

        $EDDV=$this->input->post('date8');
        $LNPV=$this->input->post('date7');
        $gyno_weight=$this->input->post('gyno_weight');

        $data_gyno=array(

                'chk_history_id'=>$chk_up_history_id,
                'user_id'=>$patient,
                'eddv_date'=>$EDDV,
                'lnpv_date'=>$LNPV,
                'weight'=>$gyno_weight,
                'date'=>date('Y-m-d')
          );

        $this->db->insert('tbl_gyno_patient',$data_gyno);




      

        $data_pulse=array('pulse'=>$pulse,'bp_upper'=>$upper_bp,'bp_lower'=>$lower_bp);

        $this->db->where('user_id',$patient);
        $this->db->update('tbl_user',$data_pulse);

        $dose=$this->input->post('dose');

        if(count($my_medicine)>0)
        {

          for($i=0;$i<count($my_medicine);$i++)
          {

            if($dose[$i] != "")
            {
              $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array('id'=>$dose[$i]), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

              $my_days_data=$days[0]->day;
            }
            else
            {
                 $my_days_data="";

            }

              

              if($my_medicine[$i] != "")
              {
              $data_my_medicine=array(
                                  'chk_history_id'=>$chk_up_history_id,
                                  'user_id'=>$patient,
                                  'medicine_id'=>$my_medicine[$i],
                                  'dose'=>@$my_days_data,
                                  'group_id'=>'0',
                                  'created_date'=>date('Y-m-d'),
                                  'created_by'=>$user_id
                                 );

               $this->db->insert('tbl_patient_medicine',$data_my_medicine);
             }
          }
        }
$heart=$this->input->post('heart');
$heart_new=$this->input->post('heart_new');
$heart_new= explode(',',$heart_new);

$my_new_med_day=$this->input->post('my_new_med_day');
$my_new_med=$this->input->post('my_new_med');


 if(count($my_new_med)>0)
        {
            for($i=0;$i<count($my_new_med);$i++)
            {


                $data_my_new_med=array(
                                         'medicine_name'=>$my_new_med[$i],
                                          'created_by'=>$user_id,
                                         'status'=>'active',
                                          'created_date'=>date('Y-m-d')
                                      );


                 if($my_new_med[$i] !="")
                {

                      $this->db->insert('tbl_medicine',$data_my_new_med);

                      $new_med_id=$this->db->insert_id();

                       if($my_new_med_day[$i] != "")
                          {
                            $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array('id'=>$my_new_med_day[$i]), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

                            $my_days_data1=$days[0]->day;
                          }
                          else
                          {
                               $my_days_data1="";

                          }

                       $data_my_new=array(
                               'chk_history_id'=>$chk_up_history_id,
                                  'user_id'=>$patient,
                                  'medicine_id'=>$new_med_id,
                                  'dose'=>@$my_days_data1,
                                  'group_id'=>'0',
                                  'created_date'=>date('Y-m-d'),
                                  'created_by'=>$user_id
                               );

                       $this->db->insert('tbl_patient_medicine',$data_my_new);
               }

           }
        }







         if(count($heart)>0)
        {

              for($l=0;$l<count($heart);$l++)
              {

                $data_heart_exam=array(
                                'chk_history_id'=>$chk_up_history_id,
                                'user_id'=>$patient,
                                'heart_exam_id'=>$heart[$l],
                                'created_date'=>date('Y-m-d'),
                                'created_by'=>$user_id
                               );

                $this->db->insert('tbl_patient_heart',$data_heart_exam);
              }
            }
          if(count($heart_new)>0)
        {
            for($i=0;$i<count($heart_new);$i++)
            {

                $data_heart_master=array(
                                         'examination_name'=>$heart_new[$i],
                                          'created_by'=>$user_id,
                                          'examination_type_id'=>6,
                                          'created_date'=>date('Y-m-d')
                                      );


                 if($heart_new[$i] !="")
                {

                      $this->db->insert('tbl_examination',$data_heart_master);

                      $heart_id=$this->db->insert_id();

                       $data_heart=array(
                                'chk_history_id'=>$chk_up_history_id,
                                'user_id'=>$patient,
                                'heart_exam_id'=>$heart_id,
                                'created_date'=>date('Y-m-d'),
                                'created_by'=>$user_id
                               );

                       $this->db->insert('tbl_patient_heart',$data_heart);
               }

           }
        }




$dose_cc=$this->input->post('dose_cc');
      

 if(count($cc)>0)
        {
            for($i=0;$i<count($cc);$i++)
            {
              if($cc[$i] != "")
              {
                    $cccc_days = "";

                      if($dose_cc[$i] !=""){
                        $cccc_days = $dose_cc[$i];

                      }else{
                        $cccc_days = "";
                      }


              $data_cc=array(
                              'chk_history_id'=>$chk_up_history_id,
                              'user_id'=>$patient,
                              'cc_id'=>$cc[$i],
                               'day_id'=>$cccc_days,
                              'created_date'=>date('Y-m-d'),
                              'created_by'=>$patient
                             );

              $this->db->insert('tbl_patient_cc',$data_cc);
            }
            }
      }
        if(count($cc_new)>0)
        {
            for($i=0;$i<count($cc_new);$i++)
            {

                $data_cc_master=array(
                                          'cc_name'=>$cc_new[$i],
                                          'created_by'=>$user_id,
                                          'created_date'=>date('Y-m-d')
                                      );

                 if($cc_new[$i] !="")
                {
		                	$days = "";

		                	if($days_x[$i] !=""){
		                		$days = $days_x[$i];

		                	}else{
		                		$days = null;
		                	}

                  $this->db->insert('tbl_cc',$data_cc_master);

                  $cc_id=$this->db->insert_id();

                   $data_cc=array(
                            'chk_history_id'=>$chk_up_history_id,
                            'user_id'=>$patient,
                            'cc_id'=>$cc_id,
                            'day_id'=>$days,
                            'created_date'=>date('Y-m-d'),
                            'created_by'=>$user_id
                           );

                   $this->db->insert('tbl_patient_cc',$data_cc);
               }

           }
        }

        //insert ho
$dose_ho=$this->input->post('dose_ho');
        if(count($ho)>0)
        {
                   for($i=0;$i<count($ho);$i++)
              {
                  if($ho[$i] != "" && $dose_ho[$i] !="")
                  {
                  $data_ho=array(
                                  'chk_history_id'=>$chk_up_history_id,
                                  'user_id'=>$patient,
                                  'ho_id'=>$ho[$i],
                                  'day_id'=>$dose_ho[$i],
                                  'created_date'=>date('Y-m-d'),
                                  'created_by'=>$patient
                                 );

                  $this->db->insert('tbl_patient_ho',$data_ho);
              }
              }
        }
        if(count($ho_new)>0)
        {
            for($i=0;$i<count($ho_new);$i++)
            {
                $data_ho_master=array(
                                          'ho_name'=>$ho_new[$i],
                                          'created_by'=>$user_id,
                                          'created_date'=>date('Y-m-d')
                                      );

                 if($ho_new[$i] !="")
                {
                    $days = "";

                      if($ho_new_days[$i] !=""){
                        $days = $ho_new_days[$i];

                      }else{
                        $days = null;
                      }

                    $this->db->insert('tbl_ho',$data_ho_master);

                    $ho_id=$this->db->insert_id();

                     $data_ho=array(
                              'chk_history_id'=>$chk_up_history_id,
                              'user_id'=>$patient,
                              'ho_id'=>$ho_id,
                              'day_id'=>$days,
                              'created_date'=>date('Y-m-d'),
                              'created_by'=>$user_id
                             );

                     $this->db->insert('tbl_patient_ho',$data_ho);
               }

           }
        }
        //end oh ho insert

         if(count($kpo)>0)
        {
          
            for($j=0;$j<count($kpo);$j++)
            {

              $data_kpo=array(
                              'chk_history_id'=>$chk_up_history_id,
                              'user_id'=>$patient,
                              'kpo'=>$kpo[$j],
                              'created_date'=>date('Y-m-d'),
                              'created_by'=>$patient
                             );

              $this->db->insert('tbl_patient_kpo',$data_kpo);
            }
          }

 //insert general
           if(count($gen)>0)
        {
            for($k=0;$k<count($gen);$k++)
            {

              $data_gen_exam=array(
                              'chk_history_id'=>$chk_up_history_id,
                              'user_id'=>$patient,
                              'gen_exam'=>$gen[$k],
                              'created_date'=>date('Y-m-d'),
                              'created_by'=>$patient
                             );

              $this->db->insert('tbl_patient_gen_exam',$data_gen_exam);
            }
          }
          if(count($gen_new)>0)
        {
            for($i=0;$i<count($gen_new);$i++)
            {

                $data_gen_master=array(
                                          'examination_name'=>$gen_new[$i],
                                          'created_by'=>$user_id,
                                          'examination_type_id'=>2,
                                          'created_date'=>date('Y-m-d')
                                      );

                 if($gen_new[$i] !="")
                {

                    $this->db->insert('tbl_examination',$data_gen_master);

                    $gen_id=$this->db->insert_id();

                     $data_gen=array(
                              'chk_history_id'=>$chk_up_history_id,
                              'user_id'=>$patient,
                              'gen_exam'=>$gen_id,
                              'created_date'=>date('Y-m-d'),
                              'created_by'=>$user_id
                             );

                     $this->db->insert('tbl_patient_gen_exam',$data_gen);
               }

           }
        }

        //end of general insert

        // insert chest 

        if(count($chest)>0)
        {

              for($l=0;$l<count($chest);$l++)
              {

                $data_chest_exam=array(
                                'chk_history_id'=>$chk_up_history_id,
                                'user_id'=>$patient,
                                'chest_id'=> $chest[$l],
                                'created_date'=>date('Y-m-d'),
                                'created_by'=>$user_id
                               );

                $this->db->insert('tbl_patient_chest',$data_chest_exam);
              }
            }
          if(count($chest_new)>0)
        {
            for($i=0;$i<count($chest_new);$i++)
            {

                $data_chest_master=array(
                                         'examination_name'=>$chest_new[$i],
                                          'created_by'=>$user_id,
                                          'examination_type_id'=>3,
                                          'created_date'=>date('Y-m-d')
                                      );


                 if($chest_new[$i] !="")
                {

                      $this->db->insert('tbl_examination',$data_chest_master);

                      $chest_id=$this->db->insert_id();

                       $data_chest=array(
                                'chk_history_id'=>$chk_up_history_id,
                                'user_id'=>$patient,
                                'chest_id'=>$chest_id,
                                'created_date'=>date('Y-m-d'),
                                'created_by'=>$user_id
                               );

                       $this->db->insert('tbl_patient_chest',$data_chest);
               }

           }
        }



        //end of chest insert

        //insert of ABD 

        if(count($abd)>0)
        {

            for($m=0;$m<count($abd);$m++)
            {

              $data_abd_exam=array(
                              'chk_history_id'=>$chk_up_history_id,
                              'user_id'=>$patient,
                              'abd_id'=> $abd[$m],
                              'created_date'=>date('Y-m-d'),
                              'created_by'=>$patient
                             );

              $this->db->insert('tbl_patient_abd',$data_abd_exam);
            }
      }
         if(count($abd_new)>0)
        {
            for($i=0;$i<count($abd_new);$i++)
            {
                $data_abd_master=array(
                                         'examination_name'=>$abd_new[$i],
                                          'created_by'=>$user_id,
                                          'examination_type_id'=>4,
                                          'created_date'=>date('Y-m-d')
                                      );

                if($abd_new[$i] !="")
                {

                    $this->db->insert('tbl_examination',$data_abd_master);

                    $abd_id=$this->db->insert_id();

                     $data_abd=array(
                              'chk_history_id'=>$chk_up_history_id,
                              'user_id'=>$patient,
                              'abd_id'=>$abd_id,
                              'created_date'=>date('Y-m-d'),
                              'created_by'=>$user_id
                             );

                     $this->db->insert('tbl_patient_abd',$data_abd);
               }

           }
        }

 //end of insert  ABD

//insert cns
         if(count($cns)>0)
        {

            for($n=0;$n<count($cns);$n++)
            {

              $data_cns_exam=array(
                              'chk_history_id'=>$chk_up_history_id,
                              'user_id'=>$patient,
                              'cns_id'=> $cns[$n],
                              'created_date'=>date('Y-m-d'),
                              'created_by'=>$patient
                             );

              $this->db->insert('tbl_patient_cns',$data_cns_exam);
            }
        }

           if(count($cns_new)>0)
        {
            for($i=0;$i<count($cns_new);$i++)
            {



                $data_cns_master=array(
                                         'examination_name'=>$cns_new[$i],
                                          'created_by'=>$user_id,
                                          'examination_type_id'=>5,
                                          'created_date'=>date('Y-m-d')
                                      );

                  if($cns_new[$i] !="")
                {


                    $this->db->insert('tbl_examination',$data_cns_master);

                    $cns_id=$this->db->insert_id();

                     $data_cns=array(
                              'chk_history_id'=>$chk_up_history_id,
                              'user_id'=>$patient,
                              'cns_id'=>$cns_id,
                              'created_date'=>date('Y-m-d'),
                              'created_by'=>$user_id
                             );

                     $this->db->insert('tbl_patient_cns',$data_cns);
               }

           }
        }
//end of cns insert
    // $medicine=$this->input->post('my_purpose_processing');
        //$medicine= explode(',',$medicine);
        if(count($group)>0)
        {


             for($p=0;$p<count($group);$p++)
            {

              $md=$p+1;
              

              $medicine=$this->input->post('medicine'.$md);

              //echo count($medicine);

            

                for($k=0;$k<count($medicine);$k++)
                {

                  $data_medicine=array(
                                  'chk_history_id'=>$chk_up_history_id,
                                  'user_id'=>$patient,
                                  'medicine_id'=>$medicine[$k],
                                  
                                  'group_id'=>$group[$p],
                                  'created_date'=>date('Y-m-d'),
                                  'created_by'=>$user_id
                                 );

                  if($medicine[$k] !="")
                  {
                     $this->db->insert('tbl_patient_medicine',$data_medicine);
                  }

                 
                }
            }

      }
$write_some=$this->input->post('write_some');
      if(count($write)>0)
        {


            for($p=0;$p<count($write);$p++)
            {
              if($write_some[$p] != "")
              {

                $investigation_report =  $this->common->select($table_name='tbl_investigations',$field=array(), $where=array('investigation_id'=>$write[$p]), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

              $data_medicine=array(
                              'chk_history_id'=>$chk_up_history_id,
                              'user_id'=>$patient,
                              'content'=>@$investigation_report[0]->investigation_name,
                              'description'=>$write_some[$p],
                              'date'=>date("Y-m-d",strtotime($date[$p])),
                              'created_date'=>date('Y-m-d'),
                              'created_by'=>$user_id
                             );

              $this->db->insert('tbl_patient_report',$data_medicine);
            }
            }

      }

       if(count($investigation)>0)
        {

             for($q=0;$q<count($investigation);$q++)
            {

              $data_investigation=array(
                              'chk_history_id'=>$chk_up_history_id,
                              'user_id'=>$patient,
                              'investigation_id'=>$investigation[$q],
                              
                              'created_date'=>date('Y-m-d'),
                              'created_by'=>$patient
                             );

              $this->db->insert('tbl_patient_investigation',$data_investigation);
            }

          }

         if(count($investigation_name)>0)
        {
            for($i=0;$i<count($investigation_name);$i++)
            {
                $data_investigation_name_master=array(
                                          'investigation_name'=>$investigation_name[$i],
                                          'created_by'=>$user_id,
                                          'created_date'=>date('Y-m-d')
                                      );


                  if($investigation_name[$i] !="")
                {

                    $this->db->insert('tbl_investigations',$data_investigation_name_master);

                    $investigation_id=$this->db->insert_id();

                     $data_investigation_name=array(
                              'chk_history_id'=>$chk_up_history_id,
                              'user_id'=>$patient,
                              'investigation_id'=>$investigation_id,
                              'created_date'=>date('Y-m-d'),
                              'created_by'=>$user_id
                             );

                     $this->db->insert('tbl_patient_investigation',$data_investigation_name);
               }

           }
        }

        $new_report=$this->input->post('new_report');
 $new_report_write=$this->input->post('new_report_write');
 //$new_report_date=date("Y-m-d",strtotime($this->input->post('new_report_date')));
 $new_report_date=$this->input->post('new_report_date');



         if(count($new_report)>0)
        {
            for($i=0;$i<count($new_report);$i++)
            {



                 $data_investigation_r_name_master=array(
                                          'investigation_name'=>$new_report[$i],
                                          'created_by'=>$user_id,
                                          'created_date'=>date('Y-m-d')
                                      );

                $this->db->insert('tbl_investigations',$data_investigation_r_name_master);

                if($new_report[$i] !="")
                {

                $report_id=$this->db->insert_id();

                 $data_rep=array(
                          'chk_history_id'=>$chk_up_history_id,
                          'user_id'=>$patient,
                          'content'=>$new_report[$i],
                           'description'=>$new_report_write[$i],
                          'date'=>date("Y-m-d",strtotime($new_report_date[$i])),
                          'created_date'=>date('Y-m-d'),
                          'created_by'=>$user_id
                         );
            if($new_report[$i] != "")
            {
               $this->db->insert('tbl_patient_report',$data_rep);
            }
             }

           }
        }

        //end oh ho insert
          if(count($diet)>0)
        {

            for($r=0;$r<count($diet);$r++)
            {

              $data_diet=array(
                              'chk_history_id'=>$chk_up_history_id,
                              'user_id'=>$patient,
                              'diet_id'=>$diet[$r],
                              
                              'created_date'=>date('Y-m-d'),
                              'created_by'=>$patient
                             );

              $this->db->insert('tbl_patient_diet',$data_diet);
            }
        }

         if(count($diet_name)>0)
        {
            for($i=0;$i<count($diet_name);$i++)
            {

                $data_diet_name_master=array(
                                          'diet_name'=>$diet_name[$i],
                                          'created_by'=>$user_id,
                                          'created_date'=>date('Y-m-d')
                                      );

                 if($diet_name[$i] !="")
                {


                    $this->db->insert('tbl_diet',$data_diet_name_master);

                    $diet_id=$this->db->insert_id();

                     $diet_name_cc=array(
                              'chk_history_id'=>$chk_up_history_id,
                              'user_id'=>$patient,
                              'diet_id'=>$diet_id,
                              'created_date'=>date('Y-m-d'),
                              'created_by'=>$user_id
                             );

                     $this->db->insert('tbl_patient_diet',$diet_name_cc);
               }

           }
        }

          if(count($councilling)>0)
        {
            for($s=0;$s<count($councilling);$s++)
            {

              $data_councilling=array(
                              'chk_history_id'=>$chk_up_history_id,
                              'user_id'=>$patient,
                              'councelling_id'=>$councilling[$s],
                              
                              'created_date'=>date('Y-m-d'),
                              'created_by'=>$patient
                             );

              $this->db->insert('tbl_patient_councelling',$data_councilling);
            }
      }


        if(count($councilling_name)>0)
        {
            for($i=0;$i<count($councilling_name);$i++)
            {

                $data_councilling_name_master=array(
                                          'councelling_name'=>$councilling_name[$i],
                                          'created_by'=>$user_id,
                                          'created_date'=>date('Y-m-d')
                                      );


                 if($councilling_name[$i] !="")
                {

                    $this->db->insert('tbl_councelling',$data_councilling_name_master);

                    $councilling_name_id=$this->db->insert_id();

                     $councilling_name_cc=array(
                              'chk_history_id'=>$chk_up_history_id,
                              'user_id'=>$patient,
                              'councelling_id'=>$councilling_name_id,
                              'created_date'=>date('Y-m-d'),
                              'created_by'=>$patient
                             );

                     $this->db->insert('tbl_patient_councelling',$councilling_name_cc);
               }

           }
        }


if(count($diagnosis)>0)
        {

            for($t=0;$t<count($diagnosis);$t++)
            {

              $data_diagnosis=array(
                              'chk_history_id'=>$chk_up_history_id,
                              'user_id'=>$patient,
                              'diagnosis_id'=>$diagnosis[$t],
                              
                              'created_date'=>date('Y-m-d'),
                              'created_by'=>$patient
                             );

              $this->db->insert('tbl_patient_diagnosis',$data_diagnosis);
            }
      }

         if(count($diagnosis_name)>0)
        {
            for($i=0;$i<count($diagnosis_name);$i++)
            {
                $data_diagnosis_name_master=array(
                                          'diagnosis_name'=>$diagnosis_name[$i],
                                          'created_by'=>$user_id,
                                          'created_date'=>date('Y-m-d')
                                      );


                 if($diagnosis_name[$i] !="")
                {

                    $this->db->insert('tbl_diagnosis',$data_diagnosis_name_master);

                    $diagnosis_name_id=$this->db->insert_id();

                     $data_diagnosis_name=array(
                              'chk_history_id'=>$chk_up_history_id,
                              'user_id'=>$patient,
                              'diagnosis_id'=>$diagnosis_name_id,
                              'created_date'=>date('Y-m-d'),
                              'created_by'=>$user_id
                             );

                     $this->db->insert('tbl_patient_diagnosis',$data_diagnosis_name);
               }

           }
        }


    $invoice_no="OPD".rand('000','999').$chk_up_history_id.$patient;
  
   
         $prescription=  $this->common->get_prescription_details($chk_up_history_id,$patient);

        //echo "<pre>"; print_r($prescription);exit;
   
    $mail_data= array(
                        'prescription'=>$prescription,
                        'chk_history_id'=>$chk_up_history_id,
                        'user_id'=>$patient
                      
                    
                        );   
   

            $this->load->library('m_pdf');

            $this->load->view('invoice_view',$mail_data); 
            $i = $invoice_no; 
            $html=$this->load->view('invoice_view',$mail_data, true); 
         
            $pdfFilePath ='../assets/upload/invoice/admin/'.$i.".pdf";
            $this->m_pdf->pdf->WriteHTML($html);
            $this->m_pdf->pdf->Output($pdfFilePath, "F");
            $data_file = file_get_contents($pdfFilePath);
        
           // $name = $i.'.pdf';



          $this->session->set_flashdata('flash_msg','Data Successfully Submitted.');
          //redirect('admin_prescription','refresh');  

          redirect('admin_prescription/individual_invoice1/'.$i);      

    }    

        function individual_invoice()
    {

       $chk_history_id= $this->uri->segment(3);

   
    $user_id=$this->uri->segment(4);

    $invoice_no="OPD".rand('000','999').$chk_history_id.$user_id;
  
   
         $prescription=  $this->common->get_prescription_details($chk_history_id,$user_id);

        //echo "<pre>"; print_r($prescription);exit;
   
    $mail_data= array(
                        'prescription'=>$prescription,
                        'chk_history_id'=>$chk_history_id,
                        'user_id'=>$user_id
                      
                    
                        );   

     $this->load->library('m_pdf');

            $this->load->view('invoice_view',$mail_data); 
            $i = $invoice_no; 
            $html=$this->load->view('invoice_view',$mail_data, true); 
         
            $pdfFilePath ='../assets/upload/invoice/admin/'.$i.".pdf";
            $this->m_pdf->pdf->WriteHTML($html);
            $this->m_pdf->pdf->Output($pdfFilePath, "F");
            $data_file = file_get_contents($pdfFilePath);

            redirect('admin_prescription/individual_invoice1/'.$i);   
  }
   
    

    function individual_invoice1()
    {
      $data['inv_no']=$this->uri->segment(3);
      $this->load->view('common/header');
      $this->load->view('common/leftmenu');
      $this->load->view('add_user_step_2',$data);
      $this->load->view('common/footer');
    }

    function get_medicine()
    {

        $group_id=$this->input->post('group_id');

         //$state =  $this->common->select($table_name='tbl_medicine',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
        //$state=$this->home_model->selectOne('tbl_state','country_id',$country_id);

        $this->db->select('*');
        $this->db->from('tbl_group_medicine tgm');
        $this->db->join('tbl_medicine tm','tm.medicine_id=tgm.medicine_id');
        $this->db->where('tgm.group_id',$group_id);
        $query=$this->db->get();
        $my_med=$query->result();
        echo json_encode($my_med);
    }

    function add_prescription()
    {

         $data['active']="manage_prescription";

          $data['med_list'] =  $this->common->select($table_name='tbl_medicine',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

           $data['group'] =  $this->common->select($table_name='tbl_group',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


         $data['cc'] =  $this->common->select($table_name='tbl_cc',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

          $data['ho'] =  $this->common->select($table_name='tbl_ho',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

          $data['kpo'] =  $this->common->select($table_name='tbl_kpo',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

         $data['investigation'] =  $this->common->select($table_name='tbl_investigations',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

         $data['diet'] =  $this->common->select($table_name='tbl_diet',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

         $data['councelling'] =  $this->common->select($table_name='tbl_councelling',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

         $data['patient'] =  $this->common->select($table_name='tbl_user',$field=array(), $where=array('user_type_id'=>2,'status'=>'active','created_on'=>date('Y-m-d')), $where_or=array('modified_on'=>date('Y-m-d')),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

         $data['diagnosis'] =  $this->common->select($table_name='tbl_diagnosis',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
       
       
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('add_prescription_view');
        $this->load->view('common/footer');
    }

    function edu_file_box_show_my_med()
    {

       $id=$this->input->post('num');

            $next=$id+1;

             $med_list=  $this->common->select($table_name='tbl_medicine',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

      ?>

        <div class="form-group frm-diff medi-p-cus-se new_desin_mediam Medicine_Name">
                                         <label for="product_name" class=" control-label">Medicine Name</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select2"   name="my_medicine[]" id="my_medicine_<?php echo $next; ?>"  required="">
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
                                            <label for="product_name" class="control-label">Days</label>
                                            <div class="col-sm-8">
                                              
                                               <select  class="form-control" name="dose[]" id="dose_<?php echo $next; ?>"  required="">
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

                                            <div class="inder-left-sec data_medicine_add_btn">
                                           
                                                     <?php if($next!=10){ ?> <a href="javacript:void(0)"  id="edu_nomed_<?php echo $next; ?>" onclick="edu_produce_file_box_my_med('<?php echo $next; ?>')" class="btn btn-primary"><b>+</b></a><?php }?>
                                                
                                                    <a href="javacript:void(0)" class="btn btn-primary" id="minus" onclick="edu_hiding_out_my_med('<?php echo $next; ?>');"><b>-</b></a></td>
                                              
                                        </div>
                                        <?php
    }

     function edu_file_box_show()
    {

        $med_list=  $this->common->select($table_name='tbl_medicine',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

          $group =  $this->common->select($table_name='tbl_group',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            $id=$this->input->post('num');

            $next=$id+1;

            ?>                                 
                                
                                  

                                         <div class="form-group frm-diff new_desin">
                                         <label for="product_name" class="control-label">Disease</label>
                                          <div class="col-sm-8">
                                               <select  class="form-control select" name="group[]" onchange="get_med(this.value,<?php echo $next; ?>)" id="group_<?php echo $next; ?>"  required="">
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

                                           <div class="processing_cont" id="get_des_med_<?php echo $next; ?>" style="min-height: 1px;overflow-y:scroll;max-height: 200px;">

                                        
                    
            


                    </div>

                    </div>

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

                                       <div class="advice-section-btn-plus-p-cus">
                                            <div class="medi-p-cus-btn-right">
                                                <td>
                                                     <?php if($next!=10){ ?> <a href="javacript:void(0)"  id="edu_no_<?php echo $next; ?>" onclick="edu_produce_file_box('<?php echo $next; ?>')" class="btn btn-primary"><b>+</b></a><?php }?>
                                                </td>
                                                <td>
                                                    <a href="javacript:void(0)" class="btn btn-primary" id="minus" onclick="edu_hiding_out('<?php echo $next; ?>');"><b>-</b></a></td>
                                             
                                           
                                        </div>
                                </div>

        <?php
      }






       function edu_report_file_box_show()
    {

       $id=$this->input->post('num');

            $next=$id+1;

            // $med_list=  $this->common->select($table_name='tbl_medicine',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


              $investigation=  $this->common->select($table_name='tbl_investigations',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');




      ?>



  <div class="form-group frm-diff new_desin Report">
                                           
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

                                          <div class="form-group frm-diff new_desin Report">
                                           <!--  <label for="product_name" class="col-sm-2 control-label">Date</label> -->
                                            <div class="col-sm-8">
                                              
                                             

                                                <input type="text" name="write_some[]" value=""  class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group frm-diff new_desin_day">
                                           <!--  <label for="product_name" class="col-sm-2 control-label">Date</label> -->
                                            <div class="col-sm-8">
                                              
                                             

                                                <input type="date" name="date[]" class="form-control">
                                            </div>
                                        </div>
        




                                            <div class="report-p-cus-plus-mi-btn">
                                            <div class="report-p-cus-text-right">
                                                <td>
                                                     <?php if($next!=10){ ?> <a href="javacript:void(0)"  id="edu_report_no_<?php echo $next; ?>" onclick="edu_report_produce_file_box('<?php echo $next; ?>')" class="btn btn-primary"><b>+</b></a><?php }?>
                                                </td>
                                                <td>
                                                    <a href="javacript:void(0)" class="btn btn-primary" id="report_minus" onclick="edu_report_hiding_out('<?php echo $next; ?>');"><b>-</b></a></td>
                                                <!-- </td> -->
                                            </div>
                                        </div>

                                        
                                        <?php
    }





function get_user_data2()
{

        $user_id=$this->input->post('user_id');

         $data['check_up_history']=  $this->common->select($table_name='tbl_patient_check_up_history',$field=array(), $where=array('user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

         if(count($data['check_up_history'])>0)
         {

            $result=1;

            $chk_history_id=@$data['check_up_history'][0]->chk_history_id;



           
         }
         else
         {

             $result=0;

            $chk_history_id="";

         }

          echo json_encode(array('res'=>$result,'chk_history_id'=>$chk_history_id,'user_id'=>$user_id));
}







      function get_user_data1()
      {

         $user_id=$this->input->post('user_id');

         $data['user_detail']=  $this->common->select($table_name='tbl_user',$field=array(), $where=array('user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

         $pulse=@$data['user_detail'][0]->pulse;
         $upper=@$data['user_detail'][0]->bp_upper;
         $lower=@$data['user_detail'][0]->bp_lower;
         $weight=@$data['user_detail'][0]->weight;

         echo json_encode(array('pulse'=>$pulse,'upper'=>$upper,'lower'=>$lower,'weight'=>$weight));
      }

      function get_user_data()
      {

        $user_id=$this->input->post('user_id');

         $data['user_detail']=  $this->common->select($table_name='tbl_user',$field=array(), $where=array('user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

        ?>
         <table id="example1" class="table table-bordered table-striped">

                                        <thead>
                                            <tr class="bg-blue">
                                          <th>Patient Id</th>
                                              <th>First Name</th>
                                             <th>Last Name</th>
                                        
                                             <th>Mobile</th>
                                             <th>Age (Yr)</th>
                                             <th>Gender</th>
                                             <th>Weight (Kg)</th>
                                             <th>Height (m)</th>
                                             <th>BMI (Kg/m^2)</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php foreach( $data['user_detail'] as $row)

                                            { ?>
                                                                      
                                          <tr>

                                           <td>
                                                  <?php echo $row->user_unique_id; ?>
                                              </td>
                                              <td>
                                                  <?php echo $row->first_name; ?>
                                              </td>
                                               <td>
                                                   <?php echo $row->last_name; ?>
                                              </td>
                                               <td>
                                                   <?php echo $row->mobile; ?>
                                              </td>
                                               <td>
                                                     <?php echo $row->age; ?>
                                              </td>

                                               <td>
                                                     <?php echo $row->gender; ?>
                                              </td> 
                                              <td>
                                                   <?php echo $row->weight; ?>
                                              </td>
                                               <td>
                                                     <?php echo $row->height; ?>
                                              </td>
                                               <td>
                                                     <?php echo $row->bmi; ?>
                                              </td>

                                          </tr>
                                          <?php } ?>
                                          </tbody>
                                        </table>
                                        <?php
      }


      function delete_prescription()
    {

      $chk_history_id=$this->uri->segment(3);
      $this->db->where('chk_history_id',$chk_history_id);
      $this->db->delete('tbl_patient_check_up_history');
      $this->db->where('chk_history_id',$chk_history_id);
      $this->db->delete('tbl_patient_cc');
      $this->db->where('chk_history_id',$chk_history_id);
      $this->db->delete('tbl_patient_ho');
      $this->db->where('chk_history_id',$chk_history_id);
      $this->db->delete('tbl_patient_kpo');
      $this->db->where('chk_history_id',$chk_history_id);
      $this->db->delete('tbl_patient_gen_exam');
      $this->db->where('chk_history_id',$chk_history_id);
      $this->db->delete('tbl_patient_chest');
      $this->db->where('chk_history_id',$chk_history_id);
      $this->db->delete('tbl_patient_abd');
      $this->db->where('chk_history_id',$chk_history_id);
      $this->db->delete('tbl_patient_cns');
      $this->db->where('chk_history_id',$chk_history_id);
      $this->db->delete('tbl_patient_medicine');
      $this->db->where('chk_history_id',$chk_history_id);
      $this->db->delete('tbl_patient_investigation');
     $this->db->where('chk_history_id',$chk_history_id);
     $this->db->delete('tbl_patient_diet');  
     $this->db->where('chk_history_id',$chk_history_id);
     $this->db->delete('tbl_patient_councelling');
     $this->db->where('chk_history_id',$chk_history_id);
     $this->db->delete('tbl_patient_diagnosis');
     $this->db->where('chk_history_id',$chk_history_id);
     @$this->db->delete('tbl_patient_report');
      $this->db->where('chk_history_id',$chk_history_id);
     @$this->db->delete('tbl_patient_heart');
    $this->session->set_flashdata('flash_msg','Data Successfully Deleted.');
    redirect('admin_prescription','refresh');  

    }



      function individual_invoice3()
{
     $chk_history_id= $this->uri->segment(3);

   
    $user_id=$this->uri->segment(4);

    $invoice_no="OPD".rand('000','999').$chk_history_id.$user_id;
  
   
         $prescription=  $this->common->get_prescription_details($chk_history_id,$user_id);

        //echo "<pre>"; print_r($prescription);exit;
   
    $mail_data= array(
                        'prescription'=>$prescription,
                        'chk_history_id'=>$chk_history_id,
                        'user_id'=>$user_id
                      
                    
                        );   
   

            $this->load->library('m_pdf');

            $this->load->view('invoice_view',$mail_data); 
            $i = $invoice_no; 
            $html=$this->load->view('invoice_view',$mail_data, true); 
         
            $pdfFilePath ='../assets/upload/invoice/admin/'.$i.".pdf";
            $this->m_pdf->pdf->WriteHTML($html);
            $this->m_pdf->pdf->Output($pdfFilePath, "F");
            $data_file = file_get_contents($pdfFilePath);
        
            $name = $i.'.pdf';
            force_download($name,$data_file); 
   
}

function edu_file_box_show_my_new_med()
    {

       $id=$this->input->post('num');

            $next=$id+1;

           
      ?>

         <div class="form-group frm-diff">
                                            <label for="product_name" class=" control-label">medicine</label>
                                            <div class="col-sm-8">
                                              <div id="null">
                                               <input type="text" class="form-control" name="my_new_med[]" id="my_new_med_<?php echo $next; ?>"  required="" placeholder="add new medicine">
                                               </div>
                                             </div>
                                           </div>

       <div class="form-group frm-diff">
                                            <label for="product_name" class=" control-label">Days</label>
                                            <div class="col-sm-8">
                                                <select  class="form-control" name="my_new_med_day[]" id="my_new_med_day_<?php echo $next; ?>"  required="">
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

                                           
                                           
      <?php if($next!=10){ ?> 
        <a href="javacript:void(0)"  id="edu_mynew_med_<?php echo $next; ?>" onclick="edu_produce_file_box_my_new_med('<?php echo $next; ?>')" class="btn btn-primary plus-p-khi"><b>+</b></a><?php }?>
                                                
  <a href="javacript:void(0)" class="btn btn-primary" id="minus" onclick="edu_hiding_out_my_new_med('<?php echo $next; ?>');"><b>-</b></a></td>
                                              
                                     
                                        <?php
    }

}
?>