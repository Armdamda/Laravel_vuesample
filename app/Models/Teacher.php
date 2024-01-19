<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Subject;


class Teacher extends Model
{
    protected $table = 'teachers';
    protected $fillable=[
        'name',
        'gender'
    ];
    
    public function  subjects():BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'teacher_subjects','teacher_id','subject_id');
    }
   
}
