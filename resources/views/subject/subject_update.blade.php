<x-dash-layout>
    <div name="header" class="bg-white p-3 flex justify-between mb-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fad fa-sitemap text-xl mr-1"></i>
            {{ __('Subject') }}
        </h2>
        <h2 class="font-semibold text-sm text-gray-500 leading-tight">
            {{ "Dashboard/Subject/Update" }}
        </h2>
    </div>

    <div class="w-full p-6 bg-white">
        <div class="flex w-full justify-start bg-gray-100 p-2 mb-3">
            <span>
                <a href="{{ route('subject') }}" class="text-md font-bold p-2 rounded bg-gray-300 hover:bg-gray-800 hover:text-white">Back <i class="fad fa-backward text-xl ml-1"></i></a>
            </span>
        </div>

        <div class="block w-full bg-gray-50 p-2 mb-3">
            <h1 class="text-xl font-bold">Update Subject</h1>
            <p class="text-sm text-gray-500">Fill all field acurately. All field are required</p>

            <form action="{{ route('subject.update.store', $subject->id) }}" method="post" enctype="multipart/form-data" id="subject_form">
                @csrf
                @method('PUT')
                <div class="w-full max-w-screen-lg">

                    <div class="w-full block gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full mb-3">
                            <label for="" class="text-gray-500 font-semibold">{{ "Class" }}</label>
                            <input type="text" name="class" list="classes" class="w-full p-2 border-gray-200" value="{{ $subject->class }}">
                            <datalist id="classes">
                                @foreach ($classes as $data)
                                    <option>{{ $data->class }}</option>
                                @endforeach
                            </datalist>
                        </div>

                        <div class="block w-full mb-3">
                            <label for="" class="text-gray-500 font-semibold">{{ "Teacher" }}</label>
                            <input type="text" name="teacher" list="teachers" class="w-full p-2 border-gray-200" value="{{ $subject->teacher }}">
                            <datalist id="teachers">
                                @foreach ($teachers as $data)
                                    <option>{{ $data->account_name }}</option>
                                @endforeach
                            </datalist>
                        </div>

                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Type" }}</label>
                            <input type="text" name="type" list="types" class="w-full p-2 border-gray-200" value="{{ $subject->type }}">
                            <datalist id="types">
                                <option>Mandatory</option>
                                <option>Optional</option>
                            </datalist>
                        </div>

                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Pass Mark" }}</label>
                            <input type="number" name="pass_mark" class="w-full p-2 border-gray-200" value="{{ $subject->pass_mark }}">
                        </div>

                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Total Mark" }}</label>
                            <input type="number" name="total_mark" class="w-full p-2 border-gray-200" value="{{ $subject->total_mark }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Subject" }}</label>
                            <input type="text" name="subject" class="w-full p-2 border-gray-200" value="{{ $subject->subject }}">
                        </div>

                        <div class="block w-full">
                            <label for="" class="text-gray-500 font-semibold">{{ "Subject Code" }}</label>
                            <input type="text" name="subject_code" class="w-full p-2 border-gray-200" value="{{ $subject->subject_code }}">
                        </div>
                    </div>

                    <div class="w-full lg:flex gap-3 p-2 mb-3 bg-gray-200 bg-opacity-25">
                        <div class="block w-full">
                            <button id="subject_btn" class="flex gap-2 lg:w-60 w-full p-2 bg-blue-500 hover:bg-blue-700 text-white font-bold">
                                {{ "Update Subject" }} 
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

            $('#subject_form').on('submit', function (event) {
            event.preventDefault(); // Prevent form from submitting normally
            
            $('#subject_btn').prop('disabled', true);
            $('#loader').show();
    
            // Create a FormData object to hold form data, including file upload
            let formData = new FormData(this);
    
            // Use Axios to send the form data to the server
            axios.post("{{ route('subject.update.store', $subject->id) }}", formData, {
                headers: {
                'Content-Type': 'multipart/form-data'
                }
            })
    
            .then(response => {
                /////////////////////////////////////////
                //console.log(response.data); // Check the data object specifically
                // Handle success
                //alert('Application Submitted Successfully!');
                $('#subject_btn').prop('disabled', false);
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
                //setTimeout(function(){window.location.assign('{{ route("subject.add") }}');}, 3000);
                //$('#subject_form')[0].reset();
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


                //setTimeout(function(){window.location.assign('{{ route("subject.add") }}');}, 1000);
            });
    
                 $('#subject_btn').prop('disabled', false);
                $('#loader').hide();
            });
        });

    </script>
</x-dash-layout>
