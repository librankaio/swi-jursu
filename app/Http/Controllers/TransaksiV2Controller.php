<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiV2Controller extends Controller
{
    public function index(Request $request){
        // $counters = DB::table('mwhse')->get();
        $counters = DB::select(DB::raw("SELECT no FROM tsj WHERE ISNULL(sendstat,'N') = 'N' GROUP BY no"));
        if (isset($request->no_sj)) {
            // dd($request->all());
            if ($request->searchtext == null) {

                $dtfr = $request->input('dtfr');
                $dtto = $request->input('dtto');
                // $datefrForm = Carbon::createFromFormat('d/m/Y', $dtfr)->format('Y-m-d');
                // $datetoForm = Carbon::createFromFormat('d/m/Y', $dtto)->format('Y-m-d');

                // $results = DB::table('tsj')->get();
                $results = DB::table('vwpacklist')->where('no','=',$request->no_sj)->get();
                // $counters = DB::table('mwhse')->groupBy('no')->get();
                // $counters = DB::select(DB::raw("SELECT no FROM tsj WHERE ISNULL(sendstat,'N') = 'N' AND no = '".$request->no_sj."' GROUP BY no"));
                $counters = DB::select(DB::raw("SELECT no FROM tsj WHERE ISNULL(sendstat,'N') = 'N' GROUP BY no"));
                // dd($counters);
                // $results = DB::table('tsj')->whereBetween('dptanggal', [$datefrForm, $datetoForm])->where('tstatus', '=', 1)->where('jenis_dokumen', '=', $jenisdok)->where('dpnomor', '=', $searchtext)->paginate(10);

                // $query = DB::select('EXEC rptTest ?,?,?',[$datefrForm,$datetoForm,'BC 4.0']);

                $page = request('page', 1);
                $pageSize = 25;
                $query = DB::table('vwpacklist')->get();
                $offset = ($page * $pageSize) - $pageSize;
                // $data = array_slice($query, $offset, $pageSize, true);
                // $results = new \Illuminate\Pagination\LengthAwarePaginator($data, count($data), $pageSize, $page);

               

                return view('pages.transaksiv2', [
                    'results' => $results,
                    'counters' => $counters
                ]);
            } else if ($request->searchtext != null) {
                $searchtext = $request->searchtext;
                $dtfr = $request->input('dtfr');
                $dtto = $request->input('dtto');
                $jenisdok = $request->input('jenisdok');
                // $counters = DB::table('mwhse')->get();
                $counters = DB::select(DB::raw("SELECT no FROM tsj WHERE ISNULL(sendstat,'N') = 'N' GROUP BY no"));
                // dd($counters);
                // $datefrForm = Carbon::createFromFormat('d/m/Y', $dtfr)->format('Y-m-d');
                // $datetoForm = Carbon::createFromFormat('d/m/Y', $dtto)->format('Y-m-d');

                // $results = DB::table('pemasukan_dokumen')->whereBetween('dptanggal', [$datefrForm, $datetoForm])->where('tstatus', '=', 1)->where('jenis_dokumen', '=', $jenisdok)->where('dpnomor', '=', $searchtext)->paginate(10);

                // $results = DB::table('tsj')->get();
                $results = DB::table('vwpacklist')->where('no','=',$request->no_sj)->get();

                return view('pages.transaksiv2', [
                    'results' => $results,
                    'counters' => $counters,
                ]);
            }
        }
        return view('pages.transaksiv2',[
            'counters' => $counters,
        ]);
    }

    public function update(Transaksi $transaksi){
        // dd(request()->all());
        $count=0;
        $countrows = sizeof(request('nosj_d'));
        $status = "";
        for ($i=0;$i<sizeof(request('nosj_d'));$i++){
            // Transaksi::where('code_mitem', '=', strtok(request('kode_d')[$i]))->update([
            //     'sendstat' => "Y",
            // ]);
            if(request('checked_item')[$i] == 'Y'){
                DB::update(DB::raw("update mitemwhse set qty -= ".(float)request('quantity_d')[$i]." WHERE code_mitem = '".strtok(request('kode_d')[$i], " ")."' and code_mwhse = '".request('code_tujuan')[$i]."'"));
                DB::update(DB::raw("update tsj SET sendstat = 'Y' WHERE no = '".request('nosj_d')[$i]."' and code_mitem = '".strtok(request('kode_d')[$i], " ")."'"));
                DB::update(DB::raw("UPDATE tsj set docstat = 'C' WHERE dbo.fgetsendstattsj('".request('nosj_d')[$i]."') = 0 AND no = '".request('nosj_d')[$i]."'"));
            }
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
            return redirect()->route('packlist')->with('success', 'Data berhasil di Update');
        }
    }

    public function getDetailSj(Request $request){
        $nosj = $request->no_sj;
        if($nosj == ''){
            $items = DB::select(DB::raw("SELECT * FROM tsj WHERE ISNULL(sendstat,'N') = 'N'"));
        }else{
            $items = DB::select(DB::raw("SELECT * FROM tsj WHERE ISNULL(sendstat,'N') = 'N'"));
        }
        return json_encode($items);
    }
}
