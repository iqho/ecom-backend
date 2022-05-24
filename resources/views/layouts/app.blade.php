<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        />

        <link href="{{ asset('assets/css/custom-css.css') }}" rel="stylesheet">

    </head>

    <body>
        <!-- Navigation -->
        @include('partials.side-navbar')

        <!-- Content -->
        <main>
            @include('partials.top-navbar')
            <div class="p-4" style="z-index: -999">
                @yield('content')
            </div>
        </main>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.2/umd/popper.min.js"></script>
        <script src="{{ asset('assets/js/custom-script.js') }}"></script>
    </body>
</html>
