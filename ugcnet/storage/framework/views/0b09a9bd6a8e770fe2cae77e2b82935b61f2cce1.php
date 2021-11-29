<?php echo $__env->make('frontend.structure.page_meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php 
    $myLibrary=new \App\library\myFunctions;
?>

<?php $__env->startSection('page_content'); ?>

<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                <li>Dashboard</li>
            </ul>
        </div>  
    </section>
    <section class="innerpage">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <?php echo $__env->make('frontend.reseller.includes.reseller_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="tabCont">
                        <h1>Dashboard</h1>
                        <?php if(Session::has('message')) { ?>
                            <div class="alert <?php if(Session::has('messageClass')) echo Session::get('messageClass'); ?>">
                                <?php echo e(Session::get('message')); ?>

                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="earningCont">
                                            <h4>Total Earning</h4>
                                            <h5>₹ <span class="tot_earned"><?php echo e($total_earned); ?></span></h5>
                                        </div>
                                    </div>
                                    <?php 
                                        $paid_amount=0;
                                        $paid_amount=$myLibrary->getContributorTotalPaid(Auth::id());
                                    ?>
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="earningCont">
                                            <h4> Received Till date</h4>
                                            <h5>₹ <span class="paid_amount"><?php echo e($paid_amount); ?></span></h5>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="earningCont">
                                            <h4>Due as on today</h4>
                                        <h5>₹ <span class="total_due"><?php echo e($total_earned - $paid_amount); ?></span></h5>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="earningCont">
                                            <h4>Reseller Code</h4>
                                            <h5 style="color:#fe9c4b"><?php echo e($distributor->reseller_code); ?></h5>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="earningCont">
                                            <h4>Reseller Code Link</h4>
                                            <h5 style="color:#fe9c4b"  class="copy-link"><?php echo e(url('/')); ?><?php echo e(config('path.reseller_code_url').'/'.$distributor->reseller_code); ?>

                                            
                                                <span class="btn-copy js-tooltip js-copy" data-toggle="tooltip" data-placement="bottom" data-copy="<?php echo e(url('/')); ?><?php echo e(config('path.reseller_code_url').'/'.$distributor->reseller_code); ?>" title="Copy to clipboard"><i class="fa fa-clipboard" aria-hidden="true"></i></span>
                                            </h5>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="earningCont">
                                            <h4>Number of Enrollments</h4>
                                            <h5 style=" text-align:center;"><?php echo e(count($orders)); ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="userSearchBy">
                                    <form class="form-inline" method="POST" id="search-form">
                                        <div class="form-group">
                                            <label>Search : </label>
                                        </div>
                                        <div class="form-group" >
                                           
                                            <input type="text" name="date_from" class="form-control datepicker" placeholder="From Date" id="from_date" autocomplete="off">

                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="date_to" class="form-control datepicker" placeholder="To Date" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="filter-record" value="Search">
                                        </div>
                                    </form>
                                </div>
                                <div class="userSearchResult table-responsive">
                                    <form action="<?php echo e(route('paymentrequestAction')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                    <table class="table table-responsive table-bordered " id="order_table">
                                        <thead>
                                            <tr>
                                            
                                                <td colspan="12" class="text-right">
                                                    <input type="submit" value="Request Payment" id="request-payment">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h4>Select</h4>
                                                </td>
                                                <td>
                                                    <h4>Order ID</h4>
                                                </td>
                                                <td>
                                                    <h4>Course Name</h4>
                                                </td>
                                                <td>
                                                    <h4>Student Name</h4>
                                                </td>
                                                <td>
                                                    <h4>Order Date</h4>
                                                </td>
                                                <td>
                                                    <h4>Price</h4>
                                                </td>
                                                <td>
                                                    <h4>Earned Percentage</h4>
                                                </td>
                                                <td>
                                                    <h4>Earned Amount</h4>
                                                </td>
                                                <td>
                                                    <h4>Payment Date</h4>
                                                </td>
                                                <td>
                                                    <h4>Pay Type</h4>
                                                </td>
                                                <td>
                                                    <h4>Cheque No/NEFT</h4>
                                                </td>
                                            
                                                <td class="text-center">
                                                    <h4>Status</h4>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody class="append-data">
                                            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <?php 
                                                $payment_info=$myLibrary->getPaymentInfo($order->order_id);
                                                // echo "<pre>";
                                                // print_r($payment_info);
                                                // echo "</pre>";
                                                $pay_date="-";
                                                $pay_type="-";
                                                $pay_str="Due";
                                                $cheque_no_neft="-";
                                                $pay_status=0;
                                                if($payment_info){
                                                    $pay_status=$payment_info->pay_status;
                                                    if($pay_status==1){
                                                        $pay_str="Requested";
                                                    }
                                                    else if($pay_status==2){
                                                        $pay_date=$payment_info->pay_date;
                                                        $cheque_no_neft=$payment_info->cheque_no_neft;
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
                                            <tr >
                                                <td class="order-td">
                                                    <input type="checkbox" name="checkdorders[]" class="order-check" <?php echo e($pay_status!=0?'disabled':''); ?> value=<?php echo e($order->order_id); ?> >
                                                    <input type="hidden" class="amount-check" name="orderamount[]" value=<?php echo e($order->commission_amount); ?> disabled="disabled" >
                                                </td>
                                                <td><?php echo e($order->reciept_id); ?></td>
                                                <td><?php echo e($order->name); ?></td>
                                                <td><?php echo e($order->username); ?></td>
                                                <td><?php echo e(\Carbon\Carbon::parse($order->created_at)->format('d/m/Y')); ?></td>
                                                <td><?php echo e($order->revised_price!=""?$order->revised_price:$order->price); ?></td>
                                                <td><?php echo e($order->commission_percent); ?></td>
                                                <td><?php echo e($order->commission_amount); ?></td>
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
                                            <tr><td colspan="12">No order yet.</td></tr>
                                            <?php endif; ?>
                                            
                                            
                                        </tbody>
                                    </table>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_js'); ?>
<script src="<?php echo e(asset('public/assets/global/scripts/datatable.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/assets/global/plugins/datatables/datatables.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>" type="text/javascript"></script>
<script>
    $('.order-check').on('click',function(){
        $(this).parents('.order-td').find('.amount-check').attr('disabled','disabled');
        if($(this).is(":checked")){
            $(this).parents('.order-td').find('.amount-check').removeAttr('disabled','disabled');

        }
    })
    $(document).ready(function(){
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            //startDate: '-3d'
        })

        $('#search-form').on('submit', function(e) {
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            //debugger
            e.preventDefault();
            let data=$("#search-form").serialize();
            let url="<?php echo e(route('ajaxpaymentFilter')); ?>";    
            $.post(url,data,function(response){
                $('.append-data').html(response.html)
                $('.tot_earned').html(response.total_earned)
                $('.paid_amount').html(response.paid_amount)
                $('.total_due').html(response.total_due)
            })
        })

        //$('.copy-to-clipboard').on
    });

function copyToClipboard(text, el) {
  var copyTest = document.queryCommandSupported('copy');
  var elOriginalText = el.attr('data-original-title');

  if (copyTest === true) {
    var copyTextArea = document.createElement("textarea");
    copyTextArea.value = text;
    document.body.appendChild(copyTextArea);
    copyTextArea.select();
    try {
      var successful = document.execCommand('copy');
      var msg = successful ? 'Copied!' : 'Whoops, not copied!';
      el.attr('data-original-title', msg).tooltip('show');
    } catch (err) {
      console.log('Oops, unable to copy');
    }
    document.body.removeChild(copyTextArea);
    el.attr('data-original-title', elOriginalText);
  } else {
    // Fallback if browser doesn't support .execCommand('copy')
    window.prompt("Copy to clipboard: Ctrl+C or Command+C, Enter", text);
  }
}

$(document).ready(function() {
  // Initialize
  // ---------------------------------------------------------------------

  // Tooltips
  // Requires Bootstrap 3 for functionality
  $('.js-tooltip').tooltip();

  // Copy to clipboard
  // Grab any text in the attribute 'data-copy' and pass it to the 
  // copy function
  $('.js-copy').click(function() {
    var text = $(this).attr('data-copy');
    var el = $(this);
    copyToClipboard(text, el);
  });
});
    // $("#order_table").dataTable({
    //         order: [[ 0, "desc" ]]
    // } );
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/reseller/dashboard.blade.php ENDPATH**/ ?>