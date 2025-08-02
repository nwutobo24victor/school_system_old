<x-dash-layout>
    <div name="header" class="bg-white p-3 flex justify-between mb-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fad fa-user-edit text-xl mr-1"></i>
            {{ __('Profile') }}
        </h2>
        <h2 class="font-semibold text-sm text-gray-500 leading-tight">
            {{ "Dashboard/Profile/" }}
        </h2>
    </div>

    <div class="w-full p-6 md:flex gap-4 bg-gray-700">
        <div class="max-w-xl p-6">
            <img src="{{ asset('upload_photo/'.Auth::user()->passport_photo) }}" class="w-[20rem] h-[15rem] rounded-full">
        </div>

        <div class="w-full py-6 mb-3">
            
            <div class="w-full flex justify-between mb-6">
                <div class="block text-white capitalize">
                    @if (Auth::user()->role == "student")
                    <h1 class="font-bold text-2xl">{{ Auth::user()->surname }} {{ Auth::user()->othernames }}</h1>
                    <p class="space-x-2">
                        <span class="border border-green-300 rounded-lg text-sm px-2 text-black bg-green-300">{{ Auth::user()->role }}</span>
                        <span class="border rounded-lg text-sm px-2 text-white">{{ Auth::user()->state_origin }}</span>
                        <span class="border rounded-lg text-sm px-2 text-white">{{ Auth::user()->local_govt_area }}</span>
                    </p>
                    <p class=""><i> {{ Auth::user()->remark }} </i></p>
                    @else
                    <h1 class="font-bold text-2xl">{{ Auth::user()->account_name }} </h1>
                    <p class="space-x-2">
                        <span class="border border-green-300 rounded-lg text-sm px-2 text-black bg-green-300">{{ Auth::user()->role }}</span>
                        <span class="border rounded-lg text-sm px-2 text-white">{{ Auth::user()->status }}</span>
                        <span class="border rounded-lg text-sm px-2 text-white">{{ Auth::user()->username }}</span>
                    </p>
                    <p class=""><i> {{ Auth::user()->remark }} </i></p>
                    @endif
                </div>
                <div class="block text-white">
                    <p class="flex gap-2">
                        <i class="fas fa-bars"></i>
                        <i class="fas fa-bars"></i>
                        <i class="fas fa-bars"></i>
                    </p>
                </div>
            </div>

            <div class="w-full flex justify-between">
                <div class="block text-white lowercase">
                    <h1 class="font-bold text-xl">{{ Auth::user()->email }}</h1>
                    <h1 class="font-bold text-xl">{{ Auth::user()->phone }}</h1>
                    @if (Auth::user()->role == "student")
                    <p class="capitalize">{{ Auth::user()->current_address }}</p>
                    <hr class="text-white py-4">
                    <span class="text-sm uppercase font-bold mb-0 p-0">Permanent Address: </span>
                    <p class="capitalize my-0 p-0">{{ Auth::user()->permanent_address }}</p>
                    @else
                    <hr class="text-white py-4">
                    <span class="text-sm uppercase font-bold mb-0 p-0">Current Address: </span>
                    <p class="capitalize my-0 p-0">{{ Auth::user()->current_address }}</p>
                    @endif
                </div>
                <div class="block text-white py-4">
                    <a href="https://wa.me/{{ Auth::user()->phone }}" target="_blank" class="flex gap-2 bg-green-500 px-3 py-2 hover:bg-green-700 rounded">
                        {{ "Whatsapp Msg" }}
                        <span class="pt-1"><i class="fas fa-phone"></i></span>
                    </a>
                </div>
            </div>

        </div>

    </div>

    <div class="py-12">
        <div class="w-full mx-auto space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-dash-layout>
