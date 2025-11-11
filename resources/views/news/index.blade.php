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

    <div class="modal fade bd-example-modal-xl" tabindex="-1" id="detail-news" aria-labelledby="myLargeModalLabel" aria-modal="true"
        role="dialog" style="display: block;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Extra large modal</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body dark-modal">
                    <div class="large-modal-header mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right">
                            <polyline points="13 17 18 12 13 7"></polyline>
                            <polyline points="6 17 11 12 6 7"></polyline>
                        </svg>
                        <h6>Web design </h6>
                    </div>
                    <p class="modal-padding-space">We build specialised websites for companies, list them on digital
                        directories, and set up a sales funnel to boost ROI.</p>
                    <div class="large-modal-header mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right">
                            <polyline points="13 17 18 12 13 7"></polyline>
                            <polyline points="6 17 11 12 6 7"></polyline>
                        </svg>
                        <h6>Content marketing </h6>
                    </div>
                    <p class="modal-padding-space">Through better opportunities and knowledgeable marketing strategies, we
                        aid business funnel. We won't only hit the target; instead, we'll aim higher and surpass the
                        objectives.</p>
                    <div class="large-modal-header mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right">
                            <polyline points="13 17 18 12 13 7"></polyline>
                            <polyline points="6 17 11 12 6 7"></polyline>
                        </svg>
                        <h6>PPC </h6>
                    </div>
                    <p class="modal-padding-space">Customized advertising to increase visitors and improve conversion. To
                        increase retention, identify the correct audience and remarket to them.</p>
                    <div class="large-modal-header mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right">
                            <polyline points="13 17 18 12 13 7"></polyline>
                            <polyline points="6 17 11 12 6 7"></polyline>
                        </svg>
                        <h6>UX designer </h6>
                    </div>
                    <p class="modal-padding-space">The capacity to comprehend and experience other people's feelings is
                        known as empathy. A positive consumer experience is prioritised by UX. The finest UX designers spend
                        time studying individuals and their tendencies because of this. Designers may produce goods that
                        genuinely engage and excite customers by having a thorough understanding of the end consumers.</p>
                </div>
            </div>
        </div>
    </div>
@endsection