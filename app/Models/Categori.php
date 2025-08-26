<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categori extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];
    
    public function publications() {
        return $this->hasMany(Publication::class);
    }
}
