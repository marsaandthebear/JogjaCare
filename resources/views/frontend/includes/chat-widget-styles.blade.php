<style>
    /* Custom position for BotMan bubble */
.botman-widget {
    bottom: 20px;
    right: 20px;
    position: fixed;
    z-index: 1000;
}

/* Widget styling */
.chat-widget-container {
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 350px;
    height: 500px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    background-color: white;
    z-index: 9999;
    display: none;
    flex-direction: column;
    overflow: hidden;
}

/* Widget header */
.chat-widget-header {
    background-color: #4A86C5; /* Darker blue for better contrast */
    color: white; /* White text on darker blue background */
    padding: 10px 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chat-widget-title {
    font-weight: bold;
    margin: 0;
}

.chat-widget-actions {
    display: flex;
    gap: 10px;
}

.chat-widget-actions a {
    color: white; /* White icons for better visibility */
    text-decoration: none;
}

/* Widget body */
.chat-widget-body {
    flex: 1;
    overflow-y: auto;
    padding: 15px;
    background-color: #f9f9f9;
    display: flex;
    flex-direction: column;
}

.chat-widget-messages {
    flex: 1;
    overflow-y: auto;
}

.message {
    margin-bottom: 10px;
    max-width: 80%;
    padding: 8px 12px;
    border-radius: 15px;
    word-wrap: break-word;
}

.bot-message {
    background-color: #D1E4F9; /* Slightly darker for better contrast */
    color: #333; /* Explicitly setting dark text */
    align-self: flex-start;
    border: 1px solid #B8D3F2; /* Adding border for definition */
}

.user-message {
    background-color: #4A86C5; /* Darker blue */
    color: white; /* White text for high contrast */
    align-self: flex-end;
    margin-left: auto;
}

/* Scrollable buttons container */
.faq-buttons-wrapper {
    position: relative;
    margin-top: 15px;
    overflow-x: auto;
    scrollbar-width: thin;
    -webkit-overflow-scrolling: touch;
}

.faq-buttons-wrapper::-webkit-scrollbar {
    height: 5px;
}

.faq-buttons-wrapper::-webkit-scrollbar-thumb {
    background-color: #ccc;
    border-radius: 5px;
}

.faq-buttons {
    display: inline-flex;
    flex-wrap: nowrap;
    gap: 8px;
    margin-bottom: 5px;
    padding-bottom: 5px;
    white-space: nowrap;
}

/* Button styles */
.category-button, .question-button {
    padding: 8px 12px;
    border-radius: 18px;
    font-size: 14px;
    cursor: pointer;
    text-align: left;
    transition: all 0.2s;
    border: none;
    display: inline-block;
    white-space: nowrap;
}

.category-button {
    background-color: #4A86C5; /* Darker blue */
    color: white; /* White text */
}

.question-button {
    background-color: #D1E4F9; /* Slightly darker background */
    color: #333; /* Dark text */
    max-width: 250px;
    overflow: hidden;
    text-overflow: ellipsis;
    border: 1px solid #B8D3F2; /* Adding border for definition */
}

.category-button:hover, .question-button:hover {
    opacity: 0.9;
}

/* Back button */
.back-button {
    padding: 6px 10px;
    background-color: #e2e2e2; /* Darker background for better visibility */
    color: #333; /* Darker text */
    border-radius: 12px;
    margin-bottom: 8px;
    display: inline-block;
    font-size: 12px;
    cursor: pointer;
    white-space: nowrap;
}

/* Widget footer */
.chat-widget-footer {
    padding: 10px;
    border-top: 1px solid #eaeaea;
}

.chat-widget-form {
    display: flex;
}

.chat-widget-input {
    flex: 1;
    padding: 8px 12px;
    border: 1px solid #bbb; /* Darker border */
    border-radius: 20px;
    outline: none;
    color: #333; /* Dark text color */
    background-color: #fff
}

.chat-widget-submit {
    background-color: #4A86C5; /* Darker blue */
    color: white; /* White text */
    border: none;
    padding: 8px 15px;
    border-radius: 20px;
    margin-left: 5px;
    cursor: pointer;
}

/* Chat bubble */
.chat-bubble {
    background-color: #4A86C5; /* Darker blue */
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.chat-bubble-icon {
    color: white;
    font-size: 24px;
}
</style>
