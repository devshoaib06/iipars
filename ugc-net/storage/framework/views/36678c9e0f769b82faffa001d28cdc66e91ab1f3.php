<?php $__env->startPush('page_meta'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<?php $__env->stopPush(); ?>
<section class="mainheader">
    <div class="container">
        <div class="d-flex align-item p-rel">
        <a href="#"  class="menu-btn"><i class="fa fa-bars" aria-hidden="true"></i></a>
            <div class="logo"><a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('public/frontend/images/logo.png')); ?>" title="Teachinns"  alt="India’s no.1 online study material for UGC & CSIR NTA NET/SET/JRF"/></a>
        </div>
        
        <?php if( isset($exams) ): ?>
            
            
            <div class="course">
                <a href="#"><i class="fa fa-th" aria-hidden="true"></i>&nbsp;Courses</a>

                <div class="menulist">

                    <ul>
                        <?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <li>
                                <a href="#"><?php echo e($exam->exam_name); ?></a>
                                <?php if($exam->id==1): ?>
                                    <?php 
                                        $myLibrary=new \App\library\myFunctions;
                                        $allSubjects=$myLibrary->getExamSubject($exam->id);
                                    
                                    ?>
                                    <ul>
                                        <?php if($exam->id==1): ?>
                                        <!-- <li>
                                            <h4>All Pack</h4></li> -->
                                        
                                        <li><a href="#">Combo Pack</a>
                                           <?php if( isset($combo_pack_products) && count($combo_pack_products) > 0): ?>
                                            <ul class="o-flow-y h-350 w-350">
                                                <!-- <li>
                                                    <h4>All Combo Courses</h4></li> -->
                                                    
                                                <?php $__currentLoopData = $combo_pack_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $combo_pack_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <a href="<?php echo e(route('front.corsCont',['exam'=>Str::slug( $exam->exam_name, '-'),'slug'=>$combo_pack_product->slug])); ?>">
                                                            <?php echo e($combo_pack_product->name); ?>

                                                        </a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                               
                                                
                                            </ul>
                                            <?php endif; ?> 
                                        </li>
                                        <li><a href="#">Individual Pack</a>
                                        <?php endif; ?> 
                                          <?php if( isset($allSubjects) && count($allSubjects) > 0): ?>
                                            <ul>
                                                <!-- <li>
                                                    <h4>Subjects</h4></li> -->
                                                <?php $__currentLoopData = $allSubjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php 
                                                        $allCourses=[];
                                                        $allCourses=$myLibrary->getCourseExamSubject($exam->id,$subject->id);
                                                    ?>
                                                    <li>
                                                        <a href="#"><?php echo e($subject->subject_name); ?></a>
                                                        <?php if(count($allCourses)>0): ?>
                                                        <ul>
                                                            <?php $__currentLoopData = $allCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allCourse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><a href="<?php echo e(route('front.corsCont',['exam'=>Str::slug( $exam->exam_name, '-'),'slug'=>$allCourse->slug])); ?>"><?php echo e($allCourse->name); ?></a></li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                        <?php endif; ?>
                                                    </li>
                                                    
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                               
                                            </ul>
                                           <?php endif; ?>
                                        </li>
                                        
                                       
                                    </ul>
                                <?php else: ?>
                                <?php 
                                    $myLibrary=new \App\library\myFunctions;
                                    $allSubjects=[];
                                    $allSubjects=$myLibrary->getExamSubject($exam->id);
                                    
                                ?>
                                        <!-- <li>
                                            <h4>Subjects</h4></li> -->
                                        <?php if(count($allSubjects)>0): ?>       
                                        <ul>
                                        <?php $__currentLoopData = $allSubjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php 
                                            $allCourses=$myLibrary->getCourseExamSubject($exam->id,$subject->id);
                                        ?>
                                        <li>
                                            <a href="#"><?php echo e($subject->subject_name); ?></a>
                                            <?php if(isset($allCourses) && count($allCourses)>0): ?>
                                            <ul>
                                                <?php $__currentLoopData = $allCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allCourse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                 <li><a href="<?php echo e(route('front.corsCont',['exam'=>Str::slug( $exam->exam_name, '-'),'slug'=>$allCourse->slug])); ?>"><?php echo e($allCourse->name); ?></a></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                            <?php endif; ?>
                                        </li>
                                            
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                        </ul>
                                        <?php endif; ?>
                                    
                                <?php endif; ?>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(url('/ugc-net-syllabus-pdf-free-download')); ?>">UGC-NET Syllabus PDF Free Download</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('/csir-net-syllabus-free-download')); ?>">CSIR-NET Syllabus Free Download</a>
                        </li>
                    </ul>

                </div>

            </div>
        <?php endif; ?>
            <?php 
                $segment1 =  Request::segment(1);  
                $segment2 =  Request::segment(2);  
            ?> 
            <div class="rightmenu">
                <ul>
                    <li <?php if($segment1 == 'about-us'): ?> <?php endif; ?>><a href="<?php echo e(url('/about-us')); ?>">About Us</a></li>
                    <li <?php if($segment1 == 'why-us'): ?> <?php endif; ?>><a href="<?php echo e(url('/why-us')); ?>">Why Us</a></li>
                    
                    <li <?php if($segment1 == 'articles'): ?> <?php endif; ?>>
                        <a href="<?php echo e(route('articles',['category'=>'current-affairs'])); ?>">Current Affairs</a>
                        
                        
                    </li>
                    <li><a href="<?php echo e(route('contributorlogin')); ?>">Contributor</a></li>
                    <li><a href="<?php echo e(route('resellerlogin')); ?>">Reseller</a></li>
                    
                    <li class="<?php echo e($segment1 == 'contact-us'?'active':''); ?>"><a href="<?php echo e(url('/contact-us')); ?>">Contact Us</a></li>
                </ul>

            </div>

            <div class="rightbutton log-btn">
                
                <?php if(auth()->guard()->check()): ?>
                <div class="dropdown">
                    <a href="#" class="login dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" style="text-transform:capitalize;">
                        <?php echo e(Auth::user()->name); ?>

                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" style="margin-top:27px;">
                        <?php if(Auth::user()->user_type_id==2): ?>
                        <li>
                        <a href="<?php echo e(route('dashboard')); ?>" class="page-unload-prevent">
                                <i class="fa fa-user"></i> My Dashboard </a>
                        </li>
                        <?php elseif(Auth::user()->user_type_id==3): ?>
                        <li>
                        <a href="<?php echo e(route('contributordashboard')); ?>" class="page-unload-prevent">
                                <i class="fa fa-user"></i> My Dashboard </a>
                        </li>
                        <?php elseif(Auth::user()->user_type_id==4): ?>
                        <li>
                        <a href="<?php echo e(route('resellerdashboard')); ?>" class="page-unload-prevent">
                                <i class="fa fa-user"></i> My Dashboard </a>
                        </li>
                        <?php endif; ?>
                        <li class="divider"> </li>
                        <li>
                            <a href="<?php echo e(route('frontendlogout')); ?>" class="page-unload-prevent">
                                <i class="fa fa-lock"></i> Log Out </a>
                        </li>
                    </ul>
                </div>
                <?php endif; ?>
               <?php if(auth()->guard()->guest()): ?>
               <?php 
                   $restricted_url=array('contributor','reset-password'); 
               ?>
               <?php if(!in_array($segment1,$restricted_url)): ?>            
                <a href="#" class="login" data-toggle="modal" data-target=".login-modal">login</a>
                
               <?php endif; ?> 
               <?php endif; ?> 
                
                <div class="clearfix"></div>
            </div>
            
            
    
            <div class="clearfix"></div>
            </div>
    </div>
    <?php if(count($newsfeed)>0): ?>
    <div class="container">
        <div class="row">    
            <div class="col-sm-12 col-md-12">
                <div class="announceCont">
                    <div class="announceHead">
                        <h4>News Feed:</h4>
                    </div>
                    <div id="newsTicker" class="accounceBox ticker">
                        <ul>
                            <?php $__currentLoopData = $newsfeed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                            <li><?php echo html_entity_decode($new->newsfeed); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php endif; ?>
 </section>


 <div class="site-overlay"><span class="crossmenu"><img src="<?php echo e(asset('public/frontend/images/crossicon.png')); ?>"  alt="Cross"/></span></div>




 <!-- Modal -->




  <?php /**PATH /home/teachinns/public_html/resources/views/frontend/includes/header_menu_bar.blade.php ENDPATH**/ ?>