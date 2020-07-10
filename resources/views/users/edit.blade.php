@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/user/{{$user->id}}" class="btn btn-secondary mt-4">Nazad</a>
    <div id="form" class="mb-5">
        <h1>Izmeni podatke za {{$user->name}} {{$user->lastname}}</h1>

        <div id="form__fields">
            {{ Form::open(array('action' => array('UsersController@update', $user->id), 'method' => 'POST')) }}
            <div class="form-group">
                {{ Form::label('name', 'Ime') }}
                {{ Form::text('name', $user->name, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('lastname', 'Prezime') }}
                {{ Form::text('lastname', $user->lastname, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('number', 'Broj telefona') }}
                {{ Form::text('number', $user->number, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('brand', 'Marka automobila') }}
                {{ Form::text('brand', $user->brand, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('model', 'Model automobila') }}
                {{ Form::text('model', $user->model, array('class' => 'form-control')) }}
            </div>
            {{ Form::hidden('_method', 'PUT') }}
            {{ Form::submit('Izmeni podatke', array('class' => 'btn btn-success btn-block')) }}
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
