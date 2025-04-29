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
    <!--<link rel="stylesheet" href="../../css/all.min.css">-->
    @vite(['resources/css/all.min.css'])

    <!-- main css -->
    @vite(['resources/css/output.css'])
</head>
<body class="bg-gray_30/20">
@yield('content')
@php
    $user = auth()->user();
    $notificationCounts = $user->notifications()->where("type","notification")->count();
@endphp

<!-- header -->
<header class="px-8 lg:px-10 py-8 absolute z-50 left-0 w-full">
    <div class="bg-gray_20/30 py-5 pl-10 pr-5 rounded-[14px] border-[1px] border-[#DDDDFF] ">
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
            <div class=" py-4 px-8 mobileshow ">
                <ul class="flex flex-col items-center  gap-10 nav_active">
                    <li><a href="{{ route("log_out") }}" class="nav  a_nav  ">log out</a></li>
                    <li><a href="{{ route("indexCourse") }}" class="nav  a_nav  ">Courses</a></li>
                    <li><a href="{{ route("indexCourseSchedule") }}" class="nav  a_nav ">Calendar</a></li>
                    <li><a href="{{ route("indexNotifications",["type" => "reminder"]) }}" class="nav  a_nav ">Reminders</a></li>
                    <li><a href="{{ route("indexNotifications",["type" => "notification"]) }}" class="nav  a_nav relative ">Notifications
                            <div class="w-[20px] h-[20px] bg-secondary rounded-full flex items-center justify-center font-secondary font-bold text-[12px] text-third absolute right-[-5px] top-[-5px]">
                                {{ $notificationCounts }}
                            </div>
                        </a></li>
                </ul>

            </div>
        </div>
    </div>
</header>

<!-- hero courses -->
<section id="web" class="bg-hero_courses bg-cover bg-center bg-no-repeat w-full min-h-[800px] flex items-center  relative  ">
    <div class="w-full min-h-[800px] absolute bg-black opacity-30 top-0 left-0"></div>
    <div class="flex flex-col justify-center  px-8 lg:px-10 relative z-10 ">
        <h1 class="font-primary text-White text-[50px] md:text-[70px] lg:text-[100px] leading-[1]">
            Courses
        </h1>
        <h3  class="font-primary text-White text-[20px] md:text-[55px] mt-5 md:w-[950px]">
            Upgrade your skills and knowledge with our online course.
        </h3>
    </div>
