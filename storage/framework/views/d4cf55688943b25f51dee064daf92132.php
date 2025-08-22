
<?php $__env->startSection('content'); ?>
<div class="about_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                          if (session()->has('paymentcount')) {
    
                          } else {
                             session(['paymentcount' => 1]);
                          }
                        ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <h2>Payment Details</h2>
                                    <h2 class="card-title">₹ <?php echo e(session('amount')); ?></h2>
                                    <?php if(session('paymentcount', 0) > 2): ?>
                                    <p class="text-danger card-title"> You have exceeded the maximum payment attempts. Contact support.</p>
                                    <?php else: ?>
                                       <input type="button" class="btn btn-outline-warning" value="Pay Now" name="payNow" onclick="pay_now()">
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-12">
                                    <h2 class="text-danger mt-3">
                                        <?php if(session()->has('paymentcount') && session('paymentcount')==0): ?>
                                    <?php else: ?>
                                            Payment Failed try again
                                    <?php endif; ?>
                                    </h2>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
    
    <?php if(session()->has('orderId') && session()->has('amount')): ?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

function pay_now() {
    var options = {
        "key": "<?php echo e(env('RAZORPAY_KEY')); ?>",
        "amount": <?php echo e(session('amount')  * 100); ?>,
        "currency": "INR",
        "name": "Rento",
        "description": "Test Transaction",
        "image": "https://example.com/your_logo",
        "order_id": "<?php echo e(session('orderId')); ?>",
        "handler": function(response) {
            $.ajax({
                url: "<?php echo e(route('payment_status')); ?>",
                type: "POST",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    razorpay_payment_id: response.razorpay_payment_id,
                    order_id: "<?php echo e(session('orderId')); ?>",
                    bid: "<?php echo e(session('bid')); ?>"
                },
                success: function(result) {
                    console.log("Success:", result);
                    window.location.href = "<?php echo e(route('index')); ?>";
                },
            });
        },
        "theme": {
            "color": "#3399cc"
        }
    };

    var rzp1 = new Razorpay(options);
    rzp1.on('payment.failed', function (response) {
        $.ajax({
                url: "<?php echo e(route('increment_payment_count')); ?>",
                type: "POST",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                },
                success: function(result) {
                    window.location.href = "/payments/payment_options?id=<?php echo e(session('bookingReference')); ?>";
                },
            });
    });
    rzp1.open();
}



</script>
<?php else: ?>
    <p>Invalid payment session. Please go back and try again.</p>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('hideFooter'); ?>
<!-- This section triggers the footer removal -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/payments.blade.php ENDPATH**/ ?>