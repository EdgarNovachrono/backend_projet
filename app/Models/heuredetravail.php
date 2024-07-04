<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class heuredetravail extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=['heuredebut','heuretolerable','heurefin'];
}
