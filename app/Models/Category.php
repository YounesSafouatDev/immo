<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','path'];
    
    public function articles(){
        return $this->hasMany(Article::class);
    }

    public function annonces(){
        return $this->hasMany(Annonce::class);
    }
}
