<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ContactFormController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/tests/test', [TestController::class, 'index']);


require __DIR__.'/auth.php';

// Route::resource('contacts', ContactFormController::class);


Route::prefix('contacts') // 頭に contacts をつける
    ->middleware(['auth']) // 認証
    ->name('contacts.') // ルート名
    ->controller(ContactFormController::class) // コントローラ指定(laravel9から)
    ->group(function(){ // グループ化
    Route::get('/', 'index')->name('index'); // 名前つきルート
    Route::get('/create', 'create')->name('create');
});
