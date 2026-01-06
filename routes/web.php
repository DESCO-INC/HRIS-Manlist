<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ManlistController;

// Auth
Route::get('/', [SessionController::class, 'index'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);


Route::prefix('manlist')->middleware(['auth'])->controller(ManlistController::class)->group(function () {
    Route::get('/', 'index')->name('manlist.index');
    Route::get('/create', 'create')->name('manlist.create');
    Route::post('/', 'store')->name('manlist.store');
    Route::get('/{unit}/edit', 'edit')->name('manlist.edit');
    Route::put('/{unit}/update', 'update')->name('manlist.update');
    Route::delete('/{unit}/destroy', 'destroy')->name('manlist.destroy');
    
    Route::get('/{id}/contract', 'generateContract')->name('manlist.contract');
    Route::get('/{id}/form', 'generateForm')->name('manlist.form');
    Route::get('/export', 'exportExcel')->name('manlist.export');
    Route::post('/import', 'importExcel')->name('manlist.import');
});

Route::get('/locations/municipalities', [ManlistController::class, 'getMunicipalities']);
Route::get('/locations/barangays', [ManlistController::class, 'getBarangays']);


Route::get('/download-manlist-template', function () {
    $file = public_path('templates/manlist_import_template.xlsx');

    if (!file_exists($file)) {
        abort(404, 'Template not found.');
    }

    return response()->download($file, 'manlist_import_template.xlsx');
})->name('download.manlist.template');


Route::prefix('maintenance')->middleware(['auth'])->controller(MaintenanceController::class)->group(function () {
    Route::get('/', 'index')->name('maintenance.index');
    Route::post('/store_user', 'store_user')->name('maintenance.store_user');
    Route::delete('/delete_user/{user}', 'delete_user')->name('maintenance.delete_user');
    Route::put('/update_user/{user}', 'update_user')->name('maintenance.update_user');
});