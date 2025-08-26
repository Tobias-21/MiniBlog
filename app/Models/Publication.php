<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function favoris() {
        return $this->belongsToMany(User::class,'favoris','user_id','publication_id')->withTimestamps();
    }

    public function ratings() {
        return $this->hasMany(Rating::class, 'publication_id');
            
    }

    public function categori(){
        return $this->belongsTo(Categori::class);
    }
}
