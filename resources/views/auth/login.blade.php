<x-visitor-layout>
   <div class="w-full mb-3">
        <p class="flex"><img src="{{ asset('img/cloe-removebg.png') }}" width="50"> <span
                class="text-black font-bold text-3xl p-2">Cloé Edu</span></p>
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />


    <form method="POST" action="{{ route('login') }}" id="signin_form">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3" id="signin_btn">
                {{ __('Log in') }}
            </x-primary-button>
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
</x-visitor-layout>
