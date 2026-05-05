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
                            <h4><i class="fas fa-graduation-cap me-2"></i>Edukasi Deteksi Gas & Kualitas Udara</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-body px-0 pb-0">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card height-equal" style="min-height: 493px;">
                                            <div class="card-body">
                                                <div class="accordion dark-accordion" id="simpleaccordion">
                                                    
                                                    <!-- Apa itu Deteksi Gas? -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingOne">
                                                            <button
                                                                class="accordion-button collapsed accordion-light-primary txt-primary active"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapseOne" aria-expanded="true"
                                                                aria-controls="collapseOne">
                                                                <i class="fas fa-microchip me-2"></i> Apa itu Deteksi Gas dan Mengapa Penting?
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
                                                                    <strong>Deteksi gas</strong> adalah proses mengidentifikasi dan mengukur konsentrasi gas berbahaya di udara seperti <strong>HCHO (Formaldehida)</strong>, <strong>CO (Karbon Monoksida)</strong>, dan <strong>TVOC</strong>. Deteksi ini penting karena gas-gas tersebut dapat membahayakan kesehatan manusia meskipun tidak terlihat atau berbau.
                                                                </p>
                                                                <p class="mb-0 mt-2 text-muted">
                                                                    <i class="fas fa-info-circle"></i> Sensor gas modern memungkinkan pemantauan real-time untuk memberikan peringatan dini dan melindungi kesehatan keluarga.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- HCHO (Formaldehida) -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwo">
                                                            <button
                                                                class="accordion-button collapsed accordion-light-primary txt-primary"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapseTwo" aria-expanded="false"
                                                                aria-controls="collapseTwo">
                                                                <i class="fas fa-flask me-2"></i> Apa itu HCHO (Formaldehida) dan Sumbernya?
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
                                                                <p>
                                                                    <strong>HCHO (Formaldehida)</strong> adalah gas tidak berwarna dengan bau tajam yang digunakan dalam industri pembuatan furnitur, lem, cat, dan bahan bangunan.
                                                                </p>
                                                                <p class="mb-2"><strong>Sumber utama di dalam ruangan:</strong></p>
                                                                <ul>
                                                                    <li><i class="fas fa-couch me-2"></i> Furnitur berbahan kayu lapis (partikel board, MDF)</li>
                                                                    <li><i class="fas fa-smoking me-2"></i> Asap rokok</li>
                                                                    <li><i class="fas fa-paint-roller me-2"></i> Cat dinding dan perekat</li>
                                                                    <li><i class="fas fa-temperature-high me-2"></i> Proses pembakaran tidak sempurna</li>
                                                                </ul>
                                                                <div class="alert alert-warning mt-2">
                                                                    <i class="fas fa-exclamation-triangle"></i> <strong>Bahaya:</strong> Paparan >0.1 ppm dapat menyebabkan iritasi mata, tenggorokan, dan bersifat karsinogenik (penyebab kanker).
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- CO (Karbon Monoksida) -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingThree">
                                                            <button
                                                                class="accordion-button collapsed accordion-light-primary txt-primary"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapseThree" aria-expanded="false"
                                                                aria-controls="collapseThree">
                                                                <i class="fas fa-car me-2"></i> Apa itu CO (Karbon Monoksida) dan Mengapa Mematikan?
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
                                                            aria-labelledby="headingThree" data-bs-parent="#simpleaccordion">
                                                            <div class="accordion-body">
                                                                <p>
                                                                    <strong>CO (Karbon Monoksida)</strong> adalah gas beracun tanpa warna, bau, dan rasa. Sering disebut <strong>"silent killer"</strong> karena tidak terdeteksi oleh panca indera manusia.
                                                                </p>
                                                                <p class="mb-2"><strong>Sumber utama CO:</strong></p>
                                                                <ul>
                                                                    <li><i class="fas fa-car-side me-2"></i> Gas buang kendaraan bermotor</li>
                                                                    <li><i class="fas fa-fire me-2"></i> Pembakaran tidak sempurna (kompor, pemanas air)</li>
                                                                    <li><i class="fas fa-industry me-2"></i> Kebakaran hutan atau industri</li>
                                                                </ul>
                                                                <div class="alert alert-danger mt-2">
                                                                    <i class="fas fa-skull-crossbones"></i> <strong>Bahaya:</strong> CO mengikat hemoglobin 200x lebih kuat dari oksigen. Pada level >50 ppm dapat menyebabkan sakit kepala, mual, kehilangan kesadaran, hingga kematian.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- TVOC -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingFour">
                                                            <button
                                                                class="accordion-button collapsed accordion-light-primary txt-primary"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapseFour" aria-expanded="false"
                                                                aria-controls="collapseFour">
                                                                <i class="fas fa-spray-can me-2"></i> Apa itu TVOC (Total Volatile Organic Compounds)?
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
                                                            aria-labelledby="headingFour" data-bs-parent="#simpleaccordion">
                                                            <div class="accordion-body">
                                                                <p>
                                                                    <strong>TVOC</strong> adalah total senyawa organik yang mudah menguap dari berbagai sumber seperti cat, pengharum ruangan, pestisida, dan produk pembersih.
                                                                </p>
                                                                <p class="mb-2"><strong>Sumber TVOC di rumah:</strong></p>
                                                                <ul>
                                                                    <li><i class="fas fa-wind me-2"></i> Pengharum ruangan dan lilin wangi</li>
                                                                    <li><i class="fas fa-broom me-2"></i> Pembersih lantai dan disinfektan</li>
                                                                    <li><i class="fas fa-fill-drip me-2"></i> Cat baru dan lem</li>
                                                                    <li><i class="fas fa-bug me-2"></i> Pestisida dan insektisida</li>
                                                                </ul>
                                                                <div class="alert alert-info mt-2">
                                                                    <i class="fas fa-lungs"></i> <strong>Dampak Kesehatan:</strong> TVOC >1 mg/m³ dapat menyebabkan sakit kepala, iritasi mata, gangguan saraf, dan kerusakan hati jangka panjang.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Cara Kerja Sensor Gas -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingFive">
                                                            <button
                                                                class="accordion-button collapsed accordion-light-primary txt-primary"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapseFive" aria-expanded="false"
                                                                aria-controls="collapseFive">
                                                                <i class="fas fa-microchip me-2"></i> Bagaimana Cara Kerja Sensor Gas Mendeteksi Polusi?
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
                                                            aria-labelledby="headingFive" data-bs-parent="#simpleaccordion">
                                                            <div class="accordion-body">
                                                                <p>
                                                                    Sensor gas modern menggunakan teknologi <strong>elektrokimia</strong> atau <strong>semikonduktor</strong> (MOS) yang mengubah konsentrasi gas menjadi sinyal listrik.
                                                                </p>
                                                                <p class="mb-2"><strong>Proses deteksi:</strong></p>
                                                                <ol>
                                                                    <li>Gas masuk melalui pori-pori sensor</li>
                                                                    <li>Terjadi reaksi kimia pada permukaan sensor</li>
                                                                    <li>Perubahan resistansi listrik diukur</li>
                                                                    <li>Mikrokontroler mengubah data menjadi nilai ppm (parts per million)</li>
                                                                </ol>
                                                                <p class="text-muted mt-2">
                                                                    <i class="fas fa-chart-line"></i> Data ditampilkan secara real-time dan dapat dipantau melalui dashboard.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Ambang Batas Aman -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingSix">
                                                            <button
                                                                class="accordion-button collapsed accordion-light-primary txt-primary"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapseSix" aria-expanded="false"
                                                                aria-controls="collapseSix">
                                                                <i class="fas fa-chart-line me-2"></i> Berapa Ambang Batas Aman untuk Setiap Gas?
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
                                                            aria-labelledby="headingSix" data-bs-parent="#simpleaccordion">
                                                            <div class="accordion-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered">
                                                                        <thead class="table-dark">
                                                                            <tr>
                                                                                <th>Parameter</th>
                                                                                <th>Aman</th>
                                                                                <th>Waspada</th>
                                                                                <th>Berbahaya</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr style="background-color: #d4edda;">
                                                                                <td><strong>HCHO</strong></td>
                                                                                <td>&lt; 0.1 ppm</td>
                                                                                <td>0.1 - 0.3 ppm</td>
                                                                                <td>&gt; 0.3 ppm</td>
                                                                            </tr>
                                                                            <tr style="background-color: #fff3cd;">
                                                                                <td><strong>CO</strong></td>
                                                                                <td>0 - 9 ppm</td>
                                                                                <td>10 - 25 ppm</td>
                                                                                <td>&gt; 50 ppm</td>
                                                                             </tr>
                                                                            <tr style="background-color: #d1ecf1;">
                                                                                <td><strong>TVOC</strong></td>
                                                                                <td>&lt; 0.5 mg/m³</td>
                                                                                <td>0.5 - 1 mg/m³</td>
                                                                                <td>&gt; 1 mg/m³</td>
                                                                             </tr>
                                                                            <tr style="background-color: #d4edda;">
                                                                                <td><strong>CO₂</strong></td>
                                                                                <td>400 - 1000 ppm</td>
                                                                                <td>1000 - 2000 ppm</td>
                                                                                <td>&gt; 5000 ppm</td>
                                                                             </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <p class="text-muted mt-2">
                                                                    <i class="fas fa-lightbulb"></i> Gunakan tabel ini sebagai panduan untuk membaca data sensor Anda.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Cara Melindungi Diri -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingSeven">
                                                            <button
                                                                class="accordion-button collapsed accordion-light-primary txt-primary"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapseSeven" aria-expanded="false"
                                                                aria-controls="collapseSeven">
                                                                <i class="fas fa-shield-alt me-2"></i> Bagaimana Melindungi Diri dari Paparan Gas Berbahaya?
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
                                                            aria-labelledby="headingSeven" data-bs-parent="#simpleaccordion">
                                                            <div class="accordion-body">
                                                                <p class="mb-2"><strong>Langkah-langkah perlindungan:</strong></p>
                                                                <ul>
                                                                    <li><i class="fas fa-fan me-2"></i> <strong>Ventilasi udara:</strong> Buka jendela secara teratur</li>
                                                                    <li><i class="fas fa-filter me-2"></i> <strong>Air purifier:</strong> Gunakan dengan filter karbon aktif</li>
                                                                    <li><i class="fas fa-leaf me-2"></i> <strong>Tanaman penyerap polutan:</strong> Lidah mertua, sirih gading, peace lily</li>
                                                                    <li><i class="fas fa-mask me-2"></i> <strong>Masker N95/KN95:</strong> Saat di luar ruangan dengan polusi tinggi</li>
                                                                    <li><i class="fas fa-chart-simple me-2"></i> <strong>Pantau dashboard:</strong> Periksa data sensor secara rutin</li>
                                                                </ul>
                                                                <div class="alert alert-success mt-2">
                                                                    <i class="fas fa-check-circle"></i> <strong>Tips:</strong> Hindari penggunaan produk kimia berlebihan di dalam ruangan dan pastikan sirkulasi udara baik.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Mitos vs Fakta -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingEight">
                                                            <button
                                                                class="accordion-button collapsed accordion-light-primary txt-primary"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapseEight" aria-expanded="false"
                                                                aria-controls="collapseEight">
                                                                <i class="fas fa-question-circle me-2"></i> Mitos vs Fakta seputar Deteksi Gas
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
                                                            aria-labelledby="headingEight" data-bs-parent="#simpleaccordion">
                                                            <div class="accordion-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="alert alert-secondary">
                                                                            <i class="fas fa-times-circle text-danger"></i> <strong>Mitos:</strong> "Jika tidak berbau, udara pasti bersih."
                                                                            <hr>
                                                                            <i class="fas fa-check-circle text-success"></i> <strong>Fakta:</strong> CO dan banyak gas berbahaya tidak berbau. Hanya sensor yang bisa mendeteksinya.
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="alert alert-secondary">
                                                                            <i class="fas fa-times-circle text-danger"></i> <strong>Mitos:</strong> "Masker kain cukup untuk melindungi dari polusi gas."
                                                                            <hr>
                                                                            <i class="fas fa-check-circle text-success"></i> <strong>Fakta:</strong> Masker N95/KN95 lebih efektif, tapi tetap tidak bisa menyaring semua gas. Ventilasi lebih penting.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-2">
                                                                    <div class="col-md-6">
                                                                        <div class="alert alert-secondary">
                                                                            <i class="fas fa-times-circle text-danger"></i> <strong>Mitos:</strong> "Tanaman bisa menghilangkan semua polusi udara."
                                                                            <hr>
                                                                            <i class="fas fa-check-circle text-success"></i> <strong>Fakta:</strong> Tanaman membantu, tetapi tidak cukup untuk level polusi tinggi. Kombinasikan dengan air purifier.
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="alert alert-secondary">
                                                                            <i class="fas fa-times-circle text-danger"></i> <strong>Mitos:</strong> "Sensor gas mahal dan tidak akurat."
                                                                            <hr>
                                                                            <i class="fas fa-check-circle text-success"></i> <strong>Fakta:</strong> Sensor modern terjangkau dan cukup akurat untuk deteksi dini dan pemantauan rumah tangga.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Tanya Jawab Umum -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingNine">
                                                            <button
                                                                class="accordion-button collapsed accordion-light-primary txt-primary"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapseNine" aria-expanded="false"
                                                                aria-controls="collapseNine">
                                                                <i class="fas fa-comments me-2"></i> Tanya Jawab Umum Seputar Kualitas Udara
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-chevron-down svg-color">
                                                                    <polyline points="6 9 12 18 9"></polyline>
                                                                </svg>
                                                            </button>
                                                        </h2>
                                                        <div class="accordion-collapse collapse" id="collapseNine"
                                                            aria-labelledby="headingNine" data-bs-parent="#simpleaccordion">
                                                            <div class="accordion-body">
                                                                <div class="mb-3">
                                                                    <strong><i class="fas fa-question me-2"></i> Apakah AQI sama dengan deteksi gas?</strong>
                                                                    <p class="mb-0 mt-1">Tidak. AQI mengukur partikel (PM2.5, PM10) dan gas umum (O₃, NO₂). Deteksi gas spesifik mengukur HCHO, CO, TVOC untuk keamanan dalam ruangan.</p>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <strong><i class="fas fa-question me-2"></i> Berapa sering sensor harus dikalibrasi?</strong>
                                                                    <p class="mb-0 mt-1">Sensor elektrokimia sebaiknya dikalibrasi setiap 6-12 bulan untuk akurasi optimal. Sensor MOS umumnya lebih stabil.</p>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <strong><i class="fas fa-question me-2"></i> Bisakah sensor mendeteksi gas bocor dari kompor?</strong>
                                                                    <p class="mb-0 mt-1">Sensor LPG/metan khusus diperlukan untuk mendeteksi gas bocor. Sensor HCHO/CO tidak dirancang untuk itu.</p>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <strong><i class="fas fa-question me-2"></i> Apa yang harus dilakukan jika sensor menunjukkan level berbahaya?</strong>
                                                                    <p class="mb-0 mt-1">Segera buka jendela untuk ventilasi, evakuasi jika perlu, periksa sumber polusi, dan gunakan air purifier.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Referensi -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTen">
                                                            <button
                                                                class="accordion-button collapsed accordion-light-primary txt-primary"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapseTen" aria-expanded="false"
                                                                aria-controls="collapseTen">
                                                                <i class="fas fa-book me-2"></i> Sumber Referensi & Standar Internasional
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-chevron-down svg-color">
                                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                                </svg>
                                                            </button>
                                                        </h2>
                                                        <div class="accordion-collapse collapse" id="collapseTen"
                                                            aria-labelledby="headingTen" data-bs-parent="#simpleaccordion">
                                                            <div class="accordion-body">
                                                                <p>Standar ambang batas gas mengacu pada:</p>
                                                                <ul>
                                                                    <li><i class="fas fa-globe me-2"></i> <strong>WHO (World Health Organization)</strong> - Pedoman Kualitas Udara Global</li>
                                                                    <li><i class="fas fa-building me-2"></i> <strong>EPA (Environmental Protection Agency)</strong> - Standar AS</li>
                                                                    <li><i class="fas fa-chart-line me-2"></i> <strong>NIOSH (National Institute for Occupational Safety and Health)</strong> - Standar tempat kerja</li>
                                                                    <li><i class="fas fa-balance-scale me-2"></i> <strong>SNI (Standar Nasional Indonesia)</strong> - Peraturan Menteri Kesehatan No. 1077/Menkes/PER/V/2011</li>
                                                                </ul>
                                                                <div class="alert alert-light mt-2">
                                                                    <i class="fas fa-info-circle"></i> Data ini bersifat edukatif. Selalu konsultasikan dengan profesional untuk kondisi darurat.
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
    </div>
@endsection