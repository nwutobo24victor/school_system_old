<x-dash-layout>
    <div name="header" class="bg-white p-3 flex justify-between mb-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fad fa-user-graduate text-xl mr-1"></i>
            {{ __('Student') }}
        </h2>
        <h2 class="font-semibold text-sm text-gray-500 leading-tight">
            {{ 'Dashboard/Student/Add' }}
        </h2>
    </div>

    <div class="w-full p-6 bg-white">
        <div class="flex w-full justify-start bg-gray-100 p-2 mb-3">
            <span>
                <a href="{{ route('student') }}"
                    class="text-md font-bold p-2 rounded bg-gray-300 hover:bg-gray-800 hover:text-white">Back <i
                        class="fad fa-backward text-xl ml-1"></i></a>
            </span>
        </div>
        <div class="block w-full bg-gray-50 p-2">

            <div class="w-full max-w-screen-lg mb-3">
                <div class="block p-2 bg-red-100 border-l-8 border-red-500">
                    <p>Note: Create class, section department and guardian before creating new student.</p>
                </div>
            </div>

            <h1 class="text-xl font-bold">Add New Student</h1>
            <p class="text-sm text-gray-500">Fill all field acurately. All field are required</p>
            <form action="{{ route('student.add.store') }}" method="post" enctype="multipart/form-data"
                id="student_form">
                @csrf
                <div class="w-full max-w-screen-lg">
                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ 'Surname' }}</label>
                            <input type="text" name="surname" class="w-full p-2 border-gray-200">
                        </div>
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ 'Other Names' }}</label>
                            <input type="text" name="othernames" class="w-full p-2 border-gray-200">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ 'Guardian' }}</label>
                            <select id="guardians" name="guardian" class="w-full p-2 border-gray-200">
                                <option value="" selected disabled>Select Guardian</option>
                                @foreach ($parents as $data)
                                    <option>{{ $data->account_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-500 bg-opacity-25">

                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ 'Date of Birth' }}</label>
                            <input type="date" name="date_birth" class="w-full p-2 border-gray-200">
                        </div>
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ 'Gender' }}</label>
                            <select id="gender"name="gender_sex" class="w-full p-2 border-gray-200">
                                <option value="" selected disabled>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ 'Blood Group' }}</label>
                            <select id="blood_groups"name="blood_group" class="w-full p-2 border-gray-200">
                                <option value="" selected disabled>Select Blood Group</option>
                                <option value="A+">A+</option>
                                <option value="B+">B+</option>
                                <option value="A-">A-</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ 'Religion' }}</label>
                            <select id="religions" name="religion" class="w-full p-2 border-gray-200">
                                <option value="Tradition">Tradition</option>
                                <option value="Christianity">Christianity</option>
                                <option value="Islam">Islam</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ 'Email Address' }}</label>
                            <input type="text" name="email" class="w-full p-2 border-gray-200">
                        </div>
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ 'Phone Number' }} <span class="text-xs text-red-500">{{ "Whatsapp number preferably" }}</span></label>
                            <input type="text" name="phone" class="w-full p-2 border-gray-200">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ 'Current Address' }}</label>
                            <textarea name="current_address" id="" cols="30" rows="3" class="w-full p-2 border-gray-200"></textarea>
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ 'Nationality' }}</label>
                            <input type="text" name="nationality" class="w-full p-2 border-gray-200">
                        </div>
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ 'State of Origin' }}</label>
                            <input type="text" name="state_origin" class="w-full p-2 border-gray-200">
                        </div>
                        <div class="block w-full">
                            <label for=""
                                class="text-gray-500 font-semibold">{{ 'Local Government Area' }}</label>
                            <input type="text" name="local_govt_area" class="w-full p-2 border-gray-200">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for=""
                                class="text-gray-500 font-semibold">{{ 'Permanent Address' }}</label>
                            <textarea name="permanent_address" id="" cols="30" rows="3" class="w-full p-2 border-gray-200"></textarea>
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-500 bg-opacity-25">

                    </div>

                    <div x-data="{ department: false, toggle: false }">
                        <div class="w-full flex gap-2 items-center py-4">
                            <div @click="toggle = !toggle; department = !department"
                                class="w-16 h-8 flex items-center bg-gray-300 rounded-full p-1 cursor-pointer transition duration-300"
                                :class="toggle ? 'bg-teal-600' : 'bg-gray-300'">

                                <div class="w-6 h-6 bg-white rounded-full shadow-md transform transition duration-300"
                                    :class="toggle ? 'translate-x-8' : 'translate-x-0'">
                                </div>
                            </div>
                            <div class="block">
                                <span :class="{ 'text-teal-600 font-semibold': department }">Show Department</span>
                            </div>
                        </div>

                        <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25 transition duration-300">
                            <div class="block w-full p-1">
                                <label class="text-gray-500 font-semibold">Class</label>
                                <select id="classes" name="class" class="w-full p-2 border-gray-200">
                                    <option value="" selected disabled>Select Class</option>
                                    @foreach ($classes as $data)
                                        <option>{{ $data->class }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div :class="{ 'block': !department, 'hidden': department }"
                            class="w-full transition duration-300 p-1">
                                <label class="text-gray-500 font-semibold">Section</label>
                                <select id="sections" name="section" class="w-full p-2 border-gray-200">
                                    <option value="" selected disabled>Select Section</option>
                                    @foreach ($sections as $data)
                                        <option value="{{ $data->category }}">{{ $data->class }}
                                            {{ $data->category }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div :class="{ 'hidden': !department, 'block': department }"
                                class="w-full transition duration-300 bg-teal-600 p-1">
                                <label class="text-white font-semibold">Department</label>
                                <select id="departments" name="department" class="w-full p-2 border-gray-200">
                                    <option value="" selected disabled>Select Department</option>
                                    <option>None</option>
                                    @foreach ($departments as $data)
                                        <option>{{ $data->category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for=""
                                class="text-gray-500 font-semibold">{{ 'Registration No.' }}</label>
                            <input type="text" id="registration_no" name="registration_no" class="w-full p-2 border-gray-200"
                               readonly>
                        </div>
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ 'Admission Date' }}</label>
                            <input type="date" name="admission_date" class="w-full p-2 border-gray-200">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">

                        <div class="block max-w-xl">
                            <p class="text-gray-500 font-semibold">{{ 'Upload Photo' }}</p>
                            <div class="card rounded-lg bg-white p-3 w-full">
                                <p class="text-gray-500 text-sm">
                                    {{ 'Passport photo should be in any of these format: .jpg, .jpeg, .png' }}
                                    <br>
                                    {{ 'Size should not be more than 1mb.' }}
                                </p>

                                <p class="flex w-full">
                                    <label for="passport_photo"
                                        class="bg-yellow-400 rounded-l text-black p-2 hover:bg-yellow-500">{{ 'Select' }}</label>
                                    <span id="passport_display"
                                        class="w-full border border-yellow-400 rounded-r text-dark font-semibold p-2 overflow-hidden">No
                                        passport selected</span>
                                </p>

                                <input type="file" name="passport_photo" id="passport_photo"
                                    class="w-full p-2 bg-white border-gray-200 hidden" accept=".jpg, .jpeg, .png">
                            </div>
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ 'Remark' }}</label>
                            <input type="text" name="remark" class="w-full p-2 border-gray-200">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ 'User Name' }}</label>
                            <input type="text" name="username" class="w-full p-2 border-gray-200">
                        </div>
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ 'Password' }}</label>
                            <input type="password" name="password" class="w-full p-2 border-gray-200">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <button id="student_btn"
                                class="flex gap-2 lg:w-60 w-full p-2 bg-blue-500 hover:bg-blue-700 text-white font-bold">
                                {{ 'Register Student' }}
                                <img src="{{ asset('img/loader_2.gif') }}" width="20" id="loader">
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    @if ($errors->any())
        <div class="block max-w-screen-lg rounded bg-red-300 text-red-600 p-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('success'))
        <div class="block max-w-screen-lg rounded bg-green-300 text-green-600 p-3">
            {{ session('success') }}
        </div>
    @endif


    <script>
        $(document).ready(function() {
            $('#classes').on('change', function() {
                let classes = $(this).val();
                
                console.log("clicked classes");
                
                if (classes) {
                    axios.get('/generate/regnumber/' + classes)
                        .then(response => {
                            $('#registration_no').val(response.data);
                            
                            console.log(response.data);

                        })
                        .catch(error => {
                            console.error("Error:", error);
                        });
                } else {
                    $('#registration_no').val('');
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#passport_photo').change(function() {
                var fileName = $(this).val().split('\\').pop(); // Get the file name from the full path
                $('#passport_display').text(fileName); // Display the file name in the #passport_display div
            });
        });


        $(document).ready(function() {
            // On form submission
            $('#loader').hide();

            $('#student_form').on('submit', function(event) {
                event.preventDefault(); // Prevent form from submitting normally

                $('#student_btn').prop('disabled', true);
                $('#loader').show();

                // Create a FormData object to hold form data, including file upload
                let formData = new FormData(this);

                // Use Axios to send the form data to the server
                axios.post("{{ route('student.add.store') }}", formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })

                    .then(response => {
                        /////////////////////////////////////////
                        //console.log(response.data); // Check the data object specifically
                        // Handle success
                        //alert('Application Submitted Successfully!');
                        $('#student_btn').prop('disabled', false);
                        $('#loader').hide();

                        if (response.data.error == true) {
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
                        } else {
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
                            //setTimeout(function(){window.location.assign('{{ route('student.add') }}');}, 3000);
                            $('#student_form')[0].reset();
                            $('#passport_display').text("No passport selected");
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


                        //setTimeout(function(){window.location.assign('{{ route('student.add') }}');}, 1000);
                    });

                $('#student_btn').prop('disabled', false);
                $('#loader').hide();
            });
        });
    </script>
</x-dash-layout>
