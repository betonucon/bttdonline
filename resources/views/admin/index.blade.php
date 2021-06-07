@extends('layouts.app_web')

@section('content')
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">UI Elements</a></li>
        <li class="breadcrumb-item active">Modal & Notification</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Modal & Notification <small>header small text goes here...</small></h1>
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
                    <h4 class="panel-title">Modal</h4>
                </div>
                <div class="panel-body">
                    <div class="btn-group" style="margin-bottom:10px;">
                        <button class="btn btn-xs btn-primary" onclick="tambah()"><i class="fa fa-plus"></i> Tambah</button>
                        <button class="btn btn-xs btn-success"onclick="cetak()"><i class="fa fa-print"></i> Cetak</button>
                        <button class="btn btn-xs btn-danger" onclick="hapus()"><i class="fa fa-eraser"></i> Hapus</button>
                    </div>
                    <div id="tampilkan" ></div>


                    <!-- #modal-dialog -->
                    <div class="modal fade" id="modal-tambah">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Modal Dialog</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                <form method="post"   enctype="multipart/form-data" id="my_data">
                                    @csrf
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" />
                                            </div>
                                            <div class="checkbox checkbox-css m-b-20">
                                                <input type="checkbox" id="nf_checkbox_css_1" />
                                                <label for="nf_checkbox_css_1">Check me out</label>
                                            </div>
                                        </fieldset>
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
                    <div class="modal" id="modal-without-animation">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Modal Without Animation</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    Modal body content here...
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
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
                    <div class="modal fade" id="modal-notif">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Alert Header</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="swal-icon swal-icon--error">
                                        <div class="swal-icon--error__x-mark">
                                            <span class="swal-icon--error__line swal-icon--error__line--left"></span>
                                            <span class="swal-icon--error__line swal-icon--error__line--right"></span>
                                        </div>
                                    </div>
                                    <div id="notif">
                                        
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
         $.ajax({
            type: 'GET',
            url: "{{url('admin/view_data')}}",
            data: "id=1",
            beforeSend: function(){
                $("#tampilkan").html('<center><i class="fa fa-refresh fa-spin"></i> Proses Data.............</center>');
            },
            success: function(msg){
                $("#tampilkan").html(msg);
                
            }
        }); 
      });

      function tambah(){
          $('#modal-tambah').modal('show');
      }

      function simpan(){
          var form=document.getElementById('my_data');
            $.ajax({
                  type: 'POST',
                  url: "{{url('admin/simpan')}}",
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