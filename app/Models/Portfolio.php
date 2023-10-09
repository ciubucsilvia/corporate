<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected $table = 'portfolios';

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'content',
    ];
    
    protected $dates = [
        'created_at'
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

    public function category()
    {
        return $this->belongsTo(PortfolioCategory::class, 'category_id', 'id');
    }

    public function getMiniImage()
    {
        return $this->getImage('mini');
    }
    
    public function getMaxImage()
    {
        return $this->getImage('max');
    }

    public function getImage($name)
    {
        $image = json_decode($this->image);
        if(isset($image)) {
            return $image->$name;    
        }
        return false;
    }

    public function getLimitText()
    {
        return Str::limit($this->content, 150);
    }

    public function getYear()
    {   
        return $this->created_at->format('Y');
    }
}
