<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;
use App\Models\Classes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $fillable =[
        'name'
    ];

         //many to many (Teacher to Subject)
    public function teachers():BelongsToMany
    {
        return $this->belongsToMany(Teacher::class,'teacher_subjects',  'subject_id',  'teacher_id');
    }
    
     //many to many (Subject to classrooms)
     public function classrooms()
     {
         return $this->belongsToMany(Classes::class,'classes__subjects','subject_id','class_id');
    }
}