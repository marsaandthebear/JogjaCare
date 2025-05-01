<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\CsChatMessage;


class BotManController extends Controller
{
    protected $faqData;

    public function __construct()
    {
        // Load data dari file JSON
        try {
            $jsonContent = Storage::disk('local')->get('faq_jogjacare.json');
            $this->faqData = json_decode($jsonContent, true);
            
            // Jika file tidak ditemukan atau data kosong, gunakan data default
            if (!$this->faqData) {
                \Log::error('Failed to load FAQ data');
                $this->faqData = [
                    'umum' => [
                        'apa itu jogjacare?' => 'JogjaCare adalah website yang menyediakan informasi lengkap mengenai layanan kesehatan dan destinasi wisata di Yogyakarta.'
                    ]
                ];
            }
        } catch (\Exception $e) {
            \Log::error('Error loading FAQ data: ' . $e->getMessage());
            $this->faqData = [
                'umum' => [
                    'apa itu jogjacare?' => 'JogjaCare adalah website yang menyediakan informasi lengkap mengenai layanan kesehatan dan destinasi wisata di Yogyakarta.'
                ]
            ];
        }
    }
    
    // Method untuk menyediakan data FAQ ke frontend
    public function getFaqData()
    {
        return response()->json($this->faqData);
    }

    public function handle()
    {
        DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);
        $botman = BotManFactory::create([]);

        $faqData = $this->faqData;

        // Tambahkan fallback untuk memulai
        $botman->fallback(function (BotMan $botman) use ($faqData) {
            $this->showCategories($botman, $faqData);
        });

        // Event ketika chat dimulai
        $botman->on('welcome', function (BotMan $botman) use ($faqData) {
            $this->showCategories($botman, $faqData);
        });

        // Mendengarkan semua pesan
        $botman->hears('{message}', function (BotMan $botman, $message) use ($faqData) {
            if (!Auth::check()) {
                $botman->reply("Silakan login terlebih dahulu untuk menggunakan chatbot.");
                return;
            }
        
            $user = Auth::user();
        
            // Simpan ke DB
            CsChatMessage::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'message' => $message,
            ]);
        
            // Respon tetap (boleh ubah sesuai yang lama)
            $botman->reply("Halo $user->name! Pesan kamu sudah dicatat: \"$message\"");
        });

        $botman->listen();
    }

    // Fungsi untuk menampilkan kategori
    protected function showCategories(BotMan $botman, array $faqData)
    {
        $text = "📚 Silakan pilih kategori pertanyaan:\n";
        foreach (array_keys($faqData) as $category) {
            $text .= "🔹 " . ucfirst($category) . "\n";
        }
        $botman->reply($text);
    }

    // Fungsi untuk menampilkan pertanyaan dalam kategori
    protected function showQuestions(BotMan $botman, string $category, array $faqData)
    {
        if (!isset($faqData[$category]) || !is_array($faqData[$category])) {
            $botman->reply("Maaf, kategori tidak ditemukan. Silakan pilih kategori lain:");
            $this->showCategories($botman, $faqData);
            return;
        }
        
        $questions = array_keys($faqData[$category]);
        $response = "❓Pertanyaan dalam kategori *" . ucfirst($category) . "*:\n";
        foreach ($questions as $q) {
            $response .= "▫️ " . $q . "\n";
        }
        $botman->reply($response . "\n(Ketik *menu* untuk kembali ke daftar kategori)");
    }
    
    // Fungsi untuk mencari kata kunci dalam pesan
    protected function containsKeywords($message, $question)
    {
        $keywords = explode(' ', $question);
        $longKeywords = array_filter($keywords, function($word) {
            return strlen($word) > 3; // hanya kata dengan panjang > 3
        });
        
        foreach ($longKeywords as $keyword) {
            if (strpos($message, $keyword) !== false) {
                return true;
            }
        }
        return false;
    }
}