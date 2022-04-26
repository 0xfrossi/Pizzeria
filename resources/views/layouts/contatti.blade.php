@extends('layouts.master')

@section('titolo', ' FastyPizza | Contatti ')

@section('left_navbar')
 <li class="nav-item  mr-3">
        <a class="nav-link" href="{{ route('home') }}">Home
         
        </a>
      </li>
   
      <li class="nav-item mr-3">
        <a class="nav-link" href="{{ route('pizza.index') }}">@lang('labels.nostrePizze')</a>
      </li>
      <li class="nav-item  active mr-3">
        <a class="nav-link" href="{{ route('contatti') }}">@lang('labels.contatti')</a>
         <span class="sr-only">(current)</span>
      </li>
@endsection



@section('corpo')
     <div class="container">
     <header class="header-paragrafo">
        <h3>@lang('labels.contatti')</h3>
     </header>
     
    
    
    <div class="col-sm-6">
        <ul  style="list-style-type: none; padding: 15px">
            <li class="item"> <span> <img src="fonts/phone32.png"> </span> 351 24147852 </li>
            <li class="item"><span>  <img src="fonts/mail32.png"> </span> fasty.pizza@email.it</li> 
            <li class="item"><span> <img src="fonts/maps32.png"> </span> Via Caduti 3, Montirone 25010</li>
            <li class="item"> P.IVA 02778560926 </li>
        </ul> 
    </div>  
    <div class="row">
        <div class="col-sm-6 " style="margin-bottom:80px"> 
                        <form id="contatti-form" class="form-horizontal">
                            <div class="form-group">
                                <label for="inputNome" class="col-sm-1 control-label">@lang('labels.nome')</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-with-feedback" type="text" id="inputNome" name="inputNome" placeholder="@lang('labels.nomeCognome')">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-1 control-label">Email</label>
                                <div class="col-sm-12">
                                    <input class="form-control " type="text" id="inputEmail" name="inputEmail" placeholder="@lang('labels.indEmail')">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textMessaggio" class="col-sm-1 control-label">Message</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="textMessaggio" name="textMessaggio" rows="6" placeholder="@lang('labels.insMess')" style=""></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-1">
                                    <a href="#" class="btn btn-primary btn-large btn-block"> @lang('labels.invia')</a>
                                </div>
                            </div>
                        </form>
       </div>   
   
   
    
    
    <div class="col-sm-6  google-maps">
        <div class="container">
             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2799.2617151938807!2d10.224345215739422!3d45.4443819791008!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4781a01d7439917f%3A0x4bbddc59885aae0f!2sVia%20Caduti%2C%203%2C%2025010%20Montirone%20BS!5e0!3m2!1sit!2sit!4v1596483601652!5m2!1sit!2sit" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
     </div>  
   </div>
 </div>
@endsection



