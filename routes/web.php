<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//=========================================LOGIN================================================================
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest'); //Halaman hanya bisa diakses oleh guest
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');


//=========================================DASHBOARD================================================================
Route::get('/', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard'); //Halaman hanya bisa diakses oleh user yg login
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth'); //Halaman hanya bisa diakses oleh user yg login
Route::post('/create', [DashboardController::class, 'sameBankTransfers']);

//=========================================PROFILE================================================================
Route::get('/setting', [ProfileController::class, 'index'])->middleware('auth')->name('profile');
Route::post('/setting', [ProfileController::class, 'changePassword'])->middleware('auth');

//AJAX (PENYESUAIAN NAMA DENGAN NOREK PADA FITUR TRANSFER)
Route::post('/ajaxtf', [DashboardController::class, 'ajaxTransfer']);




//=========================================WEB SERVICE================================================================
//TABLE USER
Route::get('/service', [WebServiceController::class, 'index']);
Route::get('/service/updatedata/{id_user}', [WebServiceController::class, 'updateData']);

//TABLE HISTORY
Route::get('/service/history', [WebServiceController::class, 'history'])->name('history');
Route::get('/service/updatehistory/{id_history}', [WebServiceController::class, 'updateHistory']);
Route::post('/service/updatehistory/{id_history}', [WebServiceController::class, 'updateHistory'])->name('updateHistory');

//TABLE BALANCE
Route::get('/service/balance', [WebServiceController::class, 'balance']);
Route::get('/service/updatebalance/{id_balance}', [WebServiceController::class, 'updateBalance']);





