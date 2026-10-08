<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FuncController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;


// ROTAS PÚBLICAS
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'validaLogin'])->name('login.valida');

//--------------
// ROTAS PROTEGIDAS COM A MIDDLEWARE
Route::middleware(['auth'])->group(function () {
    
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


    Route::prefix('/')->group(function () {
    //Página principal
    Route::get('/home', [FuncController::class, 'home'])->name('home');

    // Funcionalidades 
    Route::get('/addDid', [FuncController::class, 'addDid'])->name('addDid');
    Route::post('/saveDid', [FuncController::class, 'saveDid'])->name('saveDid');
    Route::get('/findDids', [FuncController::class, 'findDids'])->name('findDids');
    Route::get('/listDid', [FuncController::class, 'listDid'])->name('listDid');

    Route::get('/addCredit', [FuncController::class, 'addCredit'])->name('addCredit');
    Route::post('/insertCredit', [FuncController::class, 'insertCredit'])->name('insertCredit');

    Route::get('/listDomains', [FuncController::class, 'listDomain'])->name('listDomain');



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
    Route::get('/changePass', [SubscriberController::class, 'changePass'])->name('changePass');
    Route::get('/savePass', [SubscriberController::class, 'savePass'])->name('savePass');


    //aqui ainda faltam as rotas com redirecionamento para o pulse
    Route::get('/provider', function() {
        return redirect()->away('http://187.109.40.215:8080/SipPulseAdmin/pages/provider/provider.jsf');
    })->name('provider');
    

    });




    // Users
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/show/{id}', [UserController::class, 'show'])->name('users.show');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
    });



    Route::prefix('inicio')->group( function () {
        Route::get('/', [HomeController::class, 'index'])->name('home.index');
    });
});

