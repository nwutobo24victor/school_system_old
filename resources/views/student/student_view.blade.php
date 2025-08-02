<x-dash-layout>
    <div name="header" class="bg-white p-3 flex justify-between mb-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fad fa-user-graduate text-xl mr-1"></i>
            {{ __('Student') }}
        </h2>
        <h2 class="font-semibold text-sm text-gray-500 leading-tight">
            {{ "Dashboard/Student/View" }}
        </h2>
    </div>

    <div class="w-full p-6 bg-white">
        <div class="flex w-full justify-start bg-gray-100 p-2 mb-3">
            <span>
                <a href="{{ route('student') }}" class="text-md font-bold p-2 rounded bg-gray-300 hover:bg-gray-800 hover:text-white">Back <i class="fad fa-backward text-xl ml-1"></i></a>
            </span>
        </div>
        <div class="block w-full bg-gray-100">
            <div class="p-2 lg:flex gap-3">
                <div class="block">
                    <img src="{{ asset('upload_photo/'.$student->passport_photo) }}" sstyle="width: 400px; height:400px;" class="w-60 h-60"> 
                </div>

                <div class="w-full py-6 mb-3 px-6">
            
                    <div class="w-full flex justify-between mb-6">
                        <div class="block text-black capitalize">
                            <h1 class="font-bold text-3xl">{{ $student->surname }} {{ $student->othernames }}</h1>
                            <p class="space-x-2 text-black">
                                <span class="border border-green-300 rounded-lg text-sm px-2 text-black bg-green-300">{{ $student->section ?? $student->department ?? "Not Filled" }}</span>
                                <span class="border border-black rounded-lg text-sm px-2">{{ $student->state_origin }}</span>
                                <span class="border border-black rounded-lg text-sm px-2">{{ $student->local_govt_area }}</span>
                            </p>
                            <p class="">Remark: <i> {{ $student->remark }} </i></p>
                        </div>
                        <div class="block text-black">
                            <p class="flex gap-2">Admitted: <span class="font-bold">{{ \Carbon\Carbon::parse($student->admission_date)->format('d M, Y') }}</span></p>
                        </div>
                    </div>
        
                    <div class="w-full flex justify-between">
                        <div class="block text-black lowercase">
                            <h1 class="font-bold text-xl">{{ $student->email }}</h1>
                            <h1 class="font-bold text-xl">{{ $student->phone }}</h1>
                            <p class="capitalize">{{ $student->current_address }}</p>
                            <hr class="text-white py-4">
                            <span class="text-sm uppercase font-bold mb-0 p-0">Permanent Address: </span>
                            <p class="capitalize my-0 p-0">{{ $student->permanent_address }}</p>
                        </div>
                        <div class="block text-white py-4">
                            <a href="http://whatsapp.me/08089179206" target="_blank" class="flex gap-2 bg-green-500 px-3 py-2 hover:bg-green-700 rounded cursor-pointer">
                                {{ "Whatsapp Msg" }}
                                <span class="pt-1"><i class="fas fa-phone"></i></span>
                            </a>
                        </div>
                    </div>
        
                </div>


            </div>
        </div>
        <div class="block w-full bg-gray-50">
            <div class="p-2">
                <p>Guardian: <span class="text-lg font-semibold">{{ $student->guardian }}</span></p>
                <p>Date of birth: <span class="text-lg font-semibold">{{ \Carbon\Carbon::parse($student->date_birth)->format('d M, Y') }}</span></p>
                <p>Gender: <span class="text-lg font-semibold">{{ $student->gender }}</span></p>
                <p>Blood Group: <span class="text-lg font-semibold">{{ $student->blood_group }}</span></p>
                <p>Religion: <span class="text-lg font-semibold">{{ $student->religion }}</span></p>
                <p>Email: <span class="text-lg font-semibold">{{ $student->email }}</span></p>
                <p>Phone: <span class="text-lg font-semibold">{{ $student->phone }}</span></p>
                <p>Current Address: <span class="text-lg font-semibold">{{ $student->current_address }}</span></p>
                <p>Nationality: <span class="text-lg font-semibold">{{ $student->nationality }}</span></p>
                <p>State of origin: <span class="text-lg font-semibold">{{ $student->state_origin }}</span></p>
                <p>Local government: <span class="text-lg font-semibold">{{ $student->local_govt_area }}</span></p>
                <p>Permanent address: <span class="text-lg font-semibold">{{ $student->permanent_address }}</span></p>
                <p>Class: <span class="text-lg font-semibold">{{ $student->class }}</span></p>
                @if ($student->section != "")
                    <p>Section: <span class="text-lg font-semibold">{{ $student->section }}</span></p>
                @elseif ($student->department != "")
                    <p>Department: <span class="text-lg font-semibold">{{ $student->department }}</span></p>
                @else
                <p>Section or Department: <span class="text-lg font-semibold text-red-500">Not Filled, Update Account</span></p>
                @endif
                <p>Registration number: <span class="text-lg font-semibold">{{ $student->registration_no }}</span></p>
                <p>Remark: <span class="text-lg font-semibold">{{ $student->remark }}</span></p>
                <p>Username: <span class="text-lg font-semibold">{{ $student->username }}</span></p>
            </div>
        </div>
    </div>

</x-dash-layout>
