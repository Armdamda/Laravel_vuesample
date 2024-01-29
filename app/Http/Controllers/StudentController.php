<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Classes;

class StudentController extends Controller
{
    public function index()
    {
        //$students = Student::all();
        $students = Student::with('classroom')->get();
        return  response()->json($students);
    }
    public function getClassroom()
    {
        $classrooms = Classes::all();
        return response()->json($classrooms);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required',
        ]);
        $students = new Student([
            'name' => $request->name,
            'gender' => $request->gender,
            'class_id' => $request->classroom
        ]);
        $students->save();
        return response()->json('Students created!');
    }

    public function show(string $id)
    {
        $students = Student::with('classroom')->find($id);

        //return response()->json($students);
        return response()->json([
            'success' => true,
            'message' => 'Detail data students',
            'data' => $students
        ], 200);
    }

    public function update(Request $request,  $id)
    {
        $students = Student::with('classroom')->find($id);
        if ($students) {
            $students->update([
                'name' => $request->name,
                'gender' => $request->gender,
                'class_id' => $request->classroom,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Student updated !',
                'data' => $students
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'student not found'
            ], 404);
        }
    }

    public function destroy(Student $students, $id)
    {
        $students = Student::find($id);
        if ($students) {
            $students->classrooms->detach();
            $students->delete();
            return response()->json([
                'success' => true,
                'message' => 'students deleted'
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'students not found'
            ], 404);
        }
    }
}
