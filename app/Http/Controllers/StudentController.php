<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function generateRegNumber($classes)
    {
        $geLtr = substr(trim($classes), 0, 1);

        $year = 2021;
        $prefix = "AGSO";

        if ($geLtr == "j" || $geLtr == "J") {
            $classCode = "JNR";
        } elseif ($geLtr == "s" || $geLtr == "S") {
            $classCode = "SNR";
        }

        //Get last registration number for the level
        $lastReg = DB::table('students')
            ->where('registration_no', 'like', "$prefix/$year/$classCode/%")
            ->orderBy('id', 'desc')
            ->value('registration_no');

        if ($lastReg) {
            $lastNumber = (int) substr(strrchr($lastReg, "/"), 1); // Extract after last "/"
            $newNumber = str_pad($lastNumber + 1, strlen($lastNumber), "0", STR_PAD_LEFT);
        } else {
            $newNumber = "01";
        }

        return response()->json("$prefix/$year/$classCode/$newNumber");
    }


    public function index()
    {
        //$students = DB::table('students')->get()->sortByDesc('created_at');
        $students = DB::table('students')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        $suspensions = DB::table('suspensions')->get();
        return view('student.student_home', ['students' => $students, 'classes' => $classes, 'suspensions' => $suspensions]);
    }

    public function select_class(Request $request)
    {
        $request->validate([
            'select_class' => 'required|string|max:255',
        ]);
        $select_class = $request->input('select_class');

        if ($select_class == "all") {
            $classes = DB::table('classes')->orderBy('class', 'asc')->get();
            $students = DB::table('students')
                ->orderBy('created_at', 'desc')
                ->paginate(20);
            return view('student.student_home', ['students' => $students, 'classes' => $classes]);
        } else {
            $classes = DB::table('classes')->orderBy('class', 'asc')->get();
            $students = DB::table('students')->where('class', '=', $select_class)->orderBy('created_at', 'desc')->paginate(20);
            return view('student.student_home', ['students' => $students, 'classes' => $classes]);
        }
    }

    public function create()
    {
        $totalStudents = DB::table('students')->count();
        $parents = DB::table('guardians')->get();
        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        $sections = DB::table('divisions')->where('title', '=', 'section')->orderBy('class', 'asc')->get();
        $departments = DB::table('divisions')->where('title', '=', 'department')->orderBy('class', 'asc')->get();
        return view('student.student_add', ['classes' => $classes, 'sections' => $sections, 'departments' => $departments, 'parents' => $parents, 'totalStudents' => $totalStudents]);
    }

    public function store(Request $request)
    {
        $status = "active";

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:255|lowercase|unique:students',
            'password' => 'required|min:8|max:12',
            'surname' => 'required|string|max:255',
            'othernames' => 'required|string|max:255',
            'guardian' => 'required|string|max:255',
            'admission_date' => 'required|string|max:255',
            'date_birth' => 'required|string|max:255',
            'gender_sex' => 'required|string|max:255',
            'blood_group' => 'required|string|max:255',
            'religion' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'current_address' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'state_origin' => 'required|string|max:255',
            'local_govt_area' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'section' => 'string|max:255',
            'department' => 'string|max:255',
            'registration_no' => 'required|string|max:255',
            'passport_photo' => 'required|image|mimes:png,jpg,jpeg|max:1024', // Maximum size 1MB
            'remark' => 'required|string|max:255',
            'username' => 'required|string|max:255',
        ]);

        if($request->input('section') == "" && $request->input('department') == "")
        {
            return response()->json([
                'message' => "Section or Department cant be both empty",
                'error' => true
            ]);
        }

        // Check if validation fails
        if ($validator->fails()) {
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
        $data = new Student();
        $data->status = $status;

        $data->email = $request->input('email');
        $data->password = Hash::make($request->password);

        $data->surname = $request->input('surname');
        $data->othernames = $request->input('othernames');
        $data->guardian = $request->input('guardian');
        $data->date_birth = $request->input('date_birth');
        $data->gender = $request->input('gender_sex');
        $data->blood_group = $request->input('blood_group');
        $data->religion = $request->input('religion');
        $data->phone = $request->input('phone');
        $data->current_address = $request->input('current_address');
        $data->nationality = $request->input('nationality');
        $data->state_origin = $request->input('state_origin');
        $data->local_govt_area = $request->input('local_govt_area');
        $data->permanent_address = $request->input('permanent_address');
        $data->class = $request->input('class');
        $data->section = $request->input('section');
        $data->department = $request->input('department');
        $data->registration_no = $request->input('registration_no');
        $data->admission_date = $request->input('admission_date');
        $data->passport_photo = $request->input('passport_photo');
        $data->remark = $request->input('remark');
        $data->username = $request->input('username');

        ////////////////////////////// UPLOAD PHOTO
        if ($request->hasFile('passport_photo')) {
            $file = $request->file('passport_photo');
            $filename = time() . '.' . $file->getClientOriginalExtension(); // Generate unique filename

            $data->passport_photo = $filename;

            // Define the destination path
            $destinationPath = public_path('upload_photo'); // Path: public/upload_photo

            // Ensure the directory exists
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true); // Create directory with permissions
            }

            if ($file->move($destinationPath, $filename)) {
                if ($data->save()) {
                    // Additional logic or redirection after successful data storage
                    //return redirect()->back()->with('success', 'Student account created successfully!');
                    return response()->json([
                        'message' => 'Student account created successfully!',
                        'error' => false
                    ]);
                } else {
                    $filePath = $destinationPath . "/" . $filename;
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                    //return redirect()->back()->with('error', 'Student account failed to create!');
                    return response()->json([
                        'message' => 'Student account failed to create!',
                        'error' => true
                    ]);
                }
            } else {
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
        $student = DB::table('students')->where('id', '=', $id)->first();
        return view('student.student_update', ['student' => $student]);
    }

    public function update_store(Request $request, $id)
    {
        $role = "student";

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:255|lowercase|unique:students,email,' . $id,
            'surname' => 'required|string|max:255',
            'othernames' => 'required|string|max:255',
            'guardian' => 'required|string|max:255',
            'admission_date' => 'required|string|max:255',
            'date_birth' => 'required|string|max:255',
            'gender_sex' => 'required|string|max:255',
            'blood_group' => 'required|string|max:255',
            'religion' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'current_address' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'state_origin' => 'required|string|max:255',
            'local_govt_area' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'registration_no' => 'required|string|max:255',
            'remark' => 'required|string|max:255',
            'username' => 'required|string|max:255',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
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
        $user = Student::findOrFail($id);

        // Update the user's details
        $user->update($request->all());
        return response()->json([
            'message' => 'Student account updated successfully!',
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
        if ($validator->fails()) {
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
        $user = Student::findOrFail($id);

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
            if ($oldPhoto && file_exists(public_path('upload_photo/' . $oldPhoto))) {
                unlink(public_path('upload_photo/' . $oldPhoto)); // Delete the old file
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
        if ($validator->fails()) {
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
        $user = Student::findOrFail($id);

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
        $student = DB::table('students')->where('id', '=', $id)->first();
        return view('student.student_view', ['student' => $student]);
    }

    public function destroy($id)
    {
        $user = Student::find($id);
        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'Account deleted Successfully!');
        } else {
            return redirect()->back()->with('error', 'Account not found!');
        }
    }


    public function update_status($id)
    {
        $user = Student::find($id);
        if ($user->status == "active") {
            $status = "inactive";
        }
        if ($user->status == "inactive") {
            $status = "active";
        }

        $user->update([
            'status' => $status,
        ]);

        return redirect()->back()->with('success', 'Account status updated Successfully!');
    }


}
