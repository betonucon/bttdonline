<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/register', 'Auth\LoginController@login');

Route::group(['middleware'    => 'auth'],function(){
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
    Route::get('/waktu', 'HomeController@waktu');
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/vendor', 'VendorController@index');
    Route::get('/vendor/ubah', 'VendorController@ubah');
    Route::get('/vendor/view_data', 'VendorController@view_data');
    Route::post('/vendor/hapus', 'VendorController@hapus');
    Route::post('/vendor/simpan', 'VendorController@simpan');
    Route::post('/vendor/simpan_npwp', 'VendorController@simpan_npwp');
    Route::post('/vendor/simpan_password', 'VendorController@simpan_password');
    Route::post('/vendor/simpan_ubah', 'VendorController@simpan_ubah');
    
});
Route::group(['middleware'    => 'auth'],function(){
    
    Route::get('/bank', 'VendorController@bank');
    Route::get('/bank/ubah', 'VendorController@ubah_bank');
    Route::get('/bank/view_data', 'VendorController@view_data_bank');
    Route::post('/bank/hapus', 'VendorController@hapus_bank');
    Route::post('/bank/simpan', 'VendorController@simpan_bank');
    Route::post('/bank/simpan_ubah', 'VendorController@simpan_ubah_bank');
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/pengguna', 'PenggunaController@index');
    Route::get('/pengguna/ubah', 'PenggunaController@ubah');
    Route::get('/pengguna/view_data', 'PenggunaController@view_data');
    Route::post('/pengguna/hapus', 'PenggunaController@hapus');
    Route::post('/pengguna/simpan', 'PenggunaController@simpan');
    Route::post('/pengguna/simpan_ubah', 'PenggunaController@simpan_ubah');
    
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/tagihan', 'MasterController@index');
    Route::get('/tagihan/ubah', 'MasterController@ubah');
    Route::get('/tagihan/view_data', 'MasterController@view_data');
    Route::post('/tagihan/hapus', 'MasterController@hapus');
    Route::post('/tagihan/simpan', 'MasterController@simpan');
    Route::post('/tagihan/simpan_ubah', 'MasterController@simpan_ubah');
    
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/spt', 'MasterController@index_spt');
    Route::get('/spt/ubah', 'MasterController@ubah_spt');
    Route::get('/spt/view_data', 'MasterController@view_data_spt');
    Route::post('/spt/hapus', 'MasterController@hapus_spt');
    Route::post('/spt/simpan', 'MasterController@simpan_spt');
    Route::post('/spt/simpan_ubah', 'MasterController@simpan_ubah_spt');
    
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/bttd', 'BttdController@index');
    Route::get('/loket', 'BttdController@index_loket');
    Route::get('/officer', 'BttdController@index_officer');
    Route::get('/officer/terima', 'BttdController@index_officer_terima');
    Route::get('/loket/terima', 'BttdController@index_loket_terima');
    Route::get('/bttd_revisi', 'BttdController@index_dikembalikan');
    Route::get('/bttd/baru', 'BttdController@buat');
    Route::get('/bttd/struk', 'BttdController@struk');
    Route::get('/bttd/cari', 'BttdController@index_cari');
    Route::get('/bttd/tagihan', 'BttdController@tagihan');
    Route::get('/bttd/view_traking', 'BttdController@view_traking');
    Route::get('/bttd/ubah', 'BttdController@ubah');
    Route::get('/bttd/print', 'BttdController@print');
    Route::get('/bttd/view_data', 'BttdController@view_data');
    Route::get('/bttd/cetak', 'BttdController@cetak');
    Route::get('/bttd/proses_cetak', 'BttdController@proses_cetak');
    Route::post('/bttd/hapus', 'BttdController@hapus');
    Route::post('/bttd/simpan_revisi', 'BttdController@simpan_revisi');
    Route::post('/bttd/simpan_struk', 'BttdController@simpan_struk');
    Route::post('/bttd/simpan_terima', 'BttdController@simpan_terima');
    Route::post('/bttd/simpan_kirim', 'BttdController@simpan_kirim');
    Route::post('/bttd/simpan', 'BttdController@simpan');
    Route::post('/bttd/simpan_voucher', 'BttdController@simpan_voucher');
    Route::post('/bttd/simpan_ubah', 'BttdController@simpan_ubah');
    Route::post('/bttd/terima_officer', 'BttdController@terima_officer');
    
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/pengumuman', 'InformasiController@index');
    Route::get('/pengumuman/ubah', 'InformasiController@ubah');
    Route::get('/pengumuman/view_data', 'InformasiController@view_data');
    Route::post('/pengumuman/hapus', 'InformasiController@hapus');
    Route::post('/pengumuman/simpan', 'InformasiController@simpan');
    Route::post('/pengumuman/simpan_ubah', 'InformasiController@simpan_ubah');
    
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/pph', 'BukpotController@index');
    Route::get('/pph/vendor', 'BukpotController@index_vendor');
    Route::get('/pph/terima', 'BukpotController@index_terima');
    Route::get('/pph/pengambilan', 'BukpotController@index_pengambilan');
    Route::get('/pph/ubah', 'BukpotController@ubah');
    Route::get('/pph/view_data', 'BukpotController@view_data');
    Route::get('/pph/tampil', 'BukpotController@tampil');
    Route::post('/pph/terima', 'BukpotController@terima');
    Route::post('/pph/hapus', 'BukpotController@hapus');
    Route::post('/pph/cetak', 'BukpotController@cetak');
    Route::post('/pph/simpan', 'BukpotController@simpan');
    Route::post('/pph/penyerahan', 'BukpotController@penyerahan');
    Route::post('/pph/simpan_ubah', 'BukpotController@simpan_ubah');
    
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/ppn', 'BukpotController@index_ppn');
    Route::get('/ppn/vendor', 'BukpotController@index_vendor_ppn');
    Route::get('/ppn/terima', 'BukpotController@index_terima_ppn');
    Route::get('/ppn/pengambilan', 'BukpotController@index_pengambilan_ppn');
    Route::get('/ppn/ubah', 'BukpotController@ubah_ppn');
    Route::get('/ppn/view_data', 'BukpotController@view_data_ppn');
    Route::post('/ppn/hapus', 'BukpotController@hapus_ppn');
    Route::get('/ppn/tampil', 'BukpotController@tampil_ppn');
    Route::post('/ppn/terima', 'BukpotController@terima_ppn');
    Route::post('/ppn/cetak', 'BukpotController@cetak_ppn');
    Route::post('/ppn/simpan', 'BukpotController@simpan_ppn');
    Route::post('/ppn/simpan_ubah', 'BukpotController@simpan_ubah_ppn');
    Route::post('/ppn/penyerahan', 'BukpotController@penyerahan_ppn');
    
});