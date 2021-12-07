<?php $__env->startSection('content'); ?>

<?php echo $emailData['body']; ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.emails.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/emails/order.blade.php ENDPATH**/ ?>