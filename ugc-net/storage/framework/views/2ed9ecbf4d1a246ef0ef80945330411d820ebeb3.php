<?php echo $__env->make('frontend.structure.page_meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('page_content'); ?>

<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                <li>Mock Test Instruction</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <h3 class="text-center"><?php echo e(strtoupper($subject->subject_name)); ?></h3>
                    </div>
                <div class="col-12 col-sm-12">
                    <div class="outerleftsection">
                        <div class="highlightsection">
                        <form action="<?php echo e(route('startPaidExam',['mock_test_id'=>\Hasher::encode($mock_test_id)])); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <h3>Instruction:</h3>
                            <p>
                                <?php echo trim(getMockTestSettings('mt_instruction')); ?>

                            </p>
                            <?php
                                $duration=$template->duration;
                                $minutes=($duration % 60).' Min';
                                $hours= intdiv($duration, 60).' Hr(s) ';
                                if($minutes>0){
                                    $hours.=$minutes;
                                }
                            ?>  
                            <ul class="">
                                <li>Total number of questions: <b><?php echo e($noofQuestion); ?></b>.</li>
                                
                                <li>Time alloted: <b><?php echo e($hours); ?></b>.</li>
                                <li>Level: <b><?php echo e(implode(', ',$level)); ?></b>.</li>
                                <li>Total Marks: <b><?php echo e($fullmarks); ?></b>.</li>
                               
                            </ul>
                        
                            <button type="submit" class="submitTest btn btn-primary">Start Test</button>
                        </div>
                    </div>   
                </div>
            </div>
            
        </div>
        

    </section>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_js'); ?>
<script>
    var sbtclicked=0;

    window.history.forward(1);
    document.onkeydown = function(){
    switch (event.keyCode){
            case 116 : //F5 button
                event.returnValue = false;
                event.keyCode = 0;
                return false;
            case 82 : //R button
                if (event.ctrlKey){ 
                    event.returnValue = false;
                    event.keyCode = 0;
                    return false;
                }
               
            case 123 : //R button
                if (event.ctrlKey){ 
                    event.returnValue = false;
                    event.keyCode = 0;
                    return false;
                }    
        }
    }
    if (document.layers) {
        //Capture the MouseDown event.
        document.captureEvents(Event.MOUSEDOWN);
    
        //Disable the OnMouseDown event handler.
        document.onmousedown = function () {
            return false;
        };
    }
    else {
        //Disable the OnMouseUp event handler.
        document.onmouseup = function (e) {
            if (e != null && e.type == "mouseup") {
                //Check the Mouse Button which is clicked.
                if (e.which == 2 || e.which == 3) {
                    //If the Button is middle or right then disable.
                    return false;
                }
            }
        };
    }
    
    //Disable the Context Menu event.
    document.oncontextmenu = function () {
        return false;
    };


    // window.onbeforeunload = function() {
    //     if(sbtclicked==3){
    //             //alert('Are you sure you want to submit test now?');
    //             return;
    //     }
    //     if(sbtclicked==2){
            
    //         return;
    //     }
    //     return "Leave this page ?";
    // }

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/paid-mock-test/instruction.blade.php ENDPATH**/ ?>