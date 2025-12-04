<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaintenanceController;
use App\Livewire\Login;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard.index');
    }
    return view('Pages.Login');
})->name('login');

Route::resource('dashboard', DashboardController::class)->middleware('auth');

Route::get('/dashboard/{id}/contract', [DashboardController::class, 'generateContract'])->name('dashboard.contract');

Route::get('/dashboard/{id}/form', [DashboardController::class, 'generateForm'])->name('dashboard.form');

Route::post('/import-excel', [DashboardController::class, 'importExcel'])->name('dashboard.import');

Route::get('/export-excel', [DashboardController::class, 'exportExcel'])->name('dashboard.export');

Route::get('/download-manlist-template', function () {
    $file = public_path('templates/manlist_import_template.xlsx');

    if (!file_exists($file)) {
        abort(404, 'Template not found.');
    }

    return response()->download($file, 'manlist_import_template.xlsx');
})->name('download.manlist.template');

Route::resource('maintenance', MaintenanceController::class)->except('show')->middleware('auth');
Route::get('maintenance/profile', [MaintenanceController::class, 'profile'])->name('maintenance.profile');