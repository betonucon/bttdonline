
<div class="modal fade" id="modal-lihat-file">
    <div class="modal-dialog" id="modalbesar">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">View File Tagihan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="lihat-file"></div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-chat">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Live Chat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="isi-chat"></div>
                
            </div>
            <div class="modal-footer">
                <div class="form-group" style="width: 100%;">
                    <div class="input-group">
                        <input type="text" id="pesan" class="form-control" value="" placeholder="Ketik pesan.....">
                        <span class="input-group-append">
                            <input type="hidden" id="to">
                            <span class="btn btn-primary" onclick="kirim_chat()">Kirim</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-password">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Password</h4>
                <button type="button" class="close" >×</button>
            </div>
            <div class="modal-body">
                <form method="post"   enctype="multipart/form-data" id="my_data_password">
                    @csrf
                    <fieldset>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password Baru </label>
                            <input type="password" name="password" class="form-control" placeholder="*********************" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Konfirmasi Password </label>
                            <input type="password" name="konfirmasi_password"  class="form-control" placeholder="*********************" />
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <span class="btn btn-primary" onclick="simpan_password()">Simpan</span>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-poling">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kepuasan Pelayanan</h4>
                <button type="button" class="close" >×</button>
            </div>
            <div class="modal-body">
                
                    <fieldset>
                        <div class="form-group" style="text-align:center">
                            <h3>Pilih Poling Kepuasan Pengguna</h3>
                            <span class="btn btn-primary btn-sm" onclick="pilih_poling(1)">Sangat Puas</span>
                            <span class="btn btn-success btn-sm" onclick="pilih_poling(2)">Puas</span>
                            <span class="btn btn-danger btn-sm" onclick="pilih_poling(3)">Tidak Puas</span>
                        </div>
                        
                    </fieldset>
                
            </div>
            <div class="modal-footer">
                &nbsp;
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-npwp">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lengkapi Data</h4>
                <button type="button" class="close" >×</button>
            </div>
            <div class="modal-body">
                <form method="post"   enctype="multipart/form-data" id="my_data_npwp">
                    @csrf
                    <fieldset>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No Telepon/Handphone </label>
                            <input type="text" name="no_tlp" class="form-control" placeholder="Ketik disini" />
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">NPWP </label>
                            <input type="text" name="npwp" class="form-control" placeholder="Ketik disini" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email </label>
                            <input type="text" name="email" value="{{emailnya()}}" class="form-control" placeholder="Ketik disini" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama PIC (Karyawan yang bertanggung jawab atas tagihan vendor) </label>
                            <input type="text" name="pic" class="form-control" placeholder="Ketik disini" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Bagian/Jabatan </label>
                            <input type="text" name="jabatan" class="form-control" placeholder="Ketik disini" />
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <span class="btn btn-primary" onclick="simpan_npwp()">Simpan</span>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-notif">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Notifikasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="swal-icon swal-icon--error">
                    <div class="swal-icon--error__x-mark">
                        <span class="swal-icon--error__line swal-icon--error__line--left"></span>
                        <span class="swal-icon--error__line swal-icon--error__line--right"></span>
                    </div>
                </div>
                <div id="notif" style="text-align:center">
                    
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
            </div>
        </div>
    </div>
</div>
