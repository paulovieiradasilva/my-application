@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(!Auth::user()->hasRole('admin'))

                    @can('users.dashboard')
                        Seja bem vindo(a), {{ Auth::user()->name }} ! </br>
                    @endcan

                    @else
                        Seja bem vindo(a), {{ Auth::user()->name }}, você é um Administrador !
                        <hr>
                        <div class="col-lg-4 col-6">
                            <!-- small card -->
                            <div class="small-box bg-danger">
                              <div class="inner">
                                <h3>65</h3>

                                <p>Unique Visitors</p>
                              </div>
                              <div class="icon">
                                <i class="fas fa-chart-pie"></i>
                              </div>
                              <a href="#" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                              </a>
                            </div>
                          </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
