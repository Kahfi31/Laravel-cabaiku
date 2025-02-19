@extends('layouts.app')

@section('content')
    <h1>Tambah Artikel Hama dan Penyakit</h1>

    <form action="{{ route('hama_penyakit.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" name="title[]" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="content">Konten</label>
            <textarea name="content[]" id="content" class="form-control" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Gambar</label>
            <input type="file" name="image[]" id="image" class="form-control" multiple>
        </div>
        <div class="form-group">
            <label for="category">Kategori:</label>
            <select name="category[]" id="category" required>
                <option value="jenis">Jenis</option>
                <option value="hama_penyakit">Hama & Penyakit</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Simpan</button>
    </form>

    <a href="{{ route('hama_penyakit.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection
