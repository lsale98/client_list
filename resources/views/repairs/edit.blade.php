@extends('layouts.app')

@section('content')
@php
@session_start();

$user_id = $_SESSION['user_id'];
@endphp
<div class="container">
    <a href="/user/{{$user_id}}" class="btn btn-secondary mt-4">Nazad</a>
    <div id="form">
        <h1>Izmeni podatke popravke</h1>

        <div id="form">
            <!-- <h1>Unesite podatke popravke za</h1> -->

            <div id="form__fields">
                {{ Form::open(array('action' => array('UsersController@repairs_update', $repair->id), 'method' => 'POST')) }}
                {{ Form::hidden('user_id', "{$user_id}") }}
                <div class="form-group">
                    {{ Form::label('created_at', 'Datum(Godina-Mesec-Dan)') }}
                    {{ Form::text('created_at', $repair->created_at, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('kilometers', 'Kilometraža') }}
                    {{ Form::text('kilometers', $repair->kilometers, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('title', 'Popravka') }}
                    {{ Form::text('title', $repair->title, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('body', 'Napomena') }}
                    {{ Form::textarea('body', $repair->body, array('class' => 'form-control', 'rows' => '6')) }}
                </div>
                {{ Form::hidden('_method', 'PUT') }}
                {{ Form::submit('Izmeni podatke', array('class' => 'btn btn-success btn-block')) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
    @endsection
