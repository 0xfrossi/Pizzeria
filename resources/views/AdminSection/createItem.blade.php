
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@extends('layouts.masterAdmin')


    
@section('titolo', 'FastyPizza | Area Riservata ')

@section('left_navbar')
 <li class="nav-item  mr-3">
        <a class="nav-link" href="{{ route('admin.pizzas.index') }}">Pizze
            
        </a>
      </li>
   
      <li class="nav-item  mr-3">
        <a class="nav-link" href="{{ route('admin.ingredients.index') }}">Ingredienti</a>
        
         
      </li>
      <li class="nav-item mr-3">
        <a class="nav-link" href="{{ route('admin.drinks.index') }}">Bevande</a>
      </li>
@endsection



@section('corpo')

<main class="container" style="padding-bottom: 200px">
    
      <header class="header-paragrafo">
       
       <h1> Aggiungi {{ $nuovo_elem }} </h1>
       
    </header>
    
    
    <div class="col-md-12"  style="margin-top: 30px">
      
    @if($nuovo_elem == 'Nuova pizza')    
    <form class="card card-body" name="pizza" method="post" action="{{ route('admin.pizzas.store') }} " id="pizzaForm">
   
    @elseif($nuovo_elem == 'Nuovo ingrediente')
   <form class="card card-body" name="ingredient" method="post" action="{{ route('admin.ingredients.store') }}">
   @else
   <form class="card card-body" name="drink" method="post" action="{{ route('admin.drinks.store') }}">
      @endif
      @csrf
       <div class="form-group">
     <label class=" col-12 col-form-label " for="name" name='name'> Nome </label>
    <div class="col-10">
     <input class="form-control " type="text" placeholder="..." id="name" name='name'>
 <small id="emailHelp" class="form-text text-muted">Obbligatorio</small>
   @error('name')
  <div class="my-error">
        {{ $message }} 
      </div>
   @enderror
   
    </div> 
     </div> 
      
   @if($nuovo_elem == 'Nuova pizza')
      <div class="form-group" style="margin-top: 30px">
        <label class="col-12 col-form-label" for="selezioneIngr"> Ingredienti </label>
        <div class="col-10">
          <select multiple name="selezioneIngr" id="selezioneIngr" class="filter-multi-select ">
           @php
           foreach ( $listaIngr as $ing ){

           echo  " <option value=' $ing->id ' > $ing->nome </option>" ;
            }
         @endphp
         
          </select>
        @error('selezioneIngr')
       <div class="my-error">
       {{ $message }}
      </div>
        @enderror
        </div>
      </div>
   
     @endif
   
     @if($nuovo_elem != 'Nuovo ingrediente' )
       <div class="form-group" style="margin-top: 30px">
     <label class=" col-12 col-form-label " for="prezzo"> Prezzo </label>
    <div class="col-10">
        <input class="form-control "  placeholder="..." id="prezzo" name='prezzo'>
 <small id="emailHelp" class="form-text text-muted">Obbligatorio</small>
   @error('prezzo')
       <div class="my-error">
       {{ $message }}
      </div>
        @enderror
    </div> 
    
     </div>  
      @endif
     
      @if($nuovo_elem == 'Nuova pizza')
      <button type="submit" id="pizzaBott" class="btn btn-primary btn-lg btn-block"   style="margin-top: 100px">Conferma</button>
     
     
      @else
     
     <button type="submit" class="btn btn-primary btn-lg btn-block"  " style="margin-top: 100px">Conferma</button> 
   @endif
   
  </form>     
  </div>
   
  <script>
  
     $('#pizzaBott').click((e) => {
           var b = true;
        
        const data= JSON.stringify(getJson(b),null,"");
       // var  num = data.replace(/\D/g,'');
       
      var jsonn= getJson(b);
        
          
         //jData = JSON.stringify(final);
        
       /* $.ajax({
        type: 'GET',
        url: 'pizzas',
        data: jData
        
        });  */
        
        
     /*  for(var j=0; j< final.length; j++){
             if(j === final.length-1){
                  arry.push(final[j]); 
                  break;
                } 
             arry.push(final[j]);
             arry.push(",");       
          } */
        
       $('<input>').attr({
          type: 'hidden',
          id: 'selezioneIngr',
          name: 'selezioneIngr',
          value:   jsonn[0].selezioneIngr 
          }).appendTo('#pizzaForm'); 
         });   
      //   console.log(num.length, num);
         var getJson = function (b) {
           var result = $.fn.filterMultiSelect.applied
               .map((e) => JSON.parse(e.getSelectedOptionsAsJson(b)));
         
           return result;
         } 
    </script> 
    

</main>