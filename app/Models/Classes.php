<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Subject;

class Classes extends Model
{
    protected $table ="classes";
    protected $fillable=[
        'name',
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id' ,'id');
    }
    //many to many (classrooms to subject)
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'classes__subjects','class_id','subject_id')->withPivot('teacher_id');
    }

}
