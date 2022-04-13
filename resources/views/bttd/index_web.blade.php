@extends('layouts.app_web')

@push('ajax')
<style>
	td{padding:0.4% !important;}
    .table-td-valign-middle td, .table-th-valign-middle th, .table-valign-middle td, .table-valign-middle th {
        vertical-align: top !important;
    }
	th{text-transform:uppercase;}
</style>
<script>
        var handleDataTableDefault = function() {
			"use strict";
			
			if ($('#data-table-default').length !== 0) {
				var table=$('#data-table-default').DataTable({
					responsive: false,
                    scrollX: true,
					processing: false,
					ordering: false,
					serverSide: false,
					pageLength: 13,
                    
					ajax:"{{ url('bttd/get_officer_web')}}?tahun={{$tahun}}&bulan={{$bulan}}&wapu={{$wapu}}",
                    columns: [
						{ data: 'DT_RowIndex', render: function (data, type, row, meta) 
							{
								return data;
							} 
						},
						{ data: 'masuk' },
						{ data: 'LIFNR' },
						{ data: 'nama_vendor' },
                        { data: 'InvoiceDate' }, 
                        { data: 'diterima' }, 
						{ data: 'Reference'}, 
						{ data: 'HeaderText' },
						{ data: 'nilai_faktur' },
						{ data: 'nilai_invoice' },
						{ data: 'filebttd' },
						{ data: 'statusnya' },
						
					],
					language: {
                        loadingRecords: 'Proses Memuat Data.......',
                        paginate: {
							// remove previous & next text from pagination
                            previous: '<< previous',
							next: 'Next>>'
						}
					}
				});
				// $('#data-table-default thead th:eq(1)').each(function () {
				// 	var title = $(this).text();
				// 	$(this).html(title+' <input type="text" class="col-search-input" style="display:block;border: solid 1px #b9a4a4; padding: 3px; width: 100%;" placeholder="CARI ' + title + '" />');
				// });
				// $('#data-table-default thead th:eq(2)').each(function () {
				// 	var title = $(this).text();
				// 	$(this).html(title+' <input type="text" class="col-search-input" style="display:block;border: solid 1px #b9a4a4; padding: 3px; width: 100%;" placeholder="CARI ' + title + '" />');
				// });
				// $('#data-table-default thead th:eq(3)').each(function () {
				// 	var title = $(this).text();
				// 	$(this).html(title+' <input type="text" class="col-search-input" style="display:block;border: solid 1px #b9a4a4; padding: 3px; width: 100%;" placeholder="CARI ' + title + '" />');
				// });
				// $('#data-table-default thead th:eq(4)').each(function () {
				// 	var title = $(this).text();
				// 	$(this).html(title+' <input type="text" class="col-search-input" style="display:block;border: solid 1px #b9a4a4; padding: 3px; width: 100%;" placeholder="CARI ' + title + '" />');
				// });
				// $('#data-table-default thead th:eq(5)').each(function () {
				// 	var title = $(this).text();
				// 	$(this).html(title+' <input type="text" class="col-search-input" style="display:block;border: solid 1px #b9a4a4; padding: 3px; width: 100%;" placeholder="CARI ' + title + '" />');
				// });
				// $('#data-table-default thead th:eq(6)').each(function () {
				// 	var title = $(this).text();
				// 	$(this).html(title+' <input type="text" class="col-search-input" style="display:block;border: solid 1px #b9a4a4; padding: 3px; width: 100%;" placeholder="CARI ' + title + '" />');
				// });
				// $('#data-table-default thead th:eq(7)').each(function () {
				// 	var title = $(this).text();
				// 	$(this).html(title+' <input type="text" class="col-search-input" style="display:block;border: solid 1px #b9a4a4; padding: 3px; width: 100%;" placeholder="CARI ' + title + '" />');
				// });
				
				
				table.columns().every(function () {
					var table = this;
					$('input', this.header()).on('keyup change', function () {
						if (table.search() !== this.value) {
							table.search(this.value).draw();
						}
					});
				});
				
				
			}
		};

		var TableManageDefault = function () {
			"use strict";
			return {
				//main function
				init: function () {
					handleDataTableDefault();
				}
			};
		}();

		$(document).ready(function() {
			TableManageDefault.init();
		});
    </script>

@endpush
@section('content')
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{$menu}}</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">{{$menu}}<small>{{$menu_detail}}</small></h1>
    <!-- end page-header -->
    
    <!-- begin row -->
    <div class="row">
        
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="ui-modal-notification-2">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon  btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon  btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon  btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon  btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">{{$menu}}</h4>
                </div>
                <div class="panel-body">
                    
                    <form method="post"  enctype="multipart/form-data" id="my_data_all">
                    @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row row-space-12" style="background:#f6f6ff;padding-top:1%;padding-bottom:1%">
                                    <div class="col-xs-4">
                                        <select class="form-control" id="tahun">
                                            @for($x=2020;$x<=date('Y');$x++)
                                                <option value="{{$x}}" @if($tahun==$x) selected @endif>{{$x}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-xs-6">
                                        <select class="form-control" id="bulan">
                                            <option value="all">Semua Bulan</option>
                                            @for($x=1;$x<=12;$x++)
                                                <option value="{{bulnya($x)}}" @if($bulan==$x) selected @endif >{{bulan(bulnya($x))}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-xs-6">
                                        <select class="form-control" id="wapu">
                                            <option value="1" @if($wapu==1) selected @endif>Wapu</option>
                                            <option value="2" @if($wapu==2) selected @endif>Non Wapu</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-xs-2">
                                        <span class="btn btn-success" onclick="cari()">Cari</span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4" style="background:#f6f6ff;padding-top:1%;padding-bottom:1%">
                                <table width="100%">
                                    <tr>
                                        <td width="30%" style="background:#f6f6ff !important;"><b>PERIODE</b></td>
                                        <td style="background:#f6f6ff !important;"><b>:</b> &nbsp;&nbsp; @if($bulan=='all') @else {{bulan($bulan)}} @endif  {{$tahun}}</td>
                                    </tr>
                                    <tr>
                                        <td style="background:#f6f6ff !important;"><b>TAGIHAN</b></td>
                                        <td style="background:#f6f6ff !important;"><b>:</b> &nbsp;&nbsp; @if($wapu==1) WAPU @else NON WAPU @endif </td>
                                    </tr>
                                    <tr>
                                        <td style="background:#f6f6ff !important;"><b>TOTAL DOKUMEN</b></td>
                                        <td style="background:#f6f6ff !important;"><b>:</b> &nbsp;&nbsp; {{number_format($total,0)}} </td>
                                    </tr>
                                    <tr>
                                        <td style="background:#f6f6ff !important;"><b>NILAI FAKTUR</b></td>
                                        <td style="background:#f6f6ff !important;"><b>:</b> &nbsp;&nbsp; {{number_format($faktur,0)}} </td>
                                    </tr>
                                    <tr>
                                        <td style="background:#f6f6ff !important;"><b>NILAI INVOICE</b></td>
                                        <td style="background:#f6f6ff !important;"><b>:</b> &nbsp;&nbsp; {{number_format($invoice,0)}} </td>
                                    </tr>
                                </table>
                            </div>
                           
                            
                        </div>
                        <table id="data-table-default" style="width:120%" class="table table-striped table-bordered table-td-valign-middle display nowrap">
							<thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Act</th>
                                    <th>LIFNR</th>
                                    <th >NAME</th>
                                    <th >TGL FAKTUR</th>
                                    <th >TGL DITERIMA</th>
                                    <th>No Faktur  PAJAK</th>
                                    <th>No Invoice</th>
                                    <th>Nilai Faktur</th>
                                    <th>Nilai Invoice</th>
                                    <th width="0.2%">Bttd</th>
                                    <th width="0.2%">Status</th>
                                    
                                </tr>
                                
                            </thead>
                                
                        </table>
                    </form>
                    
                    
                    <!-- #modal-without-animation -->
                    <div class="modal" id="modal-cari">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Cari</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select id="parameter" class="form-control">
                                            <option value="LIFNR">Kode Vendor</option>
                                            <option value="Reference">Nomor Faktur</option>
                                            <option value="HeaderText">Nomor Invoice</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kata Kunci</label>
                                        <input type="text" id="kata" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:;" onclick="cari_data()" class="btn btn-primary" >Terapkan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal" id="modal-tampilkan">
                        <div class="modal-dialog" id="modalbesar">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Dokumen</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div id="tampilkanprint">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- #modal-message -->
                    
                    <!-- #modal-alert -->
                    @include('layouts.notif')
                </div>
            </div>
            <!-- end panel -->
            
        </div>
        <!-- end col-6 -->
    </div>
    <!-- end row -->
</div>
@endsection

@push('ajax')
<script>
    $(document).ready(function() {
       
       $('#dataexample').dataTable( {
           "paging":   false,
           "responsive": true,
           "searching": false,
           "ordering": false,
           "info":     false
       } );
    });

    function perbaharui(){
        location.assign("{{url('loket/terima')}}");
    }
    function filter_data(){
        $('#modal-cari').modal('show');
    }
    function cari(){
        var bulan=$('#bulan').val();
        var tahun=$('#tahun').val();
        var wapu=$('#wapu').val();
        location.assign("{{url('web')}}?bulan="+bulan+"&tahun="+tahun+"&wapu="+wapu);
        
    }

    function cetak(a){
        $.ajax({
            type: 'GET',
            url: "{{url('bttd/proses_cetak')}}",
            data: "id="+a,
            success: function(msg){
                $('#modal-cetak').modal('show');
                $('#tampilcetak').html(msg);
                
            }
        }); 
        
    }

    function tampilkan(a){
        
        $.ajax({
            type: 'GET',
            url: "{{url('bttd/proses_cetak')}}",
            data: "id="+a,
            success: function(msg){
                $('#tampilkanprint').html(msg);
                $('#modal-tampilkan').modal('show');
                
            }
        }); 
                    
    }
    function terima_pajak(a){
        
        $.ajax({
            type: 'GET',
            url: "{{url('web/terima_pajak')}}",
            data: "id="+a,
            beforeSend: function() {
                document.getElementById("loadnya").style.width = "100%";
            },
            success: function(msg){
                var table = $('#data-table-default').DataTable();
                table.ajax.reload(function ( json ) {
                    document.getElementById("loadnya").style.width = "0px";
                });
                
                
            }
        }); 
                    
    }

    function simpan(){
        var form=document.getElementById('my_data');
        $.ajax({
                type: 'POST',
                url: "{{url('pengguna/simpan')}}",
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                    document.getElementById("loadnya").style.width = "100%";
                },
                success: function(msg){
                    
                    if(msg=='ok'){
                        location.reload();
                    }else{
                    document.getElementById("loadnya").style.width = "0px";
                        $('#modal-notif').modal('show');
                        $('#notif').html(msg);
                    }
                            
                    
                }
        });
    
    }
    function simpan_revisi(){
        var form=document.getElementById('my_data_all');
        var keterangan=$('#keterangan').val();
        $.ajax({
                type: 'POST',
                url: "{{url('bttd/simpan_revisi')}}?keterangan="+keterangan,
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                    document.getElementById("loadnya").style.width = "100%";
                },
                success: function(msg){
                    
                    if(msg=='ok'){
                        location.reload();
                    }else{
                    document.getElementById("loadnya").style.width = "0px";
                        $('#modal-notif').modal('show');
                        $('#notif').html(msg);
                    }
                            
                    
                }
        });
    
    }
    function simpan_kirim(){
        var form=document.getElementById('my_data_all');
        var r = confirm("Dokumen akan dikirim ke OFFICER");
        if (r == true) {
            $.ajax({
                    type: 'POST',
                    url: "{{url('bttd/simpan_kirim')}}",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function() {
                        document.getElementById("loadnya").style.width = "100%";
                    },
                    success: function(msg){
                        
                        if(msg=='ok'){
                            location.reload();
                        }else{
                        document.getElementById("loadnya").style.width = "0px";
                            $('#modal-notif').modal('show');
                            $('#notif').html(msg);
                        }
                                
                        
                    }
            });
        }
    
    }
      
    function hapus(){
        var form=document.getElementById('my_data_all');
        $.ajax({
                type: 'POST',
                url: "{{url('pengguna/hapus')}}",
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                    document.getElementById("loadnya").style.width = "100%";
                },
                success: function(msg){
                    
                    if(msg=='ok'){
                        location.reload();
                    }else{
                        document.getElementById("loadnya").style.width = "0px";
                        $('#modal-notif').modal('show');
                        $('#notif').html(msg);
                    }
                            
                    
                }
        });
    
    }
</script>

@endpush