@extends('layouts.master')

@section('titolo', 'FastyPizza | Le nostre pizze ')

@section('left_navbar')
 <li class="nav-item  mr-3">
        <a class="nav-link" href="{{ route('home') }}">Home
         
        </a>
      </li>
   
      <li class="nav-item active mr-3">
        <a class="nav-link" href="{{ route('pizza.index') }}">@lang('labels.nostrePizze')</a>
         <span class="sr-only">(current)</span>
         
      </li>
      <li class="nav-item mr-3">
        <a class="nav-link" href="{{ route('contatti') }}">@lang('labels.contatti')</a>
      </li>
@endsection



@section('corpo')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script type='text/javascript'>
$(document).ready( function () {
   var locale = <?php echo json_encode(App::currentLocale());?> ;
   console.log(locale);
   if(locale == "en"){
    $('#tabPizza').DataTable( { columnDefs: [
          
          { orderable: false, targets: 1 },
         
        ],  } );
    $('#tabDrink').DataTable(  );
    } else {
    $('#tabPizza').DataTable({ 
         columnDefs: [
          
          { orderable: false, targets: 1 },
         
        ],  
            
         language: {
        "sEmptyTable":     "Nessun dato presente nella tabella",
	"sInfo":           "Vista da _START_ a _END_ di _TOTAL_ elementi",
	"sInfoEmpty":      "Vista da 0 a 0 di 0 elementi",
	"sInfoFiltered":   "(filtrati da _MAX_ elementi totali)",
	"sInfoThousands":  ".",
	"sLengthMenu":     "Visualizza _MENU_ elementi",
	"sLoadingRecords": "Caricamento...",
	"sProcessing":     "Elaborazione...",
	"sSearch":         "Cerca:",
	"sZeroRecords":    "La ricerca non ha portato alcun risultato.",
	"oPaginate": {
		"sFirst":      "Inizio",
		"sPrevious":   "Precedente",
		"sNext":       "Successivo",
		"sLast":       "Fine"
	},
	"oAria": {
		"sSortAscending":  ": attiva per ordinare la colonna in ordine crescente",
		"sSortDescending": ": attiva per ordinare la colonna in ordine decrescente"
	}
         }});
    
    $('#tabDrink').DataTable({ 
        
            
         language: {
        "sEmptyTable":     "Nessun dato presente nella tabella",
	"sInfo":           "Vista da _START_ a _END_ di _TOTAL_ elementi",
	"sInfoEmpty":      "Vista da 0 a 0 di 0 elementi",
	"sInfoFiltered":   "(filtrati da _MAX_ elementi totali)",
	"sInfoThousands":  ".",
	"sLengthMenu":     "Visualizza _MENU_ elementi",
	"sLoadingRecords": "Caricamento...",
	"sProcessing":     "Elaborazione...",
	"sSearch":         "Cerca:",
	"sZeroRecords":    "La ricerca non ha portato alcun risultato.",
	"oPaginate": {
		"sFirst":      "Inizio",
		"sPrevious":   "Precedente",
		"sNext":       "Successivo",
		"sLast":       "Fine"
	},
	"oAria": {
		"sSortAscending":  ": attiva per ordinare la colonna in ordine crescente",
		"sSortDescending": ": attiva per ordinare la colonna in ordine decrescente"
	}
         }});
    }  //else
     
     });
     
 </script>
 
 
 
   <script type='text/javascript'>
         window.onload = function exampleFunction() {
            var count = <?php echo(json_encode($count)); ?>;
            if(count !=0){
                $('#rowDrink').removeClass('hidden-ele'); 
            }
        }   
</script>

    
    


