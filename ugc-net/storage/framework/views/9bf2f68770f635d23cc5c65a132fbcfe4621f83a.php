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
                    <div class="outerleftsection">
                        <div class="highlightsection">
                        <form action="<?php echo e(route('startExam')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <h3>Instruction:</h3>
                            <p>
                                <?php echo trim(getMockTestSettings('mt_instruction')); ?>

                            </p>
                            <ul class="">
                                <li>Total number of questions: <b><?php echo e(trim(getMockTestSettings('mt_noofquestion'))); ?></b>.</li>
                                <li>Time alloted: <b><?php echo e(trim(getMockTestSettings('mt_duration'))); ?></b> minute(s).</li>
                               
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

<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/mock-test/instruction.blade.php ENDPATH**/ ?>