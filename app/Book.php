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

    // relasi dengan Orders
    public function orders(){
        return $this->belongsToMany('App\Order');
    }
}
