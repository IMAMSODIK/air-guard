<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Demo Google Translate</title>

  <!-- Bootstrap CSS (opsional, untuk tampilan tombol lebih bagus) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      font-family: "Segoe UI", sans-serif;
      padding: 40px;
      background: #f8f9fa;
    }
    .flag-buttons button {
      font-size: 16px;
      padding: 8px 16px;
      border-radius: 8px;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <div class="container text-center">
    <h2 class="mb-4">🌍 Demo Halaman Multibahasa</h2>
    <p class="lead">
      Aplikasi <b>AirZone</b> membantu masyarakat memahami kondisi udara dan cuaca secara real-time untuk meningkatkan kesehatan dan keselamatan harian.
    </p>

    <!-- Tombol Bendera -->
    <div class="flag-buttons d-flex justify-content-center gap-2 mt-4">
      <button onclick="changeLanguage('id')" class="btn btn-light border">🇮🇩 Indonesia</button>
      <button onclick="changeLanguage('en')" class="btn btn-light border">🇺🇸 English</button>
      <button onclick="changeLanguage('fr')" class="btn btn-light border">🇫🇷 Français</button>
      <button onclick="changeLanguage('ja')" class="btn btn-light border">🇯🇵 日本語</button>
      <button onclick="changeLanguage('de')" class="btn btn-light border">🇩🇪 Deutsch</button>
      <button onclick="changeLanguage('zh-CN')" class="btn btn-light border">🇨🇳 中文</button>
    </div>

    <hr class="my-4">

    <p>
      Cuaca hari ini cukup cerah namun tingkat polusi udara meningkat.  
      Gunakan masker N95 jika keluar rumah untuk menjaga kesehatan Anda.
    </p>
  </div>

  <!-- Elemen Google Translate (disembunyikan) -->
  <div id="google_translate_element" style="display:none;"></div>

  <!-- Script Google Translate -->
  <script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({
        pageLanguage: 'id', // bahasa utama halaman
        includedLanguages: 'en,id,fr,es,ja,ar,de,zh-CN',
        autoDisplay: false
      }, 'google_translate_element');
    }
  </script>
  <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  <!-- Script Ganti Bahasa -->
  <script>
    function changeLanguage(lang) {
        var select = document.querySelector("select.goog-te-combo");

        if (!select) {
            console.log("Menunggu Google Translate siap...");
            setTimeout(function() {
                changeLanguage(lang);
            }, 500);
            return;
        }

        select.value = lang;
        select.dispatchEvent(new Event("change"));
    }
  </script>

</body>
</html>
