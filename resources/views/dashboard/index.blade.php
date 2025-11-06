@extends('template')

@section('own_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --aqi-good: #00e400;
            --aqi-moderate: #ffff00;
            --aqi-usg: #ff7e00;
            --aqi-unhealthy: #ff0000;
            --aqi-very: #8f3f97;
            --aqi-hazard: #7e0023;
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-color: #1e293b;
            --muted-color: #64748b;
            --border-color: #e2e8f0;
            --sidebar-width: 320px;
            --border-radius: 12px;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: var(--text-color);
        }

        .app-container {
            display: grid;
            grid-template-columns: var(--sidebar-width) 1fr;
            min-height: 100vh;
            gap: 0;
        }

        /* Sidebar Styles */
        .sidebar {
            background: var(--card-bg);
            padding: 24px;
            box-shadow: var(--shadow);
            overflow-y: auto;
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 32px;
            font-weight: 700;
            font-size: 1.5em;
            color: #3b82f6;
        }

        .logo-icon {
            width: 32px;
            height: 32px;
            background: #3b82f6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .control-section {
            margin-bottom: 32px;
        }

        .section-title {
            font-size: 0.875em;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--muted-color);
            margin-bottom: 12px;
        }

        select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            background: var(--card-bg);
            font-size: 0.95em;
            transition: all 0.2s;
        }

        select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .location-buttons {
            display: flex;
            gap: 8px;
            margin-top: 8px;
        }

        .location-btn {
            flex: 1;
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background: var(--bg-color);
            font-size: 0.85em;
            cursor: pointer;
            transition: all 0.2s;
        }

        .location-btn:hover {
            background: var(--border-color);
        }

        .location-btn.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .summary-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: var(--border-radius);
            margin-bottom: 24px;
        }

        .aqi-display {
            text-align: center;
            margin-bottom: 16px;
        }

        .aqi-value {
            font-size: 3em;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 4px;
        }

        .aqi-category {
            font-size: 1.1em;
            opacity: 0.9;
        }

        .location-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9em;
            opacity: 0.8;
        }

        .params-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 16px;
        }

        .param-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 12px;
            border-radius: 8px;
            text-align: center;
        }

        .param-value {
            font-size: 1.2em;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .param-label {
            font-size: 0.8em;
            opacity: 0.8;
        }

        /* Main Content Styles */
        .main-content {
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .map-container {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            flex: 1;
        }

        #map {
            height: 400px;
            width: 100%;
        }

        .forecast-section {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 24px;
        }

        .section-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-header h2 {
            font-size: 1.5em;
            font-weight: 600;
            color: var(--text-color);
        }

        /* Calendar Styles */
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 12px;
        }

        .calendar-header {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 12px;
            margin-bottom: 12px;
        }

        .calendar-day-header {
            text-align: center;
            font-weight: 600;
            color: var(--muted-color);
            font-size: 0.875em;
            padding: 8px;
            text-transform: uppercase;
        }

        .calendar-day {
            background: var(--bg-color);
            border-radius: 8px;
            padding: 16px 12px;
            text-align: center;
            transition: all 0.2s;
            border: 2px solid transparent;
            cursor: pointer;
        }

        .calendar-day:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .calendar-day.active {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .day-date {
            font-size: 0.9em;
            color: var(--muted-color);
            margin-bottom: 8px;
        }

        .day-number {
            font-size: 1.4em;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .day-aqi {
            font-size: 1.1em;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .day-pm25 {
            font-size: 0.8em;
            color: var(--muted-color);
            margin-bottom: 8px;
        }

        .day-category {
            font-size: 0.75em;
            padding: 4px 8px;
            border-radius: 20px;
            background: var(--aqi-moderate);
            color: #000;
            font-weight: 500;
        }

        /* Legend Styles */
        .legend {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75em;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        /* Map Popup Styles */
        .station-popup {
            min-width: 200px;
        }

        .station-popup h3 {
            margin: 0 0 8px 0;
            color: var(--text-color);
        }

        .station-popup .aqi-value {
            font-size: 1.5em;
            font-weight: bold;
            margin: 8px 0;
        }

        .station-popup .pollutants {
            font-size: 0.9em;
            color: var(--muted-color);
            margin: 8px 0;
        }

        .station-popup .time {
            font-size: 0.8em;
            color: var(--muted-color);
            margin-top: 8px;
        }

        /* Loading States */
        .loading {
            text-align: center;
            padding: 40px;
            color: var(--muted-color);
        }

        .detection-status {
            font-size: 0.8em;
            color: var(--muted-color);
            margin-top: 8px;
            text-align: center;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .app-container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                border-radius: 0;
            }
        }

        @media (max-width: 768px) {
            .calendar {
                grid-template-columns: repeat(2, 1fr);
            }

            .calendar-header {
                display: none;
            }

            .params-grid {
                grid-template-columns: 1fr;
            }

            .location-buttons {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .calendar {
                grid-template-columns: 1fr;
            }

            .main-content {
                padding: 16px;
            }

            .sidebar {
                padding: 16px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Home</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-body px-0 pb-0">
                                <div class="row justify-content-center">
                                    <div class="app-container">
                                        <!-- Sidebar -->
                                        <div class="sidebar">
                                            <div class="logo" style="display: flex; justify-content: center;">
    <a href="/">
        <img src="{{ asset('dashboard_assets/assets/images/logo/logo_dark.png') }}" 
             alt="Logo" class="img-fluid" style="max-width: 100px;">
    </a>
</div>


                                            <div class="control-section">
                                                <div class="section-title">Location</div>
                                                <select id="citySelect">
                                                    <option value="">-- Select City --</option>
                                                </select>
                                                <div class="location-buttons">
                                                    <button class="location-btn" id="detectLocation">
                                                        📍 Detect My Location
                                                    </button>
                                                    <button class="location-btn" id="useNearestStation">
                                                        🔍 Nearest Station
                                                    </button>
                                                </div>
                                                <div class="detection-status" id="detectionStatus"></div>
                                            </div>

                                            <div class="summary-card">
                                                <div class="aqi-display">
                                                    <div class="aqi-value" id="avgAQI">—</div>
                                                    <div class="aqi-category" id="avgCategory">Loading...</div>
                                                </div>
                                                <div class="location-info">
                                                    <span id="areaLabel">Area: —</span>
                                                    <span id="areaInfo">Stations: 0</span>
                                                </div>

                                                <div class="params-grid">
                                                    <div class="param-item">
                                                        <div class="param-value" id="avg_pm25">—</div>
                                                        <div class="param-label">PM2.5</div>
                                                    </div>
                                                    <div class="param-item">
                                                        <div class="param-value" id="avg_pm10">—</div>
                                                        <div class="param-label">PM10</div>
                                                    </div>
                                                    <div class="param-item">
                                                        <div class="param-value" id="avg_o3">—</div>
                                                        <div class="param-label">O₃</div>
                                                    </div>
                                                    <div class="param-item">
                                                        <div class="param-value" id="avg_no2">—</div>
                                                        <div class="param-label">NO₂</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="control-section">
                                                <div class="section-title">AQI Scale</div>
                                                <div class="legend">
                                                    <div class="legend-item">
                                                        <div class="legend-color" style="background: var(--aqi-good)"></div>
                                                        <span>Good</span>
                                                    </div>
                                                    <div class="legend-item">
                                                        <div class="legend-color" style="background: var(--aqi-moderate)">
                                                        </div>
                                                        <span>Moderate</span>
                                                    </div>
                                                    <div class="legend-item">
                                                        <div class="legend-color" style="background: var(--aqi-usg)"></div>
                                                        <span>USG</span>
                                                    </div>
                                                    <div class="legend-item">
                                                        <div class="legend-color" style="background: var(--aqi-unhealthy)">
                                                        </div>
                                                        <span>Unhealthy</span>
                                                    </div>
                                                    <div class="legend-item">
                                                        <div class="legend-color" style="background: var(--aqi-very)"></div>
                                                        <span>Very Unhealthy</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Main Content -->
                                        <div class="main-content">
                                            <div class="map-container">
                                                <div id="map"></div>
                                            </div>

                                            <div class="forecast-section">
                                                <div class="section-header">
                                                    <h2>7-Day Air Quality Forecast</h2>
                                                </div>

                                                <div class="calendar-header">
                                                    <div class="calendar-day-header">Sun</div>
                                                    <div class="calendar-day-header">Mon</div>
                                                    <div class="calendar-day-header">Tue</div>
                                                    <div class="calendar-day-header">Wed</div>
                                                    <div class="calendar-day-header">Thu</div>
                                                    <div class="calendar-day-header">Fri</div>
                                                    <div class="calendar-day-header">Sat</div>
                                                </div>

                                                <div class="calendar" id="forecastCalendar">
                                                    <div class="loading">Loading forecast data...</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('own_script')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Configuration
        const WAQI_TOKEN = "43560c647d82b9daf429da457f7b39cbda4c3e41";
        const FALLBACK_CITY = {
            city: "Jakarta",
            country: "Indonesia",
            lat: -6.21462,
            lng: 106.84513
        };
        const MAX_DETAIL_STATIONS = 30;

        const curatedCities = [
            // Indonesia Cities
            {
                country: "Indonesia",
                city: "Jakarta",
                lat: -6.21462,
                lng: 106.84513
            },
            {
                country: "Indonesia",
                city: "Surabaya",
                lat: -7.24917,
                lng: 112.75083
            },
            {
                country: "Indonesia",
                city: "Bandung",
                lat: -6.91746,
                lng: 107.61912
            },
            {
                country: "Indonesia",
                city: "Medan",
                lat: 3.59520,
                lng: 98.67223
            },
            {
                country: "Indonesia",
                city: "Semarang",
                lat: -6.96667,
                lng: 110.41667
            },
            {
                country: "Indonesia",
                city: "Makassar",
                lat: -5.14767,
                lng: 119.43273
            },
            {
                country: "Indonesia",
                city: "Denpasar, Bali",
                lat: -8.65000,
                lng: 115.21667
            },
            {
                country: "Indonesia",
                city: "Yogyakarta",
                lat: -7.79722,
                lng: 110.36880
            },
            {
                country: "Indonesia",
                city: "Palembang",
                lat: -2.99093,
                lng: 104.75656
            },
            {
                country: "Indonesia",
                city: "Balikpapan",
                lat: -1.26753,
                lng: 116.82887
            },
            {
                country: "Indonesia",
                city: "Pekanbaru",
                lat: 0.53333,
                lng: 101.45000
            },
            {
                country: "Indonesia",
                city: "Batam",
                lat: 1.04563,
                lng: 104.03045
            },
            {
                country: "Indonesia",
                city: "Banda Aceh",
                lat: 5.54829,
                lng: 95.32376
            },
            {
                country: "Indonesia",
                city: "Manado",
                lat: 1.47483,
                lng: 124.84258
            },
            {
                country: "Indonesia",
                city: "Padang",
                lat: -0.94924,
                lng: 100.35427
            },
            {
                country: "Indonesia",
                city: "Malang",
                lat: -7.97970,
                lng: 112.63040
            },
            {
                country: "Indonesia",
                city: "Banjarmasin",
                lat: -3.31987,
                lng: 114.59075
            },
            {
                country: "Indonesia",
                city: "Samarinda",
                lat: -0.49167,
                lng: 117.14583
            },

            // International Cities
            {
                country: "Japan",
                city: "Tokyo",
                lat: 35.6895,
                lng: 139.69171
            },
            {
                country: "Japan",
                city: "Osaka",
                lat: 34.6937,
                lng: 135.5023
            },
            {
                country: "Japan",
                city: "Kyoto",
                lat: 35.0116,
                lng: 135.7681
            },
            {
                country: "United States",
                city: "New York",
                lat: 40.71427,
                lng: -74.00597
            },
            {
                country: "United Kingdom",
                city: "London",
                lat: 51.50722,
                lng: -0.1275
            },
            {
                country: "France",
                city: "Paris",
                lat: 48.85661,
                lng: 2.35149
            },
            {
                country: "China",
                city: "Beijing",
                lat: 39.9042,
                lng: 116.4074
            }
        ];

        // Global variables
        let map, stationMarkers = {},
            lastStations = [];
        let userLocation = null;

        // Utility Functions
        function getCssVar(name) {
            return getComputedStyle(document.documentElement).getPropertyValue(name).trim();
        }

        function aqiCategory(aqi) {
            if (aqi == null || isNaN(Number(aqi))) return {
                cat: 'Unknown',
                color: '#999'
            };
            aqi = Number(aqi);
            if (aqi <= 50) return {
                cat: 'Good',
                color: getCssVar('--aqi-good')
            };
            if (aqi <= 100) return {
                cat: 'Moderate',
                color: getCssVar('--aqi-moderate')
            };
            if (aqi <= 150) return {
                cat: 'Unhealthy for Sensitive Groups',
                color: getCssVar('--aqi-usg')
            };
            if (aqi <= 200) return {
                cat: 'Unhealthy',
                color: getCssVar('--aqi-unhealthy')
            };
            if (aqi <= 300) return {
                cat: 'Very Unhealthy',
                color: getCssVar('--aqi-very')
            };
            return {
                cat: 'Hazardous',
                color: getCssVar('--aqi-hazard')
            };
        }

        function pm25ToAQI(pm25) {
            const pm25Val = Number(pm25);
            if (isNaN(pm25Val) || pm25Val < 0) return null;

            const breakpoints = [{
                    pmLo: 0.0,
                    pmHi: 12.0,
                    aqiLo: 0,
                    aqiHi: 50
                },
                {
                    pmLo: 12.1,
                    pmHi: 35.4,
                    aqiLo: 51,
                    aqiHi: 100
                },
                {
                    pmLo: 35.5,
                    pmHi: 55.4,
                    aqiLo: 101,
                    aqiHi: 150
                },
                {
                    pmLo: 55.5,
                    pmHi: 150.4,
                    aqiLo: 151,
                    aqiHi: 200
                },
                {
                    pmLo: 150.5,
                    pmHi: 250.4,
                    aqiLo: 201,
                    aqiHi: 300
                },
                {
                    pmLo: 250.5,
                    pmHi: 350.4,
                    aqiLo: 301,
                    aqiHi: 400
                },
                {
                    pmLo: 350.5,
                    pmHi: 500.4,
                    aqiLo: 401,
                    aqiHi: 500
                }
            ];

            for (const bp of breakpoints) {
                if (pm25Val >= bp.pmLo && pm25Val <= bp.pmHi) {
                    return Math.round(
                        ((bp.aqiHi - bp.aqiLo) / (bp.pmHi - bp.pmLo)) * (pm25Val - bp.pmLo) + bp.aqiLo
                    );
                }
            }

            return pm25Val > 500.4 ? 500 : null;
        }

        function toFixedOrDash(v, digits = 1) {
            return (v === null || v === undefined || isNaN(Number(v))) ? '—' : Number(v).toFixed(digits);
        }

        function distanceKm(lat1, lon1, lat2, lon2) {
            function r(d) {
                return d * Math.PI / 180
            }
            const R = 6371;
            const dLat = r(lat2 - lat1),
                dLon = r(lon2 - lon1);
            const a = Math.sin(dLat / 2) ** 2 + Math.cos(r(lat1)) * Math.cos(r(lat2)) * Math.sin(dLon / 2) ** 2;
            return 2 * R * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        }

        // Location Detection Functions
        async function detectUserLocation() {
            const statusElement = document.getElementById('detectionStatus');
            statusElement.textContent = 'Detecting your location...';

            if (!navigator.geolocation) {
                statusElement.textContent = 'Geolocation not supported';
                return null;
            }

            try {
                const position = await new Promise((resolve, reject) => {
                    navigator.geolocation.getCurrentPosition(resolve, reject, {
                        timeout: 10000,
                        maximumAge: 600000,
                        enableHighAccuracy: true
                    });
                });

                const location = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                    accuracy: position.coords.accuracy
                };

                userLocation = location;
                statusElement.textContent = `Location detected (accuracy: ${Math.round(location.accuracy)}m)`;

                return location;
            } catch (error) {
                console.error('Location detection failed:', error);
                let errorMessage = 'Location detection failed';

                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        errorMessage = 'Location access denied. Please allow location access.';
                        break;
                    case error.POSITION_UNAVAILABLE:
                        errorMessage = 'Location information unavailable.';
                        break;
                    case error.TIMEOUT:
                        errorMessage = 'Location request timeout.';
                        break;
                }

                statusElement.textContent = errorMessage;
                return null;
            }
        }

        async function findNearestStation() {
            const statusElement = document.getElementById('detectionStatus');

            if (!userLocation) {
                statusElement.textContent = 'Please detect location first';
                return;
            }

            statusElement.textContent = 'Finding nearest station...';

            try {
                // Search for stations around user location
                const bounds =
                    `${userLocation.lat + 1},${userLocation.lng - 1},${userLocation.lat - 1},${userLocation.lng + 1}`;
                const stations = await fetchStations(bounds);

                if (stations.length === 0) {
                    statusElement.textContent = 'No stations found nearby';
                    return;
                }

                // Find the nearest station
                let nearestStation = null;
                let minDistance = Infinity;

                stations.forEach(station => {
                    const distance = distanceKm(userLocation.lat, userLocation.lng, station.lat, station.lon);
                    if (distance < minDistance) {
                        minDistance = distance;
                        nearestStation = station;
                    }
                });

                if (nearestStation) {
                    statusElement.textContent =
                        `Found station: ${nearestStation.station?.name || 'Unknown'} (${Math.round(minDistance)}km away)`;

                    // Create a custom city object for the nearest station
                    const nearestCity = {
                        city: nearestStation.station?.name || 'Nearest Station',
                        country: 'Local Station',
                        lat: nearestStation.lat,
                        lng: nearestStation.lon,
                        isNearestStation: true
                    };

                    // Select this location
                    await selectCity(nearestCity);
                } else {
                    statusElement.textContent = 'No suitable station found';
                }

            } catch (error) {
                console.error('Error finding nearest station:', error);
                statusElement.textContent = 'Error finding nearest station';
            }
        }

        function findNearestCuratedCity(lat, lng) {
            let nearestCity = null;
            let minDistance = Infinity;

            curatedCities.forEach(city => {
                const distance = distanceKm(lat, lng, city.lat, city.lng);
                if (distance < minDistance) {
                    minDistance = distance;
                    nearestCity = city;
                }
            });

            return {
                city: nearestCity,
                distance: minDistance
            };
        }

        // Map Functions
        function initMap() {
            map = L.map('map').setView([0, 0], 2);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(map);

            map.on('moveend', debounce(async () => {
                const b = map.getBounds();
                const boundsStr = `${b.getNorth()},${b.getWest()},${b.getSouth()},${b.getEast()}`;
                await refreshStationsAndSummary(boundsStr);
            }, 700));
        }

        async function fetchStations(boundsStr) {
            try {
                const url = `https://api.waqi.info/v2/map/bounds/?latlng=${boundsStr}&token=${WAQI_TOKEN}`;
                const r = await fetch(url);
                const j = await r.json();
                if (j.status !== 'ok') return [];
                return j.data || [];
            } catch (e) {
                console.error('fetchStations err', e);
                return [];
            }
        }

        function clearMarkers() {
            for (const k in stationMarkers) {
                try {
                    map.removeLayer(stationMarkers[k]);
                } catch (e) {}
            }
            stationMarkers = {};
        }

        function renderStationMarkers(stations) {
            clearMarkers();
            stations.forEach(s => {
                const aqiVal = (s.aqi === undefined || s.aqi === null || s.aqi === '-') ? 'na' : s.aqi;
                const iconUrl = `https://waqi.info/mapicon/${aqiVal}.30.png`;
                const icon = L.icon({
                    iconUrl,
                    iconSize: [46, 46],
                    iconAnchor: [23, 23]
                });
                const marker = L.marker([s.lat, s.lon], {
                    icon,
                    title: s.station && s.station.name ? s.station.name : 'station'
                }).addTo(map);
                marker.on('click', async () => {
                    const popup = L.popup({
                        maxWidth: 380
                    }).setLatLng([s.lat, s.lon]).setContent(
                        `<div class="station-popup"><b>${s.station && s.station.name ? s.station.name : 'Station'}</b>Loading details... (AQI ${s.aqi})</div>`
                    ).openOn(map);
                    try {
                        const detail = await fetchAQIDetail(s.uid);
                        popup.setContent(buildPopupHtml(detail));
                    } catch (err) {
                        popup.setContent(
                            `<div class="station-popup"><b>${s.station && s.station.name ? s.station.name : 'Station'}</b><div>Error loading details</div></div>`
                        );
                    }
                });
                stationMarkers[s.uid] = marker;
            });

            // Add user location marker if available
            if (userLocation) {
                const userIcon = L.divIcon({
                    className: 'user-location-marker',
                    html: '📍',
                    iconSize: [30, 30],
                    iconAnchor: [15, 30]
                });

                L.marker([userLocation.lat, userLocation.lng], {
                    icon: userIcon,
                    title: 'Your Location'
                }).addTo(map).bindPopup('Your Current Location');
            }
        }

        function buildPopupHtml(detail) {
            const title = (detail.city && detail.city.name) ? detail.city.name : (detail.attributions && detail
                .attributions[0] && detail.attributions[0].name ? detail.attributions[0].name : 'Station');
            const aqi = detail.aqi !== undefined ? detail.aqi : '—';
            const timeStr = detail.time && (detail.time.s || detail.time.v) ? (detail.time.s || new Date(detail.time.v *
                1000).toLocaleString()) : '';
            let pollutantsHtml = '';
            if (detail.iaqi) {
                const keys = Object.keys(detail.iaqi);
                pollutantsHtml = keys.map(k => `<b>${k.toUpperCase()}</b>: ${detail.iaqi[k].v}`).join(' • ');
            }
            const sources = (detail.attributions || []).map(a => a.url ?
                `<a href="${a.url}" target="_blank" rel="noopener">${a.name}</a>` : a.name).join(' • ');
            return `<div class="station-popup">
                <h3>${title}</h3>
                <div class="aqi-value" style="color: ${aqiCategory(aqi).color}">AQI: ${aqi}</div>
                <div class="pollutants">${pollutantsHtml || 'No pollutant data'}</div>
                <div class="time">${timeStr}</div>
                <div class="sources" style="margin-top:8px;font-size:12px">Sources: ${sources || '—'}</div>
            </div>`;
        }

        async function fetchAQIDetail(uid) {
            const url = `https://api.waqi.info/feed/@${uid}/?token=${WAQI_TOKEN}`;
            const r = await fetch(url);
            const j = await r.json();
            if (j.status !== 'ok') throw j;
            return j.data;
        }

        async function computeAndShowSummaryForStations(centerLat, centerLng, stations) {
            if (!stations || stations.length === 0) {
                resetSummary();
                return;
            }

            const scored = stations.map(s => {
                const d = distanceKm(centerLat, centerLng, s.lat, s.lon);
                return {
                    ...s,
                    dist: d
                };
            }).sort((a, b) => a.dist - b.dist);

            const toFetch = scored.slice(0, MAX_DETAIL_STATIONS);
            const urls = toFetch.map(s => `https://api.waqi.info/feed/@${s.uid}/?token=${WAQI_TOKEN}`);

            const rawResults = await batchFetch(urls, 6);
            const details = [];
            for (const r of rawResults) {
                if (!r) continue;
                if (r.status === 'ok' && r.data) details.push(r.data);
                else if (r && r.data) details.push(r.data);
            }

            if (details.length === 0) {
                resetSummary();
                return;
            }

            const sum = {
                aqi: 0,
                pm25: 0,
                pm10: 0,
                o3: 0,
                no2: 0,
                so2: 0,
                co: 0,
                p: 0
            };
            const cnt = {
                aqi: 0,
                pm25: 0,
                pm10: 0,
                o3: 0,
                no2: 0,
                so2: 0,
                co: 0,
                p: 0
            };

            details.forEach(d => {
                const aqi = (d.aqi !== undefined && !isNaN(Number(d.aqi))) ? Number(d.aqi) : null;
                if (aqi !== null) {
                    sum.aqi += aqi;
                    cnt.aqi++;
                }
                if (d.iaqi) {
                    if (d.iaqi.pm25 && !isNaN(Number(d.iaqi.pm25.v))) {
                        sum.pm25 += Number(d.iaqi.pm25.v);
                        cnt.pm25++;
                    }
                    if (d.iaqi.pm10 && !isNaN(Number(d.iaqi.pm10.v))) {
                        sum.pm10 += Number(d.iaqi.pm10.v);
                        cnt.pm10++;
                    }
                    if (d.iaqi.o3 && !isNaN(Number(d.iaqi.o3.v))) {
                        sum.o3 += Number(d.iaqi.o3.v);
                        cnt.o3++;
                    }
                    if (d.iaqi.no2 && !isNaN(Number(d.iaqi.no2.v))) {
                        sum.no2 += Number(d.iaqi.no2.v);
                        cnt.no2++;
                    }
                }
            });

            const avg = {
                aqi: cnt.aqi ? sum.aqi / cnt.aqi : null,
                pm25: cnt.pm25 ? sum.pm25 / cnt.pm25 : null,
                pm10: cnt.pm10 ? sum.pm10 / cnt.pm10 : null,
                o3: cnt.o3 ? sum.o3 / cnt.o3 : null,
                no2: cnt.no2 ? sum.no2 / cnt.no2 : null,
                count: details.length
            };

            updateSummaryUI(avg);
        }

        function updateSummaryUI(avg) {
            const cat = aqiCategory(avg.aqi);
            document.getElementById('avgAQI').innerText = (avg.aqi === null) ? '—' : Math.round(avg.aqi);
            document.getElementById('avgCategory').innerText = cat.cat;
            document.getElementById('areaLabel').innerText = `Area: Visible Map`;
            document.getElementById('areaInfo').innerText = `Stations: ${avg.count}`;
            document.getElementById('avg_pm25').innerText = toFixedOrDash(avg.pm25, 1);
            document.getElementById('avg_pm10').innerText = toFixedOrDash(avg.pm10, 1);
            document.getElementById('avg_o3').innerText = toFixedOrDash(avg.o3, 1);
            document.getElementById('avg_no2').innerText = toFixedOrDash(avg.no2, 1);
        }

        function resetSummary() {
            document.getElementById('avgAQI').innerText = '—';
            document.getElementById('avgCategory').innerText = '—';
            document.getElementById('areaLabel').innerText = 'Area: —';
            document.getElementById('areaInfo').innerText = `Stations: 0`;
            ['pm25', 'pm10', 'o3', 'no2'].forEach(k => {
                const el = document.getElementById('avg_' + k);
                if (el) el.innerText = '—';
            });
        }

        async function refreshStationsAndSummary(boundsStr) {
            const stations = await fetchStations(boundsStr);
            lastStations = stations;
            renderStationMarkers(stations);

            const b = map.getBounds();
            const center = b.getCenter();
            await computeAndShowSummaryForStations(center.lat, center.lng, stations);
        }

        async function batchFetch(urls, batchSize = 6) {
            const results = [];
            for (let i = 0; i < urls.length; i += batchSize) {
                const batch = urls.slice(i, i + batchSize).map(u => fetch(u).then(r => r.json()).catch(e => ({
                    error: e
                })));
                const res = await Promise.all(batch);
                results.push(...res);
            }
            return results;
        }

        // Forecast Functions
        function displayForecastCalendar(forecastData) {
            const calendar = document.getElementById('forecastCalendar');
            calendar.innerHTML = '';

            if (!forecastData.daily || !forecastData.daily.pm25) {
                calendar.innerHTML = '<div class="loading">No forecast data available</div>';
                return;
            }

            const pm25Forecast = forecastData.daily.pm25;
            const today = new Date();

            for (let i = 0; i < 7; i++) {
                const forecastDate = new Date(today);
                forecastDate.setDate(today.getDate() + i);

                const dayData = pm25Forecast[i] || {
                    avg: null,
                    min: null,
                    max: null
                };
                const dayElement = createCalendarDay(forecastDate, dayData, i === 0);
                calendar.appendChild(dayElement);
            }
        }

        function createCalendarDay(date, dayData, isToday = false) {
            const dayElement = document.createElement('div');
            dayElement.className = `calendar-day ${isToday ? 'active' : ''}`;

            const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            const dayName = dayNames[date.getDay()];
            const dayNumber = date.getDate();
            const month = date.toLocaleDateString('en-US', {
                month: 'short'
            });

            const avgPm25 = dayData.avg;
            const aqi = avgPm25 ? pm25ToAQI(avgPm25) : null;
            const category = aqiCategory(aqi);

            dayElement.innerHTML = `
                <div class="day-date">${month} ${dayNumber}</div>
                <div class="day-number">${dayName}</div>
                ${aqi ? `
                        <div class="day-aqi" style="color: ${category.color}">
                            ${aqi}
                        </div>
                        <div class="day-pm25">PM2.5: ${toFixedOrDash(avgPm25, 1)} μg/m³</div>
                        <div class="day-category" style="background: ${category.color}; color: ${getContrastYIQ(category.color) === 'dark' ? '#000' : '#fff'}">
                            ${category.cat.split(' ')[0]}
                        </div>
                    ` : `
                        <div class="day-aqi">—</div>
                        <div class="day-pm25">No data</div>
                        <div class="day-category" style="background: #999; color: #fff">
                            Unknown
                        </div>
                    `}
            `;

            return dayElement;
        }

        function getContrastYIQ(hexcolor) {
            if (!hexcolor) return 'light';
            hexcolor = hexcolor.replace('#', '').trim();
            if (hexcolor.length === 3) hexcolor = hexcolor.split('').map(c => c + c).join('');
            const r = parseInt(hexcolor.substr(0, 2), 16),
                g = parseInt(hexcolor.substr(2, 2), 16),
                b = parseInt(hexcolor.substr(4, 2), 16);
            const yiq = ((r * 299) + (g * 587) + (b * 114)) / 1000;
            return (yiq >= 128) ? 'dark' : 'light';
        }

        async function fetchForecast(lat, lng) {
            const url = `https://api.waqi.info/feed/geo:${lat};${lng}/?token=${WAQI_TOKEN}`;
            const response = await fetch(url);
            const data = await response.json();

            if (data.status === 'ok' && data.data && data.data.forecast) {
                return data.data.forecast;
            }
            throw new Error('No forecast data available');
        }

        // City Selection
        function populateDropdown() {
            const sel = document.getElementById('citySelect');

            // Group cities by country
            const citiesByCountry = {};
            curatedCities.forEach(city => {
                if (!citiesByCountry[city.country]) {
                    citiesByCountry[city.country] = [];
                }
                citiesByCountry[city.country].push(city);
            });

            // Add optgroups for each country
            Object.keys(citiesByCountry).forEach(country => {
                const optgroup = document.createElement('optgroup');
                optgroup.label = country;

                citiesByCountry[country].forEach(city => {
                    const opt = document.createElement('option');
                    opt.value = JSON.stringify(city);
                    opt.textContent = city.city;
                    optgroup.appendChild(opt);
                });

                sel.appendChild(optgroup);
            });

            sel.addEventListener('change', e => {
                if (!e.target.value) return;
                const obj = JSON.parse(e.target.value);
                selectCity(obj);
            });
        }

        async function selectCity(city) {
            map.setView([city.lat, city.lng], 11);

            if (!city.isNearestStation) {
                document.getElementById('citySelect').value = JSON.stringify(city);
            }

            document.getElementById('areaLabel').textContent = `Area: ${city.city}`;
            document.getElementById('detectionStatus').textContent = `Showing: ${city.city}, ${city.country}`;

            const deltas = [0.3, 0.5, 1.0];
            for (const d of deltas) {
                const bounds = `${city.lat + d},${city.lng - d},${city.lat - d},${city.lng + d}`;
                const stations = await fetchStations(bounds);
                if (stations && stations.length > 0) {
                    renderStationMarkers(stations);
                    await computeAndShowSummaryForStations(city.lat, city.lng, stations);

                    try {
                        const forecastData = await fetchForecast(city.lat, city.lng);
                        displayForecastCalendar(forecastData);
                    } catch (error) {
                        console.error('Error loading forecast:', error);
                        document.getElementById('forecastCalendar').innerHTML =
                            '<div class="loading">Unable to load forecast data</div>';
                    }

                    const pts = stations.map(s => [s.lat, s.lon]);
                    if (pts.length > 0) {
                        try {
                            map.fitBounds(pts, {
                                maxZoom: 12,
                                padding: [40, 40]
                            });
                        } catch (e) {}
                    }
                    return;
                }
            }

            document.getElementById('detectionStatus').textContent = 'No AQI stations found near selected location';
        }

        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Auto-detect location on startup
        async function autoDetectOnStartup() {
            const statusElement = document.getElementById('detectionStatus');
            statusElement.textContent = 'Auto-detecting your location...';

            const location = await detectUserLocation();

            if (location) {
                // Find nearest curated city
                const nearest = findNearestCuratedCity(location.lat, location.lng);

                if (nearest.city && nearest.distance < 300) { // Within 300km
                    statusElement.textContent =
                        `Auto-selected: ${nearest.city.city} (${Math.round(nearest.distance)}km away)`;
                    await selectCity(nearest.city);
                } else {
                    // Try to find nearest station
                    await findNearestStation();
                }
            } else {
                // Fallback to default city
                statusElement.textContent = 'Using default location: Jakarta';
                await selectCity(FALLBACK_CITY);
            }
        }

        // Initialize App
        function initApp() {
            populateDropdown();
            initMap();

            // Setup location buttons
            document.getElementById('detectLocation').addEventListener('click', detectUserLocation);
            document.getElementById('useNearestStation').addEventListener('click', findNearestStation);

            // Auto-detect on startup
            autoDetectOnStartup();
        }

        // Start the application
        document.addEventListener('DOMContentLoaded', initApp);
    </script>
@endsection
