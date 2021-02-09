<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pins = DB::table('pins')
        ->leftjoin('students', 'pins.studentid', '=', 'students.studentid')
        ->select('pins.pinkey as pinkey', 'students.studentid as studentid', 'students.matricno as matricno', 'students.level as level', 'students.jambregno as jambreg', 'pins.studentid as studentpin')
        ->get();
    return view('pin.index')->with('pins', $pins);
     }

     public function searchpin(Request $request){
        $item = $request->input('search');
        //if(isset($item) && !empty($item)){
            $searchedpin = DB::table('pins')
            ->leftjoin('students', 'pins.studentid', '=', 'students.studentid')
            ->where('students.matricno', $item)
            ->orhwere('pinkey', $item)
            ->get();
            return $searchedpin;

            return view('pin.index')->with('searchedpin', $searchedpin);
       // }
     }

     public function generatePinIndex(){
         return view('pin.pin');
     }

     public function printpin(){
        $getpins = DB::table('pins')->get();
        return view('pin.printpin')->with('getpins', $getpins);
    }


     public function generatePin(Request $request){
         $pincheck = DB::table('pins')->get();
         DB::table('pins')->truncate();
       /*  if(count($pincheck) > 0){
            return redirect('generatepin')->with('error', 'Please check if students are promoted.');
        } else { */
            $code = substr(uniqid(), -10);
            $pincount = $request->input('pincount');
            for ($x = 0; $x <= $pincount; $x++) {
                
                $length=6;
                $token = "";
                // $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $codeAlphabet = "abcdefghijklmnopqrstuvwxyz";
                $codeAlphabet.= "0123456789";
                $max = strlen($codeAlphabet); // edited

                for ($i=0; $i < $length; $i++) {
                    $token .= $codeAlphabet[random_int(0, $max-1)];
                }
                DB::table('pins')->insert(['PinKey' => $token, 'Counter' => 20]);
            }

         
        // }
        


        $getpins = DB::table('pins')->get();

        return view('pin.printpin')->with('getpins', $getpins);
         
     }

     public function addPinindex()
     {
         return view('pin.addpin');
     }

     public function addPin(Request $request){
           $code = substr(uniqid(), -10);
           $pincount = $request->input('pincount');
           for ($x = 0; $x <= $pincount; $x++) {
               
               $length=6;
               $token = "";
               // $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
               $codeAlphabet = "abcdefghijklmnopqrstuvwxyz";
               $codeAlphabet.= "0123456789";
               $max = strlen($codeAlphabet); // edited

               for ($i=0; $i < $length; $i++) {
                   $token .= $codeAlphabet[random_int(0, $max-1)];
               }
               DB::table('pins')->insert(['PinKey' => $token, 'Counter' => 20]);
           }
           $totalpin =DB::table('pins')->pluck('pinid')->last();
        //    return $totalpin;
       
           $getpins = DB::table('pins')->where('pinid', '>', $totalpin-$pincount)->get();

        // return redirect('printpin')->with('getpins', $getpins);
       return view('pin.addpin')->with('getpins', $getpins);
        
    }

    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
