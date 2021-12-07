
<form id="form_sample_<?php echo e($count); ?>" action="<?php echo e(route('saveResellerCommission')); ?>" class="clonerow form-horizontal" method="POST">
    <?php echo csrf_field(); ?>
<div class="form-group " id="clonerow">
    <div class="control-label col-md-2">
    
    </div>
    
    <div class="col-md-2">
        <input type="number" name="lower_bound" class="form-control lower_bound"  value="<?php echo e(($slab->upper_bound)+1); ?>" min=1 oninput="validity.valid||(value='');" readonly  required/> 

    <?php if($errors->has('lower_bound')): ?>
    <span class="help-block">
        <strong><?php echo e($errors->first('lower_bound')); ?></strong>
    </span>
    <?php endif; ?>
    </div>
    <div class="col-md-2">
    <input type="number" name="upper_bound" class="form-control upper_bound"  value="" required min=1 oninput="validity.valid||(value='');"  /> 

    <?php if($errors->has('upper_bound')): ?>
    <span class="help-block">
        <strong><?php echo e($errors->first('upper_bound')); ?></strong>
    </span>
    <?php endif; ?>
    </div>
    <div class="col-md-2">
        <input type="number" name="commission" class="form-control commission"  value="" required min=1 oninput="validity.valid||(value='');" /> 

    <?php if($errors->has('commission')): ?>
    <span class="help-block">
        <strong><?php echo e($errors->first('commission')); ?></strong>
    </span>
    <?php endif; ?>
    </div>
    
    
    <label class="col-md-2 removeBtn">
        
        <button class="btn green save-btn"  type="submit"  ><i class="fa fa-floppy-o" aria-hidden="true"></i></button>

        <button class="btn red"  type="button" onclick="removeRow(this)"><i class="fa fa-trash" aria-hidden="true"></i></button>
    </label>
</div> 
</form>
                                    
                                       <?php /**PATH /home/teachinns/public_html/resources/views/admin/settings/reseller_commission/_addnewslab.blade.php ENDPATH**/ ?>