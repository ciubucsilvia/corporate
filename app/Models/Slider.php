<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sliders';

    protected $fillable = [
        'title',
        'description',
    ];

    public function getMiniImage()
    {
        $image = json_decode($this->image);
        if(isset($image)) {
            return $image->mini;    
        }
        return false;
    }
}
