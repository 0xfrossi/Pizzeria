<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
   
    public function getPizze() {
        
      $dl= new DataLayer();  
       $pizzaList= $dl->listPizzas(); 
        return view('AdminSection.adminPizze')->with('pizzaList',$pizzaList);
    }
    
    public function getIngredients() {
        
      $dl= new DataLayer();  
       $ingredientList= $dl->listIngredients(); 
        return view('AdminSection.adminIngredienti')->with('ingredientList',$ingredientList);
    }
    
    public function addPizza() {
        $pizza= 'Nuova pizza';
        $dl= new DataLayer(); 
         $ingredientList= $dl->allIngredients();
        return view('AdminSection.createItem')->with('nuovo_elem', $pizza);
    }
    
    public function addIng() {
        $ing= 'Nuovo ingrediente';
        return view('AdminSection.createItem')->with('nuovo_elem', $ing);
    }
    
     public function addBevanda() {
        $ing= 'nuova Bevanda';
        return view('AdminSection.createItem')->with('nuovo_elem', $ing);
    }
    
    
    public function storeIngredient($request) {
        
        
    }
    
   
    
    function check(Request $request){
        $request->validate([
            'email'=> 'required|email|exists:admins,email',
            'password' => 'required|min:5|max:30'
        ],
        ['email.exists'=> 'This email is not exist']); 
    
      $creds = $request->only('email','password'); 
      if(Auth::guard('admin')->attempt($creds)){
          return redirect()->route('admin.pizzas.index');
      }
      else { return redirect()->route('admin.login')->with('Fail','Incorrect credentials'); }
    }
    
    function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('home');
    }
}
