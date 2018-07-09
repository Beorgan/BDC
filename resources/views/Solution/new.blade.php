@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Probleme N°: {{$Problems->id}}  Le {{$Problems->created_at}}</div>
                    <br/>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">

                                <div class="card card-body bg-light">
                                    Sujet du probleme: {{$Problems->MessagePrb}}
                                </div>
                                <br/>


                                <form action="{{ URL::to('solution/enregistrer') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    {!! Form::hidden('Problems_id', $Problems->id) !!}
                                    <br/>
                                    <div class="form-group{{ $errors->has('MessageSol') ? ' has-error' : '' }}">
                                        {!! Form::label('MessageSol', 'Description de la solution') !!}
                                        {!! Form::textarea('MessageSol', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                        <small class="text-danger">{{ $errors->first('MessageSol') }}</small>
                                    </div>



                                    <label>Ajouter un fichier:</label>
                                    <div>
                                        <input type="file" name="file" >
                                        <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                    </div>


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
    </div>
@endsection

