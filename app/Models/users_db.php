<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class users_db extends Model
{   use Notifiable;
    use HasFactory;
    public $timestamps=false;
    protected $fillable=['nom','email','password','token'];
    protected $hidden = [
        'password',
    ];
    public function routeNotificationForMail()
{
    return $this->email;
}

}
