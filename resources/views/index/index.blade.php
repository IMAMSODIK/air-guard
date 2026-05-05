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

    <style>
        :root {
            --good: #00E400;
            --moderate: #FFFF00;
            --unhealthy-sg: #FF7E00;
            --unhealthy: #FF0000;
            --very-unhealthy: #8F3F97;
            --hazardous: #7E0023;
        }

        .aqi-levels {
            padding: 20px;
        }

        .aqi-item {
            border-radius: 12px;
            margin-bottom: 16px;
            padding: 20px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
        }

        .aqi-item:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }

        .aqi-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 8px;
            height: 100%;
        }

        .aqi-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            flex-shrink: 0;
            font-size: 20px;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .aqi-content {
            flex: 1;
        }

        .aqi-range {
            font-weight: bold;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .aqi-description {
            font-size: 0.95rem;
            line-height: 1.5;
        }

        /* Warna untuk setiap level AQI */
        .good {
            background-color: rgba(0, 228, 0, 0.1);
        }

        .good::before {
            background-color: var(--good);
        }

        .good .aqi-icon {
            background-color: var(--good);
        }

        .moderate {
            background-color: rgba(255, 255, 0, 0.1);
        }

        .moderate::before {
            background-color: var(--moderate);
        }

        .moderate .aqi-icon {
            background-color: var(--moderate);
        }

        .unhealthy-sg {
            background-color: rgba(255, 126, 0, 0.1);
        }

        .unhealthy-sg::before {
            background-color: var(--unhealthy-sg);
        }

        .unhealthy-sg .aqi-icon {
            background-color: var(--unhealthy-sg);
        }

        .unhealthy {
            background-color: rgba(255, 0, 0, 0.1);
        }

        .unhealthy::before {
            background-color: var(--unhealthy);
        }

        .unhealthy .aqi-icon {
            background-color: var(--unhealthy);
        }

        .very-unhealthy {
            background-color: rgba(143, 63, 151, 0.1);
        }

        .very-unhealthy::before {
            background-color: var(--very-unhealthy);
        }

        .very-unhealthy .aqi-icon {
            background-color: var(--very-unhealthy);
        }

        .hazardous {
            background-color: rgba(126, 0, 35, 0.1);
        }

        .hazardous::before {
            background-color: var(--hazardous);
        }

        .hazardous .aqi-icon {
            background-color: var(--hazardous);
        }

        /* Warna teks untuk kontras yang baik */
        .good,
        .moderate {
            color: #333;
        }

        .unhealthy-sg,
        .unhealthy,
        .very-unhealthy,
        .hazardous {
            color: #333;
        }

        .card-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .card-subtitle {
            font-size: 1rem;
            opacity: 0.8;
        }

        .legend {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
            padding: 15px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin: 5px;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 4px;
            margin-right: 8px;
        }

        @media (max-width: 576px) {
            .aqi-item {
                flex-direction: column;
                text-align: center;
            }

            .aqi-icon {
                margin-right: 0;
                margin-bottom: 15px;
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
                            <h4>Index</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-body px-0 pb-0">
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

                                <!-- Informasi Gas Berbahaya: HCHO, CO, TVOC -->
                                <div class="row justify-content-center mt-5">
                                    <div class="col-12 col-lg-10">
                                        <div class="card border-danger">
                                            <div class="card-header bg-danger text-white text-center">
                                                <h3 class="mb-0"><i class="fas fa-industry me-2"></i>Informasi Gas
                                                    Berbahaya</h3>
                                                <small>Dampak Formaldehida (HCHO), Karbon Monoksida (CO), dan Gas Organik
                                                    (TVOC)</small>
                                            </div>
                                            <div class="card-body">
                                                <div class="row g-4">

                                                    <!-- HCHO (Formaldehyde) -->
                                                    <div class="col-md-6 col-lg-4">
                                                        <div class="card h-100 border-0 shadow-sm">
                                                            <div class="card-body text-center">
                                                                <div
                                                                    class="rounded-circle bg-warning bg-opacity-25 d-inline-flex p-3 mb-3">
                                                                    <i class="fas fa-flask fa-2x text-warning"></i>
                                                                </div>
                                                                <h4 class="card-title">HCHO <small
                                                                        class="text-muted">(Formaldehida)</small></h4>
                                                                <p class="card-text">Gas tidak berwarna dengan bau tajam,
                                                                    umum berasal dari asap rokok, furnitur berbahan kayu
                                                                    lapis, lem, dan cat.</p>
                                                                <hr>
                                                                <div class="text-start">
                                                                    <strong>Tingkat & Dampak:</strong>
                                                                    <ul class="list-unstyled mt-2">
                                                                        <li><i class="fas fa-circle text-success me-2"></i>
                                                                            < 0.1 ppm : Aman</li>
                                                                        <li><i class="fas fa-circle text-warning me-2"></i>
                                                                            0.1 - 0.3 ppm : Iritasi mata & tenggorokan</li>
                                                                        <li><i class="fas fa-circle text-danger me-2"></i>
                                                                            > 0.3 ppm : Berbahaya, pemicu asma & risiko
                                                                            kanker</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- CO ppm (Carbon Monoxide) -->
                                                    <div class="col-md-6 col-lg-4">
                                                        <div class="card h-100 border-0 shadow-sm">
                                                            <div class="card-body text-center">
                                                                <div
                                                                    class="rounded-circle bg-danger bg-opacity-25 d-inline-flex p-3 mb-3">
                                                                    <i class="fas fa-car fa-2x text-danger"></i>
                                                                </div>
                                                                <h4 class="card-title">COppm <small
                                                                        class="text-muted">(Karbon Monoksida)</small></h4>
                                                                <p class="card-text">Gas beracun tanpa bau & warna. Berasal
                                                                    dari kendaraan bermotor, pemanas ruangan, dan asap
                                                                    kebakaran.</p>
                                                                <hr>
                                                                <div class="text-start">
                                                                    <strong>Tingkat & Dampak:</strong>
                                                                    <ul class="list-unstyled mt-2">
                                                                        <li><i class="fas fa-circle text-success me-2"></i>
                                                                            0 - 9 ppm : Normal di lingkungan luar</li>
                                                                        <li><i class="fas fa-circle text-warning me-2"></i>
                                                                            10 - 25 ppm : Waspada untuk kelompok sensitif
                                                                        </li>
                                                                        <li><i class="fas fa-circle text-danger me-2"></i>
                                                                            > 50 ppm : Sakit kepala, kelelahan, bahaya fatal
                                                                            jika terpapar lama</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- TVOC (Total Volatile Organic Compounds) -->
                                                    <div class="col-md-6 col-lg-4">
                                                        <div class="card h-100 border-0 shadow-sm">
                                                            <div class="card-body text-center">
                                                                <div
                                                                    class="rounded-circle bg-info bg-opacity-25 d-inline-flex p-3 mb-3">
                                                                    <i class="fas fa-spray-can fa-2x text-info"></i>
                                                                </div>
                                                                <h4 class="card-title">TVOC <small class="text-muted">(Gas
                                                                        Organik Total)</small></h4>
                                                                <p class="card-text">Campuran ribuan senyawa kimia dari
                                                                    cat, pengharum ruangan, pestisida, dan produk pembersih.
                                                                </p>
                                                                <hr>
                                                                <div class="text-start">
                                                                    <strong>Tingkat & Dampak:</strong>
                                                                    <ul class="list-unstyled mt-2">
                                                                        <li><i class="fas fa-circle text-success me-2"></i>
                                                                            < 0.5 mg/m³ : Baik</li>
                                                                        <li><i class="fas fa-circle text-warning me-2"></i>
                                                                            0.5 - 1 mg/m³ : Iritasi ringan, sakit kepala
                                                                        </li>
                                                                        <li><i class="fas fa-circle text-danger me-2"></i>
                                                                            > 1 mg/m³ : Gangguan saraf, kerusakan hati &
                                                                            ginjal</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <!-- Pesan Peringatan Tambahan -->
                                                <div class="alert alert-warning mt-4 text-center" role="alert">
                                                    <i class="fas fa-shield-alt me-2"></i>
                                                    <strong>Tips Kesehatan:</strong> Pastikan sirkulasi udara baik, gunakan
                                                    masker jika diperlukan, dan hindari paparan jangka panjang dari sumber
                                                    polusi dalam ruangan.
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
