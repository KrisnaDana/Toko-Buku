<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\publicController;
use App\Http\Controllers\admController;
use App\Http\Controllers\userController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\ImgBookController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BookCategoryDetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourierController;
use App\Http\Middleware\publik;
use App\Http\Middleware\admin;
use App\Http\Middleware\user;

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

Route::view('/a', 'tes');


Route::view('/test', 'adm-layout');

Route::middleware([publik::class])->group(function () {
    Route::get('/', [publicController::class, 'landing'])->name('landing');
    // Route::get('/login', [publicController::class, 'login'])->name('login');
    // Route::post('/login/auth', [publicController::class, 'login_auth'])->name('login-auth');
    // Route::get('/register', [publicController::class, 'register'])->name('register');
    // Route::post('/register/submit', [publicController::class, 'register_submit'])->name('register-submit');

    Route::get('/adm/login', [admController::class, 'login'])->name('adm-login');
    Route::post('/adm/login/auth', [admController::class, 'login_auth'])->name('adm-login-auth');
    Route::get('/adm/register', [admController::class, 'register'])->name('adm-register');
    Route::post('/adm/register/submit', [admController::class, 'register_submit'])->name('adm-register-submit');
});

Route::middleware([user::class])->group(function () {
    // Route::get('/beranda', [userController::class, 'beranda'])->name('beranda');
    Route::get('/user/beranda', [HomeController::class, 'index'])->name('user-beranda');
    
    Route::get('/user/beranda-buku/{id}/', [HomeController::class, 'index2'])->name('user-beranda-user');
    
    Route::get('/logout', [userController::class, 'logout'])->name('logout');

    Route::get('/profil', [userController::class, 'profil'])->name('profil');
    Route::post('/profil/{id}/submit', [userController::class, 'profil_submit'])->name('profil-submit');

    Route::get('/detailbuku/{id}', [userController::class, 'detailbuku'])->name('detailbuku');

    Route::post('/review/submit/{id}', [userController::class, 'review_submit'])->name('review-submit');

    Route::get('/keranjang', [userController::class, 'keranjang'])->name('keranjang');
    Route::post('/keranjang/tambah/{id}', [userController::class, 'keranjang_tambah'])->name('keranjang-tambah');
    Route::get('/keranjang/hapus/{id}', [userController::class, 'keranjang_hapus'])->name('keranjang-hapus');
    Route::post('/keranjang/alamat', [userController::class, 'keranjang_alamat'])->name('keranjang-alamat');
    Route::post('/keranjang/checkout', [userController::class, 'keranjang_checkout'])->name('keranjang-checkout');
    Route::post('/keranjang/bayar', [userController::class, 'keranjang_bayar'])->name('keranjang-bayar');

    Route::post('/beli/alamat/{id}', [userController::class, 'beli_alamat'])->name('beli-alamat');
    Route::post('/beli/checkout/{id}/{jumlah}', [userController::class, 'beli_checkout'])->name('beli-checkout');
    Route::post('/beli/bayar/{id}/{jumlah}', [userController::class, 'beli_bayar'])->name('beli-bayar');

    Route::get('/transaksi', [userController::class, 'transaksi'])->name('transaksi');
    Route::get('/transaksi/detail/{id}', [userController::class, 'transaksi_detail'])->name('transaksi-detail');
    Route::post('/transaksi/bukti/{id}', [userController::class, 'transaksi_bukti'])->name('transaksi-bukti');
    Route::post('/transaksi/batal/{id}', [userController::class, 'transaksi_batal'])->name('transaksi-batal');
    Route::get('/notifikasi/all', [userController::class, 'userNotifAll'])->name('user.notification-all');
    //Route::get('/view/notifikasi/all',[userController::class,'userNotifViewAll'])->name('user.notification-view-all');
    Route::get('user/{id}', [userController::class, 'userNotif'])->name('user.notification');
});

