<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- PWA  -->
    {{-- <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('firebase.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}"> --}}
</head>

<body>
    @yield('content')

    {{-- <script src="{{ asset('/sw.js') }}"></script> --}}
    {{-- <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/sw.js").then(function(reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script> --}}
    <script>
        const csrfToken = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('firebase.js') }}" type="module"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    @stack('js')
</body>

</html>
