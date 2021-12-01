<!DOCTYPE html>

<html dir="ltr" lang="en">



<head>

  <!-- Global site tag (gtag.js) - Google Analytics -->

  <script async src="https://www.googletagmanager.com/gtag/js?id=G-S4Q4JM32SR"></script>

  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }

    gtag('js', new Date());



    gtag('config', 'G-S4Q4JM32SR');
  </script>



  <!-- Meta Tags -->

  <meta name="viewport" content="width=device-width,initial-scale=1.0" />

  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />





  <!-- Page Title -->

  <title>IIPARS</title>



  <!-- Favicon and Touch Icons -->

  <link href="<?php echo base_url(); ?>assets/images/favicon.png" rel="shortcut icon" type="image/png">



  <!-- Stylesheet -->

  <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">

  <link href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css" rel="stylesheet" type="text/css">

  <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet" type="text/css">

  <link href="<?php echo base_url(); ?>assets/css/css-plugin-collections.css" rel="stylesheet" />

  <!-- CSS | menuzord megamenu skins -->

  <link id="menuzord-menu-skins" href="<?php echo base_url(); ?>assets/css/menuzord-skins/menuzord-boxed.css" rel="stylesheet" />



  <!-- CSS | Preloader Styles -->

  <link href="<?php echo base_url(); ?>assets/css/preloader.css" rel="stylesheet" type="text/css">

  <!-- CSS | Custom Margin Padding Collection -->

  <link href="<?php echo base_url(); ?>assets/css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">

  <!-- CSS | Responsive media queries -->

  <link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet" type="text/css">





  <!-- Revolution Slider 5.x CSS settings -->

  <link href="<?php echo base_url(); ?>assets/js/revolution-slider/css/settings.css" rel="stylesheet" type="text/css" />

  <link href="<?php echo base_url(); ?>assets/js/revolution-slider/css/layers.css" rel="stylesheet" type="text/css" />

  <link href="<?php echo base_url(); ?>assets/js/revolution-slider/css/navigation.css" rel="stylesheet" type="text/css" />



  <!-- CSS | Theme Color -->

  <link href="<?php echo base_url(); ?>assets/css/colors/theme-skin-color-set1.css" rel="stylesheet" type="text/css">

  <!-- CSS | Main style file -->

  <link href="<?php echo base_url(); ?>assets/css/style-main.css" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.carousel.min.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.theme.default.min.css">









</head>

