@if(auth()->check())
    <!-- Chat Widget Implementation -->
    <div class="botman-widget">
        <!-- Chat Bubble -->
        <div class="chat-bubble" id="chatBubble">
            <div class="chat-bubble-icon">💬</div>
        </div>
        
        <!-- Chat Widget Container -->
        <div class="chat-widget-container" id="chatWidget">
            <div class="chat-widget-header">
                <h3 class="chat-widget-title">JogjaCare Bot</h3>
                <div class="chat-widget-actions">
                    <a href="#" id="aboutBot">Info</a>
                    <a href="#" id="closeWidget">✕</a>
                </div>
            </div>
            <div class="chat-widget-body">
                <div class="chat-widget-messages" id="chatMessages"></div>
                <div class="faq-buttons-wrapper" id="faq-buttons-wrapper">
                    <div id="faq-buttons-container" class="faq-buttons"></div>
                </div>
            </div>
            <div class="chat-widget-footer">
                <form id="chatForm" class="chat-widget-form">
                    <input type="text" class="chat-widget-input" id="userInput" placeholder="Pilih kategori di atas atau tulis...">
                    <button type="submit" class="chat-widget-submit">Kirim</button>
                </form>
                <!-- Tombol CS -->
                <div id="csButton" class="chat-cs-button" style="display: none;">
                    <a href="https://wa.me/6289674366444?text=Halo%20saya%20butuh%20bantuan%20dari%20CS" 
                    target="_blank" 
                    class="chat-cs-link">
                        Bicara dengan CS
                    </a>
                </div>

            </div>
        </div>
    </div>
@else
    <!-- Not Logged In Notice -->
    <div class="chat-login-warning" style="padding: 1rem; border: 1px solid #ccc; border-radius: 8px;">
        <p>Anda harus <a href="{{ route('login') }}">login</a> terlebih dahulu untuk menggunakan fitur chatbot.</p>
    </div>
@endif


