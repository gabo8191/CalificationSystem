<?php

use App\Http\Controllers\FormularioController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();


Route::middleware(['auth'])->group(function () {

    Route::get('/logout', [UsersController::class, 'logout'])
        ->name('logout');

    Route::prefix('questions')->group(function () {
        Route::get('/create', [QuestionController::class, 'create'])
            ->name('pregunta.create')
            ->middleware('can:pregunta.create');
        Route::get('/{question}/edit', [QuestionController::class, 'edit'])
            ->name('pregunta.edit')
            ->middleware('can:pregunta.edit');
        Route::put('/{question}', [QuestionController::class, 'update'])
            ->name('pregunta.update');
        Route::post('/', [QuestionController::class, 'store'])
            ->name('pregunta.store');
        Route::delete('/{question}', [QuestionController::class, 'destroy'])
            ->name('pregunta.destroy');
        Route::get('/', [QuestionController::class, 'show'])->name('pregunta.show')
            ->middleware('can:pregunta.show');
    });

    Route::prefix('partners')->group(function () {
        Route::get('/create', [PartnerController::class, 'create'])
            ->name('partners.create')
            ->middleware('can:partners.create');
        Route::post('/', [PartnerController::class, 'store'])
            ->name('partners.store');
        Route::get('/{partner}/edit', [PartnerController::class, 'edit'])
            ->name('partners.edit')
            ->middleware('can:partners.edit');
        Route::put('/{partner}', [PartnerController::class, 'update'])
            ->name('partners.update');
        Route::delete('/{partner}', [PartnerController::class, 'destroy'])
            ->name('partners.destroy');
        Route::get('/', [PartnerController::class, 'show'])
            ->name('partners.show')
            ->middleware('can:partners.show');
        Route::get('/export/excel', [PartnerController::class, 'exportPartnersExcel'])
            ->name('exportExcelPartner');
        Route::get('/export/pdf', [PartnerController::class, 'exportPartnersPdf'])
            ->name('exportPdfPartner');
    });

    Route::prefix('roles')->group(function () {
        Route::get('/create', [RoleController::class, 'create'])
            ->name('roles.create')
            ->middleware('can:roles.create');
        Route::post('/', [RoleController::class, 'store'])
            ->name('roles.store');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])
            ->name('roles.edit')
            ->middleware('can:roles.edit');
        Route::put('/{role}', [RoleController::class, 'update'])
            ->name('roles.update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])
            ->name('roles.destroy');
        Route::get('/', [RoleController::class, 'show'])
            ->name('roles.show')
            ->middleware('can:roles.show');
    });

    Route::prefix('teams')->group(function () {
        Route::get('/create', [TeamController::class, 'create'])
            ->name('teams.create')
            ->middleware('can:teams.create');
        Route::post('/', [TeamController::class, 'store'])
            ->name('teams.store');
        Route::get('/{team}/edit', [TeamController::class, 'edit'])->name('teams.edit')
            ->middleware('can:teams.edit');
        Route::put('/{team}', [TeamController::class, 'update'])
            ->name('teams.update');
        Route::delete('/{team}', [TeamController::class, 'destroy'])
            ->name('teams.destroy');
        Route::get('/', [TeamController::class, 'show'])
            ->name('teams.show')
            ->middleware('can:teams.show');
    });

    Route::prefix('formulario')->group(function () {
        Route::get('/', [FormularioController::class, 'index'])
            ->name('formulario.index')
            ->middleware('can:formulario.index');
        Route::post('/', [FormularioController::class, 'store'])
            ->name('formulario.store');
        Route::get('/resultados', [FormularioController::class, 'resultados'])
            ->name('formulario.resultados')
            ->middleware('can:resultados');
        Route::get('/resumen', [FormularioController::class, 'resumen'])
            ->name('formulario.resumen')
            ->middleware('can:resumen');
        Route::get('/export/excel', [FormularioController::class, 'exportResultsExcel'])
            ->name('exportExcelResults');
        Route::get('/export/pdf', [FormularioController::class, 'exportResultsPdf'])
            ->name('exportPdfResults');
        Route::get('/exportTeam/excel/', [FormularioController::class, 'exportResumeTeamsExcel'])
            ->name('exportExcelResultsTeams');
        Route::get('/exportTeam/pdf/', [FormularioController::class, 'exportResumeTeamsPdf'])
            ->name('exportPdfResultsTeams');
    });

    Route::prefix('usuario')->group(function () {
        Route::get('/{user}/edit', [UsersController::class, 'edit'])
            ->name('usuario.edit')
            ->middleware('can:usuario.edit');
        // Route::get('/index', [UsersController::class, 'index'])
        //     ->name('usuario.index')
        //     ->middleware('can:usuario.index');
        Route::get('/export/excel', [UsersController::class, 'exportUsersExcel'])
            ->name('exportExcel');
        Route::get('/export/pdf', [UsersController::class, 'exportUsersPdf'])
            ->name('exportPdf');
        Route::put('/{user}', [UsersController::class, 'update'])
            ->name('usuario.update');
        Route::delete('/{user}', [UsersController::class, 'destroy'])
            ->name('usuario.destroy');
        Route::get('/', [UsersController::class, 'show'])
            ->name('usuario.show')
            ->middleware('can:usuario.show');
    });
    
});
