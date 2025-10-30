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
                        <div class="card-header">
                            <h4>FAQ</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-body px-0 pb-0">
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
                                                                What is Air Pollution?
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-chevron-down svg-color">
                                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                                </svg>
                                                            </button>
                                                        </h2>
                                                        <div class="accordion-collapse collapse show" id="collapseOne"
                                                            aria-labelledby="headingOne" data-bs-parent="#simpleaccordion">
                                                            <div class="accordion-body">
                                                                <p>
                                                                    Air pollution is a condition where the air is contaminated by harmful substances that can harm human health, animals, and the environment.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwo">
                                                            <button
                                                                class="accordion-button collapsed accordion-light-primary txt-primary active"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapseTwo" aria-expanded="false"
                                                                aria-controls="collapseTwo">
                                                                What are the Main Pollutants in Air Pollution?
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-chevron-down svg-color">
                                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                                </svg>
                                                            </button>
                                                        </h2>
                                                        <div class="accordion-collapse collapse" id="collapseTwo"
                                                            aria-labelledby="headingTwo" data-bs-parent="#simpleaccordion">
                                                            <div class="accordion-body">
                                                                <p class="mb-3">
                                                                    The main pollutants include carbon monoxide (CO), sulfur dioxide (SO₂), nitrogen dioxide (NO₂), ozone (O₃), fine particles (PM2.5 and PM10), and lead (Pb).
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingThree">
                                                            <button
                                                                class="accordion-button collapsed accordion-light-primary txt-primary active"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapseThree" aria-expanded="false"
                                                                aria-controls="collapseThree">
                                                                Where Does Air Pollution Come From?
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-chevron-down svg-color">
                                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                                </svg>
                                                            </button>
                                                        </h2>
                                                        <div class="accordion-collapse collapse" id="collapseThree"
                                                            aria-labelledby="headingThree"
                                                            data-bs-parent="#simpleaccordion">
                                                            <div class="accordion-body">
                                                                <p>
                                                                    Sources include motor vehicles, industries, waste burning, cigarette smoke, forest fires, and household activities.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingFour">
                                                            <button
                                                                class="accordion-button collapsed accordion-light-primary txt-primary active"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapseFour" aria-expanded="false"
                                                                aria-controls="collapseFour">
                                                                How Does Air Pollution Affect Human Health?
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-chevron-down svg-color">
                                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                                </svg>
                                                            </button>
                                                        </h2>
                                                        <div class="accordion-collapse collapse" id="collapseFour"
                                                            aria-labelledby="headingFour"
                                                            data-bs-parent="#simpleaccordion">
                                                            <div class="accordion-body">
                                                                <p>
                                                                    It can cause respiratory problems, eye irritation, coughing, asthma, heart disease, and even lung cancer with long-term exposure.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingFive">
                                                            <button
                                                                class="accordion-button collapsed accordion-light-primary txt-primary active"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapseFive" aria-expanded="false"
                                                                aria-controls="collapseFive">
                                                                How Does Air Pollution Affect the Environment?
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-chevron-down svg-color">
                                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                                </svg>
                                                            </button>
                                                        </h2>
                                                        <div class="accordion-collapse collapse" id="collapseFive"
                                                            aria-labelledby="headingFive"
                                                            data-bs-parent="#simpleaccordion">
                                                            <div class="accordion-body">
                                                                <p>
                                                                    It causes acid rain, damages plants, contaminates water and soil, and contributes to climate change.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingSix">
                                                            <button
                                                                class="accordion-button collapsed accordion-light-primary txt-primary active"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapseSix" aria-expanded="false"
                                                                aria-controls="collapseSix">
                                                                What Can Be Done to Reduce Air Pollution?
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-chevron-down svg-color">
                                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                                </svg>
                                                            </button>
                                                        </h2>
                                                        <div class="accordion-collapse collapse" id="collapseSix"
                                                            aria-labelledby="headingSix"
                                                            data-bs-parent="#simpleaccordion">
                                                            <div class="accordion-body">
                                                                <p>
                                                                    Reduce private vehicle use, plant trees, use clean energy, avoid burning waste, and support environmental policies.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingSeven">
                                                            <button
                                                                class="accordion-button collapsed accordion-light-primary txt-primary active"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapseSeven" aria-expanded="false"
                                                                aria-controls="collapseSeven">
                                                                Are Regular Masks Effective Against Air Pollution?
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-chevron-down svg-color">
                                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                                </svg>
                                                            </button>
                                                        </h2>
                                                        <div class="accordion-collapse collapse" id="collapseSeven"
                                                            aria-labelledby="headingSeven"
                                                            data-bs-parent="#simpleaccordion">
                                                            <div class="accordion-body">
                                                                <p>
                                                                    Regular cloth or medical masks are less effective. Masks with filters, such as N95 or KN95, are better at filtering fine particles (PM2.5).
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingEight">
                                                            <button
                                                                class="accordion-button collapsed accordion-light-primary txt-primary active"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapseEight" aria-expanded="false"
                                                                aria-controls="collapseEight">
                                                                Who is Most Vulnerable to Air Pollution?
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-chevron-down svg-color">
                                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                                </svg>
                                                            </button>
                                                        </h2>
                                                        <div class="accordion-collapse collapse" id="collapseEight"
                                                            aria-labelledby="headingEight"
                                                            data-bs-parent="#simpleaccordion">
                                                            <div class="accordion-body">
                                                                <p>
                                                                    Children, the elderly, pregnant women, and people with lung or heart diseases.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingNine">
                                                            <button
                                                                class="accordion-button collapsed accordion-light-primary txt-primary active"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapseNine" aria-expanded="false"
                                                                aria-controls="collapseNine">
                                                                What Should Be Done to Avoid the Effects of Air Pollution?
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    hNine="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-chevron-down svg-color">
                                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                                </svg>
                                                            </button>
                                                        </h2>
                                                        <div class="accordion-collapse collapse" id="collapseNine"
                                                            aria-labelledby="headingNine"
                                                            data-bs-parent="#simpleaccordion">
                                                            <div class="accordion-body">
                                                                <p>
                                                                    Avoid outdoor activities when air quality is poor, wear an N95 mask, drink plenty of water, eat nutritious food, and use an air purifier indoors.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTen">
                                                            <button
                                                                class="accordion-button collapsed accordion-light-primary txt-primary active"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapseTen" aria-expanded="false"
                                                                aria-controls="collapseTen">
                                                                Can Reforestation Help Reduce Air Pollution?
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    hTen="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-chevron-down svg-color">
                                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                                </svg>
                                                            </button>
                                                        </h2>
                                                        <div class="accordion-collapse collapse" id="collapseTen"
                                                            aria-labelledby="headingTen"
                                                            data-bs-parent="#simpleaccordion">
                                                            <div class="accordion-body">
                                                                <p>
                                                                    Yes. Trees absorb carbon dioxide and other pollutants, produce oxygen, lower temperatures, and improve air quality.
                                                                </p>
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
    </div>
@endsection
