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
        <h1>Product By Outlet</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Report</a></div>
            <div class="breadcrumb-item"><a class="text-muted">Product By Outlet</a></div>
        </div>
    </div>
    @php
        $tpos_save = session('tpos_save');
    @endphp
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                @include('layouts.flash-message')
            </div>
        </div>
        <div class="row">
            <form action="/productbyoutlet" method="get" id="myform">
                <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row pb-3">
                                    <div class="col-12">
                                        <input type="text" class="form-control"
                                                value="OK"
                                                id="hdn_submit" name="hdn_submit" style="display: none;">
                                        <button type="submit" class="btn btn-primary px-5" onclick="show_loading()"><span> View Laporan</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </form>
        </div>
        <div class="row">
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
                                <div class="form-group">
                                    {{-- <label>counter</label> --}}
                                    <input type="text" class="form-control" id="number_counter" value="0" hidden readonly>
                                </div>
                                <table class="table table-bordered" id="datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="border border-5" style="text-align: center;">No</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Kode</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Nama</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Satuan</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Category</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">UTM</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">HDH</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">KDY</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">CLD</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">KLD</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">JHR</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">SDG</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">MCG</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">SMB</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">CMP</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">MCE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($results)
                                            @php $counter = 0 @endphp
                                            @php $grandtot = 0; @endphp

                                            @foreach($results as $data => $item)
                                            @php $counter++ @endphp
                                            <tr row_id="{{ $counter }}" id='row_{{ $counter }}' class='text-center'>
                                                <th style='readonly:true;' row_th="{{ $counter }}" class='border border-5'>{{ $counter}}</th>
                                                <td class='border border-5'>{{ $item->code }}</td>
                                                <td class='border border-5'>{{ $item->name }}</td>
                                                <td class='border border-5'>{{ $item->code_muom }}</td>
                                                <td class='border border-5'>{{ $item->name_mgrp }}</td>
                                                <td class='border border-5'>{{ $item->UTM }}</td>
                                                <td class='border border-5'>{{ $item->HDH }}</td>
                                                <td class='border border-5'>{{ $item->KDY }}</td>
                                                <td class='border border-5'>{{ $item->CLD }}</td>
                                                <td class='border border-5'>{{ $item->KLD }}</td>
                                                <td class='border border-5'>{{ $item->JHR }}</td>
                                                <td class='border border-5'>{{ $item->SDG }}</td>
                                                <td class='border border-5'>{{ $item->MCG }}</td>
                                                <td class='border border-5'>{{ $item->SMB }}</td>
                                                <td class='border border-5'>{{ $item->CMP }}</td>
                                                <td class='border border-5'>{{ $item->MCE }}</td>
                                            </tr>
                                            @endforeach
                                        @endisset
                                    </tbody>                            
                                </table>
                                <br>
                            </div>                                              
                        </div>      
                        <div class="card-footer">
                            <div class="row">
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
        $("#category").on('select2:select', function(e) {
            category = $("#select2-category-container").text();
            console.log(category);
            $("#hdn_category").val(category);
        });
        $('#datatable').DataTable({
            "ordering":false,
            "bInfo" : false,
            "pageLength": 50
            // "bPaginate": false,
            // "searching": false
        });
    })
</script>
@endsection
