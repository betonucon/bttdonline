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
                                                        <input type="text" name="InvoiceDate" readonly id="mulai" class="form-control" value="" placeholder="dd-mm-yyyy">
                                                        <span class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No Faktur Pajak</label>
                                                    <input type="text"  maxlength="16" onkeypress="return hanyaAngka(event)" name="Reference" id="Reference" class="form-control"  placeholder="Ketik disini" />
                                                    <small class="f-s-12 text-grey-darker">Format Nomor Faktur Pajak Tanpa Menggunakan Titik</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nilai Faktur Pajak (PPN 10%)	</label><br>
                                                    <select name="DocCurrency" onchange="cari_matauang(this.value)" style="display:inline;width:20%" class="form-control" >
                                                        <option value="IDR">IDR</option>
                                                        @foreach(matauang() as $mata)
                                                            <option value="{{$mata['name']}}">{{$mata['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="text" name="AmountInvoice" onkeypress="return hanyaAngkaTitik(event)" onkeyup="cek_amountinvoicenilai(this.value)" style="display:inline;width:72%" class="form-control" placeholder="Ketik disini" />
                                                    <small class="f-s-12 text-grey-darker">Format Nilai Faktur Pajak hanya Menggunakan Titik dan Angka</small>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No Rekening</label><br>
                                                    <select name="PartBank" onchange="cari_nama_bank(this.value)" style="display:inline;width:40%" class="form-control" >
                                                        @foreach(rekening_vendor() as $rekven)
                                                            <option value="{{$rekven['norek']}}">[{{$rekven['matauang']}}] {{$rekven['norek']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="text" name="nama_bank"  id="nama_bank" style="display:inline;width:58%" value="{{nama_rekening_vendor()}}" class="form-control" placeholder="Nama BANK" />
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
                                                    <input type="text" id="matauanginvoice" value="IDR" disabled style="display:inline;width:15%" class="form-control" >
                                                    <input type="text" name="Amount"  onkeypress="return hanyaAngkaTitik(event)" onkeyup="cek_amountnilai(this.value)" style="display:inline;width:83%" class="form-control" placeholder="Ketik disini" />
                                                    <!-- <input type="text"  disabled  style="display:inline;width:40%" id="Amountnilai" class="form-control" placeholder="Ketik disini" /> -->
                                                    <small class="f-s-12 text-grey-darker">Format Nilai Invoice hanya Menggunakan Titik dan Angka</small>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No Telepon/Handphone Aktif </label>
                                                    <input type="text" name="email" class="form-control" value="{{no_tlp()}}" placeholder="Ketik disini" />
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
                                                    <small class="f-s-12 text-grey-darker">Upload file tagihan dalam format .pdf & Max 500kb</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Buat Struk  </label>
                                                    <div class="input-prepend input-group">
                                                        <span  onclick="buat_struk()" title="Buat Struk" class="add-on input-group-addon" style="cursor: pointer;">
                                                            <i class="fa fa-calculator"></i> Buat Struk
                                                        </span>
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
                                                        <input type="text" readonly name="InvoiceDate" id="mulai" class="form-control" value="" placeholder="dd-mm-yyyy">
                                                        <span class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No. Kwitansi / Memo Dinas</label>
                                                    <input type="text"  name="HeaderText" onkeyup="tampilkan_Reference(this.value)" class="form-control"  placeholder="Ketik disini" />
                                                    <small class="f-s-12 text-grey-darker">Nomor Kwitansi / Memo Dinas ditulis tanpa spasi</small>
                                                    <input type="hidden"  name="Reference" id="Reference" class="form-control"  placeholder="Ketik disini" />
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
                                                    <select name="PartBank" onchange="cari_nama_bank(this.value)" style="display:inline;width:40%" class="form-control" >
                                                        @foreach(rekening_vendor() as $rekven)
                                                            <option value="{{$rekven['norek']}}">[{{$rekven['matauang']}}] {{$rekven['norek']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="text" name="nama_bank" id="nama_bank" value="{{nama_rekening_vendor()}}" style="display:inline;width:58%" class="form-control" placeholder="Nama BANK" />
                                                    <small class="f-s-12 text-grey-darker">Nama Bank sesuai nomor rekening</small>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nilai Invoice  / Memo Dinas</label><br>
                                                    <select name="DocCurrency" style="display:inline;width:20%" class="form-control" >
                                                        <option value="IDR">IDR</option>
                                                        @foreach(matauang() as $mata)
                                                            <option value="{{$mata['name']}}">{{$mata['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="text" name="Amount"  onkeyup="tampilkan_Amount(this.value)" onkeypress="return hanyaAngkaTitik(event)" style="display:inline;width:72%" class="form-control" placeholder="Ketik disini" />
                                                    <input type="hidden" name="AmountInvoice" id="AmountInvoice"  onkeypress="return hanyaAngkaTitik(event)" style="display:inline;width:83%" class="form-control" placeholder="Ketik disini" />
                                                    <!-- <input type="text"  disabled  style="display:inline;width:36%" id="AmountInvoicenilai" class="form-control" placeholder="Ketik disini" /> -->
                                                    <small class="f-s-12 text-grey-darker">Format Nilai Invoice  Menggunakan Titik</small>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No Telepon/Handphone Aktif </label>
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
                                                    <small class="f-s-12 text-grey-darker">Upload file tagihan dalam format .pdf & Max 500kb</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Buat Struk  </label>
                                                    <div class="input-prepend input-group">
                                                        <span  onclick="buat_struk()" title="Buat Struk" class="add-on input-group-addon" style="cursor: pointer;">
                                                            <i class="fa fa-calculator"></i> Buat Struk
                                                        </span>
                                                       
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
                                    <form method="post"  enctype="multipart/form-data" id="my_data_struk">
                                        
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
        format: 'dd-mm-yyyy',
        autoclose: true,
    });
    $('#sampai').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });
    function cari_matauang(a){
        $('#matauanginvoice').val(a);
    }
    function tampilkan_Reference(a){
        $('#Reference').val(a);
    }
    function tampilkan_Amount(a){
        $('#AmountInvoice').val(a);
        $.ajax({
            type: 'GET',
            url: "{{url('bttd/nilai')}}",
            data: "a="+a,
            success: function(msg){
                $('#AmountInvoicenilai').val(msg);
                
            }
        }); 
    }
    function cari_nama_bank(a){
        $.ajax({
            type: 'GET',
            url: "{{url('cari_nama_bank')}}",
            data: "norek="+a,
            success: function(msg){
                $('#nama_bank').val(msg);
                
            }
        }); 
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
        var Reference=$('#Reference').val();
        if(Reference==''){
            alert('Isi Nomor Faktur Atau Invoice');
        }else{
            $.ajax({
                type: 'GET',
                url: "{{url('bttd/struk')}}",
                data: "tagihan_id="+tagihan_id+"&Reference="+Reference,
                success: function(msg){
                    $('#modal-struk').modal('show');
                    $('#tampilkan_struk').html(msg);
                    
                }
            }); 
        }
        
    }
    function cek_amountinvoicenilai(a){
            
            $.ajax({
                type: 'GET',
                url: "{{url('bttd/nilai')}}",
                data: "a="+a,
                success: function(msg){
                    $('#AmountInvoicenilai').val(msg);
                    
                }
            }); 
       
        
    }
    function cek_amountnilai(a){
            
            $.ajax({
                type: 'GET',
                url: "{{url('bttd/nilai')}}",
                data: "a="+a,
                success: function(msg){
                    $('#Amountnilai').val(msg);
                    
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
                        document.getElementById("loadnya").style.width = "0px";
                        $('#modal-poling').modal({backdrop: 'static', keyboard: false});
                    }else{
                        document.getElementById("loadnya").style.width = "0px";
                        $('#modal-notif').modal('show');
                        $('#notif').html(msg);
                    }
                            
                    
                }
        });
    
    }
    function simpan_struk(){
        var form=document.getElementById('my_data_struk');
        var Reference=$('#Reference').val();
        $.ajax({
                type: 'POST',
                url: "{{url('bttd/simpan_struk')}}?Reference="+Reference,
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                    document.getElementById("loadnya").style.width = "100%";
                },
                success: function(msg){
                    
                    if(msg=='ok'){
                        document.getElementById("loadnya").style.width = "0px";
                        $('#modal-struk').modal('hide');
                    }else{
                        document.getElementById("loadnya").style.width = "0px";
                        $('#modal-struk').modal('hide');
                        // $('#modal-notif').modal('show');
                        // $('#notif').html(msg);
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