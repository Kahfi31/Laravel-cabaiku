<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeminiService;
use Illuminate\Support\Facades\Validator;
use Exception;

class ChatbotController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    // Menampilkan halaman chatbot
    public function index()
    {
        return view('chatbot'); // Mengembalikan view chatbot.blade.php
    }

    // Menganalisis pesan dan gambar dari permintaan
    public function analyze(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'message' => 'nullable|string|max:1000', // Pesan tidak wajib, tetapi jika ada harus string
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10480', // Memastikan gambar valid dan ukuran tidak lebih dari 2MB
        ]);

        // Jika validasi gagal, kembalikan pesan kesalahan
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400); // Mengembalikan pesan kesalahan dengan status 400
        }

        $message = $request->input('message');
        $image = $request->file('image');

        try {
            // Mengirim pesan dan gambar ke Gemini API
            $response = $this->geminiService->sendToGemini($message, $image);

            // Mengembalikan respons dari Gemini API
            return response()->json(['reply' => $response]);
        } catch (Exception $e) {
            // Menangani kesalahan jika terjadi masalah saat memproses permintaan
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500); // Status 500 untuk kesalahan server
        }
    }
}
