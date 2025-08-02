<x-dash-layout>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>

    <!---DATA--->
    @if (Auth::user()->role == "admin")
    <div class="md:grid grid-cols-4 gap-6 w-full mb-3">
        <div class="col-span-1 mb-3">
            <div class="card bg-white p-3 border ">
                <div class="card-body flex flex-col">
    
                    <!-- top -->
                    <div class="flex flex-row justify-between items-center">
                        <div class="h6 text-indigo-700 fad fa-shopping-cart"></div>
                    </div>
                    <!-- end top -->
    
                    <!-- bottom -->
                    <div class="mt-8">
                        <h1 class="text-3xl font-bold">₦ {{ number_format(5032123) }}</h1>
                        <p>Fees</p>
                    </div>
                    <!-- end bottom -->
    
                </div>
            </div>
            <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
        </div>

        <div class="col-span-1 mb-3">
            <div class="card bg-white p-3 border ">
                <div class="card-body flex flex-col">
    
                    <!-- top -->
                    <div class="flex flex-row justify-between items-center">
                        <div class="h6 text-indigo-700 fad fa-shopping-cart"></div>
                    </div>
                    <!-- end top -->
    
                    <!-- bottom -->
                    <div class="mt-8">
                        <h1 class="text-3xl font-bold">199</h1>
                        <p>Staffs</p>
                    </div>
                    <!-- end bottom -->
    
                </div>
            </div>
            <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
        </div>

        <div class="col-span-1 mb-3">
            <div class="card bg-white p-3 border ">
                <div class="card-body flex flex-col">
    
                    <!-- top -->
                    <div class="flex flex-row justify-between items-center">
                        <div class="h6 text-indigo-700 fad fa-shopping-cart"></div>
                    </div>
                    <!-- end top -->
    
                    <!-- bottom -->
                    <div class="mt-8">
                        <h1 class="text-3xl font-bold">100</h1>
                        <p>Message</p>
                    </div>
                    <!-- end bottom -->
    
                </div>
            </div>
            <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
        </div>

        <div class="col-span-1 mb-3">
            <div class="card bg-white p-3 border ">
                <div class="card-body flex flex-col">
    
                    <!-- top -->
                    <div class="flex flex-row justify-between items-center">
                        <div class="h6 text-indigo-700 fad fa-shopping-cart"></div>
                    </div>
                    <!-- end top -->
    
                    <!-- bottom -->
                    <div class="mt-8">
                        <h1 class="text-3xl font-bold">35</h1>
                        <p>Subjects</p>
                    </div>
                    <!-- end bottom -->
    
                </div>
            </div>
            <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
        </div>
    
    </div>
    @endif
    <!---PROFILE--->
    <div class="md:flex gap-6 w-full mb-3">
        <div class="block w-full">
            <div class="card bg-blue-800 p-3 border h-60">
                <div class="card-body p-6 text-white">
                    <h1 class="text-3xl font-extrabold">Ade Shina</h1>
                    <p>Loving</p>
                </div>
            </div>
        </div>

        <div class="block w-full">
            <div class="card bg-gray-900 mb-4 p-4">
                <p class="text-white">Hi! Wait A Minute . . . . . . Follow Me On Twitter</p>
            </div>

            <div class="md:flex gap-6 w-full">
                <div class="card bg-white p-3 border w-full mb-3">
                    <div class="card-body p-6">
                        s
                    </div>
                </div>

                <div class="card bg-white p-3 border w-full mb-3">
                    <div class="card-body p-6">
                        s
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!---CARDS--->
    @if (Auth::user()->role == "admin")
    <div class="md:flex gap-6 w-full mb-3">

        <!-- card -->
        <div class="card mt-6 bg-white p-3 w-full">
            <div class="card-body flex items-center">
                
                <div class="px-3 py-2 rounded bg-indigo-600 text-white mr-3">
                    <i class="fad fa-wallet"></i>
                </div>
    
                <div class="flex flex-col">
                    <h1 class="font-semibold"><span class="num-2">51</span> Parent</h1>
                </div>
    
            </div>
        </div>
        <!-- end card -->
        
        <!-- card -->
        <div class="card mt-6 bg-white p-3 w-full">
            <div class="card-body flex items-center">
                
                <div class="px-3 py-2 rounded bg-green-600 text-white mr-3">
                    <i class="fad fa-shopping-cart"></i>
                </div>
    
                <div class="flex flex-col">
                    <h1 class="font-semibold"><span class="num-2">134</span> Student</h1>
                    <p class="text-xs"><span class="num-2">73</span> Inactive | <span class="num-2">3</span> Suspension </p>
                </div>
    
            </div>
        </div>
        <!-- end card -->
    
        <!-- card -->
        <div class="card mt-6  bg-white p-3 w-full">
            <div class="card-body flex items-center">
                
                <div class="px-3 py-2 rounded bg-yellow-600 text-white mr-3">
                    <i class="fad fa-blog"></i>
                </div>
    
                <div class="flex flex-col">
                    <h1 class="font-semibold"><span class="num-2">56</span> Teacher</h1>
                </div>
    
            </div>
        </div>
        <!-- end card -->
    
        <!-- card -->
        <div class="card mt-6  bg-white p-3 w-full">
            <div class="card-body flex items-center">
                
                <div class="px-3 py-2 rounded bg-red-600 text-white mr-3">
                    <i class="fad fa-comments"></i>
                </div>
    
                <div class="flex flex-col">
                    {{-- active minus suspended --}}
                    <h1 class="font-semibold"><span class="num-2">6</span> Class</h1>
                    <p class="text-xs"><span class="num-2">3</span> Section</p>
                </div>
    
            </div>
        </div>
        <!-- end card -->
    
        <!-- card -->
        <div class="card mt-6 bg-white p-3 w-full">
            <div class="card-body flex items-center">
                
                <div class="px-3 py-2 rounded bg-pink-600 text-white mr-3">
                    <i class="fad fa-user"></i>
                </div>
    
                <div class="flex flex-col">
                    <h1 class="font-semibold"><span class="num-2">4</span> Department</h1>
                </div>
    
            </div>
        </div>
        <!-- end card -->
    
    </div>
    @endif
    <!---EVENT&ANNOUNCEMENT--->
    <div class="md:flex mb-3 py-4">

       <div class="md:flex gap-6 w-full">

            <div class="block w-full bg-white border p-3 h-60 mb-3">
                <h1 class="text-xl font-bold">Events</h1>
                <hr class="text-blue-800">
                <div class="w-full mt-3 overflow-y-auto overflow-x-hidden">
                    s
                </div>
            </div>

            <div class="block w-full bg-white border p-3 h-60 mb-3">
                <h1 class="text-xl font-bold">Announcement</h1>
                <hr class="text-blue-800">
                <div class="w-full mt-3 overflow-y-auto overflow-x-hidden">
                    s
                </div>
            </div>

       </div>
    
    </div>

    <!---CALENDER--->
    <div class="md:flex gap-6 w-full">
        <div class="block w-full bg-white p-6">
            <h1 class="text-xl font-bold">Calender</h1>
            <hr class="text-blue-800">

            <div class="w-full p-3 lg:flex gap-6 justify-between">
                <div class="card  bg-black text-white border p-3 mb-3">
                    <p class="text-sm font-bold">Date:</p>
                    <p class="">{{ date('d-m-Y') }}</p>
                </div>

                <div class="card  bg-black text-white border p-3 mb-3">
                    <p class="text-sm font-bold">Time:</p>
                    <p class="">{{ date('H-i-s') }}</p>
                </div>
            </div>

            <div id="calendar" class="p-4 border border-gray-300 rounded-md w-full mx-auto lg:block hidden">
                <div id="calendarHeader" class="flex justify-between items-center mb-2">
                  <button id="prevMonth" class="px-2 py-1 bg-gray-200 rounded">◀</button>
                  <div id="calendarTitle" class="font-bold text-lg"></div>
                  <button id="nextMonth" class="px-2 py-1 bg-gray-200 rounded">▶</button>
                </div>
                <div id="calendarGrid"></div>
              </div>
              


        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const calendarEl = document.getElementById("calendarGrid");
        const calendarTitle = document.getElementById("calendarTitle");
        const prevMonthButton = document.getElementById("prevMonth");
        const nextMonthButton = document.getElementById("nextMonth");
      
        const today = new Date();
        let currentYear = today.getFullYear();
        let currentMonth = today.getMonth(); // 0-indexed
      
        function createCalendar(year, month) {
          calendarEl.innerHTML = ""; // Clear the calendar
      
          const daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
          const firstDay = new Date(year, month, 1).getDay();
          const daysInMonth = new Date(year, month + 1, 0).getDate();
      
          // Set calendar title (Month and Year)
          calendarTitle.textContent = `${new Intl.DateTimeFormat("en-US", {
            month: "long",
          }).format(new Date(year, month))} ${year}`;
      
          // Create header for days of the week
          const header = document.createElement("div");
          header.style.display = "grid";
          header.style.gridTemplateColumns = "repeat(7, 1fr)";
          header.style.gap = "5px";
          daysOfWeek.forEach(day => {
            const dayEl = document.createElement("div");
            dayEl.style.textAlign = "center";
            dayEl.style.fontWeight = "bold";
            dayEl.textContent = day;
            header.appendChild(dayEl);
          });
          calendarEl.appendChild(header);
      
          // Create the grid for dates
          const grid = document.createElement("div");
          grid.style.display = "grid";
          grid.style.gridTemplateColumns = "repeat(7, 1fr)";
          grid.style.gap = "5px";
      
          // Add empty spaces for days before the first of the month
          for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement("div");
            grid.appendChild(emptyCell);
          }
      
          // Add days of the month
          for (let day = 1; day <= daysInMonth; day++) {
            const dayCell = document.createElement("div");
            dayCell.style.textAlign = "center";
            dayCell.style.padding = "15px";
            dayCell.style.paddingTop = "30px";
            dayCell.style.border = "1px solid #ddd";
            dayCell.style.borderRadius = "4px";
      
            // Highlight the current date
            if (
              year === today.getFullYear() &&
              month === today.getMonth() &&
              day === today.getDate()
            ) {
              dayCell.style.backgroundColor = "#4CAF50";
              dayCell.style.color = "white";
              dayCell.style.fontWeight = "bold";
            }
      
            dayCell.textContent = day;
            grid.appendChild(dayCell);
          }
      
          calendarEl.appendChild(grid);
        }
      
        // Update calendar to the previous month
        prevMonthButton.addEventListener("click", function () {
          currentMonth--;
          if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
          }
          createCalendar(currentYear, currentMonth);
        });
      
        // Update calendar to the next month
        nextMonthButton.addEventListener("click", function () {
          currentMonth++;
          if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
          }
          createCalendar(currentYear, currentMonth);
        });
      
        // Initialize calendar
        createCalendar(currentYear, currentMonth);
      });
      

      </script>

</x-dash-layout>