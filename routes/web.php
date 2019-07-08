<?php
use App\Cabang;

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

Route::get('/', function(){
    $cabang = Cabang::with('user')->get();
    return view('welcome', compact('cabang'));
});

Auth::routes();


Route::post('/cek_resi', 'BerandaController@cekResi')->name('cek.resi');
Route::post('/cek_tarif', 'BerandaController@cekTarif')->name('cek.tarif');
Route::get('/json/kecamatan', 'BerandaController@jsonKecamatan')->name('json.kecamatan');

Route::group(['middleware' => 'App\Http\Middleware\DirekturMiddleware'], function (){
    Route::get('direktur', 'HomeController@direktur')->name('direktur');

    Route::group(['prefix' => 'direktur', 'as' => 'direktur.'], function(){
        Route::get('profil/{id}', 'HomeController@profilDirektur')->name('profil');
        Route::get('detail/pengiriman', 'HomeController@direkturDetailPengiriman')->name('detail.pengiriman');
        Route::get('detail/penerimaan', 'HomeController@direkturDetailPenerimaan')->name('detail.penerimaan');

        Route::put('users/{id}', 'DirekturUsersController@update')->name('users.update'); // ubah profil direktur
            
        Route::resource('cabang', 'DirekturCabangController');
        Route::get('cabang/status/{id}', 'DirekturCabangController@status')->name('cabang.status');

        Route::get('laporan/statistik_pengiriman', 'DirekturLaporanController@statistikPengiriman')->name('laporan.statistik.pengiriman');
        Route::get('laporan/statistik_penerimaan', 'DirekturLaporanController@statistikPenerimaan')->name('laporan.statistik.penerimaan');
        Route::get('laporan/akhir', 'DirekturLaporanController@laporanAkhir')->name('laporan.akhir');
        Route::post('laporan/akhir', 'DirekturLaporanController@createLaporanAkhir')->name('laporan.akhir.create');

        Route::get('/api/datatable/users', 'DirekturUsersController@dataTable')->name('api.datatable.users');
        Route::get('/api/datatable/cabang', 'DirekturCabangController@dataTable')->name('api.datatable.cabang');
        Route::get('/api/datatable/pengiriman', 'CabangPengirimanController@dataTable')->name('api.datatable.pengiriman');
        Route::get('/api/datatable/penerimaan', 'CabangPengirimanController@dataTablePenerimaan')->name('api.datatable.penerimaan');
    });
});

Route::group(['middleware' => 'App\Http\Middleware\CabangMiddleware'], function (){
    Route::get('cabang', 'HomeController@cabang')->name('cabang');

    Route::group(['prefix' => 'cabang', 'as' => 'cabang.'], function(){
        Route::get('profil/{id}', 'HomeController@profilCabang')->name('profil');
        Route::get('detail/pengiriman', 'HomeController@CabangDetailPengiriman')->name('detail.pengiriman');
        Route::get('detail/penerimaan', 'HomeController@CabangDetailPenerimaan')->name('detail.penerimaan');

        Route::put('users/{id}', 'CabangUsersController@update')->name('users.update'); // ubah profil cabang

        Route::resource('kurir', 'CabangKurirController');
        Route::resource('ongkir', 'CabangOngkirController');
        Route::resource('surat', 'CabangSuratController');
        Route::resource('pengiriman', 'CabangPengirimanController');
        Route::get('pelanggan', 'CabangPelangganController@index')->name('pelanggan.index');
        Route::get('pelanggan/{id}', 'CabangPelangganController@show')->name('pelanggan.show');
        Route::get('pembayaran', 'CabangPembayaranController@index')->name('pembayaran.index');
        Route::put('pembayaran/{id}', 'CabangPembayaranController@update')->name('pembayaran.update');
        Route::get('pembayaran/{id}', 'CabangPembayaranController@createPembayaran')->name('pembayaran.create');
        Route::post('pengiriman/status', 'CabangPengirimanController@storeStatus')->name('pengiriman.status.store');
        Route::get('pengiriman/status/{id}', 'CabangPengirimanController@createStatus')->name('pengiriman.status.create');
        Route::get('surat/cetak/{id}', 'CabangSuratController@cetak')->name('surat.cetak');
        Route::get('surat/perbarui/{id}', 'CabangSuratController@perbarui')->name('surat.perbarui');
        Route::get('surat/status/{id}', 'CabangSuratController@status')->name('surat.status');
        Route::get('json/perbarui_status_barang', 'CabangPengirimanController@createStatusBarang');
        Route::post('perbarui/status_barang', 'CabangPengirimanController@storeStatusBarang')->name('perbarui.status.barang');
        
        
        Route::get('/api/surat/create', 'CabangSuratController@createSurat')->name('api.create.surat');
        Route::get('/api/datatable/kurir', 'CabangKurirController@dataTable')->name('api.datatable.kurir');
        Route::get('/api/datatable/ongkir', 'CabangOngkirController@dataTable')->name('api.datatable.ongkir');
        Route::get('/json-ongkir/{id}', 'CabangOngkirController@ongkir');
        Route::get('/json/kecamatan/{id}', 'CabangOngkirController@kecamatan');
        Route::get('/json/no_resi', 'CabangSuratController@noResi');
        Route::get('/api/datatable/surat', 'CabangSuratController@dataTable')->name('api.datatable.surat');
        Route::get('/api/datatable/pengiriman', 'CabangPengirimanController@dataTable')->name('api.datatable.pengiriman');
        Route::get('/api/datatable/penerimaan', 'CabangPengirimanController@dataTablePenerimaan')->name('api.datatable.penerimaan');
        Route::get('/api/datatable/pelanggan', 'CabangPelangganController@dataTable')->name('api.datatable.pelanggan');
        Route::get('/api/datatable/pembayaran', 'CabangPembayaranController@dataTable')->name('api.datatable.pembayaran');
    });
});

