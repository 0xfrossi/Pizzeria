@extends('layouts.master')

@section('titolo', 'FastyPizza | Le nostre pizze ')

@section('left_navbar')
 <li class="nav-item  mr-3">
        <a class="nav-link" href="{{ route('home') }}">Home
         
        </a>
      </li>
   
      <li class="nav-item  mr-3">
        <a class="nav-link" href="{{ route('pizza.index') }}">@lang('labels.nostrePizze')</a>
        
         
      </li>
      <li class="nav-item mr-3">
        <a class="nav-link" href="{{ route('contatti') }}">@lang('labels.contatti')</a>
      </li>
@endsection



@section('corpo')

<main class="container">
    
    <script>
$(document).ready( function () {
   var locale = <?php echo json_encode(App::currentLocale());?> ;
  
   if(locale === "en"){
    $('#tabOrdini').DataTable(  {columnDefs: [
          { orderable: false, targets: 2 },
           { orderable: false, targets: 3 },
          { orderable: false, targets: 4 } 
      ]} );
   
    } else {
    $('#tabOrdini').DataTable({ 
       columnDefs: [
          { orderable: false, targets: 2 },
           { orderable: false, targets: 3 },
          { orderable: false, targets: 4 } 
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
    }
    });
    
    </script>
    

   
  

  

    <div class="alert alert-dismissible alert-info"> 
        <strong>@lang('labels.nomeUtente')</strong> {{ Auth::user()->name }} <br>
        <strong> Email: </strong>{{ Auth::user()->email }}<br>
    </div>

 
    
 {{--   <div class="row container" style="margin-top: 10px; padding-bottom: 20px; " >
       
        <h6>  @lang('labels.nomeUtente') {{ Auth::user()->name }} <br> <br>
         Email: {{ Auth::user()->email }} </h6>
    </div>   --}}
    
  <header class="header-paragrafo" style="margin-top: 20px">
       
       <h1> @lang('labels.mieiOrdini') </h1>
       
    </header>
    
     @if( count($listaOrdini) == 0)
     <div class="row" id="spazioMess" style="margin-top: 40px; margin-bottom: 150px; padding-bottom: 150px">
      
            <div id="mess" class="alert  alert-info mx-auto lx-auto container" id="alert" >
             @lang('labels.noOrdine')
            </div>
        
        </div>
    @else
    <div class="row" style="margin-top: 20px">
            <div class="container table-responsive" style=" margin-bottom: 40px">
            <table class="table table-hover  " id="tabOrdini" style="width:100%; margin-bottom: 20px" >              
                                     

                <thead>
                    <tr>
                   
                       
                        <th scope="col"> 
                             <div class="form-row justify-content-center">
                            <div class="form-group mb-0">
                            @lang('labels.data')
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
                               
                        <th scope="col"> 
                             <div class="form-row justify-content-center">
                            <div class="form-group mb-0">
                            @lang('labels.pizze')
                             </div>
                              </div> 
                        </th>
                        <th scope="col"> 
                             <div class="form-row justify-content-center">
                            <div class="form-group mb-0">
                            @lang('labels.bere')
                             </div>
                              </div> 
                        </th>
                        <th scope="col"> 
                             <div class="form-row justify-content-center">
                            <div class="form-group mb-0">
                            @lang('labels.indirizzo')
                             </div>
                              </div> 
                        </th>
                                  
                    </tr>
                </thead>

                <tbody>
                    @foreach( $listaOrdini as $ordine )
                    <tr>
                        <td>
                             <div class="form-row justify-content-center">
                                 <div class="form-group mb-0" style="padding-top: 4px">
                                {{ $ordine->ora }}
                              </div>
                             </div>
                        </td>
                         <td>
                             <div class="form-row justify-content-center">
                                 <div class="form-group mb-0" style="padding-top: 4px">
                                {{ $ordine->prezzoFinale }} €
                              </div>
                             </div>
                        </td>
                         <td>
                             <div class="form-row justify-content-center">
                                 <div class="form-group mb-0" style="padding-top: 4px">
                               @foreach($ordine->pizza as $pizza)
                                
                               {{ $pizza->nome}}:  x{{$pizza->pivot->quantita_pizza  }}
                             
                               @endforeach
                              </div>
                             </div>
                        </td>
                          <td>
                             <div class="form-row justify-content-center">
                                 <div class="form-group mb-0" style="padding-top: 4px">
                                   
                               @foreach($ordine->drink as $drink)
                              
                               {{ $drink->nome}}: x{{$drink->pivot->quantita_drink }}
                               
                               
                               @endforeach
                              </div>
                             </div>
                        </td>
                          <td>
                             <div class="form-row justify-content-center">
                                 <div class="form-group mb-0" style="padding-top: 4px">
                               
                               {{  $ordine->indirizzo  }}
                              
                              </div>
                             </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
      </div>
    @endif
</main>
@endsection
    
     
