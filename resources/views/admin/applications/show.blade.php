@extends('layouts.app')
@section('content')

<section class="my-content">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-primary">{{ $application->name }}</h2>
                    <blockquote>
                        <p>{{ $application->description }}</p>
                        <small>Torre: {{ $application->tower->name }}</small>
                    </blockquote>
                </div>
                <!-- /.card-body -->

                <div class="col-md-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">

                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-three-provider-tab" data-toggle="pill"
                                        href="#custom-tabs-three-provider" role="tab" aria-controls="custom-tabs-three-provider"
                                        aria-selected="true">{{ __('Provider') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-three-server-tab" data-toggle="pill" href="#custom-tabs-three-server"
                                        role="tab" aria-controls="custom-tabs-three-server" aria-selected="false">{{ __('Servers') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-three-employee-tab" data-toggle="pill" href="#custom-tabs-three-employee"
                                        role="tab" aria-controls="custom-tabs-three-employee" aria-selected="false">{{ __('Users') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-three-integration-tab" data-toggle="pill"
                                        href="#custom-tabs-three-integration" role="tab" aria-controls="custom-tabs-three-integration"
                                        aria-selected="false">{{ __('Integrations') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-three-service-tab" data-toggle="pill" href="#custom-tabs-three-service"
                                        role="tab" aria-controls="custom-tabs-three-service" aria-selected="false">{{ __('Services') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-three-detail-tab" data-toggle="pill" href="#custom-tabs-three-detail"
                                        role="tab" aria-controls="custom-tabs-three-detail" aria-selected="false">{{ __('Details') }}</a>
                                </li>
                            </ul>

                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-three-provider" role="tabpanel"
                                    aria-labelledby="custom-tabs-three-provider-tab">

                                    <div class="card-body">
                                        <h4>{{ $application->provider->name }}</h4>
                                        <div class="row">
                                            @foreach($application->provider->contacts as $contact)
                                            <dd class="p-2 mr-2">
                                                @if($contact->email != null)
                                                <strong>E-mail:</strong> {{ $contact->email }}<br />
                                                @endif
                                                @if($contact->phone != null )
                                                <strong>Telefone:</strong> {{ $contact->phone }}<br />
                                                @endif
                                                @if($contact->cellphone != null)
                                                <strong>Celular:</strong> {{ $contact->cellphone }}<br />
                                                @endif
                                            </dd>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="custom-tabs-three-server" role="tabpanel"
                                    aria-labelledby="custom-tabs-three-server-tab">

                                    <div class="card-body">
                                        <div class="row">
                                            @foreach($application->servers as $server)
                                            <dd class="p-2 mr-3" style="width: 15rem;">
                                                <h6 class="text-primary">{{ $server->name }}</h6>
                                                <div>
                                                    <strong>IP:</strong> {{ $server->ip }} <br />
                                                    <strong>Tipo:</strong> {{ $server->type }} <br />
                                                    <strong>Ambiente:</strong> {{ $server->environment->name }} <br />
                                                    @if($server->credential !== null)
                                                        <strong>Usuário:</strong> {{ $server->credential->username }} <br />
                                                        <strong>Senha:</strong> {{ $server->credential->password }} <br />
                                                    @endif
                                                </div>
                                            </dd>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="custom-tabs-three-service" role="tabpanel"
                                    aria-labelledby="custom-tabs-three-service-tab">
                                    ...
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-three-employee" role="tabpanel"
                                    aria-labelledby="custom-tabs-three-employee-tab">
                                    ...
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-three-integration" role="tabpanel"
                                    aria-labelledby="custom-tabs-three-integration-tab">
                                    ...
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-three-detail" role="tabpanel"
                                    aria-labelledby="custom-tabs-three-detail-tab">

                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4 class="text-primary">Link's</h4>
                                                @foreach($application->details as $detail)
                                                    @if($detail->type == "Link")
                                                    <dd>
                                                        <h6>
                                                            <span>{{ $detail->environment->name }} :
                                                                <a target="_blank" class="text-secondary"
                                                                    href="{{ $detail->content }}">{{ $detail->content }}</a>
                                                            </span>
                                                        </h6>
                                                    </dd>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="col-md-6">
                                                <h4 class="text-primary">Diretório's</h4>
                                                @foreach($application->details as $detail)
                                                    @if($detail->type == "Diretório")
                                                    <dd>
                                                        <h6>
                                                            <span>{{ $detail->environment->name }} :
                                                                {{ $detail->content }}
                                                            </span>
                                                        </h6>
                                                    </dd>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

            </div>
            <!-- /.card -->

        </div>
        <!-- /.col-md-12 -->

    </div>
</section>

@endsection

@section('scripts')
@stop