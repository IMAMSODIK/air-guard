@extends('template')

@section('own_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #006666;
            --primary-dark: #037DB5;
            --secondary: #4cc9f0;
            --success: #06d6a0;
            --warning: #f9c74f;
            --danger: #f94144;
            --dark: #2b2d42;
            --light: #f8f9fa;
            --gray: #8d99ae;
        }

        .quiz-wrapper {
            padding: 1rem 0;
        }

        .quiz-card {
            background: white;
            border-radius: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .quiz-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 1.5rem 2rem;
            color: white;
            text-align: center;
        }

        .quiz-header h1 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .quiz-header h1 i {
            font-size: 2rem;
        }

        .quiz-header .badge-info {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 40px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.75rem;
        }

        .quiz-body {
            padding: 2rem;
        }

        /* Progress Bar */
        .progress-wrapper {
            margin-bottom: 2rem;
        }

        .progress-stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.85rem;
            color: var(--gray);
        }

        .progress-bar-custom {
            height: 8px;
            background: #e9ecef;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--success), var(--primary));
            border-radius: 10px;
            transition: width 0.3s ease;
            width: 0%;
        }

        /* Question Area */
        .question-number {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .shuffle-badge {
            background: #f0f0f0;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.7rem;
            color: var(--gray);
        }

        .question-text {
            font-size: 1.35rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 1.5rem;
            line-height: 1.4;
        }

        /* Options */
        .options-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-bottom: 2rem;
        }

        .option-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: var(--light);
            border: 2px solid #e9ecef;
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .option-item:hover {
            border-color: var(--primary);
            background: rgba(67, 97, 238, 0.05);
            transform: translateX(4px);
        }

        .option-item.selected {
            border-color: var(--primary);
            background: rgba(67, 97, 238, 0.1);
        }

        .option-letter {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: var(--primary);
            border: 1px solid #dee2e6;
            flex-shrink: 0;
        }

        .option-item.selected .option-letter {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .option-text {
            flex: 1;
            font-size: 0.95rem;
            line-height: 1.4;
            color: var(--dark);
        }

        /* Navigation Buttons */
        .nav-buttons {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            margin-top: 1rem;
        }

        .btn-nav {
            padding: 0.85rem 1.5rem;
            border: none;
            border-radius: 40px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }

        .btn-prev {
            background: #f0f0f0;
            color: var(--dark);
        }

        .btn-prev:hover:not(:disabled) {
            background: #e0e0e0;
            transform: translateX(-2px);
        }

        .btn-next {
            background: var(--primary);
            color: white;
        }

        .btn-next:hover:not(:disabled) {
            background: var(--primary-dark);
            transform: translateX(2px);
        }

        .btn-submit {
            background: var(--success);
            color: white;
        }

        .btn-submit:hover {
            background: #05b88a;
            transform: scale(1.02);
        }

        .btn-nav:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        /* Result Card */
        .result-card {
            text-align: center;
            padding: 0rem;
        }

        .result-score {
            font-size: 4rem;
            font-weight: bold;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin: 1rem 0;
        }

        .result-message {
            font-size: 1.2rem;
            color: var(--dark);
            margin-bottom: 1rem;
        }

        .result-detail {
            background: var(--light);
            padding: 1rem;
            border-radius: 16px;
            margin: 1rem 0;
            text-align: left;
            max-height: 300px;
            overflow-y: auto;
        }

        .result-item {
            padding: 0.75rem;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            gap: 0.75rem;
            align-items: flex-start;
        }

        .result-item:last-child {
            border-bottom: none;
        }

        .result-item.correct i {
            color: var(--success);
        }

        .result-item.wrong i {
            color: var(--danger);
        }

        .btn-restart {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.85rem 2rem;
            border-radius: 40px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .btn-restart:hover {
            background: var(--primary-dark);
            transform: scale(1.02);
        }

        /* Responsive */
        @media (max-width: 640px) {
            .quiz-header {
                padding: 1rem 1.25rem;
            }

            .quiz-header h1 {
                font-size: 1.2rem;
            }

            .quiz-body {
                padding: 1.25rem;
            }

            .question-text {
                font-size: 1.1rem;
            }

            .option-item {
                padding: 0.75rem;
            }

            .option-text {
                font-size: 0.85rem;
            }

            .btn-nav {
                padding: 0.7rem 1.2rem;
                font-size: 0.8rem;
            }

            .nav-buttons {
                flex-wrap: wrap;
            }

            .btn-nav {
                flex: 1;
                justify-content: center;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .quiz-card {
            animation: fadeIn 0.4s ease-out;
        }

        .footer-note {
            text-align: center;
            padding: 1rem;
            color: var(--gray);
            font-size: 0.8rem;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="quiz-wrapper">
                    <div class="quiz-card">
                        <div class="quiz-header">
                            <img src="{{ asset('dashboard_assets/assets/images/logo/logo.png') }}" alt="" width="10%">
                            <br>
                            <div class="badge-info">
                                <i class="fas fa-graduation-cap"></i> TOX-GONE Detector
                            </div>
                            <br>
                            <div class="badge-info">
                                <i class="fas fa-info-circle"></i> (Toxic Organic and Xenobiotic Gauge for Ongoing Natural Emergencies)
                            </div>
                        </div>

                        <div class="quiz-body" id="quizApp">
                            <!-- Dynamic content will be rendered here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('own_script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        // ==================== DATA KUIS ====================
        const originalQuestions = [{
                text: "Bahan rumah tangga yang paling efektif digunakan pada detektor debu buatan sendiri (kartu debu) untuk memerangkap partikel halus di udara adalah...",
                options: ["Minyak goreng", "Vaseline (Petroleum Jelly)", "Air gula", "Sabun cair"],
                correct: 1,
                explanation: "Vaseline memiliki tekstur lengket yang efektif memerangkap partikel debu halus di udara."
            },
            {
                text: "Pada pembuatan detektor debu sederhana, mengapa area pengamatan biasanya dibatasi dalam bentuk lingkaran atau kotak standar?",
                options: [
                    "Agar kartu tidak mudah robek",
                    "Untuk estetika atau keindahan kartu",
                    "Mempermudah penghitungan jumlah partikel per satuan luas",
                    "Menghindari kartu terbang tertiup angin"
                ],
                correct: 2,
                explanation: "Area standar memungkinkan perhitungan konsentrasi partikel per satuan luas secara akurat."
            },
            {
                text: "Komponen elektronik yang berfungsi memancarkan cahaya untuk mendeteksi kepadatan debu pada detektor polusi digital (seperti Arduino) adalah...",
                options: ["Sensor Suhu", "Sensor Ultrasonik", "Sensor Laser atau Infra Merah", "Sensor Kelembapan"],
                correct: 2,
                explanation: "Sensor laser atau inframerah memancarkan cahaya yang akan terhambur oleh partikel debu."
            },
            {
                text: "Tisu putih yang ditempelkan pada ujung knalpot kendaraan selama beberapa menit merupakan detektor sederhana untuk melihat adanya polutan berupa...",
                options: ["Gas Karbon Monoksida (CO)", "Partikulat padat atau jelaga karbon", "Gas Nitrogen Dioksida (NO2)", "Oksigen (O2)"],
                correct: 1,
                explanation: "Jelaga karbon akan meninggalkan noda hitam pada tisu putih."
            },
            {
                text: "Kapas yang dipasang pada botol plastik yang dihubungkan dengan pompa vakum (sebagai simulasi paru-paru) berfungsi untuk...",
                options: [
                    "Mendinginkan udara yang masuk",
                    "Menghasilkan energi listrik",
                    "Menyaring dan memerangkap polutan fisik agar bisa diamati",
                    "Mengukur suhu udara secara akurat"
                ],
                correct: 2,
                explanation: "Kapas berfungsi sebagai filter sederhana untuk memerangkap partikel debu."
            },
            {
                text: "Penggunaan ekstrak tanaman seperti kunyit atau kol ungu sebagai alat deteksi polusi air hujan bertujuan untuk mengetahui tingkat...",
                options: ["Kecepatan angin", "Keasaman (pH) akibat gas sulfur", "Kecerahan cahaya matahari", "Tekanan udara"],
                correct: 1,
                explanation: "Kunyit dan kol ungu mengandung antosianin yang berubah warna sesuai pH."
            },
            {
                text: "Dalam merakit detektor polusi digital, alat yang digunakan untuk menyambungkan antar komponen tanpa perlu proses penyolderan permanen disebut...",
                options: ["Motherboard", "Solder Station", "Breadboard", "Multimeter"],
                correct: 2,
                explanation: "Breadboard memungkinkan rangkaian prototyping tanpa solder."
            },
            {
                text: "Mengapa detektor debu handmade harus diletakkan di tempat yang terlindung dari air hujan?",
                options: [
                    "Karena debu tidak ada saat hujan",
                    "Air hujan dapat membilas partikel yang sudah menempel pada perekat",
                    "Air hujan mengandung listrik yang merusak kartu",
                    "Agar warna kartu tidak pudar"
                ],
                correct: 1,
                explanation: "Air hujan akan menghanyutkan partikel debu yang sudah terperangkap."
            },
            {
                text: "Fungsi pemasangan kipas kecil (fan) pada kotak detektor polusi udara berbasis sensor adalah...",
                options: [
                    "Menurunkan suhu ruangan",
                    "Menghalau serangga masuk ke sensor",
                    "Memastikan sirkulasi sampel udara melewati sensor secara konsisten",
                    "Sebagai penghias alat agar terlihat modern"
                ],
                correct: 2,
                explanation: "Kipas membantu aliran udara konstan menuju sensor untuk pembacaan akurat."
            },
            {
                text: "Indikator alami (Bio-indikator) yang sering digunakan untuk mendeteksi polusi udara secara jangka panjang di batang pohon adalah...",
                options: ["Lumut kerak (Lichen)", "Rumput teki", "Jamur kuping", "Benalu"],
                correct: 0,
                explanation: "Lumut kerak sensitif terhadap polusi udara, terutama SO2."
            }
        ];

        // ==================== SHUFFLE FUNCTION ====================
        function shuffleArray(arr) {
            for (let i = arr.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [arr[i], arr[j]] = [arr[j], arr[i]];
            }
            return arr;
        }

        // ==================== STATE MANAGEMENT ====================
        let currentQuestions = [];
        let userAnswers = [];
        let currentIndex = 0;
        let quizSubmitted = false;
        let score = 0;

        // Shuffle questions on load
        function initQuiz() {
            currentQuestions = shuffleArray([...originalQuestions]);
            userAnswers = new Array(currentQuestions.length).fill(null);
            currentIndex = 0;
            quizSubmitted = false;
            render();
        }

        // Render current view
        function render() {
            const app = document.getElementById('quizApp');
            if (!app) return;

            if (quizSubmitted) {
                renderResult(app);
            } else {
                renderQuestion(app);
            }
        }

        function renderQuestion(container) {
            const q = currentQuestions[currentIndex];
            const total = currentQuestions.length;
            const currentAnswer = userAnswers[currentIndex];
            const progressPercent = ((currentIndex + 1) / total) * 100;

            let optionsHtml = '';
            const letters = ['A', 'B', 'C', 'D'];

            q.options.forEach((opt, idx) => {
                let additionalClass = '';
                if (currentAnswer !== null && currentAnswer === idx) {
                    additionalClass = 'selected';
                }
                optionsHtml += `
                    <div class="option-item ${additionalClass}" data-opt-index="${idx}">
                        <div class="option-letter">${letters[idx]}</div>
                        <div class="option-text">${escapeHtml(opt)}</div>
                    </div>
                `;
            });

            const html = `
                <div class="progress-wrapper">
                    <div class="progress-stats">
                        <span><i class="fas fa-question-circle"></i> Pertanyaan ${currentIndex + 1} dari ${total}</span>
                        <span><i class="fas fa-check-circle"></i> Terjawab: ${userAnswers.filter(a => a !== null).length}</span>
                    </div>
                    <div class="progress-bar-custom">
                        <div class="progress-fill" style="width: ${progressPercent}%;"></div>
                    </div>
                </div>

                <div class="question-number">
                    <span><i class="fas fa-tag"></i> Soal #${currentIndex + 1}</span>
                    <span class="shuffle-badge"><i class="fas fa-random"></i> Soal diacak</span>
                </div>

                <div class="question-text">
                    ${escapeHtml(q.text)}
                </div>

                <div class="options-list" id="optionsList">
                    ${optionsHtml}
                </div>

                <div class="nav-buttons">
                    <button class="btn-nav btn-prev" id="prevBtn" ${currentIndex === 0 ? 'disabled' : ''}>
                        <i class="fas fa-arrow-left"></i> Sebelumnya
                    </button>
                    ${currentIndex === total - 1 ? 
                        `<button class="btn-nav btn-submit" id="submitBtn">
                            <i class="fas fa-check-circle"></i> Selesai & Lihat Hasil
                        </button>` :
                        `<button class="btn-nav btn-next" id="nextBtn">
                            Selanjutnya <i class="fas fa-arrow-right"></i>
                        </button>`
                    }
                </div>
            `;

            container.innerHTML = html;

            // Attach event listeners
            document.querySelectorAll('.option-item').forEach(opt => {
                opt.addEventListener('click', () => {
                    if (quizSubmitted) return;
                    const optIndex = parseInt(opt.dataset.optIndex);
                    userAnswers[currentIndex] = optIndex;
                    render();
                });
            });

            const prevBtn = document.getElementById('prevBtn');
            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    if (currentIndex > 0) {
                        currentIndex--;
                        render();
                    }
                });
            }

            const nextBtn = document.getElementById('nextBtn');
            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    if (currentIndex < total - 1) {
                        currentIndex++;
                        render();
                    }
                });
            }

            const submitBtn = document.getElementById('submitBtn');
            if (submitBtn) {
                submitBtn.addEventListener('click', () => {
                    const unanswered = userAnswers.filter(a => a === null).length;
                    if (unanswered > 0) {
                        if (confirm(`Masih ada ${unanswered} soal yang belum dijawab. Tetap ingin mengakhiri kuis?`)) {
                            calculateScore();
                            quizSubmitted = true;
                            render();
                        }
                    } else {
                        calculateScore();
                        quizSubmitted = true;
                        render();
                    }
                });
            }
        }

        function calculateScore() {
            score = 0;
            for (let i = 0; i < currentQuestions.length; i++) {
                if (userAnswers[i] !== null && userAnswers[i] === currentQuestions[i].correct) {
                    score++;
                }
            }
        }

        function renderResult(container) {
            const total = currentQuestions.length;
            const percentage = Math.round((score / total) * 100);
            let message = '';
            let icon = '';

            if (percentage >= 80) {
                message = 'Luar biasa! 🎉 Anda menguasai materi detektor polutan dengan sangat baik!';
                icon = '🎓';
            } else if (percentage >= 60) {
                message = 'Good job! 👍 Pelajari lagi soal yang salah untuk pemahaman lebih mendalam.';
                icon = '📚';
            } else {
                message = 'Tetap semangat! 💪 Coba lagi dan pelajari penjelasan di bawah ini.';
                icon = '🌱';
            }

            let resultDetailsHtml = '';
            for (let i = 0; i < currentQuestions.length; i++) {
                const q = currentQuestions[i];
                const userAnswer = userAnswers[i];
                const isCorrect = userAnswer === q.correct;
                const userLetter = userAnswer !== null ? String.fromCharCode(65 + userAnswer) : '-';
                const correctLetter = String.fromCharCode(65 + q.correct);
                
                resultDetailsHtml += `
                    <div class="result-item ${isCorrect ? 'correct' : 'wrong'}">
                        <div style="min-width: 30px;">
                            <i class="fas ${isCorrect ? 'fa-check-circle' : 'fa-times-circle'}"></i>
                        </div>
                        <div style="flex:1">
                            <strong>Soal ${i+1}</strong><br>
                            <small>${escapeHtml(q.text.substring(0, 100))}${q.text.length > 100 ? '...' : ''}</small><br>
                            <small class="text-muted">Jawaban Anda: ${userLetter} | Benar: ${correctLetter}</small>
                            ${!isCorrect ? `<div class="mt-1"><small class="text-success"><i class="fas fa-lightbulb"></i> ${escapeHtml(q.explanation)}</small></div>` : ''}
                        </div>
                    </div>
                `;
            }

            const html = `
                <div class="result-card">
                    <i class="fas fa-chart-line" style="font-size: 3rem; color: var(--primary);"></i>
                    <div class="result-score">
                        ${score} / ${total}
                    </div>
                    <div class="result-message">
                        ${icon} ${message}
                    </div>
                    <div class="progress-wrapper">
                        <div class="progress-bar-custom">
                            <div class="progress-fill" style="width: ${percentage}%; background: linear-gradient(90deg, var(--success), var(--primary));"></div>
                        </div>
                        <div class="progress-stats mt-2">
                            <span>Nilai: ${percentage}%</span>
                            <span>${percentage >= 70 ? '✨ Lulus' : '📖 Perlu Belajar Lagi'}</span>
                        </div>
                    </div>

                    <div class="result-detail">
                        <strong><i class="fas fa-list-ul"></i> Rincian Jawaban:</strong>
                        ${resultDetailsHtml}
                    </div>

                    <button class="btn-restart" id="restartBtn">
                        <i class="fas fa-sync-alt"></i> Kerjakan Ulang Kuis
                    </button>
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="fas fa-lightbulb"></i> Tips: Refresh halaman untuk mendapatkan urutan soal baru!
                        </small>
                    </div>
                </div>
            `;

            container.innerHTML = html;

            document.getElementById('restartBtn')?.addEventListener('click', () => {
                initQuiz();
            });
        }

        function escapeHtml(str) {
            if (!str) return '';
            return str
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;');
        }

        // Start the quiz when page loads
        $(document).ready(function() {
            initQuiz();
        });
    </script>
@endsection