@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-md-offset-10 ">
            <h3>Accueil</h3>
            <div class="card  mb-3">
                <div class="card-header">Tableau de bord
                    <div style="float: right" class="btn-group" role="group" aria-label="Basic example">
                        <a   href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-warning" role="button" aria-pressed="true"> Administration</a>   </button>
                        <a  href="{{url('/probleme/nouveau')}}" class="btn btn-outline-primary" role="button" aria-pressed="true">(+) Nouveau probleme</a>   </button>
                    </div>
                </div>
                <div class="card-body text-dark">
                    <b>Recherche:</b>
                    
                    <!--Recherche par message-->
                    <form class="ui form">
                        <div class="ui fluid action input">
                            <input class="form-control mr-sm-2" type="text" name="MessagePrb" placeholder="Message" aria-label="MessagePrb">
                            <button class="btn btn-secondary" style="float: right" type="submit">Rechercher</button>
                        </div>
                    </form> 

                    <!--Recherche par code d'erreur-->
                    <form class="ui form">
                        <div class="ui fluid action input">
                            <input class="form-control mr-sm-2" type="text" name="Code_prb" placeholder="Code d'erreur" aria-label="Code_prb">
                            <button class="btn btn-secondary" style="float: right" type="submit">Rechercher</button>
                        </div>
                    </form>
                    <br/>

                    <!--Reccuperation du message de mise a jour-->
                    @if($errors->any()) 
                    <div class="alert alert-success" role="alert">
                        {{$errors->first()}}
                    </div>
                    @endif
                    
                    <b><br/>Liste des problems: </b>
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                    
                            <!-- Entete code d'erreur avec ordonancement-->
                            <th style="max-width:80px">
                                <?php function Code_erreur(){} if(isset($_GET['Code_erreur'])) {$Problems = \App\Problems::orderBy('Code_prb', 'asc')->get();}?>
                                <form method="get">
                                    <input type="hidden" name="Code_erreur">
                                    <link href={{asset('/open-iconic-master/font/css/open-iconic.css')}}rel="stylesheet">
                                    <input style="border: none; background-color: transparent; color: white; " type="submit" value= "Code erreur">
                                <img class="icon-account-login" style="background-color: whitesmoke; width: 15px;" src={{asset('open-iconic-master/svg/sort-ascending.svg')}}> </form>
                            </th>
                    
                            <!-- Entete message avec ordonancement-->
                            <th>
                                <?php function Message(){}if(isset($_GET['Message'])) {$Problems = \App\Problems::orderBy('MessagePrb', 'asc')->get();}?>
                                <form method="get">
                                    <input type="hidden" name="Message">
                                    <link href={{asset('/open-iconic-master/font/css/open-iconic.css')}}rel="stylesheet">
                                    <input style="border: none; background-color: transparent; color: white; " type="submit" value= "Message">
                                    <img class="icon-account-login" style="background-color: whitesmoke; width: 15px;" src={{asset('open-iconic-master/svg/sort-ascending.svg')}}>
                                </form>
                            </th>
                    
                            <!-- Entete platforme avec ordonancement-->
                            <th style="max-width: 80px">
                                <?php function Platforme(){}if(isset($_GET['Platforme'])) {$Problems = \App\Problems::orderBy('Platformes_id', 'asc')->get();}?>
                                <form method="get">
                                    <input type="hidden" name="Platforme">
                                    <link href={{asset('/open-iconic-master/font/css/open-iconic.css')}}rel="stylesheet">
                                    <input style="border: none; background-color: transparent; color: white; " type="submit" value= "Platformes">
                                    <img class="icon-account-login" style="background-color: whitesmoke; width: 15px;" src={{asset('open-iconic-master/svg/sort-ascending.svg')}}>
                                </form>
                            </th>
                           
                            <!-- Entete serveur avec ordonancement-->
                            <th style="max-width: 70px">
                                <?php function Serveur(){}if(isset($_GET['Serveur'])) {$Problems = \App\Problems::orderBy('Serveurs_id', 'asc')->get();}?>
                                <form method="get">
                                    <input type="hidden" name="Serveur">
                                    <link href={{asset('/open-iconic-master/font/css/open-iconic.css')}}rel="stylesheet">
                                    <input style="border: none; background-color: transparent; color: white; " type="submit" value= "Serveur">
                                <img class="icon-account-login" style="background-color: whitesmoke; width: 15px;" src={{asset('open-iconic-master/svg/sort-ascending.svg')}}> </form>
                            </th>
                           
                            <!-- Entete date de creation avec ordonancement-->
                            <th style="max-width: 85px">
                                <?php function Date_creation(){}if(isset($_GET['Date_creation'])) {$Problems = \App\Problems::orderBy('created_at', 'asc')->get();}?>
                                <form method="get">
                                    <input type="hidden" name="Date_creation">
                                    <link href={{asset('/open-iconic-master/font/css/open-iconic.css')}}rel="stylesheet">
                                    <input style="border: none;  background-color: transparent; color: white; " type="submit" value= "Date creation">
                                <img class="icon-account-login" style="background-color: whitesmoke; width: 15px;" src={{asset('open-iconic-master/svg/sort-ascending.svg')}}> </form>
                            </th>
                        </thead>

                        <!--Boucle des problems-->
                        @foreach($Problems as $Problem) 
                        <tr>
                            <td style="max-width: 50px">{{ str_limit($Problem->Code_prb, 20)}}</td>
                            <td style="max-width: 300px"><a href="{{url('Probleme/Consulter/'.$Problem->id)}}"> {{ str_limit($Problem->MessagePrb, 70) }} </a></td>
                        
                            <!--Affichage nom platforme avec verification-->
                            <td style="max-width: 50px"   >
                                <?php $Platformes=App\Platformes::where('id',$Problem->Platformes_id)->get()?>
                                @foreach($Platformes as $platforme)
                                @if( ! empty($platforme['id']))
                                {{$platforme->NomPlatforme}}
                                @else
                                Erreur platforme manquante
                                @endif
                                @endforeach
                            </td>
                        
                            <!--Serveur ID avec verification-->
                            <td style="max-width: 60px">
                                <?php $Serveurs=App\Serveurs::where('id',$Problem->Serveurs_id)->get()?>
                                @foreach($Serveurs as $serveur)
                                @if( ! empty($serveur['id']))
                                Serv_{{$serveur->id}}
                                @else
                                Erreur serveur manquante
                                @endif
                                @endforeach
                            </td>
                            <td style="max-width: 20px">{{$Problem->created_at}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Modal choix de l'interface d'administration-->
<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" style="color:black" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Interfaces d'administration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="margin-left: 20%; color:black">
                <a  class="btn btn-outline-success" role="button" aria-pressed="true" href="{{url('/admin')}}"  >Gestion tables </a>
                <a  class="btn btn-outline-success" role="button" aria-pressed="true" href="{{url('admin/users/')}}">Gestion utilisateurs </a>
            </div>
        </div>
    </div>
</div>
@endsection