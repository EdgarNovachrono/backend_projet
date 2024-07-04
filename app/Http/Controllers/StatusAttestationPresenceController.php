<?php

namespace App\Http\Controllers;
use App\Models\attestationpresence;
use Illuminate\Http\Request;

class StatusAttestationPresenceController extends Controller
{
    public function addattestation(Request $request)
    {
    $data = $request->all();
    $user = attestationpresence::create($data); // Créer un nouvel utilisateur avec les données, y compris le token
    return response($user, 201);

    }
    
}
