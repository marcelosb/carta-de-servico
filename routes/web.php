<?php

use App\Http\Controllers\Admin\ConfigurationController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SecretaryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserProfileController;
use App\Http\Controllers\Web\WebController;

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

Route::name('web.')->group(function() {
    Route::get('/', [WebController::class, 'index'])->name('home');
    Route::get('/faq', [WebController::class, 'faq'])->name('faq');
    Route::get('secretaria/{secretary_theme_slug}', [WebController::class, 'secretary'])->name('secretary');
    Route::get('secretaria/{secretary_theme_slug}/{service_slug}', [WebController::class, 'secretaryServices'])->name('secretary.services');
});

Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function() {
    /** Página inicial do painel de controle */
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    
    /** Configuração dos dados do perfil do usuário */
    Route::get('/user-profile', [UserProfileController::class, 'index'])->name('user.profile.index');
    Route::get('/user-profile/edit', [UserProfileController::class, 'edit'])->name('user.profile.edit');
    Route::put('/user-profile/update', [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::get('/user-profile/edit/password', [UserProfileController::class, 'editPassword'])->name('user.profile.edit.password');
    Route::put('/user-profile/update/password', [UserProfileController::class, 'updatePassword'])->name('user.profile.update.password');

    /** Módulos da aplicação */
    Route::resource('secretaries', SecretaryController::class)->except(['show']);
    Route::resource('services', ServiceController::class)->except(['show']);
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('roles', RoleController::class)->except(['show']);

    /** Alteração das perguntas frequentes (Módulo específico de edição) */
    Route::get('/faq/edit', [FaqController::class, 'edit'])->name('faq.edit');
    Route::put('/faq/update', [FaqController::class, 'update'])->name('faq.update');

    /** Alteração das configurações gerais (Módulo específico de edição) */
    Route::get('/configurations/edit', [ConfigurationController::class, 'edit'])->name('configurations.edit');
    Route::put('/configurations/update', [ConfigurationController::class, 'update'])->name('configurations.update');
});