Route::group(['middleware' => 'App\Http\Middleware\KurirMiddleware'], function(){
    Route::get('kurir', 'HomeController@kurir')->name('kurir');

    Route::group(['prefix' => 'kurir', 'as' => 'kurir.'], function(){
        Route::get('profil/{id}', 'HomeController@profilKurir')->name('profil');
        Route::get('detail/pengiriman', 'HomeController@kurirDetailPengiriman')->name('detail.pengiriman');
        Route::get('detail/penerimaan', 'HomeController@kurirDetailPenerimaan')->name('detail.penerimaan');

        Route::put('users/{id}', 'KurirUsersController@update')->name('users.update'); // ubah profil pelanggan

        Route::get('status_pengiriman', 'KurirStatusPengirimanController@index')->name('status_pengiriman.index');
        Route::post('status_pengiriman', 'KurirStatusPengirimanController@store')->name('status_pengiriman.store');
        
        Route::get('json/perbarui_status_barang', 'KurirStatusPengirimanController@createStatusBarang');
        Route::get('/api/datatable/status_pengiriman', 'KurirStatusPengirimanController@dataTable')->name('api.datatable.status_pengiriman');
        Route::get('/api/datatable/pengiriman', 'CabangPengirimanController@dataTable')->name('api.datatable.pengiriman');
        Route::get('/api/datatable/penerimaan', 'CabangPengirimanController@dataTablePenerimaan')->name('api.datatable.penerimaan');
    });
});

Route::group(['middleware' => 'App\Http\Middleware\PelangganMiddleware'], function(){
    Route::get('pelanggan', 'HomeController@pelanggan')->name('pelanggan');

    Route::group(['prefix' => 'pelanggan', 'as' => 'pelanggan.'], function(){
        Route::get('profil/{id}', 'HomeController@profilPelanggan')->name('profil');
        Route::get('detail/pengiriman', 'HomeController@pelangganDetailPengiriman')->name('detail.pengiriman');
        Route::get('detail/penerimaan', 'HomeController@pelangganDetailPenerimaan')->name('detail.penerimaan');

        Route::put('users/{id}', 'PelangganUsersController@update')->name('users.update'); // ubah profil pelanggan

        Route::get('pengiriman', 'PelangganPengirimanController@index')->name('pengiriman.index');
        Route::get('pengiriman/create', 'PelangganPengirimanController@create')->name('pengiriman.create');
        Route::post('pengiriman', 'PelangganPengirimanController@store')->name('pengiriman.store');
        Route::post('pengiriman/konfirmasi', 'PelangganPengirimanController@storeKonfirmasi')->name('pengiriman.konfirmasi.store');
        Route::get('pengiriman/konfirmasi/{id}', 'PelangganPengirimanController@createKonfirmasi')->name('pengiriman.konfirmasi.create');

        Route::get('/json-ongkir/{id}', 'CabangOngkirController@ongkir');

        Route::get('/json/kecamatan/{id}', 'PelangganPengirimanController@kecamatan');
        Route::get('/api/datatable/pengiriman', 'PelangganPengirimanController@dataTable')->name('api.datatable.pengiriman');
        Route::get('/api/datatable/penerimaan', 'PelangganPengirimanController@dataTablePenerimaan')->name('api.datatable.penerimaan');

    });
});



