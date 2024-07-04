<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class auth extends Model
{
    use HasFactory;
    use Notifiable;
    use HasFactory;
    public $timestamps=false;
    protected $fillable=['email','password'];
    protected $hidden = [
        'password',
    ];
}
