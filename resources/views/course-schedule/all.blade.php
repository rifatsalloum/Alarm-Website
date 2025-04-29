<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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


    <!-- <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css"> -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

    <style>
        [x-cloak] {
            display: none;
        }

     /* scroll */
  .overflow-x-auto {
    overflow-x: auto;
    white-space: nowrap;
  }

  /*  custom scroll */
  .overflow-x-auto::-webkit-scrollbar {
    height: 8px;
  }

  .overflow-x-auto::-webkit-scrollbar-track {
    background: #f0f0f0;
  }

  .overflow-x-auto::-webkit-scrollbar-thumb {
    background-color: #8C94A3;
    border-radius: 10px;
  }

  .overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background-color: #8C94A3;
  }


</style>
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



<!-- content calendar -->
<section class="mt-[50px] ">

    <div class="antialiased ">
        <div x-data="app()" x-init="[init(),initDate(), getNoOfDays()]" x-cloak>
            <div class="px-8 lg:px-20 ">

                <div class="bg-white rounded-lg shadow overflow-hidden">

                    <div class="flex items-center justify-between py-2 px-6">
                        <!-- month + year -->
                        <div>
                            <span x-text="MONTH_NAMES[month]" class="font-secondary  text-[20px] font-bold text-gray-800"></span>
                            <span x-text="year" class="font-secondary  ml-1 text-[20px] text-primary "></span>
                        </div>
                        <!-- right and left arrows -->
                        <div class="border rounded-lg px-1" style="padding-top: 2px;">
                            <button
                                type="button"
                                class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center"
                                :class="{'cursor-not-allowed opacity-25': month == 0 }"
                                :disabled="month == 0 ? true : false"
                                @click="month--; getNoOfDays()">
                                <svg class="h-6 w-6 text-secondary inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <div class="border-r inline-flex h-6"></div>
                            <button
                                type="button"
                                class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1"
                                :class="{'cursor-not-allowed opacity-25': month == 11 }"
                                :disabled="month == 11 ? true : false"
                                @click="month++; getNoOfDays()">
                                <svg class="h-6 w-6 text-secondary inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="-mx-1 -mb-1 overflow-x-auto ">
                        <!-- days -->
                        <div class="flex flex-wrap  border-t " >
                            <template x-for="(day, index) in DAYS" :key="index">
                                <div style="width: 14.28% ; height: 50px" class="px-2 py-4 border-r text-center">
                                    <div
                                        x-text="day"
                                        class="text-primary text-sm uppercase tracking-wide font-bold text-center ">
                                    </div>
                                </div>
                            </template>
                        </div>
                        <!-- days of the month -->
                        <div class="flex flex-wrap border-t border-l">
                            <template x-for="blankday in blankdays">
                                <div
                                    style="width: 14.28%; min-height: 120px"
                                    class=" text-center border-r border-b px-4 pt-2"
                                ></div>
                            </template>
                            <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                                <div style="width: 14.28%; min-height: 120px" class="font-primary  px-4 pt-2 border-r border-b relative">
                                    <div
                                        @click="showEventModal(date)"
                                        x-text="date"
                                        class="inline-flex w-6 h-6 items-center justify-center cursor-pointer text-center leading-none rounded-full transition ease-in-out duration-100"
                                        :class="{'font-primary bg-secondary text-white': isToday(date) == true, 'text-gray-700 hover:bg-blue-200': isToday(date) == false }"
                                    ></div>

                                    <!-- Content Course Schedule -->
                                    <div style="min-height: 120px;   " class=" my-1   overflow-x-auto space-y-2 lg:space-y-2  ">
                                        <div class="  w-full overflow-hidden ">
                                        <template x-for="event in events.filter(e => new Date(e.event_date).toDateString() ===  new Date(year, month, date).toDateString() )">
                                            <!-- color theme -->
                                            <div
                                                class=" p-2  rounded-lg mt-1  border w-full overflow-x-auto "
                                                :class="{
															'border-blue-200 text-primary bg-blue-100': event.event_theme === 'blue',
															'border-red text-third bg-red': event.event_theme === 'red',
															'border-yellow text-third bg-yellow': event.event_theme === 'yellow',
															'border-green text-third bg-green': event.event_theme === 'green',
															'border-purple text-primary bg-purple': event.event_theme === 'purple'
														}"
                                            >
                                                <!-- select courses -->
                                                <div x-show="event.selected_course">
                                                    <h2 x-text="(courses.find(course => course.id == event.selected_course) || {}).title" class="font-primary font-bold text-[16px] truncate leading-tight"></h2>
                                                </div>

                                                <!-- Date  -->
                                                <h3 x-text="event.event_date" class="font-primary font-medium text-[12px]    mt-[6px]" ></h3>

                                                <!-- Start date + End date -->
                                                <span  class="font-primary font-medium    truncate leading-tight  mt-[2px] inline-block text-[12px]   ">
															<span x-text="new Date('1970-01-01T' + event.event_start).toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit', hour12: false })"></span>
															-
															<span  x-text="new Date('1970-01-01T' + event.event_end).toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit', hour12: false })"></span>
														</span>

                                                <!-- Buttons for Edit and Delete -->
                                                <div class="mt-2 flex  justify-between gap-2">
                                                    <!-- Edit Button -->
                                                    <button type="button" class="font-primary font-medium text-[12px]  bg-third shadow-xl text-green px-2 py-1 rounded-lg  " @click="{{ $user->type === "Trainer"? "editEvent(event)" : "showEvent(event)" }}">
                                                        {{ $user->type === "Trainer"? "Edit" : "Show" }}
                                                    </button>

                                                    @if($user->type === "Trainer")
                                                    <!-- Delete Button -->
                                                    <button type="button" class="font-primary font-medium text-[12px]  bg-third shadow-xl text-red px-2 py-1 rounded-lg  " @click="deleteEvent(event)">
                                                        Delete
                                                    </button>

                                                    @endif
                                                </div>

                                            </div>
                                        </template>
                                        </div>

                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div style=" background-color: rgba(0, 0, 0, 0.8)" class="fixed z-40 top-0 right-0 left-0 bottom-0 h-full w-full" x-show.transition.opacity="openEventModal">
                <div class="p-4 max-w-xl mx-auto  absolute left-0 right-0 overflow-hidden ">
                    <div class="shadow absolute right-0 top-0 w-10 h-10 rounded-full bg-white text-gray-500 hover:text-gray-800 inline-flex items-center justify-center cursor-pointer"
                         x-on:click="openEventModal = !openEventModal">
                        <svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M16.192 6.344L11.949 10.586 7.707 6.344 6.293 7.758 10.535 12 6.293 16.242 7.707 17.656 11.949 13.414 16.192 17.656 17.606 16.242 13.364 12 17.606 7.758z" />
                        </svg>
                    </div>

                    <div class="shadow w-full rounded-lg bg-white overflow-hidden  block p-8">

                        <h2 class="font-secondary font-semibold text-[30px] text-secondary border-b pb-2 mb-4">Add Course Details</h2>
                        <!-- Select Course  -->
                        <div class="mb-4">
                            <div class=" flex items-center gap-1">
										<label class=" mb-1  text-primary font-semibold tracking-wide">Course</label>
										<span class="font-primary font-medium text-red text-[10px] inline-block"> (required) </span>
							</div>
                            <div class="relative mt-1">
                                <select :disabled="isReadOnly" @change="selected_course = $event.target.value;" x-model="selected_course" class="block appearance-none w-full bg-gray-200 border-2 border-gray-200 hover:border-gray-500 px-4 py-2 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-blue-500 text-gray-700">
                                    <template x-for="course in courses" :key="course.id">
                                        <option :value="course.id" x-text="course.title"></option>
                                    </template>
                                </select>
                            </div>

                        </div>
                        <!-- Course Date -->
                        <div class="mb-4">

                            <label class="mb-1 block text-primary font-semibold tracking-wide">Lesson Date</label>

                            <input class="font-primary bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="event_date" readonly>
                        </div>


                        <!-- Start Time -->
                        <div class="mb-4">
                           <div class=" flex items-center gap-1">
                                <label class="mb-1 block text-primary font-semibold tracking-wide">Start Time</label>
                                <span class="  font-primary font-medium text-red text-[10px] inline-block  "> (required) </span>
                            </div>
                            <input :disabled="isReadOnly" type="time"
                                   class="font-primary bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                                   x-model="event_start">
                        </div>

                        <!-- End Time -->
                        <div class="mb-4">
                             <div class=" flex items-center gap-1">
                                <label class="mb-1 block text-primary font-semibold tracking-wide">End Time</label>
                                <span class="  font-primary font-medium text-red text-[10px] inline-block  "> (required) </span>
                            </div>
                            <input :disabled="isReadOnly" type="time"
                                   class="font-primary bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                                   x-model="event_end">
                        </div>

                         <!-- message validationError -->
                         <div x-show="timeValidationErrors.length" class="bg-red/50 border border-red text-red rounded-lg px-4 py-2 font-primary font-medium text-[14px] ">
                            <template x-for="error in timeValidationErrors" :key="error">
                                <p class="flex items-center space-x-2">

                                    <span x-text="error"></span>
                                </p>
                            </template>
                        </div>
                        <!-- Course  Theme -->
                        <div class="inline-block w-64 mb-4">
                            <label class="mb-1 block text-primary font-semibold tracking-wide">Select a theme</label>
                            <div class="relative">
                                <select :disabled="isReadOnly" @change="event_theme = $event.target.value;" x-model="event_theme" class="block appearance-none w-full bg-gray-200 border-2 border-gray-200 hover:border-gray-500 px-4 py-2 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-blue-500 text-gray-700">
                                    <template x-for="(theme, index) in themes">
                                        <option :value="theme.value" x-text="theme.label"></option>
                                    </template>

                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>


                        @if($user->type === "Trainer")
                        <div class="mt-8 text-right">
                            <button type="button" class="bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 border border-gray-300 rounded-lg shadow-sm mr-2" @click="openEventModal = !openEventModal">
                                Cancel
                            </button>
                            <button type="button" class="bg-secondary hover:bg-secondary/80 text-third font-semibold py-2 px-4 border border-White rounded-lg shadow-sm" @click="addEvent()">
                                Save Event
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /Modal -->
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
                <h1 class="font-secondary font-semibold text-[24px] text-primary">Alarm Website</h1>

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

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>

    const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

    function app() {
        return {

            month: '',
            year: '',
            no_of_days: [],
            blankdays: [],
            days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
              // ValidationErrors
            timeValidationErrors: [],


            events: @json($courseSchedules),
            selected_course: '',
            event_date: '',
            event_start: '',
            event_end: '',
            event_theme: 'blue',
            currentEventIndex: undefined,
            openEventModal: false,



            courses: @json($courses),

            themes: [
                {
                    value: "blue",
                    label: "Blue Theme"
                },
                {
                    value: "red",
                    label: "Red Theme"
                },
                {
                    value: "yellow",
                    label: "Yellow Theme"
                },
                {
                    value: "green",
                    label: "Green Theme"
                },
                {
                    value: "purple",
                    label: "Purple Theme"
                }
            ],

            openEventModal: false,

            init() {
                if (this.courses.length > 0) {
                    this.selected_course = this.courses[0].id; // Assign first course's id
                }
                this.isReadOnly = false;
            },

            initDate() {
                let today = new Date();
                this.month = today.getMonth();
                this.year = today.getFullYear();
                this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
            },

            isToday(date) {
                const today = new Date();
                const d = new Date(this.year, this.month, date);

                return today.toDateString() === d.toDateString() ? true : false;
            },

            showEventModal(date) {
                // open the modal
                this.openEventModal = true;
                this.event_date = new Date(this.year, this.month, date).toDateString();

                this.id = '';
                this.selected_course = this.courses.length > 0? this.courses[0].id : '';
                this.event_start = '';
                this.event_end = '';
                this.event_theme = 'blue';
            },

            // Function to edit an event
            editEvent(event) {
                this.id = event.id;
                this.event_date = event.event_date;
                this.selected_course = event.selected_course;
                this.event_start = event.event_start;
                this.event_end = event.event_end;
                this.event_theme = event.event_theme;

                // Find the actual index of the event
                this.currentEventIndex = this.events.findIndex(e => e.event_date === event.event_date && e.selected_course === event.selected_course && e.event_start === event.event_start && e.event_end === event.event_end);

                //this.isReadOnly = false;
                this.openEventModal = true;
            },

            showEvent(event) {
                this.id = event.id;
                this.event_date = event.event_date;
                this.selected_course = event.selected_course;
                this.event_start = event.event_start;
                this.event_end = event.event_end;
                this.event_theme = event.event_theme;

                // Optionally, you can compute the index for reference
                this.currentEventIndex = this.events.findIndex(e =>
                    e.id === event.id
                );

                // Set a flag indicating that the modal is in "read-only" mode
                this.isReadOnly = true;
                this.openEventModal = true;
            },


            // Function to delete an event
            deleteEvent(event) {
                axios.post('{{ route("destroyCourseSchedule") }}', {id:event.id}, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => {
                        this.events = this.events.filter(e => !(e.id === event.id));
                    })
                    .catch(error => {
                        console.error("Error saving event:", error);
                        // Optionally, show an error message to the user.
                    });
            },

            // Function to save an event (edit or add)
            addEvent() {
                // ValidationErrors
                this.timeValidationErrors = []; // Clear old errors

                if (!this.selected_course || !this.event_start || !this.event_end) {
                    this.timeValidationErrors = ['Please fill in all required fields.'];
                    return;
                }




                    const start = new Date(`2000-01-01T${this.event_start}`);
                    const end = new Date(`2000-01-01T${this.event_end}`);
                    const diffHours = (end - start) / (1000 * 60 * 60);

                      // ValidationErrors
                     if (end <= start) {
                        this.timeValidationErrors.push("End time must be after start time.");
                    }

                    if (diffHours > 4) {
                        this.timeValidationErrors.push("Maximum allowed duration is 4 hours.");
                    }

                    if (this.timeValidationErrors.length > 0) {
                        return; // stop if errors
                    }

                // Option: use raw time if your API expects 24-hour format;
                // if you need to convert to 12-hour format, ensure your backend accepts that.
                // For this example, I'll assume the input time is in "HH:mm" and we'll use it as-is.


                const newEvent = {
                    // Validation expects "selected_course" as integer; ensure selected_course holds the course id.
                    id : this.id? this.id : -1,
                    selected_course: parseInt(this.selected_course),
                    event_date: this.formatDate(this.event_date),    // should be in YYYY-MM-DD format
                    event_start: this.event_start,  // e.g. "14:00"
                    event_end: this.event_end,      // e.g. "15:00"
                    event_theme: this.event_theme,  // e.g. "blue"
                };

                const existingIndex = this.events.findIndex(e => e.id === newEvent.id);
                // Post the data to the storeCourseSchedule route
                axios.post('{{ route("storeCourseSchedule") }}', newEvent, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => {
                        newEvent.id = response.data.id;
                        // Optionally, update your local events list if needed:
                        if (existingIndex !== -1) {
                            // Update existing event
                            this.events[existingIndex] = newEvent;
                        } else {
                            // Push new event
                            this.events.push(newEvent);
                        }

                        // Reset values after saving
                        this.selected_course = '';
                        this.event_date = '';
                        this.event_start = '';
                        this.event_end = '';
                        this.event_theme = 'blue';
                        this.openEventModal = false;  // Close the modal
                    })
                    .catch(error => {
                        console.error("Error saving event:", error);
                        // Optionally, show an error message to the user.
                    });
            },


            getNoOfDays() {
                let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
                let firstDayOfMonth = new Date(this.year, this.month, 1).getDay();

                this.blankdays = Array(firstDayOfMonth).fill(null);
                this.no_of_days = Array.from({ length: daysInMonth }, (_, i) => i + 1);
            },
            formatDate(dateString) {
                const date = new Date(dateString);
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0'); // months are 0-indexed
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            },

        }
    }
</script>


@vite(['resources/js/main.js'])
@include('partials.echo-notifications')
</body>
</html>
