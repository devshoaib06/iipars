<?php echo $__env->make('frontend.structure.page_meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('page_content'); ?>
<?php 
    $myLibrary=new \App\library\myFunctions();
?>
<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                <li>Mock Test Result</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="container">
            
            <div class="row">
                <div class="col-sm-12 col-lg-8 ">
                    <div class="d-flex align-items-center">
                        <div><?php echo e($allquestions->links('frontend.paid-mock-test.result_pagination')); ?></div>
                        <div style="padding-left: 10px">
                            <div class="form-inline">
                                <label ><span>Go to Question </span></label>
                        <select id="pagination" class="selectQuestion form-control">
                            <?php for($i = 1; $i <= $total_questions; $i++): ?>
                                
                            <option value="<?php echo e($i); ?>" <?php echo e($allquestions[0]->question_no==$i?"selected":''); ?>   ><?php echo e($i); ?></option>
                            <?php endfor; ?>
                            
                        </select>
                            </div>
                            
                        </div>
                    </div>
                    <!-- <div class="col-sm-6">
                        <?php echo e($allquestions->links('frontend.paid-mock-test.result_pagination')); ?>

                    </div>
                    <div class="col-sm-6">

                        <label ><span>Go to Question </span></label>
                        <select id="pagination" class="selectQuestion">
                            <?php for($i = 1; $i <= $total_questions; $i++): ?>
                                
                            <option value="<?php echo e($i); ?>" <?php echo e($allquestions[0]->question_no==$i?"selected":''); ?>   ><?php echo e($i); ?></option>
                            <?php endfor; ?>
                            
                        </select>
                    </div> -->
                    
                </div>
                <?php 
                        $q_count=1;
                    ?>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    
                        

                <form>
                    <?php $__empty_1 = true; $__currentLoopData = $allquestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                   <div class="totalquestion">
                              <div class="questionleft">
                                 <div class="questionWrap">
                                     <div class="marksband">
                                        <?php if($question->score>0): ?>
                                        <span class="correctmarks">+<?php echo e($question->score); ?></span>
                                        
                                    <?php else: ?>
                                        <span class="wrongmarks"><?php echo e($question->score?$question->score:0); ?></span>
                                        
                                    <?php endif; ?>    
                                    </div>
                                    <div class="questionband"><?php echo e($question->questionDetails->level->name); ?></div>
                                    <div class="question">
                                        <h1><span><?php echo e($question->question_no); ?>.</span><?php echo $question->questionDetails->questionMaster->question; ?></h1>

                                    </div>
                                    <?php if($question->questionDetails->questionMaster->option_type==0): ?>
                                                            
                                    <?php echo $__env->make('frontend.paid-mock-test.result._none', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        
                                    <?php endif; ?>
                                    <?php if($question->questionDetails->questionMaster->option_type==1): ?>
                                                                
                                    <?php echo $__env->make('frontend.paid-mock-test.result._simple', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                    <?php endif; ?>
                                    <?php if($question->questionDetails->questionMaster->option_type==2): ?>
                                    <?php echo $__env->make('frontend.paid-mock-test.result._conjugate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    
                                    <?php endif; ?>
                            
                                 </div>
                                 <?php
                                $student_ans=[];
                                $correct_explanation ="";
                                $count=0;
                                
                                ?>
                                <?php $__currentLoopData = $question->questionDetails->questionMaster->questionAnswers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qanswer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <?php
                                            $correct_opts=$myLibrary->getCorrectAnswer($question->question_id);
                                        if($qanswer->is_correct==1){
                                            $correct_explanation=$question->questionDetails->questionMaster->correct_explanation;
                                        }
                                            //dd($correct_opts);
                                ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__empty_2 = true; $__currentLoopData = $question->questionDetails->questionAnswers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                <?php

                                    $student_ans[]=$answer->serial_no;
                                ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                <?php endif; ?>
                            
                            <div class="resultWrap">
                                <p>Your answer: <?php echo e($question->answer); ?> </p>
                                    <p>Correct answer: Option <strong><?php echo e(@$correct_opts); ?></strong></p>
                                    <p>Explanation:<?php echo $correct_explanation; ?> </p>
                                    
                                
                                
                             </div>
                              </div>
                              <?php if($q_count==1): ?>
                                  
                                <div class="questionright fixme">
                                    <h4><strong>Score</strong></h4>
                                    <br>
                                    <p class="score"><span><?php echo e($mock_test->secured_marks); ?> </span>/<?php echo e($mock_test->full_marks); ?></p>
                                    <div class="row">
                                        
                                        <div class="col-xs-6 col-md-4">
                                        <div class="scoreinner">Correct Answer<span><?php echo e($total_correct_answer); ?>/<?php echo e($total_attempt_answer); ?></span></div>
                                            </div>
                                            <div class="col-xs-6 col-md-4">
                                            <div class="scoreinner">Incorrect Answer<span><?php echo e($total_incorrect_answer); ?>/<?php echo e($total_attempt_answer); ?></span></div>
                                            </div>
                                            <div class="col-xs-6 col-md-4">
                                            <div class="scoreinner">Unanswered <span><?php echo e($total_questions-$total_attempt_answer); ?>/<?php echo e($total_questions); ?></span></div>
                                            </div>
                                        </div>
                                        <h4><strong>Level Wise</strong></h4>
                                        <br>
                                        <?php $__empty_2 = true; $__currentLoopData = $templateInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $templateInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                            <?php
                                                $noofques=$myLibrary->getNumofQues($mock_test_id,$templateInfo->level_id); 
                                                $noofcorrect=$myLibrary->getNumofCorrectAnswer($mock_test_id,$templateInfo->level_id); 
                                                $markGained=$myLibrary->getMarks($mock_test_id,$templateInfo->level_id); 
                                            ?>
                                            <p><strong><?php echo e($templateInfo->level->name); ?></strong></p>
                                            <div class="row">
                                                
                                                <div class="col-xs-6 col-md-4">
                                                <div class="scoreinner">No. of Question<span><?php echo e($noofques); ?></span></div>
                                                </div>
                                                <div class="col-xs-6 col-md-4">
                                                <div class="scoreinner">Total Correct<span><?php echo e($noofcorrect); ?></span></div>
                                                </div>
                                                <div class="col-xs-6 col-md-4">
                                                <div class="scoreinner">Mark Gained<span><?php echo e($markGained); ?></span></div>
                                                </div>
                                            </div>
                                            
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                            
                                        <?php endif; ?>
                                </div>
                                <?php endif; ?>
                                <div class="clear"></div>
                           </div>
                           <?php 
                           $q_count++;
                        ?>   
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                           <p>Sorry.No question here.</p>
                       <?php endif; ?>
                       <div class="col-sm-12 col-lg-8 ">
                        <div class="d-flex align-items-center">
                        <div><?php echo e($allquestions->links('frontend.paid-mock-test.result_pagination')); ?></div>
                        <div style="padding-left: 10px">
                            <div class="form-inline">
                                <label ><span>Go to Question </span></label>
                        <select id="pagination" class="selectQuestion form-control">
                            <?php for($i = 1; $i <= $total_questions; $i++): ?>
                                
                            <option value="<?php echo e($i); ?>" <?php echo e($allquestions[0]->question_no==$i?"selected":''); ?>   ><?php echo e($i); ?></option>
                            <?php endfor; ?>
                            
                        </select>
                            </div>
                            
                        </div>
                    </div>
                        
                    </div>
                </form>
                    

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
<script>
    var fixmeTop = $('.fixme').offset().top;
    $(window).scroll(function() {
        var currentScroll = $(window).scrollTop();
        if (currentScroll >= fixmeTop) {
            $('.fixme').css({
                position: 'fixed',
                top: '190px',
                right: '15%',
                width: '24%',
                
            });
        } else {
            $('.fixme').css({
                position: 'static',
                width: '34%'
            });
        }
    });
    $(".selectQuestion").on('change',function(){
        var qno=$(this).val();
        var href = new URL(window.location);
        href.searchParams.set('page', qno);
        window.location=href.toString(); 
    })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/paid-mock-test/result.blade.php ENDPATH**/ ?>