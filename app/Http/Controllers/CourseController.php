<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\UserCourse;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $user = auth()->user();
            $courses = ($user->type == "Trainer") ? $user->courses()->withCount(["students"])->get() : Course::where("status",1)->withCount([
                "students",
            ])->get();
            return view("course.all", compact("courses"));

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
            "title" => "required|string",
            "description" => "required|string",
            "start_date" => "required|date",
            "end_date" => "required|date|after:start_date",
        ]);

        $validator->validate();
        $trainer = auth()->user();

        if($trainer->type !== "Trainer")
            throw new \Exception("You Must Be Trainer To Allow You To Make This Action");

        $in = $validator->validated();

        unset($in["id"]);

        if($request->id == -1) {
            $in["user_id"] = $trainer->id;
            $course = Course::create($in);
        }else
            $course = Course::findOrFail($request->id)->update($in);

        $users = User::where("type","student")->get();

        foreach ($users as $user)
            NotificationService::create(
                $user->id,
                "New course has been added check it now!!",
                "We have new course " . $course->title . " for trainer " . $trainer->name,
                "notification"
            );

        return redirect()->to(route("indexCourse"));
        }catch (\Exception $e)
        {
            return view("errors",[
                "message" => $e->getMessage()
            ]);
        }
    }

    public function oneImage(Request $request)
    {
            $requestFile = $request->file('image');
            $dir = 'public/image';
            $randomNumber = Str::uuid();
            $fixName = $randomNumber . '.' . $requestFile->extension();
            if ($requestFile) {
                $url =  Storage::putFileAs($dir, $requestFile, $fixName);
            }

            return $url;
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        try {

        return view("course.one");

        }catch (\Exception $e)
        {
            return view("errors",[
                "message" => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        try {

        return view("course.edit");

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
    public function activate(Course $course)
    {
        try {

        $course->update([
            "status" => 1
        ]);
        return redirect()->to(route("indexCourse"));

        }catch (\Exception $e)
        {
            return view("errors",[
                "message" => $e->getMessage()
            ]);
        }
    }

    public function deactivate(Course $course)
    {
        try {

        $course->update([
            "status" => 0
        ]);
        return redirect()->to(route("indexCourse"));

        }catch (\Exception $e)
        {
            return view("errors",[
                "message" => $e->getMessage()
            ]);
        }
    }
    public function book(Course $course)
    {
        try {

            $user = auth()->user();

            if($user->type == "Trainer")
                throw new \Exception("Trainers not allowed to make this action!!");

        $userCourse = UserCourse::where("user_id",$user->id)->where("course_id",$course->id)->first();

        if($userCourse) {
            $userCourse->delete();
            NotificationService::create(
                $course->user_id,
                "You lost now a student!!",
                "student: " . $user->name . " has exited now the course: " . $course->title,
                "notification"
            );
        }
        else {
            UserCourse::create([
                "user_id" => $user->id,
                "course_id" => $course->id,
            ]);

            NotificationService::create(
                $course->user_id,
                "You have now new student!!",
                "student: " . $user->name . " is now registered in your course: " . $course->title,
                "notification"
            );
        }

        return redirect()->to(route("indexCourse"));

        }catch (\Exception $e)
        {
            return view("errors",[
                "message" => $e->getMessage()
            ]);
        }
    }
}
