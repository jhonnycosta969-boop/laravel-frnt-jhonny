<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\UsuarioToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // TELA DE CADASTRO
    public function create()
    {
        return view('usuario.create');
    }

    // CADASTRAR USUÁRIO
    public function salvar_usuario(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'required|string|min:6',
            'tipo' => 'sometimes|string',
            'ativo' => 'sometimes|boolean',
        ]);

        try {
            $usuario = new Usuario();
            $usuario->nome = $dados['nome'];
            $usuario->email = $dados['email'];
            $usuario->senha = Hash::make($dados['senha']);
            $usuario->tipo = $dados['tipo'] ?? 'usuario';
            $usuario->ativo = $dados['ativo'] ?? true;
            $usuario->save();

            return response()->json([
                'message' => 'Usuário criado com sucesso!',
                'usuario' => $usuario,
                'erro' => 'n'
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao criar usuário.',
                'erro' => 's'
            ], 500);
        }
    }

    // VER USUÁRIO POR ID
    public function ver_usuario(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $usuario = Usuario::find($request->input('id'));

        if (!$usuario) {
            return response()->json([
                'message' => 'Usuário não encontrado.',
                'erro' => 's'
            ], 404);
        }

        return response()->json([
            'usuario' => $usuario,
            'erro' => 'n'
        ], 200);
    }

    // LISTAR TODOS OS USUÁRIOS
    public function listar_usuarios(Request $request)
    {
        return response()->json([
            'usuarios' => Usuario::all(),
            'erro' => 'n'
        ], 200);
    }

    // LISTAR USUÁRIOS SIMPLES
    public function listar_usuarios_simples(Request $request)
    {
        return response()->json([
            'usuarios' => Usuario::select('nome', 'email')->get(),
            'erro' => 'n'
        ], 200);
    }

    // ALTERAR USUÁRIO
    public function alterar_usuario(Request $request)
    {
        $dados = $request->validate([
            'id' => 'required|exists:usuarios,id',
            'nome' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:usuarios,email,' . $request->input('id'),
            'senha' => 'sometimes|required|string|min:6',
            'tipo' => 'sometimes|required|string',
            'ativo' => 'sometimes|required|boolean',
        ]);

        try {
            $usuario = Usuario::findOrFail($dados['id']);

            if (array_key_exists('nome', $dados)) {
                $usuario->nome = $dados['nome'];
            }

            if (array_key_exists('email', $dados)) {
                $usuario->email = $dados['email'];
            }

            if (array_key_exists('senha', $dados)) {
                $usuario->senha = Hash::make($dados['senha']);
            }

            if (array_key_exists('tipo', $dados)) {
                $usuario->tipo = $dados['tipo'];
            }

            if (array_key_exists('ativo', $dados)) {
                $usuario->ativo = $dados['ativo'];
            }

            $usuario->save();

            return response()->json([
                'message' => 'Usuário atualizado com sucesso!',
                'erro' => 'n'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao atualizar usuário.',
                'erro' => 's'
            ], 500);
        }
    }

    // DELETAR USUÁRIO
    public function deletar_usuario(Request $request)
    {
        $dados = $request->validate([
            'id' => 'required|exists:usuarios,id',
        ]);

        try {
            $usuario = Usuario::findOrFail($dados['id']);
            $usuario->delete();

            return response()->json([
                'message' => 'Usuário deletado com sucesso!',
                'erro' => 'n'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao deletar usuário.',
                'erro' => 's'
            ], 500);
        }
    }

    // LOGIN
    public function login(Request $request)
    {
        $dados = $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string',
        ]);

        $usuario = Usuario::where('email', $dados['email'])->first();

        if (
            !$usuario ||
            !Hash::check($dados['senha'], $usuario->senha)
        ) {
            return response()->json([
                'message' => 'Email ou senha inválidos.',
                'erro' => 's'
            ], 401);
        }

        // Gerar token aleatório
        $userToken = new UsuarioToken();
        $userToken->usuario_id = $usuario->id;
        $userToken->token = bin2hex(random_bytes(32));
        $userToken->valido_ate = now()->addDays(7);
        $userToken->save();

        return response()->json([
            'message' => 'Login realizado com sucesso!',
            'erro' => 'n',
            'usuario_id' => $usuario->id,
            'token' => $userToken->token
        ], 200);
    }

    // LOGOUT: APAGAR O TOKEN
    public function logout(Request $request)
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
                'message' => 'Token inválido ou já desconectado.',
                'erro' => 's'
            ], 401);
        }

        $token->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso!',
            'erro' => 'n'
        ], 200);
    }
}
