@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if(!Auth::user()->hasRole('admin'))

                    @can('users.dashboard')
                        Seja bem vindo(a), {{ Auth::user()->name }} ! </br>
                    @endcan

                @else
                    Seja bem vindo(a), <b>{{ Auth::user()->name }}</b> você é um Administrador !
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@stop
