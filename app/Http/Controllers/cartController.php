<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\DataLayer;
use App\Models\Pizza;
use App\Models\Drink;
use App\Models\Order;
class cartController extends Controller
{
  
   public function addToCartPizza(Request $request){
      
     $data = new DataLayer(); 
     $idP = $request->id;
     $pizza = $data ->findPizzaById($idP);
     $userId = auth()->user()->id; // or any string represents user identifier
     $start=true;
     foreach (  Cart::session($userId)->getContent() as $item) {
         if($item->name == $pizza->nome){
             $start=false;
             Cart::session($userId)->update($item->id, array(
            'quantity' => $request->quantity  //aggiungi $request unità a quelle già presenti
        ));
        } 
    }
     if($start){
    Cart::session($userId)->add(array(
    'id' => uniqid(), // inique row ID
    'name' =>  $pizza->nome ,
    'price' => $pizza->prezzo,
    'quantity' => $request->quantity,
 
    'associatedModel' => $pizza
     ),); 
    }
    
    return response()->json( ['stato' => 1, 'nomeP' => $pizza->nome, 'qty'=> $request->quantity]);
   }
   
    public function addToCartDrink(Request $request){
      
    $data = new DataLayer(); 
     $idD = $request->id;
     $drink = $data ->findDrinkById($idD);
     $userId = auth()->user()->id; // or any string represents user identifier
     $start=true;
     foreach (  Cart::session($userId)->getContent() as $item) {
         if($item->name == $drink->nome){
             $start=false;
             Cart::session($userId)->update($item->id, array(
            'quantity' => $request->quantity  //aggiungi $request unità a quelle già presenti
        ));
        } 
    }
     if($start){
    Cart::session($userId)->add(array(
    'id' => uniqid(), // inique row ID
    'name' =>  $drink->nome ,
    'price' => $drink->prezzo,
    'quantity' => $request->quantity,
    'associatedModel' => $drink
     ),); 
 
     } 
    
      return response()->json( ['stato' => 1, 'nomeD' => $drink->nome, 'qty'=> $request->quantity]); 
    }
    
    
    
    
   
   public function removeQnty() {
       
   }
   
   public function removeAll() {
   $userId = auth()->user()->id;    
   Cart::session($userId)->clear();
     return redirect()->back(); 
   }
   
   public function removeElement($id) {
      
      $userId = auth()->user()->id; 
      Cart::session($userId)->remove($id); 
    //  return response()->json( [ 'id'=> $id, 'stato' => 1]); 
      return redirect()->back(); 
   }
   
   
  
   public function getCart() {
      $user = auth()->user()->id;
      $cart = Cart::session($user)->getContent();
      $count= Cart::session($user)->getContent()->count();
      $totalQ= Cart::session($user)->getTotalQuantity();
      
       $countP=0;
      foreach( Cart::session($user)->getContent() as $item ){
          
      if( $item->associatedModel instanceof Pizza ){
       
          $countP++;
      }}
      
      $countPizza=$countP;       
      $totalCost =  Cart::session($user)->getTotal();
      
      //******* TIME FUNCTION **************
      
  /*     $startTime = strtotime('12'); 
        $endTime   = strtotime('24');
    $returnTimeFormat = 'G:i:s';

    $current   = time(); 
    $addTime   = strtotime('+'.'15 mins', $current); 
    $diff      = $addTime - $current;

    $times = array(); 
    while ($startTime < $endTime) { 
        $times[] = date($returnTimeFormat, $startTime); 
        $startTime += $diff; 
    } 
    $times[] = date($returnTimeFormat, $startTime); */
   
   
        return view('layouts.cart')->with('cart', $cart)->with('count',$count)->with('countPizza',$countPizza)->with('totalQ', $totalQ )->with('totalCost', $totalCost);
   }
   
   
   public function storeOrder(Request $request) {
       
        request()->validate([ 
            'indirizzo'=>'required | string | max:50 ',  
            'picker'=>'required '
                    ]);
       
      $myOrder = new Order(); 
      $userId= auth()->user()->id;
      $myOrder->user_id = $userId;
      $myOrder->prezzoFinale= Cart::session($userId)->getTotal();
      $myOrder->indirizzo= $request->input('indirizzo') ;
      $myOrder->ora= $request->input('dataOggi'). ' '. $request->input('picker');
      $myOrder->save();
      $cart = Cart::session($userId)->getContent();
               
      foreach ($cart as $item){
          if($item->associatedModel instanceof Pizza){
          
                     $myOrder->pizza()->attach($item->associatedModel->id,['quantita_pizza' => $item->quantity]);
          }          
           if($item->associatedModel instanceof Drink)  {
        
                    $myOrder->drink()->attach($item->associatedModel->id, ['quantita_drink' =>  $item->quantity]); 
          }
      } 
          Cart::session($userId)->clear();
          return Redirect()->route('home');
   }
    
   
   
}

