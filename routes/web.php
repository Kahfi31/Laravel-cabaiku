<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ArtikelHamaController;
use App\Http\Controllers\ArtikelJenisController;
use App\Http\Controllers\ChatbotController;
use App\Models\Article;

Route::get('/', function () {
    return view('home');
});

// Rute untuk halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Rute untuk proses login
Route::post('/login', [LoginController::class, 'login']);

// Rute untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Form Register
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Proses Register
Route::post('register', [RegisterController::class, 'register']);

Route::middleware(['auth', 'isAdmin:admin'])->prefix('admin')->group(function () {
    // Halaman CRUD yang hanya bisa diakses oleh Admin
    Route::get('jenis/create', [ArtikelJenisController::class, 'create'])->name('jenis.create');
    Route::get('jenis', [ArtikelJenisController::class, 'index'])->name('jenis.index');
    Route::post('jenis', [ArtikelJenisController::class, 'store'])->name('jenis.store');
    Route::get('jenis/{id}/edit', [ArtikelJenisController::class, 'edit'])->name('jenis.edit');
    Route::put('jenis/{id}', [ArtikelJenisController::class, 'update'])->name('jenis.update');
    Route::delete('jenis/{id}', [ArtikelJenisController::class, 'destroy'])->name('jenis.destroy');

    Route::get('hama/create', [ArtikelHamaController::class, 'create'])->name('hama_penyakit.create');
    Route::get('hama', [ArtikelHamaController::class, 'index'])->name('hama_penyakit.index');
    Route::post('hama', [ArtikelHamaController::class, 'store'])->name('hama_penyakit.store');
    Route::get('hama/{id}/edit', [ArtikelHamaController::class, 'edit'])->name('hama_penyakit.edit');
    Route::put('hama/{id}', [ArtikelHamaController::class, 'update'])->name('hama_penyakit.update');
    Route::delete('hama/{id}', [ArtikelHamaController::class, 'destroy'])->name('hama_penyakit.destroy');
    Route::get('hama/{article}', [ArtikelHamaController::class, 'show'])->name('hama_penyakit.show');
});

Route::get('daftarjenis/{article}', [ArtikelJenisController::class, 'show'])->name('jenis.show');
Route::get('daftarhama/{article}', [ArtikelHamaController::class, 'show'])->name('hama_penyakit.show');

Route::get('/daftarhama', function() {
    $articles = Article::latest()->paginate(10); // Menampilkan artikel terbaru dengan pagination
    return view('daftararticleshama', compact('articles'));
})->name('hama_penyakit.index');

Route::get('/daftarhama/{id}', function($id) {
    $article = Article::findOrFail($id); // Menampilkan artikel berdasarkan ID
    return view('hama_penyakit.show', compact('article'));
})->name('hama_penyakit.show');

Route::get('/daftarjenis', function() {
    $articles = Article::latest()->paginate(10); // Menampilkan artikel terbaru dengan pagination
    return view('daftararticlesjenis', compact('articles'));
})->name('jenis.index');

Route::get('/daftarjenis/{id}', function($id) {
    $article = Article::findOrFail($id); // Menampilkan artikel berdasarkan ID
    return view('jenis.showartikel', compact('article'));
})->name('jenis.show');

// AboutUS==============================================================================================================
Route::get('/tentang-kami', function () {
    return view('tentangkami');
})->name('tentangkami');


Route::get('/chatbot', [ChatbotController::class, 'index']); // Menampilkan view chatbot
Route::post('/chatbot/analyze', [ChatbotController::class, 'analyze']);   // Menangani permintaan AJAX dari chatbot



// Route::get('/home', function () {
//     return view('home');
// });


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
