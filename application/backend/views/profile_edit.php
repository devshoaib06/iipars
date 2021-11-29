
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        ADMIN/PROFILE EDIT
        
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">PROFILE EDIT
              <span style="padding-right: 40px;"></span>
               <small style="color:green">
                <?php
            $succ_update=$this->session->flashdata('succ_update');
            if($succ_update){
              echo $succ_update;
                } ?>
            
              </small>
              </h3>
                <div id="validation" style="color:red;"></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="<?php echo base_url();?>index.php/profile/profile_update" method="post" id="profileedit_form_validation" >
              <div class="box-body">
              <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">First Name</label>

                  <div class="col-sm-8">
                    <input type="text" name="f_name" id="f_name"class="form-control" id="inputName" placeholder="Name" value="<?php echo $profile[0]->first_name; ?>">
                     <span id="error_name" style="color:red"></span>
                  </div>
                 
                </div>
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Last Name</label>

                  <div class="col-sm-8">
                    <input type="text" name="lst_name" id="lst_name"class="form-control" id="inputName" placeholder="Name" value="<?php echo $profile[0]->last_name; ?>">
                     <span id="error_name" style="color:red"></span>
                  </div>
                 
                </div>
                <!-- <div class="form-group">
                  <label for="inputUsername" class="col-sm-2 control-label">Username</label>

                  <div class="col-sm-10">
                    <input type="text" name="username" class="form-control" id="inputUsername" placeholder="Username"  value="<?php echo $profile[0]->username; ?>">
                    <span id="error_uname" style="color:red"></span>
                  </div>
                  
                </div> -->
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-8">
                    <input type="email" name="email" id="email" class="form-control" id="inputEmail3" placeholder="Email"  value="<?php echo $profile[0]->login_email; ?>">
                    <span id="error_email" style="color:red"></span>
                  </div>
                  
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Mobile</label>

                  <div class="col-sm-8">
                    <input type="text" name="phone" id="phone" class="form-control" id="inputEmail3" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="11" placeholder="Contact Number"  value="<?php echo $profile[0]->mobile; ?>">
                    <span id="error_email" style="color:red"></span>
                  </div>
                  
                </div>
                
                
              </div>
              <input type="hidden" name="user_id" value="<?php echo $profile[0]->user_id; ?>">
              <div id="error"></div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url();?>" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-info pull-right" onclick="return exequete_profileedit_form_validation()">Update</button>
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
 
<script src="<?php echo base_url();?>custom_script/validation_rulse.js"></script>
<script>
  function validation()
  {
    var f_name = $('#f_name').val();
      if (!isNull(f_name)) {
        $('#f_name').removeClass('black_border').addClass('red_border');
      } else {
        $('#f_name').removeClass('red_border').addClass('black_border');
      }

      var lst_name = $('#lst_name').val();
      if (!isNull(lst_name)) {
        $('#lst_name').removeClass('black_border').addClass('red_border');
      } else {
        $('#lst_name').removeClass('red_border').addClass('black_border');
      }

      var email = $('#email').val();
      if (!isNull(email)) {
        $('#email').removeClass('black_border').addClass('red_border');
      } else {
        $('#email').removeClass('red_border').addClass('black_border');
      }
  }
  function exequete_profileedit_form_validation()
  {
  
   
    $('#profileedit_form_validation').attr('onchange', 'validation()');
    $('#profileedit_form_validation').attr('onkeyup', 'validation()');

     validation();
    //alert($('#contact_form .red_border').size());

    if ($('#profileedit_form_validation .red_border').size() > 0)
    {
      $('#profileedit_form_validation .red_border:first').focus();
      $('#profileedit_form_validation .alert-error').show();
      return false;
    } else {

      $('#profileedit_form_validation').submit();
    }

  }

  </script>

            