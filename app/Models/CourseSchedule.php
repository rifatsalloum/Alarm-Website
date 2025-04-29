<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        "selected_course",
        "event_theme",
        "event_date",
        "event_start",
        "event_end",
    ];
    protected $casts = [
        "event_theme" => "string",
        "event_date" => "string",
        "event_start" => "string",
        "event_end" => "string",
    ];

    public function course() : object
    {
        return $this->belongsTo(Course::class,"selected_course","id");
    }
}