<script>
    // Data FAQ
    const faqData = {
        "Umum": {
                "Apa itu JogjaCare?": "JogjaCare adalah website yang menyediakan informasi lengkap mengenai layanan kesehatan dan destinasi wisata di Yogyakarta, khusus untuk wisatawan medical tourism.",
                "Apa tujuan dari JogjaCare?": "Untuk menghubungkan wisatawan dengan layanan kesehatan berkualitas serta destinasi wisata di Yogyakarta.",
                "Siapa saja yang bisa menggunakan JogjaCare?": "Wisatawan lokal maupun mancanegara.",
                "Apakah JogjaCare bekerja sama dengan rumah sakit resmi?": "Belum, Untuk sekarang kita hanya menyediakan informasi dan belum bekerja sama dengan rumah sakit dan klinik terakreditasi di Yogyakarta.",
                "Apa manfaat menggunakan JogjaCare?": "Memudahkan mencari layanan kesehatan & wisata dalam satu platform.",
                "Apakah JogjaCare aman digunakan?": "Ya, data pengguna dilindungi dengan enkripsi dan sistem keamanan.",
                "Apakah JogjaCare punya layanan 24 jam?": "Website dapat diakses 24 jam, termasuk fitur live chat jika tersedia.",
                "Bagaimana cara menggunakan JogjaCare?": "Buka website, pilih fitur sesuai kebutuhan (Medical Care, Paket Wisata, dll).",
                "Siapa pengelola JogjaCare?": "Dikelola oleh tim profesional dengan dukungan stakeholder kesehatan dan pariwisata di Yogyakarta.",
                "Apakah JogjaCare bisa dipakai agen perjalanan?": "Ya, tersedia kolaborasi untuk agen perjalanan dan penyedia layanan kesehatan."
            },
            "Medical Care": {
                "Apa itu fitur Medical Care?": "Menyediakan info layanan klinik, rumah sakit, dokter, dan perawatan umum.",
                "Apa saja spesialisasi dokter di JogjaCare?": "Kardiologi, gigi, kulit, THT, bedah plastik, dll.",
                "Apakah bisa mencari dokter berdasarkan spesialisasi?": "Bisa, lewat fitur pencarian berdasarkan spesialisasi.",
                "Apa layanan unggulan rumah sakit di Jogja?": "Perawatan jantung, bedah saraf, ortopedi, serta terapi pemulihan.",
                "Apakah tersedia informasi jadwal dokter?": "Ya, di setiap profil rumah sakit/klinik.",
                "Apakah ada layanan untuk perawatan ibu dan anak?": "Tersedia layanan seperti kandungan, kehamilan, dan anak-anak.",
                "Apakah JogjaCare memberikan informasi rawat inap?": "Ya, lengkap dengan fasilitas kamar dan tarif.",
                "Bagaimana saya memilih rumah sakit yang sesuai?": "Gunakan filter berdasarkan spesialisasi, lokasi, dan biaya.",
                "Apakah tersedia info tenaga medis berlisensi?": "Ya, semua dokter dan praktisi terdaftar memiliki lisensi.",
                "Bagaimana jika saya butuh layanan gawat darurat?": "Informasi IGD 24 jam tersedia di Medical Points.",
                "Apakah informasi layanan Medical Care diperbarui secara berkala?": "Informasi layanan medis diperbarui secara rutin agar tetap akurat dan terpercaya.",
                "Apa saja jenis terapi yang tersedia?": "Tersedia terapi seperti akupunktur, pijat refleksi, dan bekam.",
                "Bagaimana cara mengetahui dokter yang berpengalaman di bidang tertentu?": "Anda dapat melihat profil dan ulasan dokter di JogjaCare untuk mengetahui pengalaman mereka di bidang spesifik.",
                "Apakah ada layanan konsultasi gizi di JogjaCare?": "Ya, JogjaCare mencantumkan klinik dan ahli gizi yang dapat membantu kebutuhan nutrisi Anda.",
                "Apakah JogjaCare menyediakan informasi tentang layanan kesehatan mental?": "Ya, terdapat informasi mengenai klinik dan profesional yang menyediakan layanan kesehatan mental.",
                "Apakah JogjaCare menyediakan informasi tentang layanan home care?": "Ya, JogjaCare mencantumkan penyedia layanan home care yang dapat dihubungi langsung.",
                "Apakah JogjaCare menyediakan informasi tentang layanan kesehatan ibu hamil?": "Ya, terdapat informasi mengenai klinik dan dokter spesialis kandungan di JogjaCare.",
                "Apakah JogjaCare menyediakan informasi tentang vaksinasi?": "Ya, JogjaCare menyediakan informasi terkini mengenai lokasi dan jadwal vaksinasi di Yogyakarta.",
                "Di mana saya bisa menemukan layanan pemeriksaan mata?": "JogjaCare mencantumkan klinik dan rumah sakit yang menyediakan layanan pemeriksaan mata.",
                "Apakah ada informasi tentang layanan kesehatan gigi untuk anak-anak?": "Ya, JogjaCare menyediakan daftar klinik gigi yang melayani pasien anak-anak.",
                "Di mana saya bisa menemukan layanan terapi wicara?": "JogjaCare menyediakan daftar fasilitas yang menawarkan layanan terapi wicara.",
                "Apakah ada informasi tentang layanan kesehatan untuk anak berkebutuhan khusus?": "Ya, JogjaCare mencantumkan fasilitas yang menyediakan layanan khusus untuk anak berkebutuhan khusus.",
                "Apakah ada informasi tentang layanan kesehatan untuk lansia?": "Ya, JogjaCare menyediakan informasi mengenai fasilitas dan layanan khusus untuk lansia.",
                "Apakah ada informasi tentang layanan konsultasi online?": "Ya, JogjaCare mencantumkan fasilitas yang menawarkan konsultasi medis secara online.",
                "Apakah JogjaCare menyediakan informasi tentang layanan rehabilitasi?": "Ya, terdapat daftar fasilitas yang menawarkan layanan rehabilitasi medis dan terapi."
            },
            "Medical Points": {
                "Apa itu fitur Medical Points?": "Menyediakan lokasi fasilitas medis dekat area wisata.",
                "Di mana klinik terdekat dari Malioboro?": "Beberapa klinik dan apotek 24 jam tersedia di sekitar Malioboro.",
                "Fasilitas medis di sekitar Kraton Yogyakarta?": "Klinik umum dan apotek malam tersedia di area ini.",
                "Rumah sakit dekat Prambanan apa?": "RS Nur Hidayah, berjarak sekitar 6 km.",
                "Rumah sakit dekat Parangtritis?": "RSUP Dr. Sardjito berjarak sekitar 7 km.",
                "Apakah ada peta lokasi di JogjaCare?": "Ya, tersedia peta interaktif untuk setiap fasilitas.",
                "Bagaimana akses transportasi ke rumah sakit?": "Info transportasi umum dan taksi online tersedia di halaman rumah sakit.",
                "Apakah ada klinik dekat Museum Affandi?": "Ya, Anda bisa cek Medical Points untuk klinik terdekat.",
                "Apakah tersedia ambulans dalam JogjaCare?": "Beberapa rumah sakit menyediakan kontak layanan ambulans.",
                "Apakah JogjaCare mencantumkan jam operasional fasilitas medis?": "Ya, tiap fasilitas mencantumkan jam operasional.",
                "Apakah JogjaCare menampilkan fasilitas dengan akses disabilitas?": "Ya, beberapa fasilitas ditandai dengan informasi aksesibilitas bagi penyandang disabilitas.",
                "Apakah JogjaCare mencakup layanan darurat?": "Informasi nomor dan lokasi IGD rumah sakit juga disediakan di Medical Points.",
                "Di mana saya bisa menemukan layanan fisioterapi?": "JogjaCare menyediakan daftar fasilitas yang menawarkan layanan fisioterapi di berbagai lokasi di Yogyakarta.",
                "Apakah ada informasi tentang donor darah di JogjaCare?": "Ya, JogjaCare memberikan informasi mengenai lokasi dan jadwal donor darah yang tersedia.",
                "Di mana saya bisa menemukan informasi tentang klinik 24 jam?": "JogjaCare mencantumkan klinik yang beroperasi 24 jam lengkap dengan lokasi dan kontaknya."
            },
            "Medical Cost": {
                "Apa itu fitur Medical Cost?": "Info biaya untuk berbagai prosedur dan perbandingan antar fasilitas.",
                "Berapa biaya pemeriksaan umum?": "Antara Rp100.000 – Rp300.000.",
                "Biaya perawatan gigi di JogjaCare?": "Rp500.000 – Rp2.000.000 tergantung jenis layanan.",
                "Apakah biaya medical check-up tersedia?": "Ya, paket check-up mulai Rp1.000.000.",
                "Bisa bandingkan biaya antar rumah sakit?": "Ya, fitur perbandingan tersedia.",
                "Biaya perawatan kecantikan di Jogja?": "Mulai Rp300.000 tergantung layanan.",
                "Apakah biaya termasuk obat?": "Tergantung fasilitas, informasi lengkap dicantumkan di detail layanan.",
                "Bagaimana cara estimasi biaya?": "Masukkan jenis layanan dan rumah sakit di fitur simulasi biaya.",
                "Biaya operasi ringan di JogjaCare?": "Mulai dari Rp2.000.000 tergantung tindakan.",
                "Biaya pengobatan tradisional seperti bekam?": "Mulai Rp100.000 – Rp300.000.",
                "Bagaimana cara mengetahui fasilitas medis yang menerima asuransi tertentu?": "Anda dapat menggunakan filter di JogjaCare untuk mencari fasilitas yang bekerja sama dengan penyedia asuransi Anda.",
                "Bagaimana cara mengetahui biaya rawat inap di rumah sakit tertentu?": "Anda dapat melihat estimasi biaya rawat inap di profil rumah sakit yang tersedia di JogjaCare.",
                "Apakah tersedia informasi metode pembayaran?": "JogjaCare mencantumkan metode pembayaran yang diterima seperti tunai, debit, dan asuransi.",
                "Bagaimana cara membandingkan biaya pengobatan di beberapa rumah sakit?": "Gunakan fitur Medical Costs untuk membandingkan estimasi harga dari berbagai rumah sakit."
            },
            "Hospital and Medical Centers": {
                "Apa itu fitur Hospital and Medical Centers?": "Menampilkan profil rumah sakit dan pusat kesehatan di Jogja.",
                "Rumah sakit unggulan di Jogja?": "RSUP Sardjito, RS Bethesda, RSUD Panembahan Senopati.",
                "Info fasilitas tiap rumah sakit?": "Tersedia di halaman profil, termasuk ICU, rawat inap, dan lab.",
                "Jadwal praktik dokter bisa dilihat?": "Ya, di halaman masing-masing rumah sakit.",
                "Apakah rumah sakit memiliki akreditasi?": "Ya, semua yang terdaftar memiliki sertifikasi nasional.",
                "Bisa konsultasi langsung lewat JogjaCare?": "Ya, lewat form konsultasi atau live chat.",
                "Apakah rumah sakit terhubung dengan asuransi?": "Beberapa rumah sakit bekerja sama dengan asuransi tertentu.",
                "Ada fasilitas untuk wisatawan asing?": "Ya, beberapa rumah sakit menyediakan interpreter dan layanan khusus turis.",
                "Fasilitas apa yang tersedia untuk pasien difabel?": "Tersedia lift, kursi roda, dan kamar ramah difabel di beberapa rumah sakit.",
                "Apakah saya bisa memilih dokter sendiri?": "Ya, bisa memilih dokter dari daftar yang tersedia.",
                "Bisakah saya membaca ulasan rumah sakit di JogjaCare?": "Ya, pengguna dapat memberikan ulasan dan penilaian atas layanan rumah sakit.",
                "Bagaimana cara mengetahui jadwal operasi di rumah sakit tertentu?": "Anda dapat menghubungi langsung rumah sakit melalui kontak yang tersedia di JogjaCare untuk informasi jadwal operasi.",
                "Bagaimana cara mengetahui fasilitas medis yang memiliki ruang ICU?": "Informasi mengenai fasilitas dengan ruang ICU tersedia di profil rumah sakit di JogjaCare.",
                "Apakah JogjaCare menyediakan fitur pencarian rumah sakit berdasarkan lokasi?": "Ya, fitur Medical Centers memungkinkan Anda mencari berdasarkan lokasi atau fasilitas."
            },
            "Pengobatan Tradisional": {
                "Apa itu fitur Alternative and Traditional Medicine?": "Info tentang pengobatan tradisional seperti jamu, bekam, pijat, dll.",
                "Pengobatan tradisional apa saja di Jogja?": "Pijat Jawa, kerokan, bekam, jamu herbal.",
                "Siapa saja praktisi jamu di Jogja?": "Tersedia daftar praktisi bersertifikat.",
                "Pengobatan tradisional aman nggak?": "JogjaCare hanya mencantumkan yang berizin resmi.",
                "Apakah bisa booking pengobatan tradisional?": "Tidak, tapi kita menyediakan informasi terkait pengobatan informasi beserta titik point dan no yang dapat dihubungi.",
                "Apakah jamu tersedia dalam paket?": "Ya, beberapa paket wellness mencakup terapi jamu bisa ditemukan di pengobatan tradisional.",
                "Bisakah saya melihat ulasan pengguna tentang layanan alternatif?": "Ya, pengguna bisa membaca dan menulis ulasan terkait pengalaman mereka."
            },
            "Fitur Website": {
                "Apakah JogjaCare tersedia dalam bahasa Inggris?": "Ya, website ini mendukung multi-bahasa.",
                "Bagaimana cara menggunakan fitur pencarian di JogjaCare?": "Gunakan kolom pencarian di bagian atas halaman untuk menemukan informasi yang Anda butuhkan.",
                "Apa saja fitur utama JogjaCare?": "Fitur utama JogjaCare antara lain Medical Care, Medical Points, Medical Centers, Medical Costs, dan Medical Alternative.",
                "Bisa akses JogjaCare dari HP?": "Ya, desainnya responsif dan mobile-friendly."
            },
            "Konsultasi": {
                "Bisa konsultasi dengan dokter?": "Tidak, tersedia fitur chat dan form konsultasi."
            },
            "Pemesanan": {
                "Bisa pesan layanan via website?": "Tidak, JogjaCare hanya website Sistem Informasi untuk medical tourism.",
                "Apakah saya bisa memesan paket wisata medis langsung dari JogjaCare?": "Saat ini JogjaCare menyediakan informasi dan kontak penyedia, pemesanan online sedang dikembangkan."
            },
            "Live Chat": {
                "Bagaimana cara menghubungi layanan customer service JogjaCare?": "Anda dapat menggunakan fitur Live Chat atau email ke cs@jogjacare.com.",
                "Apakah ada biaya tambahan untuk menggunakan fitur Live Chat?": "Tidak, fitur Live Chat dapat digunakan secara gratis oleh semua pengunjung website."
            },
            "Layanan Darurat": {
                "Apa saja layanan darurat yang tersedia di JogjaCare?": "JogjaCare mencantumkan IGD, nomor gawat darurat, dan klinik 24 jam di Yogyakarta."
            },
            "Transportasi": {
                "Apakah ada layanan antar jemput untuk pasien dari bandara?": "Beberapa rumah sakit menyediakan layanan antar jemput yang informasinya tersedia di JogjaCare."
            },
            "Informasi Umum": {
                "Dimana saya bisa melihat testimoni dari pengguna JogjaCare?": "Anda bisa melihat testimoni di halaman utama dan setiap profil rumah sakit.",
                "Apa keuntungan menggunakan JogjaCare dibanding mencari manual?": "JogjaCare menyajikan data terverifikasi dan kemudahan pencarian satu pintu.",
                "Bagaimana JogjaCare membantu wisatawan asing?": "JogjaCare menyediakan info dalam bahasa Inggris, daftar rumah sakit dengan layanan internasional, dan info transportasi.",
                "Bagaimana JogjaCare mendukung medical tourism berkelanjutan?": "Dengan menyediakan informasi terpercaya, mendorong kerjasama lokal, dan memperhatikan aspek budaya serta etika wisata."
            }
    };

    // Inisialisasi chat widget
