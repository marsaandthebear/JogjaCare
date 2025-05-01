<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatAIController extends Controller
{
    /**
     * Display the chat AI interface
     */
    public function index()
    {
        return view('frontend.chatai.index');
    }

    /**
     * Process chat message and get AI response
     */
    public function processMessage(Request $request)
    {
        $validated = $request->validate([
            'message' => ['required', 'string'],
        ]);

        $userMessage = $validated['message'];
        $chatHistory = session('chat_history', [
            ['role' => 'assistant', 'content' => 'Halo! Saya adalah asisten berbasis DeepSeek. Ada yang bisa saya bantu?']
        ]);

        // Add user message to history
        $chatHistory[] = ['role' => 'user', 'content' => $userMessage];

        try {
            // DeepSeek API call
            $response = Http::withHeader('Authorization', 'Bearer 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')
                ->withHeader('Content-Type', 'application/json')
                ->post('https://api.deepseek.com/v1/chat/completions', [
                    'model' => 'deepseek/deepseek-chat',
                    'messages' => $chatHistory,
                ]);

            if ($response->failed()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error calling DeepSeek API: ' . $response->status()
                ], 500);
            }

            $data = $response->json();
            
            // Extract AI response
            $aiResponse = $data['choices'][0]['message']['content'];
            
            // Add AI response to history
            $chatHistory[] = ['role' => 'assistant', 'content' => $aiResponse];
            
            // Save updated chat history to session
            session(['chat_history' => $chatHistory]);
            
            return response()->json([
                'status' => 'success',
                'message' => $aiResponse,
                'history' => $chatHistory
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Clear chat history
     */
    public function clearHistory()
    {
        session()->forget('chat_history');
        
        return response()->json([
            'status' => 'success',
            'message' => 'Chat history cleared successfully'
        ]);
    }
}