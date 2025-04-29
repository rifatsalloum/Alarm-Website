<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ai Alarm</title>

    <!-- font google Epilogue -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">


     <!-- font google Roboto -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!--<link rel="stylesheet" href="../../css/all.min.css">-->
    @vite(['resources/css/all.min.css'])

    <!-- main css -->
    @vite(['resources/css/output.css'])
</head>
<body >

    <!-- Sign in -->

    <section class="bg-hero_logout bg-no-repeat bg-center bg-cover w-full h-screen flex items-center justify-end ">

        <div class="px-8 lg:pr-[200px]  ">

            <!-- content -->
            <div class="w-[500px]">
                <!-- form -->
                 <div class=" shadow-login  w-full p-14  h-full bg-White rounded-xl">
                    <form method="POST" action="{{ route('sign_up') }}" >
                        {{csrf_field()}}
                        <div class="flex items-center flex-col">
                            <h1 class="font-secondary font-bold text-[38px] text-primary  uppercase">
                                Sign up
                            </h1>

                        </div>

                        <!-- line -->
                        <div class="w-full h-[1px] bg-secondary/70 my-3"></div>

                         <!-- name -->
                         <div class=" flex items-center gap-1 mt-5">
                                <label class="mb-1 block   font-primary text-primary font-medium text-[16px] ">Name</label>
                                <span class="  font-primary font-medium text-red text-[10px] inline-block  "> (required) </span>
                        </div>
                         <input type="text" name="name" placeholder="Name "
                         class=" mt-2 w-full bg-gray_20 font-primary text-[12px] placeholder:text-primary rounded-2xl
                         p-4 outline-none
                         "
                         >
                        <!-- email -->
                        <div class=" flex items-center gap-1 mt-3">
                                <label class="mb-1 block   font-primary text-primary font-medium text-[16px] ">Email</label>
                                <span class="  font-primary font-medium text-red text-[10px] inline-block  "> (required) </span>
                        </div>
                        <input type="email" name="email" placeholder="Email "
                        class=" mt-2 w-full bg-gray_20 font-primary text-[12px] placeholder:text-primary rounded-2xl
                        p-4 outline-none
                        "
                        >
                        <!-- Password  -->
                        <div class=" flex items-center gap-1 mt-3">
                                <label class="mb-1 block  font-primary text-primary font-medium text-[16px]">Password</label>
                                <span class="  font-primary font-medium text-red text-[10px] inline-block  "> (required) </span>
                        </div>
                        <input type="password" name="password" placeholder="****************"
                        class=" mt-2 w-full bg-gray_20 font-primary text-[12px] placeholder:text-primary rounded-2xl
                        p-4 outline-none
                        "
                        >
                        <!-- Password confirmation  -->
                        <div class=" flex items-center gap-1 mt-3">
                                <label class="mb-1 block  font-primary text-primary font-medium text-[16px]"> Password</label>
                                <span class="  font-primary font-medium text-red text-[10px] inline-block  "> (required) </span>
                        </div>
                        <input type="password" name="password_confirmation" placeholder="****************"
                               class=" mt-3 w-full bg-gray_20 font-primary text-[12px] placeholder:text-primary rounded-2xl
                        p-4 outline-none
                        "
                        >
                        <!-- Specialization -->
                        <div class=" flex items-center gap-1 mt-3">
                                <label class="mb-1 block  font-primary text-primary font-medium text-[16px]">Specialize</label>
                                <span class="  font-primary font-medium text-red text-[10px] inline-block  "> (required) </span>
                        </div>
                        <input type="text" name="specialize" class="mt-2 w-full bg-gray_20 font-primary text-[12px] placeholder:text-primary rounded-2xl
                        p-4 outline-none" placeholder="e.g., UI/UX, Web Development, Training... ">
                        <!-- Account Type -->
                        <div>

                            <select name="type" class="mt-3 w-full bg-gray_20 font-primary text-[12px] text-primary rounded-2xl
                            p-4 outline-none " required>
                                <option value="Trainer" default>Trainer</option>
                                <option value="Trainee">Trainee</option>
                            </select>
                        </div>
                        <!-- btn -->

                        <div class="flex items-center justify-center bg-secondary rounded-2xl  mt-5 p-3 ">
                            <input type="submit" value="Sign up" class="font-primary  font-semibold text-[24px] text-third"> </input>


                        </div>





                         <span  class="font-primary text-[12px] text-primary inline-block mt-7">Already have an account?
                            <a href={{route("login")}} class="text-primary font-medium text-[14px]">Sign In</a>
                         </span>
                     </form>
                 </div>


            </div>
        </div>

    </section>



    @vite(['resources/js/main.js'])
</body>
</html>
