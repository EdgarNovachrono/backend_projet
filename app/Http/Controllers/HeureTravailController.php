<?php

namespace App\Http\Controllers;
use App\Models\heuredetravail;
use Illuminate\Http\Request;

class HeureTravailController extends Controller
{
    //
    public function addheure(Request $request )
    {
        $data = $request->all();
        $user = heuredetravail::create($data); // Créer un nouvel utilisateur avec les données, y compris le token
        return response($user, 201); 
    }
    public function updateusers(Request $request,$id )
  {
     $user=heuredetravail::find($id);
     if(is_null($user))
     {
         return response()->json(['messgage'=> 'utilisateur introuvable'],404);
     }
     $user->update($request->all());
      return response($user,201);
  }
}
