<?php $__env->startSection('content'); ?>

<p>Hello Admin,</p>
<p><strong>Your got an email from contact us.</strong></p>
<p>Following are the details  filled by <?php echo e($emailData['name']); ?> :</p>

<p>Name: <?php echo e($emailData['name']); ?></p>
<p>Email: <?php echo e($emailData['email']); ?></p>
<p>Phone: <?php echo e($emailData['phone']); ?></p>
<p>Message: <?php echo e($emailData['message']); ?></p>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.emails.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/emails/contact-us.blade.php ENDPATH**/ ?>