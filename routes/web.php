<?php

use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    //DASHBOARD
    Route:: get('/dashboard', function(){
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('users', UsersController::class)->only('index', 'store');
    Route::resource('permissions', PermissionsController::class)->only('index', 'store');
    Route::resource('roles', RolesController::class)->only('index', 'store');

    Route::prefix('queries')->group(function () {
        Route::get('role', [QueryController::class, 'role'])->name('queries.role');
        Route::get('permission', [QueryController::class, 'permission'])->name('queries.permission');
        Route::get('permission-role', [QueryController::class, 'permission_role'])->name('queries.permission-role');
    });
});
