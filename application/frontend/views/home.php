<!-- Start main-content -->

<div class="main-content">

	<!-- Section: home -->

	<section id="home" class="divider">

		<div class="container1">

			<div class="row">

				<!-- <div class="col-lg-3">

			<div class="link-sec">

				<h2>Important Links</h2>

				<ul>

					<?php foreach($link as $row) { ?>

					<li><a href="<?php echo $row->link; ?>" target="_blank"><i class="fa fa-angle-double-right"></i><span class="impor_link_p_cus"><?php echo $row->title;?></span></a></li>

				<?php } ?>

					

				</ul>

			</div>

		</div> -->

				<div class="col-lg-12">

					<div class="container-fluid p-0">



						<!-- START REVOLUTION SLIDER 5.0.7 -->

						<div id="rev_slider_home_wrapper" class="rev_slider_wrapper fullwidthbanner-container"
							data-alias="news-gallery34"
							style="margin:0px auto;background-color:#ffffff;padding:0px;margin-top:0px;margin-bottom:0px;">

							<!-- START REVOLUTION SLIDER 5.0.7 fullwidth mode -->

							<div id="rev_slider_home" class="rev_slider fullwidthabanner" style="display:none;"
								data-version="5.0.7">

								<ul>



									<?php  foreach($slider as $key=>$row) { ?>

									<!-- SLIDE 1 -->

									<li data-index="rs-<?php echo $key; ?>" data-transition="slidingoverlayhorizontal"
										data-slotamount="default" data-easein="default" data-easeout="default"
										data-masterspeed="default" data-thumb="" data-rotate="0"
										data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7"
										data-saveperformance="off" data-title="Make an Impact">

										<!-- MAIN IMAGE -->

										<img src="<?php echo base_url();?>assets/upload/slider/<?php echo $row->slider_image;?>"
											alt="" data-bgposition="center center" data-bgfit="cover"
											data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg"
											data-no-retina>

										<!-- LAYERS -->

										<!-- LAYER NR. 1 -->

										<!-- <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme rs-parallaxlevel-0" 

					  id="slide-1-layer-<?php echo $key; ?>" 

					  data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 

					  data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 

					  data-width="full"

					  data-height="full"

					  data-whitespace="normal"

					  data-transform_idle="o:1;"

					  data-transform_in="opacity:0;s:1500;e:Power3.easeInOut;" 

					  data-transform_out="opacity:0;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" 

					  data-start="1000" 

					  data-basealign="slide" 

					  data-responsive_offset="on" 

					  style="z-index: 5;background-color:rgba(0, 0, 0, 0.35);border-color:rgba(0, 0, 0, 1.00);"> 

					</div> -->

										<!-- LAYER NR. 2 -->

										<div class="tp-caption tp-resizeme text-white rs-parallaxlevel-0"
											id="slide-1-layer-<?php echo $key; ?>"
											data-x="['left','left','left','left']" data-hoffset="['50','50','50','30']"
											data-y="['top','top','top','top']" data-voffset="['75','75','75','75']"
											data-fontsize="['56','46','40','36']"
											data-lineheight="['70','60','50','45']"
											data-fontweight="['800','700','700','700']"
											data-width="['700','650','600','420']" data-height="none"
											data-whitespace="normal" data-transform_idle="o:1;"
											data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;"
											data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;"
											data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
											data-mask_out="x:0;y:0;s:inherit;e:inherit;" data-start="1000"
											data-splitin="none" data-splitout="none" data-responsive_offset="on"
											style="z-index: 6; min-width: 600px; max-width: 600px; white-space: normal;">
											Welcome to IIPARS

										</div>

										<!-- LAYER NR. 3 -->

										<div class="tp-caption tp-resizeme text-white rs-parallaxlevel-0"
											id="slide-1-layer-<?php echo $key; ?>"
											data-x="['left','left','left','left']" data-hoffset="['50','50','50','30']"
											data-y="['top','top','top','top']" data-voffset="['145','145','145','145']"
											data-fontsize="['18','18','16','13']"
											data-lineheight="['30','30','28','25']"
											data-fontweight="['600','600','600','600']"
											data-width="['700','650','600','420']" data-height="none"
											data-whitespace="nowrap" data-transform_idle="o:1;"
											data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;"
											data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;"
											data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
											data-mask_out="x:0;y:0;s:inherit;e:inherit;" data-start="1000"
											data-splitin="none" data-splitout="none" data-responsive_offset="on"
											style="z-index: 7; white-space: nowrap;">You are the creator. We are the
											explorer. <br>
											Let the world know your creation.

										</div>

										<!-- LAYER NR. 4 -->

										<!-- <div class="tp-caption rs-parallaxlevel-0" 

					  id="slide-1-layer-4" 

					  data-x="['left','left','left','left']" data-hoffset="['53','53','53','30']" 

					  data-y="['top','top','top','top']" data-voffset="['360','290','260','260']" 

					  data-height="none"

					  data-width="['700','650','600','420']"

					  data-whitespace="nowrap"

					  data-transform_idle="o:1;"

					  data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Power1.easeInOut;"

					  data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" 

					  data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" 

					  data-mask_in="x:0px;y:0px;" 

					  data-mask_out="x:0;y:0;" 

					  data-start="1000" 

					  data-splitin="none" 

					  data-splitout="none" 

					  data-responsive_offset="on" 

					  data-responsive="off"

					  style="z-index: 8; white-space: nowrap;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;"><a href="#" class="btn btn-dark btn-theme-colored2 btn-xl">Read More</a> <a href="#" class="btn btn-dark btn-theme-colored btn-xl">Register Now</a>

					</div> -->

									</li>



									<?php } ?>















								</ul>

								<div class="tp-bannertimer tp-bottom"
									style="height: 5px; background-color: rgba(166, 216, 236, 1.00);"></div>

							</div>

						</div>





					</div>

				</div>







				<!--   <div class="col-lg-3">

	  	<div class="name_deg">

	  	<div class="per_img">

	  		<img src="<?php echo base_url(); ?>assets/upload/ceo/<?php echo @$ceo[0]->image; ?>" alt="tanmoy">

        </div>

        <div class="per_content">

        	<h3><?php echo @$ceo[0]->title; ?></h3>

        	<p><?php echo @$ceo[0]->description; ?></p>

        </div>

	  	</div>

		

	  </div> -->







			</div>

		</div>

	</section>





	<!-- 

