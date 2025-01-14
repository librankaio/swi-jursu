<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RpaymentReceivedGroupController extends Controller
{
    public function index(Request $request){
        // dd($request->all());
        if (isset($request->dtfrom)) {
            $dtfr = $request->input('dtfrom');
            $dtto = $request->input('dtto');
            $dtto = $request->input('dtto');
            $datefrForm = Carbon::createFromFormat('d/m/Y', $dtfr)->format('Y-m-d');
            $datetoForm = Carbon::createFromFormat('d/m/Y', $dtto)->format('Y-m-d');
            
            // if($request->lokasi != null) {
            //     if($request->lokasi == 'SEMUA'){
            //         $results = DB::select(DB::raw("EXEC vroutletpayment '$datefrForm', '$datetoForm', '$request->lokasi'"));

            //         $locations = DB::select(DB::raw("SELECT 'SEMUA' AS 'value', 'SEMUA' AS 'display' UNION ALL SELECT code AS 'value', name AS 'display' FROM mwhse WHERE tstatus = 1"));

            //         return view('reports.receivedpayment',[
            //             'locations' => $locations,
            //             'results' => $results,
            //         ]);
            //     }else{

            //     }
            // }
            // $results = DB::select(DB::raw("Select name, dbo.fgetcountpayOUTLET(code,'$datefrForm', '$datetoForm', '$request->lokasi') 'count', dbo.fgetsumpayOUTLET(code,'$datefrForm', '$datetoForm', '$request->lokasi') 'amount' FROM mpay WHERE tstatus = 1"));

            $results = DB::select(DB::raw("EXEC vroutletpayment '$datefrForm', '$datetoForm', '$request->lokasi'"));

            $locations = DB::select(DB::raw("SELECT 'SEMUA' AS 'value', 'SEMUA' AS 'display' UNION ALL SELECT code AS 'value', name AS 'display' FROM mwhse WHERE tstatus = 1"));

            // dd($results);

            return view('reports.receivedpayment',[
                'locations' => $locations,
                'results' => $results,
            ]);
        }
        $locations = DB::select(DB::raw("SELECT 'SEMUA' AS 'value', 'SEMUA' AS 'display' UNION ALL SELECT code AS 'value', name AS 'display' FROM mwhse WHERE tstatus = 1"));
        
        // dd($locations);
        return view('reports.receivedpayment',[
            'locations' => $locations,
        ]);
    }
}
