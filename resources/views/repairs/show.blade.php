@extends('layouts.app')

@section('content')


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Brisanje popravke: {{$repair->title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Da li Ste sigurni da želite da obrišete popravku?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Nazad</button>
                {!! Form::open(array('action' => array('UsersController@repairs_destroy', $repair->id ), 'method' => 'POST')) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {{ Form::hidden('url',URL::previous())  }}
                <button class="btn btn-danger" type="submit" value="submit">
                    <i class="fas fa-trash-alt mr-2"></i>Izbrišite popravku
                </button>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>
<div class="container">
    <a class="btn btn-secondary mt-4" href="{{ URL::previous() }}">Nazad</a>
    <div id="repair">
        <div class="row mt-5">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Naziv popravke: {{$repair->title}}</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <h3><i class="fas fa-edit mr-2"></i>Datum popravke: {{$repair->created_at->format('d/m/Y')}}</h3>
                            </li>
                            <li class="list-group-item">
                                <h3><i class="fas fa-car mr-2"></i>Kilometraža: {{ $repair->kilometers }} km</h3>
                            </li>
                            <li class="list-group-item">
                                <h3><i class="fas fa-exclamation-circle mr-2"></i> Napomena:</h3>
                                <h4 class="mt-2">{{$repair->body}}</h4>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-trash-alt mr-2"></i>Izbrišite popravku</button>
            </div>
        </div>
    </div>
</div>
@endsection
