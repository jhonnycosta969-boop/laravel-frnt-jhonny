
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PedidoController;

// Login
Route::get('/', [LoginController::class, 'index'])->name('login');

Route::get('/login', [LoginController::class, 'index']);

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.entrar');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

// Sair
Route::get('/logout', [LoginController::class, 'logout'])
    ->name('logout');


Route::get('/materiais', [MaterialController::class, 'index'])
    ->name('materiais');

Route::get('/emprestimos', [EmprestimoController::class, 'index'])
    ->name('emprestimos');


Route::get('/pedidos', [PedidoController::class, 'index'])
    ->name('pedidos');

Route::get('/login_teste', [LoginController::class, 'mostrarLogin'])->name('login_teste');