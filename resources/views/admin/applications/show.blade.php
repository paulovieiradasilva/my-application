@extends('layouts.app')
@section('content')

<section class="my-content">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-primary">{{ $application[0]->name }}</h2>
                    <blockquote>
                        <p>{{ $application[0]->description }}</p>
                        <small>Torre: <cite title="Source Title">{{ $application[0]->tower->name }}</cite></small>
                    </blockquote>
                </div>
                <!-- /.card-body -->

                <div class="col-md-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-three-provider-tab" data-toggle="pill" href="#custom-tabs-three-provider" role="tab" aria-controls="custom-tabs-three-provider" aria-selected="true">{{ __('Provider') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-three-server-tab" data-toggle="pill" href="#custom-tabs-three-server" role="tab" aria-controls="custom-tabs-three-server" aria-selected="false">{{ __('Servers') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-three-employee-tab" data-toggle="pill" href="#custom-tabs-three-employee" role="tab" aria-controls="custom-tabs-three-employee" aria-selected="false">{{ __('Users') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-three-integration-tab" data-toggle="pill" href="#custom-tabs-three-integration" role="tab" aria-controls="custom-tabs-three-integration" aria-selected="false">{{ __('Integrations') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-three-service-tab" data-toggle="pill" href="#custom-tabs-three-service" role="tab" aria-controls="custom-tabs-three-service" aria-selected="false">{{ __('Services') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-three-detail-tab" data-toggle="pill" href="#custom-tabs-three-detail" role="tab" aria-controls="custom-tabs-three-detail" aria-selected="false">{{ __('Details') }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-three-provider" role="tabpanel" aria-labelledby="custom-tabs-three-provider-tab">
                                    <div class="card-body">
                                        <div>
                                            <h4>{{ $application[0]->provider->name }}</h4>
                                            <dl>
                                                <dd>
                                                    <strong>Site:</strong> {{ $application[0]->provider->contacts->site }}<br />
                                                    <strong>E-mail:</strong> {{ $application[0]->provider->contacts->email }}<br />
                                                    <strong>Telefone:</strong> {{ $application[0]->provider->contacts->phone }}<br />
                                                    <strong>Celular:</strong> {{ $application[0]->provider->contacts->cellphone }}<br />
                                                    <strong>Atendimento:</strong> {{ $application[0]->provider->opening_hours }}<br />
                                                    <strong>Plantão:</strong> {{ $application[0]->provider->on_duty }}<br />
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-three-server" role="tabpanel" aria-labelledby="custom-tabs-three-server-tab">
                                    <div class="row">
                                        @foreach($application[0]->servers as $server)
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5>{{ $server->name }}</h5>
                                                    <strong>Tipo:</strong> {{ $server->type }}<br />
                                                    <strong>IP:</strong> {{ $server->ip }}<br />
                                                    <strong>Sist. Operacional:</strong> {{ $server->os }}<br />
                                                    <strong>Ambiente:</strong> {{ $server->environment->name }}<br />
                                                    <strong>Usuário:</strong> -- <br />
                                                    <strong>Senha:</strong> -- <br />
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-three-service" role="tabpanel" aria-labelledby="custom-tabs-three-service-tab">
                                    ...
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-three-employee" role="tabpanel" aria-labelledby="custom-tabs-three-employee-tab">
                                    ...
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-three-integration" role="tabpanel" aria-labelledby="custom-tabs-three-integration-tab">
                                    ...
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-three-detail" role="tabpanel" aria-labelledby="custom-tabs-three-detail-tab">
                                    ...
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.col-md-12 -->

    </div>
</section>

@endsection

@section('scripts')
@stop