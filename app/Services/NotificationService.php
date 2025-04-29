<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{

    public static function create($userId,$title,$message,$type,$courseScheduleId = null) : void
    {
        Notification::create([
            "user_id" => $userId,
            "title" => $title,
            "message" => $message,
            "type" => $type,
            "course_schedule_id" => $courseScheduleId
        ]);
    }

}
