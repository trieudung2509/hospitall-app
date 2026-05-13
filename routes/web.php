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

// contact 
Route::get('/contact', 'ContactController@contact_page')->name('contact_page');
Route::post('/save-contact', 'ContactController@save_subscriber')->name('contact.save');


// about us page
Route::get('/about-us', 'AboutUsController@about_page')->name('about_page');

// news
Route::get('/category/{slug}', 'NewController@news_page')->name('news_page');
Route::get('/ajax_category/{slug}', 'NewController@ajax_new_post')->name('ajax_new_page');
Route::get('/news/{slug}`', 'NewController@detail_page')->name('detail_page');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
//Blog Section
Route::get('/blog', 'BlogController@all_blog')->name('blog');
Route::get('/blog/{slug}', 'BlogController@blog_details')->name('blog.details');

Auth::routes(['verify' => true]);
Route::get('/refresh-csrf', function() {
  return csrf_token();
});

//mobile app balnk page for webview
Route::get('/mobile-page/{slug}', 'PageController@mobile_custom_page')->name('mobile.custom-pages');

//Custom page
Route::get('/{slug}', 'PageController@show_custom_page')->name('custom-pages.show_custom_page');
