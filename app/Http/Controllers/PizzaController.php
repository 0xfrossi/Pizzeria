<?php

namespace App\Http\Controllers;
use Cart;
use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Auth;

class PizzaController extends Controller
{
    public function getPizze() {
         $dl= new DataLayer();  
       $pizzaList= $dl->listPizzasDisponibili(); 
       $drinkList= $dl->listDrinksDisponibili();
      if(Auth::check()){
       $uid=auth()->user()->id;
        $count = Cart::session($uid)->getTotalQuantity(); 
      } else {
          $count = 0;
      }



        return view('layouts.nostrePizze')->with('pizzaList',$pizzaList)->with('drinkList',$drinkList)->with('count',$count);
        
    
    }
}
