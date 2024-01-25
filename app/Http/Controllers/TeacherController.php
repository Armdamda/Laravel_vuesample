<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('subjects')->get();
        return response()->json($teachers);
    }
    public function getTeacher()
    {
        $subjects = Subject::all();
        return response()->json($subjects);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'gender' => 'required'
        ]);
        $teachers = new Teacher([
            'name' => $request->name,
            'gender'=>$request->gender,
        ]);
        $teachers->save();
        $teachers->subjects()->attach($request->subject);
        return response()->json([
            'success' => true,
            'message ' => 'Teacher created!',
            'data' => $teachers
        ], 200);
    }

    public function show(string $id)
    {
        $teachers = Teacher::with('subjects')->find($id);
        return response()->json([
            'success' => true,
            'message' => 'Detail data Teacher',
            'data' => $teachers
        ], 200);
    }
    public function update(Request $request, string $id)
    {
        $teachers = Teacher::with('subjects')->find($id);
        if ($teachers) {
            $request->validate([
                'name' => 'required|max:255',
                'gender' => 'required'
            ]);
            $teachers->update([
                'name' => $request->name,
                 'gender'=>$request->gender,
            ]);
            $teachers->subjects()->sync($request->subject);
            return response()->json([
                'success' => true,
                'message' => 'Teacher updated',
                'data' => $teachers
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Teacher not found'
        ], 404);
    }
    public function destroy(Request $request, string $id)
    {
        $teachers = Teacher::with('subjects')->find($id);
        if ($teachers) {
            $teachers->delete();
            $teachers->subjects()->detach($request->subject);
            return response()->json([
                'success' => true,
                'message' => 'Teacher has deleted!'
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Teacher not found'
        ], 404);
    }
}