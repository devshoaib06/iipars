<?php 
	$segment1 =  Request::segment(2);
	$segment =  Request::segment(1);
?>	

<div class="dashlink">
	<ul>
		<li ><a href="<?php echo e(route('resellerdashboard')); ?>" <?php if($segment1 == 'dashboard' ): ?> class="active" <?php endif; ?>>Dashboard </a></li>
		<li ><a href="<?php echo e(route('reselleraccount')); ?>" <?php if($segment1 == 'myAccount'): ?> class="active" <?php endif; ?>>My Account</a></li>
		<li ><a href="<?php echo e(route('reseller-change-password')); ?>" <?php if($segment1 == 'change-password'): ?> class="active" <?php endif; ?>>Change Password  </a></li>
		<li ><a href="<?php echo e(route('frontendlogout')); ?>">Logout  </a></li>
	</ul>
</div><?php /**PATH /home/teachinns/public_html/resources/views/frontend/reseller/includes/reseller_menu.blade.php ENDPATH**/ ?>