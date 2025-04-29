<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseSchedule;
use App\Models\Notification;
use App\Models\UserCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseScheduleController extends Controller
{
    public function index()
    {
        try {

            $user = auth()->user();
            $course_ids = $user->registeredCourses()->pluck('course_id')->toArray();

            $courseSchedules = ($user->type === "Trainer") ? CourseSchedule::whereHas("course", function ($query) use ($user) {

                $query->where("user_id", $user->id);

            })->get() : CourseSchedule::whereIn("selected_course", $course_ids)->get();

            $courses = ($user->type === "Trainer") ? Course::where("user_id",$user->id)->orderBy("id","asc")->get() :
                                                     Course::whereHas("students",function ($query) use ($user){
                                                         $query->where("users.id",$user->id);
                                                     })->get();
            return view("course-schedule.all", compact("courseSchedules", "courses"));

        }catch (\Exception $e)
        {
            return view("errors",[
                "message" => $e->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                "id" => "required|integer",
                "selected_course" => "required|integer|exists:courses,id",
                "event_theme" => "required|string",
                "event_date" => "required|date",
                "event_start" => "required|string",
                "event_end" => "required|string",
            ]);

            $validator->validate();

            $cs = CourseSchedule::find($request->id);

            if($cs) {

                $cs->update($validator->validated());

                Notification::where(function ($query) use ($cs){
                    $query->where("type","reminder")
                        ->where("course_schedule_id",$cs->id);
                })->update([
                    "course_schedule_id" => null,
                ]);

            }
            else
                $cs = CourseSchedule::create($validator->validated());


            return response($cs);

        }catch (\Exception $e)
        {
            return view("errors",[
                "message" => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseSchedule $courseSchedule)
    {
        return view("courseSchedule.one");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseSchedule $courseSchedule)
    {
        return view("course-schedule.edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseSchedule $courseSchedule)
    {
        try {

            $validator = Validator::make($request->all(), [
                "selected_course" => "required|integer|exists:courses,id",
                "event_theme" => "required|string",
                "event_date" => "required|date",
                "event_start" => "required|string",
                "event_end" => "required|string",
            ]);

            $validator->validate();

            $validator->validate();
            $courseSchedule->update(
                $validator->validated()
            );

            return redirect()->to(route("indexCourseSchedule"));
        }catch (\Exception $e)
        {
            return view("errors",[
                "message" => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {

            $courseSchedule = CourseSchedule::findOrFail($request->id);
            $courseSchedule->delete();
            return redirect()->to(route("indexCourseSchedule"));

        }catch (\Exception $e)
        {
            return view("errors",[
                "message" => $e->getMessage()
            ]);
        }
    }
}
