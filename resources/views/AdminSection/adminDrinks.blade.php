@extends('layouts.masterAdmin')

@section('titolo', 'FastyPizza | Gestione Bevande ')

@section('left_navbar')
 <li class="nav-item  mr-3">
        <a class="nav-link" href="{{ route('admin.pizzas.index') }}">Pizze
            
        </a>
      </li>
   
      <li class="nav-item   mr-3">
        <a class="nav-link" href="{{ route('admin.ingredients.index') }}">Ingredienti
      </a>
      </li>
      <li class="nav-item active mr-3">
        <a class="nav-link" href="{{ route('admin.drinks.index') }}">Bevande
         <span class="sr-only">(current)</span>
        </a>
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
       
       <h1> Gestisci Bevande </h1>
       
    </header>
    
    
     <div class="row"  style="margin-top: 30px">
      <!--  <div class="col-md-12 col-xl-12 " style="margin-top: 20px; margin-left: 717px; margin-bottom: 30px"> -->
      <div class="col-md-6 mr-auto">
             <a class="btn btn-primary" href="{{route('admin.drinks.create')}}"> Nuova bevanda</a>
        </div>
  {{--    <div class="col-md-6 ">
          <form class="form-inline justify-content-end" >
                    <input class="form-control mr-sm-2" type="text" placeholder="Search for name">
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
      </div> --}}
    
    </div>

    <div class="row" style="margin-top: 20px">
        <div class="container table-responsive ">
            <table class="table  table-hover  col-md-10 offset-md-1" style="  width: 100%;" id="tabAdminD">
               <col width='20%'>
                <col width='10%'>
                <col width='10%'>
                <col width='20%'>
                <col width='20%'>
                <col width='20%'>  
               
                <thead>
                    <tr>
                        <th>  <div class="form-row justify-content-center form-group mb-0">Nome </div></th>
                        <th>  <div class="form-row justify-content-center form-group mb-0">Prezzo </div> </th>
                         <th>  <div class="form-row justify-content-center form-group mb-0">Rimosso </div> </th>
                         <th>  </th> 
                        <th>  </th>
                        <th>  </th>
                    </tr>
                </thead>

                <tbody>
                      @if($drinksList->count()==0)
                <tr>
                    <td colspan="4">No products to display.</td>
                    
                </tr>
               @else
           {{--    <tr id="norow" style="display: none">
                    <td colspan="4">No products to display.</td>
                    
                </tr> --}}
                
                    @foreach($drinksList as $drink)
                    <tr id="row_{{$drink->id}}">
                        <td>   <div class="form-row justify-content-center form-group mb-0 padding-tab" > {{ $drink->nome }}  </div></td>
                         <td>   <div class="form-row justify-content-center form-group mb-0 padding-tab" > {{ $drink->prezzo}} € </div></td>
                         <td>   <div class="form-row justify-content-center form-group mb-0 padding-tab" id="del_{{$drink->id}}"> {{ $drink->is_delete}}  </div></td>
                         
                       <td> 
                           
                           <form action="{{ route('admin.drinks.edit', $drink ) }}" method="get" style="margin-bottom: -17px">
                    
                      <div class="form-row justify-content-center form-group mb-0">  
                                <button type="submit"  class="btn btn-info"> Modifica </button>
                      </div>
                         </form>
                            
                        </td>    
                          <td> 
                           
                           
                    
                      <div class="form-row justify-content-center form-group mb-0">  
                          <button type="button"  class="btn btn-secondary" onclick="changestato({{$drink->id}})">Soft del</button>
                      </div>
                        
                            
                        </td>    
                         
                          <td>  
                             
                             <form action="{{-- route('admin.drinks.destroy', $drink->id ) --}}" method="POST" style="margin-bottom: -17px">  
                             @csrf
                            
                              <div class="form-row justify-content-center form-group mb-0">                    
                              <button type="submit" onclick=" event.preventDefault(); if(confirm('Attenzione! eliminando l\'elemento si rischia di compromettere l\'integrità del database, confermi?')){deleteRow({{$drink->id}});}" class="btn btn-danger">Elimina</button>
                            
                              </div>
                             </form>
                        </td>
                      
                      
                    </tr>
                    @endforeach
                 @endif   
                </tbody>
            </table>
        </div>
    </div>
        
</main>


@endsection


<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
       
$(document).ready( function () {
    $('#tabAdminD').DataTable({
         columnDefs: [
          { orderable: false, targets: 2 },
          { orderable: false, targets: 3 },
          { orderable: false, targets: 4 },
          { orderable: false, targets: 5 },
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
    }, 3000 ); // 3 secs
         
} );


 function changestato(d_id){
        
      event.preventDefault();             
      var s=d_id;         
      $.get("drink-nascondi",{id: s}, mostra);
       
       function mostra(data){             
              if(data.sta == "1"){              
               $("#del_"+data.id).text("1");                       
               } else if(data.sta == "0"){
                 $("#del_"+data.id).text("0");          
               }  else{
                    window.alert("errore");
               }                    
            } 
 }
 
 function deleteRow(d_id){
      event.preventDefault(); 
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      
      $.ajax({
        url: 'drinks/'+d_id,
        data:{      
        _token: CSRF_TOKEN,
        //_method:'DELETE',
        },
        type: 'DELETE',
        success:  function getRisultato(risposta){
                        var table = $('#tabAdminD').DataTable();
                        if(risposta.esito==1 && risposta.numElem!=0){
                            table.row('#row_'+risposta.id).remove().draw( false );
                            
                              $('#alertDel').show();
                                setTimeout(function() {
                                    $('#alertDel').hide();} ,2000);  
                            }     
                        else if(risposta.esito==1 && rispsta.numElem==0){
                            table.row('#row_'+risposta.id).remove().draw( false );
                            
                              $('#alertDel').show();
                                setTimeout(function() {
                                    $('#alertDel').hide();} ,2000);  
                            }     
                            //$('#norow').show();     
                            else console.log("Errore");
                        }
                    
        });
     
   
 }

</script>