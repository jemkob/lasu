@extends('adminlte::page')

@section('title', 'Student Dashboard')

@section('content')
<div class="box">
<div class="box-header with-border">
    <h2 class="box-title">Dashboard</h2>
</div>
    <div class="box-body">
        <div class="row box-body">
            <div class="col-md-12">
                            <strong>Congratulations</strong>
                            <hr>
                           
                            <div class="col-md-6"> 
                                You've been offered provisional admission.
                                <button>Download Admission Letter</button>

                            </div>
                            <div class="col-md-6">
                               <h2>Fees</h2>
                                
                                <table class="table responsive">
                                    <tr>
                                        <td>Acceptance Fee</td>
                                        <td>N10,000.00</td>
                                        <td><button class="btn btn-success">Pay Now</button></td>
                                    </tr>
                                     <tr>
                                        <td>School Fees(one O'level)</td>
                                        <td>N25,000.00 </td>
                                        <td>
                        <form onsubmit="makePayment()" id="payment-form">
                                <script src="http://www.remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>
                        <input type="hidden" id="js-firstName" name="firstName" value ="{{Auth::user()->Firstname}}"/>
                        <input type="hidden" id="js-lastName" name="lastName" value ="{{Auth::user()->Surname}}" class="field-divided" placeholder="Last"/>
                        <input type="hidden" id="js-email" name="email" value ="{{Auth::user()->Firstname}}"/>
                        <input type="hidden" id="js-narration" name="narration" value ="School Payments"/>
                        <input type="hidden" id="js-amount" name="amount" value ="25000"/>
                        <input type="button" onclick="makePayment()" value="Pay" class="btn btn-success"/>
                         </form></td>
                                    </tr>
                                    <tr>
                                        <td>School Fees(Two O'level)</td>
                                        <td>N27,000.00 </td>
                                        <td>
                                            <form onsubmit="makePayment()" id="payment-form">
                                                    <script src="http://www.remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>
                        <input type="hidden" id="js-firstName" name="firstName" value ="{{Auth::user()->Firstname}}"/>
                        <input type="hidden" id="js-lastName" name="lastName" value ="{{Auth::user()->Surname}}" class="field-divided" placeholder="Last"/>
                        <input type="hidden" id="js-email" name="email" value ="{{Auth::user()->Firstname}}"/>
                        <input type="hidden" id="js-narration" name="narration" value ="School Payments"/>
                        <input type="hidden" id="js-amount" name="amount" value ="27000"/>
                        <input type="button" onclick="makePayment()" value="Pay" class="btn btn-success"/>
                         </form>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
        </div>
    </div>
</div>
<script>
        function setDemoData() {
            var obj = {
                firstName: "{{Auth::user()->Firstname}}",
                lastName: "{{Auth::user()->Surname}}",
                email: "{{Auth::user()->Email}}",
                narration: "Payments",
                amount: "19999"
            };
            for (var propName in obj) {
                document.querySelector('#js-' + propName).setAttribute('value', obj[propName]);
            }
        }
        function makePayment() {
            var form = document.querySelector("#payment-form");
            var paymentEngine = RmPaymentEngine.init({
                key: 'amVta29iQHlhaG9vLmNvbXw0MjUwODc0MHxlNjNiY2Y3ODEwZGRkMDMzZWQ4MTAxNjI0MWY4OWFjYTEwZmQ2YjQxN2EyZmRkNGVlNTg5NjVkZWQxYjliYjViM2ZmMjI1MDNkZmMzMjBlMjIxNGY5NDM0MzBiY2Q3OTRlMTNlODliMGUxMmE4NDNhNmVkMzE0MjQ2MjQzMjRkMQ==',
                customerId: form.querySelector('input[name="email"]').value,
                firstName: form.querySelector('input[name="firstName"]').value,
                lastName: form.querySelector('input[name="lastName"]').value,
                email: form.querySelector('input[name="email"]').value,
                amount: form.querySelector('input[name="amount"]').value,
                narration: form.querySelector('input[name="narration"]').value,
                onSuccess: function (response) {
                    console.log('callback Successful Response', response);
                },
                onError: function (response) {
                    console.log('callback Error Response', response);
                },
                onClose: function () {
                    console.log("closed");
                }
            });
             paymentEngine.showPaymentWidget();
        }
        window.onload = function () {
            setDemoData();
        };
    </script>
@endsection

