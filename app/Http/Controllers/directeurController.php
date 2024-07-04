<?php

namespace App\Http\Controllers;
use App\Models\directeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class directeurController extends Controller
{
    
    //  affiche les donnees
    public function getusers()
    {
        return response()->json(directeur::all(),200);
    }
     //ajouter un secretaire
    public function adddirecteur(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user=directeur::create($data);
        return response($user, 201);
    }
    public function auth(Request $request)
    {
        $user=directeur::where('email', $request->email)->first();
        $password=directeur::where('password', $request->password)->first();
      //   if (!$user ) {
      //     return response()->json(['message'=>'utilisateur non trouve']);
      //   }
      if ($user && password_verify($request->password, $user->password)) {
          // L'utilisateur et le mot de passe sont corrects
      
          return response()->json(['message' => 'identifiants trouve']);
      } else {
          // L'utilisateur ou le mot de passe est incorrect
          return response()->json(['message' => 'Identifiants incorrects'], 401);
      }
    }

}
