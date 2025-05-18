// FAQ Bot System
let faqData = {
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

let currentFaqState = 'categories'; // categories -> questions -> answer
let currentCategory = null;

function initializeFaqBot() {
    // Clear chat body
    const chatBody = document.getElementById('chatBody');
    chatBody.innerHTML = '';
    
    // Reset state
    currentFaqState = 'categories';
    currentCategory = null;
    
    // Welcome message
    addMessage('bot', 'Selamat datang di JogjaCare FAQ Bot! Silakan pilih kategori pertanyaan yang ingin Anda tanyakan:');
    
    // Display categories
    displayCategories();
}

function displayCategories() {
    const categories = Object.keys(faqData);
    let categoriesHtml = '<ul class="category-list">';
    
    categories.forEach(category => {
        categoriesHtml += `<li class="category-item" onclick="selectCategory('${category}')">${category}</li>`;
    });
    
    categoriesHtml += '</ul>';
    addMessage('bot', categoriesHtml);
}

function selectCategory(category) {
    currentCategory = category;
    currentFaqState = 'questions';
    
    // Display message
    addMessage('user', `Saya ingin tahu tentang: ${category}`);
    
    // Display questions for the category
    const questions = Object.keys(faqData[category]);
    let questionsHtml = '<div class="back-button" onclick="goBackToCategories()">← Kembali ke Kategori</div>';
    questionsHtml += '<ul class="question-list">';
    
    questions.forEach(question => {
        questionsHtml += `<li class="question-item" onclick="selectQuestion('${question.replace(/'/g, "\\'")}')">${question}</li>`;
    });
    
    questionsHtml += '</ul>';
    addMessage('bot', `Silakan pilih pertanyaan tentang ${category}:`);
    addMessage('bot', questionsHtml);
}

function selectQuestion(question) {
    currentFaqState = 'answer';
    
    // Display question
    addMessage('user', question);
    
    // Get and display answer
    const answer = faqData[currentCategory][question];
    
    // Show typing indicator
    showTypingIndicator();
    
    // Simulate typing delay
    setTimeout(() => {
        hideTypingIndicator();
        addMessage('bot', answer);
        
        // Show option to ask another question
        let backHtml = '<div class="back-button" onclick="goBackToQuestions()">← Pertanyaan Lain</div>';
        backHtml += '<div class="back-button" onclick="goBackToCategories()">← Kategori Lain</div>';
        addMessage('bot', backHtml);
    }, 1000);
}

function goBackToCategories() {
    currentFaqState = 'categories';
    currentCategory = null;
    
    addMessage('bot', 'Silakan pilih kategori pertanyaan:');
    displayCategories();
}

function goBackToQuestions() {
    currentFaqState = 'questions';
    selectCategory(currentCategory);
}

function handleFaqBotMessage(message) {
    // Add user message to chat
    addMessage('user', message);
    
    // Simple search in FAQ data
    let found = false;
    
    // Show typing indicator
    showTypingIndicator();
    
    // Process message with a slight delay to simulate typing
    setTimeout(() => {
        // Search for exact or partial match in questions
        for (const category in faqData) {
            for (const question in faqData[category]) {
                if (question.toLowerCase().includes(message.toLowerCase()) || 
                    message.toLowerCase().includes(question.toLowerCase().substring(0, 10))) {
                    // Found a match
                    hideTypingIndicator();
                    addMessage('bot', `<strong>${question}</strong><br>${faqData[category][question]}`);
                    found = true;
                    
                    // Show option to go back
                    let backHtml = '<div class="back-button" onclick="goBackToCategories()">← Kembali ke Kategori</div>';
                    addMessage('bot', backHtml);
                    return;
                }
            }
        }
        
        // No match found
        if (!found) {
            hideTypingIndicator();
            addMessage('bot', 'Maaf, saya tidak menemukan jawaban untuk pertanyaan Anda. Silakan pilih dari kategori berikut:');
            displayCategories();
        }
    }, 1000);
}

// Make functions available globally for onclick handlers
window.selectCategory = selectCategory;
window.selectQuestion = selectQuestion;
window.goBackToCategories = goBackToCategories;
window.goBackToQuestions = goBackToQuestions;
window.handleFaqBotMessage = handleFaqBotMessage;