<?php

namespace App\Http\Controllers;
use App\Models\directeur;
use Illuminate\Http\Request;
use App\Models\personnel;
use App\Models\secretaire;
use App\Models\User;
use Illuminate\Support\Str;
use App\Notifications\TokenNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authgenreralController extends Controller
{
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    $user = Directeur::where('email', $credentials['email'])->first()
        ?? Secretaire::where('email', $credentials['email'])->first()
        ?? Personnel::where('email', $credentials['email'])->first();

    if ($user && Hash::check($credentials['password'], $user->password)) {
        Auth::login($user);

        if ($user instanceof Directeur) {
            return response()->json(['status' => 'directeur']);
        } elseif ($user instanceof Secretaire) {
            return response()->json(['status' => 'secretaire', 'id' => $user->id, 'nom' => $user->nom]);
        } elseif ($user instanceof Personnel) {
            $token = Str::random(5);
            $hashedToken = bcrypt($token);
            $user->update(['token' => $token, 'heurearrive' => now()]);
            $user->notify(new TokenNotification($token));

            return response()->json(['status' => 'personnel', 'id' => $user->id, 'nom' => $user->nom, 'status' => $user->status]);
        }
    } else {
        return response()->json(['message' => 'Identifiants incorrects'], 401);
    }
}

}
