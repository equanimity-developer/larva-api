<?php

declare(strict_types=1);

use App\Http\Actions\Company;
use App\Http\Actions\Employee;
use Illuminate\Support\Facades\Route;

Route::prefix('/employees')->group(function () {
    Route::post('/', Employee\CreateEmployee::class)->name('employee.create');
    Route::get('/{employee}', Employee\GetEmployee::class)->name('employee.get');
    Route::patch('/{employee}', Employee\UpdateEmployee::class)->name('employee.update');
    Route::delete('/{employee}', Employee\DeleteEmployee::class)->name('employee.delete');
    Route::get('/', Employee\GetAllEmployees::class)->name('employee.get-all');
});

Route::prefix('/companies')->group(function () {
    Route::post('/', Company\CreateCompany::class)->name('company.create');
    Route::get('/{company}', Company\GetCompany::class)->name('company.get');
    Route::patch('/{company}', Company\UpdateCompany::class)->name('company.update');
    Route::delete('/{company}', Company\DeleteCompany::class)->name('company.delete');
    Route::get('/', Company\GetAllCompanies::class)->name('company.get-all');
});