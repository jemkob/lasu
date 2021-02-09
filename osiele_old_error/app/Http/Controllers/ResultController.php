<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ResultController extends Controller
{
    //
    public function search(Request $request)
    {
        //
        // Gets the query string from our form submission 
        $query = $request->input('search');
        // Returns an array of articles that have the query string located somewhere within 
        // our articles titles. Paginates them so we can break up lots of search results.
        $results = DB::table('results')->where('matricno', $query)->paginate(10);
            
        // returns a view and passes the view the list of articles and the original query.
        return view('resultviewer.index')->with('results', $results);
        //return view('resultviewer.index');
    }

    public function thelevel()
    {
        return view('resultviewer.index');
    }

    

    
       
}
