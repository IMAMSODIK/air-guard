@extends('template')

@section('own_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        :root {
            --primary-color: #0d6efd;
            --success-color: #198754;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --dark-bg: #1a1a2e;
            --light-bg: #f8f9fa;
        }

        * {
            transition: all 0.3s ease;
        }

        body {
            overflow-x: hidden;
        }

        .chat-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px 15px;
        }

        /* Card Hover Effects */
        .disaster-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .disaster-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
        }

        /* Animated Badge */
        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .badge-pulse {
            animation: pulse 2s infinite;
        }

        /* Progress Bar Styling */
        .progress-custom {
            height: 8px;
            border-radius: 10px;
            background: #e0e0e0;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            transition: width 1s ease;
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Mobile First Adjustments */
        @media (max-width: 768px) {
            .display-5 {
                font-size: 1.8rem;
            }

            .lead {
                font-size: 1rem;
            }

            .disaster-card {
                margin-bottom: 20px;
            }

            .badge {
                font-size: 0.75rem;
            }

            .list-unstyled li {
                font-size: 0.9rem;
                margin-bottom: 12px !important;
            }
        }

        /* Dark Mode */
        body.dark-mode {
            background-color: var(--dark-bg);
            color: #fff;
        }

        body.dark-mode .card {
            background-color: #2d2d44;
            color: #fff;
        }

        body.dark-mode .bg-light {
            background-color: #2d2d44 !important;
            color: #fff;
        }

        body.dark-mode .text-muted {
            color: #aaa !important;
        }

        body.dark-mode .alert-info {
            background-color: #1a3a4a;
            border-color: #0d6efd;
            color: #fff;
        }

        /* Floating Action Button */
        .fab {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }

        .fab button {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Tab Navigation Mobile */
        .nav-tabs-custom {
            overflow-x: auto;
            flex-wrap: nowrap;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
        }

        .nav-tabs-custom .nav-link {
            white-space: nowrap;
        }

        /* Checklist Styling */
        .checklist-item {
            cursor: pointer;
            transition: all 0.2s;
        }

        .checklist-item:hover {
            background: rgba(13, 110, 253, 0.05);
            transform: translateX(5px);
        }

        .checklist-item.completed {
            text-decoration: line-through;
            opacity: 0.7;
        }

        .checklist-item.completed i {
            color: var(--success-color);
        }

        /* Tooltip Custom */
        .custom-tooltip {
            border-bottom: 1px dashed #999;
            cursor: help;
        }

        .nav-tabs-custom {
            overflow-x: auto;
            flex-wrap: nowrap;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
            border-bottom: none;
            gap: 10px;
            padding-bottom: 10px;
        }

        .nav-tabs-custom .nav-link {
            white-space: nowrap;
            border: none;
            border-radius: 50px;
            padding: 12px 24px;
            background: #f1f3f5;
            color: #333;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .nav-tabs-custom .nav-link.active {
            background: var(--primary-color);
            color: white;
            box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3);
        }

        .nav-tabs-custom .nav-link:hover {
            transform: translateY(-2px);
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="chat-container">
            <!-- Dark Mode Toggle -->
            <div class="text-end mb-3">
                <button onclick="toggleDarkMode()" class="btn btn-outline-secondary rounded-pill">
                    <i class="fas fa-moon"></i> <span id="darkModeText">Mode Gelap</span>
                </button>
            </div>

            {{-- Header dengan Animasi --}}
            <div class="text-center mb-5 animate__animated animate__fadeIn">
                <div class="mb-3">
                    <i class="fas fa-shield-hart" style="font-size: 4rem; color: var(--primary-color);"></i>
                </div>
                <h1 class="display-5 fw-bold text-primary">
                    📘 Panduan Siaga Bencana
                </h1>
                <p class="lead text-muted">Edukasi lengkap penanggulangan bencana banjir, kebocoran gas, dan kebakaran</p>

                <!-- Progress Pemahaman -->
                <div class="container mt-4">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card bg-light border-0">
                                <div class="card-body">
                                    <small class="text-muted">📊 Tingkat Pemahaman Anda</small>
                                    <div class="progress-custom mt-2">
                                        <div class="progress-fill bg-primary" id="understandingProgress" style="width: 0%">
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <small id="progressText" class="text-muted">Klik checklist untuk menandai panduan
                                            yang sudah dipahami</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info mt-4 shadow-sm">
                    <i class="fas fa-info-circle"></i>
                    <strong>3 Tahap Krusial:</strong> Prabencana (Kesiapsiagaan) → Saat Bencana (Tanggap Darurat) →
                    Pascabencana (Pemulihan)
                </div>
            </div>

            <!-- Tab Navigation untuk Mobile Friendly -->
            <ul class="nav nav-tabs nav-tabs-custom mb-4 justify-content-center" id="disasterTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#banjir" type="button"
                        role="tab">
                        🌊 Banjir
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#gas" type="button" role="tab">
                        💨 Gas
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#kebakaran" type="button" role="tab">
                        🔥 Kebakaran
                    </button>
                </li>
            </ul>

            {{-- Grid Utama: 3 Bencana --}}
            <div class="tab-content" id="disasterTabContent">
                <!-- Banjir Tab -->
                <div class="tab-pane fade show active" id="banjir" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="card disaster-card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                                <div class="card-header bg-primary text-white text-center py-3">
                                    <h2 class="h4 mb-0"><i class="fas fa-water"></i> 🌊 Banjir</h2>
                                    <small class="opacity-75">Peringatan Dini & Evakuasi</small>
                                </div>
                                <div class="card-body">
                                    <!-- Statistik Singkat -->
                                    <div class="alert alert-light border mb-4">
                                        <i class="fas fa-chart-line text-primary"></i>
                                        <strong>Tahukah Anda?</strong> Banjir bandang dapat terjadi dalam hitungan menit
                                        dengan ketinggian air mencapai >3 meter!
                                    </div>

                                    @include('partials.checklist-section', [
                                        'disaster' => 'banjir',
                                        'title' => '✅ Prabencana (Kesiapsiagaan)',
                                        'items' => [
                                            'Pahami risiko banjir di sekitar Anda - cek peta rawan bencana',
                                            'Siapkan Tas Siaga Bencana (TSB): dokumen kedap air, obat, makanan instan, senter, radio, uang tunai',
                                            'Tinggikan stop kontak & sekring listrik minimal 1 meter dari lantai',
                                            'Simpan nomor darurat BNPB/BPBD (129) dan tetangga terdekat',
                                            'Buat jalur evakuasi keluarga dan titik kumpul yang aman',
                                        ],
                                    ])

                                    @include('partials.checklist-section', [
                                        'disaster' => 'banjir',
                                        'title' => '⚠️ Saat Bencana (Tanggap Darurat)',
                                        'items' => [
                                            'Matikan listrik & gas segera - jangan panik!',
                                            'Pantau informasi debit air melalui radio atau BMKG',
                                            'Evakuasi mandiri ke tempat lebih tinggi sebelum air meninggi',
                                            'Hindari berjalan di arus air - 15 cm saja sudah bisa menjatuhkan',
                                            'Jangan biarkan anak bermain di air banjir (risiko terseret dan penyakit)',
                                        ],
                                    ])

                                    @include('partials.checklist-section', [
                                        'disaster' => 'banjir',
                                        'title' => '🔄 Pascabencana (Pemulihan)',
                                        'items' => [
                                            'Periksa rumah dengan hati-hati, waspadai ular & kalajengking',
                                            'Bersihkan dengan disinfektan dan air bersih segera',
                                            'Waspadai penyakit: leptospirosis, diare, demam berdarah, penyakit kulit',
                                            'Periksa kesehatan keluarga terutama anak-anak dan lansia',
                                            'Laporkan kerusakan ke pihak kelurahan/BPBD',
                                        ],
                                    ])

                                    @include('partials.checklist-section', [
                                        'disaster' => 'banjir',
                                        'title' => '🧰 Peralatan Wajib Saat Banjir',
                                        'items' => [
                                            'Senter tahan air dan baterai cadangan',
                                            'Peluit darurat untuk meminta pertolongan',
                                            'Power bank kapasitas besar minimal 10.000mAh',
                                            'Pelampung atau ban dalam untuk evakuasi',
                                            'Sepatu boot anti air dan sarung tangan karet',
                                            'Persediaan air minum minimal 3 hari',
                                            'Makanan siap saji tinggi kalori',
                                            'Obat pribadi dan vitamin keluarga',
                                        ],
                                    ])

                                    @include('partials.checklist-section', [
                                        'disaster' => 'banjir',
                                        'title' => '🚫 Kesalahan Fatal Saat Banjir',
                                        'items' => [
                                            'Memaksa menerobos banjir dengan motor atau mobil',
                                            'Menyentuh tiang listrik atau kabel yang terkena air',
                                            'Makan makanan yang terkena air banjir',
                                            'Membiarkan anak bermain air banjir',
                                            'Menunggu air terlalu tinggi baru evakuasi',
                                            'Menggunakan listrik sebelum diperiksa teknisi',
                                        ],
                                    ])

                                    @include('partials.checklist-section', [
                                        'disaster' => 'banjir',
                                        'title' => '👨‍👩‍👧 Evakuasi Keluarga',
                                        'items' => [
                                            'Prioritaskan bayi, lansia, dan ibu hamil',
                                            'Pisahkan tas darurat tiap anggota keluarga',
                                            'Pastikan semua anggota tahu titik kumpul',
                                            'Gunakan pakaian terang saat evakuasi malam hari',
                                            'Jangan kembali sebelum ada izin petugas',
                                            'Catat lokasi pengungsian dan kontak penting',
                                        ],
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kebocoran Gas Tab -->
                <div class="tab-pane fade" id="gas" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="card disaster-card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                                <div class="card-header bg-danger text-white text-center py-3">
                                    <h2 class="h4 mb-0"><i class="fas fa-gas-pump"></i> 💨 Kebocoran Gas LPG</h2>
                                    <small class="opacity-75">Bahaya Ledakan & Kebakaran</small>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-danger py-3 mb-4">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <strong>PERINGATAN KERAS!</strong> Jangan menyalakan atau mematikan lampu, kipas
                                        angin, atau alat listrik apapun! Percikan api sekecil apapun bisa memicu ledakan
                                        dahsyat.
                                    </div>

                                    @include('partials.checklist-section', [
                                        'disaster' => 'gas',
                                        'title' => '✅ Pencegahan (Prabencana)',
                                        'items' => [
                                            'Gunakan tabung, selang, dan regulator berlogo SNI asli',
                                            'Ganti selang gas minimal 2 tahun sekali atau jika terlihat retak',
                                            'Pastikan ventilasi dapur cukup (jendela terbuka minimal 20%)',
                                            'Simpan tabung gas di tempat yang terlindung dari sinar matahari langsung',
                                            'Jangan letakkan tabung gas di dekat kompor atau sumber panas',
                                        ],
                                    ])

                                    @include('partials.checklist-section', [
                                        'disaster' => 'gas',
                                        'title' => '⚠️ Saat Terjadi Kebocoran',
                                        'items' => [
                                            '☝️ LEPAS regulator dari tabung gas dengan cepat',
                                            '🚪 BUKA semua pintu dan jendela selebar-lebarnya',
                                            '🏃 BAWA tabung ke area terbuka (halaman) jika aman',
                                            '📱 JANGAN gunakan ponsel di dekat kebocoran gas',
                                            '🚫 JANGAN nyalakan kipas angin atau exhaust fan',
                                        ],
                                    ])

                                    @include('partials.checklist-section', [
                                        'disaster' => 'gas',
                                        'title' => '🔄 Setelah Keadaan Aman',
                                        'items' => [
                                            'Uji kebocoran dengan air sabun - jika muncul gelembung berarti bocor',
                                            'Ganti selang atau regulator yang rusak, jangan dipaksa pakai',
                                            'Panggil teknisi gas resmi untuk perbaikan',
                                            'Catat kejadian untuk laporan ke pertamina/agen gas',
                                        ],
                                    ])

                                    @include('partials.checklist-section', [
                                        'disaster' => 'gas',
                                        'title' => '🛠️ Pemeriksaan Rutin Tabung Gas',
                                        'items' => [
                                            'Cek regulator apakah longgar atau rusak',
                                            'Pastikan selang tidak digigit tikus',
                                            'Periksa tanggal produksi selang gas',
                                            'Pastikan karet seal regulator masih bagus',
                                            'Gunakan penjepit selang agar tidak mudah lepas',
                                            'Pastikan aroma gas tidak tercium di dapur',
                                        ],
                                    ])

                                    @include('partials.checklist-section', [
                                        'disaster' => 'gas',
                                        'title' => '🚨 Tanda-Tanda Kebocoran Gas',
                                        'items' => [
                                            'Tercium bau menyengat seperti belerang',
                                            'Terdengar suara desis dari regulator atau tabung',
                                            'Api kompor berubah warna menjadi merah/oranye',
                                            'Mata terasa perih dan sesak napas',
                                            'Muncul gelembung saat dites dengan air sabun',
                                        ],
                                    ])

                                    @include('partials.checklist-section', [
                                        'disaster' => 'gas',
                                        'title' => '❌ Larangan Saat Kebocoran Gas',
                                        'items' => [
                                            'Jangan menyalakan korek api',
                                            'Jangan menghidupkan kendaraan dekat lokasi',
                                            'Jangan menyalakan saklar listrik',
                                            'Jangan merokok di area kebocoran',
                                            'Jangan menggunakan lift bila di gedung',
                                        ],
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kebakaran Tab -->
                <div class="tab-pane fade" id="kebakaran" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="card disaster-card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                                <div class="card-header bg-orange text-white text-center py-3"
                                    style="background-color: #fd7e14;">
                                    <h2 class="h4 mb-0"><i class="fas fa-fire"></i> 🔥 Kebakaran</h2>
                                    <small class="opacity-75">Pencegahan & Penanganan Cepat</small>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-warning mb-4">
                                        <i class="fas fa-clock"></i>
                                        <strong>Fakta:</strong> Kebakaran dapat meluas ke seluruh ruangan dalam waktu < 3
                                            menit! </div>

                                            @include('partials.checklist-section', [
                                                'disaster' => 'kebakaran',
                                                'title' => '✅ Pencegahan (Prabencana)',
                                                'items' => [
                                                    'Sediakan APAR (Dry Chemical Powder/CO₂) di dekat dapur dan pintu keluar',
                                                    'Hindari stop kontak overload - 1 colokan maksimal 4 device',
                                                    'Jauhkan bahan mudah terbakar (minyak, alkohol, kertas) dari kompor',
                                                    'Pasang detector asap di setiap ruangan (bisa DIY dengan sensor)',
                                                    'Simpan kunci cadangan di luar rumah untuk akses darurat',
                                                ],
                                            ])

                                            @include('partials.checklist-section', [
                                                'disaster' => 'kebakaran',
                                                'title' => '⚠️ Saat Kebakaran',
                                                'items' => [
                                                    '🎯 T.A.P.S: Tarik pin → Arahkan ke api → Pencet tuas → Semprot merata',
                                                    '🔥 Gunakan kain basah untuk api kecil (kompor minyak/gas)',
                                                    '⏱️ Jika api membesar > 2 menit, EVAKUASI segera!',
                                                    '🏃 Merangkak di bawah asap - udara bersih berada 30cm dari lantai',
                                                    '📞 Hubungi 113 atau 112 setelah berada di tempat aman',
                                                ],
                                            ])

                                            @include('partials.checklist-section', [
                                                'disaster' => 'kebakaran',
                                                'title' => '🔄 Setelah Kebakaran',
                                                'items' => [
                                                    'Jangan masuk terlalu cepat - tunggu izin dari petugas pemadam',
                                                    'Dokumentasikan semua kerusakan untuk klaim asuransi',
                                                    'Periksa instalasi listrik sebelum menyalakan lagi',
                                                    'Perhatikan gejala gangguan pernapasan dari asap',
                                                    'Bersihkan sisa abu dengan masker N95',
                                                ],
                                            ])

                                            @include('partials.checklist-section', [
                                                'disaster' => 'kebakaran',
                                                'title' => '🧯 Jenis APAR dan Fungsinya',
                                                'items' => [
                                                    'APAR Dry Chemical untuk kebakaran umum',
                                                    'APAR CO₂ untuk listrik dan elektronik',
                                                    'APAR Foam untuk bahan cair mudah terbakar',
                                                    'Periksa tekanan APAR setiap bulan',
                                                    'Pastikan APAR mudah dijangkau',
                                                    'Pelajari cara penggunaan sebelum darurat',
                                                ],
                                            ])

                                            @include('partials.checklist-section', [
                                                'disaster' => 'kebakaran',
                                                'title' => '🏢 Evakuasi Saat Gedung Terbakar',
                                                'items' => [
                                                    'Gunakan tangga darurat, bukan lift',
                                                    'Tutup hidung dengan kain basah',
                                                    'Ikuti jalur EXIT berlampu hijau',
                                                    'Bantu anak-anak dan lansia saat evakuasi',
                                                    'Jangan kembali mengambil barang',
                                                    'Berkumpul di assembly point',
                                                ],
                                            ])

                                            @include('partials.checklist-section', [
                                                'disaster' => 'kebakaran',
                                                'title' => '⚡ Pencegahan Korsleting Listrik',
                                                'items' => [
                                                    'Cabut charger yang tidak digunakan',
                                                    'Hindari kabel bertumpuk',
                                                    'Gunakan MCB sesuai daya listrik',
                                                    'Segera ganti kabel terkelupas',
                                                    'Jangan menaruh kabel di bawah karpet',
                                                    'Periksa instalasi listrik minimal 1 tahun sekali',
                                                ],
                                            ])

                                            @include('partials.checklist-section', [
                                                'disaster' => 'kebakaran',
                                                'title' => '🩹 Pertolongan Pertama Luka Bakar',
                                                'items' => [
                                                    'Siram luka dengan air mengalir 10-20 menit',
                                                    'Jangan oles pasta gigi atau mentega',
                                                    'Tutup luka dengan kain steril',
                                                    'Minum air untuk mencegah dehidrasi',
                                                    'Segera ke rumah sakit jika luka parah',
                                                    'Jangan pecahkan lepuhan kulit',
                                                ],
                                            ])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Ringkasan Kontak Darurat + Tips Tambahan + Infografis --}}
                <div class="row mt-5 g-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4 bg-dark text-white h-100">
                            <div class="card-body">
                                <h3 class="h5 mb-3"><i class="fas fa-phone-alt"></i> 📞 Kontak Darurat Indonesia</h3>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled small">
                                            <li class="mb-2"><i class="fas fa-phone me-2"></i><strong>112</strong> -
                                                Darurat Umum</li>
                                            <li class="mb-2"><i
                                                    class="fas fa-fire-extinguisher me-2"></i><strong>113</strong> -
                                                Pemadam</li>
                                            <li class="mb-2"><i
                                                    class="fas fa-ambulance me-2"></i><strong>118/119</strong> - Ambulans
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled small">
                                            <li class="mb-2"><i class="fas fa-mountain me-2"></i><strong>115</strong> -
                                                Basarnas</li>
                                            <li class="mb-2"><i class="fas fa-shield-alt me-2"></i><strong>110</strong>
                                                - Polisi</li>
                                            <li class="mb-2"><i class="fas fa-cloud-sun me-2"></i><strong>129</strong> -
                                                BNPB</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="alert alert-info mt-3 mb-0">
                                    <i class="fas fa-save"></i> Simpan nomor-nomor ini di kontak favorit HP Anda!
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4 bg-light h-100">
                            <div class="card-body">
                                <h3 class="h5 mb-3"><i class="fas fa-lightbulb text-warning"></i> ✨ Tips Tambahan</h3>
                                <ul class="mb-0">
                                    <li class="mb-2"><i class="fas fa-users me-2 text-primary"></i> <strong>Simulasi
                                            rutin:</strong> Latih evakuasi keluarga tiap 3 bulan</li>
                                    <li class="mb-2"><i class="fas fa-cloud-upload-alt me-2 text-primary"></i>
                                        <strong>Dokumen digital:</strong> Scan dokumen penting ke cloud
                                    </li>
                                    <li class="mb-2"><i class="fas fa-medkit me-2 text-primary"></i> <strong>P3K
                                            Lengkap:</strong> Obat luka bakar, antiseptik, plester, kasa steril</li>
                                    <li class="mb-2"><i class="fas fa-power-off me-2 text-primary"></i> <strong>Matikan
                                            kompor:</strong> Saat tidur atau meninggalkan rumah</li>
                                    <li><i class="fas fa-charging-station me-2 text-primary"></i> <strong>Power
                                            bank:</strong> Selalu isi daya untuk komunikasi darurat</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body">
                                <h3 class="h5 mb-3"><i class="fas fa-chart-pie text-success"></i> 📊 Infografis Cepat</h3>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <small>Kesiapsiagaan Masyarakat</small>
                                        <small class="text-primary">35%</small>
                                    </div>
                                    <div class="progress-custom">
                                        <div class="progress-fill bg-primary" style="width: 35%"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <small>Kepemilikan APAR di Rumah</small>
                                        <small class="text-warning">15%</small>
                                    </div>
                                    <div class="progress-custom">
                                        <div class="progress-fill bg-warning" style="width: 15%"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <small>Pengetahuan Nomor Darurat</small>
                                        <small class="text-danger">45%</small>
                                    </div>
                                    <div class="progress-custom">
                                        <div class="progress-fill bg-danger" style="width: 45%"></div>
                                    </div>
                                </div>
                                <div class="alert alert-success mt-2 mb-0 py-2">
                                    <i class="fas fa-check-circle"></i> <small>Anda sudah lebih siap dengan membaca panduan
                                        ini!</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body">
                                <h2 class="h4 mb-4 text-primary">
                                    <i class="fas fa-circle-question"></i> FAQ Kebencanaan
                                </h2>

                                <div class="accordion" id="faqAccordion">

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#faq1">
                                                Apa isi Tas Siaga Bencana?
                                            </button>
                                        </h2>
                                        <div id="faq1" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
                                                Dokumen penting, makanan instan, air minum, obat-obatan, senter, power bank,
                                                pakaian, uang tunai, dan peluit darurat.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faq2">
                                                Kapan harus evakuasi?
                                            </button>
                                        </h2>
                                        <div id="faq2" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                Segera evakuasi ketika ada peringatan resmi, air mulai naik cepat, atau
                                                api/gas tidak dapat dikendalikan dalam beberapa menit.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faq3">
                                                Mengapa tidak boleh menggunakan lift saat kebakaran?
                                            </button>
                                        </h2>
                                        <div id="faq3" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                Lift dapat mati mendadak akibat listrik padam dan menjebak pengguna di dalam
                                                gedung yang terbakar.
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Footer Catatan --}}
                <div class="text-center mt-5 text-muted small border-top pt-4">
                    <i class="fas fa-shield-alt"></i> Panduan ini bersifat edukatif. Segera hubungi petugas profesional
                    jika situasi membahayakan jiwa.
                    <br>
                    <small class="mt-2 d-block">© 2024 - Tetap waspada, selamatkan nyawa</small>
                </div>
            </div>
        </div>

        <!-- Floating Action Button untuk scroll to top -->
        <div class="fab">
            <button onclick="scrollToTop()" class="btn btn-primary rounded-circle shadow">
                <i class="fas fa-arrow-up"></i>
            </button>
        </div>
    @endsection

    @section('own_script')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Checklist System untuk progress tracking
            let completedChecklists = JSON.parse(localStorage.getItem('completedChecklists') || '{}');

            function updateProgress() {
                const allChecklists = document.querySelectorAll('.checklist-item');
                const total = allChecklists.length;
                let completed = 0;

                allChecklists.forEach(item => {
                    const id = item.dataset.id;
                    if (completedChecklists[id]) {
                        completed++;
                        item.classList.add('completed');
                        item.querySelector('i').classList.remove('fa-circle-check');
                        item.querySelector('i').classList.add('fa-check-circle');
                    } else {
                        item.classList.remove('completed');
                        item.querySelector('i').classList.remove('fa-check-circle');
                        item.querySelector('i').classList.add('fa-circle-check');
                    }
                });

                const percentage = total > 0 ? (completed / total) * 100 : 0;
                const progressBar = document.getElementById('understandingProgress');
                const progressText = document.getElementById('progressText');

                if (progressBar) {
                    progressBar.style.width = percentage + '%';
                }

                if (progressText) {
                    progressText.textContent =
                        `✅ ${completed} dari ${total} panduan sudah dipahami (${Math.round(percentage)}%)`;
                }

                localStorage.setItem('completedChecklists', JSON.stringify(completedChecklists));
            }

            function toggleChecklist(id) {
                if (completedChecklists[id]) {
                    delete completedChecklists[id];
                } else {
                    completedChecklists[id] = true;
                }
                updateProgress();
            }

            // Dark Mode Toggle
            function toggleDarkMode() {
                document.body.classList.toggle('dark-mode');
                const isDark = document.body.classList.contains('dark-mode');
                localStorage.setItem('darkMode', isDark);
                const btnText = document.getElementById('darkModeText');
                if (btnText) {
                    btnText.textContent = isDark ? 'Mode Terang' : 'Mode Gelap';
                }
            }

            // Scroll to top
            function scrollToTop() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            // Inisialisasi
            document.addEventListener('DOMContentLoaded', function() {
                // Load dark mode preference
                if (localStorage.getItem('darkMode') === 'true') {
                    document.body.classList.add('dark-mode');
                    const btnText = document.getElementById('darkModeText');
                    if (btnText) btnText.textContent = 'Mode Terang';
                }

                // Generate checklist items dinamis
                const checklistContainers = document.querySelectorAll('.checklist-container');
                checklistContainers.forEach((container, idx) => {
                    const items = container.querySelectorAll('.checklist-item');
                    items.forEach((item, itemIdx) => {
                        const id =
                            `${container.dataset.disaster}-${container.dataset.section}-${itemIdx}`;
                        item.dataset.id = id;
                        item.onclick = () => toggleChecklist(id);
                    });
                });

                updateProgress();

                // Animate progress on scroll
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                        }
                    });
                });

                document.querySelectorAll('.disaster-card').forEach(card => {
                    observer.observe(card);
                });
            });
        </script>
