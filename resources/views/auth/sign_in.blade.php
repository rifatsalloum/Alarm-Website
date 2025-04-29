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
    <!--<link rel="stylesheet" href="../../css/all.min.css">-->
    @vite(['resources/css/all.min.css'])

    <!-- main css -->
    @vite(['resources/css/output.css'])
</head>
<body >

    <!-- Sign in -->

    <section class="bg-hero_login bg-no-repeat bg-center bg-cover w-full h-screen flex items-center ">

        <div class="px-8 lg:px-[150px]  ">

            <!-- content -->
            <div class="w-[500px]">
                <!-- form -->
                 <div class=" shadow-login  w-full p-14  h-full bg-third/30 rounded-xl">
                    <form method="POST" action="{{ route('sign_in') }}" id="myForm">
                        {{csrf_field()}}
                        <div class="flex items-center flex-col">
                            <h1 class="font-secondary font-bold text-[38px] text-third  uppercase">
                                Sign in
                            </h1>

                        </div>


                         <!-- line -->
                         <div class="w-full h-[1px] bg-third/70 my-3"></div>

                        <!-- email -->
                         
                        <div class=" flex items-center gap-1 mt-5">
                                <label class="mb-1 block   font-primary text-White font-semibold text-[20px] ">Email</label>
                                <span class="  font-primary font-medium text-red text-[10px] inline-block  "> (required) </span>
                        </div>
                        <input type="email" name="email" placeholder="Email "
                        class=" mt-2 w-full bg-gray_20 font-primary text-[12px] placeholder:text-primary rounded-2xl
                        p-4 outline-none
                        "
                        >
                        <!-- Password  -->
                        <div class=" flex items-center gap-1 mt-4">
                                <label class="mb-1 block  font-primary text-White font-semibold text-[20px]">password</label>
                                <span class="  font-primary font-medium text-red text-[10px] inline-block  "> (required) </span>
                        </div>
                        <input type="password" name="password" placeholder="*************"
                        class=" mt-2 w-full bg-gray_20 font-primary text-[12px] placeholder:text-primary rounded-2xl
                        p-4 outline-none
                        "
                        >

                        <!-- Remember me  -->
                        <div class="flex items-center justify-between mt-5">
                            <div class="flex items-center gap-1">
                                <input type="checkbox" name="" id="">
                                <label for="" class="font-primary text-[13px] text-third">Remember me</label>
                            </div>
                        </div>
                        <!-- btn -->

                        <div class="flex items-center justify-center bg-secondary rounded-2xl  mt-5 p-3 ">
                            <input type="submit"  value="Sign in" class="font-primary  font-semibold text-[24px] text-third"> </input>


                        </div>





                         <span  class="font-primary text-[12px] text-third/80 inline-block mt-7">Already have an account?
                            <a href="{{route("register")}}" class="text-third font-medium text-[14px]">Sign Up</a>
                         </span>
                     </form>
                 </div>


            </div>
        </div>

    </section>



    @vite(['resources/js/main.js'])
</body>
</html>
