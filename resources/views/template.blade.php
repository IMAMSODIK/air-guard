<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')

    <style>
        /* === FLOATING BUTTON === */
        #tanyaZoneBtn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 150px;
            height: 150px;
            background: none;
            z-index: 999999;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        #tanyaZoneBtn:hover {
            transform: scale(1.05);
        }

        #tanyaZoneBtn img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            pointer-events: none;
        }

        /* Mobile styles untuk floating button */
        @media (max-width: 768px) {
            #tanyaZoneBtn {
                width: 120px;
                height: 120px;
                bottom: 15px;
                right: 15px;
            }
        }

        @media (max-width: 480px) {
            #tanyaZoneBtn {
                width: 100px;
                height: 100px;
                bottom: 10px;
                right: 10px;
            }
        }

        /* === CHAT WINDOW === */
        #chatBox {
            position: fixed;
            bottom: 150px;
            right: 20px;
            width: 400px;
            max-height: 600px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.2);
            display: none;
            flex-direction: column;
            overflow: hidden;
            z-index: 999998;
            animation: fadeIn 0.3s ease-in-out;
        }

        /* Mobile styles untuk chat box */
        @media (max-width: 768px) {
            #chatBox {
                width: 90vw;
                max-width: 400px;
                right: 50%;
                transform: translateX(50%);
                bottom: 140px;
                max-height: 70vh;
            }
        }

        @media (max-width: 480px) {
            #chatBox {
                width: 95vw;
                max-height: 65vh;
                bottom: 130px;
                border-radius: 10px;
            }
            
            /* Fullscreen mode untuk mobile kecil */
            #chatBox.fullscreen {
                width: 100vw;
                height: 100vh;
                max-height: 100vh;
                bottom: 0;
                right: 0;
                border-radius: 0;
                transform: none;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #chatHeader {
            background: linear-gradient(135deg, #4fc3f7, #0288d1);
            color: white;
            padding: 14px;
            font-weight: bold;
            text-align: center;
            position: relative;
            user-select: none;
        }

        /* Mobile styles untuk header */
        @media (max-width: 480px) {
            #chatHeader {
                padding: 12px;
                font-size: 14px;
            }
        }

        /* Close button untuk mobile */
        .close-chat {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        @media (max-width: 768px) {
            .close-chat {
                display: flex;
            }
        }

        #chatMessages {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background: #f6f6f6;
            min-height: 200px;
        }

        /* Mobile styles untuk chat messages */
        @media (max-width: 480px) {
            #chatMessages {
                padding: 12px;
                min-height: 150px;
            }
        }

        .message {
            margin-bottom: 10px;
            line-height: 1.4;
            word-wrap: break-word;
        }

        .user {
            text-align: right;
        }

        .user .bubble {
            display: inline-block;
            background: #0288d1;
            color: #fff;
            padding: 10px 14px;
            border-radius: 14px 14px 0 14px;
            max-width: 80%;
            word-break: break-word;
        }

        .bot {
            text-align: left;
        }

        .bot .bubble {
            display: inline-block;
            background: #e9ecef;
            color: #222;
            padding: 12px 14px;
            border-radius: 14px 14px 14px 0;
            max-width: 90%;
            text-align: left;
            word-break: break-word;
        }

        /* Mobile styles untuk bubbles */
        @media (max-width: 480px) {
            .user .bubble,
            .bot .bubble {
                max-width: 85%;
                padding: 10px 12px;
                font-size: 14px;
            }
        }

        /* Styling untuk response yang diformat */
        .bot .bubble .response-content {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.5;
        }

        .bot .bubble .response-content p {
            margin: 8px 0;
        }

        .bot .bubble .response-content ul,
        .bot .bubble .response-content ol {
            margin: 8px 0;
            padding-left: 20px;
        }

        .bot .bubble .response-content li {
            margin: 4px 0;
        }

        .bot .bubble .response-content strong {
            color: #0288d1;
            font-weight: 600;
        }

        .bot .bubble .response-content h3,
        .bot .bubble .response-content h4 {
            margin: 12px 0 8px 0;
            color: #333;
            font-weight: 600;
        }

        .bot .bubble .response-content code {
            background: rgba(0, 0, 0, 0.05);
            padding: 2px 6px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
        }

        .bot .bubble .response-content blockquote {
            border-left: 4px solid #4fc3f7;
            padding-left: 12px;
            margin: 8px 0;
            color: #555;
            font-style: italic;
        }

        .bubble p {
            margin: 4px 0;
            line-height: 1.5;
        }

        .bubble ul {
            margin: 4px 0 4px 16px;
            padding-left: 14px;
        }

        .bubble li {
            margin-bottom: 4px;
        }

        .bubble b {
            color: #111;
        }

        #chatInput {
            display: flex;
            border-top: 1px solid #ddd;
            background: white;
        }

        #chatInput input {
            flex: 1;
            border: none;
            padding: 12px;
            outline: none;
            font-size: 14px;
            background: transparent;
        }

        #chatInput button {
            background: #0288d1;
            color: white;
            border: none;
            padding: 12px 16px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.2s ease;
            white-space: nowrap;
        }

        #chatInput button:hover {
            background: #0277bd;
        }

        /* Mobile styles untuk input area */
        @media (max-width: 480px) {
            #chatInput input {
                padding: 10px;
                font-size: 16px; /* Mencegah zoom di iOS */
            }
            
            #chatInput button {
                padding: 10px 14px;
                font-size: 14px;
            }
        }

        /* Typing indicator */
        .typing-indicator {
            display: none;
            padding: 10px 14px;
            background: #e9ecef;
            border-radius: 14px 14px 14px 0;
            margin-bottom: 10px;
            width: fit-content;
        }

        .typing-dots {
            display: flex;
            gap: 4px;
        }

        .typing-dot {
            width: 6px;
            height: 6px;
            background: #888;
            border-radius: 50%;
            animation: typingAnimation 1.4s infinite ease-in-out;
        }

        .typing-dot:nth-child(1) { animation-delay: -0.32s; }
        .typing-dot:nth-child(2) { animation-delay: -0.16s; }

        @keyframes typingAnimation {
            0%, 80%, 100% { transform: scale(0.8); opacity: 0.5; }
            40% { transform: scale(1); opacity: 1; }
        }

        /* Scrollbar styling */
        #chatMessages::-webkit-scrollbar {
            width: 6px;
        }

        #chatMessages::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        #chatMessages::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        #chatMessages::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Backdrop untuk mobile */
        .chat-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999997;
        }

        @media (max-width: 768px) {
            .chat-backdrop.active {
                display: block;
            }
        }
    </style>
