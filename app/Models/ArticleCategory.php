<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ArticleCategory extends Model
{
    use HasFactory, HasSlug, SoftDeletes;

    protected $table = 'article_categories';

    protected $fillable = [
        'title',
        'description',
        'slug'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function articles()
    {
        return $this->hasMany(Portfolio::class, 'category_id', 'id');
    }
}
