<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'article_id',
        'text',
        'author',
        'email',
        'website',
        'user_id',
        'image',
        'parent_id'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getHash()
    {
        return isset($this->email) 
            ? md5($this->email) 
            : md5($this->user->email);
    }
}
