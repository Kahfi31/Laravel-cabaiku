<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Artikel - Cabaiku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header class="header">
        <div class="logo">Cabaiku</div>

        <div class="menu-container">
            <ul class="nav">
                <li><a href="{{ url ('/') }}" >Home</a></li>
                <li><a href="{{ url ('/daftarjenis')}}">Jenis</a></li>
                <li><a href="{{ url ('/daftarhama')}}">Hama dan Penyakit</a></li>
                <li><a href="#">Prediksi</a></li>
                <li><a href="{{ url ('/tentang-kami')}}">Tentang Kami</a></li>
            </ul>
        </div>

        <div class="login">
            <ul class="nav">
                @if (Auth::check())
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-link" style="background: none; border: none; padding: 0; cursor: pointer; color: inherit;">
                                Halo, {{ Auth::user()->name }}
                            </button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ url('/login') }}">Login</a></li>
                @endif
            </ul>
        </div>
    </header>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
