<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = ['nom','prenom','email','telephone','adresse','annonce_id'];

    public function annonce(){
        return $this->belongsTo(Annonce::class);
    }
}
