<!DOCTYPE html>

<html lang="it">
    <head>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <meta name="csrf-token" content="{{ csrf_token() }}">
   <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('titolo')</title>

    <!-- Bootstrap -->
<link href="{{ url('/') }}/css/bootstrap.min.css" rel="stylesheet"> 
  <link href="{{ url('/') }}/css/style.css" rel="stylesheet"> 
   <link rel="stylesheet" href="{{ url('/') }}/css/filter_multi_select.css">
<!-- <script src="js/bootstrap.min.js"></script> --> 
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"  defer> </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="{{ asset('js/filter-multi-select-bundle.min.js') }}" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.6/bootstrap-growl.js" integrity="sha512-+i6fcc1vA5OwH3UNZrFDPLZVLye7fifWOt7uUDHqGs9FbPJMeVXKIJzHYSQWbZowmCKDZUse4wGlVz96n9sJ0w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>   
    
    </head>

 <body> 


<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary " >
       <div class="container "> 
 
           <a class="navbar-brand mr-4" href="#"><img src=" {{ url('/') }}/img/pizzaLogo1.jpg" style="width: 68px; height: 30px"> </a>
  <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-collapse collapse" id="navbarColor01" style="">
    <ul class="navbar-nav mr-auto">
      @yield('left_navbar')
  </ul> 
     
   <ul class="  navbar-nav ml-auto">
        @auth
      <!-- LOGGED MODE --->  
      <li class="nav-item "><a style="padding-top: 8px"class="nav-link" href="{{ route('cart') }}"> <img src=" {{ url('/') }}/img/cart.png" style="width: 25px; height: 25px"/>  </a> </li>
    
         <li class="nav-item dropdown"  >
        <a style="padding-top: 6px" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><b>  {{Auth::user()->name}} </b></a>
        <div class="dropdown-menu">
        {{--  <a class="dropdown-item" href="#">Profilo</a> --}}
          <a class="dropdown-item" href="{{ route('mieiOrdini') }}">Prenotazioni</a>
         
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> @lang('labels.esci') </a>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
           </form>
        </div>
      </li> 
      <!---->
   @else   
      <li class="nav-item"><a class="nav-link" href="{{ route('register') }}  "> @lang('labels.registrati') </a> </li> 
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><b> @lang('labels.accedi') </b></a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href=" {{ route('login') }} ">@lang('labels.areaUtente')</a>
          <a class="dropdown-item" href="{{ route('admin.login') }}">@lang('labels.areaAdmin')</a> 
           </div>
      </li> 
    @endauth
   {{--   <li class="nav-item "><a class="nav-link" href="#"> <img src=" {{ url('/') }}/img/cart.png" style="width: 25px; height: 25px"/>  </a> </li> --}}
     <li class="nav-item "><a class="nav-link" href="{{ route('setLang', ['lang' => 'it']) }}"> <img src=" {{ url('/') }}/img/ita.jpg" style="width: 30px; height: 20px">  </a> </li>
       <li class="nav-item"><a class="nav-link" href="{{ route('setLang', ['lang' => 'en']) }}">  <img src=" {{ url('/') }}/img/eng.jpg" style="width: 30px; height: 20px">  </a> </li>
   
        </ul> 
      
    </div> 
    
  </div>

</nav>  
    
     
  @yield('corpo')   
     
     
 </body> 
 <!-- Footer -->
<footer  style="background-color: #e95420; margin-top: 100px" >
    <div class="container text-white">
   
     <div class="row" style="padding-bottom: 30px; padding-top: 20px">
         <div class="col-md-3 ">
             <span class="text-light align-content-center"> <img src="{{ url('/') }}/img/pizza-delivery-logo_10250-1738.jpg"> Fasty Pizza </span>
         </div>
          <div class="col-md-3 ">
        <span class="text-light align-content-center" > <img src="{{ url('/') }}/fonts/fb32.png"> Facebook </span>
         </div>
          <div class="col-md-3 ">
        <span class="text-light align-content-center" > <img src=" {{ url('/') }}/fonts/instagram32.png"> Instagram </span>
          </div>
          <div class="col-md-3 ">
        <span class="text-light align-content-center" > <img src="{{ url('/') }}/fonts/mail32.png"> fasty.pizza@mail.it </span>
          </div>
    </div>
     <div class="row align-items-center align-middle">
         <span style="font-size: 8pt">Francesco Rossi 2021@All rights reserved</span>
     </div>
</footer>
 
</html> 