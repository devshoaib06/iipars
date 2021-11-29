<!-- Start main-content -->
  <div class="main-content">
    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-white-8" data-bg-img="<?php echo base_url(); ?>assets/images/service-bg.jpg">
      <div class="container pt-30 pb-30">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="title">Service Details</h3>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="#">Home</a></li>
                <li><a href="#">Institute</a></li>
                <li class="active text-theme-colored">Service Details</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>
	
	<section class="serv-dtl">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12">
					<div class="serv-name-wrap">
						<h2><?php echo @$form[0]->title; ?></h2>
					</div>
					<div class="main-info">
						<div class="info-list">
							<h3><i class="fa fa-graduation-cap"></i> <?php echo @$service_type[0]->examination_type; ?></h3>
						</div>
					</div>
					<div class="serv-title">
						<h2>Title: <span><?php echo @$form[0]->title; ?></span></h2>
						<h3>Post: <span><?php echo @$form[0]->for_post; ?></span></h3>
						<p>Subject: <span><?php echo @$subject[0]->kpo_name; ?></span></p>
						<p>Service Provider: <span><?php echo @$university_type[0]->cc_name; ?></span> </p>
						<p>Institute: <span><a href="<?php echo $uni_link; ?>" target="_blank"><?php echo $uni_name; ?></a></span> </p>
					</div>
					<!-- <div class="main-name srv-prov">
						<h2>National Level University</h2>
						<div class="prov-listing">
							<ul>
								<li><i class="fa fa-book" aria-hidden="true"></i>Economics</li>
							</ul>
						</div>
					</div> -->
					<!-- <div class="main-name">
						<h2>Adikavi Nannaya University</h2>
						<div class="prov-listing">
							<ul>
								<li><i class="fa fa-graduation-cap"></i>Job Oriented Services</li>
								<li><i class="fa fa-map-marker"></i>Andhra Pradesh</li>
							</ul>
						</div>
					</div> -->
					<div class="main-info">
						<!-- <div class="info-list">
							<h3>Institute</h3>
							<p>Adikavi Nannaya University, 25-7-9/1, Jayakrishnapuram, Rajahmundry – 533 105, East Godavari District, Andhra Pradesh. (State University)</p>
						</div> -->
						<div class="info-list">
							<h3>Annouce Date</h3>
							<p><?php echo @$form[0]->announce_date; ?></p>
						</div>
						<div class="info-list">
							<h3>Last Submission Date</h3>
							<p><?php echo @$form[0]->last_announce_date; ?></p>
						</div>
					</div>
					<div class="srv-btn">
						<a href="<?php echo @$form[0]->web_link; ?>" class="btn btn-dark btn-sm mt-15" target="_blank">Apply Now</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-12">
					<div class="rt-panel">
						<div class="panel-hed">
							<h2>Overview</h2>
						</div>
						<div class="over-listing">
							<ul>
								<li>
									<div class="lt-ico">
										<i class="fa fa-calendar"></i>
									</div>
									<div class="rt-text">
										<p>Exam Date</p>
										<span><?php echo @$form[0]->exam_date; ?></span>
									</div>
								</li>
								<li>
									<div class="lt-ico">
										<i class="fa fa-clock-o"></i>
									</div>
									<div class="rt-text">
										<p>Duration</p>
										<span><?php echo @$form[0]->duration; ?></span>
									</div>
								</li>
								<li>
									<div class="lt-ico">
										<i class="fa fa-group"></i>
									</div>
									<div class="rt-text">
										<p>Sponsored by</p>
										<span><?php echo @$form[0]->sponsor_by; ?></span>
									</div>
								</li>
								<li>
									<div class="lt-ico">
										<i class="fa fa-calendar"></i>
									</div>
									<div class="rt-text">
										<p>From Date</p>
										<span><?php echo @$form[0]->from_date; ?></span>
									</div>
								</li>
								<li>
									<div class="lt-ico">
										<i class="fa fa-calendar"></i>
									</div>
									<div class="rt-text">
										<p>To Date</p>
										<span><?php echo @$form[0]->to_date; ?></span>
									</div>
								</li>
								<li>
									<div class="lt-ico">
										<i class="fa fa-sticky-note-o" aria-hidden="true"></i>
									</div>
									<div class="rt-text">
										<p>Post</p>
										<span><?php echo @$form[0]->for_post; ?></span>
									</div>
								</li>
								<li>
									<div class="lt-ico">
										<i class="fa fa-money"></i>
									</div>
									<div class="rt-text">
										<p>Pay Scale</p>
										<span><?php echo @$form[0]->amount; ?></span>
									</div>
								</li>
								<li>
									<div class="lt-ico">
										<i class="fa fa-globe" aria-hidden="true"></i>
									</div>
									<div class="rt-text">
										<p>Web Link</p>
										<span><a href="<?php echo @$form[0]->web_link; ?>">Click Here</a></span>
									</div>
								</li>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	
	

  </div>
  <!-- end main-content -->
