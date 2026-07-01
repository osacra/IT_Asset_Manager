<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\AtivoController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\HistoricoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('categorias', CategoriaController::class)->except(['show']); 
    Route::resource('ativos', AtivoController::class)->except(['show']);
    Route::resource('colaboradores', ColaboradorController::class)->except(['show']);
    Route::get('emprestimos', [EmprestimoController::class, 'index'])->name('emprestimos.index');
    Route::get('emprestimos/create', [EmprestimoController::class, 'create'])->name('emprestimos.create');
    Route::post('emprestimos', [EmprestimoController::class, 'store'])->name('emprestimos.store');
    Route::patch('emprestimos/{emprestimo}/devolver', [EmprestimoController::class, 'devolver'])->name('emprestimos.devolver');
    Route::get('historico', [HistoricoController::class, 'index'])->name('historicos.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
