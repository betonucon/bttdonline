
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
<div class="modal fade" id="modal-npwp">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">NPWP</h4>
                <button type="button" class="close" >×</button>
            </div>
            <div class="modal-body">
                <form method="post"   enctype="multipart/form-data" id="my_data_npwp">
                    @csrf
                    <fieldset>
                        <div class="form-group">
                            <label for="exampleInputEmail1">NPWP </label>
                            <input type="text" name="npwp" class="form-control" placeholder="Ketik disini" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email </label>
                            <input type="text" name="email" value="{{emailnya()}}" class="form-control" placeholder="Ketik disini" />
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
