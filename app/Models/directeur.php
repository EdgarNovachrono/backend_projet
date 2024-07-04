<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class directeur extends Model  implements Authenticatable
{

    public function getAuthIdentifierName()
    {
        // Retourne le nom de la colonne utilisée pour l'identifiant d'authentification
        return 'id';
    }
    public function getAuthIdentifier()
    {
        // Retourne l'identifiant d'authentification de l'utilisateur
        return $this->id;
    }
    public function getAuthPassword()
    {
        // Retourne le mot de passe d'authentification de l'utilisateur
        return $this->password;
    }
    public function getRememberToken()
    {

    }
    public function getRememberTokenName()
    {

    }
    public function setRememberToken($value)
    {
        $this->rememberToken = $value;
    }

    use HasFactory;

    
    public $timestamps=false;
    protected $fillable=['nom','email','password'];
    protected $hidden = [
        'password',
    ];
}