</head>

<body>
    <!-- loader starts-->
    <div class="loader-wrapper">
        <div class="loader">
            <div class="loader4"></div>
        </div>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    {{-- <div class="tap-top" style="display: none !important"><i data-feather="chevrons-up"></i></div> --}}
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->

        @include('layouts.header')

        <!-- Page Header Ends -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->

            @include('layouts.sidebar')

            <!-- Page Sidebar Ends-->


            <div class="page-body">
                @yield('content')
            </div>

            <!-- footer start-->
            @include('layouts.footer')
        </div>
    </div>

    <!-- Floating Button -->
    <div id="tanyaZoneBtn">
        <img src="{{ asset('own_assets/images/mascot.png') }}" alt="Tanya Si Tox">
    </div>
    

    <!-- Floating Chat -->
    <div id="chatBox">
        <div id="chatHeader">💬 Tanya Si Tox</div>
        <div id="chatMessages">
            <div class="message bot">
                <div class="bubble">
                    <b>Tox:</b> Halo! Tanya Si Tox siap bantu kamu 🌤️
                </div>
            </div>
        </div>
        <div id="chatInput">
            <input type="text" id="userInput" placeholder="Ketik pesan...">
            <button id="sendBtn">Kirim</button>
        </div>
    </div>


    <script>
        const tanyaBtn = document.getElementById('tanyaZoneBtn');
        const chatBox = document.getElementById('chatBox');
        const sendBtn = document.getElementById('sendBtn');
        const chatMessages = document.getElementById('chatMessages');
        const userInput = document.getElementById('userInput');
        let apiKey = "AIzaSyDstx8GDz1KJBDI9s7lHwFRvUPhesYqjX0";

        // Toggle chat visibility
        tanyaBtn.addEventListener('click', () => {
            chatBox.style.display = chatBox.style.display === 'flex' ? 'none' : 'flex';
        });

        // Handle send message
        sendBtn.addEventListener('click', sendMessage);
        userInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendMessage();
        });

        async function sendMessage() {
            const text = userInput.value.trim();
            if (!text) return;

            // Tambahkan pesan user
            appendMessage('user', text);
            userInput.value = '';

            // Tambahkan indikator mengetik
            const loadingMsg = appendMessage('bot', "Tox sedang mengetik...");

            // Gunakan model yang tersedia - Gemini 2.0 Flash
            const url =
                `https://generativelanguage.googleapis.com/v1/models/gemini-2.0-flash:generateContent?key=${apiKey}`;

            try {
                const response = await fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        contents: [{
                            role: "user",
                            parts: [{
                                text: `${text}\n\nTolong berikan response dalam format teks biasa yang terstruktur dengan baik menggunakan paragraf dan bullet points. JANGAN gunakan markdown seperti ** atau * format lainnya. Gunakan bahasa Indonesia yang jelas dan mudah dipahami serta jangan ada teks yang lebih besar dari h5 serta buatkan agar font jadi bold jika merupakan sebuah sub judul atau poin penting`
                            }]
                        }],
                        generationConfig: {
                            temperature: 0.7,
                            topP: 0.8,
                            topK: 40,
                            maxOutputTokens: 1024,
                        }
                    })
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(`API Error: ${response.status} - ${errorData.error?.message || 'Unknown error'}`);
                }

                const data = await response.json();

                if (data.candidates && data.candidates[0] && data.candidates[0].content) {
                    const rawReply = data.candidates[0].content.parts[0].text;

                    // Hapus pesan loading dan tambahkan response yang diformat
                    loadingMsg.remove();
                    appendFormattedMessage('bot', rawReply);
                } else {
                    throw new Error('Invalid response format from API');
                }

            } catch (err) {
                console.error('Error:', err);
                loadingMsg.querySelector('.bubble').innerHTML =
                    `<b>Tox:</b> Maaf, terjadi error. Silakan coba lagi.`;
            }

            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function appendMessage(sender, text) {
            const msgDiv = document.createElement('div');
            msgDiv.classList.add('message', sender);
            msgDiv.innerHTML =
                `<div class="bubble">${sender === 'user' ? '<b>Kamu:</b> ' : '<b>Tox:</b> '}${escapeHtml(text)}</div>`;
            chatMessages.appendChild(msgDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
            return msgDiv;
        }

        function appendFormattedMessage(sender, text) {
            const msgDiv = document.createElement('div');
            msgDiv.classList.add('message', sender);

            // Format teks menjadi HTML yang rapi
            const formattedContent = formatTextToHTML(text);

            msgDiv.innerHTML = `
            <div class="bubble">
                <b>Tox:</b> 
                <div class="response-content">
                    ${formattedContent}
                </div>
            </div>
        `;
            chatMessages.appendChild(msgDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
            return msgDiv;
        }

        function sanitizeText(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function formatTextToHTML(plainText) {
            if (!plainText) return '';

            // Hapus semua markdown bold/italic
            let text = plainText
                .replace(/\*\*(.*?)\*\*/g, '$1') // hilangkan **bold**
                .replace(/\*(.*?)\*/g, '$1') // hilangkan *italic*
                .replace(/#+\s?(.*)/g, '$1') // hilangkan heading (# Judul)
                .replace(/`/g, '') // hilangkan backtick

        // Pisahkan menjadi baris
        const lines = text.split(/\n+/).map(line => line.trim()).filter(Boolean);
        let html = '';
        let inList = false;

        for (let line of lines) {
            // Deteksi bullet list
            if (/^[-•]\s+/.test(line)) {
                if (!inList) {
                    html += '<ul style="margin:4px 0 4px 14px; padding-left:10px;">';
                    inList = true;
                }
                const item = line.replace(/^[-•]\s+/, '');
                html += `<li>${sanitizeText(item)}</li>`;
                continue;
            } else if (inList) {
                html += '</ul>';
                inList = false;
            }

            // Deteksi subjudul diakhiri titik dua
            if (/[:：]$/.test(line)) {
                html += `<p><b>${sanitizeText(line)}</b></p>`;
            } else {
                html += `<p>${sanitizeText(line)}</p>`;
            }
        }
        if (inList) html += '</ul>';

        return html;
    }

    function removeMarkdown(text) {
        // Hapus semua tanda markdown **teks** dan ganti dengan <strong>teks</strong>
        return text
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
            .replace(/\*(.*?)\*/g, '<em>$1</em>')
            .replace(/`(.*?)`/g, '<code>$1</code>')
            .replace(/```html/g, '')
                .replace(/```/g, '')
            .trim();
    }

    function isHeading(line) {
        // Deteksi apakah line kemungkinan sebuah heading
        return (
            (line.length < 60 && !line.includes('. ') && !line.includes(', ')) ||
            /^[A-Z][A-Z\s]+$/.test(line) ||
            /^(Penjelasan|Definisi|Fungsi|Manfaat|Jenis|Contoh|Kesimpulan)/i.test(line)
        );
    }

    function highlightImportantWords(line) {
        // Daftar kata penting yang akan di-bold
        const importantWords = [
            'cuaca', 'iklim', 'suhu', 'kelembapan', 'tekanan udara', 'angin',
            'curah hujan', 'awan', 'radiasi matahari', 'sirkulasi atmosfer',
            'arus laut', 'topografi', 'prakiraan', 'prediksi', 'klimatologi',
            'meteorologi', 'presipitasi', 'evaporasi', 'kondensasi'
        ];

        let result = line;

        // Bold kata-kata penting
        importantWords.forEach(word => {
            const regex = new RegExp(`\\b${word}\\b`, 'gi');
            result = result.replace(regex, `<strong style="color: #0288d1;">$&</strong>`);
            });

            return result;
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
    </script>

    @include('layouts.script')
</body>

</html>
