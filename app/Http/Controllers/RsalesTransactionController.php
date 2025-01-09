<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RsalesTransactionController extends Controller
{
    public function index(Request $request){
        if (isset($request->dtfrom)) {
            $dtfr = $request->input('dtfrom');
            $dtto = $request->input('dtto');
            $datefrForm = Carbon::createFromFormat('d/m/Y', $dtfr)->format('Y-m-d');
            $datetoForm = Carbon::createFromFormat('d/m/Y', $dtto)->format('Y-m-d');

            if($request->category != null) {
                if($request->category == 'SEMUA'){
                    $results = DB::select(DB::raw("SELECT T0.code_mlokasi, T0.name_mlokasi, T0.no, T0.name_mmbr, T0.tdate, CONVERT(VARCHAR(5), T0.createddate, 108) 'createddate', T1.name_mgrp, T1.name, T1.code, T0.qty, T0.price, T0.subtotal/T0.qty 'nett', T0.subtotal FROM tpos T0 INNER JOIN mitem T1 ON T0.code_mitem = T1.code WHERE T0.tstatus = 1 AND T1.tstatus = 1 AND tdate BETWEEN '$datefrForm' AND '$datetoForm'"));
            
                    $categories = DB::select(DB::raw("SELECT 'SEMUA' AS 'value', 'SEMUA' AS 'display' UNION ALL SELECT code AS 'value', name AS 'display' FROM mwhse WHERE tstatus = 1"));

                    return view('reports.rsalestrans',[
                        'categories' => $categories,
                        'results' => $results,
                    ]);
                }else{
                    $results = DB::select(DB::raw("SELECT T0.code_mlokasi, T0.name_mlokasi, T0.no, T0.name_mmbr, T0.tdate, CONVERT(VARCHAR(5), T0.createddate, 108) 'createddate', T1.name_mgrp, T1.name, T1.code, T0.qty, T0.price, T0.subtotal/T0.qty 'nett', T0.subtotal FROM tpos T0 INNER JOIN mitem T1 ON T0.code_mitem = T1.code WHERE T0.tstatus = 1 AND T1.tstatus = 1 AND code_mlokasi = '$request->category' AND tdate BETWEEN '$datefrForm' AND '$datetoForm'"));

                    $categories = DB::select(DB::raw("SELECT 'SEMUA' AS 'value', 'SEMUA' AS 'display' UNION ALL SELECT code AS 'value', name AS 'display' FROM mwhse WHERE tstatus = 1"));

                    return view('reports.rsalestrans',[
                        'categories' => $categories,
                        'results' => $results,
                    ]);
                }
                
            }
        }
        $categories = DB::select(DB::raw("SELECT 'SEMUA' AS 'value', 'SEMUA' AS 'display' UNION ALL SELECT code AS 'value', name AS 'display' FROM mwhse WHERE tstatus = 1"));
        
        // dd($categories);
        return view('reports.rsalestrans',[
            'categories' => $categories,
        ]);
    }
}
