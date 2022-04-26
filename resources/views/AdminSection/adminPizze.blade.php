@extends('layouts.masterAdmin')

@section('titolo', 'FastyPizza | Area Riservata ')

@section('left_navbar')
 <li class="nav-item active mr-3">
        <a class="nav-link" href="{{ route('admin.pizzas.index') }}">Pizze
             <span class="sr-only">(current)</span>
        </a>
      </li>
   
      <li class="nav-item  mr-3">
        <a class="nav-link" href="  {{ route('admin.ingredients.index') }} ">Ingredienti</a>
        
         
      </li>
      <li class="nav-item mr-3">
        <a class="nav-link" href="{{ route('admin.drinks.index') }}">Bevande</a>
      </li>
@endsection



@section('corpo')

<main class="container" style="padding-bottom: 400px">
   
     @if(session('success'))
   <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
       <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert" id="alertSuccesso" >
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  <div>
   {{  session('success')}}
  </div>
 
</div>
           
    
       @endif
       
       <div class="alert alert-primary" style="display: none" id="alertDel">
           Elemento eliminato!
       </div>
    
      <header class="header-paragrafo">
       
       <h1> Gestisci pizze </h1>
       
    </header>
    
    
    <div class="row"  style="margin-top: 30px">
      <!--  <div class="col-md-12 col-xl-12 " style="margin-top: 20px; margin-left: 717px; margin-bottom: 30px"> -->
      <div class="col-md-6 mr-auto">
       <a class="btn btn-primary" href=" {{route('admin.pizzas.create')}} ">Aggiungi pizza</a> 
  </div>  
      
  {{--    <div class="col-md-6 ">
          <form class="form-inline justify-content-end" >
                    <input class="form-control " type="text" placeholder="Search for name or ingredient">
                        <button class="btn btn-secondary " type="submit">Search</button>
                </form>
      </div> --}}

    </div>

    <div class="row"style="margin-top: 20px" >
        <div class="container table-responsive" style="margin-top: 10px">
            <table class="table table-hover" style="width:100%" id="tabAdminPizze">
                <col width='15%'>
                <col width='25%'>
                <col width='5%'>
                <col width='5%'>
                <col width='15%'>
                <col width='20%'>
                <col width='15%'> 
                
                <thead>
                    <tr>
                        <th> Name  </th>
                        <th>  Ingredienti </th>
                        <th>  Price </th>
                         <th>  Rimosso </th>
                        <th>    </th>
                        <th>    </th>
                         <th>    </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($pizzaList as $pizza)
                    <tr id="row_{{$pizza->id}}">
                        <td> <div class="form-row justify-content-center form-group mb-0 padding-tab">{{ $pizza->nome }}</div> </td>
                        <td>
                               @foreach( $pizza->Ingredients as $ingre) 
                             {{ $ingre->nome }}
                            @endforeach
                          </td>
                          <td >  <div class="form-row justify-content-center form-group mb-0 padding-tab">   {{ $pizza->prezzo }} € </div>  </td>
                         
                          <td>  <div id="statoPizza_{{$pizza->id}}" class="form-row justify-content-center form-group mb-0 padding-tab"> {{ $pizza->is_delete }} </div> </td>
                          <td>   <div class="form-row justify-content-center form-group mb-0 ">  <a class="btn btn-info" href=  "  {{ route('admin.pizzas.edit', $pizza) }} "  >Modifica</a> </div> </td>
                        <td>
                               <div class="form-row justify-content-center form-group mb-0 ">                           
                                 <input type="hidden" id="pizzaID_{{$pizza->id}}" name="pizzaID" value= '{{ $pizza->id }}' type="number" >                                 
                                <button type="button" class="btn btn-secondary" href=  "  {{-- route('admin.pizzaDisp', $pizza) --}} " onclick="changestato({{$pizza->id}})"  >Soft del</button>  
                               </div>
                        </td>
                            
                         <td>     
                             <form action="{{ route('admin.pizzas.destroy', $pizza->id )}}" method="POST" class="form-row justify-content-center form-group mb-0">  
                              @csrf
                            
                              
                              <div class="form-row justify-content-center form-group mb-0">    
                                <button type="submit" onclick="event.preventDefault(); if(confirm('Attenzione! eliminando l\'elemento si rischia di compromettere l\'integrità del database, confermi?')){deleteRow({{$pizza->id}})}" class="btn btn-danger"> Elimina </button>
                              </div>
                             </form>
                             
                         </td>
                      
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        
</main>

@endsection


<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    
  function changestato(pizza_id){
        
      event.preventDefault();             
      var s=pizza_id;
      
     // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $.get("pizza-nascondi",{id: s}, mostra);
       
       function mostra(data){             
              if(data.sta == "1"){              
               $("#statoPizza_"+data.id).text("1");                       
               } else if(data.sta == "0"){
                 $("#statoPizza_"+data.id).text("0");          
               }  else{
                    window.alert(data.sta);
               }                    
            } 
            
     /*   $.ajax({
            url: "/modifica-pizza-disponibilita", // /modifica-pizza-disponibilita/{pizza}
            data: {
                id: s,               
               // _token: CSRF_TOKEN,
            },
            type: 'GET',
            dataType: 'json',
            
            success: function(data){
               
              if(data.sta == 1){              
               $("#statoPizza").text("1");                       
               } else if(data.sta == 0){
                 $("#statoPizza").text("0");          
               }  else{
                    window.alert('ERRORE');
               }  
         
          
            } 
               
        }); */
   }  
    
    
$(document).ready( function () {
    $('#tabAdminPizze').DataTable({
        
          columnDefs: [
          { orderable: false, targets: 1 },
          { orderable: false, targets: 3 },
          { orderable: false, targets: 4 },
          { orderable: false, targets: 5 },
           { orderable: false, targets: 6 }
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
        }
    });
    
     setTimeout(function(){
       $("#alertSuccesso").remove();
    }, 2000 ); 
           
   
} );


function deleteRow(p_id){
      event.preventDefault(); 
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      
      $.ajax({
        url: 'pizzas/'+p_id,
        data:{      
        _token: CSRF_TOKEN,
        //_method:'DELETE',
        },
        type: 'DELETE',
        success:  function getRisultato(risposta){
                        var table = $('#tabAdminPizze').DataTable();
                        if(risposta.esito==1 && risposta.numElem!=0){
                            table.row('#row_'+risposta.id).remove().draw( false );
                            
                             $('#alertDel').show();
                             setTimeout(function() {$('#alertDel').hide();} ,2000);  
                        }else if(risposta.esito==1 && rispsta.numElem==0){
                            table.row('#row_'+risposta.id).remove().draw( false );
                            $('#alertDel').show();
                            setTimeout(function() { $('#alertDel').hide();} ,2000);      
                            }else console.log("Errore");
                    }
        });
     
   
 }

</script>