document.addEventListener('DOMContentLoaded', function() {
    const chatBubble = document.getElementById('chatBubble');
    const chatWidget = document.getElementById('chatWidget');
    const closeWidget = document.getElementById('closeWidget');
    const chatForm = document.getElementById('chatForm');
    const userInput = document.getElementById('userInput');
    const chatMessages = document.getElementById('chatMessages');
    const buttonsContainer = document.getElementById('faq-buttons-container');
    const aboutBot = document.getElementById('aboutBot');
    const csButton = document.getElementById('csButton');
    
    // Variable untuk mengontrol mode chat
    let isCsMode = localStorage.getItem('jogjaCareIsCsMode') === 'true' || false;
    
    // Fungsi untuk menyimpan pesan ke localStorage
    function saveMessageToHistory(type, message) {
        // Ambil history chat yang sudah ada
        let chatHistory = JSON.parse(localStorage.getItem('jogjaCareHistory') || '[]');
        
        // Tambahkan pesan baru
        chatHistory.push({
            type: type, // 'user' atau 'bot'
            message: message,
            timestamp: new Date().getTime()
        });
        
        // Simpan kembali ke localStorage
        localStorage.setItem('jogjaCareHistory', JSON.stringify(chatHistory));
    }
    
    // Fungsi untuk memuat history chat dari localStorage
    function loadChatHistory() {
        const chatHistory = JSON.parse(localStorage.getItem('jogjaCareHistory') || '[]');
        
        if (chatHistory.length > 0) {
            // Tampilkan pesan dari history
            chatHistory.forEach(item => {
                if (item.type === 'user') {
                    addUserMessage(item.message, false); // parameter kedua false berarti tidak disimpan lagi
                } else if (item.type === 'bot') {
                    addBotMessage(item.message, false);
                }
            });
        } else {
            // Tampilkan pesan intro dan kategori jika tidak ada history
            addBotMessage("👩‍⚕️ Hai! Saya siap bantu cari rumah sakit di sekitar tempat wisata Jogja. Silakan pilih kategori:", true);
            showCategories();
        }
        
        // Set mode chat sesuai localStorage
        if (isCsMode) {
            document.querySelector('.chat-widget-title').textContent = 'JogjaCare CS';
            // Sembunyikan tombol kategori
            if (buttonsContainer) {
                buttonsContainer.innerHTML = '';
            }
            // Sembunyikan tombol CS karena sudah dalam mode CS
            csButton.style.display = 'none';
            
            // Tambahkan tombol untuk kembali ke mode bot
            addBackToBotButton();
        }
    }
    
    // Toggle widget saat bubble diklik
    chatBubble.addEventListener('click', function() {
        if (chatWidget.style.display === 'flex') {
            chatWidget.style.display = 'none';
        } else {
            chatWidget.style.display = 'flex';
            // Muat history chat saat widget dibuka jika belum ada pesan
            if (chatMessages.children.length === 0) {
                loadChatHistory();
            }
        }
    });
    
    // Tutup widget
    closeWidget.addEventListener('click', function(e) {
        e.preventDefault();
        chatWidget.style.display = 'none';
    });
    
    // Tampilkan info tentang bot
    aboutBot.addEventListener('click', function(e) {
        e.preventDefault();
        addBotMessage("JogjaCare Assistant adalah layanan informasi untuk membantu wisatawan menemukan fasilitas kesehatan di sekitar tempat wisata Jogja.");
    });
    
    // Kirim pesan dari form
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const message = userInput.value.trim();
        if (message) {
            addUserMessage(message);
            
            // Cek mode chat saat ini
            if (isCsMode) {
                // Kirim ke CS (mode CS aktif)
                sendMessageToCS(message);
            } else {
                // Proses dengan bot (mode bot aktif)
                processUserMessage(message);
            }
            
            userInput.value = '';
        }
    });
    
    // Toggle mode CS saat tombol CS diklik
    document.querySelector('.chat-cs-link').addEventListener('click', function() {
        if (!isCsMode) {
            // Beralih ke mode CS
            isCsMode = true;
            localStorage.setItem('jogjaCareIsCsMode', 'true');
            document.querySelector('.chat-widget-title').textContent = 'JogjaCare CS';
            addBotMessage("🧑‍💼 Anda sekarang terhubung dengan Customer Service kami. Mohon tunggu sebentar untuk balasan dari CS.");
            // Sembunyikan tombol kategori
            if (buttonsContainer) {
                buttonsContainer.innerHTML = '';
            }
            // Sembunyikan tombol CS karena sudah dalam mode CS
            csButton.style.display = 'none';
            
            // Tambahkan tombol untuk kembali ke mode bot
            addBackToBotButton();
            
            // Kirim notifikasi ke server bahwa user memulai chat CS
            startCsChat();
        }
    });
    
    // Tampilkan tombol kategori
    window.showCategories = function() {
        if (!buttonsContainer) return;
        
        // Bersihkan container
        buttonsContainer.innerHTML = '';
        
        // Tambahkan judul
        const categoriesHeader = document.createElement('div');
        categoriesHeader.textContent = 'Pilih Kategori:';
        categoriesHeader.style.fontWeight = 'bold';
        categoriesHeader.style.marginBottom = '5px';
        buttonsContainer.appendChild(categoriesHeader);
        
        // Tambahkan tombol untuk setiap kategori
        Object.keys(faqData).forEach(category => {
            const button = document.createElement('button');
            button.className = 'category-button';
            button.textContent = category.charAt(0).toUpperCase() + category.slice(1);
            button.onclick = function() {
                const categoryName = category;
                // Tambahkan pesan user (simulasi user memilih kategori)
                addUserMessage(categoryName);
                // Tampilkan pertanyaan dari kategori
                showQuestions(categoryName);
                // Tambahkan pesan bot
                addBotMessage(`❓Pertanyaan dalam kategori *${categoryName.charAt(0).toUpperCase() + categoryName.slice(1)}*:`);
            };
            buttonsContainer.appendChild(button);
        });
    };
    
    // Tampilkan tombol pertanyaan dalam kategori
    window.showQuestions = function(category) {
        if (!buttonsContainer) return;
        
        // Bersihkan container
        buttonsContainer.innerHTML = '';
        
        // Tambahkan tombol kembali
        const backButton = document.createElement('button');
        backButton.className = 'back-button';
        backButton.innerHTML = '&larr; Kembali ke Kategori';
        backButton.onclick = function() {
            showCategories();
            addBotMessage("📚 Silakan pilih kategori pertanyaan:");
        };
        buttonsContainer.appendChild(backButton);
        
        // Tambahkan tombol untuk setiap pertanyaan
        const questions = faqData[category];
        Object.keys(questions).forEach(question => {
            const button = document.createElement('button');
            button.className = 'question-button';
            button.textContent = question;
            button.onclick = function() {
                // Tambahkan pesan user (simulasi user menanyakan pertanyaan)
                addUserMessage(question);
                // Tambahkan jawaban bot
                addBotMessage(`📌 *Jawaban:*\n${questions[question]}`);
            };
            buttonsContainer.appendChild(button);
        });
    };
    
    // Proses pesan dari user
    function processUserMessage(message) {
        message = message.toLowerCase().trim();
        
        // Periksa apakah pesan adalah kata kunci untuk menampilkan kategori
        if (message === 'start' || message === 'mulai' || message === 'menu' || message === 'kategori') {
            addBotMessage("📚 Silakan pilih kategori pertanyaan:");
            showCategories();
            return;
        }
        
        // Periksa apakah input adalah kategori
        if (faqData[message.toLowerCase()]) {
            const category = Object.keys(faqData).find(cat => cat.toLowerCase() === message.toLowerCase());
            addBotMessage(`❓Apa yang ingin anda ketahui *${category}*:`);
            showQuestions(category);
            return;
        }
        
        // Periksa apakah input adalah pertanyaan dari kategori manapun
        let answered = false;
        Object.values(faqData).forEach(category => {
            Object.entries(category).forEach(([question, answer]) => {
                if (question.toLowerCase() === message) {
                    addBotMessage(`📌 *Jawaban:*\n${answer}`);
                    answered = true;
                }
            });
        });
        
        // Jika tidak ada jawaban yang cocok, tampilkan tombol CS
        if (!answered) {
            addBotMessage("🤔 Saya belum mengenali pesan tersebut. Silakan pilih kategori di bawah ini atau bicara dengan CS kami:");
            showCategories();
            // Tampilkan tombol CS
            csButton.style.display = 'block';
        }
    }
    
    // Tambahkan pesan dari bot ke chat
    function addBotMessage(message, saveToHistory = true) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'message bot-message';
        messageDiv.textContent = message.replace(/\*([^*]+)\*/g, '$1'); // Hapus penanda markdown
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
        
        // Simpan ke history jika diperlukan
        if (saveToHistory) {
            saveMessageToHistory('bot', message);
        }
    }
    
    // Fungsi untuk menambahkan tombol kembali ke bot mode
    function addBackToBotButton() {
        // Buat tombol "Kembali ke Bot"
        const backDiv = document.createElement('div');
        backDiv.className = 'back-to-bot-button';
        backDiv.style.textAlign = 'center';
        backDiv.style.margin = '10px 0';
        
        const backButton = document.createElement('button');
        backButton.className = 'back-to-bot-btn';
        backButton.textContent = '← Kembali ke Chat Bot';
        backButton.style.backgroundColor = '#2276d2';
        backButton.style.color = 'white';
        backButton.style.border = 'none';
        backButton.style.borderRadius = '5px';
        backButton.style.padding = '8px 12px';
        backButton.style.cursor = 'pointer';
        
        backButton.addEventListener('click', function() {
            switchBackToBot();
        });
        
        backDiv.appendChild(backButton);
        chatMessages.appendChild(backDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    
    // Fungsi untuk beralih kembali ke mode bot
    function switchBackToBot() {
        // Beritahu server bahwa pengguna keluar dari mode CS
        endCsChat();
        
        // Ubah mode
        isCsMode = false;
        localStorage.setItem('jogjaCareIsCsMode', 'false');
        
        // Ubah tampilan
        document.querySelector('.chat-widget-title').textContent = 'JogjaCare Bot';
        
        // Tambahkan pesan konfirmasi
        addBotMessage("👩‍⚕️ Anda telah kembali ke chat bot. Silahkan pilih kategori:");
        
        // Tampilkan kategori
        showCategories();
        
        // Tampilkan kembali tombol CS untuk penggunaan di masa depan
        csButton.style.display = 'block';
    }
    
    // Tambahkan pesan dari user ke chat
    function addUserMessage(message, saveToHistory = true) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'message user-message';
        messageDiv.textContent = message;
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
        
        // Simpan ke history jika diperlukan
        if (saveToHistory) {
            saveMessageToHistory('user', message);
        }
    }
    
    // Fungsi-fungsi untuk Chat CS
    // Mendapatkan atau membuat session ID untuk chat
    function getChatSessionId() {
        let sessionId = localStorage.getItem('jogjaCareSessionId');
        if (!sessionId) {
            sessionId = 'session_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
            localStorage.setItem('jogjaCareSessionId', sessionId);
        }
        return sessionId;
    }
    
    // Memulai sesi chat CS
    function startCsChat() {
        const sessionId = getChatSessionId();
        fetch('/cs-chat/start', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                session_id: sessionId,
                message: "Pengguna memulai chat dengan CS"
            })
        });
        
        // Mulai interval untuk memeriksa balasan dari CS
        checkCSMessages();
        
        // Simpan referensi ke interval untuk bisa dihentikan nanti
        window.csCheckInterval = setInterval(checkCSMessages, 5000);
    }
    
    // Fungsi untuk mengakhiri sesi CS
    function endCsChat() {
        const sessionId = getChatSessionId();
        fetch('/cs-chat/end', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                session_id: sessionId,
                message: "Pengguna mengakhiri chat dengan CS"
            })
        });
        
        // Hentikan interval pengecekan
        if (window.csCheckInterval) {
            clearInterval(window.csCheckInterval);
        }
    }
    
    // Kirim pesan ke CS
    function sendMessageToCS(message) {
        const sessionId = getChatSessionId();
        fetch('/cs-chat/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                session_id: sessionId,
                message: message
            })
        });
    }
    
    // Cek pesan baru dari CS
    function checkCSMessages() {
        if (!isCsMode) return; // Hanya cek jika dalam mode CS
        
        const sessionId = getChatSessionId();
        fetch(`/cs-chat/check-new?session_id=${sessionId}`)
            .then(response => response.json())
            .then(data => {
                if (data.messages && data.messages.length > 0) {
                    data.messages.forEach(msg => {
                        // Simpan pesan CS yang baru ke history
                        addBotMessage(msg.message);
                        
                        // Tandai pesan sebagai sudah dibaca di localStorage
                        const readMessages = JSON.parse(localStorage.getItem('jogjaCareReadMessages') || '[]');
                        readMessages.push(msg.id);
                        localStorage.setItem('jogjaCareReadMessages', JSON.stringify(readMessages));
                        
                        // Jika ada pesan yang mengindikasikan sesi CS selesai
                        if (msg.message.toLowerCase().includes('sesi chat telah selesai') || 
                            msg.message.toLowerCase().includes('terima kasih telah menghubungi cs')) {
                            // Tambahkan tombol untuk kembali ke bot secara otomatis
                            addBackToBotButton();
                        }
                    });
                }
            });
    }
    
    // Jika dalam mode CS, mulai pemeriksaan pesan CS
    if (isCsMode) {
        checkCSMessages();
        setInterval(checkCSMessages, 5000);
    }
    
    // Tambahkan fungsi untuk reset history
    window.resetJogjaCareHistory = function() {
        localStorage.removeItem('jogjaCareHistory');
        localStorage.removeItem('jogjaCareIsCsMode');
        // Opsional: Hapus juga pesan di UI
        chatMessages.innerHTML = '';
        // Tampilkan pesan intro dan kategori lagi
        addBotMessage("👩‍⚕️ Hai! Saya siap bantu cari rumah sakit di sekitar tempat wisata Jogja. Silakan pilih kategori:");
        showCategories();
        isCsMode = false;
        document.querySelector('.chat-widget-title').textContent = 'JogjaCare Bot';
        csButton.style.display = 'none';
    };
});

    
</script>