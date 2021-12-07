<?php echo $__env->make('frontend.structure.page_meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('page_content'); ?>

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
                        <h1>Dashboard</h1>
                       
                        <div class="panel-group dashboard" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php if( isset($purchasedcourses) && count($purchasedcourses) > 0): ?>
                            <?php 
                                $count=1;   
                                $myLibrary=new \App\library\myFunctions();
                                $protocol = $myLibrary->getYoutubeProtocol(); 
                            ?>
                            <?php $__currentLoopData = $purchasedcourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                    
                                
                                    <?php 
                                        $related_materials=$myLibrary->getRelatedMaterial($course->product_id);
                                        $related_materials_info=$myLibrary->getMaterialInfo($course->product_id);
                                        // echo "<pre>";
                                        //     print_r($related_materials_info[4]);
                                        // echo "</pre>";
                                        
                                    ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="heading-<?php echo e($course->tech_order_id); ?>">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo e($course->tech_order_id); ?>" aria-expanded="true" aria-controls="collapse-<?php echo e($course->tech_order_id); ?>">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    <?php echo e($course->product_name); ?>

                                                    <span class="text-primary">Enrollment expires on : <?php echo e(\Carbon\Carbon::parse($course->end_date)->format('d/m/Y')); ?> </span>
                                                </a>
                                            </h4>
                                        </div>
                                    <div id="collapse-<?php echo e($course->tech_order_id); ?>" class="panel-collapse collapse <?php echo e($count==1?'in':''); ?>" role="tabpanel" aria-labelledby="heading-<?php echo e($course->tech_order_id); ?>">
                                            <div class="panel-body">
                                                <ul class="nav nav-tabs">
                                                    <?php $material_count=[];$count_material=0;
                                                    $activecount=1;
                                                  
                                                    ?>
                                                    
                                                    
                                                    <li class="active">
                                                        <h4 style="padding-bottom: 10px">Study Materials</h4>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <?php $activecount=1;?>
                                                    <?php $__currentLoopData = $related_materials_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related_material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php 
                                                            $subject_name=$myLibrary->getSubjectName($related_material['subject_id']);
                                                            $paper_name=$myLibrary->getPaperName($related_material['paper_id']);
                                                            $material_name=$myLibrary->getMaterialName($related_material['material_id']);
                                                            $course_data=$myLibrary->getRelatedMaterialContent($related_material);
                                                            $countvideo=$countpdf=0;

                                                           
                                                           
                                                            foreach ($course_data as $cdata){
                                                                if($cdata->media_type=='video'){
                                                                    $countvideo=1;
                                                                }
                                                                if($cdata->media_type=='pdf'){
                                                                    $countpdf=1;
                                                                }
                                                            }
                                                            
                                                            
                                                        ?>
                                                        
                                                        
                                                                    <?php 
                                                                    $count_pdf=1;
                                                                   // echo $material_name;
                                                                    ?>
                                                                <?php $__currentLoopData = $course_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                                    <?php if($count_pdf && $cdata->media_type=='pdf'): ?>
                                                                        <div class="">
                                                                            <div class="pdf-section">
                                                                                <?php if($cdata->media_type=='pdf'): ?>
                                                                                <div class="content_exists">
                                                                                    <div class="row">
                                                                                    <div class="col-sm-7">
                        
                                                                                        <a href="<?php echo e(route('downloadContent',['media_id'=>$cdata->media_id])); ?>"><?php echo e($cdata->value); ?></a> 
                                                                                    </div>
                                                                                    <div class="col-sm-5 text-right">
                                                                                    <span class="downloadbut">
                                                                                        <a href="<?php echo e(route('downloadContent',['media_id'=>$cdata->media_id])); ?>"><i class="fa fa-file"></i> Download</a>
                                                                                    </span>
                                                                                </div>
                                                                                </div>
                    
                                                                                </div>
                                                                                
                                                                                <?php $count_pdf++; ?>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <?php if($countvideo): ?>
                                                                        <?php if($cdata->media_type=='video'): ?>
                                                                        <div class="col-sm-6 video-section">
                                                                            <?php $count_video=0;?>
                                                                                <?php  
                                                                                    
                                                                                    
                                                                                $video_embed_link=$myLibrary->parseYouTubeUrl($cdata->value);?>
                                                                                
                                                                                <div class="content_exists">
                                                                                    <iframe width="100%" height="300px" src="<?php echo e($protocol); ?>://www.youtube.com/embed/<?php echo e($video_embed_link); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                                                
                                                                                </div>
                                                                                <?php $count_video++; ?>
                                                                                <h4 class="video_label"><?php echo e($cdata->title); ?></h4>

                                                                        </div>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                    <?php 
                                                                        $activecount++;
                                                                    
                                                                    ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                     <?php
                                                                         
                                                                         $mocktestcount=0;
                                                                     ?>   
                                                                    <?php if($related_material['material_id']==14 && $mocktestcount==0): ?>
                                                                    <div class="pdf-section stest">

                                                                        <div class="content_exists">
                                                                            <div class="row">
                                                                            <div class="col-sm-7">
                
                                                                                <a href="#"><?php echo e($material_name); ?></a> 
                                                                            </div>
                                                                            <div class="col-sm-5 text-right">
                                                                            <span class="downloadbut">
                                                                                <a href="<?php echo e(route('studentMocktest',['course_id'=>Hasher::encode($course->product_id)])); ?>" style="
                                                                                    width: 20%;
                                                                                    text-align: center;
                                                                                "><i class="fa fa-play"></i> Start</a>
                                                                            </span>
                                                                        </div>
                                                                        </div>
            
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                        $mocktestcount++;
                                                                    ?>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                               
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                    $count++  
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
<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/dashboard.blade.php ENDPATH**/ ?>