<!-- Start main-content -->
  <div class="main-content">

    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-white-8" data-bg-img="<?php echo base_url();?>assets/images/bg6.jpg">
      <div class="container pt-30 pb-30">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="title">Dissertation/ Thesis Consultancy</h2>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="#">Home</a></li>
                <li class="active text-theme-colored">Dissertation/ Thesis Consultancy</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>



    <section class="manage_research_all_sec">
    <div class="container">
    <div class="row">
    <div class="col-md-12">
    <div class="manage_reaserch_vide_section">
    <iframe width="100%" height="100px" src="<?php echo @$manage_home[0]->video_link; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

    <div class="manage_reaserch_content_section">
    <!-- <h2 class="mt-0 line-height-1">Research <span class="text-theme-colored2">Guideline</span></h2> -->
    <?php echo @$manage_home[0]->title; ?>
  <!--   <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>

    <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p> -->

    <?php echo @$manage_home[0]->description; ?>

    </div>

    <div class="apply_online_submission_btn">
      <a class="btn hvr-bounce-to-bottom btn-theme-colored" href="<?php echo base_url();?>Manage_thesis/apply_form">Apply Online Submission</a>
    </div>

    </div>
    </div>
    </div>
      
    </section>

   