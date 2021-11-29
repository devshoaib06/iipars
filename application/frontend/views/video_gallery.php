<!-- Start main-content -->
  <div class="main-content">

    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-white-8" data-bg-img="<?php echo base_url();?>assets/images/bg6.jpg">
      <div class="container pt-30 pb-30">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="title">Video Gallery</h2>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="#">Home</a></li>
                <li class="active text-theme-colored">Video Gallery</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

   <section class="vdo-gall">
      <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <!-- Portfolio Filter -->
              <div class="portfolio-filter">

                 <?php 

                foreach($category_list as $key=>$cat) {

                  // print_r($key);

                 ?>
                <a href="#design" class="" data-filter=".<?php echo $cat->video_category_id; ?>"><?php echo $cat->video_category; ?></a>

              <?php }  ?>


              <a href="#" class="active" data-filter="*">All</a>


                <!-- <a href="#" class="active" data-filter="*">All</a>
                <a href="#branding" class="" data-filter=".branding">Tab1</a>
                <a href="#design" class="" data-filter=".design">Tab2</a>
                <a href="#photography" class="" data-filter=".photography">Tab3</a> -->
              </div>
              <!-- End Portfolio Filter -->
            
              <!-- Portfolio Gallery Grid -->
              <div id="grid" class="gallery-isotope default-animation-effect grid-4 gutter clearfix">
                <!-- Portfolio Item Start -->


                        <?php

                foreach($category_list as $img) 
                {
                     

               

                $image_gallery = $this->common->select($table_name='tbl_video_gallery',$field=array(), $where=array('video_category_id'=>$img->video_category_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
 
                foreach($image_gallery as $main_img)

                { 

                  ?>

               <div class="gallery-item <?php echo $main_img->video_category_id; ?>">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?php echo base_url();?>assets/upload/gallery_image/<?php echo $main_img->video_gallery_image; ?>" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                      <a class="popup-youtube" href="<?php echo $main_img->video_gallery_link; ?>"><i class="fa fa-youtube-play"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            

            <?php
                }


                 ?>


            

              <?php } ?>


              <!--   <div class="gallery-item photography">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?php echo base_url();?>assets/images/gallery/1.jpg" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a class="popup-youtube" href="https://www.youtube.com/watch?v=kXDL1q2LCos"><i class="fa fa-youtube-play"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- Portfolio Item End -->
                
                <!-- Portfolio Item Start -->
             <!--    <div class="gallery-item branding">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?php echo base_url();?>assets/images/gallery/2.jpg" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a class="popup-youtube" href="https://www.youtube.com/watch?v=kXDL1q2LCos"><i class="fa fa-youtube-play"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- Portfolio Item End -->

                <!-- Portfolio Item Start -->
            <!--     <div class="gallery-item design">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?php echo base_url();?>assets/images/gallery/3.jpg" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a class="popup-youtube" href="https://www.youtube.com/watch?v=kXDL1q2LCos"><i class="fa fa-youtube-play"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- Portfolio Item End -->

                <!-- Portfolio Item Start -->
           <!--      <div class="gallery-item photography">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?php echo base_url();?>assets/images/gallery/4.jpg" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a class="popup-youtube" href="https://www.youtube.com/watch?v=kXDL1q2LCos"><i class="fa fa-youtube-play"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- Portfolio Item End -->

                <!-- Portfolio Item Start -->
             <!--    <div class="gallery-item branding">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?php echo base_url();?>assets/images/gallery/5.jpg" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a class="popup-youtube" href="https://www.youtube.com/watch?v=kXDL1q2LCos"><i class="fa fa-youtube-play"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- Portfolio Item End -->

                <!-- Portfolio Item Start -->
          <!--       <div class="gallery-item design">
                  <div class="thumb">
          <img class="img-fullwidth" src="<?php echo base_url();?>assets/images/gallery/6.jpg" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a class="popup-youtube" href="https://www.youtube.com/watch?v=kXDL1q2LCos"><i class="fa fa-youtube-play"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- Portfolio Item End -->

                <!-- Portfolio Item Start -->
            <!--     <div class="gallery-item photography">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?php echo base_url();?>assets/images/gallery/1.jpg" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a class="popup-youtube" href="https://www.youtube.com/watch?v=kXDL1q2LCos"><i class="fa fa-youtube-play"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- Portfolio Item End -->

                <!-- Portfolio Item Start -->
            <!--     <div class="gallery-item design">
                  <div class="thumb">
          <img class="img-fullwidth" src="<?php echo base_url();?>assets/images/gallery/7.jpg" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a class="popup-youtube" href="https://www.youtube.com/watch?v=kXDL1q2LCos"><i class="fa fa-youtube-play"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- Portfolio Item End -->
                
                
              </div>
              <!-- End Portfolio Gallery Grid -->

            </div>
          </div>
        </div>
      </div>
    </section>