<x-visitor-layout>
    <div class="w-full mb-3">
        <p class="flex"><img src="{{ asset('img/cloe-removebg.png') }}" width="50"> <span
                class="text-black font-bold text-3xl p-2">Cloé Edu</span></p>
    </div>
    <p class="block font-medium text-sm text-gray-700 mb-3">Forgot your password? No problem. Just let us know your email
        address and we will email you a password reset link that will allow you to choose a new one.</p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form action="{{ route('password.email') }}" id="forget_form" method="post">
        @csrf

        <div class="mb-3">
            <label for="email" class="block font-medium text-sm text-gray-700">{{ 'Email Address' }}</label>
            <input type="email" name="email" id="email" class="block mt-1 w-full border-gray-100" required
                autofocus autocomplete="email">
        </div>
        <div class="flex items-center justify-end mt-4">
            <a href="{{ url('/signin') }}"
                class="block font-medium text-sm text-gray-700 hover:text-gray-900">{{ 'Remembered your password?' }}</a>
            <button type="submit" id="forget_btn"
                class="flex gap-2 ms-3 font-medium text-sm px-4 py-2 rounded text-white bg-black hover:bg-gray-500">
                {{ 'Email Password Reset Link' }}
                <img src="{{ asset('img/loader_2.gif') }}" width="20" id="loader">
            </button>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            // On form submission
            $('#loader').hide();

            $('#forget_form').on('submit', function(event) {
                event.preventDefault(); // Prevent form from submitting normally

                $('#forget_btn').prop('disabled', true);
                $('#forget_btn').removeClass('bg-black hover:bg-gray-500');
                $('#forget_btn').addClass('bg-gray-500');
                $('#loader').show();

                // Create a FormData object to hold form data, including file upload
                let formData = new FormData(this);

                // Use Axios to send the form data to the server
                axios.post("{{ route('password.email') }}", formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })

                    .then(response => {
                        /////////////////////////////////////////
                        //console.log(response.data); // Check the data object specifically
                        // Handle success
                        //alert('Application Submitted Successfully!');
                        $('#forget_btn').prop('disabled', false);
                        $('#forget_btn').addClass('bg-black hover:bg-gray-500')
                        $('#forget_btn').removeClass('bg-gray-500')
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
                            //setTimeout(function(){window.location.assign('{{ url('forgot-password') }}');}, 3000);
                        }
                        //////////////////////////////////////
                    })
                    .catch(error => {
                        console.error('There was an error!', error);
                        setTimeout(function() {
                            window.location.assign('{{ url('forgot-password') }}');
                        }, 1000);
                    });


            });
        });
    </script>
</x-visitor-layout>
