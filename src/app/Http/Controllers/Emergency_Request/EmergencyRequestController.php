<?php

namespace App\Http\Controllers\Emergency_Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmergencyRequest\StoreRequest;
use App\Models\EmergencyRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class EmergencyRequestController extends Controller
{
    //
    public function store(StoreRequest $request): JsonResponse
    {
        $user = $request->user();
        $data = $request->validated();
        $data['client_id'] = $user->id;
        $emergency = EmergencyRequest::create($data);


        return response()->json([
            'message' => 'Emergencia creada',
            'data' => $emergency
        ]);
    }


    public function update(Request $request, $id): JsonResponse
    {
        $user = $request->user();

        // Opcional: Validar rol
        if ($user->role_id !== 2) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $emergency = EmergencyRequest::findOrFail($id);
        $emergency->activar($user->id); // nombre correcto del método

        return response()->json([
            'message' => 'Solicitud aceptada',
            'data' => $emergency
        ]);
    }

    public function myRequest(Request $request): JsonResponse{
        $user = $request->user();

        if ($user->role_id == 2) {
            // Veterinario: solicitudes asignadas a él
            $data = EmergencyRequest::where('assigned_vet_id', $user->id)->get();
        } elseif ($user->role_id == 1) {
            // Cliente: solicitudes que él creó
            $data = EmergencyRequest::where('client_id', $user->id)->get();
        }

        return response()->json([
            'menssage' => 'Solicitud optenida correcta mente',
            'data' => $data
        ]);


    }
}
