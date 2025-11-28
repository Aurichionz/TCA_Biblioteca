<?php

use App\Http\Controllers\LivroController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// LOGIN
Route::get('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
require __DIR__.'/auth.php';

//BLOQUEAR REGISTRO
Route::get('register', fn() => redirect()->route('login'));
Route::post('register', fn() => redirect()->route('login'));

//ÁREA LOGADA
Route::middleware(['auth'])->group(function () {

    Route::get('/', fn() => redirect()->route('livros.index'));
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('livros', LivroController::class);
    Route::resource('emprestimos', EmprestimoController::class)->only(['index', 'store', 'show']);
    Route::get('emprestimos/{id}/comprovante', [EmprestimoController::class, 'comprovantePDF'])->name('emprestimos.comprovante');
    Route::get('alunos/{id}/historico', [EmprestimoController::class, 'historicoPDF'])->name('alunos.historico');

 //SOMENTE PARA ADMIN
    Route::middleware([])->group(function () {
        Route::get('/admin/emprestimos', [EmprestimoController::class, 'admin'])->name('emprestimos.admin');

        Route::resource('categorias', CategoriaController::class);
        Route::resource('autores', AutorController::class)->parameters(['autores' => 'autor']);
    });
});