<body class="">

  <div id="wrapper" class="clearfix">

    <!-- preloader -->

    <!-- <div id="preloader">

    <div id="spinner">

      <div class="preloader-dot-loading">

        <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>

      </div>

    </div>

    <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>

  </div>  -->



    <!-- Header -->

    <header id="header" class="header">

      <!-- Header News -->
      <div class="header-top d-none_mobile">
        <?php 
          if(isset($news_feed)){
        ?>
        <div class="container news_fes_p_cus">
          <div class="d-flex align-items-cencer">
            <div class="news-title">
              <h4 class="mt-0 line-height-1 mb-0">News <span class="text-theme-colored2"> Feed</span> <img src="https://iipars.com/assets/img/arrow.gif"></h4>
            </div>
            <div id="newsTicker" class="accounceBox ticker">
              <ul>

                <?php foreach ($news_feed as $row) {





                ?>

                  <li>

                    <?php

                    if ($row->image == '') {





                    ?>

                      <a href="<?php echo $row->description; ?>" target="_blank"><?php echo $row->title; ?><img src="<?php echo base_url(); ?>assets/img/new.gif" class="new_gif_class"></a>

                    <?php } else { ?>


                      <a download href=" <?php echo base_url(); ?>assets/upload/news_feed/<?php echo $row->image ?>" target="_blank"><?php echo $row->title; ?><img src="<?php echo base_url(); ?>assets/img/new.gif" class="new_gif_class"></a>

                    <?php } ?>

                  </li>



                <?php } ?>


              </ul>
            </div>

            <!-- <div class="latest_news p_cus_content_scroll">
            <marquee direction="up" height="10" scrolldelay="220" onmouseover="this.stop();" onmouseout="this.start();">
             <ul>
               <li>
                 <div class="scroll_arrow_all_sec">
                   <div class="scroll_arrow_content">
                     <a download href=" https://iipars.com/assets/upload/news_feed/059366000_1636422671.jpeg" target="_blank">WBSET EXAM 09/01/2022 --- IIPARS Introduce an offline Crash Course for PAPAR - I at Mecheda (Near SBI)<img src="https://iipars.com/assets/img/new.gif" class="new_gif_class"></a>
                   </div>
                 </div>
               </li>
             </ul>
           </marquee>
          </div> -->

          </div>

        </div>
        <?php }?>                
      </div>



      <div class="header-top bg-theme-colored sm-text-center">

        <div class="container">

          <div class="row">

            <div class="col-md-12">

              <div class="top_header_marquee_sec">



                <?php



                $header_title =  $this->common_model->common($table_name = 'tbl_single_line_header', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');





                $contact =  $this->common_model->common($table_name = 'tbl_contact', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



                ?>







                <!-- <marquee direction="left"  scrolldelay="220" onmouseover="this.stop();" onmouseout="this.start();">

              <a href="#"><img src="<?php echo base_url(); ?>assets/img/new.gif" class="new_gif_class"><?php echo @$header_title[0]->title; ?></a>

            </marquee> -->

              </div>

            </div>



          </div>

        </div>

      </div>

      <div class="header-middle p-0 bg-lighter xs-text-center">

        <div class="container pt-20 pb-20 p_cus_mobile_all_header_ppp">

          <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-3">

              <a class="menuzord-brand pull-left flip sm-pull-center" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/new-aeducation-logo.png" alt=""></a>

            </div>

            <div class="col-xs-12 col-sm-4 col-md-9 text-ali-rt text-ce-res">

              <div class="hed-cont widget mt-10 mb-10 m-0 res-none">
                <a class="btn mt-10 trans-btn" href="https://web.whatsapp.com/send?phone=9547046102&amp;text=Hi, I am interested in one of your courses. Reply me back to help me with further enquiry." target="_blank">
                  <!-- <i class="fa fa-lg fa-mobile text-primary" aria-hidden="true"></i> --><img src="<?php echo base_url(); ?>assets/images/whatsapp-M.png" alt="Whatsapp" style="height: 16px">
                  WhatsApp
                </a>
              </div>



              <div class="hed-cont widget mt-10 mb-10 m-0 res-none">

                <a class="btn mt-10 trans-btn" href="#"><i class="fa fa-lg fa-envelope-o text-primary" aria-hidden="true"></i><?php echo @$contact[0]->primary_email; ?></a>

                <!-- <i class="fa fa-lg fa-envelope-o text-theme-colored2 font-25 mt-5 mr-sm-0 sm-display-block pull-left flip sm-pull-none"></i>

              <h5 class="font-13 text-black m-0"><a href="#" class="log-sty"> info@iipars.com</a></h5> -->

              </div>



              <div class="hed-cont widget mt-10 mb-10 m-0 res-none">

                <a class="btn mt-10 trans-btn" href="#"><i class="fa fa-lg fa-mobile text-primary" aria-hidden="true"></i><?php echo @$contact[0]->contact_no; ?></a>

                <!-- <i class="fa fa-lg fa-mobile text-theme-colored2 font-25 mt-5 mr-sm-0 sm-display-block pull-left flip sm-pull-none"></i>

              <h5 class="font-13 text-black m-0"><a href="#" class="log-sty"> +8371093927</a></h5> -->

              </div>

              <?php

              $user_id = @$this->session->userdata('user_session_id');



              // $login_avail=  $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id,'user_id !='=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

              // print_r($login_avail);



              if ($user_id == "") {

              ?>

                <div class="hed-cont widget mt-10 mb-10 m-0 login_p_cus_mobile">

                  <a class="btn mt-10 btn-success" href="<?php echo $this->url->link(2); ?>"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>

                  <!-- <i class="fa fa-user-o text-theme-colored2 font-25 mt-5 mr-sm-0 sm-display-block pull-left flip sm-pull-none" aria-hidden="true"></i>

              <h5 class="font-13 text-black m-0"><a href="#" class="log-sty"> Login</a></h5> -->

                </div>

              <?php }



              if ($user_id != "") {



                $login_avail =  $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id' => $user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

              ?>



                <div class="hed-cont widget mt-10 mb-10 m-0">

                  <div class="dropdown">

                    <a class="btn mt-10 trans-btn dropdown-toggle" href="javascript:void(0)" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-o" aria-hidden="true"></i>Hi <?php echo @$login_avail[0]->first_name; ?><span class="caret"></span></a>

                    <!-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

					Dropdown button

				  </button> -->

                    <div class="dropdown-menu nw-drop-menu" aria-labelledby="dropdownMenuButton">

                      <a class="dropdown-item" href="<?php echo $this->url->link(4); ?>">My Account</a>

                      <a class="dropdown-item" href="<?php echo $this->url->link(5); ?>">Profile Update</a>

                      <a class="dropdown-item" href="<?php echo $this->url->link(8); ?>">My Plan</a>

                      <a class="dropdown-item" href="<?php echo $this->url->link(6); ?>">Logout</a>

                    </div>

                  </div>

                </div>



              <?php } ?>







            </div>

            <div class="pull-right sm-pull-none mb-sm-15 pr-15 all_app_download_api_score_entry_lavel_p_cus">

              <!-- <a class="res-app-change btn btn-colored btn-flat btn-theme-colored2 mt-10 round-btn" href="#"><i class="fa fa-android" aria-hidden="true"></i>App Download</a>



              <a target="_blank" class="res-app-change btn btn-colored btn-flat btn-theme-colored2 mt-10 round-btn" href="<?php echo base_url(); ?>Manage_api">Check your API score</a>



              <a target="_blank" class="res-app-change btn btn-colored btn-flat btn-theme-colored2 mt-10 round-btn" href="<?php echo base_url(); ?>Manage_entry_level_score"></i>Entry level score checking</a> -->

            </div>





          </div>

        </div>

      </div>

      <div class="header-nav p_cus_mobile_toggol_menu">

        <div class="header-nav-wrapper navbar-scrolltofixed bg-white">

          <div class="container">

            <nav id="menuzord" class="menuzord red">

              <ul class="menuzord-menu">

                <li><a href="<?php echo $this->url->link(1); ?>">Home</a></li>

                <li><a href="<?php echo base_url(); ?>about_us">About Us</a></li>
                <li class="active"><a href="//">UGC - NET</a>
                  <ul class="dropdown" aria-labelledby="dropdownMenu1">
                    
                <li><h4 style="padding-left: 22px;">Subjects<!--  - Subjects --></h4></li>
                
                <li><a href="#">Bengali</a></li>
                <li><a href="#">Commerce</a></li>
                <li><a href="#">Sanskrit</a></li>
                <li><a href="#">Philosophy</a></li>
                <li><a href="#">Economics</a></li>
                <li><a href="#">Geography</a></li>
                <li><a href="#">History</a></li>
                <li><a href="#">English</a></li>
                <li><a href="#">Education</a></li>

                <li><a href="#"><h4 class="m-0">Paper – I</h4></a>

                     <ul class="dropdown" aria-labelledby="dropdownSubMenu1">
                      <li><h4 style="padding-left: 22px;">Units</h4></li>
                      <li role="separator" class="divider bg-dark" style="height: 1px; background: #ccc;"></li>
                      <li><a href="#">Unit - 1</a>

                       <ul class="dropdown" aria-labelledby="dropdownSubMenu2">
                        <li><a href="#">PDF</a>
                          <ul class="dropdown" aria-labelledby="dropdownSubMenu3">
                            <li><a href="#">Order Now</a></li>
                          </ul>
                        </li>
                        <li><a href="#">PPT</a></li>
                        <li><a href="#">PYQ</a></li>
                        <li><a href="#">Mock Test</a></li>
                      </ul>

                    </li>
                    <li><a href="#">Unit - 2</a></li>
                    <li><a href="#">Unit - 3</a></li>
                    <li><a href="#">Unit - 4</a></li>
                    <li><a href="#">Unit - 5</a></li>
                    <li><a href="#">Unit - 6</a></li>
                    <li><a href="#">Unit - 7</a></li>
                    <li><a href="#">Unit - 8</a></li>
                    <li><a href="#">Unit - 9</a></li>
                    <li><a href="#">Unit - 10</a></li>
                  </ul>

                </li>
              </ul>

            </li>
            <li><a href="#">Economics</a></li>


                <li><a href="<?php echo base_url(); ?>Manage_research/all">Writing Consultancy</a>

                  <ul class="dropdown">







                    <li><a href="<?php echo base_url(); ?>Manage_research/writing_consultancy">Research Paper Writing
                        Consultancy</a></li>

                    <li><a href="<?php echo base_url(); ?>Manage_research/paper_publication">Research Paper Publication
                        Consultancy</a></li>

                    <li><a href="<?php echo base_url(); ?>Manage_phd">Ph. D. Thesis writing Consultancy</a></li>



                    <li><a href="<?php echo base_url(); ?>Manage_research/mphil_dissertation">M.Phil. Dissertation
                        writing Consultancy</a></li>

                    <li><a href="<?php echo base_url(); ?>Manage_research/project_work">Project Work Writing
                        Consultancy</a></li>

                    <li><a href="<?php echo base_url(); ?>Manage_research/data_analysis">Data Analysis & Research
                        Methodology</a></li>













                  </ul>







                </li>

                <li><a href="<?php echo base_url(); ?>Manage_self_book_publication">Book Publication</a>

                  <ul class="dropdown">

                    <li><a href="<?php echo base_url(); ?>Manage_self_book_publication/writing_consultancy">Book Writing
                        Consultancy</a></li>

                    <li><a href="<?php echo base_url(); ?>Manage_self_book_publication/publication_consultacy">Book
                        Publication Consultancy</a></li>

                    <li><a href="<?php echo base_url(); ?>Manage_self_book_publication/thesis_publication">Thesis to Book
                        Publication</a></li>

                    <li><a href="<?php echo base_url(); ?>Manage_self_book_publication/dissertation_publication">M.Phil.
                        Dissertation to Book Publication</a></li>

                    <li><a href="<?php echo base_url(); ?>Manage_self_book_publication/project_work_book">Project Work to
                        Book Publication</a></li>

                  </ul>



                </li>



                <!-- <li><a href="<?php echo base_url(); ?>Manage_ebook/book_list">Our Books</a></li> -->







                <!--   <li ><a href="#">API Score Related Information</a>

                <ul class="dropdown">



  <?php



  $service_type =  $this->common_model->common($table_name = 'tbl_examination_type', $field = array(), $where = array('status' => 'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



  foreach ($service_type as $ser) {



  ?>



                  <li ><a href="#"><?php echo $ser->examination_type; ?></a>

                    <ul class="dropdown">

                      <?php



                      $service =  $this->common_model->common($table_name = 'tbl_examination', $field = array(), $where = array('examination_type_id' => $ser->examination_type_id, 'status' => 'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



                      foreach ($service as $row) {

                      ?>

                      <li><a href="<?php echo $row->slug; ?>"><?php echo $row->examination_name; ?></a></li>

                    <?php } ?>

					  

                    </ul>

                  </li>

                <?php } ?>





                

                </ul>







              </li> -->



                <!--  <li><a href="#">List of Subjects</a>

                <ul class="dropdown p_header_verfloww_sec_p_cus">



                  <?php













                  $user_id = @$this->session->userdata('user_session_id');

                  if ($user_id != '') {

                    $user_sub =  $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id' => $user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



                    $sub_id = @$user_sub[0]->subject_id;



                    $kpo_list =  $this->common_model->common($table_name = 'tbl_kpo', $field = array(), $where = array('kpo_id' => $sub_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                  } else {

                    $kpo_list =  $this->common_model->common($table_name = 'tbl_kpo', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                  }







                  foreach ($kpo_list as $sub) {







                  ?>



                  <li><a href="<?php echo $sub->slug; ?>"><?php echo $sub->kpo_name; ?></a></li>

                  



                <?php } ?>

                </ul>

              </li> -->





                <!--  <li><a href="#">E-Book & Short Notes</a>

                <ul class="dropdown">

                  <li><a href="<?php echo base_url(); ?>Manage_ebook">Invitation for E-Book/ Short Notes</a></li>

                  <li><a href="<?php echo base_url(); ?>Manage_ebook/purchase_your_ebook">Purchase your E-Book/ Short Notes</a></li>

                </ul>

              </li> -->



                <!--  <li><a href="#">Research Paper Consultancy</a>

                <ul class="dropdown">

                  <li><a href="<?php echo base_url(); ?>Manage_research">General Guideline</a>

                  <li><a href="<?php echo base_url(); ?>Manage_research/apply_form">Form(Online Submission)</a>

                  </li>

                </ul>

              </li> -->



                <!-- <li><a href="#">Dissertation/ Thesis Consultancy</a>

                <ul class="dropdown">

                  <li><a href="<?php echo base_url(); ?>Manage_thesis">General Guideline</a>

                  <li><a href="<?php echo base_url(); ?>Manage_thesis/apply_form">Form(Online Submission)</a>

                  </li>

                </ul>

              </li> -->



                <!--  <li><a href="#">PHD Thesis To Book Conversion</a>

                <ul class="dropdown">

                  <li><a href="<?php echo base_url(); ?>Manage_phd">General Guideline</a>

                  <li><a href="<?php echo base_url(); ?>Manage_phd/apply_form">Form(Online Submission)</a>

                  </li>

                </ul>

              </li> -->



                <!-- <li><a href="<?php echo base_url(); ?>Marketing">Marketing</a></li> -->



                <li><a href="#">Gallery</a>

                  <ul class="dropdown">

                    <li><a href="<?php echo base_url(); ?>Manage_image">Image</a>

                    <li><a href="<?php echo base_url(); ?>Manage_video">Video</a>

                    </li>

                  </ul>

                </li>



                <!-- <li><a href="#">Blogs</a></li> -->



                <!--  <li <?php if (@$active == 'video') { ?> class="active" <?php } ?>><a href="<?php echo $this->url->link(11); ?>">Video Gallery</a></li> -->







                <li><a href="<?php echo $this->url->link(10); ?>">Contact Us</a></li>



              </ul>



            </nav>

          </div>

        </div>

      </div>

    </header>