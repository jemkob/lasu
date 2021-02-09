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

afasdfas
   
  <script>
      
    function payWithPaystack(){
      var form = document.querySelector("#dews");
      var handler = PaystackPop.setup({
        key: 'pk_test_a305576e7ab28e7e64ab4a3c494cb702e69560d7',
        email: form.querySelector('input[name="email"]').value,
        amount: form.querySelector('input[name="amount"]').value,
        currency: "NGN",
        ref: form.querySelector('input[name="ref"]').value, // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
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
            location.replace("{{route('verifypayment')}}?ref="+response.reference);
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
        key: 'pk_test_a305576e7ab28e7e64ab4a3c494cb702e69560d7',
        email: form.querySelector('input[name="email"]').value,
        amount: form.querySelector('input[name="amount"]').value,
        currency: "NGN",
        callback_url: "",
        ref: form.querySelector('input[name="ref"]').value, // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
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
            location.replace("{{route('verifypayment')}}?ref="+response.reference);
        },
        onClose: function(){
            alert('window closed');
        }
      });
      handler.openIframe();
    }

    function payWithPaystackNevs(){
      var form = document.querySelector("#nevs");
      var handler = PaystackPop.setup({
        key: 'pk_test_a305576e7ab28e7e64ab4a3c494cb702e69560d7',
        email: form.querySelector('input[name="email"]').value,
        amount: form.querySelector('input[name="amount"]').value,
        currency: "NGN",
        ref: form.querySelector('input[name="ref"]').value, // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
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
            location.replace("{{route('verifypayment')}}?ref="+response.reference);
        },
        onClose: function(){
            alert('window closed');
        }
      });
      handler.openIframe();
    }

    function payWithPaystackPsycho(){
      var form = document.querySelector("#psycho");
      var handler = PaystackPop.setup({
        key: 'pk_test_a305576e7ab28e7e64ab4a3c494cb702e69560d7',
        email: form.querySelector('input[name="email"]').value,
        amount: form.querySelector('input[name="amount"]').value,
        currency: "NGN",
        ref: form.querySelector('input[name="ref"]').value, // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
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
            location.replace("{{route('verifypayment')}}?ref="+response.reference);
        },
        onClose: function(){
            alert('window closed');
        }
      });
      handler.openIframe();
    }

    function payWithPaystackHostel(){
      var form = document.querySelector("#hostel");
      var handler = PaystackPop.setup({
        key: 'pk_test_a305576e7ab28e7e64ab4a3c494cb702e69560d7',
        email: form.querySelector('input[name="email"]').value,
        amount: form.querySelector('#amount option:checked').value,
        currency: "NGN",
        ref: form.querySelector('input[name="ref"]').value, // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
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
            // alert('success. transaction ref is ' + response.reference);
            location.replace("{{route('verifypayment')}}?ref="+response.reference);
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
        {{-- <li><a data-toggle="tab" href="#menu1">Acceptance Fees</a></li>
        <li><a data-toggle="tab" href="#menu2">School Fees</a></li>
        <li><a data-toggle="tab" href="#invoice">Invoices</a></li> --}}
      </ul>
    
      <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
          <h3>All Payments</h3>
          <div class="col-md-12">
                <h3></h3>
      
                
                
                <div class="box">
                        <div class="box-header">
                          <h3 class="box-title bg-danger">Items in asterik (*) are compulsory.</h3>
                        </div>
                        <!-- /.box-header -->
                        
                        <!-- /.box-body -->
                        <div class="box-body">
                            <?php 
                              if(Auth::user()->Level == 100 && empty(Auth::user()->MatricNo)){
                                $ref = str_replace("/","","FCE/20192020/".Auth::user()->JambRegNo);
                              } else {
                              $ref = str_replace("/","","FCE/20192020/".Auth::user()->MatricNo);
                              } ?>
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Ref No.</th>
                                        <th>Session</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if(Auth::user()->Level == 300)
                                    <tr>
                                        <td>FCE/20192020/{{Auth::user()->MatricNo}}/1</td>
                                        <td>2019/2020</td>
                                        <td>SCHOOL FEES<span class="text-danger font-weight-bold">*</span></td>
                                        <td>N17,580.00</td>
                                        <td>@if($payment1 && $payment1->status='paid') Paid @else Pending @endif</td>
                                        <td> <a class="btn btn-warning" href="{{route('printreceipt')}}?ref={{$ref}}1"><i class="fa fa-print"></i> @if($payment1 && $payment1->status='paid') Print Receipt @else Generate Invoice @endif </a><br></td>
                                    </tr>
                                    <tr>
                                        <td>FCE/20192020/{{Auth::user()->MatricNo}}/2</td>
                                        <td>2019/2020</td>
                                        <td>DEWS<span class="text-danger">*</span></td>
                                        <td>N2,500.00</td>
                                        <td>@if($payment2 && $payment2->status='paid') Paid @else Pending @endif</td>
                                        <td>
                                            <a class="btn btn-warning" href="{{route('printreceipt')}}?ref={{$ref}}2"><i class="fa fa-print"></i> @if($payment2 && $payment2->status='paid') Print Receipt @else Generate Invoice @endif </a> 
                                        </td>
                                    </tr>
                                    @elseif(Auth::user()->Level == 200)
                                    <tr>
                                        <td>FCE/20192020/{{Auth::user()->MatricNo}}/1</td>
                                        <td>2019/2020</td>
                                        <td>SCHOOL FEES<span class="text-danger font-weight-bold">*</span></td>
                                        <td>N16,830.00</td>
                                        <td>@if($payment1 && $payment1->status='paid') Paid @else Pending @endif</td>
                                        <td> <a class="btn btn-warning" href="{{route('printreceipt')}}?ref={{$ref}}1"><i class="fa fa-print"></i> @if($payment1 && $payment1->status='paid') Print Receipt @else Generate Invoice @endif </a><br></td>
                                    </tr>
                                    <tr>
                                        <td>FCE/20192020/{{Auth::user()->MatricNo}}/2</td>
                                        <td>2019/2020</td>
                                        <td>DEWS<span class="text-danger">*</span></td>
                                        <td>N5,000.00</td>
                                        <td>@if($payment2 && $payment2->status='paid') Paid @else Pending @endif</td>
                                        <td>
                                            <a class="btn btn-warning" href="{{route('printreceipt')}}?ref={{$ref}}2"><i class="fa fa-print"></i> @if($payment2 && $payment2->status='paid') Print Receipt @else Generate Invoice @endif </a> 
                                        </td>
                                    </tr>
                                    @elseif(Auth::user()->Level == 100)
                                    <tr>
                                        <td>FCE/20192020/{{Auth::user()->MatricNo}}/009</td>
                                        <td>2019/2020</td>
                                        <td>ACCEPTANCE FEES<span class="text-danger font-weight-bold">*</span>
                                        <br>
                                        Internet Training/Facility<span class="text-danger font-weight-bold">*</span>
                                        </td>
                                        <td>N10,000.00 <br> N5,500.00</td>
                                        <td>@if($payment9 && $payment9->status='paid') Paid @else Pending @endif</td>
                                        <td> <a class="btn btn-warning" href="{{route('printreceipt')}}?ref={{$ref}}9"><i class="fa fa-print"></i> @if($payment9 && $payment9->status='paid') Print Receipt @else Generate Invoice @endif </a><br></td>
                                    </tr>
                                    <tr>
                                        <td>FCE/20192020/{{Auth::user()->MatricNo}}/1</td>
                                        <td>2019/2020</td>
                                        <td>SCHOOL FEES<span class="text-danger font-weight-bold">*</span></td>
                                        <td>N28,485.00</td>
                                        <td>@if($payment1 && $payment1->status='paid') Paid @else Pending @endif</td>
                                        <td> <a class="btn btn-warning" href="{{route('printreceipt')}}?ref={{$ref}}1"><i class="fa fa-print"></i> @if($payment1 && $payment1->status='paid') Print Receipt @else Generate Invoice @endif </a><br></td>
                                    </tr>
                                    <tr>
                                        <td>FCE/20192020/{{Auth::user()->MatricNo}}/2</td>
                                        <td>2019/2020</td>
                                        <td>DEWS<span class="text-danger">*</span></td>
                                        <td>N5,000.00</td>
                                        <td>@if($payment2 && $payment2->status='paid') Paid @else Pending @endif</td>
                                        <td>
                                            <a class="btn btn-warning" href="{{route('printreceipt')}}?ref={{$ref}}2"><i class="fa fa-print"></i> @if($payment2 && $payment2->status='paid') Print Receipt @else Generate Invoice @endif </a> 
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td>FCE/20192020/{{Auth::user()->MatricNo}}/3</td>
                                        <td>2019/2020</td>
                                        <td>NEVS </td>
                                        <td>@if(Auth::user()->Level == 100)N2,500.00 @else N2,000.00 @endif</td>
                                        <td>@if($payment3 && $payment3->status='paid') Paid @else Pending @endif</td>
                                        <td>
                                            <a class="btn btn-warning" href="{{route('printreceipt')}}?ref={{$ref}}3"><i class="fa fa-print"></i> @if($payment3 && $payment3->status='paid') Print Receipt @else Generate Invoice @endif </a>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>FCE/20192020/{{Auth::user()->MatricNo}}/4</td>
                                        <td>2019/2020</td>
                                        <td>PSYCHOMETRIC EDUCATION</td>
                                        <td>N3,000.00</td>
                                        <td>@if($payment4 && $payment4->status='paid') Paid @else Pending @endif</td>
                                        <td>
                                          <a class="btn btn-warning" href="{{route('printreceipt')}}?ref={{$ref}}4"><i class="fa fa-print"></i> @if($payment4 && $payment4->status='paid') Print Receipt @else Generate Invoice @endif </a>
                                        </td>
                                    </tr>
                                    
                                        <tr>
                                        <td>FCE/20192020/{{Auth::user()->MatricNo}}/5</td>
                                        <td>2019/2020</td>
                                        <td>HOSTEL ACCOMMODATION</td>
                                        
                                        <td></td>
                                        <td>@if($payment5 && $payment5->status='paid') Paid @else Pending @endif</td>
                                        <td>
                                            
                                                
                                                <a class="btn btn-warning" href="{{route('printreceipt')}}?ref={{$ref}}5"><i class="fa fa-print"></i> @if($payment5 && $payment5->status='paid') Print Receipt @else Generate Invoice @endif </a>
                                                
                                    
                                    
                                    {{-- <input type="hidden" id="js-amount" name="amount" value ="2700000"/> --}}
                                    
                                     </td>
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
