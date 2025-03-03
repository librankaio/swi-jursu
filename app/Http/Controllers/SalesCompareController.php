<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesCompareController extends Controller
{
    public function index(Request $request){
        // dd($request->all());
        if (isset($request->dtfrom)) {
            $dtfr = $request->input('dtfrom');
            $dtto = $request->input('dtto');
            $dtfrcpr = $request->input('dtfromcpr');
            $dttocpr = $request->input('dttocpr');
            $datefrForm = Carbon::createFromFormat('d/m/Y', $dtfr)->format('Y-m-d');
            $datetoForm = Carbon::createFromFormat('d/m/Y', $dtto)->format('Y-m-d');
            $datefrFormcpr = Carbon::createFromFormat('d/m/Y', $dtfrcpr)->format('Y-m-d');
            $datetoFormcpr = Carbon::createFromFormat('d/m/Y', $dttocpr)->format('Y-m-d');
            
            // $results = DB::select(DB::raw("SELECT code_mlokasi, day, tdate, CASH, [DEBIT BCA] as DEBIT_BCA, [CREDIT NON BCA] as CC_NON_BCA, [DEBIT NON BCA] as DEBIT_NON_BCA , [m-Banking] as mbanking, [CREDIT BCA] as CC_BCA, QRIS FROM vrdailypayrcv WHERE tdate BETWEEN '$datefrForm' AND '$datetoForm' AND code_mlokasi = '$request->lokasi'"));
            $results = DB::select(DB::raw("EXEC rptsalescompareputlet '$datefrForm', '$datetoForm', '$datefrFormcpr', '$datetoFormcpr'"));

            // dd(($results));
            return view('reports.salescompare',[
                'results' => $results,
            ]);
        }
        // dd($locations);
        return view('reports.salescompare');
    }
}
