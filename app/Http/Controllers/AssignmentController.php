<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AssignmentController extends Controller
{
    //
    public function index()
    {
        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        $assignments = DB::table('assignments')->get()->sortByDesc('created_at');
        return view('assignment.assignment_home',['assignments' => $assignments, 'classes' => $classes]);
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
            $assignments = DB::table('assignments')->get()->sortByDesc('created_at');
            return view('assignment.assignment_home',['assignments' => $assignments, 'classes' => $classes]);
        }
        else
        {
            $classes = DB::table('classes')->orderBy('class', 'asc')->get();
            $assignments = DB::table('assignments')->where('class', '=', $select_class)->get()->sortByDesc('created_at');
            return view('assignment.assignment_home',['assignments' => $assignments, 'classes' => $classes]);
        }
    }

    public function create()
    {
        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        $sections = DB::table('divisions')->where('title', '=', 'section')->orderBy('class', 'asc')->get();
        $departments = DB::table('divisions')->where('title', '=', 'department')->orderBy('class', 'asc')->get();
        $subjects = DB::table('subjects')->orderBy('class', 'asc')->get();
        return view('assignment.assignment_add', ['classes' => $classes, 'sections' => $sections, 'departments' => $departments, 'subjects' => $subjects]);
    }

    public function update($id)
    {
        $assignment = DB::table('assignments')->where('id', '=', $id)->first();
        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        $sections = DB::table('divisions')->where('title', '=', 'section')->orderBy('class', 'asc')->get();
        $departments = DB::table('divisions')->where('title', '=', 'department')->orderBy('class', 'asc')->get();
        $subjects = DB::table('subjects')->orderBy('class', 'asc')->get();
        return view('assignment.assignment_update', ['assignment' => $assignment, 'classes' => $classes, 'sections' => $sections, 'departments' => $departments, 'subjects' => $subjects]);
    }

    public function store(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'class' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'deadline' => 'required|string|max:255',
            'assignment_file' => 'required|mimes:pdf|max:1024', // Maximum size 1MB
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

        ///////////////////////////////////// STORE DATA
        $data = new Assignment();
        $data->class = $request->input('class');
        $data->section = $request->input('section');
        $data->subject = $request->input('subject');
        $data->title = $request->input('title');
        $data->description = $request->input('description');
        $data->deadline = $request->input('deadline');
        $data->assignment_file = $request->input('assignment_file');
        $data->uploader = Auth::user()->account_name;

        ////////////////////////////// UPLOAD FILE
        if ($request->hasFile('assignment_file')) 
        {
            $file = $request->file('assignment_file');
            $filename = 'assignment'. time() . '.' . $file->getClientOriginalExtension(); // Generate unique filename

            $data->assignment_file = $filename;

            // Define the destination path
            $destinationPath = public_path('upload_file'); // Path: public/upload_file

            // Ensure the directory exists
            if (!File::exists($destinationPath)) 
            {
                File::makeDirectory($destinationPath, 0755, true); // Create directory with permissions
            }

            if ($file->move($destinationPath, $filename)) 
            {
                if( $data->save() )
                {
                    return response()->json([
                        'message' => 'assignment created successfully!',
                        'error' => false
                    ]);
                }
                else
                {
                    $filePath = $destinationPath."/".$filename;
                    if (file_exists($filePath)) 
                    {
                        unlink($filePath);
                    }
                    return response()->json([
                        'message' => 'assignment failed to create!',
                        'error' => true
                    ]);
                }
            }
            else
            {
                return response()->json([
                    'message' => 'File upload failed!',
                    'error' => true
                ]);
            }
        }
        //////////////////////////////////////////////////

    }

    public function update_store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'class' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'deadline' => 'required|string|max:255',
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
        // Find the assignment by ID
        $assignment = Assignment::findOrFail($id);

        // Update the assignment's details
        $assignment->update($request->all());
        return response()->json([
            'message' => 'assignment updated successfully!',
            'error' => false
        ]);
        //////////////////////////////////////////////////
 

    }

    public function update_file(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'assignment_file' => 'required|mimes:pdf|max:1024', // Maximum size 1MB
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
        // Find the assignment by ID
        $assignment = Assignment::findOrFail($id);

        // Get the old file path if it exists
        $oldFile = $assignment->assignment_file;

        // Handle the uploaded file
        if ($request->hasFile('assignment_file')) {
            // Define the destination path
            $destinationPath = public_path('upload_file');

            // Ensure the directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true); // Create the directory if it doesn't exist
            }

            // Generate a unique file name
            $fileName = 'assignment'. time() . '.' . $request->file('assignment_file')->getClientOriginalExtension();


            // Move the file to the destination path
            $request->file('assignment_file')->move($destinationPath, $fileName);

            // Update the database record
            $assignment->update([
                'assignment_file' => $fileName, // Save relative path
            ]);

            // Delete the old file if it exists
            if ($oldFile && file_exists(public_path( 'upload_file/' . $oldFile))) {
                unlink(public_path( 'upload_file/' . $oldFile)); // Delete the old file
            }
        }

        return response()->json([
            'message' => 'assignment file updated successfully.',
            'error' => false,
        ]);
        //////////////////////////////////////////////////
    }

    public function destroy($id)
    {
        $assignment = Assignment::find($id);
        if ($assignment) 
        {
            $assignment->delete();
            return redirect()->back()->with('success', 'assignment deleted Successfully!');
        } 
        else 
        {
            return redirect()->back()->with('error', 'assignment not found!');
        }
    }
}
