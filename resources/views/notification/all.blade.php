<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alarm Website</title>

    <!-- font google Epilogue -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">


    <!-- font google Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- font awesome -->
    @vite(['resources/css/all.min.css'])

    <!-- main css -->
    @vite(['resources/css/output.css'])
</head>
<body class="bg-gray_30/30">
@yield('content')
@php
    $user = auth()->user();
    $notificationCounts = $user->notifications()->where("type","notification")->count();
@endphp

<!-- header -->
<header class="px-8 lg:px-10 py-8 ">
    <div class="bg-secondary/50 py-5 pl-10 pr-5 rounded-[14px] border-[1px] border-[#DDDDFF] ">
        <div class="flex items-center justify-between">
            <a href="{{ route("indexCourse") }}">
                <h1 class="font-secondary font-semibold text-[24px] text-primary">Alarm Website</h1>
            </a>
            <div class="text-primary text-2xl  text-center cursor-pointer mnav__close-btn lg:hidden z-50">
                <i class="fa-solid fa-bars mnav__close-btn-icon"></i>
            </div>
            <ul class=" items-center justify-between gap-3 nav_active hidden lg:flex">
                <li><a href="{{ route("log_out") }}" class="nav  a_nav  ">log out</a></li>
                <li><a href="{{ route("indexCourse") }}" class="nav  a_nav  ">Courses</a></li>
                <li><a href="{{ route("indexCourseSchedule") }}" class="nav  a_nav ">Calendar</a></li>
                <li><a href="{{ route("indexNotifications",["type" => "reminder"]) }}" class="nav  a_nav ">Reminders</a></li>
                <li><a href="{{ route("indexNotifications",["type" => "notification"]) }}" class="nav  a_nav relative ">Notifications
                        <div class="w-[20px] h-[20px] bg-secondary rounded-full flex items-center justify-center font-secondary font-bold text-[12px] text-third absolute right-[-5px] top-[-5px]">
                            {{$notificationCounts}}
                        </div>
                    </a></li>

            </ul>

        </div>
        <!-- mobile -->
        <div class="mobileNav ">
            <div class=" py-4 px-8 mobileShow ">
                <ul class="flex flex-col items-center  gap-10 nav_active">
                    <li><a href="{{ route("log_out") }}" class="nav  a_nav  ">log out</a></li>
                    <li><a href="{{ route("indexCourse") }}" class="nav  a_nav  ">Courses</a></li>
                    <li><a href="{{ route("indexCourseSchedule") }}" class="nav  a_nav ">Calendar</a></li>
                    <li><a href="{{ route("indexNotifications",["type" => "reminder"]) }}" class="nav  a_nav ">Reminders</a></li>
                    <li><a href="{{ route("indexNotifications",["type" => "notification"]) }}" class="nav  a_nav relative ">Notifications
                            <div class="w-[20px] h-[20px] bg-secondary rounded-full flex items-center justify-center font-secondary font-bold text-[12px] text-third absolute right-[-5px] top-[-5px]">
                                {{$notificationCounts}}
                            </div>
                        </a></li>
                </ul>

            </div>
        </div>
    </div>
</header>

<!-- hero Notifications -->
<section  class="mt-[30px]">

    <div class="flex flex-col md:flex-row items-center justify-between gap-5  px-8 lg:px-20 relative z-10 ">
        <div class="flex flex-col items-center lg:items-start">
            <!-- content text -->
            <h1 class="font-primary font-bold text-primary text-[60px] lg:text-[130px] leading-[1]">
                {{ $type === "notification"? "Notifications" : "Reminders" }}
            </h1>

        </div>
        <!-- image -->
        <img src="{{ asset( $type === "notification"? 'assets/notification.png' : 'assets/timetable.png') }}" alt="" class="w-1/2 md:w-[20%]">
    </div>
</section>

<!-- content Notifications -->
<section class="mt-[80px] ">


    <div class="px-8 lg:px-20">
        <!-- Notifications Messages  -->
        <div class="space-y-6">
            @foreach($notifications as $notification)
                @php
                    // $loop->index is available automatically in the loop
                    $colors = ['#D6E6FF', '#D6FFD6', '#FFE6FF']; // define your array of colors
                    $bgColor = $colors[$loop->index % count($colors)];
                @endphp

                <div class="flex flex-col lg:flex-row lg:items-center gap-5 shadow-card rounded-[50px] overflow-hidden w-full xl:w-[75%] py-4 px-8 relative min-h-[150px]" style="background-color: {{ $bgColor }}">
                    <div class="absolute left-0 top-0 h-full w-10 bg-secondary rounded-l-[50px]"></div>
                    <div class="flex-1 ml-10 lg:ml-14">
                        <h2 class="font-secondary font-bold text-[25px] text-primary">{{ $notification->title }}</h2>
                        <p class="font-primary font-semibold text-[20px] text-gray_50 mt-2 lg:w-[70%]">
                            {{ $notification->message }}
                        </p>
                    </div>
                    <div class="ml-10 lg:ml-0 lg:text-center">
                        <p class="font-secondary font-bold text-[22px] text-primary md:text-[30px]">
                            {{ $notification->created_at->copy()->addHours(3)->format('g:i A') }}
                        </p>
                        <p class="font-primary font-semibold text-[18px] text-secondary">
                            {{ $notification->created_at->copy()->addHours(3)->format('l, F j, Y') }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

</section>

<!-- footer -->
<footer class="mt-[50px] bg-secondary/50 ">
    <div class="px-8 lg:px-20 py-10">
        <!-- grid -->
        <div class="flex flex-col md:flex-row flex-wrap justify-between gap-5">
            <!-- logo -->
            <div>
                <h1 class="font-secondary font-semibold text-[24px] text-primary">Ai Alarm</h1>

                <p class="font-primary text-[14px] text-primary mt-5 md:w-[416px]">
                    Empowering learners through accessible and engaging online education.
                    Our Web is a leading online learning platform dedicated to providing high-quality, flexible, and affordable educational experiences.
                </p>


            </div>
            <!-- our services:-->
            <div class="">
                <h2 class="font-primary font-semibold text-[18px] text-primary ">
                    Get Help
                </h2>
                <ul class="space-y-2 mt-5">
                    <li class="footer">Support</li>
                    <li class="footer">FAQ</li>

                </ul>
            </div>
            <!-- quick links:-->
            <div>
                <h2 class="font-primary font-semibold text-[18px] text-primary  ">
                    Programs
                </h2>
                <ul class="space-y-2 mt-5">
                    <li class="footer">Art & Design</li>
                    <li class="footer">Business </li>
                    <li class="footer">IT & Software</li>
                    <li class="footer">Languages</li>
                    <li class="footer">Programming</li>

                </ul>
            </div>
            <!-- Gallery-->
            <div>
                <h2 class="font-primary font-semibold text-[18px] text-primary   ">
                    Contact Us
                </h2>
                <ul class="space-y-2 mt-5">
                    <li class="footer">Address: Damascus,syria </li>
                    <li class="footer">Tel: +963-987-8965</li>
                    <li class="footer">Mail: Our user @gmail.com</li>
                </ul>

            </div>

        </div>
    </div>

</footer>







@vite(['resources/js/main.js'])
@include('partials.echo-notifications')
</body>
</html>
