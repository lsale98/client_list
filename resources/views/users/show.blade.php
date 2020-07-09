@extends('layouts.app')


@section('content')
<div id="main__info" class="p-3">
    <div id="main__group">
        <h3><i class="fas fa-user mr-2"></i>{{ $user->name }} {{$user->lastname}} - {{$user->brand}} {{$user->model}}</h3>
        <h3><i class="fas fa-phone-alt mr-2"></i>{{$user->number}}</h3>
    </div>
    <a href="/user/{{$user->id}}/repairs" class="btn btn-success"><i class="fas fa-plus mr-2"></i>Dodajte popravku</a>
    {!! Form::open(array('action' => array('UsersController@destroy', $user->id), 'method' => 'POST', 'class' => 'delete__btn')) !!}
    {{ Form::hidden('_method', 'DELETE') }}
    {{ Form::submit('Izbrišite klijenta', array('class' => 'btn btn-danger')) }}
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
            <h5>Popravka: {{$repair->title}}</h5>
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
