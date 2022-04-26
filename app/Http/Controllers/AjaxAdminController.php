<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use App\Models\Pizza;
use App\Models\Drink;
use App\Models\Ingredient;
class AjaxAdminController extends Controller
{
    public function cambiaDisponibilita(Request $request) {
        
        $data = new DataLayer(); 
        $idP = $request->id;
        //$idP=$_GET["id"];
        $pizza = $data ->findPizzaById($idP);
        if($pizza->is_delete==1){
         $pizza->is_delete=0;
        $pizza->save();
        }
        else{
            $pizza->is_delete=1;
            $pizza->save();
        }
        //echo  $idP;
        return response()->json(['sta' => $pizza->is_delete,'id' => $idP]);
        
    }
    
     public function cambiaDisponibilitaDrink(Request $request) {
      
         $data = new DataLayer(); 
        $idP = $request->id;        
        $drink = $data ->findDrinkById($idP);
         
        if ($drink->is_delete == 1) {
            $drink->is_delete = 0;
            $drink->save();
        } else {       
            $drink->is_delete = 1;
             $drink->save();
        }
        return response()->json(['sta' => $drink->is_delete,'id' => $idP]);
    }
    
    public function cambiaDisponibilitaIng(Request $request) {
      
         $data = new DataLayer(); 
        $idP = $request->id;        
        $ing = $data ->findIngredientById($idP);
         
        if ($ing->is_delete == 1) {
            $ing->is_delete = 0;
            $ing->save();
        } else {       
            $ing->is_delete = 1;
             $ing->save();
        }
        return response()->json(['sta' => $ing->is_delete,'id' => $idP]);
    }
    
    
}
