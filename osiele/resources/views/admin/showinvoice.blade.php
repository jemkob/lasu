

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>
	OSIELE INVOICE SLIP
</title><style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
        .auto-style2 {
            width: 104px;
            height: 102px;
        }
        .auto-style3 {
            height: 125px;
        }
    </style>
    
    </head>


<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2" class="auto-style3">
                    <table>
                        <tr>
                            <td class="title">
                                
                                <img src="../images/logo.png" alt="federal college of education osiele" style="max-width:300px;" class="auto-style2">
                            </td>
                            
                            <td>
                                Invoice #:{{$users->InvoiceNumber}}<br>
                                Created: {{date('M j Y g:i A', strtotime('$users->created_at'))}}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Federal College of Education, Osiele<br>
                                Abeokuta, Ogun State<br>
                            </td>
                            
                            <td>
                               
                                {{$users->Surname}} {{$users->Firstname}} {{$users->Middlename}}<br>
                                 {{$users->Major}}/{{$users->Minor}}<br>
                                {{$users->PhoneNumber}}<br>
                                igarraboy@gmail.com
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Payment Method
                </td>
                
                <td>
                    Check #
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    Bank
                </td>
                
                <td>&nbsp;
                    </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Item
                </td>
                
                <td>&nbsp;
                    </td>
            </tr>
            
            <tr class="item">
                <td>
                    School Fees (FCE OSIELE ABEOKUTA T.S.A REMITA ACCT)</td>
                
                <td>&nbsp;
                    </td>
            </tr>
                   
            <tr class="total">
                <td></td>
                
                <td>&nbsp;
                    </td>
            </tr>
        </table>
    </div>
</body>
</html>

    </form>
</body>
</html>
