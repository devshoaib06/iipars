<?php 
	$segment1 =  Request::segment(2);
	$segment =  Request::segment(1);

?>	

<div class="dashlink">
	<ul>
		<li ><a href="<?php echo e(route('contributordashboard')); ?>" <?php if($segment1 == 'dashboard'): ?> class="active" <?php endif; ?>>Dashboard </a></li>
		<li ><a href="<?php echo e(route('contributoraccount')); ?>" <?php if($segment1 == 'myAccount'): ?> class="active" <?php endif; ?>>My Account</a></li>
		<li ><a href="<?php echo e(route('contributor-change-password')); ?>" <?php if($segment1 == 'changePassword'): ?> class="active" <?php endif; ?>>Change Password  </a></li>
		<li ><a href="<?php echo e(route('frontendlogout')); ?>">Logout  </a></li>
	</ul>
</div><?php /**PATH /home/teachinns/public_html/resources/views/frontend/contributor/includes/contributor_menu.blade.php ENDPATH**/ ?>