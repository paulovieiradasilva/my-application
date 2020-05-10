@extends('layouts.app')

@section('content')

<div class="row">
    @foreach($applications as $app)
        <div class="col-sm-3">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <h4>{{ $app->name }}</h4>
                    <h6 class="text-primary card-subtitle mb-2">{{ $app->tower->name }}</h6>
                    <a href="{{ route('applications.index')}}/{{$app->id}}" class="btn btn-sm btn-primary">Detalhes</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {

        $('#search-app').keyup(function (e) {
            console.log(e.target.value);
        })

        $('body').on('blur', '#search-app', function (e) {
            $('#search-app').val('')
            console.log('saiu do foco!');
        })
    });

</script>
@stop
