<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function () {
    Route::post('register/', 'register');
    Route::post('login/', 'login');

    Route::get('user/', 'userProfile')->middleware('auth:sanctum');
    Route::get('user/destroy', 'destroy')->middleware('auth:sanctum');
});

Route::controller(JobsController::class)->group(function () {
    Route::get('jobs/', 'showJobs');
    Route::get('jobs/featured', 'featuredJobs');

    Route::get('jobs/filter', 'filterJobs');

    Route::get('company/{company_id}/jobs', 'jobsByCompany');

    Route::get('jobs/{job_id}', 'showSingleJob');
});

Route::controller(CompanyController::class)->group(function () {
    Route::get('company/', 'showCompany');

    Route::get('company/{company_id}', 'showSingleCompany');

});
