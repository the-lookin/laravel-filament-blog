<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function articles() {
        return $this->hasMany(Article::class, 'category_id');
    }

    public function getArticlesCountAttribute() {
        return $this->articles()->count();
    }
}
