<?php $__env->startSection('page_title'); ?>
	Reseller Commission
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_plugins_css'); ?>
<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/datatables/datatables.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_css'); ?>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>	
    <!-- BEGIN CONTAINER -->
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar-wrapper">
			
			<div class="page-sidebar navbar-collapse collapse">
				
				<?php echo $__env->make('admin.partials.sidebarMenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				
			</div>
			<!-- END SIDEBAR -->
		</div>
		<!-- END SIDEBAR -->
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<!-- BEGIN CONTENT BODY -->
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<!-- BEGIN THEME PANEL -->
				<?php echo $__env->make('admin.partials.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<!-- END THEME PANEL -->
				<!-- BEGIN PAGE BAR -->
				<div class="page-bar">
				
				<div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN VALIDATION STATES-->
                        <div class="portlet light portlet-fit portlet-form bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-user "></i>
                                    <span class="caption-subject  sbold ">	Reseller Commission

                                    </span>
                                </div>
                                
                            </div>
                            
                            <div class="portlet-body">
                                <!-- BEGIN FORM-->
                               

                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button> Your form validation is successful! </div>


                                        <?php if(Session::has('message')): ?>                         
                                        <div class="<?php echo e(Session::get('messageClass')); ?>">
                                            <button class="close" data-close="alert"></button>
                                            <span><?php echo e(Session::get('message')); ?> </span>
                                        </div>
                                        <?php endif; ?>  
                                        <div class="alert alert-success showmsg" style="display: none">
                                            <button class="close" data-close="alert"></button>
                                            <span class="msg"></span>
                                        </div>
                                        <!--profile pic-->
                                        
                                        
                                        

                                        <form id="form_sample_0" class="form-horizontal" >
                                            <?php echo csrf_field(); ?>

                                        <div class="form-group">
                                            <div class="control-label col-md-2">
                                               
                                            </div>
                                            <div class="col-md-2">Lower Bound</div>
                                            <div class="col-md-2">Upper Bound</div>
                                            <div class="col-md-2">Commission (%)</div>
                                            
                                        </div>
                                        </form>
                                        <?php
                                            $j=1;
                                            $total_row=count($slabs);
                                        ?>

                                        <?php $__empty_1 = true; $__currentLoopData = $slabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <form id="form_sample_<?php echo e($j); ?>" action="<?php echo e(route('updateResellerCommission')); ?>" method="POST" class="form-horizontal clonerow" >
                                            <?php echo csrf_field(); ?>

                                            <input type="hidden" name="id" value="<?php echo e($slab->id); ?>">
                                            <div class="form-group " id="clonerow<?php echo e($j); ?>">
                                                <div class="control-label col-md-2">
                                                
                                                </div>
                                                
                                                <div class="col-md-2">
                                                    <input type="number" name="lower_bound" class="form-control lower_bound" readonly  value="<?php echo e($slab->lower_bound); ?>" min=1 oninput="validity.valid||(value='');" /> 

                                                <?php if($errors->has('lower_bound')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('lower_bound')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                                
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" name="upper_bound" class="form-control upper_bound" <?php echo e($j>=$total_row?'':'readonly'); ?> value="<?php echo e($slab->upper_bound); ?>" min=1 oninput="validity.valid||(value='');" /> 

                                                <?php if($errors->has('upper_bound')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('upper_bound')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" name="commission" class="form-control commission"   value="<?php echo e($slab->commission); ?>" required min=1 oninput="validity.valid||(value='');" /> 

                                                <?php if($errors->has('commission')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('commission')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                                </div>
                                                
                                                
                                                <?php if($j>=$total_row): ?>
                                                    
                                                <label class="col-md-2 removeBtn">
                                                    <button class="btn green update-btn"   type="submit" data-val="<?php echo e($slab->id); ?>" ><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                                                    <button class="btn red delete-btn"  type="button " data-val="<?php echo e($slab->id); ?>" ><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    
                                                </label>
                                                <?php else: ?>
                                                <label class="col-md-1 removeBtn">

                                                    <button class="btn green update-btn"  type="submit" data-val="<?php echo e($slab->id); ?>" ><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                                                </label>
                                                
                                                <?php endif; ?>

                                            </div>
                                            <?php
                                                $j++;
                                            ?> 
                                            </form>  
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <div class="form-group clonerow" >
                                            <div class="control-label col-md-2">
                                            
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <input type="text" name="lower_bound" class="form-control lower_bound"  value=""/> 

                                            <?php if($errors->has('lower_bound')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('lower_bound')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="upper_bound " class="form-control upper_bound"  value=""/> 

                                            <?php if($errors->has('upper_bound')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('upper_bound')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="commission" class="form-control commission"  value=""/> 

                                            <?php if($errors->has('commission')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('commission')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                            </div>
                                            
                                            
                                            <label class="col-md-2 removeBtn">
                                                
                                                <button class="btn green save-btn"  type="button" ><i class="fa fa-floppy-o" aria-hidden="true"></i></button>

                                            </label>
                                           
                                        </div> 
                                        <?php endif; ?>
                                        <div id="divitems">
                                        </div>
                                        <div class="form-group">
                                            <div class="control-label col-md-8 text-right">
                                                <input type="button" value="Add More" class="btn green addnewrow" data-val="1" />
                                            </div>

                                        
                                        </div> 
                                       
                                       
                                        
                                       
                                       

                                        
                                        
                                    </div>
                                    
                                
                                <!-- END FORM-->
                            </div>
                        </div>
                        <!-- END VALIDATION STATES-->
                    </div>
                </div>
			</div>
			<!-- END CONTENT BODY -->
		</div>
		<!-- END CONTENT -->
		<!-- BEGIN QUICK SIDEBAR -->            
		<?php echo $__env->make('admin.partials.quickSidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<!-- END QUICK SIDEBAR -->
	</div>    
    <!-- END CONTAINER -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page_level_plugins'); ?>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script src="<?php echo e(config('path.assets_path')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript" ></script>
<script src="public/assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_scripts'); ?>
<?php for($count=1;$count<count($slabs);$count++): ?>
<script>
    $(document).ready(function(){
        $('#form_sample_'+<?php echo e($count); ?>).validate();
        
    })
</script>
<?php endfor; ?>
<script type="text/javascript">

var $i=$k=1;

$('body').on('click','.addnewrow',function(){
    
    let url="<?php echo e(route('nextSlabRow')); ?>";
    var noofrows=$('.clonerow').length;
    let data={
        noofrows:noofrows,
        _token:"<?php echo e(csrf_token()); ?>"
    };
    $.post(url,data,function(res){
        $('#divitems').append(res.html);
        $('#form_sample_'+(noofrows+1)).validate();

    })

});

$('body').on('click','.save-btn',function(event){
    // debugger;
    event.preventDefault();
    let parent_row=$(this).parents(".clonerow");
    let form_id=parent_row.attr('id');

    let lower_bound=parent_row.find('.lower_bound').val();
    let upper_bound=parent_row.find('.upper_bound').val();
    let commission=parent_row.find('.commission').val();
    if(upper_bound<=lower_bound){
        alert('Please enter value greater than lower bound. ');
        return ;
    }
    $("#"+form_id).valid();
    
    let data={
        lower_bound:lower_bound,
        upper_bound:upper_bound,
        commission:commission,
        _token:"<?php echo e(csrf_token()); ?>"

    }
    let url="<?php echo e(route('saveResellerCommission')); ?>";
    // $.post(url,data,function(res){
    //     if(res.success){
    //         $('.showmsg').show();
    //         $('.msg').text(res.msg);
    //     }

    // });

});
$('body').on('click','.update-btn',function(event){
    debugger;
    // event.preventDefault();

    let parent_row=$(this).parents(".clonerow");
    let form_id=parent_row.attr('id');
    let id=$(this).data('val');
    let lower_bound=parent_row.find('.lower_bound').val();
    let upper_bound=parent_row.find('.upper_bound').val();
    let commission=parent_row.find('.commission').val();
    if(upper_bound<=lower_bound){
        alert('Please enter value greater than lower bound. ');
        return false ;
    }
    $("#"+form_id).valid();
    if($("#"+form_id).valid()){

        

        return;
    }

});

$('body').on('click','.delete-btn',function(event){
    
    event.preventDefault();
    let parent_row=$(this).parents(".clonerow");
    let form_id=parent_row.attr('id');

    let id=$(this).data('val');
    
    let data={
        id:id,
        _token:"<?php echo e(csrf_token()); ?>"

    }
    let url="<?php echo e(route('deleteSlab')); ?>";
    $.post(url,data,function(res){
        if(res.success){
            $('.showmsg').show();
            $('.msg').text(res.msg);
            parent_row.remove();
            location.reload();
        }

    });

});
function removeItem($j){
   

	$("#divdynamicitems"+$j).remove();
}
function removeRow(_this){
       
       $(_this).parents("#clonerow").remove();
   }    
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/admin/settings/reseller_commission/_form.blade.php ENDPATH**/ ?>