</section>
<!-- content -->
<section class="mt-[50px] ">

    <!-- Top Popular Course -->
    <div >
        <div class="px-8 lg:px-20 ">
            <!-- text -->
            <h3 class="font-primary text-third text-[11px] uppercase bg-secondary rounded py-2 px-4 inline-block">
                Top Popular Course
            </h3>
            <div class="flex flex-col xl:flex-row items-start justify-between mt-3 gap-5">

                <div >
                        <span class="font-primary font-bold  text-primary text-[34px]  gap-2 capitalize xl:w-[470px] inline-block">
                            Name Course

                                student

                            can join with us.
                        </span>


                </div>
                @if($user->type === "Trainer")
                <button id="addCourseBtn" class="font-primary font-medium bg-secondary text-third p-4 rounded-full shadow-lg" onclick="openPopup('add')"> Add Course</button>
                @endif

            </div>

            <!-- grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 mt-10">
                @foreach($courses as $course)
                    @php
                        $isJoined = \App\Models\UserCourse::where('user_id', $user->id)
                                        ->where('course_id', $course->id)
                                        ->exists();
                    @endphp
                    <div class="bg-white border border-gray-200 shadow-card rounded-2xl p-4 relative" data-user="trainee">
                        <div class="mt-5 relative z-10">
                            <h1 class="font-semibold text-[18px] text-primary capitalize">{{ $course->title }}</h1>
                            <p class="text-[15px] text-primary mt-2">{{ $course->description }}</p>
                            <div class="bg-secondary/10 rounded py-3 px-5 mt-3 flex items-center justify-between">
                <span class="font-semibold text-[13px] text-primary capitalize">
                    Start Date: <span class="text-red">{{ $course->start_date }}</span>
                </span>
                                <span class="font-semibold text-[13px] text-primary capitalize">
                    End Date: <span class="text-green">{{ $course->end_date }}</span>
                </span>
                            </div>
                            <div class="bg-secondary/10 rounded py-3 px-5 mt-3 flex items-center justify-between">
                <span class="font-medium text-[13px] text-primary">
                    Students: {{ $course->students_count }}
                </span>
                            </div>
                            @if($user->type === "Trainee")
                            <div class="flex items-center justify-between mt-5">
                                <div class="flex items-center gap-5">
                                    <!-- <button
                                        onclick="if(confirm('Are you sure you want to {{ $isJoined ? 'exit' : 'join' }} this course?')) { window.location.href='{{ route('bookCourse', ['course' => $course]) }}'; }"
                                        style="background-color: {{ $isJoined ? '#ef4444' : '#6CA8F1' }}; color: #fff; padding: 0.5rem 1.5rem; border-radius: 9999px;"
                                        class="font-primary font-medium text-[16px]">
                                        {{ $isJoined ? 'Exit' : 'Join' }}
                                    </button> -->
                                    <button 
                                        type="button"
                                        class="status-btn font-primary font-medium text-third text-[16px] rounded-full py-2 px-4 {{ $isJoined ? 'bg-red' : 'bg-secondary' }}"
                                        data-status="{{ $isJoined ? 'exit' : 'join' }}"
                                        data-action-url="{{ route('bookCourse', ['course' => $course]) }}"
                                        data-modal-id="confirmModal"
                                    >
                                        {{ $isJoined ? 'Exit' : 'Join' }}
                                    </button>

                                </div>
                            </div>
                            @endif
                            @if($user->type === "Trainer")
                            <div class="flex items-center justify-end mt-3 gap-2">
                                <button class="edit-btn font-primary font-medium bg-green text-third text-[16px] rounded-full py-2 px-4"
                                        onclick="openPopup('edit', '{{ addslashes($course->title) }}', '{{ addslashes($course->description) }}', '{{ $course->start_date }}', '{{ $course->end_date }}', '{{ $course->price }}','{{ $course->id }}')">
                                    Edit
                                </button>
                                <!-- <button type="button" class="delete-btn font-primary font-medium text-third text-[16px] rounded-full py-2 px-4
        {{ $course->status == 1 ? 'bg-red' : 'bg-green' }}"
                                        onclick="if(confirm('Are you sure you want to {{ $course->status == 1 ? 'deactivate' : 'activate' }} this course?'))
             window.location.href='{{ route($course->status == 1 ? 'deactivateCourse' : 'activateCourse', ['course' => $course]) }}'">
                                    {{ $course->status == 1 ? 'Deactivate' : 'Activate' }}
                                </button> -->
                                <button 
    type="button"
    class="status-btn font-primary font-medium text-third text-[16px] rounded-full py-2 px-4 {{ $course->status == 1 ? 'bg-red' : 'bg-green' }}"
    data-status="{{ $course->status }}"
    data-action-url="{{ route($course->status == 1 ? 'deactivateCourse' : 'activateCourse', ['course' => $course]) }}"
    data-modal-id="confirmModal"
>
    {{ $course->status == 1 ? 'Deactivate' : 'Activate' }}
