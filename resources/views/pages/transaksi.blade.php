@extends('layouts.main')
@section('topscripts')
<style>
    .row .justify-content-between{
        padding-bottom : 10px;
        padding-top : 10px;
    }
</style>
@stop
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Transaksi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>
            <div class="breadcrumb-item"><a class="text-muted">Transaksi</a></div>
        </div>
    </div>
    @php
        $tpos_save = session('tpos_save');
    @endphp
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-4">
                <form action="/transaksi" method="GET">
                <div class="card">
                    <div class="card-header">
                        <h4>Header Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">                    
                                <div class="form-group">
                                    <label>Periode</label>
                                    <input type="date" class="form-control" name="dtfr" value="@php if(request('dtfr')==NULL){ echo date('Y-m-d');} else{ echo $_GET['dtfr']; } @endphp">
                                </div>                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>s/d</label>
                                    <input type="date" class="form-control" name="dtto" value="@php if(request('dtto')==NULL){ echo date('Y-m-d');} else{ echo $_GET['dtto']; } @endphp">
                                </div>
                            </div>
                            <div class="col-md-6">                                
                                <div class="form-group">
                                    <label>Toko Tujuan</label>
                                    <select class="form-control select2" id="toko_tujuan" name="toko_tujuan">
                                            @if(request('toko_tujuan') != NULL)
                                            <option selected>{{ $_GET['toko_tujuan']}}</option>
                                            @else
                                            <option disabled selected>--Select Toko--</option>
                                            @endif  
                                        <option>TEST</option>
                                    </select>
                                </div>                                
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-12">                    
                                <div class="form-group">
                                    <label>Counter</label>
                                    <select class="form-control select2" name="counter" id="counter">
                                        @if(request('counter') == NULL)
                                        <option disabled selected>--Select Counter--</option>
                                        @else
                                        <option selected>@php echo $_GET['counter']; @endphp</option>
                                        @endif
                                        @foreach($counters as $data => $counter)
                                        <option>{{ $counter->name }}</option>
                                        @endforeach
                                    </select>
                                </div>                                
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-end">                    
                                <div class="form-group">
                                    <button class="btn btn-primary mr-1" id="confirm" type="submit" onclick="show_loading()">View</button>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-3">
                            <div class="col-6"></div>
                            <div class="col-6 d-flex justify-content-end">
                                {{-- <button type="submit" formaction="rlaperoutletprint" formtarget="_blank" class="btn btn-success"><i
                                    class="far fa-print"></i><span> Print</span></button> --}}
                                    {{-- <a href="/tsuratjalan/{{ $item->id }}/print"
                                        class="btn btn-icon icon-left btn-success" target="_blank"><i class="far fa-print">
                                            Print</i></a> --}}
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="border border-5" style="text-align: center;">No</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">No SJ</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Tanggal SJ</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Tujuan</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Kode</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Nama</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Qty</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Check</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @php $counter = 0; @endphp
                                    @for($i = 0; $i < sizeof($results); $i++) 
                                    @php $counter++; @endphp 
                                    <tr row_id="{{ $counter }}">
                                        <th class='id-header border border-5' style='readonly:true;' headers="{{ $counter }}">{{ $counter }}</th>
                                        <td class='border border-5'><input style='width:120px;' readonly form='thisform' class='namabrgclass form-control' name='nama_brg_d[]' type='text' value='{{ $penjualands[$i]->nama }}'></td>
                                        <td class='border border-5'><input style='width:120px;' form='thisform' class='row_qty qtyclass form-control' name='qty_d[]' id='qty_d_{{ $counter }}' type='text' value='{{ number_format($penjualands[$i]->quantity, 0, '.', '') }}'></td>
                                        <td class='border border-5'><input style='width:120px;' readonly form='thisform' class='satuanclass form-control' name='satuan_d[]' type='text' value='{{ $penjualands[$i]->satuan }}'></td>
                                        <td class='border border-5'><input style='width:120px;' readonly form='thisform' class='hrgjualclass form-control' name='hrgjual_d[]' id='hrgjual_d_{{ $counter }}' type='text' value='{{ number_format($penjualands[$i]->harga, 0, '.', ',') }}'></td>
                                        <td class='border border-5'><input style='width:120px;' readonly form='thisform' class='totalclass form-control' name='total_d[]' id='total_d_{{ $counter }}' type='text' value='{{ number_format($penjualands[$i]->total, 0, '.', ',') }}'></td>
                                        <td class="border border-5"><button title='Delete' class='delete btn btn-primary' value="{{ $counter }}"><i style='font-size:15pt;color:#ffff;' class='fa fa-trash'></i></button></td>
                                        <td class="border border-5" hidden><input style='width:120px;' readonly form='thisform' class='idclass form-control' name='id_d[]' type='text' value='{{ $penjualands[$i]->id }}' id="tbl_detail_id_{{ $counter }}"></td>
                                        <td class="border border-5" hidden><input style='width:120px;' readonly form='thisform' class='delclass form-control' name='deleted_item_d[]' type='text' value='' id="deleted_d_{{ $counter }}"></td>
                                        <td class="border border-5" hidden><input style='width:120px;' readonly form='thisform' class='existdbclass form-control' name='existdb_d[]' type='text' value='{{ $penjualands[$i]->id }}' id="existdb_{{ $counter }}"></td>
                                        </tr>
                                    @endfor --}}
                                    @php
                                    $no=0;
                                    $dpnomor = ""; 
                                    $bpbnomor = "";@endphp
                                    @isset($results)
                                    @foreach ($results as $key => $item)
                                    @php $no++; @endphp 
                                    <th class='id-header border border-5' style='readonly:true; text-align: center;' headers="{{ $no }}">{{ $no }}</th>
                                    <td class='border border-5'><input style='width:100%; text-align: center;' readonly form='thisform' class='namabrgclass form-control' name='nama_brg_d[]' type='text' value='{{ $item->no }}'></td>
                                    <td class='border border-5'><input style='width:100%; text-align: center;' readonly form='thisform' class='namabrgclass form-control' name='nama_brg_d[]' type='text' value='{{ date("Y-m-d", strtotime($item->tdate)) }}'></td>
                                    <td class='border border-5'><input style='width:100%; text-align: center;' readonly form='thisform' class='namabrgclass form-control' name='nama_brg_d[]' type='text' value='{{ $item->name_mlokasi2 }}'></td>
                                    <td class='border border-5'><input style='width:100%; text-align: center;' readonly form='thisform' class='namabrgclass form-control' name='nama_brg_d[]' type='text' value='{{ $item->code_mitem }}'></td>
                                    <td class='border border-5'><input style='width:100%; text-align: center;' readonly form='thisform' class='namabrgclass form-control' name='nama_brg_d[]' type='text' value='{{ $item->name_mitem }}'></td>
                                    <td class='border border-5'><input style='width:100%; text-align: center;' readonly form='thisform' class='namabrgclass form-control' name='nama_brg_d[]' type='text' value='{{ number_format($item->qty) }}'></td>
                                    <td class='border border-5' style='padding-top: 20px; padding-left: 30px;'><input class="form-check-input" type="checkbox" name="checks[]" id="checkall"></td>
                                    @endforeach
                                    @endisset 
                                </tbody>                            
                            </table>
                            <br>
                        </div>                                              
                    </div>      
                    <div class="card-footer text-right">
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-end">                    
                                <div class="form-group">
                                    <button class="btn btn-primary mr-1" id="confirm" type="submit" formaction="#">Update</button>
                            <button class="btn btn-secondary" type="reset">Reset</button>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
@section('botscripts')
<script type="text/javascript">
    $(document).ready(function() {
        //CSRF TOKEN
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $('.select2').select2({});

        });

        $('#datatable').DataTable({
        // "ordering":false,
        "bInfo" : false,
        // "bPaginate": false,
        // "searching": false
        });
    })
</script>
@endsection