<div class="news_sec">

	<div class="container">

		<div class="row">

			<div class="col-md-8 col-md-offset-2">

				<div class="news_fes_p_cus">

					<h2 class="mt-0 line-height-1">News <span class="text-theme-colored2"> Feed</span></h2>

		



			<div class="latest_news p_cus_content_scroll">

                  <marquee direction="up" height="200" scrolldelay="220" onmouseover="this.stop();" onmouseout="this.start();">

                  	<ul>

                    <?php foreach($news_feed as $row) { 

                    	



                    	?>

                       <li>

                       <div class="scroll_arrow_all_sec">

                       <div class="scroll_arrow_gif">

                       <img src="<?php echo base_url();?>assets/img/arrow.gif">

                       </div>

                       <div class="scroll_arrow_content">

                       <?php 

                       if($row->image=='')

                       {





                       ?>

                       <a href="<?php echo $row->description;?>" target="_blank"><?php echo $row->title;?><img src="<?php echo base_url();?>assets/img/new.gif" class="new_gif_class"></a>

                       <?php } else { ?>

                      

                      <a download href=" <?php echo base_url();?>assets/upload/news_feed/<?php  echo $row->image?>" target="_blank"><?php echo $row->title;?><img src="<?php echo base_url();?>assets/img/new.gif" class="new_gif_class"></a>

                       <?php } ?>

                       </div>

                       </div>

                        </li>



                        <?php }?>





                        </ul>



                      

                      







              



                    </marquee>

                   

                </div>

		

		</div>

			</div>

		</div>

	</div>

