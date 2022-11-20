<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'email',
        'contact',
        'course_id',
    ];

    public function enrollments() : HasMany
    {
        return $this->hasMany(Enrollment::class,'student_id');
    }

    public function course() : BelongsTo
    {
        return $this->belongsTo(Course::class,'course_id');
    }
}
