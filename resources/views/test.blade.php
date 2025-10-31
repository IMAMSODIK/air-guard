<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Peta Kualitas Udara (AQI) Interaktif</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    * { 
      box-sizing: border-box; 
    }
    body {
      margin: 0;
      font-family: "Segoe UI", Arial, sans-serif;
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      color: #333;
      min-height: 100vh;
    }
    header {
      background: linear-gradient(90deg, #007bff 0%, #0056b3 100%);
      color: white;
      padding: 20px;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      letter-spacing: 0.5px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    #controls {
      background: #fff;
      padding: 15px 20px;
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: center;
      gap: 15px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      z-index: 1000;
      margin-bottom: 5px;
      position: relative;
    }
    select, button, input {
      padding: 10px 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    input {
      width: 250px;
      cursor: text;
    }
    select:focus, button:hover, input:focus {
      outline: none;
      border-color: #007bff;
      box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
    }
    button {
      background: linear-gradient(90deg, #007bff 0%, #0056b3 100%);
      color: white;
      border: none;
      font-weight: 600;
    }
    button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    #leaflet-map {
      width: 100%;
      height: 65vh;
      z-index: 1;
      border-radius: 0 0 10px 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    #stats {
      background: #fff;
      margin: 20px auto;
      padding: 25px;
      max-width: 900px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    #aqi-summary {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      margin-bottom: 20px;
      gap: 15px;
    }
    .aqi-box {
      flex: 1;
      min-width: 200px;
      background: #f8f9fa;
      border-radius: 10px;
      text-align: center;
      padding: 20px;
      margin: 5px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      transition: transform 0.3s ease;
    }
    .aqi-box:hover {
      transform: translateY(-5px);
    }
    .aqi-value {
      font-size: 42px;
      font-weight: bold;
      margin: 10px 0;
      padding: 10px;
      border-radius: 8px;
      transition: all 0.3s ease;
    }
    .aqi-city {
      font-size: 20px;
      font-weight: 600;
      color: #495057;
    }
    .aqi-status {
      font-size: 16px;
      font-weight: 500;
      margin-top: 5px;
    }
    .aqi-time {
      font-size: 14px;
      color: #6c757d;
      margin: 8px 0;
    }
    .aqi-pollutants {
      font-size: 14px;
      color: #495057;
      margin-top: 10px;
    }
    canvas {
      margin-top: 15px;
      width: 100%;
      height: 260px;
    }
    #forecast-container {
      margin-top: 25px;
    }
    .forecast-title {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 15px;
      color: #495057;
    }
    .forecast-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
      gap: 15px;
      margin-top: 15px;
    }
    .forecast-day {
      background: #f8f9fa;
      border-radius: 10px;
      padding: 15px;
      text-align: center;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      transition: transform 0.3s ease;
    }
    .forecast-day:hover {
      transform: translateY(-5px);
    }
    .forecast-date {
      font-weight: 600;
      margin-bottom: 8px;
      color: #495057;
    }
    .forecast-aqi {
      font-size: 24px;
      font-weight: bold;
      margin: 8px 0;
      padding: 8px;
      border-radius: 6px;
    }
    .forecast-status {
      font-size: 14px;
      color: #6c757d;
    }
    .forecast-note {
      font-size: 14px;
      color: #6c757d;
      font-style: italic;
      margin-top: 10px;
      text-align: center;
    }
    #search-results {
      position: absolute;
      background: white;
      border: 1px solid #ccc;
      border-radius: 8px;
      max-height: 200px;
      overflow-y: auto;
      z-index: 1001;
      width: 250px;
      display: none;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      top: 100%;
      left: 50%;
      transform: translateX(-50%);
      margin-top: 5px;
    }
    .search-result-item {
      padding: 10px;
      cursor: pointer;
      border-bottom: 1px solid #eee;
    }
    .search-result-item:hover {
      background: #f0f0f0;
    }
    .search-result-item:last-child {
      border-bottom: none;
    }
    #leaflet-map-error {
      color: white;
      background: #dc3545;
      padding: 12px;
      display: none;
      border-radius: 0 0 10px 10px;
      text-align: center;
      font-weight: 500;
    }
    
    /* Loading indicator */
    .loading {
      display: inline-block;
      width: 20px;
      height: 20px;
      border: 3px solid rgba(255,255,255,.3);
      border-radius: 50%;
      border-top-color: #fff;
      animation: spin 1s ease-in-out infinite;
    }
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
    
    /* Location detection modal */
    #location-modal {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.7);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 2000;
    }
    .modal-content {
      background: white;
      padding: 30px;
      border-radius: 12px;
      text-align: center;
      max-width: 400px;
      width: 90%;
      box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }
    .modal-content h3 {
      margin-top: 0;
      color: #007bff;
    }
    .modal-buttons {
      display: flex;
      gap: 10px;
      justify-content: center;
      margin-top: 20px;
    }
    .modal-buttons button {
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 600;
    }
    #allow-location {
      background: #007bff;
      color: white;
    }
    #skip-location {
      background: #6c757d;
      color: white;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      #aqi-summary {
        flex-direction: column;
      }
      .aqi-box {
        width: 100%;
      }
      .forecast-grid {
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
      }
      input {
        width: 200px;
      }
      #search-results {
        width: 200px;
      }
    }
  </style>
