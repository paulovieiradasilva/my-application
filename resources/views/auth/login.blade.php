@extends('layouts.auth')

@section('content')

<div class="login-box container mt-5">
    <div class="login-logo">
        <a href="#"><b>My</b> Aplications</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Faça login para iniciar sua sessão</p>

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach($errors->all() as $error)
                        <span style="color: white">{!! $error !!}</span><br>
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}"
                        placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Lembre de min
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-flat btn-block">Login</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <hr>
            <!-- /.social-auth-links -->

            @if(Route::has('password.request'))
                <p class="mb-1">
                    <a href="{{ route('password.request') }}">{{ __('Esqueceu sua senha?') }}</a>
                </p>
            @endif
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

@endsection
