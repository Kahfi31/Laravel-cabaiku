@extends('layouts.app')

@section('content')
<h1>Edit Artikel Hama dan Penyakit</h1>

<form action="{{ route('jenis.update', $article->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="title">Judul</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $article->title) }}" required>
    </div>
    <div class="form-group">
        <label for="content">Konten</label>
        <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content', $article->content) }}</textarea>
        <button type="button" class="btn btn-primary mt-2" onclick="insertImage()">Sisipkan Gambar dari URL</button>
    </div>
    <div class="form-group">
        <label for="image">Gambar</label>
        <input type="file" name="image" id="image" class="form-control">
        @if ($article->image)
            <div style="margin-top: 10px;">
                <label>Gambar Saat Ini:</label>
                <img src="{{ asset('storage/'.$article->image) }}" alt="Current Image" style="width: 100px;">
            </div>
        @endif
    </div>
    <button type="submit" class="btn btn-success mt-3">Perbarui</button>
</form>

@push('scripts')
<script>
    // Fungsi untuk menyisipkan gambar URL ke dalam textarea
    function insertImage() {
        const url = prompt("Masukkan URL gambar:");
        if (url && isValidUrl(url)) {
            const textarea = document.getElementById("content");
            if (!textarea) return;

            const imageTemplate = `<img src="${url}" alt="Deskripsi gambar" style="max-width: 100%;">`;
            insertAtCursor(textarea, imageTemplate);
        } else {
            alert("URL tidak valid. Silakan coba lagi.");
        }
    }

    // Fungsi untuk menyisipkan teks di posisi kursor dalam textarea
    function insertAtCursor(textarea, text) {
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const before = textarea.value.substring(0, start);
        const after = textarea.value.substring(end, textarea.value.length);

        textarea.value = before + text + after;

        // Mengembalikan fokus ke textarea
        textarea.focus();
        textarea.selectionStart = textarea.selectionEnd = start + text.length;
    }

    // Fungsi untuk validasi URL
    function isValidUrl(string) {
        try {
            new URL(string);
            return true;
        } catch (_) {
            return false;
        }
    }
</script>
@endpush

@endsection
