<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.fixed.head') 

    @include('layouts.fixed.loader')
    
</head>

<body class="app">

    <!-- Preloader -->
    <div id="loader">
        <div class="spinner"></div>
    </div>

    <div>
        @include('layouts.fixed.sidebar')
        <div class="page-container">
            @include('layouts.fixed.navbar')
            <main class="main-content bgc-grey-100">
                <div id="mainContent">

                    @yield('content')

                </div>
            </main>
        </div>
    </div>

    @include('layouts.fixed.footer-scripts') 

</body>
</html>