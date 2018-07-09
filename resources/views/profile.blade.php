@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
<h3>Profile utilisateur</h3>
                <img src="/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">

                <p> Nom:   {{ $user->name }}</p>
                <p> Mail:  {{ $user->email }}</p>
                <p> Inscrit le: {{ $user->created_at }}</p>

                <form enctype="multipart/form-data" action="/profile" method="POST">
                    <label>Choisir photo de profile</label>
                    <input type="file" name="avatar">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="btn btn-sm btn-primary">
                </form>





            </div>
        </div>
    </div>
@endsection