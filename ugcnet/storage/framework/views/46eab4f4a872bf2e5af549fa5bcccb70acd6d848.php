<?php 
    $myLibrary=new \App\library\myFunctions;
?>
        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php 
            $payment_info=$myLibrary->getPaymentInfo($order->order_id);
            $pay_date="-";
            $pay_type="-";
            $pay_str="Due";
            $cheque_no_neft="-";
            $pay_status=0;
                if($payment_info){
                $pay_status=$payment_info['pay_status'];
                if($pay_status==1){
                        $pay_str="Requested";
                }
                else if($pay_status==2){
                    $pay_date=$payment_info['pay_date'];
                    $cheque_no_neft=$payment_info['cheque_no_neft'];
                    $pay_str="Paid";
                }

                if($payment_info->pay_type==1){
                    $pay_type="Cheque";
                }
                elseif($payment_info->pay_type==2){
                    $pay_type="NEFT";

                }

            }
        ?>
        <tr class="append-data">
            <td class="order-td">
                <input type="checkbox" name="checkdorders[]" class="order-check" <?php echo e($pay_status!=0?'disabled':''); ?> value=<?php echo e($order->order_id); ?> >
                <input type="hidden" class="amount-check" name="orderamount[]" value=<?php echo e($order->total); ?> disabled="disabled" >
            </td>
            <td><?php echo e($order->reciept_id); ?></td>
            <td><?php echo e($order->name); ?></td>
            <td><?php echo e(\Carbon\Carbon::parse($order->created_at)->format('d/m/Y')); ?></td>
            <td><?php echo e($order->revised_price!=""?$order->revised_price:$order->price); ?></td>
            <td><?php echo e($order->total); ?></td>
            <td>
                <?php if($pay_date!="-"): ?>
                <?php echo e(\Carbon\Carbon::parse($pay_date)->format('d/m/Y')); ?>

                <?php else: ?>
                <?php echo e($pay_date); ?>

                <?php endif; ?>
            </td>
            <td>
                <?php echo e($pay_type); ?>

                
            </td>
            <td><?php echo e($cheque_no_neft); ?></td>
            <td class="text-center">
                <?php if($pay_str=="Requested"): ?>
                    <a href="#" class="text text-info"><strong><?php echo e($pay_str); ?></strong></a>
                <?php endif; ?>
                <?php if($pay_str=="Due"): ?>
                    <a href="#" class="text text-danger"><strong><?php echo e($pay_str); ?></strong></a>
                <?php endif; ?>
                <?php if($pay_str=="Paid"): ?>
                    <a href="#" class="text text-success"><strong><?php echo e($pay_str); ?></strong></a>
                <?php endif; ?>
                
           
            </td>
            
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="10">No order yet.</td></tr>
        <?php endif; ?>
        
        
    

                               <?php /**PATH /home/teachinns/public_html/resources/views/frontend/reseller/order-request.blade.php ENDPATH**/ ?>