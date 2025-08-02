<x-dash-layout>
    <div name="header" class="bg-white p-3 flex justify-between mb-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fad fa-sitemap text-xl mr-1"></i>
            {{ __('Subject') }}
        </h2>
        <h2 class="font-semibold text-sm text-gray-500 leading-tight">
            {{ "Dashboard/Subject/" }}
        </h2>
    </div>

    <div class="w-full p-6 bg-white">
        <div class="w-full flex mb-3 justify-end">
            <form x-init x-target="userTable" action="{{ route('subject.select_class') }}" method="post" id="select_class">
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
                <a href="{{ route('subject.add') }}" class="text-md font-bold p-2 rounded bg-gray-300 hover:bg-gray-800 hover:text-white">Add Subject <i class="fad fa-plus text-xl ml-1"></i></a>
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
                        <th>Subject</th>
                        <th>Subject Code</th>
                        <th>Teacher</th>
                        <th>Pass Mark</th>
                        <th>Total Mark</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody class=" divide-y divide-gray-200 capitalize">
                    @php
                        $id = 1;
                    @endphp
                    @foreach($subjects as $data)
                    <tr>
                        <td class="py-2">{{ $id ++ }}</td>
                        <td>{{ $data->subject }} <br> {{ $data->class }}</td>
                        <td>{{ $data->subject_code }}</td>
                        <td>{{ $data->teacher }}</td>
                        <td>{{ $data->pass_mark }}</td>
                        <td>{{ $data->total_mark }}</td>
                        <th>
                            @if ($data->type == "Mandatory")
                                <span class="text-sm bg-green-400 text-white px-2 rounded">{{ $data->type }}</span>
                            @else
                            <span class="text-sm bg-blue-400 text-white px-2 rounded">{{ $data->type }}</span>
                            @endif
                        </th>
                        <td>
                            <form x-init x-target="userTable notification" x-on:ajax:before="confirm('Are you sure you want to delete ?') || $event.preventDefault()" action="{{ route('subject.destroy', $data->id) }}" method="POST" id="class_delete_form" class="block">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('subject.update', $data->id) }}" class="bg-yellow-500 text-white rounded px-2 text-sm">Update</a>
                                <button type="submit" class="bg-red-500 text-white rounded px-2 text-sm" >Delete</button>
                            </form>
                        </td>
                        
                    </tr>
                    @endforeach
                    </tbody>
            </table>
        </div>
    </div>


    <script src="{{ asset('js/sort_table.js') }}"></script>
    

</x-dash-layout>
