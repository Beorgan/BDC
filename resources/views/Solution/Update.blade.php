@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tableau de bord</div>

                    <div class="card-body">
                        <div class="col-md-10 col-md-offset-1">

                            <title>Student Management | Edit</title>




                            <body>
                            <form action = "/probleme/{{$problems->id}}/solution/{{$solutions->id}}/update" method = "post">
                                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                <table>
                                    <tr>

                                        {!! Form::hidden('Problems_id', $problems->id) !!}

                                        <div class="form-group{{ $errors->has('MessageSol') ? ' has-error' : '' }}">
                                            {!! Form::label('MessageSol', 'Message de la solution :') !!}
                                            {!! Form::textarea('MessageSol',$solutions->MessageSol, ['class' => 'form-control', 'required' => 'required']  )  !!}
                                            <small class="text-danger">{{ $errors->first('MessageSol') }}</small>
                                        </div>


                                    </tr>


                                    <tr>

                                        {!! Form::reset("Annuler", ['class' => 'btn btn-warning']) !!}
                                        {!! Form::submit("Mettre a jour", ['class' => 'btn btn-success']) !!}



                                    </tr>
                                </table>
                            </form>
                            </body>

                        </div>
                    </div>
                </div>
            </div>
        </div></div>
@endsection