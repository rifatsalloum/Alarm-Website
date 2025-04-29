<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "title",
        "description",
        "start_date",
        "end_date",
        "status",
    ];

    protected $casts = [
        "title" => "string",
        "start_date" => "string",
        "end_date" => "string",
        "status" => "boolean",
        "description" => "string",
    ];

    public function students() : object
    {
        return $this->belongsToMany(User::class,"user_courses","course_id","user_id","id","id");
    }

    public function trainer() : object
    {
        return $this->belongsTo(User::class,"user_id","id");
    }
}
