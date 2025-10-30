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
                            <h4>Developers</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-body px-0 pb-0">
                                <div class="row">
                                    <div class="col-6 col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4">
                                        <div class="card social-profile">
                                            <div class="card-body">
                                                <div class="social-img-wrap">
                                                    <div class="social-img"><img
                                                            src="{{ asset('own_assets/images/devs/nabil.jpeg') }}"
                                                            alt="profile">
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
                                                    <h5 class="mb-1"><a href="#" style="font-size: 25px">Muhammad Nabil Sabili Nasution
                                                            </a></h5><span class="f-light">@mhdnabilsabili</span>
                                                    <ul class="card-social">
                                                        <li>
                                                            <a href="https://www.instagram.com/mhdnabilsabili" target="_blank"><i
                                                                    class="fa-brands fa-instagram" style="font-size: 20px"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4">
                                        <div class="card social-profile">
                                            <div class="card-body">
                                                <div class="social-img-wrap">
                                                    <div class="social-img"><img
                                                            src="{{ asset('own_assets/images/devs/hafiz.jpeg') }}"
                                                            alt="profile">
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
                                                        <a href="#" style="font-size: 25px">Hafizhi Maulana Akbar</a>
                                                    </h5>
                                                    <span class="f-light">@hafizhmaulana_14</span>
                                                    <ul class="card-social">
                                                        <li>
                                                            <a href="https://www.instagram.com/hafizhmaulana_14" target="_blank"><i
                                                                    class="fa-brands fa-instagram" style="font-size: 20px"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4">
                                        <div class="card social-profile">
                                            <div class="card-body">
                                                <div class="social-img-wrap">
                                                    <div class="social-img"><img
                                                            src="{{ asset('own_assets/images/devs/rafael.jpeg') }}"
                                                            alt="profile">
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
                                                        <a href="#" style="font-size: 25px">Raffael Hasudungan Sinaga</a>
                                                    </h5>
                                                    <span class="f-light">@raffaelsng</span>
                                                    <ul class="card-social">
                                                        <li>
                                                            <a href="https://www.instagram.com/raffaelsng" target="_blank"><i
                                                                    class="fa-brands fa-instagram" style="font-size: 20px"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4">
                                        <div class="card social-profile">
                                            <div class="card-body">
                                                <div class="social-img-wrap">
                                                    <div class="social-img"><img
                                                            src="{{ asset('own_assets/images/devs/yehezkiel.jpeg') }}"
                                                            alt="profile">
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
                                                        <a href="#" style="font-size: 25px">Yehezkiel Hutapea</a>
                                                    </h5>
                                                    <span class="f-light">@yehezkielhtp</span>
                                                    <ul class="card-social">
                                                        <li>
                                                            <a href="https://www.instagram.com/yehezkielhtp" target="_blank"><i
                                                                    class="fa-brands fa-instagram" style="font-size: 20px"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4">
                                        <div class="card social-profile">
                                            <div class="card-body">
                                                <div class="social-img-wrap">
                                                    <div class="social-img"><img
                                                            src="{{ asset('own_assets/images/devs/raihan.jpeg') }}"
                                                            alt="profile">
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
                                                    <h5 class="mb-1"><a href="#"
                                                            style="font-size: 25px">Raihan Zikri Rangkuti</a></h5><span
                                                        class="f-light">@rhn_zikri</span>
                                                    <ul class="card-social">
                                                        <li>
                                                            <a href="https://www.instagram.com/rhn_zikri" target="_blank"><i
                                                                    class="fa-brands fa-instagram"
                                                                    style="font-size: 20px"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4">
                                        <div class="card social-profile">
                                            <div class="card-body">
                                                <div class="social-img-wrap">
                                                    <div class="social-img"><img
                                                            src="{{ asset('own_assets/images/devs/rangga.jpeg') }}"
                                                            alt="profile">
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
                                                    <h5 class="mb-1"><a href="#"
                                                            style="font-size: 25px">Rangga Cakrabawana Lessan</a></h5><span
                                                        class="f-light">@rangga_lessan</span>
                                                    <ul class="card-social">
                                                        <li>
                                                            <a href="https://www.instagram.com/rangga_lessan" target="_blank">
                                                                <i
                                                                    class="fa-brands fa-instagram"
                                                                    style="font-size: 20px"></i></a>
                                                        </li>
                                                    </ul>
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
