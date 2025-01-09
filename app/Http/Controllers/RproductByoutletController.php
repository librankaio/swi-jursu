<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RproductByoutletController extends Controller
{
    public function index(Request $request){
        if (isset($request->hdn_submit)) {
            if($request->hdn_submit != null) {
                $results = DB::select(DB::raw("SELECT * FROM vstockoverview T0"));

                return view('reports.rproductbyoutlet',[
                    'results' => $results,
                ]);
            }
        }
        
        // dd($categories);
        return view('reports.rproductbyoutlet');
    }
}
