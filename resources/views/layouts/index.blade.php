

@extends('layouts.master')

@section('titolo', 'FastyPizza | Home ')

@section('left_navbar')
 <li class="nav-item active mr-3">
        <a class="nav-link" href="{{ route('home') }}">Home
          <span class="sr-only">(current)</span>
        </a>
      </li>
   
      <li class="nav-item mr-3">
        <a class="nav-link" href="{{ route('pizza.index') }}">@lang('labels.nostrePizze')</a>
      </li>
      <li class="nav-item mr-3">
        <a class="nav-link" href="{{ route('contatti') }}">@lang('labels.contatti')</a>
      </li>
@endsection



@section('corpo')

<main class="container">

    <div class="row-col-lg-12">
        <div id="carouselExampleInterval" class="carousel slide slide-border" data-ride="carousel" >
  <div class="carousel-inner">
    <div class="carousel-item active" data-interval="4000">
        <img src="{{ url('/') }}/img/pizza1.jpg" class="d-block w-100 img-slide" alt="..." >
    </div>
    <div class="carousel-item" data-interval="4000">
        <img src="{{ url('/') }}/img/pizza2.jpg" class="d-block w-100 img-slide" alt="..." ">
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
       
       <h1> @lang('labels.laPizza') </h1>
    </header>
    
    
    <div class="row" style="margin-top: 20px ">
    <div  class=" col-sm-10" >     
           <blockquote class="blockquote">
               <p class="mb-0" style="font-size: 14pt">@lang('labels.cit')</p>
  <footer class="blockquote-footer">Jeff Marder </footer>
</blockquote>
    </div>
     <div  class="col-sm-2"> 
         <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcRfqDoWC_WaGoSBRL537U2JzdULECe8rjXQp9yoVFvbTJCah4g3MDGLOoXa" class="slide-border align-content-end"> 
         
     </div>     
    </div>     
   
      
       <header class="header-paragrafo" style="margin-top: 40px">
       <h1> @lang('labels.titoloOrari') </h1>
    </header>
    <div class="jumbotron jumbotron-fluid text-center text-wrap" style="font-size: 14pt; margin-top: 30px; background-image: url(https://st2.depositphotos.com/3038577/10443/v/600/depositphotos_104432362-stock-illustration-funny-pizza-chef-on-scooter.jpg);">
        <div class="container"  >
            <p > <b> @lang('labels.lun') 12:00-14:00 -- 18:00-23:00 </b> <br>   
        <b>@lang('labels.mar') 12:00-14:00 -- 18:00-23:00</b>  <br>
        <b>@lang('labels.mer') 12:00-14:00 -- 18:00-23:00</b>  <br>
        <b>@lang('labels.gio') 18:00-23:00</b>  <br>
        <b>@lang('labels.ven') 12:00-14:00 -- 18:00-23:00</b> <br>
        <b>@lang('labels.sab') 12:00-14:00 -- 18:00-23:00</b> <br> 
        <b>@lang('labels.dom') 12:00-14:00 -- 18:00-23:00</b>  </p> 
        
        </div>
        
</div>
    
    <button type="button" class="btn btn-primary btn-lg btn-block" style="margin-bottom: 40px"> @lang('labels.bottoneOrdinaLaPizza') </button>    

</main>



@endsection