<x-dash-layout>
    <div name="header" class="bg-white p-3 flex justify-between mb-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fad fa-users text-xl mr-1"></i>
            {{ __('Other Staffs') }}
        </h2>
        <h2 class="font-semibold text-sm text-gray-500 leading-tight">
            {{ "Dashboard/Staffs/Update" }}
        </h2>
    </div>

    <div class="w-full p-6 bg-white">
        <div class="flex w-full justify-start bg-gray-100 p-2 mb-3">
            <span>
                <a href="{{ route('staff') }}" class="text-md font-bold p-2 rounded bg-gray-300 hover:bg-gray-800 hover:text-white">Back <i class="fad fa-backward text-xl ml-1"></i></a>
            </span>
        </div>

        <div class="block w-full bg-gray-50 p-2 mb-3">
            <h1 class="text-xl font-bold">Update Staff Account</h1>
            <p class="text-sm text-gray-500">Fill all field acurately. All field are required</p>

            <form action="{{ route('staff.update.store', $staff->id) }}" method="post" id="staff_form">
                @csrf
                @method('PUT')
                <div class="w-full max-w-screen-lg">

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Full Name" }}</label>
                            <input type="text" name="account_name" class="w-full p-2 border-gray-200" value="{{ $staff->account_name }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Date of Birth" }}</label>
                            <input type="date" name="date_birth" class="w-full p-2 border-gray-200" value="{{ $staff->date_birth }}">
                        </div>

                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Gender" }}</label>
                            <input type="text" name="gender_sex" list="gender" class="w-full p-2 border-gray-200" value="{{ $staff->gender }}">
                            <datalist id="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </datalist>
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Religion" }}</label>
                            <input type="text" name="religion" list="religions" class="w-full p-2 border-gray-200" value="{{ $staff->religion }}">
                            <datalist id="religions">
                                <option value="Tradition">Tradition</option>
                                <option value="Christianity">Christianity</option>
                                <option value="Islam">Islam</option>
                            </datalist>
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Email Address" }}</label>
                            <input type="text" name="email" class="w-full p-2 border-gray-200" value="{{ $staff->email }}">
                        </div>
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Phone Number" }}</label>
                            <input type="text" name="phone" class="w-full p-2 border-gray-200" value="{{ $staff->phone }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-500 bg-opacity-25">
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Qualification" }}</label>
                            <input type="text" name="qualification" class="w-full p-2 border-gray-200" value="{{ $staff->qualification }}">
                        </div>
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Employment Date" }}</label>
                            <input type="date" name="employment_date" class="w-full p-2 border-gray-200" value="{{ $staff->employment_date }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Position" }}</label>
                            <input type="text" name="position" class="w-full p-2 border-gray-200" value="{{ $staff->position }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Current Address" }}</label>
                            <textarea name="current_address" id="" cols="30" rows="3" class="w-full p-2 border-gray-200"> {{ $staff->current_address }}</textarea>
                        </div>
                    </div>


                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-500 bg-opacity-25">
                        
                    </div>


                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "User Name" }}</label>
                            <input type="text" name="username" class="w-full p-2 border-gray-200" value="{{ $staff->username }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <button id="teacher_btn" class="flex gap-2 lg:w-60 w-full p-2 bg-blue-500 hover:bg-blue-700 text-white font-bold">
                                {{ "Update Account" }} 
                                <img src="{{ asset('img/loader_2.gif') }}" width="20" id="loader">
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
                    <form action="{{ route('staff.passport.update.store', $staff->id) }}" method="post" id="passport_form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="block mb-3">
                            <p class="flex w-full">
                                <label for="passport_photo" class="bg-yellow-400 rounded-l text-black p-2 hover:bg-yellow-500">{{ "Select" }}</label>
                                <span id="passport_display" class="w-full border border-yellow-400 rounded-r text-dark font-semibold p-2">{{ $staff->passport_photo }}</span>
                            </p>
    
                            <input type="file" name="passport_photo" id="passport_photo" class="w-full p-2 bg-white border-gray-200 hidden" accept=".jpg, .jpeg, .png">
                        </div>
                        <div class="block lg:w-60">
                            <button type="submit" name="passport_btn" class="w-full p-2 bg-black text-white text-left hover:bg-gray-500"> Upload Passport </button>
                        </div>
                    </form>
                </div>
                
                <div class="block p-3  bg-gray-200 bg-opacity-25 mb-3">
                    <h1 class="text-xl font-bold">Update staff Password</h1>
                    <p class="text-sm text-gray-500">Fill correct password on both field.</p>
                    <form action="{{ route('staff.password.update.store', $staff->id) }}" method="post" id="password_form">
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

        //////////////////////// UPDATE staff
        $(document).ready(function () {
            // On form submission
            $('#loader').hide();

            $('#staff_form').on('submit', function (event) {
            event.preventDefault(); // Prevent form from submitting normally
            
            $('#staff_btn').prop('disabled', true);
            $('#loader').show();
    
            // Create a FormData object to hold form data, including file upload
            let formData = new FormData(this);
    
            // Use Axios to send the form data to the server
            axios.post("{{ route('staff.update.store', $staff->id) }}", formData, {
                headers: {
                'Content-Type': 'multipart/form-data'
                }
            })
    
            .then(response => {
                /////////////////////////////////////////
                //console.log(response.data); // Check the data object specifically
                // Handle success
                //alert('Application Submitted Successfully!');
                $('#staff_btn').prop('disabled', false);
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
                //setTimeout(function(){window.location.assign('{{ route("staff.add") }}');}, 3000);
                //$('#staff_form')[0].reset();
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


                //setTimeout(function(){window.location.assign('{{ route("staff.add") }}');}, 1000);
            });
    
                 $('#staff_btn').prop('disabled', false);
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
            axios.post("{{ route('staff.passport.update.store', $staff->id) }}", formData, {
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
                //setTimeout(function(){window.location.assign('{{ route("staff.add") }}');}, 3000);
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


                //setTimeout(function(){window.location.assign('{{ route("staff.add") }}');}, 1000);
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
            axios.post("{{ route('staff.password.update.store', $staff->id) }}", formData, {
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
                //setTimeout(function(){window.location.assign('{{ route("staff.add") }}');}, 3000);
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


                //setTimeout(function(){window.location.assign('{{ route("staff.add") }}');}, 1000);
            });
    
                 $('#password_btn').prop('disabled', false);
            });
        });
    </script>
</x-dash-layout>
