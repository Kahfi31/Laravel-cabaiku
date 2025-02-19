<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Cabaiku</title>

    <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- AOS (Animate On Scroll) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
body {
    background: url('{{ asset("images/background-tentang-kami.gif") }}') no-repeat center center fixed;
    background-size: cover;
    background-position: center center;
    background-attachment: fixed;
    height: 100vh;
    color: black;
}

body::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Sesuaikan transparansi */
    z-index: -1;
}

/* Header container */
.header-container {
    display: flex;
    justify-content: space-between; /* Memisahkan logo di kiri dan login di kanan */
    align-items: center;
    width: 100%;
    padding: 15px 50px;
    position: absolute;
    font-family : 'Krona One';
    top: 0px;
    left: 0;
}

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


/* Border hijau di seluruh container */
.container {
    background-color: rgba(255, 255, 255, 0.8); /* Latar belakang semi-transparan */
    padding: 30px;
    border-radius: 15px; /* Membuat sudut border melengkung */
    border: 5px solid rgba(0, 128, 0, 0.9); /* Border hijau */
    text-align: center;
    margin: 50px auto;
    box-shadow: 0 4px 10px rgba(0, 128, 0, 0.3); /* Efek bayangan hijau */
}

/* Animasi Floating untuk Gambar */
.gambar-3d {
    width: 600px;
    animation: floating 3s ease-in-out infinite;
    margin-top: 150px; /* Geser ke bawah sejauh 50px */
}

@keyframes floating {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
    100% { transform: translateY(0px); }
}

/* Animasi teks */
.animated-title, .animated-text {
    opacity: 0;
    transform: translateY(50px);
    transition: all 0.6s ease-in-out;
}

.aos-animate {
    opacity: 1 !important;
    transform: translateY(0) !important;
}

/* Paragraf rata kanan-kiri */
p {
    font-size: 24px;
    line-height: 1.6;
    text-align: justify;
}

/* Judul lebih besar dan bold */
h2 {
    font-style: italic; /* Membuat teks miring */
    font-size: 48px;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0, 128, 0, 0.6); /* Efek bayangan hijau */
    color: #006400; /* Warna hijau tua */
}

/* Ukuran subjudul lebih besar */
h3 {
    font-style: italic; /* Membuat teks miring */
    font-size: 32px;
    font-weight: bold;
    text-shadow: 1px 1px 3px rgba(0, 128, 0, 0.5);
    color: #006400;
}

/* Memperbesar teks pada misi dan menambahkan bullet */
.misi ul {
    font-size: 24px;
    text-align: justify;
    list-style-type: disc;
    padding-left: 20px;
}


    </style>
</head>
<body>

    <header class="body">
        <div class="header-container">
            <div class="logo">Cabaiku</div>

            <nav class="menu-container">
                <ul class="nav">
                    <li><a href="{{ url ('/') }}">Home</a></li>
                    <li><a href="{{ url ('/daftarjenis') }}" >Jenis</a></li>
                    <li><a href="{{ url ('/daftarhama') }}" >Hama dan Penyakit</a></li>
                    <li><a href="#">Prediksi</a></li>
                    <li><a href="{{ url ('/tentang-kami') }}" class="active">Tentang Kami</a></li>
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
</body>
</html>

    <!-- Gambar 3D -->
    <div class="text-center my-3">
        <img src="{{ asset('images/pngtree-realistic-vector-chilli-png-image_8872212.png') }}" class="gambar-3d img-fluid" alt="Gambar 3D">
    </div>

   <!-- Tentang Cabaiku -->
<section class="container text-center">
    <h2 class="animated-title" data-aos="fade-up">Tentang Cabaiku</h2>
    <p class="animated-text" data-aos="fade-up">
        Cabaiku adalah platform untuk mendeteksi dan memprediksi hama atau penyakit yang ada pada cabai. Dengan kehadiran Cabaiku, diharapkan dapat memudahkan para petani atau pemula yang ingin menanam cabai untuk mengetahui apa saja jenis, hama, dan penyakit yang ada pada cabai sehingga dapat dilakukan pencegahan lebih cepat.
    </p>
</section>

<!-- Visi dan Misi -->
<section class="container text-center">
    <h2 class="animated-title" data-aos="fade-up">Visi dan Misi Cabaiku</h2>

    <div class="visi mt-3" data-aos="fade-up">
        <h3>Visi</h3>
        <p>
            Menjadi platform pendeteksi hama dan penyakit terbaik yang dapat memudahkan masyarakat untuk melakukan pencegahan lebih cepat.
        </p>
    </div>

    <div class="misi mt-3" data-aos="fade-up">
        <h3>Misi Kami</h3>
        <ul>
            <li>Menyediakan artikel seperti hama penyakit dan jenis untuk memudahkan para petani atau pemula yang ingin menanam cabai.</li>
            <li>Memudahkan para petani untuk mendeteksi hama pada cabai.</li>
            <li>Jika mengalami kesulitan saat menggunakan website, bisa menggunakan layanan chat yang interaktif untuk bertanya.</li>
        </ul>
    </div>
</section>


    <!-- AOS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800, // Durasi animasi lebih cepat
            mirror: true // Animasi tetap berjalan saat di-scroll ke atas dan ke bawah
        });
    </script>

</body>
</html>
