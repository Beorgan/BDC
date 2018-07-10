@extends('layouts.app')
@section('content')
<div class="Background">
    <meta charset="UTF-8">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-md-offset-10 ">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-header">Base de connaissance </div>
                    <div class="card-body">
                        @if (Auth::check())
                        @if(Auth::user()->role=='Admin')
                        @include('admin')
                        @else
                        @include('user')
                        @endif
                        @else Veuillez vous connecter <a href="/login" style="color: white; border-bottom-style: solid;">ici</a> ou sinon s'enregistrer <a href="/register" style="color: white; border-bottom-style: solid;">ici</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection