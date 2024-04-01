<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Models\Company;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //company
    Route::post('/company', [CompanyController::class, 'store'])->name('company.create');
    Route::get('/company/{id}', [CompanyController::class, 'index'])->name('company.index');
    Route::put('/company/{id}', [CompanyController::class, 'update'])->name('company.update');
    Route::delete('/company/{id}', [CompanyController::class, 'destroy'])->name('company.destroy');

    //employee
    Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.create');
    Route::get('/employee/{id}', [EmployeeController::class, 'index'])->name('employee.index');
    Route::put('/employee/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/employee/{company_id}/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
});

require __DIR__.'/auth.php';
