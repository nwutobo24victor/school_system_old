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
            <select type="text" class="max-w-md w-40 p-2 bg-white border-gray-100">
                <option selected disabled >Select Class</option>
                <option value="">JSS 1</option>
            </select>
        </div>

        <div id="messageContainer" style="display: none;" class="alert alert-success"></div>
        
        <div class="block w-full bg-gray-50 p-2 overflow-x-auto">
            <table class="table w-full" id="dataTable">
                <thead class="px-4 py-2 border bg-gray-300 text-left">
                    <tr>
                        <th>SN</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody class=" divide-y divide-gray-200 capitalize"></tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function fetchDataAndUpdateTable() {
                // Axios request
                axios.get("{{ route('parent.api') }}") // Replace with your server endpoint
                    .then(function(response) {
                        const data = response.data; // Extract the data from the response
                        const dataArray = Object.values(data); // Convert object to array if necessary
    
                        // Clear existing table rows
                        const tableBody = document.querySelector('#dataTable tbody');
                        tableBody.innerHTML = '';
    
                        // Check if dataArray is an array
                        var sn = 1;
                        if (Array.isArray(dataArray)) {
                            dataArray.forEach(function(row) {
                                const tableRow = `
                                    <tr>
                                        <td>${sn ++}</td>
                                        <td><img src="upload_photo/${row.passport_photo}" class="w-10 h-10 rounded border border-black"></td>
                                        <td>${row.surname} ${row.othernames}</td>
                                        <td>${row.class} ${row.section}</td>
                                        <td>${row.email}</td>
                                        <td>${row.created_at}</td>
                                        <td>
                                            <form action="{{ url('parent') }}/${row.id}" method="POST" id="parent_delete_form" class="block">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ url('parent/view') }}/${row.id}" class="bg-blue-500 text-white rounded px-2 text-sm">View</a>
                                                <a href="{{ url('parent/update') }}/${row.id}" class="bg-green-500 text-white rounded px-2 text-sm">Update</a>
                                                <button type="submit" class="bg-red-500 text-white rounded px-2 text-sm" >Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                `;
                                tableBody.innerHTML += tableRow;
                            });
                        } else {
                            console.error("Converted data is not an array:", dataArray);
                        }
                    })
                    .catch(function(error) {
                        console.error('Error fetching data:', error);
                    });
            }
    
            // Fetch data initially
            fetchDataAndUpdateTable();
    
            // Set interval to fetch data every 1 second
            setInterval(fetchDataAndUpdateTable, 1000); // 1000ms = 1 second
        });
    </script>


</x-dash-layout>
