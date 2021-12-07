<div class="col-sm-6">
    <div class="column-1">
        <H4>Column-I</h4>
        <ul>
            <?php $__empty_1 = true; $__currentLoopData = $allquestions->questionDetails->questionOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <li><span><?php echo e($option->serial_no); ?>.</span><?php echo $option->option_text; ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php endif; ?>
        </ul>
    </div>
</div>
<div class="col-sm-6">
    <div class="column-2">
        <H4>Column-II</h4>
        <ul>
            <?php $__empty_1 = true; $__currentLoopData = $allquestions->questionDetails->questionOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <li><span><?php echo e($option->other_option_serial_no); ?>.</span><?php echo $option->other_option_text; ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php endif; ?>
        </ul>
    </div>
</div>
<div class="cloumn-option" style="overflow-y: scroll;max-height:200px;width: 100%;">
    <table class="table table-bordered">
            <thead>
            <tr>
                <th></th>
                <?php $__empty_1 = true; $__currentLoopData = $allquestions->questionDetails->questionOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <th><?php echo e($option->serial_no); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <?php endif; ?>
                
            </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $allquestions->questionDetails->questionAnswers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>  
            <?php
                $anwOpts=explode(',',$answer->answer);
            ?>
            
            <tr>
                <td>
                    <div class="input_check">    
                        <input type="checkbox" id="opt_<?php echo e($answer->id); ?>" name="answer[]" value="<?php echo e($answer->serial_no); ?>" <?php echo e($allquestions->answer==$answer->serial_no?'checked':''); ?>> 
                        <label class="option" for="opt_<?php echo e($answer->id); ?>"><span><?php echo e($answer->serial_no); ?></span></label>
                        
                    </div>
                </td>
                <?php $__empty_2 = true; $__currentLoopData = $anwOpts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                    <td><?php echo $opt; ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                <?php endif; ?>
                
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p>No answer</p>
                
            <?php endif; ?>
            
        </tbody>

    </table>

</div>
<?php /**PATH /home/teachinns/public_html/resources/views/frontend/paid-mock-test/_conjugate.blade.php ENDPATH**/ ?>