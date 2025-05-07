<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/v1/register",
     *     summary="Registrar novo usuário",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","password","password_confirmation"},
     *             @OA\Property(property="name", type="string", example="User Name"),
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="secret123"),
     *             @OA\Property(property="password_confirmation", type="string", format="password", example="secret123")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Criado com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="user", ref="#/components/schemas/User"),
     *             @OA\Property(property="token", type="string")
     *         )
     *     ),
     *     @OA\Response(response=422, description="Validação falhou")
     * )
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|string|min:6|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role']     = 'user'; // sempre user via API

        $user  = User::create($data);
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(compact('user','token'), 201);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/login",
     *     summary="Login de usuário via API",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="secret123")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Autenticado",
     *         @OA\JsonContent(
     *             @OA\Property(property="user", ref="#/components/schemas/User"),
     *             @OA\Property(property="token", type="string")
     *         )
     *     ),
     *     @OA\Response(response=401, description="Credenciais inválidas")
     * )
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/me",
     *     summary="Retorna o usuário autenticado",
     *     tags={"Auth"},
     *     security={{ "sanctum": {} }},
     *     @OA\Response(response=200, description="Usuário retornado",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(response=401, description="Não autenticado")
     * )
     */
    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/logout",
     *     summary="Logout do usuário (token inválido)",
     *     tags={"Auth"},
     *     security={{ "sanctum": {} }},
     *     @OA\Response(response=200, description="Logout realizado",
     *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Logout realizado."))
     *     ),
     *     @OA\Response(response=401, description="Não autenticado")
     * )
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message'=>'Logout realizado.']);
    }
}
