<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AviatorController;
use App\Http\Controllers\RociAuthController;
use App\Http\Controllers\PaymentController;

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

//Authentication
Route::get('/login', [RociAuthController::class, 'login'])->name('login');
Route::post('/loginProcessor', [RociAuthController::class, 'loginProcessor'])->name('loginProcessor');
Route::get('/register', [RociAuthController::class, 'register'])->name('register');
Route::post('/registerProcessor', [RociAuthController::class, 'registerProcessor'])->name('registerProcessor');
Route::get('/logout', [RociAuthController::class, 'logout'])->name('logout');

//payments
Route::post('/verifyDeposit', [PaymentController::class, 'verifyDeposit'])->name('payment.verifyDeposit')->middleware('auth');



Route::get('/', [AviatorController::class, 'index'])->name('index')->middleware('auth');
Route::post('/logRound', [AviatorController::class, 'logRound'])->name('logRound');
Route::get('/roundCode', [AviatorController::class, 'roundCode'])->name('roundCode');
Route::get('/loadPrevRounds', [AviatorController::class, 'prevRounds'])->name('loadPrevRounds');
Route::get('/loadWinnings', [AviatorController::class, 'winnings'])->name('loadWinnings');
Route::get('/deposit', [PaymentController::class, 'deposit'])->name('deposit')->middleware('auth');