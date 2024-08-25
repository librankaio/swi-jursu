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
        <h1>Pembelian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>
            <div class="breadcrumb-item"><a class="text-muted">Pembelian</a></div>
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
            <div class="col-12 col-md-12 col-lg-12">
                <form action="/packlist/update" method="GET" id="thisform">
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
                                            <th scope="col" class="border border-5" style="text-align: center;">No Pembelian</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Tanggal</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Supplier</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">No Reff</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Subtotal</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Pajak /pcs</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Pajak Total</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Discount Total</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Grand Total</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Note</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Approval</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0 @endphp
                                        @foreach($results as $data => $item)
                                        @php $counter++ @endphp
                                        <tr row_id="{{ $counter }}" id='row_{{ $counter }}' class='text-center'>
                                            <th style='readonly:true;' row_th="{{ $counter }}" class='border border-5'>{{ $counter}}</th>
                                            <td class='border border-5'><input style='width:100%;' readonly form='thisform' class='nosjclass form-control' name='nosj_d[]' type='text' value='{{ $item->no }}'></td>
                                            <td class='border border-5'><input style='width:120px;' readonly form='thisform' class='tanggalclass form-control' name='tanggal_d[]' type='text' value='{{ $item->tdate }}'></td>
                                            <td class='border border-5'><input style='width:100%;' readonly form='thisform' class='tujuanclass form-control' name='tujuan_d[]' type='text' value='{{ $item->name_msupp }}'></td>
                                            <td class='border border-5'><input style='width:100%;' readonly form='thisform' class='kodeclass form-control' name='kode_d[]' type='text' value='{{ $item->refno }}'></td>
                                            <td class='border border-5'><input style='width:100%;' readonly form='thisform' class='namaitemclass form-control' name='nama_item_d[]' type='text' value='{{ $item->subtotalheader }}'></td>
                                            <td class='border border-5'><input style='width:100px;' readonly form='thisform' class='quantityclass form-control' name='quantity_d[]' type='text' value='{{ $item->taxpcg }}'></td>
                                            <td class='border border-5'><input style='width:100px;' readonly form='thisform' class='quantityclass form-control' name='quantity_d[]' type='text' value='{{ $item->taxtotal }}'></td>
                                            <td class='border border-5'><input style='width:100px;' readonly form='thisform' class='quantityclass form-control' name='quantity_d[]' type='text' value='{{ $item->disctotal }}'></td>
                                            <td class='border border-5'><input style='width:100px;' readonly form='thisform' class='quantityclass form-control' name='quantity_d[]' type='text' value='{{ $item->grdtotal }}'></td>
                                            <td class='border border-5'><input style='width:100px;' readonly form='thisform' class='quantityclass form-control' name='quantity_d[]' type='text' value='{{ $item->grdtotal }}'></td>
                                            <td><input class="form-check-input checkbox" type="checkbox" name="read_mitem" value="Y"></td>
                                            <td class='border border-5'><a title='Delete' class='delete'><i style='font-size:15pt;color:#6777ef;' class='fa fa-trash'></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>                            
                                </table>
                                <br>
                            </div>                                              
                        </div>      
                        <div class="card-footer text-right">
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-end">                    
                                    <div class="form-group">
                                        <button class="btn btn-primary mr-1" id="confirm" type="submit" onclick="show_loading()">Update</button>
                                <button class="btn btn-secondary" type="reset">Reset</button>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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

            $("#no_sj").on('select2:select', function(e) {
                var no_sj = $(this).val();
                show_loading()
                console.log(no_sj);
                $.ajax({
                    url: '{{ route('getnosj') }}', 
                    method: 'post', 
                    data: {'no_sj': no_sj}, 
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                    dataType: 'json', 
                    success: function(response) {
                        console.log(response);
                            number_counter = Number($('#number_counter').val());
                            for (i=0; i < response.length; i++) {
                                if(response[i].no == no_sj){
                                    console.log("contol");
                                    $('#tujuan').val(response[i].name_mlokasi2);  
                                    $('#code_tujuan').val(response[i].code_mlokasi2);  
                                    date =  response[i].tdate;     
                                    $('#dt').val(date.substring(0, 10));                                  
                                }
                            }
                            hide_loading();
                    }
                });                
            });
            
            $("#kode").select2({
                placeholder : 'Select Kode',
                ajax: {
                    url: '{{ route('getitem') }}',
                    type: "post",
                    dataType: "json",
                    delay: 250,
                    data: function (params) {
                        var no_sj = $("#no_sj").val();
                        console.log(no_sj);

                        var query = {
                            _token: CSRF_TOKEN,
                            search : params.term, //search term
                            no_sj : params.no_sj || no_sj//no_sj term
                        }
                        // return {
                            
                        //     query
                        // };
                        return query;
                        console.log("query"+query);
                    },
                    processResults: function (response) {
                        console.log(response)                  
                        return {
                            results: response,          
                        };
                    },
                    cache: true,
                }
            });

            $("#kode").on('select2:select', function(e) {
                var code = $(this).val();
                show_loading()
                console.log(code);
                $.ajax({
                    url: '{{ route('getcodeitem') }}', 
                    method: 'post', 
                    data: {'code': code}, 
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                    dataType: 'json', 
                    success: function(response) {
                        console.log(response);
                            number_counter = Number($('#number_counter').val());
                            for (i=0; i < response.length; i++) {
                                if(response[i].code_mitem == code){
                                    $('#nama_item').val(response[i].name_mitem);   
                                    qty = response[i].qty;
                                    $('#quantity_sj').val(Number(qty).toFixed(0));                              
                                }
                            }
                            hide_loading();
                    }
                });                
            });


            var counter = $('#number_counter').val();
            var counter_row = 0;
            $(document).on("click", "#addItem", function(e) {                
                e.preventDefault();
                if($('#quantity').val() == 0){
                    swal('WARNING', 'Quantity tidak boleh 0!', 'warning');
                    return false;
                }
                no_sj = $("#no_sj").val();
                tujuan = $("#tujuan").val();
                tanggal = $("#dt").val();
                kode = $("#kode").val();
                nama_item = $("#nama_item").val();
                quantity = $("#quantity").val();
                if($("#no_sj").val() == 0 || $("#no_sj").val() == ''){
                    swal('WARNING', 'Silahkan pilih nomer sj terlebih dahulu!', 'warning');
                    return false;
                }
                    counter++;
                    counter_row++;
                    kode = $("#select2-kode-container").text();

                    tablerow = `<tr row_id="${counter_row}" id='row_${counter_row}' class='text-center'>
                                <th style='readonly:true;' row_th="${counter}" class='border border-5'>${counter}</th>
                                <td class='border border-5'><input style='width:100%;' readonly form='thisform' class='nosjclass form-control' name='nosj_d[]' type='text' value='${no_sj}'></td>
                                <td class='border border-5'><input style='width:120px;' readonly form='thisform' class='tanggalclass form-control' name='tanggal_d[]' type='text' value='${tanggal}'></td>
                                <td class='border border-5'><input style='width:100%;' readonly form='thisform' class='tujuanclass form-control' name='tujuan_d[]' type='text' value='${tujuan}'></td>
                                <td class='border border-5'><input style='width:100%;' readonly form='thisform' class='kodeclass form-control' name='kode_d[]' type='text' value='${kode}'></td>
                                <td class='border border-5'><input style='width:100%;' readonly form='thisform' class='namaitemclass form-control' name='nama_item_d[]' type='text' value='${nama_item}'></td>
                                <td class='border border-5'><input style='width:100px;' readonly form='thisform' class='quantityclass form-control' name='quantity_d[]' type='text' value='${quantity}'></td>
                                <td class='border border-5'><a title='Delete' class='delete'><i style='font-size:15pt;color:#6777ef;' class='fa fa-trash'></i></a></td>
                                </tr>`;

                    $("#datatable tbody").append(tablerow);

                    $("#kode").prop('selectedIndex', 0).trigger('change');
                    $("#nama_item").val('');
                    $("#quantity").val(0);
                    $("#quantity_sj").val(0);
                    hide_loading()
            });

            $(document).on("click", ".delete", function(e) {
                e.preventDefault();
                var r = confirm("Delete Transaksi ?");
                if (r == true) {
                    // counter_id = $(this).closest('tr').find('.numberclass').val();
                    $(this).closest('tr').remove();
                    var table   = document.getElementById('datatable');
                    for (var i = 1; i < table.rows.length; i++) 
                    {
                    var firstCol = table.rows[i].cells[0];
                    firstCol.innerText = i;
                    }
                    console.log(table.rows.length);
                    counter--;
                    $('#number_counter').val(counter)
                } else {
                    return false;
                }
            });

             // VALIDATE TRIGGER
            $("#quantity").keyup(function(e){
                if (/\D/g.test(this.value)){
                    // Filter non-digits from input value.
                    this.value = this.value.replace(/\D/g, '');
                }
            });
        });

        // $('#datatable').DataTable({
        // // "ordering":false,
        // "bInfo" : false,
        // "pageLength": 50
        // // "bPaginate": false,
        // // "searching": false
        // });
    })
</script>
@endsection
