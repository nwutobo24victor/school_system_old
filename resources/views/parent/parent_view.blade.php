<x-dash-layout>
    <div name="header" class="bg-white p-3 flex justify-between mb-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fad fa-user-secret text-xl mr-1"></i>
            {{ __('Parent') }}
        </h2>
        <h2 class="font-semibold text-sm text-gray-500 leading-tight">
            {{ "Dashboard/Parent/View" }}
        </h2>
    </div>

    <div class="w-full p-6 bg-white">
        <div class="flex w-full justify-start bg-gray-100 p-2 mb-3">
            <span>
                <a href="{{ route('parent') }}" class="text-md font-bold p-2 rounded bg-gray-300 hover:bg-gray-800 hover:text-white">Back <i class="fad fa-backward text-xl ml-1"></i></a>
            </span>
        </div>
        <div class="block w-full bg-gray-100">
            <div class="p-2 lg:flex gap-3">
                <div class="block">
                    <img src="{{ asset('upload_photo/'.$parent->passport_photo) }}" sstyle="width: 400px; height:400px;" class="w-60 h-60"> 
                </div>

                <div class="w-full py-6 mb-3 px-6">
            
                    <div class="w-full flex justify-between mb-6">
                        <div class="block text-black capitalize">
                            <h1 class="font-bold text-3xl">{{ $parent->account_name }}</h1>
                            <p class="space-x-2 text-black">
                                <span class="border border-green-300 rounded-lg text-sm px-2 text-black bg-green-300">{{ 'Guardian' }}</span>
                                <span class="border border-black rounded-lg text-sm px-2">{{ $parent->username }}</span>
                                <span class="border border-black rounded-lg text-sm px-2">{{ $children." Children" }}</span>
                            </p>
                        </div>
                        <div class="block text-black">
                            <p class="flex gap-2">Created: <span class="font-bold">{{ \Carbon\Carbon::parse($parent->created_at)->format('d M, Y - H:i') }}</span></p>
                        </div>
                    </div>
        
                    <div class="w-full">
                        <div class="block text-black lowercase">
                            <h1 class="font-bold text-xl">{{ $parent->email }}</h1>
                            <h1 class="font-bold text-xl">{{ $parent->phone }}</h1>
                            <p class="capitalize">{{ $parent->current_address }}</p>
                            <hr class="text-white py-4">
                        </div>
                    </div>
        
                </div>


            </div>
        </div>
        <div class="block w-full bg-gray-50">
            <div class="p-2">
                <p>Guardian Name: <span class="text-lg font-semibold">{{ $parent->account_name }}</span></p>
                <p>Father's Name: <span class="text-lg font-semibold">{{ $parent->father_name }}</span></p>
                <p>Father's Profession: <span class="text-lg font-semibold">{{ $parent->father_profession }}</span></p>
                <p>Mother's Name: <span class="text-lg font-semibold">{{ $parent->mother_name }}</span></p>
                <p>Mother's Profession: <span class="text-lg font-semibold">{{ $parent->mother_profession }}</span></p>
                <p>Email: <span class="text-lg font-semibold">{{ $parent->email }}</span></p>
                <p>Phone: <span class="text-lg font-semibold">{{ $parent->phone }}</span></p>
                <p>Current Address: <span class="text-lg font-semibold">{{ $parent->current_address }}</span></p>
                <p>Username: <span class="text-lg font-semibold">{{ $parent->username }}</span></p>
            </div>
        </div>
    </div>

</x-dash-layout>
