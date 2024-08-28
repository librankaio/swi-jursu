<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    public function index(Request $request){
        $results = DB::select(DB::raw("select no, tdate, name_msupp, refno, subtotalheader, taxpcg, taxtotal, disctotal, grdtotal, note from tpo where tstatus = 1 and approved = 'N' group by no, tdate, name_msupp, refno, subtotalheader, taxpcg, taxtotal, disctotal, grdtotal, note"));
        
        return view('pages.pembelian',[
            'results' => $results,
        ]);
    }

    public function update(Transaksi $transaksi){
        $count=0;
        $countrows = sizeof(request('hdn_no_d'));
        for ($i=0;$i<sizeof(request('hdn_no_d'));$i++){            
            DB::update(DB::raw("update tpo set approved = 'Y' where no = '".request('hdn_no_d')[$i]."'"));
            $count++;
        }
        if($count == $countrows){
            return redirect()->route('pembelian')->with('success', 'Data berhasil di Update');
        }
    }

    public function getNoSj(Request $request){
        $no_sj = $request->no_sj;
        if($no_sj == ''){
            $items = DB::select(DB::raw("SELECT no FROM tsj WHERE ISNULL(sendstat,'N') = 'N' GROUP BY no"));
        }else{
            $items = DB::select(DB::raw("SELECT no,code_mlokasi2,name_mlokasi2,tdate FROM tsj WHERE ISNULL(sendstat,'N') = 'N' AND no = '$no_sj'"));
        }
        return json_encode($items);
    }

    public function  getItem(Request $request){
        $search = $request->search;
        $no_sj = $request->no_sj;

        if($search == ''){
            $items = DB::select(DB::raw("SELECT code_mitem,name_mitem FROM tsj WHERE ISNULL(sendstat,'N') = 'N' and no = '$no_sj'"));
        }else{
            $items = DB::select(DB::raw("SELECT code_mitem,name_mitem FROM tsj WHERE ISNULL(sendstat,'N') = 'N' AND no = '$no_sj' and code_mitem like '%$search%'"));
        }
        
        $response = array();
        foreach($items as $item){
            $response[] = array(
                "id"=>$item->code_mitem,
                "text"=>$item->code_mitem." - ".$item->name_mitem
            );
        }

      return response()->json($response);
    }
    public function  getCodeItem(Request $request){
        $search = $request->search;

        if($search == ''){
            $items = DB::select(DB::raw("SELECT code_mitem,name_mitem,qty FROM tsj WHERE ISNULL(sendstat,'N') = 'N'"));
        }else{
            $items = DB::select(DB::raw("SELECT code_mitem,name_mitem,qty FROM tsj WHERE ISNULL(sendstat,'N') = 'N' AND code = '$search'"));
        }
        
        return json_encode($items);
    }
    public function  getDetailItem(Request $request){
        $code = $request->code;

        if($code == ''){
            $items = DB::select(DB::raw("select code_mitem, name_mitem, code_muom, qty, price, disc1, disc2, disc3, subtotal from tpo where tstatus = 1 and no = '$code'"));
        }else{
            $items = DB::select(DB::raw("select code_mitem, name_mitem, code_muom, qty, price, disc1, disc2, disc3, subtotal from tpo where tstatus = 1 and no = '$code'"));
        }
        
        return json_encode($items);
    }
}
