<x-dash-layout>
    <div name="header" class="bg-white p-3 flex justify-between mb-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fad fa-sitemap text-xl mr-1"></i>
            {{ __('Syllabus') }}
        </h2>
        <h2 class="font-semibold text-sm text-gray-500 leading-tight">
            {{ "Dashboard/Syllabus/Update" }}
        </h2>
    </div>

    <div class="w-full p-6 bg-white">
        <div class="flex w-full justify-start bg-gray-100 p-2 mb-3">
            <span>
                <a href="{{ route('syllabus') }}" class="text-md font-bold p-2 rounded bg-gray-300 hover:bg-gray-800 hover:text-white">Back <i class="fad fa-backward text-xl ml-1"></i></a>
            </span>
        </div>

        <div class="block w-full bg-gray-50 p-2 mb-3">
            <h1 class="text-xl font-bold">Update Syllabus</h1>
            <p class="text-sm text-gray-500">Fill all field acurately. All field are required</p>

            <form action="{{ route('syllabus.update.store', $syllabus->id) }}" method="post" enctype="multipart/form-data" id="syllabus_form">
                @csrf
                @method('PUT')
                <div class="w-full max-w-screen-lg">

                    <div class="w-full block gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full mb-3">
                            <label for="" class="text-gray-500 font-semibold">{{ "Class" }}</label>
                            <input type="text" name="class" list="classes" class="w-full p-2 border-gray-200" value="{{ $syllabus->class }}">
                            <datalist id="classes">
                                @foreach ($classes as $data)
                                    <option>{{ $data->class }}</option>
                                @endforeach
                            </datalist>
                        </div>

                        <div class="block w-full mb-3">
                            <label for="" class="text-gray-500 font-semibold">{{ "Title" }}</label>
                            <input type="text" name="title" class="w-full p-2 border-gray-200" value="{{ $syllabus->class }}">
                        </div>

                        <div class="w-full mb-3" hidden>
                            <label for="" class="text-gray-500 font-semibold">{{ "Uploader" }}</label>
                            <input type="hidden" name="uploader" class="w-full p-2 border-gray-200" readonly value="{{ Auth::user()->account_name }}">
                        </div>

                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Description" }}</label>
                            <textarea name="description" id="" cols="30" rows="3" class="w-full p-2 border-gray-200">{{ $syllabus->description }}</textarea>
                        </div>

                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <button id="syllabus_btn" class="flex gap-2 lg:w-60 w-full p-2 bg-blue-500 hover:bg-blue-700 text-white font-bold">
                                {{ "Update Syllabus" }} 
                                <img src="{{ asset('img/loader_2.gif') }}" width="20" id="loader">
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <div class="block w-full bg-gray-50 p-2 mb-3">
            <div class="block p-3 bg-gray-200 bg-opacity-25">
                <h1 class="text-xl font-bold">Change Syllabus File</h1>
                <p class="text-gray-500 text-sm">
                    {{ "File should be in pdf format" }}
                    <br> 
                    {{ "Size should not be more than 1mb." }}
                </p> 
                <form action="{{ route('syllabus.syllabus_file.update.store', $syllabus->id) }}" method="post" id="syllabus_file_form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="block mb-3">
                        <p class="flex w-full">
                            <label for="syllabus_file" class="bg-yellow-400 rounded-l text-black p-2 hover:bg-yellow-500">{{ "Select" }}</label>
                            <span id="syllabus_display" class="w-full border border-yellow-400 rounded-r text-dark font-semibold p-2 overflow-hidden">{{ $syllabus->syllabus_file }}</span>
                        </p>

                        <input type="file" name="syllabus_file" id="syllabus_file" class="w-full p-2 bg-white border-gray-200 hidden" accept=".pdf">
                    </div>
                    <div class="block lg:w-60">
                        <button type="submit" name="syllabus_file_btn" class="w-full p-2 bg-black text-white text-left hover:bg-gray-500"> Upload syllabus file </button>
                    </div>
                </form>
            </div>
    </div>

    <script>

        $(document).ready(function() {
            $('#syllabus_file').change(function() {
                var fileName = $(this).val().split('\\').pop(); // Get the file name from the full path
                $('#syllabus_display').text(fileName); // Display the file name in the #syllabus_display div
            });
        });

        //////////////////////// UPDATE class
        $(document).ready(function () {
            // On form submission
            $('#loader').hide();

            $('#syllabus_form').on('submit', function (event) {
            event.preventDefault(); // Prevent form from submitting normally
            
            $('#syllabus_btn').prop('disabled', true);
            $('#loader').show();
    
            // Create a FormData object to hold form data, including file upload
            let formData = new FormData(this);
    
            // Use Axios to send the form data to the server
            axios.post("{{ route('syllabus.update.store', $syllabus->id) }}", formData, {
                headers: {
                'Content-Type': 'multipart/form-data'
                }
            })
    
            .then(response => {
                /////////////////////////////////////////
                //console.log(response.data); // Check the data object specifically
                // Handle success
                //alert('Application Submitted Successfully!');
                $('#syllabus_btn').prop('disabled', false);
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
                //setTimeout(function(){window.location.assign('{{ route("syllabus.add") }}');}, 3000);
                //$('#syllabus_form')[0].reset();
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


                //setTimeout(function(){window.location.assign('{{ route("syllabus.add") }}');}, 1000);
            });
    
                 $('#syllabus_btn').prop('disabled', false);
                $('#loader').hide();
            });
        });

        /////////////////UPDATE syllabus_file
        $(document).ready(function () {
            // On form submission
            $('#syllabus_file_form').on('submit', function (event) {
            event.preventDefault(); // Prevent form from submitting normally
            
            $('#syllabus_file_btn').prop('disabled', true);
    
            // Create a FormData object to hold form data, including file upload
            let formData = new FormData(this);
    
            // Use Axios to send the form data to the server
            axios.post("{{ route('syllabus.syllabus_file.update.store', $syllabus->id) }}", formData, {
                headers: {
                'Content-Type': 'multipart/form-data'
                }
            })
    
            .then(response => {
                /////////////////////////////////////////
                //console.log(response.data); // Check the data object specifically
                // Handle success
                //alert('Application Submitted Successfully!');
                $('#syllabus_file_btn').prop('disabled', false);
                
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
                //setTimeout(function(){window.location.assign('{{ route("syllabus.add") }}');}, 3000);
                $('#syllabus_file_form')[0].reset();
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


                //setTimeout(function(){window.location.assign('{{ route("syllabus.add") }}');}, 1000);
            });
    
                 $('#syllabus_file_btn').prop('disabled', false);
            });
        });
    </script>
</x-dash-layout>
