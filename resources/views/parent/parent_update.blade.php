<x-dash-layout>
    <div name="header" class="bg-white p-3 flex justify-between mb-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fad fa-user-secret text-xl mr-1"></i>
            {{ __('Parent') }}
        </h2>
        <h2 class="font-semibold text-sm text-gray-500 leading-tight">
            {{ "Dashboard/Parent/Update" }}
        </h2>
    </div>

    <div class="w-full p-6 bg-white">
        <div class="flex w-full justify-start bg-gray-100 p-2 mb-3">
            <span>
                <a href="{{ route('parent') }}" class="text-md font-bold p-2 rounded bg-gray-300 hover:bg-gray-800 hover:text-white">Back <i class="fad fa-backward text-xl ml-1"></i></a>
            </span>
        </div>

        <div class="block w-full bg-gray-50 p-2 mb-3">
            <h1 class="text-xl font-bold">Update Parent Account</h1>
            <p class="text-sm text-gray-500">Fill all field acurately. All field are required</p>

            <form action="{{ route('parent.update.store', $parent->id) }}" method="post" id="parent_form">
                @csrf
                @method('PUT')
                <div class="w-full max-w-screen-lg">

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Guardian Full Name" }}</label>
                            <input type="text" name="account_name" class="w-full p-2 border-gray-200" value="{{ $parent->account_name }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Father's Name" }}</label>
                            <input type="text" name="father_name" class="w-full p-2 border-gray-200" value="{{ $parent->father_name }}">
                        </div>
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Mother's Names" }}</label>
                            <input type="text" name="mother_name" class="w-full p-2 border-gray-200" value="{{ $parent->mother_name }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Father's Profession" }}</label>
                            <input type="text" name="father_profession" class="w-full p-2 border-gray-200" value="{{ $parent->father_profession }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Mother's Profession" }}</label>
                            <input type="text" name="mother_profession" class="w-full p-2 border-gray-200" value="{{ $parent->mother_profession }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-500 bg-opacity-25">
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Email Address" }}</label>
                            <input type="text" name="email" class="w-full p-2 border-gray-200" value="{{ $parent->email }}">
                        </div>
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Phone Number" }}</label>
                            <input type="text" name="phone" class="w-full p-2 border-gray-200" value="{{ $parent->phone }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Current Address" }}</label>
                            <textarea name="current_address" id="" cols="30" rows="3" class="w-full p-2 border-gray-200"> {{ $parent->current_address }}</textarea>
                        </div>
                    </div>


                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-500 bg-opacity-25">
                        
                    </div>


                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "User Name" }}</label>
                            <input type="text" name="username" class="w-full p-2 border-gray-200" value="{{ $parent->username }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <button id="parent_btn" class="flex gap-2 lg:w-60 w-full p-2 bg-blue-500 hover:bg-blue-700 text-white font-bold">
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
                    <p class="text-sm text-gray-500">Upload a recent passport not more than 3 months.</p>
                    <p class="text-gray-500 text-sm mb-3">
                        Passport photo should be in any of these format: .jpg, .jpeg, .png
                        <br> 
                        Size should not be more than 1mb.
                    </p> 
                    <form action="{{ route('parent.passport.update.store', $parent->id) }}" method="post" id="passport_form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="block mb-3">
                            <p class="flex w-full">
                                <label for="passport_photo" class="bg-yellow-400 rounded-l text-black p-2 hover:bg-yellow-500">{{ "Select" }}</label>
                                <span id="passport_display" class="w-full border border-yellow-400 rounded-r text-dark font-semibold p-2">{{ $parent->passport_photo }}</span>
                            </p>
    
                            <input type="file" name="passport_photo" id="passport_photo" class="w-full p-2 bg-white border-gray-200 hidden" accept=".jpg, .jpeg, .png">
                        </div>
                        <div class="block lg:w-60">
                            <button type="submit" name="passport_btn" class="w-full p-2 bg-black text-white text-left hover:bg-gray-500"> Upload Passport </button>
                        </div>
                    </form>
                </div>
                
                <div class="block p-3  bg-gray-200 bg-opacity-25 mb-3">
                    <h1 class="text-xl font-bold">Update parent Password</h1>
                    <p class="text-sm text-gray-500">Fill correct password on both field.</p>
                    <form action="{{ route('parent.password.update.store', $parent->id) }}" method="post" id="password_form">
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

        //////////////////////// UPDATE PARENT
        $(document).ready(function () {
            // On form submission
            $('#loader').hide();

            $('#parent_form').on('submit', function (event) {
            event.preventDefault(); // Prevent form from submitting normally
            
            $('#parent_btn').prop('disabled', true);
            $('#loader').show();
    
            // Create a FormData object to hold form data, including file upload
            let formData = new FormData(this);
    
            // Use Axios to send the form data to the server
            axios.post("{{ route('parent.update.store', $parent->id) }}", formData, {
                headers: {
                'Content-Type': 'multipart/form-data'
                }
            })
    
            .then(response => {
                /////////////////////////////////////////
                //console.log(response.data); // Check the data object specifically
                // Handle success
                //alert('Application Submitted Successfully!');
                $('#parent_btn').prop('disabled', false);
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
                //setTimeout(function(){window.location.assign('{{ route("parent.add") }}');}, 3000);
                //$('#parent_form')[0].reset();
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


                //setTimeout(function(){window.location.assign('{{ route("parent.add") }}');}, 1000);
            });
    
                 $('#parent_btn').prop('disabled', false);
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
            axios.post("{{ route('parent.passport.update.store', $parent->id) }}", formData, {
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
                //setTimeout(function(){window.location.assign('{{ route("parent.add") }}');}, 3000);
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


                //setTimeout(function(){window.location.assign('{{ route("parent.add") }}');}, 1000);
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
            axios.post("{{ route('parent.password.update.store', $parent->id) }}", formData, {
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
                //setTimeout(function(){window.location.assign('{{ route("parent.add") }}');}, 3000);
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


                //setTimeout(function(){window.location.assign('{{ route("parent.add") }}');}, 1000);
            });
    
                 $('#password_btn').prop('disabled', false);
            });
        });
    </script>
</x-dash-layout>
