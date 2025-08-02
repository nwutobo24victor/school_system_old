<x-dash-layout>
    <div name="header" class="bg-white p-3 flex justify-between mb-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fad fa-user-graduate text-xl mr-1"></i>
            {{ __('Student') }}
        </h2>
        <h2 class="font-semibold text-sm text-gray-500 leading-tight">
            {{ "Dashboard/Student/Update" }}
        </h2>
    </div>

    <div class="w-full p-6 bg-white">
        <div class="flex w-full justify-start bg-gray-100 p-2 mb-3">
            <span>
                <a href="{{ route('student') }}" class="text-md font-bold p-2 rounded bg-gray-300 hover:bg-gray-800 hover:text-white">Back <i class="fad fa-backward text-xl ml-1"></i></a>
            </span>
        </div>

        <div class="block w-full bg-gray-50 p-2 mb-3">
            <h1 class="text-xl font-bold">Update Student Account</h1>
            <p class="text-sm text-gray-500">Fill all field acurately. All field are required</p>

            <form action="{{ route('student.update.store', $student->id) }}" method="post" id="student_form">
                @csrf
                @method('PUT')
                <div class="w-full max-w-screen-lg">
                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Surname" }}</label>
                            <input type="text" name="surname" class="w-full p-2 border-gray-200" value="{{ $student->surname }}">
                        </div>
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Other Names" }}</label>
                            <input type="text" name="othernames" class="w-full p-2 border-gray-200" value="{{ $student->othernames }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Guardian" }}</label>
                            <input type="text" name="guardian" class="w-full p-2 border-gray-200" value="{{ $student->guardian }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-500 bg-opacity-25">
                        
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Date of Birth" }}</label>
                            <input type="date" name="date_birth" class="w-full p-2 border-gray-200" value="{{ $student->date_birth }}">
                        </div>
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Gender" }}</label>
                            <input type="text" name="gender_sex" list="gender" class="w-full p-2 border-gray-200" value="{{ $student->gender }}">
                            <datalist id="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </datalist>
                        </div>
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Blood Group" }}</label>
                            <input type="text" name="blood_group" list="blood_groups" class="w-full p-2 border-gray-200" value="{{ $student->blood_group }}">
                            <datalist id="blood_groups">
                                <option value="A+">A+</option>
                                <option value="B+">B+</option>
                                <option value="A-">A-</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </datalist>
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Religion" }}</label>
                            <input type="text" name="religion" class="w-full p-2 border-gray-200" value="{{ $student->religion }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Email Address" }}</label>
                            <input type="text" name="email" class="w-full p-2 border-gray-200" value="{{ $student->email }}">
                        </div>
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Phone Number" }}</label>
                            <input type="text" name="phone" class="w-full p-2 border-gray-200" value="{{ $student->phone }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Current Address" }}</label>
                            <textarea name="current_address" id="" cols="30" rows="3" class="w-full p-2 border-gray-200"> {{ $student->current_address }}</textarea>
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Nationality" }}</label>
                            <input type="text" name="nationality" class="w-full p-2 border-gray-200" value="{{ $student->nationality }}">
                        </div>
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "State of Origin" }}</label>
                            <input type="text" name="state_origin" class="w-full p-2 border-gray-200" value="{{ $student->state_origin }}">
                        </div>
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Local Government Area" }}</label>
                            <input type="text" name="local_govt_area" class="w-full p-2 border-gray-200" value="{{ $student->local_govt_area }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Permanent Address" }}</label>
                            <textarea name="permanent_address" id="" cols="30" rows="3" class="w-full p-2 border-gray-200"> {{ $student->permanent_address }}</textarea>
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-500 bg-opacity-25">
                        
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Class" }}</label>
                            <input type="text" name="class" class="w-full p-2 border-gray-200" value="{{ $student->class }}">
                        </div>
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Section" }}</label>
                            <input type="text" name="section" class="w-full p-2 border-gray-200" value="{{ $student->section }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Department" }}</label>
                            <input type="text" name="department" class="w-full p-2 border-gray-200" value="{{ $student->department }}">
                        </div>
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Registration No." }}</label>
                            <input type="text" name="registration_no" class="w-full p-2 border-gray-200" value="{{ $student->registration_no }}" readonly>
                        </div>
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Admission Date" }}</label>
                            <input type="date" name="admission_date" class="w-full p-2 border-gray-200" value="{{ $student->admission_date }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Remark" }}</label>
                            <input type="text" name="remark" class="w-full p-2 border-gray-200" value="{{ $student->remark }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "User Name" }}</label>
                            <input type="text" name="username" class="w-full p-2 border-gray-200" value="{{ $student->username }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <button id="student_btn" class="flex gap-2 lg:w-60 w-full p-2 bg-blue-500 hover:bg-blue-700 text-white font-bold">
                                {{ "Update Account" }} 
                                <img src="{{ asset('img/loader_2.gif') }}" class="w-5 h-5" id="loader">
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <div class="block w-full bg-gray-50 p-2 mb-3">
            <div class="lg:grid grid-cols-2 gap-3 w-full bg-gray-50 p-2">

                <div class="block p-3 bg-gray-200 bg-opacity-25">
                    <h1 class="text-xl font-bold">Change Passport</h1>
                    <p class="text-sm text-gray-500">Upload a recent passpor not more than 3 months.</p>
                    <p class="text-gray-500 text-sm mb-3">
                        Passport photo should be in any of these format: .jpg, .jpeg, .png
                        <br> 
                        Size should not be more than 1mb.
                    </p> 
                    <form action="{{ route('student.passport.update.store', $student->id) }}" method="post" id="passport_form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="block mb-3">
                            <p class="flex w-full">
                                <label for="passport_photo" class="bg-yellow-400 rounded-l text-black p-2 hover:bg-yellow-500">{{ "Select" }}</label>
                                <span id="passport_display" class="w-full border border-yellow-400 rounded-r text-dark font-semibold p-2">{{ $student->passport_photo }}</span>
                            </p>
    
                            <input type="file" name="passport_photo" id="passport_photo" class="w-full p-2 bg-white border-gray-200 hidden" accept=".jpg, .jpeg, .png">
                        </div>
                        <div class="block lg:w-60">
                            <button type="submit" name="passport_btn" class="w-full p-2 bg-black text-white text-left hover:bg-gray-500"> Upload Passport </button>
                        </div>
                    </form>
                </div>
                
                <div class="block p-3  bg-gray-200 bg-opacity-25 mb-3">
                    <h1 class="text-xl font-bold">Update Student Password</h1>
                    <p class="text-sm text-gray-500">Fill correct password on both field.</p>
                    <form action="{{ route('student.password.update.store', $student->id) }}" method="post" id="password_form">
                        @csrf
                        @method('PUT')
                        <div class="w-full block p-2 mb-3">
                            <div class="block w-full mb-3">
                                <label for="" class="text-gray-500 font-semibold">{{ "Password" }}</label>
                                <input type="password" name="password" class="w-full p-2 border-gray-200">
                            </div>
                            <div class="block w-full mb-3">
                                <label for="" class="text-gray-500 font-semibold">{{ "Retype Password" }}</label>
                                <input type="password" name="retype_password" class="w-full p-2 border-gray-200">
                            </div>
                            <div class="block lg:w-60">
                                <button type="submit" name="password_btn" class="w-full p-2 bg-red-500 text-white text-left hover:bg-red-700"> Update Password </button>
                            </div>
                        </div>
                    </form>
                </div>
    
                
            </div>
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
        //////////////////UPLOAD FORM
        $(document).ready(function() {
            $('#passport_photo').change(function() {
                var fileName = $(this).val().split('\\').pop(); // Get the file name from the full path
                $('#passport_display').text(fileName); // Display the file name in the #passport_display div
            });
        });

        //////////////////////// UPDATE STUDENT
        $(document).ready(function () {
            // On form submission
            $('#loader').hide();

            $('#student_form').on('submit', function (event) {
            event.preventDefault(); // Prevent form from submitting normally
            
            $('#student_btn').prop('disabled', true);
            $('#loader').show();
    
            // Create a FormData object to hold form data, including file upload
            let formData = new FormData(this);
    
            // Use Axios to send the form data to the server
            axios.post("{{ route('student.update.store', $student->id) }}", formData, {
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
                //setTimeout(function(){window.location.assign('{{ route("student.add") }}');}, 3000);
                //$('#student_form')[0].reset();
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


                //setTimeout(function(){window.location.assign('{{ route("student.add") }}');}, 1000);
            });
    
                 $('#student_btn').prop('disabled', false);
                $('#loader').hide();
            });
        });

        /////////////////UPDATE PASSPORT
        $(document).ready(function () {
            // On form submission
            $('#passport_form').on('submit', function (event) {
            event.preventDefault(); // Prevent form from submitting normally
            
            $('#passport_btn').prop('disabled', true);
    
            // Create a FormData object to hold form data, including file upload
            let formData = new FormData(this);
    
            // Use Axios to send the form data to the server
            axios.post("{{ route('student.passport.update.store', $student->id) }}", formData, {
                headers: {
                'Content-Type': 'multipart/form-data'
                }
            })
    
            .then(response => {
                /////////////////////////////////////////
                //console.log(response.data); // Check the data object specifically
                // Handle success
                //alert('Application Submitted Successfully!');
                $('#passport_btn').prop('disabled', false);
                
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
                //setTimeout(function(){window.location.assign('{{ route("student.add") }}');}, 3000);
                $('#passport_form')[0].reset();
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


                //setTimeout(function(){window.location.assign('{{ route("student.add") }}');}, 1000);
            });
    
                 $('#passport_btn').prop('disabled', false);
            });
        });

        /////////////////UPDATE PASSWORD
        $(document).ready(function () {
            // On form submission
            $('#password_form').on('submit', function (event) {
            event.preventDefault(); // Prevent form from submitting normally
            
            $('#password_btn').prop('disabled', true);
    
            // Create a FormData object to hold form data, including file upload
            let formData = new FormData(this);
    
            // Use Axios to send the form data to the server
            axios.post("{{ route('student.password.update.store', $student->id) }}", formData, {
                headers: {
                'Content-Type': 'multipart/form-data'
                }
            })
    
            .then(response => {
                /////////////////////////////////////////
                //console.log(response.data); // Check the data object specifically
                // Handle success
                //alert('Application Submitted Successfully!');
                $('#password_btn').prop('disabled', false);
                
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
                //setTimeout(function(){window.location.assign('{{ route("student.add") }}');}, 3000);
                $('#password_form')[0].reset();
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


                //setTimeout(function(){window.location.assign('{{ route("student.add") }}');}, 1000);
            });
    
                 $('#password_btn').prop('disabled', false);
            });
        });
    </script>
</x-dash-layout>
