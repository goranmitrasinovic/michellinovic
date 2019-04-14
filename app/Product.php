<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'quantity', 'completed'
    ];

    public function shoppingLists(){
        return $this->belongsTo('App/ShoppingList');
    }

}
