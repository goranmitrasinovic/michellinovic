<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShoppingList;

class ShoppingListController extends Controller
{
    public function index()
    {
        $shoppingLists = ShoppingList::all();
        return $shoppingLists;
    }
}
