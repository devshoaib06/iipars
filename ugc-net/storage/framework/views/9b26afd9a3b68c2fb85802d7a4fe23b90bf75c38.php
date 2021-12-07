<div class="qus_ref">
<ul>
<?php $__empty_1 = true; $__currentLoopData = $allquestions->questionDetails->questionOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <li><span><?php echo e($option->serial_no); ?>.</span>  <?php echo $option->option_text; ?></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

<?php endif; ?>
</ul>
</div>
<div class="input_check">
<?php $__empty_1 = true; $__currentLoopData = $allquestions->questionDetails->questionAnswers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<?php
    $chosen_answer=explode(",",$allquestions->answer);
?>
<!-- <label class="option"><span><?php echo e($answer->serial_no); ?> </span>
</label>
<input type="checkbox" name="answer[]" value="<?php echo e($answer->serial_no); ?>" <?php echo e(in_array($answer->serial_no,$chosen_answer)?'checked':''); ?>><?php echo $answer->answer; ?>  -->
<input id="opt_<?php echo e($answer->id); ?>" type="checkbox" name="answer[]" value="<?php echo e($answer->serial_no); ?>" <?php echo e(in_array($answer->serial_no,$chosen_answer)?'checked':''); ?>>
 <label class="option" for="opt_<?php echo e($answer->id); ?>" >
    <div class="d-flex">
        <div><span><?php echo e($answer->serial_no); ?></span> </div>
        <div style="width:calc(100% - 35px)"><?php echo $answer->answer; ?></div>
        
    </div>
    
     
    </label>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <p>No Options</p>
    
<?php endif; ?>

</div>  

       <?php /**PATH /home/teachinns/public_html/resources/views/frontend/paid-mock-test/_simple.blade.php ENDPATH**/ ?>