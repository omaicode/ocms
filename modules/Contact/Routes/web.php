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

use Modules\Contact\Http\Controllers\Admin\ContactController;
use Modules\Contact\Http\Controllers\Guest\ContactController as GuestContactController;

Route::post('guest/contact-submit', [GuestContactController::class, 'store'])->name('contact.submit');
Route::prefix(config('core.admin_prefix', 'admin'))->middleware('auth:admins')->group(function() {
    Route::post('contacts/delete', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');
    Route::get('contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
    
});