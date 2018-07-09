<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Base de conaissance') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/home') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>

                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest

                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>





<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Creation de probleme</div>

                    <div class="card-body">
                        <div class="col-md-10 col-md-offset-1">


                            <form action="{{ URL::to('probleme/enregistrer') }}" method="post" enctype="multipart/form-data" class="form-horizontal">

                                <label for="Platformes_id" class="required">Plateforme :</label>
                                <select    class="custom-select"  id='Platformes_id' name="Platformes_id" content-type="choices" trigger="true" target="Serveurs_id">
                                    <option selected disabled hidden style='display: none' value=''></option>
                                    @foreach($Platformes as $Platforme)
                                        <option value={{$Platforme->id}} >  {{$Platforme->NomPlatforme}}
                                        </option>
                                    @endforeach

                                </select>


                                <label for="Serveurs_id" class="required">Serveur:</label>
                                <select  class="custom-select" disabled="disabled" id="Serveurs_id" name="Serveurs_id"  content-type="choices" trigger="true" >
                                    @foreach($Platformes as $Platforme)

                                        <optgroup label="Serveur" reference={{$Platforme->id}}>
                                            <?php $Serveurs=App\Serveurs::where('Platformes_id',$Platforme->id)->get()?>
                                            <option selected disabled hidden style='display: none' value=''></option>
                                            @foreach($Serveurs as $serveur)

                                                <option value={{$serveur->id}} >{{$serveur->id}}: {{ $serveur->Designation}}</option>

                                            @endforeach
                                        </optgroup>

                                    @endforeach

                                </select>








                                <div class="form-group{{ $errors->has('Code_prb') ? ' has-error' : '' }}">
                                    <br/>
                                    {!! Form::label('Code_prb', "Code d'erreur :") !!}
                                    {!! Form::text('Code_prb', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                    <small class="text-danger">{{ $errors->first('Code_prb') }}</small>
                                </div>

                                <div class="form-group{{ $errors->has('MessagePrb') ? ' has-error' : '' }}">
                                    {!! Form::label('MessagePrb', 'Description du probleme :') !!}
                                    {!! Form::textarea('MessagePrb', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                    <small class="text-danger">{{ $errors->first('MessagePrb') }}</small>
                                </div>


                                <label>Ajouter un fichier:</label>
                                <div>
                                    <input type="file" name="file" >
                                    <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                </div>
                                <br/>

                                <div class="btn-group pull-right">
                                    {!! Form::reset("Annuler", ['class' => 'btn btn-warning']) !!}
                                    {!! Form::submit("Enregistrer", ['class' => 'btn btn-success']) !!}
                                </div>
                            </form>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>



            <script>
                /*
                 * trigger="true" permet de dire que c'est l'élément le plus haut qui fait varier toutes les autres listes
                 * target=[id_cible] permet de spécifier la liste qui doit varier au changement de la sélection
                 * reference=[id_reference] est l'id de l'élément parent qui déclenche la mise à jour de la liste
                 */

                //Fonction qui s'occupe de la mise à jour des listes
                function updateSelectBox(object){
                    // Object correspond au input qui déclenche l'action (pays dans notre cas)
                    // On récupère le select (département) qui doit être mise à jour suite au changement du parent (pays)
                    var target = $("#"+object.attr('target'));

                    // On récupère tous les optgroup du select cible spécifié avec target (les optgroup du select département)
                    var listGroups = target.find("optgroup");

                    // On récupère le optgroup qui correspond à la valeur courante du select parent (pays)
                    var validGroup = target.find("optgroup[reference='"+object.find(':selected').val()+"']");

                    //On modifie la valeur courante du select cible (département)
                    target.val(validGroup.find("option").val());

                    //On cache tous les optgroup de département
                    listGroups.hide();

                    //On affiche uniquement le optgroup de département qui correspond à la valeur courante de pays
                    validGroup.show();

                    //On vérifie si la cible (département) doit déclencher une mise à jour d'une autre liste
                    // Département peut par exemple déclencher la mise à jour des villes, et les villes déclenches celle des quartiers...
                    if(target.attr('content-type')=='choices')
                        target.change();

                    if (value='')
                        $('#option').prop('display', none);
                }

                //On associe la fonction updateSelectBox à l'événement onchange des listes qui doivent déclencher des mises à jour d'autres listes

                $("select[content-type='choices']").on('click',function() {
                    updateSelectBox($(this));
                });


                $("select[name='Platformes_id']").on('click',function() {

                    $('#Serveurs_id').prop('disabled', false);});







                //On fait la première mise à jour des
                $(document).ready(function(){
                    updateSelectBox($("select[trigger='true']"));
                });



            </script>



</body>
</html>
