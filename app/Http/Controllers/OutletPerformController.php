<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutletPerformController extends Controller
{
    public function index(Request $request){
        // dd($request->all());
        if (isset($request->dtfrom)) {
            $dtfr = $request->input('dtfrom');
            $dtto = $request->input('dtto');
            $datefrForm = Carbon::createFromFormat('d/m/Y', $dtfr)->format('Y-m-d');
            $datetoForm = Carbon::createFromFormat('d/m/Y', $dtto)->format('Y-m-d');
            
            $results = DB::select(DB::raw("SELECT code, name, dbo.fcountgetsalesoutlet('$datefrForm', '$datetoForm', code) trans, dbo.fgetsalesoutlet('$datefrForm', '$datetoForm', code) 'sales' FROM mwhse WHERE tstatus = 1"));

            // dd(($results));
            return view('reports.outletperformance',[
                'results' => $results,
            ]);
        }
        // dd($locations);
        return view('reports.outletperformance');
    }
}
