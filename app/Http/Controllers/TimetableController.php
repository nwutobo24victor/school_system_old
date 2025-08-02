<?php

namespace App\Http\Controllers;

use App\Models\timetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TimetableController extends Controller
{
    //
    public function index()
    {
        $select_class = "JSS 1";
        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        $sunday = DB::table('timetables')->where('day', '=', 'Sunday')->where('class', '=', $select_class)->get()->sortByDesc('created_at');
        $monday = DB::table('timetables')->where('day', '=', 'Monday')->where('class', '=', $select_class)->get()->sortByDesc('created_at');
        $tuesday = DB::table('timetables')->where('day', '=', 'Tuesday')->where('class', '=', $select_class)->get()->sortByDesc('created_at');
        $wednesday = DB::table('timetables')->where('day', '=', 'Wednesday')->where('class', '=', $select_class)->get()->sortByDesc('created_at');
        $thursday = DB::table('timetables')->where('day', '=', 'Thursday')->where('class', '=', $select_class)->get()->sortByDesc('created_at');
        $friday = DB::table('timetables')->where('day', '=', 'Friday')->where('class', '=', $select_class)->get()->sortByDesc('created_at');
        $saturday = DB::table('timetables')->where('day', '=', 'Saturday')->where('class', '=', $select_class)->get()->sortByDesc('created_at');
        return view('timetable.timetable_home',
        [
            'classes' => $classes,
            'sunday' => $sunday,
            'monday' => $monday,
            'tuesday' => $tuesday,
            'wednesday' => $wednesday,
            'thursday' => $thursday,
            'friday' => $friday,
            'saturday' => $saturday,
            ]
        );
    }

    public function select_class(Request $request)
    {
        $request->validate([
            'select_class' => 'required|string|max:255',
        ]);
        $select_class = $request->input('select_class');

        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        $sunday = DB::table('timetables')->where('day', '=', 'Sunday')->where('class', '=', $select_class)->orderBy('starting_time','asc')->get();
        $monday = DB::table('timetables')->where('day', '=', 'Monday')->where('class', '=', $select_class)->orderBy('starting_time','asc')->get();
        $tuesday = DB::table('timetables')->where('day', '=', 'Tuesday')->where('class', '=', $select_class)->orderBy('starting_time','asc')->get();
        $wednesday = DB::table('timetables')->where('day', '=', 'Wednesday')->where('class', '=', $select_class)->orderBy('starting_time','asc')->get();
        $thursday = DB::table('timetables')->where('day', '=', 'Thursday')->where('class', '=', $select_class)->orderBy('starting_time','asc')->get();
        $friday = DB::table('timetables')->where('day', '=', 'Friday')->where('class', '=', $select_class)->orderBy('starting_time','asc')->get();
        $saturday = DB::table('timetables')->where('day', '=', 'Saturday')->where('class', '=', $select_class)->orderBy('starting_time','asc')->get();
        return view('timetable.timetable_home',
        [
            'classes' => $classes,
            'sunday' => $sunday,
            'monday' => $monday,
            'tuesday' => $tuesday,
            'wednesday' => $wednesday,
            'thursday' => $thursday,
            'friday' => $friday,
            'saturday' => $saturday,
            ]
        );
    }

    public function create()
    {
        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        $teachers = DB::table('staffs')->where('role', '=', 'teacher')->orderBy('created_at', 'asc')->get();
        $subjects = DB::table('subjects')->orderBy('class', 'asc')->get();
        $divisions = DB::table('divisions')->where('title', '=', 'section')->orderBy('class', 'asc')->get();
        return view('timetable.timetable_add', ['classes' => $classes, 'divisions' => $divisions, 'subjects' => $subjects, 'teachers' => $teachers]);
    }

    public function update($id)
    {
        $timetable = DB::table('timetables')->where('id', '=', $id)->first();
        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        $teachers = DB::table('staffs')->where('role', '=', 'teacher')->orderBy('created_at', 'asc')->get();
        $subjects = DB::table('subjects')->orderBy('class', 'asc')->get();
        $divisions = DB::table('divisions')->where('title', '=', 'section')->orderBy('class', 'asc')->get();
        return view('timetable.timetable_update', ['timetable' => $timetable, 'classes' => $classes, 'divisions' => $divisions, 'subjects' => $subjects, 'teachers' => $teachers]);
    }

    public function store(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'school_year' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'teacher' => 'required|string|max:255',
            'day' => 'required|string|max:255',
            'starting_time' => 'required|string|max:255',
            'ending_time' => 'required|string|max:255',
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
        $data = new Timetable();
        $data->school_year = $request->input('school_year');
        $data->class = $request->input('class');
        $data->section = $request->input('section');
        $data->subject = $request->input('subject');
        $data->teacher = $request->input('teacher');
        $data->day = $request->input('day');
        $data->starting_time = $request->input('starting_time');
        $data->ending_time = $request->input('ending_time');

        if( $data->save() )
        {
            return response()->json([
                'message' => 'timetable created successfully!',
                'error' => false
            ]);
        }
        else
        {
            return response()->json([
                'message' => 'timetable failed to create!',
                'error' => true
            ]);
        }
        //////////////////////////////////////////////////

    }

    public function update_store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'school_year' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'teacher' => 'required|string|max:255',
            'day' => 'required|string|max:255',
            'starting_time' => 'required|string|max:255',
            'ending_time' => 'required|string|max:255',
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
        // Find the timetable by ID
        $timetable = Timetable::findOrFail($id);

        // Update the timetable's details
        $timetable->update($request->all());
        return response()->json([
            'message' => 'timetable updated successfully!',
            'error' => false
        ]);
        //////////////////////////////////////////////////
 

    }

    public function destroy($id)
    {
        $timetable = Timetable::find($id);
        if ($timetable) 
        {
            $timetable->delete();
            return redirect()->back()->with('success', 'timetable deleted Successfully!');
        } 
        else 
        {
            return redirect()->back()->with('error', 'timetable not found!');
        }
    }
     
}
