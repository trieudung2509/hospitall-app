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
// use App\Mail\SupportMailManager;
//demo

Route::post('/aiz-uploader', 'AizUploadController@show_uploader');
Route::post('/aiz-uploader/upload', 'AizUploadController@upload');
Route::get('/aiz-uploader/get_uploaded_files', 'AizUploadController@get_uploaded_files');
Route::post('/aiz-uploader/get_file_by_ids', 'AizUploadController@get_preview_files');
Route::get('/aiz-uploader/download/{id}', 'AizUploadController@attachment_download')->name('download_attachment');
Route::post('/language', 'LanguageController@changeLanguage')->name('language.change');
Route::post('/currency', 'CurrencyController@changeCurrency')->name('currency.change');
//payhere below

// home page
Route::get('/', 'HomeController@home_page')->name('home');







Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

// Admin Login Routes
Route::get('/admin/login', 'Auth\LoginController@showAdminLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\LoginController@login');

Auth::routes(['verify' => true]);
Route::get('/refresh-csrf', function() {
  return csrf_token();
});

//mobile app balnk page for webview
Route::get('/mobile-page/{slug}', 'PageController@mobile_custom_page')->name('mobile.custom-pages');

// Collection outfits page
Route::get('/collections/{slug}', 'HomeController@collection_outfits')->name('collections.show');

//Outfit detail page
Route::get('/outfits/{slug}', 'HomeController@outfit_detail')->name('outfits.detail');
Route::post('/outfits/{id}/like', 'HomeController@outfit_like')->name('outfits.like');
Route::post('/outfits/{id}/save', 'HomeController@outfit_save')->name('outfits.save');

// Search outfits page
Route::get('/search', 'HomeController@search')->name('frontend.search');

// Trending outfits page
Route::get('/trending', 'HomeController@trending_outfits')->name('frontend.trending');

// Chatbot messages endpoint
Route::post('/chatbot', 'ChatbotController@chat')->name('chatbot.chat');

// Reels
Route::get('/reels', 'HomeController@reels_index')->name('frontend.reels.index');
Route::get('/reels/{id}', 'HomeController@reel_detail')->name('frontend.reels.show');
Route::post('/reels/{id}/like', 'HomeController@reel_like')->name('reels.like');
Route::post('/reels/{id}/save', 'HomeController@reel_save')->name('reels.save');
Route::post('/reels/{id}/view', 'HomeController@reel_view')->name('reels.view');

// Static Pages
Route::get('/about', 'HomeController@about_page')->name('about');
Route::get('/privacy-policy', 'HomeController@privacy_page')->name('privacy');
Route::get('/affiliate-program', 'HomeController@affiliate_page')->name('affiliate');

//Custom page
Route::get('/{slug}', 'PageController@show_custom_page')->name('custom-pages.show_custom_page');
