<?php

namespace App\Http\Controllers\Vet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vet\StoreRequest;
use App\Http\Requests\Vet\UpdateRequest;
use App\Models\Vet;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VetController extends Controller
{
    //

    public function show(Request $request){
        $user = $request->user();
        $vet = $user->vet;

        if (!$vet) {
            return response()->json([
                'message'=> 'No escontro el veterinario'
            ], 404);
        }

        return response()->json($vet);
    }
    
    public function update(UpdateRequest $request){
        #Usurio
        $user = $request->user();
        #Relacion con vet user_id
        $vet = $user->vet;

        if (!$vet) {
            return response()->json([
                'message'=> 'No escontro el veterinario'
            ], 404);
        }

        #Activas las validacion y actualizar
        $data = $request->validated();
        $vet->update($data);

        $info = [
            'message'=> 'Actualizacion completa',
            'data' => $vet
        ];

        return response()->json($info);
        

    }
    public function store(StoreRequest $request){

        $response = DB::transaction(function ()use($request) {
            $user = $request->user();

            $data = $request->validated();
            $data['user_id'] = $user->id;

            $vet =Vet::create($data);
            return response()->json([
                'message'=>'Se a registrado el veterinario',
                'data'=> $vet
            ]);
            
        });

        return $response;
    }

    public function showVet(Request $request){
        $user = $request->user()->load('vet');

        if (!$user || !$user->vet) {
            return response()->json([
                'message'=>'No se encontro el usuario'
            ]);
        }
        return response()->json($user);
    }
}
