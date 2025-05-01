@extends('frontend.layouts.app')

@section('title', 'JogjacareAI Chat')

@section('content')
<div class="container mx-auto max-w-2xl px-4 py-8">
    <!-- Header with Logo -->
    <div class="text-center mb-6">
        <div class="flex justify-center mb-2">
            <svg class="w-12 h-12 text-blue-500" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 13c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.3-7.5c-.98-.67-2.15-1-3.3-1s-2.32.33-3.3 1c-.48.32-.75.88-.65 1.48.1.6.56 1.02 1.15 1.02.32 0 .64-.12.9-.33.55-.4 1.25-.67 1.9-.67s1.35.27 1.9.67c.26.21.58.33.9.33.59 0 1.05-.42 1.15-1.02.1-.6-.17-1.16-.65-1.48z"/>
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-800">Hi, I'm JogjacareAI.</h1>
        <p class="text-gray-600 mt-1">How can I help you today?</p>
    </div>

    <!-- Chat Container -->
    <div id="chatContainer" class="bg-white rounded-xl shadow-sm overflow-hidden mb-4">
        <!-- Chat Messages -->
        <div id="chatMessages" class="h-[400px] overflow-y-auto p-4 space-y-4">
            <!-- Messages will appear here -->
        </div>

        <!-- Input Area -->
        <div class="border-t border-gray-100 p-3">
            <div id="chatStatus" class="text-xs text-center text-gray-400 mb-2 h-4"></div>
            
            <!-- File Upload Area (Hidden by default) -->
            <div id="fileUploadArea" class="hidden mb-3 p-3 bg-gray-50 rounded-lg">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-700">Attached Files</span>
                    <button id="closeFileUpload" class="text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div id="fileList" class="space-y-2 max-h-24 overflow-y-auto"></div>
                <div class="mt-2">
                    <label for="fileInput" class="inline-block px-3 py-1.5 text-xs bg-blue-500 text-white rounded-full cursor-pointer hover:bg-blue-600 transition">
                        Add more files
                    </label>
                </div>
            </div>
            
            <div class="flex items-center rounded-full bg-gray-100 px-4 py-2">
                <input 
                    type="text" 
                    id="chatInput" 
                    class="flex-1 bg-transparent border-none focus:outline-none text-gray-700" 
                    placeholder="Message JogjacareAI"
                    autocomplete="off"
                >
                <div class="flex space-x-2 ml-2">
                    <input type="file" id="fileInput" class="hidden" multiple />
                    <button id="attachButton" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                        </svg>
                    </button>
                    <button id="chatSendBtn" class="text-blue-500 hover:text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex justify-between mt-2 text-xs text-gray-500">
                <div class="flex items-center">
                    <span id="modelLabel" class="px-2 py-1 bg-gray-100 rounded-full flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd" />
                        </svg>
                        DeepThink (R1)
                    </span>
                </div>
                <button id="chatClearBtn" class="text-gray-500 hover:text-gray-700">Clear chat</button>
            </div>
        </div>
    </div>
</div>

