<?php

use Illuminate\Support\Facades\Route;
use App\Models\TheLoai;
use App\Models\TinTuc;
use App\Models\User;
use App\Models\Slide;
use App\Models\LoaiTin;
use App\Models\Comment;
use App\Http\Controllers\TheLoaiController;
use App\Http\Controllers\LoaiTinController;
use App\Http\Controllers\TinTucController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AjaxController;


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
// Route::get('view', function () {
//     return view('admin.theloai.list');
// });
// Route::get('thu',function(){
//     $theloai = TheLoai::find(1);
//     foreach($theloai->loaitin as $loaitin){
//         echo $loaitin->Ten."<br>";
//     }
// });

Route::get('admin/dangnhap','App\Http\Controllers\UserController@getDangnhapAdmin');
Route::post('admin/dangnhap','App\Http\Controllers\UserController@postDangnhapAdmin');
Route::get('admin/logout','App\Http\Controllers\UserController@getDangxuatAdmin');

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
    Route::group(['prefix'=>'theloai'],function(){
        Route::get('danhsach','App\Http\Controllers\TheLoaiController@getDanhSach');
        Route::get('them','App\Http\Controllers\TheLoaiController@getThem');
        Route::get('sua/{id}','App\Http\Controllers\TheLoaiController@getSua');
        Route::post('them','App\Http\Controllers\TheLoaiController@postThem');
        Route::post('sua/{id}','App\Http\Controllers\TheLoaiController@postSua');
        Route::get('xoa/{id}','App\Http\Controllers\TheLoaiController@getXoa');
        
    });
    Route::group(['prefix'=>'loaitin'],function(){
        Route::get('danhsach','App\Http\Controllers\LoaiTinController@getDanhSach');
        Route::get('them','App\Http\Controllers\LoaiTinController@getThem');
        Route::get('sua/{id}','App\Http\Controllers\LoaiTinController@getSua');
        Route::post('them','App\Http\Controllers\LoaiTinController@postThem');
        Route::post('sua/{id}','App\Http\Controllers\LoaiTinController@postSua');
        Route::get('xoa/{id}','App\Http\Controllers\LoaiTinController@getXoa');
    });
    Route::group(['prefix'=>'tintuc'],function(){
        Route::get('danhsach','App\Http\Controllers\TinTucController@getDanhSach');
        Route::get('them','App\Http\Controllers\TinTucController@getThem');
        Route::get('sua/{id}','App\Http\Controllers\TinTucController@getSua');
        Route::post('them','App\Http\Controllers\TinTucController@postThem');
        Route::post('sua/{id}','App\Http\Controllers\TinTucController@postSua');
        Route::get('xoa/{id}','App\Http\Controllers\TinTucController@getXoa');
    });
    Route::group(['prefix'=>'comment'],function(){
        Route::get('xoa/{id}/{idTinTuc}','App\Http\Controllers\CommentController@getXoa');
    });
    Route::group(['prefix'=>'slide'],function(){
        Route::get('danhsach','App\Http\Controllers\SlideController@getDanhSach');
        Route::get('them','App\Http\Controllers\SlideController@getThem');
        Route::get('sua/{id}','App\Http\Controllers\SlideController@getSua');
        Route::post('them','App\Http\Controllers\SlideController@postThem');
        Route::post('sua/{id}','App\Http\Controllers\SlideController@postSua');
        Route::get('xoa/{id}','App\Http\Controllers\SlideController@getXoa');
    });
    Route::group(['prefix'=>'user'],function(){
        Route::get('danhsach','App\Http\Controllers\UserController@getDanhSach');
        Route::get('them','App\Http\Controllers\UserController@getThem');
        Route::get('sua/{id}','App\Http\Controllers\UserController@getSua');
        Route::post('them','App\Http\Controllers\UserController@postThem');
        Route::post('sua/{id}','App\Http\Controllers\UserController@postSua');
        Route::get('xoa/{id}','App\Http\Controllers\UserController@getXoa');
    });

    Route::group(['prefix'=>'ajax'],function(){
        Route::get('loaitin/{idTheLoai}','App\Http\Controllers\AjaxController@getLoaiTin');
    });
});

Route::get('trangchu','App\Http\Controllers\PageController@trangchu');

Route::get('lienhe','App\Http\Controllers\PageController@lienhe');

Route::get('loaitin/{id}/{TenKhongDau}.html','App\Http\Controllers\PageController@loaitin');

Route::get('tintuc/{id}/{TieuDeKhongDau}.html','App\Http\Controllers\PageController@tintuc');

Route::get('dangnhap','App\Http\Controllers\PageController@getDangNhap');

Route::post('dangnhap','App\Http\Controllers\PageController@postDangNhap');
Route::get('dangxuat','App\Http\Controllers\PageController@getDangXuat');
Route::post('comment/{id}','App\Http\Controllers\CommentController@postComment');
Route::get('nguoidung','App\Http\Controllers\PageController@getNguoiDung');
Route::post('nguoidung','App\Http\Controllers\PageController@postNguoiDung');

Route::get('dangky','App\Http\Controllers\PageController@getDangKy');
Route::post('dangky','App\Http\Controllers\PageController@postDangKy');
Route::post('timkiem','App\Http\Controllers\PageController@timkiem');