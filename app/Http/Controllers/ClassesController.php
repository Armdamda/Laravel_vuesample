<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;

class ClassesController extends Controller
{
    public function index()
    {
        $grade = Classes::with('students','subjects')->get();
        return response()->json($grade);
    }
    public function getTeacher(){
        $teachers = Teacher::all();
        return response()->json($teachers);
    }
    public function getStudent()
    {
        $students = Student::all();
        
        return response()->json($students);
    }
    public function getSubject()
    {
        $subjects = Subject::all();
        return response()->json($subjects);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $grade = new Classes([
            'name'=> $request->input('name')
        ]);  
        $grade->save();
        $grade->subjects()->sync([
            $request->subject => [ 'teacher_id' =>   $request->teacher],
            $request->subject1 => [ 'teacher_id' => $request->teacher1],
            $request->subject2 => [ 'teacher_id' => $request->teacher2],
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Created data grade',
            'data' => $grade
        ], 200);
    }

    public function show(string $id)
    {
        $grade = Classes::with('subjects','students')->find($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail data grade',
            'data' => $grade
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        // $grade = Classes::find($id)->teachers()->get();
         $grade = Classes::with('subjects')->find($id);
        if ($grade) {
            $grade->update();
            $grade->subjects()->sync([
                $request->subject =>   [ 'teacher_id' => $request->teacher],
                $request->subject1 => [ 'teacher_id' => $request->teacher1],
                $request->subject2 => [ 'teacher_id' => $request->teacher2],
            ]);
            return response()->json([
                'success' => true,
                'message' => 'student updated',
                'data' => $grade
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'student not found'
            ], 404);
        }
    }

    public function destroy(string $id)
    {
        $grade =Classes::find($id);
        if($grade){
            $grade->delete();
            return response()->json([
                'success'=> true,
                'message'=>'Deleted succesfuly!'
            ],200);
        }
        else{
            return response()->json([
                'success'=> false,
                'message'=>'Class not found!'
            ],400);
        }
    }
   //new route that use for store data between subject and classes
    public function  subjectTeachers(string $id) 
    {
        $teachers = Subject::find($id)->teachers()->get();
        return response()->json($teachers);
    }
}