<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function article() {
        return $this->belongsTo(Article::class);
    }

    public function replies() {
        return $this->hasMany(Reply::class);
    }
}
