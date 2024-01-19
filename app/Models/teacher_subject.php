<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teacher_subject extends Model
{
    protected $table = 'teacher_subjects';
    protected $primaryKey = 'id';
    protected $fillable =[
        'teacher_id',
        'subject_id',
    ];
}
