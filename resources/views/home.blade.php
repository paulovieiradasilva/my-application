@extends('layouts.app')
@section('content')

<section class="my-content animated fadeIn">
    <div class="row">

        @foreach($applications as $app)
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-secondary">{{ $app->name }}</h4>
                    <p class="card-text">{{ $app->tower->name }}</p>

                    <hr>
                    <a href="{{ route('applications.show', $app->id) }}" class="card-link">{{ __('Details') }}</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    {{ $applications->links() }}
</section>

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