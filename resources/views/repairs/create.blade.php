@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/user/{{$user->id}}" class="btn btn-secondary mt-4">Nazad</a>
    <div id="form">
        <h1>Unesite popravku za {{$user->brand}} {{$user->model}}</h1>

        <div id="form__fields">
            {{ Form::open(array('action' => 'UsersController@repairs_store', 'method' => 'POST')) }}
            {{ Form::hidden('user_id', "{$user->id}" ) }}
            <div class="form-group">
                {{ Form::label('kilometers', 'Kilometraža') }}
                {{ Form::text('kilometers', '', array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('title', 'Popravka') }}
                {{ Form::text('title', '', array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('body', 'Napomena') }}
                {{ Form::textarea('body', '', array('class' => 'form-control', 'rows' => '6')) }}
            </div>
            {{ Form::submit('Dodajte popravku', array('class' => 'btn btn-success btn-block')) }}
            {{ Form::close() }}
        </div>
    </div>
</div>

@endsection
