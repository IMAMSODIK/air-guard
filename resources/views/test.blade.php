<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirZone News</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* --- Gaya tombol bendera --- */
        .language-switcher {
            position: fixed;
            top: 15px;
            right: 20px;
            z-index: 9999;
            display: flex;
            gap: 10px;
        }

        .language-switcher img {
            width: 35px;
            height: 24px;
            cursor: pointer;
            border-radius: 4px;
            border: 2px solid transparent;
            transition: transform 0.2s ease, border 0.2s ease;
        }

        .language-switcher img:hover {
            transform: scale(1.1);
            border-color: #007bff;
        }

        /* --- Sembunyikan widget Google bawaan --- */
        #google_translate_element {
            display: none;
        }

        .goog-logo-link, .goog-te-gadget {
            display: none !important;
        }

        body {
            top: 0px !important;
        }
    </style>
</head>

<body>

    <!-- ✅ Pilihan Bendera -->
    <div class="language-switcher">
        <img src="https://flagcdn.com/w40/id.png" alt="Indonesia" onclick="translatePage('id')">
        <img src="https://flagcdn.com/w40/us.png" alt="English" onclick="translatePage('en')">
        <img src="https://flagcdn.com/w40/fr.png" alt="French" onclick="translatePage('fr')">
        <img src="https://flagcdn.com/w40/jp.png" alt="Japanese" onclick="translatePage('ja')">
    </div>

    <!-- ✅ Konten Contoh -->
    <div class="container mt-5">
        <h1 class="fw-bold">AirZone: Ramalan Cuaca dan Kualitas Udara Real-Time</h1>
        <p class="lead mt-3">
            Aplikasi <strong>AirZone</strong> membantu masyarakat memahami kondisi cuaca dan kualitas udara dengan lebih cerdas.
            Pilih bendera di kanan atas untuk menerjemahkan halaman ini.
        </p>
        <p>
            Perubahan cuaca ekstrem kini bisa diantisipasi dengan data hyperlocal AirZone. Masyarakat dapat mengambil keputusan
            lebih cepat terkait aktivitas harian mereka.
        </p>
    </div>

    <!-- ✅ Google Translate Hidden Element -->
    <div id="google_translate_element"></div>

    <!-- ✅ Script Google Translate -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'id',
                includedLanguages: 'id,en,fr,ja',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>

    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <!-- ✅ Script Pilihan Bahasa -->
    <script>
        function translatePage(lang) {
            const select = document.querySelector('.goog-te-combo');
            if (select) {
                select.value = lang;
                select.dispatchEvent(new Event('change'));
            } else {
                alert("Terjemahan belum siap, mohon tunggu 1-2 detik...");
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
