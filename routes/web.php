<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MovementCredelecController;
use App\Http\Controllers\MovementFipagController;
use App\Http\Controllers\MovementInformaticController;
use App\Http\Controllers\MovementMobileRechargeController;
use App\Http\Controllers\MovementMobileWalletController;
use App\Http\Controllers\MovementTvController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';*/

Route::get('/', [MainController::class, 'index']);
Route::get('/getData', [MainController::class, 'getData']);
Route::resource('user', UserController::class);
Route::resource('client', ClientController::class);
Route::resource('investment', InvestmentController::class);
Route::resource('coin', CoinController::class);
Route::resource('movement-mobile-wallet', MovementMobileWalletController::class);
Route::get('listAllMovements', [MovementMobileWalletController::class, 'listAllMovements']);
Route::put('movement-mobile-wallet-update-status', [MovementMobileWalletController::class, 'updateStatus'])->name('movement-mobile-wallet-update-status');
Route::resource('movement-informatic', MovementInformaticController::class);
Route::put('movement-informatic-update-status', [MovementInformaticController::class, 'updateStatus'])->name('movement-informatic-update-status');
Route::post('movement-informatic-storeAll', [MovementInformaticController::class, 'storeAll'])->name('movement-informatic-storeAll');
Route::resource('movement-mobile-recharge', MovementMobileRechargeController::class);
Route::put('movement-mobile-recharge-update-status', [MovementMobileRechargeController::class, 'updateStatus'])->name('movement-mobile-recharge-update-status');
Route::resource('movement-tv', MovementTvController::class);
Route::put('movement-tv-update-status', [MovementTvController::class, 'updateStatus'])->name('movement-tv-update-status');
Route::resource('movement-fipag', MovementFipagController::class);
Route::put('movement-fipag-update-status', [MovementFipagController::class, 'updateStatus'])->name('movement-fipag-update-status');
Route::resource('movement-credelec', MovementCredelecController::class);
Route::put('movement-credelec-update-status', [MovementCredelecController::class, 'updateStatus'])->name('movement-credelec-update-status');
Route::resource('service', ServiceController::class);
Route::resource('material', MaterialController::class);
//listando servicos informaticos
Route::get('getService/{code}', [MainController::class, 'getService']);
//listando os precos de servicos
Route::get('getPrices/{code}', [MainController::class, 'getPrices']);

require __DIR__.'/auth.php';

