@extends('layouts.apparticles')

@section('title', $article->title)

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Artikel Header -->
                <div class="text-center mb-4">
                    <h1 class="display-4 fade-in">{{ $article->title }}</h1>
                    <p class="text-muted fade-in">Dipublikasikan pada {{ $article->created_at->format('d M Y') }}</p>
                </div>

                <!-- Gambar Artikel (jika ada) -->
                @if ($article->image)
                    <div class="mb-4 fade-in">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="img-fluid rounded shadow-lg">
                    </div>
                @endif

                <!-- Konten Artikel -->
                <div class="content-article fade-in mb-5">
                    <p>{!! nl2br(e($article->content)) !!}</p>

                <!-- Tombol untuk Kembali ke Daftar Artikel -->
                <div class="text-center mt-5">
                    <a href="{{ route('jenis.index') }}" class="btn btn-outline-primary">Kembali ke Daftar Artikel</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* CSS untuk Animasi dan Tampilan Artikel */
        .fade-in {
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .fade-in.visible {
            opacity: 1;
        }

        .content-article p {
            font-size: 1.2rem;
            line-height: 1.6;
            color: #555;
        }

        .content-article img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .display-4 {
            font-weight: bold;
            color: #333;
        }

        /* Efek hover pada tombol */
        .btn-outline-primary {
            border-radius: 25px;
            text-transform: uppercase;
            font-weight: 600;
            transition: all 0.3s ease-in-out;
        }

        .btn-outline-primary:hover {
            transform: scale(1.05);
            background-color: #007bff;
            color: white;
        }

        /* Highlight.js styling */
        pre {
            background-color: #2d2d2d;
            padding: 20px;
            border-radius: 10px;
            overflow-x: auto;
        }

        code {
            color: #f8f8f2;
            font-family: 'Courier New', Courier, monospace;
            font-size: 1rem;
        }
    </style>
@endsection

@section('scripts')
    <!-- Highlight.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.0/highlight.min.js"></script>
    <script>
        // Aktifkan syntax highlighting untuk semua elemen <pre><code>
        document.addEventListener('DOMContentLoaded', (event) => {
            hljs.highlightAll();
        });
    </script>
@endsection
