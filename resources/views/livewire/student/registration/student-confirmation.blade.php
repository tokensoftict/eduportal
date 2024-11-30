<div id="category-2-part" style="margin-bottom: 30px; height: auto; min-height: 70vh">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Confirmation and Payment</h5>
                <h6 class="card-subtitle mb-2 text-muted">Please complete the required action to complete you application</h6>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-12 col-lg-6 offset-sm-3 offset-lg-3 text-center">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="text-left">Student Name</th>
                                    <td class="text-right"><strong>{{ auth('student')->user()->name }}</strong></td>
                                </tr>
                                <tr>
                                    <th class="text-left">Phone Number</th>
                                    <td class="text-right"><strong>{{ auth('student')->user()->phone }}</strong></td>
                                </tr>
                                <tr>
                                    <th class="text-left">Email Address</th>
                                    <td class="text-right"><strong>{{ auth('student')->user()->email }}</strong></td>
                                </tr>
                                <tr>
                                    <th class="text-left">Current Session</th>
                                    <td class="text-right"><strong>{{ app(\App\Classes\Settings::class)->get("session") }}</strong></td>
                                </tr>
                                <tr>
                                    <th class="text-left">Payment</th>
                                    <td class="text-right">Application Form</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Amount</th>
                                    <td class="text-right">(=N=) {{ number_format($paymentData['application_fee'],2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Paystack Charges</th>
                                    <td class="text-right">(=N=) {{ number_format($charges,2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Total</th>
                                    <th class="text-right">(=N=) {{ number_format(($paymentData['application_fee']+$charges),2) }}</th>
                                </tr>
                            </table>

                            <button wire:ignore type="button" id="payNow" class="btn btn-success btn-sm">Pay Now</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-6 text-left">
                        <button type="button" wire:click="back" class="btn btn-danger btn-lg" wire:loading.attr="disabled">
                            <span wire:loading wire:target="back" class="fa fa-spin fa-spinner" role="status"></span>
                            Back
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@script
<script>
    $('#payNow').off('click');
    $('#payNow').on("click",function (){
        $(this).attr('disabled', 'disabled').html('Please wait..')
        @this.generateTransaction().then(function(response) {
            var handler = PaystackPop.setup({
                key: '{{ $paymentData['public_key'] }}', // This is your public key only!
                email: response['email'], // Customers email
                amount: response['amount'] * 100, // The amount charged, I like big money lol
                ref: response['transactionId'], // Generate a random reference number and put here",
                metadata: { // More custom information about the transaction
                    custom_fields: [
                        {
                            'payment_type' : 'Application Fee'
                        }
                    ]
                },
                callback:  function(paystackResponse){
                    $('#payNow').removeAttr("disabled").html("Confirming Payment Please wait....").attr('disabled', 'disabled');
                    @this.confirmPayment(paystackResponse.reference).then(function(confirmResponse){
                        if(confirmResponse === "success") {
                            alert("Payment confirmed successfully");
                            alert('Your application has now been submitted');
                            window.location.reload();
                        } else {
                            alert("Payment failed, please try again");
                            $('#payNow').removeAttr('disabled').html('Pay Now');
                        }
                    })
                },
                onClose: function(){
                    $('#payNow').removeAttr('disabled').html('Pay Now');
                }
            });
            // Payment Request Just Fired
            handler.openIframe();
        })
    })
</script>
@endscript