Route::middleware([admin::class])->group(function () {
    Route::get('/adm/beranda', [admController::class, 'beranda'])->name('adm-beranda');
    Route::get('/adm/logout', [admController::class, 'logout'])->name('adm-logout');

    Route::get('/adm/analytics', [admController::class, 'grafik'])->name('adm-grafik');
    Route::get('/adm/profil', [admController::class, 'profil'])->name('adm-profil');
    Route::post('/adm/profil/{id}/submit', [admController::class, 'profil_submit'])->name('adm-profil-submit');
    Route::get('/adm/pesan', [admController::class, 'adm_pesan'])->name('adm-pesan');

    Route::get('/adm/detailbuku/{id}', [admController::class, 'detailbuku'])->name('adm-detailbuku');

    Route::post('/adm/response/submit/{id}', [admController::class, 'response_submit'])->name('adm-response-submit');
    Route::get('/adm/response/submit2', [admController::class, 'response_submit_notif'])->name('adm-response-submit-notif');
    Route::get('/adm/transaksi', [admController::class, 'transaksi'])->name('adm-transaksi');
    Route::get('/adm/transaksi-detail{id}/', [admController::class, 'transaksi_detail'])->name('adm-transaksi-detail');
    Route::post('/adm/transaksi/status/{id}', [admController::class, 'transaksi_status'])->name('adm-transaksi-status');
    Route::get('/adm/transaksi-bukti{id}/', [admController::class, 'transaksi_bukti'])->name('adm-transaksi-bukti');

    Route::get('/adm/buku', [BukuController::class, 'buku'])->name('adm-buku');
    Route::get('/adm/addBuku', [BukuController::class, 'add_buku'])->name('adm-buku-add');
    Route::post('/adm/saveBuku', [BukuController::class, 'save_buku'])->name('adm-buku-save');
    Route::get('/adm/editBuku{id}/', [BukuController::class, 'edit_buku'])->name('adm-buku-edit');
    Route::post('/adm/saveEditBuku/{id}', [BukuController::class, 'save_edit_buku'])->name('adm-buku-save-edit');
    Route::post('/adm/deleteBuku/{id}', [BukuController::class, 'delete_buku'])->name('adm-buku-delete');

    Route::get('/adm/Diskon', [DiskonController::class, 'diskon'])->name('adm-diskon');
    Route::get('/adm/addDiskon', [DiskonController::class, 'add_diskon'])->name('adm-diskon-add');
    Route::post('/adm/saveDiskon', [DiskonController::class, 'save_diskon'])->name('adm-diskon-save');
    Route::get('/adm/editDiskon{id}/', [DiskonController::class, 'edit_diskon'])->name('adm-diskon-edit');
    Route::post('/adm/saveEditDiskon/{id}', [DiskonController::class, 'save_edit_diskon'])->name('adm-diskon-save-edit');
    Route::post('/adm/deleteDiskon/{id}', [DiskonController::class, 'delete_diskon'])->name('adm-diskon-delete');

    Route::get('/adm/BookImg', [ImgBookController::class, 'img_book'])->name('adm-img-book');
    Route::get('/adm/addBookImg', [ImgBookController::class, 'add_img_book'])->name('adm-img-book-add');
    Route::post('/adm/saveBookImg', [ImgBookController::class, 'save_img_book'])->name('adm-img-book-save');
    Route::get('/adm/editBookImg{id}/', [ImgBookController::class, 'edit_img_book'])->name('adm-img-book-edit');
    Route::post('/adm/saveEditBookImg/{id}', [ImgBookController::class, 'save_edit_img_book'])->name('adm-img-book-save-edit');
    Route::post('/adm/deleteBookImg/{id}', [ImgBookController::class, 'delete_book_img'])->name('adm-img-book-delete');

    Route::get('/adm/BookCategory', [BookCategoryController::class, 'book_category'])->name('adm-book-category');
    Route::get('/adm/addBookCategory', [BookCategoryController::class, 'add_book_category'])->name('adm-book-category-add');
    Route::post('/adm/saveBookCategory', [BookCategoryController::class, 'save_book_category'])->name('adm-book-category-save');
    Route::get('/adm/editBookCategory{id}/', [BookCategoryController::class, 'edit_book_category'])->name('adm-book-category-edit');
    Route::post('/adm/saveEditBookCategory/{id}', [BookCategoryController::class, 'save_edit_book_category'])->name('adm-book-category-save-edit');
    Route::post('/adm/deleteBookCategory/{id}', [BookCategoryController::class, 'delete_book_category'])->name('adm-book-category-delete');

    Route::get('/adm/BookCategoryDetail', [BookCategoryDetailController::class, 'book_category_detail'])->name('adm-img-book-category-detail');
    Route::get('/adm/addBookCategoryDetail', [BookCategoryDetailController::class, 'add_book_category_detail'])->name('adm-img-book-category-detail-add');
    Route::post('/adm/saveBookCategoryDetail', [BookCategoryDetailController::class, 'save_book_category_detail'])->name('adm-img-book-category-detail-save');
    Route::get('/adm/editBookCategoryDetail{id}/', [BookCategoryDetailController::class, 'edit_book_category_detail'])->name('adm-img-book-category-detail-edit');
    Route::post('/adm/saveEditBookCategoryDetail/{id}', [BookCategoryDetailController::class, 'save_edit_book_category_detail'])->name('adm-img-book-category-detail-save-edit');
    Route::post('/adm/deleteBookCategoryDetail/{id}', [BookCategoryDetailController::class, 'delete_book_category_detail'])->name('adm-img-book-category-detail-delete');

    Route::get('/adm/Courier', [CourierController::class, 'Courier'])->name('adm-courier');
    Route::get('/adm/addCourier', [CourierController::class, 'add_Courier'])->name('adm-courier-add');
    Route::post('/adm/saveCourier', [CourierController::class, 'save_Courier'])->name('adm-courier-save');
    Route::get('/adm/editCourier{id}/', [CourierController::class, 'edit_Courier'])->name('adm-courier-edit');
    Route::post('/adm/saveEditCourier/{id}', [CourierController::class, 'save_edit_Courier'])->name('adm-courier-save-edit');
    Route::post('/adm/deleteCourier/{id}', [CourierController::class, 'delete_Courier'])->name('adm-courier-delete');

    Route::get('/admin/{id}/', [admController::class, 'adminNotif'])->name('admin.notification');
});

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
