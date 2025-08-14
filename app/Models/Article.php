<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function favoris() {
        return $this->belongsToMany(User::class,'favoris','user_id','article_id')->withTimestamps();
    }

    public function ratings() {
        return $this->hasMany(Rating::class, 'article_id');
            
    }
}
