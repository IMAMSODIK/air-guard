<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Air Quality Dashboard with News</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            --primary-color: #3b82f6;
            --success-color: #10b981;
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
            color: var(--primary-color);
        }

        .logo-icon {
            width: 32px;
            height: 32px;
            background: var(--primary-color);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .nav-tabs {
            display: flex;
            background: var(--bg-color);
            border-radius: 8px;
            padding: 4px;
            margin-bottom: 24px;
        }

        .nav-tab {
            flex: 1;
            padding: 10px 16px;
            text-align: center;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
            font-weight: 500;
            font-size: 0.9em;
        }

        .nav-tab.active {
            background: var(--primary-color);
            color: white;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Control Sections */
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
            border-color: var(--primary-color);
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
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
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

        /* News Tab Styles */
        .news-filters {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .news-filter {
            padding: 6px 12px;
            background: var(--bg-color);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            font-size: 0.8em;
            cursor: pointer;
            transition: all 0.2s;
        }

        .news-filter.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .news-search {
            position: relative;
            margin-bottom: 16px;
        }

        .news-search input {
            width: 100%;
            padding: 10px 16px 10px 40px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.9em;
        }

        .news-search i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted-color);
        }

        .news-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .news-item {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 12px;
            transition: all 0.2s;
            cursor: pointer;
        }

        .news-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .news-item:last-child {
            margin-bottom: 0;
        }

        .news-source {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 8px;
            font-size: 0.8em;
        }

        .news-source-name {
            font-weight: 600;
            color: var(--primary-color);
        }

        .news-date {
            color: var(--muted-color);
        }

        .news-title {
            font-weight: 600;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .news-description {
            font-size: 0.9em;
            color: var(--muted-color);
            line-height: 1.5;
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .news-read-more {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.85em;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .news-read-more:hover {
            text-decoration: underline;
        }

        .news-loading {
            text-align: center;
            padding: 40px;
            color: var(--muted-color);
        }

        .news-error {
            text-align: center;
            padding: 20px;
            color: #ef4444;
            background: #fef2f2;
            border-radius: 8px;
            margin-bottom: 16px;
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
            border-color: var(--primary-color);
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

        /* Detection Status */
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
            
            .news-filters {
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
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <div class="logo-icon">AQ</div>
                AirQuality
            </div>

            <div class="nav-tabs">
                <div class="nav-tab active" data-tab="air-quality">Air Quality</div>
                <div class="nav-tab" data-tab="news">News</div>
            </div>

            <!-- Air Quality Tab -->
            <div class="tab-content active" id="air-quality-tab">
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
                            <div class="legend-color" style="background: var(--aqi-moderate)"></div>
                            <span>Moderate</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background: var(--aqi-usg)"></div>
                            <span>USG</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background: var(--aqi-unhealthy)"></div>
                            <span>Unhealthy</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background: var(--aqi-very)"></div>
                            <span>Very Unhealthy</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- News Tab -->
            <div class="tab-content" id="news-tab">
                <div class="control-section">
                    <div class="section-title">Air Quality News</div>
                    
                    <div class="news-search">
                        <i class="fas fa-search"></i>
                        <input type="text" id="newsSearch" placeholder="Search air quality news...">
                    </div>

                    <div class="news-filters">
                        <div class="news-filter active" data-filter="all">All</div>
                        <div class="news-filter" data-filter="pollution">Pollution</div>
                        <div class="news-filter" data-filter="health">Health</div>
                        <div class="news-filter" data-filter="climate">Climate</div>
                        <div class="news-filter" data-filter="research">Research</div>
                    </div>

                    <div class="news-list" id="newsList">
                        <div class="news-loading">
                            <i class="fas fa-spinner fa-spin"></i><br>
                            Loading latest air quality news...
                        </div>
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

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Configuration
        const WAQI_TOKEN = "43560c647d82b9daf429da457f7b39cbda4c3e41";
        const NEWS_API_KEY = "YOUR_NEWS_API_KEY"; // Dapatkan dari https://newsapi.org
        const FALLBACK_CITY = {
            city: "Jakarta",
            country: "Indonesia",
            lat: -6.21462,
            lng: 106.84513
        };

        // Global variables
        let map, stationMarkers = {}, lastStations = [];
        let userLocation = null;
        let currentNews = [];

        // Tab Navigation
        function setupTabNavigation() {
            const tabs = document.querySelectorAll('.nav-tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('active'));
                    // Add active class to clicked tab
                    tab.classList.add('active');
                    
                    // Hide all tab contents
                    document.querySelectorAll('.tab-content').forEach(content => {
                        content.classList.remove('active');
                    });
                    
                    // Show selected tab content
                    const tabId = tab.getAttribute('data-tab') + '-tab';
                    document.getElementById(tabId).classList.add('active');

                    // Load news if news tab is selected
                    if (tab.getAttribute('data-tab') === 'news' && currentNews.length === 0) {
                        loadAirQualityNews();
                    }
                });
            });
        }

        // News Functions
        async function loadAirQualityNews(searchQuery = '', filter = 'all') {
            const newsList = document.getElementById('newsList');
            newsList.innerHTML = '<div class="news-loading"><i class="fas fa-spinner fa-spin"></i><br>Loading latest air quality news...</div>';

            try {
                // Fallback data jika NewsAPI tidak tersedia
                const fallbackNews = getFallbackNews();
                
                // Jika ada API key, gunakan NewsAPI
                if (NEWS_API_KEY && NEWS_API_KEY !== 'YOUR_NEWS_API_KEY') {
                    const query = searchQuery || 'air quality pollution PM2.5 AQI';
                    const url = `https://newsapi.org/v2/everything?q=${encodeURIComponent(query)}&language=en&sortBy=publishedAt&apiKey=${NEWS_API_KEY}`;
                    
                    const response = await fetch(url);
                    const data = await response.json();
                    
                    if (data.status === 'ok' && data.articles.length > 0) {
                        currentNews = data.articles;
                        displayNews(currentNews, filter);
                    } else {
                        throw new Error('No news articles found');
                    }
                } else {
                    // Gunakan fallback data
                    currentNews = fallbackNews;
                    displayNews(currentNews, filter);
                    newsList.innerHTML += '<div class="news-error">Using demo data. Get API key from newsapi.org for real news.</div>';
                }
            } catch (error) {
                console.error('Error loading news:', error);
                // Gunakan fallback data jika error
                currentNews = getFallbackNews();
                displayNews(currentNews, filter);
                newsList.innerHTML = '<div class="news-error">Failed to load news. Showing demo data.</div>' + newsList.innerHTML;
            }
        }

        function displayNews(news, filter = 'all') {
            const newsList = document.getElementById('newsList');
            
            if (!news || news.length === 0) {
                newsList.innerHTML = '<div class="news-error">No news articles found about air quality.</div>';
                return;
            }

            let filteredNews = news;
            
            // Apply filter jika bukan "all"
            if (filter !== 'all') {
                filteredNews = news.filter(article => {
                    const title = article.title?.toLowerCase() || '';
                    const description = article.description?.toLowerCase() || '';
                    const content = article.content?.toLowerCase() || '';
                    
                    const text = title + ' ' + description + ' ' + content;
                    
                    switch(filter) {
                        case 'pollution':
                            return text.includes('pollution') || text.includes('pollutant') || text.includes('emission');
                        case 'health':
                            return text.includes('health') || text.includes('medical') || text.includes('disease');
                        case 'climate':
                            return text.includes('climate') || text.includes('global warming') || text.includes('environment');
                        case 'research':
                            return text.includes('research') || text.includes('study') || text.includes('scientist');
                        default:
                            return true;
                    }
                });
            }

            if (filteredNews.length === 0) {
                newsList.innerHTML = '<div class="news-error">No news found for this filter.</div>';
                return;
            }

            newsList.innerHTML = filteredNews.map(article => `
                <div class="news-item" onclick="window.open('${article.url}', '_blank')">
                    <div class="news-source">
                        <span class="news-source-name">${article.source?.name || 'Unknown Source'}</span>
                        <span class="news-date">${formatNewsDate(article.publishedAt)}</span>
                    </div>
                    <div class="news-title">${article.title || 'No title available'}</div>
                    <div class="news-description">${article.description || 'No description available'}</div>
                    <a href="${article.url}" class="news-read-more" target="_blank" onclick="event.stopPropagation()">
                        Read more <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            `).join('');
        }

        function formatNewsDate(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const diffTime = Math.abs(now - date);
            const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
            
            if (diffDays === 0) {
                return 'Today';
            } else if (diffDays === 1) {
                return 'Yesterday';
            } else if (diffDays < 7) {
                return `${diffDays} days ago`;
            } else {
                return date.toLocaleDateString();
            }
        }

        function getFallbackNews() {
            return [
                {
                    title: "New Study Shows Improved Air Quality in Major Cities During Pandemic",
                    description: "Recent research indicates significant improvements in air quality metrics across urban centers due to reduced industrial activity.",
                    url: "#",
                    source: { name: "Environmental Research" },
                    publishedAt: new Date(Date.now() - 2 * 24 * 60 * 60 * 1000).toISOString(),
                    content: "A comprehensive study analyzing air quality data from 50 major cities worldwide shows notable improvements in PM2.5 and NO2 levels."
                },
                {
                    title: "WHO Updates Air Quality Guidelines for Better Public Health Protection",
                    description: "The World Health Organization has released updated global air quality guidelines, setting stricter limits for major pollutants.",
                    url: "#",
                    source: { name: "World Health Organization" },
                    publishedAt: new Date(Date.now() - 5 * 24 * 60 * 60 * 1000).toISOString(),
                    content: "New guidelines aim to protect populations from the adverse health effects of air pollution, with revised limits for PM2.5, PM10, and ozone."
                },
                {
                    title: "Innovative Technology Monitors Real-Time Air Quality in Urban Areas",
                    description: "New sensor networks and AI algorithms are revolutionizing how cities monitor and respond to air pollution events.",
                    url: "#",
                    source: { name: "Tech Innovation Daily" },
                    publishedAt: new Date(Date.now() - 1 * 24 * 60 * 60 * 1000).toISOString(),
                    content: "Advanced monitoring systems provide real-time data to help urban planners and residents make informed decisions about outdoor activities."
                },
                {
                    title: "Climate Change Impact on Air Quality Becomes Increasingly Evident",
                    description: "Scientists warn that climate change is exacerbating air pollution problems, particularly in vulnerable regions.",
                    url: "#",
                    source: { name: "Climate Science Journal" },
                    publishedAt: new Date(Date.now() - 3 * 24 * 60 * 60 * 1000).toISOString(),
                    content: "Research shows interconnected relationships between climate patterns, wildfire frequency, and deteriorating air quality metrics."
                },
                {
                    title: "Community-Led Initiatives Successfully Reduce Local Air Pollution",
                    description: "Grassroots movements and local government partnerships show promising results in improving neighborhood air quality.",
                    url: "#",
                    source: { name: "Community Action Network" },
                    publishedAt: new Date(Date.now() - 4 * 24 * 60 * 60 * 1000).toISOString(),
                    content: "Successful case studies demonstrate how community engagement and policy changes can lead to measurable air quality improvements."
                }
            ];
        }

        function setupNewsFilters() {
            const filters = document.querySelectorAll('.news-filter');
            filters.forEach(filter => {
                filter.addEventListener('click', () => {
                    filters.forEach(f => f.classList.remove('active'));
                    filter.classList.add('active');
                    
                    const filterType = filter.getAttribute('data-filter');
                    displayNews(currentNews, filterType);
                });
            });

            // Search functionality
            const searchInput = document.getElementById('newsSearch');
            let searchTimeout;
            searchInput.addEventListener('input', (e) => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    const query = e.target.value.trim();
                    if (query) {
                        loadAirQualityNews(query);
                    } else {
                        loadAirQualityNews();
                    }
                }, 500);
            });
        }

        // ... (rest of the existing JavaScript code for map, location detection, etc.)
        // Note: You'll need to include all the existing JavaScript functions from the previous implementation

        // Initialize App
        function initApp() {
            setupTabNavigation();
            setupNewsFilters();
            // ... existing initialization code
        }

        // Start the application
        document.addEventListener('DOMContentLoaded', initApp);
    </script>
</body>
</html>