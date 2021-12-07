<?php echo $__env->make('frontend.structure.page_meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('page_content'); ?>

        
        <section class="bodycont">
            <section class="breadcamp">
                   <div class="container">
                       <ul>
                           <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                           <li>Billing</li>
                       </ul>
                   </div>
               </section>
       
               <section class="innerpage">
                   <div class="container">
                    <div class="thankyou">
                        <div class="tickicon"><span><i class="fa fa-check" aria-hidden="true"></i></span></div>
                        <div class="thankyouheading">Thank you</div>
                    <p>Welcome to the world of knowledge. Go to your <a href="<?php echo e(route('dashboard')); ?>">dashboard</a> to view your account <br>
                        details and to download your courses.</p>
                        
                        
                        <div class="thankbot">
                            <?php if(Session::has('message')): ?>                         
								<div class="<?php echo e(Session::get('messageClass')); ?>">
									<button class="close" data-close="alert"></button>
									<span><?php echo e(Session::get('message')); ?> </span>
								</div>
								<?php endif; ?>  

								<?php if(count($errors) > 0): ?>
								<div class="alert alert-danger">
									<ul>
										<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li><?php echo e($error); ?></li>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</ul>
								</div>
                                <?php endif; ?>
                          <?php if($payment_details->payment_method!="Free"): ?>      
                            <a href="<?php echo e(route('dashboard')); ?>">My dashboard</a>
                            <div class="orderdetais">
                                <h3>Order details</h3>
                                <?php
                                    $amount=$product->revised_price!=""?$product->revised_price:$product->price;
                                    $subtotal=$amount;
                                    if($order->discount_amount){
                                        $subtotal=$amount-$order->discount_amount;
                                    }
                                ?>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
                                    <tr>
                                        <td><strong>Course</strong></td>
                                        <td><strong>Total</strong></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e($product->name); ?> × 1</td>
                                        <td> &nbsp; ₹ <?php echo e($amount); ?></td>
                                    </tr>
                                    <?php if($order->discount_amount!=0  ): ?>
                                    <tr>
                                        <td>Discount:</td>
                                        <td>- ₹ <?php echo e($order->discount_amount); ?></td>
                                    </tr>
                                    <?php endif; ?> 
                                    <?php if($order->student_cb_amount!=""  ): ?>
                                    <tr>
                                        <td>Cashback:</td>
                                        <td>- ₹ <?php echo e(number_format((float)$order->student_cb_amount, 2, '.', '')); ?></td>
                                    </tr>
                                    <?php endif; ?>  
                                    <tr>
                                        <td>Subtotal:</td>
                                        <td>  &nbsp; ₹ <?php echo e($order->subtotal); ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Payment method:</td>
                                    <td style="text-transform:capitalize"> &nbsp;<?php echo e($payment_details->payment_method); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total:</strong></td>
                                        <td><strong> &nbsp; ₹ <?php echo e($order->grand_total); ?></strong></td>
                                    </tr>
                                </table>
                            
                            </div>
                            <div class="orderdetais">
                            <h3>Billing Address</h3>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <strong><?php echo e($billing_info->first_name); ?>  <?php echo e($billing_info->last_name); ?></strong><br>

                                        
                                        <?php echo e($billing_info->street_address_1); ?> <?php echo e($billing_info->street_address_2); ?>,<br>
                                        <?php echo e($billing_info->city); ?><br>
                                        
                                        <?php echo e($state->state_name); ?> -  <?php echo e($billing_info->zip); ?>, <?php echo e($country->country_name); ?> <br>
                                        <strong>Phone Number: </strong><?php echo e($billing_info->phone); ?><br>
                                        <strong>Email: </strong><?php echo e($billing_info->email); ?><br>
                                    
                                    
                                    </div>
                                </div>  
                            </div>
                          <?php endif; ?>  
                    
                    
                </div>
                
            </div>
        </div>
    </section>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('page_js'); ?>
<script>
    // $(document).ready(function(){
    //     setTimeout(function(){ 
    //         let url="<?php echo e(route('dashboard')); ?>";
            
    //         window.location.replace(url);
    //     }, 20000);
    // })
</script>


<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/course/billing/thank-you.blade.php ENDPATH**/ ?>