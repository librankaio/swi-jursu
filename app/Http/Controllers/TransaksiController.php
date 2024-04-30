<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    //
    public function index(Request $request){
        if (isset($request->dtfr)) {
            // dd($request->all());
            if ($request->searchtext == null) {

                $dtfr = $request->input('dtfr');
                $dtto = $request->input('dtto');
                // $datefrForm = Carbon::createFromFormat('d/m/Y', $dtfr)->format('Y-m-d');
                // $datetoForm = Carbon::createFromFormat('d/m/Y', $dtto)->format('Y-m-d');

                $results = DB::table('tsj')->get();
                // $results = DB::table('tsj')->whereBetween('dptanggal', [$datefrForm, $datetoForm])->where('tstatus', '=', 1)->where('jenis_dokumen', '=', $jenisdok)->where('dpnomor', '=', $searchtext)->paginate(10);

                // $query = DB::select('EXEC rptTest ?,?,?',[$datefrForm,$datetoForm,'BC 4.0']);
                // dd($results);

                $page = request('page', 1);
                $pageSize = 25;
                $query = DB::table('tsj')->get();
                $offset = ($page * $pageSize) - $pageSize;
                // $data = array_slice($query, $offset, $pageSize, true);
                // $results = new \Illuminate\Pagination\LengthAwarePaginator($data, count($data), $pageSize, $page);

               

                return view('pages.transaksi', [
                    'results' => $results
                ]);
            } else if ($request->searchtext != null) {
                $searchtext = $request->searchtext;
                $dtfr = $request->input('dtfr');
                $dtto = $request->input('dtto');
                $jenisdok = $request->input('jenisdok');
                // $datefrForm = Carbon::createFromFormat('d/m/Y', $dtfr)->format('Y-m-d');
                // $datetoForm = Carbon::createFromFormat('d/m/Y', $dtto)->format('Y-m-d');

                // $results = DB::table('pemasukan_dokumen')->whereBetween('dptanggal', [$datefrForm, $datetoForm])->where('tstatus', '=', 1)->where('jenis_dokumen', '=', $jenisdok)->where('dpnomor', '=', $searchtext)->paginate(10);

                $results = DB::table('tsj')->get();
                dd($results);

                return view('pages.transaksi', [
                    'results' => $results
                ]);
            }
        }
        return view('pages.transaksi');
    }

    public function update(Transaksi $transaksi){
        // dd(request()->all());
        $count=0;
        $countrows = sizeof(request('id_d'));
        for ($i=0;$i<sizeof(request('id_d'));$i++){
            Transaksi::where('id', '=', $transaksi->id)->update([
                'sendstat' => request('checks')[$i],
            ]);
            $count++;
        }
        
        if($count == $countrows){
            return redirect()->route('transaksi');
        }
    }
}
