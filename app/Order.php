<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    // artinya order dimiliki users
    public function user() {
        return $this->belongsTo('App\User');
    }

    // many to many Order dengan book
    // artinya Order bisa memiliki banyak buku
    // dan buku bisa memiliki banyak order
    public function books(){
        return $this->belongsToMany('App\Book')->withPivot('quantity');
    }

    // get total quantity
    public function getTotalQuantityAttribute(){
        $total_quantity = 0;

        foreach ($this->books as $book) {
            $total_quantity = $total_quantity + $book->pivot->quantity;
        }

        return $total_quantity;
    }
}
