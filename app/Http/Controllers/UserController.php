<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function loginForm()
    {
        return view("auth.sign_in");
    }

    public function registerForm()
    {
        return view("auth.sign_up");
    }

    public function register(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                "name" => "required|string",
                "email" => "required|email|unique:users,email",
                "password" => "required|string|min:8|confirmed",
                "specialize" => "required|string",
                "type" => "required|string|in:Trainer,Trainee",
            ]);

            $validator->validate();

            $in = $validator->validated();
            $in["password"] = Hash::make($request->password);

            $user = User::create(
                $in
            );

            NotificationService::create(
                $user->id,
                "Welcome to the website!",
                "We are happy to have you with us! 🎉",
                "notification"
            );

            return view('auth.sign_in', compact("user"));
        }catch (\Exception $e)
        {
            return view("errors",[
                "message" => $e->getMessage()
            ]);
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "email" => "required|email|exists:users,email",
                "password" => "required|string|min:8",
            ]);

            $validator->validate();

            $user = User::where("email",$request->email)->firstOrFail();

            $this->checkPassordCurrectness(
                $request->password,
                $user->password
            );

            Auth::login($user);

            return redirect()->to(route("indexCourse"));
        }catch (\Exception $e)
        {
            return view("errors",[
                "message" => $e->getMessage()
            ]);
        }
    }

    protected function checkPassordCurrectness(string $nonHashedPassword,string $hashedPassword): void
    {
        if (!Hash::check($nonHashedPassword, $hashedPassword))
            throw new \Exception(
                "Login failed. Invalid email or password."
            );
    }

    public function logout(Request $request)
    {
        // Log the user out
        Auth::logout();

        // Invalidate the user's session and regenerate CSRF token for security
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the login route (adjust route name as needed)
        return redirect()->route('login');
    }

}
