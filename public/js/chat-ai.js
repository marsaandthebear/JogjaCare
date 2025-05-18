// AI Chat using DeepSeek API
function initializeAiChat() {
    // Clear chat body
    const chatBody = document.getElementById('chatBody');
    chatBody.innerHTML = '';
    
    // Welcome message
    addMessage('bot', 'Selamat datang di AI Assistant JogjaCare! Saya adalah asisten AI yang dapat menjawab pertanyaan Anda seputar medical tourism di Yogyakarta.');
    addMessage('bot', 'Silakan ajukan pertanyaan Anda tentang layanan kesehatan, destinasi wisata, atau informasi lainnya terkait JogjaCare.');
    
    // Initialize messages array for API
    window.aiMessages = [
        {
            "role": "system",
            "content": "Anda adalah asisten AI untuk JogjaCare, website yang menyediakan informasi lengkap mengenai layanan kesehatan dan destinasi wisata di Yogyakarta untuk wisatawan medical tourism. Berikan informasi yang akurat, sopan, dan ramah."
        }
    ];
}

async function handleAiChatMessage(message) {
    // Add user message to chat
    addMessage('user', message);
    
    // Add message to history for context
    window.aiMessages.push({
        "role": "user",
        "content": message
    });
    
    // Show typing indicator
    showTypingIndicator();
    
    // Disable input while processing
    setInputState(true);
    
    try {
        const res = await fetch('https://openrouter.ai/api/v1/chat/completions', {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer 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',
                'HTTP-Referer': window.location.href,
                'X-Title': 'jogjacare',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                model: 'deepseek/deepseek-r1:free',
                messages: window.aiMessages,
                temperature: 0.7,
                max_tokens: 1000
            })
        });
        
        const data = await res.json();
        
        if (data.choices && data.choices.length > 0) {
            const reply = data.choices[0].message.content;
            
            // Add AI response to messages history
            window.aiMessages.push({
                "role": "assistant",
                "content": reply
            });
            
            // Remove typing indicator and add message to chat
            hideTypingIndicator();
            addMessage('bot', reply);
            
            // Limit context window to save tokens
            if (window.aiMessages.length > 10) {
                // Keep system message and last 4 exchanges (8 messages)
                window.aiMessages = [
                    window.aiMessages[0],
                    ...window.aiMessages.slice(-8)
                ];
            }
        } else {
            if (data.error) {
                hideTypingIndicator();
                addMessage('bot', `Maaf, terjadi kesalahan: ${data.error.message || 'Tidak dapat mendapatkan respons'}`);
            } else {
                hideTypingIndicator();
                addMessage('bot', 'Maaf, saya tidak dapat memproses permintaan Anda saat ini. Silakan coba lagi nanti.');
            }
        }
    } catch (error) {
        console.error('Error:', error);
        hideTypingIndicator();
        addMessage('bot', `Maaf, terjadi kesalahan teknis. Silakan coba lagi nanti.`);
    } finally {
        // Re-enable input
        setInputState(false);
    }
}

// Make functions available globally
window.initializeAiChat = initializeAiChat;
window.handleAiChatMessage = handleAiChatMessage;