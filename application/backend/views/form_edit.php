

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Service Data
        
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
       <?php if($this->session->flashdata('message')) { ?> 
        <table class="table table-striped table-bordered bootstrap-datatable ">
          <tr>
            <td width="100%" colspan="2" style=" text-align:center"><span style="color:#F00"><?php echo $this->session->flashdata('message'); ?></span></td>
          </tr>
        </table>
         <?php } ?>
      <div class="row">
        <!-- left column -->
        
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Service Data Edit</h3>
            <div id="validation" style="color:red;"></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url();?>index.php/Admin_datalist/edit_form_action" method="post" id="examination_add"  onsubmit="return log_val()" >
              <div class="box-body">
              
             

              
               
               <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Service Provider</label>

                  <div class="col-sm-10">
                    <select class="form-control" id="university_type" name="university_type" required="" onchange="get_uni(this.value)">
                      <option value="">--Select Service Provider--</option>
                      <?php
                      foreach ($university_type as $row) { ?>
                         <option value="<?php echo $row->cc_id; ?>" <?php if(@$uni_type_id==$row->cc_id) { echo 'selected';} ?>><?php echo $row->cc_name; ?></option>
                      <?php } ?>

                    </select>
                  </div>
                 
              </div>

               <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Institute</label>

                  <div class="col-sm-10">
                    <select class="form-control" id="university" name="university" required="">
                     <option value="<?php echo @$form[0]->university_id; ?>" ><?php echo $uni_name; ?></option>

                    </select>
                  </div>
                 
              </div>


                <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Subject</label>

                  <div class="col-sm-10">
                    <select class="form-control" id="subject" name="subject" required="">
                    
                      <?php
                      foreach ($subject as $row) { ?>
                         <option value="<?php echo $row->kpo_id; ?>" <?php if(@$form[0]->subject_id==$row->kpo_id) { echo 'selected';} ?>> <?php echo $row->kpo_name; ?></option>
                      <?php } ?>

                    </select>
                  </div>
                 
              </div>



               <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Service Type</label>

                  <div class="col-sm-10">
                    <select class="form-control" id="service_type" name="service_type" required="" onchange="get_service(this.value)">
                      <option value="">--Select Service Type--</option>
                      <?php
                      foreach ($service_type as $row) { ?>
                         <option value="<?php echo $row->examination_type_id; ?>"  <?php if(@$service_type_id==$row->examination_type_id) { echo 'selected';} ?>><?php echo $row->examination_type; ?></option>
                      <?php } ?>

                    </select>
                  </div>
                 
              </div>

               <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Services</label>

                  <div class="col-sm-10">
                    <select class="form-control" id="services" name="services" required="">
                     <option value="<?php echo @$form[0]->service_id; ?>"><?php echo $service_name; ?></option>

                    </select>
                  </div>
                 
              </div>


               <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Country/State/City</label>

                  <div class="col-sm-10">
                   
                    <input type="text" name="state" id="state" value="<?php echo @$form[0]->state; ?>" required="" class="form-control">

                  
                  </div>
                 
              </div>


              <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Annouce Date</label>

                  <div class="col-sm-10">
                   
                    <input type="date" required="" name="announce_date" value="<?php echo @$form[0]->announce_date; ?>" id="announce_date" class="form-control">

                   
                  </div>
                 
              </div>

                <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Last Submission Date</label>

                  <div class="col-sm-10">
                   
                    <input type="date" required="" value="<?php echo @$form[0]->last_announce_date; ?>" name="last_date" id="last_date" class="form-control">

                   
                  </div>
                 
              </div>

              <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Title</label>

                  <div class="col-sm-10">
                   
                    <input type="text" required="" name="title" id="title" value="<?php echo @$form[0]->title; ?>" class="form-control">

                   
                  </div>
                 
              </div>

                <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Exam date</label>

                  <div class="col-sm-10">
                   
                    <input type="date" required="" name="exam_date" id="exam_date" value="<?php echo @$form[0]->exam_date; ?>" class="form-control">

                   
                  </div>
                 
              </div>

               <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Duration</label>

                  <div class="col-sm-10">
                   
                    <input type="text" required="" name="duration" id="duration" value="<?php echo @$form[0]->duration; ?>" class="form-control">

                   
                  </div>
                 
              </div>

                  <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Sponsored by</label>

                  <div class="col-sm-10">
                   
                    <input type="text" required="" name="sponsor_by" id="sponsor_by" value="<?php echo @$form[0]->sponsor_by; ?>" class="form-control">

                   
                  </div>
                 
              </div>

               <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">From Date</label>

                  <div class="col-sm-10">
                   
                    <input type="date" required="" name="from_date" id="from_date" value="<?php echo @$form[0]->from_date; ?>" class="form-control">

                   
                  </div>
                 
              </div>

                 <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">To Date</label>

                  <div class="col-sm-10">
                   
                    <input type="date" required="" name="to_date" id="to_date"  value="<?php echo @$form[0]->to_date; ?>" class="form-control">

                   
                  </div>
                 
              </div>

               <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Post</label>

                  <div class="col-sm-10">
                   
                    <input type="text" required="" name="post" id="post" value="<?php echo @$form[0]->for_post; ?>" class="form-control">

                   
                  </div>
                 
              </div>

                <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Amount</label>

                  <div class="col-sm-10">
                   
                    <input type="text" required="" name="amount" id="amount" value="<?php echo @$form[0]->amount; ?>" class="form-control">

                   
                  </div>
                 
              </div>

               <div class="form-group">
                  <label for="cat_name" class="col-sm-2 control-label">Web Link</label>

                  <div class="col-sm-10">
                   
                    <input type="text" required="" name="web_link" id="web_link"  value="<?php echo @$form[0]->web_link; ?>" class="form-control">

                   
                  </div>
                 
              </div>



               
      
