<?php echo $__env->make('frontend.structure.page_meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('page_content'); ?>
<?php 
    $count=1;   
    $myLibrary=new \App\library\myFunctions();
    $protocol = $myLibrary->getYoutubeProtocol(); 
    $exam= $myLibrary->getExamName($content_info[0]['exam_id']);
?>

<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                <li>Dashboard</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?php echo $__env->make('frontend.includes.student_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="col-sm-12">
                    <div class="tabCont">
                    <h1><?php echo e($exam); ?> <span class="text-secondary">Enrollment expires on : <?php echo e(\Carbon\Carbon::parse($course->end_date)->format('d/m/Y')); ?> </span></h1>
                        
                        <div class="panel-group dashboard" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php if(count($pending_tests)>0): ?>
                            <div class="panel panel-default">

                                <div class="panel-heading" role="tab" id="heading-">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-" aria-expanded="true" aria-controls="collapse-">
                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                            Previous Pending Exam
                                            
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse-" class="panel-collapse collapse <?php echo e($count==1?'in':''); ?>" role="tabpanel" aria-labelledby="heading-">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                    <h4 style="padding-bottom: 10px">Test Name</h4>
                                                
                                            </div>
                                            <div class="col-sm-2">

                                                <h4> Date & Time </h4>
                                            </div>
                                            <div class="col-sm-2">

                                                <h4> Subject</h4>
                                            </div>
                                            
                                            
                                        </div>
                                        <?php $__empty_1 = true; $__currentLoopData = $pending_tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pending_test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        
                                            <div class="row">
                                                <div class="pdf-section">
                                                                        
                                                    <div class="content_exists">
                                                    
                                                    
                                                <div class="col-sm-5">
        
                                                    <span><?php echo e($pending_test->test_name); ?></span>
                                                </div>
                                                <div class="col-sm-2">
        
                    
                                                <span><?php echo e(\Carbon\Carbon::parse($pending_test->start_datetime)->format('d/m/Y H:i')); ?></span>
                                                </div>
                                                <div class="col-sm-2">
        
                                                    <span><?php echo e($pending_test->subject->subject_name); ?></span>
                                                </div>
                                                <div class="col-sm-2 text-right">
                                                    <form action="<?php echo e(route('startPaidExam',['mock_test_id'=>\Hasher::encode($pending_test->id)])); ?>" method="POST" >
                                                        <?php echo csrf_field(); ?>
                                                        
                                                    
                                                        <span class="downloadbut">
                                                            <input type="submit" value="Resume Test">
                                                        </span>
                                                    </form>    
                                                </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            
                                        <?php endif; ?>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>    
                        <?php if( isset($content_info) && count($content_info) > 0): ?>
                            <?php 
                                $count=1;
                            ?>
                            <?php $__currentLoopData = $content_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cinfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <?php
                                        $related_papers=$cinfo['paper_id'];
                                        $paper_name= $myLibrary->getPaperName($cinfo['paper_id']);
                                        
                                    ?>
                                    <div class="panel panel-default">
                                        
                                        <div class="panel-heading" role="tab" id="heading-">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo e($cinfo['paper_id']); ?>" aria-expanded="true" aria-controls="collapse-<?php echo e($cinfo['paper_id']); ?>">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    <?php echo e($paper_name); ?>

                                                    
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse-<?php echo e($cinfo['paper_id']); ?>" class="panel-collapse collapse <?php echo e($count==1?'in':''); ?>" role="tabpanel" aria-labelledby="heading-<?php echo e($cinfo['paper_id']); ?>">
                                            <div class="panel-body">
                                                <?php $__empty_1 = true; $__currentLoopData = $cinfo['subject_id']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <?php
                                                    $subject_name= $myLibrary->getSubjectName($subject);
                                                    $tempcount=0;
                                                ?>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                                <h4 style="padding-bottom: 10px"><?php echo e($subject_name); ?></h4>
                                                            
                                                        </div>
                                                        <div class="col-sm-3">
    
                                                            <h4> Level</h4>
                                                        </div>
                                                        <div class="col-sm-2">
    
                                                            <h4> Duration</h4>
                                                        </div>
                                                        <div class="col-sm-2">
    
                                                            <h4> No. of Questions</h4>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <?php $__empty_2 = true; $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                                        <?php
                                                            $template_details=$template->templateDetails;
                                                            $level=$level_id=[];
                                                            $noofQuestion=0;
                                                            foreach($template_details as $template_detail){
                                                                $level_id[]=$template_detail->level_id;
                                                                $level[]= $template_detail->level->name;
                                                                $noofQuestion=$noofQuestion+$template_detail->number_of_questions;
                                                            }
                                                            $params=[
                                                                'level_id'=>$level_id,
                                                                'subject_id'=>$subject,
                                                                'exam_id'=>$cinfo['exam_id'],
                                                                'paper_id'=>$cinfo['paper_id']
                                                                
                                                            ];
                                                            $hasQuestion=$myLibrary->checkHasQuestion($params);  
                                                            // echo $hasQuestion;
                                                        ?>
                                                        <?php if($hasQuestion>1): ?>
                                                            <div class="">
                                                                    <div class="pdf-section">
                                                                        
                                                                        <div class="content_exists">
                                                                            <div class="row">
                                                                            <div class="col-sm-3">
                
                                                                            <a href="#"><?php echo e($template->name); ?></a> 
                                                                            </div>
                                                                            <div class="col-sm-3">
                
                                                                            <a href="#"><?php echo e(implode(', ',$level)); ?></a> 
                                                                            </div>
                                                                            <div class="col-sm-2">
    
                                                                            <span> 
                                                                                <?php
                                                                                    $duration=$template->duration;
                                                                                    $minutes=($duration % 60).' Min';
                                                                                    $hours= intdiv($duration, 60).' Hrs ';
                                                                                    if($minutes>0){
                                                                                        $hours.=$minutes;
                                                                                    }
                                                                                ?>    
                                                                                <?php echo e($hours); ?>

                                                                            </span>
                                                                            </div>
                                                                            <div class="col-sm-2">
                
                                                                            <span><?php echo e($noofQuestion); ?></span>
                                                                            </div>
                                                                        
                                                                            <div class="col-sm-2 text-right">
                                                                            <form action="<?php echo e(route('showInstructions')); ?>" method="POST" >
                                                                                <?php echo csrf_field(); ?>
                                                                                <input type="hidden" name="course_id" value="<?php echo e($course->product_id); ?>" >
                                                                                <input type="hidden" name="paper_id" value="<?php echo e($cinfo['paper_id']); ?>" >
                                                                                <input type="hidden" name="exam_id" value="<?php echo e($cinfo['exam_id']); ?>" >
                                                                                <input type="hidden" name="subject_id" value="<?php echo e($subject); ?>" >
                                                                                <input type="hidden" name="template_id" value="<?php echo e($template->id); ?>" >
                                                                            
                                                                            
                                                                                <span class="downloadbut">
                                                                                    <input type="submit" value="Start Test">
                                                                                </span>
                                                                            </form>    
                                                                        </div>
                                                                        </div>
            
                                                                        </div>
                                                                        
                                                                        
                                                                    </div>
                                                                </div>
                                                            
                                                        <?php else: ?>
                                                            
                                                        <?php endif; ?>    
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                                            
                                                        <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    
                                                <?php endif; ?>
                                                
                                                
                                            </div>
                                        </div>
                                        
                                    </div>    
                                    <?php 
                                    $count++;
                                    ?> 
                                   
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <p>No course available.</p>
                        <?php endif; ?>
                        </div><!-- panel-group -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_js'); ?>
<script>
  $(document).ready(function(){

    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
    $('.collapse.in').each(function(){
		$(this).parent().find(".glyphicon").removeClass("glyphicon-plus").addClass("glyphicon-minus");
	});
  	
	$('.collapse').on('shown.bs.collapse', function(){
		$(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
	}).on('hidden.bs.collapse', function(){
		$(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
	});  
  })  
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/student/mocktest.blade.php ENDPATH**/ ?>