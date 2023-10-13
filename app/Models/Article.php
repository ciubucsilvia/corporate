<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Article extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected $table = 'articles';

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'user_id',
        'text',
    ];

    protected $dates = [
        'created_at',
        'published_at'
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
        return $this->belongsTo(ArticleCategory::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
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

    public function getDate()
    {
        return Carbon::createFromDate($this->published_at)
            ->format('F d, Y');
    }

    public function getMonth()
    {
        return Carbon::createFromDate($this->published_at)
            ->format('M');
    }

    public function getDay()
    {
        return Carbon::createFromDate($this->published_at)
            ->format('d');
    }

    public function getLimitText()
    {
        return Str::limit($this->text, 40);
    }

    public function getCountComments()
    {
        return count($this->comments) ? count($this->comments) : 0;
    }

    public function getCommentsByParent()
    {
        return $this->comments->groupBy('parent_id');
    }
}
