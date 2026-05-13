<?php

/*
  |--------------------------------------------------------------------------
  | Admin Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register admin routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::post('/update', 'UpdateController@step0')->name('update');
Route::get('/update/step1', 'UpdateController@step1')->name('update.step1');
Route::get('/update/step2', 'UpdateController@step2')->name('update.step2');

Route::get('/admin', 'AdminController@admin_dashboard')->name('admin.dashboard')->middleware(['auth', 'admin']);
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    // about us
    Route::get('/about-us', 'AboutUsController@edit')->name('aboutus.edit');
    Route::post('/about-us', 'AboutUsController@update')->name('aboutus.update');

    // contact
    Route::get('/contact', 'ContactController@edit')->name('contact.edit');
    Route::post('/contact', 'ContactController@update')->name('contact.update');

    // slider
    Route::get("/slider-banner", 'SliderBannerController@admin_home')->name('slider.home');
    Route::post("/slider-banner", 'SliderBannerController@slider_update')->name('slider.update');
    //Update Routes

    Route::resource('categories', 'CategoryController');
    Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('categories.edit');
    Route::get('/categories/destroy/{id}', 'CategoryController@destroy')->name('categories.destroy');
    Route::post('/categories/featured', 'CategoryController@updateFeatured')->name('categories.featured');

    Route::resource('brands', 'BrandController');
    Route::get('/brands/edit/{id}', 'BrandController@edit')->name('brands.edit');
    Route::get('/brands/destroy/{id}', 'BrandController@destroy')->name('brands.destroy');

    Route::get('customers_ban/{customer}', 'CustomerController@ban')->name('customers.ban');
    Route::get('/customers/login/{id}', 'CustomerController@login')->name('customers.login');
    Route::get('/customers/destroy/{id}', 'CustomerController@destroy')->name('customers.destroy');
    Route::post('/bulk-customer-delete', 'CustomerController@bulk_customer_delete')->name('bulk-customer-delete');

    Route::get('/newsletter', 'NewsletterController@index')->name('newsletters.index');
    Route::post('/newsletter/send', 'NewsletterController@send')->name('newsletters.send');
    Route::post('/newsletter/test/smtp', 'NewsletterController@testEmail')->name('test.smtp');

    Route::resource('profile', 'ProfileController');
    Route::post('/business-settings/update', 'BusinessSettingsController@update')->name('business_settings.update');
    Route::get('/general-setting', 'BusinessSettingsController@general_setting')->name('general_setting.index');
    Route::get('/smtp-settings', 'BusinessSettingsController@smtp_settings')->name('smtp_settings.index');
    Route::post('/env_key_update', 'BusinessSettingsController@env_key_update')->name('env_key_update.update');
    // website setting
    Route::group(['prefix' => 'website'], function() {
        Route::get('/footer', 'WebsiteController@footer')->name('website.footer');
        Route::get('/header', 'WebsiteController@header')->name('website.header');
        Route::get('/appearance', 'WebsiteController@appearance')->name('website.appearance');
        Route::get('/pages', 'WebsiteController@pages')->name('website.pages');
        Route::resource('custom-pages', 'PageController');
        Route::get('/custom-pages/edit/{id}', 'PageController@edit')->name('custom-pages.edit');
        Route::get('/custom-pages/destroy/{id}', 'PageController@destroy')->name('custom-pages.destroy');
    });

    Route::resource('roles', 'RoleController');
    Route::get('/roles/edit/{id}', 'RoleController@edit')->name('roles.edit');
    Route::get('/roles/destroy/{id}', 'RoleController@destroy')->name('roles.destroy');

    Route::resource('staffs', 'StaffController');
    Route::get('/staffs/destroy/{id}', 'StaffController@destroy')->name('staffs.destroy');

    //Subscribers
    Route::get('/subscribers', 'SubscriberController@index')->name('subscribers.index');
    Route::get('/subscribers/destroy/{id}', 'SubscriberController@destroy')->name('subscriber.destroy');

    //Blog Section
    Route::resource('blog-category', 'BlogCategoryController');
    Route::get('/blog-category/destroy/{id}', 'BlogCategoryController@destroy')->name('blog-category.destroy');
    Route::post('/blog-category/change-status', 'BlogCategoryController@change_status')->name('blog-category.change-status');
    Route::resource('blog', 'BlogController');
    Route::get('/blog/destroy/{id}', 'BlogController@destroy')->name('blog.destroy');
    Route::post('/blog/change-status', 'BlogController@change_status')->name('blog.change-status');
    Route::post('/blog-category/change-home-page-status', 'BlogCategoryController@change_home_page_status')->name('blog-category.change-home-page-status');
    Route::post('/blog-category/change_show_menu_status', 'BlogCategoryController@change_show_menu_status')->name('blog-category.change-show-menu-status');
    

    // Route::resource('pages', 'PageController');
    // Route::get('/pages/destroy/{id}', 'PageController@destroy')->name('pages.destroy');

    Route::view('/system/server-status', 'backend.system.server_status')->name('system_server');

    // uploaded files
    Route::any('/uploaded-files/file-info', 'AizUploadController@file_info')->name('uploaded-files.info');
    Route::resource('/uploaded-files', 'AizUploadController');
    Route::get('/uploaded-files/destroy/{id}', 'AizUploadController@destroy')->name('uploaded-files.destroy');

    Route::post('/save-post-image', 'BlogController@save_blog_image')->name('images.upload');
    Route::get('/all-notification', 'NotificationController@index')->name('admin.all-notification');
});
