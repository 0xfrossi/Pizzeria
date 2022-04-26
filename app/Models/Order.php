<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    
     public function pizza() {
        return $this->belongsToMany(Pizza::class)->withPivot(['quantita_pizza']);
        
    }
    public function drink() {
        return $this->belongsToMany(Drink::class)->withPivot(['quantita_drink']);
        
    }
    
    public function user() {
        return $this->belongsTo('App/User');
    }
    
}
