<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        // Load driver
        DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);
        
        // Create BotMan instance
        $config = [
            // Configuration for your bot
            'conversation_cache_time' => 40,
            'user_cache_time' => 30,
        ];
        
        $botman = BotManFactory::create($config);
        
        // Define conversations and listeners
        $this->defineConversations($botman);
        
        // Start listening
        $botman->listen();
    }
    
    /**
     * Define bot conversations and event listeners.
     */
    private function defineConversations(BotMan $botman)
    {
        // Welcome message
        $botman->hears('hi|hello|halo|hai', function ($bot) {
            $bot->reply('Halo! Selamat datang di JogjaCare FAQ Bot. Ada yang bisa saya bantu?');
            $this->showCategoryMenu($bot);
        });
        
        // Default fallback
        $botman->fallback(function ($bot) {
            $bot->reply('Maaf, saya tidak mengerti pertanyaan Anda. Berikut kategori FAQ yang tersedia:');
            $this->showCategoryMenu($bot);
        });
        
        // Handle direct category selection
        $botman->hears('kategori: (.*)', function ($bot, $category) {
            $this->handleCategorySelection($bot, $category);
        });
        
        // Handle question selection
        $botman->hears('pertanyaan: (.*)', function ($bot, $questionKey) {
            $this->handleQuestionSelection($bot, $questionKey);
        });
        
        // Handle search
        $botman->hears('cari: (.*)', function ($bot, $query) {
            $this->searchFaq($bot, $query);
        });
        
        // Show categories menu
        $botman->hears('menu|kategori|categories', function ($bot) {
            $this->showCategoryMenu($bot);
        });
    }
    
    /**
     * Display the menu of available FAQ categories.
     */
    private function showCategoryMenu($bot)
    {
        $faqData = $this->getFaqData();
        $question = Question::create('Silakan pilih kategori FAQ:');
        
        foreach (array_keys($faqData) as $category) {
            $question->addButton(Button::create($category)->value('kategori: ' . $category));
        }
        
        $bot->reply($question);
    }
    
    /**
     * Handle when a user selects a category.
     */
    private function handleCategorySelection($bot, $category)
    {
        $faqData = $this->getFaqData();
        
        if (isset($faqData[$category])) {
            $bot->reply("Anda memilih kategori: $category");
            
            $questions = $faqData[$category];
            $questionMenu = Question::create("Silakan pilih pertanyaan tentang $category:");
            
            foreach ($questions as $questionText => $answer) {
                // Create a unique key for this question
                $questionKey = $category . '|' . md5($questionText);
                $questionMenu->addButton(Button::create($questionText)->value('pertanyaan: ' . $questionKey));
            }
            
            $questionMenu->addButton(Button::create('« Kembali ke Kategori')->value('menu'));
            
            $bot->reply($questionMenu);
        } else {
            $bot->reply("Maaf, kategori '$category' tidak ditemukan.");
            $this->showCategoryMenu($bot);
        }
    }
    
    /**
     * Handle when a user selects a specific question.
     */
    private function handleQuestionSelection($bot, $questionKey)
    {
        $faqData = $this->getFaqData();
        $parts = explode('|', $questionKey);
        
        if (count($parts) === 2) {
            $category = $parts[0];
            $questionHash = $parts[1];
            
            if (isset($faqData[$category])) {
                foreach ($faqData[$category] as $questionText => $answer) {
                    if (md5($questionText) === $questionHash) {
                        $bot->reply("*$questionText*");
                        $bot->reply($answer);
                        
                        // Add buttons for next actions
                        $nextActions = Question::create('Apa yang ingin Anda lakukan selanjutnya?');
                        $nextActions->addButton(Button::create('Pertanyaan lain di ' . $category)->value('kategori: ' . $category));
                        $nextActions->addButton(Button::create('Kembali ke Menu Utama')->value('menu'));
                        $bot->reply($nextActions);
                        
                        return;
                    }
                }
            }
        }
        
        $bot->reply("Maaf, pertanyaan tidak ditemukan.");
        $this->showCategoryMenu($bot);
    }
    
    /**
     * Search the FAQ data for matches to user query.
     */
    private function searchFaq($bot, $query)
    {
        $faqData = $this->getFaqData();
        $results = [];
        
        // Search through all questions for matches
        foreach ($faqData as $category => $questions) {
            foreach ($questions as $questionText => $answer) {
                if (stripos($questionText, $query) !== false || stripos($answer, $query) !== false) {
                    $results[] = [
                        'category' => $category,
                        'question' => $questionText,
                        'answer' => $answer,
                        'key' => $category . '|' . md5($questionText)
                    ];
                }
            }
        }
        
        if (!empty($results)) {
            $bot->reply("Ditemukan " . count($results) . " hasil pencarian untuk '$query':");
            
            // Only show first 5 results to avoid overloading
            $count = 0;
            foreach ($results as $result) {
                if ($count >= 5) {
                    $bot->reply("Dan " . (count($results) - 5) . " hasil lainnya. Silakan persempit pencarian Anda.");
                    break;
                }
                
                $resultQuestion = Question::create($result['question'] . ' (Kategori: ' . $result['category'] . ')');
                $resultQuestion->addButton(Button::create('Lihat Jawaban')->value('pertanyaan: ' . $result['key']));
                $bot->reply($resultQuestion);
                
                $count++;
            }
        } else {
            $bot->reply("Tidak ditemukan hasil untuk '$query'. Silakan coba kata kunci lain atau pilih dari kategori berikut:");
            $this->showCategoryMenu($bot);
        }
    }
    
    /**
     * Get FAQ data.
     * In a real application, you might want to retrieve this from a database.
     */
    private function getFaqData()
    {
        return [
            "Umum" => [
                "Apa itu JogjaCare?" => "JogjaCare adalah website yang menyediakan informasi lengkap mengenai layanan kesehatan dan destinasi wisata di Yogyakarta, khusus untuk wisatawan medical tourism.",
                "Apakah JogjaCare bisa dipakai agen perjalanan?" => "Ya, tersedia kolaborasi untuk agen perjalanan dan penyedia layanan kesehatan."
            ],
            "Medical Care" => [
                "Apa itu fitur Medical Care?" => "Menyediakan info layanan klinik, rumah sakit, dokter, dan perawatan umum.",
                "Apakah JogjaCare menyediakan informasi tentang layanan rehabilitasi?" => "Ya, terdapat daftar fasilitas yang menawarkan layanan rehabilitasi medis dan terapi."
            ],
            "Medical Points" => [
                "Apa itu fitur Medical Points?" => "Menyediakan lokasi fasilitas medis dekat area wisata.",
                "Di mana saya bisa menemukan informasi tentang klinik 24 jam?" => "JogjaCare mencantumkan klinik yang beroperasi 24 jam lengkap dengan lokasi dan kontaknya."
            ],
            "Medical Cost" => [
                "Apa itu fitur Medical Cost?" => "Info biaya untuk berbagai prosedur dan perbandingan antar fasilitas.",
                "Bagaimana cara membandingkan biaya pengobatan di beberapa rumah sakit?" => "Gunakan fitur Medical Costs untuk membandingkan estimasi harga dari berbagai rumah sakit."
            ],
            "Hospital and Medical Centers" => [
                "Apa itu fitur Hospital and Medical Centers?" => "Menampilkan profil rumah sakit dan pusat kesehatan di Jogja.",
                "Apakah JogjaCare menyediakan fitur pencarian rumah sakit berdasarkan lokasi?" => "Ya, fitur Medical Centers memungkinkan Anda mencari berdasarkan lokasi atau fasilitas."
            ],
            "Pengobatan Tradisional" => [
                "Apa itu fitur Alternative and Traditional Medicine?" => "Info tentang pengobatan tradisional seperti jamu, bekam, pijat, dll.",
                "Bisakah saya melihat ulasan pengguna tentang layanan alternatif?" => "Ya, pengguna bisa membaca dan menulis ulasan terkait pengalaman mereka."
            ],
            "Fitur Website" => [
                "Apakah JogjaCare tersedia dalam bahasa Inggris?" => "Ya, website ini mendukung multi-bahasa.",
                "Bisa akses JogjaCare dari HP?" => "Ya, desainnya responsif dan mobile-friendly."
            ],
            "Konsultasi" => [
                "Bisa konsultasi dengan dokter?" => "Tidak, tersedia fitur chat dan form konsultasi."
            ],
            "Pemesanan" => [
                "Bisa pesan layanan via website?" => "Tidak, JogjaCare hanya website Sistem Informasi untuk medical tourism.",
                "Apakah saya bisa memesan paket wisata medis langsung dari JogjaCare?" => "Saat ini JogjaCare menyediakan informasi dan kontak penyedia, pemesanan online sedang dikembangkan."
            ],
            "Live Chat" => [
                "Bagaimana cara menghubungi layanan customer service JogjaCare?" => "Anda dapat menggunakan fitur Live Chat atau email ke cs@jogjacare.com.",
                "Apakah ada biaya tambahan untuk menggunakan fitur Live Chat?" => "Tidak, fitur Live Chat dapat digunakan secara gratis oleh semua pengunjung website."
            ],
            "Layanan Darurat" => [
                "Apa saja layanan darurat yang tersedia di JogjaCare?" => "JogjaCare mencantumkan IGD, nomor gawat darurat, dan klinik 24 jam di Yogyakarta."
            ],
            "Transportasi" => [
                "Apakah ada layanan antar jemput untuk pasien dari bandara?" => "Beberapa rumah sakit menyediakan layanan antar jemput yang informasinya tersedia di JogjaCare."
            ],
            "Informasi Umum" => [
                "Dimana saya bisa melihat testimoni dari pengguna JogjaCare?" => "Anda bisa melihat testimoni di halaman utama dan setiap profil rumah sakit.",
                "Bagaimana JogjaCare mendukung medical tourism berkelanjutan?" => "Dengan menyediakan informasi terpercaya, mendorong kerjasama lokal, dan memperhatikan aspek budaya serta etika wisata."
            ]
        ];
    }
    
    /**
     * Load the BotMan widget view.
     */
    public function tinker()
    {
        return view('botman.tinker');
    }
}