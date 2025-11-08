<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glosarium Istilah Cuaca</title>
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --accent: #1abc9c;
            --light: #ecf0f1;
            --dark: #34495e;
            --danger: #e74c3c;
            --warning: #f39c12;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 2rem 0;
            text-align: center;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .search-container {
            max-width: 600px;
            margin: 0 auto 2rem;
            position: relative;
        }

        #searchInput {
            width: 100%;
            padding: 15px 20px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        #searchInput:focus {
            outline: none;
            box-shadow: 0 4px 20px rgba(52, 152, 219, 0.3);
        }

        .alphabet-nav {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 2rem;
            padding: 15px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .alphabet-nav button {
            width: 40px;
            height: 40px;
            border: none;
            background: var(--light);
            border-radius: 50%;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .alphabet-nav button:hover {
            background: var(--secondary);
            color: white;
        }

        .alphabet-nav button.active {
            background: var(--secondary);
            color: white;
        }

        .glossary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 3rem;
        }

        .term-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            border-left: 5px solid var(--accent);
        }

        .term-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .term-card h3 {
            color: var(--primary);
            margin-bottom: 10px;
            font-size: 1.4rem;
        }

        .term-card .definition {
            color: var(--dark);
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .term-card .category {
            display: inline-block;
            background: var(--light);
            color: var(--dark);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        .category-kualitas-udara {
            background: #e8f6f3 !important;
            color: var(--accent) !important;
        }

        .category-cuaca {
            background: #e3f2fd !important;
            color: var(--secondary) !important;
        }

        .category-iklim {
            background: #fff3e0 !important;
            color: var(--warning) !important;
        }

        .detail-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            overflow-y: auto;
            padding: 20px;
        }

        .modal-content {
            background: white;
            max-width: 800px;
            margin: 50px auto;
            border-radius: 20px;
            padding: 30px;
            position: relative;
            animation: modalFade 0.3s ease;
        }

        @keyframes modalFade {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .close-modal {
            position: absolute;
            top: 20px;
            right: 25px;
            font-size: 2rem;
            cursor: pointer;
            color: var(--dark);
            transition: color 0.2s ease;
        }

        .close-modal:hover {
            color: var(--danger);
        }

        .modal-header {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--light);
        }

        .modal-header h2 {
            color: var(--primary);
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .modal-body {
            margin-bottom: 25px;
        }

        .modal-body p {
            margin-bottom: 15px;
            font-size: 1.1rem;
        }

        .impact-section,
        .prevention-section {
            background: var(--light);
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }

        .impact-section h3,
        .prevention-section h3 {
            color: var(--primary);
            margin-bottom: 15px;
            font-size: 1.3rem;
        }

        .impact-section ul,
        .prevention-section ul {
            padding-left: 20px;
        }

        .impact-section li,
        .prevention-section li {
            margin-bottom: 8px;
        }

        .pm25-visual {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 25px 0;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .pm25-size-comparison {
            flex: 1;
            text-align: center;
        }

        .size-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .pm25-circle {
            background: var(--danger);
        }

        .hair-circle {
            background: var(--secondary);
        }

        .comparison-text {
            font-size: 0.9rem;
            color: var(--dark);
        }

        footer {
            text-align: center;
            padding: 20px;
            color: var(--dark);
            font-size: 0.9rem;
            margin-top: 2rem;
            border-top: 1px solid var(--light);
        }

        @media (max-width: 768px) {
            .glossary-grid {
                grid-template-columns: 1fr;
            }

            .pm25-visual {
                flex-direction: column;
                gap: 20px;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <h1>Glosarium Istilah Cuaca</h1>
            <p class="subtitle">Temukan definisi istilah-istilah penting dalam meteorologi dan kualitas udara</p>
        </div>
    </header>

    <div class="container">
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Cari istilah cuaca...">
        </div>

        <div class="alphabet-nav" id="alphabetNav">
            <!-- Alphabet buttons will be generated by JavaScript -->
        </div>

        <div class="glossary-grid" id="glossaryGrid">
            <!-- Term cards will be generated by JavaScript -->
        </div>
    </div>

    <div class="detail-modal" id="detailModal">
        <div class="modal-content">
            <span class="close-modal" id="closeModal">&times;</span>
            <div class="modal-header">
                <h2 id="modalTitle">PM2.5</h2>
                <span class="category" id="modalCategory">Kualitas Udara</span>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Modal content will be populated by JavaScript -->
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>Glosarium Istilah Cuaca &copy; 2023 - Sumber data dari BMKG dan WHO</p>
        </div>
    </footer>

    <script>
        const glossaryData = [{
                term: "PM2.5",
                definition: "Partikel halus di udara dengan diameter 2.5 mikrometer atau lebih kecil yang dapat masuk jauh ke dalam paru-paru dan aliran darah.",
                fullDescription: "PM2.5 adalah partikel halus di udara dengan diameter 2.5 mikrometer atau lebih kecil (kira-kira 1/30 lebar rambut manusia). Partikel ini sangat kecil sehingga dapat terhirup dan masuk jauh ke dalam paru-paru bahkan aliran darah, menyebabkan berbagai masalah kesehatan seperti gangguan pernapasan dan kardiovaskular.",
                category: "Kualitas Udara",
                categoryClass: "category-kualitas-udara"
            },
            {
                term: "PM10",
                definition: "Partikel debu atau partikel kasar di udara dengan diameter kurang dari 10 mikrometer.",
                fullDescription: "PM10 mencakup partikel seperti debu, serbuk sari, dan asap yang cukup kecil untuk terhirup ke dalam sistem pernapasan bagian atas. Kadar PM10 yang tinggi dapat menyebabkan iritasi pada mata, hidung, dan tenggorokan serta memperburuk penyakit paru-paru.",
                category: "Kualitas Udara",
                categoryClass: "category-kualitas-udara"
            },
            {
                term: "CO (Karbon Monoksida)",
                definition: "Gas tidak berwarna dan tidak berbau yang beracun, dihasilkan dari pembakaran bahan bakar yang tidak sempurna.",
                fullDescription: "Karbon Monoksida (CO) terbentuk ketika bahan bakar seperti bensin, kayu, atau gas alam terbakar tidak sempurna. Paparan CO dalam jumlah tinggi dapat mengurangi kemampuan darah membawa oksigen, menyebabkan pusing, sakit kepala, bahkan kematian.",
                category: "Kualitas Udara",
                categoryClass: "category-kualitas-udara"
            },
            {
                term: "NO₂ (Nitrogen Dioksida)",
                definition: "Gas berwarna coklat kemerahan yang berbau tajam dan dapat menyebabkan iritasi pada saluran pernapasan.",
                fullDescription: "Nitrogen Dioksida (NO₂) adalah hasil dari pembakaran bahan bakar fosil, terutama dari kendaraan bermotor dan pembangkit listrik. Gas ini dapat menyebabkan peradangan paru-paru dan menurunkan fungsi paru, terutama pada anak-anak dan penderita asma.",
                category: "Kualitas Udara",
                categoryClass: "category-kualitas-udara"
            },
            {
                term: "SO₂ (Sulfur Dioksida)",
                definition: "Gas tidak berwarna dengan bau tajam seperti belerang terbakar, berasal dari pembakaran batu bara dan minyak.",
                fullDescription: "Sulfur Dioksida (SO₂) dilepaskan dari pembakaran bahan bakar fosil di pembangkit listrik, industri, dan kendaraan. Gas ini dapat bereaksi dengan air di atmosfer membentuk hujan asam dan menyebabkan iritasi pernapasan.",
                category: "Kualitas Udara",
                categoryClass: "category-kualitas-udara"
            },
            {
                term: "O₃ (Ozon Permukaan)",
                definition: "Gas reaktif yang terbentuk di atmosfer bawah akibat reaksi sinar matahari dengan polutan seperti NOx dan VOC.",
                fullDescription: "Ozon di lapisan permukaan bumi (troposfer) bukanlah ozon pelindung di atmosfer atas. Ia terbentuk dari reaksi antara sinar UV dengan polutan kendaraan dan industri. Konsentrasi ozon tinggi dapat menyebabkan iritasi mata, tenggorokan, dan memperburuk penyakit paru-paru.",
                category: "Kualitas Udara",
                categoryClass: "category-kualitas-udara"
            },
            {
                term: "µg/m³",
                definition: "Satuan pengukuran untuk konsentrasi polutan di udara, yaitu mikrogram per meter kubik udara.",
                fullDescription: "µg/m³ (mikrogram per meter kubik) digunakan untuk mengukur seberapa banyak partikel atau gas tertentu terdapat di satu meter kubik udara. Semakin tinggi nilainya, semakin banyak polutan di udara tersebut.",
                category: "Satuan",
                categoryClass: "category-satuan"
            },
            {
                term: "Suhu Udara",
                definition: "Ukuran panas atau dinginnya udara di suatu tempat pada waktu tertentu.",
                fullDescription: "Suhu udara menunjukkan energi panas di atmosfer. Diukur menggunakan termometer dan biasanya dinyatakan dalam derajat Celcius (°C). Faktor yang memengaruhi suhu meliputi waktu, lokasi, ketinggian, dan kondisi awan.",
                category: "Cuaca",
                categoryClass: "category-cuaca"
            },
            {
                term: "Tekanan Udara",
                definition: "Gaya yang diberikan oleh udara pada satuan luas permukaan bumi.",
                fullDescription: "Tekanan udara diukur dengan barometer dan dinyatakan dalam milibar (mb) atau hektopascal (hPa). Tekanan tinggi biasanya menandakan cuaca cerah, sementara tekanan rendah berkaitan dengan hujan dan badai.",
                category: "Cuaca",
                categoryClass: "category-cuaca"
            },
            {
                term: "Kelembaban Relatif",
                definition: "Perbandingan jumlah uap air di udara dengan jumlah maksimum uap air yang dapat ditampung udara pada suhu tertentu.",
                fullDescription: "Kelembaban relatif dinyatakan dalam persen (%). Kelembaban tinggi membuat udara terasa gerah dan meningkatkan risiko hujan, sementara kelembaban rendah dapat menyebabkan kulit kering dan udara terasa panas.",
                category: "Cuaca",
                categoryClass: "category-cuaca"
            },
            {
                term: "Kecepatan Angin",
                definition: "Kecepatan pergerakan udara di atmosfer, biasanya diukur dalam kilometer per jam atau meter per detik.",
                fullDescription: "Kecepatan angin dipengaruhi oleh perbedaan tekanan udara antara dua wilayah. Angin kencang dapat membawa awan hujan, menyebabkan badai, atau membantu menyebarkan polusi udara.",
                category: "Cuaca",
                categoryClass: "category-cuaca"
            },
            {
                term: "Arah Angin",
                definition: "Arah dari mana angin bertiup, biasanya dinyatakan dalam derajat atau arah mata angin (misal: barat daya).",
                fullDescription: "Arah angin penting dalam prakiraan cuaca karena dapat menunjukkan pergerakan sistem tekanan, hujan, atau polutan dari satu wilayah ke wilayah lain.",
                category: "Cuaca",
                categoryClass: "category-cuaca"
            },
            {
                term: "Curah Hujan",
                definition: "Jumlah air hujan yang jatuh di suatu wilayah dalam periode waktu tertentu.",
                fullDescription: "Curah hujan diukur dalam milimeter (mm). Nilai ini menunjukkan seberapa banyak air hujan yang terkumpul di permukaan datar tanpa penguapan atau aliran. Curah hujan tinggi dapat menyebabkan banjir, sedangkan curah hujan rendah dapat menimbulkan kekeringan.",
                category: "Cuaca",
                categoryClass: "category-cuaca"
            },
            {
                term: "Awan Kumulonimbus",
                definition: "Jenis awan vertikal yang sangat tinggi dan padat, terkait dengan badai petir dan cuaca ekstrem.",
                fullDescription: "Awan Kumulonimbus dapat menjulang hingga ketinggian lebih dari 20 km dan menghasilkan hujan lebat, petir, angin kencang, serta tornado.",
                category: "Cuaca",
                categoryClass: "category-cuaca"
            },
            {
                term: "El Niño",
                definition: "Fenomena pemanasan suhu permukaan laut di Samudera Pasifik tropis bagian tengah dan timur.",
                fullDescription: "El Niño dapat memengaruhi pola cuaca global, menyebabkan kekeringan di beberapa wilayah dan hujan lebat di wilayah lain. Fenomena ini terjadi setiap 2–7 tahun.",
                category: "Iklim",
                categoryClass: "category-iklim"
            },
            {
                term: "La Niña",
                definition: "Fenomena pendinginan suhu permukaan laut di Samudera Pasifik tropis bagian tengah dan timur.",
                fullDescription: "La Niña merupakan kebalikan dari El Niño. Kondisi ini dapat meningkatkan curah hujan di wilayah tertentu dan menyebabkan suhu lebih dingin di wilayah tropis.",
                category: "Iklim",
                categoryClass: "category-iklim"
            },
            {
                term: "Indeks UV",
                definition: "Ukuran intensitas radiasi ultraviolet matahari di permukaan bumi.",
                fullDescription: "Semakin tinggi nilai Indeks UV, semakin besar risiko kulit terbakar akibat paparan sinar matahari. Nilai di atas 6 memerlukan perlindungan tambahan seperti tabir surya atau pakaian pelindung.",
                category: "Cuaca",
                categoryClass: "category-cuaca"
            },
            {
                term: "Presipitasi",
                definition: "Setiap bentuk air cair atau beku yang jatuh dari atmosfer ke permukaan bumi.",
                fullDescription: "Presipitasi mencakup hujan, salju, hujan es, atau embun. Fenomena ini terjadi ketika tetesan air di awan menjadi cukup berat untuk jatuh karena gravitasi.",
                category: "Cuaca",
                categoryClass: "category-cuaca"
            },
            {
                term: "Kabut",
                definition: "Kondensasi uap air di udara dekat permukaan tanah yang mengurangi jarak pandang.",
                fullDescription: "Kabut terbentuk ketika udara lembap mendingin hingga mencapai titik embun. Ini sering terjadi di pagi hari atau di daerah lembah dan pegunungan.",
                category: "Cuaca",
                categoryClass: "category-cuaca"
            },
            {
                term: "Kilat dan Petir",
                definition: "Pelepasan muatan listrik di atmosfer yang menyebabkan cahaya (kilat) dan suara (guntur).",
                fullDescription: "Petir terjadi akibat perbedaan muatan listrik antara awan dan tanah atau antar awan. Fenomena ini sering disertai hujan badai dan berbahaya jika terjadi di area terbuka.",
                category: "Cuaca",
                categoryClass: "category-cuaca"
            }
        ];


        // Inisialisasi halaman
        document.addEventListener('DOMContentLoaded', function() {
            initializeAlphabetNav();
            renderGlossaryCards(glossaryData);
            setupEventListeners();
        });

        // Inisialisasi navigasi alfabet
        function initializeAlphabetNav() {
            const alphabetNav = document.getElementById('alphabetNav');
            const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');

            alphabet.forEach(letter => {
                const button = document.createElement('button');
                button.textContent = letter;
                button.addEventListener('click', () => filterByLetter(letter));
                alphabetNav.appendChild(button);
            });
        }

        // Render kartu glosarium
        function renderGlossaryCards(data) {
            const glossaryGrid = document.getElementById('glossaryGrid');
            glossaryGrid.innerHTML = '';

            data.forEach(item => {
                const card = document.createElement('div');
                card.className = 'term-card';
                card.innerHTML = `
                    <h3>${item.term}</h3>
                    <div class="definition">${item.definition}</div>
                    <span class="category ${item.categoryClass}">${item.category}</span>
                `;
                card.addEventListener('click', () => openTermDetail(item));
                glossaryGrid.appendChild(card);
            });
        }

        // Filter berdasarkan huruf
        function filterByLetter(letter) {
            const filteredData = glossaryData.filter(item =>
                item.term.toUpperCase().startsWith(letter)
            );

            // Update active state in alphabet nav
            document.querySelectorAll('.alphabet-nav button').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            renderGlossaryCards(filteredData);
        }

        // Setup event listeners
        function setupEventListeners() {
            // Search functionality
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const filteredData = glossaryData.filter(item =>
                    item.term.toLowerCase().includes(searchTerm) ||
                    item.definition.toLowerCase().includes(searchTerm)
                );
                renderGlossaryCards(filteredData);
            });

            // Modal close functionality
            const closeModal = document.getElementById('closeModal');
            const detailModal = document.getElementById('detailModal');

            closeModal.addEventListener('click', () => {
                detailModal.style.display = 'none';
            });

            window.addEventListener('click', (event) => {
                if (event.target === detailModal) {
                    detailModal.style.display = 'none';
                }
            });
        }

        // Buka detail istilah
        function openTermDetail(termData) {
            const modalTitle = document.getElementById('modalTitle');
            const modalCategory = document.getElementById('modalCategory');
            const modalBody = document.getElementById('modalBody');
            const detailModal = document.getElementById('detailModal');

            modalTitle.textContent = termData.term;
            modalCategory.textContent = termData.category;
            modalCategory.className = `category ${termData.categoryClass}`;

            // Konten khusus untuk PM2.5
            if (termData.term === "PM2.5") {
                modalBody.innerHTML = `
                    <p>${termData.fullDescription}</p>
                    
                    <div class="pm25-visual">
                        <div class="pm25-size-comparison">
                            <div class="size-circle pm25-circle">PM2.5</div>
                            <div class="comparison-text">Partikel 2.5μm</div>
                        </div>
                        <div style="text-align: center; font-size: 1.5rem; font-weight: bold;">VS</div>
                        <div class="pm25-size-comparison">
                            <div class="size-circle hair-circle">Rambut</div>
                            <div class="comparison-text">Lebar rambut manusia ~70μm</div>
                        </div>
                    </div>
                    
                    <div class="impact-section">
                        <h3>Dampak Kesehatan PM2.5</h3>
                        <ul>
                            <li>Masalah pernapasan seperti asma dan bronkitis</li>
                            <li>Penyakit kardiovaskular dan serangan jantung</li>
                            <li>Kanker paru-paru</li>
                            <li>Gangguan perkembangan pada anak</li>
                            <li>Iritasi mata, hidung, dan tenggorokan</li>
                        </ul>
                    </div>
                    
                    <div class="prevention-section">
                        <h3>Cara Melindungi Diri</h3>
                        <ul>
                            <li>Pantau kualitas udara harian (AQI)</li>
                            <li>Gunakan masker N95 saat kualitas udara buruk</li>
                            <li>Batasi aktivitas luar ruangan saat polusi tinggi</li>
                            <li>Gunakan pembersih udara di dalam ruangan</li>
                            <li>Tutup jendela saat tingkat polusi tinggi</li>
                        </ul>
                    </div>
                    
                    <p><strong>Sumber:</strong> PM2.5 terutama berasal dari pembakaran bahan bakar fosil, kebakaran hutan, emisi industri, dan reaksi kimia di atmosfer.</p>
                `;
            } else {
                modalBody.innerHTML = `
                    <p>${termData.fullDescription}</p>
                `;
            }

            detailModal.style.display = 'block';
        }
    </script>
</body>

</html>
