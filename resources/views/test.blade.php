<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Demo AirZone Multilingual</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/i18next@21.6.10/i18next.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/i18next-http-backend@1.4.1/i18nextHttpBackend.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

  <style>
    body {
      font-family: "Segoe UI", sans-serif;
      padding: 40px;
      background: #f8f9fa;
    }

    .flag-container {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 12px;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }

    .flag-container img {
      width: 40px;
      height: 28px;
      cursor: pointer;
      border: 1px solid #ccc;
      border-radius: 4px;
      transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .flag-container img:hover {
      transform: scale(1.1);
      box-shadow: 0 0 5px rgba(0,0,0,0.2);
    }

    .flag-container img.active {
      border-color: #0d6efd;
      box-shadow: 0 0 6px rgba(13,110,253,0.5);
    }

    .content {
      text-align: center;
      max-width: 700px;
      margin: 0 auto;
    }

    .loading {
      display: none;
      color: #0d6efd;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <div class="container text-center">
    <h2 class="mb-4">🌎 AirZone Multilingual Demo</h2>

    <!-- BENDERA PILIHAN -->
    <div class="flag-container">
      <img src="https://flagcdn.com/w40/id.png" alt="Indonesia" data-lang="id" class="active">
      <img src="https://flagcdn.com/w40/us.png" alt="English" data-lang="en">
      <img src="https://flagcdn.com/w40/fr.png" alt="French" data-lang="fr">
      <img src="https://flagcdn.com/w40/de.png" alt="German" data-lang="de">
      <img src="https://flagcdn.com/w40/jp.png" alt="Japanese" data-lang="ja">
      <img src="https://flagcdn.com/w40/cn.png" alt="Chinese" data-lang="zh">
    </div>
    
    <div class="loading mb-3" id="loadingIndicator">
      Menerjemahkan...
    </div>

    <div class="content">
      <p class="lead" data-i18n="app_description">
        Aplikasi <strong>AirZone</strong> membantu masyarakat memahami kondisi udara dan cuaca secara real-time untuk meningkatkan kesehatan dan keselamatan harian.
      </p>
      <p data-i18n="weather_info">
        Cuaca hari ini cukup cerah namun tingkat polusi udara meningkat.  
        Gunakan masker N95 jika keluar rumah untuk menjaga kesehatan Anda.
      </p>
    </div>
  </div>

  <script>
    // Data terjemahan untuk semua bahasa
    const resources = {
      id: {
        translation: {
          "app_description": "Aplikasi <strong>AirZone</strong> membantu masyarakat memahami kondisi udara dan cuaca secara real-time untuk meningkatkan kesehatan dan keselamatan harian.",
          "weather_info": "Cuaca hari ini cukup cerah namun tingkat polusi udara meningkat. Gunakan masker N95 jika keluar rumah untuk menjaga kesehatan Anda."
        }
      },
      en: {
        translation: {
          "app_description": "The <strong>AirZone</strong> application helps people understand air and weather conditions in real-time to improve daily health and safety.",
          "weather_info": "Today's weather is quite sunny but air pollution levels are increasing. Use an N95 mask if you go outside to maintain your health."
        }
      },
      fr: {
        translation: {
          "app_description": "L'application <strong>AirZone</strong> aide les gens à comprendre les conditions de l'air et de la météo en temps réel pour améliorer la santé et la sécurité quotidiennes.",
          "weather_info": "Le temps aujourd'hui est assez ensoleillé mais les niveaux de pollution de l'air augmentent. Utilisez un masque N95 si vous sortez pour préserver votre santé."
        }
      },
      de: {
        translation: {
          "app_description": "Die <strong>AirZone</strong>-Anwendung hilft den Menschen, Luft- und Wetterbedingungen in Echtzeit zu verstehen, um die tägliche Gesundheit und Sicherheit zu verbessern.",
          "weather_info": "Das Wetter heute ist recht sonnig, aber die Luftverschmutzung nimmt zu. Verwenden Sie eine N95-Maske, wenn Sie nach draußen gehen, um Ihre Gesundheit zu erhalten."
        }
      },
      ja: {
        translation: {
          "app_description": "<strong>AirZone</strong>アプリケーションは、人々が大気と気象の状態をリアルタイムで理解し、日々の健康と安全を向上させるのに役立ちます。",
          "weather_info": "今日の天気はかなり晴れていますが、大気汚染レベルは上昇しています。外出する場合はN95マスクを使用して健康を維持してください。"
        }
      },
      zh: {
        translation: {
          "app_description": "<strong>AirZone</strong> 应用程序帮助人们实时了解空气和天气状况，以提高日常健康和安全。",
          "weather_info": "今天天气相当晴朗，但空气污染水平正在上升。如果外出，请使用 N95 口罩以保持健康。"
        }
      }
    };

    // Inisialisasi i18next
    i18next.init({
      lng: 'id', // Bahasa default
      debug: false,
      resources: resources
    }, function(err, t) {
      // Terapkan terjemahan setelah inisialisasi
      updateContent();
      
      // Setup event listener untuk bendera
      document.querySelectorAll('.flag-container img').forEach(flag => {
        flag.addEventListener('click', function() {
          const lang = this.getAttribute('data-lang');
          changeLanguage(lang, this);
        });
      });
    });

    // Fungsi untuk mengganti bahasa
    function changeLanguage(lang, element) {
      document.getElementById('loadingIndicator').style.display = 'block';
      
      // Update bendera aktif
      document.querySelectorAll(".flag-container img").forEach(img => img.classList.remove("active"));
      element.classList.add("active");
      
      // Ubah bahasa dengan sedikit delay untuk efek visual
      setTimeout(() => {
        i18next.changeLanguage(lang, (err, t) => {
          if (err) {
            console.error('Error changing language:', err);
            document.getElementById('loadingIndicator').style.display = 'none';
            return;
          }
          updateContent();
          document.getElementById('loadingIndicator').style.display = 'none';
        });
      }, 300);
    }

    // Fungsi untuk memperbarui konten dengan terjemahan
    function updateContent() {
      document.querySelectorAll('[data-i18n]').forEach(element => {
        const key = element.getAttribute('data-i18n');
        element.innerHTML = i18next.t(key);
      });
    }
  </script>

</body>
</html>