<main class="container">

    <div class="row-col-lg-12">
        <div id="carouselExampleInterval" class="carousel slide slide-border" data-ride="carousel" >
  <div class="carousel-inner">
    <div class="carousel-item active" data-interval="4000">
        <img src="{{ url('/') }}/img/pizza1.jpg" class="d-block w-100 img-slide" alt="..." >
    </div>
    <div class="carousel-item" data-interval="4000">
        <img src="{{ url('/') }}/img/pizza2.jpg" class="d-block w-100 img-slide" alt="..." >
    </div>
    <div class="carousel-item" data-interval="4000">
        <img src="{{ url('/') }}/img/pizza3.jpg" class="d-block w-100 img-slide" alt="..." >
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
   
    
  </div>


    <header class="header-paragrafo">
       
       <h1> @lang('labels.nostrePizze') </h1>
       
    </header>
    
    
 {{--   <div class="col-md-12 col-xl-12 " style="margin-top: 20px; margin-bottom: 30px">
        <form class="form-inline justify-content-end">
                    <input class="form-control mr-sm-2" type="text" placeholder="@lang('labels.cercaPer')">
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">@lang('labels.cerca')</button>
                </form>
        </div>  --}}
        
    
        <div class="row" style="margin-top: 40px">
            <div id="mess" class="alert  alert-success mx-auto lx-auto container" id="alert" style="display: none">
             
            </div>
        </div>
    
        <div class="row" >
            <div class="container table-responsive" style="margin-top: 10px; margin-bottom: 40px">
            <table class="table table-hover  " id="tabPizza" style="width:100%; margin-bottom: 20px" >
                @auth
                <col width='20%'>
                <col width='30%'>
                <col width='15%'>
               
                <col width='35%'>
              {{--  <col width='10%'> --}}
                
                @else
                
                <col width='40%'>
                <col width='40%'>
                <col width='20%'>
               
                
                @endauth
                <thead>
                    <tr>
                   
                        <th scope="col"> 
                            <div class="form-row justify-content-center">
                            <div class="form-group mb-0">
                            @lang('labels.nome')
                            </div>
                              </div>   
                        </th>
                        <th scope="col"> 
                             <div class="form-row justify-content-center">
                            <div class="form-group mb-0">
                            @lang('labels.ingredienti')
                             </div>
                              </div> 
                            </th>
                        <th scope="col">
                             <div class="form-row justify-content-center">
                            <div class="form-group mb-0">
                            @lang('labels.prezzo')
                             </div>
                              </div> 
                            </th>
                    @auth            
                        <th scope="col">   </th>
                      
                    @endauth 
                    </tr>
                </thead>

                <tbody>
                    
               
                    @foreach($pizzaList as $pizza)
                    <tr>
                        <td>
                             <div class="form-row justify-content-center">
                                 <div class="form-group mb-0" style="padding-top: 4px">
                                {{ $pizza->nome }}
                              </div>
                             </div>
                          </td>
                        <td>
                             <div class="form-row justify-content-center">
                            <div class="form-group mb-0" style="padding-top: 4px">
                            @foreach($pizza->Ingredients as $ing )
                            {{ $ing->nome }}
                             @endforeach
                            </div>
                             </div>
                        </td>
                        <td class="justify-center ">
                             <div class="form-row justify-content-center">
                            <div class="form-group mb-0" style="padding-top: 4px">
                            {{ $pizza->prezzo }}   € 
                            </div>
                             </div>
                            </td>
                    @auth 
                      
                        <td>
                          <form type="hidden" id="addCartPizzaForm" method="POST">
                         
                     
                              <div class=" row">
                                    
                                  <div class="number-input col-md-3 offset-md-1 col-7 " style="padding-left: 0px;padding-right: 0px;" >
                                   
                                  <button onclick="event.preventDefault(); this.parentNode.querySelector('input[type=number]').stepDown()" ></button>
                                  <input class="quantity bg-light" min="1" max="10" id="quantityInput_{{$pizza->id}}" name="quantityInput" value="1"  type="number">
                                   <button onclick="event.preventDefault(); this.parentNode.querySelector('input[type=number]').stepUp(); " class="plus"></button>
                                </div>
                                  
                               <div class="col-md-6 offset-md-2 col-7 my-center">    
                                   <input type="hidden" id="pizzaID_{{$pizza->id}}" name="pizzaID" value= '{{ $pizza->id }}' type="number" >
                                    <button type="submit"  onclick=" addAjax( {{$pizza->id}} );" id="buttSub" class="btn btn-primary " > @lang('labels.aggiungi') </button>                        
                                </div>
                                  
                               </div>                
                             
                               
                         
                                  
                            </form>
                        </td>
                   
                 
                     @endauth
                    </tr>
                    @endforeach
                 
                </tbody>
            </table>
        </div>
        
    </div>
    
   @auth
    <div class="row" style="margin-top: 20px">
            <div id="messDrink" class="alert  alert-success mx-auto lx-auto container"  style="display: none">
             
            </div>
        </div>
   
       <div class=" hidden-ele row" id="rowDrink" >   
      <button type="submit" id="drinkButt" class="btn btn-primary btn-block" style="margin-top: 10px" >  @lang('labels.addDrinks') </button> 
          
            <div class="container table-responsive" style="display: none; margin-top: 30px " id="drinkDiv">  
               
                <table class="table  table-hover" id="tabDrink"style="width:100%; margin-bottom: 20px; margin-top: 50px; margin-right: 20px" >
               
                <col width='50%'>
                
                <col width='15%'>
               
                <col width='35%'>
                
                <thead>
                    <tr>
                        <th scope="col"> 
                            <div class="form-row justify-content-center">
                            <div class="form-group mb-0">
                            @lang('labels.nome')
                            </div>
                              </div>   
                        </th>
                     
                        <th scope="col">
                             <div class="form-row justify-content-center">
                            <div class="form-group mb-0">
                            @lang('labels.prezzo')
                             </div>
                              </div> 
                            </th>
                            <th>   </th>
                            
                    </tr>
                </thead>

                <tbody>
                    
               
                    @foreach($drinkList as $drink)
                    <tr>
                        <td>
                             <div class="form-row justify-content-center">
                                 <div class="form-group mb-0 " style="padding-top: 4px">
                                {{ $drink->nome }}
                              </div>
                             </div>
                          </td>
                                        
                        <td class="justify-center ">
                             <div class="form-row justify-content-center">
                            <div class="form-group mb-0" style="padding-top: 4px">
                            {{ $drink->prezzo }}   € 
                            </div>
                             </div>
                         </td>  
                
                    <td>
                             
                      
                                
                       <form type="hidden" id="addCartDrinkForm" method="POST">
                           <div class="row">
                                  
                               <div class="number-input col-md-3 offset-md-1 col-7" style="padding-left: 0px;padding-right: 0px;">
                                   
                                  <button onclick="event.preventDefault(); this.parentNode.querySelector('input[type=number]').stepDown()" ></button>
                                  <input class="quantity bg-light" min="1" max="10" id="quantityDrink_{{$drink->id}}" name="quantityDrink" value="1"  type="number">
                                   <button onclick="event.preventDefault(); this.parentNode.querySelector('input[type=number]').stepUp(); " class="plus"></button>
                                </div>
                                  
                                <div class="col-md-6 offset-md-2 col-7 my-center">      
                                    <input type="hidden" id="drinkID_{{$drink->id}}" name="drinkID" value= '{{ $drink->id }}' type="number" >
                                   <button type="submit" onclick="  addDrink( {{$drink->id}} );" id="buttDrink" class="btn btn-primary " >  @lang('labels.aggiungi') </button>  
                       
                               </div> 
                                
                              </div>   
                            </form> 
                        </td>
                       
                        
                        
                 </tr>
                  
                 @endforeach
                </tbody>
            </table>
        </div> 
        
    
                
    </div> 
   
   @endauth  

  
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $("#drinkButt").click(function () {
        $("#drinkDiv").toggle();
        });
  //  jQuery(document).ready(function($){
   //      $("#buttSub").click(function (e){
    function addAjax(pizza_id){
        
      event.preventDefault();             
      var pizzaId=  $("#pizzaID_" + pizza_id).val();
      var quantityP = $("#quantityInput_" + pizza_id).val();     
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
     
    //  var pizzaId =   document.getElementById('pizzaID').value;
    
      //  var quantityP = document.getElementById('quantityInput').value;
       
        $.ajax({
            url: "/Add-to-cart",
            data: {
                id: pizzaId,
                quantity: quantityP,
                _token: CSRF_TOKEN
            },
            type: 'POST',
            dataType: 'json',
            
            success: function(data){
               
              if(data.stato === 1){
              // console.log('ecco: ' + data.qty +' --- ' + data.nomeP); 
                let ele = document.getElementById('mess');
                ele.innerHTML = data.qty + ' ' + data.nomeP + ' Aggiunta!';
                $('#mess.alert').show();
                setTimeout(function() {
                $('#mess.alert').hide();} ,2000);                      
                $('#rowDrink').removeClass('hidden-ele');                          
               }              
                else {
                console.log('errore');         
               }                
            } 
        }); 
   }
 
   //-------------------
      function addDrink(drink_id){
   //  document.getElementById("addCartDrinkForm").submit();  
      event.preventDefault();      
      var drinkId=  $("#drinkID_" + drink_id).val();
      var quantityD = $("#quantityDrink_" + drink_id).val();  
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
        $.ajax({
            url: "/Add-to-cart-drink",
            data: {
                id: drinkId,
                quantity: quantityD,
                _token: CSRF_TOKEN
            },
            type: 'POST',
            dataType: 'json',
            
            success: function(data){
               
              if(data.stato === 1){
              
                let ele = document.getElementById('messDrink');
                ele.innerHTML = data.qty+' ' + data.nomeD + ' Aggiunta!';
                $('#messDrink.alert').show();
                setTimeout(function() {
                $('#messDrink.alert').hide();} ,2000); 
               }
                else {
                console.log('errore');
               }  
               
                }
            }); 
          }
 
    </script>




    
 </main>
  
    
    
    
  
    <!------- PAGINATION ------->
    <!--
    <div class="row justify-content-center" style="margin-top: 5px">
        
        <ul class="pagination pagination-sm " >
    <li class="page-item disabled" >
      <a class="page-link" href="#">&laquo;</a>
    </li>
    <li class="page-item active">
      <a class="page-link" href="#">1</a>
    </li>
    <li class="page-item" >
      <a class="page-link" href="#">2</a>
    </li>
    <li class="page-item" >
      <a class="page-link" href="#">3</a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">4</a>
    </li>
   
    <li class="page-item">
      <a class="page-link" href="#">&raquo;</a>
    </li>
  </ul>    
    </div>  -->




@endsection