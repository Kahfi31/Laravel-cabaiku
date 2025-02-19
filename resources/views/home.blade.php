<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabaiku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header class="header">
        <div class="logo">Cabaiku</div>

        <div class="menu-container">
            <ul class="nav">
                <li><a href="{{ url ('/') }}" class="active">Home</a></li>
                <li><a href="{{ url ('/daftarjenis')}}">Jenis</a></li>
                <li><a href="{{ url ('/daftarhama')}}">Hama dan Penyakit</a></li>
                <li><a href="#">Prediksi</a></li>
                <li><a href="{{ url ('/tentang-kami')}}">Tentang Kami</a></li>
            </ul>
        </div>

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
    </header>

    <section class="gambar-home">
        <div class="overlay">
            <h1 id="typed-text"></h1> <!-- Menambahkan ID 'typed-text' untuk animasi -->
        </div>
        <div class="slideshow">
            <img src="https://www.dgwfertilizer.co.id/wp-content/uploads/2020/10/Hama-dna-Penyakit-Cabai-1024x575.jpg" alt="gambar-home" class="img active">
            <img src="http://1.bp.blogspot.com/-VDz48B_Iql0/UzkgyDlGECI/AAAAAAAAAkY/ymnCR3nqnt8/s1600/Hama_Cabai.JPG" alt="gambar-home" class="img">
            <img src="https://bukubiruku.com/wp-content/uploads/2016/09/IMG-20150114-WA0002.jpg" alt="gambar-home" class="img">
        </div>
    </section>

    <!-- Script untuk Typed.js -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script>
        // Menambahkan animasi teks menggunakan Typed.js
        var typed = new Typed('#typed-text', {
            strings: ["Selamat Datang di Cabaiku", "Website untuk mendeteksi hama pada cabai."], // Teks yang ingin ditampilkan
            typeSpeed: 50,  // Kecepatan mengetik
            backSpeed: 30,  // Kecepatan menghapus
            backDelay: 1000, // Waktu delay sebelum menghapus
            loop: true
        });

        // Slideshow gambar
        const slides = document.querySelectorAll('.slideshow .img');
        let currentSlide = 0;

        function showNextSlide() {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }

        setInterval(showNextSlide, 5000); // Slideshow berganti setiap 5 detik
    </script>

    <div class="container mt-5">
        <h1 class="text-center">Mari mulai untuk membasmi hama </h1>
        <div class="d-flex justify-content-center">
            <a href="{{ url('/siswa/kategori-soal') }}" class="btn btn-primary mx-2">Prediksi</a>
            <a href="{{ url('/tentang-kami') }}" class="btn btn-outline-primary mx-2">Tentang cabaiku</a>
        </div>
    </div>

    <section class="gambar-cabai">
        <div class="overlay">
            <h1 class="slide-up">Jenis Tanaman Cabai</h1>
            <p class="slide-up">Tanaman Cabai di Indonesia memiliki berbagai macam jenis.</p>
            <div class="d-flex justify-content-center mt-3">
                <a href="{{ url('/daftarjenis') }}" class="btn btn-primary mx-2">Jenis Cabai</a>
            </div>
        </div>
        <div class="scroll-container">
            <img src="https://www.kampustani.com/wp-content/uploads/2018/10/Cara-Budidaya-Cabai-Di-Polybag.jpg" alt="gambar-cabai">
            <img src="https://bisatani.com/wp-content/uploads/2021/04/tanaman-cabai-1024x740.jpg" alt="gambar-cabai">
            <img src="https://hortiindonesia.com/img/posts/image/784028e3-ba24-4983-a181-81075ff4ae9a/6%20Hama%20pada%20Tanaman%20Cabai%20Merah.jpeg" alt="gambar-cabai">
        </div>
    </section>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
    // Animasi scroll otomatis untuk gambar
    const container = document.querySelector(".scroll-container");
    const images = document.querySelectorAll(".scroll-container img");
    let currentIndex = 0;

    function scrollToNext() {
        currentIndex = (currentIndex + 1) % images.length; // Loop gambar
        const scrollAmount = container.clientWidth * currentIndex;
        container.scrollTo({
            left: scrollAmount,
            behavior: "smooth"
        });
    }

    // Jalankan scroll otomatis setiap 5 detik
    setInterval(scrollToNext, 5000);

    // Animasi teks muncul ketika scroll
    const elements = document.querySelectorAll(".slide-up");

    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return rect.top >= 0 && rect.bottom <= (window.innerHeight || document.documentElement.clientHeight);
    }

    function handleScrollAnimation() {
        elements.forEach((el) => {
            if (isInViewport(el)) {
                el.classList.add("active"); // Tambahkan animasi jika elemen terlihat
            } else {
                el.classList.remove("active"); // Hapus animasi jika elemen keluar dari viewport
            }
        });
    }

    // Jalankan fungsi animasi teks saat halaman di-scroll
    window.addEventListener("scroll", handleScrollAnimation);

    // Jalankan animasi teks saat halaman pertama kali dimuat
    handleScrollAnimation();
    });
    </script>

<section class="gambar-hama">
    <div class="overlay">
        <h1 class="slide-up">Hama Tanaman Cabai</h1>
        <p class="slide-up">Hama tanaman cabai dapat merusak hasil panen petani.</p>
        <div class="d-flex justify-content-center mt-3">
            <a href="{{ url('daftarhama') }}" class="btn btn-primary mx-2">Hama Cabai</a>
        </div>
    </div>
    <div class="scroll-horizontal">
        <img src="https://sp-ao.shortpixel.ai/client/q_glossy,ret_img,w_2000,h_1429/https://paktanidigital.com/artikel/wp-content/uploads/2018/11/Thrips-Hama-Penyebab-Daun-Cabai-Keriting.jpg" alt="gambar-hama">
        <img src="https://static.promediateknologi.id/crop/0x0:0x0/750x500/webp/photo/2022/09/09/291118661.jpg" alt="gambar-hama">
        <img src="https://asset.kompas.com/crops/P1BicoTdkVlPKqfuZAS1C2aaByU=/100x67:900x600/750x500/data/photo/2023/02/02/63db17d6a7ca1.jpg" alt="gambar-hama">
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Animasi teks (slide-up)
    const elements = document.querySelectorAll(".slide-up");

    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return rect.top >= 0 && rect.bottom <= (window.innerHeight || document.documentElement.clientHeight);
    }

    function handleScrollAnimation() {
        elements.forEach((el) => {
            if (isInViewport(el)) {
                el.classList.add("active");
            } else {
                el.classList.remove("active");
            }
        });
    }

    window.addEventListener("scroll", handleScrollAnimation);
    handleScrollAnimation(); // Jalankan pada saat halaman pertama kali dimuat

    // Scroll otomatis ke kanan
    const container = document.querySelector(".scroll-horizontal");
    let currentScroll = 0;

    function scrollToNext() {
        // Pindah ke gambar berikutnya (ke kanan)
        currentScroll += container.clientWidth;
        if (currentScroll >= container.scrollWidth) {
            currentScroll = 0; // Reset ke awal jika sudah mencapai akhir
        }
        container.scrollTo({
            left: currentScroll,
            behavior: "smooth",
        });
    }

    function toggleDropdown() {
    var dropdown = document.getElementById("dropdown-menu");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}

// Menutup dropdown saat klik di luar
document.addEventListener("click", function(event) {
    var dropdown = document.getElementById("dropdown-menu");
    var button = document.querySelector(".dropdown-toggle");

    if (!button.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.style.display = "none";
    }
});


    setInterval(scrollToNext, 5000); // Jalankan setiap 5 detik
});
</script>

</body>
</html>
