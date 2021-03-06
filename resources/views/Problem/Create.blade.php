@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Creation de probleme
                </div>
                <div class="card-body">
                    <div class="col-md-10 col-md-offset-1">
                        <form action="{{ URL::to('probleme/enregistrer') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <label for="Platformes_id" class="required">Plateforme :</label>
                            <select    class="custom-select"  id='Platformes_id' name="Platformes_id" content-type="choices" trigger="true" target="Serveurs_id">
                                <option selected disabled hidden style='display: none' value=''></option>
                                @foreach($Platformes as $Platforme) {{-- Affichage des platformes --}}
                                <option value={{$Platforme->id}} >  {{$Platforme->NomPlatforme}}
                                </option>
                                @endforeach
                            </select>
                            <label for="Serveurs_id" class="required">Serveur:</label>
                            <select  class="custom-select" disabled="disabled" id="Serveurs_id" name="Serveurs_id"  content-type="choices" trigger="true" >
                                @foreach($Platformes as $Platforme) 
                                <optgroup label="Serveur" reference={{$Platforme->id}}>
                                    <?php $Serveurs=App\Serveurs::where('Platformes_id',$Platforme->id)->get()?>
                                    {{-- Serveurs de la platforme selectionée --}}
                                    <option selected disabled hidden style='display: none' value=''></option>
                                    @foreach($Serveurs as $serveur)
                                    <option value={{$serveur->id}} >{{$serveur->id}}: {{ $serveur->Designation}}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                            <div class="form-group{{ $errors->has('Code_prb') ? ' has-error' : '' }}">  {{-- forme pour inserer le code --}}
                                <br/> 
                                {!! Form::label('Code_prb', "Code d'erreur :") !!}
                                {!! Form::text('Code_prb', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('Code_prb') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('MessagePrb') ? ' has-error' : '' }}">  {{-- forme pour inserer le message --}}
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
@endsection