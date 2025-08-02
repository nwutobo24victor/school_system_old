<?php

namespace App\Http\Controllers;

use App\Models\Suspension;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SuspensionController extends Controller
{
    //
    public function index()
    {
        $suspensions = DB::table('suspensions')
        ->orderBy('created_at', 'desc')
        ->paginate(20);
        return view('suspension.suspension_home', ['suspensions' => $suspensions]);
    }

    public function create()
    {
        $students = DB::table('students')->orderBy('surname', 'asc')->get();
        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        return view('suspension.suspension_add', ['classes' => $classes, 'students'=>$students]);
    }

    public function update($id)
    {
        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        $suspension = DB::table('suspensions')->where('id', $id)->first();
        return view('suspension.suspension_update', ['classes' => $classes, 'suspension' => $suspension]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'registration_no' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'note' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'end_date' => 'required|string|max:255',
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

        $student = DB::table('students')->where('registration_no', $request->input('registration_no'))->first();
        $id = $student->id;
        
        if($id != $request->input('name'))
        {
            return response()->json([
                'message' => "Student name doesnt match with registration number",
                'error' => true
            ]);
        }


        ///////////////////////////////////// STORE DATA
        $data = new Suspension();
        $data->name = $request->input('name');
        $data->registration_no = $request->input('registration_no');
        $data->class = $request->input('class');
        $data->status = $request->input('status');
        $data->note = $request->input('note');
        $data->start_date = $request->input('start_date');
        $data->end_date = $request->input('end_date');
        if( $data->save() )
        {
            return response()->json([
                'message' => $request->registration_no . ' was suspended successfully!',
                'error' => false
            ]);
        }
        else
        {
            return response()->json([
                'message' => 'Suspension failed to create!',
                'error' => true
            ]);
        }
        //////////////////////////////////////////////////

    }

    public function update_store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'registration_no' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'note' => 'required|string',
            'start_date' => 'required|string|max:255',
            'end_date' => 'required|string|max:255',
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
        $user = Suspension::findOrFail($id);

        // Update the user's details
        $user->update($request->all());
        return response()->json([
            'message' => 'Suspension updated successfully!',
            'error' => false
        ]);
        //////////////////////////////////////////////////
 

    }


    public function view($id)
    {
        $suspension = DB::table('suspensions')->where('id', $id)->first();
        return view('suspension.suspension_home', ['suspension' => $suspension]);
    }



    public function destroy($id)
    {
        $user = Suspension::find($id);
        if ($user) 
        {
            $user->delete();
            return redirect()->back()->with('success', 'Susupension deleted Successfully!');
        } 
        else 
        {
            return redirect()->back()->with('error', 'not found!');
        }
    }
}
