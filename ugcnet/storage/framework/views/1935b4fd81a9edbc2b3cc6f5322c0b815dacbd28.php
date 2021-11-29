<?php
    $j=$k=1;
?>
<div class="form-group">
    <label class="col-md-3 control-label"></label>
    <div class="radio-list col-md-6">
        <label class="radio-inline" for="option_type_1">
            Sl No</label>
       
    </div>
</div>
<?php $__empty_1 = true; $__currentLoopData = $question->questionOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $questionOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                
    <div class="form-group cloneOpt clonerow" >
        <label class="control-label col-md-3">Option #<?php echo e($j); ?>

            <?php if($j<3): ?>
                <span class="required"> * </span>
            <?php else: ?>   
                <span class="required"> &nbsp; </span> 
            <?php endif; ?>
        </label>
        
        <div class="col-md-1">
            <input type="text" name="option_no<?php echo e($j); ?>" class="form-control" <?php echo e($j<3?'required':''); ?>   value="<?php echo e($questionOption->serial_no); ?>"/> 
                
            </div>
        <div class="col-md-5">
            
            <textarea name="option_text<?php echo e($j); ?>" rows="8" class="form-control ceditor" id="option_text<?php echo e($j); ?>" ><?php echo e($questionOption->option_text); ?></textarea>
            
        </div>
        <?php if($j>2): ?>
            <div class="col-sm-1 removeBtn"><input class="btn red" type="button" value="-" onclick="removeCloneRow(this)"></div>
            
        <?php endif; ?>
    </div>
    <?php
        $j++;
    ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<?php for($i = 1; $i <5; $i++): ?>
        <div class="form-group cloneOpt clonerow">
            <label class="control-label col-md-3">Option #<?php echo e($i); ?>

                <?php if($i<3): ?>
                    <span class="required"> * </span>
                <?php else: ?>   
                    <span class="required"> &nbsp; </span> 
                <?php endif; ?>
            </label>
            
            <div class="col-md-1">
                <input type="text" name="option_no<?php echo e($i); ?>" class="form-control" <?php echo e($i<3?'required':''); ?> value="<?php echo e(old('serial_no'.$i)); ?>"/> 
                    
                </div>
            <div class="col-md-5">
            
            <textarea name="option_text<?php echo e($i); ?>" rows="8" class="form-control ceditor" id="option_text<?php echo e($i); ?>" ><?php echo e(old('options'.$i)); ?></textarea>

            </div>
            <?php if($i>2): ?>
            <div class="col-md-1">
                <input class="btn red" type="button" value="-" onclick="removeCloneRow(this)">
            </div>
            
            <?php endif; ?>
            
        </div>
        
    <?php endfor; ?>
<?php endif; ?>
<div id="divopt" class="divopt"></div>

<div class="form-group">
    <div class="control-label col-md-9 text-right">
        
        <input type="button" value="Add More Option" class="btn green" onclick="addNewSimpleOpt()" />
    </div>


</div>

<?php $__empty_1 = true; $__currentLoopData = $question->questionAnswers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $questionAnswer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    
        <div class="form-group cloneans clonerow">
            <label class="control-label col-md-3">Answer #<?php echo e($k); ?>

                <?php if($k<3): ?>
                <span class="required"> * </span>
                <?php else: ?>   
                    <span class="required"> &nbsp; </span> 
                <?php endif; ?>
            </label>
            
            <div class="col-md-1">
                <input type="text" name="ans_serial_no<?php echo e($k); ?>" class="form-control" <?php echo e($k<3?'required':''); ?>  value="<?php echo e($questionAnswer->serial_no); ?>"/> 
                    
                </div>
            <div class="col-md-5">
            
                <textarea name="answer<?php echo e($k); ?>" rows="8" class="form-control ceditor" id="answer<?php echo e($k); ?>" ><?php echo e($questionAnswer->answer); ?></textarea>

                
            </div>
            <div class="col-md-1">
            <input type="checkbox" name="is_correct<?php echo e($k); ?>" id="ans_<?php echo e($k); ?>"  class="form-control is_check" data-val=<?php echo e($k); ?>  value="1"  <?php echo e($questionAnswer->is_correct==1?'checked':''); ?>/> 
                
            </div>
            <?php if($k>2 && $questionAnswer->is_correct!=1): ?>
            <div class="col-md-1">
                <input class="btn red" type="button" value="-" onclick="removeCloneRow(this)">
            </div>
            
            <?php endif; ?>

            
        </div>
        
    <?php
        $k++;
    ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

    <?php for($i = 1; $i <5; $i++): ?>
        <div class="form-group clonerow">
            <label class="control-label col-md-3">Answer #<?php echo e($i); ?>

                <?php if($i<3): ?>
                    <span class="required"> * </span>
                <?php else: ?>   
                    <span class="required"> &nbsp; </span> 
                <?php endif; ?>
            </label>
            
            <div class="col-md-1">
                <input type="text" name="ans_serial_no<?php echo e($i); ?>" class="form-control"  value="<?php echo e(old('ans_serial_no'.$i)); ?>"/> 
                    
                </div>
            <div class="col-md-5">
                <textarea name="answer<?php echo e($i); ?>" rows="8" class="form-control ceditor" id="answer<?php echo e($i); ?>" ><?php echo e(old('answer'.$i)); ?></textarea>

            
            
                
            </div>
            <div class="col-md-1">
            <input type="checkbox" name="is_correct<?php echo e($i); ?>" id="ans_<?php echo e($k); ?>" class="form-control" onclick="showAnsExp(<?php echo e($k); ?>)"  value="1"/> 
                
            </div>
            
        </div>
        
        
    <?php endfor; ?>
<?php endif; ?>
<?php /**PATH /home/teachinns/public_html/resources/views/admin/mock-test/questions_master/_simple.blade.php ENDPATH**/ ?>