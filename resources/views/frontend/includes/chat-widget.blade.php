<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JogjaCare Chat Widget</title>
  <style>

    /* Chat Widget Styles */
    .botman-widget {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 9999;
    }

    .chat-bubble {
      width: 70px;
      height: 70px;
      background: linear-gradient(135deg, #45b6fe 0%, #1a75ff 100%);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .chat-bubble:hover {
      transform: scale(1.05);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
    }

    .robot-container {
      width: 45px;
      height: 45px;
      position: relative;
      transform-style: preserve-3d;
      animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-5px); }
    }

    .robot-head {
      width: 30px;
      height: 25px;
      background-color: #fff;
      border-radius: 12px 12px 10px 10px;
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      box-shadow: 0 3px 5px rgba(0,0,0,0.1);
    }

    .robot-eye {
      width: 6px;
      height: 6px;
      background-color: #0084ff;
      border-radius: 50%;
      position: absolute;
      top: 10px;
    }

    .robot-eye.left {
      left: 7px;
      animation: blink 4s infinite;
    }

    .robot-eye.right {
      right: 7px;
      animation: blink 4s 0.2s infinite;
    }

    @keyframes blink {
      0%, 96%, 98% { transform: scaleY(1); }
      97% { transform: scaleY(0.1); }
    }

    .robot-body {
      width: 24px;
      height: 20px;
      background-color: #fff;
      border-radius: 5px;
      position: absolute;
      top: 22px;
      left: 50%;
      transform: translateX(-50%);
      box-shadow: 0 3px 5px rgba(0,0,0,0.1);
    }

    .robot-antenna {
      width: 2px;
      height: 6px;
      background-color: #fff;
      position: absolute;
      top: -6px;
      left: 50%;
      transform: translateX(-50%);
    }

    .robot-antenna:after {
      content: "";
      position: absolute;
      width: 4px;
      height: 4px;
      background-color: #0084ff;
      border-radius: 50%;
      top: -2px;
      left: 50%;
      transform: translateX(-50%);
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0%, 100% { transform: translateX(-50%) scale(1); opacity: 1; }
      50% { transform: translateX(-50%) scale(1.2); opacity: 0.8; }
    }

    .robot-arm {
      width: 5px;
      height: 12px;
      background-color: #fff;
      position: absolute;
      top: 27px;
      border-radius: 2px;
    }

    .robot-arm.left {
      left: 6px;
      transform: rotate(-30deg);
      transform-origin: top center;
      animation: wave 2s ease-in-out infinite;
    }

    .robot-arm.right {
      right: 6px;
      transform: rotate(30deg);
      transform-origin: top center;
    }

    @keyframes wave {
      0%, 100% { transform: rotate(-30deg); }
      50% { transform: rotate(-10deg); }
    }

    /* Speech bubble */
    .speech-bubble {
      position: absolute;
      background-color: white;
      border-radius: 20px;
      padding: 8px 15px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      top: -40px;
      right: -10px;
      font-size: 14px;
      font-weight: 600;
      color: #1a75ff;
      opacity: 0;
      transform: translateY(10px);
      transition: all 0.3s ease;
    }

    .speech-bubble:after {
      content: '';
      position: absolute;
      bottom: -6px;
      right: 20px;
      width: 12px;
      height: 12px;
      background-color: white;
      transform: rotate(45deg);
      box-shadow: 2px 2px 3px rgba(0,0,0,0.1);
    }

    .chat-bubble:hover .speech-bubble {
      opacity: 1;
      transform: translateY(0);
    }

    .chat-options {
      position: absolute;
      bottom: 80px;
      right: 0;
      width: 270px;
      background-color: white;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      display: none;
      overflow: hidden;
      transform: translateY(20px);
      opacity: 0;
      transition: all 0.3s ease;
    }

    .chat-options.active {
      transform: translateY(0);
      opacity: 1;
      display: block;
    }

    .options-header {
      padding: 15px;
      background: linear-gradient(135deg, #45b6fe 0%, #1a75ff 100%);
      color: white;
      font-weight: 600;
      font-size: 16px;
      text-align: center;
      border-radius: 15px 15px 0 0;
    }

    .options-body {
      max-height: 300px;
      overflow-y: auto;
      padding: 10px 0;
    }

    .chat-option {
      padding: 15px;
      cursor: pointer;
      transition: all 0.2s;
      border-bottom: 1px solid #f0f0f0;
      display: flex;
      align-items: center;
    }

    .chat-option:last-child {
      border-bottom: none;
    }

    .chat-option:hover {
      background-color: #f5f8ff;
    }

    .chat-option-icon {
      margin-right: 15px;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: linear-gradient(135deg, #f5f7fa 0%, #e4e9f2 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      color: #1a75ff;
    }

    .chat-option-content {
      flex: 1;
    }

    .chat-option-title {
      font-weight: 600;
      margin-bottom: 3px;
      color: #333;
    }

    .chat-option-desc {
      font-size: 12px;
      color: #777;
    }

    /* Chat Window */
    .chat-window {
      position: fixed;
      bottom: 90px;
      right: 20px;
      width: 350px;
      height: 500px;
      background-color: white;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      display: none;
      flex-direction: column;
      z-index: 9998;
      overflow: hidden;
      transform: translateY(20px);
      opacity: 0;
      transition: all 0.3s ease;
    }

    .chat-window.active {
      transform: translateY(0);
      opacity: 1;
      display: flex;
    }

    .chat-header {
      padding: 18px 20px;
      background: linear-gradient(135deg, #45b6fe 0%, #1a75ff 100%);
      color: white;
      font-weight: 600;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-radius: 15px 15px 0 0;
    }

    .chat-close {
      cursor: pointer;
      font-size: 18px;
      width: 24px;
      height: 24px;
      border-radius: 50%;
      background-color: rgba(255, 255, 255, 0.2);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
    }

    .chat-close:hover {
      background-color: rgba(255, 255, 255, 0.3);
      transform: scale(1.1);
    }

    .chat-body {
      flex: 1;
      overflow-y: auto;
      padding: 20px;
      background-color: #f5f7fa;
    }

    .chat-footer {
      padding: 15px;
      border-top: 1px solid #f0f0f0;
      display: flex;
      background-color: white;
      border-radius: 0 0 15px 15px;
    }

    .chat-input {
      flex: 1;
      padding: 12px 20px;
      border: 1px solid #e4e9f2;
      border-radius: 25px;
      outline: none;
      font-size: 14px;
      transition: all 0.2s;
    }

    .chat-input:focus {
      border-color: #1a75ff;
      box-shadow: 0 0 0 3px rgba(26, 117, 255, 0.1);
    }

    .chat-send {
      margin-left: 10px;
      background: linear-gradient(135deg, #45b6fe 0%, #1a75ff 100%);
      color: white;
      border: none;
      width: 45px;
      height: 45px;
      border-radius: 50%;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
    }

    .chat-send:hover {
      transform: scale(1.05);
      box-shadow: 0 3px 8px rgba(26, 117, 255, 0.3);
    }

    /* Message styles */
    .message {
      margin-bottom: 15px;
      max-width: 80%;
      position: relative;
      animation: fadeIn 0.3s forwards;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .user-message {
      margin-left: auto;
      background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
      color: white;
      border-radius: 18px 18px 0 18px;
      padding: 12px 18px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .bot-message {
      margin-right: auto;
      background-color: white;
      color: #333;
      border-radius: 18px 18px 18px 0;
      padding: 12px 18px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
      position: relative;
    }

    /* Category list for FAQ */
    .category-list, .question-list {
      list-style: none;
      padding: 0;
      margin: 0;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .category-item, .question-item {
      padding: 12px 15px;
      cursor: pointer;
      border-bottom: 1px solid #f0f0f0;
      transition: all 0.2s;
      background-color: white;
    }

    .category-item:last-child, .question-item:last-child {
      border-bottom: none;
    }

    .category-item:hover, .question-item:hover {
      background-color: #f5f8ff;
    }

    .back-button {
      display: inline-block;
      margin-bottom: 10px;
      padding: 8px 15px;
      background-color: white;
      border-radius: 20px;
      cursor: pointer;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
      transition: all 0.2s;
      font-size: 13px;
    }

    .back-button:hover {
      background-color: #f5f8ff;
    }

    /* Typing indicator */
    .typing-indicator {
      display: flex;
      padding: 12px 18px;
      background-color: white;
      border-radius: 18px 18px 18px 0;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
      margin-right: auto;
      width: fit-content;
    }

    .typing-indicator span {
      height: 8px;
      width: 8px;
      background-color: #ccc;
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
</head>
<body>
  <!-- Chat Widget -->
  <div class="botman-widget">
    <!-- Chat Bubble -->
    <div class="chat-bubble" id="chatBubble">
      <div class="robot-container">
        <div class="robot-antenna"></div>
        <div class="robot-head">
          <div class="robot-eye left"></div>
          <div class="robot-eye right"></div>
        </div>
        <div class="robot-body"></div>
        <div class="robot-arm left"></div>
        <div class="robot-arm right"></div>
      </div>
      <div class="speech-bubble">Hello!</div>
    </div>

    <!-- Chat Options Menu -->
    <div class="chat-options" id="chatOptions">
      <div class="options-header">
        <div>JogjaCare Assistant</div>
      </div>
      <div class="options-body">
        <div class="chat-option" id="openFaqBot">
          <div class="chat-option-icon">🤖</div>
          <div class="chat-option-content">
            <div class="chat-option-title">Chat Bot FAQ</div>
            <div class="chat-option-desc">Tanya jawab umum tentang JogjaCare</div>
          </div>
        </div>
        <div class="chat-option" id="openCustomerService">
          <div class="chat-option-icon">👨‍💼</div>
          <div class="chat-option-content">
            <div class="chat-option-title">Customer Service</div>
            <div class="chat-option-desc">Layanan bantuan dari staf kami</div>
          </div>
        </div>
        <div class="chat-option" id="openAiChat">
          <div class="chat-option-icon">🧠</div>
          <div class="chat-option-content">
            <div class="chat-option-title">AI Chat</div>
            <div class="chat-option-desc">Asisten AI untuk medical tourism</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Chat Window -->
    <div class="chat-window" id="chatWindow">
      <div class="chat-header" id="chatHeader">
        Chat Bot
        <div class="chat-close" id="chatClose">×</div>
      </div>
      <div class="chat-body" id="chatBody">
        <!-- Messages will appear here -->
      </div>
      <div class="chat-footer" id="chatFooter">
        <input type="text" class="chat-input" id="chatInput" placeholder="Ketik pesan Anda...">
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

</body>
</html>