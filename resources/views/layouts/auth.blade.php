<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.partials._html-head')

<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    @include('layouts.partials._scripts')

</body>

</html>
