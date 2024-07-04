<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
class personnel extends Model implements Authenticatable
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
    use Notifiable;
    use HasFactory;
    public $timestamps=false;
    protected $fillable=['nom','prenom','email','password','departement','poste_occupe','date_embauche','sexe','token','heurearrive'];
    protected $hidden = [
        'password',
        

    ];
    public function attestations()
        {
            return $this->hasMany(attestationpresence::class);
        }
        public function presence()
        {
            return $this->hasMany(presencepersonnel::class);
        }
}
