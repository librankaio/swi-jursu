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
        $countrows = sizeof(request('nosj_d'));
        $status = "";
        for ($i=0;$i<sizeof(request('nosj_d'));$i++){
            // Transaksi::where('code_mitem', '=', strtok(request('kode_d')[$i]))->update([
            //     'sendstat' => "Y",
            // ]);
            
            DB::update(DB::raw("update mitemwhse set qty -= ".(float)request('quantity_d')[$i]." WHERE code_mitem = '".strtok(request('kode_d')[$i], " ")."' and code_mwhse = '".request('code_tujuan')[$i]."'"));
            DB::update(DB::raw("update tsj SET sendstat = 'Y' WHERE no = '".request('nosj_d')[$i]."' and code_mitem = '".strtok(request('kode_d')[$i], " ")."'"));
            DB::update(DB::raw("UPDATE tsj set docstat = 'C' WHERE dbo.fgetsendstattsj('".request('nosj_d')[$i]."') = 0 AND no = '".request('nosj_d')[$i]."'"));
            $count++;

        }
        // for ($i=0;$i<sizeof(request('checks'));$i++){
        //     // dd((float)request('qty_d')[$i]);
        //     if(request('checks')[$i] == "on"){
        //         $status = "Y";
        //     }
        //     Transaksi::where('code_mitem', '=', request('codemitem_d')[$i])->update([
        //         // 'sendstat' => request('checks')[$i],
        //         'sendstat' => $status,
        //     ]);
        //     // DB::update(DB::raw("update mitemwhse set qty = qty - ".(float)request('qty_d')[$i]." where code_mitem = '".request('codemitem_d')[$i]."' and code_mwhse = 'HDH'"));
        //     // DB::update(DB::raw("update mitemwhse set qty = qty + ".(float)request('qty_d')[$i]." where code_mitem = '".request('codemitem_d')[$i]."' and code_mwhse = '".request('code_lokasi')[$i]."'"));
            
        //     // DB::update(DB::raw("update mitemwhse set stock -= ".(float)request('qty_d')[$i]." WHERE code_mitem = '".request('codemitem_d')[$i]."' and code_mwhse = '".request('code_lokasi')[$i]."'"));
        //     DB::update(DB::raw("update mitemwhse set qty -= ".(float)request('qty_d')[$i]." WHERE code_mitem = '".request('codemitem_d')[$i]."' and code_mwhse = '".request('code_lokasi')[$i]."'"));
        //     DB::update(DB::raw("update tsj SET sendstat = 'Y' WHERE no = '".request('no_d')[$i]."' and code_mitem = '".request('codemitem_d')[$i]."'"));
        //     $count++;
        // }
        
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
