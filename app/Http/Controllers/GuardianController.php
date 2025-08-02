<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class GuardianController extends Controller
{
    //

    public function index()
    {
        //$parents = DB::table('guardians')->get()->sortByDesc('created_at');
        $parents = DB::table('guardians')
        ->orderBy('created_at', 'desc')
        ->paginate(20);
        return view('parent.parent_home',['parents' => $parents]);
    }

    public function create()
    {
        return view('parent.parent_add');
    }

    public function store(Request $request)
    {
       $status = "active";
        
        $validator = Validator::make($request->all(), [
            'account_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'father_profession' => 'required|string|max:255',
            'mother_profession' => 'required|string|max:255',
            'email' => 'required|string|max:255|lowercase|unique:guardians',
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
        $data = new Guardian();
        $data->status = $status;

        $data->account_name = $request->input('account_name');
        $data->father_name = $request->input('father_name');
        $data->mother_name = $request->input('mother_name');
        $data->father_profession = $request->input('father_profession');
        $data->mother_profession = $request->input('mother_profession');
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
                    //return redirect()->back()->with('success', 'parent account created successfully!');
                    return response()->json([
                        'message' => 'parent account created successfully!',
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
                    //return redirect()->back()->with('error', 'parent account failed to create!');
                    return response()->json([
                        'message' => 'parent account failed to create!',
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
        $parent = DB::table('guardians')->where('id', '=', $id)->first();
        return view('parent.parent_update', ['parent' => $parent]);
    }

    public function update_store(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'account_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'father_profession' => 'required|string|max:255',
            'mother_profession' => 'required|string|max:255',
            'email' => 'required|string|max:255|lowercase|unique:guardians,email,' . $id,
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
        $user = Guardian::findOrFail($id);

        // Update the user's details
        $user->update($request->all());
        return response()->json([
            'message' => 'Parent account updated successfully!',
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
        $user = Guardian::findOrFail($id);

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
        $user = Guardian::findOrFail($id);

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
        $parent = DB::table('guardians')->where('id', '=', $id)->first();
        //$guardian = $parent->account_name;
        $totalChildren = DB::table('students')->where('guardian', '=', $parent->account_name)->count();
        return view('parent.parent_view', ['parent' => $parent, 'children' => $totalChildren]);
    }


    public function destroy($id)
    {
        $user = Guardian::find($id);
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
        $user = Guardian::find($id);
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
