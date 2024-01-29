<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('teachers')->get();
        // return response()->json($subjects);
        return response()->json([
            'success' => true,
            'message' => 'Detail data Teacher',
            'data' => $subjects
        ], 200);
    }

    public function getTeacher()
    {
        $teachers = Teacher::all()->subjects;
        return response()->json($teachers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'require|string'
        ]);
        $subjects = new Subject([
            'name'=>$request->name
        ]);
        $subjects->save();
        $subjects->teachers()->attach($request->teachers);
        //return response()->json('');
        return response()->json([
            'success' => true,
            'message' => 'Subject created!',
            'data' => $subjects
        ], 200);
    }

    public function show(string $id)
    {
        $subjects = Subject::with('teachers')->find($id);
        return response()->json([
            'success' => true,
            'message' => 'Detail data Teacher',
            'data' => $subjects
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $subjects = Subject::find($id);
        if ($subjects) {
            $request->validate([
                'name'=> 'required|max:250|string'
            ]);
            $subjects->update([
                'name'=>$request->name
            ]);
            // $subjects->teachers()->sync($request->teachers);
            return response()->json([
                'success' => true,
                'message' => 'subjects updated !',
                'data' => $subjects
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'subjects not found !'
        ], 404);
    }
    public function destroy(string $id)
    {
        $subjects = Subject::find($id);
        $subjects->delete();
        $subjects->teachers()->detach();
        return response()->json('Subject has been deleted!');
    }
}
