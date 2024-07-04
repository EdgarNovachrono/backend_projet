<?php

namespace App\Http\Controllers;
use App\Notifications\TokenNotification;
use Illuminate\Support\Str;
use App\Models\personnel;
use App\Models\auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\attestationpresence;
use App\Models\presencepersonnel;
use Illuminate\Support\Facades\Storage;


class PersonnelController extends Controller
{
    public function getattestion(Request $request,$id)
    {
        $attestation = attestationpresence::find($id);
if ($attestation->personnel) {
    $nomPersonnel = $attestation->personnel->nom;
     return response( $nomPersonnel, 201);
} else {
    return response()->json(['messgage'=> 'probleme inconnue'],404);
}
      
    }
    public function presence(Request $request,$id)
    {
        $attestation =presencepersonnel::find();
if ($attestation->personnel) {
    $nomPersonnel = $attestation->personnel->nom;
     return response( $nomPersonnel, 201);
} else {
    return response()->json(['messgage'=> 'probleme inconnue'],404);
}
      
    }
     //permet de recuperer les donnes dans la bd
     public function getusers()
     {
         return response()->json(personnel::all(),200);
     }
     public function count()
     {
        $userCount = personnel::count();
    return response()->json([ $userCount]);
     }
     public function getusersbyid($id)
     {
         $user=personnel::find($id);
         if(is_null($user))
         {
             return response()->json(['messgage'=> 'utilisateur introuvable'],404);
         }
         return response()->json(personnel::find($id),200);
     }
 //ajouter un utilisateurs
 public function addusers(Request $request)
 {
    //  $imageName=str::random(32).".".$e->image->getClientOriginalExtension();
    // 'image'=>$imageName
   // Créer un nouvel utilisateur avec les données, y compris le token
//  Storage::disk('public')->put($imageName,file_get_contents($e->image));
 
//    $data = $request->all();
//  $data['password'] = Hash::make($data['password']);
//  $user=personnel::create([$data]);
// return response($user,201);
// $token = Str::random(60); // Générer un token aléatoire de longueur 60
    
    // $data['token'] = $token; // Ajouter le token à vos données d'utilisateur
    $data = $request->all();
    $data['password']=Hash::make($data['password']);
    $user = personnel::create($data);
    return response($user, 201);

 }
  //modifier un utilisateur
  public function updateusers(Request $request,$id )
  {
     $user=personnel::find($id);
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
     $user=personnel::find($id);
     if(is_null($user))
     {
         return response()->json(['message'=> 'utilisateur introuvable'],404);
     }
     $user->delete();
      return response(null,204);
  }
  public function auth(Request $request)
  {
      $user=personnel::where('email', $request->email)->first();
      $password=personnel::where('password', $request->password)->first();
    //   if (!$user ) {
    //     return response()->json(['message'=>'utilisateur non trouve']);
    //   }
    if ($user && password_verify($request->password, $user->password)) {
        // L'utilisateur et le mot de passe sont corrects
        $token = Str::random(5);
        $hashedToken = bcrypt($token);
      $user->update(['token' => $token]);
      $user->update(['heurearrive'=> now()]);
      $user->notify(new TokenNotification($token));
    
        return response()->json(['message' => 'Un email de vérification a été envoyé']);
    } else {
        // L'utilisateur ou le mot de passe est incorrect
        return response()->json(['message' => 'Identifiants incorrects'], 401);
    }
      


  }
  public function doubleauth(Request $request)
  {
    $user = personnel::where('token', $request->token)->first();

    if (!$user) {
        return response()->json(['message' => 'Token invalide'], 401);
    }

    // Authentifier l'utilisateur et supprimer le token

    return response()->json(['message' => 'Authentification réussie']);
  }

}



