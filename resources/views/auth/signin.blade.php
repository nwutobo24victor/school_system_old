<x-guest-layout>
    <p class="text-black font-bold text-3xl p-2">Staff Login</p>

    <form action="{{ route('signin') }}" id="signin_form" method="post">
        @csrf
        <div class="mb-3">
            <label for="email" class="block font-medium text-sm text-gray-700">{{ 'Email Address' }}</label>
            <input type="email" name="email" id="email" class="block mt-1 w-full border-gray-100" required
                autofocus autocomplete="email">
        </div>
        <div class="mb-3">
            <label for="password" class="block font-medium text-sm text-gray-700">{{ 'Password' }}</label>
            <input type="password" name="password" id="password" class="block mt-1 w-full border-gray-100" required>
        </div>
        <div class="flex gap-2 mt-4">
            <input type="checkbox" name="remember" id="remember" value="remember">
            <label for="remember" class="block font-medium text-sm text-gray-700">{{ 'Remember me' }}</label>
        </div>
        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('password.request') }}"
                class="block font-medium text-sm text-gray-700 hover:text-gray-900">{{ 'Forgot your password?' }}</a>
            <button type="submit" id="signin_btn"
                class="flex gap-2 ms-3 font-medium text-sm px-4 py-2 rounded text-white bg-black hover:bg-gray-500">
                {{ 'Sign In' }}
                <img src="{{ asset('img/loader_2.gif') }}" width="20" id="loader">
            </button>
        </div>
    </form>


    <script>
        $(document).ready(function() {
            // On form submission
            $('#loader').hide();

            $('#signin_form').on('submit', function(event) {
                event.preventDefault(); // Prevent form from submitting normally

                $('#signin_btn').prop('disabled', true);
                $('#signin_btn').removeClass('bg-black hover:bg-gray-500');
                $('#signin_btn').addClass('bg-gray-500');
                $('#loader').show();

                // Create a FormData object to hold form data, including file upload
                let formData = new FormData(this);

                // Use Axios to send the form data to the server
                axios.post("{{ route('signin') }}", formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })

                    .then(response => {
                        /////////////////////////////////////////
                        //console.log(response.data); // Check the data object specifically
                        // Handle success
                        //alert('Application Submitted Successfully!');
                        $('#signin_btn').prop('disabled', false);
                        $('#signin_btn').addClass('bg-black hover:bg-gray-500');
                        $('#signin_btn').removeClass('bg-gray-500');
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
                            setTimeout(function() {
                                window.location.assign('{{ route('dashboard') }}');
                            }, 3000);
                        }
                        //////////////////////////////////////
                    })
                    .catch(error => {
                        console.error('There was an error!', error);
                        setTimeout(function() {
                            window.location.assign('{{ route('signin') }}');
                        }, 1000);
                    });


            });
        });
    </script>
</x-guest-layout>
