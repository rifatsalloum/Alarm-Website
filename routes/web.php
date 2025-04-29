<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CourseScheduleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect("/user/login/form");
});



Route::prefix('user')->group(function () {

    Route::get("/login/form",[UserController::class,"loginForm"])->name("login");
    Route::get("/register/form",[UserController::class,"registerForm"])->name("register");

    Route::post("/register", [UserController::class, "register"])->name("sign_up");
    Route::post("/login", [UserController::class, "login"])->name("sign_in");

    Route::get("/logout", [UserController::class, "logout"])->name("log_out");

});

Route::middleware("auth")->group(function () {

    Route::prefix('course')->group(function () {

        Route::post("/create",[CourseController::class,"store"])->name("storeCourse");
        Route::get("/activate/{course}",[CourseController::class,"activate"])->name("activateCourse");
        Route::get("/deactivate/{course}",[CourseController::class,"deactivate"])->name("deactivateCourse");

        Route::get("/index",[CourseController::class,"index"])->name("indexCourse");

        Route::get("/book/{course}",[CourseController::class,"book"])->name("bookCourse");

        });

    Route::prefix('courseSchedule')->group(function () {

        Route::post("/create",[CourseScheduleController::class,"store"])->name("storeCourseSchedule");

        Route::get("/index",[CourseScheduleController::class,"index"])->name("indexCourseSchedule");

        Route::post("/destroy",[CourseScheduleController::class,"destroy"])->name("destroyCourseSchedule");

    });

    Route::prefix('notifications')->group(function () {

        Route::get("/index",[NotificationController::class,"index"])->name("indexNotifications");

    });

});
