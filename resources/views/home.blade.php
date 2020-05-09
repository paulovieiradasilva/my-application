@extends('layouts.app')

@section('content')

<div class="row">
    @foreach($applications as $app)
        <div class="col-sm-3">
            <div class="card card-danger card-outline">
                <div class="card-body">
                    <h4>{{ $app->name }}</h4>
                    <h6 class="text-danger card-subtitle mb-2">R3</h6>
                    <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-info-circle"></i> Detalhes</a>
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
