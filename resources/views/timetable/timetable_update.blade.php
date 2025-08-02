<x-dash-layout>
    <div name="header" class="bg-white p-3 flex justify-between mb-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fad fa-sitemap text-xl mr-1"></i>
            {{ __('Time Table') }}
        </h2>
        <h2 class="font-semibold text-sm text-gray-500 leading-tight">
            {{ "Dashboard/Timetable/Update" }}
        </h2>
    </div>

    <div class="w-full p-6 bg-white">
        <div class="flex w-full justify-start bg-gray-100 p-2 mb-3">
            <span>
                <a href="{{ route('timetable') }}" class="text-md font-bold p-2 rounded bg-gray-300 hover:bg-gray-800 hover:text-white">Back <i class="fad fa-backward text-xl ml-1"></i></a>
            </span>
        </div>

        <div class="block w-full bg-gray-50 p-2 mb-3">
            <h1 class="text-xl font-bold">Update TIme Table</h1>
            <p class="text-sm text-gray-500">Fill all field acurately. All field are required</p>

            <form action="{{ route('timetable.update.store', $timetable->id) }}" method="post" enctype="multipart/form-data" id="timetable_form">
                @csrf
                @method('PUT')
                <div class="w-full max-w-screen-lg">

                    <div class="w-full block gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full mb-3">
                            <label for="" class="text-gray-500 font-semibold">{{ "School Year" }}</label>
                            <input type="text" name="school_year" class="w-full p-2 border-gray-200" value="{{ $timetable->school_year }}">
                        </div>
                    </div>
                    
                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full mb-3">
                            <label for="" class="text-gray-500 font-semibold">{{ "Class" }}</label>
                            <input type="text" list="classes" name="class" class="w-full p-2 border-gray-200" value="{{ $timetable->class }}">
                            <datalist id="classes">
                                <option value="" selected disabled>Select Class</option>
                                @foreach ($classes as $data)
                                    <option>{{ $data->class }}</option>
                                @endforeach
                            </datalist>
                        </div>

                        <div class="block w-full mb-3">
                            <label for="" class="text-gray-500 font-semibold">{{ "Section" }}</label>
                            <input type="text" name="section" list="sections" class="w-full p-2 border-gray-200" value="{{ $timetable->section }}">
                            <datalist id="sections">
                                <option value="" selected disabled>Select Section</option>
                                @foreach ($divisions as $data)
                                    <option value="{{ $data->category }}">{{ $data->class }} {{ $data->category }}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full mb-3">
                            <label for="" class="text-gray-500 font-semibold">{{ "Subject" }}</label>
                            <input type="text" list="subjects" name="subject" class="w-full p-2 border-gray-200" value="{{ $timetable->subject }}">
                            <datalist id="subjects">
                                <option value="" selected disabled>Select Subject</option>
                                @foreach ($subjects as $data)
                                    <option value="{{ $data->class }}, {{ $data->subject }}, {{ $data->subject_code }}">{{ $data->class }} {{ $data->subject }}, {{ $data->subject_code }}</option>
                                @endforeach
                            </datalist>
                        </div>

                        <div class="block w-full mb-3">
                            <label for="" class="text-gray-500 font-semibold">{{ "Teacher" }}</label>
                            <input type="text" list="teachers" name="teacher" class="w-full p-2 border-gray-200" value="{{ $timetable->teacher }}">
                            <datalist id="teachers">
                                <option value="" selected disabled>Select Teacher</option>
                                @foreach ($teachers as $data)
                                    <option>{{ $data->account_name }}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>

                    <div class="w-full block gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full mb-3">
                            <label for="" class="text-gray-500 font-semibold">{{ "Day" }}</label>
                            <input type="text" list="days" name="day" class="w-full p-2 border-gray-200" value="{{ $timetable->day }}">
                            <datalist id="days">
                                <option value="" selected disabled>Select Day</option>
                                <option>Sunday</option>
                                <option>Monday</option>
                                <option>Tuesday</option>
                                <option>Wednesday</option>
                                <option>Thursday</option>
                                <option>Friday</option>
                                <option>Saturday</option>
                            </datalist>
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="w-full mb-3">
                            <label for="" class="text-gray-500 font-semibold">{{ "Starting Time" }}</label>
                            <input type="text" name="starting_time" class="w-full p-2 border-gray-200" value="{{ $timetable->starting_time }}">
                        </div>

                        <div class="w-full mb-3">
                            <label for="" class="text-gray-500 font-semibold">{{ "Ending Time" }}</label>
                            <input type="text" name="ending_time" class="w-full p-2 border-gray-200" value="{{ $timetable->ending_time }}">
                        </div>
                    </div>


                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <button id="timetable_btn" class="flex gap-2 lg:w-60 w-full p-2 bg-blue-500 hover:bg-blue-700 text-white font-bold">
                                {{ "Update Timetable" }} 
                                <img src="{{ asset('img/loader_2.gif') }}" width="20" id="loader">
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>


    <script>
        //////////////////////// UPDATE class
        $(document).ready(function () {
            // On form submission
            $('#loader').hide();

            $('#timetable_form').on('submit', function (event) {
            event.preventDefault(); // Prevent form from submitting normally
            
            $('#timetable_btn').prop('disabled', true);
            $('#loader').show();
    
            // Create a FormData object to hold form data, including file upload
            let formData = new FormData(this);
    
            // Use Axios to send the form data to the server
            axios.post("{{ route('timetable.update.store', $timetable->id) }}", formData, {
                headers: {
                'Content-Type': 'multipart/form-data'
                }
            })
    
            .then(response => {
                /////////////////////////////////////////
                //console.log(response.data); // Check the data object specifically
                // Handle success
                //alert('Application Submitted Successfully!');
                $('#timetable_btn').prop('disabled', false);
                $('#loader').hide();
                
                if(response.data.error == true){
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    width: '400px',
                    timerProgressBar: true,
                    didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "error",
                    title: "Failed! " + response.data.message
                });
                }
                else{
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    width: '400px',
                    timerProgressBar: true,
                    didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: "Success! " + response.data.message
                });
                //setTimeout(function(){window.location.assign('{{ route("timetable.add") }}');}, 3000);
                //$('#timetable_form')[0].reset();
                }
                //////////////////////////////////////
            })
            .catch(error => {
                console.error('There was an error!', error);

                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    width: '400px',
                    timerProgressBar: true,
                    didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "error",
                    title: "Error! " + "There was an error, check fields."
                });


                //setTimeout(function(){window.location.assign('{{ route("timetable.add") }}');}, 1000);
            });
    
                 $('#timetable_btn').prop('disabled', false);
                $('#loader').hide();
            });
        });

        /////////////////UPDATE timetable_file
        $(document).ready(function () {
            // On form submission
            $('#timetable_file_form').on('submit', function (event) {
            event.preventDefault(); // Prevent form from submitting normally
            
            $('#timetable_file_btn').prop('disabled', true);
    
            // Create a FormData object to hold form data, including file upload
            let formData = new FormData(this);
    
            // Use Axios to send the form data to the server
            axios.post("{{ route('timetable.timetable_file.update.store', $timetable->id) }}", formData, {
                headers: {
                'Content-Type': 'multipart/form-data'
                }
            })
    
            .then(response => {
                /////////////////////////////////////////
                //console.log(response.data); // Check the data object specifically
                // Handle success
                //alert('Application Submitted Successfully!');
                $('#timetable_file_btn').prop('disabled', false);
                
                if(response.data.error == true){
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    width: '400px',
                    timerProgressBar: true,
                    didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "error",
                    title: "Failed! " + response.data.message
                });
                }
                else{
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    width: '400px',
                    timerProgressBar: true,
                    didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: "Success! " + response.data.message
                });
                //setTimeout(function(){window.location.assign('{{ route("timetable.add") }}');}, 3000);
                $('#timetable_file_form')[0].reset();
                }
                //////////////////////////////////////
            })
            .catch(error => {
                console.error('There was an error!', error);

                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    width: '400px',
                    timerProgressBar: true,
                    didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "error",
                    title: "Error! " + "There was an error, check fields."
                });


                //setTimeout(function(){window.location.assign('{{ route("timetable.add") }}');}, 1000);
            });
    
                 $('#timetable_file_btn').prop('disabled', false);
            });
        });
    </script>
</x-dash-layout>
