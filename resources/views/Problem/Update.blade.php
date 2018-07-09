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
                    </div>
                    <div class="card-body text-dark">
                        <form action = "/probleme/update/{{ $problems->id}}" method = "post">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <table>
                                <tr>
                                    {!! Form::hidden('Problems_id', $problems->id) !!}
                                    <div class="form-group{{ $errors->has('Code_prb') ? ' has-error' : '' }}">
                                        {!! Form::label('Code_prb', "Code d'erreur :") !!}
                                        {!! Form::text('Code_prb',$problems->Code_prb, ['class' => 'form-control', 'required' => 'required']  )  !!}
                                        <small class="text-danger">{{ $errors->first('Code_prb') }}</small>
                                    </div>
                                    <div class="form-group{{ $errors->has('MessagePrb') ? ' has-error' : '' }}">
                                        {!! Form::label('MessagePrb', 'Message du probleme :') !!}
                                        {!! Form::textarea('MessagePrb',$problems->MessagePrb, ['class' => 'form-control', 'required' => 'required']  )  !!}
                                        <small class="text-danger">{{ $errors->first('MessagePrb') }}</small>
                                    </div>
                                    <label for="Platformes_id" class="required">Platforme :</label>
                                    <select class="custom-select" id='Platformes_id' name="Platformes_id" content-type="choices" trigger="true"
                                            target="Serveurs_id">
                                        <?php $Platformes = \App\Platformes::where('id', $problems->Platformes_id)->get()   ?>
                                        @foreach($Platformes as $Platforme)
                                            <option value={{$Platforme->id}} >  {{$Platforme->NomPlatforme}}     </option>
                                        @endforeach
                                        <?php $Platformes = \App\Platformes::where('id', '<>', $problems->Platformes_id)->get()   ?>

                                        @foreach($Platformes as $Platforme)
                                            <option value={{$Platforme->id}} >  {{$Platforme->NomPlatforme}}   </option>
                                        @endforeach
                                    </select>
                                    <?php $Platformes = \App\Platformes::all()   ?>
                                    <label for="Serveurs_id" class="required">Serveur:</label>
                                    <select class="custom-select" id="Serveurs_id" name="Serveurs_id" content-type="choices" trigger="true">
                                        @foreach($Platformes as $Platforme)
                                            <optgroup label="Serveur" reference={{$Platforme->id}}>
                                                @if ($Platforme->id==$problems->Platformes_id)
                                                    <?php $Serveurs = \App\Serveurs::where('id', $problems->Serveurs_id)->get()   ?>
                                                    @foreach($Serveurs as $Serveur)
                                                        <option value={{$Serveur->id}} >  {{$Serveur->Designation}}       </option>
                                                    @endforeach
                                                @endif
                                                <?php $Serveurs = \App\Serveurs::where('id', '<>', $problems->Serveurs_id)->where('Platformes_id', '=', $Platforme->id)->get()   ?>
                                                @foreach($Serveurs as $Serveur)
                                                    <option value={{$Serveur->id}} >  {{$Serveur->Designation}}   </option>
                                                @endforeach
                                                @endforeach
                                            </optgroup>
                                    </select>
                                    <div>
                                        <br/>
                                        {!! Form::reset("Annuler", ['class' => 'btn btn-warning']) !!}
                                        {!! Form::submit("Mettre a jour", ['class' => 'btn btn-success']) !!}

                                    </div>
                            </table>
                        </form>
                        <script>
                            /*
                             * trigger="true" permet de dire que c'est l'élément le plus haut qui fait varier toutes les autres listes
                             * target=[id_cible] permet de spécifier la liste qui doit varier au changement de la sélection
                             * reference=[id_reference] est l'id de l'élément parent qui déclenche la mise à jour de la liste
                             */
                            //Fonction qui s'occupe de la mise à jour des listes
                            function updateSelectBox(object) {
                                // Object correspond au input qui déclenche l'action (pays dans notre cas)
                                // On récupère le select (département) qui doit être mise à jour suite au changement du parent (pays)
                                var target = $("#" + object.attr('target'));
                                // On récupère tous les optgroup du select cible spécifié avec target (les optgroup du select département)
                                var listGroups = target.find("optgroup");
                                // On récupère le optgroup qui correspond à la valeur courante du select parent (pays)
                                var validGroup = target.find("optgroup[reference='" + object.find(':selected').val() + "']");
                                //On modifie la valeur courante du select cible (département)
                                target.val(validGroup.find("option").val());
                                //On cache tous les optgroup de département
                                listGroups.hide();
                                //On affiche uniquement le optgroup de département qui correspond à la valeur courante de pays
                                validGroup.show();
                                //On vérifie si la cible (département) doit déclencher une mise à jour d'une autre liste
                                // Département peut par exemple déclencher la mise à jour des villes, et les villes déclenches celle des quartiers...
                                if (target.attr('content-type') == 'choices')
                                    target.change();
                                if (value = '')
                                    $('#option').prop('display', none);
                            }
                            //On associe la fonction updateSelectBox à l'événement onchange des listes qui doivent déclencher des mises à jour d'autres listes
                            $("select[content-type='choices']").on('click', function () {
                                updateSelectBox($(this));
                            });
                            //On fait la première mise à jour des
                            $(document).ready(function () {
                                updateSelectBox($("select[trigger='true']"));
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection