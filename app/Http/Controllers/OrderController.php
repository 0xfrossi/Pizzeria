<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class OrderController extends Controller
{
    
    public function userOrders() {
        
       $data=new DataLayer();
       $listaOrdini=$data->listOrder( auth()->user()->id);
       return view('layouts.ordiniView')->with('listaOrdini',$listaOrdini);
    }
    
}
