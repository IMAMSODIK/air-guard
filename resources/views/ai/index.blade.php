@extends('template')

@section('own_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            /* background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 16px; */
        }

        .chat-container {
            width: 100%;
            max-width: 1400px;
            height: 90vh;
            background: #006666;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            display: flex;
            overflow: hidden;
        }

        /* Sidebar */
        .sidebar-ai {
            width: 260px;
            background: var(--primary-color);
            color: white;
            display: flex;
            flex-direction: column;
            border-right: 1px solid var(--border-color);
            transition: transform 0.3s ease;
        }

        .new-chat-btn {
            margin: 16px;
            padding: 12px 16px;
            background: transparent;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .new-chat-btn:hover {
            background: var(--dark-bg);
        }

        .new-chat-btn svg {
            width: 16px;
            height: 16px;
        }

        .chat-history {
            flex: 1;
            overflow-y: auto;
            padding: 8px;
        }

        .history-item {
            padding: 12px;
            margin: 4px 0;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            color: var(--text-light);
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .history-item:hover {
            background: var(--dark-bg);
        }

        .history-item svg {
            width: 16px;
            height: 16px;
            opacity: 0.6;
            flex-shrink: 0;
        }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid var(--border-color);
            font-size: 12px;
            color: #9ca3af;
        }

        /* Main Chat Area */
        .chat-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: var(--primary-color);
            position: relative;
        }

        .chat-header {
            padding: 16px;
            border-bottom: 1px solid var(--border-color);
            text-align: center;
            color: white;
            font-size: 28px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            padding: 4px 8px;
        }

        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            background: var(--light-bg) !important;
            color: var(--text-dark) !important;
        }

        .message {
            display: flex;
            gap: 16px;
            max-width: 100%;
            padding: 16px 20px;
        }

        .message.user {
            background: #eaeaea;
            color: var(--text-dark) !important;
        }

        .message.assistant {
            background: var(--primary-color);
            color: white;
        }

        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
            flex-shrink: 0;
        }

        .user .avatar {
            background: var(--secondary-color);
            color: white;
        }

        .assistant .avatar {
            background: #5436da;
            color: white;
        }

        .user .message-content {
            color: var(--text-dark) !important;
        }

        .message-content {
            flex: 1;
            color: #2e2e2e;
            line-height: 1.6;
            font-size: 15px;
            padding: 5px;
        }

        .message-content p {
            margin-bottom: 12px;
        }

        .message-content p:last-child {
            margin-bottom: 0;
        }

        .message-content ul,
        .message-content ol {
            margin: 12px 0;
            padding-left: 24px;
        }

        .message-content li {
            margin: 6px 0;
        }

        .message-content strong {
            color: #2e2e2e;
            font-weight: 600;
        }

        .message-content code {
            background: var(--dark-bg);
            padding: 2px 6px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
            color: #2e2e2e;
        }

        .message-content pre {
            background: var(--dark-bg);
            padding: 16px;
            border-radius: 8px;
            overflow-x: auto;
            margin: 12px 0;
        }

        .message-content blockquote {
            border-left: 4px solid var(--secondary-color);
            padding-left: 16px;
            margin: 12px 0;
            color: #9ca3af;
            font-style: italic;
        }

        .message.assistant .message-content {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px 16px;
            line-height: 1.6;
            font-size: 15px;
            max-width: 85%;
            word-wrap: break-word;
            white-space: pre-wrap;
            margin-bottom: 10px;
        }

        .message.assistant .message-content p {
            margin: 0 0 10px 0;
        }

        .message.assistant .message-content ul,
        .message.assistant .message-content ol {
            margin: 6px 0 10px 20px;
            padding-left: 18px;
        }

        .message.assistant .message-content li {
            margin-bottom: 4px;
        }

        .message.assistant .message-content strong {
            display: block;
            font-weight: 600;
            margin-top: 8px;
            color: #2e2e2e;
        }

        /* Input Area */
        .chat-input-container {
            padding: 20px;
            border-top: 1px solid var(--border-color);
        }

        .input-wrapper {
            position: relative;
            max-width: 768px;
            margin: 0 auto;
        }

        .chat-input {
            width: 100%;
            background: white;
            border: 1px solid #565869;
            border-radius: 12px;
            padding: 16px 48px 16px 16px;
            color: black;
            font-size: 15px;
            resize: none;
            min-height: 56px;
            max-height: 200px;
            outline: none;
            line-height: 1.5;
        }

        .chat-input:focus {
            border-color: var(--secondary-color);
        }

        .chat-input::placeholder {
            color: #2e2e2e;
        }

        .send-button {
            position: absolute;
            right: 12px;
            bottom: 17px;
            background: var(--secondary-color);
            border: none;
            border-radius: 6px;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #2e2e2e;
            transition: all 0.2s;
        }

        .send-button:hover {
            background: #0d8c6d;
        }

        .send-button:disabled {
            background: #565869;
            cursor: not-allowed;
        }

        .send-button svg {
            width: 16px;
            height: 16px;
        }

        /* Typing Indicator */
        .typing-indicator {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #2e2e2e;
            font-size: 14px;
            padding: 16px 0;
        }

        .typing-dots {
            display: flex;
            gap: 4px;
        }

        .typing-dot {
            width: 6px;
            height: 6px;
            background: #9ca3af;
            border-radius: 50%;
            animation: typing 1.4s infinite ease-in-out;
        }

        .typing-dot:nth-child(1) {
            animation-delay: -0.32s;
        }

        .typing-dot:nth-child(2) {
            animation-delay: -0.16s;
        }

        @keyframes typing {
            0%, 80%, 100% {
                transform: scale(0.8);
                opacity: 0.5;
            }
            40% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Welcome Screen */
        .welcome-screen {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--text-light);
            padding: 40px;
        }

        .welcome-icon {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .welcome-title {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 16px;
            color: black;
        }

        .welcome-subtitle {
            font-size: 16px;
            margin-bottom: 32px;
            color: #424242;
            max-width: 600px;
            line-height: 1.5;
        }

        .capabilities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
            max-width: 800px;
            margin-top: 32px;
        }

        .capability-card {
            background: var(--primary-color);
            padding: 20px;
            border-radius: 12px;
            text-align: left;
            border: 2px solid #006666;
        }

        .capability-card h4 {
            color: #2e2e2e;
            margin-bottom: 8px;
            font-size: 16px;
        }

        .capability-card p {
            color: #2e2e2e;
            font-size: 14px;
            line-height: 1.5;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #565869;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #6e6e7c;
        }

        /* Responsive Styles */
        @media (max-width: 1024px) {
            .chat-container {
                height: 95vh;
            }
            
            .sidebar-ai {
                width: 220px;
            }
            
            .message.assistant .message-content {
                max-width: 90%;
            }
        }

        @media (max-width: 768px) {
            .chat-container {
                height: 100vh;
                border-radius: 0;
            }
            
            .sidebar-ai {
                position: absolute;
                top: 0;
                left: 0;
                bottom: 0;
                z-index: 10;
                transform: translateX(-100%);
            }
            
            .sidebar-ai.active {
                transform: translateX(0);
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .chat-messages {
                padding: 16px;
            }
            
            .message {
                padding: 12px 16px;
                gap: 12px;
            }
            
            .message.assistant .message-content {
                max-width: 95%;
            }
            
            .welcome-screen {
                padding: 20px;
            }
            
            .welcome-title {
                font-size: 24px;
            }
            
            .welcome-subtitle {
                font-size: 14px;
            }
            
            .capabilities-grid {
                grid-template-columns: 1fr;
                gap: 12px;
                margin-top: 24px;
            }
            
            .capability-card {
                padding: 16px;
            }
            
            .chat-input-container {
                padding: 16px;
            }
        }

        @media (max-width: 480px) {
            .chat-messages {
                padding: 12px;
            }
            
            .message {
                padding: 10px 12px;
                gap: 8px;
            }
            
            .avatar {
                width: 28px;
                height: 28px;
                font-size: 12px;
            }
            
            .message-content {
                font-size: 14px;
            }
            
            .message.assistant .message-content {
                padding: 10px 12px;
                font-size: 14px;
                max-width: 100%;
            }
            
            .welcome-title {
                font-size: 20px;
            }
            
            .welcome-subtitle {
                font-size: 13px;
            }
            
            .capability-card h4 {
                font-size: 14px;
            }
            
            .capability-card p {
                font-size: 13px;
            }
            
            .chat-input {
                padding: 12px 40px 12px 12px;
                min-height: 48px;
                font-size: 14px;
            }
            
            .send-button {
                right: 8px;
                bottom: 12px;
                width: 28px;
                height: 28px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="chat-container">
            <!-- Sidebar -->
            <div class="sidebar-ai">
                <button class="new-chat-btn" onclick="newChat()">
                    <svg viewBox="0 0 16 16" fill="currentColor">
                        <path
                            d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    New Chat
                </button>

                <div class="chat-history">
                    <div class="history-item" data-chat-id="1">
                        <svg viewBox="0 0 16 16" fill="currentColor">
                            <path
                                d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9V1z" />
                        </svg>
                        Penjelasan tentang cuaca
                    </div>
                    <div class="history-item" data-chat-id="2">
                        <svg viewBox="0 0 16 16" fill="currentColor">
                            <path
                                d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm12-1v14h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zm-1 0H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h9V1z" />
                        </svg>
                        Cara prediksi iklim
                    </div>
                </div>

                <div class="sidebar-footer">
                    Tanya Si Zone v1.0<br>
                    Created By: <br> <strong>AirZone Team (SMA N 1 Medan)</strong>
                </div>
            </div>

            <!-- Main Chat Area -->
            <div class="chat-main">
                <div class="chat-header">
                    Si Zone AI
                </div>

                <div class="chat-messages" id="chatMessagesZone">
                    <!-- Welcome Screen -->
                    <div class="welcome-screen" id="welcomeScreen">
                        <div class="welcome-icon">
                            <img src="{{ asset('own_assets/images/mascot.png') }}" width="100px" alt="Tanya Si Zone">
                        </div>
                        <h1 class="welcome-title">Halo! Saya Si Zone</h1>
                        <p class="welcome-subtitle">
                            Asisten AI Anda yang siap membantu menjawab pertanyaan tentang
                            cuaca, iklim,
                            dan berbagai topik lainnya. Tanyakan apa saja!
                        </p>

                        <div class="capabilities-grid">
                            <div class="capability-card">
                                <h4>💡 Penjelasan Mendalam</h4>
                                <p>Dapatkan penjelasan detail tentang konsep cuaca dan iklim
                                    dengan bahasa yang mudah dipahami.</p>
                            </div>
                            <div class="capability-card">
                                <h4>🔍 Analisis Data</h4>
                                <p>Bantu menganalisis data cuaca dan memberikan insight yang
                                    berguna.</p>
                            </div>
                            <div class="capability-card">
                                <h4>📚 Rekomendasi</h4>
                                <p>Berikan saran dan rekomendasi berdasarkan kondisi cuaca
                                    terkini.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Chat messages will be inserted here -->
                </div>

                <!-- Input Area -->
                <div class="chat-input-container">
                    <div class="input-wrapper">
                        <textarea class="chat-input" id="userInputZone" placeholder="Tanyakan sesuatu kepada Si Zone..." rows="1"
                            oninput="autoResize(this)"></textarea>
                        <button class="send-button" id="sendBtnZone" onclick="sendMessage()">
                            <svg viewBox="0 0 16 16" fill="currentColor">
                                <path
                                    d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('own_script')
    <script>
        const chatMessagesZone = document.getElementById('chatMessagesZone');
        const welcomeScreen = document.getElementById('welcomeScreen');
        const userInputZone = document.getElementById('userInputZone');
        const sendBtnZone = document.getElementById('sendBtnZone');
        let apiKeyZone = "AIzaSyDstx8GDz1KJBDI9s7lHwFRvUPhesYqjX0";
        let currentChat = [];

        // Gunakan event delegation untuk element yang mungkin belum ada
        $(document).on("click", ".history-item", function() {
            const id = $(this).data('chat-id'); // Deklarasi const/let
            const chatTitle = $(this).text().trim(); // Ambil judul dari teks

            // Pastikan element userInputZone ada
            if (window.userInputZone && userInputZone.value !== undefined) {
                userInputZone.value = chatTitle;

                // Pastikan sendMessage tersedia
                if (typeof sendMessage === 'function') {
                    sendMessage();
                } else {
                    console.error('sendMessage function not found');
                }
            } else {
                console.error('userInputZone element not found');
            }
        });

        // Auto-resize textarea
        function autoResize(textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = Math.min(textarea.scrollHeight, 200) + 'px';
        }

        // New chat function
        function newChat() {
            currentChat = [];
            chatMessagesZone.innerHTML = '';
            welcomeScreen.style.display = 'flex';
            userInputZone.value = '';
            userInputZone.focus();
        }

        // Send message function
        async function sendMessage() {
            const text = userInputZone.value.trim();
            if (!text) return;

            // Hide welcome screen
            welcomeScreen.style.display = 'none';

            // Add user message
            addMessage('user', text);
            userInputZone.value = '';
            autoResize(userInputZone);

            // Add typing indicator
            const typingIndicator = addTypingIndicator();

            try {
                const response = await fetch(
                    `https://generativelanguage.googleapis.com/v1/models/gemini-2.0-flash:generateContent?key=${apiKeyZone}`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            contents: [{
                                role: "user",
                                parts: [{
                                    text: `${text}\n\nTolong berikan response dalam format teks biasa yang terstruktur dengan baik menggunakan paragraf dan bullet points. JANGAN gunakan markdown seperti ** atau format lainnya. Gunakan bahasa Indonesia yang jelas dan mudah dipahami.`
                                }]
                            }],
                            generationConfig: {
                                temperature: 0.7,
                                topP: 0.8,
                                topK: 40,
                                maxOutputTokens: 1024,
                            }
                        })
                    }
                );

                const data = await response.json();

                // Remove typing indicator
                typingIndicator.remove();

                if (data.candidates && data.candidates[0] && data.candidates[0].content) {
                    const reply = data.candidates[0].content.parts[0].text;
                    addMessage('assistant', reply);
                } else {
                    throw new Error('Invalid response format');
                }

            } catch (err) {
                console.error('Error:', err);
                typingIndicator.remove();
                addMessage('assistant', 'Maaf, terjadi kesalahan. Silakan coba lagi.');
            }
        }

        // Add message to chat
        function addMessage(role, content) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${role}`;

            const avatar = role === 'user' ? '😊' : '🌤️';
            const avatarClass = role === 'user' ? 'user' : 'assistant';

            const formattedContent = formatMessage(content);

            messageDiv.innerHTML = `
                <div class="avatar ${avatarClass}">${avatar}</div>
                <div class="message-content">${formattedContent}</div>
            `;

            chatMessagesZone.appendChild(messageDiv);
            chatMessagesZone.scrollTop = chatMessagesZone.scrollHeight;

            // Add to current chat
            currentChat.push({
                role,
                content
            });
        }

        // Add typing indicator
        function addTypingIndicator() {
            const typingDiv = document.createElement('div');
            typingDiv.className = 'message assistant';
            typingDiv.innerHTML = `
                <div class="avatar assistant">🌤️</div>
                <div class="typing-indicator">
                    <span>Si Zone sedang mengetik</span>
                    <div class="typing-dots">
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                    </div>
                </div>
            `;
            chatMessagesZone.appendChild(typingDiv);
            chatMessagesZone.scrollTop = chatMessagesZone.scrollHeight;
            return typingDiv;
        }

        // Format message content
        // Format message content agar lebih rapi dan mudah dibaca
        function formatMessage(text) {
            if (!text) return "";

            // Escape karakter HTML agar aman
            let safeText = text
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;");

            // Deteksi subjudul (kalimat diakhiri titik dua atau diapit tanda **)
            safeText = safeText.replace(
                /(^|\n)([A-Z][^:\n]{2,}):/g,
                "$1<strong>$2:</strong>"
            );

            // Ubah bullet list (- atau •)
            safeText = safeText.replace(
                /(?:^|\n)[•\-]\s(.*?)(?=\n|$)/g,
                "<li>$1</li>"
            );

            // Ubah numbered list (1., 2., dst)
            safeText = safeText.replace(
                /(?:^|\n)\d+\.\s(.*?)(?=\n|$)/g,
                "<li>$1</li>"
            );

            // Bungkus list item dengan <ul> atau <ol>
            safeText = safeText
                .replace(/(<li>.*<\/li>)/gs, "<ul>$1</ul>")
                .replace(/<\/ul>\s*<ul>/g, "");

            // Pisahkan paragraf
            safeText = safeText
                .split(/\n{2,}/)
                .map(p => `<p>${p.trim()}</p>`)
                .join("");

            // Rapikan spasi kosong
            safeText = safeText.replace(/\s{2,}/g, " ");

            return safeText;
        }


        // Render existing chat
        function renderChat() {
            chatMessagesZone.innerHTML = '';
            currentChat.forEach(msg => {
                addMessage(msg.role, msg.content);
            });
        }

        // Enter key to send message
        userInputZone.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        // Focus input on load
        userInputZone.focus();
    </script>
@endsection
