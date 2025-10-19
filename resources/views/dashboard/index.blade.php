@extends('template')

@section('own_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                        <div class="card-body">
                            <div
                                class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2 pb-2 p-0">
                                <ul class="nav nav-pills nav-warning" id="j-pills-tab-list" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="j-pills-home-tab" data-bs-toggle="pill"
                                            href="#j-pills-home" role="tab" aria-controls="j-pills-home"
                                            aria-selected="false" tabindex="-1">
                                            Home
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="j-pills-index-tab" data-bs-toggle="pill"
                                            href="#j-pills-index" role="tab" aria-controls="j-pills-index"
                                            aria-selected="false" tabindex="-1">
                                            Index
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="j-pills-faq-tab" data-bs-toggle="pill" href="#j-pills-faq"
                                            role="tab" aria-controls="j-pills-faq" aria-selected="true">
                                            FAQ
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="j-pills-developers-tab" data-bs-toggle="pill"
                                            href="#j-pills-developers" role="tab" aria-controls="j-pills-developers"
                                            aria-selected="true">
                                            Developers
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body px-0 pb-0">
                                <div class="tab-content" id="j-pills-tabContents">
                                    <div class="tab-pane fade active show" id="j-pills-home" role="tabpanel"
                                        aria-labelledby="j-pills-home-tab">
                                        <div class="row justify-content-center">
                                            <div class="iframe-wrapper">
                                                <iframe src="https://aqicn.org/city/indonesia/medan/m">
                                                </iframe>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="j-pills-index" role="tabpanel"
                                        aria-labelledby="j-pills-index-tab">
                                        <div class="row justify-content-center">
                                            <div class="col-12 col-lg-10">
                                                <div class="card">
                                                    <div class="card-header text-center">
                                                        <h1 class="card-title"><i class="fas fa-wind me-2"></i>Tingkat
                                                            Kualitas Udara (AQI)</h1>
                                                        <p class="card-subtitle">Indeks Kualitas Udara dan Dampaknya
                                                            terhadap Kesehatan</p>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="aqi-levels">
                                                            <!-- Good -->
                                                            <div class="aqi-item good">
                                                                <div class="aqi-icon">
                                                                    <i class="fas fa-smile"></i>
                                                                </div>
                                                                <div class="aqi-content">
                                                                    <div class="aqi-range">Baik (0-50)</div>
                                                                    <div class="aqi-description">Kualitas udara baik,
                                                                        tidak berisiko bagi kesehatan.</div>
                                                                </div>
                                                            </div>

                                                            <!-- Moderate -->
                                                            <div class="aqi-item moderate">
                                                                <div class="aqi-icon">
                                                                    <i class="fas fa-meh"></i>
                                                                </div>
                                                                <div class="aqi-content">
                                                                    <div class="aqi-range">Sedang (51-100)</div>
                                                                    <div class="aqi-description">Masih dapat diterima,
                                                                        namun beberapa orang sensitif mungkin terdampak
                                                                        ringan.</div>
                                                                </div>
                                                            </div>

                                                            <!-- Unhealthy for Sensitive Groups -->
                                                            <div class="aqi-item unhealthy-sg">
                                                                <div class="aqi-icon">
                                                                    <i class="fas fa-exclamation-triangle"></i>
                                                                </div>
                                                                <div class="aqi-content">
                                                                    <div class="aqi-range">Tidak Sehat untuk Kelompok
                                                                        Sensitif (101-150)</div>
                                                                    <div class="aqi-description">Kelompok sensitif
                                                                        seperti anak-anak, lansia, dan penderita
                                                                        gangguan pernapasan mulai berisiko.</div>
                                                                </div>
                                                            </div>

                                                            <!-- Unhealthy -->
                                                            <div class="aqi-item unhealthy">
                                                                <div class="aqi-icon">
                                                                    <i class="fas fa-exclamation-circle"></i>
                                                                </div>
                                                                <div class="aqi-content">
                                                                    <div class="aqi-range">Tidak Sehat (151-200)</div>
                                                                    <div class="aqi-description">Semua orang bisa mulai
                                                                        merasakan efek kesehatan.</div>
                                                                </div>
                                                            </div>

                                                            <!-- Very Unhealthy -->
                                                            <div class="aqi-item very-unhealthy">
                                                                <div class="aqi-icon">
                                                                    <i class="fas fa-skull-crossbones"></i>
                                                                </div>
                                                                <div class="aqi-content">
                                                                    <div class="aqi-range">Sangat Tidak Sehat (201-300)
                                                                    </div>
                                                                    <div class="aqi-description">Peringatan kesehatan
                                                                        serius; risiko tinggi bagi seluruh populasi.
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Hazardous -->
                                                            <div class="aqi-item hazardous">
                                                                <div class="aqi-icon">
                                                                    <i class="fas fa-radiation-alt"></i>
                                                                </div>
                                                                <div class="aqi-content">
                                                                    <div class="aqi-range">Berbahaya (301-500)</div>
                                                                    <div class="aqi-description">Kondisi darurat; semua
                                                                        orang sangat berbahaya untuk terpapar.</div>
                                                                </div>
                                                            </div>



                                                            <div class="legend">
                                                                <div class="legend-item">
                                                                    <div class="legend-color"
                                                                        style="background-color: var(--good);"></div>
                                                                    <span>Baik</span>
                                                                </div>
                                                                <div class="legend-item">
                                                                    <div class="legend-color"
                                                                        style="background-color: var(--moderate);"></div>
                                                                    <span>Sedang</span>
                                                                </div>
                                                                <div class="legend-item">
                                                                    <div class="legend-color"
                                                                        style="background-color: var(--unhealthy-sg);">
                                                                    </div>
                                                                    <span>Tidak Sehat untuk Kelompok Sensitif</span>
                                                                </div>
                                                                <div class="legend-item">
                                                                    <div class="legend-color"
                                                                        style="background-color: var(--unhealthy);"></div>
                                                                    <span>Tidak Sehat</span>
                                                                </div>
                                                                <div class="legend-item">
                                                                    <div class="legend-color"
                                                                        style="background-color: var(--very-unhealthy);">
                                                                    </div>
                                                                    <span>Sangat Tidak Sehat</span>
                                                                </div>
                                                                <div class="legend-item">
                                                                    <div class="legend-color"
                                                                        style="background-color: var(--hazardous);"></div>
                                                                    <span>Berbahaya</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="j-pills-faq" role="tabpanel"
                                        aria-labelledby="j-pills-faq-tab">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card height-equal" style="min-height: 493px;">
                                                    <div class="card-body">
                                                        <div class="accordion dark-accordion" id="simpleaccordion">
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="headingOne">
                                                                    <button
                                                                        class="accordion-button collapsed accordion-light-primary txt-primary active"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapseOne" aria-expanded="true"
                                                                        aria-controls="collapseOne">
                                                                        What do web designers do?
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-chevron-down svg-color">
                                                                            <polyline points="6 9 12 15 18 9"></polyline>
                                                                        </svg>
                                                                    </button>
                                                                </h2>
                                                                <div class="accordion-collapse collapse show"
                                                                    id="collapseOne" aria-labelledby="headingOne"
                                                                    data-bs-parent="#simpleaccordion">
                                                                    <div class="accordion-body">
                                                                        <p>
                                                                            Web design<em class="txt-danger"> identifies
                                                                                the goals</em> of a website or webpage and
                                                                            promotes accessibility for all potential users.
                                                                            This process involves organizing content and
                                                                            images across a series of pages and integrating
                                                                            applications and other interactive elements.
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="headingTwo">
                                                                    <button
                                                                        class="accordion-button collapsed accordion-light-primary txt-primary active"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapseTwo"
                                                                        aria-expanded="false" aria-controls="collapseTwo">
                                                                        What is the use of web design?
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-chevron-down svg-color">
                                                                            <polyline points="6 9 12 15 18 9"></polyline>
                                                                        </svg>
                                                                    </button>
                                                                </h2>
                                                                <div class="accordion-collapse collapse" id="collapseTwo"
                                                                    aria-labelledby="headingTwo"
                                                                    data-bs-parent="#simpleaccordion">
                                                                    <div class="accordion-body">
                                                                        <p class="mb-3">
                                                                            <strong>Search engine optimization: </strong>
                                                                            Search engine optimization (SEO) is a method for
                                                                            improving the chances for a website to be found
                                                                            by search engines. Web design codes information
                                                                            in a way that search engines can read it. It can
                                                                            boost business because the site shows up on the
                                                                            top search result pages, helping people to find
                                                                            it.
                                                                        </p>
                                                                        <p class="mb-3">
                                                                            <strong>Mobile responsiveness:</strong> Mobile
                                                                            responsiveness is the feature of a website that
                                                                            allows it to display on a mobile device and
                                                                            adapt its layout and proportions to be legible.
                                                                            Web design ensures sites are easy to view and
                                                                            navigate from mobile devices. When a website is
                                                                            well-designed and mobile-responsive, customers
                                                                            can reach the business with ease.
                                                                        </p>
                                                                        <p>
                                                                            <strong> Improved sales:</strong>Increasing the
                                                                            number of items sold or acquiring more active
                                                                            customers are objectives of a compelling
                                                                            website. As web design reaches targeted
                                                                            customers and search engines, it helps the
                                                                            business make conversions on their site and
                                                                            improve its sales.
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="headingThree">
                                                                    <button
                                                                        class="accordion-button collapsed accordion-light-primary txt-primary active"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapseThree"
                                                                        aria-expanded="false"
                                                                        aria-controls="collapseThree">
                                                                        What are the elements of web design?
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-chevron-down svg-color">
                                                                            <polyline points="6 9 12 15 18 9"></polyline>
                                                                        </svg>
                                                                    </button>
                                                                </h2>
                                                                <div class="accordion-collapse collapse"
                                                                    id="collapseThree" aria-labelledby="headingThree"
                                                                    data-bs-parent="#simpleaccordion">
                                                                    <div class="accordion-body">
                                                                        <p>
                                                                            The web design process allows designers to
                                                                            adjust to any preferences and provide effective
                                                                            solutions. There are many standard components of
                                                                            every web design, including:
                                                                        </p>
                                                                        <ul
                                                                            class="d-flex flex-column gap-2 accordions-content">
                                                                            <li>--&gt; Layout</li>
                                                                            <li>--&gt; Images</li>
                                                                            <li>--&gt; Visual hierarchy</li>
                                                                            <li>--&gt; Color scheme</li>
                                                                            <li>--&gt; Typography</li>
                                                                            <li>--&gt; Navigation</li>
                                                                            <li>--&gt; Readability</li>
                                                                            <li>--&gt; Content</li>
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
                                    <div class="tab-pane fade" id="j-pills-developers" role="tabpanel"
                                        aria-labelledby="j-pills-developers-tab">
                                        <div class="row">
                                            <div class="col-6 col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4">
                                                <div class="card social-profile">
                                                    <div class="card-body">
                                                        <div class="social-img-wrap">
                                                            <div class="social-img"><img
                                                                    src="{{ asset('own_assets/images/devs/arif.jpeg') }}"
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
                                                                    style="font-size: 25px">Developer 1</a></h5><span
                                                                class="f-light">@Developer1</span>
                                                            <ul class="card-social">
                                                                <li>
                                                                    <a href="https://www.instagram.com"
                                                                        target="_blank"><i class="fa fa-instagram"
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
                                                                    src="{{ asset('own_assets/images/devs/zakwan.jpeg') }}"
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
                                                                    style="font-size: 25px">Developer 2</a></h5><span
                                                                class="f-light">@Developer2</span>
                                                            <ul class="card-social">
                                                                <li>
                                                                    <a href="https://www.instagram.com/"
                                                                        target="_blank"><i class="fa fa-instagram"
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
                                                                    src="{{ asset('own_assets/images/devs/moan.jpeg') }}"
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
                                                                    style="font-size: 25px">Developer 3</a></h5><span
                                                                class="f-light">@Developer3</span>
                                                            <ul class="card-social">
                                                                <li>
                                                                    <a href="https://www.instagram.com/"
                                                                        target="_blank"><i class="fa fa-instagram"
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
                                                                    src="{{ asset('own_assets/images/devs/talitha.jpeg') }}"
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
                                                                    style="font-size: 25px">Developer 4</a></h5><span
                                                                class="f-light">@Developer4</span>
                                                            <ul class="card-social">
                                                                <li>
                                                                    <a href="https://www.instagram.com/"
                                                                        target="_blank"><i class="fa fa-instagram"
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
                                                                    src="{{ asset('own_assets/images/devs/keysha.jpeg') }}"
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
                                                                    style="font-size: 25px">Developer 5</a></h5><span
                                                                class="f-light">@Developer5</span>
                                                            <ul class="card-social">
                                                                <li>
                                                                    <a href="https://www.instagram.com"
                                                                        target="_blank"><i class="fa fa-instagram"
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
                                                                    src="{{ asset('own_assets/images/devs/rasyid.jpeg') }}"
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
                                                                    style="font-size: 25px">Developer 6</a></h5><span
                                                                class="f-light">@Developer6</span>
                                                            <ul class="card-social">
                                                                <li>
                                                                    <a href="https://www.instagram.com/"
                                                                        target="_blank"><i class="fa fa-instagram"
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
        </div>
    </div>
@endsection
