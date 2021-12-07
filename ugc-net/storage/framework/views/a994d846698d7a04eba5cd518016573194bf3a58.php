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
                <div class="col-sm-12 col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
                    <div class="mcqTestHead">    
                        <table class="table table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <td colspan="2">Your result</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Total Number of question:</td>
                                    <td><?php echo e($total_questions); ?></td>
                                </tr>
                                <tr>
                                    <td>Number of answered question:</td>
                                <td><?php echo e($total_attempt_answer); ?></td>
                                </tr>
                                <tr>
                                    <td>Number of unanswered question:</td>
                                    <td><?php echo e($total_questions-$total_attempt_answer); ?></td>
                                </tr>
                                <tr>
                                    <td>Total correct answers:</td>
                                    <td><?php echo e($total_score); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                <form>
                    
                    <?php 
                        $q_count=1;
                    ?>
                    <?php $__empty_1 = true; $__currentLoopData = $allquestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="questionWrap">
                                <div class="question">
                                    <h1><span><?php echo e($q_count); ?>.</span><?php echo e($question->question); ?></h1>
                                </div>
                                <?php 
                                    $qoptions=$myLibrary->getQuestionOptions($question->id);
                                    $index=0;
                                    @$student_answer=$myLibrary->getStudentAnswer($question->id,$exam_id);
                                    $qanswer=$myLibrary->getCorrectOptionsExplain($question->id);
                                ?>
                               
                                <?php $__empty_2 = true; $__currentLoopData = $qoptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                    <label class="option<?php echo e($optionsLabel[$index]); ?>">
                                        <span><?php echo e($optionsLabel[$index]); ?></span>
                                        <?php echo e($option->answer); ?>

                                       <?php if($option->id==$qanswer->correct_answer_id): ?>
                                        <i class="fa fa-check-circle"></i>
                                       <?php endif; ?>
                                       <?php if(@$option->id==@$student_answer->answer_id): ?>
                                          <?php if($student_answer->is_correct==0): ?>
                                            <i class="fa fa-times-circle"></i>
                                          <?php endif; ?>  
                                       <?php endif; ?>
                                    </label>
                                    <?php 
                                        $index++;
                                    ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                    <p>No Options</p>
                                    
                                <?php endif; ?>
                                
                            </div>
                            <?php 

                            ?>
                            <div class="resultWrap">
                                <?php if(@$student_answer->option_label): ?>
                                 <p>Your answer: Option <strong><?php echo e(@$student_answer->option_label); ?></strong></p>
                                <?php else: ?>
                                 <p>Your answer:</p>
                                <?php endif; ?>
                                <p>Correct answer: Option <strong><?php echo e($qanswer->option_label); ?></strong></p>
                                <p>Explanation:</p><?php echo e($qanswer->correct_clarification); ?>

                            </div>
                         <?php 
                            $q_count++;
                         ?>   
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p>Sorry.No question here.</p>
                        <?php endif; ?>
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/mock-test/result.blade.php ENDPATH**/ ?>