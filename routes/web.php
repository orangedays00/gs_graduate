<?php

use App\Member;
use App\Post;
use Illuminate\Http\Request;

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

// Route::get('/', function () {
//     return view('welcome');
// })->name('top');

// 完成後は以下
// Route::get('/', function(){
//          return view('top');
// });


/*
|--------------------------------------------------------------------------
| ログイン処理
|--------------------------------------------------------------------------
 */
// 管理者のみから登録できるようにするためにコメントアウト。
// Auth::routes();

// 上記を分解
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
 
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/password/change', 'Auth\ChangePasswordController@showChangePasswordForm')->name('password.form')->middleware('auth');;
Route::post('/password/change', 'Auth\ChangePasswordController@ChangePassword')->name('password.change')->middleware('auth');;

/*
|-------------------------------------------------------------------------
| 管理者以上で操作
|-------------------------------------------------------------------------
 */
Route::group(['middleware' => ['auth', 'can:admin']], function () {
  //ユーザー登録
  Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
  Route::post('register', 'Auth\RegisterController@register');
});

Route::get('/admin', 'UserController@index')->name('admin')->middleware('auth');
Route::post('/admin/{id}', 'UserController@destroy')->name('admin.delete')->middleware('auth');

/*
|-------------------------------------------------------------------------
| TOP（非ログイン）
|-------------------------------------------------------------------------
 */

Route::get('/', 'MembersController@judge')->name('non.login');

// Route::get('/', function (){
//        if (Auth::check()) {
//   // ログイン済みのときの処理
//   return Route::get('/member', 'MembersController@index')->name('top');
// } else {
// // ログインしていないときの処理
//   return view('welcome');
// } 
// });


/*
|-------------------------------------------------------------------------
| メンバー一覧
|-------------------------------------------------------------------------
 */
Route::get('/member', 'MembersController@index')->name('top')->middleware('auth');

Route::get('/member/{profile_id}', 'MembersController@profileDetail')->name('profile')->middleware('auth');

// Route::get('/member/{profile_id}/form', 'MembersController@profileCommentForm')->name('profile.comment')->middleware('auth');

// Route::post('/member/{profile_id}/form', 'MembersController@profileComment')->name('profile.comment')->middleware('auth');

Route::post('/member/{profile_id}/review', 'MembersController@review')->name('profile.review')->middleware('auth');


/*
|-------------------------------------------------------------------------
| マイページ
|-------------------------------------------------------------------------
 */


Route::prefix('mypage')
     ->namespace('MyPage')
     ->middleware('auth')
     ->group(function () {
         Route::get('edit-profile', 'ProfileController@showProfileEditForm')->name('mypage.edit-profile');
         Route::post('edit-profile', 'ProfileController@editProfile')->name('mypage.edit-profile');
     });

/*
|-------------------------------------------------------------------------
| 掲示板
|-------------------------------------------------------------------------
 */
 
Route::get('/posts', 'PostsController@index')->name('posts.index')->middleware('auth');
Route::get('/posts/create', 'PostsController@create')->name('posts.create')->middleware('auth');
Route::post('/posts', 'PostsController@store')->name('posts.store')->middleware('auth');
Route::get('/posts/{id}', 'PostsController@show')->name('posts.show')->middleware('auth');
Route::get('/posts/{id}/edit', 'PostsController@edit')->name('posts.edit')->middleware('auth');
Route::post('/posts/{id}', 'PostsController@update')->name('posts.update')->middleware('auth');
Route::post('/posts/{id}/delete', 'PostsController@destroy')->name('posts.destroy')->middleware('auth');

Route::post('/comments', 'CommentsController@store')->name('comments.store')->middleware('auth');

// Route::resource('comments', 'CommentsController', ['only' => ['store']]);

// Route::prefix('posts')
//          ->namespace('Posts')
//          ->middleware('auth')
//          ->group(function () {
//          Route::get('/posts', 'PostsController@index')->name('posts.index');      
// });

Route::get('/home', 'HomeController@index')->name('home');
