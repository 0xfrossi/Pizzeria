<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use App\Models\Pizza;

class frontController extends Controller
{
 /*   public function getHome() {
        
        if($request->sesssion()->has('logged')){
           return view('index')->with('logged',true)->with('loggedName', $_SESSION['loggedName']); 
        }
    } */
    
    public function getHome() {
            return view('layouts.index'); 
    }
    
    
    public function getContatti() {
        
        session_start();
        
        if(isset($_SESSION['logged'])) {
            return view('layouts.contatti')->with('logged',true)->with('loggedName', $_SESSION['loggedName']);
        } else {
            return view('layouts.contatti')->with('logged',false);
        }
    
    }
    
    
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
        return response()->json(['sta' => $pizza->is_delete]);
    }
}
