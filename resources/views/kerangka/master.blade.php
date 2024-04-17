
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('include.style') 
</head>
<body>
    <div id="app">
    @include('include.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            
<div class="page-heading">
    @auth
        @if(Auth::check())
            <h3>{{ Auth::user()->name }}</h3>
        @endif
    @endauth
</div>
    @yield('content')
    @include('include.footer')

    <!-- Skrip Alert untuk Peringatan Error -->
    @if (session('error'))
    <script>
        alert('{{ session('error') }}');
        window.onload = function() {
            // Fokuskan kembali ke input yang diinginkan jika perlu
            // Contoh: document.getElementById('ID_INPUT_REALISASI_AWAL').focus();
        };
    </script>
    @endif
    
    @include('include.script')
    
</body>
</html>
