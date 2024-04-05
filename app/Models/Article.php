<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'description',
    ];
    public function category(){
        return $this->BelongsTo(Category::class,'category_id');
    }   

    public function images(){
        return $this->hasMany(ArticleImage::class);
    }
}
