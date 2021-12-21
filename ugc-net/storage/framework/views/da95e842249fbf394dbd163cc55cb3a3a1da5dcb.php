<?php $__env->startPush('page_meta'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<?php $__env->stopPush(); ?>
<?php
$myfunction = new App\library\myFunctions();
$protocol = $myfunction->getYoutubeProtocol();
// $allCourses=$myfunction->getCourses(1,2);

// echo "<pre>";
//     print_r($allCourses[0]->product);
// echo "</pre>";
?>
<div class="header-nav p_cus_mobile_toggol_menu">
    <div class="header-nav-wrapper navbar-scrolltofixed bg-white">
        <div class="container">
            <nav id="menuzord" class="menuzord red">
                <ul class="menuzord-menu">
                    <li><a href="<?php echo e(config('path.iipars_base_url')); ?>">Home</a></li>
                    <li><a href="<?php echo e(config('path.iipars_base_url')); ?>about">About Us</a></li>
                    <li class="active"><a href="<?php echo e(config('path.iipars_base_url')); ?>ugc-net">UGC - NET</a>
                        <ul class="dropdown" aria-labelledby="dropdownMenu1">
                            <?php echo $__env->make('frontend.includes.header_ugc_menu_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </li>


                </ul>
                </li>
                <li><a href="<?php echo e(config('path.iipars_base_url')); ?>economics">Economics</a></li>
                <li><a href="<?php echo e(config('path.iipars_base_url')); ?>writing_consultancy">Research Paper Publication</a>

                    <ul class="dropdown">

                        <?php 
                        $writing_consultancy_page_detl=$myfunction->writing_consultancy_detl_all();
                        $book_publication_page_detl=$myfunction->book_publication_detl_all();
                        $current_affairs_cat=$myfunction->current_affairs_cat();
                        if(!empty($writing_consultancy_page_detl)){
                            foreach($writing_consultancy_page_detl as $wcpd){
                            ?>
                        <li><a
                                href="<?php echo e(config('path.iipars_base_url')); ?>writing_consultancy/<?php echo $wcpd->slug; ?>"><?php echo $wcpd->title; ?></a>
                        </li>


                        <?php
                            }
                        }?>


                    </ul>
                </li>
                <li><a href="<?php echo e(config('path.iipars_base_url')); ?>book_publications">Book Publication</a>
                    <ul class="dropdown">
                        <?php 
                          if(!empty($book_publication_page_detl)){
                              foreach($book_publication_page_detl as $bppd){
                              ?>
                        <li><a href="<?php echo e(config('path.iipars_base_url')); ?>book_publication/<?php echo $bppd->slug; ?>"><?php echo $bppd->title; ?>
                            </a></li>
                        <?php
                              }
                          }?>
                    </ul>
                </li>

                <li><a href="#">Academic Information</a>

                    <ul class="dropdown">

                        <?php
                      $subjects = $myfunction->getPapersExceptPaperI();
                      if (!empty($subjects)) {
                        foreach ($subjects as $sl) {
                      ?>
                        <li><a href="#"><?php echo $sl->paper_name; ?> </a>

                            <ul class="dropdown">

                                <li><a
                                        href="<?php echo e(config('path.iipars_base_url')); ?>acadamic/<?php echo lcfirst($sl->paper_name); ?>/paper-call">Paper
                                        Call </a></li>
                                <li><a
                                        href="<?php echo e(config('path.iipars_base_url')); ?>acadamic/<?php echo lcfirst($sl->paper_name); ?>/refresher">Refresher
                                        Course </a></li>
                                <li><a
                                        href="<?php echo e(config('path.iipars_base_url')); ?>acadamic/<?php echo lcfirst($sl->paper_name); ?>/orientation">Orientation
                                        Program </a></li>
                                <li><a
                                        href="<?php echo e(config('path.iipars_base_url')); ?>acadamic/<?php echo lcfirst($sl->paper_name); ?>/seminar">Seminar</a>
                                </li>
                                <li><a
                                        href="<?php echo e(config('path.iipars_base_url')); ?>acadamic/<?php echo lcfirst($sl->paper_name); ?>/conference">Conference</a>
                                </li>
                                <li><a
                                        href="<?php echo e(config('path.iipars_base_url')); ?>acadamic/<?php echo lcfirst($sl->paper_name); ?>/phd">Ph.D.
                                        Entrance Test</a></li>
                                <li><a
                                        href="<?php echo e(config('path.iipars_base_url')); ?>acadamic/<?php echo lcfirst($sl->paper_name); ?>/workshop">Workshop</a>
                                </li>
                                <li><a
                                        href="<?php echo e(config('path.iipars_base_url')); ?>acadamic/<?php echo lcfirst($sl->paper_name); ?>/mphil">M.
                                        Phil. Admission</a></li>
                            </ul>
                        </li>
                        <?php
                        }
                      } ?>
                    </ul>



                </li>
                <li><a href="#">Current Affairs </a>

                    <ul class="dropdown">

                        <?php
                      if (!empty($current_affairs_cat)) {
                        foreach ($current_affairs_cat as $cac) {
                      ?>
                        <li><a
                                href="<?php echo e(config('path.iipars_base_url')); ?>current_affairs/<?php echo $cac->slug; ?>"><?php echo $cac->cat_name; ?></a>
                        </li>
                        <?php
                        }
                      }
                      ?>

                    </ul>
                </li>
                <li><a href="#">UGC-NET UPDATE</a>

                    <ul class="dropdown">

                        <?php
                      if (!empty($subjects)) {
                        foreach ($subjects as $sl) {
                      ?>
                        <li><a href="#"><?php echo $sl->paper_name; ?> </a>

                            <ul class="dropdown">

                                <li><a
                                        href="<?php echo e(config('path.iipars_base_url')); ?>ugc-net-update/<?php echo lcfirst($sl->paper_name); ?>/video-links">Video
                                        Link </a></li>
                                <li><a
                                        href="<?php echo e(config('path.iipars_base_url')); ?>ugc-net-update/<?php echo lcfirst($sl->paper_name); ?>/others">Others
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <?php
                        }
                      } ?>
                    </ul>



                </li>
                

                <!--  <li><a href="Manage_ebook/book_list">Our Books</a></li> -->





                <li><a href="#">Gallery</a>
                    <ul class="dropdown">
                        <li><a href="<?php echo e(config('path.iipars_base_url')); ?>Manage_image">Image</a>

                        <li><a href="<?php echo e(config('path.iipars_base_url')); ?>Manage_video">Video</a>
                        </li>
                    </ul>
                </li>

                <!-- <li><a href="#">Blogs</a></li> -->

                <!--  <li ><a href="https://iipars.com/video-gallery">Video Gallery</a></li> -->



                <li><a href="<?php echo e(config('path.iipars_base_url')); ?>contact-us">Contact Us</a></li>

                </ul>

            </nav>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/iipars/ugc-net/resources/views/frontend/includes/header_menu_bar.blade.php ENDPATH**/ ?>