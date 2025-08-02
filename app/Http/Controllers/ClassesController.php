<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClassesController extends Controller
{
    //
    public function index()
    {
        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        return view('class.class_home',['classes' => $classes]);
    }

    public function create()
    {
        $teachers = DB::table('staffs')->where('role', '=', 'teacher')->get()->sortByDesc('created_at');
        return view('class.class_add', ['teachers' => $teachers]);
    }

    public function update($id)
    {
        $teachers = DB::table('staffs')->where('role', '=', 'teacher')->get()->sortByDesc('created_at');
        $class = DB::table('classes')->where('id', '=', $id)->first();
        return view('class.class_update', ['class' => $class, 'teachers' => $teachers]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'class' => 'required|string|max:255',
            'class_number' => 'required|string|max:255|unique:classes',
            'teacher' => 'required|string|max:255',
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
        $data = new Classes();
        $data->class = $request->input('class');
        $data->class_number = $request->input('class_number');
        $data->teacher = $request->input('teacher');
        $data->note = $request->input('note');
        if( $data->save() )
        {
            return response()->json([
                'message' => 'Class created successfully!',
                'error' => false
            ]);
        }
        else
        {
            return response()->json([
                'message' => 'Class failed to create!',
                'error' => true
            ]);
        }
        //////////////////////////////////////////////////

    }

    public function update_store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'class' => 'required|string|max:255',
            'class_number' => 'required|string|max:255|unique:classes,class_number,' . $id,
            'teacher' => 'required|string|max:255',
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
        $user = Classes::findOrFail($id);

        // Update the user's details
        $user->update($request->all());
        return response()->json([
            'message' => 'Class updated successfully!',
            'error' => false
        ]);
        //////////////////////////////////////////////////
 

    }

    public function destroy($id)
    {
        $user = Classes::find($id);
        if ($user) 
        {
            $user->delete();
            return redirect()->back()->with('success', 'Class deleted Successfully!');
        } 
        else 
        {
            return redirect()->back()->with('error', 'Class not found!');
        }
    }
    
}
