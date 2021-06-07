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
                        <button class="btn btn-xs btn-primary" onclick="cetak()"><i class="fa fa-plus"></i> Cetak E-cupon</button>
                    </div>
                    <form method="post"  enctype="multipart/form-data" id="my_data_all">
                    @csrf
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="3%">NO</th>
                                    <th width="3%" ></th>
                                    <th width="12%" >No BukPot</th>
                                    <th>Tgl BukPot</th>
                                    <th width="12%" >No Invoice </th>
                                    <th width="17%" >Vendor </th>
                                    <th width="13%" >No Faktur Pajak</th>
                                    <th width="15%" >Nilai DPP & PPH </th>
                                    <th width="12%" >Keterangan</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $no=>$o)

                                <?php 
                                if($o['cetak']['urut']==''){
                                  $warna='';
                                }else{
                                    $warna='#fff9b0';
                                }
                                ?>
                                <tr class="odd gradeX" >
                                    <td style="background:{{$warna}} !important" class="ttd">{{($no+1)}}</td>
                                    <td style="background:{{$warna}} !important" class="ttd"><input type="checkbox" name="id[]" value="{{$o['id']}}"></td>
                                    <td style="background:{{$warna}} !important" class="ttd">{{$o['Docno']}}</td>
                                    <td style="background:{{$warna}} !important" class="ttd">{{$o['DateDocno']}}</td>
                                    <td style="background:{{$warna}} !important" class="ttd">{{$o['HeaderText']}}</td>
                                    <td style="background:{{$warna}} !important" class="ttd"><b>{{$o['LIFNR']}}</b><br>{{$o['vendor']['name']}}</td>
                                    <td style="background:{{$warna}} !important" class="ttd">{{$o['Reference']}}</td>
                                    <td style="background:{{$warna}} !important" class="ttd"><b>DPP (Rp):</b><br>{{uang($o['AmountDpp'])}}<br><b>PPH (Rp):</b><br>{{uang($o['AmountPph'])}}</td>
                                    <td style="background:{{$warna}} !important" class="ttd"><b>Penerima :</b><br>{{$o['penerima']}}<br><b>Tanggal :</b><br>{{$o['tgl_terima']}}</td>
                                   
                                   
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
                                    <h4 class="modal-title">Terima</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                <form method="post"  style="display: flex;" enctype="multipart/form-data" id="my_data">
                                    @csrf
                                    <div class="col-md-12">
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Penerima</label>
                                                <input type="text" id="penerima" class="form-control" placeholder="Ketik disini" />
                                            </div>
                                            
                                           
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
                        <div class="modal-dialog" id="modalbesar">
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

    function cetak(){
        var form=document.getElementById('my_data_all');
        $.ajax({
                type: 'POST',
                url: "{{url('pph/cetak')}}",
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                    document.getElementById("loadnya").style.width = "100%";
                },
                success: function(msg){
                    if(msg=='ok'){
                        window.open("{{url('pph/tampil')}}", '_blank');
                        
                        location.reload();
                        
                    }else{
                        document.getElementById("loadnya").style.width = "0px";
                        $('#modal-notif').modal('show');
                        $('#notif').html(msg);
                    }
                            
                    
                }
        });
    
    }
    function simpan_ubah(){
        var form=document.getElementById('my_data_ubah');
        $.ajax({
                type: 'POST',
                url: "{{url('pengguna/simpan_ubah')}}",
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
                url: "{{url('pph/hapus')}}",
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