</button>
                                <!-- <button type="button"  class="delete-btn font-primary font-medium text-third text-[16px] rounded-full py-2 px-4
                                 {{ $course->status == 1 ? 'bg-red' : 'bg-green' }}"
                                        onclick="handleCourseStatus(
                                            {{ $course->status == 1 ? 'true' : 'false' }},
                                            '{{ route($course->status == 1 ? 'deactivateCourse' : 'activateCourse', ['course' => $course]) }}'
                                        )"
                                    >
                                        {{ $course->status == 1 ? 'Deactivate' : 'Activate' }}
                                </button> -->
                                <!-- <button
                                    type="button"
                                    onclick="openConfirmationModal(
                                        {{ $course->status }},
                                        '{{ route($course->status == 1 ? 'deactivateCourse' : 'activateCourse', ['course' => $course]) }}',
                                        '{{ $course->status == 1 ? 'deactivate' : 'activate' }}'
                                    )"
                                    class="delete-btn font-primary font-medium text-third text-[16px] rounded-full py-2 px-4 {{ $course->status == 1 ? 'bg-red' : 'bg-green' }}">
                                    {{ $course->status == 1 ? 'Deactivate' : 'Activate' }}
                                </button> -->
   

                            </div>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <div id="coursePopup" class="hidden">
        <form method="POST" action="{{ route("storeCourse") }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-6">
            {{csrf_field()}}
            <div class="bg-white_70 p-6 rounded-2xl w-full md:w-1/2 xl:w-1/3 shadow-lg  max-h-screen overflow-y-auto">
                <h2 id="popupTitle" class=" font-secondary font-semibold text-[30px] text-secondary mb-4">Add New Course</h2>
                <label class="font-primary block text-primary font-medium text-[18px]">Course Name</label>
                <input id="courseName" name="title" type="text" placeholder="Enter course name" class="font-secondary placeholder:text-gray_50/80 text-[16px] rounded-lg outline-none border p-2 w-full mb-3 bg-White">

                <label class="font-primary block text-primary font-medium text-[18px]">Course Description</label>
                <textarea id="courseDescription" name="description" placeholder="Enter course description" class="font-secondary placeholder:text-gray_50/80 text-[16px] rounded-lg outline-none border p-2 w-full mb-3 bg-White"></textarea>

                <label class="font-primary block text-primary font-medium text-[18px]">Start Date</label>
                <input id="startDate" name="start_date" type="date" class="font-secondary text-gray_50/80 text-[16px] rounded-lg outline-none border p-2 w-full mb-3 bg-White">

                <label class="font-primary block text-primary font-medium text-[18px]">End Date</label>
                <input id="endDate" name="end_date" type="date" class="font-secondary text-gray_50/80 text-[16px] rounded-lg outline-none border p-2 w-full mb-3 bg-White">

                <input name="id" id="id" hidden>
                <div class="flex justify-end">
                    <button type="submit" id="saveBtn" class="font-primary font-medium bg-secondary text-third text-[16px]   rounded-full py-2 px-4">Save</button>
                    <button type="button" id="closePopup" class="ml-3 font-primary font-medium bg-red text-third text-[16px]   rounded-full py-2 px-4">Cancel</button>
                </div>
            </div>
        </form>

    </div>

    <!--  confirmationModal -->
 <!-- Modal -->
 <div id="confirmModal" class="fixed inset-0 flex items-start justify-center z-50 hidden mt-5">
  <div class="bg-White   rounded-xl shadow-xl p-6 w-[90%] max-w-md">
    <h2 class="text-lg font-secondary font-semibold  text-primary"> Confirm Action</h2>
    <p id="modalMessage" class="font-primary text-gray_50 mt-2">Do you want to activate this course?</p>
    <div class="flex justify-end gap-2  mt-3">
      <button id="cancelBtn" class="p-3 rounded-xl bg-red text-third font-primary text-[16px] ">Cancel</button>
      <button id="confirmBtn" class="p-3 rounded-xl bg-green  text-third font-primary text-[16px] ">Confirm</button>
    </div>
  </div>
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



<script>
    function openPopup(mode, courseTitle = '', courseDescription = '', startDate = '', endDate = '', coursePrice = '',id = -1) {
        document.getElementById('coursePopup').classList.remove('hidden');

        if (mode === 'edit') {
            document.getElementById('popupTitle').innerText = 'Edit Course';
            document.getElementById('courseName').value = courseTitle;
            document.getElementById('courseDescription').value = courseDescription;
            document.getElementById('startDate').value = startDate;
            document.getElementById('endDate').value = endDate;
            document.getElementById('id').value = id;
        } else {
            document.getElementById('popupTitle').innerText = 'Add New Course';
            document.getElementById('courseName').value = '';
            document.getElementById('courseDescription').value = '';
            document.getElementById('startDate').value = '';
            document.getElementById('endDate').value = '';
            document.getElementById('id').value = -1;
        }
    }


    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const preview = document.getElementById('preview');
            preview.src = reader.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    document.getElementById('closePopup')?.addEventListener('click', function() {
        document.getElementById('coursePopup').classList.add('hidden');
    });



    // confirmationModal
    document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('confirmModal');
    const confirmBtn = document.getElementById('confirmBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const modalMessage = document.getElementById('modalMessage');
    let actionUrl = '';

    // Handle click on Activate/Deactivate or Join/Exit buttons
    document.querySelectorAll('.status-btn').forEach(button => {
      button.addEventListener('click', () => {
        const status = button.dataset.status;
        actionUrl = button.dataset.actionUrl;

        // Change modal message based on the button clicked
        if (status == 'join') {
          modalMessage.textContent = 'Do you want to join this course?';
        } else if (status == 'exit') {
          modalMessage.textContent = 'Do you want to exit this course?';
        } else if (status == '1') {  // If status is '1', it means deactivate
          modalMessage.textContent = 'Do you want to deactivate this course?';
        } else if (status == '0') {  // If status is '0', it means activate
          modalMessage.textContent = 'Do you want to activate this course?';
        }

        modal.classList.remove('hidden'); // Show the modal
      });
    });

    // Confirm action (navigate to the action URL)
    confirmBtn.addEventListener('click', () => {
      window.location.href = actionUrl;
    });

    // Cancel action (hide the modal)
    cancelBtn.addEventListener('click', () => {
      modal.classList.add('hidden');
    });
});
</script>

@vite(['resources/js/main.js'])
@include('partials.echo-notifications')
</body>
</html>
