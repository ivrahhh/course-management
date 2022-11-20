<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'course_id',
        'student_id',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function course() : BelongsTo
    {
        return $this->belongsTo(Course::class,'course_id');
    }
}
