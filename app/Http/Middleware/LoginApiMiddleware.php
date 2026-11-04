<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UsuarioToken;
use Carbon\Carbon;

class LoginApiMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('token') && $request->has('usuario_id')) {

            $token = UsuarioToken::where(
                'usuario_id',
                $request->input('usuario_id')
            )
                ->where('token', $request->input('token'))
                ->where('valido_ate', '>', Carbon::now())
                ->first();

            if ($token) {
                return $next($request);
            }

            return response()->json([
                'message' => 'Token inválido ou expirado.',
                'erro' => 's'
            ], 200);

        } else {
            return response()->json([
                'message' => 'Token ou usuario_id não fornecido.',
                'erro' => 's'
            ], 200);
        }
    }
}
