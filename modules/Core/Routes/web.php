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

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => config('core.admin_prefix', 'admin'),
    'middleware' => 'auth',
    'as'         => 'admin.'
], function($router) {
    $router->get('/', 'AdminController@dashboard')->name('dashboard');
    $router->get('/account/logout', 'AdminController@logout')->name('logout');

    $router->prefix('settings')->as('settings.')->group(function($router) {
        $router->get('general', 'SettingController@general')->name('general');
        $router->get('email', 'SettingController@email')->name('email');

        $router->post('backend', 'SettingController@updateBackend')->name('backend.post');
        $router->post('analytics', 'SettingController@updateAnalytics')->name('analytics.post');
        $router->post('maintenance', 'SettingController@updateMaintenance')->name('maintenance.post');
        $router->post('email', 'SettingController@updateEmail')->name('email.post');
        $router->post('ajax/email-template', 'SettingController@getEmailTemplate')->name('email.template');
    });

    $router->prefix('system')->as('system.')->group(function($router) {
        $router->get('information', 'SystemController@information')->name('information');
        $router->get('activities', 'SystemController@activities')->name('activities');
        $router->post('activities/delete', 'SystemController@deleteActivity')->name('activities.delete');
    });
});

Route::group([
    'prefix' => 'ajax',
    'middleware' => 'auth',
    'as' => 'admin.ajax.'
], function($router) {
    $router->post('clear-cache', 'AjaxController@clearCache')->name('clear-cache');

    $router->prefix('email-template')->as('email-template.')->group(function($router) {
        $router->post('preview', 'AjaxController@previewEmailTemplate')->name('preview');
        $router->post('update', 'AjaxController@updateEmailTemplate')->name('update');
    });
});

Route::group([
    'prefix'     => config('core.admin_prefix', 'admin'),
    'middleware' => 'guest',
    'as'         => 'admin.'
], function($router) {
    $router->prefix('auth')->as('auth.')->group(function($router) {
        $router->get('login', 'AuthController@login')->name('login');
        $router->get('forgot-password', 'AuthController@forgot')->name('forgot');
        $router->get('reset-password/{token}', 'AuthController@reset')->name('reset');

        $router->post('login', 'AuthController@postLogin')->name('login.post');
        $router->post('forgot', 'AuthController@postForgot')->name('forgot.post');
        $router->post('reset-password/{token}', 'AuthController@postReset')->name('reset.post');
    });
});

// Route::get('email-template', function() {
//     return view('core::email_templates.reset_password', [
//         'subject' => 'Demo'
//     ]);
// });
