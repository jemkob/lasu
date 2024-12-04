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
        <li class="active"><a data-toggle="tab" href="#home">RRR Verification</a></li>
        {{-- <li><a data-toggle="tab" href="#menu1">Acceptance Fees</a></li>
        <li><a data-toggle="tab" href="#menu2">School Fees</a></li>
        <li><a data-toggle="tab" href="#invoice">Invoices</a></li> --}}
      </ul>
    
      <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
          <h3>RRR Verification</h3>
          <div class="col-md-12">
                <h3></h3>
      
                
                
                <div class="box">
                        <div class="box-header">
                          <h3 class="box-title bg-danger">Kindly verify your Remita payment details: RRR</h3>
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

<div class="col-sm-4">
  <form action="{{url('student/verifypayment')}}" method="post">
    {{csrf_field()}}
          

        <div class="form-group">
          <label for="">Items</label>
          <select class="form-control" name="fees" id="fees" required="required">
            <option value="" disable="true" selected="true">--- Select Fee Type---</option>
            <option value="1">School fees</option>
            <option value="2">DEWS</option>
          </select>
        </div>

        <div class="form-group">
              <label for="">RRR</label>
              <input type="text" class="form-control" name="rrr" required placeholder="eg: 2302819928837">
        </div>
          <div class="col-md-6">
            <button class="btn btn-primary" type="submit">Verify RRR</button>
        </div>
  </form>
</div>

                            {{-- <table id="example" class="display" style="width:100%">
                              <form action="verify" method="post">
                                @csrf

                              </form>
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
                                
                            </table> --}}
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
         
        </div>
      </div>

        <hr />


</div>

</div>
@endsection
