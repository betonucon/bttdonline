@extends('layouts.app_web')

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
                    <div class="btn-group" style="margin-bottom:10px;">
                        <button class="btn btn-xs btn-success" onclick="simpan_terima()"><i class="fa fa-check"></i> Terima Dokumen</button>
                        <!-- <button class="btn btn-xs btn-primary" onclick="revisi()"><i class="fa fa-arrow-left"></i> Revisi</button> -->
                    </div>
                    <div class="alert alert-success fade show m-b-0" style="background:#e0dea5;margin-bottom:1% !important">
                        <span class="close" data-dismiss="alert">×</span>
                        <strong>Perhatian</strong><br>
                        - Klik ceklis pada dokumen yang akan diterima.<br>
                        - Klik Icon Terima.
                    </div>
                    <div style="margin-bottom:10px;width:100%;display: flow-root;">
                        <button class="btn btn-sm btn-primary" style="float:right;" onclick="filter_data()"><i class="fa fa-filter"></i> Cari</button>
                        <button class="btn btn-sm btn-success" style="float:right;margin-right:1%" onclick="perbaharui()"><i class="fa fa-sync-alt"></i> Reload</button>
                    </div>
                    <form method="post"  enctype="multipart/form-data" id="my_data_all">
                    @csrf
                        <table id="dataexample" class="table table-striped table-bordered">
                        
                            <thead>
                                <tr>
                                    <th width="3%">NO</th>
                                    <th width="2%" ><input type="checkbox" onchange="pilihsemua(this)"></th>
                                    <th >Vendor</th>
                                    <th class="text-nowrap" width="10%" >No Faktur </th>
                                    <th class="text-nowrap" width="10%" >Nilai Faktur </th>
                                    <th class="text-nowrap" width="10%" >No Invoice </th>
                                    <th class="text-nowrap" width="10%" >Nilai Invoice </th>
                                    <th class="text-nowrap" width="15%" >Tanggal </th>
                                    <th class="text-nowrap" width="9%" >Status</th>
                                    <th class="text-nowrap" width="4%" >File</th>
                                    <th class="text-nowrap" width="4%" >Bttd</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $no=>$o)

                                
                                <tr class="odd gradeX">
                                    <td class="ttd">{{($no+1)}}</td>
                                    <td class="ttd" style="text-align: center;background: #f0f5d8 !important;">
                                        @if($o['lokasi']==3)
                                        <input type="checkbox" name="id[]" value="{{$o['id']}}">
                                        @endif
                                    </td>
                                    <td class="ttd"><b>{{$o['LIFNR']}}</b><br>{{$o['vendor']['name']}}</td>
                                    <td class="ttd">{{$o['Reference']}}</td>
                                    <td class="ttd">{{uang($o['AmountInvoice'])}}</td>
                                    <td class="ttd">{{$o['HeaderText']}}</td>
                                    <td class="ttd">{{uang($o['Amount'])}}</td>
                                    <td class="ttd"><b>Dibuat :</b> {{tgl($o['InvoiceDate'])}}<br><b>Diterima :</b> {{tgl($o['diterima'])}}</td>
                                    <td class="ttd" style="background:{{$o['rolenya']['warna']}} !important;text-align:center">
                                       <b><i>{{$o['rolenya']['name']}}</i></b>
                                    </td>
                                    <td class="ttds">
                                        <span class="btn btn-xs btn-warning" onclick="lihatfilegd('{{$o['linknya']}}')"><i class="fa fa-clone"></i></span>
                                    </td>
                                    <td class="ttds">
                                        <span class="btn btn-xs btn-success" onclick="tampilkan({{$o['id']}})" ><i class="fa fa-file-pdf"></i></span>
                                    </td>
                                   
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </form>
                    {{ $data->links() }}
                    <!-- #modal-dialog -->
                    
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
        location.assign("{{url('officer')}}");
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
            location.assign("{{url('officer')}}?kata="+kata+"&parameter="+parameter);
        }
            
        
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

    

    
    function simpan_terima(){
        var form=document.getElementById('my_data_all');
        $.ajax({
                type: 'POST',
                url: "{{url('bttd/terima_officer')}}",
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