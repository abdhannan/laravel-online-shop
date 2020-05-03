<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    // Gunakan softdeletes
    use SoftDeletes;

    // membuat relasi many to many dengan category
    public function categories() {
        return $this->belongsToMany('App\Category');
    }
}
