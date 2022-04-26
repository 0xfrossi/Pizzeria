

@extends('layouts.master')
@section('titolo', ' FastyPizza | Ordine ')


@section('left_navbar')
 <li class="nav-item  mr-3">
        <a class="nav-link" href="{{ route('home') }}">Home
         
        </a>
      </li>
   
      <li class="nav-item mr-3">
        <a class="nav-link" href="{{ route('pizza.index') }}"> @lang('labels.nostrePizze') </a>
      </li>
      <li class="nav-item   mr-3">
        <a class="nav-link" href="{{ route('contatti') }}"> @lang('labels.contatti') </a>
       
      </li>
@endsection



@section('corpo')
<div class="container" style="padding-bottom: 300px">
     <header class="header-paragrafo">
        <h3> @lang('labels.ordine')</h3>
     </header>
      
    <div class="row" id="spazioMess" style="margin-top: 40px">
        @if( $count == 0)
            <div id="mess" class="alert  alert-info mx-auto lx-auto container" id="alert" >
             @lang('labels.carrelloVuoto')
            </div>
        @endif
        </div>
        @if( $count != 0) 
         <div class="row">
             <div class="col-md-12 col-12 ">
                <a href="{{route('eliminaCart')}}"> @lang('labels.eliminaCarrello') </a>
             </div>
         </div>
        <div class="row">
           
          <div class="col-md-7 ">
              <table class="table  table-hover  " style="width:100%; margin-bottom: 100px" id="tableItems">
               
                <col width='40%'>
                <col width='20%'>
                <col width='20%'>
             
                <col width='20%'>
         
                <thead>
                    <tr>
                        <th scope="col">  @lang('labels.nome') </th>
                        <th scope="col">  @lang('labels.quantita') </th>
                        <th scope="col">  @lang('labels.prezzo') </th>
                    
                        <th> {{-- rimuovi --}} </th>                 
                    </tr>
                </thead>
  
                <tbody>
                
                        @foreach( $cart as $item)
                            @if( $item->associatedModel instanceof app\Models\Pizza )
                <tr id="rowID_{{$item->id}}">
                        <td style=" padding-top: 20px">{{ $item->name }}</td>
                        <td style="padding-left: 30px; padding-top: 20px">{{ $item->quantity }}</td> 
                        <td style="padding-left: 30px; padding-top: 20px">{{ $item->price }} €</td>
                    
                           <td> 
                               <form type="hidden" id="removeItem" method="post" action="{{route('removeElem',['id'=> $item->id])}}">
                                 @csrf
                                                                 
                                   <input type="hidden" id="pizzaID_{{$item->id}}"  value= '{{$item->id}}' >
                                                             
                                   <button type="submit"  id="sub_{{$item->id}}"  class="btn btn-danger"  > <img src="{{ url('/') }}/img/delete.png"> </button> 
                                 
                               </form>        
                           </td> 
                   </tr>      
                   @endif     
                  @endforeach 
                  <tr>
                      <td style="color: #e95420; padding-bottom: -7px"> Bevande: </td>
                      <td>    </td>
                      <td>    </td>
                       <td>    </td>
                  </tr>
                  {{-- ---------------------------- DRINK ROWS ------------------------- --}}
                  
                          @foreach( $cart as $item)
                            @if( $item->associatedModel instanceof app\Models\Drink )
                <tr id="rowID_{{$item->id}}">
                        <td style=" padding-top: 20px">{{ $item->name }}</td>
                        <td style="padding-left: 30px; padding-top: 20px">{{ $item->quantity }}</td> 
                        <td style="padding-left: 30px; padding-top: 20px">{{ $item->price }} €</td>
                  
                           <td> 
                               <form type="hidden" id="removeItem" method="post" action="{{route('removeElem',['id'=> $item->id])}}">
                                 @csrf
                                   
                               
                                   <input type="hidden" id="pizzaID_{{$item->id}}"  value= '{{$item->id}}' >
                                                             
                                   <button type="submit"  id="sub_{{$item->id}}"  class="btn btn-danger"  > <img src="{{ url('/') }}/img/delete.png"> </button> 
                                 
                               </form>        
                           </td> 
                   </tr>      
                   @endif     
                  @endforeach    
                   
                </tbody>     
            </table>
           
          </div>
           <div class="col-md-3 offset-md-2  align-self-end justify-center">
                                                              
               <div class="col text-center " >   <h5 style="margin-bottom:  20px"> @lang('labels.totaleprov') <br>   ( {{ $totalQ }}  @lang('labels.articoli')): <b> {{ $totalCost }} €</b> </h5>     </div>       
           @if( $countPizza > 0)  
               <div class="col text-center ">     <button type="submit"  class="btn btn-primary" id="conferma" style="margin-bottom: 10px"
                            onclick=" var r= window.confirm('Confermi l\'ordine?'); if(r){ if(checkNormalOrder()){ alert('Ordine completato');}  }"> @lang('labels.pagaCasa') </button>    </div>         
                 
               <div class="col" id="paypal-button-container" >   </div>
             @endif    
           </div> 
   </div>          
        @endif
      
     
           @if( $count != 0)   
            <header class="header-paragrafo"> </header>
           @endif 
           
         
       @if( $countPizza > 0)
  
   <form method="post" id="datiOrdine" action="{{route('storeOrder')}}">
       
   <div class="row" style="margin-top: 20px">
      <div class="col-md-6" style="margin-top: 10px">

    
       @csrf
      <fieldset>
        
       <legend>@lang('labels.dataOrdine')  </legend>
        <div class="form-group "> 
            <label for="dataOggi" class=" form-label mt-4">@lang('labels.data')</label>
            <input type="text" readonly="{{date('d/m/Y')}}" class="form-control" id=dataOggiView" value="{{date('d/m/Y')}}" name="dataOggi">
            <input type="hidden" readonly="{{date('d/m/Y')}}"  id=dataOggi" value="{{date('Y-m-d')}}" name="dataOggi">
       </div>
    
          
    <div class="form-group">
      <label for="picker" class="form-label mt-4">@lang('labels.ora')</label> 
      <input type="time" class="timepicker" id="picker" name="picker">
       
         <div class="my-error" id="erroreTempo" style="display: none;">
        @lang('labels.errorOra')
      </div>
       
   
    </div>
    
    <div class="form-group">
      <label  for="indirizzo" class="form-label mt-4">@lang('labels.indirizzo')</label>
      <input  class="form-control" id="indirizzo" placeholder="Bs via roma n 1 " name="indirizzo">  
      
     
      <div class="my-error" id="erroreCasa" style="display: none;">
      @lang('labels.errorCasa')
      </div>
          
        <div class="my-error" id="erroreInput">
       
      </div>  
    </div>
    
 
  </fieldset>
    
    
          
   </div>    
   
   </div>   
   
    </form>

