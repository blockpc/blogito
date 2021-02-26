<?php

use App\Http\Controllers\System\JobController;
use App\Http\Controllers\System\PermissionController;
use App\Http\Controllers\System\ProfileController;
use App\Http\Controllers\System\RoleController;
use App\Http\Controllers\System\SystemController;
use App\Http\Controllers\System\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'=>'sistema', 
    'middleware'=> ['auth', 'verified', 'active_user']
], function() {
    Route::get('/', [SystemController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [SystemController::class, 'dashboard'])->name('dashboard');

    Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');
    Route::get('/usuarios/{user}', [UserController::class, 'edit'])->name('users.edit');

    Route::get('/tareas', [JobController::class, 'index'])->name('jobs.index');

    Route::get('/perfil', [ProfileController::class, 'index'])->name('profiles.index');
    Route::post('/perfil/edit/information', [ProfileController::class, 'edit_information'])->name('profiles.edit.information');
    Route::post('/perfil/edit/password', [ProfileController::class, 'change_password'])->name('profiles.change.password');
    Route::post('/perfil/edit/image', [ProfileController::class, 'change_image'])->name('profiles.change.image');
    Route::get('/perfil/{user}', [ProfileController::class, 'show'])->name('profiles.show');

    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/permisos', [PermissionController::class, 'index'])->name('permissions.index');
});