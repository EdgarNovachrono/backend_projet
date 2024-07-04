<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class presencepersonnel extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=['id','date','heurearrive','heurefin','personnel_id','status'];
    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }
}
