<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RsalesSummaryController extends Controller
{
    public function index(Request $request){
        // dd($request->all());
        if (isset($request->dtfrom)) {
            $dtfr = $request->input('dtfrom');
            $dtto = $request->input('dtto');
            $datefrForm = Carbon::createFromFormat('d/m/Y', $dtfr)->format('Y-m-d');
            $datetoForm = Carbon::createFromFormat('d/m/Y', $dtto)->format('Y-m-d');
            
            if($request->lokasi != null) {
                if($request->lokasi == 'SEMUA'){
                    $results = DB::select(DB::raw("select code_mlokasi, name_mlokasi, no, tdate, CONVERT(VARCHAR(5), createddate, 108) 'created', name_mmbr, sum(qty*isnull(hpp,0)) 'cost', grdtotal, 'Paid' as 'paymentstate' from tpos WHERE tdate BETWEEN '$datefrForm' AND '$datetoForm' GROUP BY code_mlokasi, name_mlokasi, no, tdate, CONVERT(VARCHAR(5), createddate, 108), name_mmbr, grdtotal"));

                    $locations = DB::select(DB::raw("SELECT 'SEMUA' AS 'value', 'SEMUA' AS 'display' UNION ALL SELECT code AS 'value', name AS 'display' FROM mwhse WHERE tstatus = 1"));
    
                    return view('reports.salessummary',[
                        'locations' => $locations,
                        'results' => $results,
                    ]);
                }else{
                    $results = DB::select(DB::raw("select code_mlokasi, name_mlokasi, no, tdate, CONVERT(VARCHAR(5), createddate, 108) 'created', name_mmbr, sum(qty*isnull(hpp,0)) 'cost', grdtotal, 'Paid' as 'paymentstate' from tpos WHERE tdate BETWEEN '$datefrForm' AND '$datetoForm' AND code_mlokasi = '$request->lokasi' GROUP BY code_mlokasi, name_mlokasi, no, tdate, CONVERT(VARCHAR(5), createddate, 108), name_mmbr, grdtotal"));

                    $locations = DB::select(DB::raw("SELECT 'SEMUA' AS 'value', 'SEMUA' AS 'display' UNION ALL SELECT code AS 'value', name AS 'display' FROM mwhse WHERE tstatus = 1"));

                    return view('reports.salessummary',[
                        'locations' => $locations,
                        'results' => $results,
                    ]);
                }
                
            }
            $results = DB::select(DB::raw("select code_mlokasi, name_mlokasi, no, tdate, CONVERT(VARCHAR(5), createddate, 108) 'created', name_mmbr, sum(qty*isnull(hpp,0)) 'cost', grdtotal, 'Paid' as 'paymentstate' from tpos WHERE tdate BETWEEN '$datefrForm' AND '$datetoForm' GROUP BY code_mlokasi, name_mlokasi, no, tdate, CONVERT(VARCHAR(5), createddate, 108), name_mmbr, grdtotal"));
            
            $locations = DB::select(DB::raw("SELECT 'SEMUA' AS 'value', 'SEMUA' AS 'display' UNION ALL SELECT code AS 'value', name AS 'display' FROM mwhse WHERE tstatus = 1"));

            return view('reports.salessummary',[
                'locations' => $locations,
                'results' => $results,
            ]);
        }
        $locations = DB::select(DB::raw("SELECT 'SEMUA' AS 'value', 'SEMUA' AS 'display' UNION ALL SELECT code AS 'value', name AS 'display' FROM mwhse WHERE tstatus = 1"));
        
        // dd($locations);
        return view('reports.salessummary',[
            'locations' => $locations,
        ]);
    }
}
