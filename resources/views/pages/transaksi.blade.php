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
        <form action="" method="GET" id="thisform">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-4">
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
                                        <option disabled selected>--Select Toko--</option>
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
                                    <button class="btn btn-primary mr-1" id="confirm" type="submit" formaction="#" onclick="show_loading()">View</button>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
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
    </form>
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
