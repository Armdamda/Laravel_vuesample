<?php

use App\Http\Controllers\ClassesController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//apiresource(index,store,update,destroy)

Route::apiResource('classes',ClassesController::class);
Route::get('subjects/{id}/teachers', [ClassesController::class, 'subjectTeachers']);
Route::apiResource('teachers',TeacherController::class);
Route::apiResource('subjects',SubjectController::class);
Route::apiResource('students', StudentController::class);
