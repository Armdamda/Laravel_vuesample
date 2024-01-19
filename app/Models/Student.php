<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $table="students";
    protected $fillable =[
        'name',
        'gender',
        'class_id'
    ];

    public function classroom():BelongsTo
    {
        return $this->belongsTo(Classes::class, 'class_id','id' );
    }
}