</div> -->






	<!-- start Section: Banner Bottom -->
	<section class="iconsection">
		<div class="container">
			<div class="col-sm-4">
				<div class="iconinner">
					<img src="<?php echo base_url();?>assets/images/courses_icon.png" class="lefticon" alt="Best Online Courses for CSIR-UGC NET/SET/JRF exam
				">
					<span>Best Online Courses</span>
					Explore a variety of fresh topics
				</div>
			</div>
			<div class="col-sm-4">
				<div class="iconinner">
					<img src="<?php echo base_url();?>assets/images/instruction.png" class="lefticon" alt="Expert Instruction for CSIR-UGC NET/SET/JRF exam
				">
					<span>Expert Instruction</span>
					Find the right instructor for you
				</div>
			</div>
			<div class="col-sm-4">
				<div class="iconinner">
					<img src="<?php echo base_url();?>assets/images/access.png" class="lefticon" alt="Lifetime access of all courses materials
				">
					<span>Lifetime Access</span>
					Learn on your schedule
				</div>
			</div>
		</div>
	</section>

	<!-- start Section: Course Highlight -->
	<section class="course-highlight">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<a href="//">
						<div class="ugc-csir-courses">
							<h4>UGC-NET</h4>
						</div>
					</a>
				</div>
				<div class="col-sm-6">
					<a href="//">
						<div class="ugc-csir-courses">
							<h4>Writing Consultancy</h4>
						</div>
					</a>
				</div>
			</div>
		</div>

	</section>

	<!-- start Section: About -->

	<section class="abt-sec">

		<div class="container section-content">

			<div class="row d-flex">

				<div class="col-md-6">

					<div class="thumb-one">

						<h2>About <span class="text-theme-colored2">Us</span></h2>

						<p>IIPARS (International Institute for Providing Academic and Research Support) is one of the
							leading academic, proofreading, and job-related service firm. Registered under relevant
							company act, IIPARS approaches versatility of our current educational system by encompassing
							research-based study and offering expert guidance to the students and academicians in their
							career trajectory. Nowadays a student is absorbed in variety of activities and assignments
							that they commit grammatical or formatting errors while almost failing to convey the actual
							message. Here is where our organization plays the role of a northern star where both
							students and academicians can rely. </p>
						<p>
							We have high quality and customized editing services. We employ only the most experienced
							and highly educated and efficient editors who are experts in a vast range of subjects and
							distinctive fields. With the rapid evolution of technologies, we aim at providing the best
							skills to students and assists academicians in constructing a palatable career path for
							better opportunities in employment, enhancing your research outputs and accelerating your
							career prospects. Moreover, with a bare minimum cost of a newspaper IIPARS also lets you
							know about your career prospects and windows of opportunities all around you.
							<!--In this dynamic world where dimensions are always shifting, consciousness commands a constant upgradation and a need to stay ahead of the time. We acknowledge varying and specific needs of our subscribers and are committed to support and provide them with the best future prospects.  Miracle is nothing but manifestation cooked with potentiality. This is what we aim for our subscribers and help them fulfil their dreams. We ensure and nurture a hassle-free trustworthy relation with our subscribers. -->
						</p>
						<p>&nbsp;</p>





						<a class="btn hvr-bounce-to-bottom btn-success" href="<?php echo base_url();?>about_us">Know
							More</a>

					</div>

				</div>



				<div class="col-md-3">

					<div class="link-sec">
						<h2>Our <span class="text-theme-colored2">Services</span></h2>
						<ul>
							<li><a href="<?php echo base_url();?>Manage_research/writing_consultancy"><i
										class="fa fa-angle-double-right"></i>Research Paper Writing Consultancy</a></li>
							<li><a href="<?php echo base_url();?>Manage_research/paper_publication"><i
										class="fa fa-angle-double-right"></i>Research Paper Publication Consultancy</a>
							</li>
							<li><a href="<?php echo base_url();?>Manage_phd"><i class="fa fa-angle-double-right"></i>Ph.
									D. Thesis writing Consultancy</a></li>
							<li><a href="<?php echo base_url();?>Manage_research/mphil_dissertation"><i
										class="fa fa-angle-double-right"></i>M.Phil. Dissertation writing
									Consultancy</a></li>
							<li><a href="<?php echo base_url();?>Manage_research/project_work"><i
										class="fa fa-angle-double-right"></i>Project Work Writing Consultancy</a></li>
							<li><a href="<?php echo base_url();?>Manage_research/data_analysis"><i
										class="fa fa-angle-double-right"></i>Data Analysis & Research Methodology</a>
							</li>
							<li><a href="<?php echo base_url();?>Manage_self_book_publication/writing_consultancy"><i
										class="fa fa-angle-double-right"></i>Book Writing Consultancy</a></li>
							<li><a href="<?php echo base_url();?>Manage_self_book_publication/publication_consultacy"><i
										class="fa fa-angle-double-right"></i>Book Publication Consultancy</a></li>
							<li><a href="<?php echo base_url();?>Manage_self_book_publication/thesis_publication"><i
										class="fa fa-angle-double-right"></i>Thesis to Book Publication</a></li>
							<li><a href="<?php echo base_url();?>Manage_self_book_publication/dissertation_publication"><i
										class="fa fa-angle-double-right"></i>M.Phil. Dissertation to Book
									Publication</a></li>
							<li><a href="<?php echo base_url();?>Manage_self_book_publication/project_work_book"><i
										class="fa fa-angle-double-right"></i>Project Work to Book Publication</a></li>
						</ul>
					</div>
				</div>


				<div class="col-md-3">
					<div class="link-sec">

						<h2>Important <span class="text-theme-colored2">Links</span></h2>

						<ul>

							<?php foreach($link as $row) { ?>

							<li><a href="<?php echo $row->link; ?>" target="_blank"><i
										class="fa fa-angle-double-right"></i><span
										class="impor_link_p_cus"><?php echo $row->title;?></span></a></li>

							<?php } ?>



						</ul>

					</div>

				</div>
			</div>
		</div>
	</section>

	<!--start testimonial Section-->
	<section class="testimonials  ">
		<div class="container" style="position:relative">
			<h2>Our <span class="text-theme-colored2">Testimonials</span></h2>

			<section id="demos" class="outerslider">
			<div class="owl-carousel2">
					<?php
					foreach ($testimonials as $testimonial) {
						if ($testimonial->testimonial_type == 2 && $testimonial->testimonial_text!="") {
					?>

							<div class="item">

								<div class="testibox">
									<img src="<?php echo base_url(); ?>assets/images/invited.jpg" class="inviterd" alt="" />
									<p><?= $testimonial->testimonial_text; ?> </p>
									<span><?= $testimonial->student_name; ?></span>
								</div>

							</div>
					<?php  }
					} ?>

				</div>

			</section>

		</div>
	</section>