<!-- Start main-content -->
  <div class="main-content">
    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-white-8" data-bg-img="<?php echo base_url();?>assets/images/bg6.jpg">
      <div class="container pt-30 pb-30">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h3 class="font-28">Subject List</h2>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="active text-theme-colored">Subject Title</li>
              </ol>
            </div>
          </div>
        </div>
      </div>      
    </section>

    <section class="sub-lst-sec">
      <div class="container pb-0">
        <div class="row text-center">

          <?php foreach($subject_details as $row) { ?>
          <div class="col-sm-3">
            <div class="icon-box iconbox-border iconbox-theme-colored p-40" style="background: url(<?php echo base_url();?>assets/upload/subject_image/<?php echo $row->subject_image ; ?>);background-size: cover;">
				<div class="box-overlay"></div>
              <!-- <a href="#" class="icon icon-gray icon-bordered icon-border-effect effect-flat">
                <i class="fa fa-book"></i>
              </a> -->
              <div class="in-btn-sec">
				  <h5 class="icon-box-title"><?php echo $row->kpo_name; ?></h5>
				  <a class="btn btn-dark btn-sm mt-15" href="<?php echo $row->slug; ?>">View Institute</a>
			  </div>
        </div>
        </div>
<?php } ?>

        </div>
      </div>
    </section>

    
  </div>
  <!-- end main-content -->