<?php

namespace App\Console\Commands;

use App\Events\SendReminderEvent;
use App\Models\CourseSchedule;
use App\Models\Notification;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remind-me';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send reminder to related users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // dd(Carbon::now()->addHours(2 + 3));
        $courseSchedules = CourseSchedule::where(function ($query) {

            $query->whereTime('event_start','<=', Carbon::now()->addHours(2 + 3)) // 2 +  3 for time delay
                  ->whereDate('event_date',Carbon::now()->addHours(3)->startOfDay());

        })->with([
            "course",
            "course.students",
        ])->get();

        foreach ( $courseSchedules as $courseSchedule )
        {
            $title = "Lessen Reminder!!";
            $message = "Today you have lessen for course: " . $courseSchedule->course->title . " at: " . Carbon::parse($courseSchedule->event_start)->format('H:i') . " ends at: " . Carbon::parse($courseSchedule->event_end)->format('H:i');

            $this->handelReminder(
                $courseSchedule->course->user_id,
                $title,
                $message,
                $courseSchedule
            );

            $students = $courseSchedule->course->students;
            foreach ($students as $student)
                $this->handelReminder(
                        $student->id,
                        $title,
                        $message,
                        $courseSchedule
                    );
        }
    }

    protected function handelReminder($userId,$title,$message,$courseSchedule) : void
    {
        if(Notification::where(function ($query) use ($userId,$courseSchedule){
            $query->where("type","reminder")
                  ->where("user_id",$userId)
                  ->where("course_schedule_id",$courseSchedule->id);
        })->exists()) return;

        NotificationService::create(
            $userId,
            $title,
            $message,
            "reminder",
            $courseSchedule->id
        );
        event( new SendReminderEvent($userId,$title,$message) );
    }
}
