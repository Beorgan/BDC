@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="dropdown">
                        Gestion d'utilisateurs
                    </div>
                </div>
                <div class="card-body">

                    {{-- Tableau des utilisateurs --}}
                    <table class="table table-bordered ">
                        <thead class="thead-dark">
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Mail</th>
                            <th>Role</th>
                            <th>Date création</th>
                            <th>Derniére modification</th>
                            <th>Action</th>
                        </thead>
                        @foreach($users as $user)
                        <tr>
                            <td> {{$user->id}} </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td style="max-width: 90px">
                                <form action = "users/update/{{$user->id}}" method = "post"  id="form1_{{$user->id}}">
                                    <select    class="custom-select"  id='role' name="role" content-type="choices" trigger="true">
                                        <?php $users = \App\User::where('id', $user->id)->get()   ?>
                                        @foreach($users as $use)
                                        <option value={{$use->role}} >  {{$use->role}}     </option> {{-- Affichage du role actuel en premier --}}
                                        @endforeach
                                        <?php $users = \App\User::where('id', $user->id)->where('role','<>', 'Utilisateur')->get()   ?>
                                        @foreach($users as $use)
                                        <option value="Utilisateur" >  Utilisateur  </option>  {{-- S'il est admin le 2e choix est utilisateur --}}
                                        @endforeach
                                        <?php $users = \App\User::where('id', $user->id)->where('role','<>', 'Admin')->get()   ?>
                                        @foreach($users as $use)
                                        <option value="Admin" >  Admin  </option> {{-- S'il est utilisateur le 2e choix est admin --}}
                                        @endforeach
                                    </select>
                                    <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                    <div class="btn-group btn-group-sm" aria-label="Small button group">
                                    </div>
                                </form></td>
                                <td>{{$user->created_at}}</td>
                                <td>{{$user->updated_at}}</td>
                                <td>

                                    {{-- Bouton submit de la forme 1 a distance (nouvelle fonctionalité form="form1") --}}
                                    <button class="dropdown-item" style="border: solid;  border-width: 1px; border-color: #d8d8d8" type="submit" form="form1_{{$user->id}}" value="Submit">
                                    Modifier role
                                    </button> 
                                    <a class="dropdown-item" style="border: solid; border-top: none;  border-width: 1px; border-color: #d8d8d8" href="" data-toggle="modal" data-target="#del">Supprimer </a>
                                </td>
                            </tr>
                            @endforeach

                            {{-- Modal confirmation de la suppresion d'un utilisateur --}}
                            <div class="modal fade" id="del" role="dialog" aria-labelledby="exampleModalLabel" style="color:black" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="color:black">
                                            Etes vous sur de vouloir supprimer {{$user->name}}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            @if( ! empty($user['id']))
                                            <button type="button" class="btn btn-primary" >
                                            <a href="{{url('admin/users/delete/'.$user->id)}} " style="color:white" >Confirmer </a>
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection