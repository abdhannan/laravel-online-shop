<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // membuat relasi many to many dengan category
    public function categories() {
        return $this->belongsToMany('App\Category');
    }
}
