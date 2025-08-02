<x-dash-layout>
    <div name="header" class="bg-white p-3 flex justify-between mb-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fad fa-sitemap text-xl mr-1"></i>
            {{ __('Assignment') }}
        </h2>
        <h2 class="font-semibold text-sm text-gray-500 leading-tight">
            {{ "Dashboard/Assignment/Add" }}
        </h2>
    </div>

    <div class="w-full p-6 bg-white">
        <div class="flex w-full justify-start bg-gray-100 p-2 mb-3">
            <span>
                <a href="{{ route('assignment') }}" class="text-md font-bold p-2 rounded bg-gray-300 hover:bg-gray-800 hover:text-white">Back <i class="fad fa-backward text-xl ml-1"></i></a>
            </span>
        </div>

        <div class="block w-full bg-gray-50 p-2">

            <div class="w-full max-w-screen-lg mb-3">
                <div class="block p-2 bg-red-100 border-l-8 border-red-500">
                    <p>Note: Create class section and subject before creating new assignment.</p>
                </div>
            </div>

            <h1 class="text-xl font-bold">Add New Assignment</h1>
            <p class="text-sm text-gray-500">Fill all field acurately. All field are required</p>
            <form action="{{ route('assignment.add.store') }}" method="post" enctype="multipart/form-data" id="assignment_form">
                @csrf
                <div class="w-full max-w-screen-lg">

                    <div class="w-full block gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="w-full lg:flex gap-3 mb-3">
                            <div class="block w-full">
                                <label for="" class="text-gray-500 font-semibold">{{ "Class" }}</label>
                                <select id="classes" name="class" class="w-full p-2 border-gray-200">
                                    <option value="" selected disabled>Select Class</option>
                                    @foreach ($classes as $data)
                                        <option>{{ $data->class }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="block w-full">
                                <label for="" class="text-gray-500 font-semibold">{{ "Section" }}</label>
                                <select id="sections" name="section" class="w-full p-2 border-gray-200">
                                    <option value="" selected disabled>Select Section</option>
                                    @foreach ($sections as $data)
                                        <option value="{{ $data->category }}">{{ $data->class }} {{ $data->category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="block w-full mb-3">
                            <label for="" class="text-gray-500 font-semibold">{{ "Subject" }}</label>
                            <select id="subjects" name="subject" class="w-full p-2 border-gray-200">
                                <option value="" selected disabled>Select Subject</option>
                                @foreach ($subjects as $data)
                                    <option value="{{ $data->class }}, {{ $data->subject }}, {{ $data->subject_code }}">{{ $data->class }} {{ $data->subject }}, {{ $data->subject_code }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="block w-full mb-3">
                            <label for="" class="text-gray-500 font-semibold">{{ "Title" }}</label>
                            <input type="text" name="title" class="w-full p-2 border-gray-200">
                        </div>

                        <div class="block w-full mb-3">
                            <label for="" class="text-gray-500 font-semibold">{{ "Description" }}</label>
                            <textarea name="description" id="" cols="30" rows="3" class="w-full p-2 border-gray-200"></textarea>
                        </div>

                        <div class="block w-full mb-3">
                            <label for="" class="text-gray-500 font-semibold">{{ "Submission Date" }}</label>
                            <input type="date" name="deadline" class="w-full p-2 border-gray-200">
                        </div>

                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">

                        <div class="block lg:w-[400px]">
                            <p class="text-gray-500 font-semibold">{{ "Upload File" }}</p>  
                           <div class="card rounded-lg bg-white p-3 w-full">
                                <p class="text-gray-500 text-sm">
                                    {{ "File should be in pdf format" }}
                                    <br> 
                                    {{ "Size should not be more than 1mb." }}
                                </p>  

                                <p class="flex w-full">
                                    <label for="assignment_file" class="bg-yellow-400 rounded-l text-black p-2 hover:bg-yellow-500">{{ "Select" }}</label>
                                    <span id="assignment_display" class="w-full border border-yellow-400 rounded-r text-dark font-semibold p-2 overflow-hidden">No file selected</span>
                                </p>

                                <input type="file" name="assignment_file" id="assignment_file" class="w-full p-2 bg-white border-gray-200 hidden" accept=".pdf">
                           </div>
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <button id="assignment_btn" class="flex gap-2 lg:w-60 w-full p-2 bg-blue-500 hover:bg-blue-700 text-white font-bold">
                                {{ "Add Assignment" }} 
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
            $('#assignment_file').change(function() {
                var fileName = $(this).val().split('\\').pop(); // Get the file name from the full path
                $('#assignment_display').text(fileName); // Display the file name in the #assignment_display div
            });
        });

        $(document).ready(function () {
            // On form submission
            $('#loader').hide();

            $('#assignment_form').on('submit', function (event) {
            event.preventDefault(); // Prevent form from submitting normally
            
            $('#assignment_btn').prop('disabled', true);
            $('#loader').show();
    
            // Create a FormData object to hold form data, including file upload
            let formData = new FormData(this);
    
            // Use Axios to send the form data to the server
            axios.post("{{ route('assignment.add.store') }}", formData, {
                headers: {
                'Content-Type': 'multipart/form-data'
                }
            })
    
            .then(response => {
                /////////////////////////////////////////
                //console.log(response.data); // Check the data object specifically
                // Handle success
                //alert('Application Submitted Successfully!');
                $('#assignment_btn').prop('disabled', false);
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
                    //setTimeout(function(){window.location.assign('{{ route("class.add") }}');}, 3000);
                    $('#assignment_form')[0].reset();
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


                //setTimeout(function(){window.location.assign('{{ route("assignment.add") }}');}, 1000);
            });
    
                 $('#assignment_btn').prop('disabled', false);
                $('#loader').hide();
            });
        });
    </script>
</x-dash-layout>
