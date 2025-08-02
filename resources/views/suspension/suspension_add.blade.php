<x-dash-layout>
    <div name="header" class="bg-white p-3 flex justify-between mb-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fad fa-sitemap text-xl mr-1"></i>
            {{ __('Suspension') }}
        </h2>
        <h2 class="font-semibold text-sm text-gray-500 leading-tight">
            {{ "Dashboard/Suspension/Add" }}
        </h2>
    </div>

    <div class="w-full p-6 bg-white">
        <div class="flex w-full justify-start bg-gray-100 p-2 mb-3">
            <span>
                <a href="{{ route('suspension') }}" class="text-md font-bold p-2 rounded bg-gray-300 hover:bg-gray-800 hover:text-white">Back <i class="fad fa-backward text-xl ml-1"></i></a>
            </span>
        </div>
        <div class="block w-full bg-gray-50 p-2">

            <div class="w-full max-w-screen-lg mb-3">
                <div class="block p-2 bg-red-100 border-l-8 border-red-500">
                    <p>Note: Create class before creating new section.</p>
                </div>
            </div>
            
            <h1 class="text-xl font-bold">New Suspension</h1>
            <p class="text-sm text-gray-500">Fill all field acurately. All field are required</p>
            <form action="{{ route('suspension.add.store') }}" method="post" enctype="multipart/form-data" id="suspension_form">
                @csrf
                <div class="w-full max-w-screen-lg">

                    <div class="w-full block gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Name" }}</label>
                            <select id="names" name="name" class="w-full p-2 border-gray-200">
                                <option value="" selected disabled>Select Student</option>
                                @foreach ($students as $data)
                                    <option value="{{ $data->id }}">{{ $data->surname }} {{ $data->othernames }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="w-full flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Registration Number" }}</label>
                            <input type="text" name="registration_no" class="w-full p-2 border-gray-200">
                        </div>

                        <div class="block w-full mb-3">
                            <label for="" class="text-gray-500 font-semibold">{{ "Class" }}</label>
                            <select id="classes" name="class" class="w-full p-2 border-gray-200">
                                <option value="" selected disabled>Select Class</option>
                                @foreach ($classes as $data)
                                    <option>{{ $data->class }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="block w-full mb-3">
                            <label for="" class="text-gray-500 font-semibold">{{ "Suspension Type" }}</label>
                            <select id="status" name="status" class="w-full p-2 border-gray-200">
                                <option selected>Temporary</option>
                                <option>Indefinate</option>
                            </select>
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Note" }}</label>
                            <textarea name="note" id="" cols="30" rows="3" class="w-full p-2 border-gray-200"></textarea>
                        </div>
                    </div>

                    <div class="w-full flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Start Date" }}</label>
                            <input type="date" name="start_date" class="w-full p-2 border-gray-200">
                        </div>

                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "End Date" }}</label>
                            <input type="date" name="end_date" class="w-full p-2 border-gray-200">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <button id="suspension_btn" class="flex gap-2 lg:w-60 w-full p-2 bg-blue-500 hover:bg-blue-700 text-white font-bold">
                                {{ "Add Suspension" }} 
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

        $(document).ready(function () {
            // On form submission
            $('#loader').hide();

            $('#suspension_form').on('submit', function (event) {
            event.preventDefault(); // Prevent form from submitting normally
            
            $('#suspension_btn').prop('disabled', true);
            $('#loader').show();
    
            // Create a FormData object to hold form data, including file upload
            let formData = new FormData(this);
    
            // Use Axios to send the form data to the server
            axios.post("{{ route('suspension.add.store') }}", formData, {
                headers: {
                'Content-Type': 'multipart/form-data'
                }
            })
    
            .then(response => {
                /////////////////////////////////////////
                //console.log(response.data); // Check the data object specifically
                // Handle success
                //alert('Application Submitted Successfully!');
                $('#suspension_btn').prop('disabled', false);
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
                    $('#suspension_form')[0].reset();
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


                //setTimeout(function(){window.location.assign('{{ route("suspension.add") }}');}, 1000);
            });
    
                 $('#suspension_btn').prop('disabled', false);
                $('#loader').hide();
            });
        });
    </script>
</x-dash-layout>
