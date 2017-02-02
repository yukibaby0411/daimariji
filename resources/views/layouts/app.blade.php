<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{-- config('app.name', 'Laravel') --}}
        @yield('title', 'snowday') - 代码日记 - 一只程序猿的自传
        @yield('title', 'snowday
        ') - 代码日记 - 一只程序猿的自传
    </title>
    <link rel="icon" href="/images/icon.png">
    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <style>
        .app-content{min-height: 678px;}
        .font-normal{ font-style: normal;}
        @media screen and (max-width: 770px) {
            #search_input,#search_icon{ display: none;}
        }
    </style>
</head>
<body>

    <div id="app">
        @include('layouts._header')
        @yield('js_app_promise')
        <div class="app-content">
            @yield('content')
        </div>
        @include('layouts._footer')
    </div>

    <!-- Scripts -->
    @yield('js_app_layouts')
</body>
</html>