</head>
<body>

<header>🌏 Peta Kualitas Udara Dunia (AQI)</header>

<div id="controls">
  <div style="position: relative;">
    <input type="text" id="citySearch" placeholder="Cari kota (contoh: Jakarta, London)" />
    <div id="search-results"></div>
  </div>
  <button id="btnMyLocation">📍 Deteksi Lokasi Saya</button>
</div>

<div id="leaflet-map"></div>

<div id="stats">
  <div id="aqi-summary">
    <div class="aqi-box">
      <div class="aqi-city" id="aqi-city">-</div>
      <div class="aqi-value" id="aqi-value">-</div>
      <div class="aqi-status" id="aqi-status">-</div>
    </div>
    <div class="aqi-box">
      <b>Update Terakhir</b>
      <div class="aqi-time" id="aqi-time">-</div>
      <div class="aqi-pollutants" id="aqi-pollutants"></div>
    </div>
  </div>
  
  <div id="forecast-container">
    <div class="forecast-title">Perkiraan Tren AQI 7 Hari Mendatang</div>
    <div class="forecast-grid" id="forecast-grid">
      <!-- Forecast days will be populated here -->
    </div>
    <div class="forecast-note" id="forecast-note"></div>
  </div>
  
  <canvas id="forecastChart"></canvas>
</div>

<div id="leaflet-map-error"></div>

<!-- Location Detection Modal -->
<div id="location-modal" style="display: none;">
  <div class="modal-content">
    <h3>🌍 Deteksi Lokasi Otomatis</h3>
    <p>Izinkan akses lokasi untuk menampilkan kualitas udara di daerah Anda secara otomatis.</p>
    <p><small>Lokasi Anda tidak akan disimpan atau dibagikan ke pihak lain.</small></p>
    <div class="modal-buttons">
      <button id="allow-location">Izinkan Lokasi</button>
      <button id="skip-location">Lewati</button>
    </div>
  </div>
</div>

<script>
const apiToken = "43560c647d82b9daf429da457f7b39cbda4c3e41";
let map, allMarkers = {}, aqiChart;
let searchTimeout;
let isFirstLoad = true;

function createMap() {
  const base = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19, attribution: '&copy; OpenStreetMap contributors'
  });
  map = L.map("leaflet-map").setView([-2, 118], 5).addLayer(base);
}

function removeMarkers() {
  Object.values(allMarkers).forEach(m => map.removeLayer(m));
  allMarkers = {};
}

function populateMarkers(lat, lon) {
  const bounds = `${lat-1},${lon-1},${lat+1},${lon+1}`;
  removeMarkers();
  
  // Show loading state
  const searchBtn = document.getElementById('btnMyLocation');
  const originalText = searchBtn.innerHTML;
  searchBtn.innerHTML = '<span class="loading"></span> Memuat...';
  searchBtn.disabled = true;
  
  fetch(`https://api.waqi.info/v2/map/bounds/?latlng=${bounds}&token=${apiToken}`)
    .then(r => r.json())
    .then(data => {
      if (data.status !== "ok") throw data.data;
      data.data.forEach(station => {
        const icon = L.icon({
          iconUrl: `https://waqi.info/mapicon/${station.aqi}.30.png`,
          iconSize: [30, 30]
        });
        const marker = L.marker([station.lat, station.lon], {icon, title: station.station.name})
          .addTo(map)
          .on("click", () => {
            L.popup()
              .setLatLng([station.lat, station.lon])
              .setContent(`<b>${station.station.name}</b><br>AQI: ${station.aqi}`)
              .openOn(map);
          });
        allMarkers[station.uid] = marker;
      });
      map.setView([lat, lon], 10);
    })
    .catch(err => {
      const o = document.getElementById("leaflet-map-error");
      o.style.display = "block";
      o.textContent = "Gagal memuat data: " + err;
    })
    .finally(() => {
      // Restore button state
      searchBtn.innerHTML = originalText;
      searchBtn.disabled = false;
    });
}

