<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;
use DB;
use App\Models\Order;
use App\Models\Drink;   
use App\Models\Ingredient;
use App\Models\Pizza;
/**
 * Description of DataLayer
 *
 * @author Francesco
 */
class DataLayer {
   
     
    //---- FIND ---------
    public function findPizzaById($id) {
        return Pizza::find($id);
    }
    
    public function findIngredientById($id) {
        return Ingredient::find($id);
    }
    
    public function findDrinkById($id) {
        return Drink::find($id);
    }
    
    
    
    //------ LIST --------
    public function listPizzas() {
     return Pizza::all()->sortBy('nome');
    // return Pizza::paginate(10);
    }
    
    public function listPizzasDisponibili() {
        return Pizza::all()->where('is_delete', 0)->sortBy('nome');;
    }
    
    public function allIngredients() {
       
        return Ingredient::all()->sortBy('nome');
    } 
    
    public function listIngDisponibili() {       
        return Ingredient::all()->where('is_delete', 0)->sortBy('nome');;
    }
    
    public function listIngredients() {
       
        return Ingredient::all()->sortBy('nome');
    }
    
    public function listDrinks() {
       // return Ingredient::all()->orderBy('nome','asc')->get();
        return Drink::all()->sortBy('nome');
    }
    
     public function listDrinksDisponibili() {
       // return Ingredient::all()->orderBy('nome','asc')->get();
        return Drink::all()->where('is_delete', 0)->sortBy('nome');;
    }
    
    
    public function listOrder($user) {
       // return Order::where('user_id', $user)->orderBy('ora','asc')->get();
        return Order::all()->where('user_id', $user);
    }
    
    //----------DELETE-------
    public function deletePizza($id) {
        
        $this->findPizzaById($id)->delete();
    }
    
    public function deleteIngredient($id) {
        
        $this->findIngredientById($id)->delete();
    }
    
    public function deleteDrink($id) {
        
        $this->findDrinkById($id)->delete();
    }
    
    //---- EDIT -----
    
    
    public function editPizzaPrice(Pizza $pizza, $price) {
        
       // $pizza= $this->findPizzaById($id);
        $pizza->prezzo = $price;
        $pizza->save();
    }
    
    public function editDrinkPrice(Drink $drink, $price) {
        
       // $drink= $this->findDrinkById($id);
        $drink->prezzo = $price;
       
        $drink->save();
        
    }
    
    //  ------ ADD --------
    
    public function addPizza($nome, $ingredients, $price) {
        
        $pizza = new Pizza();
        $pizza->nome = $nome;
        $pizza->is_delete=0;
        $pizza->save();
        
    }
    
    public function addIngredient($nome) {
        
        $ingredient= new Ingredient();
        $ingredient->nome = $nome;
        $ingredient->save();
        
    }
    
    public function addDrink($nome, $prezzo , $id) {
        $drink= new Drink();
        $drink->nome = $nome;
        $drink->prezzo = $prezzo;
        $drink->id = $id;
        $drink->is_delete=0;
        $drink->save();
        
    }
    
    public function addOrder($dataOra, $user, $indirizzo, $prezzoFinale, $ordinePizza, $ordineDrink ) {
        
        $order= new Order();
        $order->ora= $dataOra;
        $order->user_id=$user;
        $order->indirizzo= $indirizzo;
        $order->prezzoFinale=$prezzoFinale;
        $order->save();
        
    }
    
    
    public function validUser($username, $password) {
        $users = User::where('username',$username)->get(['password']);
        
        if(count($users) == 0)
        {
            return false;
        }
        
        return (md5($password) == ($users[0]->password));
    
    }
    
    public function addUser($username, $password, $email) {
        $user = new User();
        $user->username = $username;
        $user->password = md5($password);
        $user->email = $email;
        $user->save();
        
        }
    
    public function getUserID($username) {
        $users = User::where('username',$username)->get(['id']);
        return $users[0]->id; 
    }
    
    
     public function findPizzaByName($name) {
        $pizzas = Pizza::where('nome', $name)->get();
        
        if (count($pizzas) == 0) {
            return false;
        } else {
            return true;
        }
    }
    
    
      public function findDrinkByName($name) {
        $drinks = Drink::where('nome', $name)->get();
        
        if (count($drinks) == 0) {
            return false;
        } else {
            return true;
        }
    }
    
     public function findIngByName($name) {
        $ingredients = Ingredient::where('nome', $name)->get();
        
        if (count($ingredients) == 0) {
            return false;
        } else {
            return true;
        }
    }
    
    
    public function ingredientIsUsed($ingId){
        
     // $ing = DB::statement('SELECT * from ingredient_pizza WHERE ingredient_id =\''.$ingId ."'")->first();
       $ing = DB::table('ingredient_pizza')->where('ingredient_id', '=',$ingId )->first();
        if($ing === null){
            return false;
        } else return true;
    }
    
}
