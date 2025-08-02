<?php

namespace App\Http\Controllers;

use App\Models\Syllabus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SyllabusController extends Controller
{
    //
    public function index()
    {
        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        $syllabuses = DB::table('syllabuses')->get()->sortByDesc('created_at');
        return view('syllabus.syllabus_home',['syllabuses' => $syllabuses, 'classes' => $classes]);
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
            $syllabuses = DB::table('syllabuses')->get()->sortByDesc('created_at');
            return view('syllabus.syllabus_home',['syllabuses' => $syllabuses, 'classes' => $classes]);
        }
        else
        {
            $classes = DB::table('classes')->orderBy('class', 'asc')->get();
            $syllabuses = DB::table('syllabuses')->where('class', '=', $select_class)->get()->sortByDesc('created_at');
            return view('syllabus.syllabus_home',['syllabuses' => $syllabuses, 'classes' => $classes]);
        }
    }

    public function create()
    {
        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        return view('syllabus.syllabus_add', ['classes' => $classes]);
    }

    public function update($id)
    {
        $syllabus = DB::table('syllabuses')->where('id', '=', $id)->first();
        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        return view('syllabus.syllabus_update', ['syllabus' => $syllabus, 'classes' => $classes]);
    }

    public function store(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'class' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'syllabus_file' => 'required|mimes:pdf|max:1024', // Maximum size 1MB
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
        $data = new Syllabus();
        $data->class = $request->input('class');
        $data->title = $request->input('title');
        $data->description = $request->input('description');
        $data->syllabus_file = $request->input('syllabus_file');
        $data->uploader = Auth::user()->account_name;

        ////////////////////////////// UPLOAD FILE
        if ($request->hasFile('syllabus_file')) 
        {
            $file = $request->file('syllabus_file');
            $filename = 'syllabus'. time() . '.' . $file->getClientOriginalExtension(); // Generate unique filename

            $data->syllabus_file = $filename;

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
                        'message' => 'Syllabus created successfully!',
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
                        'message' => 'Syllabus failed to create!',
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
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
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
        // Find the syllabus by ID
        $syllabus = Syllabus::findOrFail($id);

        // Update the syllabus's details
        $syllabus->update($request->all());
        return response()->json([
            'message' => 'syllabus updated successfully!',
            'error' => false
        ]);
        //////////////////////////////////////////////////
 

    }

    public function update_file(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'syllabus_file' => 'required|mimes:pdf|max:1024', // Maximum size 1MB
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
        // Find the syllabus by ID
        $syllabus = Syllabus::findOrFail($id);

        // Get the old file path if it exists
        $oldFile = $syllabus->syllabus_file;

        // Handle the uploaded file
        if ($request->hasFile('syllabus_file')) {
            // Define the destination path
            $destinationPath = public_path('upload_file');

            // Ensure the directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true); // Create the directory if it doesn't exist
            }

            // Generate a unique file name
            $fileName = 'syllabus'. time() . '.' . $request->file('syllabus_file')->getClientOriginalExtension();


            // Move the file to the destination path
            $request->file('syllabus_file')->move($destinationPath, $fileName);

            // Update the database record
            $syllabus->update([
                'syllabus_file' => $fileName, // Save relative path
            ]);

            // Delete the old file if it exists
            if ($oldFile && file_exists(public_path( 'upload_file/' . $oldFile))) {
                unlink(public_path( 'upload_file/' . $oldFile)); // Delete the old file
            }
        }

        return response()->json([
            'message' => 'Syllabus file updated successfully.',
            'error' => false,
        ]);
        //////////////////////////////////////////////////
    }

    public function destroy($id)
    {
        $syllabus = Syllabus::find($id);
        if ($syllabus) 
        {
            $syllabus->delete();
            return redirect()->back()->with('success', 'syllabus deleted Successfully!');
        } 
        else 
        {
            return redirect()->back()->with('error', 'syllabus not found!');
        }
    }
     
}
