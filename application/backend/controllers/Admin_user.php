

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_user extends CI_Controller
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

    	$data['active']="manage_doc";

    	 $data['doc_list'] =  $this->common->select($table_name='tbl_user',$field=array(), $where=array('user_type_id'=>3), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('doctor_list_view',$data);
        $this->load->view('common/footer');
    }

    function add_doctor()
    {
        $data['chamber_list'] =  $this->common->select($table_name='tbl_chamber',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
        $data['active']="manage_doc";
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('doctor_add_view',$data);
        $this->load->view('common/footer');
    }

    function edu_file_box_show_ho()
    {

           $ho =  $this->common->select($table_name='tbl_ho',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            $id=$this->input->post('num');

            $next=$id+1;


        ?>


         <div class="form-group frm-diff add_blank">
                                            
                                            <div class="col-sm-8">
                                                 <div id="null">
                                               <select  class="form-control" style="display: none;">
                                                     
                                                </select>
                                                </div>
                                                
                                            </div>
                                        </div>





                                          <div class="form-group frm-diff new_desin C_C">
                                            <label for="product_name" class="control-label">H/O</label>
                                            <div class="col-sm-8">
                                                 <div id="null">
                                               <select  class="form-control" name="ho[]" id="ho_<?php echo $next; ?>"   required="">
                                                      <option value="">--Select H/O--</option>
                      
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
                                            <label for="product_name" class="control-label">Days</label>
                                            <div class="col-sm-8">

                                              <input type="text" class="form-control" name="dose_ho[]" id="dose_ho_<?php echo $next; ?>">
                                              
                                            <!--    <select  class="form-control" name="dose_ho[]" id="dose_ho_<?php echo $next; ?>"  required="">
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

                                                    <div class="all-p-cus-section-left">
                                            <div class="inder-left-sec">
                                                <td>
                                                     <?php if($next!=10){ ?> <a href="javacript:void(0)"  id="edu_no3_<?php echo $next; ?>" onclick="edu_produce_file_box_ho('<?php echo $next; ?>')" class="btn btn-primary"><b>+</b></a><?php }?>
                                                </td>
                                                <td>
                                                    <a href="javacript:void(0)" class="btn btn-primary" id="minus" onclick="edu_hiding_out_ho('<?php echo $next; ?>');"><b>-</b></a></td>
                                                
                                            </div>
                                        </div>

        <?php 
    }

    function edu_file_box_show_cc1()
    {


         $cc=  $this->common->select($table_name='tbl_cc',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

           $id=$this->input->post('num');

            $next=$id+1;


      ?>
  <div class="form-group frm-diff add_blank">
          <select  class="form-control" style="display: none;">
                                                </select>
                                              </div>
         <div class="form-group frm-diff new_desin C_C">
         
                                            <label for="product_name" class="control-label">C/C</label>
                                            <div class="col-sm-8" >

                                            <div id="null">
                                              

                                               <select  class="form-control" name="cc[]" id="cc_<?php echo $next; ?>"  required="">
                                                    
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

                                          <div class="form-group frm-diff new_desin_day Days_c_c">
                                            <label for="product_name" class="control-label">Days</label>
                                            <div class="col-sm-8">
                                              
                                               <select  class="form-control" name="dose_cc[]" id="dose_cc_<?php echo $next; ?>"  required="">
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
                                            <div class="add_remove">
                                            <div class="all-p-add-pplus-mina">
                                              <div class="right-p-sec-pp">
                                                <td>
                                                     <?php if($next!=10){ ?> <a href="javacript:void(0)"  id="edu_no2_<?php echo $next; ?>" onclick="edu_produce_file_box_cc('<?php echo $next; ?>')" class="btn btn-primary"><b>+</b></a><?php }?>
                                                </td>
                                                <td>
                                                    <a href="javacript:void(0)" class="btn btn-primary" id="minus" onclick="edu_hiding_out_cc('<?php echo $next; ?>');"><b>-</b></a></td>
                                                  </div>
                                                
                                            </div>
                                        </div>

                                        





      <?php 
    }


    function doctor_add_action()
    {

        $first_name=$this->input->post('first_name');

        $last_name=$this->input->post('last_name');

        $email=$this->input->post('email');

        $password=$this->input->post('pass');

        $mobile=$this->input->post('mobile');

        $age=$this->input->post('age');

        $gen=$this->input->post('gen');

        $weight=$this->input->post('weight');

        $height=$this->input->post('height');

        $exp=$this->input->post('exp');

        $reg_no=$this->input->post('reg_no');

        $start=$this->input->post('start');

        $start1 = date('Y-m-d',strtotime($start));

        $chamber=$this->input->post('chamber');

        $fees=$this->input->post('fees');

        $unique_id=date('mY').rand(000,999);

        $created_date=date('Y-m-d');

        $created_by=$this->session->userdata('hs_admin_id');


        $data_user=array(

                                'first_name'=>$first_name,
                                'last_name'=>$last_name,
                                'login_email'=>$email,
                                'mobile'=>$mobile,
                                'login_pass'=>$password,
                                'user_unique_id'=>$unique_id,
                                'age'=>$age,
                                'weight'=>$weight,
                                'height'=>$height,
                                'gender'=>$gen,
                                'created_by'=>$created_by,
                                'created_on'=>$created_date,
                                'user_type_id'=>3

                        );

        $this->db->insert('tbl_user',$data_user);

        $user_id=$this->db->insert_id();



        $data_doc=array(

                            'user_id'=>$user_id,
                            'exp_desc'=>$exp,
                            'reg_no'=>$reg_no,
                            'created_by'=>$created_by,
                            'created_on'=>$created_date,
                            'start_year'=>$start1
                        );

         $this->db->insert('tbl_doctor',$data_doc);

         $doc_id=$this->db->insert_id();

         for($i=0;$i<count($chamber) && $i<count($fees);$i++)
         {



                $data_doc_chamber=array(

                                            'doctor_id'=>$doc_id,
                                            'chamber_id'=>$chamber[$i],
                                            'fees'=>$fees[$i]
                                        );

                 $this->db->insert('tbl_doctor_chamber',$data_doc_chamber);
            }

       

        $this->session->set_flashdata('flash_msg','Data Successfully Submited.');
        redirect('admin_user','refresh');
    }

  

    function change_to_active_doc()
{
    
        $pro_ids=$this->input->post('pid');
        $status=$this->input->post('status');
        $data=array('status'=>$status);


        for($i=0;$i<count($pro_ids);$i++)
        {
            $id=$pro_ids[$i];
            $this->db->where('user_id',$id);

            if($this->db->update('tbl_user',$data))
            {
                $result=1;
            }
            else
            {
                $result=0;
            }


            }
            
        echo json_encode(array('changedone'=>$result));
        


        }

        function check_mail()
    {

        $email=$this->input->post('email');

        $email_check=$this->common->select($table_name = 'tbl_user', $field = array(), $where = array('login_email'=>$email,'user_type_id'=>'3'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
        //$email_check = $this->common_model->email_check($email);
         if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
         {
                   if(count($email_check) > 0)
                {
                    $result['status']=3;
                    echo json_encode(array('changedone'=>$result));
                    
                }
                else
                {
                    $result['status']=1;
                    echo json_encode(array('changedone'=>$result));
                }

         } 
         else 
         {

            $result['status']=2;
            echo json_encode(array('changedone'=>$result));
            
         }

        
        

    }

    function show_doc_detail()
    {

        $usr_id=$this->uri->segment(3);

         $data['chamber_list'] =  $this->common->select($table_name='tbl_chamber',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

        $data['user_doc'] =  $this->common->select($table_name='tbl_user',$field=array(), $where=array('user_id'=>$usr_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

        $data['doc'] =  $this->common->select($table_name='tbl_doctor',$field=array(), $where=array('user_id'=>$usr_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

         $data['doc_chamber'] =  $this->common->select($table_name='tbl_doctor_chamber',$field=array(), $where=array('doctor_id'=>@$data['doc'][0]->doctor_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

         $data['doc_id']=@$data['doc'][0]->doctor_id;


        $data['active']="manage_doc";
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('doctor_detail_view',$data);
        $this->load->view('common/footer');
    }

    function edit_doctor()
    {

        $usr_id=$this->uri->segment(3);

         $data['chamber_list'] =  $this->common->select($table_name='tbl_chamber',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

        $data['user_doc'] =  $this->common->select($table_name='tbl_user',$field=array(), $where=array('user_id'=>$usr_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

        $data['doc'] =  $this->common->select($table_name='tbl_doctor',$field=array(), $where=array('user_id'=>$usr_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

         $data['doc_chamber'] =  $this->common->select($table_name='tbl_doctor_chamber',$field=array(), $where=array('doctor_id'=>@$data['doc'][0]->doctor_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

         $data['doc_id']=@$data['doc'][0]->doctor_id;


        $data['active']="manage_doc";
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('doctor_edit_view',$data);
        $this->load->view('common/footer');
    }

    function doctor_edit_action()
    {

        $user_id=$this->input->post('doc_user_id');

        $doctor_id=$this->input->post('doc_id');

        $first_name=$this->input->post('first_name');

        $last_name=$this->input->post('last_name');

        $email=$this->input->post('email');

        $password=$this->input->post('pass');

        $mobile=$this->input->post('mobile');

        $age=$this->input->post('age');

        $gen=$this->input->post('gen');

        $weight=$this->input->post('weight');

        $height=$this->input->post('height');

        $exp=$this->input->post('exp');

        $reg_no=$this->input->post('reg_no');

        $start=$this->input->post('start');

        $start1 = date('Y-m-d',strtotime($start));

        $chamber=$this->input->post('chamber');

        $fees=$this->input->post('fees');

        //$unique_id=date('mY').rand(000,999);

        $edited_date=date('Y-m-d');

        $edited_by=$this->session->userdata('hs_admin_id');


        $data_user=array(

                                'first_name'=>$first_name,
                                'last_name'=>$last_name,
                                'login_email'=>$email,
                                'mobile'=>$mobile,
                                'login_pass'=>$password,
                                //'user_unique_id'=>$unique_id,
                                'age'=>$age,
                                'weight'=>$weight,
                                'height'=>$height,
                                'gender'=>$gen,
                                'modified_by'=>$edited_by,
                                'modified_on'=>$edited_date,
                                'user_type_id'=>3

                        );

        $this->db->where('user_id',$user_id);
        $this->db->update('tbl_user', $data_user);

          $data_doc=array(

                            'user_id'=>$user_id,
                            'exp_desc'=>$exp,
                            'reg_no'=>$reg_no,
                            'modified_by'=>$edited_by,
                            'modified_on'=>$edited_date,
                            'start_year'=>$start1
                        );

        $this->db->where('user_id',$user_id);
        $this->db->update('tbl_doctor', $data_doc);

          $data['doctor_chamber']=$this->admin_model->selectOne('tbl_doctor_chamber','doctor_id',$doctor_id);
      
         if(count(@$data['doctor_chamber'])>0)
         {
          
                  $this->db->where('doctor_id',$doctor_id);
                  $this->db->delete('tbl_doctor_chamber');

      

         for($i=0;$i<count($chamber) && $i<count($fees);$i++)
         {
                

                $data_doc_chamber=array(

                                            'doctor_id'=>$doctor_id,
                                            'chamber_id'=>$chamber[$i],
                                            'fees'=>$fees[$i]
                                        );

                 $this->db->insert('tbl_doctor_chamber',$data_doc_chamber);

         }
     }

     else
     {
             for($i=0;$i<count($chamber) && $i<count($fees);$i++)
         {
                

                $data_doc_chamber=array(

                                            'doctor_id'=>$doctor_id,
                                            'chamber_id'=>$chamber[$i],
                                            'fees'=>$fees[$i]
                                        );

                 $this->db->insert('tbl_doctor_chamber',$data_doc_chamber);

         }

     }

        $this->session->set_flashdata('flash_msg','Data Successfully Updated.');
        redirect('admin_user','refresh');
    }

    function delete_doctor()
    {
             $usr_id=$this->uri->segment(3);

              $data['doc'] =  $this->common->select($table_name='tbl_doctor',$field=array(), $where=array('user_id'=>$usr_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

       

            $doc_id=@$data['doc'][0]->doctor_id;

                  $this->db->where('user_id',$usr_id);
                  $this->db->delete('tbl_user');

                   $this->db->where('user_id',$usr_id);
                   $this->db->delete('tbl_doctor');


                  $this->db->where('doctor_id',$doc_id);
                  $this->db->delete('tbl_doctor_chamber');


                   $this->session->set_flashdata('flash_msg','Data Successfully Deleted.');
                  redirect('admin_user','refresh');




    }
   

         function edu_file_box_show()
    {

        $chamber_list=  $this->common->select($table_name='tbl_chamber',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            $id=$this->input->post('num');

            $next=$id+1;
 


            ?>


  
                         
           
                                  
                                <div id="vital_info" >
                                   
                                        
                                       
                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Chamber Name<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                               <select  class="form-control select" name="chamber[]" id="chamber"  required="">
                                                    <option value="">--Select Chamber--</option>
                      
                                                     <?php
                                                       foreach($chamber_list as $row){

                                                        ?>

                                                   <option value="<?php echo $row->chamber_id; ?>" ><?php echo $row->chamber_name; ?></option>
                                                  <?php
                                                    }
                                                  ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div><div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label">Fees(Rs.)<span style="color:red">*</span></label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" required="" name="fees[]" id="fees" style="margin-bottom:12px" placeholder="Fees">
                                            </div>
                                        </div>

                                        <table>
                                            <tr>
                                                <td>
                                                     <?php if($next!=10){ ?> <a href="javacript:void(0)"  id="edu_no_<?php echo $next; ?>" onclick="edu_produce_file_box('<?php echo $next; ?>')" class="btn btn-primary"><b>Add More</b></a><?php }?>
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

                                            
                                </div>


        <?php
      }


      /////////////////////////////////////////////////////////////////////////PATIENT///////////////////////////////////////////////////////////////////////

        function edu_file_box_show1()
    {

      

            $id=$this->input->post('num');

            $next=$id+1;
 


            ?>


  
                         
           
                                  
                                <div id="vital_info" >
                                   
                                        
                                       
                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="product_name" class="col-sm-2 control-label"></label>
                                            <div class="col-sm-8">
                                               <textarea class="form-control" rows="10" cols="10" type="text" name="write[]" id="write"  placeholder="Write Report"></textarea>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div><div class="clearfix"></div>

                                        <div class="form-group">
                                           <!--  <label for="product_name" class="col-sm-2 control-label">Fees(Rs.)</label> -->
                                            <div class="col-sm-8">
                                               <input type="date" name="date[]" class="form-control">
                                            </div>
                                        </div>

                                        <table>
                                            <tr>
                                                <td>
                                                     <?php if($next!=10){ ?> <a href="javacript:void(0)"  id="edu_no1_<?php echo $next; ?>" onclick="edu_produce_file_box1('<?php echo $next; ?>')" class="btn btn-primary"><b>Add More</b></a><?php }?>
                                                </td>
                                                <td>
                                                    <a href="javacript:void(0)" class="btn btn-primary" id="minus1" onclick="edu_hiding_out1('<?php echo $next; ?>');"><b>-</b></a></td>
                                                </td>
                                            </tr>
                                        </table>             

                                       

                                       

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


        <?php
      }


      function patient_view()
      {

        $data['active']="manage_patient";

         $data['patient_list'] =  $this->common->select($table_name='tbl_user',$field=array(), $where=array('user_type_id'=>2), $where_or=array(),$like=array(),$like_or=array(),$order=array('user_id'=>'DESC'),$start='',$end='');
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('patient_list_view',$data);
        $this->load->view('common/footer');

      }

       function patient_view_today()
      {

        $data['active']="manage_patient";

         $data['patient_list'] =  $this->common->select($table_name='tbl_user',$field=array(), $where=array('user_type_id'=>2,'created_on'=>date('Y-m-d')), $where_or=array('modified_on'=>date('Y-m-d')),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
       
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('patient_list_view_today',$data);
        $this->load->view('common/footer');

      }

      function edit_patient_prescription()
      {

         $data['active']="manage_prescription";

         $user_id=$this->uri->segment(3);

         $chk_history_id=$this->uri->segment(4);

         $data['chk_history_id']=$chk_history_id;

          $data['user_id']=$user_id;

            $data['user_weight'] =  $this->common->select($table_name='tbl_user',$field=array(), $where=array('user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

         $data['patient_chk'] =  $this->common->select($table_name='tbl_patient_check_up_history',$field=array(), $where=array('chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

          $data['patient_cc'] =  $this->common->select($table_name='tbl_patient_cc',$field=array(), $where=array('user_id'=>$user_id,'chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

         $data['patient_kpo'] =  $this->common->select($table_name='tbl_patient_kpo',$field=array(), $where=array('user_id'=>$user_id,'chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

         $data['patient_ho'] =  $this->common->select($table_name='tbl_patient_ho',$field=array(), $where=array('user_id'=>$user_id,'chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end=''); 


          $data['patient_gen_exam'] =  $this->common->select($table_name='tbl_patient_gen_exam',$field=array(), $where=array('user_id'=>$user_id,'chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

        $data['patient_chest'] =  $this->common->select($table_name='tbl_patient_chest',$field=array(), $where=array('user_id'=>$user_id,'chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end=''); 


         $data['patient_heart'] =  $this->common->select($table_name='tbl_patient_heart',$field=array(), $where=array('user_id'=>$user_id,'chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end=''); 

        $data['patient_abd'] =  $this->common->select($table_name='tbl_patient_abd',$field=array(), $where=array('user_id'=>$user_id,'chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');  

         $data['patient_cns'] =  $this->common->select($table_name='tbl_patient_cns',$field=array(), $where=array('user_id'=>$user_id,'chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');  

          $data['patient_report'] =  $this->common->select($table_name='tbl_patient_report',$field=array(), $where=array('user_id'=>$user_id,'chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

           $data['patient_inves'] =  $this->common->select($table_name='tbl_patient_investigation',$field=array(), $where=array('user_id'=>$user_id,'chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            $data['patient_diag'] =  $this->common->select($table_name='tbl_patient_diagnosis',$field=array(), $where=array('user_id'=>$user_id,'chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

              $data['patient_diet'] =  $this->common->select($table_name='tbl_patient_diet',$field=array(), $where=array('user_id'=>$user_id,'chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

                 $data['patient_counc'] =  $this->common->select($table_name='tbl_patient_councelling',$field=array(), $where=array('user_id'=>$user_id,'chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

                  $data['gyno'] =  $this->common->select($table_name='tbl_gyno_patient',$field=array(), $where=array('user_id'=>$user_id,'chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

                   $data['gyno_weight'] =  $this->common->select($table_name='tbl_gyno_weight',$field=array(), $where=array('user_id'=>$user_id,'chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

                                                        
                                                        
                 // $data['my_med_without_group'] =  $this->common->select($table_name='tbl_patient_medicine',$field=array(), $where=array('user_id'=>$user_id,'chk_history_id'=>$chk_history_id,'group_id'=>"Null"), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

                    $data['patient_report_counter'] =  $this->common->select($table_name='tbl_patient_report',$field=array(), $where=array('user_id'=>$user_id,'chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');



                  //echo "<pre>";print_r($data['my_med']);exit;

                 $this->db->select('*');
                 $this->db->from('tbl_patient_medicine');
                 $this->db->where('user_id',$user_id);
                 $this->db->where('chk_history_id',$chk_history_id);
                 $this->db->where('group_id',"0");
               
                 $qry=$this->db->get();
                 $data['my_med_without_group']=$qry->result();

                 //echo "<pre>";print_r($data['my_med_without_group']);exit;


                 $this->db->select('*');
                 $this->db->from('tbl_patient_medicine');
                 $this->db->where('user_id',$user_id);
                 $this->db->where('chk_history_id',$chk_history_id);
                 $this->db->where('group_id !=',"0");
                 $this->db->group_by('group_id');
                 $qry=$this->db->get();
                 $data['patient_med']=$qry->result();

                //echo "<pre>";print_r($data['patient_med']);exit;
                 //$md=array();
                                    /*foreach($data['patient_med'] as $row1)
                                               {
                                                  array_push($md, $row1->medicine_id);

                                               }

                                               print_r($md);exit;*/


                 $this->db->select('*');
                 $this->db->from('tbl_patient_medicine');
                 $this->db->where('user_id',$user_id);
                 $this->db->where('chk_history_id',$chk_history_id);

                
                 $qry=$this->db->get();
                 $data['patient_med1']=$qry->result();

                 $med_id=array();

                 foreach($data['patient_med1'] as $row1)
                 {

                        array_push($med_id,$row1->medicine_id);
                 }

                 //print_r($med_id);exit;

                 $data['med_id1']=$med_id;

//echo "<pre>";print_r($data['patient_med']);exit;

                  // $data['patient_med'] =  $this->common->select($table_name='tbl_patient_medicine',$field=array(), $where=array('user_id'=>$user_id,'chk_history_id'=>$chk_history_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
   
   
   
 


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          $data['name'] =  $this->common->select($table_name='tbl_user',$field=array(), $where=array('user_id'=>$user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

          $data['med_list'] =  $this->common->select($table_name='tbl_medicine',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

           $data['group'] =  $this->common->select($table_name='tbl_group',$field=array(), $where=array('status'=>'active'), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');


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
        $this->load->view('edit_prescription_view',$data);
        $this->load->view('common/footer');
      }

      function prescription_edit()
      {

        $chk_history_id=$this->input->post('hidden_chk_history_id');
        $user_id1=$this->input->post('hidden_user_id');



        $cc=$this->input->post('cc');
        $kpo=$this->input->post('kpo');
        $ho=$this->input->post('ho');
        $gen=$this->input->post('gen');
        $pulse=$this->input->post('pulse');
        $upper_bp=$this->input->post('upper');
        $lower_bp=$this->input->post('lower');
        $chest=$this->input->post('chest');
        $abd=$this->input->post('abd');
        $cns=$this->input->post('cns');
        //$medicine=$this->input->post('medicine');
        $group=$this->input->post('group');
        $dose=$this->input->post('dose');

        //echo "<pre>";print_r($dose);exit;
        $investigation=$this->input->post('investigation');
        $diet=$this->input->post('diet');
        $councilling=$this->input->post('councilling');
        $diagnosis=$this->input->post('diagnosis');
        $review=$this->input->post('review');
        $cc_new=$this->input->post('cc_new');

        $write=$this->input->post('write');
        $date=$this->input->post('date');

         $pulse_type=$this->input->post('pulse_type');



        $cc_new=$this->input->post('cc_new');
        $days_x=$this->input->post('days_x');
        $ho_new=$this->input->post('ho_new'); //array
        $ho_new_days=$this->input->post('ho_new_days'); //array
        @$gen_new=$this->input->post('gen_new');
        @$gen_new= explode(',',$gen_new);
        @$chest_new=$this->input->post('chest_new');
        @$chest_new= explode(',',$chest_new);
        @$abd_new=$this->input->post('abd_new');
        @@$abd_new= explode(',',$abd_new);
        @$cns_new=$this->input->post('cns_new');
        @$cns_new= explode(',',$cns_new);
        @$heart_new=$this->input->post('heart_new');
        @$heart_new= explode(',',$heart_new);
        $user_id=$this->session->userdata('hs_admin_id');

         $diet_name=$this->input->post('diet_name');
         @$diet_name= explode(',',$diet_name);
       
         @$councilling_name=$this->input->post('councilling_name');
         @$councilling_name= explode(',',$councilling_name);

         $investigation_name=$this->input->post('investigation_name');
         $investigation_name= explode(',',$investigation_name);

         $diagnosis_name=$this->input->post('diagnosis_name');
         $diagnosis_name= explode(',',$diagnosis_name);
     $my_medicine=$this->input->post('my_medicine');


     $my_new_med_day=$this->input->post('my_new_med_day');
$my_new_med=$this->input->post('my_new_med');

      $feedback=$this->input->post('feedback');



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

                                'user_id'=>$user_id1,
                                'pulse'=>$pulse,
                                'bp_upper'=>$upper_bp,
                                'bp_lower'=>$lower_bp,
                                'check_next_date'=>$review,
                                'created_date'=>date('Y-m-d'),
                                'feedback'=>$feedback_days,
                                'pulse_type'=>$pulse_type,
                                'created_by'=>$user_id
                             );

        $this->db->where('chk_history_id',$chk_history_id);

        $this->db->update('tbl_patient_check_up_history',$data_gen_info);

        $data_pulse=array('pulse'=>$pulse,'bp_upper'=>$upper_bp,'bp_lower'=>$lower_bp);

        $this->db->where('user_id',$user_id1);
        $this->db->update('tbl_user',$data_pulse);


         $EDDV=$this->input->post('date8');
        $LNPV=$this->input->post('date7');
        $gyno_weight=$this->input->post('gyno_weight');

        $data_gyno=array(

              
                'user_id'=>$user_id1,
                'eddv_date'=>$EDDV,
                'lnpv_date'=>$LNPV,
               
                'date'=>date('Y-m-d')
          );
        $this->db->where('chk_history_id',$chk_history_id);
        $this->db->update('tbl_gyno_patient',$data_gyno);


        $data_gyno_weight=array(

                                'user_id'=>$user_id1,
                                'chk_history_id'=>$chk_history_id,
                                'date'=>date('Y-m-d'),
                                'weight'=>$gyno_weight
                            );

        $this->db->insert('tbl_gyno_weight',$data_gyno_weight);



        $chk_up_history_id=$chk_history_id;

        $patient=$user_id1;


                    $this->db->where('chk_history_id',$chk_up_history_id);
                    $this->db->where('user_id',$patient);
                    $this->db->where('group_id',"0");
                    $this->db->delete('tbl_patient_medicine');


                     if(count($my_medicine)>0)
                        {

                          for($i=0;$i<count($my_medicine);$i++)
                          {


                             if($dose[$i] != "0")
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


                    $this->db->where('chk_history_id',$chk_up_history_id);
                    $this->db->where('user_id',$patient);
                    $this->db->delete('tbl_patient_cc');
$dose_cc=$this->input->post('dose_cc');

        for($i=0;$i<count($cc);$i++)
        {


          $data_cc=array(
                          'chk_history_id'=>$chk_up_history_id,
                          'user_id'=>$patient,
                          'cc_id'=>$cc[$i],
                           'day_id'=>$dose_cc[$i],
                          'created_date'=>date('Y-m-d'),
                          'created_by'=>$patient
                         );

          if($cc[$i] != "")
          {
              $this->db->insert('tbl_patient_cc',$data_cc);

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


        $heart=$this->input->post('heart');
$heart_new=$this->input->post('heart_new');
$heart_new= explode(',',$heart_new);

                   $this->db->where('chk_history_id',$chk_up_history_id);
                    $this->db->where('user_id',$patient);
                    $this->db->delete('tbl_patient_heart');
        
              for($l=0;$l<count($heart);$l++)
              {

                $data_heart_exam=array(
                                'chk_history_id'=>$chk_up_history_id,
                                'user_id'=>$patient,
                                'heart_exam_id'=>$heart[$l],
                                'created_date'=>date('Y-m-d'),
                                'created_by'=>$user_id
                               );

                if($heart[$l] != "")
                                 {

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


            $this->db->where('chk_history_id',$chk_up_history_id);
                    $this->db->where('user_id',$patient);
                    $this->db->delete('tbl_patient_ho');

                    $dose_ho=$this->input->post('dose_ho');
        //insert ho


             for($i=0;$i<count($ho);$i++)
        {



              

          $data_ho=array(
                          'chk_history_id'=>$chk_up_history_id,
                          'user_id'=>$patient,
                          'ho_id'=>$ho[$i],
                            'day_id'=>$dose_ho[$i],
                          'created_date'=>date('Y-m-d'),
                          'created_by'=>$patient
                         );

                        if($ho[$i] != "")
                                 {

                                   $this->db->insert('tbl_patient_ho',$data_ho);
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
         $this->db->where('chk_history_id',$chk_up_history_id);
                    $this->db->where('user_id',$patient);
                    $this->db->delete('tbl_patient_kpo');
        //end oh ho insert
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

 //insert general
         $this->db->where('chk_history_id',$chk_up_history_id);
                    $this->db->where('user_id',$patient);
                    $this->db->delete('tbl_patient_gen_exam');
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
          $this->db->where('chk_history_id',$chk_up_history_id);
                    $this->db->where('user_id',$patient);
                    $this->db->delete('tbl_patient_chest');

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
         $this->db->where('chk_history_id',$chk_up_history_id);
                    $this->db->where('user_id',$patient);
                    $this->db->delete('tbl_patient_abd');

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
         $this->db->where('chk_history_id',$chk_up_history_id);
                    $this->db->where('user_id',$patient);
                    $this->db->delete('tbl_patient_cns');
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

                $this->db->insert('tbl_examination',$data_cns_master);

                if($cns_new[$i] !="")
                {

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
                   $this->db->where('chk_history_id',$chk_up_history_id);
                    $this->db->where('user_id',$patient);
                      $this->db->where('group_id !=','0');
                    $this->db->delete('tbl_patient_medicine');
                    //print_r($group);exit;

//echo "<pre>";print_r($group);exit;
         if(count($group)>0)
        {
            //echo print_r($group);exit;

        

         //print_r($group);exit;

             for($p=0;$p<count($group);$p++)
            {
              $md=$p+1;
              

              $medicine=$this->input->post('medicine'.$md);
              

/* $days =  $this->common->select($table_name='tbl_time',$field=array(), $where=array('id'=>@$dose[$p]), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');*/
              //echo count($medicine);
            if($group[$p] != "")
            {


                for($k=0;$k<count($medicine);$k++)
                {

                  $data_medicine=array(
                                  'chk_history_id'=>$chk_up_history_id,
                                  'user_id'=>$patient,
                                  'medicine_id'=>$medicine[$k],
                                 // 'dose'=>$days[0]->day,
                                  'group_id'=>$group[$p],
                                  'created_date'=>date('Y-m-d'),
                                  'created_by'=>$user_id
                                 );

                  $this->db->insert('tbl_patient_medicine',$data_medicine);
                }
              }
            }

          

      }

      $write_some=$this->input->post('write_some');
 $this->db->where('chk_history_id',$chk_up_history_id);
                    $this->db->where('user_id',$patient);
                    $this->db->delete('tbl_patient_report');


        for($p=0;$p<count($write);$p++)
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
            if($write[$p] != "")
            {
               $this->db->insert('tbl_patient_report',$data_medicine);
            }
         
        }

 $new_report=$this->input->post('new_report');
 $new_report_write=$this->input->post('new_report_write');
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








         $this->db->where('chk_history_id',$chk_up_history_id);
                    $this->db->where('user_id',$patient);
                    $this->db->delete('tbl_patient_investigation');


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
        //end oh ho insert

                 $this->db->where('chk_history_id',$chk_up_history_id);
                    $this->db->where('user_id',$patient);
                    $this->db->delete('tbl_patient_diet');

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

   $this->db->where('chk_history_id',$chk_up_history_id);
                    $this->db->where('user_id',$patient);
                    $this->db->delete('tbl_patient_councelling');
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
  $this->db->where('chk_history_id',$chk_up_history_id);
                    $this->db->where('user_id',$patient);
                    $this->db->delete('tbl_patient_diagnosis');

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
    $invoice_no="OPD".rand('000','999').$chk_up_history_id.$user_id1;
  
   
         $prescription=  $this->common->get_prescription_details($chk_up_history_id,$user_id1);

        //echo "<pre>"; print_r($prescription);exit;
   
    $mail_data= array(
                        'prescription'=>$prescription,
                        'chk_history_id'=>$chk_up_history_id,
                        'user_id'=>$user_id1
                      
                    
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


          //$this->session->set_flashdata('flash_msg','Data Successfully Submitted.');
          //redirect('admin_prescription','refresh');        
      }

      function show_patient_detail()
    {

        $usr_id=$this->uri->segment(3);

        

        $data['user_patient'] =  $this->common->select($table_name='tbl_user',$field=array(), $where=array('user_id'=>$usr_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

       


        $data['active']="manage_patient";
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('patient_detail_view',$data);
        $this->load->view('common/footer');
    }

      function add_patient()
      {

        $data['active']="manage_patient";
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('patient_add_view',$data);
        $this->load->view('common/footer');

      }

      function patient_add_action()
      {

        $first_name=$this->input->post('first_name');

        $bmi=$this->input->post('bmi');

        //$last_name=$this->input->post('last_name');

        $city=$this->input->post('city');

         $payment=$this->input->post('payment');

      

        //$password=$this->input->post('pass');

        $mobile=$this->input->post('mobile');

        $age=$this->input->post('age');

        $gen=$this->input->post('gen');

        $weight=$this->input->post('weight');

        $height=$this->input->post('height');

        $prefix=$this->input->post('prefix');

        if($prefix=="Ms." || $prefix=="Mrs." || $prefix=="Baby")
        {
            $gen="female";

        }
        else
        {

           $gen="male";
        }

      
        $pulse=$this->input->post('pulse');
        $upper_bp=$this->input->post('upper');
        $lower_bp=$this->input->post('lower');
       

        $unique_id=date('mY').rand(000,999);

        $created_date=date('Y-m-d');

        $created_by=$this->session->userdata('hs_admin_id');


        $data_user=array(

                                'first_name'=>$first_name,
                                 'prefix'=>$prefix,
                                'city'=>$city,
                                'user_unique_id'=>$unique_id,
                                'pulse'=>$pulse,
                                'bp_upper'=>$upper_bp,
                                'bp_lower'=>$lower_bp,
                                'mobile'=>$mobile,
                                'bmi'=>$bmi,
                                'user_unique_id'=>$unique_id,
                                'age'=>$age,
                                'weight'=>$weight,
                                'height'=>$height,
                                'gender'=>$gen,
                                'created_by'=>$created_by,
                                'created_on'=>$created_date,
                                'payment'=>$payment,
                                'visit'=>1,
                                'user_type_id'=>2

                        );

        $this->db->insert('tbl_user',$data_user);

         $this->session->set_flashdata('flash_msg','Data Successfully Submited.');
         redirect('admin_user/patient_view','refresh');


      }

      function edit_patient()
      {
             $usr_id=$this->uri->segment(3);

      
        $data['user_patient'] =  $this->common->select($table_name='tbl_user',$field=array(), $where=array('user_id'=>$usr_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

      


        $data['active']="manage_patient";
        $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
        $this->load->view('patient_edit_view',$data);
        $this->load->view('common/footer');

      }

      function patient_edit_action()
      {

        $patient_user_id=$this->input->post('patient_user_id');

        $first_name=$this->input->post('first_name');

        //$last_name=$this->input->post('last_name');

        $city=$this->input->post('city');

        $bmi=$this->input->post('bmi');
       $payment=$this->input->post('payment');

        $mobile=$this->input->post('mobile');

        $age=$this->input->post('age');

        $gen=$this->input->post('gen');

         $prefix=$this->input->post('prefix');

        if($prefix=="Ms." || $prefix=="Mrs." || $prefix=="Baby")
        {
            $gen="female";

        }
        else
        {

           $gen="male";
        }

       
        $weight=$this->input->post('weight');

        $height=$this->input->post('height');

         $pulse=$this->input->post('pulse');
        $upper_bp=$this->input->post('upper');
        $lower_bp=$this->input->post('lower');

      

       

      

      
        $edited_date=date('Y-m-d');

        $edited_by=$this->session->userdata('hs_admin_id');


        $data_user=array(

                                'first_name'=>$first_name,
                                'prefix'=>$prefix,
                                'city'=>$city,
                                'mobile'=>$mobile,
                                'pulse'=>$pulse,
                                'bp_upper'=>$upper_bp,
                                'bp_lower'=>$lower_bp,
                                'age'=>$age,
                                'bmi'=>$bmi,
                                'weight'=>$weight,
                                'height'=>$height,
                                'gender'=>$gen,
                                'modified_by'=>$edited_by,
                                'modified_on'=>$edited_date,
                                 'payment'=>$payment,
                                'user_type_id'=>2

                        );

        $this->db->where('user_id',$patient_user_id);
        $this->db->update('tbl_user', $data_user);

          $visit =  $this->common->select($table_name='tbl_user',$field=array(), $where=array('user_id'=>$patient_user_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

          $count=@$visit[0]->visit;

          if(count($visit)>0)
          {
            $count=$count+1;
            $data_array=array('visit'=>$count);
              $this->db->where('user_id',$patient_user_id);
             $this->db->update('tbl_user', $data_array);
          }

         $this->session->set_flashdata('flash_msg','Data Successfully Updated.');
         redirect('admin_user/patient_view','refresh');

      }


    function change_to_active_patient()
{
    
        $pro_ids=$this->input->post('pid');
        $status=$this->input->post('status');
        $data=array('status'=>$status);


        for($i=0;$i<count($pro_ids);$i++)
        {
            $id=$pro_ids[$i];
            $this->db->where('user_id',$id);

            if($this->db->update('tbl_user',$data))
            {
                $result=1;
            }
            else
            {
                $result=0;
            }


            }
            
        echo json_encode(array('changedone'=>$result));
        


        }

         function check_mail_patient()
    {

        $email=$this->input->post('email');

        $email_check=$this->common->select($table_name = 'tbl_user', $field = array(), $where = array('login_email'=>$email,'user_type_id'=>'2'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
        //$email_check = $this->common_model->email_check($email);
         if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
         {
                   if(count($email_check) > 0)
                {
                    $result['status']=3;
                    echo json_encode(array('changedone'=>$result));
                    
                }
                else
                {
                    $result['status']=1;
                    echo json_encode(array('changedone'=>$result));
                }

         } 
         else 
         {

            $result['status']=2;
            echo json_encode(array('changedone'=>$result));
            
         }

        
        

    }

    function delete_patient()
    {
                 $usr_id=$this->uri->segment(3);

             

                  $this->db->where('user_id',$usr_id);
                  $this->db->delete('tbl_user');

                

                   $this->session->set_flashdata('flash_msg','Data Successfully Deleted.');
                  redirect('admin_user/patient_view','refresh');


    }




}
?>