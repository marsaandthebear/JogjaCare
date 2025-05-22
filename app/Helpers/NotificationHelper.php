<?php

namespace App\Helpers;

use App\Notifications\GenericNotification;

class NotificationHelper
{
    public static function send($users, $title, $text, $module, $urls = [])
    {
        $data = [
            'title' => $title,
            'text' => $text,
            'module' => $module
        ];
        
        if (isset($urls['backend'])) {
            $data['url_backend'] = $urls['backend'];
        }
        
        if (isset($urls['frontend'])) {
            $data['url_frontend'] = $urls['frontend'];
        }
        
        $users = is_array($users) || $users instanceof \Illuminate\Database\Eloquent\Collection 
                ? $users : [$users];
        
        foreach ($users as $user) {
            $user->notify(new GenericNotification($data));
        }
    }
}