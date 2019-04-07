<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{

    protected $table = 'shopping_list';

    

    public function products(){
        return $this->hasMany('App/Product');
    }

}
