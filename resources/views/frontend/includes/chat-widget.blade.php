<!-- Place this in your main layout file -->
<!-- CSS -->
<style>
    /* Chat Widget Styles */
    .botman-widget {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
    }

    .chat-bubble {
        width: 60px;
        height: 60px;
        background-color: #4e73df;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .chat-bubble:hover {
        transform: scale(1.1);
    }

    .chat-bubble-icon {
        font-size: 24px;
        color: white;
    }

    .chat-options {
        position: absolute;
        bottom: 70px;
        right: 0;
        width: 200px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        display: none;
        overflow: hidden;
    }

    .chat-option {
        padding: 12px 15px;
        cursor: pointer;
        transition: background-color 0.2s;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
    }

    .chat-option:hover {
        background-color: #f5f8ff;
    }

    .chat-option-icon {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }

    /* Chat Window */
    .chat-window {
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 350px;
        height: 450px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        display: none;
        flex-direction: column;
        z-index: 9998;
        overflow: hidden;
    }

    .chat-header {
        padding: 15px;
        background-color: #4e73df;
        color: white;
        font-weight: bold;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chat-close {
        cursor: pointer;
        font-size: 18px;
    }

    .chat-body {
        flex: 1;
        overflow-y: auto;
        padding: 15px;
    }

    .chat-footer {
        padding: 10px;
        border-top: 1px solid #f0f0f0;
        display: flex;
    }

    .chat-input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 20px;
        outline: none;
    }

    .chat-send {
        margin-left: 10px;
        background-color: #4e73df;
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Message styles */
    .message {
        margin-bottom: 10px;
        max-width: 80%;
    }

    .user-message {
        margin-left: auto;
        background-color: #4e73df;
        color: white;
        border-radius: 18px 18px 0 18px;
        padding: 10px 15px;
    }

    .bot-message {
        margin-right: auto;
        background-color: #f0f0f0;
        border-radius: 18px 18px 18px 0;
        padding: 10px 15px;
    }

    /* Category list for FAQ */
    .category-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .category-item {
        padding: 10px 15px;
        cursor: pointer;
        border-bottom: 1px solid #f0f0f0;
        transition: background-color 0.2s;
    }

    .category-item:hover {
        background-color: #f5f8ff;
    }

    .question-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .question-item {
        padding: 10px 15px;
        cursor: pointer;
        border-bottom: 1px solid #f0f0f0;
        transition: background-color 0.2s;
    }

    .question-item:hover {
        background-color: #f5f8ff;
    }

    .back-button {
        display: inline-block;
        margin-bottom: 10px;
        padding: 5px 10px;
        background-color: #f0f0f0;
        border-radius: 15px;
        cursor: pointer;
    }

    /* Typing indicator */
    .typing-indicator {
        display: flex;
        padding: 10px;
    }

    .typing-indicator span {
        height: 8px;
        width: 8px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        margin: 0 2px;
        animation: typing 1s infinite;
    }

    .typing-indicator span:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-indicator span:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes typing {
        0% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
        100% { transform: translateY(0); }
    }
</style>

<!-- HTML Structure -->
<div class="botman-widget">
    <!-- Chat Bubble -->
    <div class="chat-bubble" id="chatBubble">
        <div class="chat-bubble-icon">💬</div>
    </div>

    <!-- Chat Options Menu -->
    <div class="chat-options" id="chatOptions">
        <div class="chat-option" id="openFaqBot">
            <div class="chat-option-icon">🤖</div>
            <div>Chat Bot FAQ</div>
        </div>
        <div class="chat-option" id="openCustomerService">
            <div class="chat-option-icon">👨‍💼</div>
            <div>Customer Service</div>
        </div>
        <div class="chat-option" id="openAiChat">
            <div class="chat-option-icon">🧠</div>
            <div>AI Chat</div>
        </div>
    </div>

    <!-- Chat Window - will be populated by JS -->
    <div class="chat-window" id="chatWindow">
        <div class="chat-header" id="chatHeader">
            Chat Bot
            <div class="chat-close" id="chatClose">×</div>
        </div>
        <div class="chat-body" id="chatBody">
            <!-- Messages will appear here -->
        </div>
        <div class="chat-footer" id="chatFooter">
            <input type="text" class="chat-input" id="chatInput" placeholder="Type a message...">
            <button class="chat-send" id="chatSend">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13"></line>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                </svg>
            </button>
        </div>
    </div>
</div>

<!-- Load all required JavaScript files -->
<script src="js/chat-bot.js"></script>
<script src="js/chat-cs.js"></script>
<script src="js/chat-ai.js"></script>
<script src="js/chat-main.js"></script>