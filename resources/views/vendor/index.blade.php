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
                        <!-- <button class="btn btn-xs btn-primary" onclick="tambah()"><i class="fa fa-plus"></i> Tambah</button>
                        <button class="btn btn-xs btn-success"onclick="cetak()"><i class="fa fa-print"></i> Cetak</button>
                        <button class="btn btn-xs btn-danger" onclick="hapus()"><i class="fa fa-eraser"></i> Hapus</button> -->
                        <div class="input-group m-b-10">
                            <input type="text" class="form-control" id="textname">
                            <div class="input-group-append"><span class="input-group-text" onclick="cari_data()"><i class="fa fa-search"></i> Cari</span></div>
                        </div>
                    </div>
                    <table id="myTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="3%">NO</th>
                                <th width="3%" ></th>
                                <th width="12%" >Kode Vendor</th>
                                <th>Nama</th>
                                <th width="20%" >Email </th>
                                <th width="20%" >NPWP </th>
                                <th width="4%" >Reset</th>
                                <th width="4%" ></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $no=>$o)

                            
                            <tr class="odd gradeX">
                                <td class="ttd">{{($no+1)}}</td>
                                <td class="ttd"><input type="checkbox" name="id[]" value="{{$o['id']}}"></td>
                                <td class="ttd">{{$o['LIFNR']}}</td>
                                <td class="ttd">{{$o['name']}}</td>
                                <td class="ttd">{{$o['email']}}</td>
                                <td class="ttd">{{$o['npwp']}}</td>
                                <td class="ttd">
                                    <span class="btn btn-xs btn-primary" onclick="reset_password(`{{$o['LIFNR']}}`)">Reset</span>
                                </td>
                                <td class="ttd">
                                    <span class="btn btn-xs btn-success" onclick="ubah({{$o['id']}})"><i class="fa fa-edit"></i></span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $data->links() }}
                    <!-- #modal-dialog -->
                    <div class="modal fade" id="modal-tambah">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Modal Dialog</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                <form method="post"  style="display: flex;" enctype="multipart/form-data" id="my_data">
                                    @csrf
                                    <div class="col-md-6">
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">NIK </label>
                                                <input type="text" name="username" class="form-control" placeholder="Ketik disini" />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama </label>
                                                <input type="text" name="name" class="form-control" placeholder="Ketik disini" />
                                            </div>
                                           
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email </label>
                                                <input type="text" name="email" class="form-control" placeholder="Ketik disini" />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Role Akses </label>
                                                <select name="role" class="form-control" placeholder="Ketik disini">
                                                    <option value="">Pilih Role Akses---</option>
                                                    <option value="2">LOKET</option>
                                                    <option value="3">OFFICER</option>
                                                    <option value="4">SPV</option>
                                                    <option value="5">SPT</option>
                                                    <option value="6">MANAGER</option>
                                                </select>
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
    $('#myTable').DataTable( {
			responsive: true,
			paging: false,
			info: false,
			ordering:false,
			searching:false,
			lengthChange: false,
	});

      function tambah(){
          $('#modal-tambah').modal('show');
      }

    function ubah(a){
        $.ajax({
            type: 'GET',
            url: "{{url('vendor/ubah')}}",
            data: "id="+a,
            success: function(msg){
                $('#modal-ubah').modal('show');
                $('#tampilkan_ubah').html(msg);
                
            }
        }); 
        
    }
    function reset_password(a){
        $.ajax({
            type: 'GET',
            url: "{{url('vendor/reset_password')}}",
            data: "username="+a,
            success: function(msg){
               location.reload();
                
            }
        }); 
        
    }

    function cari_data(){
        var name=$('#textname').val();
        location.assign("{{url('vendor')}}?name="+name);
    }

    function simpan_ubah(){
        var form=document.getElementById('my_data_ubah');
        $.ajax({
                type: 'POST',
                url: "{{url('vendor/simpan_ubah')}}",
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