function searchCity(query) {
  if (!query || query.length < 2) {
    document.getElementById('search-results').style.display = 'none';
    return;
  }
  
  clearTimeout(searchTimeout);
  searchTimeout = setTimeout(() => {
    fetch(`https://api.waqi.info/search/?token=${apiToken}&keyword=${encodeURIComponent(query)}`)
      .then(r => r.json())
      .then(data => {
        if (data.status !== "ok") throw data.data;
        
        const resultsContainer = document.getElementById('search-results');
        resultsContainer.innerHTML = '';
        
        if (data.data.length === 0) {
          resultsContainer.innerHTML = '<div class="search-result-item">Tidak ada hasil ditemukan</div>';
        } else {
          data.data.forEach(station => {
            const item = document.createElement('div');
            item.className = 'search-result-item';
            item.textContent = station.station.name;
            item.addEventListener('click', () => {
              document.getElementById('citySearch').value = station.station.name;
              resultsContainer.style.display = 'none';
              loadStatsByStation(station);
            });
            resultsContainer.appendChild(item);
          });
        }
        
        resultsContainer.style.display = 'block';
      })
      .catch(err => {
        console.error('Error searching city:', err);
        const resultsContainer = document.getElementById('search-results');
        resultsContainer.innerHTML = '<div class="search-result-item">Error mencari kota</div>';
        resultsContainer.style.display = 'block';
      });
  }, 300);
}

function loadStatsByStation(station) {
  const uid = station.uid;
  const cityName = station.station.name;
  
  // Show loading state
  document.getElementById('aqi-city').textContent = 'Memuat data...';
  document.getElementById('aqi-value').textContent = '-';
  document.getElementById('aqi-status').textContent = '-';
  
  fetch(`https://api.waqi.info/feed/@${uid}/?token=${apiToken}`)
    .then(r => r.json())
    .then(res => {
      if (res.status !== "ok") throw res.data;
      const d = res.data;
      const aqi = d.aqi;
      const time = d.time.s;
      const pol = d.iaqi;
      
      document.getElementById("aqi-city").textContent = cityName;
      document.getElementById("aqi-value").textContent = aqi;
      document.getElementById("aqi-time").textContent = time;
      
      const aqiStatus = getAQICategory(aqi);
      document.getElementById("aqi-status").textContent = aqiStatus.status;
      
      // Set AQI value color based on category
      const aqiValueElement = document.getElementById("aqi-value");
      aqiValueElement.style.backgroundColor = aqiStatus.color;
      aqiValueElement.style.color = aqiStatus.textColor;
      
      let polList = "";
      for (let p in pol) {
        polList += `${p.toUpperCase()}: ${pol[p].v} `;
      }
      document.getElementById("aqi-pollutants").textContent = polList;
      
      // if city has coordinates, populate markers nearby
      if (d.city.geo && d.city.geo.length === 2) {
        populateMarkers(d.city.geo[0], d.city.geo[1]);
      } else if (station.lat && station.lon) {
        populateMarkers(station.lat, station.lon);
      }
      
      // Try to get forecast data
      getForecastData(uid, aqi, cityName);
    })
    .catch(e => {
      document.getElementById("aqi-city").textContent = "Gagal memuat data";
      document.getElementById("aqi-value").textContent = "-";
      document.getElementById("aqi-status").textContent = e;
    });
}

function getForecastData(uid, currentAqi, city) {
  // Try to get forecast from the API first
  fetch(`https://api.waqi.info/feed/@${uid}/?token=${apiToken}`)
    .then(r => r.json())
    .then(res => {
      if (res.status === "ok" && res.data.forecast) {
        // Use actual forecast data if available
        useActualForecast(res.data.forecast, city);
      } else {
        // Fallback to generated forecast
        createGeneratedForecast(currentAqi, city, false);
      }
    })
    .catch(() => {
      // Fallback to generated forecast if API fails
      createGeneratedForecast(currentAqi, city, false);
    });
}

