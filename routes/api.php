<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('index', 'index')->name('user-index');
        Route::post('store', 'store')->name('user-store')
            ->withoutMiddleware('auth:sanctum');
        Route::put('update', 'update')->name('user-update');
        Route::delete('destroy', 'destroy')->name('user-destroy');
    });

Route::controller(AuthController::class)
    ->group(function () {
        Route::post('login', 'login')->name('login');
        Route::delete('logout', 'logout')->name('logout')
            ->middleware('auth:sanctum');
    });

Route::controller(TransactionController::class)
    ->prefix('transaction')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('index', 'index')->name('transaction-index');
        Route::post('entry', 'entry')->name('transaction-entry');
        Route::post('withdraw', 'withdraw')->name('transaction-withdraw');
        Route::put('update/{id}', 'update')->name('transaction-update');
        Route::delete('destroy/{id}', 'destroy')->name('transaction-destroy');
    });

Route::controller(TransactionController::class)
    ->prefix('transaction')
    ->middleware('auth:sanctum')
    ->group(function () {

        Route::get('queryDate/{inicialDate}/{finalDate}', 'queryDate')
            ->name('transaction-query-date');

        Route::get('queryType/{type}', 'queryType')
            ->name('transaction-query-type');

        Route::get('queryCategory/{category}', 'queryCategory')
            ->name('transaction-query-category');
    });

Route::controller(CategoryController::class)
    ->prefix('category')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('index', 'index')->name('category-index');
        Route::get('show/{id}', 'show')->name('category-show');
        Route::post('store', 'store')->name('category-store');
        Route::put('update/{id}', 'update')->name('category-update');
        Route::delete('destroy/{id}', 'destroy')->name('category-destroy');
    });

Route::controller(ReportController::class)
    ->prefix('report')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('total', 'total')->name('reports-total');
        Route::get('month/{year}/{month}', 'month')->name('reports-month');
        Route::get('personalized/{iniDate}/{finDate}', 'personalized')->name('reports-personalized');
    });

// {
//     "name": "admin",
//     "email": "mail@mail.com",
//     "password": "12345678"
// }
