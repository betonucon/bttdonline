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
                <div class="panel-body" >
                    
                    <form method="post"  class="fomrnya" enctype="multipart/form-data" id="my_data">
                        @csrf
                            @if($kategori=='faktur')
                                        <div class="col-md-6">
                                            <fieldset>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Vendor </label><br>
                                                    <input type="text" style="display:inline;width:30%" disabled value="{{Auth::user()['username']}}" class="form-control" placeholder="Ketik disini" />
                                                    <input type="text" style="display:inline;width:67%"  disabled value="{{Auth::user()['name']}}" class="form-control" placeholder="Ketik disini" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">NPWP</label>
                                                    <input type="text" disabled class="form-control" value="{{npwp()}}" placeholder="Ketik disini" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Kategori </label><br>
                                                    <select class="form-control" name="kategori" onchange="cek_kategori(this.value)">
                                                        <option value="1">Faktur</option>
                                                        <option value="2">Non Faktur</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Tanggal Faktur Pajak</label>
                                                    <div class="input-group" >
                                                        <input type="text" name="InvoiceDate" id="mulai" class="form-control" value="" placeholder="yyyy-mm-dd">
                                                        <span class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No Faktur Pajak</label>
                                                    <input type="text"  onkeypress="return hanyaAngka(event)" name="Reference" class="form-control"  placeholder="Ketik disini" />
                                                    <small class="f-s-12 text-grey-darker">Format Nomor Faktur Pajak Tanpa Menggunakan Titik</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nilai Faktur Pajak (PPn 10%)	</label><br>
                                                    <select name="DocCurrency" onchange="cari_matauang(this.value)" style="display:inline;width:20%" class="form-control" >
                                                        <option value="">Pilih-----</option>
                                                        @foreach(matauang() as $mata)
                                                            <option value="{{$mata['name']}}">{{$mata['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="text" name="AmountInvoice" onkeypress="return hanyaAngka(event)" style="display:inline;width:78%" class="form-control" placeholder="Ketik disini" />
                                                    <small class="f-s-12 text-grey-darker">Format Nilai Invoice Tanpa Menggunakan Titik Kecuali Mata Uang Asing</small>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No Rekening</label><br>
                                                    <select name="PartBank" style="display:inline;width:30%" class="form-control" >
                                                        @foreach(rekening_vendor() as $rekven)
                                                            <option value="{{$rekven['norek']}}">{{$rekven['norek']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="text" name="nama_bank"  style="display:inline;width:68%" class="form-control" placeholder="Nama BANK" />
                                                    <small class="f-s-12 text-grey-darker">Nama Bank sesuai nomor rekening</small>
                                                </div>
                                                
                                                
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset>
                                                
                                                
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No. Kwitansi / Memo Dinas</label>
                                                    <input type="text"  name="HeaderText" class="form-control"  placeholder="Ketik disini" />
                                                    <small class="f-s-12 text-grey-darker">Nomor Kwitansi / Memo Dinas ditulis tanpa spasi</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nomor : PO/Kontrak/Ket.Pembayaran</label>
                                                    <input type="text"  name="PurchaseOrder" class="form-control"  placeholder="Ketik disini" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nilai Invoice  / Memo Dinas</label><br>
                                                    <input type="text" id="matauanginvoice" disabled style="display:inline;width:15%" class="form-control" >
                                                    <input type="text" name="Amount" onkeypress="return hanyaAngka(event)" style="display:inline;width:83%" class="form-control" placeholder="Ketik disini" />
                                                    <small class="f-s-12 text-grey-darker">Format Nilai Invoice Tanpa Menggunakan Titik Kecuali Mata Uang Asing</small>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email / Telp / Fax Vendor </label>
                                                    <input type="text" name="email" class="form-control" placeholder="Ketik disini" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Tagihan</label><br>
                                                    <select name="tagihan_id" id="tagihan_id" onchange="tampilkan_tagihan(this.value)" class="form-control" >
                                                        <option value="">Pilih Tagihan---------</option>
                                                        @foreach(tagihan() as $tag)
                                                            <option value="{{$tag['id']}}">{{$tag['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <small class="f-s-12 text-grey-darker">Pilih Jenis Tagihan</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Dokumen Tagihan </label>
                                                    <input type="file" name="file" class="form-control" placeholder="Ketik disini" />
                                                    <small class="f-s-12 text-grey-darker">Upload file tagihan dalam format .pdf</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Struk Transportir </label>
                                                    <div class="input-prepend input-group">
                                                        <span  onclick="buat_struk()" title="Click here to show/hide password" class="add-on input-group-addon" style="cursor: pointer;">
                                                            <i class="fa fa-calculator"></i>
                                                        </span>
                                                        <input type="text" class="form-control" placeholder="password" >
                                                    </div>
                                                    <small class="f-s-12 text-grey-darker">Klik icon calculator kemudian isi nilai sesuai dokumen</small>
                                                </div>
                                            </fieldset>
                                        </div>
                            @endif

                            @if($kategori=='nonfaktur')
                                        <div class="col-md-6">
                                            <fieldset>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Vendor </label><br>
                                                    <input type="text" style="display:inline;width:30%" disabled value="{{Auth::user()['username']}}" class="form-control" placeholder="Ketik disini" />
                                                    <input type="text" style="display:inline;width:67%"  disabled value="{{Auth::user()['name']}}" class="form-control" placeholder="Ketik disini" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">NPWP</label>
                                                    <input type="text" disabled class="form-control" value="{{npwp()}}" placeholder="Ketik disini" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Kategori </label><br>
                                                    <select class="form-control" name="kategori" onchange="cek_kategori(this.value)">
                                                        <option value="2">Non Faktur</option>
                                                        <option value="1">Faktur</option>
                                                        
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Tanggal Invoice</label>
                                                    <div class="input-group" >
                                                        <input type="text" name="InvoiceDate" id="mulai" class="form-control" value="" placeholder="yyyy-mm-dd">
                                                        <span class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No. Kwitansi / Memo Dinas</label>
                                                    <input type="text"  name="HeaderText" onkeyup="tampilkan_Reference(this.value)" class="form-control"  placeholder="Ketik disini" />
                                                    <small class="f-s-12 text-grey-darker">Nomor Kwitansi / Memo Dinas ditulis tanpa spasi</small>
                                                    <input type="text"  name="Reference" id="Reference" class="form-control"  placeholder="Ketik disini" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nomor : PO/Kontrak/Ket.Pembayaran</label>
                                                    <input type="text"  name="PurchaseOrder" class="form-control"  placeholder="Ketik disini" />
                                                </div>
                                                
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No Rekening</label><br>
                                                    <select name="PartBank" style="display:inline;width:30%" class="form-control" >
                                                        @foreach(rekening_vendor() as $rekven)
                                                            <option value="{{$rekven['norek']}}">{{$rekven['norek']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="text" name="nama_bank"  style="display:inline;width:68%" class="form-control" placeholder="Nama BANK" />
                                                    <small class="f-s-12 text-grey-darker">Nama Bank sesuai nomor rekening</small>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nilai Invoice  / Memo Dinas</label><br>
                                                    <select name="DocCurrency" style="display:inline;width:20%" class="form-control" >
                                                        <option value="">Pilih-----</option>
                                                        @foreach(matauang() as $mata)
                                                            <option value="{{$mata['name']}}">{{$mata['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="text" name="Amount" onkeyup="tampilkan_Amount(this.value)" onkeypress="return hanyaAngka(event)" style="display:inline;width:78%" class="form-control" placeholder="Ketik disini" />
                                                    <input type="hidden" name="AmountInvoice" id="Amount" onkeypress="return hanyaAngka(event)" style="display:inline;width:83%" class="form-control" placeholder="Ketik disini" />
                                                    <small class="f-s-12 text-grey-darker">Format Nilai Invoice Tanpa Menggunakan Titik Kecuali Mata Uang Asing</small>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email / Telp / Fax Vendor </label>
                                                    <input type="text" name="email" class="form-control" placeholder="Ketik disini" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Tagihan</label><br>
                                                    <select name="tagihan_id" id="tagihan_id" onchange="tampilkan_tagihan(this.value)" class="form-control" >
                                                        <option value="">Pilih Tagihan---------</option>
                                                        @foreach(tagihan() as $tag)
                                                            <option value="{{$tag['id']}}">{{$tag['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <small class="f-s-12 text-grey-darker">Pilih Jenis Tagihan</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Dokumen Tagihan </label>
                                                    <input type="file" name="file" class="form-control" placeholder="Ketik disini" />
                                                    <small class="f-s-12 text-grey-darker">Upload file tagihan dalam format .pdf</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Struk Transportir </label>
                                                    <div class="input-prepend input-group">
                                                        <span  onclick="buat_struk()" title="Click here to show/hide password" class="add-on input-group-addon" style="cursor: pointer;">
                                                            <i class="fa fa-calculator"></i>
                                                        </span>
                                                        <input type="text" class="form-control" placeholder="password" >
                                                    </div>
                                                    <small class="f-s-12 text-grey-darker">Klik icon calculator kemudian isi nilai sesuai dokumen</small>
                                                </div>
                                            </fieldset>
                                        </div>
                            @endif
                    </form>
                    <div class="col-md-12">
                        <div id="tampilkantagihan">
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:2%">
                        <a href="javascript:;" class="btn btn-success" onclick="simpan()">Simpan</a>
                    </div>
                    <!-- #modal-dialog -->
                    
                    <!-- #modal-without-animation -->
                    <div class="modal" id="modal-struk">
                        <div class="modal-dialog" id="modalmedium">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">struk Data</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <form method="post"  style="display: flex;" enctype="multipart/form-data" id="my_data_struk">
                                        @csrf
                                        <div id="tampilkan_struk" style="display: contents;"></div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                                    <a href="javascript:;" class="btn btn-success" onclick="simpan_struk()">Simpan</a>
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
                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
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
    $('#mulai').datepicker({
        format: 'yyyy-mm-dd'
    });
    $('#sampai').datepicker({
        format: 'yyyy-mm-dd'
    });
    function cari_matauang(a){
        $('#matauanginvoice').val(a);
    }
    function tampilkan_Reference(a){
        $('#Reference').val(a);
    }
    function tampilkan_Amount(a){
        $('#Amount').val(a);
    }
    function cek_kategori(a){
        if(a==1){
            location.assign("{{url('bttd/baru')}}?kategori=faktur");
        }
        if(a==2){
            location.assign("{{url('bttd/baru')}}?kategori=nonfaktur");
        }
        
    }
    function buat_struk(){
        var tagihan_id=$('#tagihan_id').val();
        $.ajax({
            type: 'GET',
            url: "{{url('bttd/struk')}}",
            data: "tagihan_id="+tagihan_id,
            success: function(msg){
                $('#modal-struk').modal('show');
                $('#tampilkan_struk').html(msg);
                
            }
        }); 
        
    }
    function tampilkan_tagihan(a){
        
        $.ajax({
            type: 'GET',
            url: "{{url('bttd/tagihan')}}",
            data: "id="+a,
            success: function(msg){
                $('#tampilkantagihan').html(msg);
                
            }
        }); 
        
    }

    function simpan(){
        var form=document.getElementById('my_data');
        $.ajax({
                type: 'POST',
                url: "{{url('bttd/simpan')}}",
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                    document.getElementById("loadnya").style.width = "100%";
                },
                success: function(msg){
                    
                    if(msg=='ok'){
                        location.assign("{{url('bttd/')}}");
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
                url: "{{url('bank/simpan_ubah')}}",
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
                url: "{{url('bank/hapus')}}",
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