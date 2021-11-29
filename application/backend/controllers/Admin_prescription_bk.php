

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
        if ($this->session->userdata('hs_admin_id')=="")
        {
            redirect(base_url().'index.php/admin_login');
        }
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
        $hb=$this->input->post('ho');
        $gen=$this->input->post('gen');
        $pulse=$this->input->post('pulse');
        $upper_bp=$this->input->post('upper');
        $lower_bp=$this->input->post('lower');
        $chest=$this->input->post('chest');
        $abd=$this->input->post('abd');
        $cns=$this->input->post('cns');
        $medicine=$this->input->post('medicine');
        $dose=$this->input->post('dose');
        $investigation=$this->input->post('investigation');
        $diet=$this->input->post('diet');
        $councilling=$this->input->post('councilling');
        $diagnosis=$this->input->post('diagnosis');
        $review=$this->input->post('review');

        $data_gen_info=array(

                                'user_id'=>$patient,
                                'pulse'=>$pulse,
                                'bp_upper'=>$upper_bp,
                                'bp_lower'=>$lower_bp,
                                'check_next_date'=>$review,
                                'created_date'=>date('Y-m-d'),
                                'hb'=>$hb,
                                'created_by'=>$patient
                             );

        $this->db->insert('tbl_patient_check_up_history',$data_gen_info);

        $chk_up_history_id=$this->db->insert_id();


        for($i=0;$i<count($cc);$i++)
        {

          $data_cc=array(
                          'chk_history_id'=>$chk_up_history_id,
                          'user_id'=>$patient,
                          'cc_id'=>$cc[$i],
                          'created_date'=>date('Y-m-d'),
                          'created_by'=>$patient
                         );

          $this->db->insert('tbl_patient_cc',$data_cc);
        }
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

        for($l=0;$l<count($chest);$l++)
        {

          $data_chest_exam=array(
                          'chk_history_id'=>$chk_up_history_id,
                          'user_id'=>$patient,
                          'chest_id'=> $chest[$l],
                          'created_date'=>date('Y-m-d'),
                          'created_by'=>$patient
                         );

          $this->db->insert('tbl_patient_chest',$data_chest_exam);
        }

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


         for($p=0;$p<count($medicine) && $p<count($dose) ;$p++)
        {

          $data_medicine=array(
                          'chk_history_id'=>$chk_up_history_id,
                          'user_id'=>$patient,
                          'medicine_id'=>$medicine[$p],
                          'dose'=>$dose[$p],
                          'created_date'=>date('Y-m-d'),
                          'created_by'=>$patient
                         );

          $this->db->insert('tbl_patient_medicine',$data_medicine);
        }

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



          $this->session->set_flashdata('flash_msg','Data Successfully Submitted.');
          redirect('admin_prescription','refresh');

        

    }

    

    function add_prescription()
    {

         $data['active']="manage_prescription";

          $data['med_list'] =  $this->common->select($table_name='tbl_medicine',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

         $data['cc'] =  $this->common->select($table_name='tbl_cc',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

          $data['ho'] =  $this->common->select($table_name='tbl_ho',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

          $data['kpo'] =  $this->common->select($table_name='tbl_kpo',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

         $data['investigation'] =  $this->common->select($table_name='tbl_investigations',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

         $data['diet'] =  $this->common->select($table_name='tbl_diet',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

         $data['councelling'] =  $this->common->select($table_name='tbl_councelling',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

         $data['patient'] =  $this->common->select($table_name='tbl_user',$field=array(), $where=array('user_type_id'=>2,'status'=>'active','created_on'=>date('Y-m-d')), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

         $data['diagnosis'] =  $this->common->select($table_name='tbl_diagnosis',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
       
       
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('add_prescription_view');
        $this->load->view('common/footer');
    }

     function edu_file_box_show()
    {

        $med_list=  $this->common->select($table_name='tbl_medicine',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            $id=$this->input->post('num');

            $next=$id+1;
 


            ?>


  
                         
           
                                  
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
                                                <textarea class="form-control" type="text" name="dose[]" id="dose" placeholder="Dose"></textarea>
                                            </div>
                                        </div>

                                       

                                         <table>
                                            <tr>
                                                <td>
                                                     <?php if($next!=5){ ?> <a href="javacript:void(0)"  id="edu_no_<?php echo $next; ?>" onclick="edu_produce_file_box('<?php echo $next; ?>')" class="btn btn-primary"><b>Add More</b></a><?php }?>
                                                </td>
                                                <td>
                                                    <a href="javacript:void(0)" class="btn btn-primary" id="minus" onclick="edu_hiding_out('<?php echo $next; ?>');"><b>-</b></a></td>
                                                </td>
                                            </tr>
                                        </table>          

                                       

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


        <?php
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
      $this->db->delete('tbl_patient_cc');
      $this->db->delete('tbl_patient_kpo');
      $this->db->delete('tbl_patient_gen_exam');
      $this->db->delete('tbl_patient_chest');
      $this->db->delete('tbl_patient_abd');
      $this->db->delete('tbl_patient_cns');
      $this->db->delete('tbl_patient_medicine');
      $this->db->delete('tbl_patient_investigation');
 
     $this->db->delete('tbl_patient_diet');  
     $this->db->delete('tbl_patient_councelling');
     $this->db->delete('tbl_patient_diagnosis');
    $this->session->set_flashdata('flash_msg','Data Successfully Deleted.');
    redirect('admin_prescription','refresh');
   

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
        
            $name = $i.'.pdf';
            force_download($name,$data_file);
  
   
}



}
?>