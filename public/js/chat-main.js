// Main Chat Manager - Coordinates all chat functionality
document.addEventListener('DOMContentLoaded', function() {
    const chatBubble = document.getElementById('chatBubble');
    const chatOptions = document.getElementById('chatOptions');
    const chatWindow = document.getElementById('chatWindow');
    const chatClose = document.getElementById('chatClose');
    
    // Chat option buttons
    const openFaqBot = document.getElementById('openFaqBot');
    const openCustomerService = document.getElementById('openCustomerService');
    const openAiChat = document.getElementById('openAiChat');
    
    let currentChatMode = null;
    
    // Toggle chat options menu
    chatBubble.addEventListener('click', function() {
        // If chat window is open, close it instead of showing options
        if (chatWindow.style.display === 'flex') {
            chatWindow.style.display = 'none';
            return;
        }
        
        if (chatOptions.style.display === 'block') {
            chatOptions.style.display = 'none';
        } else {
            chatOptions.style.display = 'block';
        }
    });
    
    // Close button for chat window
    chatClose.addEventListener('click', function() {
        chatWindow.style.display = 'none';
    });
    
    // Open FAQ Bot
    openFaqBot.addEventListener('click', function() {
        // Reset and initialize the FAQ bot
        initializeFaqBot();
        currentChatMode = 'faq';
        
        // Update header
        document.getElementById('chatHeader').innerHTML = 'JogjaCare FAQ Bot <div class="chat-close" id="chatClose">×</div>';
        
        // Rebind close button
        document.getElementById('chatClose').addEventListener('click', function() {
            chatWindow.style.display = 'none';
        });
        
        // Show chat window and hide options
        chatWindow.style.display = 'flex';
        chatOptions.style.display = 'none';
    });
    
    // Open Customer Service
    openCustomerService.addEventListener('click', function() {
        initializeCustomerService();
        currentChatMode = 'cs';
        
        // Update header
        document.getElementById('chatHeader').innerHTML = 'Customer Service <div class="chat-close" id="chatClose">×</div>';
        
        // Rebind close button
        document.getElementById('chatClose').addEventListener('click', function() {
            chatWindow.style.display = 'none';
        });
        
        // Show chat window and hide options
        chatWindow.style.display = 'flex';
        chatOptions.style.display = 'none';
    });
    
    // Open AI Chat
    openAiChat.addEventListener('click', function() {
        initializeAiChat();
        currentChatMode = 'ai';
        
        // Update header
        document.getElementById('chatHeader').innerHTML = 'AI Assistant <div class="chat-close" id="chatClose">×</div>';
        
        // Rebind close button
        document.getElementById('chatClose').addEventListener('click', function() {
            chatWindow.style.display = 'none';
        });
        
        // Show chat window and hide options
        chatWindow.style.display = 'flex';
        chatOptions.style.display = 'none';
    });
    
    // Handle send button click based on current mode
    document.getElementById('chatSend').addEventListener('click', function() {
        const chatInput = document.getElementById('chatInput');
        const message = chatInput.value.trim();
        
        if (message === '') return;
        
        switch(currentChatMode) {
            case 'faq':
                handleFaqBotMessage(message);
                break;
            case 'cs':
                handleCustomerServiceMessage(message);
                break;
            case 'ai':
                handleAiChatMessage(message);
                break;
        }
        
        // Clear input
        chatInput.value = '';
    });
    
    // Handle enter key in input
    document.getElementById('chatInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            document.getElementById('chatSend').click();
        }
    });
    
    // Helper functions for handling messages across all chat types
    window.addMessage = function(type, content) {
        const chatBody = document.getElementById('chatBody');
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${type === 'user' ? 'user-message' : 'bot-message'}`;
        messageDiv.innerHTML = content;
        chatBody.appendChild(messageDiv);
        
        // Scroll to bottom
        chatBody.scrollTop = chatBody.scrollHeight;
    };
    
    window.showTypingIndicator = function() {
        const chatBody = document.getElementById('chatBody');
        const indicatorDiv = document.createElement('div');
        indicatorDiv.className = 'typing-indicator bot-message';
        indicatorDiv.id = 'typingIndicator';
        indicatorDiv.innerHTML = '<span></span><span></span><span></span>';
        chatBody.appendChild(indicatorDiv);
        
        // Scroll to bottom
        chatBody.scrollTop = chatBody.scrollHeight;
    };
    
    window.hideTypingIndicator = function() {
        const indicator = document.getElementById('typingIndicator');
        if (indicator) {
            indicator.remove();
        }
    };
    
    window.setInputState = function(disabled) {
        document.getElementById('chatInput').disabled = disabled;
        document.getElementById('chatSend').disabled = disabled;
    };
});