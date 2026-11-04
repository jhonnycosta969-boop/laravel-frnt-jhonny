<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\UsuarioToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $dados = $request->validate([
            'usuario_id' => 'required|integer',
            'token' => 'required|string',
        ]);

        
        $token = UsuarioToken::where(
            'usuario_id',
            $dados['usuario_id']
        )
            ->where('token', $dados['token'])
            ->where('valido_ate', '>', now())
            ->first();

        if (!$token) {
            return response()->json([
                'message' => 'Token inválido ou expirado.',
                'erro' => 's'
            ], 401);
        }

        
        $admin = Admin::where(
            'usuario_id',
            $dados['usuario_id']
        )->first();

        if (!$admin) {
            return response()->json([
                'message' => 'Acesso permitido somente para administradores.',
                'erro' => 's'
            ], 403);
        }

        return $next($request);
    }
}
