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
        <h1>Retur Pembelian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>
            <div class="breadcrumb-item"><a class="text-muted">Retur Pembelian</a></div>
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
                <form action="/returpembelian/update" method="GET" id="thisform">
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
                                            <th scope="col" class="border border-5" style="text-align: center;">Code Supplier</th>
                                            {{-- <th scope="col" class="border border-5" style="text-align: center;">Subtotal</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Pajak /pcs</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Pajak Total</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Discount Total</th> --}}
                                            <th scope="col" class="border border-5" style="text-align: center;">Grand Total</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Note</th>
                                            <th scope="col" class="border border-5" style="text-align: center;">Approval</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0 @endphp
                                        @foreach($results as $data => $item)
                                        @php $counter++ @endphp
                                        <tr row_id="{{ $counter }}" id='row_{{ $counter }}' class='text-center'>
                                            <th style='readonly:true;' row_th="{{ $counter }}" class='border border-5'>{{ $counter}}</th>
                                            {{-- <td class='border border-5'><input style='width:100%;' readonly form='thisform' class='nosjclass form-control' name='nosj_d[]' type='text' value='{{ $item->no }}'></td> --}}
                                            <td class='border border-5'><a style="cursor: pointer;" onclick="showDetailModal('{{ $item->no }}')" id="anchor">{{ $item->no }}</a></td>
                                            <td class='border border-5' hidden><input style='width:120px;' disabled form='thisform' class='hdnnoclass form-control' name='hdn_no_d[]' type='text' value='{{ $item->no }}'></td>
                                            <td class='border border-5'><input style='width:100%;' readonly form='thisform' class='tanggalclass form-control' type='text' value='{{ date("Y-m-d", strtotime($item->tdate)) }}'></td>
                                            <td class='border border-5'><input style='width:100%;' readonly form='thisform' class='tujuanclass form-control' type='text' value='{{ $item->name_msupp }}'></td>
                                            <td class='border border-5'><input style='width:100%;' readonly form='thisform' class='kodeclass form-control' type='text' value='{{ $item->code_msupp }}'></td>
                                            {{-- <td class='border border-5'><input style='width:100%;' readonly form='thisform' class='namaitemclass form-control' name='nama_item_d[]' type='text' value='{{ $item->subtotalheader }}'></td>
                                            <td class='border border-5'><input style='width:100px;' readonly form='thisform' class='quantityclass form-control' name='quantity_d[]' type='text' value='{{ $item->taxpcg }}'></td>
                                            <td class='border border-5'><input style='width:100px;' readonly form='thisform' class='quantityclass form-control' name='quantity_d[]' type='text' value='{{ $item->taxtotal }}'></td>
                                            <td class='border border-5'><input style='width:100px;' readonly form='thisform' class='quantityclass form-control' name='quantity_d[]' type='text' value='{{ $item->disctotal }}'></td> --}}
                                            <td class='border border-5'><input style='width:100%;' readonly form='thisform' class='quantityclass form-control' type='text' value='{{ number_format($item->grdtotal, 0, '.', '.') }}'></td>
                                            <td class='border border-5'><input style='width:100%;' readonly form='thisform' class='noteclass form-control' type='text' value='{{ $item->note }}'></td>
                                            <td class='border border-5 pl-5 pb-4'><input class="form-check-input checkbox" type="checkbox" name="approval_d[]" value="Y"></td>
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
                                        <button class="btn btn-primary mr-1" id="confirm" type="submit" onclick="show_loading()">Approve</button>
                                {{-- <button class="btn btn-secondary" type="reset">Reset</button> --}}
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
<div class="modal" tabindex="-1" id="mymodal">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Item <div id="title_modal"></div></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="#" method="POST">
            @csrf
            <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered" id="modaltable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="border border-5" style="text-align: center;">No</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Code Item</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Nama Item</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Quantity</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Price</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>                            
                            </table>
                        </div>
                    </div>            
            </div>
            {{-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button class="btn btn-primary mr-1" type="submit" id="confirm_modal" onclick="submitForm();">Save</button> 
            </div> --}}
        </form>
      </div>
    </div>
</div>
@stop
@section('botscripts')
<script type="text/javascript">
    function showDetailModal(no){
        console.log(no);
        // code = $("#anchor").text();
        getDetailData(no);
        $('#mymodal').modal({
            backdrop: 'static',
            keyboard: true, 
            show: true,
        });
    }
    $('#mymodal').on('hide.bs.modal', function (e) {
        // alert("Jancuk");
        $('#title_modal').html('');
        $("#modaltable tbody").empty();
        // do something...
    });
    function getDetailData(no){
        $.ajax({
            url: '{{ route('getreturdetailitem') }}', 
            method: 'post', 
            data: {'no': no}, 
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
            dataType: 'json', 
            success: function(response) {
                $('#title_modal').html(no);
                console.log(response);
                    number_counter = Number($('#number_counter').val());
                    for (i=0; i < response.length; i++) {
                        tablerow = `<tr class='text-center'>
                                    <th class='border border-5'>${i+1}</th>
                                    <td class='border border-5'>${response[i].code_mitem}</td>
                                    <td class='border border-5'>${response[i].name_mitem}</td>
                                    <td class='border border-5'>${thousands_separators(parseFloat(response[i].qty))}</td>
                                    <td class='border border-5'>${thousands_separators(parseFloat(response[i].price))}</td>
                                    <td class='border border-5'>${thousands_separators(parseFloat(response[i].subtotal))}</td>
                                    </tr>`;
                        $("#modaltable tbody").append(tablerow);
                    }
            }
        }); 
        console.log(no + " to str");
    }
    $(document).ready(function() {
        //CSRF TOKEN
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {          
            $('.select2').select2({});

            $(document).on("click", ".form-check-input", function(e) {
                // alert("oke checked!");
                if ($(this).is(':checked')) {
                    $(this).closest('tr').find('.hdnnoclass').prop('disabled', false);
                }else{
                    $(this).closest('tr').find('.hdnnoclass').prop('disabled', true);
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
