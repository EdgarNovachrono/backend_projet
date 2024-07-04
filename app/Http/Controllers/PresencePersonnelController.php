<?php

namespace App\Http\Controllers;
use App\Models\presencepersonnel;

use Illuminate\Http\Request;

class PresencePersonnelController extends Controller
{
    public function addpresence(Request $request)
    {
    $data = $request->all();
    
    $user = presencepersonnel::create($data); // Créer un nouvel utilisateur avec les données, y compris le token
    return response($user, 201);

    }
}
