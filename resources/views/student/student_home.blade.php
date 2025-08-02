<x-dash-layout>
    <div name="header" class="bg-white p-3 flex justify-between mb-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fad fa-user-graduate text-xl mr-1"></i>
            {{ __('Student') }}
        </h2>
        <h2 class="font-semibold text-sm text-gray-500 leading-tight">
            {{ "Dashboard/Student/" }}
        </h2>
    </div>

    <div class="w-full p-6 bg-white">

        <div class="w-full flex mb-3 justify-end">
            <form x-init x-target="userTable" action="{{ route('student.select_class') }}" method="post" id="select_class">
                @csrf
                <select name="select_class" class="bg-white border-gray-200 w-60" onchange="this.form.submit()">
                    <option selected disabled>Select Class</option>
                    @foreach ($classes as $data)
                        <option>{{ $data->class }}</option>
                    @endforeach
                    <option value="all">All Class</option>
                </select>
            </form>
        </div>

        <div class="flex w-full justify-between bg-gray-100 p-2 mb-3">
            <span>
                <a href="{{ route('student.add') }}" class="text-md font-bold p-2 rounded bg-gray-300 hover:bg-gray-800 hover:text-white">Add Student <i class="fad fa-user-plus text-xl ml-1"></i></a>
            </span>
            <input type="text" id="searchInput" placeholder="Search . . ." class="max-w-md w-40 p-2 bg-white border-gray-100">
        </div>

        <div class="block w-full bg-gray-50 p-2 overflow-x-auto">
            
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

            <table class="table w-full" id="userTable">
                <thead class="px-4 py-2 border bg-gray-300 text-left">
                    <tr>
                        <th>SN</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Roll</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class=" divide-y divide-gray-200 capitalize" id="studentsTableBody">
                    @php
                        $id = 1;
                    @endphp
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $id ++ }}</td>
                        <td> <img src="{{ asset('upload_photo/'.$student->passport_photo) }}" class="w-10 h-10 rounded border border-black"></td>
                        <td>{{ $student->surname }} {{ $student->othernames }}</td>
                        <td>{{ $student->class }} - @if (!empty($student->section)){{ $student->section }} @else {{ $student->department }} @endif</td>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->email }} - {{ $student->phone }}</td>
                        <td>{{ \Carbon\Carbon::parse($student->created_at)->format('d M Y, H:i') }}</td>
                        <td>
                            @php
                                $isSuspended = false;
                                $today = \Carbon\Carbon::today();
                            @endphp
                            @foreach ($suspensions as $data)
                                @if ($student->id == $data->name && $today->lessThanOrEqualTo(\Carbon\Carbon::parse($data->end_date)))
                                    @php
                                        $isSuspended = true;
                                        break;
                                    @endphp
                                @endif
                            @endforeach

                            @if ($isSuspended)
                                <button type="submit" class=" bg-red-200 text-red-700 rounded px-2 text-sm capitalize" >{{ "suspended" }}</button>
                            @else
                                <form x-init x-target="userTable" action="{{ route('student.status.update.store', $student->id) }}" method="POST" id="status_form" class="block">
                                    @csrf
                                    @method('put')
                                    @if ( $student->status == "active" )
                                        <button type="submit" class=" bg-emerald-200 text-emerald-700 rounded px-2 text-sm capitalize" >{{ $student->status }}</button>
                                    @else
                                        <button type="submit" class=" bg-yellow-200 text-yellow-700 rounded px-2 text-sm capitalize" >{{ $student->status }}</button>
                                    @endif
                                </form>
                            @endif
                        </td>
                        <td>
                            <form x-init x-target="userTable notification" x-on:ajax:before="confirm('Are you sure you want to delete ?') || $event.preventDefault()" action="{{ route('student.destroy', $student->id) }}" method="POST" id="student_delete_form" class="block">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('student.view', $student->id) }}" class="bg-blue-500 text-white rounded px-2 text-sm">View</a>
                                <a href="{{ route('student.update', $student->id) }}" class="bg-yellow-500 text-white rounded px-2 text-sm">Update</a>
                                <button type="submit" class="bg-red-500 text-white rounded px-2 text-sm" >Delete</button>
                            </form>
                        </td>
                        
                    </tr>
                    @endforeach
                    {{ $students->links() }}
                </tbody>

            </table>
        </div>
    </div>


    <script src="{{ asset('js/sort_table.js') }}"></script>

</x-dash-layout>