function useActualForecast(forecastData, city) {
  const forecastGrid = document.getElementById("forecast-grid");
  forecastGrid.innerHTML = '';
  
  const today = new Date();
  let hasDailyData = false;
  
  // Check if daily forecast is available
  if (forecastData.daily && forecastData.daily.pm25) {
    hasDailyData = true;
    const pm25Data = forecastData.daily.pm25;
    
    for (let i = 0; i < Math.min(7, pm25Data.length); i++) {
      const forecastDate = new Date(today);
      forecastDate.setDate(today.getDate() + i);
      
      // Use PM2.5 data to estimate AQI
      const pm25 = pm25Data[i].avg;
      const forecastAqi = Math.round(pm25 * 0.5); // Rough conversion
      
      const aqiCategory = getAQICategory(forecastAqi);
      
      const dayElement = document.createElement("div");
      dayElement.className = "forecast-day";
      
      // Format date
      const dateString = forecastDate.toLocaleDateString('id-ID', { 
        weekday: 'short', 
        day: 'numeric', 
        month: 'short' 
      });
      
      dayElement.innerHTML = `
        <div class="forecast-date">${dateString}</div>
        <div class="forecast-aqi" style="background-color: ${aqiCategory.color}; color: ${aqiCategory.textColor}">
          ${forecastAqi}
        </div>
        <div class="forecast-status">${aqiCategory.status}</div>
      `;
      
      forecastGrid.appendChild(dayElement);
    }
    
    document.getElementById("forecast-note").textContent = "Data perkiraan berdasarkan prediksi PM2.5";
  } else {
    // Fallback to generated forecast if no daily data
    createGeneratedForecast(currentAqi, city, true);
    return;
  }
  
  // Update chart with actual forecast data
  updateForecastChartWithActualData(forecastData);
}

function createGeneratedForecast(currentAqi, city, fromAPI) {
  const forecastGrid = document.getElementById("forecast-grid");
  forecastGrid.innerHTML = '';
  
  const today = new Date();
  
  for (let i = 0; i < 7; i++) {
    const forecastDate = new Date(today);
    forecastDate.setDate(today.getDate() + i);
    
    // Generate realistic AQI forecast based on current value
    // More realistic variation that considers trends
    let variation;
    if (i === 0) {
      variation = 0; // Today stays the same
    } else {
      // Create a trend: slight increase/decrease over days
      const trend = Math.random() > 0.5 ? 1 : -1;
      variation = Math.round((Math.random() * 15 + 5) * trend * (i/7));
    }
    
    const forecastAqi = Math.max(10, Math.min(300, currentAqi + variation));
    
    const aqiCategory = getAQICategory(forecastAqi);
    
    const dayElement = document.createElement("div");
    dayElement.className = "forecast-day";
    
    // Format date
    const dateString = forecastDate.toLocaleDateString('id-ID', { 
      weekday: 'short', 
      day: 'numeric', 
      month: 'short' 
    });
    
    dayElement.innerHTML = `
      <div class="forecast-date">${dateString}</div>
      <div class="forecast-aqi" style="background-color: ${aqiCategory.color}; color: ${aqiCategory.textColor}">
        ${forecastAqi}
      </div>
      <div class="forecast-status">${aqiCategory.status}</div>
    `;
    
    forecastGrid.appendChild(dayElement);
  }
  
  if (fromAPI) {
    document.getElementById("forecast-note").textContent = "Data perkiraan tidak tersedia, menggunakan estimasi berbasis data saat ini";
  } else {
    document.getElementById("forecast-note").textContent = "Data perkiraan menggunakan estimasi berbasis data saat ini";
  }
  
  // Update the chart with generated forecast
  updateForecastChart(currentAqi);
}

function updateForecastChartWithActualData(forecastData) {
  const labels = [];
  const data = [];
  
  const today = new Date();
  
  if (forecastData.daily && forecastData.daily.pm25) {
    const pm25Data = forecastData.daily.pm25;
    
    for (let i = 0; i < Math.min(7, pm25Data.length); i++) {
      const forecastDate = new Date(today);
      forecastDate.setDate(today.getDate() + i);
      
      const dateString = forecastDate.toLocaleDateString('id-ID', { 
        weekday: 'short', 
        day: 'numeric', 
        month: 'short' 
      });
      
      labels.push(dateString);
      
      // Convert PM2.5 to estimated AQI
      const pm25 = pm25Data[i].avg;
      const estimatedAqi = Math.round(pm25 * 0.5);
      data.push(estimatedAqi);
    }
  }
  
  updateChart(labels, data);
}

function updateForecastChart(current) {
  const labels = [];
  const data = [];
  
  const today = new Date();
  
  for (let i = 0; i < 7; i++) {
    const forecastDate = new Date(today);
    forecastDate.setDate(today.getDate() + i);
    
    const dateString = forecastDate.toLocaleDateString('id-ID', { 
      weekday: 'short', 
      day: 'numeric', 
      month: 'short' 
    });
    
    labels.push(dateString);
    
    // Generate realistic forecast data
    let variation;
    if (i === 0) {
      variation = 0;
    } else {
      const trend = Math.random() > 0.5 ? 1 : -1;
      variation = Math.round((Math.random() * 15 + 5) * trend * (i/7));
    }
    
    data.push(Math.max(10, Math.min(300, current + variation)));
  }
  
  updateChart(labels, data);
}

