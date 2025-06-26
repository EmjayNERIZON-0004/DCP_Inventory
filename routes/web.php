<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\SchoolDetailsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/test', function () {
    return view('test.test');
});
Route::get('/', function () {
    return view('login');
})->name('login');


Route::get('/logout', [LoginController::class,'logout'] )->name('logout');

Route::post('login-submit',[LoginController::class,'login'])->name('submit-login');

Route::middleware('auth:school')->group(function () {
    Route::get('/dashboard', function () {
        return view('SchoolSide.dashboard');
    })->name('dashboard');
});

Route::get('Admin/DCP-Dashboard',function(){
    return view('AdminSide.dashboard');
})->name('AdminSide-Dashboard');

Route::get('Schools-index',[SchoolDetailsController::class,'index'])->name('index.schools');
Route::post('Submit-New-School',[SchoolDetailsController::class,'store'])->name('store.schools');