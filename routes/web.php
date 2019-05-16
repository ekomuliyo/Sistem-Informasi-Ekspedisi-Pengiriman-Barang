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

Route::get('/', function(){
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' => 'App\Http\Middleware\DirekturMiddleware'], function (){
    Route::get('direktur', 'HomeController@direktur')->name('direktur');

    Route::group(['prefix' => 'direktur', 'as' => 'direktur.'], function(){
        Route::get('profil/{id}', 'HomeController@profilDirektur')->name('profil');

        Route::put('users/{id}', 'DirekturUsersController@update')->name('users.update'); // ubah profil direktur
            
        Route::resource('cabang', 'DirekturCabangController');
        Route::get('cabang/status/{id}', 'DirekturCabangController@status')->name('cabang.status');

        Route::get('/api/datatable/users', 'DirekturUsersController@dataTable')->name('api.datatable.users');
        Route::get('/api/datatable/cabang', 'DirekturCabangController@dataTable')->name('api.datatable.cabang');
    });
});

Route::group(['middleware' => 'App\Http\Middleware\CabangMiddleware'], function (){
    Route::get('cabang', 'HomeController@cabang')->name('cabang');

    Route::group(['prefix' => 'cabang', 'as' => 'cabang.'], function(){
        Route::get('profil/{id}', 'HomeController@profilCabang')->name('profil');

        Route::put('users/{id}', 'CabangUsersController@update')->name('users.update'); // ubah profil cabang

        Route::resource('kurir', 'CabangKurirController');
        Route::resource('ongkir', 'CabangOngkirController');
        Route::resource('surat', 'CabangSuratController');
        Route::resource('pengiriman', 'CabangPengirimanController');

        Route::get('/api/datatable/kurir', 'CabangKurirController@dataTable')->name('api.datatable.kurir');
        Route::get('/api/datatable/ongkir', 'CabangOngkirController@dataTable')->name('api.datatable.ongkir');
        Route::get('/api/datatable/surat', 'CabangSuratController@dataTable')->name('api.datatable.surat');
        Route::get('/api/datatable/pengiriman', 'CabangPengirimanController@dataTable')->name('api.datatable.pengiriman');

    });
});

Route::group(['middleware' => 'App\Http\Middleware\PelangganMiddleware'], function(){
    Route::get('pelanggan', 'HomeController@pelanggan')->name('pelanggan');

    Route::group(['prefix' => 'pelanggan', 'as' => 'pelanggan.'], function(){
        Route::get('profil/{id}', 'HomeController@profilPelanggan')->name('profil');

        Route::put('users/{id}', 'PelangganUsersController@update')->name('users.update'); // ubah profil pelanggan

    });
});


