<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Annonce extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'type',
        'city',
        'address',
        'map',
        'status',
        'price',
        'surface',
        'video',
        'bedroom',
        'bathroom',
        'category_id',
        'user_id',
        'is_valid',
        'is_premium'
    ];
    public function category(){
        return $this->BelongsTo(Category::class,'category_id');
    }  
    public function images(){
        return $this->hasMany(AnnonceImage::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function messages(){
        return $this->hasMany(Message::class);
    }
}
