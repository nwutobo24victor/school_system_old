<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="{{ asset('img/cloe-removebg.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/popper.min.js') }}"></script>
    <script src="{{ asset('/js/flowbite.min.js') }}"></script>
    <script src="{{ asset('/axios/axios.min.js') }}"></script>
    <script src="{{ asset('/sweetalert/sweetalert2.all.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/sweetalert/sweetalert2.min.css') }}">

    <script defer src="{{ asset('/alpine/alpine-ajax.min.js') }}"></script>
    <script defer src="{{ asset('/alpine/alpinejs.min.js') }}"></script>


    <style>
        [aria-busy] {
            --loading-size: 64px;
            --loading-stroke: 6px;
            --loading-duration: 1s;
            position: relative;
            opacity: .75
        }

        [aria-busy]:before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: var(--loading-size);
            height: var(--loading-size);
            margin-top: calc(var(--loading-size) / 2 * -1);
            margin-left: calc(var(--loading-size) / 2 * -1);
            border: var(--loading-stroke) solid rgba(0, 0, 0, 0.15);
            border-radius: 50%;
            border-top-color: rgba(0, 0, 0, 0.5);
            animation: rotate calc(var(--loading-duration)) linear infinite;
        }

        @keyframes rotate {
            100% {
                transform: rotate(360deg);
            }
        }
    </style>

</head>

