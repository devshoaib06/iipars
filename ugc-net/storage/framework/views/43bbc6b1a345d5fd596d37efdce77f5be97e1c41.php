<?php if( isset($exams) ): ?>
<?php 
$segment1 =  Request::segment(1);  
?>
<div class="responsivepusi">
    <nav class="pushy pushy-left" data-focus="#first-link">
        <div class="pushy-content">
            <h3>Our Courses</h3>
            <div id="content" >
                <div class="u-vmenu">
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
            <h3>Main Menu</h3>
            <div id="content" >
                <div class="u-vmenu">
                    <ul>
                        <li <?php if($segment1 == 'about-us'): ?> <?php endif; ?>><a href="<?php echo e(url('/about-us')); ?>">About Us</a></li>
                        <li <?php if($segment1 == 'why-us'): ?> <?php endif; ?>><a href="<?php echo e(url('/why-us')); ?>">Why Us</a></li>
                        
                        <li <?php if($segment1 == 'articles'): ?> <?php endif; ?>>
                            <a href="<?php echo e(route('articles',['category'=>'current-affairs'])); ?>">Current Affairs</a>
                            
                            
                        </li>
                        <li><a href="<?php echo e(route('contributorlogin')); ?>">Contributor</a></li>
                        <li><a href="<?php echo e(route('resellerlogin')); ?>">Reseller</a></li>
                        <li>
                            <?php if(auth()->guard()->check()): ?>
                                <a href="<?php echo e(route('showInstruction')); ?>">Mock Test</a>
                                
                            <?php endif; ?>
                            <?php if(auth()->guard()->guest()): ?>
                                <a href="#" class="mock-test-login" data-toggle="modal" data-target=".login-modal">Mock Test</a>
                            <?php endif; ?>
                        </li>
                        <li class="<?php echo e($segment1 == 'contact-us'?'active':''); ?>"><a href="<?php echo e(url('/contact-us')); ?>">Contact Us</a></li>

                    </ul>
                </div>
            </div>        
        </div>
    </nav>
</div>
<?php endif; ?>

 <section class="topsection"><img alt="New" src="/public/frontend/images/newicon.gif" style="height:14px; width:30px"> Visit <a href="https://iipars.com/">www.iipars.com</a> for Research Activities & Information about 22 Academic and Job-Oriented Services.
    <a href="#" class="cross crossbar"><i class="fa fa-times" aria-hidden="true"></i></a>
 </section>
 <section class="top-contact-mb">
     <ul>
        <li><a href="mailto:<?php echo e(trim(getSettings('enquiry_email'))); ?>"><i aria-hidden="true" class="fa fa-lg fa-envelope-o"></i></a></li>
        <li><a href="tel:<?php echo e(trim(getSettings('phone'))); ?>"><i aria-hidden="true" class="fa fa-lg fa-mobile"></i></a></li>
        <li><a href="https://web.whatsapp.com/send?phone=7478071704&amp;text=Hi, I am interested in one of your courses. Reply me back to help me with further enquiry." target="_blank" class="whatsapp-blink"><img src="<?php echo e(asset('public/frontend/images/whatsapp-M.png')); ?>" alt="Whatsapp" style="height: 16px"></a></li>
        <li><a href="#" class="link-img"><img src="<?php echo e(asset('public/frontend/images/play-store-icon.png')); ?>" style="height: 16px"></a></li>
    </ul>
</section>
 <section class="top-contact">
    <div class="container">
     <span><i aria-hidden="true" class="fa fa-lg fa-envelope-o"></i>&nbsp;<a href="mailto:<?php echo e(trim(getSettings('enquiry_email'))); ?>"><?php echo e(trim(getSettings('enquiry_email'))); ?></a></span>
     &nbsp;&nbsp;&nbsp;
     <span><i aria-hidden="true" class="fa fa-lg fa-mobile"></i>&nbsp;
        <a href="tel:<?php echo e(trim(getSettings('phone'))); ?>"><?php echo e(trim(getSettings('phone'))); ?></a> 
        <?php if(trim(getSettings('phone-2'))): ?>
        / 
        <a href="tel:<?php echo e(trim(getSettings('phone-2'))); ?>"><?php echo e(trim(getSettings('phone-2'))); ?></a>
        <?php endif; ?>
    </span>
     &nbsp;&nbsp;&nbsp;
     <span><a href="https://web.whatsapp.com/send?phone=7478071704&amp;text=Hi, I am interested in one of your courses. Reply me back to help me with further enquiry." target="_blank" class="whatsapp-blink link-img"><img src="<?php echo e(asset('public/frontend/images/whatsapp-M.png')); ?>" alt="Whatsapp" style="height: 16px">WhatsApp</a></span>&nbsp;&nbsp;&nbsp;
     <span><a href="https://play.google.com/store/apps/details?id=com.edu.teachinns" class="link-img"><img src="<?php echo e(asset('public/frontend/images/play-store-icon.png')); ?>" style="height: 16px"> Download Android App</a></span>
     </div>
 </section><?php /**PATH /var/www/html/teachins/resources/views/frontend/includes/top_header_bar.blade.php ENDPATH**/ ?>