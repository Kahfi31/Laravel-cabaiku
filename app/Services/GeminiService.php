<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Exception;

class GeminiService
{
    private $geminiApiKey;
    private $apiUrl;

    public function __construct()
    {
        $this->geminiApiKey = env('GEMINI_API_KEY');
        $this->apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=AIzaSyDjCYFF6zwFr7qp1f26SHKiPbakorMUwvM";
    }

    // 1. Simpan gambar di Laravel dan dapatkan base64-nya
    public function saveAndEncodeImage($image)
    {
        $imagePath = $image->store('images'); // Simpan di storage/app/images/
        $fullPath = storage_path("app/{$imagePath}");

        if (!file_exists($fullPath)) {
            throw new Exception("Gagal menyimpan gambar.");
        }

        $imageData = file_get_contents($fullPath);
        return base64_encode($imageData); // Konversi ke base64
    }

    public function sendToGemini($message, $image = null)
{
    $client = new Client();

    $payload = ["contents" => [["parts" => []]]];

    if (!empty($message)) {
        $payload["contents"][0]["parts"][] = ["text" => $message];
    }

    if ($image) {
        $encodedImage = base64_encode(file_get_contents($image->getPathname()));
        $payload["contents"][0]["parts"][] = [
            "inline_data" => [
                "mime_type" => "image/jpeg",
                "data" => $encodedImage
            ]
        ];
    }

    try {
        $response = $client->post($this->apiUrl, [
            'json' => $payload,
            'headers' => ['Content-Type' => 'application/json']
        ]);

        $responseBody = json_decode($response->getBody(), true);
        return $responseBody['candidates'][0]['content'] ?? 'Tidak ada respons dari Gemini';
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
}
}
