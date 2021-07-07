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
    <div class="row">
        <!-- begin col-3 -->
        <div class="col-lg-4 col-md-6">
            <div class="widget widget-stats bg-red">
                <div class="stats-icon"><i class="fa fa-clone"></i></div>
                <div class="stats-info">
                    <h4>TOTAL DOKUMEN</h4>
                    {{total_dokumen()}}	
                </div>
                <div class="stats-link">
                    <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-lg-5 col-md-6">
            <div class="widget widget-stats bg-orange">
                <div class="stats-icon"><i class="fa fa-link"></i></div>
                <div class="stats-info">
                    <h4>NPWP</h4>
                    {{npwp()}}	
                </div>
                <div class="stats-link">
                    <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-black-lighter">
                <div class="stats-icon"><i class="fa fa-clock"></i></div>
                <div class="stats-info" id="waktusekarang">
                    
                </div>
                <div class="stats-link">
                    <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
    </div>
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
                    <h4 class="panel-title">Profil</h4>
                </div>
                <div class="panel-body" style="background:#ddfbcd" >
                <form method="post" class="fomrnya"  enctype="multipart/form-data" id="my_data_ubah_vendor">
                    @csrf
                    <div class="col-lg-6">
                        <fieldset>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Vendor </label>
                                <input type="text" disabled  class="form-control" value="[{{Auth::user()['username']}}] {{Auth::user()['name']}}"placeholder="Ketik disini" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">No Telepon/Handphone </label>
                                <input type="text" name="no_tlp" class="form-control" value="{{no_tlp()}}" placeholder="Ketik disini" />
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">NPWP </label>
                                <input type="text" name="npwp" class="form-control"  value="{{npwp()}}" placeholder="Ketik disini" />
                            </div>
                            
                        </fieldset>
                    </div>
                    <div class="col-lg-6">
                        <fieldset>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email </label>
                                <input type="text" name="email" value="{{emailnya()}}" class="form-control" placeholder="Ketik disini" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama PIC (Karyawan yang bertanggung jawab atas tagihan vendor) </label>
                                <input type="text" name="pic" value="{{pic()}}" class="form-control" placeholder="Ketik disini" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Bagian/Jabatan </label>
                                <input type="text" name="jabatan" value="{{jabatan()}}" class="form-control" placeholder="Ketik disini" />
                            </div>
                        </fieldset>
                    </div>
                </form>
                <div class="col-md-12" style="margin-top:2%">
                    <a href="javascript:;" class="btn btn-success" onclick="simpan_ubah_vendor()">Update</a>
                </div>
                </div>
            </div>
            
        </div>
        <div class="col-lg-8">
            <div class="panel panel-inverse" data-sortable-id="ui-modal-notification-2">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon  btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon  btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon  btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon  btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Pengumuman</h4>
                </div>
                <div class="panel-body" >
                <table class="table">
                    <thead>
                        <tr>
                            <th>PENGUMUMAN</th>
                            <th width="5%">FILE</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $no=>$o)
                            <tr>
                                <td style="padding: 3px;"><a href="{{url('_file_pengumuman/'.$o['file'])}}" target="_blank" style="color:#000">{{$o['name']}}</a></td>
                                <td style="padding: 3px;"><a href="{{url('_file_pengumuman/'.$o['file'])}}" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf"></i></a></td>
                            </tr>
                    @endforeach   
                    </tbody>
                </table>
                {{ $data->links() }}



                </div>
            </div>
            <!-- end panel -->
            
        </div>
        <div class="col-lg-4">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="ui-modal-notification-2">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon  btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon  btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon  btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon  btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Notifikasi</h4>
                </div>
                <div class="panel-body" >
                    <div class="note note-warning note-with-right-icon m-b-15">
                        <div class="note-icon"><i class="fa fa-lightbulb"></i></div>
                        <div class="note-content text-right">
                            <h4><b>BTTD Online</b></h4>
                            <p>
                            Kawasan Industri PTKS, Gedung Logistik (Persero Tbk) Blok G1 No. 1, Jalan Australia II No. 1, Warnasari, Citangkil, Warnasari, Kec. Citangkil, Kota Cilegon, Banten 42443
                            </p>
                        </div>
                    </div>
                    
                    
                    <!-- #modal-dialog -->
                    <div class="modal fade" id="modal-tambah">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                <form method="post"  style="display: flex;" enctype="multipart/form-data" id="my_data">
                                    @csrf
                                    <div class="col-md-6">
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Kode Vendor </label>
                                                <input type="text" name="LIFNR" class="form-control" placeholder="Ketik disini" />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Bank</label>
                                                <input type="text" name="bank_key" class="form-control" placeholder="Ketik disini" />
                                            </div>
                                           
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">No Rekening </label>
                                                <input type="text" name="norek" class="form-control" placeholder="Ketik disini" />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Mata Uang </label>
                                                <input type="text" name="matauang" class="form-control" placeholder="Ketik disini" />
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
        
        var refreshwaktu = setInterval(function()
        {
            
            $.ajax({
                type: 'GET',
                url: "{{url('waktu')}}",
                data: "id=id",
                success: function(msg){
                    
                    $("#waktusekarang").html(msg);
                    
                }
            });
        }, 1000);
    });
    
    
</script>

@endpush