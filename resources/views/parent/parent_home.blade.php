<x-dash-layout>
    <div name="header" class="bg-white p-3 flex justify-between mb-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fad fa-user-secret text-xl mr-1"></i>
            {{ __('Parent') }}
        </h2>
        <h2 class="font-semibold text-sm text-gray-500 leading-tight">
            {{ "Dashboard/Parent/" }}
        </h2>
    </div>

    <div class="w-full p-6 bg-white">
        <div class="flex w-full justify-between bg-gray-100 p-2 mb-3">
            <span>
                <a href="{{ route('parent.add') }}" class="text-md font-bold p-2 rounded bg-gray-300 hover:bg-gray-800 hover:text-white">Add Parent <i class="fad fa-user-plus text-xl ml-1"></i></a>
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
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody class=" divide-y divide-gray-200 capitalize">
                    @php
                        $id = 1;
                    @endphp
                    @foreach($parents as $parent)
                    <tr>
                        <td>{{ $id ++ }}</td>
                        <td> <img src="{{ asset('upload_photo/'.$parent->passport_photo) }}" class="w-10 h-10 rounded border border-black"></td>
                        <td>{{ $parent->account_name }}</td>
                        <td>{{ $parent->username }}</td>
                        <td>{{ $parent->email }} - {{ $parent->phone }}</td>
                        <td>{{ \Carbon\Carbon::parse($parent->created_at)->format('d M Y, H:i') }}</td>
                        <td>
                            <form x-init x-target="userTable" action="{{ route('parent.status.update.store', $parent->id) }}" method="POST" id="status_form" class="block">
                                @csrf
                                @method('put')
                                @if ( $parent->status == "active" )
                                    <button type="submit" class=" bg-emerald-200 text-emerald-700 rounded px-2 text-sm capitalize" >{{ $parent->status }}</button>
                                @else
                                    <button type="submit" class=" bg-yellow-200 text-yellow-700 rounded px-2 text-sm capitalize" >{{ $parent->status }}</button>
                                @endif
                            </form>
                        </td>
                        <td>
                            <form x-init x-target="userTable notification" x-on:ajax:before="confirm('Are you sure you want to delete ?') || $event.preventDefault()" action="{{ route('parent.destroy', $parent->id) }}" method="POST" id="parent_delete_form" class="block">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('parent.view', $parent->id) }}" class="bg-blue-500 text-white rounded px-2 text-sm">View</a>
                                <a href="{{ route('parent.update', $parent->id) }}" class="bg-yellow-500 text-white rounded px-2 text-sm">Update</a>
                                <button type="submit" class="bg-red-500 text-white rounded px-2 text-sm" >Delete</button>
                            </form>
                        </td>
                        
                    </tr>
                    @endforeach
                    {{ $parents->links() }}
                    </tbody>
            </table>
        </div>
    </div>


    <script src="{{ asset('js/sort_table.js') }}"></script>

    
</x-dash-layout>
