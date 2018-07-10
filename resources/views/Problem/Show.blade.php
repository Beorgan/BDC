@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="panel-heading">
                <i class="list alternate icon">Fiche Problème N° {{ $problems->id}}</i>
            </div>
            <div class="card">
                <div class="card-header">

                    {{-- Test pour afficher le message de mise a jour --}}
                    @if($errors->any())
                    <div class="alert alert-success" role="alert">
                        {{$errors->first()}}
                    </div>
                    @endif

                    Données du probleme
                </div>
                <div class="card-body text-dark">

                    {{-- Tableau d'informations du probléme --}}
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td>Code d'erreur:</td>
                            <td>{{$problems->Code_prb}}</td>
                        </tr>

                        <tr> {{-- Test serveur n'est pas vide --}}
                            <td>Serveur:</td>
                            @if( ! empty($problems->Serveurs['id']))
                            <td>
                                Serv_{{$problems->Serveurs->id}}/{{$problems->Serveurs->Designation}}
                            </td>
                            @else
                            <td style="color: red">Serveur manquant</td>
                            @endif
                        </tr>

                        <tr>
                            <td>Platforme:</td>
                            <td>{{$problems->Platformes->NomPlatforme}}</td>
                        </tr>
                        <tr>
                            <td>Message:</td>
                            <td>  {{$problems->MessagePrb }}  </td>
                        </tr>
                        <tr>
                            <td>Attachement:</td>
                            <td>
                                <a href="storage/{{$problems->id}}/{{$problems->AttachementProb }}">
                                    {{$problems->AttachementProb }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Action:</td>

                            {{-- Petit tableau d'actions sur le probléme (modif/supp/ajouter sol) en utilisant des dropdown-item --}}
                            <td> 
                                <a class="dropdown-item" style="border: solid; border-bottom: none;  border-width: 1px; border-color: #d8d8d8" href="{{url('probleme/update/'.$problems->id)}}">Modifier </a>
                                <a data-toggle="modal" data-target="#ProbModal" class="dropdown-item" style="border: solid;  border-width: 1px; border-color: #d8d8d8" href="#">Supprimer</a>
                                <a class="dropdown-item" style="border: solid;border-top: none;  border-width: 1px; border-color: #d8d8d8" href="{{url('probleme/solution/'.$problems->id)}}">Nouvelle solution (+) </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <table class="ui inverted table">
                <thead class="table">
                    <th>Description</th>
                    <th>Date de creation</th>
                    <th>Attachement:</th>
                    <th>Action:</th>
                </thead>
                @foreach( $solutions as $solution) {{-- boucles des solution du probleme --}}
                <tr>
                    <td style="max-width: 600px">{{$solution->MessageSol}}</td>
                    <td>{{$solution->created_at}}</td>
                    <td>
                        <a href="storage/{{$solution->id}}/{{$solution->AttachementSol }}"> {{$solution->AttachementSol }} </a>
                    </td>
                    <td>
                        {{-- Petit tableau d'actions sur la solution (modif/supp) en utilisant des dropdown-item --}}
                        <a class="dropdown-item" style="border: solid; border-bottom: none; border-width: 1px; border-color: #d8d8d8" href="/probleme/{{$problems->id}}/solution/{{$solution->id}}/update"> Modifier</a>
                        <a class="dropdown-item" style="border: solid;  border-width: 1px; border-color: #d8d8d8" href="" data-toggle="modal" data-target="#exampleModal">Supprimer </a>
                    </td>
                </tr>
                @endforeach
            </table>

            {{-- Modal pour confirmation de la suppression d'une solution --}}
            <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" style="color:black" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="color:black">
                            Etes vous sur de vouloir supprimer cette solution?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            @if( ! empty($solution['id']))
                            <button type="button" class="btn btn-primary">
                            <a href="{{url('solution/delete/'.$solution->id)}} " style="color:white">Confirmer </a>
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal pour confirmation de la suppression d'un probléme --}}
            <div class="modal fade" id="ProbModal" role="dialog" aria-labelledby="exampleModalLabel" style="color:black" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="color:black">
                            Etes vous sur de vouloir supprimer ce probleme?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            @if( ! empty($problems['id']))
                            <button type="button" class="btn btn-primary">
                            <a href="{{url('probleme/delete/'.$problems->id)}} " style="color:white">Confirmer </a>
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection