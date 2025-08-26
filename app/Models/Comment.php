<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function publication() {
        return $this->belongsTo(Publication::class);
    }

    public function replies() {
        return $this->hasMany(Reply::class);
    }
}
