<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class PortfolioCategory extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected $table = 'portfolio_categories';

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

    public function portfolios()
    {
        return $this->belongsTo(Portfolio::class);
    }

}
