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
                        <button class="btn btn-xs btn-success" onclick="simpan_kirim()"><i class="fa fa-check"></i> Kirim Dokumen</button>
                        <button class="btn btn-xs btn-primary" onclick="revisi()"><i class="fa fa-arrow-left"></i> Revisi</button>
                    </div>
                    <div class="alert alert-success fade show m-b-0" style="background:#e0dea5;margin-bottom:1% !important">
                        <span class="close" data-dismiss="alert">×</span>
                        <strong>Perhatian</strong><br>
                        - Jika isi BTTD tidak sesuai dengan isi dokumen fisik, silahkan ceklis data BTTD yang akan direvisi dan klik tombol revisi.<br>
                        - Jika isi BTTD sesuai dengan isi dokumen fisik, silahkan ceklis data BTTD yang akan sesuai dan klik tombol terima.
                    </div>
                    <form method="post"  enctype="multipart/form-data" id="my_data_all">
                    @csrf
                        <table id="example" class="table table-striped table-bordered">
                        
                            <thead>
                                <tr>
                                    <th width="3%">NO</th>
                                    <th width="2%" ></th>
                                    <th >Vendor</th>
                                    <th class="text-nowrap" width="10%" >No Faktur </th>
                                    <th class="text-nowrap" width="10%" >Nilai Faktur </th>
                                    <th class="text-nowrap" width="10%" >No Invoice </th>
                                    <th class="text-nowrap" width="10%" >Nilai Invoice </th>
                                    <th class="text-nowrap" width="15%" >Tanggal </th>
                                    <th class="text-nowrap" width="9%" ></th>
                                    <th class="text-nowrap" width="4%" ></th>
                                    <th class="text-nowrap" width="4%" ></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $no=>$o)

                                
                                <tr class="odd gradeX">
                                    <td class="ttd">{{($no+1)}}</td>
                                    <td class="ttd" style="text-align: center;background: #f0f5d8 !important;">
                                        <input type="checkbox" name="id[]" value="{{$o['id']}}">
                                    </td>
                                    <td class="ttd"><b>{{$o['LIFNR']}}</b><br>{{$o['vendor']['name']}}</td>
                                    <td class="ttd">{{$o['Reference']}}</td>
                                    <td class="ttd">{{uang($o['AmountInvoice'])}}</td>
                                    <td class="ttd">{{$o['HeaderText']}}</td>
                                    <td class="ttd">{{uang($o['Amount'])}}</td>
                                    <td class="ttd"><b>Dibuat :</b> {{tgl($o['InvoiceDate'])}}<br><b>Diterima : </b>{{tgl($o['diterima'])}}</td>
                                    <td class="ttd" style="background:{{$o['rolenya']['warna']}} !important;text-align:center">
                                       <b><i>{{$o['rolenya']['name']}}</i></b>
                                    </td>
                                    <td class="ttd">
                                        <a href="{{url('_file_tagihan/'.$o['file'])}}" target="_blank" title="file tagihan"><span class="btn btn-xs btn-warning" ><i class="fa fa-clone"></i></span></a>
                                        
                                    </td>
                                    <td class="ttd">
                                        <span class="btn btn-xs btn-white " onclick="cetak({{$o['id']}})"><i class="fa fa-file-pdf"></i></span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </form>
                    {{ $data->links() }}
                    
                    <!-- #modal-without-animation -->
                    <div class="modal" id="modal-cetak">
                        <div class="modal-dialog" id="modalbesar">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Cetak</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div id="tampilcetak"></div>
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
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
        
    });

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

    function ubah(a,b){
        location.assign("{{url('bttd/ubah')}}?kategori="+b+"&id="+a);
        
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