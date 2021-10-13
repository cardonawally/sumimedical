<?php

use App\Http\Controllers\PermissionsController;
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

    Route::get('view_users', [UsersController::class, 'view_users'])->name('view_users');
    Route::get('view_permissions', [PermissionsController::class, 'view_permissions'])->name('view_permissions');
    Route::post('save_permissions',[PermissionsController::class, 'save_permissions'])->name('save_permissions');
    Route::get('view_roles', [RolesController::class, 'view_roles'])->name('view_roles');


});
