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
        <h1>Inventory By Category</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Report</a></div>
            <div class="breadcrumb-item"><a class="text-muted">Inventory By Category</a></div>
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
            <form action="/inventcategory" method="get" id="myform">
                <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row pb-3">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select class="form-control select2" id="category" name="category" form="myform">
                                                    @if(request('category') != NULL)
                                                    <option selected disabled value="{{ $_GET['category'] }}">{{ $_GET['hdn_category'] }}</option>
                                                    @else
                                                    <option disabled selected>--Select Category--</option>
                                                    @endif  
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category->display }}">{{ $category->display }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="text" class="form-control"
                                                value="@php if(request('hdn_category') != NULL){ echo $_GET['hdn_category'];} @endphp"
                                                id="hdn_category" name="hdn_category" style="display: none;">
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Tanggal Dari</label>
                                            <div class="input-group date" id="dtfrom">
                                            <input type="text" class="form-control"
                                                value="@php if(request('dtfrom')==NULL){ echo date('d/m/Y');} else{ echo $_GET['dtfrom']; } @endphp"
                                                name="dtfrom">
                                            <span class="input-group-append">
                                                <span class="input-group-text bg-white d-block">
                                                <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Sampai Tanggal</label>
                                            <div class="input-group date" id="dtto">
                                            <input type="text" class="form-control"
                                                value="@php if(request('dtto')==NULL){ echo date('d/m/Y');} else{ echo $_GET['dtto']; } @endphp"
                                                name="dtto">
                                            <span class="input-group-append">
                                                <span class="input-group-text bg-white d-block">
                                                <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary px-5" onclick="show_loading()"><span> View</span></button>
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
                                            <th scope="col" class="border border-5" style="text-align: center;">Category</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Product</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Kode</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Cost</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Price</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Margin</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Inventory</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Release Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($results)
                                            @php $counter = 0 @endphp
                                            @php $grandtot = 0; @endphp

                                            @foreach($results as $data => $item)
                                            @php $counter++ @endphp
                                            @php 
                                            $total_amount = $item->sellprice * $item->stock;
                                            $total_perrow = $total_amount
                                            @endphp
                                            @if($grandtot == 0)
                                                @php $grandtot = $grandtot + $total_perrow @endphp
                                            @else
                                                @php $grandtot = $grandtot + $total_perrow @endphp
                                            @endif
                                            <tr row_id="{{ $counter }}" id='row_{{ $counter }}' class='text-center'>
                                                <th style='readonly:true;' row_th="{{ $counter }}" class='border border-5'>{{ $counter}}</th>
                                                <td class='border border-5'>{{ $item->name_mgrp }}</td>
                                                <td class='border border-5'>{{ $item->name }}</td>
                                                <td class='border border-5'>{{ $item->code }}</td>
                                                @if($item->lastprice == 0)
                                                <td class='border border-5'>0</td>
                                                @else
                                                    <td class='border border-5'>{{ number_format($item->lastprice, 2, '.', ',') }}</td>
                                                @endif
                                                <td class='border border-5'>{{ number_format($item->sellprice, 2, '.', ',') }}</td>
                                                <td class='border border-5'>0</td>
                                                <td class='border border-5'>{{ number_format($item->stock, 2, '.', ',') }}</td>
                                                <td class='border border-5'>{{ date("Y-m-d h:i:s", strtotime($item->createddate)) }}</td>
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
                                @isset($results)
                                {{-- <div class="col-12 col-md-12 col-lg-12 d-flex justify-content-end">                     --}}
                                <div class="col-12 col-md-12 col-lg-12">                    
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Grand Total</label>
                                            <input type="text" class="form-control" value="{{ number_format($grandtot, 2, '.', ',') }}" readonly>
                                        </div>
                                    </div>                                
                                </div>
                                @endisset
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
