@extends('layouts.app')

@section('content')
<div class="container">
    <div id="form">
        <h1>Kreirajte novog klijenta</h1>

        <div id="form__fields">
            {{ Form::open(array('action' => 'UsersController@store', 'method' => 'POST')) }}
            <div class="form-group">
                {{ Form::label('name', 'Ime') }}
                {{ Form::text('name', '', array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('lastname', 'Prezime') }}
                {{ Form::text('lastname', '', array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('number', 'Broj telefona') }}
                {{ Form::text('number', '', array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('brand', 'Marka automobila') }}
                {{ Form::text('brand', '', array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('model', 'Model automobila') }}
                {{ Form::text('model', '', array('class' => 'form-control')) }}
            </div>
            {{ Form::submit('Kreirajte klijenta', array('class' => 'btn btn-success btn-block')) }}
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
