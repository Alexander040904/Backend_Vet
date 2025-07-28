<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Registro de usuario
    public function register(RegisterRequest $request)
    {

        #Para evitar dato incompletos en caso de erro
        $response = DB::transaction(function () use ($request) {
            #validacion y encriptacion
            $data = $request->validated();
            $data['password'] = bcrypt($data['password']);

            #creacion de usuario
            $user = User::create($data);

            #Generar token 
            $token = $user->createToken($request->email);
            $info = [
                'message'=>'El usuario se a creado correctamente',
                'data' => $user,
                'token' => $token,
            ];

            #respuesta
            return response()->json($info);
        });
        return $response;
    }

    public function login(LoginRequest $request)
    {
        $request->validated();
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {

            return response()->json([
                'message' => 'Las credenciales son incorrectas.'
            ], 401);
        }

        $token = $user->createToken($user->email);
        $data = [
            'message'=>'Has iniciado sesion correcta mente',
            'user' => $user,
            'token' => $token->plainTextToken
        ];
        return response()->json($data);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Vuelva pronto'
        ], 200);
    }
}
