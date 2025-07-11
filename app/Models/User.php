<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "specialize",
        "type",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        "specialize" => "string",
        "type" => "string",
    ];

    public function notifications() : object
    {
        return $this->hasMany(Notification::class,"user_id","id");
    }

    public function courses() : object
    {
        return $this->hasMany(Course::class,"user_id","id");
    }

    public function registeredCourses() : object
    {
        return $this->belongsToMany(Course::class,"user_courses","user_id","course_id","id","id");
    }
}
