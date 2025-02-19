<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Artikel - Cabaiku</title>
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* HEADER BACKGROUND */
        .header-background {
            background: url('{{ asset("images/background-hama.png") }}') no-repeat center center;
            background-size: cover;
            height: 750px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding: 50px 20px;
            position: relative;
            font-family: 'Krona One';
            text-align: flex-start;
        }

        .header-background::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6); /* Gelapkan background tanpa mempengaruhi teks */
    z-index: 1;
}

/* Pastikan teks dan elemen lain tetap terlihat */
.header-background > * {
    position: relative;
    z-index: 2;
}

        /* JUDUL DI ATAS HEADER */
        .header-title {
            font-size: 2rem;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
            font-family: 'Krona One';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            z-index: 2;
        }

        .header-container {
    display: flex;
    justify-content: space-between; /* Memisahkan logo di kiri dan login di kanan */
    align-items: center;
    width: 100%;
    padding: 15px 50px;
    position: absolute;
    top: 0px;
    left: 0;
}

/* Logo di kiri */
.logo {
    font-size: 24px;
    font-weight: bold;
    color: white;
}

/* Navigasi di tengah */
.menu-container {
    flex: 1;
    display: flex;
    justify-content: center;
}

/* Login di kanan */
.login {
    font-size: 16px;
    color: white;
}

        /* NAVIGATION */
        .menu-container {
            margin-top: 0px;
        }

        .nav {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 15px; /* Jarak antar item lebih rapi */
}

.nav li {
    list-style: none;
}

.nav a {
    text-decoration: none;
    font-size: 16px;
    font-weight: bold;
    color: #ffff;
    padding: 8px 12px;
    font-family: 'Krona One';
    position: relative;
    transition: color 0.3s ease-in-out;
}

.nav a:hover,
.nav a.active {
    color: #007BFF;
}

.nav a.active::after,
.nav a:hover::after {
    content: '';
    display: block;
    width: 100%;
    height: 3px;
    background-color: #007BFF;
    position: absolute;
    bottom: -3px;
    left: 0;
    transition: width 0.3s ease-in-out;
}

        /* ARTICLE PREVIEW */
        .article-preview {
            display: flex;
            border: 3px solid green;
            padding: 40px;
            width: 800px;
            height: 300px;
            border-radius: 8px;
            background-color: green;
            margin: 40px auto;
            color: white;
        }

        .article-preview img {
            width: 150px;
            height: 100px;
            object-fit: cover;
            margin-right: 15px;
            border-radius: 5px;
        }

        .article-content {
            flex: 1;
            position: relative;
        }

        .text-muted {
            position: absolute;
            bottom: -45px;
            right: 15px;
            font-size: 0.9rem;
            color: white;
        }
    </style>
</head>
<body>
    <header class="header-background">
        <div class="header-container">
            <div class="logo">Cabaiku</div>

            <nav class="menu-container">
                <ul class="nav">
                    <li><a href="{{ url ('/') }}">Home</a></li>
                    <li><a href="{{ url ('/daftarjenis') }}" >Jenis</a></li>
                    <li><a href="{{ url ('/daftarhama') }}" class="active">Hama dan Penyakit</a></li>
                    <li><a href="#">Prediksi</a></li>
                    <li><a href="{{ url ('/tentang-kami') }}">Tentang Kami</a></li>
                </ul>
            </nav>

            <div class="login">
                <ul class="nav">
                    @if (Auth::check())
                    <li class="dropdown">
                        <button class="nav-link user-profile dropdown-toggle" onclick="toggleDropdown(event)">
                            <img src="{{ Auth::user()->avatar ?? asset('images/default-avatar.png') }}" alt="Avatar" class="avatar">
                            Halo, {{ Auth::user()->name }}
                        </button>
                        <div id="dropdown-menu" class="dropdown-menu">
                            <a href="{{ url('/profil') }}">Profil</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </div>
                    </li>
                    @else
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </header>

    <h1 class="header-title">Daftar Artikel Hama dan Penyakit</h1>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @foreach($articles as $article)
            @if($article->category == 'hama_penyakit')
            <div class="article-preview">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                <div class="article-content">
                    <h2>
                        <a href="{{ route('hama_penyakit.show', $article->id) }}" class="text-decoration-none text-dark">
                            {{ $article->title }}
                        </a>
                    </h2>
                    <p class="text-muted">Dipublikasikan pada {{ $article->created_at->format('d M Y') }}</p>
                    <p>{{ Str::limit($article->content, 150) }}
                        <a href="{{ route('hama_penyakit.show', $article->id) }}">Baca selengkapnya</a>
                    </p>
                </div>
            </div>
            @endif
            @endforeach

            @if($articles->isEmpty())
                <p class="text-center">Tidak ada artikel untuk ditampilkan.</p>
            @endif
        </div>
    </div>
</div>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.27.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.27.0/plugins/autoloader/prism-autoloader.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var fadeInElements = document.querySelectorAll('.fade-in');
            fadeInElements.forEach(function(element) {
                element.classList.add('visible');
            });
        });
    </script>
</body>
</html>
