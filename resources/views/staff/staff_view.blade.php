<x-dash-layout>
    <div name="header" class="bg-white p-3 flex justify-between mb-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fad fa-users text-xl mr-1"></i>
            {{ __('Other Staffs') }}
        </h2>
        <h2 class="font-semibold text-sm text-gray-500 leading-tight">
            {{ "Dashboard/Staffs/View" }}
        </h2>
    </div>

    <div class="w-full p-6 bg-white">
        <div class="flex w-full justify-start bg-gray-100 p-2 mb-3">
            <span>
                <a href="{{ route('staff') }}" class="text-md font-bold p-2 rounded bg-gray-300 hover:bg-gray-800 hover:text-white">Back <i class="fad fa-backward text-xl ml-1"></i></a>
            </span>
        </div>
        <div class="block w-full bg-gray-100">
            <div class="p-2 lg:flex gap-3">
                <div class="block">
                    <img src="{{ asset('upload_photo/'.$staff->passport_photo) }}" sstyle="width: 400px; height:400px;" class="w-60 h-60"> 
                </div>

                <div class="w-full py-6 mb-3 px-6">
            
                    <div class="w-full flex justify-between mb-6">
                        <div class="block text-black capitalize">
                            <h1 class="font-bold text-3xl">{{ $staff->account_name }}</h1>
                            <p class="space-x-2 text-black">
                                <span class="border border-green-300 rounded-lg text-sm px-2 text-black bg-green-300">{{ $staff->role }}</span>
                                <span class="border border-black rounded-lg text-sm px-2">{{ $staff->position }}</span>
                                <span class="border border-black rounded-lg text-sm px-2">{{ $staff->username }}</span>
                            </p>
                        </div>
                        <div class="block text-black">
                            <p class="flex gap-2">Created: <span class="font-bold">{{ \Carbon\Carbon::parse($staff->created_at)->format('d M, Y - H:i') }}</span></p>
                        </div>
                    </div>
        
                    <div class="w-full">
                        <div class="block text-black lowercase">
                            <h1 class="font-bold text-xl">{{ $staff->email }}</h1>
                            <h1 class="font-bold text-xl">{{ $staff->phone }}</h1>
                            <p class="capitalize">{{ $staff->current_address }}</p>
                            <hr class="text-white py-4">
                        </div>
                    </div>
        
                </div>


            </div>
        </div>
        <div class="block w-full bg-gray-50">
            <div class="p-2">
                <p>Staff's Name: <span class="text-lg font-semibold">{{ $staff->account_name }}</span></p>
                <p>Qualification: <span class="text-lg font-semibold">{{ $staff->qualification }}</span></p>
                <p>Employment Date: <span class="text-lg font-semibold">{{ $staff->employment_date }}</span></p>
                <p>Position: <span class="text-lg font-semibold">{{ $staff->position }}</span></p>
                <p>Date of Birth: <span class="text-lg font-semibold">{{ $staff->date_birth }}</span></p>
                <p>Gender: <span class="text-lg font-semibold">{{ $staff->gender }}</span></p>
                <p>Religion: <span class="text-lg font-semibold">{{ $staff->religion }}</span></p>
                <p>Email: <span class="text-lg font-semibold">{{ $staff->email }}</span></p>
                <p>Phone: <span class="text-lg font-semibold">{{ $staff->phone }}</span></p>
                <p>Current Address: <span class="text-lg font-semibold">{{ $staff->current_address }}</span></p>
                <p>Username: <span class="text-lg font-semibold">{{ $staff->username }}</span></p>
            </div>
        </div>
    </div>

</x-dash-layout>
