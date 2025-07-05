<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
{{-- <link rel="icon" href="/favicon.svg" type="image/svg+xml"> --}}
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />


@if (config('app.env') == 'local')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@else
    <link href="/build/assets/app-By5eI1eP.css" rel="stylesheet" />
    <script src="/build/assets/app-l0sNRNKZ.js"></script>
@endif

@fluxAppearance
