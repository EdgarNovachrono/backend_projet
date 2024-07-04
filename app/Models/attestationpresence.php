<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attestationpresence extends Model
{
    use HasFactory;
    public $timestamps=false;

    protected $fillable=['motif','preuve','date','heure','status','personnel_id'];
    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }
}
