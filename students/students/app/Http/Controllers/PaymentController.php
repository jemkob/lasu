<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Auth;

class PaymentController extends Controller
{
    
    public function payment()
    {
        return view('student.payment');
    }

    public function verifyPayment(Request $request)
    {
        
        $merchantId = "7101217067";
        $apiKey = "321074";
        $ref = $request->get('ref');
        // $rrr = 230513062183;
        $rrr = $request->rrr;

        $hashy = $rrr.$apiKey.$merchantId;
        $apihash = openssl_digest($hashy, 'sha512');
        $session = DB::table('sessions')->where('currentsession', 1)->first();

        if(Auth::user()->Level == 100 && empty(Auth::user()->MatricNo)){
            $studentref = 'FCE'.$session->SessionYear.Auth::user()->JambRegNo;
        } else {
            $studentref = 'FCE'.$session->SessionYear.Auth::user()->MatricNo;
        }
        $details = str_ireplace("/","",$studentref);


        $indexx=substr($ref,-1);

        if($indexx==1){
            $title='SCHOOL FEES';
        } elseif($indexx==2){
            $title='DEWS';
        } elseif($indexx==3){
            $title='NEVS';
        } elseif($indexx==4){
            $title='PSYCHOMETRIC ';
        } elseif($indexx==5){
            $title='HOSTEL';
        } elseif($indexx==9){
            $title='ACCEPTANCE';
        }
        $checkpayment = DB::table('payments')->where('rrr', $rrr)->get();
        // return $checkpayment;
        if(count($checkpayment) > 0){
            return redirect('student/payment?r=1')->with('error', 'RRR already exists');
        }
        $result = array();
        //The parameter after verify/ is the transaction reference to be verified
        $url = 'https://login.remita.net/remita/ecomm/'.$merchantId.'/'.$rrr.'/'.$apihash.'/status.reg';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $request = curl_exec($ch);
        curl_close($ch);

        if ($request) {
            $result = json_decode($request, true);
            // print_r($result);
            // dd($result);
            if($result){
                // stristr("Hello world!","WORLD");
            
            if($result['status'] == 01){
                $check = stristr($result['orderId'], $details);
                // if(empty($check)){
                //     return redirect('student/payment?r=2')->with('error', 'RRR Valid but does not match student details. Validate RRR or Consult STEP-B');
                // }
                if(Auth::user()->Level == 100 && empty(Auth::user()->MatricNo)){
                    DB::table('payments')->insert(['matricno' => Auth::user()->JambRegNo, 'amount'=> $result['amount'], 'rrr'=>$rrr, 'sessionid'=>$session->SessionID]);

                } else {
                DB::table('payments')->insert(['matricno' => Auth::user()->MatricNo, 'amount'=> $result['amount'], 'rrr'=>$rrr, 'sessionid'=>$session->SessionID]);
                }

            return redirect('student/payment?r=2')->with('success', 'RRR approved');
            // return redirect('students/home');

            } else {
            return redirect('student/payment?r=2')->with('error', 'Invalid payment details');
            }
            if($result['status'] == 00 || $result['status'] == 021){
                //something came in
                if($result['status'] == 00 || $result['status'] == 021){
                // the transaction was successful, you can deliver value
                /* 
                @ also remember that if this was a card transaction, you can store the 
                @ card authorization to enable you charge the customer subsequently. 
                @ The card authorization is in: 
                @ $result['data']['authorization']['authorization_code'];
                @ PS: Store the authorization with this email address used for this transaction. 
                @ The authorization will only work with this particular email.
                @ If the user changes his email on your system, it will be unusable
                */

                // if(Auth::user()->Level == 100 && empty(Auth::user()->MatricNo)){
                //     DB::table('payments')->insert(['matricno' => Auth::user()->JambRegNo, 'referenceno' => $ref, 'transactiondate' => $result['transactiontime'], 'status'=>'paid', 'transactionno'=>$ref, 'level'=>Auth::user()->Level, 'title'=>$title, 'amount'=> $result['amount'], 'rrr'=>$rrr]);

                // } else {
                // DB::table('payments')->insert(['matricno' => Auth::user()->MatricNo, 'referenceno' => $ref, 'transactiondate' => $result['transactiontime'], 'status'=>'paid', 'transactionno'=>$ref, 'level'=>Auth::user()->Level, 'title'=>$title, 'amount'=> $result['amount'], 'rrr'=>$rrr]);
                // }
                return $result;
                print_r($result);
                // return redirect('student/printreceipt?ref='.$ref.'&transdate='.$result['status']);
                }else{
                // the transaction was not successful, do not deliver value'
                // print_r($result);  //uncomment this line to inspect the result, to check why it failed.
                echo "Transaction was not successful: Last gateway response was: ".$result['status'];
                }
            }else{
                echo $result['status'];
                // if(Auth::user()->Level == 100 && empty(Auth::user()->MatricNo)){
                //     DB::table('payments')->insert(['matricno' => Auth::user()->JambRegNo, 'referenceno' => $ref, 'transactiondate' => $result['transactiontime'], 'status'=>'paid', 'transactionno'=>$ref, 'level'=>Auth::user()->Level, 'title'=>$title, 'amount'=> $result['amount'], 'rrr'=>$rrr]);

                // } else {
                // DB::table('payments')->insert(['matricno' => Auth::user()->MatricNo, 'referenceno' => $ref, 'transactiondate' => $result['transactiontime'], 'status'=>'paid', 'transactionno'=>$ref, 'level'=>Auth::user()->Level, 'title'=>$title, 'amount'=> $result['amount'], 'rrr'=>$rrr]);

                // }

                // return redirect('student/printreceipt?ref='.$ref.'&transdate='.$result['status']);
            }

            }else{
            //print_r($result);
            die("Something went wrong while trying to convert the request variable to json. Uncomment the print_r command to see what is in the result variable.");
            }
        }else{
            //var_dump($request);
            die("Something went wrong while executing curl. Uncomment the var_dump line above this line to see what the issue is. Please check your CURL command to make sure everything is ok");
        }
    }

