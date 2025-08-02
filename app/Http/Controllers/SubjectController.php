<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    //
    public function index()
    {
        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        $subjects = DB::table('subjects')->get()->sortByDesc('created_at');
        return view('subject.subject_home',['subjects' => $subjects, 'classes' => $classes]);
    }

    public function select_class(Request $request)
    {
        $request->validate([
            'select_class' => 'required|string|max:255',
        ]);
        $select_class = $request->input('select_class');

        if($select_class == "all")
        {
            $classes = DB::table('classes')->orderBy('class', 'asc')->get();
            $subjects = DB::table('subjects')->get()->sortByDesc('created_at');
            return view('subject.subject_home',['subjects' => $subjects, 'classes' => $classes]);
        }
        else
        {
            $classes = DB::table('classes')->orderBy('class', 'asc')->get();
            $subjects = DB::table('subjects')->where('class', '=', $select_class)->get()->sortByDesc('created_at');
            return view('subject.subject_home',['subjects' => $subjects, 'classes' => $classes]);
        }
    }

    public function create()
    {
        $teachers = DB::table('staffs')->where('role', '=', 'teacher')->orderBy('created_at', 'asc')->get();
        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        return view('subject.subject_add', ['classes' => $classes, 'teachers' => $teachers]);
    }

    public function update($id)
    {
        $subject = DB::table('subjects')->where('id', '=', $id)->first();
        $teachers = DB::table('staffs')->where('role', '=', 'teacher')->orderBy('created_at', 'asc')->get();
        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        return view('subject.subject_update', ['subject' => $subject, 'teachers' => $teachers, 'classes' => $classes]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'class' => 'required|string|max:255',
            'teacher' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'pass_mark' => 'required|string|max:255',
            'total_mark' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'subject_code' => 'required|string|max:255',
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
        $data = new Subject();
        $data->class = $request->input('class');
        $data->teacher = $request->input('teacher');
        $data->type = $request->input('type');
        $data->pass_mark = $request->input('pass_mark');
        $data->total_mark = $request->input('total_mark');
        $data->subject = $request->input('subject');
        $data->subject_code = $request->input('subject_code');
        if( $data->save() )
        {
            return response()->json([
                'message' => 'subject created successfully!',
                'error' => false
            ]);
        }
        else
        {
            return response()->json([
                'message' => 'subject failed to create!',
                'error' => true
            ]);
        }
        //////////////////////////////////////////////////

    }

    public function update_store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'class' => 'required|string|max:255',
            'teacher' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'pass_mark' => 'required|string|max:255',
            'total_mark' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'subject_code' => 'required|string|max:255',
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
        $user = Subject::findOrFail($id);

        // Update the user's details
        $user->update($request->all());
        return response()->json([
            'message' => 'subject updated successfully!',
            'error' => false
        ]);
        //////////////////////////////////////////////////
 

    }

    public function destroy($id)
    {
        $user = Subject::find($id);
        if ($user) 
        {
            $user->delete();
            return redirect()->back()->with('success', 'subject deleted Successfully!');
        } 
        else 
        {
            return redirect()->back()->with('error', 'subject not found!');
        }
    }
     
}
