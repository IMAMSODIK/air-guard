@extends('template')

@section('own_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #1e40af;
            --secondary: #64748b;
            --success: #10b981;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --border: #e2e8f0;
            --radius: 12px;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .news-page {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }

        .news-container {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 3rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            position: relative;
        }

        .page-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
            position: relative;
        }

        .stats-bar {
            background: var(--light-bg);
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--border);
        }

        .stat-item {
            text-align: center;
            padding: 0 1rem;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            display: block;
        }

        .stat-label {
            font-size: 0.85rem;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .news-grid {
            padding: 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
            gap: 2rem;
        }

        .news-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .news-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
            border-color: var(--primary);
        }

        .news-image-container {
            width: 100%;
            height: 220px;
            overflow: hidden;
            position: relative;
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .news-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .news-card:hover .news-image {
            transform: scale(1.08);
        }

        .news-image-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        }

        .source-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: rgba(255, 255, 255, 0.95);
            color: var(--primary);
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            backdrop-filter: blur(10px);
        }

        .news-content {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .news-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 0.8rem;
        }

        .news-date {
            color: var(--text-light);
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .news-category {
            background: var(--light-bg);
            color: var(--primary);
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .news-title {
            font-weight: 700;
            font-size: 1.25rem;
            line-height: 1.4;
            margin-bottom: 1rem;
            color: var(--text-dark);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .news-description {
            color: var(--text-light);
            line-height: 1.6;
            margin-bottom: 1.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex-grow: 1;
        }

        .news-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .read-time {
            color: var(--text-light);
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .read-more-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            font-size: 0.9rem;
        }

        .read-more-btn:hover {
            background: var(--primary-dark);
            color: white;
            transform: translateX(4px);
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-light);
            grid-column: 1 / -1;
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: var(--border);
            opacity: 0.5;
        }

        .loading-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-light);
            grid-column: 1 / -1;
        }

        .loading-spinner {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        @media (max-width: 768px) {
            .news-grid {
                grid-template-columns: 1fr;
                padding: 1.5rem;
                gap: 1.5rem;
            }

            .page-title {
                font-size: 2rem;
            }

            .page-header {
                padding: 2rem 0;
            }

            .stats-bar {
                padding: 1rem;
            }

            .stat-item {
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 480px) {
            .news-page {
                padding: 1rem 0;
            }

            .news-grid {
                padding: 1rem;
            }

            .page-header {
                padding: 1.5rem 0;
            }
        }

        /* Animation for cards */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .news-card {
            animation: fadeInUp 0.6s ease-out;
        }

        .news-card:nth-child(2) { animation-delay: 0.1s; }
        .news-card:nth-child(3) { animation-delay: 0.2s; }
        .news-card:nth-child(4) { animation-delay: 0.3s; }
        .news-card:nth-child(5) { animation-delay: 0.4s; }
    </style>
@endsection

@section('content')
    <div class="news-page">
        <div class="container">
            <!-- Header -->
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <a href="/" class="d-inline-block mb-4">
                        <img src="{{ asset('dashboard_assets/assets/images/logo/logo_dark.png') }}" alt="Logo" 
                             class="img-fluid" style="max-width: 100px; filter: brightness(0) invert(1);">
                    </a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row justify-content-center">
                <div class="col-12 col-xxl-10">
                    <div class="news-container">
                        <!-- Page Header -->
                        <div class="page-header">
                            <div class="container">
                                <h1 class="page-title">
                                    <i class="fas fa-newspaper me-3"></i>Air Quality News
                                </h1>
                                <p class="page-subtitle">
                                    Stay informed with the latest updates on air pollution, environmental research, and climate change impacts
                                </p>
                            </div>
                        </div>

                        <!-- Stats Bar -->
                        <div class="stats-bar">
                            <div class="row text-center">
                                <div class="col-md-3 col-6 stat-item">
                                    <span class="stat-number">{{ count($articles) }}</span>
                                    <span class="stat-label">Total Articles</span>
                                </div>
                                <div class="col-md-3 col-6 stat-item">
                                    <span class="stat-number">{{ $articles->where('publishedAt', '>=', now()->subDays(1))->count() }}</span>
                                    <span class="stat-label">Last 24 Hours</span>
                                </div>
                                <div class="col-md-3 col-6 stat-item">
                                    <span class="stat-number">{{ $articles->unique('source.name')->count() }}</span>
                                    <span class="stat-label">News Sources</span>
                                </div>
                                <div class="col-md-3 col-6 stat-item">
                                    <span class="stat-number">7</span>
                                    <span class="stat-label">Days Coverage</span>
                                </div>
                            </div>
                        </div>

                        <!-- News Grid -->
                        <div class="news-grid" id="newsGrid">
                            @if(count($articles) > 0)
                                @foreach($articles as $index => $article)
                                    <div class="news-card" onclick="window.open('{{ $article['url'] }}', '_blank')">
                                        <div class="news-image-container">
                                            @if(!empty($article['image']))
                                                <img src="{{ $article['image'] }}" class="news-image" alt="{{ $article['title'] }}">
                                            @else
                                                <div class="news-image-placeholder">
                                                    <i class="fas fa-newspaper"></i>
                                                </div>
                                            @endif
                                            <div class="source-badge">
                                                {{ $article['source']['name'] ?? 'News' }}
                                            </div>
                                        </div>
                                        
                                        <div class="news-content">
                                            <div class="news-meta">
                                                <span class="news-date">
                                                    <i class="far fa-clock"></i>
                                                    {{ \Carbon\Carbon::parse($article['publishedAt'])->diffForHumans() }}
                                                </span>
                                                <span class="news-category">
                                                    {{ $article['source']['name'] ?? 'General' }}
                                                </span>
                                            </div>
                                            
                                            <h3 class="news-title">{{ $article['title'] }}</h3>
                                            <p class="news-description">{{ $article['description'] ?? 'No description available' }}</p>
                                            
                                            <div class="news-actions">
                                                <span class="read-time">
                                                    <i class="far fa-eye"></i>
                                                    {{ estimateReadTime($article['content'] ?? $article['description'] ?? '') }} min read
                                                </span>
                                                <a href="{{ $article['url'] }}" class="read-more-btn" target="_blank" onclick="event.stopPropagation()">
                                                    Read More
                                                    <i class="fas fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-newspaper"></i>
                                    </div>
                                    <h3>No News Articles Found</h3>
                                    <p class="mb-4">There are currently no air quality news articles available.</p>
                                    <button class="btn btn-primary" onclick="window.location.reload()">
                                        <i class="fas fa-refresh me-2"></i>
                                        Refresh Page
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@php
    // Helper function for reading time estimation
    if (!function_exists('estimateReadTime')) {
        function estimateReadTime($content) {
            if (empty($content)) return 2;
            $words = str_word_count(strip_tags($content));
            $minutes = ceil($words / 200);
            return max(1, $minutes);
        }
    }
@endphp