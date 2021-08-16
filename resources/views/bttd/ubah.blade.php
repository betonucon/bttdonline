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
                    
                    <form method="post" action="{{url('bttd/simpan_ubah')}}" style="display:flex" enctype="multipart/form-data" id="my_data">
                        @csrf
                            <input type="hidden" name="id" value="{{$data['id']}}">
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
                                                    <select class="form-control" name="kategori" onchange="kategori(this.value)">
                                                        <option value="1">Faktur</option>
                                                        <option value="2">Non Faktur</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Tanggal Faktur Pajak</label>
                                                    <div class="input-group" >
                                                        <input type="text" name="InvoiceDate" value="{{date('d-m-Y',strtotime($data['InvoiceDate']))}}"  id="mulai" class="form-control" value="" placeholder="yyyy-mm-dd">
                                                        <span class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No Faktur Pajak</label>
                                                    <input type="text"  name="Reference" id="Reference" value="{{$data['Reference']}}" class="form-control"  placeholder="Ketik disini" />
                                                    <small class="f-s-12 text-grey-darker">Format Nomor Faktur Pajak Tanpa Menggunakan Titik</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nilai Faktur Pajak (PPN 10%)	</label><br>
                                                    <select name="DocCurrency" onchange="cari_matauang(this.value)" style="display:inline;width:20%" class="form-control" >
                                                        <option value="">Pilih-----</option>
                                                        @foreach(matauang() as $mata)
                                                            <option value="{{$mata['name']}}"  @if($data['DocCurrency']==$mata['name']) selected @endif>{{$mata['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="text" name="AmountInvoice" value="{{$data['Amount']}}" onkeyup="cek_amountinvoicenilai(this.value)" onkeypress="return hanyaAngka(event)" style="display:inline;width:36%" class="form-control" placeholder="Ketik disini" />
                                                    <input type="text"  disabled  style="display:inline;width:36%" id="AmountInvoicenilai" value="{{number_format($data['Amount'],0)}}" class="form-control" placeholder="Ketik disini" />
                                                    
                                                    <small class="f-s-12 text-grey-darker">Format Nilai Invoice Tanpa Menggunakan Titik Kecuali Mata Uang Asing</small>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No Rekening</label><br>
                                                    <select name="PartBank" style="display:inline;width:30%" class="form-control" >
                                                        @foreach(rekening_vendor() as $rekven)
                                                            <option value="{{$rekven['norek']}}" @if($data['PartBank']==$rekven['norek']) selected @endif >{{$rekven['norek']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="text" name="nama_bank" value="{{$data['nama_bank']}}"  style="display:inline;width:68%" class="form-control" placeholder="Nama BANK" />
                                                    <small class="f-s-12 text-grey-darker">Nama Bank sesuai nomor rekening</small>
                                                </div>
                                                
                                                
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset>
                                                
                                                
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No. Kwitansi / Memo Dinas</label>
                                                    <input type="text"  name="HeaderText" value="{{$data['HeaderText']}}"  class="form-control"  placeholder="Ketik disini" />
                                                    <small class="f-s-12 text-grey-darker">Nomor Kwitansi / Memo Dinas ditulis tanpa spasi</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nomor : PO/Kontrak/Ket.Pembayaran</label>
                                                    <input type="text"  name="PurchaseOrder"  value="{{$data['PurchaseOrder']}}"  class="form-control"  placeholder="Ketik disini" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nilai Invoice  / Memo Dinas</label><br>
                                                    <input type="text" id="matauanginvoice" value="{{$data['DocCurrency']}}" disabled style="display:inline;width:15%" class="form-control" >
                                                    <input type="text" name="Amount" value="{{$data['AmountInvoice']}}" onkeyup="cek_amountnilai(this.value)" onkeypress="return hanyaAngka(event)" style="display:inline;width:43%" class="form-control" placeholder="Ketik disini" />
                                                    <input type="text"  disabled  value="{{number_format($data['AmountInvoice'],0)}}" style="display:inline;width:40%" id="Amountnilai" class="form-control" placeholder="Ketik disini" />
                                                    <small class="f-s-12 text-grey-darker">Format Nilai Invoice Tanpa Menggunakan Titik Kecuali Mata Uang Asing</small>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email / Telp / Fax Vendor </label>
                                                    <input type="text" name="email" value="{{$data['email']}}"  class="form-control" placeholder="Ketik disini" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Tagihan</label><br>
                                                    <select name="tagihan_id" onchange="tampilkan_tagihan(this.value)" class="form-control" >
                                                        <option value="">Pilih Tagihan---------</option>
                                                        @foreach(tagihan() as $tag)
                                                            <option value="{{$tag['id']}}"  @if($data['tagihan_id']==$tag['id']) selected @endif>{{$tag['name']}}</option>
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
                                                    <select class="form-control" name="kategori" onchange="kategori(this.value)">
                                                        <option value="2">Non Faktur</option>
                                                        <option value="1">Faktur</option>
                                                        
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Tanggal Invoice</label>
                                                    <div class="input-group" >
                                                        <input type="text" name="InvoiceDate" value="{{date('d-m-Y',strtotime($data['InvoiceDate']))}}" value="{{$data['']}}" id="mulai" class="form-control" value="" placeholder="yyyy-mm-dd">
                                                        <span class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No. Kwitansi / Memo Dinas</label>
                                                    <input type="text"  name="HeaderText" value="{{$data['HeaderText']}}" onkeyup="tampilkan_Reference(this.value)" class="form-control"  placeholder="Ketik disini" />
                                                    <small class="f-s-12 text-grey-darker">Nomor Kwitansi / Memo Dinas ditulis tanpa spasi</small>
                                                    <input type="hidden"  name="Reference" value="{{$data['Reference']}}"id="Reference" class="form-control"  placeholder="Ketik disini" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nomor : PO/Kontrak/Ket.Pembayaran</label>
                                                    <input type="text"  name="PurchaseOrder"  value="{{$data['PurchaseOrder']}}"  class="form-control"  placeholder="Ketik disini" />
                                                </div>
                                                
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No Rekening</label><br>
                                                    <select name="PartBank" style="display:inline;width:30%" class="form-control" >
                                                        @foreach(rekening_vendor() as $rekven)
                                                            <option value="{{$rekven['norek']}}" @if($data['PartBank']==$rekven['norek']) selected @endif>[{{$rekven['bank_key']}}] {{$rekven['norek']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="text" name="nama_bank" value="{{$data['Reference']}}"  style="display:inline;width:68%" class="form-control" placeholder="Nama BANK" />
                                                    <small class="f-s-12 text-grey-darker">Format Nilai Invoice Tanpa Menggunakan Titik Kecuali Mata Uang Asing</small>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nilai Invoice  / Memo Dinas</label><br>
                                                    <select name="DocCurrency" style="display:inline;width:18%" class="form-control" >
                                                        <option value="">Pilih-----</option>
                                                        @foreach(matauang() as $mata)
                                                            <option value="{{$mata['name']}}"  @if($data['DocCurrency']==$mata['name']) selected @endif>{{$mata['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="text" name="Amount" onkeyup="cek_amountnilai(this.value)" value="{{$data['AmountInvoice']}}" onkeyup="tampilkan_Amount(this.value)" onkeypress="return hanyaAngka(event)" style="display:inline;width:43%" class="form-control" placeholder="Ketik disini" />
                                                    <input type="hidden" name="AmountInvoice" value="{{$data['AmountInvoice']}}" id="Amount" onkeypress="return hanyaAngka(event)" style="display:inline;width:40%" class="form-control" placeholder="Ketik disini" />
                                                    <input type="text"  disabled  style="display:inline;width:36%" id="Amountnilai" class="form-control" value="{{uang($data['AmountInvoice'])}}" placeholder="Ketik disini" />
                                                    
                                                    <small class="f-s-12 text-grey-darker">Format Nilai Invoice Tanpa Menggunakan Titik Kecuali Mata Uang Asing</small>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email / Telp / Fax Vendor </label>
                                                    <input type="text" name="email" value="{{$data['email']}}" class="form-control" placeholder="Ketik disini" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Tagihan</label><br>
                                                    <select name="tagihan_id" onchange="tampilkan_tagihan(this.value)" class="form-control" >
                                                        <option value="">Pilih Tagihan---------</option>
                                                        @foreach(tagihan() as $tag)
                                                            <option value="{{$tag['id']}}"  @if($data['tagihan_id']==$tag['id']) selected @endif>{{$tag['name']}}</option>
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
                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                                    <a href="javascript:;" class="btn btn-success" onclick="simpan_ubah()">Simpan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- #modal-message -->
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
    function tambah(){
        $('#modal-tambah').modal('show');
    }
    $('#mulai').datepicker({
        format: 'dd-mm-yyyy'
    });
    $('#sampai').datepicker({
        format: 'dd-mm-yyyy'
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
    function kategori(a){
        if(a==1){
            location.assign("{{url('bttd/baru')}}?kategori=faktur");
        }
        if(a==2){
            location.assign("{{url('bttd/baru')}}?kategori=nonfaktur");
        }
    }
    function simpan_struk(){
        var form=document.getElementById('my_data_struk');
        var Reference=$('#Reference').val();
        $.ajax({
                type: 'POST',
                url: "{{url('bttd/simpan_struk')}}?Reference="+Reference+"&act=ubah",
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
                    }else{
                        document.getElementById("loadnya").style.width = "0px";
                        $('#modal-notif').modal('show');
                        $('#notif').html(msg);
                    }
                            
                    
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
                url: "{{url('bttd/simpan_ubah')}}",
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