<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'department_id',
    ];

    public function enrollments() : HasMany
    {
        return $this->hasMany(Enrollment::class,'course_id');
    }

    public function students() : HasMany
    {
        return $this->hasMany(Student::class,'course_id');
    }

    public function department() : BelongsTo
    {
        return $this->belongsTo(Department::class,'department_id');
    }
}