function updateChart(labels, data) {
  const ctx = document.getElementById("forecastChart").getContext("2d");
  if (aqiChart) aqiChart.destroy();
  
  aqiChart = new Chart(ctx, {
    type: "line",
    data: { 
      labels, 
      datasets: [{
        label: "Perkiraan Tren AQI 7 Hari", 
        data, 
        borderWidth: 3, 
        borderColor: "#007bff",
        backgroundColor: "rgba(0, 123, 255, 0.1)",
        fill: true,
        tension: 0.4,
        pointBackgroundColor: "#007bff",
        pointBorderColor: "#fff",
        pointBorderWidth: 2,
        pointRadius: 5
      }] 
    },
    options: { 
      responsive: true,
      plugins: {
        legend: {
          display: true,
          position: 'top'
        }
      },
      scales: { 
        y: { 
          beginAtZero: false,
          title: {
            display: true,
            text: 'Nilai AQI'
          }
        },
        x: {
          title: {
            display: true,
            text: 'Tanggal'
          }
        }
      } 
    }
  });
}

function getAQICategory(aqi) {
  if (aqi <= 50) return { 
    status: "Baik 😀", 
    color: "#4CAF50", 
    textColor: "white" 
  };
  if (aqi <= 100) return { 
    status: "Sedang 🙂", 
    color: "#FFC107", 
    textColor: "black" 
  };
  if (aqi <= 150) return { 
    status: "Tidak Sehat untuk Sensitif 😐", 
    color: "#FF9800", 
    textColor: "black" 
  };
  if (aqi <= 200) return { 
    status: "Tidak Sehat 😷", 
    color: "#F44336", 
    textColor: "white" 
  };
  if (aqi <= 300) return { 
    status: "Sangat Tidak Sehat 🤒", 
    color: "#9C27B0", 
    textColor: "white" 
  };
  return { 
    status: "Berbahaya ☠️", 
    color: "#673AB7", 
    textColor: "white" 
  };
}

function detectLocation() {
  if (!navigator.geolocation) {
    alert("Browser tidak mendukung geolocation");
    return;
  }
  
  // Show loading state
  const locationBtn = document.getElementById('btnMyLocation');
  const originalText = locationBtn.innerHTML;
  locationBtn.innerHTML = '<span class="loading"></span> Mendeteksi...';
  locationBtn.disabled = true;
  
  navigator.geolocation.getCurrentPosition(pos => {
    const { latitude, longitude } = pos.coords;
    fetch(`https://api.waqi.info/feed/geo:${latitude};${longitude}/?token=${apiToken}`)
      .then(r => r.json())
      .then(d => {
        if (d.status !== "ok") throw d.data;
        const uid = d.data.idx;
        const station = {
          uid: uid,
          station: {
            name: d.data.city.name
          },
          lat: latitude,
          lon: longitude
        };
        loadStatsByStation(station);
      })
      .catch(() => {
        alert("Tidak dapat mendeteksi stasiun AQI terdekat. Coba cari kota secara manual.");
      })
      .finally(() => {
        // Restore button state
        locationBtn.innerHTML = originalText;
        locationBtn.disabled = false;
      });
  }, err => {
    alert("Gagal mendeteksi lokasi: " + err.message);
    // Restore button state
    locationBtn.innerHTML = originalText;
    locationBtn.disabled = false;
  });
}

function showLocationModal() {
  const modal = document.getElementById('location-modal');
  modal.style.display = 'flex';
  
  document.getElementById('allow-location').addEventListener('click', () => {
    modal.style.display = 'none';
    detectLocation();
  });
  
  document.getElementById('skip-location').addEventListener('click', () => {
    modal.style.display = 'none';
    // Load default city (Jakarta) if user skips location detection
    searchCity('Jakarta');
  });
}

// Inisialisasi
createMap();

// Event listeners
document.getElementById("citySearch").addEventListener("input", function() {
  searchCity(this.value);
});

document.getElementById("btnMyLocation").addEventListener("click", detectLocation);

// Close search results when clicking outside
document.addEventListener('click', function(e) {
  if (!e.target.closest('#citySearch') && !e.target.closest('#search-results')) {
    document.getElementById('search-results').style.display = 'none';
  }
});

// Auto-detect location on page load
window.addEventListener('load', function() {
  // Show location modal after a short delay
  setTimeout(() => {
    showLocationModal();
  }, 1000);
});
</script>

</body>
</html>