@extends('layouts.master')

@section('titolo', 'FastyPizza | Area Riservata ')

@section('left_navbar')
 <li class="nav-item  mr-3">
        <a class="nav-link" href="{{ route('admin.pizzas.index') }}">Pizze
            
        </a>
      </li>
   
      <li class="nav-item  mr-3">
        <a class="nav-link" href="{{ route('admin.ingredients.index')}}">Ingredienti</a>
        
         
      </li>
      <li class="nav-item mr-3">
        <a class="nav-link" href="{{ route('admin.drinks.index')}}">Bevande</a>
      </li>
@endsection



@section('corpo')

<main class="container" style="padding-bottom: 200px">
    
      <header class="header-paragrafo">
       
       <h1> Modifica  </h1>
       
    </header>
    
    
    <div class="col-md-12"  style="margin-top: 30px">
      
   @if( isset($pizza->id))
   <form class="card card-body" name="pizza"  action="{{ route('admin.pizzas.update', $pizza) }}" method="POST">
    @method('PUT')
     @csrf

 @else
 <form class="card card-body" name="drink"  action="{{ route('admin.drinks.update', $drink) }}" method="POST">
    @method('PUT')
     @csrf
   @endif
   
       <div class="card card-body">
     <div class="form-group">
     <label class=" col-12 col-form-label " for="name" name='name'> Nome </label>
    <div class="col-10">
     @if( isset($pizza->id))
     <input class="form-control " type="text" value="{{ $pizza->nome }}" id="name" name='name'readonly>
       @error('name')
        <div class="invalid-feedback">
       {{ $message }}
      </div>
   @enderror
       @else 
       <input class="form-control " type="text" readonly="{{ $drink->nome }}"value="{{ $drink->nome }}" id="name" name='name'>
            @error('name')
          <div class="invalid-feedback">
             {{ $message }}
          </div>
   @enderror
       @endif
          <small id="emailHelp" class="form-text text-muted">Obbligatorio</small>
    </div> 
     </div> 
      
  
     
       <div class="form-group" style="margin-top: 30px">
     <label class=" col-12 col-form-label " for="prezzo"> Prezzo </label>
    <div class="col-10">
    
       @if(isset($pizza->id))
           <input class="form-control " type="number" id="prezzo" name="prezzo" value="{{ $pizza->prezzo }}">
             @error('prezzo')
             <div class="invalid-feedback">
              {{ $message }}
                </div>
   @enderror
       @else
         <input class="form-control " id="prezzo" name="prezzo" value="{{ $drink->prezzo }}">
             @error('prezzo')
              <div class="invalid-feedback">
                {{ $message }}
                </div>
                @enderror
        @endif
           <small id="emailHelp" class="form-text text-muted">Obbligatorio</small>
    </div> 
     </div>  
      
  
    <button type="submit"  class="btn btn-primary btn-lg btn-block" style="margin-top: 100px"> Conferma </button>
      </div>
   </form>
</div>      
        

</main>

