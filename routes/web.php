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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', 'PagesController@root')->name('root');

Route::get('/', 'TopicsController@index')->name('root');

// 等同
// Auth::routes();

// 用户身份验证相关的路由
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// 用户注册相关路由
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// 密码重置相关路由
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email 认证相关路由
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

// 主页已经有app 不需要
// Route::get('/home', 'HomeController@index')->name('home');


// 注册一个用户  资源路由 严格遵循了 RESTful URI 的规范
Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);

// 帖子 代码生成器做的
Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
// 帖子展示   URI 最后一个参数表达式 {slug?} ，? 意味着参数可选
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');

// 帖子分类
Route::resource('categories', 'CategoriesController', ['only' => ['show']]);


// 发送帖子的时候上传图片
Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');

// 帖子回复
Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);


// 通知列表
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);


// 无权限提醒页面
Route::get('permission-denied', 'PagesController@permissionDenied')->name('permission-denied');
