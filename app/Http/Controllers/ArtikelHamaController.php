<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelHamaController extends Controller
{

    /**
     * Menampilkan daftar artikel.
     */
    public function index()
    {
        $articles = Article::where('category', 'hama_penyakit')->get();
        return view('hama_penyakit.index', compact('articles'));
    }

    /**
     * Menampilkan form untuk menambahkan artikel baru.
     */
    public function create()
    {
        return view('hama_penyakit.create');
    }

    /**
     * Menyimpan artikel baru ke dalam database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title.*' => 'required|string|max:255',
            'content.*' => 'required|string',
            'category.*' => 'required|string',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10480',
        ]);

        $titles = $request->title ?? [];
        $contents = $request->content ?? [];
        $categories = $request->category ?? [];
        $images = $request->file('image') ?? [];

        foreach ($titles as $key => $title) {
            // Proses penyimpanan gambar jika ada
            $imagePath = isset($images[$key]) ? $images[$key]->store('images', 'public') : null;

            // Simpan artikel baru ke database
            $article = new Article();
            $article->title = $title;
            $article->content = $contents[$key];
            $article->image = $imagePath;
            $article->category = $categories[$key];
            $article->user_id = auth()->id();
            $article->save();
        }

        return redirect()->route('hama_penyakit.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit artikel.
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('hama_penyakit.edit', compact('article'));
    }

    /**
     * Memperbarui artikel yang ada di database.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10480',
        ]);

        // Cari artikel yang ingin diperbarui
        $article = Article::findOrFail($id);

        // Proses penyimpanan gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            // Jika tidak ada gambar baru, gunakan gambar lama
            $imagePath = $article->image;
        }

        // Perbarui data artikel
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->image = $imagePath;
        $article->category = $request->input('category'); // Simpan kategori
        $article->user_id = auth()->id(); // Ambil ID user yang sedang login
        $article->save();

        return redirect()->route('hama_penyakit.index')->with('success', 'Artikel berhasil diperbarui');
    }

    /**
     * Menghapus artikel dari database.
     */
    public function destroy($id)
    {
        // Mencari artikel yang akan dihapus
        $article = Article::findOrFail($id);

        // Menghapus gambar terkait jika ada
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }


        // Menghapus artikel
        $article->delete();

        return redirect()->route('hama_penyakit.index')->with('success', 'Artikel berhasil dihapus.');
    }

    public function show($id)
{
    $article = Article::findOrFail($id);
    return view('hama_penyakit.show', compact('article'));
}

}
