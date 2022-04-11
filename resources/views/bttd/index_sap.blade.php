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
					ajax:"{{ url('bttd/get_officer')}}",
					columns: [
						{ data: 'DT_RowIndex', render: function (data, type, row, meta) 
							{
								return data;
							} 
						},
						{ data: 'LIFNR' },
						{ data: 'nama_vendor' },
						{ data: 'Reference' },
						{ data: 'HeaderText' },
						{ data: 'nilai_faktur' },
						{ data: 'nilai_invoice' },
						{ data: 'no_voucher' },
						{ data: 'level_1' },
						{ data: 'level_2' },
						{ data: 'level_3' },
						
					],
					language: {
						paginate: {
							// remove previous & next text from pagination
							previous: '<< previous',
							next: 'Next>>'
						}
					}
				});
				$('#data-table-default thead th:eq(1)').each(function () {
					var title = $(this).text();
					$(this).html(title+' <input type="text" class="col-search-input" style="display:block;border: solid 1px #b9a4a4; padding: 3px; width: 100%;" placeholder="CARI ' + title + '" />');
				});
				$('#data-table-default thead th:eq(2)').each(function () {
					var title = $(this).text();
					$(this).html(title+' <input type="text" class="col-search-input" style="display:block;border: solid 1px #b9a4a4; padding: 3px; width: 100%;" placeholder="CARI ' + title + '" />');
				});
				$('#data-table-default thead th:eq(3)').each(function () {
					var title = $(this).text();
					$(this).html(title+' <input type="text" class="col-search-input" style="display:block;border: solid 1px #b9a4a4; padding: 3px; width: 100%;" placeholder="CARI ' + title + '" />');
				});
				$('#data-table-default thead th:eq(4)').each(function () {
					var title = $(this).text();
					$(this).html(title+' <input type="text" class="col-search-input" style="display:block;border: solid 1px #b9a4a4; padding: 3px; width: 100%;" placeholder="CARI ' + title + '" />');
				});
				$('#data-table-default thead th:eq(5)').each(function () {
					var title = $(this).text();
					$(this).html(title+' <input type="text" class="col-search-input" style="display:block;border: solid 1px #b9a4a4; padding: 3px; width: 100%;" placeholder="CARI ' + title + '" />');
				});
				$('#data-table-default thead th:eq(6)').each(function () {
					var title = $(this).text();
					$(this).html(title+' <input type="text" class="col-search-input" style="display:block;border: solid 1px #b9a4a4; padding: 3px; width: 100%;" placeholder="CARI ' + title + '" />');
				});
				$('#data-table-default thead th:eq(7)').each(function () {
					var title = $(this).text();
					$(this).html(title+' <input type="text" class="col-search-input" style="display:block;border: solid 1px #b9a4a4; padding: 3px; width: 100%;" placeholder="CARI ' + title + '" />');
				});
				
				
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
                        <table id="data-table-default" style="width:150%" class="table table-striped table-bordered table-td-valign-middle display nowrap">
							<thead>
                                <tr>
                                    <th>NO</th>
                                    <th>LIFNR</th>
                                    <th >NAME</th>
                                    <th>No Faktur</th>
                                    <th>No Invoice</th>
                                    <th>Nilai Faktur</th>
                                    <th>Nilai Invoice</th>
                                    <th>Voucher</th>
                                    <th width="0.2%">Lvl 1</th>
                                    <th width="0.2%">Lvl 1</th>
                                    <th width="0.2%">Lvl 1</th>
                                    
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
    function cari_data(){
        var parameter=$('#parameter').val();
        var kata=$('#kata').val();
        if(kata==''){
            alert('Masukan kata kunci')
        }else{
            location.assign("{{url('loket/terima')}}?kata="+kata+"&parameter="+parameter);
        }
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