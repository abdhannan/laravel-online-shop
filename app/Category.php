<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    // softdeletes
    use SoftDeletes;

    // relasi many to many dengan book
    public function books() {
        $this->belongsToMany('App\Book');
    }
}