<input type="hidden" name="hidden_id" value="<?php echo @$form[0]->form_id; ?>">
              
                
                
              </div>
             
             
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url();?>index.php/Admin_datalist/form_list" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Update</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->
          
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  </div>
 <script type="text/javascript" src="<?php echo base_url(); ?>custom_script/sub_admin_form_validation.js" ></script> 
<script src="<?php echo base_url();?>custom_script/validation_rulse.js"></script>
<script src="<?php echo base_url();?>custom_script/setting_validation.js"></script>


<script type="text/javascript">
  function get_uni(val)
  {
    var base_url = '<?php echo base_url(); ?>';
    
      $.ajax({
        type: "POST",
        url: base_url+'index.php/Admin_datalist/getuniversity',
        data:{id:val},
        success: function(data){
         // console.log(data);
          var unilist = JSON.parse(data);

         // alert(unilist.length);
         
                     var html_str = ' <option value="">Select University</option>';
            for(var i=0;i<unilist.length;i++){
              html_str+= '<option value="'+unilist[i]['university_id']+'">'+unilist[i]['university']+'</option>';
            }

            $("#university").html(html_str);
            $("#university").prop('hidden',false);
          

        }
      });
    
  }


  function get_service(val)
  {
    var base_url = '<?php echo base_url(); ?>';
    
      $.ajax({
        type: "POST",
        url: base_url+'index.php/Admin_datalist/getservice',
        data:{id:val},
        success: function(data){
         // console.log(data);
          var unilist = JSON.parse(data);

         // alert(unilist.length);
         
                     var html_str = ' <option value="">Select Service</option>';
            for(var i=0;i<unilist.length;i++){
              html_str+= '<option value="'+unilist[i]['examination_id']+'">'+unilist[i]['examination_name']+'</option>';
            }

            $("#services").html(html_str);
            $("#services").prop('hidden',false);
          

        }
      });
    
  }
</script>
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
   function add_role_validate()
{
  

        var examination = $('#examination').val();
        if (!isNull(examination)) 
        {
          $('#examination').removeClass('black_border').addClass('red_border');

           $("#examination").attr("data-toggle", "tooltip");
                $("#examination").attr("data-placement", "bottom");
                document.getElementById('examination').title = 'Service Name Is Required';
                $('#examination').tooltip('show');
        } 
        else 
        {
          $('#examination').removeClass('red_border').addClass('black_border');

           document.getElementById('examination').title = '';
                $('#examination').tooltip('destroy');
        }

        var examination_type = $('#examination_type').val();
        if (!isNull(examination_type)) 
        {
          $('#examination_type').removeClass('black_border').addClass('red_border');

            $("#examination_type").attr("data-toggle", "tooltip");
                $("#examination_type").attr("data-placement", "bottom");
                document.getElementById('examination_type').title = 'Service Type Is Required';
                $('#examination_type').tooltip('show');
        } 
        else 
        {
          $('#examination_type').removeClass('red_border').addClass('black_border');

          document.getElementById('examination_type').title = '';
                $('#examination_type').tooltip('destroy');
        }

}
 function subAdminAdd()
 {
    $('#examination_add').attr('onchange', 'add_role_validate()');
    $('#examination_add').attr('onkeyup', 'add_role_validate()');

     add_role_validate();
    //alert($('#contact_form .red_border').size());

    if ($('#examination_add .red_border').size() > 0)
    {
      $('#examination_add .red_border:first').focus();
      $('#examination_add .alert-error').show();
      return false;
    } else {

      $('#examination_add').submit();
    }

 }


 </script>








 
