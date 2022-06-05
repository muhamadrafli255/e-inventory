<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContentController;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Content;

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


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => ['guest']], function(){
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'store']);
});
Route::group(['middleware' => ['auth']], function(){
Route::get('/logout', [AuthController::class, 'logout']);
});


/*
|--------------------------------------------------------------------------
| Content Admin Routes
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => ['auth', 'CheckRole:admin']], function(){
    Route::get('/dashboard', [ContentController::class, 'index']);
    Route::get('/barang/tambah', [ContentController::class, 'add']);
    Route::post('/barang/tambah', [ContentController::class, 'store']);
    Route::get('/barang/lihat', [ContentController::class, 'show']);
    Route::get('/barang/edit', [ContentController::class, 'showedit']);
    Route::get('/barang/hapus', [ContentController::class, 'showdelete']);
    Route::delete('/barang/hapus/{goods}', [ContentController::class, 'delete'])->name('delete');
    Route::get('/barang/edit/{goods}', [ContentController::class, 'edit']);
    Route::put('/barang/edit/{goods}', [ContentController::class, 'update']);
    Route::get('/peminjaman/catat', [ContentController::class, 'addloans']);
    Route::post('/peminjaman/catat', [ContentController::class, 'storeloans']);
    Route::get('peminjaman/lihat', [ContentController::class, 'showloans']);
    Route::delete('/peminjaman/hapus/{loans}', [ContentController::class, 'loansdelete'])->name('loansdelete');
    Route::get('/peminjaman/hapus', [ContentController::class, 'showloansdelete']);
    Route::get('/peminjaman/edit', [ContentController::class, 'showloansedit']);
    Route::get('/peminjaman/edit/{loans}', [ContentController::class, 'editloans']);
    Route::put('/peminjaman/edit/{loans}', [ContentController::class, 'updateloans']);
    Route::put('peminjaman/editstatus/{loans}', [ContentController::class, 'updatestatus']);
    Route::get('/user/lihat', [ContentController::class, 'showuser']);
    Route::get('/user/edit', [ContentController::class, 'edituser']);
    Route::get('/user/tambah', [ContentController::class, 'adduser']);
    Route::post('/user/tambah', [ContentController::class, 'adduserstore']);
    Route::get('/user/hapus', [ContentController::class, 'deleteuser']);
    Route::get('/user/edit/{user}', [ContentController::class, 'edituserprogress']);
    Route::put('/user/edit/{user}', [ContentController::class, 'editusersave']);
    Route::delete('/user/hapus/{user}', [ContentController::class, 'userdelete']);
    Route::get('/pengaturanakun', [ContentController::class, 'adminsettings']);
    Route::put('/updateakun/{user}', [ContentController::class, 'updateakun']);
    Route::get('/pengaturanpassword/{user}', [ContentController::class, 'settingspassword']);
    Route::put('/pengaturanpassword/{user}', [ContentController::class, 'updatepassword']);
    Route::get('/downloadexceluser', [ContentController::class, 'exceluser']);
    Route::get('/downloadexcelloans', [ContentController::class, 'excelloans']);
    Route::get('/laporan', [ContentController::class, 'showreport']);
    Route::get('/downloadpdfuser', [ContentController::class, 'downloadpdf']);
    Route::get('/downloadpdfloans', [ContentController::class, 'downloadpdfloans']);
    Route::get('/cari', [ContentController::class, 'search']);
    Route::get('/peminjaman/harian', [ContentController::class, 'loanstoday']);
    Route::get('/peminjaman/dipinjam', [ContentController::class, 'borrowtoday']);
    Route::get('/peminjaman/dikembalikan', [ContentController::class, 'returnedtoday']);
});

/*
|--------------------------------------------------------------------------
| Content User Routes
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => ['auth', 'CheckRole:user']], function(){
    Route::get('/home', [ContentController::class, 'indexuser']);
    Route::get('/semuabarang', [ContentController::class, 'showall']);
    Route::get('/caribarang', [ContentController::class, 'find']);
    Route::get('/sejarahpeminjaman', [ContentController::class, 'history']);
    Route::get('/pengaturan', [ContentController::class, 'settings']);
    Route::post('/userpinjam/{goods}', [ContentController::class, 'loansuser']);
    Route::put('/updateakunuser/{user}', [ContentController::class, 'updateakun']);
    Route::get('/pengaturanpassworduser/{user}', [ContentController::class, 'password']);
    Route::put('/pengaturanpassworduser/{user}', [ContentController::class, 'updatepassword']);
    Route::get('/searchbarang', [ContentController::class, 'searchgoods']);
    Route::get('/peminjaman/user/harian', [ContentController::class, 'userloanstoday']);
    Route::get('/peminjaman/user/dipinjam', [ContentController::class, 'userborrowstoday']);
    Route::get('/peminjaman/user/dikembalikan', [ContentController::class, 'userreturnedtoday']);
});