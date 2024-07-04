<?php

namespace App\Http\Controllers;
use App\Models\secretaire;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class secretaireController extends Controller
{
    //  affiche les donnees
    public function getusers()
    {
        return response()->json(secretaire::all(),200);
    }
     //ajouter un secretaire
    public function addsecretaire(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = secretaire::create($data);
        return response($user, 201);
    }
    public function auth(Request $request)
    {
        $user=secretaire::where('email', $request->email)->first();
        $password=secretaire::where('password', $request->password)->first();
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
