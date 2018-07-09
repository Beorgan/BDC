
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <div class="dropdown">
                            Administration
                            <button style="float:right" class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">(+) Nouvelle platforme
                                <span class="caret"> </span></button>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header"></li>
                                <li>
                                    <form action="{{ URL::to('platforme/enregistrer') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <div style="padding-left: 10px; padding-right: 10px; " class="red box" >
                                            <div class="form-group{{ $errors->has('NomPlatforme') ? ' has-error' : '' }}">
                                            {!! Form::label('NomPlatforme', 'Nom:') !!}
                                            {!! Form::text('NomPlatforme', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                            <small class="text-danger">{{ $errors->first('NomPlatforme') }}</small>
                                            </div>
                                            <div class="btn-group pull-right">
                                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                            {!! Form::reset("Annuler", ['class' => 'btn btn-warning']) !!}
                                            {!! Form::submit("Enregistrer", ['class' => 'btn btn-success']) !!}
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            </ul> <!-- Liste qui affiche la forme d'ajout d'une platforme -->
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach($Platformes as $Platforme)<!-- boucle des platformes-->
                            <table class="table table-bordered ">
                                <thead class="table-secondary ">
                                    <th>
                                        <div class="dropdown">
                                            Plateforme N°{{$Platforme->id}}: {{$Platforme->NomPlatforme}}  <!-- Recuperation ID platforme-->
                                            <a data-toggle="modal" data-target="#ProbModal -{{ $Platforme->id }}"  style="border: solid;  border-width: 1px; border-color: #d8d8d8" href="">Supprimer</a>
                                            <?php $Serveurs=App\Serveurs::where('Platformes_id',$Platforme->id)->get()?>  <!-- Recuperation ID serveur-->
                                            <button style="float:right" class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">(+) Nouveau serveur
                                            <span class="caret"> </span></button>
                                            <ul class="dropdown-menu">
                                                <form action="{{ URL::to('serveur/enregistrer') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                    <div style="padding-left: 10px; padding-right: 10px; " class="red box" >
                                                        <input type="hidden" id="Platformes_id" name="Platformes_id" value={{$Platforme->id}}>
                                                        <div class="form-group{{ $errors->has('Designation') ? ' has-error' : '' }}">
                                                            {!! Form::label('Designation', 'Designation:') !!}
                                                            {!! Form::text('Designation', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                                            <small class="text-danger">{{ $errors->first('NomServeur') }}</small>
                                                        </div>
                                                        <div class="btn-group pull-right">
                                                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                                            {!! Form::reset("Annuler", ['class' => 'btn btn-warning']) !!}
                                                            {!! Form::submit("Enregistrer", ['class' => 'btn btn-success']) !!}
                                                        </div>
                                                    </div>
                                                </form>
                                            </ul> <!-- Forme pour ajouter serveur -->
                                        </div>  <!-- Liste pour ajouter serveur a la platforme-->
                                    </th>
                                </thead>
                            </table>
                            <table class="table table-bordered ">
                                <thead class="thead-dark">
                                    <th>ID</th>
                                    <th>Designation</th>
                                    <th>Date création</th>
                                    <th>Derniére modification</th>
                                    <th>Action</th>
                                </thead> <!-- Entete -->
                                @foreach($Serveurs as $serveur)
                                    <tr>
                                        <td> {{$serveur->id}} </td>
                                        <td>{{$serveur->Designation}}</td>
                                        <td>{{$serveur->created_at}}</td>
                                        <td>{{$serveur->updated_at}}</td>
                                        <td>
                                            <button style="float:right; border: solid; border-width: 1px; border-color: #d8d8d8" class=" dropdown-item dropdown-toggle" type="button" data-toggle="dropdown">Modifier
                                            <span class="caret"> </span></button>
                                            <ul class="dropdown-menu">
                                                <form action="{{ URL::to('serveur/update/'.$serveur->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                    <div style="padding-left: 10px; padding-right: 10px; " class="red box" >
                                                        <input type="hidden" id="Platformes_id" name="Platformes_id" value={{$Platforme->id}}>

                                                        <div class="form-group{{ $errors->has('Platformes_id') ? ' has-error' : '' }}">
                                                            {!! Form::label('Platformes_id', 'Affecter N° Platforme:') !!}
                                                            {!! Form::text('Platformes_id', $serveur->Platformes_id, ['class' => 'form-control', 'required' => 'required']) !!}
                                                            <small class="text-danger">{{ $errors->first('Designation') }}</small>
                                                        </div>

                                                        <div class="form-group{{ $errors->has('Designation') ? ' has-error' : '' }}">
                                                            {!! Form::label('Designation', 'Designation:') !!}
                                                            {!! Form::text('Designation', $serveur->Designation, ['class' => 'form-control', 'required' => 'required']) !!}
                                                            <small class="text-danger">{{ $errors->first('Designation') }}</small>
                                                        </div>
                                                        <div class="btn-group pull-right">
                                                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                                            {!! Form::reset("Annuler", ['class' => 'btn btn-warning']) !!}
                                                            {!! Form::submit("Enregistrer", ['class' => 'btn btn-success']) !!}
                                                        </div>
                                                    </div>
                                                </form>
                                            </ul>
                                            <a class="dropdown-item" style="border: solid; border-top: none;  border-width: 1px; border-color: #d8d8d8" href="" data-toggle="modal" data-target="#Del -{{ $serveur->id }}">Supprimer </a>
                                        </td> <!-- liste pour modifier serveur-->
                                        <!-- Modal pour la confirmation de suppression serveur-->
                                        <div class="modal fade" id="Del -{{ $serveur->id }}" role="dialog" aria-labelledby="exampleModalLabel" style="color:black" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body" style="color:black">
                                                        Etes vous sur de vouloir supprimer ce serveur: Serv_{{$serveur->id}} ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                        @if( ! empty($Platforme['id']))
                                                            <button type="button" class="btn btn-primary" ><a  href="{{url('serveur/delete/'.$serveur->id)}}" style="color:White" >Confirmer </a></button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endforeach
                            </table> <!-- Tableau affichant la liste des serveurs de la platforme-->
                            <!-- Modal pour la confirmation de suppression platforme-->
                            <div class="modal fade" id="ProbModal -{{ $Platforme->id }}" role="dialog" aria-labelledby="exampleModalLabel" style="color:black" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="color:black">
                                            Etes vous sur de vouloir supprimer cette platforme {{$Platforme->NomPlatforme}} ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            @if( ! empty($Platforme['id']))
                                                <button type="button" class="btn btn-primary" ><a  href="{{url('platforme/delete/'.$Platforme->id)}}" style="color:White" >Confirmer </a></button>

                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach <!-- Fin de la boucle des platformes-->
                        <table class="table  ">
                            <thead class="table-warning ">
                                <th>
                                    <div class="dropdown">
                                        Serveurs non affectés
                                    </div>
                                </th>
                            </thead>
                        </table> <!-- Titre serveurs non affectés-->
                        <table class="table table-bordered ">
                            <thead class="thead-dark">
                                <th>ID</th>
                                <th>Designation</th>
                                <th>Date création</th>
                                <th>Derniére modification</th>
                                <th>Action</th>
                            </thead>
                            @foreach($Platformes as $Platforme)
                                <?php  $array[]=$Platforme->id; ?>
                            @endforeach
                                <?php $Servs=\App\Serveurs::all();?>
                            @foreach($Servs as $Serv)
                                <?php $value= $Serv->Platformes_id?>
                                @if   ( ! in_array( $value ,$array)) <!-- Detection des serveur qui n'ont pas de platforme-->
                                    <tr>
                                        <td> {{$Serv->id}} </td>
                                        <td>{{$Serv->Designation}}</td>
                                        <td>{{$Serv->created_at}}</td>
                                        <td>{{$Serv->updated_at}}</td>
                                        <td> <!-- Modification de ces serveurs -->
                                            <button style="float:right; border: solid; border-width: 1px; border-color: #d8d8d8" class=" dropdown-item dropdown-toggle" type="button" data-toggle="dropdown">Modifier
                                                <span class="caret"> </span></button>
                                            <ul class="dropdown-menu">
                                                <form action="{{ URL::to('serveur/update/'.$Serv->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                    <div style="padding-left: 10px; padding-right: 10px; " class="red box" >
                                                        <input type="hidden" id="Platformes_id" name="Platformes_id" value={{$Platforme->id}}>
                                                        <div class="form-group{{ $errors->has('Platformes_id') ? ' has-error' : '' }}">
                                                            {!! Form::label('Platformes_id', 'Affecter N° Platforme:') !!}
                                                            {!! Form::text('Platformes_id', $Serv->Platformes_id, ['class' => 'form-control', 'required' => 'required']) !!}
                                                            <small class="text-danger">{{ $errors->first('Designation') }}</small>
                                                        </div>
                                                        <div class="form-group{{ $errors->has('Designation') ? ' has-error' : '' }}">
                                                            {!! Form::label('Designation', 'Designation:') !!}
                                                            {!! Form::text('Designation', $Serv->Designation, ['class' => 'form-control', 'required' => 'required']) !!}
                                                            <small class="text-danger">{{ $errors->first('Designation') }}</small>
                                                        </div>
                                                        <div class="btn-group pull-right">
                                                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                                            {!! Form::reset("Annuler", ['class' => 'btn btn-warning']) !!}
                                                            {!! Form::submit("Enregistrer", ['class' => 'btn btn-success']) !!}
                                                        </div>
                                                    </div>
                                                </form>
                                            </ul>
                                            <a class="dropdown-item" style="border: solid; border-top: none;  border-width: 1px; border-color: #d8d8d8" href="" data-toggle="modal" data-target="#Del -{{ $Serv->id }}">Supprimer </a>
                                        </td>
                                            <!-- Modal suppression serveurs non affectés -->
                                            <div class="modal fade" id="Del -{{ $Serv->id }}" role="dialog" aria-labelledby="exampleModalLabel" style="color:black" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="color:black">
                                                            Etes vous sur de vouloir supprimer ce serveur: Serv_{{$Serv->id}} ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                            @if( ! empty($Platforme['id']))
                                                                <button type="button" class="btn btn-primary" ><a  href="{{url('serveur/delete/'.$Serv->id)}}" style="color:White" >Confirmer </a></button>

                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </tr>
                                @endif
                            @endforeach <!--Fin de la boucle des serveurs non affectés-->
                        </table> <!-- Tableau des serveurs qui ont perdu leurs platforme-->
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
