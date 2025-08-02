<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    //
    
    public function index()
    {
        //$teachers = DB::table('staffs')->where('role', '=', 'teacher')->get()->sortByDesc('created_at');
        $teachers = DB::table('staffs')
        ->where('role', '=', 'teacher')
        ->orderBy('created_at', 'desc')
        ->paginate(20);
        return view('teacher.teacher_home',['teachers' => $teachers]);
    }

    public function create()
    {
        return view('teacher.teacher_add');
    }

    public function store(Request $request)
    {
        $role = "teacher";
        $status = "active";
        
        $validator = Validator::make($request->all(), [
            'account_name' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'employment_date' => 'required|string|max:255',
            'date_birth' => 'required|string|max:255',
            'gender_sex' => 'required|string|max:255',
            'religion' => 'required|string|max:255',
            'email' => 'required|string|max:255|lowercase|unique:staffs',
            'phone' => 'required|string|max:255',
            'current_address' => 'required|string|max:255',
            'passport_photo' => 'required|image|mimes:png,jpg,jpeg|max:1024', // Maximum size 1MB
            'username' => 'required|string|max:255',
            'password' => 'required|min:8|max:12',
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
        $data = new Staff();
        $data->role = $role;
        $data->status = $status;

        $data->account_name = $request->input('account_name');
        $data->qualification = $request->input('qualification');
        $data->employment_date = $request->input('employment_date');
        $data->date_birth = $request->input('date_birth');
        $data->gender = $request->input('gender_sex');
        $data->religion = $request->input('religion');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->current_address = $request->input('current_address');
        $data->passport_photo = $request->input('passport_photo');
        $data->username = $request->input('username');
        $data->password = Hash::make($request->password);

        ////////////////////////////// UPLOAD PHOTO
        if ($request->hasFile('passport_photo')) 
        {
            $file = $request->file('passport_photo');
            $filename = time() . '.' . $file->getClientOriginalExtension(); // Generate unique filename

            $data->passport_photo = $filename;

            // Define the destination path
            $destinationPath = public_path('upload_photo'); // Path: public/upload_photo

            // Ensure the directory exists
            if (!File::exists($destinationPath)) 
            {
                File::makeDirectory($destinationPath, 0755, true); // Create directory with permissions
            }

            if ($file->move($destinationPath, $filename)) 
            {
                if( $data->save() )
                {
                    // Additional logic or redirection after successful data storage
                    //return redirect()->back()->with('success', 'teacher account created successfully!');
                    return response()->json([
                        'message' => 'teacher account created successfully!',
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
                    //return redirect()->back()->with('error', 'teacher account failed to create!');
                    return response()->json([
                        'message' => 'teacher account failed to create!',
                        'error' => true
                    ]);
                }
            }
            else
            {
                //return redirect()->back()->with('error', 'Passport upload failed!');
                return response()->json([
                    'message' => 'Passport upload failed!',
                    'error' => true
                ]);
            }
        }
        //////////////////////////////////////////////////

    }

    public function update($id)
    {
        $teacher = DB::table('staffs')->where('id', '=', $id)->first();
        return view('teacher.teacher_update', ['teacher' => $teacher]);
    }

    public function update_store(Request $request, $id)
    {
        $role = "teacher";
        
        $validator = Validator::make($request->all(), [
            'account_name' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'employment_date' => 'required|string|max:255',
            'date_birth' => 'required|string|max:255',
            'gender_sex' => 'required|string|max:255',
            'religion' => 'required|string|max:255',
            'email' => 'required|string|max:255|lowercase|unique:staffs,email,' . $id,
            'phone' => 'required|string|max:255',
            'current_address' => 'required|string|max:255',
            'username' => 'required|string|max:255',
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
        $user = Staff::findOrFail($id);

        // Update the user's details
        $user->update($request->all());
        return response()->json([
            'message' => 'teacher account updated successfully!',
            'error' => false
        ]);
        //////////////////////////////////////////////////
 

    }

    public function update_passport(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'passport_photo' => 'required|image|mimes:png,jpg,jpeg|max:1024', // Maximum size 1MB
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
        $user = Staff::findOrFail($id);

        // Get the old file path if it exists
        $oldPhoto = $user->passport_photo;

        // Handle the uploaded file
        if ($request->hasFile('passport_photo')) {
            // Define the destination path
            $destinationPath = public_path('upload_photo');

            // Ensure the directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true); // Create the directory if it doesn't exist
            }

            // Generate a unique file name
            $fileName = time() . '.' . $request->file('passport_photo')->getClientOriginalExtension();


            // Move the file to the destination path
            $request->file('passport_photo')->move($destinationPath, $fileName);

            // Update the database record
            $user->update([
                'passport_photo' => $fileName, // Save relative path
            ]);

            // Delete the old file if it exists
            if ($oldPhoto && file_exists(public_path( 'upload_photo/' . $oldPhoto))) {
                unlink(public_path( 'upload_photo/' . $oldPhoto)); // Delete the old file
            }
        }

        return response()->json([
            'message' => 'Passport photo updated successfully.',
            'error' => false,
        ]);
        //////////////////////////////////////////////////
    }

    public function update_password(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|max:12', // Minimum 8 and maximum 12 characters
            'retype_password' => 'required|same:password', // Must match the 'password' field
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
        $user = Staff::findOrFail($id);

        // Hash the password and update it in the database
        $user->update([
            'password' => Hash::make($request->password), // Hash the password before saving
        ]);

        return response()->json([
            'message' => 'Password updated successfully.',
            'error' => false,
        ]);
        //////////////////////////////////////////////////

    }

    public function view($id)
    {
        $teacher = DB::table('staffs')->where('id', '=', $id)->first();
        return view('teacher.teacher_view', ['teacher' => $teacher]);
    }


    public function destroy($id)
    {
        $user = Staff::find($id);
        if ($user) 
        {
            $user->delete();
            return redirect()->back()->with('success', 'Account deleted Successfully!');
        } 
        else 
        {
            return redirect()->back()->with('error', 'Account not found!');
        }
    }


    public function update_status($id)
    {
        $user = Staff::find($id);
        if ($user->status == "active") 
        {
            $status = "inactive";
        }
        if ($user->status == "inactive") 
        {
            $status = "active";
        }

        $user->update([
            'status' => $status,
        ]);

        return redirect()->back()->with('success', 'Account status updated Successfully!');
    }

    
}
