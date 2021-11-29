<!-- Footer -->
  <footer id="footer" class="footer bg-black-111">
    <div class="container">
      <div class="row border-bottom-black">
		<div class="col-sm-6 col-md-3">
          <div class="widget dark">
            <h5 class="widget-title line-bottom">Legal Links</h5>
            <ul class="list-border">
              <li><a href="<?php  echo $this->url->link(16);?>">Privacy Policy</a></li>
              <li><a href="<?php  echo $this->url->link(17);?>">Terms & Conditions</a></li>
            </ul>
          </div>
		  <div class="widget dark">
            <h5 class="widget-title mb-10">Connect With Us</h5>
            <ul class="styled-icons icon-dark mt-20">

            	<?php 

            	$social= $this->common->select($table_name='tbl_social_link',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

            	 ?>


              <li class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".1s" data-wow-offset="10"><a href="https://www.facebook.com/iipars_ugcnet/" data-bg-color="#3B5998"><i class="fa fa-facebook"></i></a></li>
              <li class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".2s" data-wow-offset="10"><a href="<?php echo @$social[0]->twitter_link; ?>" data-bg-color="#02B0E8"><i class="fa fa-twitter"></i></a></li>
              <li class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".3s" data-wow-offset="10"><a href="<?php echo @$social[0]->instagram_link; ?>" data-bg-color="#05A7E3"><i class="fa fa-skype"></i></a></li>
              <li class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".4s" data-wow-offset="10"><a href="<?php echo @$social[0]->googleplus_link; ?>" data-bg-color="#A11312"><i class="fa fa-google-plus"></i></a></li>
              <li class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".5s" data-wow-offset="10"><a href="<?php echo @$social[0]->youtube_link; ?>" data-bg-color="#C22E2A"><i class="fa fa-youtube"></i></a></li>
            </ul>
          </div>
        </div>
        
        <!-- <div class="col-sm-6 col-md-3">
          <div class="widget dark">
            <h5 class="widget-title line-bottom">Latest News</h5>
            <div class="latest-posts">
              <article class="post media-post clearfix pb-0 mb-10">
                <a href="blog-single-right-sidebar.html" class="post-thumb"><img alt="" src="images/banner/bann01.jpg"></a>
                <div class="post-right">
                  <h5 class="post-title mt-0 mb-5"><a href="blog-single-right-sidebar.html">Sustainable Construction</a></h5>
                  <p class="post-date mb-0 font-12">Mar 08, 2015</p>
                </div>
              </article>
              <article class="post media-post clearfix pb-0 mb-10">
                <a href="blog-single-right-sidebar.html" class="post-thumb"><img alt="" src="images/banner/bann02.jpg"></a>
                <div class="post-right">
                  <h5 class="post-title mt-0 mb-5"><a href="blog-single-right-sidebar.html">Industrial Coatings</a></h5>
                  <p class="post-date mb-0 font-12">Mar 08, 2015</p>
                </div>
              </article>
              <article class="post media-post clearfix pb-0 mb-10">
                <a href="blog-single-right-sidebar.html" class="post-thumb"><img alt="" src="images/banner/bann03.jpg"></a>
                <div class="post-right">
                  <h5 class="post-title mt-0 mb-5"><a href="blog-single-right-sidebar.html">Storefront Installations</a></h5>
                  <p class="post-date mb-0 font-12">Mar 08, 2015</p>
                </div>
              </article>
            </div>
          </div>
        </div> -->
        <div class="col-sm-6 col-md-3">
          <div class="widget dark">
            <h5 class="widget-title line-bottom">Important Links</h5>
            <ul class="list-border">
              <li><a href="#">Upcoming Courses</a></li>
              <li><a href="<?php echo base_url(); ?>manage_ebook">Invitation for E-Book</a></li>
			  <li><a href="<?php  echo $this->url->link(14);?>">Plan</a></li>
            </ul>
          </div>
        </div>
		<div class="col-sm-6 col-md-3">
          <div class="widget dark">
            <h5 class="widget-title line-bottom">News</h5>
            <ul class="list-border">
              <li><a href="#">Upcoming Courses</a></li>
              <li><a href="<?php echo base_url(); ?>manage_ebook">Invitation for E-Book</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="widget dark">
            <!-- <img class="mt-10 mb-20" alt="index.html" src="images/new-aeducation-logo.png"> -->
			<h5 class="widget-title line-bottom">Contact Us</h5>
            <ul class="list-inline mt-5">

            	<?php 

            	$contact=  $this->common_model->common($table_name = 'tbl_contact', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

            	 ?>
              <!-- <li class="m-0 pl-10 pr-10"> <i class="fa fa-map-marker text-theme-colored2 mr-5"></i> <a class="text-gray" href="#">Unit 201, 2nd Floor, Mondal House, Biswa Bangla Sarani, Noapara, Rajarhat Newtown, Kolkata, West Bengal 700157</a> </li> -->
              <!-- <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-theme-colored2 mr-5"></i> <a class="text-gray" href="#">8371093927/ 8918153945</a> </li> -->
              <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-colored2 mr-5"></i> <a class="text-gray" href="#"><?php echo @$contact[0]->primary_email; ?></a> </li>

             <br>
              
               <?php 

               $counter = $this->common_model->common($table_name = 'tbl_no_of_visitor', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


                ?>
              
               <!-- <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-colored2 mr-5"></i> <a class="text-gray" href="#"><?php echo @$counter[0]->count; ?></a> </li> -->
               <li class="number_of_view_cls"><span class="number_of_view">No. of Visitor:<?php echo @$counter[0]->count; ?></span></li>

            </ul>
          </div>
          
        </div>
      </div>
    </div>
    <div class="footer-bottom bg-black-222">
      <div class="container pt-10 pb-10 pb-0">
        <div class="row">
          <div class="col-md-7 sm-text-center text-white">
            <p class="font-13 m-0">Copyright &copy;<?php echo date('Y'); ?> International Institute For Providing Academic And Research Supports. All Rights Reserved</p>
          </div>
          <div class="col-md-5 text-right flip sm-text-center text-white">
            <div class="widget no-border m-0 company-link">
              Design By: <a rel="nofollow" href="https://www.exprolab.com/" traget="_blank" rel="">Expro Lab</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
</div>
<!-- end wrapper -->



<!-- external javascripts -->
<script src="<?php echo base_url();?>assets/js/jquery-2.2.4.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<!-- JS | jquery plugin collection for this theme -->
<script src="<?php echo base_url();?>assets/js/jquery-plugin-collection.js"></script>

<!-- Revolution Slider 5.x SCRIPTS -->
<script src="<?php echo base_url();?>assets/js/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo base_url();?>assets/js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>

<!-- END REVOLUTION SLIDER -->
			<script type="text/javascript">
			  var tpj=jQuery;         
			  var revapi34;
			  tpj(document).ready(function() {
				if(tpj("#rev_slider_home").revolution == undefined){
				  revslider_showDoubleJqueryError("#rev_slider_home");
				}else{
				  revapi34 = tpj("#rev_slider_home").show().revolution({
					sliderType:"standard",
					jsFileLocation:"<?php echo base_url();?>assets/js/revolution-slider/js/",
					sliderLayout:"fullwidth",
					dottedOverlay:"none",
					delay:9000,
					navigation: {
					  keyboardNavigation:"on",
					  keyboard_direction: "horizontal",
					  mouseScrollNavigation:"off",
					  onHoverStop:"on",
					  touch:{
						touchenabled:"on",
						swipe_threshold: 75,
						swipe_min_touches: 1,
						swipe_direction: "horizontal",
						drag_block_vertical: false
					  }
					  ,
					  arrows: {
						style:"zeus",
						enable:true,
						hide_onmobile:true,
						hide_under:600,
						hide_onleave:true,
						hide_delay:200,
						hide_delay_mobile:1200,
						tmp:'<div class="tp-title-wrap">    <div class="tp-arr-imgholder"></div> </div>',
						left: {
						  h_align:"left",
						  v_align:"center",
						  h_offset:30,
						  v_offset:0
						},
						right: {
						  h_align:"right",
						  v_align:"center",
						  h_offset:30,
						  v_offset:0
						}
					  },
					  bullets: {
						enable:true,
						hide_onmobile:true,
						hide_under:600,
						style:"metis",
						hide_onleave:true,
						hide_delay:200,
						hide_delay_mobile:1200,
						direction:"horizontal",
						h_align:"center",
						v_align:"bottom",
						h_offset:0,
						v_offset:30,
						space:5,
						tmp:'<span class="tp-bullet-img-wrap"><span class="tp-bullet-image"></span></span>'
					  }
					},
					viewPort: {
					  enable:true,
					  outof:"pause",
					  visible_area:"80%"
					},
					responsiveLevels:[1240,1024,778,480],
					gridwidth:[1240,1024,778,480],
					gridheight:[950,550,500,450],
					lazyType:"none",
					parallax: {
					  type:"scroll",
					  origo:"enterpoint",
					  speed:400,
					  levels:[5,10,15,20,25,30,35,40,45,50],
					},
					shadow:0,
					spinner:"off",
					stopLoop:"off",
					stopAfterLoops:-1,
					stopAtSlide:-1,
					shuffle:"off",
					autoHeight:"off",
					hideThumbsOnMobile:"off",
					hideSliderAtLimit:0,
					hideCaptionAtLimit:0,
					hideAllCaptionAtLilmit:0,
					debugMode:false,
					fallbacks: {
					  simplifyAll:"off",
					  nextSlideOnWindowFocus:"off",
					  disableFocusListener:false,
					}
				  });
				}
			  }); /*ready*/
			</script>
		  <!-- END REVOLUTION SLIDER -->


<!-- Footer Scripts -->
<!-- JS | Custom script for all pages -->
<script src="<?php echo base_url();?>assets/js/custom.js"></script>


<script type="text/javascript" src="<?php echo base_url();?>assets/js/revolution-slider/js/extensions/revolution.extension.actions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/revolution-slider/js/extensions/revolution.extension.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/revolution-slider/js/extensions/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/revolution-slider/js/extensions/revolution.extension.migration.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/revolution-slider/js/extensions/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/revolution-slider/js/extensions/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/revolution-slider/js/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/revolution-slider/js/extensions/revolution.extension.video.min.js"></script>



</body>

</html>



