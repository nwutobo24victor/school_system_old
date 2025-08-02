<x-dash-layout>
    <div name="header" class="bg-white p-3 flex justify-between mb-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fad fa-sitemap text-xl mr-1"></i>
            {{ __('Class') }}
        </h2>
        <h2 class="font-semibold text-sm text-gray-500 leading-tight">
            {{ "Dashboard/Class/" }}
        </h2>
    </div>

    <div class="w-full p-6 bg-white">
        <div class="flex w-full justify-between bg-gray-100 p-2 mb-3">
            <span>
                <a href="{{ route('class.add') }}" class="text-md font-bold p-2 rounded bg-gray-300 hover:bg-gray-800 hover:text-white">Add class <i class="fad fa-plus text-xl ml-1"></i></a>
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
                        <th>Class</th>
                        <th>Class No</th>
                        <th>Teacher</th>
                        <th>Note</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody class=" divide-y divide-gray-200 capitalize">
                    @php
                        $id = 1;
                    @endphp
                    @foreach($classes as $class)
                    <tr>
                        <td class="py-2">{{ $id ++ }}</td>
                        <td>{{ $class->class }}</td>
                        <td>{{ $class->class_number }}</td>
                        <td>{{ $class->teacher }}</td>
                        <td>{{ $class->note }}</td>
                        <td>{{ \Carbon\Carbon::parse($class->created_at)->format('d M Y, H:i') }}</td>
                        <td>
                            <form x-init x-target="userTable notification" x-on:ajax:before="confirm('Are you sure you want to delete ?') || $event.preventDefault()" action="{{ route('class.destroy', $class->id) }}" method="POST" id="class_delete_form" class="block">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('class.update', $class->id) }}" class="bg-yellow-500 text-white rounded px-2 text-sm">Update</a>
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
