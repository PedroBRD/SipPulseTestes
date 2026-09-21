<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriberController;

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

Route::get('/', function () {
    return view('home');
})->name('home');

// Funcionalidades 
Route::get('/addDid', [UserController::class, 'addDid'])->name('addDid');
Route::post('/saveDid', [UserController::class, 'saveDid'])->name('saveDid');

Route::get('/findDids', [UserController::class, 'findDids'])->name('findDids');
Route::get('/listDid', [UserController::class, 'listDid'])->name('listDid');

Route::get('/addCredit', [UserController::class, 'addCredit'])->name('addCredit');
Route::post('/insertCredit', [UserController::class, 'insertCredit'])->name('insertCredit');

Route::get('/listDomains', [UserController::class, 'listDomain'])->name('listDomain');






// Assinantes

Route::get('/tvendas', [SubscriberController::class, 'homeTvendas'])->name('homeTvendas');
Route::get('/addTvenda', [SubscriberController::class, 'addTvenda'])->name('addTvenda');
Route::post('/saveTvendas', [SubscriberController::class, 'saveTvendas'])->name('saveTvendas');
Route::get('/listTvenda', [SubscriberController::class, 'listTvenda'])->name('listTvenda');
Route::get('/deleteTvenda', [SubscriberController::class, 'deleteTvenda'])->name('deleteTvenda');
Route::delete('/excludeTvenda', [SubscriberController::class, 'excludeTvenda'])->name('excludeTvenda');

Route::get('/planoTarifas', [SubscriberController::class, 'homePtarifas'])->name('homePtarifas');
Route::get('/addPtarifa', [SubscriberController::class, 'addPtarifa'])->name('addPtarifa');
Route::get('/savePtarifa', [SubscriberController::class, 'savePtarifa'])->name('savePtarifa');
Route::get('/listPtarifa', [SubscriberController::class, 'listPtarifa'])->name('listPtarifa');
Route::get('/alterPtarifa', [SubscriberController::class, 'alterPtarifa'])->name('alterPtarifa');
Route::get('/deletePtarifa', [SubscriberController::class, 'deletePtarifa'])->name('deletePtarifa');
Route::delete('/excludePtarifa', [SubscriberController::class, 'excludePtarifa'])->name('excludePtarifa');

Route::get('/profile', [SubscriberController::class, 'homeProfile'])->name('homeProfile');
Route::get('/listProfile', [SubscriberController::class, 'listProfile'])->name('listProfile');
Route::get('/changeProfile', [SubscriberController::class, 'changeProfile'])->name('changeProfile');

Route::get('/assinantes', [SubscriberController::class, 'homeAssinantes'])->name('homeAssinantes');
Route::get('/addAssinante', [SubscriberController::class, 'addAssinante'])->name('addAssinante');
Route::get('/saveAssinante', [SubscriberController::class, 'saveAssinante'])->name('saveAssinante');
Route::get('/deleteAssinante', [SubscriberController::class, 'deleteAssinante'])->name('deleteAssinante');
Route::delete('/excludeAssinante', [SubscriberController::class, 'excludeAssinante'])->name('excludeAssinante');


Route::get('/provider', function() {
    return redirect()->away('http://187.109.40.215:8080/SipPulseAdmin/pages/provider/provider.jsf');
})->name('provider');