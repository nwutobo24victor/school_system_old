<x-dash-layout>
    <div name="header" class="bg-white p-3 flex justify-between mb-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fad fa-sitemap text-xl mr-1"></i>
            {{ __('Time Table') }}
        </h2>
        <h2 class="font-semibold text-sm text-gray-500 leading-tight">
            {{ "Dashboard/Timetable/" }}
        </h2>
    </div>

    <div class="w-full p-6 bg-white">


        <div class="flex w-full justify- items-center gap-10 bg-gray-100 p-2 mb-3">
            <span>
                <a href="{{ route('timetable.add') }}" class="text-md font-bold p-2 rounded bg-gray-300 hover:bg-gray-800 hover:text-white">Add Timetable <i class="fad fa-plus text-xl ml-1"></i></a>
            </span>
            <form x-init x-target="userTable" action="{{ route('timetable.select_class') }}" method="post" id="select_class">
                @csrf
                <select name="select_class" class="bg-white border-gray-200 w-60" onchange="this.form.submit()">
                    <option selected disabled>Select Class</option>
                    @foreach ($classes as $data)
                        <option>{{ $data->class }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="block w-full bg-gray-50">

            <div class="w-full p-2" id="notification">
                @if (session()->has('error'))
                    <div class="max-w-lg my-4 p-4 bg-red-100 text-red-800 rounded-lg border border-red-300">
                        <div class="flex items-center justify-between">
                          <p><span class="font-semibold">Error!</span> {{ session('error') }}</p>
                          <button onclick="this.parentElement.parentElement.remove()" class="text-red-600 hover:text-red-800">
                            &times;
                          </button>
                        </div>
                    </div>
                @endif
            
                @if (session()->has('success'))
                <div class="max-w-lg my-4 p-4 bg-green-100 text-green-800 rounded-lg border border-green-300">
                    <div class="flex items-center justify-between">
                      <p><span class="font-semibold">Success!</span> {{ session('success') }}</p>
                      <button onclick="this.parentElement.parentElement.remove()" class="text-green-600 hover:text-green-800">
                        &times;
                      </button>
                    </div>
                </div>
                @endif
            </div>

            
        </div>

        <div class="flex w-full bg-gray-50 p-2 overflow-x-auto">
            <table class="table w-full" id="userTable">
                
                <tbody class=" divide-y divide-gray-200 capitalize">
                    <tr>
                        <td class="font-bold text-xl">{{ "Sunday" }}</td>
                        @foreach($sunday as $data)
                        <td class="w-24 border ">
                            <div class="bg-gray-200 text-sm font-bold">{{ $data->class }}</div>
                            <p class="text-center">
                                {{ $data->starting_time }} {{ $data->ending_time }} <br> {{ $data->section }} <br> {{ $data->subject }}
                            </p>
                            <p>
                                <form x-init x-target="userTable notification" x-on:ajax:before="confirm('Are you sure you want to delete ?') || $event.preventDefault()" action="{{ route('timetable.destroy', $data->id) }}" method="POST" id="timetable_delete_form" class="flex justify-center gap-2">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('timetable.update', $data->id) }}" class="bg-yellow-500 text-white rounded px-2 text-sm">Update</a>
                                    <button type="submit" class="bg-red-500 text-white rounded px-2 text-sm" >Delete</button>
                                </form>
                            </p>
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="font-bold text-xl">{{ "Monday" }}</td>
                        @foreach($monday as $data)
                        <td class="w-24 border ">
                            <div class="bg-gray-200 text-sm font-bold">{{ $data->class }}</div>
                            <p class="text-center">
                                {{ $data->starting_time }} {{ $data->ending_time }} <br> {{ $data->section }} <br> {{ $data->subject }}
                            </p>
                            <p>
                                <form x-init x-target="userTable notification" x-on:ajax:before="confirm('Are you sure you want to delete ?') || $event.preventDefault()" action="{{ route('timetable.destroy', $data->id) }}" method="POST" id="timetable_delete_form" class="flex justify-center gap-2">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('timetable.update', $data->id) }}" class="bg-yellow-500 text-white rounded px-2 text-sm">Update</a>
                                    <button type="submit" class="bg-red-500 text-white rounded px-2 text-sm" >Delete</button>
                                </form>
                            </p>
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="font-bold text-xl">{{ "Tuesday" }}</td>
                        @foreach($tuesday as $data)
                        <td class="w-24 border ">
                            <div class="bg-gray-200 text-sm font-bold">{{ $data->class }}</div>
                            <p class="text-center">
                                {{ $data->starting_time }} {{ $data->ending_time }} <br> {{ $data->section }} <br> {{ $data->subject }}
                            </p>
                            <p>
                                <form x-init x-target="userTable notification" x-on:ajax:before="confirm('Are you sure you want to delete ?') || $event.preventDefault()" action="{{ route('timetable.destroy', $data->id) }}" method="POST" id="timetable_delete_form" class="flex justify-center gap-2">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('timetable.update', $data->id) }}" class="bg-yellow-500 text-white rounded px-2 text-sm">Update</a>
                                    <button type="submit" class="bg-red-500 text-white rounded px-2 text-sm" >Delete</button>
                                </form>
                            </p>
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="font-bold text-xl">{{ "Wednesday" }}</td>
                        @foreach($wednesday as $data)
                        <td class="w-24 border ">
                            <div class="bg-gray-200 text-sm font-bold">{{ $data->class }}</div>
                            <p class="text-center">
                                {{ $data->starting_time }} {{ $data->ending_time }} <br> {{ $data->section }} <br> {{ $data->subject }}
                            </p>
                            <p>
                                <form x-init x-target="userTable notification" x-on:ajax:before="confirm('Are you sure you want to delete ?') || $event.preventDefault()" action="{{ route('timetable.destroy', $data->id) }}" method="POST" id="timetable_delete_form" class="flex justify-center gap-2">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('timetable.update', $data->id) }}" class="bg-yellow-500 text-white rounded px-2 text-sm">Update</a>
                                    <button type="submit" class="bg-red-500 text-white rounded px-2 text-sm" >Delete</button>
                                </form>
                            </p>
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="font-bold text-xl">{{ "Thursday" }}</td>
                        @foreach($thursday as $data)
                        <td class="w-24 border ">
                            <div class="bg-gray-200 text-sm font-bold">{{ $data->class }}</div>
                            <p class="text-center">
                                {{ $data->starting_time }} {{ $data->ending_time }} <br> {{ $data->section }} <br> {{ $data->subject }}
                            </p>
                            <p>
                                <form x-init x-target="userTable notification" x-on:ajax:before="confirm('Are you sure you want to delete ?') || $event.preventDefault()" action="{{ route('timetable.destroy', $data->id) }}" method="POST" id="timetable_delete_form" class="flex justify-center gap-2">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('timetable.update', $data->id) }}" class="bg-yellow-500 text-white rounded px-2 text-sm">Update</a>
                                    <button type="submit" class="bg-red-500 text-white rounded px-2 text-sm" >Delete</button>
                                </form>
                            </p>
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="font-bold text-xl">{{ "Friday" }}</td>
                        @foreach($friday as $data)
                        <td class="w-24 border ">
                            <div class="bg-gray-200 text-sm font-bold">{{ $data->class }}</div>
                            <p class="text-center">
                                {{ $data->starting_time }} {{ $data->ending_time }} <br> {{ $data->section }} <br> {{ $data->subject }}
                            </p>
                            <p>
                                <form x-init x-target="userTable notification" x-on:ajax:before="confirm('Are you sure you want to delete ?') || $event.preventDefault()" action="{{ route('timetable.destroy', $data->id) }}" method="POST" id="timetable_delete_form" class="flex justify-center gap-2">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('timetable.update', $data->id) }}" class="bg-yellow-500 text-white rounded px-2 text-sm">Update</a>
                                    <button type="submit" class="bg-red-500 text-white rounded px-2 text-sm" >Delete</button>
                                </form>
                            </p>
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="font-bold text-xl">{{ "Saturday" }}</td>
                        @foreach($saturday as $data)
                        <td class="w-24 border ">
                            <div class="bg-gray-200 text-sm font-bold">{{ $data->class }}</div>
                            <p class="text-center">
                                {{ $data->starting_time }} {{ $data->ending_time }} <br> {{ $data->section }} <br> {{ $data->subject }}
                            </p>
                            <p>
                                <form x-init x-target="userTable notification" x-on:ajax:before="confirm('Are you sure you want to delete ?') || $event.preventDefault()" action="{{ route('timetable.destroy', $data->id) }}" method="POST" id="timetable_delete_form" class="flex justify-center gap-2">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('timetable.update', $data->id) }}" class="bg-yellow-500 text-white rounded px-2 text-sm">Update</a>
                                    <button type="submit" class="bg-red-500 text-white rounded px-2 text-sm" >Delete</button>
                                </form>
                            </p>
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    

</x-dash-layout>
