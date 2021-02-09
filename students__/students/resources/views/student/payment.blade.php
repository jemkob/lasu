@extends('adminlte::page')

@section('content')
<style type="text/css">
.solidborder{
border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;
}
</style>

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Payment Information</h3>
  </div>
  <div class="box-body">

<h1>Congratulations!</h1>
You have been offered provisional admission to Nigeria Certificat In Education Programme.
<p>&nbsp;</p><p>&nbsp;</p>
                                       
    <button class="btn btn-success">Download Admission Letter</button>


<br><br>
<form >
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <button class="btn btn-success" type="button" onclick="payWithPaystack()"> Pay </button> 
  </form>
   
  <script>
      
    function payWithPaystack(){
      var form = document.querySelector("#acceptance");
      var handler = PaystackPop.setup({
        key: 'pk_live_146f521c6930e4c9cc613266b713207dec5dcde7',
        email: form.querySelector('input[name="email"]').value,
        amount: form.querySelector('input[name="amount"]').value,
        currency: "NGN",
        ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
        metadata: {
           custom_fields: [
              {
                  display_name: form.querySelector('input[name="firstName"]').value+' '+form.querySelector('input[name="lastName"]').value,
                  variable_name: "mobile_number",
                  value: "+2348012345678"
                  
              }
           ]
        },
        callback: function(response){
            alert('success. transaction ref is ' + response.reference);
        },
        onClose: function(){
            alert('window closed');
        }
      });
      handler.openIframe();
    }

    function payWithPaystackSchoolFees(){
      var form = document.querySelector("#schoolfees");
      var handler = PaystackPop.setup({
        key: 'pk_live_146f521c6930e4c9cc613266b713207dec5dcde7',
        email: form.querySelector('input[name="email"]').value,
        amount: form.querySelector('input[name="amount"]').value,
        currency: "NGN",
        ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
        metadata: {
           custom_fields: [
              {
                  display_name: form.querySelector('input[name="firstName"]').value+' '+form.querySelector('input[name="lastName"]').value,
                  variable_name: "mobile_number",
                  value: "+2348012345678"
                  
              }
           ]
        },
        callback: function(response){
            alert('success. transaction ref is ' + response.reference);
        },
        onClose: function(){
            alert('window closed');
        }
      });
      handler.openIframe();
    }

    function payWithPaystackSchoolFees2(){
      var form = document.querySelector("#schoolfees2");
      var handler = PaystackPop.setup({
        key: 'pk_live_146f521c6930e4c9cc613266b713207dec5dcde7',
        email: form.querySelector('input[name="email"]').value,
        amount: form.querySelector('input[name="amount"]').value,
        currency: "NGN",
        ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
        metadata: {
           custom_fields: [
              {
                  display_name: form.querySelector('input[name="firstName"]').value+' '+form.querySelector('input[name="lastName"]').value,
                  variable_name: "mobile_number",
                  value: "+2348012345678"
                  
              }
           ]
        },
        callback: function(response){
            alert('success. transaction ref is ' + response.reference);
        },
        onClose: function(){
            alert('window closed');
        }
      });
      handler.openIframe();
    }
  </script>

<ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">All Payments</a></li>
        <li><a data-toggle="tab" href="#menu1">Acceptance Fees</a></li>
        <li><a data-toggle="tab" href="#menu2">School Fees</a></li>
        <li><a data-toggle="tab" href="#invoice">Invoices</a></li>
      </ul>
    
      <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
          <h3>All Payments</h3>
          <div class="col-md-12">
                <h3></h3>
      
                
                <script>
                    function setDemoData() {
                        var obj = {
                            firstName: "{{Auth::user()->Firstname}}",
                            lastName: "{{Auth::user()->Surname}}",
                            email: "{{Auth::user()->Email}}",
                            narration: "Payments",
                            amount: "40000"
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
                    // window.onload = function () {
                    //     setDemoData();
                    // };
                </script>
                <div class="box">
                        <div class="box-header">
                          <h3 class="box-title">Data Table With Full Features</h3>
                        </div>
                        <!-- /.box-header -->
                        
                        <!-- /.box-body -->
                        <div class="box-body">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Ref No.</th>
                                        <th>Session</th>
                                        <th>Desciption</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>FCE/20192020/17829</td>
                                        <td>2019/2020</td>
                                        <td>Acceptance Fee</td>
                                        <td>N10,000.00</td>
                                        <td>Pending</td>
                                        <td>
                                            <form id="acceptance">
                                                <script src="https://js.paystack.co/v1/inline.js"></script>
                                                <button class="btn btn-success" type="button" onclick="payWithPaystack()"><i class="fa fa-money"></i> Pay Now </button> 
                                              
                                    <input type="hidden" id="js-firstName" name="firstName" value ="{{Auth::user()->Firstname}}"/>
                                    <input type="hidden" id="js-lastName" name="lastName" value ="{{Auth::user()->Surname}}" class="field-divided" placeholder="Last"/>
                                    <input type="hidden" id="js-email" name="email" value ="{{Auth::user()->Email}}"/>
                                    <input type="hidden" id="js-narration" name="narration" value ="School Payments"/>
                                    <input type="hidden" id="js-amount" name="amount" value ="1000000"/>
                                    
                                     </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>FCE/20192020/17830</td>
                                        <td>2019/2020</td>
                                        <td>School Fee</td>
                                        <td>N25,000.00</td>
                                        <td>Pending</td>
                                        <td><form id="schoolfees">
                                                <script src="https://js.paystack.co/v1/inline.js"></script>
                                                <button class="btn btn-success" type="button" onclick="payWithPaystackSchoolFees()"> <i class="fa fa-money"></i> Pay Now  </button> 
                                              
                                    <input type="hidden" id="js-firstName" name="firstName" value ="{{Auth::user()->Firstname}}"/>
                                    <input type="hidden" id="js-lastName" name="lastName" value ="{{Auth::user()->Surname}}" class="field-divided" placeholder="Last"/>
                                    <input type="hidden" id="js-email" name="email" value ="{{Auth::user()->Email}}"/>
                                    <input type="hidden" id="js-narration" name="narration" value ="School Payments"/>
                                    <input type="hidden" id="js-amount" name="amount" value ="2500000"/>
                                    
                                     </form></td>
                                    </tr>
                                    <tr>
                                        <td>FCE/20192020/17831</td>
                                        <td>2019/2020</td>
                                        <td>School Fee (two O'Level results)</td>
                                        <td>N27,000.00</td>
                                        <td>Pending</td>
                                        <td>
                                            <form id="schoolfees2">
                                                <script src="https://js.paystack.co/v1/inline.js"></script>
                                                <button class="btn btn-success" type="button" onclick="payWithPaystackSchoolFees2()"><i class="fa fa-money"></i> Pay Now </button> 
                                              
                                    <input type="hidden" id="js-firstName" name="firstName" value ="{{Auth::user()->Firstname}}"/>
                                    <input type="hidden" id="js-lastName" name="lastName" value ="{{Auth::user()->Surname}}" class="field-divided" placeholder="Last"/>
                                    <input type="hidden" id="js-email" name="email" value ="{{Auth::user()->Email}}"/>
                                    <input type="hidden" id="js-narration" name="narration" value ="School Payments"/>
                                    <input type="hidden" id="js-amount" name="amount" value ="2700000"/>
                                    
                                     </form></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                      </div>
                      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
                      <script>
                            $(function () {
                           $("#example").DataTable();
                           });
                           </script>
                           <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
             
                           <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
                           
              </div>
        </div>
        <div id="menu1" class="tab-pane fade">
          <h3>Acceptance Fee</h3>
          <div class="col-md-12">
                <hr /><br />
                <div class="row box-body">
                    <div class="col-md-12">
                                    
                                    <div class="col-md-6">
                                       <h2>Fees</h2>
                                        
                                        <table class="table responsive">
                                            <tr>
                                                <td>Acceptance Fee</td>
                                                <td>N10,000.00</td>
                                                <td><form id="payment-form">
                                                    <script src="http://www.remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>
                                            <input type="hidden" id="js-firstName" name="firstName" value ="{{Auth::user()->Firstname}}"/>
                                            <input type="hidden" id="js-lastName" name="lastName" value ="{{Auth::user()->Surname}}" class="field-divided" placeholder="Last"/>
                                            <input type="hidden" id="js-email" name="email" value ="{{Auth::user()->Firstname}}"/>
                                            <input type="hidden" id="js-narration" name="narration" value ="School Payments"/>
                                            <input type="hidden" id="js-amount" name="amount" value ="10000"/>
                                            <input type="button" onclick="makePayment()" value="Pay" class="btn btn-success"/>
                                             </form></td>
                                            </tr>
                                             
                                        </table>
                                    </div>
                                </div>
                </div>
                    
                        <hr />
                        
                    </div>
        </div>
        <div id="menu2" class="tab-pane fade">
          <h3>School Fees</h3>
          <div class="col-md-6">
            <h2>Fees</h2>
             
             <table class="table responsive">
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

        {{-- Edit O level --}}
        <div id="invoice" class="tab-pane fade">
            <h3>Invoices</h3>
            
          </div>
          {{-- end edit olevel --}}
        <div id="menu3" class="tab-pane fade">
          <h3>Add UTME Result</h3>
          aindii
        </div>
      </div>

        <hr />


</div>

</div>
@endsection