    public function AddOlevel(Request $request){
        $subjects = $request->input('subject');
        $grades = $request->input('grade');
        $examtype = $request->input('examtype');
        $examyear = $request->input('examyear');
        $regno = $request->input('regno');
        $centreno = $request->input('centreno');

        $checkregno = DB::table('oleveldetails')->where('regno', $regno)->get();
        if(count($checkregno)> 0){
            return redirect(url()->previous())->with('error', 'This Registration No. alreay exist, please check and try again!');
        }

        for($i=0; $i < count($subjects); $i++){
            $subject = $subjects[$i];
            $grade = $grades[$i];
            DB::table('oleveldetails')
            ->insert(
                ['ExamType'=>$examtype,
                'CenterNumber'=>$centreno,
                'RegNo'=>$regno,
                'SubjectName'=>$subject,
                'Grade'=>$grade,
                'StudentID'=>Auth::user()->StudentID,
                'ExamYear'=>$examyear]);
  
        }

        return redirect(url()->previous())->with('success', 'O\'Level Result Addess Successfully!');
    }

    public function AddJamb(Request $request){
        $subjects = $request->input('subject');
        $scores = $request->input('score');
        $examyear = $request->input('examyear');
        $regno = $request->input('regno');
        $centreno = $request->input('centreno');

        $checkregno = DB::table('jambdetails')->where('regno', $regno)->get();
        if(count($checkregno)> 0){
            return redirect(url()->previous())->with('error', 'This Registration No. alreay exist, please check and try again!');
        }

        for($i=0; $i < count($subjects); $i++){
            $subject = $subjects[$i];
            $score = $scores[$i];
            DB::table('jambdetails')
            ->insert(
                [
                'Center'=>$centreno,
                'RegNo'=>$regno,
                'Subject'=>$subject,
                'score'=>$score,
                'StudentID'=>Auth::user()->StudentID,
                'Year'=>$examyear]);
               
        }

        return redirect(url()->previous())->with('success', 'UTME details has been added Successfully!');
    }
}
