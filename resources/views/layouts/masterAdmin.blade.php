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
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <!--  <script src="{{ url('/') }}/js/jquery-3.5.1.min.js"></script> -->
<!-- <script src="js/bootstrap.min.js"></script> --> 
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="{{ asset('js/filter-multi-select-bundle.min.js') }}" type="text/javascript"></script>
 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"  defer> </script>

    </head>

 <body> 


<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary " >
       <div class="container "> 
 
           <a class="navbar-brand mr-4" href="#"><img src=" {{ url('/') }}/img/pizzaLogo1.jpg" style="width: 68px; height: 30px"> </img></a>
  <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-collapse collapse" id="navbarColor01" style="">
    <ul class="navbar-nav mr-auto">
      @yield('left_navbar')
  </ul> 
     
      <ul class="  navbar-nav ml-auto">
          <li class="nav-item active  ml-3">
              <a class="nav-link "  href="#" > Admin mode </a>
      </li> 
    <li class="nav-item ml-3"> <a class="nav-link"  href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Esci</a>
       <form action="{{ route('admin.logout') }}" id="logout-form" method="post">@csrf</form> </li>
     
    {{--   <li class="nav-item active"><a class="nav-link" href="#"> It </a> </li>
       <li class="nav-item active"><a class="nav-link" href="#">  En </a> </li>  --}}
        </ul> 
      
    </div> 
    
  </div>

</nav>  
    
     
  @yield('corpo')   
     
     
 </body> 
 
 <!-- Footer -->
<footer  style="background-color: #e95420; padding:  30px " >
    <div class="container text-white">
   
   
     <div class="row align-items-center align-middle">
         <span style="font-size: 9pt">Francesco Rossi 2021@All rights reserved</span>
     </div>
    </div>
</footer>
 
</html> 