</div> 
   @endif
         
 </div>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
 <script src="{{ url('/') }}/js/qcTimepicker.min.js" type="text/javascript"></script>
 
    <script>
    
    function checkNormalOrder(){
        var go=true;
        event.preventDefault();
        $('#picker').val();
        $('#indirizzo').val();
        if($('#picker').val()==""){
           $('#erroreTempo').show();
           $('#picker').focus();
            go=false;
        }
        if($('#indirizzo').val()==""){
           $('#erroreCasa').show();
           $('#indirizzo').focus();
            go=false;
        }else if(go){
             $("#datiOrdine").submit();
             return true;
        }else return false;
    }
    
      function  checkPayPal(){
          var procedi=true;
          var isValid = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test($('#picker').val());
          console.log("Time: ",$('#picker').val() );
           console.log("isvalid: ",isValid );
          if($('#indirizzo').val()==""){
              procedi=false;
          } 
          if(!isValid){
              procedi=false;
          }
          if(procedi==true){
              return true
          }else{
             
                 return false
          }            
        
      }  
      
     $("#drinkButt").click(function () {
    $("#drinkDiv").toggle();
     });
     
     function sendOrder(){
        
         $("#datiOrdine").submit();
        // alert('Ordine completato');
     }
   $(document).ready(function() {  
     var today = new Date();
     $('.timepicker').qcTimepicker({

    // additional CSS classes
    classes: 'form-control',
    // time format
    format: 'H:mm',

    // min/max time
    minTime: today.getHours()>11?today.getHours().toString()+':'+today.getMinutes():' ',
    maxTime: '23:00:00',

    // step size in ms
    step: 600,
  
    placeholder: ' '
  
});
   }); 
     
   </script>
    
 <script src="https://www.paypal.com/sdk/js?client-id=AakEIW2khOJ9a8p1I-TtJPCtMuV1MOcXxmxwcbkWmO5DFDQWjLn2XI1n_x4w_kNE9a0Xd5Gaag9cb11n&disable-funding=credit,card,mybank,sofort&currency=EUR"></script>
 <script>
  var totale = <?php echo json_encode($totalCost);?> ;
  paypal.Buttons({
      
    

     onClick: function(data, actions) {

      // Disable the buttons
      //actions.disable();
          
          if (checkPayPal()) {

            return actions.resolve();

          } else {
           $('#erroreInput').html("Completa tutti i campi in modo corretto!");
          
           return actions.reject();
            

          }

       
    },

  
    createOrder: function(data, actions) {
      // Set up the transaction
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: totale
          }
        }]
      });
    },
      onApprove: function(data, actions) {

    // This function captures the funds from the transaction.
        // $('#datiOrdine').submit();
    return actions.order.capture().then(function(details) {

      // This function shows a transaction success message to your buyer.
        alert('Transazione completata');
         $('#datiOrdine').submit();
     

    });

  }
  }).render('#paypal-button-container');
</script>
@endsection