<?php

use App\Http\Controllers\Proyect\CategoryController;
use App\Http\Controllers\Proyect\DropzoneController;
use App\Http\Controllers\Proyect\PostController;
use App\Http\Controllers\Proyect\TagController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'=>'sistema', 
    'middleware'=> ['auth', 'verified', 'active_user']
], function() {
    Route::get('/categorias', [CategoryController::class, 'index'])->name('proyect.category.index');

    Route::get('/etiquetas', [TagController::class, 'index'])->name('proyect.tag.index');

    Route::post('/dropzone/store/{post}', [DropzoneController::class, 'store'])->name('dropzone.store');
    Route::post('/dropzone/destroy', [DropzoneController::class, 'destroy'])->name('dropzone.destroy');

    Route::get('/articulos', [PostController::class, 'index'])->name('proyect.post.index');
    Route::post('/articulos/store_fast', [PostController::class, 'store_fast'])->name('proyect.post.store_fast');
    Route::post('/articulos/store', [PostController::class, 'store'])->name('proyect.post.store');
    Route::post('/articulos/content/{post}', [PostController::class, 'content'])->name('proyect.post.content');
    Route::get('/articulos/edit/{post}', [PostController::class, 'edit'])->name('proyect.post.edit');
    Route::put('/articulos/update/{post}', [PostController::class, 'update'])->name('proyect.post.update');
});