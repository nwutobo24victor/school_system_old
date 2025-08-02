<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    //
    public function index()
    {
        $departments = DB::table('divisions')->where('title', '=', 'department')->orderBy('class', 'asc')->get();
        return view('department.department_home',['departments' => $departments]);
    }

    public function create()
    {
        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        return view('department.department_add', ['classes' => $classes]);
    }

    public function update($id)
    {
        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        $department = DB::table('divisions')->where('id', '=', $id)->first();
        return view('department.department_update', ['department' => $department, 'classes' => $classes]);
    }

    public function store(Request $request)
    {
        $title = "department";

        $validator = Validator::make($request->all(), [
            'class' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'note' => 'required|string|max:255',
        ]);

        // Check if validation fails
        if ($validator->fails()) 
        {
            $data = $validator->errors()->toArray();

            foreach ($data as $field => $messages) {
                foreach ($messages as $message) {
                    return response()->json([
                        'message' => $message,
                        'error' => true
                    ]);
                }
            }


        }

        ///////////////////////////////////// STORE DATA
        $data = new Division();
        $data->title = $title;
        $data->class = $request->input('class');
        $data->category = $request->input('category');
        $data->note = $request->input('note');
        if( $data->save() )
        {
            return response()->json([
                'message' => 'Department created successfully!',
                'error' => false
            ]);
        }
        else
        {
            return response()->json([
                'message' => 'Department failed to create!',
                'error' => true
            ]);
        }
        //////////////////////////////////////////////////

    }

    public function update_store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'class' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'note' => 'required|string|max:255',
        ]);

        // Check if validation fails
        if ($validator->fails()) 
        {
            $data = $validator->errors()->toArray();

            foreach ($data as $field => $messages) {
                foreach ($messages as $message) {
                    //echo "Field: {$field} - Error: {$message}<br>";

                    return response()->json([
                        'message' => $message,
                        'error' => true
                    ]);
                }
            }

        }

        ///////////////////////////////////// UPDATE DATA
        // Find the user by ID
        $user = Division::findOrFail($id);

        // Update the user's details
        $user->update($request->all());
        return response()->json([
            'message' => 'Department updated successfully!',
            'error' => false
        ]);
        //////////////////////////////////////////////////
 

    }

    public function destroy($id)
    {
        $user = Division::find($id);
        if ($user) 
        {
            $user->delete();
            return redirect()->back()->with('success', 'Department deleted Successfully!');
        } 
        else 
        {
            return redirect()->back()->with('error', 'Department not found!');
        }
    }
      
}
