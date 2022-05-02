<?php

use App\Http\Actions\Employee;
use App\Http\Actions\Company;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('/employees')->group(function () {
    Route::post('/', Employee\AddEmployee::class)->name('employee.add');
    Route::get('/{employee}', Employee\GetEmployee::class)->name('employee.get');
    Route::patch('/{employee}', Employee\UpdateEmployee::class)->name('employee.update');
    Route::delete('/{employee}', Employee\DeleteEmployee::class)->name('employee.delete');
});


Route::prefix('/companies')->group(function () {
    Route::post('/', Company\AddCompany::class)->name('company.add');
    Route::get('/{company}', Company\GetCompany::class)->name('company.get');
    Route::patch('/{company}', Company\UpdateCompany::class)->name('company.update');
    Route::delete('/{company}', Company\DeleteCompany::class)->name('company.delete');
});