<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RdailyPaymentRecController extends Controller
{
    public function index(Request $request){
        // dd($request->all());
        if (isset($request->dtfrom)) {
            $dtfr = $request->input('dtfrom');
            $dtto = $request->input('dtto');
            $datefrForm = Carbon::createFromFormat('d/m/Y', $dtfr)->format('Y-m-d');
            $datetoForm = Carbon::createFromFormat('d/m/Y', $dtto)->format('Y-m-d');
            
            if($request->lokasi == 'SEMUA'){
                $results = DB::select(DB::raw("SELECT code_mlokasi, day, tdate, CASH, [DEBIT BCA] as DEBIT_BCA, [CREDIT NON BCA] as CC_NON_BCA, [DEBIT NON BCA] as DEBIT_NON_BCA , [m-Banking] as mbanking, [CREDIT BCA] as CC_BCA, QRIS FROM vrdailypayrcv WHERE tdate BETWEEN '$datefrForm' AND '$datetoForm'"));
            }else{
                $results = DB::select(DB::raw("SELECT code_mlokasi, day, tdate, CASH, [DEBIT BCA] as DEBIT_BCA, [CREDIT NON BCA] as CC_NON_BCA, [DEBIT NON BCA] as DEBIT_NON_BCA , [m-Banking] as mbanking, [CREDIT BCA] as CC_BCA, QRIS FROM vrdailypayrcv WHERE tdate BETWEEN '$datefrForm' AND '$datetoForm' AND code_mlokasi = '$request->lokasi'"));
            }
            $locations = DB::select(DB::raw("SELECT 'SEMUA' AS 'value', 'SEMUA' AS 'display' UNION ALL SELECT code AS 'value', name AS 'display' FROM mwhse WHERE tstatus = 1"));

            return view('reports.dailypaymentrcv',[
                'locations' => $locations,
                'results' => $results,
            ]);
        }
        $locations = DB::select(DB::raw("SELECT 'SEMUA' AS 'value', 'SEMUA' AS 'display' UNION ALL SELECT code AS 'value', name AS 'display' FROM mwhse WHERE tstatus = 1"));
        
        // dd($locations);
        return view('reports.dailypaymentrcv',[
            'locations' => $locations,
        ]);
    }
}
