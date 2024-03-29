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
                    
                    <form method="post"  enctype="multipart/form-data" id="my_data_all">
                    @csrf
                        <table id="example" class="table table-striped table-bordered">
                        
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
                                    <th class="text-nowrap" width="9%" >Voucher</th>
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
                                    <td class="ttd"><b>Dibuat :</b> {{tgl($o['InvoiceDate'])}}<br><b>Diterima :</b> {{tgl(tgl_terima($o['id']))}}</td>
                                    <td class="ttd">
                                       <b>VCR:</b>{{$o['no_voucher']}}<br>
                                       <b>Tempo:</b>{{$o['tempo']}}
                                    </td>
                                    <td class="ttd">
                                    <span class="btn btn-xs btn-warning" onclick="lihatfilegd('{{$o['linknya']}}')"><i class="fa fa-clone"></i></span>
                                    </td>
                                    <td class="ttd">
                                        <span class="btn btn-xs btn-success" onclick="tampilkan({{$o['id']}})" ><i class="fa fa-file-pdf-o"></i></span>
                                    </td>
                                    
                                   
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </form>
                    {{ $data->links() }}
                    <!-- #modal-dialog -->
                    
                    <!-- #modal-without-animation -->
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
                    <div class="modal" id="modal-voucher">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Buat Voucher</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <form method="post"  enctype="multipart/form-data" id="my_data_voucher">
                                        @csrf
                                        <div class="col-md-12">
                                            <input type="text" name="bttd_id" id="bttd_id">
                                            <fieldset>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nomor Voucher </label>
                                                    <input type="text" name="no_voucher" class="form-control" placeholder="Ketik disini" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Jatuh Tempo </label>
                                                    <input type="text" name="tempo" id="datepicker" class="form-control" placeholder="Ketik disini" />
                                                </div>
                                            
                                            </fieldset>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                                    <a href="javascript:;" class="btn btn-success" onclick="simpan_voucher()">Simpan</a>
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
        
    });

    function buat_voucher(a){
        $('#bttd_id').val(a);
        $('#modal-voucher').modal('show');
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

    function ubah(a,b){
        location.assign("{{url('bttd/ubah')}}?kategori="+b+"&id="+a);
        
    }

    
    function simpan_terima(){
        var form=document.getElementById('my_data_voucher');
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
      
    function simpan_voucher(){
        var form=document.getElementById('my_data_voucher');
        $.ajax({
                type: 'POST',
                url: "{{url('bttd/simpan_voucher')}}",
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