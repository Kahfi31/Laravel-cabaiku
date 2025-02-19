<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cabaiku</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* Menghilangkan margin & padding default */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        /* Background dengan overlay gelap */
        body {
    background: linear-gradient(to right, #b44e39, #6f8b4e); /* Warna merah ke hijau */
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    position: relative;
    color: white;
    padding-top: 100px;
}

/* Header */
.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    padding: 15px 50px;
    font-family: 'Krona One';
    position: absolute;
    top: 0px;
    left: 0;
    z-index: 1000; /* Pastikan header ada di atas semua elemen */
}

/* Logo */
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


/* Login */
.login {
    font-size: 16px;
    color: white;
}


/* Menambahkan overlay semi-transparan */
.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0.5, 0, 0, 0.2); /* Transparansi 50% */
    z-index: -1; /* Menempatkan overlay di atas gambar */
}

/* Menambahkan konten di atas gambar dan overlay */
.content {
    position: relative;
    z-index: 2; /* Membuat konten berada di atas overlay */
    text-align: center;
    padding-top: 20%;
}

/* Menetapkan warna merah pada elemen h1 di dalam login-container */
.login-container h1 {
    color: red !important; /* Menetapkan warna merah untuk tulisan "Login" */
    font-weight: bold !important; /* Membuat teks menjadi tebal (bold) */
    font-family: 'Arial', sans-serif !important; /* Mengubah gaya font */
    font-size: 3rem !important; /* Ukuran font besar untuk h1 */
    margin-bottom: 20px; /* Menambahkan jarak bawah */
}

/* Login Form */
.login-container {
    position: relative;
    z-index: 3; /* Formulir login berada di atas overlay */
}

.content p, label, h1 .form-control {
    color: red !important; /* Menetapkan warna merah untuk elemen lainnya */
}

.btn-primary {
    background-color: red !important; /* Ganti latar belakang tombol dengan merah */
    border-color: red !important; /* Ganti border tombol dengan merah */
    color: white !important; /* Ubah warna teks di dalam tombol menjadi putih */
}

.btn-primary:hover {
    background-color: darkred !important; /* Warna saat hover */
    border-color: darkred !important;
}

/* Menjaga tulisan "Belum punya akun?" tetap warna hitam */
.text-center.mt-3 {
    color: black !important; /* Menetapkan warna hitam untuk teks tersebut */
}

.text-center.mt-3 a {
    color: blue !important; /* Menetapkan warna biru untuk link "Daftar" */
}

.text-center.mt-3 a:hover {
    color: darkblue !important; /* Warna biru tua saat hover */
}

    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">Cabaiku</div>

            <nav class="menu-container">
                <ul class="nav">
                    <li><a href="{{ url ('/') }}">Home</a></li>
                    <li><a href="{{ url ('/daftarjenis') }}" >Jenis</a></li>
                    <li><a href="{{ url ('/daftarhama') }}" >Hama dan Penyakit</a></li>
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
                        <li><a href="{{ url('/login') }}" class="active">Login</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </header>

    <div class="login-container container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
            <h1 class="text-center mb-4">Login</h1>
            <form id="loginForm" action="{{ route('login') }}" method="POST">
                @csrf <!-- CSRF Token -->
                <!-- Email Input -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email" required>
                </div>
                <!-- Password Input -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            <p class="text-center mt-3">Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none">Daftar</a></p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
