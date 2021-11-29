<?php 
	$segment1 =  Request::segment(2);
?>	

<div class="dashlink">
	<ul>
		<li ><a <?php if($segment1 == 'dashboard'): ?> class="active" <?php endif; ?> href="<?php echo e(route('dashboard')); ?>">Dashboard </a></li>
		
		<li ><a <?php if($segment1 == 'myAccount'): ?> class="active" <?php endif; ?> href="<?php echo e(route('my_account')); ?>">My Account</a></li>
		<li ><a <?php if($segment1 == 'orders'): ?> class="active" <?php endif; ?> href="<?php echo e(route('myOrders')); ?>">My Orders  </a></li>
		<li ><a <?php if($segment1 == 'mock-tests'): ?> class="active" <?php endif; ?> href="<?php echo e(route('my_mock_tests')); ?>">My Mock Test  </a></li>
		<li ><a <?php if($segment1 == 'changePassword'): ?> class="active" <?php endif; ?> href="<?php echo e(route('change-password')); ?>">Change Password  </a></li>
	</ul>
</div><?php /**PATH /home/teachinns/public_html/resources/views/frontend/includes/student_menu.blade.php ENDPATH**/ ?>