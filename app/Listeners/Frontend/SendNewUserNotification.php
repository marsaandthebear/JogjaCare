<?php

namespace App\Listeners\Frontend;

use App\Events\Frontend\UserRegistered;
use App\Models\User;
use App\Notifications\NewUserNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNewUserNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        // Mendapatkan semua admin atau user yang perlu menerima notifikasi
        $admins = User::role('admin')->get();
        
        // Jika tidak ada admin, bisa dikirim ke user dengan ID tertentu
        if ($admins->isEmpty()) {
            // Alternatif: mengirim ke super admin atau user ID 1
            $admins = User::whereIn('id', [1])->get();
        }
        
        // Kirim notifikasi ke semua admin
        Notification::send($admins, new NewUserNotification($event->user));
    }
}