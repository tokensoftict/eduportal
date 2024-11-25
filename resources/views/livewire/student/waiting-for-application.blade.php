<div>
    <div id="category-2-part" style="margin-bottom: 30px;">
        <div class="container">
            <div class="card">
                <div class="card-body" style="height: 80vh">
                    <h5 class="card-title">Application Status</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Your Application status</h6>
                    <div class="card-body text-center">
                        <h6>Hello <span class="text-info">{{ auth('student')->user()->name }}, Welcome Back</span></h6>
                        <div class="alert alert-default mt-2">
                            <p>Your application status is : <strong class="{{ \App\Classes\Settings::ApplicationStatusLabel(auth('student')->user()->status) }}">{{ \App\Classes\Settings::ApplicationStatus(auth('student')->user()->status) }}</strong></p>
                        </div>

                        @if(\App\Classes\Settings::ApplicationStatus(auth('student')->user()->status)  == "Admitted")
                            <h2>Congratulations! You Have Been Admitted</h2>
                            <p>We are pleased to inform you that you have been admitted to {{ app(\App\Classes\Settings::class)->get('name') }} for the {{ auth('student')->user()->course->name }}</p>
                            <p>Your hard work and dedication have earned you a place in our institution, and we are excited to welcome you to our community of learners and achievers.</p>
                            <div class="card">
                                <div class="card-body">
                                    <h4>Acceptance Fee Payment</h4>
                                    <table class="table table-bordered">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th class="text-left">Payment</th>
                                                <td class="text-right">Acceptance Fee</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Amount</th>
                                                <td class="text-right">(=N=) {{ number_format($paymentData['acceptance_fee'],2) }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Paystack Charges</th>
                                                <td class="text-right">(=N=) {{ number_format($charges,2) }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Total</th>
                                                <th class="text-right">(=N=) {{ number_format(($paymentData['acceptance_fee']+$charges),2) }}</th>
                                            </tr>
                                        </table>

                                        <button wire:ignore type="button" id="payNow" class="btn btn-success btn-sm">Pay Now</button>
                                    </table>
                                </div>
                            </div>
                            <script>
                                window.addEventListener('load', function (){
                                    $(document).ready(function() {
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
                                                                'payment_type' : 'Acceptance Fee'
                                                            }
                                                        ]
                                                    },
                                                    callback:  function(paystackResponse){
                                                        $('#payNow').removeAttr("disabled").html("Confirming Payment Please wait....").attr('disabled', 'disabled');
                                                        @this.confirmPayment(paystackResponse.reference).then(function(confirmResponse){
                                                            if(confirmResponse === "success") {
                                                                alert("Payment confirmed successfully");
                                                                alert('Please check your mailbox for your portal login details');
                                                                window.location.reload();
                                                                $('#payNow').removeAttr('disabled').html('Pay Now');
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
                                    })
                                })

                            </script>

                         @elseif(\App\Classes\Settings::ApplicationStatus(auth('student')->user()->status)  == "Acceptance Paid")
                            <div class="col-12 col-sm-6 offset-sm-3">
                                <h6 class="mb-2 mt-2">Payment Receipts and Forms</h6>
                                <table class="table table-bordered">
                                    <!--
                                    <tr>
                                        <th class="text-left">Application Form</th>
                                        <td class="text-right"><a href="#" class="btn btn-sm btn-primary">Download <i class="fa fa-download"></i> </a> </td>
                                    </tr>
                                    -->
                                    <tr>
                                        <th class="text-left">Application Form Receipt</th>
                                        <td class="text-right"><a target="_blank" href="{{ route('student.download.application_receipt', auth('student')->user()->application_fee_transaction_id) }}" class="btn btn-sm btn-primary">Download <i class="fa fa-download"></i> </a> </td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">Acceptance Payment Receipt</th>
                                        <td class="text-right"><a target="_blank" href="{{ route('student.download.application_receipt', auth('student')->user()->application_fee_transaction_id) }}" class="btn btn-sm btn-primary">Download <i class="fa fa-download"></i> </a> </td>
                                    </tr>
                                </table>
                            </div>
                         @else

                            <div class="col-12 col-sm-6 offset-sm-3">
                                <h6 class="mb-2 mt-2">Payment Receipts and Forms</h6>
                                <table class="table table-bordered">
                                    <!--
                                    <tr>
                                        <th class="text-left">Application Form</th>
                                        <td class="text-right"><a href="#" class="btn btn-sm btn-primary">Download <i class="fa fa-download"></i> </a> </td>
                                    </tr>
                                    -->
                                    <tr>
                                        <th class="text-left">Application Receipt</th>
                                        <td class="text-right"><a target="_blank" href="{{ route('student.download.application_receipt', auth('student')->user()->application_fee_transaction_id) }}" class="btn btn-sm btn-primary">Download <i class="fa fa-download"></i> </a> </td>
                                    </tr>
                                </table>
                            </div>
                        @endif



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
