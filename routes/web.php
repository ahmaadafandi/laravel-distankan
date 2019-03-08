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

/* Route::get('/', function () {
    return view('welcome');
}); */

// Route Login
Route::get('/', 'AuthController@index');
Route::get('/login', 'AuthController@index')->name('login');
Route::post('/loginPost', 'AuthController@loginPost');

Route::group(['middleware' => ['web', 'auth']], function(){
    Route::get('/logout', 'AuthController@logout');

     // Route Export
     Route::get('/excel_laporan/{id}','KepalaDinasController@export_laporan');

     //Route PDF
     Route::get('/pdf_laporan/{id}',  'KepalaDinasController@PDF_laporan');

     // Route Ubah gambar
     Route::post('/ubahGambar', 'AuthController@ubah_gambar')->name('ubahGambar');
});

//Route User Pegawai
Route::group(['middleware' => ['web', 'auth', 'pegawai']], function() {
    Route::get('/tambahProyek', 'PegawaiController@tambahProyek')->name('pegawai.tambahProyek');
    Route::get('/proyekBerjalan/{id}', 'PegawaiController@proyekBerjalan')->name('pegawai.proyekBerjalan');
    Route::get('/detail_proyek_berjalan/{id}', 'PegawaiController@detail_proyek_berjalan')->name('pegawai.detail_proyek_berjalan');
});

//Route User Kepala Sub Bagian Program
Route::group(['middleware' => ['web', 'auth', 'kepalasubbagianprogram']], function() {
    Route::get('/listProyekKSBP', 'KSBPController@list_proyek_KSBP')->name('KSBP.proyek');
    Route::get('/detail_proyek_KSBP/{id}', 'KSBPController@detail_proyek_KSBP')->name('KSBP.detailProyek');
    Route::get('/laporan', 'KSBPController@laporan')->name('KSBP.laporan');


    // Route pengambilan data
    Route::get('/pilihan', 'KSBPController@pilihan');
});

// Route Kepala Dinas
Route::group(['middleware' => ['web', 'auth', 'kepaladinas']], function() {
    Route::get('/laporan_realisasi_proyek', 'KepalaDinasController@laporan_realisasi_proyek')->name('KD.realisasiProyek');
    Route::get('/detail_proyek_KD/{id}', 'KepalaDinasController@detail_proyek_KD');
    Route::get('/proyek', 'KepalaDinasController@proyek')->name('KD.proyek');
    Route::get('/persetujuan_proyek', 'KepalaDinasController@persetujuan_proyek')->name('KD.persetujuanProyek');
    Route::get('/daftar_pegawai', 'KepalaDinasController@daftar_pegawai')->name('KD.daftarPegawai');
    Route::get('/daftar_user', 'KepalaDinasController@daftar_user')->name('KD.daftarUser');
    Route::get('/laporanKD', 'KepalaDinasController@laporanKD')->name('KD.laporan');
    Route::get('/Log_Aktivitas', 'KepalaDinasController@Log_Aktivitas')->name('KD.logAktivitas');
});

Route::group(['middleware' => ['web', 'auth', 'pegawai']], function() {
    //CRUD kegiatan Proyek
    Route::resource('DataKegiatan', 'CrudKegiatanProyek', [
        'except' => ['create', 'index', 'show']
    ]);
    
    //CRUD Proyek
    Route::resource('Proyek', 'CrudProyek', [
        'except' => ['create', 'index', 'show', 'edit', 'update']
    ]);

    //Route ubah status proyek
    Route::post('/proyekSelesai', 'CrudProyek@proyekSelesai');
});


Route::group(['middleware' => ['web', 'auth', 'kepaladinas']], function() {
    // CRUD USER
    Route::resource('User', 'CrudUser', [
        'except' => ['create','index', 'show']
    ]);

    
    //edit status user
    Route::post('editStatusUser', 'CrudUser@editStatusUser')->name('User.editStatus');


    //Route ubah status proyek
    Route::post('/setujuiProyek', 'CrudProyek@setujuiProyek');
    Route::post('/ditolak', 'CrudProyek@ditolak');

    // Route pengambilan data
    Route::get('/pilihanKD', 'KepalaDinasController@pilihanKD')->name('KD.laporanPilihan');
    Route::get('/getDataKegiatan/{id}', 'CrudKegiatanProyek@getDataKegiatan'); // untuk ajax di show kegiatan
    Route::get('/getDataUser/{id}', 'CrudUser@getDataUser'); // untuk ajax di show kegiatan

});