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
        box-shadow: 0 4px 14px rgba(0,0,0,0.08);
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .news-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
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

            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4><i class="fa-solid fa-newspaper me-2"></i>News</h4>
                    <small class="text-muted">Air quality and pollution updates</small>
                </div>

                <div class="card-body">
                    <div class="news-wrapper">

    @forelse ($articles as $article)
        <div class="news-card">
            
            {{-- IMAGE --}}
            @if (!empty($article['image']))
                <img src="{{ $article['image'] }}" class="news-image" alt="news-image">
            @else
                <img src="https://via.placeholder.com/600x300?text=No+Image"
                     class="news-image" alt="no-image">
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
                <a href="{{ $article['url'] }}" 
                   target="_blank" 
                   class="btn btn-primary read-more-btn">
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
@endsection
