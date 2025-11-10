<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\UserDocumentsController;
use App\Http\Controllers\HospedagensController;
use App\Http\Controllers\AfiliacaoController;
use App\Http\Controllers\FormularioController;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Auth::routes();

Route::group(['prefix' => 'perfil'], function () {
    Route::get('/', [PerfilController::class, 'index']);
    Route::post('/update', [PerfilController::class, 'update']);
    Route::post('/change-password', [PerfilController::class, 'changePassword'])->name('perfil.change-password');
});

Route::group(['prefix' => 'upload'], function () {
    Route::post('/documentos/pessoais', [UserDocumentsController::class, 'upload'])->name('upload.documentos');
    Route::get('/documentos/pessoais/delete/{id}', [UserDocumentsController::class, 'delete'])->name('documentos.destroy');

    Route::post('/logo', [PerfilController::class, 'upload'])->name('upload.logo');
});

Route::group(['prefix' => 'empreendimentos'], function () {
    Route::group(['prefix' => 'hospedagens'], function () {
        Route::get('/', [HospedagensController::class, 'view'])->name('empreendimentos.hospedagens');
        Route::get('/tabela', [HospedagensController::class, 'tabela'])->name('empreendimentos.hospedagens.tabela');
        Route::post('/store', [HospedagensController::class, 'store'])->name('empreendimentos.hospedagens.store');
        Route::get('/{id}', [HospedagensController::class, 'show']);
        Route::put('/update/{id}', [HospedagensController::class, 'update']);
        Route::post('/upload', [HospedagensController::class, 'upload'])->name('empreendimentos.hospedagens.upload');
    });

    Route::group(['prefix' => 'afiliacoes'], function () {
        Route::get('/', [AfiliacaoController::class, 'viewMinhasAfiliacoes'])->name('empreendimentos.afiliacoes');
        Route::get('/tabela/{status}', [AfiliacaoController::class, 'tabelaMinhasAfiliacoes'])->name('empreendimentos.afiliacoes.tabela');
    });
});

Route::group(['prefix' => 'mercado'], function () {
    Route::group(['prefix' => 'empreendimentos'], function () {
        Route::get('/', [AfiliacaoController::class, 'view'])->name('mercado.empreendimentos.afiliacao');
        Route::get('/tabela/{type}', [AfiliacaoController::class, 'tabela'])->name('mercado.empreendimentos.afiliacao.tabela');
        Route::post('/afiliar', [AfiliacaoController::class, 'store']);
    });
});

Route::get('/formularios', [FormularioController::class, 'view'])->name('formularios.index');
Route::get('/formularios/list', [FormularioController::class, 'list'])->name('formularios.list');
Route::post('/formularios/acao', [FormularioController::class, 'acao'])->name('formularios.acao');
