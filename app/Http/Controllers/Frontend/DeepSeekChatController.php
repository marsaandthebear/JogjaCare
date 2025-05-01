<?php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeepSeekChatController extends Controller
{
    /**
     * Menampilkan halaman DeepSeek Chat.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.deepseek-chat');
    }
}
