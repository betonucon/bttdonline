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
                        <button class="btn btn-xs btn-primary" onclick="tambah()"><i class="fa fa-plus"></i> Upload BukPot PPH</button>
                        <button class="btn btn-xs btn-danger" onclick="hapus()"><i class="fa fa-eraser"></i> Hapus</button>
                    </div>
                    <form method="post"  enctype="multipart/form-data" id="my_data_all">
                    @csrf
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="3%">NO</th>
                                    <th width="3%" ></th>
                                    <th>No Invoice </th>
                                    <th width="14%" >Kode Vendor </th>
                                    <th width="13%" >No Faktur Pajak</th>
                                    <th width="15%">Tgl Faktur Pajak</th>
                                    <th width="12%" >Nilai DPP (Rp) </th>
                                    <th width="12%" >Nilai PPH (Rp) </th>
                                    <th width="5%" >Tahun </th>
                                    <!-- <th width="5%" >File</th> -->
                                    <th width="8%" >Status</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $no=>$o)

                                
                                <tr class="odd gradeX">
                                    <td class="ttd">{{($no+1)}}</td>
                                    <td class="ttd">
                                        @if($o['sts']==0)
                                        <input type="checkbox" name="id[]" value="{{$o['id']}}">
                                        @endif
                                    </td>
                                    <td class="ttd">{{$o['HeaderText']}}</td>
                                    <td class="ttd"><b>{{$o['LIFNR']}}</b><br>{{$o['vendor']['name']}}</td>
                                    <td class="ttd">{{$o['Reference']}}</td>
                                    <td class="ttd">{{$o['DateDocno']}}</td>
                                    
                                    <td class="ttd">{{$o['AmountDpp']}}</td>
                                    <td class="ttd">{{$o['AmountPph']}}</td>
                                    <td class="ttd">{{$o['tahun']}}</td>
                                    <!-- <td class="ttd"><span class="btn btn-xs btn-success" onclick="location.assign(`{{$o['file']}}`)" title="File PPN" ><i class="fas fa-clone"></i></td> -->
                                    @if($o['sts']==0)
                                        <td class="ttd"><i>Proses</i></td>
                                    @else
                                        <td class="ttd"><i>Diterima</i></td>
                                    @endif
                                   
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </form>
                    {{ $data->links() }}
                    <!-- #modal-dialog -->
                    <div class="modal fade" id="modal-tambah">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                <form method="post"  style="display: flex;" enctype="multipart/form-data" id="my_data">
                                    @csrf
                                    <div class="col-md-12">
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">File Excel Bukpot PPN </label>
                                                <input type="file" name="file" class="form-control" placeholder="Ketik disini" />
                                            </div>
                                            
                                            <a href="{{url('file_excel/importppn.xlsx')}}"><i class="fa fa-download"></i> Download Format PPN</a>
                                        </fieldset>
                                    </div>
                                    
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                    <a href="javascript:;" class="btn btn-success" onclick="simpan()">Simpan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- #modal-without-animation -->
                    <div class="modal" id="modal-ubah">
                        <div class="modal-dialog" id="modalmedium">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Ubah Data</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <form method="post"  style="display: flex;" enctype="multipart/form-data" id="my_data_ubah">
                                        @csrf
                                        <div id="tampilkan_ubah" style="display: contents;"></div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                    <a href="javascript:;" class="btn btn-success" onclick="simpan_ubah()">Simpan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- #modal-message -->
                    <div class="modal modal-message fade" id="modal-message">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Modal Message Header</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <p>Text in a modal</p>
                                    <p>Do you want to turn on location services so GPS can use your location ?</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                    <a href="javascript:;" class="btn btn-primary">Save Changes</a>
                                </div>
                            </div>
                        </div>
                    </div>
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

    function tambah(){
        $('#modal-tambah').modal('show');
    }

    function ubah(a){
        $.ajax({
            type: 'GET',
            url: "{{url('pengguna/ubah')}}",
            data: "id="+a,
            success: function(msg){
                $('#modal-ubah').modal('show');
                $('#tampilkan_ubah').html(msg);
                
            }
        }); 
        
    }

    function simpan(){
        var form=document.getElementById('my_data');
        $.ajax({
                type: 'POST',
                url: "{{url('ppn/simpan')}}",
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
                url: "{{url('ppn/hapus')}}",
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