@extends('template')

@section('own_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .news-wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(330px, 1fr));
            gap: 22px;
            padding-block: 10px;
        }

        .news-card {
            border-radius: 14px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s, box-shadow 0.2s;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .news-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .news-image {
            height: 180px;
            object-fit: cover;
            width: 100%;
        }

        .news-content {
            padding: 16px 18px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .news-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
            line-height: 1.3em;
        }

        .news-desc {
            flex: 1;
            color: #555;
            margin-bottom: 12px;
            font-size: .95rem;
        }

        .news-meta {
            color: #888;
            font-size: .8rem;
            margin-bottom: 10px;
        }

        .news-lang-badge {
            display: inline-block;
            background: #e8f0fe;
            color: #1967d2;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: .75rem;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .read-more-btn {
            padding: 8px 14px;
            border-radius: 8px;
            font-size: .9rem;
        }
    </style>

    <style>
        .news-article {
    font-family: "Merriweather", "Georgia", serif;
    color: #333;
    line-height: 1.8;
    text-align: justify;
}

.news-article h3 {
    font-family: "Playfair Display", serif;
    font-weight: 700;
    font-size: 1.4rem;
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #0d6efd;
    border-left: 4px solid #0d6efd;
    padding-left: 10px;
}

.news-article strong.app-name {
    color: #007bff;
    font-weight: 700;
    letter-spacing: 0.5px;
}

.news-article .person-name {
    font-weight: 700;
    color: #222;
}

.news-article blockquote {
    font-style: italic;
    color: #555;
    border-left: 4px solid #ccc;
    margin: 1.5rem 0;
    padding-left: 1rem;
    background: #f8f9fa;
    border-radius: 6px;
}

.news-article p {
    margin-bottom: 1rem;
}

.news-article img {
    border-radius: 12px;
    margin-bottom: 1.5rem;
}

.video-section {
            margin-bottom: 20px;
        }

        .video-section video {
            width: 100%;
            border-radius: 12px;
        }


    </style>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

@endsection

@section('content')
    <div class="container-fluid">
        <div class="page-title">

            <div class="row mb-4">
                <div class="col-12 text-center">
                    <a href="/"><img src="{{ asset('dashboard_assets/assets/images/logo/logo_dark.png') }}"
                            alt="Logo" class="img-fluid" style="max-width: 100px;"></a>
                </div>
            </div>

            <div class="row video-section mb-2">
                <video autoplay muted loop playsinline>
                    <source src="{{asset('own_assets/videos/video.mp4')}}" type="video/mp4">
                    Browser Anda tidak mendukung pemutaran video.
                </video>
            </div>

            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4><i class="fa-solid fa-newspaper me-2"></i>News</h4>
                    <small class="text-muted">Air quality and pollution updates</small>
                </div>

                <div class="card-body">
                    <div class="news-wrapper">

                        <div class="news-card">
                            <img src="{{ asset('own_assets/images/news-1.jpeg') }}" class="news-image" alt="no-image">
                            <div class="news-content">
                                <span class="news-lang-badge">
                                    ID
                                </span>
                                <div class="news-title">
                                    Andalkan AirZone, Siswa SMAN 1 Medan Waspadai Pancaroba Mendadak: Fluktuasi Suhu Picu
                                    Lonjakan Kasus Flu
                                </div>
                                <div class="news-meta">
                                    {{ \Carbon\Carbon::parse(now())->format('d M Y') }}
                                    • Airzone News
                                </div>
                                <div class="news-desc">
                                    @php
                                        $news1 =
                                            'Periode pancaroba yang ditandai dengan perubahan cuaca ekstrem di Kota Medan kini tak lagi membuat kaget, setidaknya bagi kalangan pelajar yang mulai mengandalkan aplikasi prakiraan cuaca pintar. Aplikasi AirZone menjadi rujukan baru bagi siswa untuk mengatur aktivitas harian mereka, terutama saat suhu bisa melonjak 10 derajat Celsius dalam hitungan jam sebelum dihantam hujan deras.';
                                    @endphp
                                    {{ Str::limit($news1, 150) }}
                                </div>
                                <button data-id="1" class="btn btn-primary read-more-btn read-more-own">
                                    Read More <i class="fa-solid fa-arrow-right ms-1"></i>
                                </button>
                            </div>

                        </div>

                        <div class="news-card">
                            <img src="{{ asset('own_assets/images/news-2.jpeg') }}" class="news-image" alt="no-image">
                            <div class="news-content">
                                <span class="news-lang-badge">
                                    ID
                                </span>
                                <div class="news-title">
                                    AirZone: Lebih dari Sekadar Ramalan Cuaca, Solusi Adaptif Masyarakat Medan Menghadapi
                                    Ancaman Ganda Polusi dan Pancaroba
                                </div>
                                <div class="news-meta">
                                    {{ \Carbon\Carbon::parse(now())->format('d M Y') }}
                                    • Airzone News
                                </div>
                                <div class="news-desc">
                                    @php
                                        $news2 =
                                            'Dalam menghadapi tantangan lingkungan ganda—polusi udara yang kronis dan cuaca pancaroba yang tidak menentu—masyarakat Medan membutuhkan alat yang lebih cerdas dari sekadar aplikasi cuaca biasa. Aplikasi AirZone kini muncul sebagai solusi adaptif, mengintegrasikan data real-time kualitas udara (Air Quality Index / AQI) dan prakiraan cuaca hiperlokal untuk memberdayakan warga mengambil keputusan kesehatan dan aktivitas yang lebih baik.';
                                    @endphp
                                    {{ Str::limit($news2, 150) }}
                                </div>
                                <button data-id="2" class="btn btn-primary read-more-btn read-more-own">
                                    Read More <i class="fa-solid fa-arrow-right ms-1"></i>
                                </button>
                            </div>

                        </div>

                        @forelse ($articles as $article)
                            <div class="news-card">

                                {{-- IMAGE --}}
                                @if (!empty($article['image']))
                                    <img src="{{ $article['image'] }}" class="news-image" alt="news-image">
                                @else
                                    <img src="https://via.placeholder.com/600x300?text=No+Image" class="news-image"
                                        alt="no-image">
                                @endif

                                {{-- CONTENT --}}
                                <div class="news-content">

                                    {{-- LANGUAGE BADGE --}}
                                    <span class="news-lang-badge">
                                        {{ strtoupper($article['language'] ?? 'EN') }}
                                    </span>

                                    {{-- TITLE --}}
                                    <div class="news-title">
                                        {{ $article['title'] }}
                                    </div>

                                    {{-- META --}}
                                    <div class="news-meta">
                                        {{ \Carbon\Carbon::parse($article['publishedAt'] ?? now())->format('d M Y') }}
                                        • {{ $article['source']['name'] ?? 'Unknown Source' }}
                                    </div>

                                    {{-- DESCRIPTION --}}
                                    <div class="news-desc">
                                        {{ Str::limit($article['description'] ?? '-', 150) }}
                                    </div>

                                    {{-- BUTTON --}}
                                    <a href="{{ $article['url'] }}" target="_blank" class="btn btn-primary read-more-btn">
                                        Read More <i class="fa-solid fa-arrow-right ms-1"></i>
                                    </a>

                                </div>

                            </div>
                        @empty
                            <p class="text-muted text-center mt-3">No news found.</p>
                        @endforelse

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal News Detail -->
    <!-- Modal Berita AirZone -->
<div class="modal fade" id="newsModal" tabindex="-1" aria-labelledby="newsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title fw-bold" id="newsModalLabel">AirZone News</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body p-5 news-article">
        <img id="newsModalImage" src="{{ asset('own_assets/images/news-1.jpeg') }}" 
             alt="News Image" class="img-fluid rounded mb-4 w-100 shadow-sm">
        
        <article id="newsModalContent" class="fs-5 lh-lg"></article>
      </div>

      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('own_script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).on("click", ".read-more-own", function() {
            const newsId = $(this).data("id");
            const modal = new bootstrap.Modal(document.getElementById("newsModal"));

            let title = "";
            let image = "";
            let content = "";

            // ==============================
            // 📰 Berita 1
            // ==============================
            if (newsId === 1) {
                title = "<span style='color: white'>Andalkan AirZone, Siswa SMAN 1 Medan Waspadai Pancaroba Mendadak: Fluktuasi Suhu Picu Lonjakan Kasus Flu</span>";
                image = "{{ asset('own_assets/images/news-1.jpeg') }}";
                content = `
        <p><strong>MEDAN</strong> – Periode pancaroba yang ditandai dengan perubahan cuaca ekstrem di Kota Medan kini tak lagi membuat kaget, setidaknya bagi kalangan pelajar yang mulai mengandalkan aplikasi prakiraan cuaca pintar. Aplikasi <strong class="app-name">AirZone</strong> menjadi rujukan baru bagi siswa untuk mengatur aktivitas harian mereka, terutama saat suhu bisa melonjak 10 derajat Celsius dalam hitungan jam sebelum dihantam hujan deras.</p>
        <p>BMKG membenarkan bahwa pergerakan angin dan labilitas atmosfer saat transisi musim memang sulit diprediksi secara tradisional, namun data hyperlocal dari aplikasi membantu masyarakat bersiaga.</p>

        <h3>AirZone Jadi Rujukan Wajib Sebelum Sekolah</h3>
        <p>Fluktuasi suhu yang cepat membuat risiko kesehatan meningkat. Para siswa kini menjadikan <strong class="app-name">AirZone</strong> sebagai alat wajib untuk menentukan pakaian dan perlengkapan harian.</p>

        <blockquote><span class="person-name">Nabil</span>, seorang siswa, mengungkapkan bagaimana <strong class="app-name">AirZone</strong> mengubah rutinitasnya. "Dulu saya sering kehujanan mendadak. Sekarang, <strong class="app-name">AirZone</strong> selalu kasih notifikasi akurat 30 menit sebelum hujan datang. 'AirZone sudah jadi alarm cuaca saya. Kalau di aplikasi tertulis suhu bakal naik 35 derajat siang, saya tahu harus pakai baju yang lebih tipis, tapi tetap bawa payung karena ada potensi petir di jam tiga sore,' ujar <span class="person-name">Nabil</span>.</blockquote>

        <h3>Mengelola Kesehatan di Tengah Perubahan Suhu</h3>
        <blockquote><span class="person-name">Raihan</span>, yang baru saja sembuh dari demam, menceritakan pengalamannya. "Saya sempat mengira sudah aman karena <strong class="app-name">AirZone</strong> bilang pagi cerah. Tapi sorenya suhu langsung anjlok. 'Flu saya kambuh karena tubuh kaget dengan perubahan suhu mendadak. Sekarang, saya tidak cuma lihat ramalan, tapi juga Health Index di <strong class="app-name">AirZone</strong> yang menunjukkan risiko sakit,' kata <span class="person-name">Raihan</span>.</blockquote>

        <h3>Perencanaan Aktivitas dan Pencegahan Dini</h3>
        <blockquote><span class="person-name">Rangga</span>, siswa yang bertanggung jawab pada jadwal ekskul sepak bola, menggunakan data <strong class="app-name">AirZone</strong> untuk membuat keputusan cepat. "Kami tidak mau ambil risiko latihan di bawah terik matahari ekstrem atau kehujanan di lapangan terbuka. 'Dengan real-time prediction dari <strong class="app-name">AirZone</strong>, kami bisa putuskan pukul 14.00 latihan dibatalkan atau dialihkan ke aula. Ini demi menghindari kelelahan dan risiko sambaran petir,' jelas <span class="person-name">Rangga</span>.</blockquote>

        <blockquote><span class="person-name">Rafael</span>, yang aktif membagikan info kesehatan kepada teman-temannya, menyoroti aspek keselamatan. 'AirZone juga memberikan peringatan dini untuk angin kencang. Ini krusial. Kami selalu ingatkan teman-teman untuk tidak berteduh di bawah pohon besar saat ada alert angin kencang atau potensi petir di aplikasi,' saran <span class="person-name">Rafael</span>.</blockquote>

        <h3>Optimisme Siswa dalam Menghadapi Lingkungan</h3>
        <blockquote><span class="person-name">Kiel</span>, siswa yang hobi bepergian, melihat teknologi ini sebagai solusi adaptif. "Pancaroba itu tantangan alam, tapi kami bisa mengatasinya dengan teknologi. Saya selalu cek jalur perjalanan di <strong class="app-name">AirZone</strong>, memastikan rute saya tidak tergenang saat hujan lebat tiba-tiba. Ini soal adaptasi cerdas," ungkap <span class="person-name">Kiel</span>.</blockquote>

        <blockquote>Terakhir, <span class="person-name">Hafiz</span>, menyimpulkan bahwa teknologi telah memberdayakan mereka untuk mengambil kendali atas lingkungan yang tidak menentu. 'AirZone mengubah kita dari korban cuaca menjadi pengelola cuaca. Kami tahu kapan harus istirahat ekstra dan kapan harus siaga. Istirahat yang cukup adalah kunci sukses melawan pancaroba,' tutup <span class="person-name">Hafiz</span>.</blockquote>
        `;
            }

            // ==============================
            // 📰 Berita 2
            // ==============================
            if (newsId === 2) {
                title = "<span style='color: white'>AirZone: Lebih dari Sekadar Ramalan Cuaca, Solusi Adaptif Masyarakat Medan Menghadapi Ancaman Ganda Polusi dan Pancaroba</span>";
                image = "{{ asset('own_assets/images/news-2.jpeg') }}";
                content = `
        <p><strong>MEDAN</strong> – Dalam menghadapi tantangan lingkungan ganda—polusi udara yang kronis dan cuaca pancaroba yang tidak menentu—masyarakat Medan membutuhkan alat yang lebih cerdas dari sekadar aplikasi cuaca biasa. Aplikasi <strong class="app-name">AirZone</strong> kini muncul sebagai solusi adaptif, mengintegrasikan data real-time kualitas udara (Air Quality Index / AQI) dan prakiraan cuaca hiperlokal untuk memberdayakan warga mengambil keputusan kesehatan dan aktivitas yang lebih baik.</p>

        <h3>Integrasi Data: Kekuatan Utama AirZone</h3>
        <p>Inovasi utama <strong class="app-name">AirZone</strong> terletak pada kemampuannya menyajikan informasi yang saling berkaitan. Aplikasi ini tidak hanya memberitahu kapan hujan akan turun, tetapi juga memberikan peringatan simultan mengenai kadar PM2.5 di area spesifik pengguna.</p>

        <blockquote><span class="person-name">Nabil</span>, seorang siswa yang aktif di komunitas lingkungan, melihat <strong class="app-name">AirZone</strong> sebagai alat advokasi. "Selama ini kami hanya mengandalkan data polusi statis. Dengan <strong class="app-name">AirZone</strong>, kami bisa melihat polusi dan cuaca di peta secara langsung. 'Aplikasi ini memotong rantai birokrasi informasi. Kami tidak perlu menunggu pengumuman resmi untuk tahu apakah kami aman bernapas hari ini,' jelas <span class="person-name">Nabil</span>.</blockquote>

        <h3>Memitigasi Risiko Kesehatan Harian</h3>
        <p>Fluktuasi suhu dan kadar polutan tinggi adalah pemicu utama penyakit ISPA dan alergi. <strong class="app-name">AirZone</strong> memberikan panduan kesehatan yang spesifik.</p>

        <blockquote><span class="person-name">Raihan</span>, yang memiliki alergi parah, merasa terbantu. "AirZone memberikan Health Index berdasarkan kombinasi suhu, kelembaban, dan PM2.5. 'Ketika indeksnya menunjukkan risiko alergi tinggi, saya tahu harus mengganti masker dari N95 biasa ke yang lebih ketat, bahkan saat cuaca terlihat cerah. Ini membuat saya tidak gampang sakit,' kata <span class="person-name">Raihan</span>.</blockquote>

        <h3>Memperkuat Perencanaan Aktivitas Komunal</h3>
        <blockquote><span class="person-name">Rangga</span>, sebagai koordinator kegiatan olahraga sekolah, mengandalkan <strong class="app-name">AirZone</strong> untuk manajemen risiko. "Keputusan menunda atau memindahkan latihan sering kali sulit. Tapi dengan data akurat dari <strong class="app-name">AirZone</strong>, kami punya bukti kuat. 'Kami bisa memprediksi dengan presisi kapan angin kencang akan datang atau kapan tingkat polusi akan turun, sehingga jadwal outdoor bisa diatur lebih aman dan efisien,' ujar <span class="person-name">Rangga</span>.</blockquote>

        <blockquote><span class="person-name">Rafael</span>, seorang siswa yang berfokus pada teknologi, menyoroti aspek user-friendly aplikasi. 'Antarmuka <strong class="app-name">AirZone</strong> yang menampilkan peta polusi dan jalur hujan secara layer memudahkan semua orang, tidak hanya ahli. Ini membuat edukasi pencegahan jadi lebih mudah di sekolah,' tambah <span class="person-name">Rafael</span>.</blockquote>

        <h3>Masa Depan Solusi Berbasis Data</h3>
        <blockquote><span class="person-name">Kiel</span>, siswa yang tertarik pada desain kota, melihatnya sebagai komponen Smart City. "Jika data dari <strong class="app-name">AirZone</strong> diintegrasikan dengan sistem lalu lintas kota, mungkin kita bisa mengatur lampu merah berdasarkan tingkat emisi kendaraan di jam puncak. Teknologi harusnya bekerja seperti itu, predictive dan preventive,' harap <span class="person-name">Kiel</span>.</blockquote>

        <blockquote>Terakhir, <span class="person-name">Hafiz</span>, seorang siswa yang berfokus pada kesejahteraan, menyimpulkan nilai sosial dari aplikasi ini. 'AirZone memberikan rasa aman di tengah ketidakpastian. Ketika masyarakat tahu apa yang akan terjadi, mereka bisa bersiap. Ini adalah solusi digital untuk masalah fisik,' tutup <span class="person-name">Hafiz</span>.</blockquote>
        `;
            }

            // Set data ke modal
            $("#newsModalLabel").html(title);
            $("#newsModalImage").attr("src", image);
            $("#newsModalContent").html(content);

            modal.show();
        });
    </script>

@endsection
