<?php

namespace App\Http\Controllers;
use App\Notifications\TokenNotification;
use Illuminate\Http\Request;
use App\Models\users_db;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class users_dbscontroller extends Controller
{
    //permet de recuperer les donnes dans la bd
    public function getusers()
    {
        return response()->json(users_db::all(),200);
    }
    public function getusersbyid($id)
    {
        $user=users_db::find($id);
        if(is_null($user))
        {
            return response()->json(['messgage'=> 'utilisateur introuvable'],404);
        }
        return response()->json(users_db::find($id),200);
    }
    //ajouter un utilisateurs
    public function addusers(Request $request)
    {
        $token = Str::random(60); // Générer un token aléatoire de longueur 60
    $data = $request->all();
    $data['token'] = $token; // Ajouter le token à vos données d'utilisateur
    $data['password'] = Hash::make($data['password']);
    $user = users_db::create($data); // Créer un nouvel utilisateur avec les données, y compris le token
    return response($user, 201);
    }
     //modifier un utilisateur
     public function updateusers(Request $request,$id )
     {
        $user=users_db::find($id);
        if(is_null($user))
        {
            return response()->json(['messgage'=> 'utilisateur introuvable'],404);
        }
        $user->update($request->all());
         return response($user,201);
     }
      //mise à jours un utilisateur
      public function deleteusers(Request $request,$id )
      {
         $user=users_db::find($id);
         if(is_null($user))
         {
             return response()->json(['message'=> 'utilisateur introuvable'],404);
         }
         $user->delete();
          return response(null,204);
      }
      public function auth(Request $request)
      {
          $user= users_db::where('email', $request->email)->first();
          $password=users_db::where('password', $request->password)->first();
        //   if (!$user ) {
        //     return response()->json(['message'=>'utilisateur non trouve']);
        //   }
        if ($user && password_verify($request->password, $user->password)) {
            // L'utilisateur et le mot de passe sont corrects
            $token = Str::random(60);
          $user->update(['token' => $token]);
          $user->notify(new TokenNotification($token));
           
        
            return response()->json(['message' => 'Un email de vérification a été envoyé']);
        } else {
            // L'utilisateur ou le mot de passe est incorrect
            return response()->json(['message' => 'Identifiants incorrects'], 401);
        }
          
  

      }
      public function doubleauth(Request $request)
      {
        $user = users_db::where('token', $request->token)->first();

        if (!$user) {
            return response()->json(['message' => 'Token invalide'], 401);
        }
    
        // Authentifier l'utilisateur et supprimer le token
    
        return response()->json(['message' => 'Authentification réussie']);
      }
}

