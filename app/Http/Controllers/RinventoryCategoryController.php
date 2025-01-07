<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RinventoryCategoryController extends Controller
{
    public function index(Request $request){
        if (isset($request->category)) {
            if($request->category != null) {
                if($request->category == 'SEMUA'){
                    $results = DB::select(DB::raw("SELECT name_mgrp, name, code, lastprice, sellprice, stock, createddate FROM mitem T0 WHERE tstatus = 1 AND stock > 0 "));
            
                    $categories = DB::select(DB::raw("SELECT 'SEMUA' AS 'value', 'SEMUA' AS 'display' UNION ALL SELECT code AS 'value', name AS 'display' FROM mgrp WHERE tstatus = 1"));

                    return view('reports.rinventcategory',[
                        'categories' => $categories,
                        'results' => $results,
                    ]);
                }else{
                    $results = DB::select(DB::raw("SELECT name_mgrp, name, code, lastprice, sellprice, stock, createddate FROM mitem T0 WHERE tstatus = 1 AND name_mgrp = '$request->category' AND stock > 0"));

                    $categories = DB::select(DB::raw("SELECT 'SEMUA' AS 'value', 'SEMUA' AS 'display' UNION ALL SELECT code AS 'value', name AS 'display' FROM mgrp WHERE tstatus = 1"));

                    return view('reports.rinventcategory',[
                        'categories' => $categories,
                        'results' => $results,
                    ]);
                }
                
            }
        }
        $categories = DB::select(DB::raw("SELECT 'SEMUA' AS 'value', 'SEMUA' AS 'display' UNION ALL SELECT code AS 'value', name AS 'display' FROM mgrp WHERE tstatus = 1"));
        
        // dd($categories);
        return view('reports.rinventcategory',[
            'categories' => $categories,
        ]);
    }
}
