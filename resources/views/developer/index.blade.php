@extends('template')

@section('own_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        .iframe-wrapper {
            width: 100%;
            height: 1200px;
            overflow: hidden;
            position: relative;
            border: 0;
        }

        .iframe-wrapper iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* ========== STYLE UNTUK DEVELOPERS CARD ========== */
        .developers-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0;
        }

        .developer-card {
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .developer-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .developer-card .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 1.5rem;
            flex: 1;
        }

        .social-img-wrap {
            position: relative;
            display: inline-block;
        }

        .social-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto;
            border: 3px solid #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .social-img img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            /* biar tidak kepotong */
            background-color: #f5f5f5;
            /* optional biar rapi */
        }

        .developers-row>div {
            display: flex;
        }

        .developers-row {
            ` display: flex;
            flex-wrap: wrap;
            justify-content: center;
            /* ini bikin center */
        }

        .developer-card {
            width: 100%;
        }

        .edit-icon {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: #4c71f2;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            border: 2px solid white;
        }

        .edit-icon svg {
            width: 16px;
            height: 16px;
            fill: white;
        }

        .social-details {
            margin-top: 1rem;
            width: 100%;
        }

        .social-details h5 {
            margin-bottom: 0.5rem;
        }

        .social-details h5 a {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2b2d42;
            text-decoration: none;
            transition: color 0.2s;
            display: inline-block;
            word-break: break-word;
        }

        .social-details h5 a:hover {
            color: #4c71f2;
        }

        /* Role/Badge styling (opsional, jika ingin menambahkan role) */
        .developer-role {
            font-size: 0.8rem;
            color: #8d99ae;
            margin-top: 0.25rem;
        }

        /* Membuat semua card memiliki tinggi yang sama pada baris yang sama */
        @media (min-width: 768px) {
            .developers-row {
                display: flex;
                flex-wrap: wrap;
            }

            .developers-row>[class*="col-"] {
                display: flex;
                flex-direction: column;
            }
        }

        /* Responsif untuk mobile */
        @media (max-width: 576px) {
            .social-img {
                width: 90px;
                height: 90px;
            }

            .edit-icon {
                width: 26px;
                height: 26px;
            }

            .edit-icon svg {
                width: 12px;
                height: 12px;
            }

            .social-details h5 a {
                font-size: 0.9rem;
            }

            .developer-card .card-body {
                padding: 1rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 text-center">
                    <a href="/"><img src="{{ asset('dashboard_assets/assets/images/logo/logo_dark.png') }}"
                            alt="Logo" class="img-fluid" style="max-width: 100px;"></a>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-users me-2"></i> Developers Team</h4>
                            <p class="text-muted mb-0">Tim pengembang sistem deteksi kualitas udara</p>
                        </div>
                        <div class="card-body">
                            <div class="card-body px-0 pb-0">
                                <div class="row developers-row">
                                    <!-- Bilal Muhammad Dwi Raharja -->
                                    <div class="col-12 col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4 mb-4">
                                        <div class="card social-profile developer-card h-100">
                                            <div class="card-body">
                                                <div class="social-img-wrap">
                                                    <div class="social-img">
                                                        <img src="{{ asset('own_assets/images/devs/Bilal Muhammad Dwi Raharja.jpeg') }}"
                                                            alt="Bilal Muhammad Dwi Raharja">
                                                    </div>
                                                    <div class="edit-icon">
                                                        <svg>
                                                            <use
                                                                href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#profile-check') }}">
                                                            </use>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="social-details">
                                                    <h5 class="mb-1">
                                                        <a href="#">Bilal Muhammad Dwi Raharja</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Enzi Zidane Tobing -->
                                    <div class="col-12 col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4 mb-4">
                                        <div class="card social-profile developer-card h-100">
                                            <div class="card-body">
                                                <div class="social-img-wrap">
                                                    <div class="social-img">
                                                        <img src="{{ asset('own_assets/images/devs/Enzi Zidane Tobing.jpeg') }}"
                                                            alt="Enzi Zidane Tobing">
                                                    </div>
                                                    <div class="edit-icon">
                                                        <svg>
                                                            <use
                                                                href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#profile-check') }}">
                                                            </use>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="social-details">
                                                    <h5 class="mb-1">
                                                        <a href="#">Enzi Zidane Tobing</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- M. Ibrahim Irsyad Sitorus -->
                                    <div class="col-12 col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4 mb-4">
                                        <div class="card social-profile developer-card h-100">
                                            <div class="card-body">
                                                <div class="social-img-wrap">
                                                    <div class="social-img">
                                                        <img src="{{ asset('own_assets/images/devs/M. Ibrahim Irsyad Sitorus.jpeg') }}"
                                                            alt="M. Ibrahim Irsyad Sitorus">
                                                    </div>
                                                    <div class="edit-icon">
                                                        <svg>
                                                            <use
                                                                href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#profile-check') }}">
                                                            </use>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="social-details">
                                                    <h5 class="mb-1">
                                                        <a href="#">M. Ibrahim Irsyad Sitorus</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Muhammad Atqa Sapelfi Al Hakim -->
                                    <div class="col-12 col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4 mb-4">
                                        <div class="card social-profile developer-card h-100">
                                            <div class="card-body">
                                                <div class="social-img-wrap">
                                                    <div class="social-img">
                                                        <img src="{{ asset('own_assets/images/devs/Muhammad Atqa Sapelfi Al Hakim.jpeg') }}"
                                                            alt="Muhammad Atqa Sapelfi Al Hakim">
                                                    </div>
                                                    <div class="edit-icon">
                                                        <svg>
                                                            <use
                                                                href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#profile-check') }}">
                                                            </use>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="social-details">
                                                    <h5 class="mb-1">
                                                        <a href="#">Muhammad Atqa Sapelfi Al Hakim</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Muhammad Rais Al khoir -->
                                    <div class="col-12 col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4 mb-4">
                                        <div class="card social-profile developer-card h-100">
                                            <div class="card-body">
                                                <div class="social-img-wrap">
                                                    <div class="social-img">
                                                        <img src="{{ asset('own_assets/images/devs/Muhammad Rais Al khoir.jpeg') }}"
                                                            alt="Muhammad Rais Al khoir">
                                                    </div>
                                                    <div class="edit-icon">
                                                        <svg>
                                                            <use
                                                                href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#profile-check') }}">
                                                            </use>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="social-details">
                                                    <h5 class="mb-1">
                                                        <a href="#">Muhammad Rais Al khoir</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Muhammad Rumi Attarniki -->
                                    <div class="col-12 col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4 mb-4">
                                        <div class="card social-profile developer-card h-100">
                                            <div class="card-body">
                                                <div class="social-img-wrap">
                                                    <div class="social-img">
                                                        <img src="{{ asset('own_assets/images/devs/Muhammad Rumi Attarniki.jpeg') }}"
                                                            alt="Muhammad Rumi Attarniki">
                                                    </div>
                                                    <div class="edit-icon">
                                                        <svg>
                                                            <use
                                                                href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#profile-check') }}">
                                                            </use>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="social-details">
                                                    <h5 class="mb-1">
                                                        <a href="#">Muhammad Rumi Attarniki</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Muhammad Yazfi Yaznil -->
                                    <div class="col-12 col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4 mb-4">
                                        <div class="card social-profile developer-card h-100">
                                            <div class="card-body">
                                                <div class="social-img-wrap">
                                                    <div class="social-img">
                                                        <img src="{{ asset('own_assets/images/devs/Muhammad Yazfi Yaznil.jpeg') }}"
                                                            alt="Muhammad Yazfi Yaznil">
                                                    </div>
                                                    <div class="edit-icon">
                                                        <svg>
                                                            <use
                                                                href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#profile-check') }}">
                                                            </use>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="social-details">
                                                    <h5 class="mb-1">
                                                        <a href="#">Muhammad Yazfi Yaznil</a>
                                                    </h5>
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
