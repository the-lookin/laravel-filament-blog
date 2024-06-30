<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'preview_text',
        'detail_text',
        'preview_image',
        'detail_image',
        'tags',
        'category_id',
        'published_at',
        'active'
    ];

    protected $casts = [
        'tags' => 'json',
        'published_at' => 'datetime',
        'active' => 'boolean'
    ];

    public function category() {
        return $this->belongsTo(ArticleCategory::class);
    }

}
