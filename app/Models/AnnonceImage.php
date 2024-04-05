<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnonceImage extends Model
{
    use HasFactory;
    protected $fillable = ['path','annonce_id'];
    public function annonce(){
        return $this->belongsTo(Annonce::class);
    }
}
