<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;
    public $timestamps = false;
    
     public function Orders() {
        return $this->belongsToMany(Order::class);
        
    }
    
    public function Ingredients() {
        return $this->belongsToMany(Ingredient::class);
        
    }
}
