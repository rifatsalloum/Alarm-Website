<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "title",
        "message",
        "type",
        "course_schedule_id",
    ];
    protected $casts = [
        "title" => "string",
        "message" => "string",
        "type" => "string",
    ];
}
