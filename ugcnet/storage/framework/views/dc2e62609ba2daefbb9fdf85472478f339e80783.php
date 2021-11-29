<div class="qus_ref">
<ul>
<?php $__empty_1 = true; $__currentLoopData = $question->questionDetails->questionOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <li><span><?php echo e($option->serial_no); ?>.</span>  <?php echo $option->option_text; ?></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

<?php endif; ?>
</ul>
</div>
<div class="input_check">

<?php $__empty_1 = true; $__currentLoopData = $question->questionDetails->questionAnswers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<?php
    
        $stanswers=explode(",",$question->answer);
    
?>
<label class="option
    <?php if(in_array($answer->serial_no,$stanswers) && $answer->is_correct==1): ?>
    <?php echo e("right-ans"); ?>

    <?php elseif(in_array($answer->serial_no,$stanswers) && $answer->is_correct==0): ?>
    <?php echo e("wrong-ans"); ?>

    <?php endif; ?>
"><span><?php echo e($answer->serial_no); ?></span><?php echo $answer->answer; ?>

    <?php if($question->answer==$answer->serial_no && $question->is_correct==1): ?>
        <i class="fa fa-check-circle"></i>
    <?php elseif($question->answer==$answer->serial_no && $question->is_correct==0): ?>
        <i class="fa fa-times-circle"></i>
        
    <?php endif; ?>

</label>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <p>No Options</p>
    
<?php endif; ?>

</div>

       <?php /**PATH /home/teachinns/public_html/resources/views/frontend/paid-mock-test/result/_simple.blade.php ENDPATH**/ ?>