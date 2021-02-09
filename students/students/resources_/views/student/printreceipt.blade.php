<style type="text/css">
  .receipt {
    font-family: "Arial", "Lucida Sans Unicode", "Lucida Grande", sans-serif;
    font-size: 12px;
  }
  .header {
	font-family: "Arial Black", Gadget, sans-serif;
	font-size: 16px;
}
@media print
        {
        .noprint {display:none;}
        }
  </style>
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
            // alert('success. transaction ref is ' + response.reference);
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
            // alert('success. transaction ref is ' + response.reference);
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
            // alert('success. transaction ref is ' + response.reference);
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
            // alert('success. transaction ref is ' + response.reference);
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
  
 
  {{-- <body onload="javacript:window.print()"> --}}
    <body>
      
    <?php $ref = Request::get('ref'); 
    $indexx=substr($ref,-1);
    ?>

    <div align="center" class="receipt">
    <table width="650" border="0" background="../images/osielereceipt_bg.jpg">
            <tr>
              <td><table width="100%" border="0">
                <tr>
                  <td width="9%"><img name="osiele_logo" src="../images/logo.png" width="77" height="65" alt="" /></td>
                  <td width="91%" align="center" valign="top" class="header">FEDERAL COLLEGE OF EDUCATION, ABEOKUTA</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="center">
                @if($payment1 && $payment1->status == 'paid' && $payment1->referenceno == $ref) STUDENT RECEIPT 
                @elseif($payment2 && $payment2->status == 'paid' && $payment2->referenceno == $ref) STUDENT RECEIPT 
                @elseif($payment3 && $payment3->status == 'paid' && $payment3->referenceno == $ref) STUDENT RECEIPT 
                @elseif($payment4 && $payment4->status == 'paid' && $payment4->referenceno == $ref) STUDENT RECEIPT 
                @elseif($payment5 && $payment5->status == 'paid' && $payment5->referenceno == $ref) STUDENT RECEIPT @else   STUDENT INVOICE @endif
              </td>
            </tr>
            <tr>
              <td>
               
                <table width="100%" border="0">
                <tr>
                  <td nowrap="nowrap">Student Name: <strong>{{Auth::user()->Surname.' '.Auth::user()->Firstname.' '.Auth::user()->Middlename}}</strong></td>
                  <td nowrap="nowrap">Programme: <strong>NCE</strong></td>
                </tr>
                <tr>
                    @if($payment1 && $payment1->status == 'paid' && $payment1->referenceno == $ref) 
                    <td nowrap="nowrap">Trans Date: <strong>{{ $payment1->transactiondate }}</strong></td> 
                    @elseif($payment2 && $payment2->status == 'paid' && $payment2->referenceno == $ref) <td nowrap="nowrap">Trans Date: <strong>{{ $payment2->transactiondate }}</strong></td> 
                    @elseif($payment3 && $payment3->status == 'paid' && $payment3->referenceno == $ref) <td nowrap="nowrap">Trans Date: <strong>{{ $payment3->transactiondate }}</strong></td> 
                    @elseif($payment4 && $payment4->status == 'paid' && $payment4->referenceno == $ref) <td nowrap="nowrap">Trans Date: <strong>{{ $payment4->transactiondate }}</strong></td> 
                    @elseif($payment5 && $payment5->status == 'paid' && $payment5->referenceno == $ref) 
                    <td nowrap="nowrap">Trans Date: <strong>{{ $payment1->transactiondate }}</strong></td> 
                    @else 
                  <td nowrap="nowrap">Invoice Date: <strong>{{ date('d-m-Y') }}</strong></td>
                  @endif
                <td nowrap="nowrap">Department: <strong>{{Auth::user()->Major.'/'.Auth::user()->Minor}}</strong></td>
                </tr>
                <tr>
                  <td>Trans Ref: <strong>{{ Request::get('ref') }}</strong></td>
                  <td>Session: <strong>2019/2020</strong></td>
                </tr>
                <tr>
                  @if(Auth::user()->Level == 100 && empty(Auth::user()->MatricNo))
                  <td nowrap="nowrap">JAMB No.: <strong>{{Auth::user()->JambRegNo}}</strong></td>
                  @else 
                  <td nowrap="nowrap">Matric No.: <strong>{{Auth::user()->MatricNo}}</strong></td>
                  @endif
                  <td>Level: <strong>@if(Auth::user()->Level ==300) NCE III @elseif(Auth::user()->Level ==200) NCE II @elseif(Auth::user()->Level ==100) NCE I @endif</strong></td>
                </tr> 
              </table></td>
            </tr>
            <tr>
              <td>
                <?php 
                if(Auth::user()->Level == 100 && empty(Auth::user()->MatricNo)){
                $ref = str_replace("/","","FCE/20192020/".Auth::user()->JambRegNo);
                } else {
                  $ref = str_replace("/","","FCE/20192020/".Auth::user()->MatricNo);
                }
                ?>
                  @if($indexx==1)
                  @if(Auth::user()->Level ==300)
                <table width="100%" border="1" cellpadding="2" cellspacing="0">
                <tr>
                  <td width="10%">S/N</td>
                  <td width="70%">Payment Description</td>
                  <td width="20%" align="right">Amount</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Registration</td>
                  <td align="right">700.00</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Examination</td>
                  <td align="right">1,500.00</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Caution</td>
                  <td align="right">0.00</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Sports</td>
                  <td align="right">350.00</td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>I.D Card</td>
                  <td align="right">400.00</td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>Library</td>
                  <td align="right">250.00</td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>Medical Examination</td>
                  <td align="right">0.00</td>
                </tr>
                <tr>
                  <td>8</td>
                  <td>NHIS</td>
                  <td align="right">2,000.00</td>
                </tr>
                <tr>
                  <td>9</td>
                  <td>Certificate Verification</td>
                  <td align="right">0.00</td>
                </tr>
                <tr>
                  <td>10</td>
                  <td>Edu. Portal/ICT</td>
                  <td align="right">3,000.00</td>
                </tr>
                <tr>
                  <td>11</td>
                  <td>Internet Facility</td>
                  <td align="right">3,600.00</td>
                </tr>
                <tr>
                  <td>12</td>
                  <td>College Documentary</td>
                  <td align="right">0.00</td>
                </tr>
                <tr>
                  <td>13</td>
                  <td> Student Handbook</td>
                  <td align="right">0.00</td>
                </tr>
                <tr>
                  <td>14</td>
                  <td>College Publication / Journal</td>
                  <td align="right">0.00</td>
                </tr>
                <tr>
                  <td>15</td>
                  <td>Matriculation</td>
                  <td align="right">0.00</td>
                </tr>
                <tr>
                  <td>16</td>
                  <td>Alumni Hostel Project</td>
                  <td align="right">0.00</td>
                </tr>
                <tr>
                  <td>17</td>
                  <td>College Development</td>
                  <td align="right">650.00</td>
                </tr>
                <tr>
                  <td>18</td>
                  <td>Studio/Lab/Workshop Equipment</td>
                  <td align="right">1,000.00</td>
                </tr>
                <tr>
                  <td>19</td>
                  <td>Convocation</td>
                  <td align="right">2,500.00</td>
                </tr>
                <tr>
                  <td>20</td>
                  <td>Accident Insurance Scheme</td>
                  <td align="right">450</td>
                </tr>
                <tr>
                  <td>21</td>
                  <td>Campus Alert</td>
                  <td align="right">530.00</td>
                </tr>
                <tr>
                  <td>22</td>
                  <td>Utility</td>
                  <td align="right">650.00</td>
                </tr>
                <tr>
                  <td>23</td>
                  <td>College Special Bulletin</td>
                  <td align="right">0.00</td>
                </tr>
                <tr>
                  <td><strong>Total</strong></td>
                  <td colspan="2" align="right"><strong>17,580.00</strong></td>
                  
                </tr>
                <tr>
                  <td colspan="2"><strong>Amount in words: Seventeen thousand, five hundred and eighty naira only</strong></td>
                  
                  
                </tr>
              </table>
              @elseif(Auth::user()->Level == 200)
              <table width="100%" border="1" cellpadding="2" cellspacing="0">
                  <tr>
                    <td width="10%">S/N</td>
                    <td width="70%">Payment Description</td>
                    <td width="20%" align="right">Amount</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>Registration</td>
                    <td align="right">1000.00</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Examination</td>
                    <td align="right">2,000.00</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Caution</td>
                    <td align="right">0.00</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Sports</td>
                    <td align="right">600.00</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>I.D Card</td>
                    <td align="right">400.00</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td>Library</td>
                    <td align="right">250.00</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td>Medical Examination</td>
                    <td align="right">0.00</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td>NHIS</td>
                    <td align="right">2,000.00</td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td>Certificate Verification</td>
                    <td align="right">0.00</td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td>Edu. Portal/ICT</td>
                    <td align="right">3,500.00</td>
                  </tr>
                  <tr>
                    <td>11</td>
                    <td>Internet Facility</td>
                    <td align="right">3,600.00</td>
                  </tr>
                  <tr>
                    <td>12</td>
                    <td>College Documentary</td>
                    <td align="right">0.00</td>
                  </tr>
                  <tr>
                    <td>13</td>
                    <td> Student Handbook</td>
                    <td align="right">0.00</td>
                  </tr>
                  <tr>
                    <td>14</td>
                    <td>College Publication / Journal</td>
                    <td align="right">0.00</td>
                  </tr>
                  <tr>
                    <td>15</td>
                    <td>Matriculation</td>
                    <td align="right">0.00</td>
                  </tr>
                  <tr>
                    <td>16</td>
                    <td>Alumni Hostel Project</td>
                    <td align="right">0.00</td>
                  </tr>
                  <tr>
                    <td>17</td>
                    <td>College Development</td>
                    <td align="right">850.00</td>
                  </tr>
                  <tr>
                    <td>18</td>
                    <td>Studio/Lab/Workshop Equipment</td>
                    <td align="right">1,000.00</td>
                  </tr>
                  <tr>
                    <td>19</td>
                    <td>Convocation</td>
                    <td align="right">0.00</td>
                  </tr>
                  <tr>
                    <td>20</td>
                    <td>Accident Insurance Scheme</td>
                    <td align="right">450</td>
                  </tr>
                  <tr>
                    <td>21</td>
                    <td>Campus Alert</td>
                    <td align="right">530.00</td>
                  </tr>
                  <tr>
                    <td>22</td>
                    <td>Utility</td>
                    <td align="right">650.00</td>
                  </tr>
                  <tr>
                    <td>23</td>
                    <td>College Special Bulletin</td>
                    <td align="right">0.00</td>
                  </tr>
                  <tr>
                    <td><strong>Total</strong></td>
                    <td colspan="2" align="right"><strong>16,830.00</strong></td>
                    
                  </tr>
                  <tr>
                    <td colspan="2"><strong>Amount in words: Sixteen thousand, eight hundred and thirty naira only</strong></td>
                    
                    
                  </tr>
                </table>
                @elseif(Auth::user()->Level == 100)
              <table width="100%" border="1" cellpadding="2" cellspacing="0">
                  <tr>
                    <td width="10%">S/N</td>
                    <td width="70%">Payment Description</td>
                    <td width="20%" align="right">Amount</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>Registration</td>
                    <td align="right">2500.00</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Examination</td>
                    <td align="right">2,500.00</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Caution</td>
                    <td align="right">800.00</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Sports</td>
                    <td align="right">850.00</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>I.D Card</td>
                    <td align="right">655.00</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td>Library</td>
                    <td align="right">500.00</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td>Medical Examination</td>
                    <td align="right">1,000.00</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td>NHIS</td>
                    <td align="right">2,000.00</td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td>Certificate Verification</td>
                    <td align="right">1,500.00</td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td>Edu. Portal/ICT</td>
                    <td align="right">3,500.00</td>
                  </tr>
                  <tr>
                    <td>11</td>
                    <td>Internet Facility</td>
                    <td align="right">3,600.00</td>
                  </tr>
                  <tr>
                    <td>12</td>
                    <td> Student Handbook</td>
                    <td align="right">1,500.00</td>
                  </tr>
                  <tr>
                    <td>13</td>
                    <td>College Publication / Journal</td>
                    <td align="right">2,400.00</td>
                  </tr>
                  <tr>
                    <td>14</td>
                    <td>Matriculation</td>
                    <td align="right">1,000.00</td>
                  </tr>
                  <tr>
                    <td>15</td>
                    <td>Alumni Hostel Project</td>
                    <td align="right">500.00</td>
                  </tr>
                  <tr>
                    <td>16</td>
                    <td>College Development</td>
                    <td align="right">2,000.00</td>
                  </tr>
                  <tr>
                    <td>17</td>
                    <td>Studio/Lab/Workshop Equipment</td>
                    <td align="right">1,500.00</td>
                  </tr>
                  <tr>
                    <td>18</td>
                    <td>Convocation</td>
                    <td align="right">0.00</td>
                  </tr>
                  <tr>
                    <td>19</td>
                    <td>Accident Insurance Scheme</td>
                    <td align="right">450.00</td>
                  </tr>
                  <tr>
                    <td>20</td>
                    <td>Campus Alert</td>
                    <td align="right">530.00</td>
                  </tr>
                  <tr>
                    <td>21</td>
                    <td>Utility</td>
                    <td align="right">1,800.00</td>
                  </tr>
                  <tr>
                    <td><strong>Total</strong></td>
                    <td colspan="2" align="right"><strong>28,485.00</strong></td>
                    
                  </tr>
                  <tr>
                    <td colspan="2"><strong>Amount in words: Twenty eight thousand, four hundred and eighty five naira only</strong></td>
                    
                    
                  </tr>
                </table>
                @endif
              <br>
              <table align="right" class="noprint">
                  <tr>
                    <td>
                      <button onclick="javacript:window.print()" class="btn btn-warning">
                          <i class="fa fa-print"></i> @if(!$payment1)PRINT INVOICE @else PRINT RECEIPT @endif</button>
                    </td>
                    @if(!$payment1) 
                    <td>&nbsp;</td>
                    <td>
                      <a href="{{url('student/payment')}}" class="btn btn-warning">CANCEL</a>
                      
                    </td>
                    <td>&nbsp;</td>
                    <td><form id="schoolfees">
                      <script src="https://js.paystack.co/v1/inline.js"></script>
                      
                    
          <input type="hidden" id="js-firstName" name="firstName" value ="{{Auth::user()->Firstname}}"/>
          <input type="hidden" id="js-lastName" name="lastName" value ="{{Auth::user()->Surname}}" class="field-divided" placeholder="Last"/>
          <input type="hidden" id="js-email" name="email" value ="{{Auth::user()->Email}}"/>
          <input type="hidden" id="js-narration" name="narration" value ="School fees Payment for {{Auth::user()->MatricNo}}"/>
          @if(Auth::user()->Level == 100)
          <input type="hidden" id="js-amount" name="amount" value ="{{2848500+10000+(2848500*0.015)}}"/>
          @elseif(Auth::user()->Level == 300)
          <input type="hidden" id="js-amount" name="amount" value ="{{1758000+10000+(1758000*0.015)}}"/>
          @elseif(Auth::user()->Level == 200)
          <input type="hidden" id="js-amount" name="amount" value ="{{1683000+10000+(1683000*0.015)}}"/>
          @elseif(Auth::user()->Level > 300)
          <input type="hidden" id="js-amount" name="amount" value ="{{1148000+10000+(1148000*0.015)}}"/>
          @endif
          <?php //$ref = str_replace("/","","FCE/20192020/".Auth::user()->MatricNo."/1");?>
          <input type="hidden" id="ref" name="ref" value ="{{$ref."1"}}"/>
          
          
           </form><button class="btn btn-success" type="button" onclick="payWithPaystackSchoolFees()"> <i class="fa fa-money"></i> Pay Now  </button>
                    </td>@endif
                  </tr>
                </table>
            @endif
            @if($indexx==2)
            @if(Auth::user()->Level == 300)
            <table width="100%" border="1" cellpadding="2" cellspacing="0">
                <tr>
                  <td width="10%">S/N</td>
                  <td width="70%">Payment Description</td>
                  <td width="20%" align="right">Amount</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>DEWS</td>
                  <td align="right">2,500.00</td>
                </tr>
                <tr>
                  <td><strong>Total</strong></td>
                  <td colspan="2" align="right"><strong>2,500.00</strong></td>
                  
                </tr>
                <tr>
                  <td colspan="2"><strong>Amount in words: Two thousand and five hundred naira only</strong></td>
                  
                  
                </tr>
              </table>
              @elseif(Auth::user()->Level <= 200)
              <table width="100%" border="1" cellpadding="2" cellspacing="0">
                  <tr>
                    <td width="10%">S/N</td>
                    <td width="70%">Payment Description</td>
                    <td width="20%" align="right">Amount</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>DEWS</td>
                    <td align="right">5,000.00</td>
                  </tr>
                  <tr>
                    <td><strong>Total</strong></td>
                    <td colspan="2" align="right"><strong>5,000.00</strong></td>
                    
                  </tr>
                  <tr>
                    <td colspan="2"><strong>Amount in words: Five thousand naira only</strong></td>
                    
                    
                  </tr>
                </table>
              @endif
              <br>
              <table align="right" class="noprint">
                  <tr>
                    <td>
                      <button onclick="javacript:window.print()" class="btn btn-warning">
                          <i class="fa fa-print"></i>@if(!$payment2)PRINT INVOICE @else PRINT RECEIPT @endif</button>
                    </td>
                    @if(!$payment2)
                    <td>&nbsp;</td>
                    <td>
                      <a href="{{url('student/payment')}}" class="btn btn-warning">CANCEL</a>
                      
                    </td>
                    <td>&nbsp;</td>
                    <td><form id="dews">
                        <script src="https://js.paystack.co/v1/inline.js"></script>
                         
                      
            <input type="hidden" id="js-firstName" name="firstName" value ="{{Auth::user()->Firstname}}"/>
            <input type="hidden" id="js-lastName" name="lastName" value ="{{Auth::user()->Surname}}" class="field-divided" placeholder="Last"/>
            <input type="hidden" id="js-email" name="email" value ="{{Auth::user()->Email}}"/>
            <input type="hidden" id="js-narration" name="narration" value ="DEWS Payment"/>
            @if(Auth::user()->Level == 300)
            <input type="hidden" id="js-amount" name="amount" value ="{{250000+10000+(250000*0.015)}}"/>
            @elseif(Auth::user()->Level <= 200)
            <input type="hidden" id="js-amount" name="amount" value ="{{500000+10000+(500000*0.015)}}"/>
            @endif
            <?php //$ref = str_replace("/","","FCE/20192020/".Auth::user()->MatricNo."/2");?>
            <input type="hidden" id="ref" name="ref" value ="{{$ref."2"}}"/>
            
             </form><button class="btn btn-success" type="button" onclick="payWithPaystack()"><i class="fa fa-money"></i> Pay Now </button>
                    </td>@endif
                  </tr>
                </table>
            @endif
            @if($indexx==3)
            <table width="100%" border="1" cellpadding="2" cellspacing="0">
                <tr>
                  <td width="10%">S/N</td>
                  <td width="70%">Payment Description</td>
                  <td width="20%" align="right">Amount</td>
                </tr>
                @if(Auth::user()->Level == 100)
                <tr>
                  <td>1</td>
                  <td>NEVS</td>
                  <td align="right">2,500.00</td>
                </tr>
                <tr>
                  <td><strong>Total</strong></td>
                  <td colspan="2" align="right"><strong>2,500.00</strong></td>
                  
                </tr>
                <tr>
                  <td colspan="2"><strong>Amount in words: Two thousand five hundred naira only</strong></td>
                @else
                <tr>
                  <td>1</td>
                  <td>NEVS</td>
                  <td align="right">2,000.00</td>
                </tr>
                <tr>
                  <td><strong>Total</strong></td>
                  <td colspan="2" align="right"><strong>2,000.00</strong></td>
                  
                </tr>
                <tr>
                  <td colspan="2"><strong>Amount in words: Two thousand naira only</strong></td>
                @endif
                  
                  
                </tr>
              </table>
              <br><table align="right" class="noprint">
                  <tr>
                    <td>
                      <button onclick="javacript:window.print()" class="btn btn-warning">
                          <i class="fa fa-print"></i>@if(!$payment3)PRINT INVOICE @else PRINT RECEIPT @endif</button>
                    </td>
                    @if(!$payment3)
                    <td>&nbsp;</td>
                    <td>
                      <a href="{{url('student/payment')}}" class="btn btn-warning">CANCEL</a>
                      
                    </td>
                    <td>&nbsp;</td>
                    <td>
                        <form id="nevs">
                            <script src="https://js.paystack.co/v1/inline.js"></script>
                             
                            
                <input type="hidden" id="js-firstName" name="firstName" value ="{{Auth::user()->Firstname}}"/>
                <input type="hidden" id="js-lastName" name="lastName" value ="{{Auth::user()->Surname}}" class="field-divided" placeholder="Last"/>
                <input type="hidden" id="js-email" name="email" value ="{{Auth::user()->Email}}"/>
                <input type="hidden" id="js-narration" name="narration" value ="NEVS Payment for {{Auth::user()->MatricNo}}"/>
                @if(Auth::user()->Level == 100)
                <input type="hidden" id="js-amount" name="amount" value ="{{250000+10000+(250000*0.015)}}"/>
                @else
                <input type="hidden" id="js-amount" name="amount" value ="{{200000+10000+(200000*0.015)}}"/>
                @endif 

                <?php //$ref = str_replace("/","","FCE/20192020/".Auth::user()->MatricNo."/3");?>
                <input type="hidden" id="ref" name="ref" value ="{{$ref."3"}}"/>
                
                    </form><button class="btn btn-success" type="button" onclick="payWithPaystackNevs()"><i class="fa fa-money"></i> Pay Now </button>
                    </td>
                    @endif
                  </tr>
                </table>
            @endif

            @if($indexx==4)
            <table width="100%" border="1" cellpadding="2" cellspacing="0">
                <tr>
                  <td width="10%">S/N</td>
                  <td width="70%">Payment Description</td>
                  <td width="20%" align="right">Amount</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>PSYCHOMETRIC EDUCATION</td>
                  <td align="right">3,000.00</td>
                </tr>
                <tr>
                  <td><strong>Total</strong></td>
                  <td colspan="2" align="right"><strong>3,000.00</strong></td>
                  
                </tr>
                <tr>
                  <td colspan="2"><strong>Amount in words: Thress thousand naira only</strong></td>
                  
                  
                </tr>
              </table>
              <br>
              <table align="right" class="noprint">
                  <tr>
                    <td>
                      <button onclick="javacript:window.print()" class="btn btn-warning">
                          <i class="fa fa-print"></i> @if(!$payment4)PRINT INVOICE @else PRINT RECEIPT @endif</button>
                    </td>
                    @if(!$payment4)
                    <td>&nbsp;</td>
                    <td>
                      <a href="{{url('student/payment')}}" class="btn btn-warning">CANCEL</a>
                      
                    </td>
                    <td>&nbsp;</td>
                    <td>
                        <form id="psycho">
                            <script src="https://js.paystack.co/v1/inline.js"></script>
                             
                          
                <input type="hidden" id="js-firstName" name="firstName" value ="{{Auth::user()->Firstname}}"/>
                <input type="hidden" id="js-lastName" name="lastName" value ="{{Auth::user()->Surname}}" class="field-divided" placeholder="Last"/>
                <input type="hidden" id="js-email" name="email" value ="{{Auth::user()->Email}}"/>
                <input type="hidden" id="js-narration" name="narration" value ="Psychometric Examination Payment for {{Auth::user()->MatricNo}}"/>
                <input type="hidden" id="js-amount" name="amount" value ="{{300000+10000+(300000*0.015)}}"/>
                <?php //$ref = str_replace("/","","FCE/20192020/".Auth::user()->MatricNo."/4");?>
                <input type="hidden" id="ref" name="ref" value ="{{$ref."4"}}"/>
                
                 </form><button class="btn btn-success" type="button" onclick="payWithPaystackPsycho()"><i class="fa fa-money"></i> Pay Now </button>
                    </td>
                    @endif
                  </tr>
                </table>
            @endif
            @if($indexx==5)
            <table width="100%" border="1" cellpadding="2" cellspacing="0">
                <tr>
                  <td width="10%">S/N</td>
                  <td width="70%">Payment Description</td>
                  <td width="20%" align="right">Amount</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Hostel Accommodation</td>
                  {{-- <td align="right">{{money_format("", $payment5->referenceno)}}</td> --}}
                  <td align="right"><form id="hostel"><script src="https://js.paystack.co/v1/inline.js"></script><input type="hidden" id="js-lastName" name="lastName" value ="{{Auth::user()->Surname}}" class="field-divided" placeholder="Last"/>
                          <input type="hidden" id="js-email" name="email" value ="{{Auth::user()->Email}}"/>
                          <input type="hidden" id="js-narration" name="narration" value ="Hostel Payment  for {{Auth::user()->MatricNo}}"/>
                          <?php //$ref = str_replace("/","","FCE/20192020/".Auth::user()->MatricNo."/5");?>
                          <input type="hidden" id="ref" name="ref" value ="{{$ref."5"}}"/>
                          <select name="amount" size="1" id="amount">
                                              <option value="" selected="selected">SELECT HALL</option>
                                              <option value="1600000">BLOCK A (HALL 1,2 & 3) N16,000.00</option>
                                              <option value="1300000">BLOCK B & C (HALL 1,2 & 3) N13,000.00</option>
                                              <option value="1100000">BLOCK D & (HALL 1,2 & 3) N11,000.00</option>
                                              <option value="1300000">ALL BLOCKS (HALL 4) N13,000.00</option>
                                            </select>
                                            <input type="hidden" id="js-firstName" name="firstName" value ="{{Auth::user()->Firstname}}"/></form></td>
                </tr>
                <tr>
                  <td><strong>Total</strong></td>
                  {{-- <td colspan="2" align="right"><strong>{{money_format("", $payment5->referenceno)}}</strong></td> --}}
                  <td align="right"></td>
                </tr>
                <tr>
                  <td colspan="2"><strong></strong></td>
                  
                  
                </tr>
              </table>
              <br>
              <table align="right" class="noprint">
                  <tr>
                    <td>
                      <button onclick="javacript:window.print()" class="btn btn-warning">
                          <i class="fa fa-print"></i> @if(!$payment5)PRINT INVOICE @else PRINT RECEIPT @endif</button>
                    </td>
                    @if(!$payment5)
                    <td>&nbsp;</td>
                    <td>
                      <a href="{{url('student/payment')}}" class="btn btn-warning">CANCEL</a>
                      
                    </td>
                    <td>&nbsp;</td>
                    <td>
                        
                                            <button class="btn btn-success" type="button" onclick="payWithPaystackHostel()"><i class="fa fa-money"></i> Pay Now </button>
                    </td>
                    @endif
                  </tr>
                </table>
            @endif


            @if($indexx==9)
            <table width="100%" border="1" cellpadding="2" cellspacing="0">
                <tr>
                  <td width="10%">S/N</td>
                  <td width="70%">Payment Description</td>
                  <td width="20%" align="right">Amount</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Acceptance Fees</td>
                  <td align="right">10,000.00</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Internet Training/Facility</td>
                    <td align="right">5,500.00</td>
                  </tr>
                <tr>
                  <td><strong>Total</strong></td>
                  <td colspan="2" align="right"><strong>15,500.00</strong></td>
                  
                </tr>
                <tr>
                  <td colspan="2"><strong>Amount in words: Fifteen thousand and five hundred naira only</strong></td>
                  
                  
                </tr>
              </table>
              <br>
              <table align="right" class="noprint">
                  <tr>
                    <td>
                      <button onclick="javacript:window.print()" class="btn btn-warning">
                          <i class="fa fa-print"></i> @if(!$payment9)PRINT INVOICE @else PRINT RECEIPT @endif</button>
                    </td>
                    @if(!$payment9)
                    <td>&nbsp;</td>
                    <td>
                      <a href="{{url('student/payment')}}" class="btn btn-warning">CANCEL</a>
                      
                    </td>
                    <td>&nbsp;</td>
                    <td>
                        <form id="dews">
                            <script src="https://js.paystack.co/v1/inline.js"></script>
                             
                          
                <input type="hidden" id="js-firstName" name="firstName" value ="{{Auth::user()->Firstname}}"/>
                <input type="hidden" id="js-lastName" name="lastName" value ="{{Auth::user()->Surname}}" class="field-divided" placeholder="Last"/>
                <input type="hidden" id="js-email" name="email" value ="{{Auth::user()->Email}}"/>
                <input type="hidden" id="js-narration" name="narration" value ="Psychometric Examination Payment for {{Auth::user()->MatricNo}}"/>
                <input type="hidden" id="js-amount" name="amount" value ="{{1550000+10000+(1550000*0.015)}}"/>
                <?php //$ref = str_replace("/","","FCE/20192020/".Auth::user()->MatricNo."/4");?>
                <input type="hidden" id="ref" name="ref" value ="{{$ref."9"}}"/>
                
                 </form><button class="btn btn-success" type="button" onclick="payWithPaystack()"><i class="fa fa-money"></i> Pay Now </button>
                    </td>
                    @endif
                  </tr>
                </table>
            @endif
            

            </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
          <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
          <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
          
          <div class="noprint">
          <hr>
          <a href="{{route('payments')}}"><h2>Return to payment page</h2></a>
          </div>
        </div>
</body>