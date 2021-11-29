<div class="modal fade floater_signup modal-pop">
    <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="logincont">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <div class="poplogo"><img src="<?php echo e(asset('public/frontend/images/logo.png')); ?>"  alt="India’s no.1 online study material for UGC & CSIR NTA NET/SET/JRF"/></div>
                        <h2><?php echo e($floatersignup->title); ?></h2>
                        <div class="poptext text-center">
                            <?php echo html_entity_decode($floatersignup->description); ?>

                        </div>
                        
                        <div class="floater-signbtn">
                            <a href="<?php echo e(route('sign-up')); ?>"><button type="submit" class="submitbut" id="rset">Register</button></a>      
                        </div>
                        <div class=" text-center">
                        <a href="javascript:void(0)" class="floaterlogin">Already have an account?</a>
                        
                        </div>
                     </div>
                </div>
            
    </div>
</div> 
<?php if(auth()->guard()->guest()): ?>
<script>
<?php if(!in_array(Route::currentRouteName(),$excluded_page)): ?>
$(document).ready(function(){
    

   var handle= setInterval(() => {
        $('.floater_signup').modal('show');
        
    }, <?php echo e($timetoshowPopup); ?>);
    $('.floaterlogin').on('click',function(){
        $('.floater_signup').modal('hide');
        $('#logmod').modal('show');
        clearInterval(handle);
    })
    $('.login').on('click',function(){
        $('.floater_signup').modal('hide');
        //$('#logmod').modal('show');
        clearInterval(handle);
    })
});
    

</script>
<?php endif; ?>
<?php endif; ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/includes/modal/floater_sign.blade.php ENDPATH**/ ?>