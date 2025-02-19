@extends('layouts.app')

@section('content')
<h1>Artikel Jenis</h1>
<a href="{{ route('jenis.create') }}" class="btn btn-primary">Tambah Artikel</a>
<table class="table mt-3">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Konten</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
        <tr>
            <td>{{ $article->title }}</td>
            <td>{{ Str::limit($article->content, 100) }}</td>
            <td>
                @if ($article->image)
                    <img src="{{ asset('storage/'.$article->image) }}" alt="Image" style="width: 100px;">
                @else
                    <span>No Image</span>
                @endif
            </td>
            <td>
                <a href="{{ route('jenis.show', $article->id) }}" class="btn btn-warning btn-sm">Lihat</a>
                <a href="{{ route('jenis.edit', $article->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('jenis.destroy', $article->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
