<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Air Quality News</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3b82f6;
            --secondary-color: #1e40af;
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-color: #1e293b;
            --muted-color: #64748b;
            --border-color: #e2e8f0;
            --border-radius: 12px;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
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

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        .header {
            background: var(--card-bg);
            box-shadow: var(--shadow);
            padding: 20px 0;
            margin-bottom: 30px;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 1.5em;
            color: var(--primary-color);
            text-decoration: none;
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

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-link {
            color: var(--text-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .nav-link.active {
            color: var(--primary-color);
            font-weight: 600;
        }

        /* Main Content */
        .main-content {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 30px;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 40px 0;
            text-align: center;
        }

        .page-title {
            font-size: 2.5em;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .page-subtitle {
            font-size: 1.1em;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Controls Section */
        .controls {
            padding: 30px;
            border-bottom: 1px solid var(--border-color);
        }

        .search-section {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            align-items: center;
        }

        .search-box {
            flex: 1;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 15px 20px 15px 50px;
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius);
            font-size: 1em;
            transition: all 0.2s;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted-color);
        }

        .search-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 15px 25px;
            border-radius: var(--border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .search-btn:hover {
            background: var(--secondary-color);
        }

        .filters {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 10px 20px;
            background: var(--bg-color);
            border: 1px solid var(--border-color);
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.2s;
            font-weight: 500;
        }

        .filter-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .filter-btn:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow);
        }

        /* News Grid */
        .news-grid {
            padding: 30px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }

        .news-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .news-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3em;
        }

        .news-content {
            padding: 20px;
        }

        .news-source {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .source-name {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 0.9em;
        }

        .news-date {
            color: var(--muted-color);
            font-size: 0.85em;
        }

        .news-title {
            font-weight: 600;
            font-size: 1.2em;
            line-height: 1.4;
            margin-bottom: 10px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .news-description {
            color: var(--muted-color);
            line-height: 1.5;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .news-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85em;
        }

        .read-time {
            color: var(--muted-color);
        }

        .read-more {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* News Detail Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            overflow-y: auto;
        }

        .modal-content {
            background: var(--card-bg);
            margin: 50px auto;
            border-radius: var(--border-radius);
            max-width: 800px;
            position: relative;
            animation: modalAppear 0.3s ease;
        }

        @keyframes modalAppear {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            padding: 30px 30px 0;
        }

        .modal-close {
            position: absolute;
            right: 20px;
            top: 20px;
            background: none;
            border: none;
            font-size: 1.5em;
            cursor: pointer;
            color: var(--muted-color);
            transition: color 0.2s;
        }

        .modal-close:hover {
            color: var(--error-color);
        }

        .modal-source {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .modal-title {
            font-size: 1.8em;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 20px;
        }

        .modal-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .modal-body {
            padding: 0 30px 30px;
        }

        .modal-content-text {
            line-height: 1.7;
            font-size: 1.1em;
            margin-bottom: 25px;
        }

        .modal-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        .original-link {
            background: var(--primary-color);
            color: white;
            padding: 12px 25px;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s;
        }

        .original-link:hover {
            background: var(--secondary-color);
        }

        /* Loading States */
        .loading {
            text-align: center;
            padding: 60px;
            color: var(--muted-color);
        }

        .loading-spinner {
            font-size: 2em;
            margin-bottom: 15px;
        }

        .error-message {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 20px;
            border-radius: var(--border-radius);
            text-align: center;
            margin: 20px;
        }

        .empty-state {
            text-align: center;
            padding: 60px;
            color: var(--muted-color);
        }

        .empty-state i {
            font-size: 3em;
            margin-bottom: 15px;
            color: var(--border-color);
        }

        /* Footer */
        .footer {
            background: var(--card-bg);
            padding: 30px 0;
            text-align: center;
            color: var(--muted-color);
            margin-top: 50px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .news-grid {
                grid-template-columns: 1fr;
                padding: 20px;
            }

            .search-section {
                flex-direction: column;
            }

            .search-btn {
                width: 100%;
            }

            .nav {
                flex-direction: column;
                gap: 15px;
            }

            .nav-links {
                gap: 20px;
            }

            .modal-content {
                margin: 20px;
            }

            .modal-title {
                font-size: 1.4em;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 15px;
            }

            .page-title {
                font-size: 2em;
            }

            .controls {
                padding: 20px;
            }

            .filters {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <nav class="nav">
                <a href="air-quality-dashboard.html" class="logo">
                    <div class="logo-icon">AQ</div>
                    AirQuality
                </a>
                <div class="nav-links">
                    <a href="air-quality-dashboard.html" class="nav-link">Air Quality</a>
                    <a href="air-quality-news.html" class="nav-link active">News</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <div class="main-content">
            <!-- Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title">Air Quality News</h1>
                    <p class="page-subtitle">Latest updates on air pollution, environmental research, and climate change impacts on air quality worldwide</p>
                </div>
            </div>

            <!-- Controls -->
            <div class="controls">
                <div class="search-section">
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="searchInput" placeholder="Search for air quality news, pollution, PM2.5, climate...">
                    </div>
                    <button class="search-btn" id="searchBtn">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
                <div class="filters">
                    <button class="filter-btn active" data-filter="all">All News</button>
                    <button class="filter-btn" data-filter="pollution">Pollution</button>
                    <button class="filter-btn" data-filter="health">Health Impacts</button>
                    <button class="filter-btn" data-filter="climate">Climate Change</button>
                    <button class="filter-btn" data-filter="research">Research</button>
                    <button class="filter-btn" data-filter="technology">Technology</button>
                </div>
            </div>

            <!-- News Grid -->
            <div class="news-grid" id="newsGrid">
                <div class="loading">
                    <div class="loading-spinner">
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                    <p>Loading latest air quality news...</p>
                </div>
            </div>
        </div>
    </main>

    <!-- News Detail Modal -->
    <div class="modal" id="newsModal">
        <div class="modal-content">
            <div class="modal-header">
                <button class="modal-close" id="modalClose">
                    <i class="fas fa-times"></i>
                </button>
                <div class="modal-source">
                    <span class="source-name" id="modalSource">Loading source...</span>
                    <span class="news-date" id="modalDate">Loading date...</span>
                </div>
                <h1 class="modal-title" id="modalTitle">Loading title...</h1>
            </div>
            <div class="modal-body">
                <div class="modal-image" id="modalImage">
                    <div style="background: linear-gradient(135deg, #667eea, #764ba2); height: 300px; display: flex; align-items: center; justify-content: center; color: white; font-size: 3em;">
                        <i class="fas fa-newspaper"></i>
                    </div>
                </div>
                <div class="modal-content-text" id="modalContent">
                    Loading content...
                </div>
                <div class="modal-footer">
                    <div class="read-time" id="modalReadTime">Estimated reading time: 2 min</div>
                    <a href="#" class="original-link" id="modalLink" target="_blank">
                        <i class="fas fa-external-link-alt"></i>
                        Read Full Article
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 AirQuality Dashboard. Providing real-time air quality information and environmental news.</p>
        </div>
    </footer>

    <script>
        // Configuration
        const NEWS_API_KEY = "d9bf79de7e7e462e9538f320a6a3ff67"; // Your token
        const NEWS_API_URL = "https://newsapi.org/v2/everything";

        // Global variables
        let currentNews = [];
        let currentFilter = 'all';
        let currentSearch = '';

        // DOM Elements
        const newsGrid = document.getElementById('newsGrid');
        const searchInput = document.getElementById('searchInput');
        const searchBtn = document.getElementById('searchBtn');
        const newsModal = document.getElementById('newsModal');
        const modalClose = document.getElementById('modalClose');

        // Initialize the application
        document.addEventListener('DOMContentLoaded', function() {
            loadNews();
            setupEventListeners();
        });

        function setupEventListeners() {
            // Search functionality
            searchBtn.addEventListener('click', performSearch);
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });

            // Filter buttons
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    currentFilter = this.dataset.filter;
                    filterNews();
                });
            });

            // Modal close
            modalClose.addEventListener('click', closeModal);
            newsModal.addEventListener('click', function(e) {
                if (e.target === newsModal) {
                    closeModal();
                }
            });

            // Close modal with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeModal();
                }
            });
        }

        async function loadNews(searchQuery = 'air quality pollution PM2.5 AQI climate change environment') {
            showLoading();
            
            try {
                const url = `${NEWS_API_URL}?q=${encodeURIComponent(searchQuery)}&language=en&sortBy=publishedAt&pageSize=20&apiKey=${NEWS_API_KEY}`;
                
                const response = await fetch(url);
                const data = await response.json();

                if (data.status === 'ok' && data.articles.length > 0) {
                    currentNews = data.articles;
                    displayNews(currentNews);
                } else {
                    throw new Error(data.message || 'No articles found');
                }
            } catch (error) {
                console.error('Error loading news:', error);
                showError('Failed to load news. Please try again later.');
            }
        }

        function displayNews(news) {
            if (!news || news.length === 0) {
                showEmptyState();
                return;
            }

            newsGrid.innerHTML = news.map(article => `
                <div class="news-card" onclick="openNewsDetail('${article.url}')">
                    <div class="news-image">
                        ${article.urlToImage ? 
                            `<img src="${article.urlToImage}" alt="${article.title}" style="width: 100%; height: 100%; object-fit: cover;">` :
                            `<i class="fas fa-newspaper"></i>`
                        }
                    </div>
                    <div class="news-content">
                        <div class="news-source">
                            <span class="source-name">${article.source?.name || 'Unknown Source'}</span>
                            <span class="news-date">${formatDate(article.publishedAt)}</span>
                        </div>
                        <h3 class="news-title">${article.title || 'No title available'}</h3>
                        <p class="news-description">${article.description || 'No description available'}</p>
                        <div class="news-meta">
                            <span class="read-time">${estimateReadTime(article.content)} min read</span>
                            <span class="read-more">
                                Read more <i class="fas fa-arrow-right"></i>
                            </span>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function filterNews() {
            if (currentFilter === 'all') {
                displayNews(currentNews);
                return;
            }

            const filteredNews = currentNews.filter(article => {
                const title = article.title?.toLowerCase() || '';
                const description = article.description?.toLowerCase() || '';
                const content = article.content?.toLowerCase() || '';
                
                const text = title + ' ' + description + ' ' + content;
                
                switch(currentFilter) {
                    case 'pollution':
                        return text.includes('pollution') || text.includes('pollutant') || text.includes('emission') || text.includes('smog');
                    case 'health':
                        return text.includes('health') || text.includes('medical') || text.includes('disease') || text.includes('lung') || text.includes('respiratory');
                    case 'climate':
                        return text.includes('climate') || text.includes('global warming') || text.includes('environment') || text.includes('carbon');
                    case 'research':
                        return text.includes('research') || text.includes('study') || text.includes('scientist') || text.includes('university');
                    case 'technology':
                        return text.includes('technology') || text.includes('innovation') || text.includes('sensor') || text.includes('monitoring');
                    default:
                        return true;
                }
            });

            if (filteredNews.length === 0) {
                showEmptyState('No news found for this filter.');
            } else {
                displayNews(filteredNews);
            }
        }

        function performSearch() {
            const query = searchInput.value.trim();
            if (query) {
                currentSearch = query;
                loadNews(query);
            } else {
                currentSearch = '';
                loadNews();
            }
        }

        function openNewsDetail(articleUrl) {
            const article = currentNews.find(a => a.url === articleUrl);
            if (!article) return;

            // Update modal content
            document.getElementById('modalSource').textContent = article.source?.name || 'Unknown Source';
            document.getElementById('modalDate').textContent = formatDate(article.publishedAt);
            document.getElementById('modalTitle').textContent = article.title || 'No title available';
            
            // Handle image
            const modalImage = document.getElementById('modalImage');
            if (article.urlToImage) {
                modalImage.innerHTML = `<img src="${article.urlToImage}" alt="${article.title}" style="width: 100%; max-height: 400px; object-fit: cover;">`;
            } else {
                modalImage.innerHTML = `
                    <div style="background: linear-gradient(135deg, #667eea, #764ba2); height: 300px; display: flex; align-items: center; justify-content: center; color: white; font-size: 3em;">
                        <i class="fas fa-newspaper"></i>
                    </div>
                `;
            }

            // Handle content
            const content = article.content || article.description || 'No content available.';
            document.getElementById('modalContent').innerHTML = `
                <p>${content}</p>
                ${article.content ? `<p><em>Click "Read Full Article" to continue reading on the original website.</em></p>` : ''}
            `;

            document.getElementById('modalReadTime').textContent = `Estimated reading time: ${estimateReadTime(article.content)} min`;
            document.getElementById('modalLink').href = article.url;

            // Show modal
            newsModal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            newsModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Utility functions
        function formatDate(dateString) {
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
                return date.toLocaleDateString('en-US', { 
                    year: 'numeric', 
                    month: 'short', 
                    day: 'numeric' 
                });
            }
        }

        function estimateReadTime(content) {
            if (!content) return 2;
            const wordsPerMinute = 200;
            const words = content.split(/\s+/).length;
            const minutes = Math.ceil(words / wordsPerMinute);
            return Math.max(1, minutes);
        }

        function showLoading() {
            newsGrid.innerHTML = `
                <div class="loading">
                    <div class="loading-spinner">
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                    <p>Loading latest air quality news...</p>
                </div>
            `;
        }

        function showError(message) {
            newsGrid.innerHTML = `
                <div class="error-message">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h3>Error Loading News</h3>
                    <p>${message}</p>
                    <button onclick="loadNews()" style="margin-top: 10px; padding: 10px 20px; background: var(--primary-color); color: white; border: none; border-radius: 5px; cursor: pointer;">
                        Try Again
                    </button>
                </div>
            `;
        }

        function showEmptyState(message = 'No news articles found.') {
            newsGrid.innerHTML = `
                <div class="empty-state">
                    <i class="fas fa-newspaper"></i>
                    <h3>${message}</h3>
                    <p>Try changing your search terms or filters.</p>
                </div>
            `;
        }
    </script>
</body>
</html>