<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalizacaoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MaterialController;
use App\http\controllers\EmprestimoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\LoginApiMiddleware;
use App\Http\Middleware\AdminMiddleware;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/usuario_cadastro', [App\Http\Controllers\UsuarioController::class, 'salvar_usuario'])->name('usuario_cadastro');


Route::get('/ver_usuario', [App\Http\Controllers\UsuarioController::class, 'ver_usuario'])->name('ver_usuario');
Route::get('/listar_usuarios', [App\Http\Controllers\UsuarioController::class, 'listar_usuarios'])->name('listar_usuarios');
Route::get('/listar_usuarios_simples', [App\Http\Controllers\UsuarioController::class, 'listar_usuarios_simples'])->name('listar_usuarios_simples');
Route::put('/alterar_usuario', [UsuarioController::class,'alterar_usuario'])->middleware(VerificarToken::class);
Route::delete('/deletar_usuario', [App\Http\Controllers\UsuarioController::class, 'deletar_usuario'])->name('deletar_usuario');


Route::get('/listar_localizacoes', [LocalizacaoController::class, 'index']);
Route::get('/ver_localizacao/{id}', [LocalizacaoController::class, 'show']);

Route::post('/cadastrar_localizacao', [LocalizacaoController::class, 'store']);

Route::put('/alterar_localizacao/{id}', [LocalizacaoController::class, 'update']);
Route::delete('/deletar_localizacao', [App\Http\Controllers\LocalizacaoController::class, 'deletar_localizacao'])->name('deletar_localizacao');


Route::get('/listar_categorias', [CategoriaController::class, 'index']);
Route::get('/ver_categoria/{id}', [CategoriaController::class, 'show']);
Route::post('/cadastrar_categoria', [CategoriaController::class, 'store']);
Route::put('/alterar_categoria/{id}', [CategoriaController::class, 'update']);
Route::delete('/deletar_categoria/{id}', [CategoriaController::class, 'destroy']);

Route::get('/listar_materiais', [MaterialController::class, 'index']);
Route::get('/ver_material/{id}', [MaterialController::class, 'show']);
Route::post('/cadastrar_material', [MaterialController::class, 'store']);
Route::put('/alterar_material/{id}', [MaterialController::class, 'update']);
Route::delete('/deletar_material/{id}', [MaterialController::class, 'destroy']);

Route::get('/listar_emprestimos', [EmprestimoController::class, 'listar_emprestimos']);
Route::get('/ver_emprestimo/{id}', [EmprestimoController::class, 'ver_emprestimo']);
Route::post('/cadastrar_emprestimo', [EmprestimoController::class, 'cadastrar_emprestimo']);
Route::put('/alterar_emprestimo/{id}', [EmprestimoController::class, 'alterar_emprestimo']);
Route::delete('/deletar_emprestimo/{id}', [EmprestimoController::class, 'deletar_emprestimo']);

Route::get('/listar_pedidos', [PedidoController::class, 'listar_pedidos']);
Route::get('/ver_pedido/{id}', [PedidoController::class, 'ver_pedido']);
Route::post('/cadastrar_pedido', [PedidoController::class, 'cadastrar_pedido']);
Route::put('/alterar_pedido/{id}', [PedidoController::class, 'alterar_pedido']);
Route::delete('/deletar_pedido/{id}', [PedidoController::class, 'destroy']);

Route::post('/login', [UsuarioController::class, 'login'])->name('login');
Route::put('/alterar_usuario', [UsuarioController::class,'alterar_usuario'])->middleware(LoginApiMiddleware::class);

Route::post('/logout', [UsuarioController::class, 'logout']);

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', function () {
        return response()->json([
            'message' => 'Acesso autorizado para administrador.',
            'erro' => 'n'
        ]);
    });
});


