@extends('layouts.app')


@section('content')
@php
session_start();

$_SESSION['user_id'] = $user->id;

@endphp
<div id="main__info" class="p-3">
    <div id="main__group">
        <h3><i class="fas fa-user mr-2"></i>{{ $user->name }} {{$user->lastname}} - {{$user->brand}} {{$user->model}}</h3>
        <h3><i class="fas fa-phone-alt mr-2"></i>{{$user->number}}</h3>
    </div>
    <a href="/user/{{$user->id}}/repairs" class="btn btn-success"><i class="fas fa-plus mr-2"></i>Dodajte popravku</a>
    <a href="/user/{{$user->id}}/edit" class="btn btn-primary mx-3"><i class="fas fa-user-edit mr-2"></i></i>Izmenite podatke</a>
    {!! Form::open(array('action' => array('UsersController@destroy', $user->id), 'method' => 'POST')) !!}
    {{ Form::hidden('_method', 'DELETE') }}
    <button class='btn btn-danger' type='submit' value='submit' onclick="return confirm('Da li Ste sigurni da želite da obrišete {{ $user->name}} {{$user->lastname}}?')">
        <i class="fas fa-trash-alt mr-2"></i>Izbrišite klijenta
    </button>
    {!! Form::close() !!}
</div>
<div id="msg">
    @include('includes.messages')
</div>
<div class="container">
    @if(count($repairs) > 0)
    @foreach($repairs as $repair)

    <div id="card" class="card w-90">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <h5 class="pt-2">Popravka: {{$repair->title}}</h5>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 text-right">
                    <a href="/user/repairs/{{$repair->id}}/edit" class="btn btn-primary"><i class="fas fa-edit mr-2"></i>Izmenite popravku</a>

                    {!! Form::open(array('action' => array('UsersController@repairs_destroy', $repair->id), 'method' => 'POST', 'class' =>'d-inline-block')) !!}
                    {{ Form::hidden('_method', 'DELETE') }}
                    <button class='btn btn-danger' type='submit' value='submit' onclick="return confirm('Da li Ste sigurni da želite da obrišete popravku {{ $repair->title}}?')">
                        <i class="fas fa-trash-alt mr-2"></i>Izbrišite popravku
                    </button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="card-body">
            <h5><i class="fas fa-calendar-alt mr-1"></i>Datum popravke(dan/mesec/godina): {{$repair->created_at->format('d/m/Y')}} <span>|</span><i class="fas fa-car ml-1"></i> Kilometraža: {{$repair->kilometers}} km</h5>
            <hr>
            <h5><i class="fas fa-exclamation-circle mr-1"></i>Napomena:</h5>
            <p>{{$repair->body}}</p>
        </div>
    </div>
    @endforeach
    {{ $repairs->links() }}
    @else
    <h3>Trenutno nema podataka za prikaz</h3>

    @endif
</div>

@endsection