@push('after-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatInput = document.getElementById('chatInput');
    const chatSendBtn = document.getElementById('chatSendBtn');
    const chatMessages = document.getElementById('chatMessages');
    const chatStatus = document.getElementById('chatStatus');
    const chatClearBtn = document.getElementById('chatClearBtn');
    const attachButton = document.getElementById('attachButton');
    const fileInput = document.getElementById('fileInput');
    const fileUploadArea = document.getElementById('fileUploadArea');
    const fileList = document.getElementById('fileList');
    const closeFileUpload = document.getElementById('closeFileUpload');
    
    // Store uploaded files
    let uploadedFiles = [];
    
    // Initialize chat
    loadChatHistory();
    
    // Event listeners
    chatInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });
    
    chatSendBtn.addEventListener('click', sendMessage);
    
    chatClearBtn.addEventListener('click', function() {
        if (confirm('Are you sure you want to clear the chat history?')) {
            chatMessages.innerHTML = '';
            localStorage.removeItem('deepseekChatHistory');
            addMessage('ai', 'Hi, I\'m JogjacareAI. How can I help you today?');
        }
    });
    
    attachButton.addEventListener('click', function() {
        fileInput.click();
    });
    
    fileInput.addEventListener('change', function(e) {
        handleFileUpload(e.target.files);
        // Reset input to allow selecting the same file again
        fileInput.value = '';
    });
    
    closeFileUpload.addEventListener('click', function() {
        uploadedFiles = [];
        fileUploadArea.classList.add('hidden');
        fileList.innerHTML = '';
    });
    
    // Handle file upload
    function handleFileUpload(files) {
        if (files.length === 0) return;
        
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            
            // Add to uploaded files array
            uploadedFiles.push(file);
            
            // Create file item in UI
            const fileItem = document.createElement('div');
            fileItem.className = 'flex items-center justify-between bg-white p-2 rounded border text-sm';
            
            // Determine file icon based on type
            let fileIcon = '';
            if (file.type.startsWith('image/')) {
                fileIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>';
            } else if (file.type === 'application/pdf') {
                fileIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>';
            } else if (file.type.includes('word') || file.type.includes('document')) {
                fileIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-700 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>';
            } else {
                fileIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>';
            }
            
            const index = uploadedFiles.length - 1;
            fileItem.innerHTML = `
                <div class="flex items-center overflow-hidden">
                    ${fileIcon}
                    <span class="truncate max-w-xs">${file.name}</span>
                    <span class="text-xs text-gray-500 ml-2">${formatFileSize(file.size)}</span>
                </div>
                <button class="text-red-500 hover:text-red-700 ml-2 remove-file" data-index="${index}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            `;
            
            fileList.appendChild(fileItem);
            
            // Add event listener to remove button
            const removeBtn = fileItem.querySelector('.remove-file');
            removeBtn.addEventListener('click', function() {
                const fileIndex = parseInt(this.getAttribute('data-index'));
                
                // Remove from array (keeping the index positions intact to avoid issues)
                uploadedFiles[fileIndex] = null;
                
                // Remove from UI
                this.closest('div').remove();
                
                // If no files left, hide the upload area
                if (fileList.children.length === 0) {
                    fileUploadArea.classList.add('hidden');
                    uploadedFiles = [];
                }
            });
        }
        
        // Show file upload area
        fileUploadArea.classList.remove('hidden');
    }
    
    // Format file size
    function formatFileSize(bytes) {
        if (bytes < 1024) return bytes + ' B';
        else if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
        else return (bytes / 1048576).toFixed(1) + ' MB';
    }
    
    // Load chat history
    function loadChatHistory() {
        const savedChat = localStorage.getItem('deepseekChatHistory');
        if (savedChat) {
            chatMessages.innerHTML = savedChat;
            scrollToBottom();
        } else {
            // Add welcome message
            addMessage('ai', 'Hi, I\'m JogjacareAI. How can I help you today?');
        }
    }
    
    // Save chat history
    function saveChatHistory() {
        localStorage.setItem('deepseekChatHistory', chatMessages.innerHTML);
    }
    
    // Scroll to bottom of messages
    function scrollToBottom() {
        setTimeout(() => {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }, 0);
    }
    
    // Add message to chat
    function addMessage(sender, content, attachments = null) {
        const messageDiv = document.createElement('div');
        const isUser = sender === 'user';
        
        messageDiv.className = `flex ${isUser ? 'justify-end' : 'justify-start'}`;
        
        let attachmentsHTML = '';
        if (attachments && attachments.length > 0) {
            attachmentsHTML = '<div class="mt-2 space-y-1.5">';
            
            attachments.forEach(file => {
                if (file) {
                    let fileIcon = '';
                    if (file.type.startsWith('image/')) {
                        // For images, show a thumbnail
                        fileIcon = `<img src="${URL.createObjectURL(file)}" class="w-20 h-20 object-cover rounded" alt="${file.name}">`;
                    } else if (file.type === 'application/pdf') {
                        fileIcon = '<svg class="w-4 h-4 text-red-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>';
                    } else {
                        fileIcon = '<svg class="w-4 h-4 text-gray-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>';
                    }
                    
                    attachmentsHTML += `
                        <div class="flex items-center bg-gray-50 rounded p-1 text-xs text-gray-600">
                            ${fileIcon}
                            <span class="truncate max-w-xs">${file.name}</span>
                            <span class="text-xs text-gray-500 ml-1">${formatFileSize(file.size)}</span>
                        </div>
                    `;
                }
            });
            
            attachmentsHTML += '</div>';
        }
        
        messageDiv.innerHTML = `
            <div class="max-w-[80%] ${isUser ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-800'} rounded-2xl px-4 py-2 ${isUser ? 'rounded-tr-none' : 'rounded-tl-none'}">
                <div class="chat-message-content text-sm">${formatMessage(content)}</div>
                ${attachmentsHTML}
            </div>
        `;
        
        chatMessages.appendChild(messageDiv);
        scrollToBottom();
        saveChatHistory();
    }
    
    // Format message
    function formatMessage(text) {
        // Replace URLs with clickable links
        text = text.replace(/(https?:\/\/[^\s]+)/g, '<a href="$1" target="_blank" class="underline">$1</a>');
        
        // Format code blocks
        text = text.replace(/```([\s\S]*?)```/g, '<pre class="bg-gray-200 dark:bg-gray-700 p-2 rounded my-2 overflow-x-auto text-xs"><code>$1</code></pre>');
        text = text.replace(/`([^`]+)`/g, '<code class="bg-gray-200 dark:bg-gray-700 px-1 rounded text-xs">$1</code>');
        
        // Format bold and italic text
        text = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
        text = text.replace(/\*(.*?)\*/g, '<em>$1</em>');
        
        // Handle line breaks
        text = text.replace(/\n/g, '<br>');
        
        return text;
    }
    
    // Show typing indicator
    function showTypingIndicator() {
        chatStatus.innerHTML = `
            <div class="flex items-center justify-center">
                <span class="text-gray-500">JogjacareAI is typing</span>
                <div class="flex space-x-1 ml-2">
                    <div class="w-1 h-1 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0s"></div>
                    <div class="w-1 h-1 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    <div class="w-1 h-1 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                </div>
            </div>
        `;
    }
    
    // Hide typing indicator
    function hideTypingIndicator() {
        chatStatus.innerHTML = '';
    }
    
    // Toggle input state
    function setInputState(disabled) {
        chatInput.disabled = disabled;
        chatSendBtn.disabled = disabled;
        attachButton.disabled = disabled;
        if (disabled) {
            chatSendBtn.classList.add('opacity-50');
            attachButton.classList.add('opacity-50');
        } else {
            chatSendBtn.classList.remove('opacity-50');
            attachButton.classList.remove('opacity-50');
        }
    }
    
    // Process files for API request
    async function processFiles() {
        const files = uploadedFiles.filter(file => file !== null);
        if (files.length === 0) return null;
        
        // Create an array of file information and base64 content
        const fileData = await Promise.all(files.map(async (file) => {
            return {
                name: file.name,
                type: file.type,
                content: await fileToBase64(file)
            };
        }));
        
        return fileData;
    }
    
    // Convert file to base64
    function fileToBase64(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = () => {
                // Remove the data URL prefix (e.g., "data:image/png;base64,")
                const base64 = reader.result.split(',')[1];
                resolve(base64);
            };
            reader.onerror = error => reject(error);
        });
    }
    
    // Send message
    async function sendMessage() {
        const input = chatInput.value.trim();
        
        if (!input && uploadedFiles.filter(f => f !== null).length === 0) {
            return;
        }
        
        // Process files for sending
        const files = await processFiles();
        
        // Add user message with attachments
        addMessage('user', input, uploadedFiles.filter(f => f !== null));
        
        // Clear input and attachments
        chatInput.value = '';
        uploadedFiles = [];
        fileUploadArea.classList.add('hidden');
        fileList.innerHTML = '';
        
        // Show typing indicator
        showTypingIndicator();
        setInputState(true);
        
        try {
            // Prepare messages for API
            const messages = [
                { 
                    role: 'system', 
                    content: 'You are a helpful, friendly AI assistant. Provide accurate and helpful answers in a natural conversational style.' 
                },
                { 
                    role: 'user', 
                    content: input
                }
            ];
            
            // Add file attachments if any
            if (files && files.length > 0) {
                // Modify the last user message to include file references
                messages[messages.length - 1].content += 
                    '\n\nI have attached ' + files.length + ' file(s):\n' + 
                    files.map((f, i) => `${i+1}. ${f.name} (${f.type})`).join('\n');
                
                // Add file attachments to the API request
                messages[messages.length - 1].files = files;
            }
            
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
                    messages: messages,
                    temperature: 0.7,
                    max_tokens: 1000
                })
            });
            
            const data = await res.json();
            
            if (data.choices && data.choices.length > 0) {
                const reply = data.choices[0].message.content;
                addMessage('ai', reply);
            } else {
                if (data.error) {
                    addMessage('ai', `Sorry, there was an error: ${data.error.message || 'Unable to get a response'}`);
                } else {
                    addMessage('ai', 'Sorry, I cannot process your request right now. Please try again later.');
                }
            }
        } catch (error) {
            console.error('Error:', error);
            addMessage('ai', `Sorry, there was a technical error. Please try again later.`);
        } finally {
            hideTypingIndicator();
            setInputState(false);
            // Focus on input after sending
            chatInput.focus();
        }
    }
});
</script>

<style>
/* Custom styles for chat elements */
#chatMessages::-webkit-scrollbar {
    width: 6px;
}

#chatMessages::-webkit-scrollbar-track {
    background: transparent;
}

#chatMessages::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

#fileList::-webkit-scrollbar {
    width: 4px;
}

#fileList::-webkit-scrollbar-track {
    background: transparent;
}

#fileList::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

/* Handle code overflow */
pre code {
    white-space: pre-wrap;
    word-break: break-word;
}

/* Ensure messages don't overflow */
.chat-message-content {
    overflow-wrap: break-word;
    word-wrap: break-word;
    word-break: break-word;
    hyphens: auto;
}
</style>
@endpush
@endsection