<body class="font-sans text-gray-900 bg-gray-100 antialiased">
    <div class="w-full min-h-screen">
        <!-----HEADER------>
        <div class="block h-16 bg-white p-2 border border-b-2 border-gray-400">
            <div class="relative">
                <div class="absolute left-0">
                    <span class="flex">
                        <img src="{{ asset('img/cloe-removebg.png') }}" width="30" class="rounded-full">
                        <span class="text-black font-semibold text-xl p-2">Cloé Edu <span
                                class="lg:inline-block hidden">School Management System</span></span>
                    </span>
                </div>
                <div class=" absolute right-0">
                    <span class="flex gap-2">
                        <a href="" class="py-2 px-2 mr-5 hover:text-gray-500"><i class="fad fa-comments"></i></a>
                        <button id="rightMenuToggle"
                            class="hidden lg:flex bg-gray-200 hover:bg-black hover:text-white rounded-lg p-2">
                            <img src="{{ asset('upload_photo/' . Auth::user()->passport_photo) }}"
                                style="width: 35px; height:35px;" class="rounded-full mr-2">
                            <span class="font-semibold py-1 capitalize">{{ Auth::user()->username }} <i
                                    class="fas fa-caret-down"></i></span>
                        </button>

                        <button id="sideBarMenuToggle"
                            class="hover:bg-black hover:text-white rounded-lg p-2 block lg:hidden">
                            <i class="fas fa-bars"></i>
                        </button>
                        
                    </span>
                </div>
            </div>
        </div>
        <!-----END HEADER------>


        <!-----RIGHT MENU------>
        <div class="block relative">
            <div id="rightMenu" class="absolute right-4 w-[200px] hidden">

                <div
                    class="text-gray-500 menu md:mt-5 md:w-full rounded bg-white shadow-md absolute z-20 right-0 w-40 mt-5 py-2 animated faster fadeIn">

                    <!-- item -->
                    <a class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out"
                        href="{{ route('profile.edit') }}">
                        <i class="fad fa-user-edit text-xs mr-1"></i>
                        edit my profile
                    </a>
                    <!-- end item -->

                    <!-- item -->
                    <a class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out"
                        href="#">
                        <i class="fad fa-comments text-xs mr-1"></i>
                        messages
                    </a>
                    <!-- end item -->

                    <!-- item -->
                    <a class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out"
                        href="#">
                        <i class="fad fa-badge-check text-xs mr-1"></i>
                        to do
                    </a>
                    <!-- end item -->

                    <!-- item -->
                    <a class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out"
                        href="#">
                        <i class="fad fa-wrench text-xs mr-1"></i>
                        settings
                    </a>
                    <!-- end item -->

                    <hr>

                    <!-- item -->
                    <form method="post" action="{{ route('logout') }}"
                        class="flex px-4 py-2 capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out">
                        <i class="fad fa-user-times text-xs mr-1 py-1"></i>
                        @csrf
                        <button class="bg-transparent w-full capitalize text-left">Sign out</button>
                    </form>
                    <!-- end item -->

                </div>

            </div>

        </div>
        <!-----RIGHT MENU------>



        <!-----BODY------>
        <section class="flex gap-3 overflow-hidden">
            <!-----SIDE BAR MENU----->
            <div id="sideBarMenu" class="lg:block hidden bg-white border-r-2 border-b-2">

                <div class="w-64 bg-white border-gray-400 p-2 min-h-screen">
                    <div class="flex flex-col">

                        <p class="uppercase text-xs text-gray-600 mb-4 tracking-wider">homes</p>

                        <!-- link -->
                        <a href="{{ route('dashboard') }}"
                            class="@if (request()->routeIs('dashboard')) bg-gray-200 text-teal-600 @endif mb-1 capitalize font-medium text-sm p-2 rounded hover:bg-gray-200 hover:text-teal-600 transition ease-in-out duration-500">
                            <i class="fad fa-chart-pie text-xs mr-2"></i>
                            dashboard
                        </a>
                        <!-- end link -->

                        <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider">Tables</p>

                        <!-- link -->
                        <a href="{{ route('student') }}"
                            class="@if (request()->routeIs('student') || request()->routeIs('student.*')) bg-gray-200 text-teal-600 @endif mb-1 capitalize font-medium text-sm p-2 rounded hover:bg-gray-200 hover:text-teal-600 transition ease-in-out duration-500">
                            <i class="fad fa-user-graduate text-xs mr-2"></i>
                            Students
                        </a>
                        <!-- end link -->

                        <!-- link -->
                        <a href="{{ route('parent') }}"
                            class="@if (request()->routeIs('parent') || request()->routeIs('parent.*')) bg-gray-200 text-teal-600 @endif mb-1 capitalize font-medium text-sm p-2 rounded hover:bg-gray-200 hover:text-teal-600 transition ease-in-out duration-500">
                            <i class="fad fa-user-secret text-xs mr-2"></i>
                            Parents
                        </a>
                        <!-- end link -->

                        <!-- link -->
                        <a href="{{ route('teacher') }}"
                            class="@if (request()->routeIs('teacher') || request()->routeIs('teacher.*')) bg-gray-200 text-teal-600 @endif mb-1 capitalize font-medium text-sm p-2 rounded hover:bg-gray-200 hover:text-teal-600 transition ease-in-out duration-500">
                            <i class="fad fa-user-tie text-xs mr-2"></i>
                            Teachers
                        </a>
                        <!-- end link -->

                        <!-- link -->
                        <a href="{{ route('staff') }}"
                            class="@if (request()->routeIs('staff') || request()->routeIs('staff.*')) bg-gray-200 text-teal-600 @endif mb-1 capitalize font-medium text-sm p-2 rounded hover:bg-gray-200 hover:text-teal-600 transition ease-in-out duration-500">
                            <i class="fad fa-users text-xs mr-2"></i>
                            Other Staffs
                        </a>
                        <!-- end link -->



                        <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider">Academic</p>
                        
                        <!-- link -->
                        <div class="@if (
                            request()->routeIs('class') || request()->routeIs('class.*') || 
                            request()->routeIs('department') || request()->routeIs('department.*') || 
                            request()->routeIs('section') || request()->routeIs('section.*') ||
                            request()->routeIs('subject') || request()->routeIs('subject.*') ||
                            request()->routeIs('syllabus') || request()->routeIs('syllabus.*') ||
                            request()->routeIs('timetable') || request()->routeIs('timetable.*') ||
                            request()->routeIs('assignment') || request()->routeIs('assignment.*') ||
                            request()->routeIs('suspension') || request()->routeIs('suspension.*')
                        ) bg-gray-200 text-teal-600 @endif
                           mb-1 capitalize font-medium text-sm p-2 rounded hover:bg-gray-200 hover:text-teal-600 transition ease-in-out duration-500"
                             x-data="{
                                academic: false,
                            }">
                            <div class="flex items-center" x-on:click="academic = !academic"
                                x-bind:class="{ 'bg-teal-600 px-2 hover:text-white text-black': academic }">
                                <span class="block w-full mb-1 cursor-pointer">
                                    <i class="fad fa-sitemap text-xs mr-2"></i> Academic Modules
                                </span>
                                <i class="fad fa-angle-down text-lg mr-2"></i>
                            </div>

                            <div class="w-full px-2 pt-2 bg-gray-200 border-t-4 border-teal-600 " x-show="academic">
                                <!-- link -->
                                <a href="{{ route('class') }}"
                                    class="@if(request()->routeIs('class') || request()->routeIs('class.*')) bg-white @endif rounded block font-medium text-sm text-teal-600 hover:bg-white p-2 transition ease-in-out duration-500">
                                    <i class="fad fa-minus text-xs mr-2"></i> Class
                                </a>
                                <!-- end link -->

                                <!-- link -->
                                <a href="{{ route('department') }}"
                                    class="@if(request()->routeIs('department') || request()->routeIs('department.*')) bg-white @endif rounded block font-medium text-sm text-teal-600 hover:bg-white p-2 transition ease-in-out duration-500">
                                    <i class="fad fa-minus text-xs mr-2"></i> Department
                                </a>
                                <!-- end link -->

                                <!-- link -->
                                <a href="{{ route('section') }}"
                                    class="@if(request()->routeIs('section') || request()->routeIs('section.*')) bg-white @endif rounded block font-medium text-sm text-teal-600 transition hover:bg-white p-2 ease-in-out duration-500">
                                    <i class="fad fa-minus text-xs mr-2"></i> Section
                                </a>
                                <!-- end link -->

                                <!-- link -->
                                <a href="{{ route('subject') }}"
                                    class="@if(request()->routeIs('subject') || request()->routeIs('subject.*')) bg-white @endif rounded block font-medium text-sm text-teal-600 hover:bg-white p-2 transition ease-in-out duration-500">
                                    <i class="fad fa-minus text-xs mr-2"></i> Subject
                                </a>
                                <!-- end link -->

                                <!-- link -->
                                <a href="{{ route('syllabus') }}"
                                    class="@if(request()->routeIs('syllabus') || request()->routeIs('syllabus.*')) bg-white @endif rounded block font-medium text-sm text-teal-600 hover:bg-white p-2 transition ease-in-out duration-500">
                                    <i class="fad fa-minus text-xs mr-2"></i> Syllabus
                                </a>
                                <!-- end link -->

                                <!-- link -->
                                <a href="{{ route('timetable') }}"
                                    class="@if(request()->routeIs('timetable') || request()->routeIs('timetable.*')) bg-white @endif block font-medium text-sm text-teal-600 transition hover:bg-white p-2 ease-in-out duration-500">
                                    <i class="fad fa-minus text-xs mr-2"></i> Time Table
                                </a>
                                <!-- end link -->

                                <!-- link -->
                                <a href="{{ route('assignment') }}"
                                    class="@if(request()->routeIs('assignment') || request()->routeIs('assignment.*')) bg-white @endif rounded block font-medium text-sm text-teal-600 transition hover:bg-white p-2 ease-in-out duration-500">
                                    <i class="fad fa-minus text-xs mr-2"></i> Assignment
                                </a>
                                <!-- end link -->

                                <!-- link -->
                                <a href="{{ route('suspension') }}"
                                    class="@if(request()->routeIs('suspension') || request()->routeIs('suspension.*')) bg-white @endif rounded block font-medium text-sm text-teal-600 transition hover:bg-white p-2 ease-in-out duration-500">
                                    <i class="fad fa-minus text-xs mr-2"></i> Suspension
                                </a>
                                <!-- end link -->

                            </div>
                        </div>
                        <!-- end link -->

                        <!-- link -->
                        <div class="mb-1 capitalize font-medium text-sm p-2 rounded hover:bg-gray-200 hover:text-teal-600 transition ease-in-out duration-500"
                            x-data="{
                                attendance: false,
                            }">
                            <div class="flex items-center" x-on:click="attendance = !attendance"
                                x-bind:class="{ 'bg-teal-600 px-2 hover:text-white': attendance }">
                                <span class="block w-full mb-1 cursor-pointer">
                                    <i class="fad fa-sitemap text-xs mr-2"></i> Attendance
                                </span>
                                <i class="fad fa-angle-down text-lg mr-2"></i>
                            </div>

                            <div class="w-full px-2 pt-2 bg-gray-200 border-t-4 border-teal-600 " x-show="attendance">
                                <!-- link -->
                                <a href="{{ route('dashboard') }}"
                                    class="rounded block font-medium text-sm text-teal-600 hover:bg-white p-2 transition ease-in-out duration-500">
                                    <i class="fad fa-minus text-xs mr-2"></i> Student Attendance
                                </a>
                                <!-- end link -->

                                <!-- link -->
                                <a href="{{ route('dashboard') }}"
                                    class="rounded block font-medium text-sm text-teal-600 hover:bg-white p-2 transition ease-in-out duration-500">
                                    <i class="fad fa-minus text-xs mr-2"></i> Teacher Attendance
                                </a>
                                <!-- end link -->

                                <!-- link -->
                                <a href="{{ route('dashboard') }}"
                                    class="rounded block font-medium text-sm text-teal-600 hover:bg-white p-2 transition ease-in-out duration-500">
                                    <i class="fad fa-minus text-xs mr-2"></i> Staff Attendance
                                </a>
                                <!-- end link -->

                            </div>
                        </div>
                        <!-- end link -->

                        <!-- link -->
                        <div class="mb-1 capitalize font-medium text-sm p-2 rounded hover:bg-gray-200 hover:text-teal-600 transition ease-in-out duration-500"
                            x-data="{
                                exam: false,
                            }">
                            <div class="flex items-center" x-on:click="exam = !exam"
                                x-bind:class="{ 'bg-teal-600 px-2 hover:text-white': exam }">
                                <span class="block w-full mb-1 cursor-pointer">
                                    <i class="fad fa-sitemap text-xs mr-2"></i> Examination
                                </span>
                                <i class="fad fa-angle-down text-lg mr-2"></i>
                            </div>

                            <div class="w-full px-2 pt-2 bg-gray-200 border-t-4 border-teal-600 " x-show="exam">
                                <!-- link -->
                                <a href="{{ route('dashboard') }}"
                                    class="rounded block font-medium text-sm text-teal-600 hover:bg-white p-2 transition ease-in-out duration-500">
                                    <i class="fad fa-minus text-xs mr-2"></i> Exam Schedule
                                </a>
                                <!-- end link -->

                                <!-- link -->
                                <a href="{{ route('dashboard') }}"
                                    class="rounded block font-medium text-sm text-teal-600 hover:bg-white p-2 transition ease-in-out duration-500">
                                    <i class="fad fa-minus text-xs mr-2"></i> Exam Attendance
                                </a>
                                <!-- end link -->

                                <!-- link -->
                                <a href="{{ route('dashboard') }}"
                                    class="rounded block font-medium text-sm text-teal-600 hover:bg-white p-2 transition ease-in-out duration-500">
                                    <i class="fad fa-minus text-xs mr-2"></i> Grades
                                </a>
                                <!-- end link -->

                            </div>
                        </div>
                        <!-- end link -->

                        <!-- link -->
                        <div class="mb-1 capitalize font-medium text-sm p-2 rounded hover:bg-gray-200 hover:text-teal-600 transition ease-in-out duration-500"
                            x-data="{
                                mark: false,
                            }">
                            <div class="flex items-center" x-on:click="mark = !mark"
                                x-bind:class="{ 'bg-teal-600 px-2 hover:text-white': mark }">
                                <span class="block w-full mb-1 cursor-pointer">
                                    <i class="fad fa-sitemap text-xs mr-2"></i> Mark
                                </span>
                                <i class="fad fa-angle-down text-lg mr-2"></i>
                            </div>

                            <div class="w-full px-2 pt-2 bg-gray-200 border-t-4 border-teal-600 " x-show="mark">
                                <!-- link -->
                                <a href="{{ route('dashboard') }}"
                                    class="rounded block font-medium text-sm text-teal-600 hover:bg-white p-2 transition ease-in-out duration-500">
                                    <i class="fad fa-minus text-xs mr-2"></i> Mark
                                </a>
                                <!-- end link -->

                                <!-- link -->
                                <a href="{{ route('dashboard') }}"
                                    class="rounded block font-medium text-sm text-teal-600 hover:bg-white p-2 transition ease-in-out duration-500">
                                    <i class="fad fa-minus text-xs mr-2"></i> Mark Distribution
                                </a>
                                <!-- end link -->

                                <!-- link -->
                                <a href="{{ route('dashboard') }}"
                                    class="rounded block font-medium text-sm text-teal-600 hover:bg-white p-2 transition ease-in-out duration-500">
                                    <i class="fad fa-minus text-xs mr-2"></i> Promotion
                                </a>
                                <!-- end link -->

                            </div>
                        </div>
                        <!-- end link -->


                        <!-- link -->
                        <a href="{{ route('dashboard') }}"
                            class="mb-1 capitalize font-medium text-sm p-2 rounded hover:bg-gray-200 hover:text-teal-600 transition ease-in-out duration-500">
                            <i class="fad fa-id-badge text-xs mr-2"></i>
                            ID Card
                        </a>
                        <!-- end link -->

                        <!-- link -->
                        <a href="{{ route('dashboard') }}"
                            class="mb-1 capitalize font-medium text-sm p-2 rounded hover:bg-gray-200 hover:text-teal-600 transition ease-in-out duration-500">
                            <i class="fad fa-book text-xs mr-2"></i>
                            Library
                        </a>
                        <!-- end link -->




                        <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider">apps</p>

                        <!-- link -->
                        <a href="{{ route('dashboard') }}"
                            class="mb-1 capitalize font-medium text-sm p-2 rounded hover:bg-gray-200 hover:text-teal-600 transition ease-in-out duration-500">
                            <i class="fad fa-envelope-open-text text-xs mr-2"></i>
                            email
                        </a>
                        <!-- end link -->

                        <!-- link -->
                        <a href="{{ route('dashboard') }}"
                            class="mb-1 capitalize font-medium text-sm p-2 rounded hover:bg-gray-200 hover:text-teal-600 transition ease-in-out duration-500">
                            <i class="fad fa-comments text-xs mr-2"></i>
                            Messages
                        </a>
                        <!-- end link -->

                        <!-- link -->
                        <a href="{{ route('dashboard') }}"
                            class="mb-1 capitalize font-medium text-sm p-2 rounded hover:bg-gray-200 hover:text-teal-600 transition ease-in-out duration-500">
                            <i class="fad fa-badge-check text-xs mr-2"></i>
                            todo
                        </a>
                        <!-- end link -->

                        <!-- link -->
                        <a href="{{ route('dashboard') }}"
                            class="mb-1 capitalize font-medium text-sm p-2 rounded hover:bg-gray-200 hover:text-teal-600 transition ease-in-out duration-500">
                            <i class="fad fa-calendar-edit text-xs mr-2"></i>
                            calendar
                        </a>
                        <!-- end link -->

                        <!-- link -->
                        <a href="{{ route('dashboard') }}"
                            class="mb-1 capitalize font-medium text-sm p-2 rounded hover:bg-gray-200 hover:text-teal-600 transition ease-in-out duration-500">
                            <i class="fad fa-file-invoice-dollar text-xs mr-2"></i>
                            invoice
                        </a>
                        <!-- end link -->

                        <!-- link -->
                        <a href="{{ route('dashboard') }}"
                            class="mb-1 capitalize font-medium text-sm p-2 rounded hover:bg-gray-200 hover:text-teal-600 transition ease-in-out duration-500">
                            <i class="fad fa-user-shield text-xs mr-2"></i>
                            Administrator
                        </a>
                        <!-- end link -->

                        <!-- link -->
                        <a href="{{ route('dashboard') }}"
                            class="mb-1 capitalize font-medium text-sm p-2 rounded hover:bg-gray-200 hover:text-teal-600 transition ease-in-out duration-500">
                            <i class="fad fa-wrench text-xs mr-2"></i>
                            Settings
                        </a>
                        <!-- end link -->

                    </div>
                </div>

            </div>
            <!-----END SIDE BAR MENU------>

            <main id="main" class="w-full">
                <div class="w-full p-4 min-h-screen">
                    {{ $slot }}
                </div>

                <div class="w-full p-4">
                    <div class="flex justify-between text-sm font-semibold p-4 bg-white">
                        <p class="">Copyright © {{ date('Y') }} School Management System</p>
                        <p class="">V 0.1</p>
                    </div>
                </div>
            </main>
        </section>
        <!-----END BODY------>




    </div>

    <script>
        $(document).ready(function() {

            $("#rightMenuToggle").click(function() {
                $("#rightMenu").toggleClass("hidden");
            });

            $(document).click(function(e) {
                // Check if the clicked element is not inside the #rightMenu or the toggle button
                if (!$(e.target).closest("#rightMenu, #rightMenuToggle").length) {
                    $("#rightMenu").addClass("hidden"); // Hide the menu
                }
            });
            ////////////////////////////
            $("#sideBarMenuToggle").click(function() {
                $("#sideBarMenu").toggleClass("hidden");
            });

        });
    </script>
</body>

</html>
