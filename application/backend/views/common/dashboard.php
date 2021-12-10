<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
<?php 

  // echo "<pre>";
  // print_r($this->session->userdata);die;
?>
<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>Dashboard<small> Control panel</small></h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class="active">Dashboard</li>

    </ol>

  </section>

  <!-- Main content -->

  <section class="content">

    <!-- Small boxes (Stat box) -->

    <div class="row">

      <div class="col-lg-3 col-xs-6">



        <div class="small-box bg-aqua">

          <div class="inner">
            <?php
            $uni_type = $this->common->select($table_name = 'tbl_university', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


            ?>
            University -<h3> <?php echo count($uni_type); ?></h3>

          </div>

          <div class="icon">



          </div>

          <a href="<?php echo base_url(); ?>index.php/Admin_service/university_view" class="small-box-footer">More info
            <i class="fa fa-arrow-circle-right"></i></a>

        </div>

      </div>

      <?php

      $admin_details = $this->session_check_and_session_data->admin_session_data();

      if (@$admin_details[0]->user_type_id == '1') {
      ?>
      <div class="col-lg-3 col-xs-6">



        <div class="small-box bg-aqua">

          <div class="inner">
            <?php
              $uni_type1 = $this->common->select($table_name = 'tbl_kpo', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
              ?>
            Subject -<h3> <?php echo count($uni_type1); ?></h3>

          </div>

          <div class="icon">


          </div>

          <a href="<?php echo base_url(); ?>index.php/Admin_service/kpo_view" class="small-box-footer">More info <i
              class="fa fa-arrow-circle-right"></i></a>

        </div>

      </div>

      <?php } ?>

      <?php

      $admin_details = $this->session_check_and_session_data->admin_session_data();

      if (@$admin_details[0]->user_type_id == '1') {
      ?>

      <div class="col-lg-3 col-xs-6">



        <div class="small-box bg-aqua">

          <div class="inner">
            <?php
              $uni_type2 = $this->common->select($table_name = 'tbl_examination', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
              ?>
            Service -<h3> <?php echo count($uni_type2); ?></h3>

          </div>

          <div class="icon">



          </div>

          <a href="<?php echo base_url(); ?>index.php/Admin_service/examination_view" class="small-box-footer">More info
            <i class="fa fa-arrow-circle-right"></i></a>

        </div>

      </div>

      <?php } ?>

      <?php

      $admin_details = $this->session_check_and_session_data->admin_session_data();

      if (@$admin_details[0]->user_type_id == '1') {
      ?>

      <div class="col-lg-3 col-xs-6">



        <div class="small-box bg-aqua">

          <div class="inner">
            <?php
              $uni_type32 = $this->common->select($table_name = 'tbl_user', $field = array(), $where = array('user_type_id' => 6), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
              ?>
            Employee -<h3> <?php echo count($uni_type32); ?></h3>

          </div>

          <div class="icon">



          </div>

          <a href="<?php echo base_url(); ?>index.php/sub_admin_list_manage" class="small-box-footer">More info <i
              class="fa fa-arrow-circle-right"></i></a>

        </div>

      </div>

      <?php } ?>




      <?php

      $admin_details = $this->session_check_and_session_data->admin_session_data();

      if (@$admin_details[0]->user_type_id == '1') {
      ?>

      <div class="col-lg-3 col-xs-6">



        <div class="small-box bg-aqua">

          <div class="inner">
            <?php
              $user_student = $this->common->select($table_name = 'tbl_user', $field = array(), $where = array('user_type_id' => 2), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
              ?>
            User -<h3> <?php echo count($user_student); ?></h3>

          </div>

          <div class="icon">



          </div>

          <a href="<?php echo base_url(); ?>index.php/manage_user_student" class="small-box-footer">More info <i
              class="fa fa-arrow-circle-right"></i></a>

        </div>

      </div>

      <?php } ?>


      <?php

      $admin_details = $this->session_check_and_session_data->admin_session_data();

      if (@$admin_details[0]->user_type_id == '1') {
      ?>

      <div class="col-lg-3 col-xs-6">



        <div class="small-box bg-aqua">

          <div class="inner">
            <?php
              $invite_for_ebook = $this->common->select($table_name = 'tbl_invite_for_ebook', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
              ?>
            Invite for Ebook -<h3> <?php echo count($invite_for_ebook); ?></h3>

          </div>

          <div class="icon">



          </div>

          <a href="<?php echo base_url(); ?>index.php/manage_ebook" class="small-box-footer">More info <i
              class="fa fa-arrow-circle-right"></i></a>

        </div>

      </div>

      <?php } ?>



      <?php

      $admin_details = $this->session_check_and_session_data->admin_session_data();

      if (@$admin_details[0]->user_type_id == '1') {
      ?>

      <div class="col-lg-3 col-xs-6">



        <div class="small-box bg-aqua">

          <div class="inner">
            <?php
              $research = $this->common->select($table_name = 'tbl_research_paper_consul_form', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
              ?>
            Research Paper Consultancy -<h3> <?php echo count($research); ?></h3>

          </div>

          <div class="icon">



          </div>

          <a href="<?php echo base_url(); ?>index.php/manage_research_guideline/research_paper_consul_form"
            class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

        </div>

      </div>

      <?php } ?>



      <?php

      $admin_details = $this->session_check_and_session_data->admin_session_data();

      if (@$admin_details[0]->user_type_id == '1') {
      ?>

      <div class="col-lg-3 col-xs-6">



        <div class="small-box bg-aqua">

          <div class="inner">
            <?php
              $thesis_consul = $this->common->select($table_name = 'tbl_thesis_cons_form', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
              ?>
            Thesis Consultancy -<h3> <?php echo count($thesis_consul); ?></h3>

          </div>

          <div class="icon">



          </div>

          <a href="<?php echo base_url(); ?>index.php/manage_disertation_guideline/thesis_consul_list"
            class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

        </div>

      </div>

      <?php } ?>



      <?php

      $admin_details = $this->session_check_and_session_data->admin_session_data();

      if (@$admin_details[0]->user_type_id == '1') {
      ?>

      <div class="col-lg-3 col-xs-6">



        <div class="small-box bg-aqua">

          <div class="inner">
            <?php
              $phd = $this->common->select($table_name = 'tbl_phd_thesis_form', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
              ?>
            PHD Thesis Consultancy -<h3> <?php echo count($phd); ?></h3>

          </div>

          <div class="icon">



          </div>

          <a href="<?php echo base_url(); ?>index.php/manage_phd_thesis_guideline/phd_thesis_online_application"
            class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

        </div>

      </div>

      <?php } ?>


      <!--  <div class="col-lg-3 col-xs-6">

      

        <div class="small-box bg-aqua">

          <div class="inner">

           <h3><?php echo count($order_list); ?></h3> 

            <p>Total Order</p>

          </div>

          <div class="icon">

            <i class="ion ion-ios-cart"></i>

          </div>



          <a href="<?php echo base_url(); ?>index.php/manage_order" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

        </div>

      </div> -->







      <!--  <div class="col-lg-3 col-xs-6">

               

                <div class="small-box bg-green">

                    <div class="inner">

                        <h4>Total Order</h4>

                        <p>

                          <?php

                          $order_list = count($order_list);

                          if (strlen($order_list) < 2) {

                            $order_list = '0' . $order_list;
                          } else {

                            $order_list = $order_list;
                          }

                          echo $order_list;

                          ?>



                        </p>

                    </div>

                    <div class="icon">

                     <i class="fa fa-th" aria-hidden="true"></i>

                    </div>

                   <a href="<?php echo base_url(); ?>index.php/manage_order" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                </div>

            </div> -->



      <!--   <div class="col-lg-3 col-xs-6">

      

        <div class="small-box bg-aqua">

          <div class="inner">

           <h3><?php echo '0'; ?></h3> 

            <p>Total Category</p>

          </div>

          <div class="icon">

            <i class="ion ion-ios-cart"></i>

          </div>

          <a href="<?php echo base_url(); ?>index.php/admin_category" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

        </div>

      </div> -->







      <!-- ./col -->

      <!-- <div class="col-lg-3 col-xs-6"> -->

      <!-- small box -->

      <!-- <div class="small-box bg-green">

          <div class="inner">

            <h3><?php echo count($buyer_list); ?></sup></h3> 

            <p>Total Buyer</p>

          </div>

          <div class="icon">

            <i class="ion ion-ios-people"></i>

          </div>

          <a href="<?php echo base_url(); ?>index.php/admin_buyer" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

        </div>

      </div> -->

      <!-- ./col -->

      <!-- <div class="col-lg-3 col-xs-6"> -->

      <!-- small box -->

      <!-- <div class="small-box bg-yellow"> -->

      <!-- <div class="inner">

         <h3><?php echo count($seller_list); ?></h3> 

            <p>Total Seller</p>

          </div>

          <div class="icon">

            <i class="ion ion-person"></i>

          </div>

        <a href="<?php echo base_url(); ?>index.php/admin_seller" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> 

        </div>

      </div> -->

      <!-- ./col -->



      <!--    <div class="col-lg-3 col-xs-9">

       

        <div class="small-box bg-red">

          <div class="inner">

            <h3><?php echo count($product_list); ?></h3>

            <p>Total Products</p>

          </div>

          <div class="icon">

           <i class="fa fa-product-hunt" aria-hidden="true"></i>

          </div>

          <a href="<?php echo base_url(); ?>index.php/manage_product/product_list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> 

        </div>

    

    </div> -->

      <!-- /.row -->

      <!-- Main row -->

      <div class="row">

        <!-- Left col -->

        <section class="col-lg-6 connectedSortable">



          <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js"></script> -->

          <!-- Custom tabs (Charts with tabs)-->

          <!--  <div class="nav-tabs-custom">

      

          <select class="pull-right" onchange="get_bar_chart(this.value)">

            <option value="year">Year</option>

            <option value="month">Month</option>

            <option value="week">Week</option>

          </select>

          <ul class="nav nav-tabs pull-right">

             <li class="active"><button type="button" onclick="get_bar_chart()" name="button">Day</button></li>

            <li><a href="#sales-chart" data-toggle="tab">Donut</a></li> 

            <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>

          </ul>

          <div class="tab-content no-padding" id="my_chart_div">

          <canvas id="myChart"></canvas>

          </div>

        </div> -->

          <!-- /.nav-tabs-custom -->

          <!-- <textarea name="my_text" id="my_text"></textarea> -->

          <script src="<?php echo base_url(); ?>assets/plugins/tinymce/tinymce.min.js"></script>

          <script type="text/javascript">
            tinymce.init({

              selector: '#my_text',

              height: 500,

              theme: 'modern',

              plugins: [

                'advlist autolink lists link image charmap print preview hr anchor pagebreak',

                'searchreplace wordcount visualblocks visualchars code fullscreen',

                'insertdatetime nonbreaking save table contextmenu directionality',

                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'

              ],

              toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',

              toolbar2: 'print preview | codesample',

              image_advtab: true



            });
          </script>

        </section>

        <!-- /.Left col -->

        <!-- right col (We are only adding the ID to make the widgets sortable)-->

        <section class="col-lg-6 connectedSortable">

          <!-- solid sales graph -->

          <!--  <div class="nav-tabs-custom">

           

            <select class="pull-right" onchange="get_line_chart(this.value)">

              <option value="year">Year</option>

              <option value="month">Month</option>

              <option value="week">Week</option>

            </select>

            <ul class="nav nav-tabs pull-right">

              <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>

              <li><a href="#sales-chart" data-toggle="tab">Donut</a></li> 



              <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>

            </ul>

            <div class="tab-content no-padding" id="line_chart_div">

              <canvas id="line_chart"></canvas>

            </div>

          </div> -->

          <!-- /.box -->

        </section>

        <!-- right col -->

      </div>

      <!-- /.row (main row) -->

  </section>

  <!-- /.content -->

</div>

<?php 
 //if(!$this->session->userdata('teachloggedIn')) {
   $this->session->set_userdata('teachloggedIn', '1');
?>


<script>
  $.ajax({
    type: "POST",
    url: "<?php echo $this->config->item('base_teach_url'); ?>/admin/login",
    data: {
      email: "<?php echo $this->config->item('base_admin_teach_email'); ?>",
      'user_id': "<?= $this->session->userdata('hs_admin_id');?>"
    },
    dataType: 'json',
    success: function (response) {
      if (response.success) {
        location.reload();
      }
    },
    error: function (jqXHR) {
      var response = $.parseJSON(jqXHR.responseText);
      if (response.message) {
        alert(response.message);
      }
    }
  });
  //   var popout = window.open("http://localhost/iipars/ugcnet/admin/admin/login");
  //   window.setTimeout(function(){
  //     popout.close();
  // }, 200);
</script>
<?php //}?>

<script type="text/javascript">
  var ctx = document.getElementById("myChart").getContext('2d');

  var chart_data = < ? php echo $bar_chart_year; ? > ;

  //alert(chart_data);

  var myChart = new Chart(ctx, {

    type: 'bar',

    data: {

      labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],

      datasets: [{

        //label: 'blue',

        data: chart_data,

        backgroundColor: "#36a2eb"

      }]

    },

    options: {

      legend: {

        display: false,

      }

    }

  });
</script>

<script type="text/javascript">
  function get_bar_chart(value)

  {

    if (value == "week")

    {

      $("#my_chart_div").empty("");

      $("#my_chart_div").html("<canvas id='myChart'></canvas>");

      var ctx = document.getElementById("myChart").getContext('2d');

      var chart_data = < ? php echo $bar_chart_week; ? > ;

      //alert(chart_data);

      var myChart = new Chart(ctx, {

        type: 'bar',

        data: {

          labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],

          datasets: [{

            //label: 'blue',

            data: chart_data,

            backgroundColor: "#36a2eb"

          }]



        },

        options: {

          legend: {

            display: false,

          }

        }

      });

    } else if (value == "month")

    {

      $("#my_chart_div").empty("");

      $("#my_chart_div").html("<canvas id='myChart'></canvas>");

      var ctx = document.getElementById("myChart").getContext('2d');

      var chart_data = < ? php echo $bar_chart_month; ? > ;

      var chart_labels = < ? php echo $bar_chart_month1; ? > ;

      //alert(chart_data);

      var myChart = new Chart(ctx, {

        type: 'bar',

        data: {

          labels: chart_labels,

          datasets: [{

            //label: 'blue',

            data: chart_data,



            backgroundColor: "#36a2eb"



          }]

        },

        options: {

          legend: {

            display: false,

          }

        }

      });

    } else if (value == "year")

    {

      $("#my_chart_div").empty("");

      $("#my_chart_div").html("<canvas id='myChart'></canvas>");

      var ctx = document.getElementById("myChart").getContext('2d');

      var chart_data = < ? php echo $bar_chart_year; ? > ;

      //alert(chart_data);

      var myChart = new Chart(ctx, {

        type: 'bar',

        data: {

          labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],

          datasets: [{

            //label: 'blue',

            data: chart_data,



            backgroundColor: "#36a2eb"



          }]

        },

        options: {

          legend: {

            display: false,

          }

        }

      });

    }



  }
</script>



<script type="text/javascript">
  var ctx = document.getElementById('line_chart').getContext('2d');

  var chart_data = < ? php echo $bar_chart_year; ? > ;

  var myChart = new Chart(ctx, {

    type: 'line',

    data: {

      labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],

      datasets: [{

        //label: 'blue',

        data: chart_data,

        backgroundColor: "rgba(0,0,0,0)",

        pointBackgroundColor: "#000000",

        borderColor: "rgba(255,153,0,0.6)"



      }]

    },

    options: {

      legend: {

        display: false,

      }

    }

  });
</script>

<script type="text/javascript">
  function get_line_chart(value)

  {

    if (value == "week")

    {

      $("#line_chart_div").empty("");

      $("#line_chart_div").html("<canvas id='line_chart'></canvas>");

      var ctx = document.getElementById("line_chart").getContext('2d');

      var chart_data = < ? php echo $bar_chart_week; ? > ;

      //alert(chart_data);

      var myChart = new Chart(ctx, {

        type: 'line',

        data: {

          labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],

          datasets: [{

            //label: 'blue',

            data: chart_data,

            backgroundColor: "rgba(0,0,0,0)",

            pointBackgroundColor: "#000000",

            borderColor: "rgba(255,153,0,0.6)"

          }]



        },

        options: {

          legend: {

            display: false,

          }

        }

      });

    } else if (value == "month")

    {

      $("#line_chart_div").empty("");

      $("#line_chart_div").html("<canvas id='line_chart'></canvas>");

      var ctx = document.getElementById("line_chart").getContext('2d');

      var chart_data = < ? php echo $bar_chart_month; ? > ;

      var chart_labels = < ? php echo $bar_chart_month1; ? > ;

      //alert(chart_data);

      var myChart = new Chart(ctx, {

        type: 'line',

        data: {

          labels: chart_labels,

          datasets: [{

            //label: 'blue',

            data: chart_data,



            backgroundColor: "rgba(0,0,0,0)",

            pointBackgroundColor: "#000000",

            borderColor: "rgba(255,153,0,0.6)"



          }]

        },

        options: {

          legend: {

            display: false,

          }

        }

      });

    } else if (value == "year")

    {

      $("#line_chart_div").empty("");

      $("#line_chart_div").html("<canvas id='line_chart'></canvas>");

      var ctx = document.getElementById("line_chart").getContext('2d');

      var chart_data = < ? php echo $bar_chart_year; ? > ;

      //alert(chart_data);

      var myChart = new Chart(ctx, {

        type: 'line',

        data: {

          labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],

          datasets: [{

            //label: 'blue',

            data: chart_data,



            backgroundColor: "rgba(0,0,0,0)",

            pointBackgroundColor: "#000000",

            borderColor: "rgba(255,153,0,0.6)"



          }]

        },

        options: {

          legend: {

            display: false,

          }

        }

      });

    }



  }
</script>