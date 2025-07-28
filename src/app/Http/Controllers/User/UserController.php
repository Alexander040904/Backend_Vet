<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    #elimar usuario
    public function destroy (Request $request){
        $user = $request->user();
        
        $user->tokens()->delete();

        $user->delete();


        return response()->json([
            'message'=> 'Perfil eliminado'
            
        ]);

    }

    #Actualizar usuario
    public function update(UpdateRequest $request){
        try{
            $user = $request->user();
            
            $data = $request->validated();
            if (isset($data['password']) && $data['password']) {
                $data['password'] = Hash::make($data['password']);
            }
            
            $user->update($data);

            $info = [
                'message' => 'Actualizacion completa',
                'data' => $user
            ];

            return response()->json($info);
        }
        catch(ModelNotFoundException $e){

            return response()->json([
                'message'=> 'No escontro el usuario'
            ], 404);
        };

        
        

    }

    #Vizualizar usuario
    public function  show(Request $request){
        $user = $request->user();


        return response()->json($user);
    }
}
