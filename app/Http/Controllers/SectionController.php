<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
    //
    public function index()
    {
        $sections = DB::table('divisions')->where('title', '=', 'section')->orderBy('class', 'asc')->get();
        return view('section.section_home',['sections' => $sections]);
    }

    public function create()
    {
        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        return view('section.section_add', ['classes' => $classes]);
    }

    public function update($id)
    {
        $classes = DB::table('classes')->orderBy('class', 'asc')->get();
        $section = DB::table('divisions')->where('id', '=', $id)->first();
        return view('section.section_update', ['section' => $section, 'classes' => $classes]);
    }

    public function store(Request $request)
    {
        $title = "section";

        $validator = Validator::make($request->all(), [
            'class' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'capacity' => 'required|string|max:255',
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
        $data->capacity = $request->input('capacity');
        $data->note = $request->input('note');
        if( $data->save() )
        {
            return response()->json([
                'message' => 'section created successfully!',
                'error' => false
            ]);
        }
        else
        {
            return response()->json([
                'message' => 'section failed to create!',
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
            'capacity' => 'required|string|max:255',
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
            'message' => 'section updated successfully!',
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
            return redirect()->back()->with('success', 'section deleted Successfully!');
        } 
        else 
        {
            return redirect()->back()->with('error', 'section not found!');
        }
    }
     
}
