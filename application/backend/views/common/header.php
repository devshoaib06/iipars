
<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | iipars</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>../fav.png"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/skins/skin-blue.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datepicker/datepicker3.css">

    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/select2/select2.min.css">

    <script src="<?php echo base_url()?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

    <script src="<?php echo base_url()?>assets/parsley.min.js"></script>
     <script src="<?php echo base_url()?>custom_css/form_validation.css"></script>
    <style>
    .glowing-border-red{
        outline: none;
        border-color: #ff3333;
        box-shadow: 0 0 10px #ff3333;
    }
    .glowing-border-green{
        outline: none;
        border-color: #4dff4d;
        box-shadow: 0 0 10px #4dff4d;
    }
    </style>


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<header class="main-header">

    <!-- Logo -->
    <a href="" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">iipars</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">iipars</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

 
               
                <li class="dropdown user user-menu">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                       <!-- <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->

                        <span class="hidden-xs"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i> Welcome! <?php echo $this->session->userdata('hs_admin_name'); ?>


                        </span>
                    </a>
                    <ul class="dropdown-menu">



                        <span class="hidden-xs">
              <?php if($this->session->userdata('hs_admin_id'))
              {
                  $user_id= $this->session->userdata('hs_admin_id');
                  //echo $user_id;
                  $user_details=$this->admin_model->selectone('tbl_user','user_id',$user_id);
                  // echo $user_details[0]->first_name;
             } ?></span>
                        <li class="user-body">
                            <div class="row">
                                 <div class="text-center">
                              <a href="<?php echo base_url();?>index.php/profile/profile_view/<?php echo $user_id; ?>" class="col-md-12 btn btn-default">Profile</a>
                             </div>
                                  <div class="text-center">
                                    <a href="javascript:void(0)" onclick="email_modal()" class="col-md-12 btn btn-default">Email Settings</a>
                                </div>
                                <div class="text-center">
                                    <a href="<?php echo base_url()?>index.php/admin_panel/password" class="col-md-12 btn btn-default">Change Password</a>
                                </div>  
                                <div class="text-center" style="margin-top:15px">
                                    <a href="<?php echo base_url()?>index.php/admin_login/logout" class="col-md-12 btn btn-default" >Log out</a>
                                </div>
                               
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <!--<li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>-->
            </ul>
        </div>
    </nav>
</header>



<div class="bg-danger text-center"><span><?php echo $this->session->flashdata('message'); ?></span></div> 
<div id="myEmailModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal-title">Email</h4>
      </div>
      <?php
        $data=$this->admin_model->selectOne('tbl_email','email_id','1');
      ?>
       <form method="post" id="email_data" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="form-group">
                  <label class="form-label">Receive Email</label>
                    <div class="controls" id="cation_control">
                      <input type="text" class="form-control" name="receive_email" id="receive_email" onkeyup="remove_border()" value="<?php echo $data[0]->recieve_email; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="form-label">From Email</label>
                    <div class="controls" id="video_control">
                     <input type="text" class="form-control" name="from_email" id="from_email" onkeyup="remove_border()" value="<?php echo $data[0]->from_email; ?>">
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-primary" onclick = "send_email_data()">Submit</button>
              </div>
        </form>
    </div>    
  </div>
</div> 

<style>
    .glowing-border-red{
        outline: none;
        border-color: #ff3333;
        /*box-shadow: 0 0 10px #ff3333;*/
    }

</style>



<script>
  function email_modal()
  {
      $("#myEmailModal").modal('show');
       
  }
</script> 
<script>
    function send_email_data()
    {
    //print_r('1');
      var count=0;
      var receive_email= $("#receive_email").val();
      var from_email= $("#from_email").val();

      if(receive_email=="")
      {
           $("#receive_email").addClass("glowing-border-red");
            count++;
      }
      else
      {
            var atpos = receive_email.indexOf("@");
            var dotpos = receive_email.lastIndexOf(".");
            if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= receive_email.length)
            {
                $("#receive_email").addClass("glowing-border-red");
                 count++;
            }
            else
            {
                $("#receive_email").removeClass("glowing-border-red");
            }
      }

        if(from_email=="")
        {
           $("#from_email").addClass("glowing-border-red");
            count++;
        }
        else
        {
            var atpos = from_email.indexOf("@");
            var dotpos = from_email.lastIndexOf(".");
            if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= from_email.length)
            {
                $("#from_email").addClass("glowing-border-red");
                 count++;
            }
            else
            {
                $("#from_email").removeClass("glowing-border-red");
            }
        }

        if(receive_email!="" && from_email!="")
        {
            //alert();
             var data = new FormData($('#email_data')[0]);
        
              $.ajax({
                  type:"POST",
                  //dataType:'html',
                  url:"<?php echo base_url()?>index.php/admin_login/email_sent",
                  data:data,
                  mimeType: "multipart/form-data",
                  contentType: false,
                  cache: false,
                  processData: false,

                  success:function(data)
                  {
                        $("#myEmailModal .close").click();
                  }
              });

              //document.getElementById("receive_email").value="";
              //document.getElementById("from_email").value="";
        }

      if(count>0)
      {
        return false;
      }
        
    }      
</script>

<script>
    function remove_border()
    {
      var receive_email= $("#receive_email").val();
      var from_email= $("#from_email").val();

        if(receive_email!="")
        {
           $("#receive_email").removeClass("glowing-border-red");
        }

        if(from_email!="")
        {
           $("#from_email").removeClass("glowing-border-red");
        }

    }
</script>
